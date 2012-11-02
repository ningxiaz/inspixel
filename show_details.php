<?php
	session_start();
	$_SESSION['photo_id'] = $_POST['photo_id'];
	header("location: index.php#details");
?>