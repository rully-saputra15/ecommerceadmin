<!doctype html>
<html>
	<head>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.js"></script>
		<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
		<script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>asset/css/bootstrap.min.css">
		<script>
			$(document).ready(function() {
				//$("#tanggal").datepicker();
				$('#check').click(function(){
					var tanggal = $("#tanggal").val();
					var date = new Date(tanggal);
					var month = date.getMonth()+1;
					var year = date.getFullYear();
					var url = <?php echo json_encode(base_url().'public/dashboard/showReportData?')?>;
					$.ajax({
						type: "POST",
						url: url,
						data:{"month":month,"year":year},
						success:function(data){
							$('#data').html(data);
						},
						error:function(xhr, status, error){
							console.log(xhr.responseText);
							console.log(error);
							console.log(status);
						}
					})
				});
			});
			/*var ctx = document.getElementById('canvas').getContext('2d');
			var chart = new Chart(ctx, {
				type:'line',
				data:{
					labels:[<?php
						/*foreach($data as $tmp){
							echo "'" . $tmp->Bulan ."',";
						}*/
						?>
					],
					datasets:[{
						label:'Jumlah barang yang terjual',
                		borderColor : "rgba(33, 72, 192, 0.88)",
                		pointBorderColor : "rgba(33, 72, 192, 1)",
						borderWidth:"4",
						pointRotation:"2",
						fill:'false',
						data:[<?php
							/*foreach($data as $tmp){
								echo $tmp->Jumlah .",";
							}*/
							?>
						]
					}]
				}

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
	<div style="margin-top:16px;"class="container">
	<?php setlocale (LC_TIME, 'id_ID');?>
		<h1 style="text-align:center;">Report Penjualan</h1>
		<div style="margin-top:32px;"class="row">
			<div class="col">
				<input type="month" class="form-control" id="tanggal" name="tanggal" min="2020-01" value="2020-08">
			</div>
			<div class="col">
				<div class="text-center">
					<button type="button" id="check" name="check" class="btn btn-primary">Check</button>
				</div>
			</div>
		</div>
		<div id="data">

		</div>
	</div>

	<!--<div class="chart-container" style="position: relative; height:40vh; width:80vw">
    	<canvas id="canvas"></canvas>
	</div>-->

	</body>
</html>
