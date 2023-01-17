<?php 
namespace Core;

class View {
	public $view;
	public $data = [];

	public function __construct($viewName) {
		// $viewName = str_replace('\\', '/', $viewName);
		$this->view = $viewName;
	}

	public function bind($name,$value = '') {
		$this->data[$name] = $value;
	}

	public function render() {
		extract($this->data['data']);
		$view = ROOT.DS.'views'.DS.$this->view.'.view.php';
		if (file_exists($view)) {
			require_once $view;
		}
		else {
			die('Views Not found !!');
		}
	}

	public function load($view) {
		extract($this->data['data']);
		// $view = str_replace('\\', '/', $view);
		$file = ROOT.DS.'views'.DS.$view.'.view.php';
		if (file_exists($file)) {
			include_once $file;
		}
		else {
			die('File Not Found');
		}
	}

	public function __destruct() {
		$this->render();
	}
}