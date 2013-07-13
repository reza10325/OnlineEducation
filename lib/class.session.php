<?php
/*
 * session::set('a','a')
 */
class session{

    static function set( $name , $val = null , $ttl = 1400 ){
	session_start();
        $_SESSION[$name] = array('expire' => time()+$ttl , 'value' => $val);
	session_write_close();
    }

    static function get( $name ){
        if (!empty($_SESSION[$name]) && $_SESSION[$name]['expire'] > time()){
            return $_SESSION[$name]['value'];
        }
        self::delete($name);
        return FALSE;
    }

    static function delete( $name ){
        UNSET($_SESSION[$name]); 
    }
}
?>
