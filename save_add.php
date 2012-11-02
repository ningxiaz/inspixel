<?php
	include("config.php");
	include("helper.php");

	session_start();
	$save_path = "photos/" . $_SESSION['photo_name'];
	$user_id = $_SESSION['user_id'];
	$tag_string = $_POST['tag'];
	$color_1 = $_POST['color_1'];
	$color_2 = $_POST['color_2'];
	$color_3 = $_POST['color_3'];
	$color_4 = $_POST['color_4'];
	$lat = $_POST['lat'];
	$lng = $_POST['lng'];

	$palette_query = "SELECT * FROM Palettes where color_1 = '$color_1' AND color_2 = '$color_2' AND color_3 = '$color_3' AND color_4 = '$color_4'";
	$result = mysql_query($palette_query);
	
	//if the palette already exists
	if(mysql_num_rows($result)!=0){
		$array = mysql_fetch_array($result);
		$palette_id = $array['palette_id'];
	}
	//new palette
	else{
		$palette_query = "INSERT INTO Palettes (color_1, color_2, color_3, color_4) VALUES ('$color_1', '$color_2', '$color_3', '$color_4')";
		if(mysql_query($palette_query, $link)){
			$palette_query = "SELECT * FROM Palettes where color_1 = '$color_1' AND color_2 = '$color_2' AND color_3 = '$color_3' AND color_4 = '$color_4'";
			$result = mysql_query($palette_query);
			$array = mysql_fetch_array($result);
			$palette_id = $array['palette_id'];
		}
		else{
			echo mysql_error($link);
		}
	}

	$photo_query = "INSERT INTO Photos (save_path, palette_id, user_id, geolat, geolng, is_fav, frequency) VALUES ('$save_path', $palette_id, $user_id, $lat, $lng, 0, 0)";
	
	if(mysql_query($photo_query, $link)){
			$photo_query = "SELECT * FROM Photos where save_path = '$save_path' and user_id = $user_id";
			$result = mysql_query($photo_query);
			$array = mysql_fetch_array($result);
			$photo_id = $array['photo_id'];

			//process the tags
			if(!IsNullOrEmpty($tag_string)){
				$tags = explode(",", $tag_string);
				$tag_query = "";
				for($i = 0; $i < count($tags); $i++){
					$tag = trim($tags[$i]);//remove spaces

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

			header('location:index.php#my');
	}
	else{
		echo mysql_error($link);
	}

?>