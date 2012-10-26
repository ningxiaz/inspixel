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
	<link rel="apple-touch-icon" href="appicon.png" />
	<link rel="apple-touch-startup-image" href="#" />

	<script src="js/jquery-1.8.2.min.js"></script>
	<script src="js/jquery.mobile-1.2.0.min.js"></script>
	<script src="js/index.js"></script>
</head/>
<body>
	<!-- Login Page -->
	<div data-role="page" id="login">
		<div data-role="content">
			<h1>Hi, Welcome to Inspixel!</h1>
			<div data-role="fieldcontain">
				<form action="" method="post">
					<label for="email">Email:</label>
					<input type="text" name="email" id="login_email">
					<label for="password">Password:</label>
					<input type="password" name="password" id="login_password">
					<a data-role="button" href="#my">Login</a>
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
				<form action="" method="post">
					<label for="email">Email:</label>
					<input type="text" name="email" id="new_email">
					<label for="password">Password:</label>
					<input type="password" name="password" id="new_password">
					<a data-role="button" href="#my">Create Account</a>
				</form>
			</div>
		</div>
	</div>

	<!-- My Inspiration Page -->
	<div data-role="page" id="my">
		<div data-role="header">
			<a href="#" data-role="button" data-icon="colours">Color</a>
			<h1>My Inspirations</h1>
			<a href="#">Map</a>			
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

			<div class="photo_list_item">
				<img src="photos/test2.jpg" class="photo"/>
				<div class="palette">
					<div class="item" style="background-color: #f7fae7;"></div>
					<div class="item" style="background-color: #c09429;"></div>
					<div class="item" style="background-color: #87a05f;"></div>
					<div class="item" style="background-color: #000;"></div>
				</div>
			</div>

		</div>

		<?php
			include("footer.php");
		?>
	</div>

	<!-- Tag Searching Page -->
	<div data-role="page" id="tags">
		<div data-role="header">
			<a href="#my">Back</a>
			<h1>Search</h1>
		</div>

		<div data-role="content">
			<div data-role="fieldcontain">
				<form action="search.php" method="post">
					<input type="text" name="tag" id="search_tag">
				</form>
			</div>
			<div class="tag_group">
				<p><span>#music</span></p>
				<div class="thumbnail">
					<img src="photos/test1.jpg"/>
				</div>
				<div class="thumbnail">
					<img src="photos/test2.jpg"/>
				</div>
				<div class="clear"></div>
			</div>
			<div class="tag_group">
				<p><span>#black and white</span></p>
				<div class="thumbnail">
					<img src="photos/test3.jpg"/>
				</div>
				<div class="thumbnail">
					<img src="photos/test4.jpg"/>
				</div>
				<div class="clear"></div>
			</div>
		</div>

		<?php
			include("footer.php");
		?>
	</div>

	<!-- Photo Details Page -->
	<div data-role="page" id="details">
		<div data-role="header">
			<a href="#" data-rel="back">Back</a>
			<h1>Photo</h1>
			<a href="#">...</a>
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
			<p class="tags_display"><span>#NewOrder</span><span>#AlbumArt</span><span>#80s</span></p>
			<p class="location">@ London Studio</p>
		</div>

		<?php
			include("footer.php");
		?>
	</div>
</body>
</html>