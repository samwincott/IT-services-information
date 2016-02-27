<?php

$user_guess = $_POST['name'];
$password_guess = $_POST['password'];

//establishing link to database
$db = new SQLite3('testing.db') or die('Unable to open database');

//prevent sql injection
$user_guess = stripslashes($user_guess);
$password_guess = stripslashes($password_guess);
$user_guess = SQLite3::escapeString($user_guess);
$password_guess = SQLite3::escapeString($password_guess);

//checking if credentials are correct
$sql="SELECT count(*) FROM users WHERE name='$user_guess' and passhash='$password_guess'";
$result = $db->querySingle($sql);

//if they are correct, redirect to input page
//if not, redirect to output page
if($result == 1){
	session_start();
	$_SESSION['username'] = $user_guess;
	header('Location: ../Input.php');
}
else {
	header('Location: ../Output.php');
}
?>








