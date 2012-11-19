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

    <link rel="stylesheet" href="css/style.css" />
	
	<link rel="stylesheet" href="css/jquery.mobile-1.2.0.min.css" />	
	<script src="js/jquery-1.8.2.min.js"></script>
	<script src="js/jquery.mobile-1.2.0.min.js"></script>
</head/>


<style>
#colorViewContent
{
	padding:15px 0 0 0;
}   

div.colorList
{
	height:60px;
	paddng:2px 0 2px 0;
	margin:0 0 3px 0;
}

div.colorSelector
{
	display: inline;
	height:56px;
	width: 20px;
	padding:0;
	margin:2px 0 2px 0;
	float:left;
	box-shadow: 1px 1px 2px #999999;
}

.photo_list_wrapper
{
	display:inline;
	height:56px;
	width:280px;
    list-style: none;
    margin:0;
    padding:0;
    float:left;
    overflow-y:hidden;
    overflow-x:scroll;  
}

.photo_list_item
{
	dispay:inline;
	height:56px;
	width:56px;
	margin:0 2px 0 0;
	padding:0;
	float:left;
}

.photo_list_item img
{
   height:56px;
   width: 56px;
   margin:0px;
   float:left;
    }

.colorWrapper
{
	display: inline;
	height:56px;
	width:290px;
	padding:0;
	margin:2px 0px 2px 10px; 
	float:left;
	overflow-y:hidden;
    overflow-x:scroll;
}


#redList
{
    background-color:#fdedee;
}
#orangeList
{
   background-color: #fff1dc;
}

#yellowList
{
   background-color:#fefcdf; 
}
#greenList
{
   background-color:#eaf3d9; 
}
#cyansList
{
   background-color:#e1f5fa;
}
#blueList
{
   background-color:#dfe5fa;
}
#magnentassList
{
   background-color:#eedced;
}
#blackAndWhiteList
{
  background-color:#eeeeee;
}

#redSelector
{
    background-color:#e73843;
}
#orangeSelector
{
   background-color: #f68e2b;
}
#yellowSelector
{
   background-color:#f6da46; 
}
#greenSelector
{
   background-color:#7eb44d; 
}
#cyansSelector
{
   background-color:#6abbd3;
}
#blueSelector
{
   background-color:#46639c;
}
#magnentassSelector
{
   background-color:#765a95;
}
#blackAndWhiteSelector
{
  background-color:#888888;
}

.palette{
    display: none;
}

</style>
<script>
$('#color').live('pageinit',function(event){

    //auto upload photo
    $('#photo_input_color').change(function(){
        $('#upload_form_color').submit();
    }); 

    $('.photo_list_item').live('tap',function(event) {
        var photo_id = $(this).find('.photo').attr('alt');
        $('#show_photo_id').val(photo_id);
        $('#show_form').submit();
    });

    $('#settings').hide();

    $('#settings_button').live('tap',function(event) {
        $('#settings').toggle();
    });

    $('#cancel_settings').live('tap',function(event) {
        $('#settings').hide();
    });

    $('#reset').live('tap',function(event) {
        location.reload();
    });

    $.post("show_photos.php", {sendValue: 0}, function(data){
            $('#redUl').html(data.returnValue);
            var num_photos = $('#redUl .photo_list_item').children().length;
            $('#redUl').css("width", 60*num_photos);
        }, "json");
      
      $.post("show_photos.php", {sendValue: 1}, function(data){
            $('#orangeUl').html(data.returnValue);
            var num_photos = $('#orangeUl .photo_list_item').children().length;
            $('#orangeUl').css("width", 60*num_photos);
        }, "json");
      
      $.post("show_photos.php", {sendValue: 2}, function(data){
            $('#yellowUl').html(data.returnValue);
            var num_photos = $('#yellowUl .photo_list_item').children().length;
            $('#yellowUl').css("width", 60*num_photos);
        }, "json");
      
      $.post("show_photos.php", {sendValue: 3}, function(data){
            $('#greenUl').html(data.returnValue);
            var num_photos = $('#greenUl .photo_list_item').children().length;
            $('#greenUl').css("width", 60*num_photos);
        }, "json");
      
      $.post("show_photos.php", {sendValue: 4}, function(data){
            $('#cyansUl').html(data.returnValue);
            var num_photos = $('#cyansUl .photo_list_item').children().length;
            $('#cyansUl').css("width", 60*num_photos);
        }, "json");
      
      $.post("show_photos.php", {sendValue: 5}, function(data){
            $('#blueUl').html(data.returnValue);
            var num_photos = $('#blueUl .photo_list_item').children().length;
            $('#blueUl').css("width", 60*num_photos);
        }, "json");
      
      $.post("show_photos.php", {sendValue: 6}, function(data){
            $('#magnentassUl').html(data.returnValue);
            var num_photos = $('#magnentassUl .photo_list_item').children().length;
            $('#magnentassUl').css("width", 60*num_photos);
        }, "json");
      
      $.post("show_photos.php", {sendValue: 7}, function(data){
            $('#blackAndWhiteUl').html(data.returnValue);
            var num_photos = $('#blackAndWhiteUl .photo_list_item').children().length;
            $('#blackAndWhiteUl').css("width", 60*num_photos);
        }, "json");

    
});
</script>

