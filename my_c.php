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
<style>
#filterContainer
{
	width:61px;
	padding:0px;
	display: none;
	position: absolute;
	top: 42px;
	left: 0;
	z-index: 100;
}

.colorFilter
{
	display:block;
	width:61px;
	height:44px; 
}

.redFilter
{
	background-image: url(icons/colorfilter_02.png);
}
.orangeFilter
{
  background-image: url(icons/colorfilter_04.png);
}
.yellowFilter
{
  background-image: url(icons/colorfilter_05.png);
}
.greenFilter
{
  background-image: url(icons/colorfilter_06.png);
}
.cyansFilter
{
  background-image: url(icons/colorfilter_07.png);
}
.blueFilter
{
  background-image: url(icons/colorfilter_08.png);
}
.purpleFilter
{
  background-image: url(icons/colorfilter_10.png);
}
.grayFilter
{
  background-image: url(icons/colorfilter_11.png);
}

</style>

<script src="js/index.js"></script>
<script>
var open_item = null;

$('#my_c').live('pageinit',function(event){
   
   $("#filterButton").live('tap',function(){
      $("#filterContainer").slideToggle(300);
   });

   $('.colorFilter').live('tap',function(event) {
        if($(this).hasClass('isOpen')){
          if ($(this).hasClass('redFilter'))
             {
              $(this).css("background-image","url(icons/colorfilter_02.png)");
             }
          else if ($(this).hasClass('orangeFilter'))
             {
              $(this).css("background-image","url(icons/colorfilter_04.png)");
             }
          else if ($(this).hasClass('yellowFilter'))
             {
              $(this).css("background-image","url(icons/colorfilter_05.png)");
             }
          else if ($(this).hasClass('greenFilter'))
             {
              $(this).css("background-image","url(icons/colorfilter_06.png)");
             }
          else if ($(this).hasClass('cyansFilter'))
             {
              $(this).css("background-image","url(icons/colorfilter_07.png)");
             }
          else if ($(this).hasClass('blueFilter'))
             {
              $(this).css("background-image","url(icons/colorfilter_08.png)");
             }
          else if ($(this).hasClass('purpleFilter'))
             {
              $(this).css("background-image","url(icons/colorfilter_10.png)");
             }
          else if ($(this).hasClass('grayFilter'))
             {
              $(this).css("background-image","url(icons/colorfilter_11.png)");
             }

          $(this).removeClass("isOpen");
        }
        else
        {
          if ($(this).hasClass('redFilter'))
            {
            $(this).css("background-image","url(icons/colorfilterOpen_02.png)");
            ajax_show_photos(0);
            }
          else if ($(this).hasClass('orangeFilter'))
             {
              $(this).css("background-image","url(icons/colorfilterOpen_04.png)");
              ajax_show_photos(1);
             }
          else if ($(this).hasClass('yellowFilter'))
             {
              $(this).css("background-image","url(icons/colorfilterOpen_05.png)");
              ajax_show_photos(2);
             }
          else if ($(this).hasClass('greenFilter'))
             {
              $(this).css("background-image","url(icons/colorfilterOpen_06.png)");
              ajax_show_photos(3);
             }
          else if ($(this).hasClass('cyansFilter'))
             {
              $(this).css("background-image","url(icons/colorfilterOpen_07.png)");
              ajax_show_photos(4);
             }
          else if ($(this).hasClass('blueFilter'))
             {
              $(this).css("background-image","url(icons/colorfilterOpen_08.png)");
              ajax_show_photos(5);
             }
          else if ($(this).hasClass('purpleFilter'))
             {
              $(this).css("background-image","url(icons/colorfilterOpen_10.png)");
              ajax_show_photos(6);
             }
          else if ($(this).hasClass('grayFilter'))
             {
              $(this).css("background-image","url(icons/colorfilterOpen_11.png)");
              ajax_show_photos(7);
             }

          $(this).addClass("isOpen");
        }  
	});

		$('loader').show();

		//show all photos by default
		$.post("show_photos.php", {sendValue: -1}, function(data){
			$('.loader').hide();
			$('.photo_list_wrapper').html(data.returnValue);

			//if no photos yet, show instructions
			var num_photos = $('.photo_list_wrapper .photo_list_item').children().length;
			if(num_photos==0){
				$("#instruction").popup({history:false,transition:"fade"});
				
				$( "#instruction" ).on({
				popupbeforeposition: function() {
				    var h = $( window ).height();
				        w = $( window ).width();
				
				    $( "#instruction" ).css( "height", h );
				    $( "#instruction" ).css( "width", w );
				}
				});
				$("#instruction").popup("open");

				//tap anywhere to dismiss the instructions
				$('#instruction').live('tap', function(event){
					$('#instruction').popup('close');
				});
			}
		}, "json");

		//auto upload photo
		$('#photo_input_my').change(function(){
			$('.loader').show();
			$('#upload_form_my').submit();
		});	

	  	$('.photo_list_item img').live('tap',function(event) {
	  		//google analytics tracking
	  		_gaq.push(['_trackEvent', 'Photos', 'Click', 'Version C']);
	  		
			var photo_id = $(this).attr('alt');
			$('#show_photo_id').val(photo_id);
			$('#show_form').submit();
		});
});

</script>

<body>
	<!-- My Inspiration Page -->
	<div data-role="page" id="my_c">
		<div data-role="header" data-position="fixed">
			<button id="filterButton">filter</button>
			<h1>My Inspirations</h1>
			<a href="#" data-icon="gear" id="settings_button" data-iconpos="notext"></a>	
		</div>

		<div id="filterContainer">
   	   	   <div class="colorFilter redFilter">
   	   	   </div>
           <div class="colorFilter orangeFilter">
           </div>
           <div class="colorFilter yellowFilter">
           </div>
           <div class="colorFilter greenFilter">
           </div>
           <div class="colorFilter cyansFilter">
           </div> 
           <div class="colorFilter blueFilter">
           </div>           
           <div class="colorFilter purpleFilter">
           </div>           
           <div class="colorFilter grayFilter">
           </div>           
   	   </div>

		<div data-role="content" class="photo_list">
			<div class="photo_list_wrapper">
			</div>

		</div>
		<form action="show_details.php" id="show_form" method="post" data-ajax="false">
			<input type="hidden" name="photo_id" id="show_photo_id"></input>
		</form>

		<div id="settings" class="hidden_menu">
			<a href="logout.php" class="option" data-role="button" id="logout" data-theme="e">Log out</a>
			<a href="feedback.php" class="option" data-role="button" id="logout">Feedback</a>
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

        <div class="loader"></div>

        <p class="no_photo">
        	Currently there are no pictures in this category. Snap some!
        </p>

		<div data-role="footer" class="nav" data-position="fixed">
				<div data-role="navbar">
					<ul>
						<li><a href="search.php" class="ui-btn-active ui-state-persist"><img class="tab_icon" src="icons/tag_sized_blue.png"></a></li>
						<form id="upload_form_my" action="upload.php" enctype="multipart/form-data" method="post" data-ajax="false">
							<div id="input_wrapper">
								<input type="file" name="file" id="photo_input_my" size="100"/>
							</div>
							<li id="photo_li"><a href="#"><img class="tab_icon" src="icons/camera_sized_blue.png"/></a></li>
						</form>
						<li><a href="fav.php"><img class="tab_icon" src="icons/star1_blue.png"/></a></li>
					</ul>
				</div>
		</div>
	</div>	
</body>
</html>