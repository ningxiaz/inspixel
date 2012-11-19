<?php
	include("config.php");
	include("helper.php");

	session_start();
	$photo_id = $_SESSION['photo_id'];

	$query = "DELETE FROM Photos WHERE photo_id = $photo_id";
	if(mysql_query($query, $link)){
		$query = "DELETE FROM PhotosTags WHERE photo_id = $photo_id";
		if(mysql_query($query, $link)){
			header('location:my.php');
		}
		else{
			session_start();
			$_SESSION['error'] = mysql_error($link);
			header('location:error.php');
		}
	}
	else{
		session_start();
		$_SESSION['error'] = mysql_error($link);
		header('location:error.php');
	}
?>