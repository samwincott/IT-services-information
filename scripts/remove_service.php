<?php

$service_to_remove = $_POST['remove_service_name'];

//establishing link to database
$db = new SQLite3('info.db') or die('Unable to open database');

//determining how many services there are
$current_no_of_services = $db->querySingle("SELECT COUNT(*) FROM services");

$service_id = $db->querySingle("SELECT id FROM services WHERE name='$service_to_remove'");

if (isset($_POST['remove_service_name']) && !empty($_POST['remove_service_name'])){
    //if the id of the service to delete isn't the most recent, it creates an error when adding a new service
    if ($service_id == $current_no_of_services) {
        $delete_service_sql = "DELETE FROM services WHERE name='$service_to_remove'";
        $db->exec($delete_service_sql);
    }
    else {
        $delete_service_sql = "DELETE FROM services WHERE name='$service_to_remove'";
        $db->exec($delete_service_sql);
        $shift_id_sql = "UPDATE services SET id = id-1 WHERE id > '$service_id'";
        $db->exec($shift_id_sql);
    }
}

//redirect once complete
header('Location: ../Input.php');

?>