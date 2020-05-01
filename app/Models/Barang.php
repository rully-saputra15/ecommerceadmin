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
			'kode_item' => $sql[0],
			'nama_barang' => $sql[1],
			'merk' => $sql[2],
			'satuan' => $sql[3],
			'harga_pokok' => $sql[4],
			'harga_level_1' => $sql[5],
			'harga_level_2' => $sql[6],
			'stok_barang' => $sql[7]
		];
		$this->$builder->set($array);

		// $builder->set('nama_barang',$sql[2]);
		// $builder->set('jumlah_terjual',$sql[3]);
		// $builder->set('stok_barang',$sql[4]);
		// $builder->set('harga',$sql[5]);
		// $builder->set('berat',$sql[6]);
		$this->$builder->where('nama_barang',$sql[1]);
		$this->$builder->update();
	}
	public function addBarang($namaItem,$kodeItem,$stok,$hargaPokok,$hargaLevel1,$hargaLevel2,$satuan)
	{
		$this->db->transStart();
		$this->db->query("INSERT INTO Barang(kode_item,nama_barang,stok_barang,harga_pokok,harga_level_1,harga_level_2,satuan,merk) VALUES('$kodeItem','$namaItem','$stok','$hargaPokok','$hargaLevel1','$hargaLevel2','$satuan','$merk')");
		$this->db->transComplete();
		if($this->db->transStatus() === FALSE)
		{
			$this->db->trans_rollback();
			return FALSE;
		}
	}

}
?>
