<?php
	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json;charset=UTF-8");

	include_once '../config/database.php';
	include_once '../objects/barang.php';

	$database = new Database();
	$db = $database->getConnection();
	$barang = new Barang($db);

	$postdata = file_get_contents("php://input",true);
	$data = json_decode($postdata,true);

	$stmt = $barang->readID($data['id'],$data['status']);
	$num = $stmt->rowCount();

	if($num > 0){
		$barang_arr = array();
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
			extract($row);

			$barang_tmp = array(
				"id" => $id,
				"foto" =>$foto,
				"nama_barang" => $nama_barang,
				"kode_item" => $kode_item,
				"harga_pokok" => $harga,
				"stok_barang" => $stok_barang,
				"satuan" => $satuan,
				"jumlah_terjual" => $jumlah_terjual,
				"merk" =>$merk,
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
