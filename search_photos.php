<?php
	if(isset($_POST["sendValue"])){
		$search_query = $_POST["sendValue"];

		include("config.php");
		session_start();
		$user_id = $_SESSION['user_id'];

		$returnValue = "";

		if($search_query === ""){
			$tag_query = "SELECT * FROM Tags, Photos, PhotosTags WHERE Photos.user_id = $user_id AND Photos.photo_id = PhotosTags.photo_id AND PhotosTags.tag_id = Tags.tag_id";
		}
		else{
			$tag_query = "SELECT * FROM Tags, Photos, PhotosTags WHERE Tags.name LIKE '%$search_query%' AND Photos.user_id = $user_id AND Photos.photo_id = PhotosTags.photo_id AND PhotosTags.tag_id = Tags.tag_id";
		}


		if($result = mysql_query($tag_query, $link)){
			while($row = mysql_fetch_array($result)){
				$returnValue = $returnValue . "<div class=\"tag_group\"><p><span>#".$row['name']."</span></p>";
				$photo_query = "SELECT Photos.photo_id, save_path FROM Photos, PhotosTags WHERE Photos.user_id = $user_id AND Photos.photo_id = PhotosTags.photo_id AND PhotosTags.tag_id = ".$row['tag_id'];
				if($photo_result = mysql_query($photo_query)){
					while($photo_row = mysql_fetch_array($photo_result)){
						$returnValue = $returnValue . "<div class=\"thumbnail\"><img src=\"".$photo_row['save_path']."\" alt=\"".$photo_row['photo_id']."\"/></div>";
					}
				}
				$returnValue = $returnValue . "<div class=\"clear\"></div></div>";
			}
			echo json_encode(array("returnValue"=>$returnValue));
		}
		else{
			session_start();
			$_SESSION['error'] = mysql_error($link);
			header('location:error.php');
		}
	}
?>