<?php
	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json;charset=UTF-8");

	include_once '../config/database.php';
	include_once '../objects/user.php';

	$database = new Database();
	$db = $database->getConnection();
	$user = new User($db);

	$postdata = file_get_contents("php://input",true);
	$data = json_decode($postdata,true);
	$stmt = $user->login($data['email'],$data['password']);
	$num = $stmt->rowCount();
	if($num > 0){
		$barang_arr = array();
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
			extract($row);

			$barang_tmp = array(
				"id" => $ID,
				"status" => $status,
				"alamat" => $alamat,
				"nama" => $nama,
				"message" => 'success',
			);
			array_push($barang_arr,$barang_tmp);
		}
		http_response_code(200);
		echo json_encode($barang_arr);
	}else{
		http_response_code(400);
		echo json_encode(
			array("message" => "No products found.")
		);
	}
?>
