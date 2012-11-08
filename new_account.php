<?php
	include("config.php");
	include("helper.php");

	$email = $_POST["new_email"];
	$password = $_POST["new_password"];

	if(!IsNullOrEmpty($email)&&!IsNullOrEmpty($password)){

		$query = "INSERT into Users (email, password) VALUES ('$email', '$password');";

		if(mysql_query($query)){
			$query = "select * from Users where email = '$email' and password = '$password'";
			$result = mysql_query($query);
			$array = mysql_fetch_array($result);
			session_start();
			$_SESSION['user_id'] = $array['user_id'];
			header('location:index.php#my');
		}
		else{
			header('location:index.php#new');
		}
	}
?>