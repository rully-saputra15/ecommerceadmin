<?php
	class User{
		private $conn;
		private $table_name="users";

		public function __construct($db){
			$this->conn = $db;
		}

		public function login($email,$password){
			$password = md5($password);
			$query = "SELECT ID,nama,alamat,status from users WHERE email = '$email' AND password = '$password'";
			$stmt = $this->conn->prepare($query);
			$stmt->execute();
			return $stmt;
		}
		public function register($nama,$email,$password,$alamat,$handphone,$provinsi,$kota){
			$password = md5($password);
			$query = "INSERT INTO users(nama,alamat,kota,provinsi,kode_pos,username,password,no_handphone,status,email)
			VALUES('$nama','$alamat','$kota','$provinsi',0,'','$password','$handphone',0,'$email')";
			$stmt = $this->conn->prepare($query);
			if($stmt->execute()){
				return 1;
			}else{
				return 0 ;
			}
		}
		public function getStatusUser($id){
			$query = "SELECT status FROM users WHERE ID = '$id'";
			$stmt = $this->conn->prepare($query);
			$stmt->execute();
			return $stmt;
		}
	}
?>
