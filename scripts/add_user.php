<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="scripts/css.css">
</head>
<body>
        <form class="form-horizontal" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            Name: <input align="middle" type="text" name="new_username">
            <br>
            Password: <input align="middle" type="password" name="password_attempt1">  
            <br>
            Retype password: <input align="middle" type="password" name="password_attempt2">  
            <br>
            <input type="submit" value="Submit">
        </form>         
<?php

ini_set('display_errors',1);
error_reporting(E_ALL);

$new_user = $_POST['new_username'];
$new_password_attempt1 = $_POST['password_attempt1'];
$new_password_attempt2 = $_POST['password_attempt2'];



//establishing link to database
$db = new SQLite3('testing.db') or die('Unable to open database');

//prevent sql injection
$new_user = stripslashes($new_user);
$new_password_attempt1 = stripslashes($new_password_attempt1);
$new_user = SQLite3::escapeString($new_user);
$new_password_attempt1 = SQLite3::escapeString($new_password_attempt1);

$id = $db->querySingle("SELECT COUNT(*) FROM users");
$id = $id + 1;

//if they are correct, redirect to input page
//if not, redirect to output page
if($new_password_attempt1 == $new_password_attempt2){
	$password = password_hash($new_password_attempt1, PASSWORD_DEFAULT);
    $new_user_sql = "INSERT INTO users (id, name, passhash) VALUES ($id, '$new_user', '$password')";
    $db->exec($new_user_sql);	
}

?>

</body>
</html>