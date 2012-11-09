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

	<link rel="stylesheet" href="css/style.css" />
	<link rel="apple-touch-icon" href="icons/homeScreen_new.png" />
	<link rel="apple-touch-startup-image" href="icons/login_bg_light.png" />
	
	<script src="js/jquery-1.8.2.min.js"></script>
	<script src="js/jquery.mobile-1.2.0.min.js"></script>
	<script src="js/quantize.js"></script>
    <script src="js/color-thief.js"></script>
    <script src="js/classification.js"></script>

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
			<!-- <a id="color" href="#" data-icon="custom">Color</a>	-->
			<h1>My Inspirations</h1>
			<a href="#search" data-icon="search">Search</a>		
		</div>

		<div data-role="content" class="photo_list with_filter">
			<div id="color_filter">
				<ul>
					<li id="red" class="selected"></li>
					<li id="orange"></li>
					<li id="yellow"></li>
					<li id="green"></li>
					<li id="cyan"></li>
					<li id="blue"></li>
					<li id="magenta"></li>
					<li id="bwg"></li>
				</ul>
			</div>
			<div class="photo_list_wrapper">
			</div>

		</div>
		<form action="show_details.php" id="show_form" method="post" data-ajax="false">
			<input type="hidden" name="photo_id" id="show_photo_id"></input>
		</form>

		<?php
			include("footer.php");
		?>
	</div>

	<!-- Tag Searching Page -->
	<div data-role="page" id="search">
		<div data-role="header" data-position="fixed">
			<a href="#my">Back</a>
			<h1>Search Results</h1>
		</div>

		<div data-role="content">
			<div data-role="fieldcontain">
				<form action="search.php" method="post">
					<input type="text" name="tag" id="search_tag">
				</form>
			</div>

			<div class="search_result">
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

		<div data-role="content" class="photo_list">
			<div class="photo_list_wrapper">
			</div>		
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
			<a href="#" id="more">...</a>
		</div>

		<div data-role="content" class="photo_list">
			<?php
				include("config.php");
				session_start();
				$photo_id = $_SESSION['photo_id'];

				$query = "SELECT save_path, geolat, geolng, color_1, color_2, color_3, color_4, color_5, is_fav FROM Photos, Palettes WHERE Photos.photo_id = $photo_id AND Photos.palette_id = Palettes.palette_id";
				$result = mysql_query($query);
				$row = mysql_fetch_array($result);
				if($row['is_fav']==0){
					$fav_class = "not_faved";
				}
				else{
					$fav_class = "faved";
				}
				echo "<div class=\"photo_list_item\">
									<div id=\"fav_button\" class=\"".$fav_class."\"></div>
									<img src=\"".$row['save_path']."\" class=\"photo\"/>
								  <div class=\"palette\">
								  	<div class=\"swatch\" style=\"background-color: rgb(".$row['color_1'].");\"></div>
								  	<div class=\"swatch\" style=\"background-color: rgb(".$row['color_2'].");\"></div>
								  	<div class=\"swatch\" style=\"background-color: rgb(".$row['color_3'].");\"></div>
								  	<div class=\"swatch\" style=\"background-color: rgb(".$row['color_4'].");\"></div>
								  	<div class=\"swatch\" style=\"background-color: rgb(".$row['color_5'].");\"></div>
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

		<div id="more_options">
			<a href="#edit" class="option" data-role="button" id="edit_button">Edit</a>
			<a href="#" class="option" data-role="button" id="delete_button">Delete</a>
			<a href="#" class="option" data-role="button" id="cancel_button">Cancel</a>
		</div>

		<?php
			include("footer.php");
		?>
	</div>

	<!-- Photo Edit Details Page -->
	<div data-role="page" id="edit">
		<div data-role="header"  data-position="fixed">
			<a href="#" data-rel="back">Cancel</a>
			<h1>Edit</h1>
			<a href="#" id="save_edit">Save</a>
		</div>

		<div data-role="content" class="photo_list">
			<?php
				include("config.php");
				session_start();
				$photo_id = $_SESSION['photo_id'];

				if(isset($photo_id)){
					$query = "SELECT save_path, geolat, geolng, color_1, color_2, color_3, color_4, color_5 FROM Photos, Palettes WHERE Photos.photo_id = $photo_id AND Photos.palette_id = Palettes.palette_id";
					$result = mysql_query($query);
					$row = mysql_fetch_array($result);
					echo "<div class=\"photo_list_item\">
										<img src=\"".$row['save_path']."\" class=\"photo\"/>
									  <div class=\"palette\">
									  	<div class=\"swatch\" style=\"background-color: rgb(".$row['color_1'].");\"></div>
								  		<div class=\"swatch\" style=\"background-color: rgb(".$row['color_2'].");\"></div>
								  		<div class=\"swatch\" style=\"background-color: rgb(".$row['color_3'].");\"></div>
								  		<div class=\"swatch\" style=\"background-color: rgb(".$row['color_4'].");\"></div>
								  		<div class=\"swatch\" style=\"background-color: rgb(".$row['color_5'].");\"></div>
									  </div>
								  </div>";
					$location_lat = $row['geolat'];
					$location_lng = $row['geolng'];

					echo "<div data-role=\"fieldcontain\"><form id=\"edit_form\" action=\"edit.php\" method=\"post\" data-ajax=\"false\">
						<input type=\"text\" name=\"tag\" id=\"edit_tag\" value=\"";
					$query = "SELECT name FROM Tags, PhotosTags WHERE PhotosTags.photo_id = $photo_id AND Tags.tag_id = PhotosTags.tag_id";
					if($result = mysql_query($query, $link)){
						while ($row = mysql_fetch_array($result)) {
							echo $row['name'] . ", ";
						}

						echo "\"></input> <br/></form></div>";
					}
					else{
						echo mysql_error($link);
					}
					echo "</p>";
					echo "<p>@ $location_lat, $location_lng</p>";
				}
			?>
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
					echo "<img src=\"photos/$photo_name\" class=\"new_photo\"/>";
				?>
				
				<div class="palette">
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
					<input type="hidden" name="color_1" id="color_1"></input>
					<input type="hidden" name="color_2" id="color_2"></input>
					<input type="hidden" name="color_3" id="color_3"></input>
					<input type="hidden" name="color_4" id="color_4"></input>
					<input type="hidden" name="color_5" id="color_5"></input>
					<input type="hidden" name="category" id="category"></input>
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