<body>
    <div data-role="page" id="color">
        <script src="//cdn.optimizely.com/js/141682239.js"></script>
    	<div data-role="header" data-position="fixed">
            <!-- <a id="color" href="#" data-icon="custom">Color</a>    -->
            <h1>My Inspirations</h1>
            <a href="search.php" data-ajax="false" data-icon="search">Search</a> 
            <a href="#" data-icon="gear" id="settings_button" data-iconpos="notext"></a>    
        </div>

    	<div data-role="content" id="colorViewContent">
    		<div class="colorList" id="redList">
    				<div class="colorSelector" id="redSelector">
    				</div>
    			<div class="colorWrapper" data-scroll="x">
    		    	<div class="photo_list_wrapper" id="redUl">
    			    	
    			    </div>
    		    </div>
    		</div>

    		<div class="colorList" id="orangeList">
    				<div class="colorSelector" id="orangeSelector">
    				</div>
    			<div class="colorWrapper" data-scroll="x">
    		    	<div class="photo_list_wrapper" id="orangeUl">
    			    	
    			    </div>
    		    </div>
    		</div>

    		<div class="colorList" id="yellowList">
    				<div class="colorSelector" id="yellowSelector">
    				</div>
    			<div class="colorWrapper" data-scroll="x">
    		    	<div class="photo_list_wrapper" id="yellowUl">
                        
                    </div>
    		    </div>
    		</div>

    		<div class="colorList" id="greenList">
    				<div class="colorSelector" id="greenSelector">
    				</div>
    			<div class="colorWrapper" data-scroll="x">
    		    	<div class="photo_list_wrapper" id="greenUl">
                        
                    </div>
    		    </div>
    		</div>

    		<div class="colorList" id="cyansList">
    				<div class="colorSelector" id="cyansSelector">
    				</div>
    			<div class="colorWrapper" data-scroll="x">
    		    	<div class="photo_list_wrapper" id="cyansUl">
                        
                    </div>
    		    </div>
    		</div>

    		<div class="colorList" id="blueList">
    				<div class="colorSelector" id="blueSelector">
    				</div>
    			<div class="colorWrapper" data-scroll="x">
    		    	<div class="photo_list_wrapper" id="blueUl">
                        
                    </div>
    		    </div>
    		</div>

    		<div class="colorList" id="magnentassList">
    				<div class="colorSelector" id="magnentassSelector">
    				</div>
    			<div class="colorWrapper" data-scroll="x">
    		    	<div class="photo_list_wrapper" id="magnentassUl">
                        
                    </div>
    		    </div>
    		</div>

    		<div class="colorList" id="blackAndWhiteList">
    				<div class="colorSelector" id="blackAndWhiteSelector">
    				</div>
    			<div class="colorWrapper" data-scroll="x">
    		    	<div class="photo_list_wrapper" id="blackAndWhiteUl">
                        
                    </div>
    		    </div>
    		</div>

    	</div>

        <form action="show_details.php" id="show_form" method="post" data-ajax="false">
            <input type="hidden" name="photo_id" id="show_photo_id"></input>
        </form>

        <div id="settings" class="hidden_menu">
            <a href="logout.php" data-ajax="false" class="option" data-role="button" id="logout">Log out</a>
            <a href="#" class="option" data-role="button" id="cancel_settings">Cancel</a>
        </div>

        <div data-role="footer" class="nav" data-position="fixed">
                <div data-role="navbar">
                    <ul>
                        <li><a id="reset" class="ui-btn-active ui-state-persist"><img class="tab_icon" src="icons/inspire_sized.png"></a></li>
                        <form id="upload_form_color" action="upload.php" enctype="multipart/form-data" method="post" data-ajax="false">
                            <div id="input_wrapper">
                                <input type="file" name="file" id="photo_input_color" size="100"/>
                            </div>
                            <li id="photo_li"><a href="#"><img class="tab_icon" src="icons/camera_sized.png"/></a></li>
                        </form>
                        <li><a href="fav.php" data-ajax="false"><img class="tab_icon" src="icons/star1.png"/></a></li>
                    </ul>
                </div>
        </div>
    </div>

</body>
</html>