<!doctype html>
<html>
	<head>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.js"></script>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>asset/css/bootstrap.min.css">
	</head>
	<body>
	<h1>Data penjualan tahun 2020</h1>
	<div class="chart-container" style="position: relative; height:40vh; width:80vw">
    	<canvas id="canvas"></canvas>
	</div>
		    <script>
			var ctx = document.getElementById('canvas').getContext('2d');
			var chart = new Chart(ctx, {
				type:'line',
				data:{
					labels:[<?php
						foreach($data as $tmp){
							echo "'" . $tmp->Bulan ."',";
						}
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
							foreach($data as $tmp){
								echo $tmp->Jumlah .",";
							}
							?>
						]
					}]
				}

			});
         </script>
	</body>
</html>
