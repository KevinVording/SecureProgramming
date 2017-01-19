<?php include "db.php"; ?>
<?php include "functions.php"; ?>
<?php include "functions.profile.php"; ?>
<?php include "../config.php"; ?>
<?php include "singlechat.php"; ?>


<?php session_start(); ?>

<?php
if (isset($_POST['submit']) && isset($_POST['message']))
{
	$message = escapeString($_POST['message']);
	$user_id = escapeString($_SESSION['user_id']);
	$user_two_id = escapeString($_SESSION['user_two_id']);


	$newMessage = addDmMessage($message, $user_id, $user_two_id);
	var_dump($newMessage);
}
?>