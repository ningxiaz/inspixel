<?php
	include("config.php");
	include("helper.php");

	$email = $_POST["new_email"];
	$password = $_POST["new_password"];

	if(checkEmail($email)&&!IsNullOrEmpty($password)){
		//see whether the email has already registered
		$query = "SELECT * from Users WHERE email = '$email'";
		$result = mysql_query($query);

		//if not, register new user
		if(mysql_num_rows($result) == 0){
			$query = "INSERT into Users (email, password) VALUES ('$email', '$password');";

			if(mysql_query($query, $link)){
				$query = "select * from Users where email = '$email' and password = '$password'";
				$result = mysql_query($query);
				$array = mysql_fetch_array($result);

				//set the max life time of session to 8 hours
				ini_set(’session.gc_maxlifetime’, 8*60*60);
				session_start();
				$_SESSION['user_id'] = $array['user_id'];
				header('location:my_b.php');
			}
			else{
				session_start();
				$_SESSION['error'] = mysql_error($link);
				header('location:error.php');
			}
		}
		else{
			session_start();
			$_SESSION['account_error'] = "Oops, looks like the email has already been registered.";
			header('location:new.php');
		}	
	}
	else{
		session_start();
		$_SESSION['account_error'] = "Hmm, that doesn't look like a valid email address.";
		header('location:new.php');
	}
?>