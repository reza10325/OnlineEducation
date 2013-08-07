<?php
class controller_login extends controller{
    function index(){
        return $this->user();
    }
    function user($msg = ''){
        if(users::isOnline()){
            redirect(html::generateLink('users'));
            return true;
        }
        $action = html::generateLink('users','check_login');
        $message = $msg;
        $this->render('login', compact('action','message'));
    }
    function admin($msg = ''){
        if(managers::isOnline()){
            redirect(html::generateLink('managers'));
            return true;
        }
        $action = html::generateLink('managers','check_login');
        $message = $msg;
        $this->render('login', compact('action','message'));
    }
}
?>
