<?php

$new_user = $_POST['name'];
$new_password_attempt1 = $_POST['password_attempt1'];
$new_password_attempt2 = $_POST['password_attempt2'];



//establishing link to database
$db = new SQLite3('testing.db') or die('Unable to open database');

//prevent sql injection
$new_user = stripslashes($new_user);
$new_password_attempt1 = stripslashes($new_password_attempt1);
$new_user = SQLite3::escapeString($new_user);
$new_password_attempt1 = SQLite3::escapeString($new_password_attempt1);

//if they are correct, redirect to input page
//if not, redirect to output page
if($new_password_attempt1 == $new_password_attempt2){
    $new_user_sql = "INSERT INTO users (id, name, passhash) VALUES ("	
}

?>