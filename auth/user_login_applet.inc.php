<?php

if(!isset($_SESSION["user"])) {
	?><p class="login"><?= L::auth_guest ?> (<a href="auth/login.php"><?= L::auth_loging_label ?></a>)</p><?php
}
else {
	?><p class="login"><?=$_SESSION["user"]?> (<a href="auth/logout.action.php?>"><?= L::auth_logout_label ?></a>)</p><?php
}

?>