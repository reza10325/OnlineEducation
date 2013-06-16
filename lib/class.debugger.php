<?php
class debugger{
	static $ENV;
	static function setEnvironment($env){
		self::$ENV = $env;
	}
	static function trigger() {
		switch (self::$ENV) {
			case 'production':
				ob_start();
		        debug_print_backtrace();
			    $trace = ob_get_contents();
			    ob_end_clean();
				$errlog = fopen("../tmp/error.log", "a+");
				fwrite ( $errlog , $trace );
				break;
			case 'developer':
				debug_print_backtrace();
				break;
		}

	}
}
?>
