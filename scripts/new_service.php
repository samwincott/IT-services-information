<?php

$new_service = $_POST['name'];

//establishing link to database
$db = new SQLite3('testing.db') or die('Unable to open database');

//determining id of new service, depending on how many services there already are
$id = $db->querySingle("SELECT COUNT(*) FROM services");
$id = $id + 1;

//getting current date
$date = date(d)."/".date(m)."/".date(y);

//this is not working
//from a brief look online it is due to permissions
//get mr bailey to look at it
$sql = "INSERT INTO services (id, name, description, updated, status) VALUES ('$id', '$new_service', 'Working', '$date', 1)";
$db->exec($sql);

// header('Location: ../Input.php');		


?>