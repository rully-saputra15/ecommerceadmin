<!doctype html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>asset/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>asset/css/dashboard.css">
		<script src="https://code.jquery.com/jquery-3.4.1.min.js"integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="crossorigin="anonymous"></script>

		<script src="<?php echo base_url(); ?>asset/js/bootstrap.js"></script>
		<script>
			$('#addModal').on('show.bs.modal', function (event) {
			var button = $(event.relatedTarget) // Button that triggered the modal
			var recipient = button.data('whatever') // Extract info from data-* attributes
			// If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
			// Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
			var modal = $(this)
			modal.find('.modal-title').text('New message to ' + recipient)
			modal.find('.modal-body input').val(recipient)
			});
		</script>
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
        				<a class="nav-link" href="<?php echo base_url() . 'public/dashboard/insight'?>">Insight <span class="sr-only">(current)</span></a>
      				</li>
					<li class="nav-item">
						<a class="nav-link" href="<?php echo base_url(). 'public/dashboard/transaksi'?>">Transaksi</span></a>
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
		  <div class="row">
				<div class="col">
		  		<form class="form-horizontal" method="post" action="upload" name="uploadCSV" enctype="multipart/form-data">
				  <label><b>Upload file excel untuk mengubah data</b></label>
			  		<input type="file" name="file" id="file" accept=".xlsx">
			  		<button class="btn btn-primary" id="submit" name="import">Import</button>
				</form>
				</div>
				<div class="col">
					<label><b>Untuk menambah barang baru</b></label><br>
					<button class="btn btn-primary" data-toggle="modal" data-target="#addModal" data-whatever="@add">Add Barang</button>
				</div>
		  </div>
		  </div>
					<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Add Barang</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form action="addBarang" method="post">
					<div class="form-group">
						<label for="nama-barang" class="col-form-label">Nama Barang : </label>
						<input type="text" class="form-control" id="nama-barang" name="nama-barang">
					</div>
					<div class="form-group">
						<label for="message-text" class="col-form-label">Foto Barang:</label>
						<input type="file" class="form-control" id="foto-barang" name="foto-barang" accept="image/*"></input>
					</div>
					<div class="form-group">
						<label for="recipient-name" class="col-form-label">Harga :</label>
						<input type="text" class="form-control" id="harga" name="harga">
					</div>
					<div class="form-group">
						<label for="message-text" class="col-form-label">Stok:</label>
						<input type="text" class="form-control" id="stok" name="stok">
					</div>
					<div class="form-group">
						<label for="message-text" class="col-form-label">Kondisi :</label>
						<input type="text" class="form-control" id="kondisi" name="kondisi">
					</div>
					<div class="form-group">
						<label for="message-text" class="col-form-label">Deskripsi:</label>
						<textarea class="form-control" id="deskripsi" name="deskripsi"></textarea>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						<button type="button" class="btn btn-primary" id="submit" name="submit">Submit</button>
					</div>
				</form>
				</div>

				</div>
			</div>
			</div>
		  <div class="container-sm table-responsive mt-4">
		  	<table class="table table-sm table-striped">
				<thead>
					<tr>
						<th scope="col">No</th>
						<th scope="col">ID Barang</th>
						<th scope="col">Nama Barang</th>
						<th scope="col">Jumlah Barang</th>
						<th scope="col">Tindakan</th>
					</tr>
				</thead>
				<tbody>
				<?php $i=1;$class=null; ?>
				<?php foreach ($row as $item):?>
					<?php if($item->stok_barang >= 25) {
							$class= 'table-primary';
						}else if($item->stok_barang > 10 and $item->stok_barang < 25){
							$class='table-warning';
						}else{
							$class='table-danger';
						}
					?>
					<tr class='<?php echo $class?>'>
						<th scope="row"><?=$i?></th>
						<td><?php echo 'B-' . $item->ID?></td>
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
