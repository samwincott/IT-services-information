<!DOCTYPE = html>

<html>
<head>
    <link rel="stylesheet" type="text/css" href="scripts/css.css">
    <title>Add/Remove Status</title>
</head>
<body>
<<<<<<< HEAD

=======
>>>>>>> 366e1540c9674b658b166f2f2dab7590ca57dfea
<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("location: Output.php");
}
?>

<div id="form_boxes">
<<<<<<< HEAD
    <form action='scripts/new_status.php' method='post' enctype='multipart/form-data'>
=======
    <form id="---" action='scripts/new_status.php' method='post' enctype='multipart/form-data'>
>>>>>>> 366e1540c9674b658b166f2f2dab7590ca57dfea
        Name of new status: <input type='text' name='new_status_name'>
        <br>
        Logo for new status: <input type='file' name='new_status_logo'>
        <br>   
        <input type='submit' value='Submit' name='submit'>
    </form>

<<<<<<< HEAD
    <form action='scripts/remove_status.php' method='post'>
=======
    <form id="---" action='scripts/remove_status.php' method='post'>
>>>>>>> 366e1540c9674b658b166f2f2dab7590ca57dfea
        Remove status: <input type='text' name='remove_status_name'>
        <br>
        <input type='submit' value='Submit'>
    </form>
</div>
</body>
</html>