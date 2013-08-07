<?php
class router {
    static private $section = array(
        '{controller}' => '(\w+)' ,
        '{action}' => '?(\w*)',
        '{params}' => '?([\w/\s]*)'
    );

    static function connect($rout, $callback = null){
        $section = array(
            '{controller}' => null ,
            '{action}' => null,
            '{params}' => null
        );

        foreach($section as $key => $val){
            if(($pos = strpos($rout, $key)) !== false){
                $section [$key] = $pos;
            }else{
                unset($section [$key]);
            }
        }
        asort($section);
        $pattern = '#^' . str_replace(array_keys(self::$section), self::$section, $rout) . '$#';
        if(!preg_match($pattern, self::getUrl(), $match)){
            return false;
        }
        array_shift($match);
        reset($match);
        foreach($section as $key => $val){
            $section[$key] = current($match);
            next($match);
        }
        if(!empty($section['{params}'])){
            $section['{params}'] = explode('/',trim($section['{params}'],'/'));
        }
        is_callable($callback) && call_user_func($callback);
        
        $section['{controller}'] = !empty($section['{controller}']) ? $section['{controller}'] : 'index';
        $section['{action}'] = !empty($section['{action}']) ? $section['{action}'] : 'index';
        $section['{params}'] = !empty($section['{params}']) ? $section['{params}'] : array();
        self::load($section['{controller}'],$section['{action}'],$section['{params}']);
        exit;
    }

    static function load($controller, $action, $params){
        $controller = 'controller_' . $controller;
        if(!class_exists($controller) || !method_exists($controller, $action)){
            //header('Location: error/404');
            //var_dump($controller,$action);exit;
            header('Location: '. html::mainRoot() .'/error/404');
            //debug_print_backtrace();
            debugger::trigger('not found method or class');
        }
        $obj = new $controller;
        call_user_func_array(array($obj,$action),$params);
    }
    
    static function getUrl(){
        return trim($_GET['__'], '/');
    }
}
?>
