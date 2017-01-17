<?php
	// Database settings
	$core_db = array(
		"host" 		=> "localhost",
		"dbname" 	=> "secure_programming",
		"username" 	=> "root",
		"password" 	=> ""
	);
	// Small prefix after the domain, eg xxxx.xxx/PREFIX
	$core_root_postfix 		= "swack/";
	// Timestamps, are changed according to server OS if needed.
	$core_timestamp_formats = array(
		"chat_timestamp" => "%H:%M",
		"chat_datestamp" => "%e %B",
	);
	$core_dropbox_auth = array(
		"dropboxKey" 	=> "ql6acp5dda9ph0b",
		"dropboxSecret" => "99aevek3cta2213",
		"appName"		=> "Swack"
	);
	// All rights, currently not used.
	$core_channel_rights = array(
		"1" =>	"Administrator",
		"2" =>	"Moderator",
		"3" =>	"Gebruiker",
		"4" =>	"Gast",
	);
	// Settings used to send an email
	$core_mail_settings = array(
		"name" 		=> "Swack Applicatie",
		"email" 	=> "swackapp@gmail.com",
		"passwd" 	=> "swackquack",
	);
	$core_login_pages = array("login","aanmelden","wachtwoord-vergeten","account-activeren");
	// All the pages a user can visit, defines the title for the <title> tag and the script (in /pages) to include
	$core_custom_pages = array(
		"login" 	=> array(
			"title" 	=> "Login",
			"template" 	=> "login.php",
		),
		"aanmelden" 	=> array(
			"title" 	=> "Aanmelden",
			"template" 	=> "register.php",
		),
		"wachtwoord-vergeten" 	=> array(
			"title" 	=> "Wachtwoord vergeten",
			"template" 	=> "lostpw.php",
		),
		"kanaal" 	=> array(
			"title" 	=> "Kanaal",
			"template" 	=> "channel.php",
		),
		"dashboard" 	=> array(
			"title"		=> "Kanalen",
			"template" 	=> "dashboard.php"
		),
		"account-activeren" 	=> array(
			"title"		=> "Account activeren",
			"template" 	=> "account-activation.php"
		),
		"uitloggen" 	=> array(
			"title"		=> "Uitloggen",
			"template" 	=> "logout.php"
		),
		"groep" 	=> array(
			"title"		=> "Groep",
			"template" 	=> "group.php"
		),
		"blok" 	=> array(
			"title"		=> "Blok",
			"template" 	=> "block.php"
		),
		"profiel" => array(
			"title" => "Profiel",
			"template" => "profile.php"
		),
		"kanaal-rechten" => array(
			"title" => "Kanaal rechten",
			"template" => "channel-rights.php"
		),
		"groep-rechten" => array(
			"title" => "Groep rechten",
			"template" => "group-rights.php"
		),
		"download" => array(
			"title" => "Download",
			"template" => "download.php"
		),
		"chat" => array(
			"title" => "Chat",
			"template" => "chat.php"
		),
	);
	// All API pages, changes the include folder to /api
	$core_api_pages = array(
		"getchat" 	=> array(
			"title" 	=> "Chat",
			"template" 	=> "getchat.php",
		),
		"addmessage" 	=> array(
			"title" 	=> "Bericht toevoegen",
			"template" 	=> "add-message.php",
		),
			"addBlock" 	=> array(
			"title" 	=> "Blok toevoegen",
			"template" 	=> "addBlock.php",
		),
		"uploadfile" 	=> array(
			"title" 	=> "Bestand upload",
			"template" 	=> "uploadfile.php",
		),
		"getSubscribers" 	=> array(
			"title" 	=> "Subscribe",
			"template" 	=> "getSubscribers.php",
		),
		"getsinglechat" 	=> array(
			"title" 	=> "Single Chat",
			"template" 	=> "getsinglechat.php",
		),
		"addsinglemessage" 	=> array(
			"title" 	=> "Chat Bericht toevoegen",
			"template" 	=> "addsinglemessage.php",
		),
	);
	// Default theme colors.
	$core_colors = array(
		"main" 		=> "indigo",
		"accent" 	=> "red",
	);
	// A set of colors that are randomly linked to a user
	$core_chat_colors = array(
		"red-text text-darken-1", "pink-text text-darken-1",  "purple-text text-darken-1", "deep-purple-text text-darken-1", "cyan-text text-darken-1", "light-blue-text text-darken-1", "teal-text text-darken-1",
		"green-text text-darken-1", "lime-text text-darken-1", "yellow-text text-darken-3", "amber-text text-darken-3", "orange-text text-darken-1",
	);
	// All theme colors, will overwrite $core_colors if user has chosen to
	$core_theme_colors = array(
		"0" => array(
		"main" 			=> "indigo",
		"accent" 		=> "red",
		"text"			=> "Donkerblauw - rood",
		),
		"1" => array(
			"main" 		=> "teal",
			"accent" 	=> "red",
			"text"		=> "Teal - rood",
		),
		"2" => array(
			"main" 		=> "brown",
			"accent" 	=> "cyan",
			"text"		=> "Bruin - cyaan",
		),
		"3" => array(
			"main" 		=> "green",
			"accent" 	=> "blue",
			"text"		=> "Groen - blauw",
		),
		"4" => array(
			"main" 		=> "purple",
			"accent" 	=> "deep-orange",
			"text"		=> "Paarse - donker oranje",
		),
		"5" => array(
			"main" 		=> "blue-grey",
			"accent" 	=> "amber",
			"text"		=> "Grijs - geel",
		),
		"6" => array(
			"main" 		=> "orange",
			"accent" 	=> "light-green",
			"text"		=> "Oranje - lichtgroen",
		),
		"7" => array(
			"main" 		=> "deep-purple",
			"accent" 	=> "pink",
			"text"		=> "Donkerpaars - roze",
		),
	);
?>
