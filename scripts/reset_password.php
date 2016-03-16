<!DOCTYPE html>
<html>
<head>
    <title>Reset Password</title>
    <link rel="stylesheet" type="text/css" href="scripts/css.css">
</head>
<body>
        <form class="form-horizontal" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            Username: <input align="middle" type="text" name="username">
            <br>
            Email: <input align="middle" type="text" name="email">  
            <br>
            <input type="submit" value="Submit">
        </form>         
<?php

ini_set('display_errors',1);
error_reporting(E_ALL);

$username = $_POST['username'];
$email = $_POST['email'];

//establishing link to database
$db = new SQLite3('testing.db') or die('Unable to open database');

//prevent sql injection
$username = stripslashes($username);
$email = stripslashes($email);
$username = SQLite3::escapeString($username);
$email = SQLite3::escapeString($email);

//check if user exists
$sql_check_user_exists = "SELECT * FROM users WHERE name = '$username' AND email = '$email'";
$sql_check_user_exists_result = $db->query($sql_check_user_exists);
$user_exists = count($sql_check_user_exists_result);

//random password generator
$bytes = openssl_random_pseudo_bytes(2);
$new_pwd = bin2hex($bytes);

if ($user_exists == 1){
    mail('wincott97@gmail.com', "Password Reset", "Your new password is ".$new_pwd);
    $new_pwd_hashed = password_hash($new_pwd, PASSWORD_DEFAULT);
    $sql_change_password = "UPDATE users SET passhash = '$new_pwd_hashed' WHERE email = '$email'";
    $db->exec($sql_change_password);
}




?>

</body>
</html>