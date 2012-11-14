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
	<link rel="stylesheet" type="text/css" href="http://dev.jtsage.com/cdn/simpledialog/latest/jquery.mobile.simpledialog.min.css" /> 

	<link rel="stylesheet" href="css/style.css" />
	<link rel="apple-touch-icon" href="icons/homeScreen_new.png" />
	<link rel="apple-touch-startup-image" href="icons/login_bg_light.png" />
	
	<script src="js/jquery-1.8.2.min.js"></script>
	<script src="js/jquery.mobile-1.2.0.min.js"></script>
	<script type="text/javascript" src="http://dev.jtsage.com/cdn/simpledialog/latest/jquery.mobile.simpledialog2.min.js"></script>
	<script src="js/quantize.js"></script>
    <script src="js/color-thief.js"></script>
    <script src="js/classification.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
    <script src="http://yui.yahooapis.com/3.7.3/build/yui/yui-min.js"></script>

	<script src="js/index.js"></script>

	<script type="text/javascript">
		YUI().use('node', function(Y) {
    	var nodes = Y.all('#pix_filter li');

    	var onClick = function(e) {
        	nodes.removeClass('highlight');

        	e.currentTarget.addClass('highlight'); // e.currentTarget === #pix_filter li 
        	e.currentTarget.setStyle('border', '2px solid #220A29'); // e.container === #pix_filter

        	nodes.filter(':not(.highlight)').setStyle('border', 'none');
    	};

    Y.one('#pix_filter').delegate('click', onClick, 'li');
});
</script>

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
			<h1>Create a new account, just in seconds!</h1>
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

	<!-- Logout Page -->
	<div data-role="page" id="logout">
		<div data-role="content">
			<h1>Thanks for using Inspixel!</h1>
			<a href="#login">Click here to re-login.</a>
		</div>
	</div>

	<!-- My Inspiration Page -->
	<div data-role="page" id="my">
		<div data-role="header" data-position="fixed">
			<!-- <a id="color" href="#" data-icon="custom">Color</a>	-->
			<h1>My Inspirations</h1>
			<a href="#search" data-icon="search">Search</a>	
			<a href="#" data-icon="gear" id="settings_button" data-iconpos="notext"></a>	
		</div>

		<div data-role="content" class="photo_list with_filter">
			<div id="color_filter">
				<ul id="pix_filter">
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

		<div id="settings" class="hidden_menu">
			<a href="#logout" class="option" data-role="button" id="logout">Log out</a>
			<a href="#" class="option" data-role="button" id="cancel_settings">Cancel</a>
		</div>

		<div data-role="footer" class="nav" data-position="fixed">
				<div data-role="navbar">
					<ul>
						<li><a href="index.php#my"><img class="tab_icon" src="icons/inspire_sized.png"></a></li>
						<form id="upload_form_my" action="upload.php" enctype="multipart/form-data" method="post" data-ajax="false">
							<div id="input_wrapper">
								<input type="file" name="file" id="photo_input_my" size="100"/>
							</div>
							<li id="photo_li"><a href="#"><img class="tab_icon" src="icons/camera_sized.png"/></a></li>
						</form>
						<li><a href="index.php#fav"><img class="tab_icon" src="icons/star1.png"/></a></li>
					</ul>
				</div>
		</div>
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

		<div data-role="footer" class="nav" data-position="fixed">
				<div data-role="navbar">
					<ul>
						<li><a href="index.php#my"><img class="tab_icon" src="icons/inspire_sized.png"></a></li>
						<form id="upload_form_search" action="upload.php" enctype="multipart/form-data" method="post" data-ajax="false">
							<div id="input_wrapper">
								<input type="file" name="file" id="photo_input_search" size="100"/>
							</div>
							<li id="photo_li"><a href="#"><img class="tab_icon" src="icons/camera_sized.png"/></a></li>
						</form>
						<li><a href="index.php#fav"><img class="tab_icon" src="icons/star1.png"/></a></li>
					</ul>
				</div>
		</div>
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

		<div data-role="footer" class="nav" data-position="fixed">
				<div data-role="navbar">
					<ul>
						<li><a href="index.php#my"><img class="tab_icon" src="icons/inspire_sized.png"></a></li>
						<form id="upload_form_fav" action="upload.php" enctype="multipart/form-data" method="post" data-ajax="false">
							<div id="input_wrapper">
								<input type="file" name="file" id="photo_input_fav" size="100"/>
							</div>
							<li id="photo_li"><a href="#"><img class="tab_icon" src="icons/camera_sized.png"/></a></li>
						</form>
						<li><a href="index.php#fav"><img class="tab_icon" src="icons/star1.png"/></a></li>
					</ul>
				</div>
		</div>
	</div>

	<!-- Photo Details Page -->
	<div data-role="page" id="details">
		<div data-role="header"  data-position="fixed">
			<a href="#" data-rel="back">Back</a>
			<h1>Inspiration</h1>
			<a href="#" id="more">Edit</a>
		</div>

		<div data-role="content" class="photo_list">
			<?php
				include("config.php");
				session_start();
				$photo_id = $_SESSION['photo_id'];

				$query = "SELECT save_path, place, color_1, color_2, color_3, color_4, color_5, is_fav FROM Photos, Palettes WHERE Photos.photo_id = $photo_id AND Photos.palette_id = Palettes.palette_id";
				$result = mysql_query($query);
				$row = mysql_fetch_array($result);
				if($row['is_fav']==0){
					$fav_class = "not_faved";
				}
				else{
					$fav_class = "faved";
				}
				echo "<div class=\"photo_list_item\">
