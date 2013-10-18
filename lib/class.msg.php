<?php
class msg {
	static public $val;
	static public $name;
	static function set($val,$name = 'defualt'){
		session::set($name,$val);
		
	}
	
	static function get($name = 'defualt'){
		$msg=session::get($name);
		$msg = !empty($msg) ? $msg : null;
		session::delete($name);
		return $msg;
	}
	
}
   		/** 
		 * test::message class
		 *
		 * 	msg::set('msg','hi');
			msg::set('msg2','bye');
			if($msg = msg::get('msg2'))
		    print $msg; ==> print bye 
		 * 
		 */
		
?>
