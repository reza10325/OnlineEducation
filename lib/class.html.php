<?php
class html {
	static $js = array();
	static $css = array();
	static $priority;
	static $jpr;
	static function addJs($js,$jp='last'){
		self::$jpr=$jp;
		self::$js[] = $js;
	}
	static function addCss($css,$p='last'){
		self::$priority=$p;
		self::$css[]=$css;
	}
	static function loadJs(){
		$str = '';
		foreach (self::$js as $key => $value) {
			if(self::$jpr=='first'){
				$str='<script src="js/' . $value . '.js"></script>' . $str;
			}
			else{
				$str .= '<script src="js/' . $value . '.js"></script>';
			}
		}
		return $str;
	}
	static function loadCss(){
		$str='';
			foreach (self::$css as $key => $value) {
				if(self::$priority =='first'){
					$str='<link rel="stylesheet" type="text/css" href="css/' . $value . '.css" />' . $str;
				}
				else{
					$str.= '<link rel="stylesheet" type="text/css" href="css/' . $value . '.css" />';
				}
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
		$cssPath=self::mainRoot() . str_replace('\\', '/', $cssPath);
		return $cssPath;
	}
	static function dirJs ($j){
		$jsPath=VIEW .DS .'js' .DS .$j .'.js';
		if(!file_exists ($jsPath)){
			return false;
		}
		$jsPath= substr($jsPath,strlen(ROOT));
		$jsPath=self::mainRoot() . str_replace('\\', '/', $jsPath);
		return $jsPath;
	}
	static function dirImage ($img){
		$imagePath=VIEW .DS .'images' .DS .$img ;
		if(!file_exists ($imagePath)){
			return false;
		}
		$imagePath= substr($imagePath,strlen(ROOT));
		$imagePath=self::mainRoot(). str_replace('\\', '/', $imagePath);
		return $imagePath;
	}
	static function absPath ($r_path){
		$current_page= $_SERVER['DOCUMENT_ROOT'] . $_SERVER['REQUEST_URI'];
		$r = explode('/', $r_path);
		$path=explode('/', $current_page);
		$k=sizeof($path);
		foreach ($r as $key => $value){
			if($value== '..'){
				array_pop ($path);
			}
			else if(($value != '.') && ($value != $path[$k-2])){
				$k--;
				array_push ($path , $value);
			}
		}
		$path=implode ($path,'/');
		$abs=substr($path,strlen(ROOT));
		$abs=self::mainRoot(). $abs;
		return $abs;
	}
	static function getUrl ($add_get,$clean){
		$current_url= 'http://' .  $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
		if($add_get!=''){
			$p=explode('/', $current_url);
			$k1=sizeof($p);
			$last_get=explode('?', $p[$k1-1]);
			$k2=sizeof($last_get);
			foreach ($add_get as $key => $value) {
				$g1= $key .'='. $value;
				$g2='&'. $key .'='. $value;
			}
			
			if($k2>1){
				$l=$last_get[1];
				if($clean=='true'){
					$last_get[1]=$g1;
				}
				else{
					$last_get[1].=$g2;
				}
				$t=implode('?',$last_get);
			}
			else{
				$t= $last_get[0].'?'. $g1;
			}
			$p[$k1-1]=$t;
			$p= implode('/',$p);
			return $p;
		}
		else{
			return $current_url;
		}
	}
	static function isAjax(){
		if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
			// If its an ajax request execute the code below       
			return true;
		}
		else{
			//if it's not an ajax request echo the below.
			return false;
		}
		
	}
}
