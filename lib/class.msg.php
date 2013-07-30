<?php
class msg {
	static function set($val){
		session_start();
		$_SESSION['msg'] = $val;
		session_write_close();
	}
	
	static function get(){
		$msg = isset($_SESSION['msg']) ? $_SESSION['msg'] : null;
		unset($_SESSION['msg']);
		return $msg;
	}
}
?>