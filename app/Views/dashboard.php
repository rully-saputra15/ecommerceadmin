<!doctype html>
<html>
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
		<script type="text/javascript">
			$(document).ready(function() {
			    $('#data').DataTable({
					lengthMenu: [10, 20, 50, 100, 200, 500],
				});
				/*var hargaPokok = document.getElementById('hargaPokok');
				var hargaLevel1 = document.getElementById('hargaLevel1');
				var hargaLevel2 = document.getElementById('hargaLevel2');
				hargaPokok.addEventListener('keyup', function(e){
					// tambahkan 'Rp.' pada saat form di ketik
					// gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
					hargaPokok.value = formatRupiah(this.value, 'Rp. ');
				});
				hargaLevel1.addEventListener('keyup', function(e){
					// tambahkan 'Rp.' pada saat form di ketik
					// gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
					hargaLevel1.value = formatRupiah(this.value, 'Rp. ');
				});
				hargaLevel2.addEventListener('keyup', function(e){
					// tambahkan 'Rp.' pada saat form di ketik
					// gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
					hargaLevel2.value = formatRupiah(this.value, 'Rp. ');
				});
				function formatRupiah(angka, prefix){
					var number_string = angka.replace(/[^,\d]/g, '').toString(),
					split   		= number_string.split(','),
					sisa     		= split[0].length % 3,
					rupiah     		= split[0].substr(0, sisa),
					ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);

					// tambahkan titik jika yang di input sudah menjadi angka ribuan
					if(ribuan){
						separator = sisa ? '.' : '';
						rupiah += separator + ribuan.join('.');
					}

					rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
					return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
				}*/

				$("#addItem").submit(function(event){
					submitForm();
					return false;
				});

			});
			function submitForm(){
				var url = <?php echo json_encode(base_url() . 'public/dashboard/addItem?')?>;
				$.ajax({
					type: "POST",
					url: url,
					cache: false,
					data: $('form#addItem').serialize(),
					success: function(response){
						$("#addModal").modal('hide');
						alert("Success!");
					},
					error: function(){
						$("#addModal").modal('hide');
						alert("Error!");
					}
				});
				}
			/*$('#addModal').on('show.bs.modal', function (event) {
			var button = $(event.relatedTarget) // Button that triggered the modal
			var recipient = button.data('whatever') // Extract info from data-* attributes
			// If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
			// Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
			var modal = $(this)
			modal.find('.modal-title').text('New message to ' + recipient)
			modal.find('.modal-body input').val(recipient)
			});*/
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
        				<a class="nav-link" href="<?php echo base_url(). 'public/dashboard/user'?>">Users</a>
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
		  		<form class="form-horizontal" method="post" action="<?php echo base_url(). 'public/dashboard/upload' ?>" name="uploadCSV" enctype="multipart/form-data">
				  <label><b>Upload file excel untuk mengubah data</b></label>
			  		<input type="file" name="file" id="file" accept=".xlsx">
			  		<button class="btn btn-primary" id="submit" name="import">Import</button>
				</form>
				</div>
				<div class="col">
					<label><b>Untuk menambah barang baru</b></label><br>
					<button class="btn btn-primary" data-toggle="modal" data-target="#addModal" data-whatever="@add">Add Item</button>
				</div>
		  </div>
		  </div>
		  <br>
		  <div class="container">
		  	<table id="data" class="table table-striped table-bordered" style="width:100%">
				<thead>
					<tr>
						<th scope="col">No</th>
						<th scope="col">ID Barang</th>
						<th scope="col">Nama Barang</th>
						<th scope="col">Jumlah Barang</th>
						<th scope="col">Harga Pokok</th>
						<th scope="col">Harga Level 1</th>
						<th scope="col">Harga Level 2</th>
					</tr>
				</thead>
				<tbody>
				<?php $i=1;$class=null; setlocale (LC_TIME, 'id_ID');?>
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
						<td><?= 'Rp. ' . number_format($item->harga_pokok)?></td>
						<td><?= 'Rp. ' . number_format($item->harga_level_1)?></td>
						<td><?= 'Rp. ' . number_format($item->harga_level_2)?></td>
					</tr>
					<?php endforeach;?>
				</tbody>
				<tfoot>
				</tfoot>
			</table>
		  </div>
				<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModal" aria-hidden="true" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Add Item</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form id="addItem" name="addItem" role="form">
			<div class="modal-body">

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
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<input type="submit" class="btn btn-primary" id="submit">
			</div>
			</form>
			</div>
		</div>
		</div>
	</body>
</html>
