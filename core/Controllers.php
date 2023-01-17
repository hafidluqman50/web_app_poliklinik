<?php 
namespace Core;

use Core\View;
use Core\Helper;
use Core\DB;

class Controllers extends DB {
	protected $db;
	public function __construct() {
		parent::__construct();
	}

	protected function view($viewName,$data = []) {
		$view = new View($viewName);
		$view->bind('data',$data);
		return $view;
	}

	protected function location($url) {
		header('Location:'.$url);
	}

	protected function redirect($url) {
		header('Refresh:0; url='.$url);
	}
}