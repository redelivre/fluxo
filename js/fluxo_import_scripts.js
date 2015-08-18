/**
 * 
 */

jQuery(function()
{
	jQuery("#importcsv").click(function(event)
	{
		event.preventDefault();
		var data =
        {
                action: 'ImportarCsv',
        };
         
        jQuery.ajax(
        {
            type: 'POST',
                    url: fluxo_import_scripts_object.ajax_url,
            data: data,
            success: function(response)
            {
            	jQuery('#result').replaceWith(response);
            },
        });
	});
	jQuery("#check-estado-cidade").click(function(event)
	{
		event.preventDefault();
		var data =
        {
                action: 'CheckEstadoCidade',
        };
         
        jQuery.ajax(
        {
            type: 'POST',
                    url: fluxo_import_scripts_object.ajax_url,
            data: data,
            success: function(response)
            {
            	jQuery('#result').append(response);
            },
        });
	});
	
});