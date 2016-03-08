<!DOCTYPE = html>

<html>
<head>
        <link rel="stylesheet" type="text/css" href="scripts/css.css">
</head>
<body>
<?php

//establishing link to database
$db = new SQLite3('scripts/testing.db') or die('Unable to open database');

//determining which services to show
$service_sql = "SELECT * FROM services WHERE status <> 1";
$service_result = $db->query($service_sql);

//filling two arrays with information about statuses
//first array will be key(status_id) => path_to_logo
//first array will be key(status_id) => name
$status_sql = "SELECT * FROM statuses WHERE id <> 1";
$status_result = $db->query($status_sql);
$status_logo_array = array();
while($row = $status_result->fetchArray()){
    $status_logo_array[$row['id']] = $row['link'];
}
$status_name_array = array();
while($row = $status_result->fetchArray()){
    $status_name_array[$row['id']] = $row['name'];
}

if ($db->querySingle("SELECT COUNT(*) FROM services WHERE status <> 1") != 0){
    //output page table
    echo "<table id='input_table'>
            <tr>
                <th>Service</th>
                <th>Status</th>
                <th>Description</th>
                <th>Updated</th>
            </tr>";         
    while($row = $service_result->fetchArray()){
        $service = $row['name'];
        $status = $row['status'];
        $status = str_replace(' ', '', $status);
        $description = $row['description'];
        $updated = $row['updated'];
        echo "<tr>
                <td>".$service."</td>
                <td><img src="."$status_logo_array[$status]"."></td>
                <td>".$description."</td>
                <td>".$updated."</td>
            </tr>";
    }
    echo "</table>";

    //generating key for logos
    echo "<table id='input_table'>
            <tr>";
    for ($i=1; $i<=count($status_name_array) + 1; $i++){
            echo "<th><img src="."$status_logo_array[$i]"."></th>";
            
    }
    echo "</tr>
          <tr>";
    for ($i=1; $i<=count($status_name_array) + 1; $i++){
        echo "<td>"."$status_name_array[$i]"."</td>";
    }
    echo "</tr>
        </table>";
}
else{
    echo "<p>All services are functioning correctly</p>";
} 


?>
<div id="input_table">
    <a href="Login.php">Admin Login</a>
</div>
</body>
</html>


