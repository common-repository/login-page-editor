<?php
/**
* Plugin Name: Login Page Editor
* Description: Changing the WordPress login page styling has never been easier. The awesome DEVotion editor shows you what your login page will look like before you save it. If you are not happy with your design then you can reset the style back to the default with one click.
* Version: 1.2
* Author: DEVotion
* License: GPL v2 or later
* License URI: https://www.gnu.org/licenses/gpl-2.0.html
* Author URI: https://www.devotion-plugin.com
**/

defined('ABSPATH') or die('Eh?');
if(is_admin()&&!function_exists('wp_crop_image')) { 
	require_once(ABSPATH . 'wp-admin/includes/image.php'); 
}
include('includes/vars.php');
include('class/class.php');
include('includes/scripts.php');
include('includes/menus.php');
include('render/render.php');