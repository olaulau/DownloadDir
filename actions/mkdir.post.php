<?php
require_once '../includes/ALL.inc.php';

Session::start();


if(isset($_SESSION["user"])) {
	if(!empty($_POST["new_dir"])) {
		$full_dir = $base_dir."/" . $_POST["subdir"] . "/" . $_POST["new_dir"];
		$res = mkdir($full_dir);
// 		echo ($res ? "OK !" : "KO :-(");
		redirect();
	}
	else {
		//pb  de paramètres
	}
	
}
else {
	sleep(3);
	exit;
}
