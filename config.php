<?php
/*
 * Directory list
 */
define('ROOT', dirname(__FILE__));
define('DS', DIRECTORY_SEPARATOR);
define('CONTROLLER', ROOT . DS . 'controller');
define('LIB', ROOT . DS . 'lib');
define('MODEL', ROOT . DS . 'MODEL');
define('VIEW', ROOT . DS . 'VIEW');

/*
 * Database
 */
define('DB_DRIVER','mysql');
define('DB_HOST','localhost');
define('DB_PORT','3306');
define('DB_USER','root');
define('DB_PASS','');
define('DB_NAME','sn');
define('DB_CHARSET', 'utf-8');

/*
 * encrypt
 */
define('AUTH_HASH', 'koushki');
 
?>