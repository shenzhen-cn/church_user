<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Group extends MY_Controller {
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
            $group_id =  $this->input->get('group_id');
            $data['user_id'] = $this->session->userdata('user_id');

            $result = doCurl(API_BASE_LINK.'group/find_group_by_group_id?group_id='."$group_id");
           // var_dump($result);exit;
            if ($result && $result['http_status_code'] == 200) {
                $content  =  json_decode($result['output']);
//                var_dump($content);exit;
                $status_code = $content->status_code;
                if ($status_code == 200) {
                    $data['results'] = $content->results;
                }
            }else {
                show_404();exit();
            }


            $user_results = doCurl(API_BASE_LINK.'group/find_all_users_by_group_id?group_id='."$group_id");
           // var_dump($user_results);exit;
            if ( $user_results && $user_results['http_status_code'] ==200 ) {
                $content  =  json_decode($user_results['output']);
                $status_code = $content->status_code;

                if ($status_code == 200) {
                    $data['group_users'] = $content->results;
                    $data['group_name'] = $content->group_name;
                    
                }
                
            } else {
                show_404();exit();
            }  


            $week_s_report = doCurl(API_BASE_LINK.'group/find_week_s_report?group_id='."$group_id");
            // echo 'week_s_report';
           // var_dump($week_s_report);exit;
            if ( $week_s_report && $week_s_report['http_status_code'] ==200 ) {
                $content  =  json_decode($week_s_report['output']);
                $status_code = $content->status_code;

                if ($status_code == 200) {
                    $data['week_s_report'] = $content->results;
                    $data['week_firstday'] = $content->week_firstday;
                    $data['week_lastday'] = $content->week_lastday;
                    
                }
                
            } else {
                show_404();exit();
            }  
          
          $this->load->view('group/group_view', isset($data) ? $data : "");
            
        }

  }

  public function spirituality(){

        if (!$this->session->userdata('access_token')) {

            redirect('login','refresh');
       
        }else {

           $data =  $this->tq_header_info();
           
           $params['testament'] = $this->input->get('testament');

           $params['book_id'] = $this->input->get('book_id');
           $params['chapter_id'] = $this->input->get('chapter_id');
           $temp_get = $this->input->get(); 
           if (!empty($temp_get)) {
               $url = API_BASE_LINK.'group/spirituality';
               $result = doCurl($url, $params, 'POST');
               if ($result && $result['http_status_code'] == 200 ) {
                   $content =json_decode($result['output']);
                   $status_code = $content->status_code;
                   if ($status_code == 200 ) {
                       $data['results'] = $content->results;                       
                   }else{
                        show_404();exit();
                   }
               }else{                
                    show_404();exit();
               }
           }
           $this->load->view('group/group_setting_spiri_view',isset($data) ? $data : "" );    
       }
    
  }

    public function setting_group_prayer(){

        if (!$this->session->userdata('access_token')) {

            redirect('login','refresh');
            
        }else {

            $data  =  $this->tq_header_info();
            $group_id = $data['user_info']->group_id;
            $group_id = isset($group_id) ? $group_id : "" ;
            $get_today_group_prayer = doCurl(API_BASE_LINK.'group/get_today_group_prayer?group_id='."$group_id");    
            if ( $get_today_group_prayer && $get_today_group_prayer['http_status_code'] ==200 ) {
                $content  =  json_decode($get_today_group_prayer['output']);
                $status_code = $content->status_code;

                if ($status_code == 200) {
                    $data['today_group_prayer'] = $content->results;
                }
                
            } else {
                show_404();exit();
            } 

            $temp_post = $this->input->post();
            if (! empty($temp_post) && ! empty($group_id) ) {
                $params['group_prayer_content'] = $this->input->post('group_prayer_content'); 
                $params['group_id']             = $group_id;

                $url = API_BASE_LINK.'group/setting_group_prayer';
                $result = doCurl($url, $params, 'POST');

               if ($result && $result['http_status_code'] == 200) {
                   $content = json_decode($result['output']);
                   $status_code = $content->status_code;
                   if ($status_code == 200) {           
                    $this->session->set_flashdata('success', '设置成功！');
                   }else{
                    $this->session->set_flashdata('error', '设置失败');
                    $data['error'] = '失败';
                   }

                   redirect('setting_group_prayer','refresh');
               }else{
                 show_404();exit;
               }
                
            }
            
            $this->load->view('group/setting_group_prayer_view',isset($data) ? $data : "" );    
        }
    }

    public function check_spirituality()
    {
        if (!$this->session->userdata('access_token')) {

          redirect('login','refresh');
            
        }else {


          $data =  $this->tq_header_info();
          $group_id = isset($data['user_info']->group_id) ?  $data['user_info']->group_id : ""; 
          $result = doCurl(API_BASE_LINK.'group/get_users_by_group_id?group_id='.$group_id);

          if ($result && $result['http_status_code'] == 200) {
              $content =json_decode($result['output']);
              $status_code = $content->status_code;

              if ($status_code == 200) {
                  $data['users_results'] = $content->results;
              }
            
          }else{

            show_404();exit();
          }

          $post_results = $this->input->post();
          if(!empty($post_results)){
            $params['starttime'] = $this->input->post('starttime');
            $params['endtime'] = $this->input->post('endtime');
            $params['users_id'] = $this->input->post('users_id');
            $params['check_class'] = $this->input->post('check_class');

            $url = API_BASE_LINK.'group/check_spirituality_or_prayer';
            $result = doCurl($url, $params, 'POST');

            if ($result && $result['http_status_code'] == 200) {
                $content = json_decode($result['output']);                
                $status_code = $content->status_code;
                if ($status_code == 200) {           
                  $data['check_results'] = $content->spirituality_results;  
                  $data['prayer_results'] = $content->prayer_results;                  
                }
            }else{
              show_404();exit;
            }
          }

          $this->load->view('group/group_check_spirituality_or_prayer_view',isset($data) ? $data : ""); 

        }
    }

    public function delete_spirituality()
    {
      if (!$this->session->userdata('access_token')) {

        redirect('login','refresh');

      }else{

        $spirituality_id = $this->input->get('s_id');
        $site = $this->input->get('site');
        $user_id         = $this->session->userdata('user_id');
        $result          = doCurl(API_BASE_LINK.'group/delete_spirituality?del_user_id='.$user_id.'&spirituality_id='.$spirituality_id);

        if ( $result && $result['http_status_code'] ==200 ) {
            $content  =  json_decode($result['output']);
            $status_code = $content->status_code;

            if ($status_code == 200) {
                $this->session->set_flashdata('success', '删除成功！');                
            }
            
        } else {
            show_404();exit();
        } 

        if ($site == 'personal') {
          
          redirect('personal','refresh');
        }else{
          redirect('home','refresh');

        }
      }
    }
    
    public function del_spirituality()
    {
       $spirituality_id = $this->input->post('spirituality_id');
       $user_id         = $this->session->userdata('user_id');
       $result          = doCurl(API_BASE_LINK.'group/delete_spirituality?del_user_id='.$user_id.'&spirituality_id='.$spirituality_id);      
       $obj  = array(); 

       if ( $result && $result['http_status_code'] ==200 ) {
           $content  =  json_decode($result['output']);
           $status_code = $content->status_code;

           if ($status_code == 200) {
               $obj['status'] = 200;                
           }else{
               $obj['status'] = 400;                
           }
           
       } else {
           echo json_encode('error');exit;
       }        
       echo  json_encode($obj);exit;

    }

    public function ranking()
    {
      if (!$this->session->userdata('access_token')) {

        redirect('login','refresh');

      }else{
          
        $data =  $this->tq_header_info();      
        $user_id = $this->session->userdata('user_id');

        $notice_groups_results = doCurl(API_BASE_LINK.'group/get_notice_groups_results?user_id='."$user_id");    

        if ( $notice_groups_results && $notice_groups_results['http_status_code'] ==200 ) {
            $content  =  json_decode($notice_groups_results['output']);
            $status_code = $content->status_code;

            if ($status_code == 200) {
                $data['notice_groups_results'] = $content->results;                
            }
            
        } else {
            show_404();exit();
        } 

        $rate_of_spirituality_results = doCurl(API_BASE_LINK.'group/get_rate_of_spirituality');    
        if ( $rate_of_spirituality_results && $rate_of_spirituality_results['http_status_code'] ==200 ) {
            $content  =  json_decode($rate_of_spirituality_results['output']);
            $status_code = $content->status_code;

            if ($status_code == 200) {
                $data['last_month_results'] = $content->last_month_results;                
                $data['last_week_results'] = $content->last_week_results;                
            }
            
        } else {
            show_404();exit();
        } 

        $this->load->view('group/group_ranking_view',isset($data) ? $data : "");
      }
    }

    public function seeMember()
    {
        if (!$this->session->userdata('access_token')) {

          redirect('login','refresh');

        }else{
            
          $data          =  $this->tq_header_info();
          $group_user_id = $this->input->get('user_id');
          $user_id       = $this->session->userdata('user_id');
          $temp_results = $this->input->get('results');
          $page = $this->input->get('page');
          $temp_count = $this->input->get('count');
          $data['results'] = $temp_results ? $temp_results : 10;
          $data['page'] =  $page ? $page : 1;
          $data['count'] = $temp_count ? $temp_count : 5;

          $result        = doCurl(API_BASE_LINK.
                            'group/see_member?group_user_id='.$group_user_id.
                            '&user_id='.$user_id.
                            '&limit='.$data['results'].
                            '&page='.$data['page'].
                            '&count='.$data['count']
                          );         
        // var_dump($result);exit;

          if ($result && $result['http_status_code'] == 200) {
              $content          = json_decode($result['output']);

              // var_dump($content);exit;
              $status_code      = $content->status_code;


              if ($status_code == 200) {
                  $data['group_userHead_src'] = $content->results->userHead_src;
                  $data['spirituality_results'] = $content->results->spirituality_results;

                  $data['total']    = $content->total;
                  $uri = ''; 
                  $data['pagination'] = pagination($content->total, $data['page'], $content->results->spirituality_results, $uri);
                  $data['prayer_results'] = $content->results->prayer_results;
                  $data['page_array'] = $content->results->page_array;
                  $data['spiri_total_count'] = $content->results->spiri_total_count;
                  $data['spiri_week_count'] = $content->results->spiri_week_count;
                  $data['prayer_group_week_count'] = $content->results->prayer_group_week_count;
                  $data['urgent_group_week_count'] = $content->results->urgent_group_week_count;
                  $data['prayer_group_total_count'] = $content->results->prayer_group_total_count;
                  $data['urgent_group_total_count'] = $content->results->urgent_group_total_count;
                  $data['group_user_info'] = $content->results->group_user_info;
                  $data['group_ranking_result'] = $content->results->group_ranking_result;
                  $data['tq_ranking_result'] = $content->results->tq_ranking_result;
              }            
          }else{

            show_404();exit();
          }                        
          $this->load->view('group/group_seeMember_view', isset($data) ? $data : "");   
        }
    }

    public function setting_spirituality()
    {
        $params['testament'] = $this->input->get('testament');
        $params['book_id'] = $this->input->get('book_id');
        $params['chapter_id'] = $this->input->get('chapter_id');
        $params['user_id'] = $this->session->userdata('user_id');
        $params['group_id'] = $this->input->get('group_id');

        if ($this->session->userdata('user_id')) {
            $url = API_BASE_LINK.'group/setting_spirituality';
            $result = doCurl($url, $params, 'POST');
            if ($result && $result['http_status_code'] ==200 ) {
              $content = json_decode($result['output']); 
              $status_code = $content->status_code;
              $results = $content->results;

              if ($status_code == 200 && $results) {
                  
                $this->session->set_flashdata('success', '灵修章节设置成功！');
              }else{
                
                $this->session->set_flashdata('error', '灵修章节设置失败！');
              }


              redirect('/group/spirituality','refresh');

            }else{
              
              show_404();exit();
            }
            
        }else{

            redirect('/group/spirituality','refresh');
        }
  }

  // public function  check_nextday()
  // {
  //   if (!$this->session->userdata('access_token')) {

  //     redirect('login','refresh');

  //   }else{
      
  //     $data =  $this->tq_header_info();

  //     $day = $this->input->get('day') ? $this->input->get('day'): ""; 
  //     $group_id = isset($data['user_info']->group_id) ?  $data['user_info']->group_id : ""; 
  //     $result = doCurl(API_BASE_LINK.'group/check_nextday?day='."$day".'&group_id='."$group_id");
  //     if ($result && $result['http_status_code'] == 200) {
  //         $content =json_decode($result['output']);
  //         $status_code = $content->status_code;

  //         if ($status_code == 200) {
  //             $data['results'] = $content->results;
  //             $data['date'] = $content->date;
  //         }
        
  //         $this->load->view('group/group_check_prayer_view',isset($data) ? $data : ""); 
  //     }else{

  //       show_404();exit();
  //     }

  //   }      
  // }

  public function send_comments()
  {

    if (!$this->session->userdata('access_token')) {
      redirect('login','refresh');
    }else{
      $params{"comments_contents"}    = $this->input->post('comments_contents');
      $params['spirituality_id']      = $this->input->post('spirituality_id');
      $params['user_id']              = $this->session->userdata('user_id');      
      $object = array();
      $url = API_BASE_LINK.'group/send_comments';
      $result = doCurl($url, $params, 'POST');
      if ($result && $result['http_status_code'] == 200) {
          $content =json_decode($result['output']);
          $status_code = $content->status_code;
          if ($status_code == 200) {
                $object['status'] = '200'; //成功  
                $object['message'] = '成功!'; //成功                                          
                $object['list'] = $params;
          } else{
                $object['status'] = '400'; //失败
                $object['message'] = '提交失败！';  
          }       
      }else{
        echo json_encode("error");exit;
      }    

      echo json_encode($object);exit;
    }

  }

  public function send_reply()
  {
    if (!$this->session->userdata('access_token')) {
      redirect('login','refresh');
    }else{     

      $params['user_id']        = $this->session->userdata('user_id');
      $params['comments_id']    = $this->input->post('comments_id');
      $params['reply_content']  = $this->input->post('reply_content');      
      $url = API_BASE_LINK.'group/send_reply';

      $result = doCurl($url, $params, 'POST');

      if ($result && $result['http_status_code'] == 200) {
          $content =json_decode($result['output']);
          $status_code = $content->status_code;

          if ($status_code == 200) {
              echo json_encode($params);exit;
          }        

      }else{
        echo json_encode('error');exit;
      }      
    }
  }

  public function  del_comments_by_comment_id()
  {
    $params['comment_id'] = $this->input->get('comment_id'); 
    $params['user_id'] = $this->session->userdata('user_id');
    $return = array();

    $url = API_BASE_LINK.'group/del_comments_by_comment_id';
    $result = doCurl($url, $params, 'POST');
    if ($result && $result['http_status_code'] == 200) {
        $content =json_decode($result['output']);
        $status_code = $content->status_code;

        if ($status_code == 200) {
            $return['status'] = 200;             
        }else{            
            $return['status'] = 400;             
            $return['message'] = 'error';             
        }        
    }else{
        echo json_encode('error');exit;
    }  
        echo json_encode($return);exit; 
  } 

  
    public function del_prayer()
    {
      $params['prayer_id'] = $this->input->post('prayer_id');
      $params['contentStyle'] = $this->input->post('contentStyle');
      $params['user_id'] = $this->session->userdata('user_id');

      $odj = array();

      $url = API_BASE_LINK.'group/del_prayer';
      $result = doCurl($url, $params, 'POST');

      if ($result && $result['http_status_code'] == 200) {
          $content =json_decode($result['output']);
          $status_code = $content->status_code; 
          if($status_code == 200){
            $odj['status'] = 200;                           
            
          }else{
            $odj['status'] = 400;                          
          }

      }else{
        echo json_encode('error');exit;
      }
      echo json_encode($odj);exit;
    } 


}
