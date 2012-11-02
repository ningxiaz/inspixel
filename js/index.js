$(document).ready(function(){
	var slider_shown = false;

	$('.photo_list_item').click(function(){
		var photo_id = $(this).find('.photo').attr('alt');
		$('#show_photo_id').val(photo_id);
		$('#show_form').submit();
	});

	$('.thumbnail').click(function(){
		window.location.href="index.php#details";
	});

	$('#photo').change(function(){
		$('#upload_form').submit();
	});

	$('#add_done').click(function(){
		$('#add_form').submit();
	});

	$('#color').click(function(){
		if(slider_shown){
			$('#slider_shaded').hide();
			slider_shown = false;
		}
		else{
			$('#slider_shaded').show();
			slider_shown = true;
		}
	});

});