<?php
	include("config.php");

	$email = $_POST["login_email"];
	$password = $_POST["login_password"];

	$query = "select * from Users where email = '$email' and password = '$password'";
	$result = mysql_query($query);
	$rows = mysql_num_rows($result);

	if($rows==0){
		header("location:index.php#login");
	}
	else{
		$array = mysql_fetch_array($result);
		session_start();
		$_SESSION['user_id'] = $array['user_id'];
		header("location:index.php#my");
	}
?>