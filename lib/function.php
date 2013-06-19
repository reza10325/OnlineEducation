<?php
function redirect($addr){
	header('Location: ' . $addr);
	exit;
}
function loadController($class,$method){
	$c = new $class();
	$c->$method();
	exit;
}
function error($method , $msg = ''){
	$c = new controller_error();
	$c->$method($msg);
	exit;
}
function login($method){
	$c = new controller_login();
	$c->$method();
}
function register($method){
	$c = new controller_register();
	$c->$method();
}
?>
