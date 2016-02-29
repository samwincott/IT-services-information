<?php

ini_set('display_errors',1);
error_reporting(E_ALL);
session_start();

//establishing link to database
$db = new SQLite3('testing.db') or die('Unable to open database');

//getting all the services
$sql = "SELECT * FROM services";
$result = $db->query($sql);

while($row = $result->fetchArray()){
    $service_id = $row['id'];
    $service_name = $row['name'];
    $service_status = $row['status'];
    $service_description = $row['description'];
    $service_updated = $row['updated'];
    $new_service_name = $_POST['new_name'.$service_id];
    $new_service_status = $_POST['new_status'.$service_id];
    $new_service_description = $_POST['new_description'.$service_id];
    if ($new_service_name != $service_name) {
        //sql update query for name
        //update the date also
        echo $new_service_name;
        echo "<br>";
    }
    if ($new_service_status != $service_status) {
        //sql update query for status
        //update the date also
        echo $new_service_status;
    }
    if ($new_service_description != $service_description) {
        //sql update query for description
        //update the date also
    }
}

?>