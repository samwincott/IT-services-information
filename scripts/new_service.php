<?php

$new_status = $_POST['name'];

//establishing link to database
$db = new SQLite3('testing.db') or die('Unable to open database');

//determining id of new service, depending on how many services there already are
$id = $db->querySingle("SELECT COUNT(*) FROM services");
$id = $id + 1;

//getting current date
$date = date(d)."/".date(m)."/".date(y);
echo $date;

$sql = "INSERT INTO services (id, name, description, updated, status) VALUES ($id, '$new_status', 'Working', '$date', 1)";
$db->exec($sql);

$i = SQLite3::lastErrorMsg();


echo $i;

// header('Location: ../Input.php');		


?>