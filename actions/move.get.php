<?php
require_once '../includes/ALL.inc.php';

Session::start();



if(isset($_SESSION["user"])) {
	if(!empty($_GET["file"])) {
		$full_file = $base_dir."/" . $_GET["subdir"] . "/" . $_GET["file"];
		if(file_exists($full_file)) {
			?>
			<form action="move.post.php" method="post">
				deplacer vers :<br/>
				<?php 
				$tab = getAllSubdir($base_dir, "", $exclude);
				$tab = array_merge(array("/"), array_struct_flatten($tab, "/"));
				sort($tab);
				?>
				
				<select size="<?=count($tab)?>" name="new_subdir">
				<?php 
				foreach ($tab as $dir) {
					?><option><?=$dir?></option><?php 
				}
				?>
				</select>
				
				<input type="hidden" name="subdir" value="<?=$_GET["subdir"]?>">
				<input type="hidden" name="file" value="<?=$_GET["file"]?>">
				<input type="hidden" name="redirect" value="<?=$_SERVER["HTTP_REFERER"]?>">
				<button type="submit">Valider</button>
			</form>
			<?php 
		}
		else {
			echo "n'existe pas. bug ?";
		}
	}
	else {
		echo "pb de parametre.";
	}
	
}
else {
	sleep(3);
	exit;
}
