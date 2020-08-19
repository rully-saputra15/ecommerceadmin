<?php
	class Transaksi{
		private $conn;

		private $IDUser;
		private $JenisPembayaran;
		private $TotalHarga;
		private $id;
		public function __construct($db){
			$this->conn = $db;
		}
		public function insertTransaksi($IDUser , $JenisPembayaran, $TotalHarga){
			$query = "SELECT COUNT(*)+1 FROM transaksi";
			$stm = $this->conn->prepare($query);
			$stm->execute();
			$ID = $stm->fetchColumn();
			$IDUser = (int) $IDUser;
			$ID = (int) $ID;
			$this->id = $ID;
			$TotalHarga = (int) $TotalHarga;
			$query = "INSERT INTO transaksi(waktu,ID,ID_user,jenis_pembayaran,total_harga,status) values(NOW(),'$ID','$IDUser','$JenisPembayaran','$TotalHarga',0)";
			$stmt = $this->conn->prepare($query);
			$stmt->execute();
			return $stmt;
		}
		public function insertDetailTransaksi($IDTransaksi,$IDBarang,$Jumlah){
			$IDTransaksi = (int) $IDTransaksi;
			$IDBarang = (int) $IDBarang;
			$Jumlah = (int) $Jumlah;
			$query = "INSERT INTO transaksi_detail VALUES('$IDTransaksi','$IDBarang','$Jumlah')";
			$stmt = $this->conn->prepare($query);
			$stmt->execute();
			return $stmt;
		}
		public function getID(){
			return $this->id;
		}
		public function getAllTransaksi($id){
			$query = "SELECT waktu,ID,jenis_pembayaran,total_harga,status FROM transaksi WHERE ID_user = '$id'";
			$stmt = $this->conn->prepare($query);
			$stmt->execute();
			return $stmt;
		}
		public function getAllTransaksiAdmin(){
			$query = "SELECT ID,DATE_FORMAT(waktu,'%d %M %Y %H:%i') as waktu,jenis_pembayaran,total_harga,status,status_user FROM transaksi";
			$stmt = $this->conn->prepare($query);
			$stmt->execute();
			return $stmt;
		}
		public function getTransaksiByIdAdmin($id,$status){
			if($status == 0){
				$query = "SELECT b.nama_barang as nama_barang, b.harga_pokok as harga , a.jumlah_beli as jumlah_beli
				FROM transaksi_detail a, barang b
				WHERE a.ID_barang = b.ID
				AND ID_transaksi = '$id';";
			} else if($status == 1){
				$query = "SELECT b.nama_barang as nama_barang, b.harga_level_1 as harga , a.jumlah_beli as jumlah_beli
				FROM transaksi_detail a, barang b
				WHERE a.ID_barang = b.ID
				AND ID_transaksi = '$id';";
			}else {
				$query = "SELECT b.nama_barang as nama_barang, b.harga_level_2 as harga , a.jumlah_beli as jumlah_beli
				FROM transaksi_detail a, barang b
				WHERE a.ID_barang = b.ID
				AND ID_transaksi = '$id';";
			}
			$stmt = $this->conn->prepare($query);
			$stmt->execute();
			return $stmt;
		}
	}

?>
