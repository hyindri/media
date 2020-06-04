@extends("base.main_base")
@section("content")
@section("title", "Dashboard")

<div class="container-fluid">
	<!-- Breadcrumb  -->
	<div class="block-header">
		<ol class="breadcrumb">
			<li>HOME</li>
			<li class="active">DASHBOARD</li>
		</ol>
	</div>
	<!-- end breadcrumb -->

	<!-- widget -->
	<div class="row clearfix">
		<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
			<div class="info-box bg-deep-purple hover-zoom-effect">
				<div class="icon">
					<i class="material-icons">airplay</i>
				</div>
				<div class="content">
					<div class="text">MEDIA MASSA</div>
					<div class="number count-to" data-from="0" data-to="{{$medmas->total}}" data-speed="15" data-fresh-interval="20"></div>
				</div>
			</div>
		</div>
		<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
			<div class="info-box bg-indigo hover-zoom-effect">
				<div class="icon">
					<i class="material-icons">fiber_new</i>
				</div>
				<div class="content">
					<div class="text">BERITA HARI INI</div>
					<div class="number count-to" data-from="0" data-to="{{$berita_hariini->total}}" data-speed="1000" data-fresh-interval="20"></div>
				</div>
			</div>
		</div>
		<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
			<div class="info-box bg-blue hover-zoom-effect">
				<div class="icon">
					<i class="material-icons">trending_up</i>
				</div>
				<div class="content">
					<div class="text">BERITA MINGGU INI</div>
					<div class="number count-to" data-from="0" data-to="{{$berita_mingguini->total}}" data-speed="1000" data-fresh-interval="20"></div>
				</div>
			</div>
		</div>
		<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
			<div class="info-box bg-light-blue hover-zoom-effect">
				<div class="icon">
					<i class="material-icons">assessment</i>
				</div>
				<div class="content">
					<div class="text">BERITA BULAN INI</div>
					<div class="number count-to" data-from="0" data-to="{{$berita_bulanini->total}}" data-speed="1000" data-fresh-interval="20"></div>
				</div>
			</div>
		</div>
	</div>
	<!-- End Widget -->
	<!-- Chart -->
	<div class="row clearfix">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<div class="card">
				<div class="header">
					<div class="row clearfix">
						<div class="col-xs-12 col-sm-6">
							<h2>BERITA</h2>
						</div>
					</div>
				</div>
				<div class="body">
					<canvas id="bar_chart" height="150"></canvas>
					<?php
					//Inisialisasi nilai variabel awal
					$tanggal = "";
					$berita = null;
					foreach ($hasil as $item) {
						$tgl = $item->dibuat_tanggal;
						$tanggal .= "'$tgl'" . ", ";
						$jum = $item->berita;
						$berita .= "$jum" . ", ";
					}
					?>
				</div>
			</div>
		</div>
	</div>
	<!-- End Chart  -->
</div>

@endsection

@section("js")
<script>
	$(document).ready(function() {
		$('.count-to').countTo();

		//Sales count to
		$('.sales-count-to').countTo({
			formatter: function(value, options) {
				return '$' + value.toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, ' ').replace('.', ',');
			}
		});


		var ctx = document.getElementById('bar_chart').getContext('2d');
		var chart = new Chart(ctx, {
			// The type of chart we want to create
			type: 'bar',
			// The data for our dataset
			data: {
				labels: [<?php echo $tanggal; ?>],
				datasets: [{
					label: 'Data Upload Berita Harian ',
					backgroundColor: 'rgba(0, 188, 212, 0.8)',
					borderColor: ['rgb(255, 255, 255)'],
					data: [<?php echo $berita; ?>]
				}]
			},
			// Configuration options go here
			options: {
				scales: {
					yAxes: [{
						ticks: {
							beginAtZero: true
						}
					}]
				}
			}
		});

	});
</script>
@endsection