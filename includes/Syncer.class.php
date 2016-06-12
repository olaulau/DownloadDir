<?php

class Syncer {
	
	private $sync_script_dir;
	private $scripts = array();
	
	
	public function __construct($sync_script_dir) {
		$this->sync_script_dir = $sync_script_dir;
		
		if ($handle = opendir($sync_script_dir)) {
			while (false !== ($entry = readdir($handle))) {
				if ($entry != "." && $entry != "..") {
// 					echo "$entry<br/>";
					$this->scripts[] = $entry;
				}
			}
			closedir($handle);
			sort($this->scripts);
		}
	}
	
	public function listScripts() {
		return $this->scripts;
	}
	
	public function launchScript($id) {
		set_time_limit(0);
		$script = $this->sync_script_dir . '' . $this->scripts[$id];
		$command = $script . ' > /dev/null 2>&1 &'; //TODO retrieve output and pid like that : http://stackoverflow.com/a/45966
		// of maybe use : https://github.com/cocur/background-process
		exec($command, $output, $ret_code);
		$res = '';
		if($ret_code !== 0) {
			$res .= "<pre> $command </pre>";
			$res .= "downloads_push finished. ret code : $ret_code <br/>";
			$res .= "output : <pre>" . var_export($output, TRUE) . "</pre>";
		}
		return $res;
	}
	
	public function launchAllScripts() {
		foreach ($this->scripts as $id => $script) {
			$res = $this->launchScript($id);
			if($res !== '')
				return $res;
		}
		return '';
	}
	
}
