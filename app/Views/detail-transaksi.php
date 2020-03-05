<!doctype html>
	<head>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>asset/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

	</head>
	<body>
		<div class="container border">
		<div class="row justify-content-center my-8">
    		<h1>Receipt</h1>
  		</div>
		<?php
		setlocale (LC_TIME, 'id_ID');
		foreach($data as $row):
		?>
		<p>Order ID :<b> <?php echo $row->ID?></b></p>
		<p>Nama Pembeli : <b><?php echo $row->nama_pembeli?></b></p>
		<table class="table table-dark">

				<thead>
    				<tr>
      					<th scope="col">Produk</th>
      					<th scope="col">Kuantitas</th>
      					<th scope="col">Harga</th>
    				</tr>
  				</thead>
				  <tbody>
				  	<tr>
						<td><b><?php echo $row->nama_barang?></b></td>
						<td><b><?php echo $row->jumlah_beli?></b></td>
						<td><b><?php echo 'IDR '.number_format($row->total_harga)?></b></td>
					</tr>
					<tr>
						<td colspan="2">Alamat</td>
						<td><b><?php echo $row->alamat?></b></td>
					</tr>
					<tr>
						<td colspan="2">Pengiriman</td>
						<td><b>JNE</b></td>
					</tr>
					<tr>
						<td colspan="2">Jenis Pembayaran</td>
						<td><b><?php echo $row->pembayaran?></b></td>
					</tr>
					<tr>
						<td colspan="2">Status</td>
						<td><b>LUNAS</b></td>
					</tr>
				  </tbody>
			<?php endforeach;?>
			</table>
		</div>
	</body>
</html>
