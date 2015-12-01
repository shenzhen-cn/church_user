<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tq_about extends MY_Controller {

    public function __construct() {
        parent::__construct();
    }

	public function index() {
		if (! $this->session->userdata('access_token')) {

			redirect(site_url('login'),'refresh');

		} else {						

			$data =  $this->tq_header_info();
			$this->load->view('tq_about_view' ,isset($data) ? $data : "");
			
		}

	}
}
