<?php include("redirect.php"); ?>
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

	<script src="js/index.js"></script>
	<script type="text/javascript">

	  var _gaq = _gaq || [];
	  _gaq.push(['_setAccount', 'UA-36620884-1']);
	  _gaq.push(['_trackPageview']);

	  (function() {
	    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
	    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
	    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
	  })();

	</script>
</head/>
<body>
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
				if(!isset($photo_id)){
					session_start();
					$_SESSION['error'] = "Photo id not found in session in details page.";
					header('location:error.php');
				}

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
					session_start();
					$_SESSION['error'] = mysql_error($link);
					header('location:error.php');
				}
				echo "</p>";
				echo "<p>@ $place</p>"
			?>

			<div data-role="popup" id="color_popup">
				<a href="#" data-rel="back" data-role="button" data-theme="a" data-icon="delete" data-iconpos="notext" class="ui-btn-left">Close</a>
				<ul>
				</ul>
			</div>
			
		</div>

		<div id="more_options" class="hidden_menu">
			<a href="edit.php" class="option" data-role="button" id="edit_button">Edit</a>
			<a href="#" class="option" data-role="button" id="delete_button">Delete</a>
			<a href="#" class="option" data-role="button" id="cancel_button">Cancel</a>
		</div>

		<div data-role="footer" class="nav" data-position="fixed">
				<div data-role="navbar">
					<ul>
						<li><a href="my.php"><img class="tab_icon" src="icons/inspire_sized.png"></a></li>
						<form id="upload_form_details" action="upload.php" enctype="multipart/form-data" method="post" data-ajax="false">
							<div id="input_wrapper">
								<input type="file" name="file" id="photo_input_details" size="100"/>
							</div>
							<li id="photo_li"><a href="#"><img class="tab_icon" src="icons/camera_sized.png"/></a></li>
						</form>
						<li><a href="fav.php"><img class="tab_icon" src="icons/star1.png"/></a></li>
					</ul>
				</div>
		</div>
	</div>
</body>
</html>