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
	
	function query($query, $value = array()){
		foreach($value as $key => $val){
			$query = str_replace($key, $val, $query);
		}
		$result = mysql_query($query) or $this->error();
		return $result;
	}
	
	function getOne($query, $value){ // $query ( select * from table where id = :id ) and $value is array (:id => 5) 
		$row = $this->getRow($query, $value);
		reset($row);
		return current($row);
	}
	
	function getRow($query, $value){
		$result = $this->query($query, $value);
		if(mysql_num_rows($result) < 1){
			return false;
		}
		return mysql_fetch_array($result);
	}

	function getAll($query, $value){
		$result = $this->query($query, $value);
		if(mysql_num_rows($result) < 1){
			return false;
		}
		$return = array();
		while($row = mysql_fetch_array($result)){
			$return[] = $row;
		}
		return $return;
	}
	
	function insert($table, $value ){
		$query = " INSERT INTO $table SET ";
		$insertValue = array();
		foreach ($value as $key => $val) {
			$insertValue [] = "`$key` = '$val'";
		}
		$query .= implode(',', $insertValue);
		$add = $this->query($query);
		return $add;
	}
	
	function update( $table, $value, $where )//$value is array & $where is string whithout (Where)
	{
		if(empty($where)){
			 return FALSE;
		}
		$query = " UPDATE $table SET ";
		$insertValue = array();
		foreach ($value as $key => $val) {
			$insertValue [] = "`$key` = '$val'";
		}
		$query = $query . implode(',', $insertValue) . ' WHERE ' . $where;
		$ans = $this-> query($query);
		return $ans;
	}
	
	function delete( $table, $where ){ // $where example:"id = 1"
 		$query = " DELETE FROM $table WHERE " . $where;
		$ans = $this->query($query);
		return $ans;
	}
	
	function escape($str){
		return mysql_real_escape_string($str);
	}
	
	function error(){
		print mysql_error();
		exit;
	}
	
	function __destruct(){
		mysql_close();
	}
}
?>
