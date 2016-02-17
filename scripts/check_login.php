<?php


$host = "localhost";
$db_user = "root";
$db_pass = "password";
$user_guess = $_POST['name'];
$password_guess = $_POST['password'];
$db_name = "testing";
$tbl_name = "users";

//establishing link to database
$link = mysqli_connect($host, $db_user, $db_pass, $db_name);

//checking for valid link to database
if (!$link) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}

//prevent sql injection
$user_guess = stripslashes($user_guess);
$password_guess = stripslashes($password_guess);
$user_guess = mysqli_real_escape_string($link, $user_guess);
$password_guess = mysqli_real_escape_string($link, $password_guess);
$sql="SELECT * FROM $tbl_name WHERE name='$user_guess' and passhash='$password_guess'";
$result=mysqli_query($link, $sql);
$count=mysqli_num_rows($result);

if($count==1){
	session_start();
	$_SESSION['username'] = $user_guess;
	header('Location: ../Input.php');
}
else {
	header('Location: ../Output.php');
}
?>








