<?php
require_once '../includes/ALL.inc.php';

Session::start();


if(isset($_SESSION["user"])) {
	$s = new Syncer($conf["sync_script_dir"]);
	if(isset($_GET['id'])) {
		if(is_numeric($_GET['id'])) {
			$id = intval($_GET['id']);
			$res = $s->launchScript($id);
			if($res === '')
				redirect();
			else
				echo $res;
		}
		else {
			sleep(3);
			exit;
		}
	}
	else {
		$res = $s->launchAllScripts();
		if($res === '')
			redirect();
		else
			echo $res;
	}
}
else {
	sleep(3);
	exit;
}
