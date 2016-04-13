<?php
//establishing link to database


//getting all the services
$sql_all_services = "SELECT * FROM services";
$result = $db->query($sql_all_services);

//getting current date in datetime format
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
}
?>