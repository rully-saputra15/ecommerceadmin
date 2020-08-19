<?php
	class Barang{
		private $conn;
		private $table_name = "barang";

		public $id;
		public $foto;
		public $nama_barang;
		public $jumlah_terjual;
		public $stok_barang;
		public $harga;
		public $satuan;
		public $deskripsi;
		public $kategori;
		public $merk;

		public function __construct($db){
			$this->conn = $db;
		}
		public function read(){
			$query ="SELECT * FROM barang";
			$stmt = $this->conn->prepare($query);
			$stmt->execute();
			return $stmt;
		}
		public function readID($id,$status){
			$status = (int) $status;
			if($status == 0){
				$query = "SELECT id,foto,kode_item,nama_barang,jumlah_terjual,stok_barang,harga_pokok 'harga',satuan,merk FROM barang WHERE ID = '$id'";
			}else if($status == 1){
				$query = "SELECT id,foto,kode_item,nama_barang,jumlah_terjual,stok_barang,harga_level_1 'harga',satuan,merk FROM barang WHERE ID = '$id'";
			}else{
				$query = "SELECT id,foto,kode_item,nama_barang,jumlah_terjual,stok_barang,harga_level_2 'harga',satuan,merk FROM barang WHERE ID = '$id'";
			}
			$stmt = $this->conn->prepare($query);
			$stmt->execute();
			return $stmt;
		}
		public function updateStokBarang($id,$jumlah){
			$ID = (int) $id;
			$jumlah_int = (int) $jumlah;
			$query = "SELECT stok_barang,jumlah_terjual FROM barang WHERE ID ='$ID'";
			$stm = $this->conn->prepare($query);
			$stm->execute();
			$stok_lama = $stm->fetchColumn();
			$jumlah_terjual = $stm->fetchColumn(1);
			$stok_lama_int = (int) $stok_lama;
			$jumlah_terjual_int = (int) $jumlah_terjual;
			$stok = $stok_lama_int - $jumlah_int;
			$terjual = $jumlah_terjual_int + $jumlah;
			if($stok < 0){
				$stok = 0;
			}
			$query = "UPDATE barang SET stok_barang = '$stok',jumlah_terjual = '$terjual' WHERE ID ='$ID'";
			$stmt = $this->conn->query($query);
			$stmt->execute();
			return $stmt;
		}
	}
?>
