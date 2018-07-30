<?php
require_once '../includes/ALL.inc.php';

Session::start();


if(isset($_SESSION["user"])) {
	if(!empty($_POST["destination"])) {
		$current_dir = $base_dir."/" . $_POST["subdir"];
		if(file_exists($current_dir.'/'.$_POST["destination"])) {
			$basename = basename($_POST["destination"]);
			$res = symlink($_POST["destination"], $current_dir.'/'.$basename);
			// 	echo ($res ? "OK !" : "KO :-(");
			redirect();
		}
		else {
			echo L::actions_dest_doesnt_exist . '.';
			// symlink destination doesn't exist
			// create it anyway ? does basename work with non-existing path ? does it work with relative path ?
			// add possibility to create named links ?
		}
	}
	else {
		echo L::actions_parameter_problem;
	}
	
}
else {
	sleep(3);
	exit;
}
