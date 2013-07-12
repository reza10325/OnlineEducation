<?php
class controller_login extends controller{
    function index(){
        return $this->user();
    }
    function user(){
        $action = html::generateLink('user', 'check_login');
        $this->render('login', compact('action'));
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
