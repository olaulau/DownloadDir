<?php
require_once '../includes/ALL.inc.php';

Session::start();


if(!empty($_SESSION["user"])) {
// 	unset($_SESSION["user"]);
	Session::unset_var("user");
// 	echo "OK !";
	// redirection avec récup réferrer
	redirect();
}
else {
	//pas authentifié
}
