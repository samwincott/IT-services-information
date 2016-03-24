<?php

//getting the input from the login page
$username = $_POST['username'];
$current_password = $_POST['current_password'];
$new_password1 = $_POST['new_password1'];
$new_password2 = $_POST['new_password2'];

//establishing link to database
$db = new SQLite3('info.db') or die('Unable to open database');

//prevent sql injection
$username = stripslashes($username);
$current_password = stripslashes($current_password);
$new_password1 = stripslashes($new_password1);
$new_password2 = stripslashes($new_password2);
$username = SQLite3::escapeString($username);
$current_password = SQLite3::escapeString($current_password);
$new_password1 = SQLite3::escapeString($new_password1);
$new_password2 = SQLite3::escapeString($new_password2);

$sql_get_passhash="SELECT passhash FROM users WHERE name='$username'";
$passhash = $db->querySingle($sql_get_passhash);

if((password_verify($current_password, $passhash)) && ($new_password1 == $new_password2)){
	$new_password_hashed = password_hash($new_password1, PASSWORD_DEFAULT);
	$update_password_sql = "UPDATE users SET passhash='$new_password_hashed' WHERE name='$username'";
	$db->exec($update_password_sql);
	header('Location: ../Login.php');   
}
else {
    header('Location: ../change_password.php');
}
?>