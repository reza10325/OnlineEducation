<?php
/*
 * Config local for developers
 */
if(file_exists('config.local.php')){
	include_once 'config.local.php';
}
error_reporting(E_ALL & ~E_NOTICE);

/*
 * Directory list
 */
define('ROOT', dirname(__FILE__));
define('DS', DIRECTORY_SEPARATOR);
define('CONTROLLER', ROOT . DS . 'controller');
define('LIB', ROOT . DS . 'lib');
define('MODEL', ROOT . DS . 'model');
define('VIEW', ROOT . DS . 'view');

/*
 * Database
 */
define('DB_DRIVER','mysql');
define('DB_HOST','localhost');
define('DB_PORT','3306');
define('DB_USER','root');
define('DB_PASS','');
define('DB_NAME','online_education');
define('DB_CHARSET', 'utf-8');

/*
 * encrypt
 */
define('AUTH_HASH', '0/\/|_|/\/ EDUC/\TI0/\/');

error_reporting(E_ALL);
?>