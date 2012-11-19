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
	<!-- My Inspiration Page -->
	<div data-role="page" id="my">
		<div data-role="header" data-position="fixed">
			<script src="//cdn.optimizely.com/js/141682239.js"></script>
			<!-- <a id="color" href="#" data-icon="custom">Color</a>	-->
			<h1>My Inspirations</h1>
			<a href="search.php" data-icon="search">Search</a>	
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
			<div>
			</div>

		</div>
		<form action="show_details.php" id="show_form" method="post" data-ajax="false">
			<input type="hidden" name="photo_id" id="show_photo_id"></input>
		</form>

		<div id="settings" class="hidden_menu">
			<a href="logout.php" class="option" data-role="button" id="logout">Log out</a>
			<a href="#" class="option" data-role="button" id="cancel_settings">Cancel</a>
		</div>

		<div data-role="popup" id="instruction" data-corners="false" data-theme="none" data-shadow="false" data-tolerance="0,0">
            <div id="filter_instruction">
                <img src="icons/description_1.png" id="ins_pic_1"/>
            </div>
           
            <div id="camera_instruction">
                  <img src="icons/description_2.png" id="ins_pic_2"/>
            </div>
        </div>

		<div data-role="footer" class="nav" data-position="fixed">
				<div data-role="navbar">
					<ul>
						<li><a id="reset" class="ui-btn-active ui-state-persist"><img class="tab_icon" src="icons/inspire_sized.png"></a></li>
						<form id="upload_form_my" action="upload.php" enctype="multipart/form-data" method="post" data-ajax="false">
							<div id="input_wrapper">
								<input type="file" name="file" id="photo_input_my" size="100"/>
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