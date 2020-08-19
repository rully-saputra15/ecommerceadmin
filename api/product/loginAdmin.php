<?php
	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json;charset=UTF-8");

	include_once '../config/database.php';
	include_once '../objects/admin.php';

	$database = new Database();
	$db = $database->getConnection();
	$admin = new Admin($db);

	$postdata = file_get_contents("php://input",true);
	$data = json_decode($postdata,true);
	$stmt = $admin->login($data['username'],$data['password']);
	$num = $stmt->rowCount();
	if($num > 0){
		http_response_code(200);
		echo json_encode(
			array("message" => 'Success')
		);
	} else {
		http_response_code(400);
		echo json_encode(
			array("message" => 'Failed')
		);
	}
?>
