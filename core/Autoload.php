<?php 
function __autoload($className) {
	$fileName = str_replace("\\",DS,$className).'.php';
	if (!file_exists($fileName)) {
		return false;
	}
	include $fileName;
}