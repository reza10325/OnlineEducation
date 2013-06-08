<?php
class mysql{
	static function singletone(){
		static $instance;
		if(empty($instance)){
			$instance = new self();
		}
		return $instance;
	}
	function __construct(){
		mysql_connect(DB_HOST,DB_USER,DB_PASS);
		mysql_select_db(DB_NAME);
		mysql_query("SET CHARSET " . DB_CHARSET);
	}
	function query($query){
		$result = mysql_query($query) or $this->error();
		return $result;
	}
	
	function getOne($query){
		$row = $this->getRow($query);
		reset($row);
		return current($row);
	}
	
	function insert($query){
		$add=$this->query($query);
		return $add;
	}
	function getRow($query){
		$result = $this->query($query);
		if(mysql_num_rows($result) < 1){
			return false;
		}
		return mysql_fetch_array($result);
	}

	function getAll($query){
		$result = $this->query($query);
		if(mysql_num_rows($result) < 1){
			return false;
		}
		
		$return = array();
		while($row = mysql_fetch_array($result)){
			$return[] = $row;
		}
		return $return;
	}
	
	function escape($str){
		return mysql_real_escape_string($str);
	}
	
	function error(){
		print mysql_error();
		exit;
	}
	
	function __destruct(){
		//mysql_close();
	}
}
?>
