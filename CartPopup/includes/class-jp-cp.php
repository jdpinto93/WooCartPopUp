<?php

if(!defined('ABSPATH'))
	return;


class JP_CP{

	protected static $instance = null;

	//Get instance
	public static function get_instance(){
		if(self::$instance === null){
			self::$instance = new self();
		}
		return self::$instance;
	}

	public function __construct(){

		//Functions
		include_once JP_CP_PATH.'/includes/jp-cp-functions.php';

		//Front end
		include_once JP_CP_PATH.'/includes/class-jp-cp-public.php';
		Jp_CP_Public::get_instance();

		//Core functions
		include_once JP_CP_PATH.'/includes/class-jp-cp-core.php';
		Jp_CP_Core::get_instance();

	}

}

?>