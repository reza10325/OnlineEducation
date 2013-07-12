<?php

router::connect('error/404',function(){
    $obj = new controller_error;
    $obj->_404();
    exit;
});

router::connect('{controller}/{action}/{params}',function(){
	//print 'Router main';
});

//print 'sad';
header('Location: '. html::mainRoot() .'/error/404');
return;
?>
