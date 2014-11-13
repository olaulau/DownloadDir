<?php
require_once '../includes/ALL.inc.php';

Session::start();
?>

<html>
<head>
	<title>Login</title>
	<script type="text/javascript" src="../js/sha.js"></script>
	<script type="text/javascript" src="../js/jquery-2.0.3.min.js"></script>
	<script type="text/javascript" src="login.js"></script>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
</head>
<body>

<?php 
if(!empty($_SESSION["user"])) {
	?>Vous êtes déjà authentifié.<?php
}
else {
	?>
	<form action="login.post.php" method="post">
		<table>
			<tr><td>identifiant :</td><td><input type="text" name="user" id="user"></td></tr>
			<tr><td>mot de passe :</td><td><input type="password" id="password"></td></tr>
		</table>
		<input type="hidden" name="password" id="password_hashed">
		<input type="hidden" name="redirect" value="<?=$_SERVER["HTTP_REFERER"]?>">
		<button type="reset">Effacer</button> <button type="submit" id="valider">Valider</button>
	</form>
	<?php
}
?>

</body>
</html>
