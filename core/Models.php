<?php
namespace Core;
use Core\DB;

 class Models extends DB
 {
	protected $tableName;

 	public function __construct()
 	{
 		parent::__construct();
 	}

 	public function all()
 	{
 		$sql = "SELECT * FROM $this->tableName";
 		$execute = $this->mysqli->query($sql); 
 		return $execute;
 	}

 	public function rowsAll()
 	{
 		$sql = "SELECT * FROM $this->tableName";
 		$execute = $this->mysqli->query($sql);
 		$rows = $execute->num_rows;
 		return $rows;
 	}

 	// public function create($data = []) 
 	// {
 	// 	$sql = "INSERT INTO $this->tableName (".
 	// }
 } 