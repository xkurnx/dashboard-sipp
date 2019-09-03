<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Validasi extends CI_Controller {
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
        $a['namaPN'] = $this->dashboard->get_sys_config('NamaPN');
		$a['content']	= $this->load->view('v_dashboard', $data, true);
		$this->load->view('template', $a);
	}

    public function pts_blm_ikrar(){

		$data = $this->dashboard->get_data_ikrar();
		$this->load->library('table');

		$tmpl = array ( 'table_open'  => '<table class="table table-striped table-hover">' );

		$this->table->set_template($tmpl);
		$this->table->set_heading('No', 'Nomor Perkara', 'Ketua Majelis','Tgl Daftar','Tgl Putusan','Tgl Minutasi','Tgl BHT','Tgl Ikrar', 'Status Terakhir');
		$i = 0;
		foreach ($data as $row ):
		$i++;
		$pihak = $row['hakim_nama'];
			$this->table->add_row($i, $row['nomor_perkara'], $pihak, $row['tanggal_pendaftaran'],  $row['tanggal_putusan'], $row['tanggal_minutasi'],$row['tanggal_bht'],$row['tgl_ikrar_talak'], $row['proses_terakhir_text']);
		endforeach;


        $data['html_table'] = $this->table->generate();
		$data['text_filter'] = " - Sudah Putus Belum Ikrar";
        $data['text_nama'] = "";
		$a['content']	= $this->load->view('simple_table', $data, true);
		$this->load->view('template', $a);
	}
	
	function ping(){
			$siteaddressAPI = "http://tv.pa-stabat.go.id/check.php";
			$data = file_get_contents($siteaddressAPI);
			header('Content-Type: application/json');
			echo json_encode($data);

	}




}
