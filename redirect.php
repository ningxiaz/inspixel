<?php
	session_start();

	//if the user hasn't logged in yet, redirect to log in page
	if(!isset($_SESSION['user_id'])){
 		header('location:index.php');
 	}
?>