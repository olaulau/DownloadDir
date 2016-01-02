<?php

if(!isset($_SESSION["user"])) {
	?><span><?= L::auth_guest ?> (<a href="auth/login.php"><?= L::auth_loging_label ?></span>)</span><?php
}
else {
	?><span><?=$_SESSION["user"]?> (<a href="auth/logout.action.php?>"><?= L::auth_logout_label ?></v>)</span><?php
}

?>