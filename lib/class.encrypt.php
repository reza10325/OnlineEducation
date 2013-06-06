<?php
class encrypt {
	static function md5($str){
		return md5($str . AUTH_HASH);
	}
}
