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
$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

/*------------------------------------Custom Routes Product Management System---------------------- */


$route['default_controller']='Product_management_system_controller';
$route['pms']='Product_management_system_controller';
$route['pms/home']='Product_management_system_controller/home';

//Routes Related To Product Categories
$route['pms/cadd']='Product_management_system_controller/add_category';
$route['pms/cupdate/(:num)']='Product_management_system_controller/update_category/(:num)';
$route['pms/call']='Product_management_system_controller/show_all_categories';
$route['pms/categories_data']='Product_management_system_controller/categories_data';

//Routes Related To Product Sub-Categories
$route['pms/sc/(:any)']='Product_management_system_controller/buildSubcategoryByCategory/$1';
$route['pms/scadd']='Product_management_system_controller/add_subcategory';
$route['pms/scupdate/(:num)']='Product_management_system_controller/update_subcategory/(:num)';
$route['pms/scall']='Product_management_system_controller/show_all_subcategories';
$route['pms/subcategories_data']='Product_management_system_controller/subcategories_data';

//Routes Related To Product
$route['pms/padd']='Product_management_system_controller/add_product';
$route['pms/pupdate/(:num)']='Product_management_system_controller/update_product/(:num)';

$route['pms/do_upload']='Product_management_system_controller/do_upload';
$route['pms/pall']='Product_management_system_controller/show_all_products';
$route['pms/product_data']='Product_management_system_controller/product_data';

//Routes Related To User Profile Management
$route['pms/show']='Product_management_system_controller/show_my_profile';
$route['pms/update']='Product_management_system_controller/update_user_profile';
$route['pms/logout']='Product_management_system_controller/logout';
