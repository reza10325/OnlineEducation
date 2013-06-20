<?php 
class session{

    function set( $name, $val ) { 
        session_start();
        $_SESSION[$var_name] = $var_val;
	session_write_close(); 
    }
    function get( $name ){
    	session_start(); 
        return $_SESSION[$name]; 
	session_write_close();
    }
    function delete( $name ){
    	session_start(); 
        unset( $_SESSION[$name] );
	session_write_close(); 
    }
}
?>
