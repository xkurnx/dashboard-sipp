<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class TT_Ac extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model('dashboard_model','dashboard');
		$this->load->model('ac_model','ac');
	}

	public function index() {	
		
        $a['namaPN'] = $this->dashboard->get_sys_config('NamaPN');
		$data['title'] = "Formulir Pengambilan Akta Cerai";
		$a['content']	= $this->load->view('frm_tt_ac', $data, true);
		$this->load->view('template', $a);
	}

    public function cek($no_perk){		
		$a['namaPN'] = $this->dashboard->get_sys_config('NamaPN');		
		$extracted_nomor_perk = $this->extract_no_perk($no_perk);
		$data['title'] = "Formulir Pengambilan Akta Cerai - ".$extracted_nomor_perk;
		$data['nomor_perkara'] = $extracted_nomor_perk;
		$data['info_perkara'] =  $this->ac->get_info_perkara($extracted_nomor_perk);
		$a['content']	= $this->load->view('frm_tt_ac', $data, true);
		$this->load->view('template', $a);
	}
	//** request lewat AJAX **/
	
	public function save(){
		// 1. upload photo
		define('UPLOAD_DIR', 'uploads/photo_ac/');
		$img = $this->input->post('base64image');		
		$img = str_replace('[removed]', '', $img);
		$img = str_replace('data:image/jpeg;base64,', '', $img);
		$img = str_replace(' ', '+', $img);		
		$data = base64_decode($img);
		
		$file_photo = UPLOAD_DIR . uniqid() . '.jpeg';
		$success = file_put_contents($file_photo, $data);
		
		
        // 2. save data	
		$data_db['nama_pemohon'] = $this->input->post('nama_pemohon');
		$data_db['alamat_pemohon'] = $this->input->post('alamat_pemohon');
		$data_db['telp_pemohon'] = $this->input->post('telp_pemohon');
		$data_db['nomor_perkara'] = $this->input->post('nomor_perkara');
		$data_db['nama_pihak'] = $this->input->post('nama_pihak');
		$data_db['url_photo'] = $file_photo;
		$data_db['date_req'] = date('Y-m-d h:i:s');
		
		if ( $this->db->insert('req-ac.req_ac',$data_db) )
		{
			$ret['id_req'] =  $this->db->insert_id();
			$ret['message'] = "Data Berhasil diUpload";
		}	
		
		echo json_encode($ret);
		// 3. return id_req 
	}
	
	public function print($id){
				
	}
	function extract_no_perk($no_perk){
		$ret = substr($no_perk,0,4).'/Pdt.'.strtoupper(substr($no_perk,4,1)).'/20'.substr($no_perk,5,2).'/PA.Kis';		
		return $ret;		
	}
	
	




}
