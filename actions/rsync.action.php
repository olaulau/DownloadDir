<?php
require_once '../includes/ALL.inc.php';

Session::start();


if(isset($_SESSION["user"])) {
	set_time_limit(0);
	$command = $download_push_command;
	exec($command, $output, $ret_code);

	if($ret_code === 0) {
		redirect();
	}
	else {
		echo "<pre> $command </pre>";
		echo "downloads_push finished. ret code : $ret_code <br/>";
		echo "output : <pre>" . var_export($output, TRUE) . "</pre>";
	}
}
else {
	sleep(3);
	exit;
}
