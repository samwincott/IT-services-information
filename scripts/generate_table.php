<!DOCTYPE = html>
<html>
<head>
	<title>Table</title>
</head>
<body>

<?php

//establishing link to database
$db = new SQLite3('testing.db') or die('Unable to open database');
	
//output page table
echo "<table>"; 
echo "<tr>
		<th>Service</th>
			<th>Status</th>
			<th>Description</th>
			<th>Updated</th>
		</tr>";
		//////// this isn't working, probably need to figure it out
    		for ($row=1; $row <= $num_rows_to_show; $row++) {  
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


?>


</body>
</html>


