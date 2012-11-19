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

			//set the max life time of session to 8 hours
			ini_set(’session.gc_maxlifetime’, 8*60*60);
			session_start();
			$_SESSION['user_id'] = $array['user_id'];
			header('location:my.php');
		}
		else{
			header('location:new.php');
		}
	}
?>