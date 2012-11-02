<?php
	include("config.php");
	include("helper.php");

	$email = $_POST["new_email"];
	$password = $_POST["new_password"];

	if(!IsNullOrEmpty($email)&&!IsNullOrEmpty($password)){

		$query = "INSERT into Users (email, password) VALUES ('$email', '$password');";

		if(mysql_query($query)){
			header('location:index.php#my');
		}
		else{
			header('location:index.php#new');
		}
	}
?>