<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Template_urtug extends CI_Controller {
	function __construct() {
		parent::__construct();	
		$this->load->model('template_urtug_model','template_urtug');			
	}
	
	public function index() {
		
		if ($this->session->userdata('admin_valid') == FALSE && $this->session->userdata('admin_id') == "") {
			redirect("index.php/admin/login");
		}
		$ta = $this->session->userdata('admin_ta');
		
		//ambil variabel URL
		$mau_ke					= $this->uri->segment(3);
		$idu					= $this->uri->segment(4);
	
		$this->fetch_urtug();	
		
	}
	
	
	public function fetch_urtug($kode_jabatan=0){
		$data['sel_kode_jabatan'] = $kode_jabatan;
		$data['l_jabatan'] = $this->template_urtug->fetch_jabatan()->result();
		$data['l_urtug'] = $this->template_urtug->fetch_urtug($kode_jabatan)->result();
		$a['content']	= $this->load->view('template_urtug', $data, true);	
		$this->load->view('template', $a);		
	}
	
	
	/****************** CRUD functions *******************/
	public function save(){
		
		$data['kode_jabatan'] = addslashes($this->input->post('kode_jabatan'));
		$data['urtug'] = addslashes($this->input->post('urtug'));
		$data['id'] = addslashes($this->input->post('id_urtug'));
		$data['target_output'] = addslashes($this->input->post('target_output'));
		$data['target_bulan'] = addslashes($this->input->post('target_bulan'));
		#print_r($data);
		if ( $data['urtug'] !='' )
		{
			$msg = $this->template_urtug->save_urtug($data);
			echo $msg;
		}	
	}
			
		
	public function del() {		
		$data['id'] = addslashes($this->input->post('id_urtug'));
		$msg = $this->template_urtug->del_urtug($data);	
		echo $msg;
	}
		

	
	
	
}
