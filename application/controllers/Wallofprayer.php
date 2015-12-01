<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Wallofprayer extends MY_Controller {

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
			$data['results'] = 10;
			$page = $this->input->get('page');
			$data['page'] =   $page ? $page : 1;
			
			$get_all_prayer = doCurl(API_BASE_LINK.
				'wallOfPrayer/get_all_prayer'.
				'?limit='.$data['results'].
				'&page='.$data['page']
				);

			if ($get_all_prayer && $get_all_prayer['http_status_code'] ==200) {
				$content = json_decode($get_all_prayer['output']);
				$status_code	 = $content->status_code;

				if ($status_code == 200) {
					$data['total']	 = $content->total;
					$data['get_all_prayer'] = $content->results;
				}
			}

//			var_dump($get_all_prayer);exit;
			$this->load->view('Wallofprayer/timeline_of_prayer_view',isset($data) ? $data : "");
		}
	}

	public function get_json_wallofprayer()
	{
		$data['results'] = 10;
		$page = $this->input->post('page');
		$data['page'] = $page ? $page : 1;
		
		$get_all_prayer = doCurl(API_BASE_LINK.
			'wallOfPrayer/get_all_prayer'.
			'?limit='.$data['results'].
			'&page='.$data['page']
			);			

		if ($get_all_prayer && $get_all_prayer['http_status_code'] ==200) {
			$content = json_decode($get_all_prayer['output']);
			$status_code	 = $content->status_code;
			
			if ($status_code == 200) {
				$data['get_all_prayer_json'] = $content->results;	
				echo json_encode($data);exit;
			}
		}else {
			echo json_encode('error!');exit;
		}
	}

	public function prayer()
	{
		if (!$this->session->userdata('access_token')) {
			
			redirect('login','refresh');
		}else {

			$data =  $this->tq_header_info();				
			$user_id = $this->session->userdata('user_id');
			//团契紧急祷告
			$find_urgent_prayer = doCurl(API_BASE_LINK.'home/find_urgent_prayer');
//			 var_dump($find_urgent_prayer);exit;
			if ($find_urgent_prayer && $find_urgent_prayer['http_status_code'] ==200) {
				$content = json_decode($find_urgent_prayer['output']);
				$status_code	 = $content->status_code;
				if ($status_code == 200) {
					$data['urgent_prayer'] = $content->results;	
					$urgent_prayer_id = $data['urgent_prayer']->id;
				}
			}

//			var_dump($urgent_prayer_id);exit;
			if (isset($urgent_prayer_id) && !empty($urgent_prayer_id)) {				
				$get_tq_prayer = doCurl(API_BASE_LINK.'wallOfPrayer/get_tq_content_prayer?tq_prayer_id='.$urgent_prayer_id.'&user_id='.$user_id);
//				 var_dump($get_tq_prayer);exit;
				if ($get_tq_prayer && $get_tq_prayer['http_status_code'] ==200) {
					$content = json_decode($get_tq_prayer['output']);
					$status_code	 = $content->status_code;
					if ($status_code == 200) {
						$data['content_prayer'] = $content->results;	
						$data['total'] = $content->total;	
						$data['is_send'] = $content->is_send;	
					}
				}
			}

			//小组祷告：
            $group_id = isset($data['user_info']->group_id) ? $data['user_info']->group_id : "" ;
//			var_dump($group_id);exit;
			$get_today_group_prayer = doCurl(API_BASE_LINK.'group/get_today_group_prayer?group_id='."$group_id");    
//			 var_dump($get_today_group_prayer);exit;
			if ( $get_today_group_prayer && $get_today_group_prayer['http_status_code'] ==200 ) {
			    $content  =  json_decode($get_today_group_prayer['output']);
			    $status_code = $content->status_code;

			    if ($status_code == 200) {
			        $data['today_group_prayer'] = $content->results;
			        $group_prayer_id = isset($data['today_group_prayer']->id) ? $data['today_group_prayer']->id : "" ;
			    }
			    
			} else {
			    show_404();exit();
			} 
//			var_dump($group_prayer_id);exit;
			if (isset($group_prayer_id) && !empty($group_prayer_id)) {				
				$get_group_prayer = doCurl(API_BASE_LINK.'wallOfPrayer/get_group_prayer?group_prayer_id='.$group_prayer_id.'&user_id='.$user_id);
//				 var_dump($get_group_prayer);exit;

				if ($get_group_prayer && $get_group_prayer['http_status_code'] ==200) {
					$content = json_decode($get_group_prayer['output']);
					$status_code	 = $content->status_code;
					if ($status_code == 200) {
						// var_dump($content);exit;
						$data['content_group_prayer'] = $content->results;	
						$data['group_prayer_total'] = $content->group_prayer_total;	
						$data['is_send_group_prayer'] = $content->is_send_group_prayer;	
					}
				}
			}

//			var_dump($data);exit;
			$this->load->view('Wallofprayer/Wallofprayer_view',isset($data) ? $data : "");
		}	
	}

	public function send_prayer()
	{
		if (!$this->session->userdata('access_token')) {
			
			redirect('login','refresh');
		}else {

			$data =  $this->tq_header_info();	
			$params['user_id'] = $this->session->userdata('user_id') ; 
			$params['content_prayer'] = $this->input->post('content_prayer');
			$params['urgent_prayer_id']   = $this->input->post('urgent_prayer_id');

			$url = API_BASE_LINK.'wallOfPrayer/send_prayer';
			$result = doCurl($url, $params, 'POST');

			// var_dump($result);exit;
			if ($result && $result['http_status_code'] ==200) {
				$content = json_decode($result['output']);
				$status_code	 = $content->status_code;
				$is_send  = null;

				if ($status_code == 200) {
					$is_send = $content->results;

					if (! empty($is_send) && $is_send >=1 ) {

						$this->session->set_flashdata('success', '阿们！你的祷告内容已提交！');
					}else {

						$this->session->set_flashdata('error', '阿们！你的祷告内容提交失败！');

					}

				}				

				redirect('Wallofprayer/prayer','refresh') ;


			}else{

				show_404();exit();
			}

		}
	}

	public function del_payer()
	{
		if (!$this->session->userdata('access_token')) {
			
			redirect('login','refresh');
		}else {

			$data =  $this->tq_header_info();				
			$urgent_id = $this->input->get('urgent_id');
			$del_by = $this->input->get('del_by');
			$user_id = $this->session->userdata('user_id');
			// var_dump($del_by);exit;
			$del_payer = doCurl(API_BASE_LINK.'wallOfPrayer/del_payer?urgent_id='.$urgent_id.'&user_id='.$user_id.'&del_by='.$del_by);
			// echo API_BASE_LINK.'wallOfPrayer/del_payer?urgent_id='.$urgent_id.'&user_id='.$user_id;exit;
			// var_dump($del_payer);exit;
			if ($del_payer && $del_payer['http_status_code'] ==200) {
				$content = json_decode($del_payer['output']);
				$status_code	 = $content->status_code;
				if ($status_code == 200) {
					$this->session->set_flashdata('success', '阿们！祷告内容已删除！');
				}else {
					$this->session->set_flashdata('error', '阿们！你的祷告删除失败，请重试！');
				}
				
				redirect('Wallofprayer/prayer','refresh') ;
			}else {
				show_404();exit;
			}

		}	
	}

	public function send_group_prayer()
	{
		if (!$this->session->userdata('access_token')) {
			
			redirect('login','refresh');
		}else {

			$data =  $this->tq_header_info();	
			$params['user_id'] = $this->session->userdata('user_id') ; 
			$params['group_prayer_contents'] = $this->input->post('group_prayer_contents');
			$params['group_prayer_id']   = $this->input->post('group_prayer_id') ;

			$url = API_BASE_LINK.'wallOfPrayer/send_group_prayer';
			$result = doCurl($url, $params, 'POST');
			// var_dump($result);exit;

			// var_dump($result);exit;
			if ($result && $result['http_status_code'] ==200) {
				$content = json_decode($result['output']);
				$status_code	 = $content->status_code;
				$is_send  = null;

				if ($status_code == 200) {
					$is_send = $content->results;

					if (! empty($is_send) && $is_send >=1 ) {

						$this->session->set_flashdata('success', '阿们！你的小组祷告内容已提交！');
					}else {

						$this->session->set_flashdata('error', '阿们！你的小组祷告内容提交失败！');

					}

				}				

				redirect('Wallofprayer/prayer','refresh') ;


			}else{

				show_404();exit();
			}

		}
	}

	public function del_group_payer()
	{
		if (!$this->session->userdata('access_token')) {
			
			redirect('login','refresh');
		}else {

			$data =  $this->tq_header_info();				
			$prayer_for_group_id = $this->input->get('prayer_for_group_id');
			$del_by = $this->input->get('del_by');

			$user_id = $this->session->userdata('user_id');
			$del_payer = doCurl(API_BASE_LINK.'wallOfPrayer/del_group_payer?prayer_for_group_id='.$prayer_for_group_id.'&user_id='.$user_id.'&del_by='.$del_by);
			// echo API_BASE_LINK.'wallOfPrayer/del_group_payer?prayer_for_group_id='.$prayer_for_group_id.'&user_id='.$user_id.'&del_by='.$del_by;exit;
			// var_dump($del_payer);exit;
			if ($del_payer && $del_payer['http_status_code'] ==200) {
				$content = json_decode($del_payer['output']);
				$status_code	 = $content->status_code;
				if ($status_code == 200) {
					$this->session->set_flashdata('success', '阿们！祷告内容已删除！');
				}else {
					$this->session->set_flashdata('error', '阿们！你的祷告删除失败，请重试！');
				}
				
				redirect('Wallofprayer/prayer','refresh') ;
			}else {
				show_404();exit;
			}

		}		
	}
}
