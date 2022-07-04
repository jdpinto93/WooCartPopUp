<?php

/**
 * Plugin Name:       WooCartPopUp
 * Plugin URI:        http://www.webmasteryagency.com
 * Description:       Ventana modal de carrito para woocommerce que se dispara en forma de PopUp cuando se añade al carrito.
 * Version:           1.10.3
 * Requires at least: 5.2
 * Requires PHP:      7.8
 * Author:            Jose Pinto
 * Author URI:        http://www.webmasteryagency.com
 * License:           GPL v3 or later
 */

if(!defined('ABSPATH')){
	return; 	
}


define("JP_CP_PATH", plugin_dir_path(__FILE__));
define("JP_CP_URL", plugins_url('',__FILE__));
define("JP_CP_VERSION",1.6);

//Admin Settings
include_once JP_CP_PATH.'/admin/jp-cp-admin.php';

//Init plugin
function jp_cp_rock_the_world(){
	global $jp_cp_gl_atcem_value;
	
	//If mobile
	if(!$jp_cp_gl_atcem_value){
		if(wp_is_mobile()){
			return;
		}
	}
	require_once JP_CP_PATH.'/includes/class-jp-cp.php';
	//Start the plugin
	Jp_CP::get_instance();
}
add_action('plugins_loaded','jp_cp_rock_the_world');