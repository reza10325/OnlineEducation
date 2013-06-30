/*
 * session::set('a','a')
 */
<?php
	class session{
		function __construct() {
			session_start();
		}
		function singleton() {
			static $instance;
			if(empty($instance)) {
				$instance = new self();
			}			
			return $instance;
		}
		private function set( $name , $val = null , $ttl = 1400 ){
			$_SESSION[$name] = array('expire' => time()+$ttl , 'value' => $val);
		}
		private function get( $name ){
			if (!empty($_SESSION[$name]) && $_SESSION[$name]['expire'] > time()){
				return $_SESSION[$name]['value'];
			}
			$this->delete($name);
			return FALSE;
		}
		private function delete( $name ){
			UNSET($_SESSION[$name]); 
		}
		static function __callstatic($func,$arg){
			$object = self::singleton();
			return call_user_func_array(array($object,$func), $arg);
		}
		function __destruct(){
			session_destroy(); 
		}
	}
?>	
