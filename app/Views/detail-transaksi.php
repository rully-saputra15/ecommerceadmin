<!doctype html>
	<head>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>asset/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>asset/css/detail-transaksi.css">
	</head>
	<body>
		<div class="container border">
		<div class="row justify-content-center my-8">
    		<h1>Receipt</h1>
  		</div>
		<?php
		setlocale (LC_TIME, 'id_ID');$id;$nama;$jenis_pembayaran;$alamat;$status;$total_harga;
		foreach($data as $row){
			$id = $row->id;
			$nama = $row->nama;
			$jenis_pembayaran = $row->jenis_pembayaran;
			$alamat = $row->alamat;
			$status = $row->status;
			$total_harga = $row->total_harga;
			break;
		}
		?>
		<p>Order ID :<b> <?php echo 'T'. $id?></b></p>
		<p>Nama Pembeli : <b><?php echo $nama?></b></p>
		<table class="table table-dark">

				<thead>
    				<tr>
      					<th scope="col">Produk</th>
      					<th scope="col">Kuantitas</th>
						<th scope="col">Satuan</th>
      					<th scope="col">Harga</th>
						<th scope="col">Total Harga</th>
    				</tr>
  				</thead>
				  <tbody>
				  <?php foreach($data as $row):?>
				  	<tr>
						<td><b><?php echo $row->nama_barang?></b></td>
						<td><b><?php echo $row->jumlah_beli?></b></td>
						<td><b><?php echo $row->satuan?></b></td>
						<td><b><?php echo 'IDR '.number_format($row->harga)?></b></td>
						<td><b><?php echo 'IDR '.number_format($row->jumlah_beli * $row->harga)?></b></td>
					</tr>
				<?php endforeach;?>
					<tr>
						<td colspan="4">Alamat</td>
						<td><b><?php echo $alamat?></b></td>
					</tr>
					<tr>
						<td colspan="4">Jenis Pembayaran</td>
						<td><b><?php echo $jenis_pembayaran?></b></td>
					</tr>
					<tr>
						<td colspan="4">Status</td>
						<td><b><?php if($status == 0){
							echo 'BELUM SELESAI';
						}else{
							echo 'SELESAI';
						}
						?></b></td>
					</tr>
					<tr>
						<td colspan="4">Grand Total</td>
						<td><b><?php echo 'IDR '.number_format($total_harga)?></b></td>
					</tr>
				  </tbody>

			</table>
			<div class="form-group">
			<button class="btn btn-primary">
			<a href="<?php echo base_url() . 'public/dashboard/transaksi'?>">BACK
			</button>
			</a>
			<button class="btn btn-success"><a href="<?php echo base_url() . 'public/dashboard/changeStatus/' . $id ?>">CHECKOUT</a></button>
			</div>
		</div>

	</body>
</html>
