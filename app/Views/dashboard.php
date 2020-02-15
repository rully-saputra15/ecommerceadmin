<!doctype html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>asset/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>asset/css/dashboard.css">

	</head>
	<body>
		<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
			<a class="navbar-brand" href="#">Navbar</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    			<span class="navbar-toggler-icon"></span>
  			</button>
		<div class="collapse navbar-collapse" id="navbarNav">
    		<ul class="navbar-nav ml-auto">
      				<li class="nav-item active">
        				<a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
      				</li>
					<li class="dropdown">
					<button class="dropbtn">
					  <i class="fa fa-bell" style="font-size:20px;" aria-hidden="true"></i>
      				</button>
					  <div class="dropdown-content">
						<?php foreach ($notif as $item) :?>
						<a href="<?php echo $baseURL?>notif/<?php echo $item->ID?>"><?='<b>' .$item->nama .'</b>'. ' membeli '.'<b>' .$item->jumlah_beli .'</b>'. ' ' .'<b>'. $item->nama_barang .'</b>'?></a>
						<?php endforeach;?>
						<a href="<?php echo $baseURL?>seeMoreTransaksi">See More</a>
					  </div>
					</li>
      				<li class="nav-item">
        				<a class="nav-link" href="#">Users</a>
      				</li>
    		</ul>
  		</div>
		  </nav>
		  <div class="container-sm mt-4">
		  	<div class="row">
				<div class="col">
				<div class="card bg-light mb-3" style="max-width: 18rem;">
 					 <div class="card-header">Total Users</div>
  						<div class="card-body">
    					<h5 class="card-title">Users</h5>
    					<p class="card-text">Users mencapai <b>200</b></p>
 					 </div>
				</div>
				</div>
				<div class="col">
				<div class="card bg-light mb-3" style="max-width: 18rem;">
 					 <div class="card-header">Total Penjualan</div>
  						<div class="card-body">
    					<h5 class="card-title">Penjualan</h5>
    					<p class="card-text">Penjualan mencapai <b><?php echo $jumlah_barang_terjual ?></b></p>
 					 </div>
				</div>
				</div>
				<div class="col">
				<div class="card bg-light mb-3" style="max-width: 18rem;">
 					 <div class="card-header">Penjualan</div>
  						<div class="card-body">
    					<h5 class="card-title">Bulanan</h5>
    					<p class="card-text">Penjualan mencapai <b>250</b></p>
 					 </div>
				</div>
				</div>
			</div>
		  </div>
		  <div class="container">
		  	<form class="form-horizontal" method="post" action="<?php echo $baseURL?>dashboard/upload" name="uploadCSV" enctype="multipart/form-data">
			  <input type="file" name="file" id="file" accept=".xlsx">
			  <button class="btn btn-primary" id="submit" name="import">Import</button>
			</form>
		  </div>
		  <div class="container-sm table-responsive mt-4">
		  	<table class="table table-sm table-striped">
				<thead>
					<tr>
						<th scope="col">No</th>
						<th scope="col">ID Barang</th>
						<th scope="col">Nama Barang</th>
						<th scope="col">Jumlah Barang Terjual</th>
						<th scope="col">Tindakan</th>
					</tr>
				</thead>
				<tbody>
				<?php $i=1 ?>
				<?php foreach ($row as $item):?>
					<tr>
						<th scope="row"><?=$i?></th>
						<td><?= $item->ID?></td>
						<td><?= $item->nama_barang?></td>
						<td><?= $item->stok_barang; $i++?></td>
						<td><button class="btn-primary">Edit</button></td>
					</tr>
					<?php endforeach;?>
				</tbody>
			</table>
		  </div>

	</body>
</html>
