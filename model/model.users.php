<?php
class users extends model{
	static function singletone() {
		static $instance;
		if(empty($instance)) {
			$instance = new self();
		}
		return $instance;
	}
	function userdata(){
		$this->id = 1;
		return $this->find();
	}
	function login($user, $pass, $save = false){
		$row = $this->find(array(
			"conditions" => "username = '$user' AND password = '$pass'"
		));
		if(!$row){
			return false;
		}
		$this->id = $row['id'];
		$this->setSession();
		if($save){
			$this->setCookie();
		}
		return true;
	}
	function setSession(){
		$_SESSION['users_id'] = $this->id;
	}
	function setCookie(){
		//......
	}
	function isOnline(){
		return !empty($_SESSION['users_id']) ? $_SESSION['users_id'] : false;
	}
	private function register($info){
		$info['password'] = encrypt::md5($info['password']);
		$this->insert($info);
		return true;
	}
	static function __callstatic($func,$arg){
		$object = self::singletone();
		return call_user_func_array(array($object,$func), $arg);
	}
	
}
?>
