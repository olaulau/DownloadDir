<?php
require_once "../html-head.inc.php";
?>

	<script TYPE="text/javascript" src="../js/sha.js"></script>
	<script type="text/javascript" src="../js/login.js"></script>

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
					<tr><td><?= L::auth_login_label ?> :</td><td><input type="text" name="user" id="user" autofocus></td></tr>
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
