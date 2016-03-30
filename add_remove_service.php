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

<div id="form_boxes">
	<form id="---" action='scripts/new_service.php' method='post'>
	    Name of new service: <input type='text' name='new_service_name'>
	    <br>
	    <input type='submit' value='Submit'>
	</form>

	<form id="---" action='scripts/remove_service.php' method='post'>
	    Remove service: <input type='text' name='remove_service_name'>
	    <br>
	    <input type='submit' value='Submit'>
	</form>
</div>	

</body>
</html>