<?php
require_once '../includes/ALL.inc.php';
$app_base_path = app_base_path();

Session::start();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title></title>
	<link href="<?=$app_base_path?>/index.css" rel="stylesheet" type="text/css" />
</head>
<body>

<?php
if(isset($_SESSION["user"])) {
	if(!empty($_GET["file"])) {
		$full_file = $base_dir."/" . $_GET["subdir"] . "/" . $_GET["file"];
		if(file_exists($full_file)) {
			?>
			<form action="rename.post.php" method="post">
				<?= L::actions_new_name ?> :<input type="text" name="new_file" value="<?=$_GET["file"]?>" size="64"/>
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
