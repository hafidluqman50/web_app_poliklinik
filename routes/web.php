<?php 
$controllerName = (isset($_GET['c']) && $_GET['c']) ? $_GET['c'] : 'auth';
$controller = ROOT.DS.'app'.DS.'Controllers'.DS.$controllerName.'Controller.php';

if (file_exists($controller)) {
	require_once $controller;
	$action = (isset($_GET['m']) && $_GET['m']) ? $_GET['m'] : 'index';
	$controllerName = ucfirst($controllerName).'Controller';

	$obj = new $controllerName();

	if (method_exists($obj,$action)) {
		$args = [];
		if (count($_GET) > 2) {
			$parts = array_slice($_GET,2);
			foreach ($parts as $part) {
				array_push($args,$part);
			}
		}
		call_user_func_array([$obj,$action], $args);
	}else require_once ROOT.DS.'views/404_page/404_page.view.php';
}else die('Controller Not Found !!');