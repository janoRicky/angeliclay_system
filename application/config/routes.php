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
$route['default_controller'] = 'controller_main';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

// PAGES - USER
$route['home'] = 'controller_main/view_u_home';
$route['products'] = 'controller_main/view_u_products';
$route['product'] = 'controller_main/view_u_product';
$route['cart'] = 'controller_main/view_u_cart';
$route['login'] = 'controller_main/view_u_login';

$route['test'] = 'controller_main/test';

// SESSION
$route['to_cart'] = 'user/u_controller_session/to_cart';
$route['remove_from_cart'] = 'user/u_controller_session/remove_from_cart';

// FUNCTIONS
$route['user_login'] = 'user/u_controller_login/user_login_verification';



// PAGES - ADMIN
$route['admin'] = 'controller_main/view_a_login';
$route['admin/dashboard'] = 'controller_main/view_a_dashboard';

$route['admin/products'] = 'controller_main/view_a_products';
$route['admin/products_view'] = 'controller_main/view_a_products_view';
$route['admin/products_edit'] = 'controller_main/view_a_products_edit';

$route['admin/types'] = 'controller_main/view_a_types';
$route['admin/types_view'] = 'controller_main/view_a_types_view';
$route['admin/types_edit'] = 'controller_main/view_a_types_edit';

$route['admin/orders'] = 'controller_main/view_a_orders';
$route['admin/orders_view'] = 'controller_main/view_a_orders_view';
$route['admin/orders_edit'] = 'controller_main/view_a_orders_edit';

$route['admin/users'] = 'controller_main/view_a_users';
$route['admin/users_view'] = 'controller_main/view_a_users_view';
$route['admin/users_edit'] = 'controller_main/view_a_users_edit';

$route['admin/accounts'] = 'controller_main/view_a_accounts';
$route['admin/accounts_view'] = 'controller_main/view_a_accounts_view';
$route['admin/accounts_edit'] = 'controller_main/view_a_accounts_edit';


// FUNCTIONS
$route['admin/login'] = 'admin/a_controller_login/admin_login_verification';
$route['admin/logout'] = 'controller_main/admin_logout';

// - CREATE
$route['admin/product_create'] = 'admin/a_controller_create/new_product';
$route['admin/type_create'] = 'admin/a_controller_create/new_type';
$route['admin/order_create'] = 'admin/a_controller_create/new_order';
$route['admin/user_create'] = 'admin/a_controller_create/new_user_account';
$route['admin/acc_create'] = 'admin/a_controller_create/new_admin_account';

// - UPDATE
$route['admin/product_update'] = 'admin/a_controller_update/edit_product';
$route['admin/type_update'] = 'admin/a_controller_update/edit_type';
$route['admin/order_update'] = 'admin/a_controller_update/edit_order';
$route['admin/user_update'] = 'admin/a_controller_update/edit_user_account';
$route['admin/acc_update'] = 'admin/a_controller_update/edit_admin_account';

// - DELETE
$route['admin/product_delete'] = 'admin/a_controller_delete/delete_product';
$route['admin/type_delete'] = 'admin/a_controller_delete/delete_type';
$route['admin/order_delete'] = 'admin/a_controller_delete/delete_order';
$route['admin/user_delete'] = 'admin/a_controller_delete/delete_user_account';
$route['admin/acc_delete'] = 'admin/a_controller_delete/delete_admin_account';


// NOTES:
// url of admin log-in is "http://localhost/angeliclay_system/admin"
// url of admin dashboard is "http://localhost/angeliclay_system/admin/dashboard"
