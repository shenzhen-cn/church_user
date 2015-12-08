<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
// $route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

//smqntq 
$route['default_controller'] = 'login';

//for  home
$route['read'] 						= 'priest_preach/pp_read';
$route['album'] 		    		= 'fellowship_life/album';
$route['upload_photos']     		= 'fellowship_life/upload_photos';
$route['spirituality']      		= 'group/spirituality';
$route['setting_group_prayer']      = 'group/setting_group_prayer';
$route['checkSpiri']        		= 'group/check_spirituality';
$route['delete_spirituality']       = 'group/delete_spirituality';

$route['ranking']           		= 'group/ranking';
$route['setPersonalData']   		= 'Personal/setPersonalData';
$route['look_volume']   			= 'Bibile/look_volume';

$route['seeMember']   				= 'Group/seeMember';

$route['onlineBibile']   			= 'Bibile/onlineBibile';
$route['forgetpassword']   			= 'resetpassword/forgetpassword';
$route['read_myEdit']   			= 'priest_preach/read_myEdit';
$route['del_prompt_alerts']   		= 'alert_messages/del_prompt_alerts';
$route['add_praise']   	    		= 'home/add_praise';
$route['del_all_praise_alert']   	= 'alert_messages/del_all_praise_alert';
$route['tq_statement']          	= 'tq_about/tq_statement';






// 