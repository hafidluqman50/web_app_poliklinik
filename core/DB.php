<?php
namespace Core;
use mysqli;

class DB
{
	public $mysqli;
	
	public function __construct()
	{
		$this->mysqli = new mysqli(HOST,USER,PASS,DBNAME);
		if (!$this->mysqli) {
			echo $this->mysqli->error;
			die;
		}
	}
}