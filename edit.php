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
	<!-- Photo Edit Details Page -->
	<div data-role="page" id="edit">
		<div data-role="header"  data-position="fixed">
			<a href="#" data-rel="back">Cancel</a>
			<h1>Edit</h1>
			<a href="#" id="save_edit">Save</a>
		</div>

		<div class="loader"></div>

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
									  <div class=\"palette\">
									  	<div class=\"swatch\" style=\"background-color: rgb(".$row['color_1'].");\"></div>
								  		<div class=\"swatch\" style=\"background-color: rgb(".$row['color_2'].");\"></div>
								  		<div class=\"swatch\" style=\"background-color: rgb(".$row['color_3'].");\"></div>
								  		<div class=\"swatch\" style=\"background-color: rgb(".$row['color_4'].");\"></div>
								  		<div class=\"swatch\" style=\"background-color: rgb(".$row['color_5'].");\"></div>
									  </div>
									</div>";
					$place = $row['place'];

					echo "<div data-role=\"fieldcontain\"><form id=\"edit_form\" action=\"edit_photo.php\" method=\"post\" data-ajax=\"false\">
						<input type=\"text\" name=\"tag\" id=\"edit_tag\" value=\"";
					$query = "SELECT name FROM Tags, PhotosTags WHERE PhotosTags.photo_id = $photo_id AND Tags.tag_id = PhotosTags.tag_id";
					if($result = mysql_query($query, $link)){
						while ($row = mysql_fetch_array($result)) {
							echo $row['name'] . ", ";
						}

						echo "\"></input> <br/></form></div>";
					}
					else{
						session_start();
						$_SESSION['error'] = mysql_error($link);
						header('location:error.php');
					}
					echo "</p>";
					echo "<p>@ $place</p>";
				}
				else{
					session_start();
					$_SESSION['error'] = "Photo id not found in session in edit page.";
					header('location:error.php');
				}
			?>
		</div>
	</div>
</body>
</html>