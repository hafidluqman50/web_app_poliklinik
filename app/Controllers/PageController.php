<?php 
use Core\DB;
use Core\Controllers;

class PageController extends Controllers
{
	public function index() {
		$this->view('welcome');
	}
}