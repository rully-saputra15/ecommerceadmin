<?php
	class Admin{
		private $conn;

		public function __construct($db){
			$this->conn = $db;
		}
		//adminEcommerce2020
		public function login($username,$password){
			$table_name = 'admin';
			$password = md5($password);
			$query = "SELECT * from admin WHERE username = '$username' AND password = '$password'";
			$stmt = $this->conn->prepare($query);
			$stmt->execute();
			return $stmt;
		}
	}
?>
