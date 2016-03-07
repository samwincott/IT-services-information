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
$sql_all_services = "SELECT * FROM services";
$sql_result_all_services = $db->query($sql_all_services);

//filling two arrays with information about statuses
//first array will be key(status_id) => path_to_logo
//first array will be key(status_id) => name
$sql_all_statuses = "SELECT * FROM statuses";
$sql_result_all_statuses = $db->query($sql_all_statuses);
$status_logo_array = array();
while($row = $sql_result_all_statuses->fetchArray()){
    $status_logo_array[$row['id']] = $row['link'];
}
$status_name_array = array();
while($row = $sql_result_all_statuses->fetchArray()){
    $status_name_array[$row['id']] = $row['name'];
}

//dynamically generating the input table
echo "<form method='post' action='scripts/update_db.php'>
        <input type='submit' value='Submit' name='submit'>
        <table id='input_table'> 
            <tr>
                <th>Service</th>
                <th>Status</th>
                <th>Description</th>
                <th>Updated</th>
            </tr>";          
while($row = $sql_result_all_services->fetchArray()){
    //set of variables with information about services
    $service_id = $row['id'];
    $service_name = $row['name'];
    $service_status = $row['status'];
    $service_description = $row['description'];
    $service_updated = $row['updated'];
    //set of new variables, in the case of updated values
    //they are set to the current values of the corresponding variable, so if they are not changed the if statement in 'scripts/update_db.php' won't notice
    $new_service_name = $service_name;
    $new_service_status = $service_status;
    $new_service_description = $service_description;
        echo "<tr>
                <td><input type='text' value='".$service_name."' name='new_name".$service_id."'></td>
                <td>";
                    //the drop down menu has to be dynamically generated, in the case that 
                    //more statuses are added in the future
                    echo "<select name='new_status".$service_id."'";
                    for($i = 0; $i <= count($status_name_array); $i++){
                            //if condition is making sure that the status for the row is pre-selected
                            if ($status_name_array[$i] == $status_name_array[$service_status]){
                                echo "<option value='$status_name_array[$i]' selected>"."$status_name_array[$service_status]"."</option>";
                            }
                            else{
                                echo "<option>"."$status_name_array[$i]"."</option>";
                            }
                    }
                    echo "</select> 
                </td>
                <td><input type='text' value='".$service_description."' name='new_description".$service_id."'></td>
                <td>".$service_updated."</td>
            </tr>";       
}
echo " </table>
    </form>";  

/* still to do:
-sort out imagick
-any extra marks for sorting the ouput list in order of status serverity? 
-css for everything
*/

?>


<form id="new_remove_forms" action='scripts/new_service.php' method='post'>
    Name of new service: <input type='text' name='name'>
    <br>
    <input type='submit' value='Submit'>
</form>

<form class="new_remove_forms" action='scripts/remove_service.php' method='post'>
    Remove service: <input type='text' name='name'>
    <br>
    <input type='submit' value='Submit'>
</form>



<form id="new_remove_forms" action='scripts/new_status.php' method='post' enctype='multipart/form-data'>
    Name of new status: <input type='text' name='name'>
    <br>
    Logo for new status: <input type='file' name='logo' id='logo'>
    <br>   
    <input type='submit' value='Submit' name='submit'>
</form>

<form id="new_remove_forms" action='scripts/remove_status.php' method='post'>
    Remove status: <input type='text' name='name'>
    <br>
    <input type='submit' value='Submit'>
</form>

<div id="center_footer">
    <a href="scripts/logout.php">Logout</a>
</div>
</body>
</html>