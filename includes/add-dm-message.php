<?php include "db.php"; ?>
<?php include "functions.php"; ?>
<?php include "../config.php"; ?>

<?php session_start(); ?>

<?php
if (isset($_POST['submit']) && isset($_POST['message']) && isset($_POST['chat_group_id']))
{

	$message = escapeString($_POST['message']);
	$chat_id = escapeString($_POST['chat_group_id']);


	$secret_key = "lkgitorpwyfhcjak";

// Create the initialization vector for added security.
	$iv = mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB), MCRYPT_RAND);

// Encrypt $string
	$encrypted_string = mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $secret_key, $message, MCRYPT_MODE_CBC, $iv);

	$newMessage = addDmMessage($chat_id, $message);
	var_dump($newMessage);
}
?>
