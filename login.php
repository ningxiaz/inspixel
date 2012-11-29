<?php
	include("config.php");

	$email = $_POST["login_email"];
	$password = $_POST["login_password"];

	$query = "select * from Users where email = '$email' and password = '$password'";
	$result = mysql_query($query);
	$rows = mysql_num_rows($result);

	if($rows==0){
		session_start();
		$_SESSION['account_error'] = "Sorry, you've entered the wrong email or password.";
		header("location:index.php");
	}
	else{
		$array = mysql_fetch_array($result);
		
		//set the max life time of session to 8 hours
		ini_set(’session.gc_maxlifetime’, 8*60*60);
		session_start();
		$_SESSION['user_id'] = $array['user_id'];
		header("location:my.php");
	}
?>