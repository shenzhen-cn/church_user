<?php (defined('BASEPATH')) OR exit('No direct script access allowed');


class MY_Controller extends CI_Controller
{	
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->helper('util');
		date_default_timezone_set('Asia/Shanghai');
	}

	public function tq_header_info()
	{
		if (!$this->session->userdata('access_token')) {
			
			redirect('login','refresh');

		}else {

			$user_id = $this->session->userdata('user_id');
			if ($user_id) {
				
				//用户基本信息
				$result = doCurl(API_BASE_LINK.'tq_header_info/find?user_id='.$user_id);				
//				 var_dump($result);exit;
				if (isset($result) && $result['http_status_code'] == 200)
				{
				    $result = json_decode($result['output']);
				    $content = $result->results;
//					var_dump($content);exit;
				    $data['user_info']      	= 	$content->user_info;
				    $data['group_info']     	= 	$content->group_info;
				    // var_dump($data['group_info']);exit;
				    $data['userHeadSrc_info']   = 	$content->userHead_src;
				    $data['clas_p_p']     	    = 	$content->clas_p_p;
					$data['user_id'] 			=   $this->session->userdata('user_id');		    
				}    	

				//灵修提示
	    		$results = doCurl(API_BASE_LINK.'home/reminder_spirituality_by_id?user_id='.$user_id);
	    		// var_dump($results);exit;
				if ($results && $results['http_status_code'] == 200 ) {
					$content = json_decode($results['output']);				
					$data['reminder_days'] = $content->results;
				}

				
				//提示消息
	    		$results = doCurl(API_BASE_LINK.'tq_header_info/get_tip_messages?user_id='.$user_id);
	    		// echo API_BASE_LINK.'tq_header_info/get_tip_messages?user_id='.$user_id;exit;	
	    		// var_dump($results);exit;
	    		// var_dump($results);exit;	
				if ($results && $results['http_status_code'] == 200 ) {
					$content = json_decode($results['output']);				
					// var_dump($content);exit;
					$results = $content->results;
					
					$data['data_return_of_content_priest_preach'] 					= $results->data_return_of_content_priest_preach;
					$data['count_content_priest_preach_messages'] 					= $results->count_content_priest_preach_messages;
					$data['is_readed_count_c_p_p_id']             					= $results->is_readed_count_c_p_p_id;

					$data['data_return_of_user_album_src']       					= $results->data_return_of_user_album_src;
					$data['count_user_album_src_messages']        					= $results->count_user_album_src_messages;					
					$data['is_readed_count_user_album_src']       					= $results->is_readed_count_user_album_src;					
					$data['data_return_of_notice_groups']         					= $results->data_return_of_notice_groups;
					$data['count_notice_groups_messages']         					= $results->count_notice_groups_messages;
					$data['is_readed_count_notice_groups']        					= $results->is_readed_count_notice_groups;
					//点赞通知
					$data['data_return_of_praise_of_spirituality'] 					= $results->data_return_of_praise_of_spirituality; 
					$data['count_praise_of_spirituality_messages'] 					= $results->count_praise_of_spirituality_messages; 
					$data['is_readed_count_praise_of_spirituality']  				= $results->is_readed_count_praise_of_spirituality; 
					//灵修评论
					$data['data_return_of_comments_of_spirituality']  				= $results->data_return_of_comments_of_spirituality; 
					$data['count_praise_of_comments_of_spirituality_messages']  	= $results->count_praise_of_comments_of_spirituality_messages; 
					//回复灵修评论
					$data['data_return_of_replies_of_spirituality']                 = $results->data_return_of_replies_of_spirituality; 
					$data['count_praise_of_replies_of_spirituality_messages']       = $results->count_praise_of_replies_of_spirituality_messages; 

				}
			    return $data;
			}else{
				redirect('login','refresh');
			}

		}
	}


	public function remove_alert_by_user_id($user_id,$table_name)
	{
		if (!empty($user_id) && !empty($table_name)) {

			$results = doCurl(API_BASE_LINK.'tq_header_info/remove_alert_by_user_id?user_id='.$user_id.'&table_name='.$table_name);
		}
	}

	// public function del_all_alert_by_user_id($user_id)
	// {
	// 	if (!empty($user_id)) {
	// 		$alert_count = null;
	// 		$results = doCurl(API_BASE_LINK.'tq_header_info/del_all_alert_by_user_id?user_id='.$user_id);

	// 		if ($results && $results['http_status_code'] == 200 ) {
	// 			$content = json_decode($results['output']);				

	// 			$alert_count = $content->results;
	// 		}
	// 		return $alert_count;
	// 	}
	// }
	
}
