@echo off


set "cygwin_bin=C:\sync\cygwin\bin"
set PATH=%cygwin_bin%:%PATH%

set "time=%cygwin_bin%\time.exe"
set "rsync=%cygwin_bin%\rsync.exe"

set "src=/cygdrive/c/Users/<user>/<locaDir>/"
set "dest=<login>@<host>:<remoteDir>/"


%time% -p %rsync% --exclude=.svn --recursive --chmod=u+rwx,g+rwx,o+rwx --times --delete --itemize-changes --verbose "%src%" "%dest%"
goto :eof

