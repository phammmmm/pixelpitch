<?php
class DBController {
	private $host = "localhost";
	private $user = "root";
	private $password = "welcome1";
	private $database = "pixelpitch";
	private $conn;
	
	function __construct() {
		$this->conn = $this->connectDB();
	}
	
	function connectDB() {
		$conn = mysqli_connect($this->host,$this->user,$this->password,$this->database);
		return $conn;
	}
	
	function executeUpdate($query){
		$result = mysqli_query($this->conn,$query);
		return $result;
	}
	function runQuery($query) {
		$result = mysqli_query($this->conn,$query);
		while($row=mysqli_fetch_assoc($result)) {
			$resultset[] = $row;
		}		
		if(!empty($resultset))
			return $resultset;
	}

	function singleResult($query) {
		$result = mysqli_query($this->conn,$query);
		$row=mysqli_fetch_assoc($result);
		return $row;

	}
	
	function numRows($query) {
		$result  = mysqli_query($this->conn,$query);
		$rowcount = mysqli_num_rows($result);
		return $rowcount;	
	}

	function getConnection() {
		return $this->conn;
	}

	function prepare($query){
		return mysqli_prepare($this->conn, $query);
	}
}
