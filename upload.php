<?php
	if(isset($_FILES["file"])){
		$tokens = explode('.', $_FILES["file"]["name"]);
		$noextension = $tokens[0];
		$extension = $tokens[1];
		$filename =  $noextension . time() . "." .$extension;
		if(move_uploaded_file($_FILES["file"]["tmp_name"], "photos/" . $filename)){
			session_start();
			$_SESSION['photo_name'] = $filename;
			header("location: index.php#add");
		}
	}
?>