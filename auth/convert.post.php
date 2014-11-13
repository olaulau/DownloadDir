<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Insert title here</title>
</head>
<body>
<?php 
$original = !empty($_POST["original"]) ? $_POST["original"] : "";
$hashed = !empty($_POST["original"]) ? hash("sha512", hash("sha512", $_POST["original"])) : "";
?>
<form action="" method="post">
	original : <input type="text" name="original" size="32" value="<?=$original?>"><br/>
	hashé (SHA512 client  & serveur) : <input type="text" name="result" size="100" value="<?=$hashed?>"><br/>
	<button type="submit">Valider</button>
</form>

</body>
</html>