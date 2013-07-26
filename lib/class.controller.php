<?php
abstract class controller{
    protected $input = array();
    abstract function index();
	protected function render($view,$param = array(),$ajax = false){
		$file = VIEW . DS . $view . '.phtml';
		$header = VIEW . DS . 'header.phtml';
		$footer = VIEW . DS . 'footer.phtml';
		if(!file_exists($file) || !is_readable($file)){
            debugger::trigger("FILE [$file] NOT FOUND ");
            return false;
		}
		if(!empty($param)){
			extract($param);
		}
		if(!$ajax){
			html::addJs('jquery');
			html::addCss('main');
		}
		ob_start();
		include $file;
		$content = ob_get_contents();
		ob_end_clean();
		if(!$ajax){
			include $header;
		}
		print $content;
		if(!$ajax){
			include $footer;
		}
		return true;
	}
	
	protected function filter($filter){
		$_REQUEST = filter_var_array($_REQUEST , $filter);
		foreach ($filter as $key => $value) {
			$this->input[$key] = $_REQUEST[$key];
		}
	}
}
?>
