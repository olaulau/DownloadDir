<?php
require_once '../includes/ALL.inc.php';

Session::start();


if(isset($_SESSION["user"])) {
	if(!empty($_POST["new_dir"])) {
		$full_dir = realpath($base_dir) . "/" . (!empty($_POST["subdir"]) ? $_POST["subdir"]."/" : "") . $_POST["new_dir"];
// 		vdd($full_dir);
		$res = mkdir($full_dir);
		if($res) {
			redirect();
		}
		else {
			echo L::actions_error_occured;
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
