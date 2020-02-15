<?php namespace App\Controllers;
use App\Models\Login;
use App\Models\Barang;
$model = null;
$model_barang = null;
class Home extends BaseController
{

	public function __construct(){
		//parent::__construct();
		$this->model = new Login();
		$this->model_barang = new Barang();
	}
	public function index()
	{
		return view('login');
	}
	/*public function _remap($method){
		if($method === 'dashboard'){
			$this->$method();
		}else{
			$this->index();
		}
	}*/
	public function dashboard()
	{
		if(isset($_POST['btnSubmit'])){
			$username = $_POST['username'];
			$password = $_POST['password'];
			echo "<script>console.log('.$username.$password')</script>";
			$num = $this->model->check($username,$password);
			$row = $this->model_barang->check();
			echo $num;
			if($num > 0){
				echo view('dashboard',['row' => $row]);
			}
			else{
				echo view('login');
			}
		}else{
			$row = $this->model_barang->check();
			echo view('dashboard',['row' => $row]);
		}

	}
	//--------------------------------------------------------------------

}
