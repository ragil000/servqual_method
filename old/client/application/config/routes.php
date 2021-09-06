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
$route['default_controller'] = 'Home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['litbang/detail/(:any)/(:any)']          = 'litbang/detail/$1/$2';
$route['litbang/(:any)']                        = 'litbang/index/$1';
$route['litbang/(:any)/(:num)']                 = 'litbang/index/$1/$2';

$route['journal/detail/(:any)/(:any)']          = 'journal/detail/$1/$2';
$route['journal/(:any)']                        = 'journal/index/$1';
$route['journal/(:any)/(:num)']                 = 'journal/index/$1/$2';

$route['profile/detail/(:any)/(:any)']          = 'profile/detail/$1/$2';
$route['profile/(:any)']                        = 'profile/index/$1';
$route['profile/(:any)/(:num)']                 = 'profile/index/$1/$2';

$route['galery/detail/(:any)/(:any)']          = 'galery/detail/$1/$2';
$route['galery/(:any)']                        = 'galery/index/$1';
$route['galery/(:any)/(:num)']                 = 'galery/index/$1/$2';

$route['usulan-penelitian']                     = 'penelitian/index';
$route['penelitian/post']                       = 'penelitian/post';

$route['admin']                                 = 'admin/Auth/index';

$route['admin/dashboard']                       = 'admin/dashboard/index';

$route['admin/litbang/detail/(:any)/(:num)']    = 'admin/litbang/detail/$1/$2';
$route['admin/litbang/create/(:any)']           = 'admin/litbang/create/$1';
$route['admin/litbang/update/(:any)/(:num)']    = 'admin/litbang/update/$1/$2';
$route['admin/litbang/put/(:any)/(:num)']       = 'admin/litbang/put/$1/$2';
$route['admin/litbang/(:any)']                  = 'admin/litbang/index/$1';
$route['admin/litbang/(:any)/(:num)']           = 'admin/litbang/index/$1/$2';

$route['admin/journal/detail/(:any)/(:num)']    = 'admin/journal/detail/$1/$2';
$route['admin/journal/create/(:any)']           = 'admin/journal/create/$1';
$route['admin/journal/update/(:any)/(:num)']    = 'admin/journal/update/$1/$2';
$route['admin/journal/put/(:any)/(:num)']       = 'admin/journal/put/$1/$2';
$route['admin/journal/(:any)']                  = 'admin/journal/index/$1';
$route['admin/journal/(:any)/(:num)']           = 'admin/journal/index/$1/$2';

$route['admin/profile/detail/(:any)/(:num)']    = 'admin/profile/detail/$1/$2';
$route['admin/profile/create/(:any)']           = 'admin/profile/create/$1';
$route['admin/profile/update/(:any)/(:num)']    = 'admin/profile/update/$1/$2';
$route['admin/profile/put/(:any)/(:num)']       = 'admin/profile/put/$1/$2';
$route['admin/profile/(:any)']                  = 'admin/profile/index/$1';
$route['admin/profile/(:any)/(:num)']           = 'admin/profile/index/$1/$2';

$route['admin/galery/detail/(:any)/(:num)']    = 'admin/galery/detail/$1/$2';
$route['admin/galery/create/(:any)']           = 'admin/galery/create/$1';
$route['admin/galery/update/(:any)/(:num)']    = 'admin/galery/update/$1/$2';
$route['admin/galery/put/(:any)/(:num)']       = 'admin/galery/put/$1/$2';
$route['admin/galery/(:any)']                  = 'admin/galery/index/$1';
$route['admin/galery/(:any)/(:num)']           = 'admin/galery/index/$1/$2';

$route['admin/proposal/detail/(:any)/(:num)']    = 'admin/proposal/detail/$1/$2';
$route['admin/proposal/create/(:any)']           = 'admin/proposal/create/$1';
$route['admin/proposal/update/(:any)/(:num)']    = 'admin/proposal/update/$1/$2';
$route['admin/proposal/put/(:any)/(:num)']       = 'admin/proposal/put/$1/$2';
$route['admin/proposal/(:any)']                  = 'admin/proposal/index/$1';
$route['admin/proposal/(:any)/(:num)']           = 'admin/proposal/index/$1/$2';