<?php namespace App\Controllers;
use App\Models\Barang;
use App\Models\Transaksi;
use App\Models\Login;
use App\Models\User;
use App\Models\Report;
use PhpOffice\PhpSpreadsheet\Reader\Csv;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use App\Config\Encryption;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\Files\UploadedFile;
$model = null;
$model_login = null;
$model_user = null;
$model_report = null;
$transaksi = null;
$encrypter = null;
$message = null;
class Dashboard extends BaseController{
	public function __construct(){
		//parent::__construct();
		helper('form');
		$this->model = new Barang();
		$this->model_login = new Login();
		$this->model_user = new User();
		$this->model_report = new Report();
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
	public function showReport(){
		echo view('report');
	}
	public function showReportData(){
		$month;$year;
		if($_POST['month']){
			$month = $_POST['month'];
		}
		if($_POST['year']){
			$year = $_POST['year'];
		}
		if(isset($month) && isset($year)){
			/*$data = [
				'month' => $month,
				'year' => $year
			];*/
			$result = $this->model_report->getReportMonth($month,$year);
			//print_r($result);
			$output = '<br>';
			$total = 0;
			$showTotal = '';
			$output .= '<table class="table table-bordered">';
			$output .= '<thead>
							<tr>
								<th scope="col">Tanggal</th>
								<th scope="col">Nama Barang</th>
								<th scope="col">Jumlah Barang</th>
								<th scope="col">Subtotal</th>
							</tr>
						</thead><tbody>';
			foreach($result as $data){
				$output .= '<tr>
					<td>
						'.date("H:i:s d-M-Y",strtotime($data->Tanggal)).'
					</td>
					<td>
						'.$data->Nama.'
					</td>
					<td>
					'.$data->Jumlah.'
					</td>
					<td>
					Rp. '.number_format($data->Subtotal).'
					</td>
					</tr>';
					$total = $total + $data->Subtotal;
			}
			$showTotal .= '<br><h3 style="text-align:center">Total : Rp. <b>'.number_format($total).'</b></h3>';
			$output .= '</tbody></table>';
			$outputFinal = $showTotal . $output;
			echo $outputFinal;
		} else {
			echo 'Mohon masukkan bulan dan tahun';
		}
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
	public function user(){
		$result = $this->model_user->show();
		echo view('user',['data' => $result]);
	}
	public function gantiStatusUser(){
		$id;$status;
		if(isset($_POST['id'])){
			$id =  $_POST['id'];
		}
		if(isset($_POST['status'])){
			$status= $_POST['status'];
		}
		$result = $this->model_user->update($id,$status);
		if($result == false){
			$message = 'Gagal mengupdate!';
			$result = $this->model_user->show();
			echo view('user',['data' => $result,'message' => $message]);
		}
	}
	public function viewAddItem(){
		echo view('add_item');
	}
	public function addItem(){
		$namaItem;$kodeItem;$stok;$hargaPokok;$hargaLevel1;$hargaLevel2;$satuan;
		if(isset($_POST['namaItem'])){
			$namaItem = $_POST['namaItem'];
		}
		if(isset($_POST['kodeItem'])){
			$kodeItem = $_POST['kodeItem'];
		}
		if(isset($_POST['stok'])){
			$stok = $_POST['stok'];
		}
		if(isset($_POST['hargaPokok'])){
			$hargaPokok = $_POST['hargaPokok'];
		}
		if(isset($_POST['hargaLevel1'])){
			$hargaLevel1 = $_POST['hargaLevel1'];
		}
		if(isset($_POST['hargaLevel2'])){
			$hargaLevel2 = $_POST['hargaLevel2'];
		}
		if(isset($_POST['satuan'])){
			$satuan = $_POST['satuan'];
		}
		$result = $this->model->addBarang($namaItem,$kodeItem,$stok,$hargaPokok,$hargaLevel1,$hargaLevel2,$satuan);
		if($result === FALSE){
			echo "<script>alert('Error!')</script>";
			return FALSE;
		}
		$this->index();
	}
	public function itemDetail(){
		try{
			$id;
			if($_POST['id']){
				$id = $_POST['id'];
			}
			if(isset($id)){
				$result = $this->model->get_search_barang($id);
				echo json_encode($result->getResult('array'));
			} else {
				echo 'error';
			}
		} catch(\Exception $e){
			alert($e);
		}

	}
	public function editItemDetail(){
		$validated = $this->validate([
            'foto' => 'uploaded[foto]|mime_in[foto,image/jpg,image/jpeg,image/gif,image/png]|max_size[foto,9000]'
        ]);
		$id;$namaItem;$kodeItem;$stok;$hargaPokok;$hargaLevel1;$hargaLevel2;$satuan;$foto;$merk;
		$namaFoto;
		if(isset($_POST['ID'])){
			$id = $_POST['ID'];
		}
		if(isset($_POST['namaItem'])){
			$namaItem = $_POST['namaItem'];
		}
		if(isset($_POST['kodeItem'])){
			$kodeItem = $_POST['kodeItem'];
		}
		if(isset($_POST['stok'])){
			$stok = $_POST['stok'];
		}
		if(isset($_POST['hargaPokok'])){
			$hargaPokok = $_POST['hargaPokok'];
		}
		if(isset($_POST['hargaLevel1'])){
			$hargaLevel1 = $_POST['hargaLevel1'];
		}
		if(isset($_POST['hargaLevel2'])){
			$hargaLevel2 = $_POST['hargaLevel2'];
		}
		if(isset($_POST['satuan'])){
			$satuan = $_POST['satuan'];
		}
		/*if(isset($_POST['foto'])){
			$foto = $_POST['foto'];
		}*/
		if(isset($_POST['merk'])){
			$merk = $_POST['merk'];
		}
		if($validated){
			//$file = $request->getFiles();
			$foto = $this->request->getFile('foto');
			$namaFoto = $foto->getName();
			$foto->move(ROOTPATH . 'public/uploads');
		}
		$data = [
			'id' => intval($id),
			'namaItem' => $namaItem,
			'kodeItem' => $kodeItem,
			'stok' => intval($stok),
			'hargaPokok' => intval($hargaPokok),
			'hargaLevel1' => intval($hargaLevel1),
			'hargaLevel2' => intval($hargaLevel2),
			'satuan' => $satuan,
			'merk' => $merk,
			'foto' => $namaFoto
		];
		$result = $this->model->updtItem($data);
		if($result === FALSE){
			echo "<script>alert('Error!')</script>";
			return FALSE;
		}
		$this->index();
	}
}
?>
