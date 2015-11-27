<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Priest_preach extends MY_Controller {

	 /**
     * Constructor function
     */
    public function __construct() {
        parent::__construct();
        $this->load->helper('pagination');
    }

	public function index() {

		if (!$this->session->userdata('access_token')) {

	 		redirect('login','refresh');
	 	}else {

	 		$data =  $this->tq_header_info();	
	 		$id  =  $this->input->get('id') ? $this->input->get('id') : "";
	 		$data['results'] = $this->input->get('results') ? $this->input->get('results') : 10;
	 		$data['page'] = $this->input->get('page') ? $this->input->get('page') : 1;		

	 		if (!empty($id)) {

		 		$results = doCurl(API_BASE_LINK.
		 			'priest_preach/get_priest_preach_by_id?id='.$id.
		 			'&'.'limit='.$data['results'].
		 			'&'.'page='.$data['page']);
		 		if ($results && $results['http_status_code'] ==200) {
		 			$content = json_decode($results['output']);
		 			$status_code = $content->status_code;

		 			if ($status_code == 200) {

			 			$data['total'] = $content->total;
		 				$data['content'] = $content->results;
		 				$uri = 'priest_preach';	
						$data['pagination'] = pagination($content->total, $data['page'], $content->results, $uri);
		 			}
		 					
		 		}else {
		 			show_404();exit();
		 		}	
	 			
	 		}else{
	 			show_404();exit;
	 		}

	 		$this->load->view('priest_preach/priest_preach_view' ,isset($data) ? $data : "" );
	 	}	

	}

	public function pp_read($value='')
	{
		$this->load->view('priest_preach/pp_read_view');	
	}
	

    public function read_myEdit()
    {
    	if (!$this->session->userdata('access_token')) {

    		redirect('login','refresh');
    	}else {

	 		$data =  $this->tq_header_info();	
    		$document_id = $this->input->get('document_id') ? $this->input->get('document_id') : '' ;
    		// var_dump($document_id);exit;	
    		$results = doCurl(API_BASE_LINK.'priest_preach/read_myEdit_by_id?document_id='.$document_id);
    		// var_dump($results);exit;	
			if ($results && $results['http_status_code'] == 200 ) {
				$content = json_decode($results['output']);
				// var_dump($content);exit;
				$status_code = $content->status_code;

				if ($status_code == 200) {
					$data['results'] = $content->results->rows;
					$data['pre_id'] = $content->results->pre_id;
					$data['next_id'] = $content->results->next_id;
				}

			}else {
				show_404();exit;
			}
			
	 		$this->load->view('priest_preach/pp_read_view', isset($data) ? $data : "" );	

    	}
    }

   
}
