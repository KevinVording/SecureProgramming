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
 $query = "SELECT COUNT(user_firstname) AS amount,user_id 
 FROM sw_user
 ORDER BY COUNT(user_firstname)";

 $result = databaseQuery($query, $connection);
 while($row = databaseFetchRow($result)) {
  if($row['user_id'] == $_SESSION['user_id'])
  {
    echo $amount - 1;
  }
  else{

    $amount = $row['amount'];
    return $amount - 1;
  }
}

}


/**
 * Count how many users are avaiable for Direct Messaging
 */
function showUsernames($user_id, $connection) {

 global $connection;

 $query = "SELECT user_id, user_name 
 FROM sw_user";

 $result = databaseQuery($query, $connection);
 while($row = databaseFetchRow($result)) {
  if($row['user_id'] == $_SESSION['user_id'])
  {
    echo "";
  }
  else
  {
    $group_id = rand();

    echo $row['user_name']."&nbsp";
    echo"</br>";
    echo"<a href='singlechat.php?groep=$group_id' class='waves-effect waves-light btn'>Direct Message</a>";
    echo"</br>";
  }
}
}
?>
