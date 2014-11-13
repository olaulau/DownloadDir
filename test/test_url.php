<?php

require_once '../includes/Url.class.php';




$url = new Url();
$url->setQueryParameter("azerty", "qsdfgh");
$u = $url->getFullUrl();
echo $u;