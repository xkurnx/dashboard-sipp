<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mon_real_skp extends CI_Controller {
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
	
	
	public function mon(){

		$data['l_urtug'] = $this->skp->fetch_real_harian()->result();
		$a['content']	= $this->load->view('f_input_real_harian', $data, true);	
		$this->load->view('template', $a);		
	}
	
	public function save(){
		$strKey = explode('#',$this->input->post('strKey'));
		$pengurang_tgl = $this->input->post('pengurang_tgl');
		$strVal = explode('#',$this->input->post('strVal'));
		$date = date('Y-m-d');
		$i = 0;
		foreach ( $strKey as $k ){
			$id_urtug = str_replace('input-','',$k);	
			$val = $strVal[$i];			
			$tgl = strtotime ( '-'.$pengurang_tgl.' days' , strtotime ( $date ) ) ;
			$tgl = date ( 'Y-m-d' , $tgl );
			if ( $id_urtug != '' )
				$this->skp->save_realisasi_harian($id_urtug,$tgl,$val);	
			$i++;
		}
		
		
		//$data['l_urtug'] = $this->skp->fetch_urtug()->result();
		//$a['content']	= $this->load->view('f_input_real_harian', $data, true);	
		//$this->load->view('template', $a);		
	}
	
	
	
	public function submit_target(){
		$this->skp->submit_target($this->session->userdata('admin_id'),$this->session->userdata('admin_ta'));	
		redirect('index.php/urtug');
	}
		

	
	
	
}
