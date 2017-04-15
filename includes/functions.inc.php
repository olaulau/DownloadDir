<?php


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



function getAllSubdir($dir, $subdir="", $exclude=array()) {
	$res = array();
	$directory = dir($dir . "/" . $subdir);
	while($filename = $directory->read()) {
		if(!in_array($filename, $exclude)) {
			if(is_dir($dir . "/" . $subdir . "/" . $filename)) {
				$res[$filename] = getAllSubdir($dir, $subdir."/".$filename, $exclude);
			}
		}
	}
	if(!empty($res))
		return $res;
	else
		return NULL;
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
	if( count($tree) > 0 ) {
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



function app_base_path() {
	// 	echo $_SERVER['PHP_SELF'] . "<br/>";
	// 	echo $_SERVER['SCRIPT_NAME'] . "<br/>";
	// 	echo $_SERVER['SCRIPT_FILENAME'] . "<br/>";
	// 	echo "<br/>";
	// 	echo __FILE__ . "<br/>";
	// 	echo __DIR__ . "<br/>";
	// 	echo "<br/>";

	// 	echo $_SERVER['SCRIPT_FILENAME'] . "<br/>";
	// 	echo " - <br/>";
	// 	echo $_SERVER['SCRIPT_NAME'] . "<br/>";
	// 	echo " = <br/>";
	$webroot = str_replace($_SERVER['SCRIPT_NAME'], '', $_SERVER['SCRIPT_FILENAME']);
	// 	echo $webroot . "<br/><br/>";

	// 	echo __DIR__ . "<br/>";
	// 	echo " - <br/>";
	// 	echo $webroot . "<br/>";
	// 	echo " = <br/>";
	$app_base_path = str_replace($webroot, '', __DIR__);
	$app_base_path = dirname($app_base_path); //  because we are in a subdir, we must go to parent
	// 	echo $app_base_path . "<br/><br/>";
	
	if($app_base_path === '/') {
		return '';
	}
	else {
		return $app_base_path;
	}
}
