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
 FROM sw_user
 GROUP BY user_name";

 $result = databaseQuery($query, $connection);
 while($row = databaseFetchRow($result)) {

  if($row['user_id'] == $_SESSION['user_id'])
  {
    echo "";
  }
  else{

    $group_id = rand();

    $user_id = $row['user_id'];

    $_SESSION['user_name2'] = $row['user_name'];


    echo $row['user_name']."&nbsp";
    echo"</br>";
    echo"<a href='singlechat.php?groep=$group_id&dm_user=$user_id' class='waves-effect waves-light btn'>Direct Message</a>";
    echo"</br>";
  }
}

}
?>
