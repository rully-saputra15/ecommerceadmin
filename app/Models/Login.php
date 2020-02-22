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
		$query = $this->db->query("SELECT username FROM admin WHERE username='$username' AND password='$password'");
		return $query->getRow();

	}
 }
?>
