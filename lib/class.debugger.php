<?php
static class debugger{
	function trigger() {
		$trace = debug_backtrace();
		$errlog = fopen("../tmp/error.log", "a+");
		fwrite ( $errlog , $trace );
	}
}
?>
