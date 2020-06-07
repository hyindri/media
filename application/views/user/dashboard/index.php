@extends('base.main_base')
@section('content')
@section('title','Dashboard')
<div class="container-fluid">
	<!-- Breadcrumb  -->
	<div class="block-header">
		<ol class="breadcrumb">
			<li>HOME</li>
			<li class="active">DASHBOARD</li>
		</ol>
	</div>
	<!-- end breadcrumb -->

	<!-- Widgets -->
	<div class="row clearfix">
		<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
			@if($this->session->userdata('status')=='aktif')
			<div class="info-box bg-green hover-zoom-effect">
				@else
				<div class="info-box bg-red hover-zoom-effect">
					@endif
					<div class="icon">
						@if($this->session->userdata('status')=='aktif')
						<i class="material-icons">verified_user</i>
						@else
						<i class="material-icons">error</i>
						@endif
					</div>
					<div class="content">
						<div class="text">STATUS MEDIA</div>
						@if($this->session->userdata('status')=='aktif')
						<div class="">AKTIF</div>
						@else
						<div class="">BELUM AKTIF</div>
						@endif
					</div>
				</div>
			</div>
			<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
				@if($status_berita > 1)
				<div class="info-box bg-blue hover-zoom-effect">
					@else
					<div class="info-box bg-red hover-zoom-effect">
						@endif
						<div class="icon">

							@if($status_berita > 1)
							<i class="material-icons">verified_user</i>
							@else
							<i class="material-icons">error</i>
							@endif
						</div>
						<div class="content">
							<div class="text">BERITA HARI INI</div>
							@if($status_berita > 1)
							<div>SUDAH LAPOR</div>
							@else
							<div>BELUM LAPOR</div>
							@endif
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
			<!-- #END# Widgets -->
			<!-- CPU Usage -->
			<div class="row clearfix">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class="card">
						<div class="header">
							<div class="row clearfix">
								<div class="col-xs-12 col-sm-6">
									<h2>BERITA</h2>
								</div>
							</div>
							<ul class="header-dropdown m-r--5">
								<li class="dropdown">
									<a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
										<i class="material-icons">more_vert</i>
									</a>
									<ul class="dropdown-menu pull-right">
										<li><a href="javascript:void(0);">Action</a></li>
										<li><a href="javascript:void(0);">Another action</a></li>
										<li><a href="javascript:void(0);">Something else here</a></li>
									</ul>
								</li>
							</ul>
						</div>
						<div class="body">
							<canvas id="grafik_harian" height="150"></canvas>
						</div>
					</div>
				</div>
			</div>
			<!-- #END# CPU Usage -->


		</div>
		@endsection

		@section('js')
		<script>
			$(document).ready(function() {
				$.ajax({
					type: "GET",
					url: "{{base_url('Dashboard/get_status_akun')}}",
					dataType: "JSON",
					success: function(data) {
						if (data.status == 'registrasi'){
							toastr.error('Mohon lengkapi data profil anda terlebih dahulu, lalu hubungi admin', 'Status belum aktif');
						}else if(data.status == 'suspend'){
							toastr.error('Akun anda telah disuspend, mohon hubungi bagian bersangkutan', 'Peringatan');
						}
					}
				});

				$('.count-to').countTo();

				//Sales count to
				$('.sales-count-to').countTo({
					formatter: function(value, options) {
						return '$' + value.toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, ' ').replace('.', ',');
					}
				});

				ajax_harian();

				function ajax_harian() {

					$.ajax({
						type: "POST",
						url: "{{site_url('Dashboard/get_chart_harian')}}",
						success: function(data) {
							var obj = jQuery.parseJSON(data);
							grafik_harian(obj);
						}
					});
				}

				function grafik_harian(obj) {

					let labelse = [];
					let dataset = [];

					$.each(obj, function(key, value) {
						labelse = [];
						$.each(value, function(kunci, data) {
							labelse.push(data.dibuat_tanggal);
							dataset.push(data.berita);
						});
					})


					let ctx = document.getElementById('grafik_harian').getContext('2d');
					let chart = new Chart(ctx, {
						type: 'bar',
						data: {
							labels: labelse,
							datasets: [{
								label: 'Data Laporan Berita Harian ',
								backgroundColor: 'rgba(0, 188, 212, 0.8)',
								borderColor: ['rgb(255, 255, 255)'],
								data: dataset
							}]
						},
						options: {
							scales: {
								yAxes: [{
									ticks: {
										beginAtZero: true
									}
								}]
							}
						}
					})
				}



			});
		</script>
		@endsection