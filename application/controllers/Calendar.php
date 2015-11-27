<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Calendar extends MY_Controller {

	 /**
     * Constructor function
     */
    public function __construct() {
        parent::__construct();
    }

	public function index() {

		if (!$this->session->userdata('access_token')) {
			
			redirect('login','refresh');
		}else { 

			$data =  $this->tq_header_info();	

			$user_id = $this->session->userdata('user_id');
			
    		$results = doCurl(API_BASE_LINK.'calendar/get_all_events_for_json?user_id='.$user_id);
			// var_dump($results);exit;
		    if (isset($results) && $results['http_status_code'] == 200)
			{
			    $content           = json_decode($results['output']);
			    $results            = $content->results;

			    $data['user_create_at']     = $results->user_create_at; 
			    $data['spirituality']       = $results->spirituality;
			    $data['prayer_for_group']   = $results->prayer_for_group;
			    $data['prayer_for_urgent']  = $results->prayer_for_urgent;

			}

			$this->load->view('calendar/calendar_view', isset($data) ? $data : "");
		}

	}

}
