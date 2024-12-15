<?php

require_once __DIR__ . '/../core/Constant.php';

class Database
{
	public static function connect(): mysqli
	{
		$conn = new mysqli(
			Constant::DB_HOST,
			Constant::DB_USER,
			Constant::DB_PASS,
			Constant::DB_NAME
		);
		if ($conn->connect_error) die("Connection failed: $conn->connect_error");
		return $conn;
	}
}
