$(function(){
	var href = '';
	
	$( "#dialog" ).dialog({
		autoOpen: false,
		width: 400,
		buttons: [
			{
				text: "Ok",
				click: function() {
					window.location.href = href;
					$( this ).dialog( "close" );
				}
			},
			{
				text: "Cancel",
				click: function() {
					href = '';
					$( this ).dialog( "close" );
				}
			}
		]
	});

	// Link to open the dialog 
	$( ".dialog_confirm" ).each(function(){
		$(this).click(function( event ) {
			href = $(this).attr('href');
			$( "#dialog" ).dialog( "open" );
			event.preventDefault();
		});
	});
});
