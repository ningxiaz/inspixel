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
	
	<link rel="stylesheet" href="themes/Inspixel.min.css" />
	<link rel="stylesheet" href="http://code.jquery.com/mobile/1.2.0/jquery.mobile.structure-1.2.0.min.css" />

	<link rel="stylesheet" href="css/style.css" />
	<link rel="apple-touch-icon" href="icons/homeScreen_new.png" />
	<link rel="apple-touch-startup-image" href="icons/login_bg_light.png" />
	
	<script src="js/jquery-1.8.2.min.js"></script>
	<script src="js/jquery.mobile-1.2.0.min.js"></script>
	
	<script src="js/index.js"></script>
	<script type="text/javascript">

	  var _gaq = _gaq || [];
	  _gaq.push(['_setAccount', 'UA-36620884-1']);
	  _gaq.push(['_trackPageview']);

	  (function() {
	    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
	    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
	    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
	  })();

	</script>
</head/>
<body>
	<!-- Login Page -->
	<div data-role="page" id="login">
		<div data-role="content" class="account">
			<div class="upperline" id="num1">
			</div>
			<div class="upperline" id="num2">
			</div>
            <div class="upperline" id="num3">
			</div>
			<div class="upperline" id="num4">
			</div>
			<div class="upperline" id="num5">
			</div>

			<h1>Welcome to Inspixel!</h1>
			<p>Get organized and inspired by colors in everyday life</p>
			<div data-role="fieldcontain">
				<form id="login_form" class="account_form" action="login.php" method="post" data-ajax="false">
					<?php
						session_start();
						if(isset($_SESSION['account_error'])){
							echo "<p class=\"account_error\">".$_SESSION['account_error']."</p>";
							$_SESSION['account_error'] = null;
						}
					?>
					<label for="email">Email:</label>
					<input type="text" name="login_email" id="login_email">
					<label for="password">Password:</label>
					<input type="password" name="login_password" id="login_password"><br/>				
					<div class="action_button" id="login_button"><a href="#">Log in</a></div>
					<div class="clear"></div>
					<a href="new.php" id="signup_link">No account yet? Sign up here!</a>
				</form>
			</div>
		</div>
	</div>
</body>
</html>