<?php

class MY_Controllers extends CI_Controller {
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

?>
