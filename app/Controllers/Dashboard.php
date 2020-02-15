<?php namespace App\Controllers;
use App\Models\Barang;
use App\Models\Transaksi;
use PhpOffice\PhpSpreadsheet\Reader\Csv;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
$model = null;
$transaksi = null;
class Dashboard extends BaseController{
	public function __construct(){
		//parent::__construct();
		$this->model = new Barang();
		$this->transaksi = new Transaksi();
	}
	public function index()
	{
		/*for($j = 0 ; $j < sizeof($row) ; $j++){
			for($q = 0 ; $q < 5 ; $q++){
				echo $row['ID'][$q];
			}
		}*/
		echo view('login');
	}
	public function login()
	{
		if(isset($_POST['btnSubmit'])){
			$username = $_POST['username'];
			$password = $_POST['password'];
			$num = $this->model->check($username,$password);
			$row = $this->model_barang->check();
			echo $num;
			if($num > 0){
				$row = $this->model->check();
				$data_transaksi = $this->transaksi->show();
				echo view('dashboard',['row' => $row]);
			}
			else{
				echo view('login');
			}
		}else{
			$row = $this->model->check();
			$data_transaksi = $this->transaksi->show();
			$data_barang_terjual = $this->transaksi->jumlah_barang_terjual();
			echo view('dashboard',['row' => $row,'notif'=>$data_transaksi,'jumlah_barang_terjual' => $data_barang_terjual[0]->nilai]);
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
			echo view('dashboard',['row' => $row]);
	}
	public function notif($id)
	{
		echo $id;
	}
	public function seeMoreTransaksi()
	{
		echo view('transaksi');
	}
}
?>
