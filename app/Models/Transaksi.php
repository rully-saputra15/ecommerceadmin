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
		$query = $this->db->query("SELECT a.ID,b.nama,a.jumlah_beli,c.nama_barang FROM transaksi a, users b,barang c WHERE a.ID_user = b.ID AND a.ID_barang = c.ID");
		return $query->getResult();
		//$query = $this->db->query("SELECT * FROM transaksi");
		//return $query->getResult();
	}
	public function jumlah_barang_terjual()
	{
		$query = $this->db->query("SELECT sum(jumlah_beli) as nilai from transaksi");
		return $query->getResult();
	}
	public function detail_transaksi($id)
	{
		$query = $this->db->query("SELECT a.ID as ID,c.nama_barang as nama_barang,b.nama as nama_pembeli, a.jumlah_beli as jumlah_beli , a.jenis_pembayaran as pembayaran, a.total_harga as total_harga,b.alamat as alamat FROM transaksi a, users b, barang c WHERE a.ID_user = b.ID AND a.ID_barang = c.ID AND a.ID = '$id'");
		return $query->getResult();
	}
}
