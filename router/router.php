<?php
$controller = !empty($_GET['__controller']) ? str_replace(DS, '_', $_GET['__controller']) : 'main';
$method = !empty($_GET['__method']) ? trim($_GET['__method'],DS) : 'index';
$controller = 'controller_' . $controller ;
if(!class_exists($controller) || !method_exists($controller, $method)){
	//redirect('../error'.DS.'_404');
	//loadController('controller_error', '_404');
	//error('_404','not found controller or method');
	login('_login');
}
$class = new $controller;
$class->$method();
?>
