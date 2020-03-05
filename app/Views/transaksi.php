<!doctype html>
	<head>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>asset/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

	</head>
	<body>
		<div class="container">
		<h1>Transaksi</h1>
			<div class="list-group py-8">
			<?php foreach($data as $dat) :?>
			<a href="<?php echo $baseURL . '/notif/'.$dat->ID?>" class="list-group-item list-group-item-action flex-column align-items-start">
    			<div class="d-flex w-100 justify-content-between">
      				<h5 class="mb-1"><?php echo $dat->waktu?></h5>
      				<small><b><?php echo $dat->selisih_waktu?></b> days ago</small>
    			</div>
    			<p class="mb-1"><?php echo 'Nama : ' .$dat->nama_barang?></p>
    			<small><?php echo 'Jumlah Beli : ' . $dat->jumlah_beli?></small>
  			</a>
			<?php endforeach;?>
			</div>
		</div>
	</body>
</html>
