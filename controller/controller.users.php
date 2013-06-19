<?php
class controller_users extends controller{
	function userdata(){
		$users = new users();
		$user_data = $users->userdata();
		$this->render('users',compact('user_data'));
	}
}
?>
