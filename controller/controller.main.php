<?php

class controller_main extends controller {
    function index(){
        print 'hello';
        //$this->render('index');
    }
    function captcha(){
    	$cap = new captcha(); // instantiate Captcha class
    	$cap->setBGColor(255,0,0);  // sets background color of image
    	$cap->setTextColor(0,255,0); // sets the text color
    	$cap->setSize(100,40); // sets the image size.
    	$cap->show(); // outputs captcha image.
    	exit;
    }
}
