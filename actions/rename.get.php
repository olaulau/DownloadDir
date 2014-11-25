<?php
require_once '../includes/ALL.inc.php';

Session::start();


if(isset($_SESSION["user"])) {
	if(!empty($_GET["file"])) {
		$full_file = $base_dir."/" . $_GET["subdir"] . "/" . $_GET["file"];
		if(file_exists($full_file)) {
			?>
			<form action="rename.post.php" method="post">
				<?= L::actions_new_name ?> :<input type="text" name="new_file" value="<?=$_GET["file"]?>" />
				<input type="hidden" name="subdir" value="<?=$_GET["subdir"]?>">
				<input type="hidden" name="file" value="<?=$_GET["file"]?>">
				<input type="hidden" name="redirect" value="<?=$_SERVER["HTTP_REFERER"]?>">
				<button type="submit"><?= L::common_submit_button?></button>
			</form>
			<?php 
		}
		else {
			echo L::actions_doesnt_exist;
		}
	}
	else {
		echo L::actions_parameter_problem;
	}
	
}
else {
	sleep(3);
	exit;
}
