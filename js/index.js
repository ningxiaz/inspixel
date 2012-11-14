$('#my').live('pageinit',function(event){
	//show all photos by default
	ajax_show_photos(-1);

	//auto upload photo
	$('#photo_input_my').change(function(){
		$('#upload_form_my').submit();
	});	

  	$('.photo_list_item').live('tap',function(event) {
		var photo_id = $(this).find('.photo').attr('alt');
		$('#show_photo_id').val(photo_id);
		$('#show_form').submit();
	});

	$('#red').live('tap',function(event) {
    	ajax_show_photos(0);
	});

	$('#orange').live('tap',function(event) {
    	ajax_show_photos(1);
	});

	$('#yellow').live('tap',function(event) {
    	ajax_show_photos(2);
	});

	$('#green').live('tap',function(event) {
    	ajax_show_photos(3);
	});

	$('#cyan').live('tap',function(event) {
    	ajax_show_photos(4);
	});

	$('#blue').live('tap',function(event) {
    	ajax_show_photos(5);
	});

	$('#magenta').live('tap',function(event) {
    	ajax_show_photos(6);
	});

	$('#bwg').live('tap',function(event) {
    	ajax_show_photos(7);
	});

	$('#settings').hide();

	$('#settings_button').live('tap',function(event) {
		$('#settings').toggle();
	});

	$('#cancel_settings').live('tap',function(event) {
		$('#settings').hide();
	});

	$('.swatch').live('tap',function(event) {
		var rgb_string = $(this).css("background-color");
		$('<div>').simpledialog2({
		    mode: 'blank',
		    headerText: 'Color Value',
		    headerClose: true,
		    blankContent : 
		      "<ul data-role='listview'><li>"+colorToHex(rgb_string)+"</li></ul>"+
		      "<a rel='close' data-role='button' href='#'>Close</a>"
		  })
	});
});

//send category values to php via AJAX and display results
function ajax_show_photos(val){
	$.post("show_photos.php", {sendValue: val}, function(data){
		$('.photo_list_wrapper').html(data.returnValue);
	}, "json");
}

$('#details').live('pageinit',function(event){
	//auto upload photo
	$('#photo_input_details').change(function(){
		$('#upload_form_details').submit();
	});	

	$('#more_options').hide();

	$('#more').live('tap',function(event) {
		$('#more_options').toggle();
	});

	$('#cancel_button').live('tap',function(event) {
		$('#more_options').hide();
	});

	$('#delete_button').live('tap',function(event) {
		if(confirm("Are you sure to delete the photo?")){
			window.location.href="delete.php";
		}
		else{
			$('#more_options').hide();
		}
	});

	$('#fav_button').live('tap',function(event) {
		var button = $(this);

		//if the photo is not faved, fav it
		if(button.hasClass('not_faved')){
			$.post("fav.php", {sendValue: 1}, function(){
				button.addClass('faved').removeClass('not_faved');
			});
		}

		//otherwise, unfav it
		else if(button.hasClass('faved')){
			$.post("fav.php", {sendValue: 0}, function(){
				button.addClass('not_faved').removeClass('faved');
			});
		}
	});

	$('.swatch').live('tap',function(event) {
		var rgb_string = $(this).css("background-color");
		$('<div>').simpledialog2({
		    mode: 'blank',
		    headerText: 'Color Value',
		    headerClose: true,
		    blankContent : 
		      "<ul data-role='listview'><li>"+colorToHex(rgb_string)+"</li></ul>"+
		      "<a rel='close' data-role='button' href='#'>Close</a>"
		  })
	});
});

function colorToHex(color) {
    if (color.substr(0, 1) === '#') {
        return color;
    }
    var digits = /(.*?)rgb\((\d+), (\d+), (\d+)\)/.exec(color);
    
    var red = parseInt(digits[2]);
    var green = parseInt(digits[3]);
    var blue = parseInt(digits[4]);
    
    var rgb = blue | (green << 8) | (red << 16);
    return digits[1] + '#' + rgb.toString(16);
};

