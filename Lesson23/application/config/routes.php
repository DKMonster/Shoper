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
$route['store'] = 'index';
$route['news'] = 'welcome/news';

$route['console'] = 'console/index';
$route['console/login'] = 'console/login';
$route['console/logout'] = 'console/logout';

$route['console/manager'] = 'console/manager_list';
$route['console/manager/insert'] = 'console/manager_insert';
$route['console/manager/update/(:any)'] = 'console/manager_update/$1';
$route['console/member'] = 'console/member_list';
$route['console/member/insert'] = 'console/member_insert';
$route['console/member/update/(:any)'] = 'console/member_update/$1';
$route['console/category'] = 'console/category_list';
$route['console/category/insert'] = 'console/category_insert';
$route['console/category/update/(:any)'] = 'console/category_update/$1';
$route['console/product'] = 'console/product_list';
$route['console/product/insert'] = 'console/product_insert';
$route['console/product/update/(:any)'] = 'console/product_update/$1';
$route['console/order'] = 'console/order_list';
$route['console/order/detals/(:any)'] = 'console/order_detals/$1';
$route['console/contact'] = 'console/contact_list';
$route['console/contact/detals/(:any)'] = 'console/contact_detals/$1';
$route['console/news'] = 'console/news_list';
$route['console/news/insert'] = 'console/news_insert';
$route['console/news/update/(:any)'] = 'console/news_update/$1';


$route['api_console/delete_manager'] = 'api_console/delete_manager';
$route['api_console/delete_member'] = 'api_console/delete_member';
$route['api_console/delete_category'] = 'api_console/delete_category';
$route['api_console/delete_sub_photo'] = 'api_console/delete_sub_photo';
$route['api_console/delete_contact'] = 'api_console/delete_contact';

$route['api_console/online_product'] = 'api_console/online_product';
$route['api_console/feature_product'] = 'api_console/feature_product';

$route['api_console/upload_trumbowyg_image'] = 'api_console/upload_trumbowyg_image';
$route['api_console/upload_sub_photo'] = 'api_console/upload_sub_photo';


$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
