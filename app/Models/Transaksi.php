<?php namespace App\Models;
use CodeIgniter\Database\ConnectionInterface;

class Transaksi {

	public $builder;
	public $data;
	//public $builder_users;
	public function __construct()
	{
			$this->db = $db = \Config\Database::connect();
			$this->builder = $db->table('transaksi');
			$this->builder_users = $db->table('users');
			$this->data = array();
	}
	public function show()
	{
		$query = $this->db->query("SELECT a.waktu 'waktu',DATEDIFF(NOW(),a.waktu)'selisih_waktu', a.ID 'ID',b.nama 'nama', a.total_harga 'total_harga'
		FROM transaksi a, users b
        WHERE a.ID_user = b.ID
        AND a.status = 0
		ORDER BY 2 ASC");
		return $query->getResult();
		//$query = $this->db->query("SELECT * FROM transaksi");
		//return $query->getResult();
	}
	public function jumlah_barang_terjual()
	{
		$query = $this->db->query("SELECT sum(jumlah_beli) as nilai from transaksi_detail");
		return $query->getResult();
	}
	public function detail_transaksi($id)
	{
		$query = $this->db->query("SELECT a.ID 'id' , d.nama_barang 'nama_barang',c.nama 'nama',c.alamat 'alamat', b.jumlah_beli 'jumlah_beli', a.jenis_pembayaran 'jenis_pembayaran',a.status 'status',(CASE
		WHEN a.status_user = 0 THEN d.harga_pokok
		WHEN a.status_user = 1 THEN d.harga_level_1
		ELSE  d.harga_level_2 END) 'harga',d.satuan 'satuan',a.total_harga 'total_harga'
		FROM transaksi a, transaksi_detail b, users c , barang d
		WHERE a.ID = b.ID_transaksi
		AND a.ID_user = c.ID
		AND b.ID_barang = d.ID
		AND a.ID = '$id'");
		return $query->getResult();
	}
	public function insight(){
		$query = $this->db->query("SELECT DATE_FORMAT(a.waktu,'%M') 'Bulan',SUM(c.jumlah_beli) 'Jumlah'
		FROM transaksi a, barang b , transaksi_detail c
		WHERE c.ID_barang = b.ID
        AND a.ID = c.ID_transaksi
		GROUP BY MONTH(a.waktu)
		ORDER BY MONTH(a.waktu) asc;");
		return $query->getResult();
	}
	public function transaksiSukses()
	{
		$query = $this->db->query("SELECT a.waktu 'waktu',DATEDIFF(NOW(),a.waktu)'selisih_waktu', a.ID 'ID',b.nama 'nama',a.total_harga 'total_harga'
		FROM transaksi a, users b WHERE a.ID_user = b.ID  AND a.status = 1
		ORDER BY 2 ASC");
		return $query->getResult();
	}
	public function changeStatus($id){
		$query = $this->db->query("UPDATE transaksi SET status = 1 WHERE ID = '$id'");
		return $query->getResult();
	}
}
