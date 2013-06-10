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
	
	static function mainRoot(){
		$r= substr(ROOT,strlen($_SERVER['DOCUMENT_ROOT']));
		$r='http://' . $_SERVER['SERVER_NAME'] . str_replace('\\', '/', $r);
		return $r;
	}
	static function dirCss($c){
		$cssPath=VIEW .DS .'css' .DS .$c .'.css';
		if(!file_exists ($cssPath)){
			return false;
		}
		$cssPath= substr($cssPath,strlen(ROOT));
		$cssPath='http://' . $_SERVER['SERVER_NAME'] . str_replace('\\', '/', $cssPath);
		return $cssPath;
	}
	static function dirJs ($j){
		$jsPath=VIEW .DS .'js' .DS .$j .'.js';
		if(!file_exists ($jsPath)){
			return false;
		}
		$jsPath= substr($jsPath,strlen(ROOT));
		$jsPath='http://' . $_SERVER['SERVER_NAME'] . str_replace('\\', '/', $jsPath);
		return $jsPath;
	}
	static function dirImage ($img){
		$imagePath=VIEW .DS .'images' .DS .$img ;
		if(!file_exists ($imagePath)){
			return false;
		}
		$imagePath= substr($imagePath,strlen(ROOT));
		$imagePath='http://' . $_SERVER['SERVER_NAME'] . str_replace('\\', '/', $imagePath);
		return $imagePath;
	}
}
