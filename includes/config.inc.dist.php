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


$conf["directory_icon"] = "indexoverride/dir.png";
$conf["default_icon"] = "indexoverride/default.png";
$conf["icons"] = array(
	"indexoverride/image.png" => array(".jpg", ".png" ."bmp", ".svg", ".gif", ".wmf", ".psd", ".ico"),
	"indexoverride/video.png" => array(".mov", ".avi", ".mpg"),
	"indexoverride/music.png" => array(".wav", ".mp3"),
	"indexoverride/flash_src.png" => array(".fla", ".as"),
	"indexoverride/swf.png" => array(".swf"),
	"indexoverride/xls.png" => array(".xls", ".csv"),
	"indexoverride/doc.png" => array(".doc"),
	"indexoverride/ppt.png" => array(".ppt"),
	"indexoverride/pdf.png" => array(".pdf"),
	"indexoverride/php.png" => array(".php"),
	"indexoverride/html.png" => array(".htm", ".html"),
	"indexoverride/css.png" => array(".css"),
	"indexoverride/archive.png" => array(".zip", ".rar", ".arj", ".arc", ".tar", ".targz", ".gz"),
	
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
