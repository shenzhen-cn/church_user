<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Personal extends MY_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->helpers('uploadFiles');

    }

	public function index()
	{
		if (!$this->session->userdata('access_token')) {
			
			redirect('login','refresh');
		}else {

			$data =  $this->tq_header_info();
			$user_id         = $this->session->userdata('user_id');
			$spirituality_id = $this->input->get('spirituality_id');		
			$result = doCurl(API_BASE_LINK.'personal/get_informations?user_id='.$user_id.'&spirituality_id='.$spirituality_id);
			if ($result && $result['http_status_code'] == 200) {
				$content     = json_decode($result['output']);
				$status_code = $content->status_code;
				// $results     = $content->results;
				if($status_code == 200){
					$data['informations'] = $content->results;				
				}	
			}else{
				show_404();exit;
			}
			
			$this->load->view('personal/personal_view' , isset($data) ? $data : "");
		}
	}

	public function setPersonalData()
	{	
		if (!$this->session->userdata('access_token')) {
			
			redirect('login','refresh');
		}else {

			$data =  $this->tq_header_info();

			$this->load->view('personal/setPersonalData_view' , isset($data) ? $data : "");
		}	

	}

	public function upload_photo()
	{
		if (!$this->session->userdata('access_token')) {
			
			redirect('login','refresh');
		}else {

			$data =  $this->tq_header_info();
			$userHeadSrc = $this->input->post('userHeadSrc') ;
			if ( !empty($userHeadSrc) &&  $userHeadSrc == $data['userHeadSrc_info'] ) {
				$params['userHeadSrc'] = $userHeadSrc; 
			}else {
				$fileInfo = $_FILES['uploadphoto'];
				$uploadPath = "public/uploads/userHeadsrc";
				$msg_return = uploadFiles($fileInfo,$uploadPath);
				var_dump($msg_return);exit;
				if (isset($msg_return['msg']) ) {
					$this->session->set_flashdata('error', $msg_return['msg']);
					redirect('setPersonalData','refresh');	
				}else{
					$params['userHeadSrc']	= $msg_return['newName'];
				}	
				if(!empty($data['userHeadSrc_info'])){
					$file = '/var/www/html/church/church_user/public/uploads/userHeadsrc/'.$data['userHeadSrc_info'];
					if(file_exists($file)){					
						!unlink($file);
					}				 
				}
			}

			$params['user_nick'] 	= $this->input->post('user_nick');
			$params['sex'] 			= $this->input->post('sex');
			$params['group_id'] 	= $this->input->post('group_id');
			$params['user_id'] 		= $this->session->userdata('user_id');
//			 var_dump($params);exit;
			$url = API_BASE_LINK.'personal/upload_photo';
			$result = doCurl($url, $params, 'POST');			
//			 var_dump($result);exit();

			if ($result && $result['http_status_code'] == 200) {

					$result = json_decode($result['output']);
					$content = $result->results;
					if ($content) {

						$affected_id 			= 	$content->affected_id;
						$userHead_src_id 	= 	$content->userHead_src_id;

						if (isset($affected_id) && $userHead_src_id) {
							$data['success'] =  '资料修改成功！';
						}

					}else{

						$this->session->set_flashdata('error', '资料修改失败！');
					}
						$data =  $this->tq_header_info();	
						$this->load->view('personal/setPersonalData_view' , isset($data) ? $data : "");


			} else {
				show_404();exit;
			}  

			
		}	

		
	}
}

		