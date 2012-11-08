<?php
	include("config.php");
	include("helper.php");

	session_start();
	$photo_id = $_SESSION['photo_id'];
	$tag_string = $_POST['tag'];

	//first remove the original tags
	$query = "DELETE FROM PhotosTags WHERE photo_id = $photo_id";
	mysql_query($query);

	//then add new tags
	if(!IsNullOrEmpty($tag_string)){
				$tags = explode(",", $tag_string);
				$tag_query = "";
				for($i = 0; $i < count($tags); $i++){
					$tag = trim($tags[$i]);//remove spaces

					if(IsNullOrEmpty($tag)){
						continue;
					}

					$tag_query = "SELECT * FROM Tags WHERE name = '$tag'";
					$result = mysql_query($tag_query);

					//if tag exists
					if(mysql_num_rows($result)!=0){
						$array = mysql_fetch_array($result);
						$tag_id = $array['tag_id'];
						$tag_query = "INSERT INTO PhotosTags VALUES ($photo_id, $tag_id)";
						if(!mysql_query($tag_query, $link)){
							echo mysql_error($link);
						}
					}
					//new tag
					else{
						$tag_query = "INSERT INTO Tags (name) VALUES ('$tag')";
						if(!mysql_query($tag_query, $link)){
							echo mysql_error($link);
						}
						$tag_query = "SELECT * FROM Tags WHERE name = '$tag'";
						$result = mysql_query($tag_query);
						$array = mysql_fetch_array($result);
						$tag_id = $array['tag_id'];
						$tag_query = "INSERT INTO PhotosTags VALUES ($photo_id, $tag_id)";
						if(!mysql_query($tag_query, $link)){
							echo mysql_error($link);
						}
					}
				}
			}

		header('location:index.php#details');

?>