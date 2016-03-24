<!DOCTYPE = html>

<html>
<head>
    <link rel="stylesheet" type="text/css" href="scripts/css.css">
    <title>Add/Remove Service</title>
</head>
<body>

<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("location: Output.php");
}
?>


<form id="---" action='scripts/change_password_script.php' method='post'>
    Name: <input type='text' name='username'>
    <br>
    Current password: <input type='text' name='current_password'>
    <br>
    New password: <input type='text' name='new_password1'>
    <br>
    Retype new password: <input type='text' name='new_password2'>
    <br>

    <input type='submit' value='Submit'>
</form>

</body>
</html>
