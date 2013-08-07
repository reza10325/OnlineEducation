<?php
class controller_users extends controller{
	function __construct(){
		$this->filter(array(
			'username' => FILTER_SANITIZE_MAGIC_QUOTES,
			'password' => FILTER_SANITIZE_STRING,
			'save' => FILTER_SANITIZE_STRING,
			'type' => FILTER_SANITIZE_STRING,
		));
	}
	function register(){
		if(isset($_POST[submit]){
			if(isset($_POST['username']) && isset($_POST['name']) && isset($_POST['family']) && isset($_POST['MelliCode'])
			&& isset($_POST['password']) && isset($_POST['password2']) && isset($_POST['Email'])){
				$u_name = $mysql->getRow("SELECT * FROM personal 
					WHERE username = '$this -> input['username']'");
				if(!$u_name){
					$p_username=/[a-zA-Z0-9_-]{6,12}/;
					$p_MelliCode=/[0-9]{10}/;
					$p_birth=/(0[1-9]|1[0-9]|2[0-9]|3[01]).(0[1-9]|1[012]).[0-9]{4}/;
					$p_Mobile= /[0-9]{11}/;
					
					$info=array('username' => $this -> input['username'], 'name' => $this -> input['name'], 						'family' => $this -> input['family'],
						'MelliCode' => $this -> input['MelliCode'], 'password' => $this -> input['password'], 							'password2' => $this -> input['password2'],
						'Email' => $this -> input['Email']);
					if(!((preg_match($p_username,$info['username']) && (preg_match($p_MelliCode,$info['MelliCode']) && ($info['password'] == $info['password2'])){
						return false;
					}
					if(isset($_POST[Gender]){
						$info['Gender']=$this -> input['Gender'];
					}
					if(isset($_POST[BirthDate]){
						if(!preg_match($p_birth,$info['BirthDate']){
							return false;
						}
						$info['BirthDate']=$this -> input['BirthDate'];
					}
					if(isset($_POST[Mobile]){
						if(!preg_match($p_Mobile,$info['Mobile']){
							return false;
						}
						$info['Mobile']=$this -> input['Mobile'];
					}
					if(isset($_POST[Address]){
						$info['Address']=$this -> input['Address'];
					}
				}
				else {
					return false;
				}
				if(!users::register($info)){
					$error="error insert";
					$this->render('register',compact("error"));
					return false;
				}
				$this->index();
				return;
			}
			else{
				return false;
			}
		}
	}
}
