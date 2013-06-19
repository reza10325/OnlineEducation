<?php
class debugger{
	static $ENV;
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

	}
}
?>
