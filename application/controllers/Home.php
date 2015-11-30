<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Home extends MY_Controller {

//	echo 'sdfsdf';exit;
    public function __construct() {
        parent::__construct();

    }

	public function index() {

		if (!$this->session->userdata('access_token')) {
			
			redirect(site_url('login'),'refresh');
		}else {

			$data =  $this->tq_header_info();
			$group_id = $data['user_info']->group_id ? $data['user_info']->group_id : "";
			$find_home_inform = doCurl(API_BASE_LINK.'home/find_home_inform');
//			var_dump($find_home_inform);exit;

			if ($find_home_inform && $find_home_inform['http_status_code'] ==200) {
				$content = json_decode($find_home_inform['output']);
				$status_code	 = $content->status_code;
				if ($status_code == 200) {
					$data['home_inform'] = $content->results;
				}
			}

			//团契紧急祷告
			$find_urgent_prayer = doCurl(API_BASE_LINK.'home/find_urgent_prayer');
//			var_dump($find_urgent_prayer );exit;
			if ($find_urgent_prayer && $find_urgent_prayer['http_status_code'] ==200) {
				$content = json_decode($find_urgent_prayer['output']);
				$status_code	 = $content->status_code;
				if ($status_code == 200) {
					$data['urgent_prayer'] = $content->results;
				}
			}
			//小组祷告
			$get_today_group_prayer = doCurl(API_BASE_LINK.'group/get_today_group_prayer?group_id='."$group_id");    
//			 var_dump($get_today_group_prayer);exit;
			if ( $get_today_group_prayer && $get_today_group_prayer['http_status_code'] ==200 ) {
			    $content  =  json_decode($get_today_group_prayer['output']);
			    $status_code = $content->status_code;

			    if ($status_code == 200) {
			        $data['today_group_prayer'] = $content->results;
			    }
			    
			} else {
			    show_404();exit();
			} 
			
			$find_spirituality = doCurl(API_BASE_LINK.'home/find_spirituality?group_id='.$group_id);
//			var_dump($find_spirituality);exit;
			if ($find_spirituality && $find_spirituality['http_status_code'] ==200) {
				$content = json_decode($find_spirituality['output']);
				$status_code	 = $content->status_code;
				if ($status_code == 200) {
					$data['bible_section'] = $content->bible_section;	
					$data['bible_note'] = $content->bible_note;	
					$data['volume_name'] = $content->volume_name;	
					$data['current_chapter_id'] = $content->current_chapter_id;	
					$data['current_book_id'] = $content->current_book_id;	
				}
			}

			//组员灵修
			$current_chapter_id = isset($data['current_chapter_id']) ? $data['current_chapter_id'] : "" ; 
			$current_book_id = isset($data['current_book_id']) ? $data['current_book_id'] : "" ;
			$user_id = $this->session->userdata('user_id') ? $this->session->userdata('user_id') : "" ; 
			$data['user_id'] = $user_id;

			$find_user_spirituality = doCurl(API_BASE_LINK.'home/find_user_spirituality?group_id='.$group_id.'&user_id='.$user_id.'&chapter_id='.$current_chapter_id.'&book_id='.$current_book_id);			
//			 var_dump($find_user_spirituality);exit;
			if ($find_user_spirituality && $find_user_spirituality['http_status_code'] ==200) {
				$content = json_decode($find_user_spirituality['output']);

				$status_code	 = $content->status_code;
				$data['count_users_group']	  = $content->count_users_group;
				$data['status_spirituality']	 = $content->is_spirituality;
				// var_dump($data['count_users_group']);exit;

				if ($status_code == 200) {
					$data['user_spirituality'] = $content->results;							
				}
			}				
			
			//分享文章
			$document_id = $this->input->get('document_id') ? $this->input->get('document_id') : '' ;
    		$results = doCurl(API_BASE_LINK.'priest_preach/read_myEdit_by_id?document_id='.$document_id);
//			var_dump($results);exit;
			if ($results && $results['http_status_code'] == 200 ) {
				$content = json_decode($results['output']);
				$status_code = $content->status_code;

				if ($status_code == 200) {
					$data['online_read'] = $content->results->rows;
				}

			}else {
				show_404();exit;
			}

			//当日经文
    		$results = doCurl(API_BASE_LINK.'home/find_todayScriptures');
//			var_dump($results);exit;
			if ($results && $results['http_status_code'] == 200 ) {
				$content = json_decode($results['output']);
				// var_dump($content);exit;
				$status_code = $content->status_code;

				if ($status_code == 200) {
					$data['todayScriptures'] = $content->results;
				}

			}else {
				show_404();exit;
			}
			

			//团契生活
    		$results = doCurl(API_BASE_LINK.'home/recently_fellowship_photos');
//			var_dump($results);exit;
			if ($results && $results['http_status_code'] == 200 ) {
				$content = json_decode($results['output']);				
				$status_code = $content->status_code;

				if ($status_code == 200) {					
					$data['recently_photos'] = $content->results;
				}

			}else {
				show_404();exit;
			}
//		var_dump('dfgdfgd');exit;
			$this->load->view('home_view', isset($data) ? $data : "");
		}


	}

	public function send_spirituality()
	{
		$params['gold_sentence'] = $this->input->post('gold_sentence') ? $this->input->post('gold_sentence') : "" ;
		// var_dump($params);exit;
		$params['heart_feeling'] = $this->input->post('heart_feeling') ? $this->input->post('heart_feeling') : "" ;
		$params['response'] = $this->input->post('response') ? $this->input->post('response') : "" ;
		$params['current_chapter_id'] = $this->input->post('current_chapter_id') ? $this->input->post('current_chapter_id') : "" ;
		$params['current_book_id'] = $this->input->post('current_book_id') ? $this->input->post('current_book_id') : "" ;
		$params['user_id'] = $this->session->userdata('user_id') ? $this->session->userdata('user_id') : "" ; 
		$url = API_BASE_LINK.'home/send_spirituality';
		$result = doCurl($url, $params, 'POST');
		// var_dump($result);exit;
		if ($result && $result['http_status_code'] ==200) {
			$content = json_decode($result['output']);
			$status_code	 = $content->status_code;
			$is_send  = null;

			if ($status_code == 200) {
				$is_send = $content->results;

				if (! empty($is_send) && $is_send >=1 ) {

					$this->session->set_flashdata('success', '阿们！你的灵修已提交！');
				}

			}	
			redirect('home','refresh') ;

		}else{

			show_404();exit();
		}
	}

	// public function del_all_alert()
	// {
	// 	if (!$this->session->userdata('access_token')) {
			
	// 		redirect('login','refresh');
	// 	}else {
	// 		$user_id = $this->session->userdata('user_id');

	// 		$count = $this->del_all_alert_by_user_id($user_id);				
	// 		echo $count;
	// 	}
	// }	

	public function add_praise()
	{
		$spirituality_id = $this->input->post('spirituality_id');
		$user_id = $this->session->userdata('user_id');
		$results = doCurl(API_BASE_LINK.'home/add_praise?spirituality_id='.$spirituality_id.'&user_id='.$user_id);

		if ($results && $results['http_status_code'] ==200) {
			$content = json_decode($results['output']);
			$results = $content->results;
			echo $results;
		}
	}
}
