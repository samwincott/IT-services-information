<!DOCTYPE = html>

<html>
<head>
    <link rel="stylesheet" type="text/css" href="scripts/css.css">
<<<<<<< HEAD
    <title>Change Password</title>
=======
    <title>Add/Remove Service</title>
>>>>>>> 366e1540c9674b658b166f2f2dab7590ca57dfea
</head>
<body>

<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("location: Output.php");
}
?>

<div id="form_boxes">
<<<<<<< HEAD
    <form action='scripts/change_password_script.php' method='post'>
=======
    <form id="---" action='scripts/change_password_script.php' method='post'>
>>>>>>> 366e1540c9674b658b166f2f2dab7590ca57dfea
        Name: <input type='text' name='username'>
        <br>
        Current password: <input type='password' name='current_password'>
        <br>
        New password: <input type='password' name='new_password1'>
        <br>
        Retype new password: <input type='password' name='new_password2'>
        <br>

        <input type='submit' value='Submit'>
    </form>
</div>    

</body>
</html>
