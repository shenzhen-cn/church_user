<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Login extends MY_Controller {

    public function __construct() {
        parent::__construct();
    }

	public function index() {	

		if ($this->session->userdata('access_token')) {
			
            $this->session->unset_userdata('access_token');
			redirect('login','refresh');
		}else{

			$user_name_email  = trim($this->input->post('user_name'));
			$password         = $this->input->post('password');
			$checkcode1		  = strtolower(trim($this->input->post('checkcode')));
			$checkcode        = md5($checkcode1);
			$cookie_checkcode = $this->input->cookie("checkpic");
			

			if (!empty($checkcode1) && ($checkcode != $cookie_checkcode)) {
				$temp_checkcode = $this->input->post('checkcode');
				if(!empty($temp_checkcode)){
					$data['error'] = '验证码输入错误！';
				}

				$this->load->view('login_view',isset($data) ? $data : "");

		    } else{
					if (! empty($user_name_email)) {
						$result = doCurl(API_BASE_LINK.'login/login_email/find?user_name_email='.$user_name_email.'&password='.$password);
					}

//					 var_dump($result);exit;
				    if (isset($result) && $result['http_status_code'] == 400)
					{
					    $result = json_decode($result['output']);
					    $status_code = $result->status_code;
					    $message     = $result->message;
					    if ($status_code == 400) {
							$data['error'] = $message;
					    }
					    else if ($status_code == 401) {

							$data['error'] = $message;					    	
					    }
					    else if ($status_code == 402) {
							$data['error'] = $message;					    						    	
					    	
					    }
					
					   

					}else if (isset($result) && $result['http_status_code'] == 200) {

						$result = json_decode($result['output']);

					    $status_code = $result->status_code;
					    $content = $result->results;

					    $user_id = $result->results->account_id;
					    $token   = $result->results->access_token;

		                $this->session->set_userdata('access_token', $token);
		                $this->session->set_userdata('user_id', $user_id);
		                redirect('home','refresh');

					}

				$this->load->view('login_view',isset($data) ? $data : "");						    	

		    }
		}
	}	

}
