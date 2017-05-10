<?php


class Url {
	private $scheme;
	private $host;
	private $port;
	private $user;
	private $pass;
	private $path;
	private $query;
	private $fragment;
	
	
	
	public function __construct($url = NULL) {
		if(!isset($url))
			$url = "http://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
		
		$parsed_url = parse_url($url);
		$this->scheme = $parsed_url["scheme"];
		$this->host = $parsed_url["host"];
		$this->port = isset($parsed_url["port"]) ? $parsed_url["port"] : 80;
		@$this->user = $parsed_url["user"];
		@$this->pass = $parsed_url["pass"];
		$this->path = $parsed_url["path"];
		@$this->fragment = $parsed_url["fragment"];
		
		if(isset($parsed_url["query"])) {
			$parsed_string = array();
			parse_str($parsed_url["query"], $parsed_string);
			$this->query = $parsed_string;
		}
		else
			$this->query = array();
	}
	
	
	public function removeQueryParameter($param) {
		unset($this->query[$param]);
	}
	
	
	public function setQueryParameter($param, $val) {
		$this->query[$param] = $val;
	}
	
	
	public function getQueryarameter($param) {
		return isset($this->query[$param]) ? $this->query[$param] : NULL;
	}
	
	
	public function getFullUrl() {
		$reconstructed_query_string = http_build_query($this->query);

		$reconstructed_url = self::http_build_url($this->scheme, $this->host, $this->port, $this->user, $this->pass, $this->path, $reconstructed_query_string, $this->fragment);

		return $reconstructed_url;
	}
	
	
	
	private static function http_build_url(
				$scheme="http",
				$host,
				$port=80,
				$user=NULL,
				$pass=NULL,
				$path="",
				$query="",
				$fragment=""
		) {
			$res = $scheme . "://";
			$res .= $user ? $user.( $pass ? ":".$pass : "" )."@" : "";
			$res .= $host . ( ($port == 80) ? "" : ":".$port );
			$res .= $path;
			$res .= $query ? "?".$query : "";
			$res .= $fragment ? "#".$fragment : "";
			return $res;
	}
	
}

