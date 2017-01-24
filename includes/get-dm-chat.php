<?php include "db.php"; ?>
<?php include "functions.php"; ?>
<?php include "functions.profile.php"; ?>
<?php include "../config.php"; ?>

<?php
$chat_group_id = $_GET['chat_group_id'];

if(isset($_GET['chat_gorup_id']) && $_GET['chat_group_id'] > 0) 
{
	$chat_group_id = $_GET['chat_group_id'];
}

$chat_items = getAllDmChats($chat_group_id);

$user_id = $_SESSION['user_id'];

if(!empty($chat_items) && $chat_items !== false)
{
	foreach($chat_items as $key=>$item) 
	{

		srand($item['user_id']);
		$chat_items[$key]['color'] = $core_chat_colors[rand(1, (count($core_chat_colors) -1))];
		$chat_items[$key]['format_time'] = strftime($core_timestamp_formats['chat_timestamp'], strtotime($item['timemessage']));
		$chat_items[$key]['format_date'] = date($core_timestamp_formats['chat_datestamp'], strtotime($item['timemessage']));
	}
	echo json_encode($chat_items);
}
else 
{
	return false;
}
?>
