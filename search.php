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
	
	<link rel="stylesheet" href="themes/Inspixel.min.css" />
	<link rel="stylesheet" href="http://code.jquery.com/mobile/1.2.0/jquery.mobile.structure-1.2.0.min.css" />

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
	<!-- Tag Searching Page -->
	<div data-role="page" id="search">
		<div data-role="header" data-position="fixed">
			<h1>Tags</h1>
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

		<form action="show_details.php" id="show_form" method="post" data-ajax="false">
			<input type="hidden" name="photo_id" id="show_photo_id"></input>
		</form>

		<div data-role="footer" class="nav" data-position="fixed">
				<div data-role="navbar">
					<ul>
						<li><a href="my_b.php" data-ajax="false"><img class="tab_icon" src="icons/sunoff.png"></a></li>
						<li><a href="explore.php" data-ajax="false"><img class="tab_icon" src="icons/exploreoff.png"></a></li>
						<form id="upload_form_search" action="upload.php" enctype="multipart/form-data" method="post" data-ajax="false">
							<div id="input_wrapper">
								<input type="file" name="file" id="photo_input_search" size="100"/>
							</div>
							<li id="photo_li"><a href="#"><img class="tab_icon" src="icons/cameraoff.png"/></a></li>
						</form>
						<li><a href="search.php" class="ui-btn-active ui-state-persist"><img class="tab_icon" src="icons/tagon.png"></a></li>
						<li><a href="fav.php" data-ajax="false"><img class="tab_icon" src="icons/favoriteoff.png"/></a></li>
					</ul>
				</div>
		</div>
	</div>
</body>
</html>