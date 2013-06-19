<?php 
class sessions {

    function __construct()
    { 
        session_start(); 
    }
    function set_var( $var_name, $var_val ) 
    { 
        if( !$var_name || !$var_val ) 
        { 
            return false; 
        } 
        $_SESSION[$var_name] = $var_val; 
    }
    function get_var( $var_name ) 
    { 
        return $_SESSION[$var_name]; 
    }
    function del_var( $var_name ) 
    { 
        unset( $_SESSION[$var_name] ); 
    }
 function __destruct() {
      session_destroy();
   }
}
?>
