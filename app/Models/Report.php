<?php namespace App\Models;
use CodeIgniter\Database\ConnectionInterface;

class Report{
	public $builder;
	public $data;
	//public $builder_users;
	public function __construct()
	{
			$this->db = $db = \Config\Database::connect();
	}
	public function getReportMonth($month,$year){
		$query = $this->db->query("SELECT b.waktu as Tanggal,a.nama_barang AS Nama , CASE
		WHEN b.status_user = 0 THEN a.harga_pokok
		WHEN b.status_user = 1 THEN a.harga_level_1
		WHEN b.status_user = 2 THEN a.harga_level_2
		END as Harga , c.jumlah_beli as Jumlah , CASE
		WHEN b.status_user = 0 THEN a.harga_pokok * c.jumlah_beli
		WHEN b.status_user = 1 THEN a.harga_level_1 * c.jumlah_beli
		WHEN b.status_user = 2 THEN a.harga_level_2 * c.jumlah_beli
		END as Subtotal
		FROM barang a, transaksi b , transaksi_detail c
		WHERE a.ID = c.ID_barang
		AND b.ID = c.ID_transaksi
		AND MONTH(b.waktu) = '$month'
		AND YEAR(b.waktu) ='$year'");
		return $query->getResult();
	}
}
?>
