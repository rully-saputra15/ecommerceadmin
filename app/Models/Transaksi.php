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
}
