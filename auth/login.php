<?php
require_once '../includes/ALL.inc.php';

Session::start();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title></title>
	<script type="text/javascript" src="../js/sha.js"></script>
	<script type="text/javascript" src="../js/jquery.min.js"></script>
	<script src="../js/jquery-ui/jquery-ui.min.js"></script>
	<script type="text/javascript" src="login.js"></script>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
	<link href="../js/jquery-ui/jquery-ui.min.css" rel="stylesheet" />
	<link href="../js/jquery-ui/themes/smoothness/theme.css" rel="stylesheet" />
	<link href="../index.css" rel="stylesheet" type="text/css" />
</head>
<body>

<?php 
if(!empty($_SESSION["user"])) {
	echo L::auth_already_authed_label . '.';
}
else {
	?>
	<div class="centered-parent">
		<div class="centered-content">
			<form action="login.post.php" method="post">
				<table>
					<tr><td><?= L::auth_login_label ?> :</td><td><input type="text" name="user" id="user"></td></tr>
					<tr><td><?= L::auth_password_label ?> :</td><td><input type="password" name="password" id="password"></td></tr>
				</table>
				<input type="hidden" name="password_hashed" id="password_hashed">
				<input type="hidden" name="redirect" value="<?=$_SERVER["HTTP_REFERER"]?>">
				<button type="reset"><?=L::common_reset_button ?></button> <button type="submit" id="valider"><?=L::common_submit_button ?></button>
			</form>
		</div>
	</div>
	<?php
}
?>

<script src="../js/design.js"></script>
</body>
</html>
