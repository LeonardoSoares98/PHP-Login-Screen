<?php
class Database {
	
	// specify your own database credentials
	private $host = "localhost";
	private $db_name = "teste";
	private $username = "root";
	private $password = "";
	public $conn;
	
	// get the database connection
	public function getConnection() {
		$this->conn = null;
		
		try {
			$this->conn = new PDO ( "mysql:host=" . $this->host . ";dbname=" . $this->db_name . "; charset=utf8", $this->username, $this->password );
			$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
		} catch ( PDOException $exception ) {
			echo "Connection error: " . $exception->getMessage ();
		}
		
		return $this->conn;
	}
}
?>