$('#add').live('pageinit',function(event){
	$('#add_done').click(function(){
		$('#add_form').submit();
	});

    // Once image is loaded, get dominant color and palette and display them.
    $('.new_photo').bind('load', function (event) {
        var image = event.target;
        var $image = $(image);
        var imageSection = $image.closest('.photo_list_item');
        var appendColors = function (colors, root) {
            $.each(colors, function (index, value) {
                var swatch_div = $('<div>', {'class': 'swatch'})
                    .css('background-color', 'rgba('+ value +', 1)');
                root.append(swatch_div);
            });
        };

        // Palette
        var colorCount = $image.attr('data-colorcount') ? $image.data('colorcount') : 5;
        var medianPalette = createPalette(image, colorCount);
        console.log(medianPalette);
        var medianCutPalette = imageSection.find('.palette');
        appendColors(medianPalette, medianCutPalette);
        
        //record the color values for database storage
        for(var i = 0; i < medianPalette.length; i++){
        	$('#color_'+(i+1)).val(medianPalette[i]);
        }

        //get the color category and store it
        var cat = colorClassification(medianPalette[0]);
        console.log(cat);
        $('#category').val(cat);

    });

	//get current location
	if (navigator.geolocation) {
		navigator.geolocation.getCurrentPosition(success, error);
	}

	function error(){
		alert("Sorry, can't get your current location!");
	}	

	function success(position){
		$('#lat').val(position.coords.latitude);
		$('#lng').val(position.coords.longitude);
		if(position.coords.latitude==='' || position.coords.latitude===null || position.coords.latitude===undefined){
			alert("Sorry, your location is currently unavailable, this picture will not have location information.");
		}
		else{
			getPlaces(position.coords.latitude, position.coords.longitude);
		}
	}


});

function getPlaces(lat, lng){
	var geocoder = new google.maps.Geocoder();
        var latlng = new google.maps.LatLng(lat, lng);

        geocoder.geocode({'latLng': latlng}, function(results, status) {
         	if (status == google.maps.GeocoderStatus.OK) {
               if (results[1]) {
                	console.log(results);
                	    for (var i = 0; i < results.length; i++) {
                	            var item = "<option value=\""+results[i].formatted_address+"\">"+results[i].formatted_address+"</option>";
                	            $('#place').append(item);
                	        };
                	    } else {
                	      alert('No results found');
                	    }
        	} else {
               alert('Geocoder failed due to: ' + status);
        	}
        });
}

$('#edit').live('pageinit',function(event){
	$('#save_edit').live('tap',function(event) {
		$('#edit_form').submit();
	});
});

$('#fav').live('pageinit',function(event){
	//show faved photos
	ajax_show_photos(8);

	//auto upload photo
	$('#photo_input_fav').change(function(){
		$('#upload_form_fav').submit();
	});	

	$('.photo_list_item').live('tap',function(event) {
		var photo_id = $(this).find('.photo').attr('alt');
		$('#show_photo_id').val(photo_id);
		$('#show_form').submit();
	});
});

$('#search').live('pageinit',function(event){
	//show all tags and photos by default
	ajax_search_photos("");

	//auto upload photo
	$('#photo_input_search').change(function(){
		$('#upload_form_search').submit();
	});	

	$('#search_tag').keyup(function(){
		var search_query = $(this).val();
		console.log(search_query);
		ajax_search_photos(search_query);
	});

	$('.thumbnail').live('tap',function(event) {
		var photo_id = $(this).find('img').attr('alt');
		$('#show_photo_id').val(photo_id);
		$('#show_form').submit();
	});
});

function ajax_search_photos(search_query){
	$.post("search_photos.php", {sendValue: search_query}, function(data){
		$('.search_result').html(data.returnValue);
	}, "json");
}