<<<<<<< HEAD
									<div id=\"fav_button\" class=\"".$fav_class."\"></div>
									<img src=\"".$row['save_path']."\" class=\"photo\"/>
								</div>
=======
									<div class=\"image_click\">
										<div id=\"fav_button\" class=\"".$fav_class."\"></div>
										<img src=\"".$row['save_path']."\" class=\"photo\"/>
									</div>
>>>>>>> 07e92bed03aec4aca579e8374c280725d941a977
								  <div class=\"palette\">
								  	<div class=\"swatch\" style=\"background-color: rgb(".$row['color_1'].");\"></div>
								  	<div class=\"swatch\" style=\"background-color: rgb(".$row['color_2'].");\"></div>
								  	<div class=\"swatch\" style=\"background-color: rgb(".$row['color_3'].");\"></div>
								  	<div class=\"swatch\" style=\"background-color: rgb(".$row['color_4'].");\"></div>
								  	<div class=\"swatch\" style=\"background-color: rgb(".$row['color_5'].");\"></div>
								  </div>";
				$place = $row['place'];

				echo "<p class=\"color_value\"></p>";
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
				echo "<p>@ $place</p>"
			?>
			
		</div>

		<div id="more_options" class="hidden_menu">
			<a href="#edit" class="option" data-role="button" id="edit_button">Edit</a>
			<a href="#" class="option" data-role="button" id="delete_button">Delete</a>
			<a href="#" class="option" data-role="button" id="cancel_button">Cancel</a>
		</div>

		<div data-role="footer" class="nav" data-position="fixed">
				<div data-role="navbar">
					<ul>
						<li><a href="index.php#my"><img class="tab_icon" src="icons/inspire_sized.png"></a></li>
						<form id="upload_form_details" action="upload.php" enctype="multipart/form-data" method="post" data-ajax="false">
							<div id="input_wrapper">
								<input type="file" name="file" id="photo_input_details" size="100"/>
							</div>
							<li id="photo_li"><a href="#"><img class="tab_icon" src="icons/camera_sized.png"/></a></li>
						</form>
						<li><a href="index.php#fav"><img class="tab_icon" src="icons/star1.png"/></a></li>
					</ul>
				</div>
		</div>
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
					$query = "SELECT save_path, place, color_1, color_2, color_3, color_4, color_5 FROM Photos, Palettes WHERE Photos.photo_id = $photo_id AND Photos.palette_id = Palettes.palette_id";
					$result = mysql_query($query);
					$row = mysql_fetch_array($result);
					echo "<div class=\"photo_list_item\">
										<img src=\"".$row['save_path']."\" class=\"photo\"/>
									</div>
									  <div class=\"palette\">
									  	<div class=\"swatch\" style=\"background-color: rgb(".$row['color_1'].");\"></div>
								  		<div class=\"swatch\" style=\"background-color: rgb(".$row['color_2'].");\"></div>
								  		<div class=\"swatch\" style=\"background-color: rgb(".$row['color_3'].");\"></div>
								  		<div class=\"swatch\" style=\"background-color: rgb(".$row['color_4'].");\"></div>
								  		<div class=\"swatch\" style=\"background-color: rgb(".$row['color_5'].");\"></div>
									  </div>";
					$place = $row['place'];

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
					echo "<p>@ $place</p>";
				}
			?>
		</div>
	</div>

	<!-- Add New Photo Page -->
	<div data-role="page" id="add">
		<div data-role="header"  data-position="fixed">
			<a href="#" data-rel="back">Cancel</a>
			<h1>Add Inspiration</h1>
			<a href="#" id="add_done">Done</a>
		</div>

		<div data-role="content" class="photo_list">
			<div data-role="fieldcontain">
				<form action="save_add.php" id="add_form" method="post" data-ajax="false">
					<input type="text" name="tag" id="add_tag" placeholder="Tags seperated by commas"></input> <br/>
					<select name="place" id="place">
					</select>
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
			<div class="photo_list_item">
				<div class="palette">
				</div>
				<?php 
					session_start();
					$photo_name = $_SESSION['photo_name'];
					echo "<img src=\"photos/$photo_name\" class=\"new_photo\"/>";
				?>
			</div>
		</div>
	</div>
</body>
</html>