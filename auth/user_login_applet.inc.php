<?php

if(!isset($_SESSION["user"])) {
	?><p class="login">guest (<a href="auth/login.php">Login</a>)</p><?php
}
else {
	?><p class="login"><?=$_SESSION["user"]?> (<a href="auth/logout.action.php?>">Logout</a>)</p><?php
}

?>