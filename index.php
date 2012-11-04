<?php session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="apple-mobile-web-app-capable" content="yes">
 	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="viewport" content="width=device-width, initial-scale=1">  
    
    <title>Inspixel</title>
	
	<link rel="stylesheet" href="css/jquery.mobile-1.2.0.min.css" />
	<link href="css/verticalSlider.css" rel="stylesheet" type="text/css" />

	<link rel="stylesheet" href="css/style.css" />
	<link rel="apple-touch-icon" href="icons/homeScreen_new.png" />
	<link rel="apple-touch-startup-image" href="icons/login_bg_light.png" />
	
	<script src="js/jquery-1.8.2.min.js"></script>
	<script src="js/jquery.mobile-1.2.0.min.js"></script>
	<script src="js/verticalSlider.js"></script>
	<script src="js/index.js"></script>
</head/>
<body>
	<!-- Login Page -->
	<div data-role="page" id="login">
		<div data-role="content">
			<h1>Hi, Welcome to Inspixel!</h1>
			<div data-role="fieldcontain">
				<form action="login.php" method="post" data-ajax="false">
					<label for="email">Email:</label>
					<input type="text" name="login_email" id="login_email">
					<label for="password">Password:</label>
					<input type="password" name="login_password" id="login_password"><br/>
					<input type="submit" value="Login"><br/>
					<a href="#new">No account yet? Create one!</a>
				</form>
			</div>
		</div>
	</div>

	<!-- Create Account Page -->
	<div data-role="page" id="new">
		<div data-role="content">
			<h1>Create a new account, just in secondes!</h1>
			<div data-role="fieldcontain">
				<form action="new_account.php" method="post" data-ajax="false">
					<label for="email">Email:</label>
					<input type="text" name="new_email" id="new_email">
					<label for="password">Password:</label>
					<input type="password" name="new_password" id="new_password"><br/>
					<input type="submit" value="Creat Account" >
				</form>
			</div>
		</div>
	</div>

	<!-- My Inspiration Page -->
	<div data-role="page" id="my">
		<div data-role="header" data-position="fixed">
			<a href="#">Map</a>	
			<h1>My Inspirations</h1>
			<a id="color" href="#" data-icon="custom">Color</a>		
		</div>

		<div data-role="content" class="photo_list">
			<div data-role="fieldcontain">
				<form action="search.php" method="post">
					<input type="text" name="tag" id="search_tag">
				</form>
			</div>
			<?php 
				include("config.php");
				session_start();
				$user_id = $_SESSION['user_id'];

				$query = "SELECT photo_id, save_path, color_1, color_2, color_3, color_4 FROM Photos, Palettes WHERE Photos.user_id = $user_id AND Photos.palette_id = Palettes.palette_id ORDER BY Photos.ts DESC";
				if($result = mysql_query($query, $link)){
					while($row = mysql_fetch_array($result)){
						echo "<div class=\"photo_list_item\">
									<img src=\"".$row['save_path']."\" alt=\"".$row['photo_id']."\" class=\"photo\"/>
								  <div class=\"palette\">
								  	<div class=\"item\" style=\"background-color: ".$row['color_1'].";\"></div>
									<div class=\"item\" style=\"background-color: ".$row['color_2'].";\"></div>
									<div class=\"item\" style=\"background-color: ".$row['color_3'].";\"></div>
									<div class=\"item\" style=\"background-color: ".$row['color_4'].";\"></div>
								  </div>
							  </div>";
					}
				}
				else{
					echo mysql_error($link);
				}
			?>
		</div>
		<form action="show_details.php" id="show_form" method="post" data-ajax="false">
			<input type="hidden" name="photo_id" id="show_photo_id"></input>
		</form>
		<div id="slider_shaded">
			<div data-role="fieldcontain" >
				<label for="color_slider"</label>
				<input type="range" id="color_slider" value="15" min="0" max="135" step="15" sliderOrientation="vertical" />
			</div>
		</div>

		<?php
			include("footer.php");
		?>
	</div>

	<!-- Favorited Photos Page -->
	<div data-role="page" id="fav">
		<div data-role="header" data-position="fixed">
			<a href="#my">Back</a>
			<h1>Favorites</h1>
		</div>

		<div data-role="content">
			
		</div>

		<?php
			include("footer.php");
		?>
	</div>

	<!-- Photo Details Page -->
	<div data-role="page" id="details">
		<div data-role="header"  data-position="fixed">
			<a href="#" data-rel="back">Back</a>
			<h1>Inspiration</h1>
			<a href="#edit" id="more">...</a>
		</div>

		<div data-role="content" class="photo_list">
			<?php
				include("config.php");
				session_start();
				$photo_id = $_SESSION['photo_id'];

				$query = "SELECT save_path, geolat, geolng, color_1, color_2, color_3, color_4 FROM Photos, Palettes WHERE Photos.photo_id = $photo_id AND Photos.palette_id = Palettes.palette_id";
				$result = mysql_query($query);
				$row = mysql_fetch_array($result);
				echo "<div class=\"photo_list_item\">
									<img src=\"".$row['save_path']."\" class=\"photo\"/>
								  <div class=\"palette\">
								  	<div class=\"item\" style=\"background-color: ".$row['color_1'].";\"></div>
									<div class=\"item\" style=\"background-color: ".$row['color_2'].";\"></div>
									<div class=\"item\" style=\"background-color: ".$row['color_3'].";\"></div>
									<div class=\"item\" style=\"background-color: ".$row['color_4'].";\"></div>
								  </div>
							  </div>";
				$location_lat = $row['geolat'];
				$location_lng = $row['geolng'];

				echo "<p class=\"tags_display\">";
				$query = "SELECT name FROM Tags, PhotosTags WHERE PhotosTags.photo_id = $photo_id AND Tags.tag_id = PhotosTags.tag_id";
				if($result = mysql_query($query, $link)){
					while ($row = mysql_fetch_array($result)) {
						echo "<span>#".$row['name']."</span>";
					}
				}
				else{
					echo mysql_error($link);
				}
				echo "</p>";
				echo "<p>@ $location_lat, $location_lng</p>"
			?>
		</div>

		<?php
			include("footer.php");
		?>
	</div>

	<!-- Photo Edit Details Page -->
	<div data-role="page" id="edit">
		<div data-role="header"  data-position="fixed">
			<a href="#" data-rel="back">Cancel</a>
			<h1>Inspiration</h1>
			<a href="#">Save</a>
		</div>

		<div data-role="content" class="photo_list">
			<div class="photo_list_item">
				<img src="photos/test1.jpg" class="photo"/>
				<div class="palette">
					<div class="item" style="background-color: #333;"></div>
					<div class="item" style="background-color: #ccc;"></div>
					<div class="item" style="background-color: red;"></div>
					<div class="item" style="background-color: #000;"></div>
				</div>
			</div>
			<div data-role="fieldcontain">
				<form action="" method="post">
					<input type="text" name="tag" id="edit_tag" value="NewOrder, AlbumArt, 80s"></input> <br/>
				</form>
			</div>
		</div>

		<?php
			include("footer.php");
		?>
	</div>

	<!-- Add New Photo Page -->
	<div data-role="page" id="add">
		<div data-role="header"  data-position="fixed">
			<a href="#" data-rel="back">Cancel</a>
			<h1>Add Inspiration</h1>
			<a href="#" id="add_done">Done</a>
		</div>

		<div data-role="content" class="photo_list">
			<div class="photo_list_item">
				<?php 
					session_start();
					$photo_name = $_SESSION['photo_name'];
					echo "<img src=\"photos/$photo_name\" class=\"photo\"/>";
				?>
				
				<div class="palette">
					<div class="item" style="background-color: #333333;"></div>
					<div class="item" style="background-color: #cccccc;"></div>
					<div class="item" style="background-color: #FF0000;"></div>
					<div class="item" style="background-color: #000000;"></div>
				</div>
			</div>
			<script>
				//get current location
				if (navigator.geolocation) {
		    		navigator.geolocation.getCurrentPosition(success, error);
				}

				function error(){
					alert("Sorry, can't get your current location!");
				}	

				function success(position){
					$('#lat').val(position.coords.latitude);
					$('#lng').val(position.coords.longitude);
					//console.log(position.coords.latitude);
					//console.log(position.coords.longitude);
				}
			</script>
			<div data-role="fieldcontain">
				<form action="save_add.php" id="add_form" method="post" data-ajax="false">
					<input type="text" name="tag" id="add_tag" placeholder="Tags seperated by commas"></input> <br/>
					<input type="hidden" name="color_1" id="color_1" value="#333333"></input>
					<input type="hidden" name="color_2" id="color_2" value="#cccccc"></input>
					<input type="hidden" name="color_3" id="color_3" value="#FF0000"></input>
					<input type="hidden" name="color_4" id="color_4" value="#000000"></input>
					<input type="hidden" name="lat" id="lat"></input>
					<input type="hidden" name="lng" id="lng"></input>
				</form>
			</div>
		</div>

		<?php
			include("footer.php");
		?>
	</div>
</body>
</html>