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
		$data_db['nomor_akta_cerai'] = $this->input->post('nomor_akta_cerai');
		$data_db['perkara_id'] = $this->input->post('perkara_id');
		$data_db['nama_pihak_pengambil'] = $this->input->post('nama_pihak_pengambil');
		$data_db['nama_pihak1'] = $this->input->post('nama_pihak1');
		$data_db['nama_pihak2'] = $this->input->post('nama_pihak2');
		$data_db['url_photo'] = $file_photo;
		$data_db['date_req'] = date('Y-m-d H:i:s');
		
		if ( $this->db->insert('permintaan_ac.req_ac',$data_db) )
		{
			$ret['id_req'] =  $this->db->insert_id();
			$ret['message'] = "Data Berhasil diUpload";
		}	
		
		echo json_encode($ret);
		// 3. return id_req 
	}
	
	function print_tt($id){
		$data_req =  $this->ac->get_data_req($id);
		/*****
		$template = "aset/template/permintaan_ac.rtf";
		$handle = fopen($template, "r+");
		$hasilbaca = fread($handle, filesize($template));
		fclose($handle);
		 
		//nilai yang akan dituliskan dalam template
		//pada praktek sebenarnya anda bisa mengambil data dari database
		$data_req =  $this->ac->get_data_req($id);
		 
		//tuliskan data dalam template
		$hasilbaca = str_replace('nomor_perkara', $data_req->nomor_perkara, $hasilbaca);
		$hasilbaca = str_replace('nomor_akta_cerai', $data_req->nomor_akta_cerai, $hasilbaca);
		$hasilbaca = str_replace('nama_pemohon', $data_req->nama_pemohon, $hasilbaca);
		$hasilbaca = str_replace('alamat_pemohon', $data_req->alamat_pemohon, $hasilbaca);
		$hasilbaca = str_replace('telp_pemohon', $data_req->telp_pemohon, $hasilbaca);
		$hasilbaca = str_replace('nama_pihak1', $data_req->nama_pihak1, $hasilbaca);
		$hasilbaca = str_replace('nama_pihak22', $data_req->nama_pihak2, $hasilbaca);
		$hasilbaca = str_replace('date_req', date_format(date_create($data_req->date_req),"d-m-Y"), $hasilbaca);
		$hasilbaca = str_replace('fulldatereq', $data_req->date_req, $hasilbaca);
		$photo64 = "{\rtf1
{\pict
\jpegblip
89504e470d0a1a0a0000000d49484452000000200000001708030000005ddbbdd300000300504c5445ffffffffffccffff99ffff66ffff33ffff00ffccffffcc
ccffcc99ffcc66ffcc33ffcc00ff99ffff99ccff9999ff9966ff9933ff9900ff66ffff66ccff6699ff6666ff6633ff6600ff33ffff33ccff3399ff3366ff3333
ff3300ff00ffff00ccff0099ff0066ff0033ff0000ccffffccffccccff99ccff66ccff33ccff00ccccffcccccccccc99cccc66cccc33cccc00cc99ffcc99cccc
9999cc9966cc9933cc9900cc66ffcc66cccc6699cc6666cc6633cc6600cc33ffcc33cccc3399cc3366cc3333cc3300cc00ffcc00cccc0099cc0066cc0033cc00
0099ffff99ffcc99ff9999ff6699ff3399ff0099ccff99cccc99cc9999cc6699cc3399cc009999ff9999cc9999999999669999339999009966ff9966cc996699
9966669966339966009933ff9933cc9933999933669933339933009900ff9900cc99009999006699003399000066ffff66ffcc66ff9966ff6666ff3366ff0066
ccff66cccc66cc9966cc6666cc3366cc006699ff6699cc6699996699666699336699006666ff6666cc6666996666666666336666006633ff6633cc6633996633
666633336633006600ff6600cc66009966006666003366000033ffff33ffcc33ff9933ff6633ff3333ff0033ccff33cccc33cc9933cc6633cc3333cc003399ff
3399cc3399993399663399333399003366ff3366cc3366993366663366333366003333ff3333cc3333993333663333333333003300ff3300cc33009933006633
003333000000ffff00ffcc00ff9900ff6600ff3300ff0000ccff00cccc00cc9900cc6600cc3300cc000099ff0099cc0099990099660099330099000066ff0066
cc0066990066660066330066000033ff0033cc0033990033660033330033000000ff0000cc000099000066000033000000f7c695f6c491f6c08af5b97de5a96d
c3905da2774d82603e684d324c3824574129b4845560472deaad6fe7aa6ee0a56ad79f66ce9862a87c50946d467c5c3befb072c7935f644a30f4b5764f3b26f4
b778f5b87bf5ba7ff5bd84f6c28df6c38ff6c593f7ca9cf8d0a8f9d7b54d3824755638fbe2caffffff4eb00bbe0000010074524e53ffffffffffffffffffffff
ffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffff
ffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffff
ffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffff
ffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffff0053f7072500000001624b47
440088051d480000000c636d50504a436d703037313200000003480073bc000000e84944415428539d92cb7683201400f3ff5f188989a21205b5a5e095006a0b
25c174a19ed3590fc3eb9ebe0f38fd53208fd7c28d42adecd3d8109af140a0c82c21b15500b304c3098c92419d230a2469523036184ee86e94a355481088be07
ed046f38a1c8ca1492884230087e51cf841370de528956000629e42be185afae249788945270ce87d12716bf05f689f49d3b21bd40da586b835064ecface076d
6a0e676dccef21b14fdcfec04a4ae0a175b885138a398b74b3a32d6bff365198aa3c5215139e3e5b2a50b2f3d438bbf630ee097359cbbdcfc2396b767f13cf6c7f60aaec60e4d651fe0132d0c07e948f6cb20000000049454e44ae426082
}
}";
		#$photo64 = "AA"; 
		$hasilbaca = str_replace('fotopemohon', $photo64, $hasilbaca);
		#echo $data_req->nama_pihak1;exit;
		$file_output = 	$data_req->nomor_perkara."/".substr($data_req->nama_pemohon,0,5);
		#$file_output = str_replace('/', '_');
		
		Header("Content-type: application/rtf"); Header("Content-Disposition: attachment;filename=".$file_output.".rtf");

		echo $hasilbaca;	
		
		
		//membuat file baru dari hasil baca
		$hasil = "uploads/tt_ac/hasil_laporan.rtf";
		$handle = fopen($hasil, "w+");
		fwrite($handle, $hasilbaca);
		fclose($handle);
		 
		//membuka file hasil secara langsung
		//header('Location:'.$hasil); 
		 
		//atau membuka file melalui link
		echo '<a href="'.$hasil.'">Hasil</a>'	;

		***/
		
		$a['data_req'] = $data_req;
		$this->load->view('print_tt_ac', $a);	
	}
	function extract_no_perk($no_perk){
		$ret = substr($no_perk,0,4).'/Pdt.'.strtoupper(substr($no_perk,4,1)).'/20'.substr($no_perk,5,2).'/PA.Kis';		
		return $ret;		
	}
	
	




}
