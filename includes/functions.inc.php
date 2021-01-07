<?php


function vd($var) {
	echo "<pre>";
	var_dump($var);
	echo "</pre>";
}
function vdd($var) {
	vd($var);
	die;
}


function sizeToString($size) {
	$factor = 1024;
	$units = array("o", "Kio", "Mio", "Gio", "Tio", "Pio", "Eio", "Zio", "Yio");
	foreach ($units as $i => $unit) {
		$res = $size / (pow($factor, $i));
		if($res < 1024) {
			$res = round($res, 1);
			$res = "$res $unit";
			break;
		}
	}
	return $res;
}


function new_subdir($prefix, $suffix) {
	if(empty($prefix))
		$new_subdir = $suffix;
	else
		$new_subdir = $prefix . "/" . $suffix;
	return $new_subdir;
}


// http://blog.jachim.be/2009/09/php-msort-multidimensional-array-sort/
/**
 * Sort a 2 dimensional array based on 1 or more indexes.
 *
 * msort() can be used to sort a rowset like array on one or more
 * 'headers' (keys in the 2th array).
 *
 * @param array        $array      The array to sort.
 * @param string|array $key        The index(es) to sort the array on.
 * @param int          $sort_flags The optional parameter to modify the sorting
 *                                 behavior. This parameter does not work when
 *                                 supplying an array in the $key parameter.
 *
 * @return array The sorted array.
 */
function msort($array, $key, $sort_flags = SORT_REGULAR) {
	if (is_array($array) && count($array) > 0) {
		if (!empty($key)) {
			$mapping = array();
			foreach ($array as $k => $v) {
				$sort_key = '';
				if (!is_array($key)) {
					$sort_key = $v[$key];
				} else {
					// @TODO This should be fixed, now it will be sorted as string
					foreach ($key as $key_key) {
						$sort_key .= $v[$key_key];
					}
					$sort_flags = SORT_STRING;
				}
				$mapping[$k] = $sort_key;
			}
// 			asort($mapping, $sort_flags);
			natcasesort($mapping);
			$sorted = array();
			foreach ($mapping as $k => $v) {
				$sorted[] = $array[$k];
			}
			return $sorted;
		}
	}
	return $array;
}


function getIcon($filename) {
	global $conf;
	
	$found = FALSE;
	foreach ($conf["icons"] as $icon => $extensions) {
		foreach ($extensions as $extension) {
			$res = endsWithCase($filename, $extension); 
			if ($res !== FALSE) {
				$found = $icon;
				break 2;
			}
		}
		
	}
	$res = $found ? $found : $conf["default_icon"];
	return $res;
}


function startsWith($haystack, $needle)
{
	return strpos($haystack, $needle) === 0;
}

function endsWith($haystack, $needle)
{
	return substr($haystack, -strlen($needle)) == $needle;
}

function endsWithCase($haystack, $needle) // case insensitive
{
	return (strcasecmp(substr($haystack, -strlen($needle)), $needle) == 0);
}


function redirect($url="") {
	if(empty($url))
		$url = $_SERVER["HTTP_REFERER"];
	header("Location: $url");
}


function getAllSubdir ($dir, $subdir = "", $exclude = array())
{
	$cmd = "cd $dir/$subdir && find -type d";
// 	$cmd = "$cmd 2>&1";
	exec($cmd, $output, $res);
// 	var_dump($output); die;

	
	$res = [];
	foreach ($output as $file)
	{
		$current_dir = &$res;
		$dirs = explode("/", $file);
		array_shift($dirs);
		foreach ($dirs as $dir)
		{
			if(!isset($current_dir [$dir]))
			{
				$current_dir [$dir] = [];
			}
			$current_dir = &$current_dir [$dir];
		}
	}
	return $res;
}


function array_struct_flatten($array, $glue, $parent="") {
	$res = array();
	foreach ($array as $key => $value) {
		$res[] = $parent . $glue . $key;
		if(is_array($value)) {
			$res = array_merge($res, array_struct_flatten($value, $glue, $parent.$glue.$key));
		}
	}
	return $res;
}


function toJstreeObject($tree, $text="/", $fullPath="", $level=0) {
    if( is_array($tree) && count($tree)>0 ) {
		ksort($tree);
		$children = array();
		foreach($tree as $key => $value) {
			$children[] = toJstreeObject($value, $key, $fullPath.'/'.$key, $level+1);
		}
	}
	else
		$children = FALSE;
	
	$opened = ($level==0);

	$res = array(
			'id' => rawUrlencode($fullPath),
			'text' => $text,
			'state' =>
			array(
					'opened' => $opened,
					'selected' => $opened,
			),
			'children' => $children,
	);
	return $res;
}


/**
 * http://stackoverflow.com/a/185725
 * @return string
 */
function app_base_path() {
	require_once __DIR__ . '/../root.inc.php';
// 	echo URLADDR; die;
	return rtrim(URLADDR,'/');
}

