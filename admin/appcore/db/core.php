<?php 

require_once $_SERVER['DOCUMENT_ROOT'].'/admin/appcore/config.php';

class DatabaseConnection
{
	private static $DB_HOST=DB_ADDR;
	private static $DB_NAME=DB_NAME;
	private static $DB_USERNAME=DB_USERNAME;
	private static $DB_PASSWORD=DB_PASSWORD;
	
	public $conn;

	function __construct()
	{
		$this->conn=new mysqli($this::$DB_HOST, $this::$DB_USERNAME, $this::$DB_PASSWORD, $this::$DB_NAME) or die("Database connection failed.");
	}
	
	function get_affected_rows()
	{
		return $this->conn->affected_rows;
	}

	function query($q)
	{
		$result=$this->conn->query($q);
		return $result; 
	}
	
	function __destruct()
	{
		if($this->conn)
			$this->conn->close();
	}
}
?>