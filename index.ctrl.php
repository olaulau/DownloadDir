<?php

$subdir = isset($_GET["subdir"]) ? $_GET["subdir"] : "";


// breadcrumb
$directories = explode("/", $subdir);
$current_dirs = array();
$breads = array('<h1><a href="./">' . $conf['title'] . '</a></h1>');
foreach ($directories as $directory) {
	if($directory !== "") { // subdir can be empty (at root level)
		$current_dirs[] = $directory;
		$current_dir = implode("/", $current_dirs);
		$breads[] = '<h2><a href="index.php?subdir=' . $current_dir . '">' . $directory . '</a></h2>';
	}
}
if($conf['debug'] === TRUE) echo "end of breadcrumbs <br/>";


// listing
$current_dir = $base_dir . "/" . $subdir;
$dir = dir($current_dir);
if($dir === FALSE) {
	die("ERROR : directory not found. ");
}
$list = [];
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
		
		$realpath = null;
		$link_destination = null;
		if (is_link($full_filename)) {
			$link_destination = readlink($full_filename);
			$realpath = $link_destination;
			if (!file_exists($link_destination)) {
				$realpath = $current_dir . "/" . $link_destination;
			}
		}
			
		$stat = stat($full_filename);
		$files_raw_data[] = array(
				"name" => $filename,
				"last_modified" => $stat["mtime"],
				"size" => $stat["size"],
				"is_directory" => $is_directory,
				"icon" => $icon,
				'link_destination' => $link_destination,
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
$sum_of_files_size = 0;
$files_formated_data = array();
foreach ($files_raw_data as $file_raw_data) {
	$last_modified = date("d/m/Y H:i:s", $file_raw_data["last_modified"]);
	$new_subdir = new_subdir($subdir, $file_raw_data["name"]);
	if($file_raw_data["is_directory"]) {
		$icon = '<img src="' . $file_raw_data["icon"] . '" width=32px", height="32px" />';
		$name = '<a href="index.php?subdir=' . $new_subdir . '">' . $file_raw_data["name"] . "</a>";
		$size = "";
	}
	else {
		$url = $base_url . "/" . $new_subdir;
		$icon = '<img src="' . $file_raw_data["icon"].'" width=32px", height="32px" />';
		$name = '<a href="' . $url . '">' . '' . $file_raw_data["name"] . '</a>';
		$size = sizeToString($file_raw_data["size"]);
		$sum_of_files_size += $file_raw_data["size"];
	}
	
	$actions = '
		<a href="actions/delete.get.php?subdir='.urlencode($subdir).'&file='.urlencode($file_raw_data["name"]).'" class="dialog_confirm">
			<img src="images/delete.svg" width="32" height="32" alt="'.L::admin_delete_action.'" title="'.L::admin_delete_action.'"/></a>
		<a href="actions/rename.get.php?subdir='.urlencode($subdir).'&file='.urlencode($file_raw_data["name"]).'">
			<img src="images/rename.svg" width="32" height="32" alt="'.L::admin_rename_action.'" title="'.L::admin_rename_action.'"/></a>
		<a href="actions/move.get.php?subdir='.  urlencode($subdir).'&file='.urlencode($file_raw_data["name"]).'">
			<img src="images/move.svg" width="32" height="32" alt="'.L::admin_move_action.'" title="'.L::admin_move_action.'"/></a>
		';
	
	$link_destination = '';
	if (!empty($file_raw_data['link_destination'])) {
		$link_destination = '-> '.$file_raw_data['link_destination'];
		if (!file_exists($file_raw_data['realpath'])) {
			$link_destination = '<span class="error">' . $link_destination . '<span>';
		}
	}
	
	$files_formated_data[] = array(
		'icon' => $icon,
		"name" => $name,
		"last_modified" => $last_modified,
		"size" => $size,
		"actions" => $actions,
		'link_destination' => $link_destination,
	);
}
if($conf['debug'] === TRUE) echo "end of formating <br/>";
