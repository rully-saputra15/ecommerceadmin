<?php namespace App\Controllers;
use App\Models\Barang;
use App\Models\Transaksi;
use App\Models\Login;
use PhpOffice\PhpSpreadsheet\Reader\Csv;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use App\Config\Encryption;
$model = null;
$model_login = null;
$transaksi = null;
$encrypter = null;
$message = null;
class Dashboard extends BaseController{

	public function __construct(){
		//parent::__construct();
		helper('form');
		$this->model = new Barang();
		$this->model_login = new Login();
		$this->transaksi = new Transaksi();
		$this->encrypter = \Config\Services::encrypter();
	}
	public function index()
	{
		//echo view('login',['message'=>$this->message]);
		$row = $this->model->check();
		$data_transaksi = $this->transaksi->show();
		$data_barang_terjual = $this->transaksi->jumlah_barang_terjual();
		echo view('dashboard',['row' => $row,'notif'=>$data_transaksi,'jumlah_barang_terjual' => $data_barang_terjual[0]->nilai]);
	}
	public function login()
	{
		if(isset($_POST['submit'])){
			$username = $_POST['username'];
			$password = $_POST['password'];
			if($username == '' && $password == ''){
				$message = 'Username dan Password salah!';
				echo view('login');
			}else{
				$ivlen = openssl_cipher_iv_length('aes-256-ctr');
				$iv = '1234567890123456';
				$ciphertext = base64_encode(openssl_encrypt($password,'aes-256-ctr','256', OPENSSL_RAW_DATA,$iv));
				$num = $this->model_login->check($username,$ciphertext);
				if($num->username == $username){
					$row = $this->model->check();
					$data_transaksi = $this->transaksi->show();
					$data_barang_terjual = $this->transaksi->jumlah_barang_terjual();
					echo view('dashboard',['row' => $row,'notif'=>$data_transaksi,'jumlah_barang_terjual' => $data_barang_terjual[0]->nilai]);
				}
				else{
					$message = 'Username dan Password salah!';
					echo view('login');
				}
			}

		}else{
			$message = 'Username dan Password salah!';
			echo view('login');
		}
	}
	public function addBarang()
	{
		if(isset($_POST['submit'])){
			$nama_barang = $_POST['nama-barang'];
			$foto_barang = $_POST['foto-barang'];
			$harga = $_POST['harga'];
			$stok = $_POST['stok'];
			$kondisi = $_POST['kondisi'];
			$deskripsi = $_POST['deskripsi'];

			$addBarang = $this->model->addBarang($nama_barang,$foto_barang,$harga,$stok,$kondisi,$deskripsi);
			print_r($addBarang);
		}
	}
	public function upload()
	{
		if(isset($_POST['import'])){
			$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
			$spreadsheet = $reader->load($_FILES['file']['tmp_name']);
			$sheetData = $spreadsheet->getActiveSheet()->toArray();
			//echo "<pre>";
			//print_r($sheetData);
			//print_r($sheetData[0][2]);
			for($i = 1 ; $i < count($sheetData);$i++){
				//$sqlUpdate = "UPDATE barang SET jumlah_terjual=" . $sheetData[$i][3] . ",stok_barang=" .$sheetData[$i][4] . ",harga=" .$sheetData[$i][5] . ",berat=".$sheetData[$i][6] + " WHERE ID = .$sheetData[$i][0].";
				$this->model->updt($sheetData[$i]);
			}
		}else{
			echo "belum masuk";
		}
			$row = $this->model->check();
			$detail_transaksi = $this->transaksi->detail_transaksi($id);
			echo view('dashboard',['row' => $row,'notif'=>$detail_transaksi,'jumlah_barang_terjual' => $data_barang_terjual[0]->nilai]);
	}
	public function notif($id)
	{
		$detail_transaksi = $this->transaksi->detail_transaksi($id);
		echo view('detail-transaksi',['data'=>$detail_transaksi]);
	}
	public function insight(){
		$data_insight = $this->transaksi->insight();
		echo view('insight',['data' => $data_insight]);
	}
	public function transaksi()
	{
		$data_transaksi = $this->transaksi->show();
		echo view('transaksi',['data' => $data_transaksi]);
	}
	public function transaksiSukses()
	{
		if(isset($_POST['selesai'])){
			$data_transaksi = $this->transaksi->transaksiSukses();
			echo view('transaksi',['data'=>$data_transaksi]);
		}else{
			$data_transaksi = $this->transaksi->show();
			echo view('transaksi',['data'=>$data_transaksi]);
		}

	}
	public function changeStatus($id){
		$result = $this->transaksi->changeStatus($id);
		$row = $this->model->check();
		$detail_transaksi = $this->transaksi->detail_transaksi($id);
		echo view('dashboard',['row' => $row,'notif'=>$detail_transaksi,'jumlah_barang_terjual' => $data_barang_terjual[0]->nilai]);
	}
}
?>
