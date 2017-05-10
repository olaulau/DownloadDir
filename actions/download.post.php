<?php
require_once '../includes/ALL.inc.php';

Session::start();


if(isset($_SESSION["user"])) {
	if(!empty($_POST["url"])) {
		$wget = "/usr/bin/wget";
		$cd = "cd '$base_dir/".$_POST["subdir"]."'";
		$referrer_string = empty($_POST["page"]) ? "" : "--referer '".$_POST["page"]."'";
		$options = "--content-disposition --no-check-certificate";
		$command = "$cd && $wget $options $referrer_string '".$_POST["url"]."'";
		set_time_limit(0);
		exec($command, $output, $ret_code);
		
		if($ret_code === 0) {
			redirect();
		}
		else {
			echo "<pre> $command </pre>";
			echo "DL finished. ret code : $ret_code <br/>";
			echo "output : <pre>" . var_export($output, TRUE) . "</pre>";
		}
	}
	else {
		echo L::actions_parameter_problem . '.';
		exit;
	}
	
}
else {
	sleep(3);
	exit;
}
