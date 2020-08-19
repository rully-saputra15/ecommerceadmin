<?php
	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json;charset=UTF-8");

	include_once '../config/database.php';
	include_once '../objects/transaksi.php';
	include_once '../objects/barang.php';
	$database = new Database();
	$db = $database->getConnection();
	$transaksi = new Transaksi($db);
	$barang = new Barang($db);
	$postdata = file_get_contents("php://input",true);

	$data = json_decode($postdata);
	$status1;$status2;
	//$data = json_encode($postdata);
	//echo $data->;
	$num = count($data);
	for($i = 0 ; $i < $num ; $i++){
		$status1 = $transaksi->insertDetailTransaksi($data[$i]->IDTransaksi,$data[$i]->IDBarang,$data[$i]->JumlahBarang);
		$status2 = $barang->updateStokBarang($data[$i]->IDBarang,$data[$i]->JumlahBarang);
	}
	if($status1 == true and $status2 == true){
		http_response_code(200);
		echo json_encode(array('Message' => 'success'));
	}else{
		http_response_code(400);
		echo json_encode(array('Message' => 'failure'));
	}
?>
