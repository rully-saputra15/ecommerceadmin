<!doctype html>
	<head>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>asset/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>asset/css/transaksi.css">
	</head>
	<body>
	<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
			<a class="navbar-brand" href="<?php echo base_url() . 'public/dashboard'?>">Admin</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    			<span class="navbar-toggler-icon"></span>
  			</button>
		<div class="collapse navbar-collapse" id="navbarNav">
    		<ul class="navbar-nav ml-auto">
					<li class="nav-item active">
        				<a class="nav-link" href="<?php echo base_url() . 'public/dashboard/showReport'?>">Report</a>
      				</li>
					<li class="nav-item">
						<a class="nav-link" href="<?php echo base_url(). 'public/dashboard/transaksi'?>">Transaksi</span></a>
					</li>
      				<li class="nav-item">
        				<a class="nav-link" href="<?php echo base_url(). 'public/dashboard/user'?>">Users</a>
      				</li>
    		</ul>
  		</div>
		  </nav>
		<div class="container">
		<h1>Transaksi</h1>
		<form action="<?php echo base_url() .'public/dashboard/transaksiSukses'?>" method="post">
		<div class="btn-group btn-group-sm d-md-flex p-2">
			<button type="submit" class="btn btn-primary" id="selesai" name="proses">MASIH DIPROSES</button>
			<button type="submit" class="btn btn-success" id="selesai" name="selesai">SELESAI</button>
		</div>
		</form>
			<div class="list-group py-8">
			<?php foreach($data as $dat) :?>
			<a href="<?php echo base_url() . 'public/dashboard/notif/'.$dat->ID?>" class="list-group-item list-group-item-action d-flex flex-column align-items-start">
    			<div class="d-flex w-100 justify-content-between">
      				<h5 class="mb-1"><?php $date = date_create($dat->waktu);echo date_format($date,"D , d-M-y H:i")?></h5>
      				<small><b><?php echo $dat->selisih_waktu?></b> days ago</small>
    			</div>
    			<p class="mb-1"><?php echo 'Nama : ' .$dat->nama?></p>
    			<small><?php echo 'Total Harga : ' . $dat->total_harga?></small>
  			</a>
			<?php endforeach;?>
			</div>
		</div>
	</body>
</html>
