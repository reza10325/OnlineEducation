<?php
class datalayer{
	protected $db;
	function __construct(){
		$this->db = self::factory();
	}
	static function factory(){
		switch(DB_DRIVER){
			case 'mysql' : 
				return mysql::singletone();
			case 'sqlserver' :
				//return sqlserver::singletone();
		}
	}
}
?>
