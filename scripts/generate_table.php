<!DOCTYPE = html>
<html>
<head>
	<title>Table</title>
</head>
<body>

<?php

//establishing link to database
$db = new SQLite3('testing.db') or die('Unable to open database');

$sql = "SELECT * FROM services WHERE status <> 1";
$result = $db->query($sql);

//output page table
echo "<table>"; 
echo "<tr>
		<th>Service</th>
			<th>Status</th>
			<th>Description</th>
			<th>Updated</th>
		</tr>";  
while($row = $result->fetchArray()){
    $service     = $row['name'];
    $status    = $row['status'];
    $description     = $row['description'];
    $updated = $row['updated'];
    echo "<tr><td>".$service."</td><td>".$status."</td><td>".$description."</td><td>".$updated."</td></tr><br>";
}
echo "</table>";

?>


</body>
</html>


