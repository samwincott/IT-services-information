<?php

//uncomment these to find errors
//also comment out the header to be able to see the errors
// ini_set('display_errors',1);
// error_reporting(E_ALL);



$service_to_remove = $_POST['remove_service_name'];

//establishing link to database
$db = new SQLite3('testing.db') or die('Unable to open database');

//determining how many services there are
$id = $db->querySingle("SELECT COUNT(*) FROM services");

//finding the id of service to delete
$service_id = $db->querySingle("SELECT id FROM services WHERE name='$service_to_remove'");

//this if statement is here in the case that the url to this script is accesssed
//if this script is not accessed correctly (from the form on the input page) it would create a new status with a blank name
if (isset($_POST['remove_service_name']) && !empty($_POST['remove_service_name'])){
    //if the id of the service to delete isn't the most recent, it creates an error when adding a new service
    if ($service_id == $id) {
        $sql = "DELETE FROM services WHERE name='$service_to_remove'";
        $db->exec($sql);
    }
    else {
        $sql = "DELETE FROM services WHERE name='$service_to_remove'";
        $db->exec($sql);
        $shift_id_sql = "UPDATE services SET id = id-1 WHERE id > '$service_id'";
        $db->exec($shift_id_sql);
    }
}

header('Location: ../Input.php');




?>