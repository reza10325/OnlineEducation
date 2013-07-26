<?php
class debugger{
    static private $ENV = 'developer';
    
    static public function setEnvironment($env){
        self::$ENV = $env;
    }
    
    static public function getEnvironment(){
        return self::$ENV;
    }
    
    /*
     * Use Like => debugger::trigger('FILE NOT FOUND');
     */
    static public function trigger($message = '', $exit = true, $limit = 0) {
        $backtrace = self::getBackTrace($limit);
		$date = date("Y-m-d H:i:s");   
        array_unshift($backtrace, $message, $date . "\n");
        array_push($backtrace, str_repeat('=',50)."\n");
        switch (self::getEnvironment()) {
			case 'production':
					$log = fopen(ERROR_FILE, "a+");
                    fwrite ($log, implode("",$backtrace));
                    fclose($log);
                    $exit && exit();
				break;
            case 'developer':
                    print implode("<br />",$backtrace);
                    exit();
                break;
        }
        return true;
    }

    static private function getBackTrace($limit = 0){
        $trace = array();
        $limit += 2;
        foreach (debug_backtrace() as $k => $v) { 
            if ($k < $limit) { 
                continue; 
            }
            $trace []= '#' . ($k - $limit) . 
                        ' [' . $v['file'] . '] at line ('. $v['line'] . ') : ' . 
                        (isset($v['class']) ? $v['class'] . '->' : '') . $v['function'] . 
                        '(' . @implode(', ', $v['args']) . ')' . "\n"; 
        } 
        return $trace;
    }
}
?>
