<?php
	class Database{
		private $host = "localhost";
		//private $db_name = "id12865567_ecommerce";
		//private $username = "id12865567_saputra523";
		//private $password = "adminEcommerce";
		private $db_name = "adminecommerce";
		private $username = "root";
		private $password = "";
		public $conn;

		function getConnection(){
			$this->conn = null;
			try{
				$this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name,$this->username,$this->password);
				$this->conn->exec("set names utf8");
			}catch(PDOExecption $exception){
				echo "Connection error: ". $exeception->getMessage();
			}
			return $this->conn;
		}
	}

?>
