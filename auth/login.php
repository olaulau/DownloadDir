<?php
require_once '../includes/ALL.inc.php';

Session::start();
?>

<html>
<head>
	<title></title>
	<script type="text/javascript" src="../js/sha.js"></script>
	<script type="text/javascript" src="../js/jquery-2.1.1.min.js"></script>
	<script type="text/javascript" src="login.js"></script>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
	<link href="../index.css" rel="stylesheet" type="text/css" />
</head>
<body>

<?php 
if(!empty($_SESSION["user"])) {
	echo L::auth_already_authed_label . '.';
}
else {
	?>
	<form action="login.post.php" method="post">
		<table>
			<tr><td><?= L::auth_login_label ?> :</td><td><input type="text" name="user" id="user"></td></tr>
			<tr><td><?= L::auth_password_label ?> :</td><td><input type="password" id="password"></td></tr>
		</table>
		<input type="hidden" name="password" id="password_hashed">
		<input type="hidden" name="redirect" value="<?=$_SERVER["HTTP_REFERER"]?>">
		<button type="reset"><?=L::common_reset_button ?></button> <button type="submit" id="valider"><?=L::common_submit_button ?></button>
	</form>
	<?php
}
?>

</body>
</html>