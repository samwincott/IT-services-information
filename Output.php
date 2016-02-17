<!DOCTYPE = html>

<html>
<head>
		<link rel="stylesheet" type="text/css" href="scripts/css.css">
</head>
<body>
		<?php

		//	$db = new mysqli('localhost', 'user', 'pass', 'demo');

			if($db->connect_errno > 0){
    			die('Unable to connect to database [' . $db->connect_error . ']');
			}

			//Query the database then fill an array with showable services
			//For num(services) display in table
			//Another query will need to be made finding the service info

		?>
		//lets see if this is working
		<div id="footer">
		<a href="Login.php">Admin Login</a>
		</div>
</body>
</html>


