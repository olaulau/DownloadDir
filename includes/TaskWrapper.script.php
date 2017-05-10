<?php

// this script is launched in background by Task::launch 

$command = $argv[1];
echo "COMMAND TO LAUNCH : " . $command . PHP_EOL;



// Task->start() stores the task in a list


// exec() : launch the command, not in background
passthru($command);

// Task->stop() after the command is finished


