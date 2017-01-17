<?php
	
	// Disable errors
	//error_reporting(0);
	
	//Includes
	include_once("config.php");
	$include_array = array(
		"functions.core",
		"router",
		"functions.account",
		"functions.website",
		"functions.channel",
		"functions.profile",
		"database",
		"ext/phpmailer/class.phpmailer",
		"ext/phpmailer/class.smtp",
		"ext/phpmailer/class.phpmaileroauthgoogle",
		"email",
	);

	$require_array = array(
		"app/Dropbox/autoload",
		"app/dropbox.start",
	);

	foreach($include_array as $include) {
		include_once("includes/" . $include . ".php");
	}

	foreach($require_array as $require) {
		require("includes/" . $require . ".php");
	}
	// Set locales
	if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
		foreach($core_timestamp_formats as $key=>$format) {
			$core_timestamp_formats[$key] = preg_replace('#(?<!%)((?:%%)*)%e#', '\1%#d', $format);
		}
		setlocale(LC_ALL, 'nld_nld');
	}
	else {
		setlocale(LC_ALL, 'nl_NL');
	}
	date_default_timezone_set('Europe/Amsterdam');

	//Database connection
	$core_db_link = databaseConnect($core_db['host'], $core_db['username'],$core_db['password'], $core_db['dbname']);

	// User account stuff
	$core_user_item	= false;
	
	// Check if user is logged in, or redirected if not logged in.
	include_once("includes/account_validation.php");
	
	// Set the theme (if applicable)
	if($core_user_item != false) {
		if($core_user_item['user_theme'] != "0") {
			$core_colors = $core_theme_colors[$core_user_item['user_theme']];
		}
	}
	//Rijndael key
	$key = pack('H*', "bcb04b7e103a0cd8b54763051cef08bc55abe029fdebae5e1d417e2ffb2a00a3");

   	// create a random IV to use with CBC encoding
	$iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC);

	//Variable used in the html <title> tag, can be overwritten of the page want a specific text in front of the title: "USERNAME | Profile | Swack"
	$core_title_prefix = "";
	//Link used by the header, if set, the header will show a big 'back' arrow with the given link, is meant for use in the pages, if not set, no arrow will be shown.
	$core_back_link = "";
	
	// Start the router
	include(T_ROOT . SCRIPT_FOLDER . PAGE_TEMPLATE);
?>