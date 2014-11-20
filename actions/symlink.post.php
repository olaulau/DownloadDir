<?php
require_once '../includes/ALL.inc.php';

Session::start();


if(isset($_SESSION["user"])) {
	if(!empty($_POST["destination"])) {
		if(file_exists($_POST["destination"])) {
			$basename = basename($_POST["destination"]);
			$current_dir = $base_dir."/" . $_POST["subdir"];
			$res = symlink($_POST["destination"], $current_dir.'/'.$basename);
			// 	echo ($res ? "OK !" : "KO :-(");
			redirect();
		}
		else {
			// symlink destination doesn't exist
			// create it anyway ? does basename work with non-existing path ? does it work with relative path ?
			// add possibility to create named links ?
		}
	}
	else {
		//pb  de paramètres
	}
	
}
else {
	sleep(3);
	exit;
}
