<!DOCTYPE = html>

<html>
<head>
    <link rel="stylesheet" type="text/css" href="scripts/css.css">
    <title>Add/Remove Status</title>
</head>
<body>
<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("location: Output.php");
}
?>

<div id="form_boxes">
    <form id="---" action='scripts/new_status.php' method='post' enctype='multipart/form-data'>
        Name of new status: <input type='text' name='new_status_name'>
        <br>
        Logo for new status: <input type='file' name='new_status_logo'>
        <br>   
        <input type='submit' value='Submit' name='submit'>
    </form>

    <form id="---" action='scripts/remove_status.php' method='post'>
        Remove status: <input type='text' name='remove_status_name'>
        <br>
        <input type='submit' value='Submit'>
    </form>
</div>
</body>
</html>