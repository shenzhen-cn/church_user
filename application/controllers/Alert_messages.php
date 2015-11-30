<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Alert_messages extends MY_Controller {

	 /**
     * Constructor function
     */
    public function __construct() {
        parent::__construct();
    }

    public function del_alert_comments_by_spirituality_id()
    {
        $params['spirituality_id'] = $this->input->get("spirituality_id"); 
        $params['user_id'] = $this->session->userdata('user_id');    
        $url = API_BASE_LINK.'alert_messages/del_alert_comments_by_spirituality_id';
        $return = array();  

        $result = doCurl($url, $params, 'POST');
        if ($result && $result['http_status_code'] == 200) {
            $content =json_decode($result['output']);
            $status_code = $content->status_code;

            if ($status_code == 200) {
                $return['status'] = 200;             
            }else{            
                $return['status'] = 400;             
            }        
        }else{
            echo json_encode('error');exit;
        }  
            echo json_encode($return);exit; 
    }

    public function del_all_praise_alert()
    {
        $user_id = $this->session->userdata('user_id');   
        $results = doCurl(API_BASE_LINK.'alert_messages/del_all_praise_alert?user_id='.$user_id);
        $return = array();     

        if ($results && $results['http_status_code'] == 200 ) {
            $content = json_decode($results['output']);             
            $status_code = $content->status_code;

            if ($status_code == 200) {
                $return['status'] = 200;             
            }else{            
                $return['status'] = 400;             
            }                       
        }else{
            echo json_encode('error');exit;             
        }
        echo json_encode($return);exit; 
    }    

    public function del_prompt_alerts()
    {
        $user_id = $this->session->userdata('user_id');           
        $results = doCurl(API_BASE_LINK.'alert_messages/del_prompt_alerts?user_id='.$user_id);
        $return  = array();
        if ($results && $results['http_status_code'] == 200 ) {
            $content = json_decode($results['output']);             
          // echo   json_encode($content);exit;
            $status_code = $content->status_code;
            if($status_code == 200){
                $return["status"] = 200;    
            }else{
                $return['status'] = 400;                 
            }

        }else{
            echo  json_encode('error');exit;
        }

        echo  json_encode($return);exit;        
    }   

    public function remove_alert_by_id()
    {
        $alert_id = $this->input->post('alert_id');
        // echo json_encode($alert_id);exit;
        $obj  = array();
    
        if (!empty($alert_id)) {
            $results = doCurl(API_BASE_LINK.'alert_messages/remove_alert_by_id?alert_id='.$alert_id);
        
            if($results && $results['http_status_code'] == 200){
                $content= json_decode($results['output']); 
                $status_code = $content->status_code;
                
                if($status_code == 200){
                   $obj['status'] = 200; 
                }else{                    
                   $obj['status'] = 400; 
                }
            }
        }else{
            echo json_encode('error');exit;
        }

        echo json_encode($obj);exit;

    }












}
