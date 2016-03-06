<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="scripts/css.css">
</head>
<body>
	<div id="login_box">
		<form class="form-horizontal" action="scripts/check_login.php" method="post">
				Name: <input align="middle" type="text" name="name">
			<br>
			<div id="password_box_align">
				Password: <input align="middle" type="password" name="password">
			</div>	
			<br>
			<input type="submit" value="Submit">
		</form>			
	</div>
</body>
</html>
