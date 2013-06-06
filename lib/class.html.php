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
}
