<?php
	if(isset($_POST["sendValue"])){
		$command = $_POST["sendValue"];
		
		include("config.php");
		session_start();
		$photo_id = $_SESSION['photo_id'];

		//if command is 1, fav the photo, command is 0, unfav it
		$query = "UPDATE Photos SET is_fav = ".$command." WHERE photo_id = $photo_id";
		mysql_query($query);
	}
?>