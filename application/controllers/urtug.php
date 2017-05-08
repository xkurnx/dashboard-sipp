<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Urtug extends CI_Controller {
	public $ta = 0;
	public $user_id = 0;
	function __construct() {
		parent::__construct();	
		$this->load->model('skp_model','skp');	
		$this->ta = $this->session->userdata('admin_ta');
		$this->user_id = $this->session->userdata('admin_id');
		
		//ambil variabel URL
		$mau_ke					= $this->uri->segment(3);
		$idu					= $this->uri->segment(4);
	
		$this->skp->set_tahun($this->ta);
		$this->skp->set_user_id($this->user_id);		
	}
	
	public function index() {
		
		if ($this->session->userdata('admin_valid') == FALSE && $this->session->userdata('admin_id') == "") {
			redirect("index.php/admin/login");
		}		
		$this->fetch_urtug();	
		
	}
	
	
	private function fetch_urtug(){

		$data['l_urtug'] = $this->skp->fetch_urtug()->result();
		$a['content']	= $this->load->view('l_urtug', $data, true);	
		$this->load->view('template', $a);		
	}
	
	
	/**** download SKP dalam bentuk XLS ****/
	
	public function download(){

		$data['l_urtug'] = $this->skp->fetch_urtug()->result();
		$data['prof_peg'] = $this->skp->get_user_profile_by_id($this->user_id);
		$id_atasan  = $data['prof_peg'][0]->id_atasan;
		$data['prof_penilai'] = $this->skp->get_user_profile_by_id($id_atasan );
		$a['content']	= $this->load->view('l_urtug_xls', $data);			
	}
	
	
	
	/****************** CRUD functions *******************/
	public function save(){
		
		$data['id_user'] = addslashes($this->session->userdata('admin_id'));		
		$data['tahun'] = addslashes($this->session->userdata('admin_ta'));
		$data['urtug'] = addslashes($this->input->post('urtug'));
		$data['id_urtug'] = addslashes($this->input->post('id_urtug'));
		$data['target_volume'] = addslashes($this->input->post('target_volume'));
		$data['target_output'] = addslashes($this->input->post('target_output'));
		$data['target_bulan'] = addslashes($this->input->post('target_bulan'));
		#print_r($data);
		if ( $data['urtug'] !='' )
		{
			$msg = $this->skp->save_urtug($data);
			echo $msg;
		}	
	}
			
		
	public function del() {		
		$data['id_user'] = addslashes($this->session->userdata('admin_id'));		
		$data['tahun'] = addslashes($this->session->userdata('admin_ta'));
		$data['id_urtug'] = addslashes($this->input->post('id_urtug'));
		$msg = $this->skp->del_urtug($data);	
		echo $msg;
	}
	
	public function import_urtug_by_jabatan(){
		$this->skp->import_urtug_by_jabatan($this->session->userdata('admin_id'),$this->session->userdata('admin_kode_jabatan'),$this->session->userdata('admin_ta'));	
		redirect('index.php/urtug');
	}
	
	public function submit_target(){
		//print_r($_SERVER);
		$this->skp->submit_target($this->session->userdata('admin_id'),$this->session->userdata('admin_ta'));	
		redirect('index.php/urtug');
	}
		

	
	
	
}
