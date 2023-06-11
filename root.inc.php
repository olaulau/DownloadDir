<?php

$script_filename = realpath($_SERVER ['SCRIPT_FILENAME']);

// echo "__FILE__ = " . __FILE__ . "<br/>";
// echo "SCRIPT_FILENAME = " . $script_filename . "<br/>";
// echo "PHP_SELF = " . $_SERVER ['PHP_SELF'] . "<br/>";
// die;

define ( 'ABSPATH', str_replace ( '\\', '/', dirname ( __FILE__ ) ) . '/' );

$tempPath1 = explode ( '/', str_replace ( '\\', '/', dirname ( $script_filename ) ) );
$tempPath2 = explode ( '/', substr ( ABSPATH, 0, - 1 ) );
$tempPath3 = explode ( '/', str_replace ( '\\', '/', dirname ($_SERVER ['PHP_SELF']) ) );

// echo "<pre>";
// echo "tempPath1 (SCRIPT_FILENAME) = "; var_dump($tempPath1);
// echo "tempPath1 (__FILE__) = "; var_dump($tempPath2);
// echo "tempPath1 (PHP_SELF) = "; var_dump($tempPath3);
// echo "</pre>";
// die;

for($i = count ( $tempPath2 ); $i < count ( $tempPath1 ); $i ++)
	array_pop ( $tempPath3 );

$urladdr = $_SERVER ['HTTP_HOST'] . implode ( '/', $tempPath3 );

if ($urladdr [strlen ( $urladdr ) - 1] == '/')
	define ( 'URLADDR', $_SERVER['REQUEST_SCHEME'] . '://' . $urladdr );
else
	define ( 'URLADDR', $_SERVER['REQUEST_SCHEME'] . '://' . $urladdr . '/' );

unset ( $tempPath1, $tempPath2, $tempPath3, $urladdr );
