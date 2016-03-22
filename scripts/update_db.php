<?php

//establishing link to database
$db = new SQLite3('testing.db') or die('Unable to open database');

//getting all the services
$get_all_services_sql = "SELECT * FROM services";
$all_services = $db->query($get_all_services_sql);

//getting current date
//example format '18:23 04/-5/16'
$date = date('H:i d')."/".date('m')."/".date('y');

//filling two arrays with information about statuses
//first array will be key(status_id) => name
$get_all_statuses_sql = "SELECT * FROM statuses";
$status_result = $db->query($get_all_statuses_sql);
$status_name_array = array();
while($row = $status_result->fetchArray()){
    $status_name_array[$row['id']] = $row['name'];
}

while($row = $all_services->fetchArray()){
    $service_id = $row['id'];
    $service_name = $row['name'];
    $service_status = $status_name_array[$row['status']];
    $service_description = $row['description'];
    $service_updated = $row['updated'];
    $new_service_name = $_POST['new_name'.$service_id];
    $new_service_status = $_POST['new_status'.$service_id];
    $new_service_description = $_POST['new_description'.$service_id];
    if (isset($_POST['new_status'.$service_id]) && !empty($_POST['new_status'.$service_id])){
        if ($new_service_name != $service_name) {
            $new_name_sql = "UPDATE services SET name='$new_service_name' WHERE id='$service_id'";
            $db->exec($new_name_sql);
        }
        if ($new_service_status != $service_status) {
            $new_service_status = array_search($new_service_status, $status_name_array);
            $new_status_sql = "UPDATE services SET status='$new_service_status', updated='$date' WHERE id='$service_id'";
            $db->exec($new_status_sql);
        }
        if ($new_service_description != $service_description) {
            $new_description_sql = "UPDATE services SET description='$new_service_description', updated='$date' WHERE id='$service_id'";
            $db->exec($new_description_sql);
        }
    }
}

header('Location: ../Input.php');

?>