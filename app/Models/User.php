<?php namespace App\Models;
use CodeIgniter\Database\ConnectionInterface;

class User{
	public $builder;
	public function __construct()
	{
			$this->db = $db = \Config\Database::connect();
			$this->builder = $db->table('users');
	}
	public function show()
	{
		$query = $this->db->query("SELECT ID,nama ,alamat, no_handphone,status FROM users");
		return $query->getResult();
	}
	public function update($id,$status){
		$this->db->transStart();
		$this->db->query("UPDATE users set status = '$status' WHERE ID = '$id'");
		$this->db->transComplete();

		if($this->db->transStatus() === FALSE)
		{
			$this->db->trans_rollback();
			return FALSE;
		}
	}
}

?>
