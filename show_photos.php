<?php
	if(isset($_POST["sendValue"])){
		$cat = $_POST["sendValue"];

		include("config.php");
		session_start();
		$user_id = $_SESSION['user_id'];

		//show all photos
		if($cat<0){
			$query = "SELECT photo_id, save_path, color_1, color_2, color_3, color_4, color_5 FROM Photos, Palettes WHERE Photos.user_id = $user_id AND Photos.palette_id = Palettes.palette_id ORDER BY Photos.ts DESC";
		}
		//show photos based on color catogory
		else if($cat<8){
			$query = "SELECT photo_id, save_path, color_1, color_2, color_3, color_4, color_5 FROM Photos, Palettes WHERE Photos.user_id = $user_id AND Photos.palette_id = Palettes.palette_id AND Photos.category = $cat ORDER BY Photos.ts DESC";
		}

		//show fav photos
		else if($cat==8){
			$query = "SELECT photo_id, save_path, color_1, color_2, color_3, color_4, color_5 FROM Photos, Palettes WHERE Photos.user_id = $user_id AND Photos.palette_id = Palettes.palette_id AND Photos.is_fav = 1 ORDER BY Photos.ts DESC";
		}

		$returnValue = "";
		if($result = mysql_query($query, $link)){
			while($row = mysql_fetch_array($result)){
				$returnValue = $returnValue . "<div class=\"photo_list_item\">
							<img src=\"".$row['save_path']."\" alt=\"".$row['photo_id']."\" class=\"photo\"/>
						  <div class=\"palette\">
						  	<div class=\"swatch\" style=\"background-color: rgb(".$row['color_1'].");\"></div>
						  	<div class=\"swatch\" style=\"background-color: rgb(".$row['color_2'].");\"></div>
						  	<div class=\"swatch\" style=\"background-color: rgb(".$row['color_3'].");\"></div>
						  	<div class=\"swatch\" style=\"background-color: rgb(".$row['color_4'].");\"></div>
						  	<div class=\"swatch\" style=\"background-color: rgb(".$row['color_5'].");\"></div>
						  </div>
					  </div>";
			}

			echo json_encode(array("returnValue"=>$returnValue));
		}
		else{
			echo $query;
			echo mysql_error($link);
		}
	}
?>