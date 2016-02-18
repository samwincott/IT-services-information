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

//determining number of possible statuses
$possible_statuses = mysqli_query($link, "SELECT * FROM statuses");
$possible_statuses = mysqli_num_rows($possible_statuses);

//creating an array with the paths of the logo files
$status_logo_paths = mysqli_query($link, "SELECT link FROM statuses WHERE id <> 1");
$status_logo_paths = mysqli_fetch_array($status_logo_paths);

//creating an array with the names of statuses
$status_name = mysqli_query($link, "SELECT name FROM statuses WHERE id <> 1");
$status_name = mysqli_fetch_array($status_name);



//creating an associative array linking the status names and paths to logo files
for ($status=1; $status <= $possible_statuses; $status++){
    $status_arrary=array($status_name[$status]=>$status_logo_paths);
}

//determining which services don't have the status "running" and therefore need to be displayed, "running" has the foreign key of 1 
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
    			$service_name = mysqli_fetch_array(mysqli_query($link, "SELECT name FROM services WHERE id = '$row'"));
    			$service_status = mysqli_fetch_array(mysqli_query($link, "SELECT status FROM services WHERE id = '$row'"));
    			$service_description = mysqli_fetch_array(mysqli_query($link, "SELECT description FROM services WHERE id = '$row'"));
    			$service_updated = mysqli_fetch_array(mysqli_query($link, "SELECT updated FROM services WHERE id = '$row'")); 
        		echo "<tr>";  
        		echo "<td>".$service_name[0]."</td>";
        		echo "<td>".$service_status[0]."</td>";
        		echo "<td>".$service_description[0]."</td>";
        		echo "<td>".$service_updated[0]."</td>"; 
            	echo "</tr>";  
        	}  
echo "</table>";  

//many things to fix here
//the table is now being dynamically generated and displayed correctly, which is good
//however, it's only displaying the first n tables, depending on how many, n, tables aren't in the 'runnning' state, there's no selection being done 
//also the whole using function1(function2($thing)) is probably bad and needs sorting
//as does having to use $service_*[0]

//also, i'm very wary of lines 33-50 that were added in the last commit
//it hasn't been tested at all to see if its doing what i want
//it hasn't given any errors though either so that's a positive sign 

?>


</body>
</html>


