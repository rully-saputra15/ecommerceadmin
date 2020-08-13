<!doctype html>
<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
		<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>asset/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>asset/css/dashboard.css">
		<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
		<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>

		<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>

		<script src="<?php echo base_url(); ?>asset/js/bootstrap.js"></script>
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
        				<a class="nav-link" href="<?php echo base_url(). 'public/dashboard/user'?>">Users</a>
      				</li>
    		</ul>
  		</div>
		  </nav>
		  <div class="container mt-4">

		  <form id="addItem" name="addItem" method="post" action="<?php echo base_url(). 'public/dashboard/addItem' ?>"role="form">

				<div class="form-group">
					<label for="kodeItem" class="col-form-label">Kode Item:</label>
					<input type="text" class="form-control" name="kodeItem" id="kodeItem">
				</div>
				<div class="form-group">
					<label for="merk" class="col-form-label">Merk :</label>
					<select class="custom-select" id="merk" name="merk">
						<option value="- A -">- A -</option>
						<option value="CRUN">CRUN</option>
						<option value="CKD">CKD</option>
						<option value="KOMACHI">KOMACHI</option>
						<option value="YASUHO">YASUHO</option>
					</select>

				</div>
				<div class="form-group">
					<label for="namaItem" class="col-form-label">Nama Item:</label>
					<input type="text" class="form-control" name="namaItem" id="namaItem">
				</div>
				<div class="form-group">
					<label for="stok" class="col-form-label">Stok:</label>
					<input type="number" class="form-control" name="stok" id="stok" required>
				</div>
				<div class="form-group">
					<label for="hargaPokok" class="col-form-label">Harga pokok:</label>
					<input type="number" class="form-control" name="hargaPokok" id="hargaPokok" required>
				</div>
				<div class="form-group">
					<label for="hargaLevel1" class="col-form-label">Harga Level 1:</label>
					<input type="number" class="form-control" name="hargaLevel1" id="hargaLevel1" required>
				</div>
				<div class="form-group">
					<label for="hargaLevel2" class="col-form-label">Harga Level 2:</label>
					<input type="number" class="form-control" name="hargaLevel2" id="hargaLevel2" required>
				</div>
				<div class="form-group">
					<label for="satuan" class="col-form-label">Satuan :</label>
					<select class="custom-select" id="satuan" name="satuan">
						<option value="SET">SET</option>
						<option value="PCS">PCS</option>
					</select>
				</div>
			</div>
			<div class="modal-footer">
				<button class="btn btn-primary" id="submit">Submit</button>
			</div>
			</form>
</body>
