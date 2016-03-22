<?php

$status_to_remove = $_POST['remove_status_name'];
$target_dir = "../logos/";
$target_file = $target_dir . $status_to_remove . '*';

//establishing link to database
$db = new SQLite3('testing.db') or die('Unable to open database');

//determining how many statuses there are
$number_of_statuses = $db->querySingle("SELECT COUNT(*) FROM statuses");

//finding the id of status to delete
$status_id = $db->querySingle("SELECT id FROM statuses WHERE name='$status_to_remove'");

if (isset($_POST['remove_status_name']) && !empty($_POST['remove_status_name'])){
    if ($status_id == $number_of_statuses ){
        $sql = "DELETE FROM statuses WHERE name='$status_to_remove'";
        $db->exec($sql);
        unlink($target_file);
    }
    else {
        $sql = "DELETE FROM statuses WHERE name='$status_to_remove'";
        $db->exec($sql);
        $shift_id_sql = "UPDATE statuses SET id = id - 1 WHERE id > '$status_id'";
        $db->exec($shift_id_sql);
        unlink($target_file);
    }
}

header('Location: ../Input.php');

?>