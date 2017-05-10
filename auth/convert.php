<?php 
require_once '../includes/ALL.inc.php';
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title></title>
</head>
<body>
<?php 
$original = !empty($_POST["original"]) ? $_POST["original"] : "";
$hashed = !empty($_POST["original"]) ? hash("sha512", hash("sha512", $_POST["original"])) : "";
?>
<form action="" method="post">
	<?= L::auth_original_label ?> : <input type="text" name="original" size="32" value="<?=$original?>"><br/>
	<?= L::auth_hashed_label ?> : <input type="text" name="result" size="100" value="<?=$hashed?>"><br/>
	<button type="submit"><?=L::common_submit_button ?></button>
</form>

</body>
</html>