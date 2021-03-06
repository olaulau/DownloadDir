<?php
require_once "header.inc.php";


$query = isset($_GET["query"]) ? $_GET["query"] : "";
$queries = explode(" ", $query);


// breadcrumb
?><h1>search results for </h1><?php
echo "<h2> / $query </h2>
<br/><br/>";
if($conf['debug'] === TRUE) echo "end of breadcrumbs <br/>";


exit;
////////////////
// continue work here
////////////////


// listing
$current_dir = $base_dir . "/" . $subdir;
$dir = dir($current_dir);
if($dir === FALSE) {
	die("ERROR : directory not found. ");
}
while($filename = $dir->read()) {
	$list[] = $filename;
}
if($conf['debug'] === TRUE) echo "end of listing <br/>";


// raw data's
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
		if(is_link($full_filename))
			$realpath = readlink($full_filename);
		else
			$realpath = null;
		$stat = stat($full_filename);
		$files_raw_data[] = array(
				"name" => $filename,
				"last_modified" => $stat["mtime"],
				"size" => $stat["size"],
				"is_directory" => $is_directory,
				"icon" => $icon,
				'realpath' => $realpath,
			);
	}
}
if($conf['debug'] === TRUE) echo "end of raw datas <br/>";


// sorting
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
if($conf['debug'] === TRUE) echo "end of sorting <br/>";


// formating data's
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
		<a href="actions/delete.get.php?subdir='.urlencode($subdir).'&file='.urlencode($file_raw_data["name"]).'" class="dialog_confirm">
			<img src="images/delete.svg" width="32" height="32" alt="'.L::admin_delete_action.'" title="'.L::admin_delete_action.'"/></a>
		<a href="actions/rename.get.php?subdir='.urlencode($subdir).'&file='.urlencode($file_raw_data["name"]).'">
			<img src="images/rename.svg" width="32" height="32" alt="'.L::admin_rename_action.'" title="'.L::admin_rename_action.'"/></a>
		<a href="actions/move.get.php?subdir='.  urlencode($subdir).'&file='.urlencode($file_raw_data["name"]).'">
			<img src="images/move.svg" width="32" height="32" alt="'.L::admin_move_action.'" title="'.L::admin_move_action.'"/></a>
		';
	$realpath = ( empty($file_raw_data['realpath']) ? '' : '-> '.$file_raw_data['realpath'] );
	
	$files_formated_data[] = array(
			'icon' => $icon,
			"name" => $name,
			"last_modified" => $last_modified,
			"size" => $size,
			"actions" => $actions,
			'realpath' => $realpath,
		);
}
if($conf['debug'] === TRUE) echo "end of formating <br/>";

		
// display
?>
<table>
	<tr>
<?php 
$current_url = new Url();
$fields = array(
		"icon" => '',
		"name" => L::table_name_header,
		"last_modified" => L::table_last_modified_header,
		"size" => L::table_size_header
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
		<td><?=$file_formated_data["name"]?>
<?php 
if(isset($_SESSION["user"])) {
	if(!empty($file_formated_data["realpath"])) {
		?>
			<br/> <?=$file_formated_data["realpath"]?>
		<?php
	}
}
?>
		</td>
		<td><?=$file_formated_data["last_modified"]?></td>
		<td><?=$file_formated_data["size"]?></td>
<?php 
if(isset($_SESSION["user"])) {
	?>
		<td><?=$file_formated_data["actions"]?></td>
	<?php
}
?>
	</tr>
	<?php 
}

?>
</table>


<div id="dialog" title="<?=L::admin_confirm_title ?>">
	<p><?= L::admin_delete_confirm ?></p>
</div>


<?php
require_once "footer.inc.php";
?>


</body>
</html>