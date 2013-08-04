<?php
class msg {
	static public $val;
	static public $name;
	static function set($name = 'defualt',$val){
		session::set($name,$val);
	}
	
	static function get($name){
		$msg=session::get($name);
		$msg = isset($msg) ? $msg : null;
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
