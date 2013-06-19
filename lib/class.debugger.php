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
        array_unshift($backtrace, $message . "\n");
        array_push($backtrace, str_repeat('=',50)."\n");
        switch (self::getEnvironment()) {
			case 'production':
					$log = fopen(ERROR_FILE, "a+");
                    fwrite ($log, $backtrace);
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
    /*static $ENV;
	static $MSG;
	static $START=0;
	static $END=10;
	static function setElement($env,$msg,$start,$end){
		self::$ENV = $env;
		self::$MSG = $msg;
		self::$START= $start;
		self::$END = $end;
	}
	static function backtrace(){
		ob_start(); 
        debug_print_backtrace();
		$trace = self::$MSG; 
        $trace = ob_get_contents(); 
        ob_end_clean();
		}
	static function trigger() {
		switch (self::$ENV) {
			case 'production':
				for($i = self::$start ; $i = self::$END ; $i++){
					$logTarce = $trace($i);
					$errlog = fopen("../tmp/error.log", "a+");
					fwrite ( $errlog , $logTrace );
				}
				break;
			case 'developer':
				for($i = self::$start ; $i = self::$END ; $i++){
					var_dump($trace($i));
				}
				exit();
				break;
		}

    }*/
}
?>
