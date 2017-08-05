<?php

/**
 *	Netstral API
 *  
 *  This is an API developed by Netstral to be used in
 *  various plug-ins and customization works for Social Engine.
 *  Do NOT modify this file in anyway. This file is not Open-Source.
 *
 *  @category		api
 *  @version		3.00
 *  @author			Abdelrahman Mahmoud <abdelrahman94@gmail.com>
 *
**/

session_start();

class nsl {
	
	function get($key, $default = null) { 
		return isset($_GET[$key]) ? $_GET[$key] : $default; 
	}
	
	function session($key, $default = null) { 
		return isset($_SESSION[$key]) ? $_SESSION[$key] : $default;
	}
	
	function post($key, $default = null) {
		return isset($_POST[$key]) ? $_POST[$key] : $default;
	}
	
	function request($key, $default = null)  { 
		return isset($_REQUEST[$key]) ? $_GET[$key] : $default;  	 
	}
	
	function getpost($key, $default = null)  { 
		return isset($_GET[$key]) ? $_GET [$key] : (isset($_POST[$key]) ? $_POST[$key] : $default); 
	}
	
	function redirect($url) {
		header('Location: '.$url);
		exit();
	}
	
	function get_contents($filename) {
		return file_get_contents($filename);
	}
	
	function put_contents($filename, $value) {
		return file_put_contents($filename, $value);
	}
	
	function is_user() {
		global $user;
		
		return $user->user_exists != 0;
	}
	
	function is_owner() {
		global $owner;
		
		return $owner->user_exists != 0;
	}
	
	function get_owner_level($type, $value=null) {
		global $owner;
		
		if($value) { 
			return $owner->level_info['level_'.$type.'_'.$value]; 
		} else { 
			return $owner->level_info['level_'.$type];            
		}
	}
	
	function get_user_level($type, $value=null) {
		global $user;
		
		if($value) { 
			return $user->level_info['level_'.$type.'_'.$value]; 
		} else { 
			return $user->level_info['level_'.$type];
		}
	}
	
	function plugin_is_installed($plugin_type) {
		global $database;
		
		$plugin_resource = $database->database_query("SELECT * FROM se_plugins WHERE plugin_type='{$plugin_type}' LIMIT 1");
		$plugin_exists   = $database->database_num_rows($plugin_resource);
		
		return $plugin_exists;
	}
}

?>