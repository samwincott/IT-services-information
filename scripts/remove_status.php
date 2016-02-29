<?php

//uncomment these to find errors
//also comment out the header to be able to see the errors
// ini_set('display_errors',1);
// error_reporting(E_ALL);




$status_to_remove = $_POST['name'];

//establishing link to database
$db = new SQLite3('testing.db') or die('Unable to open database');

//determining how many statuses there are
$id = $db->querySingle("SELECT COUNT(*) FROM statuses");

//finding the id of status to delete
$status_id = $db->querySingle("SELECT id FROM statuses WHERE name='$status_to_remove'");

//this if statement is here in the case that the url to this script is accesssed
//if this script is not accessed correctly (from the form on the input page) it would create a new status with a blank name
if (isset($_POST['name']) && !empty($_POST['name'])){
	if ($status_id == $id ){
		$sql = "DELETE FROM statuses WHERE name='$status_to_remove'";
		$db->exec($sql);
	}
	else {
		$sql = "DELETE FROM statuses WHERE name='$status_to_remove'";
		$db->exec($sql);
		$shift_id_sql = "UPDATE statuses SET id = id - 1 WHERE id > '$status_id'";
		$db->exec($shift_id_sql);
	}
}

header('Location: ../Input.php');

?>