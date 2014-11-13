<?php

require_once '../includes/config.inc.php';
require_once '../includes/functions.inc.php';



$tab = getAllSubdir($base_dir, "", $exclude);
ksort($tab);
echo "<pre>" . print_r($tab, TRUE) . "</pre>";


echo "<hr>";


$tab = array_struct_flatten($tab, "/");
echo "<pre>" . print_r($tab, TRUE) . "</pre>";
