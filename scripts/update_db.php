<?php

//uncomment these to find errors
//also comment out the header to be able to see the errors
// ini_set('display_errors',1);
// error_reporting(E_ALL);

//establishing link to database
$db = new SQLite3('testing.db') or die('Unable to open database');

//getting all the services
$sql = "SELECT * FROM services";
$result = $db->query($sql);

//getting current date
$date = date('h:i d')."/".date('m')."/".date('y');

//filling two arrays with information about statuses
//first array will be key(status_id) => name
$status_sql = "SELECT * FROM statuses";
$status_result = $db->query($status_sql);
$status_name_array = array();
while($row = $status_result->fetchArray()){
    $status_name_array[$row['id']] = $row['name'];
}

while($row = $result->fetchArray()){
    $service_id = $row['id'];
    $service_name = $row['name'];
    $service_status = $status_name_array[$row['status']];
    $service_description = $row['description'];
    $service_updated = $row['updated'];
    $new_service_name = $_POST['new_name'.$service_id];
    $new_service_status = $_POST['new_status'.$service_id];
    $new_service_description = $_POST['new_description'.$service_id];
    //this if statement is here in the case that the url to this script is accesssed
    //if this script is not accessed correctly (from the form on the input page) it would create a new status with a blank name
    if (isset($_POST['new_name'.$service_id]) && !empty($_POST['new_name'.$service_id])){
        if ($new_service_name != $service_name) {
            //sql update query for name
            //update the date also
            $new_name_sql = "UPDATE services SET name='$new_service_name' WHERE id='$service_id'";
            $db->exec($new_name_sql);
        }
        if ($new_service_status != $service_status) {
            //sql update query for status
            //update the date also
            $new_service_status = array_search($new_service_status, $status_name_array);
            $new_status_sql = "UPDATE services SET status='$new_service_status', updated='$date' WHERE id='$service_id'";
            $db->exec($new_status_sql);
        }
        if ($new_service_description != $service_description) {
            //sql update query for description
            //update the date also
            $new_description_sql = "UPDATE services SET description='$new_service_description', updated='$date' WHERE id='$service_id'";
            $db->exec($new_description_sql);
        }
    }
}

header('Location: ../Input.php');

?>