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
	<script src="js/quantize.js"></script>
    <script src="js/color-thief.js"></script>
    <script src="js/classification.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>

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
					<label for="place" class="select">Choose Location:</label>
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