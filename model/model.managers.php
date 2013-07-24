<?php
/*
*functions:
*	login()
*	logout()
*	isonline()
*	register($username, $password, $status, $name, $family, $gender, $melli_code, $mobile, $email, $address)
*	editdate($username, $password, $status, $name, $family, $gender, $melli_code, $mobile, $email, $address)
*	editpass($olduser, $oldpass, $newuser, $newpass)
*/
class managers extends model{
	static function singletone() {
		static $instance;
		if(empty($instance)) {
			$instance = new self();
		}			
		return $instance;
	}

	private function login($user, $pass, $save = false){
		$pass = encrypt::md5($pass);
		$row = $this->find(array(
			"conditions" => "username = '$user' AND password = '$pass'"
		));
		if(!$row){
			return false;
		}
		$this->id = $row['id'];
		session::set('admin_id', $this->id);
		if($save){
			$this->setCookie();
		}
		return true;
	}

	private function logout(){
		$this->unsetCookie();
		session::delete('admin_id');		
	}

	private function isOnline(){
		if(isset($_COOKIE['admin_id'])){
			list($id,$hash) = explode(':', $_COOKIE['admin_id']);
			if($hash == encrypt::md5($id)){
				session::set('admin_id', $id);
			}
		}
		return session::get('admin_id');
	}

	private function register($username, $password, $status, $name, $family, $gender, $melli_code, $mobile, $email, $address){
		return $this->insert(array(
			'username' => $username,
			'password' => encrypt::md5($password),
			'status' => $status,
			'name' => $name,
			'family' => $family,
			'gender' => $gender,
			'melli_code' => $melli_code,
			'mobile' => $mobile,
			'email' => $email,
			'address' => $address
		));
	}

	private function editdata($id, $status, $name, $family, $gender, $melli_code, $mobile, $email, $address){
		$cond = " id = '$id' ";
		$values = array(
			'status' => $status,
			'name' => $name,
			'family' => $family,
			'gender' => $gender,
			'melli_code' => $melli_code,
			'mobile' => $mobile,
			'email' => $email,
			'address' => $address
		);
		
		return $this->$db->update($this->_table, $values, $cond );
	}

	private function editpass($id, $newuser, $newpass){
		$cond = " id = '$id'";
		$values = array(
			'username' => $newuser,
			'password' => encrypt::md5($newpass)
			);
		return $this->$db->update($this->_table, $values, $cond );
	}

	static function __callstatic($func,$arg){
		$object = self::singletone();
		return call_user_func_array(array($object,$func), $arg);
	}

	private function setCookie(){
		$val = $id . ':' . encrypt::md5($id);
		setcookie('admin_id', $val, time()+86400*7);
	}

	private function unsetCookie(){
		setcookie('admin_id', false, time()-3600);
		unset($_COOKIE['admin_id']);
	}


}

?>
