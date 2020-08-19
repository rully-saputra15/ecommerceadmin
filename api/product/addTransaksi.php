<?php
	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json;charset=UTF-8");

	include_once '../config/database.php';
	include_once '../objects/transaksi.php';

	$database = new Database();
	$db = $database->getConnection();
	$transaksi = new Transaksi($db);
	$postdata = file_get_contents("php://input",true);

	$data = json_decode($postdata,true);
	$stmt = $transaksi->insertTransaksi($data['IDUser'],$data['JenisPembayaran'],$data['TotalHarga']);
	if($stmt == true){
		http_response_code(200);
		echo json_encode(array('Message' => 'success','ID'=>$transaksi->getID()));
	}else{
		http_response_code(400);
		echo json_encode(array('Message' => 'Failure!'));
	}
?>
