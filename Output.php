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


//output page table
echo "<table>"; 
echo "<tr>
		<th>Service</th>
			<th>Status</th>
			<th>Description</th>
			<th>Updated</th>
		</tr>";  
while($row = $service_result->fetchArray()){
    $service     = $row['name'];
    $status    = $row['status'];
    $description     = $row['description'];
    $updated = $row['updated'];
    echo "<tr>
    		<td>".$service."</td>
    		<td><img src="."$status_logo_array[$status]"."></td>
    		<td>".$description."</td>
    		<td>".$updated."</td>
    	</tr>";
    echo "<br>";
}
echo "</table>";

echo "<table>";
echo "<tr>";
for ($i=1; $i<=count($status_name_array); $i++){
        echo "<td><img src="."$status_logo_array[$i]"."></td>";
        
}
echo "</tr>";
echo "<tr>";
for ($i=1; $i<=count($status_name_array); $i++){
    echo "<td>"."$status_name_array[$i]"."</td>";
}
echo "</tr>";

echo "</table>";

?>

		<div id="footer">
		<a href="Login.php">Admin Login</a>
		</div>
</body>
</html>


