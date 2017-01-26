<?php
/**
 * Functions file for everything used within a profile
 */

/**
 * Count how many users are avaiable for Direct Messaging
 */
function countTotalUsers($user_id, $connection) {

 global $connection;

 $amount = '';
 $query = "SELECT COUNT(sw_user.user_id) AS amount
 FROM sw_user
 INNER JOIN sw_single_chat
 ON sw_user.user_id=sw_single_chat.user_two_id
 ORDER BY COUNT(sw_user.user_id);";

 $result = databaseQuery($query, $connection);
 while($row = databaseFetchRow($result)) {


  $amount = $row['amount'];
  return $amount;
}
}



function createChat($chat_id, $user_one_id, $user_two_id, $connection)
{
  $connection;

  $query = "INSERT INTO sw_single_chat(chat_id, user_one_id, user_two_id)";
  $query .= "VALUES ('$chat_id', '$user_one_id', '$user_two_id')";
  $result = mysqli_query($connection, $query);

  confirmQuery($result);

  return $result;
}


/**
 * /Users which are already in DM
 */
function showExistingUsernames($user_id, $connection) {

 global $connection;

 $user_id = $_SESSION['user_id'];

 $query = "SELECT
 sw_user.user_id
 ,  sw_user.user_name
 FROM sw_user, sw_single_chat
 GROUP BY sw_user.user_name";

 $result = databaseQuery($query, $connection);
 while($row = databaseFetchRow($result)) {

  if($row['user_id'] == $_SESSION['user_id'])
  {

    echo "";
  }
  else{

    echo $row['user_name']."&nbsp</br>";
    echo "<a href='singlechat.php?user_one=".$user_id."&user_two=".$row['user_id']."' class='waves-effect waves-light btn'>Direct Message</a></br>";
  }

}



}








?>
