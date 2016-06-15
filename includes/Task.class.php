<?php

class Task {
	
	const PERSISTANCE_FILE = __DIR__ . '/../tasks.dat'; // stores the task list in serialise format
	
	private static $task_list = NULL;
	
	private $pid;
	private $command;
	private $time_started;
	private $label;
	private $status;
	private $output_file;
	
	
	public function __construct() {
		
	}
	
	
	public static function launch($command) {
		$output_file = tempnam(sys_get_temp_dir(), '');
		echo "output file = " . $output_file . "<br/>";
		$pid_file = tempnam(sys_get_temp_dir(), '');
		echo "pid file = " . $pid_file . "<br/>";
		
		$t = new Task();
		$t->command = $command;
		$exec_command = 'php '.__DIR__.'/'.'TaskWrapper.script.php "'.$command.'" > '.$output_file.' 2>&1 & echo $! > '.$pid_file.' 2>&1';
		echo "EXEC COMMAND = <br/>$exec_command<br/>";
		exec($exec_command, $out, $res);
// 		echo $res; var_dump($out); die;
		$pid = file_get_contents($pid_file);
		echo "PID = " . $pid . "<br/>";
		unlink($pid_file);
		$t->set_pid($pid);
		$t->set_output_file($output_file);
		
		self::init_list();
		self::$task_list[] = $t;
		echo "launched task added <br/>";
		self::save_list();
	}
	
	public function set_pid($pid) {
		$this->pid = $pid;
	}
	
	public function set_output_file($output_file) {
		$this->output_file = $output_file;
	}
	
	
	private static function init_list() {
		if(is_null(self::$task_list)) {
			if(!file_exists(SELF::PERSISTANCE_FILE)) {
				self::$task_list = array();
				echo "list initialized <br/>";
				self::save_list();
			}
			else {
				self::load_list();
			}
		}
	}
	
	private static function save_list() {
		file_put_contents(self::PERSISTANCE_FILE, serialize(self::$task_list));
		echo "list saved <br/>";
	}
	
	private static function load_list() {
		self::$task_list = unserialize(file_get_contents(self::PERSISTANCE_FILE));
		echo "list loaded <br/>";
	}
	
	
	
	public function started() {
		
	}
	
	public function stopped() {
		// get return status code
		// if ok, 
		// unlink output file
		// remove from list and save
	}
	
	
	
	public static function getTask($pid) {
		
	}
	
}
