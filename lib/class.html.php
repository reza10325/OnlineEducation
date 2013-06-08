<?php
class html {
	static $js = array();
	static $css = array();
	static function addJs($js){
		self::$js[] = $js;
	}
	static function addCss($css){
		self::$css[] = $css;
	}
	static function loadJs(){
		$str = '';
		foreach (self::$js as $key => $value) {
			$str .= '<script src="js/' . $value . '.js"></script>';
		}
		return $str;
	}
	static function loadCss(){
		$str = '';
		foreach (self::$css as $key => $value) {
			$str .= '<link rel="stylesheet" type="text/css" href="css/' . $value . '.css" />';
		}
		return $str;
	}
	static function loadImg($image_name){
		return '<img src="images/'.$image_name.'" />' ;
	}

	/***************************************************************
		functions added recently
	***************************************************************/
	
	static function dirCss($c){
		$cssName=VIEW .DS .'css' .DS .$c .'.css';
		if(!file_exists ($cssName)){
			return false;
		}
		return $cssName;
	}
	static function dirJs ($j){
		$jsName=VIEW .DS .'js' .DS .$j .'.js';
		if(!file_exists ($jsName)){
			return false;
		}
		return $jsName;
	}
	static function dirImage ($img){
		$imageName=VIEW .DS .'images' .DS .$img ;
		if(!file_exists ($imageName)){
			return false;
		}
		return $imageName;
	}
	static function mainRoot(){
		$r= $_SERVER['DOCUMENT_ROOT'];
		return $r;
	}
}
