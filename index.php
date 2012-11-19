<?php
 	session_start(); 

 	//If the user has already logged in, redirect to my inspiration page
 	if(isset($_SESSION['user_id'])){
 		header('location:my.php');
 	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="apple-mobile-web-app-capable" content="yes">
 	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="viewport" content="width=device-width, initial-scale=1">  
    
    <title>Inspixel</title>
	
	<link rel="stylesheet" href="css/jquery.mobile-1.2.0.min.css" />

	<link rel="stylesheet" href="css/style.css" />
	<link rel="apple-touch-icon" href="icons/homeScreen_new.png" />
	<link rel="apple-touch-startup-image" href="icons/login_bg_light.png" />
	
	<script src="js/jquery-1.8.2.min.js"></script>
	<script src="js/jquery.mobile-1.2.0.min.js"></script>
	
	<script src="js/index.js"></script>
</head/>
<body>
	<!-- Login Page -->
	<div data-role="page" id="login">
		<div data-role="content">
			<h1>Hi, Welcome to Inspixel!</h1>
			<div data-role="fieldcontain">
				<form action="login.php" method="post" data-ajax="false">
					<label for="email">Email:</label>
					<input type="text" name="login_email" id="login_email">
					<label for="password">Password:</label>
					<input type="password" name="login_password" id="login_password"><br/>
					<input type="submit" value="Login"><br/>
					<a href="new.php">No account yet? Create one!</a>
				</form>
			</div>
		</div>
	</div>
</body>
</html>