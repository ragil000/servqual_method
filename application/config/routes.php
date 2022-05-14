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
|	https://codeigniter.com/user_guide/general/routing.html
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
$route['default_controller'] = 'Auth';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['auth'] = 'Auth/index';
$route['auth/(:any)'] = 'Auth/$1';

$route['dashboard']                       = 'dashboard/index';

$route['user']              = 'User/index';
$route['user/create']        = 'User/create';
$route['user/post']          = 'User/post';
$route['user/put']          = 'User/put';
$route['user/delete']          = 'User/delete';
$route['user/(:num)']              = 'User/index/$1';

$route['laboratorium/get_data_laboratorium']    = 'Laboratorium/get_data_laboratorium';
$route['laboratorium']              = 'Laboratorium/index';
$route['laboratorium/create']        = 'Laboratorium/create';
$route['laboratorium/post']          = 'Laboratorium/post';
$route['laboratorium/put']          = 'Laboratorium/put';
$route['laboratorium/delete']          = 'Laboratorium/delete';
$route['laboratorium/(:num)']              = 'Laboratorium/index/$1';

$route['questionnaire/questionnaire']              = 'Questionnaire/index';
$route['questionnaire/questionnaire/create']        = 'Questionnaire/create';
$route['questionnaire/questionnaire/post']          = 'Questionnaire/post';
$route['questionnaire/questionnaire/activate']          = 'Questionnaire/activate';
$route['questionnaire/questionnaire/nonactivate']          = 'Questionnaire/nonactivate';
$route['questionnaire/questionnaire/publish']          = 'Questionnaire/publish';
$route['questionnaire/questionnaire/delete']          = 'Questionnaire/delete';
$route['questionnaire/questionnaire/(:num)']              = 'Questionnaire/index/$1';

$route['questionnaire/question/get_data_questionnaire']              = 'Question/get_data_questionnaire';
$route['questionnaire/question/get_data_dimension']              = 'Question/get_data_dimension';
$route['questionnaire/question']              = 'Question/index';
$route['questionnaire/question/create']        = 'Question/create';
$route['questionnaire/question/post']          = 'Question/post';
$route['questionnaire/question/put']          = 'Question/put';
$route['questionnaire/question/delete']          = 'Question/delete';
$route['questionnaire/question/(:num)']              = 'Question/index/$1';

$route['group/get_data_group']    = 'Group/get_data_group';

$route['analysis/gap5/get_data_summary_servqual']              = 'Gap5/get_data_summary_servqual';
$route['analysis/gap5']              = 'Gap5/filter';
$route['analysis/gap5/list']              = 'Gap5/index';
$route['analysis/gap5/list/(:num)']              = 'Gap5/index/$1';

$route['analysis/ranking']              = 'Ranking/index';
$route['analysis/ranking/(:num)']              = 'Ranking/index/$1';

$route['as_user']              = 'AsUser/index';
$route['as_user/set_user']              = 'AsUser/set_user';
$route['as_user/reset_user']              = 'AsUser/reset_user';
$route['as_user/post']              = 'AsUser/post';

// end