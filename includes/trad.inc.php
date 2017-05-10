<?php
require_once 'ext/i18n.class.php';
$i18n = new i18n(__DIR__ . '/../lang/lang_{LANGUAGE}.ini', __DIR__ . '/../lang/cache/', 'en');
$i18n->init();
?>