<?php
class msg {
	static function setMsg($val){
		$_SESSION['msg'] = $val;
	}
	
	static function getMsg(){
		
		$msg = isset($_SESSION['msg']) ? $_SESSION['msg'] : null;
		unset($_SESSION['msg']);
		return $msg;
	}
}
