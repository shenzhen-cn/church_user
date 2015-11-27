<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Fellowship_life extends MY_Controller {

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
		    $count_user_album_src_messages = isset($data['count_user_album_src_messages']) ? $data['count_user_album_src_messages'] : "";

		    $data['results'] = 20;
		    $data['page'] = $this->input->get('page') ? $this->input->get('page') : 1;

		    if (!empty($count_user_album_src_messages)) {
		    	$user_id = $this->session->userdata('user_id');
		    	$table_name = 'user_album_src';
		    	$this->remove_alert_by_user_id($user_id,$table_name);
		    }

		    $prev_day = $this->input->get('date') ? $this->input->get('date') : "";

		    $result = doCurl(
		    		API_BASE_LINK.
		    		'fellowship_life/get_today_user_photos?limit='.$data['results'].
		    		'&'.'page='.$data['page']
				    	);		 

			if ($result && $result['http_status_code'] == 200) {

				$content = json_decode($result['output']);
				$status_code = $content->status_code;

				if ($status_code == 200) {					

		 			$data['total'] = $content->total;
	 				$data['user_photos_results'] = $content->results;
	 				$uri = 'fellowship_life';	
					$data['pagination'] = pagination($content->total, $data['page'], $content->results, $uri);

				}	
			}else {
				show_404();exit;
			}
			
			$this->load->view('fellowship_life/fellowship_life_view' , isset($data) ? $data : "" );
		}

	}

	public function load_images()
	{
		$data['results'] = 10;
	    $data['page'] = $this->input->post('page') ? $this->input->post('page') : 1;

	    if(!empty($data['page'])){	    
	    	$user_id = $this->session->userdata('user_id');
	    	$table_name = 'user_album_src';
	    	$this->remove_alert_by_user_id($user_id,$table_name);

		    $result = doCurl(
		    		API_BASE_LINK.
		    		'fellowship_life/get_today_user_photos?limit='.$data['results'].
		    		'&'.'page='.$data['page']
				    	);		 
			if ($result && $result['http_status_code'] == 200) {

				$content = json_decode($result['output']);
				$status_code = $content->status_code;

				if ($status_code == 200) {					

		 			$data['total'] = $content->total;
	 				$data['user_photos_results'] = $content->results;
	 				$uri = 'fellowship_life';	
					$data['pagination'] = pagination($content->total, $data['page'], $content->results, $uri);

					echo json_encode($data);
				}	
			}else {
				 echo json_encode('error!');
			}
	    }	
	}

	public function album()
	{	
		if (!$this->session->userdata('access_token')) {

		    redirect('login','refresh');		    
		}else { 
		    $data =  $this->tq_header_info();
		    $result = doCurl(API_BASE_LINK.'fellowship_life/get_photos_count');

		    if ($result && $result['http_status_code'] == 200) {

		    	$content = json_decode($result['output']);
		    	$status_code = $content->status_code;

		    	if ($status_code == 200) {					
		    		$data['group_albums_counts'] = $content->results;														
		    	}	
		    }else {
		    	show_404();exit;
		    }

			$this->load->view('fellowship_life/fs_album_view',isset($data) ? $data : ""  );	
		}
	}

	public function group_albums()
	{
		if (!$this->session->userdata('access_token')) {

		    redirect('login','refresh');		    
		}else { 
		    $data =  $this->tq_header_info();

		    $group_id  = $this->input->get('group_id') ? $this->input->get('group_id') : "" ;
		    $data['group_id']  = $group_id; 
		    $result = doCurl(API_BASE_LINK.'fellowship_life/group_albums?group_id='.$group_id);

		    if ($result && $result['http_status_code'] == 200) {

		    	$content = json_decode($result['output']);
		    	$status_code = $content->status_code;

		    	if ($status_code == 200) {					
		    		// var_dump($content);exit;
		    		$data['album_results'] = $content->results;														
		    	}	
		    }else {
		    	show_404();exit;
		    }

			$this->load->view('fellowship_life/fs_group_albums_view',isset($data) ? $data : ""  );	
		}
	}

	public function upload_photos()
	{
		if (!$this->session->userdata('access_token')) {

		    redirect('login','refresh');		    
		}else { 
		    $data =  $this->tq_header_info();
		    $user_id = $this->session->userdata('user_id');
			$result = doCurl(API_BASE_LINK.'fellowship_life/get_user_album_name?user_id='.$user_id);

			if ($result && $result['http_status_code'] == 200) {

				$content = json_decode($result['output']);
				$status_code = $content->status_code;

				if ($status_code == 200) {					
					$data['album_names'] = $content->results;														
				}	
			}else {
				show_404();exit;
			}			
		    
			$this->load->view('fellowship_life/fs_upload_photos_view',isset($data) ? $data : ""  );	
		}
	}

	public function create_album()
	{
		if (!$this->session->userdata('access_token')) {

		    redirect('login','refresh');		    
		}else { 
		    $data =  $this->tq_header_info();
		    
		    $params['user_id']     = $this->session->userdata('user_id');
		    $params['group_id']    = $this->input->post('group_id') ? $this->input->post('group_id') : "" ;
		    $params['album_name']  = $this->input->post('album') ? $this->input->post('album') : "" ;

		    // var_dump($params);exit;
			$url = API_BASE_LINK.'fellowship_life/create_album';
			// echo $url;exit;
			// var_dump($url);exit;
			$result = doCurl($url, $params, 'POST');

			// var_dump($result); exit;

			if ($result && $result['http_status_code'] == 200) {

				$content = json_decode($result['output']);
				$status_code = $content->status_code;

				if ($status_code == 200) {
					// $data['success'] = $content->message;	
					$this->session->set_flashdata('success', $content->message);									
				}else {
					// $data['error'] = $content->message;
					$this->session->set_flashdata('error', $content->message);									
				}

				redirect('upload_photos','refresh');

			}else {
				show_404();exit;
			}			
		}
	}

	public function photos_upload()
	{
		if (!$this->session->userdata('access_token')) {

		    redirect('login','refresh');		    
		}else { 
		    
			if (empty($_FILES['images'])) {
			    echo json_encode(['error'=>'没有选择可以上传的照片']); 
			    return; // terminate
			}
			
			// get the files posted
			$images    = $_FILES['images'];	
			$user_id   = $this->session->userdata('user_id');
			$album_id  = empty($_POST['album_id']) ? '' : $_POST['album_id'];
			$group_id  = empty($_POST['group_id']) ? '' : $_POST['group_id'];
			 
			$success = null;

			$paths= [];			 
			$filenames = $images['name'];
			 
			if (empty($album_id) || $album_id <= 0 ) {
				
				echo json_encode(['error'=>'还没有选择你的相册呦！']); 
				return; 
			}else {

				for($i=0; $i < count($filenames); $i++){
				    $ext = explode('.', basename($filenames[$i]));
				    $target = "public" . DIRECTORY_SEPARATOR ."uploads" . DIRECTORY_SEPARATOR ."albums".DIRECTORY_SEPARATOR. md5(uniqid()) . "." . array_pop($ext);

				    if(move_uploaded_file($images['tmp_name'][$i], $target)) {
				        $success = true;
				        $paths[] = $target;
				    } else {
				        $success = false;
				        break;
				    }
				}
		
				// $paths = array('0' =>'uploads\albums\f2dcb9e0fdc2f30f7d85bd9a919656ec.jpg' ,
				// 				'1' =>'uploads\albums\f8fcc0292bd25862de78287f87d7a5a9.jpg' ,
				// 				'2' =>'uploads\albums\fde063bd505f1fd42fb65f5b02e68509.jpg' ,
				// 				'3' =>'uploads\albums\ff90c11f5ed1ec920b6eb5ee4a5246a7.jpg' ,							 
				// 		);

				// $paths_array = implode(',',$paths);	

				// $results =  $this->save_data($user_id, $album_id, $paths_array);

				// echo json_encode(array('error'=>$user_id));exit;
				// check and process based on successful status 
				if ($success === true) {

					$paths_array = implode(',',$paths);	

				    $this->save_data($user_id, $album_id, $paths_array);
				    // var_dump($temp);exit;


				    // echo json_encode(['error' => $results]);exit();
				     $output = array('upload' => 'OK' );
				    // echo json_encode(['error' => $paths]);exit();
				} else if ($success === false) {

				    $output = ['error'=>'Error while uploading images. Contact the system administrator'];
				    // delete any uploaded files
				    foreach ($paths as $file) {
				        unlink($file);
				    }

				    // $output = array('error' => '' );
				} 
				
				// // return a json encoded response for plugin to process successfully
				echo json_encode($output);
				exit();
			}
		}
	}

	

	public function save_data($user_id, $album_id, $paths)
	{
		if (!empty($user_id) && !empty($album_id) &&!empty($paths)) {
				    
		    $params['album_id']    = $album_id;
		    $params['paths']       = $paths;
		    $params['user_id']     = $user_id;
			$url = API_BASE_LINK.'fellowship_life/save_data';

			$result = doCurl($url, $params, 'POST');
			if ($result && $result['http_status_code'] == 200) {
				$content = json_decode($result['output']);
				$is_upload = $content->results;
				return $is_upload;

			}else {
				show_404();exit;
			}

		}else {
			return false;
		}
	}

	public function see_user_albums()
	{
		if (!$this->session->userdata('access_token')) {

		    redirect('login','refresh');		    
		}else { 

		    $data     =  $this->tq_header_info();			
			// $user_id  =  $this->input->get('create_by') ? $this->input->get('create_by') : "";
			$user_id  =  $this->session->userdata('user_id');

			$data['group_id'] =  $this->input->get('group_id') ? $this->input->get('group_id') : "";

			$result = doCurl(API_BASE_LINK.'fellowship_life/see_user_albums?user_id='.$user_id);
			// echo API_BASE_LINK.'fellowship_life/see_user_albums?user_id='.$user_id;exit;
			// var_dump($result);exit;

			if ($result && $result['http_status_code'] == 200) {

				$content = json_decode($result['output']);
				$status_code = $content->status_code;

				if ($status_code == 200) {					
					// var_dump($content);exit;
					$data['user_album_names'] = $content->results;														
				}	
			}else {
				show_404();exit;
			}	

			$this->load->view('fellowship_life/see_user_albums_view',isset($data) ? $data : ""  );	

		}		
	}

	public function see_user_photos()
	{
		if (!$this->session->userdata('access_token')) {

		    redirect('login','refresh');		    
		}else { 

		    $data      =  $this->tq_header_info();			
			$album_id  =  $this->input->get('album_id') ? $this->input->get('album_id') : "";
			$user_id   =  $this->input->get('create_by') ? $this->input->get('create_by') : "";
			$data['results'] = 10;
			$data['page'] = $this->input->get('page') ? $this->input->get('page') : 1;

			$result = doCurl(API_BASE_LINK.
				'fellowship_life/see_user_photos?album_id='.$album_id.
				'&user_id='.$user_id.
				'&limit='.$data['results'].	
				'&page='.$data['page']
				);

			if ($result && $result['http_status_code'] == 200) {

				$content = json_decode($result['output']);
				$status_code = $content->status_code;

				if ($status_code == 200) {					
					$data['total'] = $content->total;
					// var_dump($data['total']);exit;
					$data['user_album_photos'] = $content->results->results;	
					// var_dump($data['user_album_photos']);exit;
					$data['use_nick_Hsrc']     = $content->results->use_nick_Hsrc;	
	 				$uri = '';	
					$data['pagination'] = pagination($content->total, $data['page'], $content->results->results, $uri);
				}	
			}else {
				show_404();exit;
			}	

			$this->load->view('fellowship_life/see_user_photos_view',isset($data) ? $data : ""  );	

		}			
	}

	public function del_photos()
	{
		if (!$this->session->userdata('access_token')) {

			    redirect('login','refresh');		    
		}else { 

		    $src_id  = $this->input->post('src_id') ? $this->input->post('src_id') : "" ;		    
		    $user_id = $this->session->userdata('user_id');
		    $paths_src  = $this->input->post('paths_src') ? $this->input->post('paths_src') : "" ;		    

			$result = doCurl(API_BASE_LINK.'fellowship_life/del_photos?src_id='.$src_id.'&user_id='.$user_id);
			$obj = array();
			
		    if ($result && $result['http_status_code'] == 200) {
				$content = json_decode($result['output']);
				$status_code = $content->status_code;

				if ($status_code == 200) {

					if(!empty($paths_src)){
						if(file_exists($paths_src)){					
							!unlink($paths_src);
						}				 
					}

					$obj['status'] = '200';
				}else{
					$obj['status'] = '400';					
					$obj['message'] = '异常错误！';					
				}

			}else {
				echo json_encode('error!');
				exit;
			}	
			echo json_encode($obj);exit;
		}	
	}

	public function rename_album_name()
	{
		if (!$this->session->userdata('access_token')) {

			    redirect('login','refresh');		    
		}else { 
			$album_name = $this->input->post('album_name');
			$album_id = $this->input->post('album_id');

			$result = doCurl(API_BASE_LINK.'fellowship_life/rename_album_name?album_id='.$album_id.'&album_name='.$album_name);
			
		    if ($result && $result['http_status_code'] == 200) {

				$content = json_decode($result['output']);
				$status_code = $content->status_code;
				if ($status_code == 200) {														
					echo $album_name;					
				}
			}else {
				show_404();exit;
			}						
		}
	}
}
