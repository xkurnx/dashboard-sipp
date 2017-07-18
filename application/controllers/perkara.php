<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Perkara extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model('perkara_model','perkara');
	}

	public function index() {
		$data['rekap_sidang'] = $this->perkara->fetch_rekap_sidang();
		$data['stat_perkara'] = $this->perkara->fetch_rekap_stat_perkara();

		$data['process_hakim'] = $this->perkara->get_process_hakim();
		$data['process_hakim_total'] = $this->perkara->get_process_hakim_total();

		$data['selesai_hakim'] = $this->perkara->get_selesai_hakim();
		$data['selesai_hakim_total'] = $this->perkara->get_selesai_hakim_total();

		$data['progres_pp'] = $this->perkara->get_progress_pp();
		$data['process_perkara_masuk'] = $this->perkara->get_process_perkara_masuk();
		$a['content']	= $this->load->view('v_perk', $data, true);
		$this->load->view('template', $a);
	}

	public function process_hakim_detail($id,$filter){

		$data = $this->perkara->get_process_hakim_detail($id,$filter);
        $nama_hakim = $this->perkara->get_nama_hakim($id);


		switch($filter) {
			case 'baik' :
				$text_filter = '- Belum Diputus Kurang Dari 4 Bulan';
			break;
			case 'kurang' :
				$text_filter = '- Belum Diputus 4 s.d 5 Bulan';
			break;
			case 'sangat' :
				$text_filter = '- Belum Diputus 6 s.d 12 Bulan';
			break;
			default:
				$text_filter = '- Belum Diputus Lebih Dari 12 Bulan';

		}


		$this->load->library('table');

		$tmpl = array ( 'table_open'  => '<table class="table table-striped table-hover">' );

		$this->table->set_template($tmpl);
		$this->table->set_heading('No.', 'Nomor Perkara', 'Pemohon/Penggugat','Tgl Daftar','Tgl Sidang I','Status Terakhir','Editor','Waktu Pelaksanaan');
		$i = 0;
		foreach ($data as $row ):
		$i++;
		$pihak = (strlen($row['pihak1_text']) > 35) ? substr($row['pihak1_text'], 0, 35) . '...' : $row['pihak1_text'];
			$this->table->add_row($i, $row['nomor_perkara'], $pihak, $row['tanggal_pendaftaran'], $row['sidang_pertama'], $row['proses_terakhir_text'], $row['diperbaharui_oleh'], $row['diperbaharui_tanggal']);
		endforeach;

		$data['html_table'] = $this->table->generate();
		$data['text_filter'] = $text_filter;
        $data['text_nama'] = "Ketua Majelis : ".$nama_hakim;
		$a['content']	= $this->load->view('simple_table', $data, true);
		$this->load->view('template', $a);
	}

	public function progress_pp_detail($id,$filter){

		$data = $this->perkara->get_progress_pp_detail($id,$filter);
		$nama_pp = $this->perkara->get_nama_pp($id);

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
        $data['text_nama'] = $nama_pp;
		$a['content']	= $this->load->view('simple_table', $data, true);
		$this->load->view('template', $a);
	}




	public function selesai_hakim_detail($id,$filter){

		$data = $this->perkara->get_selesai_hakim_detail($id,$filter);

		switch($filter) {
			case 'baik' :
				$text_filter = '- Diputus Kurang Dari 4 Bulan';
			break;
			case 'kurang' :
				$text_filter = '- Diputus 4 s.d 5 Bulan';
			break;
			case 'sangat' :
				$text_filter = '- Diputus 6 s.d 12 Bulan';
			break;
			default:
				$text_filter = '- Diputus Lebih Dari 12 Bulan';

		}


		$this->load->library('table');

		$tmpl = array ( 'table_open'  => '<table class="table table-striped table-hover">' );

		$this->table->set_template($tmpl);
		$this->table->set_heading('No.', 'Nomor Perkara', 'Pemohon/Penggugat','Tgl Daftar','Tgl Sidang I','Tanggal Putusan','Status Terakhir','Editor','Waktu Pelaksanaan');
		$i = 0;
		foreach ($data as $row ):
		$i++;
		$pihak = (strlen($row['pihak1_text']) > 35) ? substr($row['pihak1_text'], 0, 35) . '...' : $row['pihak1_text'];
			$this->table->add_row($i, $row['nomor_perkara'], $pihak, $row['tanggal_pendaftaran'], $row['sidang_pertama'], $row['tanggal_putusan'], $row['proses_terakhir_text'], $row['diperbaharui_oleh'], $row['diperbaharui_tanggal']);
		endforeach;

		$data['html_table'] = $this->table->generate();
		$data['text_filter'] = $text_filter;
		$a['content']	= $this->load->view('simple_table', $data, true);
		$this->load->view('template', $a);
	}






}
