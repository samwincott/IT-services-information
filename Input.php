<!DOCTYPE = html>

<html>
<head>
	<link rel="stylesheet" type="text/css" href="scripts/css.css">
</head>
<body>
<?php
//creating secure session
session_start();
if (!isset($_SESSION['username'])) {
	header("location: Output.php");
}

//establishing link to database
$db = new SQLite3('scripts/testing.db') or die('Unable to open database');

//getting all the services
$sql = "SELECT * FROM services";
$result = $db->query($sql);

//filling two arrays with information about statuses
//first array will be key(status_id) => path_to_logo
//first array will be key(status_id) => name
$status_sql = "SELECT * FROM statuses";
$status_result = $db->query($status_sql);
$status_logo_array = array();
while($row = $status_result->fetchArray()){
    $status_logo_array[$row['id']] = $row['link'];
}
$status_name_array = array();
while($row = $status_result->fetchArray()){
    $status_name_array[$row['id']] = $row['name'];
}

// $status_array[$status]

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
    echo "<tr>
    		<td><input type='text' value="."$service"."></td>
    		<td>";
                //the drop down menu has to be dynamically generated, in the case that 
                //more statuses are added in the future
                echo "<select>";
                for($i = 1; $i <= count($status_name_array); $i++){
                        //if condition is making sure that the status for the row is pre-selected
                        if ($status_name_array[$i] == $status_name_array[$status]){
                            echo "<option value="."$status_name_array[$i]"." selected>"."$status_name_array[$i]"."</option>";
                        }
                        else{
                            echo "<option value="."$status_name_array[$i]".">"."$status_name_array[$i]"."</option>";
                        }
        
                }
                echo "</select> 
            </td>
    		<td><input type='text' value="."$description"."></td>
    		<td>".$updated."</td>
    	</tr>";
    echo "<br>";
}
echo "</table>";

?>
<div id="footer">
	<a href="scripts/logout.php">Logout</a>
</div>
</body>
</html>