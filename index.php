<?php
$generation_start = microtime(TRUE);

require_once 'includes/ALL.inc.php';

Session::start();

$subdir = isset($_GET["subdir"]) ? $_GET["subdir"] : "";
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>downloads</title>
	<link href="index.css" rel="stylesheet" type="text/css" />
</head>
<body>


<table width="100%" class="hidden"><tr>
<td width="50%">
<?php
// rsync button
if(isset($_SESSION["user"])) {
	?>
	<form action="actions/rsync.action.php" method="get">
		<button type="submit">rsync with NAS's</button>
	</form>
	<?php
}
?>
</td>

<td width="50%">
<?php 
require 'auth/user_login_applet.inc.php';
?>
</td>
</tr></table>







<?php
if(isset($_SESSION["user"])) {
	?>
<fieldset>
	<legend>actions</legend>
	
<!-- new directory -->
<form action="actions/mkdir.post.php" method="post">
	<label for="new_dir">nouveau répertoire :</label>
	<input type="text" name="new_dir" size="100" maxlength="256"/>
	<input type="hidden" name="subdir" value="<?=$subdir?>"/>
	<button type="submit">Créer</button>
</form>

<br/>

<!-- download form -->
	<form action="actions/download.post.php" method="post">
		<table>
			<tr><td>fichier</td> <td><input type="text" name="url" size="100" maxlength="2048"></td> <td rowspan="2"><button type="submit">Télécharger</button></td> </tr>
			<tr><td>page (referer, optionnel)</td> <td><input type="text" name="page" size="100" maxlength="2048"></td></tr>
		</table>
		<input type="hidden" name="subdir" value="<?=$subdir?>"/>
	</form>
</fieldset>
<br/>
	<?php
}


// fil d'arianne
?><h1><a href="./">Downloads</a></h1><?php
$directories = explode("/", $subdir);
$current_dirs = array();
foreach ($directories as $directory) {
	$current_dirs[] = $directory;
	$current_dir = implode("/", $current_dirs);
	$liens[] = '<a href="index.php?subdir=' . $current_dir . '">' . $directory . '</a>';
}
echo "<h2> / " . implode(" / ", $liens) . "</h2>
<br/><br/>";


// listing
$current_dir = $base_dir . "/" . $subdir;
$dir = dir($current_dir);
while($filename = $dir->read()) {
	$list[] = $filename;
}


// données brutes
$files_raw_data = array();
foreach ($list as $filename) {
	if(!in_array($filename, $exclude)) {
		$new_subdir = new_subdir($subdir, $filename);
		$full_filename = $base_dir . "/" . $new_subdir;
		if(is_dir($full_filename)) {
			$is_directory = TRUE;
			$icon = $conf["directory_icon"];
		}
		else {
			$is_directory = FALSE;
			$icon = getIcon($filename);
		}
			
		$stat = stat($full_filename);
		
		$files_raw_data[] = array(
				"name" => $filename,
				"last_modified" => $stat["mtime"],
				"size" => $stat["size"],
				"is_directory" => $is_directory,
				"icon" => $icon
			);
	}
}


// tri
$sort_field = isset($_GET["sort_field"]) ? $_GET["sort_field"] : "name";
$sort_order = isset($_GET["sort_order"]) ? $_GET["sort_order"] : "ASC";

if($sort_field == "name") {
	$files_raw_data = msort($files_raw_data, array("is_directory", "name"), SORT_LOCALE_STRING);
}
else {
	$files_raw_data = msort($files_raw_data, $sort_field, SORT_NUMERIC);
}
if($sort_order == "DESC")
	$files_raw_data = array_reverse($files_raw_data);


// formatage données
$files_formated_data = array();
foreach ($files_raw_data as $file_raw_data) {
	$last_modified = date("d/m/Y H:i:s", $file_raw_data["last_modified"]);
	$new_subdir = new_subdir($subdir, $file_raw_data["name"]);
	if($file_raw_data["is_directory"]) {
		$icon = '<img src="http://www.d-l.fr' . $file_raw_data["icon"] . '" width=32px", height="32px" />';
		$name = '<a href="index.php?subdir=' . $new_subdir . '">' . $file_raw_data["name"] . "</a>";
		$size = "";
	}
	else {
		$url = $base_url . "/" . $new_subdir;
		$icon = '<img src="http://www.d-l.fr'.$file_raw_data["icon"].'" width=32px", height="32px" />';
		$name = '<a href="' . $url . '">' . '' . $file_raw_data["name"] . '</a>';
		$size = sizeToString($file_raw_data["size"]);
	}
	
	$actions = '
		<a href="actions/delete.get.php?subdir='.urlencode($subdir).'&file='.urlencode($file_raw_data["name"]).'">supprimer</a>
		<a href="actions/rename.get.php?subdir='.urlencode($subdir).'&file='.urlencode($file_raw_data["name"]).'">renommer</a>
		<a href="actions/move.get.php?subdir='.  urlencode($subdir).'&file='.urlencode($file_raw_data["name"]).'">déplacer</a>
		';
	
	$files_formated_data[] = array(
			'icon' => $icon,
			"name" => $name,
			"last_modified" => $last_modified,
			"size" => $size,
			"actions" => $actions
		);
}

		
// affichage
?>
<table>
	<tr>
<?php 
$current_url = new Url();
$fields = array(
		"icon" => '',
		"name" => "Nom",
		"last_modified" => "Dernière modif",
		"size" => "Taille"
	);
foreach ($fields as $field_name => $field_label) {
	$url = clone $current_url;
	$url->setQueryParameter("sort_field", $field_name);
	if( $sort_field == $field_name  &&  $sort_order == "ASC" )
		$url->setQueryParameter("sort_order", "DESC");
	else
		$url->setQueryParameter("sort_order", "ASC");
	$u = $url->getFullUrl();
	echo '		<th><a href="'.$u.'">'.$field_label.'</a></th>';
	
}
if(isset($_SESSION["user"])) {
	?>	<th>&nbsp;</th><?php 
}
?>
	</tr>
	
	
<?php
foreach ($files_formated_data as $file_formated_data) {
	?>
	<tr>
		<td><?=$file_formated_data["icon"]?></td>
		<td><?=$file_formated_data["name"]?></td>
		<td><?=$file_formated_data["last_modified"]?></td>
		<td><?=$file_formated_data["size"]?></td>
<?php 
if(isset($_SESSION["user"])) {
	?>	<td><?=$file_formated_data["actions"]?></td><?php
}
?>
	</tr>
	<?php 
}

?>
</table>

<p class="footer">
	<?php 
	$generation_end = microtime(TRUE);
	$generation_time = $generation_end - $generation_start;
	$generation_time = round($generation_time*1000);
	?>
	page build in <?= $generation_time ?> ms - powered by <a href="https://github.com/olaulau/DownloadDir">DownloadDir</a>
</p>

</body>
</html>
