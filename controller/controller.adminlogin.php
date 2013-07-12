<?php

class controller_adminlogin extends controller{
	
	function __construct(){
		$this->filter(array(
			'username' => FILTER_SANITIZE_MAGIC_QUOTES,
			'password' => FILTER_SANITIZE_STRING,
			'save' => FILTER_SANITIZE_STRING,
			'type' => FILTER_SANITIZE_STRING,
		));
	}

	function login($msg = ''){
		if(managers::isOnline()){
			return $this->index();
		}
		$this->render('adminlogin', compact('msg'));
	}
	
	function check_login(){
		if(managers::isOnline()){
			return $this->index();
		}
		if(!empty($this->input['username'])){		
			$auth = managers::login($this->input['username'],$this->input['password'],!empty($this->input['save']));
			if($auth){
				return $this->index();
			}
		}
		return $this->login('invalid user or pass');
	}
	
	function index(){
	 	if($id = managers::isOnline()){
	 		$username = $id;
	 		$this->render('managers',compact('username'));
			return;
	 	}
		return $this->login();
	}
	
	function logout(){
		managers::logout();
		$this->login('success logout');
	} 
	
}

?>
