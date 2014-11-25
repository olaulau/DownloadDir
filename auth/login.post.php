<?php
require_once '../includes/ALL.inc.php';

Session::start();


$user = $_POST["user"];
$password = $_POST["password"];
// echo "$user $password";

if(!empty($user) && !empty($password)) {
	$hashed = hash("sha512", $password);
	if(isset($auth["users"][$user])  &&  $hashed == $auth["users"][$user]) {
		Session::set_var("user", $user);
		// 	echo "OK !";
		redirect($_POST["redirect"]);
	}
	else {
		echo L::auth_bad_login;
		sleep(3);
		// redirect to login screen with a message
	}
}
else {
	// pb paramètres
	echo L::common_missing_informations;
}