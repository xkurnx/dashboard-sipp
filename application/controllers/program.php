<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Program extends CI_Controller {
	public $id_pelaksana = 0;
	public $tipe = 'P';
	public $keyword = '';
	function __construct() {
		parent::__construct();	
		$this->load->model('program_model','program');	
		$this->load->model('sms_model','sms');			
	}
	
	public function index($tipe='P') {
		
		if ($this->session->userdata('admin_valid') == FALSE && $this->session->userdata('admin_id') == "") {
			redirect("index.php/admin/login");
		}
		$ta = $this->session->userdata('admin_ta');
		
		//ambil variabel URL
		$mau_ke					= $this->uri->segment(3);
		$idu					= $this->uri->segment(4);
		
		$this->fetch_program($tipe);
		
		
	}
	
	private function fetch_program($tipe){
		$data['tipe'] = $tipe;
		$data['l_tipe'] = ( $tipe == 'T' )? "TUGAS" :"PROGRAM";
		
		$this->program->set_tipe($tipe);
		
		/* pagination */	
		$total_row = $this->program->get_list_program()->num_rows();
		$per_page		= 20;
		
		$awal	= $this->uri->segment(4); 
		$awal	= (empty($awal) || $awal == 1) ? 0 : $awal;
		
		$akhir	= $per_page;
		
		$data['pagi']	= _page($total_row, $per_page, 4, base_url()."index.php/program/index/".$tipe);
		#echo $awal;exit;
		$data['l_program'] = $this->program->get_list_program($awal,$akhir)->result();
		$a['content']	= $this->load->view('l_program', $data, true);	
		$this->load->view('template', $a);		
	}
	
	private function get_tipe_by_kode($tipe){
		switch ($tipe) {
			case 'T':
				return "Tugas";
			break;
			case 'p':
				return "Program";
			
		}		
	}
	
	public function task(){
		$this->fetch_program("T");		
	}
	
	/****************** CRUD functions *******************/
	public function add($tipe='P'){
		$data['l_pejabat']= $this->db->query("SELECT * FROM t_user where kode_jabatan is not null order by kode_jabatan asc")->result();
		if ( $tipe == 'T' ) $data['l_pejabat']= $this->db->query("SELECT  * FROM t_user ORDER BY (CASE WHEN kode_jabatan IS NULL OR kode_jabatan=0 THEN 9000 ELSE kode_jabatan END) ASC")->result();
		$data['tipe'] = $tipe;
		$data['l_tipe'] = ( $tipe == 'T' )? "TUGAS" :"PROGRAM";
		$a['content']	= $this->load->view('f_program', $data, true);	
		$this->load->view('template', $a);
	}
	
	public function edt($id,$tipe='P'){
		$data['l_pejabat']= $this->db->query("SELECT * FROM t_user where kode_jabatan is not null order by kode_jabatan asc")->result();
		
		$data['d_program'] = $this->program->get_program_by_id($id);
		if ( $tipe == 'T' ) $data['l_pejabat']= $this->db->query("SELECT  * FROM t_user ORDER BY (CASE WHEN kode_jabatan IS NULL OR kode_jabatan=0 THEN 9000 ELSE kode_jabatan END) ASC")->result();
		
		$a['content']	= $this->load->view('f_program', $data, true);	
		$this->load->view('template', $a);
	}
	
	public function save() {
		
		$data['idp'] = addslashes($this->input->post('idp'));
		$data['tipe'] = addslashes($this->input->post('tipe'));
		$data['program'] = addslashes($this->input->post('program'));
		$data['deskripsi'] = addslashes($this->input->post('deskripsi'));
		$data['id_pelaksana'] = addslashes($this->input->post('id_pelaksana'));
		$data['duedate'] = addslashes($this->input->post('duedate'));
		$data['id_pembuat'] = addslashes($this->session->userdata('admin_id'));
		$data['tgl_buat'] = date('Y-m-d h:i:s');
		
		$this->program->save($data);	
			
		// Kirim SMS ke Pelaksana jika buat program baru
		if ( $data['idp'] == '' ) {
			$pelaksana = $this->program->get_user_profile_by_id($data['id_pelaksana'])->row();
			$admin_nama = $this->session->userdata('admin_nama');
			$sms['DestinationNumber'] = $pelaksana->hp;
			$sms['CreatorID'] = $this->session->userdata('admin_user');
			$sms['TextDecoded'] = 'Misi baru untuk anda: '.$data['program'].", target:".$data['duedate']."[".$admin_nama."]";
			$this->sms->send($sms);	
		}
		$this->session->set_flashdata("k", "<div class=\"alert alert-success\" id=\"alert\">Data Berhasil disimpan.</div>");
		redirect('index.php/program/'.($data['tipe'] == 'T' ?'task':'' ));
	}
	
	public function del($idp) {		
		$this->program->del($idp);	
		$this->session->set_flashdata("k", "<div class=\"alert alert-success\" id=\"alert\">Data Program Berhasil dihapus.</div>");
		redirect('index.php/program');
	}
	
	public function selesai($idp) {		
		$this->program->close($idp);	
		$data['idp'] = $idp;
		$data['komentar'] = "Program telah diselesaikan";
		$data['id_user'] = addslashes($this->session->userdata('admin_id'));
		$data['tgl_input'] = date('Y-m-d h:i:s');
		$this->program->add_comment($data);	
		$this->session->set_flashdata("k", "<div class=\"alert alert-success\" id=\"alert\">Data Program telah diselesaikan.</div>");
		#redirect('index.php/program');
	}
	
	public function view($idp) {	
		$data['d_program'] = $this->program->get_program_by_id($idp);	
		$data['d_komentar'] = $this->program->fetch_komentar($idp);	
		$data['admin_id'] = $this->session->userdata('admin_id');
		$a['content']	= $this->load->view('v_program', $data, true);	
		$this->load->view('template', $a);
		
	}
	
	/********* search function **********/
	public function cari($tipe){
		$this->program->set_tipe($tipe);
		$this->program->set_keyword(addslashes($this->input->post('q')));
		$this->fetch_program($tipe);	
	}
	
	public function addcomment() {		
		$data['idp'] = addslashes($this->input->post('idp'));
		$data['komentar'] = addslashes($this->input->post('komentar'));
		$data['id_user'] = addslashes($this->input->post('id_user'));
		$kode_tugas = addslashes($this->input->post('kode'));
		$id_pembuat = addslashes($this->input->post('id_pembuat'));
		$id_pelaksana = addslashes($this->input->post('id_pelaksana'));
		$data['tgl_input'] = date('Y-m-d h:i:s');
		$this->program->add_comment($data);	
		
		// kirim SMS comment
		// klo yg koment == yg melaksanakan, SMS dikirim ke pembuat ELSE dikirim ke pelaksana
		$id_yg_disms = ( $data['id_user'] == $id_pelaksana ) ? $id_pembuat : $id_pelaksana;
		$commentator = $this->program->get_user_profile_by_id($id_yg_disms)->row();
		$admin_nama = $this->session->userdata('admin_nama');
		$sms['DestinationNumber'] = $commentator->hp;
		$sms['CreatorID'] = $this->session->userdata('admin_user');
		$sms['TextDecoded'] = $data['komentar']."[".$admin_nama.'/'.$kode_tugas."]";
		$this->sms->send($sms);	
		
		$this->session->set_flashdata("k", "<div class=\"alert alert-success\" id=\"alert\">Data Program Berhasil disimpan.</div>");
		redirect('index.php/program/view/'.$data['idp']);
	}
	
		
	

	
	
	
}
