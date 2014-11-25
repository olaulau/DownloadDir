<?php
require_once '../includes/ALL.inc.php';

Session::start();


if(isset($_SESSION["user"])) {
	if(!empty($_GET["file"])) {
		$full_file = $base_dir."/" . $_GET["subdir"] . "/" . $_GET["file"];
		if(file_exists($full_file)) {
			if(!is_link($full_file) && is_dir($full_file)) {
				$res = rmdir($full_file);
			}
			else {
				$res = unlink($full_file);
			}
// 			echo ($res ? "OK !" : "KO :-("); die;
			redirect();
		}
		else {
			echo L::actions_doesnt_exist;
		}
	}
	else {
		echo L::actions_parameter_problem . '.';
	}
	
}
else {
	sleep(3);
	exit;
}
