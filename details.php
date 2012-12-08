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
	<script src="js/jquery.timeago.js"></script>
	<script src="js/html2canvas.min.js"></script>
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
	<div id="fb-root"></div>
	<script>
	  //integrating FB SDK
	  window.fbAsyncInit = function() {
	    FB.init({
	      appId      : '179423075530334', // App ID
	      channelUrl : '//WWW.YOUR_DOMAIN.COM/channel.html', // Channel File
	      status     : true, // check login status
	      cookie     : true, // enable cookies to allow the server to access the session
	      xfbml      : true  // parse XFBML
	    });

	    FB.Event.subscribe('auth.statusChange', handleStatusChange);
	  };

	  // Load the SDK Asynchronously
	  (function(d){
	     var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
	     if (d.getElementById(id)) {return;}
	     js = d.createElement('script'); js.id = id; js.async = true;
	     js.src = "//connect.facebook.net/en_US/all.js";
	     ref.parentNode.insertBefore(js, ref);
	   }(document));

	  function handleStatusChange(response) {
	    document.body.className = response.authResponse ? 'connected' : 'not_connected';
	   
	    if (response.authResponse) {
	      console.log(response);
	      updateUserInfo(response);
	    }
	  }

	  function FBshare(){
	  	FB.login(function(response) { }, {scope:'email'});

	  	//convert the html elements to canvas, save it to png and then share
	  	html2canvas( [ document.getElementById("photo_palette") ], {
	  	    onrendered: function( canvas ) {
	  	           var image = canvas.toDataURL("image/png");

	  	           //send the ajax request to save the png file
	  	           var ajax = new XMLHttpRequest();
	  	           ajax.onreadystatechange=function()
	  	           {
	  	             if (ajax.readyState==4 && ajax.status==200)
	  	               {
	  	               		console.log(ajax.responseText);
	  	               		var image_url = "http://stanford.edu/~ningxiaz/cgi-bin/Inspixel/"+ajax.responseText;
	  	               		FB.ui({
	  	               		  method: 'feed',
	  	               		  name: 'I\'ve just logged an inspiration with Inspixel!',
	  	               		  caption: 'My life in color!',
	  	               		  description: 'Check out Inspixel app! Get organized and inspired by colors in everyday life.',
	  	               		  link: 'https://www.facebook.com/Inspixel',
	  	               		  picture: image_url
	  	               		}, 
	  	               		function(response) {
	  	               		  console.log('publishStory response: ', response);
	  	               		});
	  	               }
	  	           }
  
	  	           ajax.open("POST",'save_png.php',false);
	  	           ajax.setRequestHeader('Content-Type', 'application/upload');
	  	           ajax.send(image);  
	  	    }
	  	});
	  	
	  }
	</script>
	<script src="js/index.js"></script>


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
				include("helper.php");
				session_start();
				$photo_id = $_SESSION['photo_id'];
				if(!isset($photo_id)){
					session_start();
					$_SESSION['error'] = "Photo id not found in session in details page.";
					header('location:error.php');
				}

				$query = "SELECT save_path, place, color_1, color_2, color_3, color_4, color_5, is_fav, ts FROM Photos, Palettes WHERE Photos.photo_id = $photo_id AND Photos.palette_id = Palettes.palette_id";
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
								<div id=\"photo_palette\">
									<img src=\"".$row['save_path']."\" class=\"photo\"/>
								  <div class=\"palette\">
								  	<div class=\"swatch\" style=\"background-color: rgb(".$row['color_1'].");\"></div>
								  	<div class=\"swatch\" style=\"background-color: rgb(".$row['color_2'].");\"></div>
								  	<div class=\"swatch\" style=\"background-color: rgb(".$row['color_3'].");\"></div>
								  	<div class=\"swatch\" style=\"background-color: rgb(".$row['color_4'].");\"></div>
								  	<div class=\"swatch\" style=\"background-color: rgb(".$row['color_5'].");\"></div>
								  </div>
								 </div>
								</div>";
				$place = $row['place'];
				$ts = $row['ts'];

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
				if(!IsNullOrEmpty($place)){
					echo "<p>@ $place</p>";
				}

				echo "<abbr class=\"ts\" title=\"$ts\"></abbr>";
			?>
			<br>
			<a onClick="FBshare();" href="#">Share to Facebook</a><br>
			<p class="filename"></p>

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
						<li><a href="my_b.php" data-ajax="false" ><img class="tab_icon" src="icons/sunoff.png"></a></li>
						<li><a href="explore.php" data-ajax="false"><img class="tab_icon" src="icons/exploreoff.png"></a></li>
						<form id="upload_form_details" action="upload.php" enctype="multipart/form-data" method="post" data-ajax="false">
							<div id="input_wrapper">
								<input type="file" name="file" id="photo_input_details" size="100"/>
							</div>
							<li id="photo_li"><a href="#"><img class="tab_icon" src="icons/cameraoff.png"/><br></a></li>
						</form>
						<li><a href="search.php" data-ajax="false"><img class="tab_icon" src="icons/tagoff.png"></a></li>
						<li><a href="fav.php" data-ajax="false"><img class="tab_icon" src="icons/favoriteoff.png"/></a></li>
					</ul>
				</div>
		</div>
	</div>
</body>
</html>