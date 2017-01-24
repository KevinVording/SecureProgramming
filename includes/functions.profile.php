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

 $query = "SELECT *
 FROM sw_user
 INNER JOIN sw_single_chat
 ON sw_user.user_id = sw_single_chat.user_two_id
 GROUP BY sw_user.user_id;";

 $result = databaseQuery($query, $connection);
 while($row = databaseFetchRow($result)) {

  $chat_id = $row['chat_id'];

  echo $row['user_name']."&nbsp</br>";
  echo '<a class="waves-effect waves-light btn" href="singlechat.php?chat_group_id='.$chat_id.'">Direct Message</a></br>';

}

/**
 * /Users which are already in DM
 */
function showNonExistingUsernames($user_id, $connection) {

 global $connection;


 $query = "SELECT *
 FROM sw_user, sw_single_chat
 WHERE sw_user.user_id != sw_single_chat.user_one_id
 ORDER BY sw_user.user_id;";

 $result = databaseQuery($query, $connection);
 while($row = databaseFetchRow($result)) {

  if($row['user_id'] == $_SESSION['user_id'])
  {
    echo "";
  }
  else{

    $chat_id = rand();

    echo $row['user_name']."&nbsp</br>";
    echo '<a class="waves-effect waves-light btn" href="singlechat.php?chat_group_id='.$chat_id.'">Direct Message</a></br>';
  }

}

}


}





?>
