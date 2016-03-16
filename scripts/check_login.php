<?php

//uncomment these to find errors
//also comment out the header to be able to see the errors
// ini_set('display_errors',1);
// error_reporting(E_ALL);

$user_guess = $_POST['name'];
$password_guess = $_POST['password'];

//establishing link to database
$db = new SQLite3('testing.db') or die('Unable to open database');

//prevent sql injection
$user_guess = stripslashes($user_guess);
$password_guess = stripslashes($password_guess);
$user_guess = SQLite3::escapeString($user_guess);
$password_guess = SQLite3::escapeString($password_guess);

$sql_get_passhash="SELECT passhash FROM users WHERE name='$user_guess'";
$passhash = $db->querySingle($sql_get_passhash);

//if they are correct, redirect to input page
//if not, redirect to output page
if(password_verify($password_guess, $passhash)){
    session_start();
    $_SESSION['username'] = $user_guess;
    header('Location: ../Input.php');
}
else {
    header('Location: ../Output.php');
}
?>







