<?php
class controller_error extends controller{
	function index(){
		$this->_404();
	}
	function _404($msg = ''){
		$msg = $msg;
		$this->render('error/404',compact('msg'));
	}
	
	function _300(){
		$this->render('error/300');
	}
	function _301(){
		$this->render('error/301');
	}
	function _100(){
		$this->render('error/100');
	}
}
?>
