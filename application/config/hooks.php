<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| Hooks
| -------------------------------------------------------------------------
| This file lets you define "hooks" to extend CI without hacking the core
| files.  Please see the user guide for info:
|
|	https://codeigniter.com/user_guide/general/hooks.html
|
*/

# Load phpdotenv
// $hook['pre_system'] = function() {
// 	require_once 'vendor/autoload.php';
	
// 	$dotenv = Dotenv\Dotenv::createArrayBacked(__DIR__.'/../..');
// 	$dotenv->load();
// };
// $hook['pre_system'] = function() {
//  $dotenv = Dotenv\Dotenv::create(APPPATH);
//  $dotenv->load();
// };

// $hook['post_controller_constructor'] = array(
// 	'class'    => 'Auth',
// 	'function' => 'check',
// 	'filename' => 'Auth.php',
// 	'filepath' => 'hooks'
// );

// $hook['pre_controller'] = function() {
// 	// echo "test";
// 	// die;
// 	$CI =& get_instance();
// 	$CI->load->library('acl');
// 	if (property_exists($CI, 'acl')) {
// 		$CI->acl->check();
// 	}
// };
