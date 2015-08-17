var _URL = window.URL || window.webkitURL;
function displayPreview(files, id) {
   var file = files[0]
   var img = new Image();
   var sizeKB = file.size / 1024;
   img.onload = function() {
      jQuery('.images-'+id).append(img);
      //alert("Size: " + sizeKB + "KB\nWidth: " + img.width + "\nHeight: " + img.height);
   }
   img.src = _URL.createObjectURL(file);
}

jQuery(document).ready(function()
{
	jQuery('#emrede-suporte-option-1, #emrede-suporte-option-2').click(function() {
		jQuery('.emrede-suporte-tempo, .emrede-suporte-esfera').fadeIn(600);
	});
	jQuery('#emrede-suporte-option-0').click(function() {
		jQuery('.emrede-suporte-tempo, .emrede-suporte-esfera').fadeOut(600);
	});
	
	
	if(jQuery('#emrede-suporte-option-1:checked, #emrede-suporte-option-2:checked').length > 0)
	{
		jQuery('.emrede-suporte-tempo, .emrede-suporte-esfera').show();
	}
	else
	{
		jQuery('.emrede-suporte-tempo, .emrede-suporte-esfera').hide();
	}
	
});


function emrede_scroll_to_anchor(id)
{
	jQuery('body, html').animate({
	    scrollTop:   jQuery('#'+id).offset().top - 100
	}, 800);
}