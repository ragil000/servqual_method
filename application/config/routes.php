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

$route['dashboard']                       = 'dashboard/index';

$route['content/kompetensi']              = 'Content/index';
$route['content/createKompetensi']        = 'Content/createKompetensi';
$route['content/postKompetensi']          = 'Content/postKompetensi';
$route['content/updateKompetensi/(:num)']        = 'Content/updateKompetensi/$1';

$route['content/materi']              = 'Content/materi';
$route['content/createMateri']        = 'Content/createMateri';
$route['content/postMateri']          = 'Content/postMateri';
$route['content/updateMateri/(:num)']        = 'Content/updateMateri/$1';

$route['content/tentang']              = 'Content/tentang';
$route['content/createTentang']        = 'Content/createTentang';
$route['content/postTentang']          = 'Content/postTentang';
$route['content/updateTentang/(:num)']        = 'Content/updateTentang/$1';

$route['content/bantuan']              = 'Content/bantuan';
$route['content/createBantuan']        = 'Content/createBantuan';
$route['content/postBantuan']          = 'Content/postBantuan';
$route['content/updateBantuan/(:num)']        = 'Content/updateBantuan/$1';

$route['content/putData']          = 'Content/putData';

$route['quist'] = 'Quist/index';
$route['quist/(:num)'] = 'Quist/index/$1';
$route['quist/(:any)'] = 'Quist/$1';
$route['quist/(:any)/(:num)'] = 'Quist/$1/$2';

$route['quast'] = 'Quast/index';
$route['quast/(:num)'] = 'Quast/index/$1';
$route['quast/(:any)'] = 'Quast/$1';
$route['quast/(:any)/(:num)'] = 'Quast/$1/$2';

$route['history'] = 'History/index';
$route['history/(:num)'] = 'History/index/$1';
$route['history/(:any)'] = 'History/$1';
$route['history/(:any)/(:num)'] = 'History/$1/$2';

// end