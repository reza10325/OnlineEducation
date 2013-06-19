<?php
session_start();
include_once 'config.php';
include_once 'lib/function.php';
$mysql = mysql::singletone();
function __autoload($class){ //x_k_d
	$path = explode('_', $class); //[0] => x [1] => k ,[2] => d
	$file = array_pop($path) ; //[0] => x [1] => k ;file = d
	$dir = implode(DS, $path); //dir => x/k;
	
	$controller = ROOT . DS . $dir . DS . 'controller.' . $file . '.php'; // controller/controller.main.php 
	if(file_exists($controller) && is_readable($controller)){
		include_once $controller;
		return;
	}
	
	$model = ROOT . DS . 'model' . DS . $dir . DS . 'model.' . $file . '.php'; // model/x/k/model.d.php 
	if(file_exists($model) && is_readable($model)){
		include_once $model;
		return;
	}
	
	$lib = ROOT . DS . 'lib' . DS . $dir . DS . 'class.' . $file . '.php'; // lib/x/k/class.d.php 
	if(file_exists($lib) && is_readable($lib)){
		include_once $lib;
		return;
	}
}
?>