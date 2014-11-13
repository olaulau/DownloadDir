<?php
require_once '../includes/ALL.inc.php';

Session::start();


$user = $_POST["user"];
$password = $_POST["password"];
// echo "$user $password";

if(!empty($user) && !empty($password)) {
	if(isset($auth["users"][$user])) {
		$hashed = hash("sha512", $password);
		if($hashed == $auth["users"][$user]) {
			Session::set_var("user", $user);
			// 		echo "OK !";
			redirect($_POST["redirect"]);
		}
		else {
			echo "NOP :-/";
			echo "password mismatch";
			sleep(3);
			//redirection écran login avec message
		}
	}
	else {
		echo "NOP :-/";
		echo "utilisateur inconnu";
		sleep(3);
		//redirection écran login avec message
	}
}
else {
	// pb paramètres
	echo "champs non renseignés";
}