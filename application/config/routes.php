<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] = "home";
$route['about-us']	= 'aboutus';
$route['blog'] = "post";
$route['blog/post'] = "post/index";
$route['blog/post/(:num)'] = "post/index/$1";
$route['blog/post/view'] = "post/view";
$route['blog/post/view/(:any)'] = "post/view/$1";
$route['blog/categories'] = "post/categories";
$route['blog/categories/(:any)'] = "post/categories/$1";
$route['blog/search'] = "post/search";
$route['blog/search/(:any)/(:any)'] = "post/search/$1/$2";

$route['login'] = "auth/login";
$route['admin4739'] = "admin4739/dashboard";
$route['admin4739/team/change-picture'] = "admin4739/team/change_picture";
$route['admin4739/team/change-picture/(:any)'] = "admin4739/team/change_picture/$1";
$route['admin4739/(:any)/change-picture'] = "admin4739/$1/change_picture";
$route['admin4739/(:any)/change-picture/(:any)'] = "admin4739/$1/change_picture/$2";



$route['404_override'] = 'pages';


/* End of file routes.php */
/* Location: ./application/config/routes.php */