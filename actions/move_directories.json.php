<?php
header('Content-type: application/json');

require_once '../includes/ALL.inc.php';

Session::start();


$tab = getAllSubdir($base_dir, "", $exclude);
$tab = toJstreeObject($tab);
echo json_encode($tab); exit;
