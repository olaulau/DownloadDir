<?php
$generation_start = microtime(TRUE);

require_once 'includes/ALL.inc.php';

Session::start();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title><?= $conf['title'] ?></title>
	<link href="index.css" rel="stylesheet" type="text/css" />
	<link href="js/jquery-ui/jquery-ui.min.css" rel="stylesheet">
	<link href="js/jquery-ui/themes/smoothness/theme.css" rel="stylesheet">
</head>
<body>
<script src="./js/jquery-2.1.1.min.js"></script>
<script src="js/jquery-ui/jquery-ui.min.js"></script>
<script src="index.js"></script>

<table width="100%" class="hidden"><tr>
<td width="50%">
<?php
// rsync button
if(isset($_SESSION["user"])) {
	?>
	<form action="actions/rsync.action.php" method="get">
		<button type="submit"><?= L::admin_rsync_button; ?></button>
	</form>
	<?php
}
?>
</td>

<td width="50%">
<div style="float: right; border: none;">
	<span>search</span>
	<?php 
	require 'auth/user_login_applet.inc.php';
	?>
</div>
</td>
</tr></table>