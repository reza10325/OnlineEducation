<?php
function redirect($addr){
	header('Location: ' . $addr);
	exit;
}
?>
