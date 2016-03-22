<?php

$service_to_remove = $_POST['remove_service_name'];

//establishing link to database
$db = new SQLite3('testing.db') or die('Unable to open database');

//determining how many services there are
$id = $db->querySingle("SELECT COUNT(*) FROM services");

$service_id = $db->querySingle("SELECT id FROM services WHERE name='$service_to_remove'");

if (isset($_POST['remove_service_name']) && !empty($_POST['remove_service_name'])){
    //if the id of the service to delete isn't the most recent, it creates an error when adding a new service
    if ($service_id == $id) {
        $sql = "DELETE FROM services WHERE name='$service_to_remove'";
        $db->exec($sql);
    }
    else {
        $sql = "DELETE FROM services WHERE name='$service_to_remove'";
        $db->exec($sql);
        $shift_id_sql = "UPDATE services SET id = id-1 WHERE id > '$service_id'";
        $db->exec($shift_id_sql);
    }
}

header('Location: ../Input.php');

?>