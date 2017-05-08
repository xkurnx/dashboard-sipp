<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*****************
validasi Uraian Tugas oleh Penjabat Penilai (atasan Langsung)
******************/

class Validasi_urtug extends CI_Controller {
	function __construct() {
		parent::__construct();	
		$this->load->model('skp_model','skp');		
		$this->load->library('user_agent');
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
		$this->rekap_urtug_bawahan();			
	}
	
	
	private function rekap_urtug_bawahan(){
		/****
		status = 0 or null draft
		status = 1, menunggu validasi atasan
		status = 2, verified
		***/
		$data['l_urtug'] = $this->skp->fetch_rekap_urtug_bawahan()->result();
		$a['content']	= $this->load->view('rekap_urtug_bawahan', $data, true);	
		$this->load->view('template', $a);		
	}
	
	function urtug_bawahan($id_bawahan){
		$this->skp->set_tahun($this->session->userdata('admin_ta'));
		$this->skp->set_user_id($id_bawahan);
		$data['profile_bawahan'] = $this->skp->get_user_profile_by_id($id_bawahan);
		$data['l_urtug'] = $this->skp->fetch_urtug()->result();
		$a['content']	= $this->load->view('f_vef_urtug_bawahan', $data, true);	
		$this->load->view('template', $a);		
	}
	
	
	public function verifikasi_target($id_urtug,$status){
		if ($this->agent->is_referral())
		{
			$this->skp->verifikasi_target($id_urtug,$status);	
			redirect($this->agent->referrer());
		}	
		
	}
		

	
	
	
}
