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
?>