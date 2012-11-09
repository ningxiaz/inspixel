$(document).ready(function(){
	$('#photo').change(function(){
		$('#upload_form').submit();
	});	
});


$('#my').live('pageinit',function(event){
	//show all photos first
	sendValue(-1);

  	$('.photo_list_item').live('tap',function(event) {
		var photo_id = $(this).find('.photo').attr('alt');
		$('#show_photo_id').val(photo_id);
		$('#show_form').submit();
	});

	$('#red').live('tap',function(event) {
    	sendValue(0);
	});

	$('#orange').live('tap',function(event) {
    	sendValue(1);
	});

	$('#yellow').live('tap',function(event) {
    	sendValue(2);
	});

	$('#green').live('tap',function(event) {
    	sendValue(3);
	});

	$('#cyan').live('tap',function(event) {
    	sendValue(4);
	});

	$('#blue').live('tap',function(event) {
    	sendValue(5);
	});

	$('#magenta').live('tap',function(event) {
    	sendValue(6);
	});

	$('#bwg').live('tap',function(event) {
    	sendValue(7);
	});
});

//send category values to php via AJAX and display results
function sendValue(val){
	$.post("show_photos.php", {sendValue: val}, function(data){
		$('.photo_list_wrapper').html(data.returnValue);
	}, "json");
}

$('#details').live('pageinit',function(event){
	$('#more_options').hide();

	$('#more').live('tap',function(event) {
		$('#more_options').show();
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
});

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
});

$('#edit').live('pageinit',function(event){
	$('#save_edit').live('tap',function(event) {
		$('#edit_form').submit();
	});
});

$('#fav').live('pageinit',function(event){
	//show faved photos
	sendValue(8);
});