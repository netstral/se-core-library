<?php

$plugin_name 		   = 'Netstral Library';
$plugin_version 	   = '3.00';
$plugin_type 		   = 'netstral';
$plugin_desc 		   = ' This is an API developed by Netstral to be used in various plug-ins and customization works for Social Engine.';
$plugin_icon 		   = 'netstral.png';
$plugin_db_charset     = 'utf8';
$plugin_db_collation   = 'utf8_unicode_ci';
$plugin_reindex_totals = TRUE;

if($install == 'netstral') 
{
  	//######### GET CURRENT PLUGIN INFORMATION
  	$sql 	  = "SELECT * FROM `se_plugins` WHERE `plugin_type` = '{$plugin_type}' LIMIT 1";
  	$resource = $database->database_query($sql) or die($database->database_error()."<b>SQL was:</b> {$sql}");
 
  	$plugin_info = array();
	
  	if($database->database_num_rows($resource))
    	$plugin_info = $database->database_fetch_assoc($resource);


  	//######### INSERT ROW INTO `se_plugins`
	$sql 	  = "SELECT `plugin_id` FROM `se_plugins` WHERE `plugin_type` = '{$plugin_type}'";
  	$resource = $database->database_query($sql) or die($database->database_error()."<b>SQL was:</b> {$sql}");
	
  	if(!$database->database_num_rows($resource)) 
	{
		$sql = "
			INSERT INTO 
				`se_plugins`
			SET
				`plugin_name` 		  = '{$plugin_name}',
				`plugin_version` 	  = '{$plugin_version}',
				`plugin_type` 		  = '{$plugin_type}',
				`plugin_desc` 		  = '".str_replace("'", "\'", $plugin_desc)."',
				`plugin_icon` 		  = '{$plugin_icon}',
				`plugin_menu_title`   = '{$plugin_menu_title}',
				`plugin_pages_main`   = '{$plugin_pages_main}',
				`plugin_pages_level`  = '{$plugin_pages_level}',
				`plugin_url_htaccess` = '{$plugin_url_htaccess}'
		";
		
		$resource = $database->database_query($sql) or die($database->database_error()." <b>SQL was:</b> {$sql}");
	}

  	//######### UPDATE PLUGIN VERSION IN `se_plugins`
	else
	{
		$sql = "
			UPDATE 
				`se_plugins` 
			SET 
				`plugin_name` 			= '{$plugin_name}',
				`plugin_version`		= '{$plugin_version}',
				`plugin_desc`  			= '".str_replace("'", "\'", $plugin_desc)."',
				`plugin_icon`			= '{$plugin_icon}',
				`plugin_menu_title`		= '{$plugin_menu_title}',
				`plugin_pages_main`		= '{$plugin_pages_main}',
				`plugin_pages_level`	= '{$plugin_pages_level}',
				`plugin_url_htaccess`	= '{$plugin_url_htaccess}' 
			WHERE 
				`plugin_type` 			= '{$plugin_type}'
		";
		
    	$resource = $database->database_query($sql) or die($database->database_error()." <b>SQL was:</b> {$sql}");
	}	
	
  	//######### INSERT LANGUAGE VARS
  	if($database->database_num_rows($database->database_query("SELECT `languagevar_id` FROM `se_languagevars` WHERE `languagevar_id` = 12000000 LIMIT 1")) == 0) 
	{
    	$sql = "
				INSERT INTO `se_languagevars` 
					(`languagevar_id`, `languagevar_language_id`, `languagevar_value`, `languagevar_default`) 
				VALUES 
					(12000000, 1, 'Netstral', 'admin_viewusers_edit, admin_viewusers, admin_viewreports, admin_viewplugins, admin_viewadmins, admin_url, admin_templates, 
					admin_subnetworks, admin_stats, admin_signup, admin_profile, admin_lostpass_reset, admin_lostpass, admin_login, admin_log, admin_levels_usersettings, 
					admin_levels_messagesettings, admin_levels_edit, admin_levels, admin_language_edit, admin_language, admin_invite, admin_home, admin_general, 
					admin_fields, admin_faq, admin_emails, admin_connections, admin_banning, admin_announcements, admin_ads_modify, admin_ads, admin_activity, ')
		";
		
		$resource = $database->database_query($sql) or die($database->database_error()." <b>SQL was:</b> {$sql}");
  	}
}

?>