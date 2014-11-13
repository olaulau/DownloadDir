<?php

/**
 * PHP session wrapper to avoid write lock on concurent script for the same session (ajax, tabs ...)
 * @author laulau
 *
 */

class Session {
	
	static function start(){
		session_start();
		session_write_close();
	}
	
	static function set_var($variable, $value) {
		session_start();
		$_SESSION[$variable] = $value;
		session_write_close();
	}
	
	static function unset_var($variable) {
		session_start();
		unset($_SESSION[$variable]);
		session_write_close();
	}
	
}