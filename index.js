//  style all buttons
$( "a, button" ).button();

//  build sync choice button
$("#sync_select")
.button({
	text : false,
	icons : {
		primary : "ui-icon-triangle-1-s"
	}
}).click(function() {
	var menu = $(this).parent().next().toggle().position({
		my : "left top",
		at : "left bottom",
		of : this
	});
	$(document).one("click", function() {
		menu.hide();
	});
	return false;
}).parent().buttonset().next().hide().menu();


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
