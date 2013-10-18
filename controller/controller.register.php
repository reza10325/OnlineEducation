<?php
class controller_register extends controller{
	function __construct(){
		$this->filter ( array (
				'username' => FILTER_SANITIZE_MAGIC_QUOTES,
				'name' => FILTER_SANITIZE_MAGIC_QUOTES,
				'family' => FILTER_SANITIZE_MAGIC_QUOTES,
				'MelliCode' => FILTER_SANITIZE_MAGIC_QUOTES,
				'password' => FILTER_SANITIZE_STRING,
				'password2' => FILTER_SANITIZE_STRING,
				'save' => FILTER_SANITIZE_STRING,
				'type' => FILTER_SANITIZE_STRING,
				'Gender' => FILTER_SANITIZE_STRING,
				'BirthDate' => FILTER_SANITIZE_STRING,
				'Mobile' => FILTER_SANITIZE_STRING,
				'Address' => FILTER_UNSAFE_RAW,
		) );
	}
	function index(){
		$this->render('register');
	}
	function register() {
		if (empty( $this->input['username'])) {
			msg::set('نام کاربری وارد نشده است .');
			$this->index();
			return false;	
		}
		$sec_code = session::get('sec_code');
		if(empty($sec_code)){
			msg::set('کد امنیتی اشتباه است .');
			$this->index();
			return false;
		}
		session::delete('sec_code');
		$user = new users();
		$u_name = $user->find(array('condition' => 'username = "' . $this->input['username'] . '"'));
		if (empty($u_name)) {
			msg::set('نام کاربری تکراری است .');
			$this->index();
			return false;
		}
		$p_username = '/[a-zA-Z0-9_-]{6,12}/';
		$p_MelliCode = '/[0-9]{10}/';
		$p_birth = '/(0[1-9]|1[0-9]|2[0-9]|3[01]).(0[1-9]|1[012]).[0-9]{4}/';
		$p_Mobile = '/[0-9]{11}/';
			
		$info = array (
				'username' => $this->input ['username'],
				'name' => $this->input['name'],
				'family' => $this->input ['family'],
				'melli_code' => $this->input ['MelliCode'],
				'password' => $this->input ['password'],
				'gender' => $this->input ['Gender'],
				//'BirthDate' => $this->input ['BirthDate'],
				'mobile' => $this->input ['Mobile'],
				'address' => $this->input ['Address'],
		);
		$error = false;
		if(!preg_match($p_username,$info['username'])){
			$error = 'فرمت نام کاربری اشتباه است.';
		}
		if($this->input['password'] != $this->input['password2']){
			$error = 'رمز عبور با تکرار رمز مطابقت ندارد.';
		}
		if(!preg_match($p_Mobile,$info['mobile'])){
			$error = 'فرمت موبایل اشتباه است.';
		}
		
		if (!$error && !users::register ( $info )) {
			$error = "خطای پیشبینی نشده رخ داده است .";
		}
		if($error){
			msg::set($error);
			$this->index ();
			return false;
		}
		//mailer::sendMail('', '', $this->input['email'])
		$user = new users();
		$user->login($this->input['username'], $this->input['password']);
		$this->render('users',array('user_data' => $info));
		return;
	}
}
?>
