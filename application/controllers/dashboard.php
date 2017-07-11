<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	function __construct() {
		parent::__construct();	
		$this->load->model('dashboard_model','dashboard');			
	}
	
	public function index() {
		$data['rekap_sidang'] = $this->dashboard->fetch_rekap_sidang();
		$data['stat_perkara'] = $this->dashboard->fetch_rekap_stat_perkara();
		$data['progres_hakim'] = $this->dashboard->get_progress_hakim();
		$data['progres_pp'] = $this->dashboard->get_progress_pp();
		$data['delegasi_keluar'] = $this->dashboard->fetch_upcoming_delegasi_keluar();
		$data['delegasi_masuk'] = $this->dashboard->fetch_upcoming_delegasi_masuk();
		$a['content']	= $this->load->view('v_dashboard', $data, true);	
		$this->load->view('template', $a);	
	}

    /** dashboad on fullscreen **/
    public function fullscreen() {
		$data['rekap_sidang'] = $this->dashboard->fetch_rekap_sidang();
		$data['stat_perkara'] = $this->dashboard->fetch_rekap_stat_perkara();
		$data['progres_hakim'] = $this->dashboard->get_progress_hakim();
		$data['progres_pp'] = $this->dashboard->get_progress_pp();
		$data['delegasi_keluar'] = $this->dashboard->fetch_upcoming_delegasi_keluar();
		$data['delegasi_masuk'] = $this->dashboard->fetch_upcoming_delegasi_masuk();
		$a['content']	= $this->load->view('v_dashboard_fs', $data, true);
		$this->load->view('template_fs', $a);
	}
	
	public function progress_hakim_detail($id,$filter){
		
		$data = $this->dashboard->get_progress_hakim_detail($id,$filter);
		
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
		$this->table->set_heading('No', 'Nomor Perkara', 'Pihak 1','Tgl Daftar','Tgl Sidang I','Tgl Putusan','Tgl Minutasi','Status Terakhir');
		$i = 0;
		foreach ($data as $row ):
		$i++;
		$pihak = (strlen($row['pihak1_text']) > 35) ? substr($row['pihak1_text'], 0, 35) . '...' : $row['pihak1_text'];
			$this->table->add_row($i, $row['nomor_perkara'], $pihak, $row['tanggal_pendaftaran'], $row['sidang_pertama'], $row['tanggal_putusan'], $row['tanggal_minutasi'],$row['proses_terakhir_text']);
		endforeach;
		
		$data['html_table'] = $this->table->generate(); 		
		$data['text_filter'] = $text_filter;
		$a['content']	= $this->load->view('simple_table', $data, true);	
		$this->load->view('template', $a);	
	}
	
	public function progress_pp_detail($id,$filter){
		
		$data = $this->dashboard->get_progress_pp_detail($id,$filter);
		
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
		$this->table->set_heading('No', 'Nomor Perkara', 'Pihak 1','Tgl Daftar','Tgl Sidang I','Tgl Putusan','Tgl Minutasi','Status Terakhir');
		$i = 0;
		foreach ($data as $row ):
		$i++;
		$pihak = (strlen($row['pihak1_text']) > 35) ? substr($row['pihak1_text'], 0, 35) . '...' : $row['pihak1_text'];
			$this->table->add_row($i, $row['nomor_perkara'], $pihak, $row['tanggal_pendaftaran'], $row['sidang_pertama'], $row['tanggal_putusan'], $row['tanggal_minutasi'],$row['proses_terakhir_text']);
		endforeach;
		
		$data['html_table'] = $this->table->generate(); 		
		$data['text_filter'] = $text_filter;
		$a['content']	= $this->load->view('simple_table', $data, true);	
		$this->load->view('template', $a);	
	}
	
	
	
	
	
	
	
	
}
