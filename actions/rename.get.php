<?php
require_once '../includes/ALL.inc.php';

Session::start();


if(isset($_SESSION["user"])) {
	if(!empty($_GET["file"])) {
		$full_file = $base_dir."/" . $_GET["subdir"] . "/" . $_GET["file"];
		if(file_exists($full_file)) {
			////////////
			?>
			<form action="rename.post.php" method="post">
				nouveau nom :<input type="text" name="new_file" value="<?=$_GET["file"]?>" />
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
