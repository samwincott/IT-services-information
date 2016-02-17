<!DOCTYPE = html>
<html>
<head>
	<title>Table</title>
</head>
<body>

<?php

$host = "localhost";
$db_user = "root";
$db_pass = "password";
$db_name = "testing";
$tbl_statuses = "statuses";
$tbl_services = "services";
$edit = False;

//establishing link to database
$link = mysqli_connect($host, $db_user, $db_pass, $db_name);

//checking for valid link to database
if (!$link) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}	

if (basename($_SERVER['PHP_SELF']) == "Input"){
	$edit = True;
}

//determining which services don't have the status "running" and therefore need to be displayed
$rows_to_show = mysqli_query($link, "SELECT * FROM services WHERE status <> 1");
$rows_to_show = mysqli_num_rows($rows_to_show);

//output page table
echo "<table>"; 
echo "<tr>
		<th>Service</th>
			<th>Status</th>
			<th>Description</th>
			<th>Updated</th>
		</tr>";
		//////// this isn't working, probably need to figure it out
    		for ($row=1; $row <= $rows_to_show; $row++) {  
    			$service_name = mysqli_query($link, "SELECT name FROM services WHERE id = '$row'");
    			$service_status = mysqli_query($link, "SELECT name FROM services WHERE id = '$row'");
    			$service_description = mysqli_query($link, "SELECT name FROM services WHERE id = '$row'");
    			$service_updated = mysqli_query($link, "SELECT name FROM services WHERE id = '$row'"); 
        		echo "<tr>";  
        		echo "<td>".$service_name."</td>";
        		echo "<td>".$service_status."</td>";
        		echo "<td>".$service_description."</td>";
        		echo "<td>".$service_updated."</td>"; 
            	echo "</tr>";  
        	}  
echo "</table>";  

?>


</body>
</html>


