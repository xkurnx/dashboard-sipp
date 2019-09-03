<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tv extends CI_Controller {
	function __construct() {
		parent::__construct();	
		$this->load->model('dashboard_model','dashboard');
        $this->load->library('session');
        // cek session
        if ( $this->session->userdata('namaPN') =='' )  :
            $config = array(
            'namaPN'  => $this->dashboard->get_sys_config('NamaPN')
            );

        $this->session->set_userdata($config);
        endif;

	}
	
	
	public function index	(){
		$a['style']="tv";
		$data['jadwal_sidang_1'] = $this->dashboard->jadwal_sidang(1);
		$data['jadwal_sidang_2'] = $this->dashboard->jadwal_sidang(2);
		$data['jadwal_sidang_3'] = $this->dashboard->jadwal_sidang(3);
		$data['rekap_jenis_perkara'] = $this->dashboard->rekap_jenis_perkara();	
		$data['blm_psp'] = $this->dashboard->blm_psp();	
		$a['namaPN'] = $this->session->userdata('namaPN');
		$a['content'] = $this->load->view('v_tv_pengunjung', $data, true);	
		$a['style']="tv";		
		$this->load->view('template_tv', $a);	
		
	}	
	
	public function progress_hakim_detail($id,$filter){
		
		$data = $this->dashboard->get_progress_hakim_detail($id,$filter);
		$nama_hakim = $this->dashboard->get_nama_hakim($id);
		switch($filter) {
			case 'sisa' :
				$text_filter = '- Sisa perkara tahun lalu (belum minutasi)';
			break;
			case 'terima' :
				$text_filter = '- Perkara yang diterima Tahun ini';
			break;
			case 'putus' :
				$text_filter = '- Perkara yang diputus Tahun ini';
			break;
			default:
				$text_filter = '';
			
		}
		
		
		$this->load->library('table');
		
		$tmpl = array ( 'table_open'  => '<table class="table table-striped table-hover">' );
		
		$this->table->set_template($tmpl); 
		$this->table->set_heading('No', 'Nomor Perkara', 'Pemohon/Penggugat','Tgl Daftar','Tgl Sidang I','Tgl Putusan','Tgl Minutasi','Status Terakhir');
		$i = 0;
		foreach ($data as $row ):
		$i++;
		$pihak = (strlen($row['pihak1_text']) > 35) ? substr($row['pihak1_text'], 0, 35) . '...' : $row['pihak1_text'];
			$this->table->add_row($i, $row['nomor_perkara'], $pihak, $row['tanggal_pendaftaran'], $row['sidang_pertama'], $row['tanggal_putusan'], $row['tanggal_minutasi'],$row['proses_terakhir_text']);
		endforeach;
		
		$data['html_table'] = $this->table->generate(); 		
		$data['text_filter'] = $text_filter;
        $data['text_nama'] = "Ketua Majelis : ".$nama_hakim;
		$a['content']	= $this->load->view('simple_table', $data, true);	
		$this->load->view('template', $a);	
	}
	
	public function progress_pp_detail($id,$filter){
		
		$data = $this->dashboard->get_progress_pp_detail($id,$filter);
		$nama_pp = $this->dashboard->get_nama_pp($id);
		switch($filter) {
			case 'sisa' :
				$text_filter = '- Sisa perkara tahun lalu (belum minutasi)';
			break;
			case 'terima' :
				$text_filter = '- Perkara yang diterima Tahun ini';
			break;
			case 'putus' :
				$text_filter = '- Perkara yang diputus Tahun ini';
			break;
			default:
				$text_filter = '';
			
		}
		
		
		$this->load->library('table');
		
		$tmpl = array ( 'table_open'  => '<table class="table table-striped table-hover">' );
		
		$this->table->set_template($tmpl); 
		$this->table->set_heading('No', 'Nomor Perkara', 'Pemohon/Penggugat','Tgl Daftar','Tgl Sidang I','Tgl Putusan','Tgl Minutasi','Status Terakhir');
		$i = 0;
		foreach ($data as $row ):
		$i++;
		$pihak = (strlen($row['pihak1_text']) > 35) ? substr($row['pihak1_text'], 0, 35) . '...' : $row['pihak1_text'];
			$this->table->add_row($i, $row['nomor_perkara'], $pihak, $row['tanggal_pendaftaran'], $row['sidang_pertama'], $row['tanggal_putusan'], $row['tanggal_minutasi'],$row['proses_terakhir_text']);
		endforeach;
		
		$data['html_table'] = $this->table->generate(); 		
		$data['text_filter'] = $text_filter;
        $data['text_nama'] = "Panitera Pengganti : ".$nama_pp;
		$a['content']	= $this->load->view('simple_table', $data, true);	
		$this->load->view('template', $a);	
	}
	
	

	
	
	
	
}
