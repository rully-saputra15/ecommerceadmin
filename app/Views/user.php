<!doctype html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>asset/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<script src="https://code.jquery.com/jquery-3.5.0.js" integrity="sha256-r/AaFHrszJtwpe+tHyNi/XCfMxYpbsRg2Uqn0x3s2zc="crossorigin="anonymous"></script>
		<script type="text/javascript">
		var stat;
			function confirmation(id) {
				var url = <?php echo json_encode(base_url() . 'public/dashboard/gantiStatusUser?')?>;
				var answer = confirm("Anda yakin mengganti status dari user?");
				if(answer == true){
					$.ajax({
						type:"POST",
						url:url,
						data: {id : id,status : stat},
						success: function(res){
							alert('Success');
						}
					}).fail(function(){
						alert( "Gagal!" );
					});
					//window.location = url +"id=" + id + '&' + 'status=' + stat;
				}else{

				}
			}
			function status(val){
				stat = val;
			}
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
		  <br>
		<div class="container">
			<table class="table table-bordered">
				<thead>
					<tr>
					<th scope="col">ID</th>
					<th scope="col">Nama</th>
      				<th scope="col">Alamat</th>
      				<th scope="col">No Handphone</th>
     				<th scope="col">Status</th>
					 <th scope="col">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($data as $tmp): ?>
					<!--<form action="<?php echo base_url() . 'public/dashboard/gantiStatusUser' . '?id=' . $tmp->ID?>" method="post">-->
					<tr>
						<td><?php echo 'U-'. $tmp->ID?></td>
						<td><?php echo $tmp->nama?></td>
						<td><?php echo $tmp->alamat?></td>
						<td><?php echo $tmp->no_handphone?></td>
						<td><select id="status" name='status' class="custom-select" onchange="status(this.value);"><?php if($tmp->status == 0){
									echo '<option value="0"selected>' .'Bronze' . '</option>';
									echo '<option value="1">' .'Silver' . '</option>';
									echo '<option value="2">' .'Gold' . '</option>';
								  }else if($tmp->status == 1){
									echo '<option value="0">' .'Bronze' . '</option>';
									echo '<option value="1" selected>' .'Silver' . '</option>';
									echo '<option value="2">' .'Gold' . '</option>';
								  }else{
									echo '<option value="0">' .'Bronze' . '</option>';
									echo '<option value="1">' .'Silver' . '</option>';
									echo '<option value="2" selected>' .'Gold' . '</option>';
								  } ?></select>
						</td>
						<td><input type="submit" onclick="confirmation(<?php echo $tmp->ID?>)"class="btn btn-primary p-8"value="Ganti"></td>
					</tr>
					<!--</form>-->
					<?php endforeach;?>
				</tbody>
			</table>
		</div>

	</body>
</html>
