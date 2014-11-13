<?php
require_once '../includes/ALL.inc.php';

Session::start();


// print_r($_POST); exit;

if(isset($_SESSION["user"])) {
	if(!empty($_POST["file"]) && !empty($_POST["new_subdir"])) {
		$full_file = $base_dir."/" . $_POST["subdir"] . "/" . $_POST["file"];
		if(file_exists($full_file)) {
			$full_new_file = $base_dir."/" . $_POST["new_subdir"] . "/" . $_POST["file"];
			$res = rename($full_file, $full_new_file);
// 			echo ($res ? "OK !" : "KO :-(");
			redirect($_POST["redirect"]);
		}
		else {
			echo "n'existe pas. bug ?";
		}
	}
	else {
		echo "pb de parametre.";
	}
	
}
else {
	sleep(3);
	exit;
}
