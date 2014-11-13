$(function(){
	
	$("button#valider").click(function(){
		password = $("#password").val();
		var shaObj = new jsSHA(password, "TEXT");
		var hash = shaObj.getHash("SHA-512", "HEX");
		$("#password_hashed").val(hash);
		
		$("form").submit();
	});
	
});