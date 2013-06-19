<?php
class model extends datalayer{
	protected $_table ;
	protected $id ;
	function __construct(){
		$this->_table = get_class($this);
	}
	function find(array $options = array()){
		$options += array(
				"conditions" => "1"
		);
		$cond = '';
		$cond .= $options["conditions"];
		$cond .= empty($this->id) ? '' : " AND `id` = {$this->id}";
		return $this->db->getRow("SELECT * FROM {$this->_table} WHERE $cond");
	}
	function findAll(array $options = array()){
		$options += array(
				"conditions" => "1",
				"limit" => null
		);
		$cond = '';
		$cond .= $options["conditions"];
		return $this->db->getAll("SELECT * FROM {$this->_table} WHERE $cond");
	}
	function insert(array $values = array()){
		$sql = "INSERT INTO {$this->_table} SET ";
		$sqldata = array();
		foreach ($values as $k => $v){
			$sqldata[] = "`$k` = '$v'" ;
		}
		$sql .= implode(' , ' , $sqldata);
		return $this->db->query($sql);
	}
}
?>