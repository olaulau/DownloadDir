<table width="100%" class="no_border"><tr>
<td width="50%">
<?php
// rsync button
if(isset($_SESSION["user"])) {
	?>
	<form action="actions/rsync.action.php" method="get">
		<div>
			<button type="submit"><?= L::admin_rsync_button; ?></button>
			<button id="sync_select">Select an action</button>
		</div>
		<ul>
			<li>1</li>
			<li>2</li>
			<li>3</li>
		</ul>
	</form>
	<?php
}
?>
</td>

<td width="50%">
<div class="right_applet">
	<span>
<!--		<form action="search.php" method="get" name="search"> -->
<!--			<input type="text" name="query" value="<?= L::header_search_action; ?>"></input> -->
<!--			<button type="submit">envoyer</button> -->
		</form>
	</span>
	<?php 
	if(!isset($_SESSION["user"])) {
		?><span><?= L::auth_guest ?> <a href="auth/login.php"><?= L::auth_loging_label ?></a></span></span><?php
	}
	else {
		?><span><?=$_SESSION["user"]?> <a href="auth/logout.action.php?>"><?= L::auth_logout_label ?></a></span><?php
	}
	?>
</div>
</td>
</tr></table>
