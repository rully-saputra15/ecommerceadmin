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

		$stmt = $user->register($data['nama'],$data['email'],$data['password'],$data['alamat'],$data['handphone'],$data['provinsi'],$data['kota']);
		if($stmt == 1){
			http_response_code(200);
			echo json_encode(array("message" => "success!"));
		}else{
			http_response_code(400);
			echo json_encode(array("message" => "failed!"));
		}
?>
