<?php
class router {
    static private $section = array(
        '{controller}' => '(\w+)' ,
        '{action}' => '(\w+)',
        '{params}' => '([\w/]+)'
    );

    static function connect($rout, $callback){
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
        $pattern = '#' . str_replace(array_keys(self::$section), self::$section, $rout) . '#';
        if(!preg_match($pattern, self::getUrl(), $match)){
            print 'not match url';
            return false;
        }
        array_shift($match);
        reset($match);
        foreach($section as $key => $val){
            $section[$key] = current($match);
            next($match);
        }
        if(!empty($section['{params}'])){
            $section['{params}'] = explode('/',$section['{params}']);
        }
        is_callable($callback) && call_user_func($callback);
        self::load($section['{controller}'],$section['{action}'],(array) $section['{params}']);
        exit;
    }
    static function load($controller = 'index', $action = 'index', $params = array()){
        $controller = 'controller_' . $controller;
        if(!class_exists($controller) || !method_exists($controller, $action)){
           print 's';
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
