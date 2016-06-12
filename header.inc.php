<table width="100%" class="no_border"><tr>
<td width="50%">
<?php
// rsync button
if(isset($_SESSION["user"])) {
	?>
	<div>
		<a href="actions/sync.action.php"><?= L::admin_rsync_button; ?></a>
		<button id="sync_select">Select an action</button>
	</div>
	<ul>
		<?php
		$s = new Syncer($conf["sync_script_dir"]);
		$scripts = $s->listScripts();
		foreach ($scripts as $id => $script) {
			echo '<li><a href="actions/sync.action.php?id='.$id.'">' . $script . '</a></li>';
		}
		?>
	</ul>
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
