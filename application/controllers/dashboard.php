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
		$data['delegasi_keluar'] = $this->dashboard->fetch_upcoming_delegasi_keluar();
		$data['delegasi_masuk'] = $this->dashboard->fetch_upcoming_delegasi_masuk();
		$a['content']	= $this->load->view('v_dashboard', $data, true);	
		$this->load->view('template', $a);	
	}
	
	
	
	
	
	
	
	
}
