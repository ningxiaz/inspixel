<?php
	include("config.php");
	include("helper.php");

	session_start();
	$photo_id = $_SESSION['photo_id'];

	$query = "DELETE FROM Photos WHERE photo_id = $photo_id";
	if(mysql_query($query, $link)){
		$query = "DELETE FROM PhotosTags WHERE photo_id = $photo_id";
		if(mysql_query($query, $link)){
			header('location:index.php#my');
		}
		else{
			echo mysql_error($link);
		}
	}
	else{
		echo mysql_error($link);
	}
?>