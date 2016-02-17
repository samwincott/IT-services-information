<!DOCTYPE = html>

<html>
	<head>
		<link rel="stylesheet" type="text/css" href="scripts/css.css">
	</head>

	<body>
	<?php
		//connecting to database
		$host = "localhost";
		$db_user = "root";
		$db_pass = "password";
		$db_name = "testing";
		$link = mysqli_connect($host, $db_user, $db_pass, $db_name);

		//checking for valid link to database
		if (!$link) {
    		echo "Error: Unable to connect to MySQL." . PHP_EOL;
    		echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
   			echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    		exit;
		}
		
		//creating secure session
		session_start();
		if (!isset($_SESSION['username'])) {
			header("location: Output.php");
		}


		//getting image
		$image = mysqli_query($link, "SELECT link FROM statuses WHERE name='Resolved'")
	?>


	<!--<img src="logos/resolved.jpg" />-->
	<div id="footer">
		<a href="scripts/logout.php">Logout</a>
	</div>

	</body>
</html>