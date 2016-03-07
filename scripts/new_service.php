<?php

//uncomment these to find errors
//also comment out the header to be able to see the errors
// ini_set('display_errors',1);
// error_reporting(E_ALL);

$new_service = $_POST['name'];

//establishing link to database
$db = new SQLite3('testing.db') or die('Unable to open database');

//determining id of new service, depending on how many services there already are
$id = $db->querySingle("SELECT COUNT(*) FROM services");
$id = $id + 1;

//getting current date
$date = date(d)."/".date(m)."/".date(y);

//this if statement is here in the case that the url to this script is accesssed
//if this script is not accessed correctly (from the form on the input page) it would create a new service with a blank name
if (isset($_POST['name']) && !empty($_POST['name'])){
    $sql = "INSERT INTO services (id, name, description, updated, status) VALUES ('$id', '$new_service', 'Working', '$date', 1)";
    $db->exec($sql);
}   

header('Location: ../Input.php');       
?>