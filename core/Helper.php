<?php 
namespace Core;

class Helper {
	function redirect($url) {
		header('Refresh:0; url='.$url);
	}
}