<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Resetpassword extends MY_Controller {

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
			$params['currentPwd'] = $this->input->post('currentPwd');
			$params['confirmNewPwd'] = $this->input->post('confirmNewPwd');
			$params['user_id'] = $this->session->userdata('user_id');
			$tmp_post = $this->input->post();
			if (empty($tmp_post)) {
				
				$this->load->view('resetPassword_view',isset($data) ? $data : "");
			}else{
				$result = $this->alterPassword($params);
				if ($result && $result['http_status_code'] == 200) {
					$content = json_decode($result['output']); 
					$is_reset = $content->results;				

					if (! isset($is_reset) && $is_reset<=0  ) {
						$data['error'] = '错误！';	
						redirect('resetpassword','refresh');
					}else{
						
				        $this->session->unset_userdata('access_token',isset($data) ? $data : "");
						$this->session->set_flashdata('success', '密码重置成功，请重新登录！');

						redirect(site_url('login'),'refresh');
					}
				}else{
					show_404();exit;
				}

			}

		 } 	

	}

	public function forgetpassword() {

		$params['user_email']  	=  $this->input->post('f_user_email');
		$checkcode_f = $this->input->post('checkcode_f');
		$checkcode1		  		=  strtolower(trim($checkcode_f));
		$checkcode        		=  md5($checkcode1);
		$cookie_checkcode 		=  $this->input->cookie("checkpic");

		if (!empty($checkcode1) && ($checkcode != $cookie_checkcode)) {
			$temp_checkcode_f = $this->input->post('checkcode_f');
			if(!empty($temp_checkcode_f)){

				$data['error'] = '验证码输入错误！';
			}

			$this->load->view('forget_password_view',isset($data) ? $data: "" );

	    }else{

			if (!empty($params['user_email'])) {

				$result = $this->alterPassword($params);
//				var_dump($result);exit;
				if ($result && $result['http_status_code'] == 200) {
					$content = json_decode($result['output']); 
					$status_code = $content->status_code;

					if ($status_code && $status_code == 200) {
						$message = $content->message;
						$data['success'] = $message;							
					} else{
						$message = $content->message;
						$data['error'] = $message;							
					}
				}				
				  			    		
			}

			$this->load->view('forget_password_view',isset($data) ? $data : "" );    	
	    }

	}

	public function alterPassword($params='')
	{
		if (! empty($params)) {
			$url = API_BASE_LINK.'register/resetpassword';
			$result = doCurl($url, $params, 'POST');
//			var_dump($result);exit;
			
			return $result;
		}else{
			return false;
		}	

	}

	public function checkCurrentPwd()
	{
		if (!$this->session->userdata('access_token')) {
			redirect('login','refresh');
		}else {
			$params['currentPwd']  = $this->input->post('currentPwd');
			$params['user_id']     = $this->session->userdata('user_id');
			$url = API_BASE_LINK.'resetpassword/checkCurrentPwd';
			$result = doCurl($url, $params, 'POST');
			if ($result && $result['http_status_code'] == 200) {
				$content = json_decode($result['output']); 
				$is_bool = $content->results;
				echo json_encode($is_bool);				
			}else{
				show_404();exit;
			}			
		}	
	}
}
