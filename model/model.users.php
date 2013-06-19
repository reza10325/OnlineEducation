<?php
class users extends model{
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
}
?>
