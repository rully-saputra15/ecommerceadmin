<?php namespace App\Models;
use CodeIgniter\Database\ConnectionInterface;

class Barang {
	public $builder;
	public function __construct()
	{
			$this->db = $db = \Config\Database::connect();
			$this->$builder = $db->table('barang');
	}
	public function check(){
		$query = $this->db->query("SELECT * FROM barang");
		return $query->getResult();
	}
	public function updt($sql){

		$array = [
			'nama_barang' => $sql[3],
			'jumlah_terjual' => $sql[4],
			'stok_barang' => $sql[5],
			'harga' => $sql[6],
			'berat' => $sql[7]
		];
		$this->$builder->set($array);

		// $builder->set('nama_barang',$sql[2]);
		// $builder->set('jumlah_terjual',$sql[3]);
		// $builder->set('stok_barang',$sql[4]);
		// $builder->set('harga',$sql[5]);
		// $builder->set('berat',$sql[6]);
		$this->$builder->where('ID',$sql[1]);
		$this->$builder->update();
	}
	public function addBarang($nama_barang,$foto_barang,$harga,$stok,$kondisi,$deskripsi)
	{
		$query = $this->db->query("INSERT INTO barang(foto,nama_barang,jumlah_terjual,stok_barang,harga,berat,kondisi,deskrpsi,rating) VALUES('$foto_barang','$nama_barang',0,$stok,$harga,50,'BARU','$deskripsi',0)");
		return $query->error();
	}

}
?>
