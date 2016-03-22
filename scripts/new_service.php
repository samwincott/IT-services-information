<?php

$new_service_name = $_POST['new_service_name'];

//establishing link to database
$db = new SQLite3('testing.db') or die('Unable to open database');

//determining id of new service, depending on how many services there already are
$current_max_id = $db->querySingle("SELECT COUNT(*) FROM services");
$new_id = $current_max_id + 1;

//getting current date
//example format '18:23 04/05/16'
$current_date = date('H:i d')."/".date('m')."/".date('y');

//updating the database
if (isset($_POST['new_service_name']) && !empty($_POST['new_service_name'])){
    $sql = "INSERT INTO services (id, name, description, updated, status) VALUES ('$new_id', '$new_service_name', 'Working', '$current_date', 1)";
    $db->exec($sql);
}   

//once completed, redirect to input page
header('Location: ../Input.php');       
?>