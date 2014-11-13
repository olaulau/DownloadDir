time -p rsync --exclude=.svn --recursive --chmod=u+rwx,g+rwx,o+rwx --times --delete --itemize-changes --verbose "<localDir>/" "<login>@<host>:<remoteDir>/"

exit
