<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Proses_skp extends CI_Controller {
	function __construct() {
		parent::__construct();	
		$this->load->model('skp_model','skp');			
	}
	
	public function index() {
		
		if ($this->session->userdata('admin_valid') == FALSE && $this->session->userdata('admin_id') == "") {
			redirect("index.php/admin/login");
		}
		$ta = $this->session->userdata('admin_ta');
		$user_id = $this->session->userdata('admin_id');
		
		//ambil variabel URL
		$mau_ke					= $this->uri->segment(3);
		$idu					= $this->uri->segment(4);
	
		$this->skp->set_tahun($ta);
		$this->skp->set_user_id($user_id);
		$this->mon();			
	}
	
	
	public function kirim_ke_atasan(){
		$this->skp->kirim_ke_atasan($this->session->userdata('admin_id'),$this->session->userdata('admin_ta'));	
		redirect('index.php/dashboard');
	}
	
	public function rekap_bawahan(){
		/****
		status = 3
		***/
		$this->skp->set_tahun($this->session->userdata('admin_ta'));
		$this->skp->set_user_id($this->session->userdata('admin_id'));
		$data['l_urtug'] = $this->skp->fetch_rekap_skp_bawahan()->result();
		$a['content']	= $this->load->view('rekap_skp_bawahan', $data, true);	
		$this->load->view('template', $a);		
	}
		
	public function skp_bawahan($id_bawahan){	
		
		$this->skp->set_tahun($this->session->userdata('admin_ta'));
		$this->skp->set_user_id($id_bawahan);
		$data['profile_bawahan'] = $this->skp->get_user_profile_by_id($id_bawahan);
		
		$data['l_urtug'] = $this->skp->fetch_detail_skp_bawahan()->result();
		$data['id_bawahan'] = $id_bawahan;
		
		$a['content']	= $this->load->view('f_nilai_skp_bawahan', $data, true);	
		$this->load->view('template', $a);		
	}
	
	
	public function input_nilai_bawahan(){
		$data = $this->input->post('kualitas');
		$id_bawahan = $this->input->post('id_bawahan');
		$this->skp->set_tahun($this->session->userdata('admin_ta'));	
		$this->skp->set_user_id($id_bawahan);	
		
		foreach ( $data as $id_urtug => $kualitas ){
			#echo "$id_urtug -> $kualitas </br>";
			if ( $kualitas > 0 )
				$this->skp->isi_nilai_bawahan_per_urtug($id_urtug,$kualitas);
		}
		
		$this->skp->update_status_skp(3,4);
		$this->session->set_flashdata("k", "<div class=\"alert alert-success\" id=\"alert\">Penilaian SKP telah berhasil</div>");
		redirect('index.php/proses_skp/skp_bawahan/'.$id_bawahan);
	}
	
	
}
