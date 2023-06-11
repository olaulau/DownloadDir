# DownloadDir


## management of (downloaded) files

This is a web file-manager, targeted for downloaded files.


#### Features :
- file manager
	- move, delete, rename
	- create directory and symbolic links
- web
	- download a file in any directory, with referer managment
	- run an (rsync) script to deploy the directory to mirrors
- file listing
	- acts as Apache autoIndex when unauthenticated
- global
	- fully internationalized (english and french supported)
	
#### Requirements :
- Linux server (find command available)
- web server (tested with Apache 2.4)
- PHP (tested with version 8.0)


#### Install :
- git clone https://github.com/olaulau/DownloadDir
- cd DownloadDir
- composer install
- ln -s <listing dir> apache_listing
- cp includes/config.inc.dist.php includes/config.inc.php
- vim includes/config.inc.php


#### Dependencies (via composer) :
- jQuery
- jQuery UI
- [jsTree](https://www.jstree.com/)


#### other resources :
- icons :  
	- [delete](https://www.iconfinder.com/icons/197210/delete_meanicons_remove_icon#size=512)  
	- [move](https://www.iconfinder.com/icons/298775/directory_file_symlink_icon#size=128)  
	- [rename](http://wiki.geogebra.org/en/File:Menu-edit-rename.svg)  
