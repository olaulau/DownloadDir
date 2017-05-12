<?php

$conf['debug'] = FALSE;
$conf['title'] = 'Downloads';
$base_dir = "/home/user/downloads/";
$base_url = "http://localhost/apache_listing/"; //you can use the git-ignored /apache_listing/ at the root of the project to point to $base_dir
$conf["sync_script_dir"] = "/home/user/BIN/downloads_push/";
$auth["users"] = array(
		"admin" => "SHA512 hex string you can generate with /auth/convert.php"
);


$exclude = array(
		".",
		"..",
		".htaccess",
		"cdicons",
		"indexoverride",
		"Thumbs.db"
	);


$conf['icon_base_url'] = 'http://domain.fr';
$conf["directory_icon"] = "/downloads/indexoverride/dir.png";
$conf["default_icon"] = "/downloads/indexoverride/default.png";
$conf["icons"] = array(
		"/downloads/indexoverride/image.png" => array(".jpg", ".png" ."bmp", ".svg", ".gif", ".wmf", ".psd", ".ico"),
		"/downloads/indexoverride/video.png" => array(".mov", ".avi", ".mpg"),
		"/downloads/indexoverride/music.png" => array(".wav", ".mp3"),
		"/downloads/indexoverride/flash_src.png" => array(".fla", ".as"),
		"/downloads/indexoverride/swf.png" => array(".swf"),
		"/downloads/indexoverride/xls.png" => array(".xls", ".csv"),
		"/downloads/indexoverride/doc.png" => array(".doc"),
		"/downloads/indexoverride/ppt.png" => array(".ppt"),
		"/downloads/indexoverride/pdf.png" => array(".pdf"),
		"/downloads/indexoverride/php.png" => array(".php"),
		"/downloads/indexoverride/html.png" => array(".htm", ".html"),
		"/downloads/indexoverride/css.png" => array(".css"),
		"/downloads/indexoverride/archive.png" => array(".zip", ".rar", ".arj", ".arc", ".tar", ".targz", ".gz"),
		
		"/icons/binary.gif" => array(".bin", ".exe"),
		"/icons/binhex.gif" => array(".hqx"),
		"/icons/tar.gif" => array(".tar"),
		"/icons/world2.gif" => array(".wrl", ".wrl.gz", ".vrml", ".vrm", ".iv"),
		"/icons/compressed.gif" => array(".Z", ".z", ".tgz", ".gz", ".zip"),
		"/icons/a.gif" => array(".ps", ".ai", ".eps"),
		"/icons/layout.gif" => array(".html", ".shtml", ".htm", ".pdf"),
		"/icons/text.gif" => array(".txt"),
		"/icons/c.gif" => array(".c"),
		"/icons/p.gif" => array(".pl", ".py"),
		"/icons/f.gif" => array(".for"),
		"/icons/dvi.gif" => array(".dvi"),
		"/icons/uuencoded.gif" => array(".uu"),
		"/icons/script.gif" => array(".conf", ".sh", ".shar", ".csh", ".ksh", ".tcl"),
		"/icons/tex.gif" => array(".tex")
	);
