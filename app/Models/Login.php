<?php namespace App\Models;
use CodeIgniter\Database\ConnectionInterface;

 class Login {
	public $username;
	public $password;
	protected $db;
	public function __construct()
	{
			$this->db = $db = \Config\Database::connect();
	}
	public function check($username,$password){
		$query = $this->db->query("SELECT * FROM users WHERE username='%s' && password='%s'",$username,$password);
		return $query->num_rows();

	}
 }
?>
