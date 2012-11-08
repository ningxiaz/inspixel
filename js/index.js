$(document).ready(function(){
	$('#photo').change(function(){
		$('#upload_form').submit();
	});	
});


$('#my').live('pageinit',function(event){
  	$('.photo_list_item').click(function(){
		var photo_id = $(this).find('.photo').attr('alt');
		$('#show_photo_id').val(photo_id);
		$('#show_form').submit();
	});

	$('#search_tag').keypress(function(){
		window.location.href="index.php#tags";
	});
});

$('#details').live('pageinit',function(event){
	$('#more_options').hide();

	$('#more').click(function(){
		$('#more_options').show();
	});

	$('#cancel_button').click(function(){
		$('#more_options').hide();
	});

	$('#delete_button').click(function(){
		if(confirm("Are you sure to delete the photo?")){
			window.location.href="delete.php";
		}
		else{
			$('#more_options').hide();
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
    });
});

$('#edit').live('pageinit',function(event){
	$('#save_edit').click(function(){
		$('#edit_form').submit();
	});
});