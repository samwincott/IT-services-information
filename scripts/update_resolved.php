<?php

//uncomment these to find errors
ini_set('display_errors',1);
error_reporting(E_ALL);

//establishing link to database
$db = new SQLite3('/var/www/html/testing/scripts/testing.db') or die('Unable to open database');

//getting all the services
$sql_all_services = "SELECT * FROM services";
$result = $db->query($sql_all_services);

//getting current date
$date = date('h:i d')."/".date('m')."/".date('y');
$format = 'H:i d/m/y';
$date = DateTime::createFromFormat($format, $date);


while($row = $result->fetchArray()){
    $service_id = $row['id'];
    $service_status = $row['status'];
    $service_updated = $row['updated'];
    $service_date = DateTime::createFromFormat($format, $service_updated);
    $interval = date_diff($service_date, $date);
    $interval = (int)$interval->format('%d');
    if ($interval >= 1 && $service_status == '2'){
        $sql_update_resolved = "UPDATE services SET status=1 WHERE id='$service_id'";
        $db->exec($sql_update_resolved);
    }
    echo $interval;
}
?>