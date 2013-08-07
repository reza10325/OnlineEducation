<?php

router::connect('error/404',function(){
    $obj = new controller_error;
    $obj->_404();
    exit;
});

router::connect('{controller}/{action}/{params}');
router::connect('');
header('Location: '. html::mainRoot() .'/error/404');
return;
?>
