@extends('base.main_base')
@section('content')
@section('title','Dashboard')
<div class="container-fluid">
    <div class="block-header">
        <h2>DASHBOARD</h2>
    </div>
    <!-- Widgets -->
    <div class="row clearfix">
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
			@if($this->session->userdata('status')=='aktif')
            <div class="info-box bg-green hover-expand-effect">
			@else
			<div class="info-box bg-red hover-expand-effect">
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
			@if($status_berita == 1)
            <div class="info-box bg-cyan hover-expand-effect">
			@else
			<div class="info-box bg-red hover-expand-effect">
			@endif
                <div class="icon">

					@if($status_berita == 1)
					<i class="material-icons">verified_user</i>
					@else
					<i class="material-icons">error</i>
					@endif
                </div>
                <div class="content">
                    <div class="text">BERITA HARI INI</div>
					@if($status_berita == 1)
					<div >SUDAH UPLOAD</div>
					@else
					<div >BELUM UPLOAD</div>
					@endif
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-light-green hover-expand-effect">
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
            <div class="info-box bg-orange hover-expand-effect">
                <div class="icon">
                    <i class="material-icons">trending_up</i>
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
					<canvas id="bar_chart" height="150"></canvas>
					<?php
					//Inisialisasi nilai variabel awal
					$tanggal= "";
					$berita=null;
					foreach ($hasil as $item)
					{
						$tgl=$item->dibuat_tanggal;
						$tanggal .= "'$tgl'". ", ";
						$jum=$item->berita;
						$berita .= "$jum". ", ";
					}
					?>
				</div>
			</div>
		</div>
	</div>
    <!-- #END# CPU Usage -->


</div>
@endsection

@section('js')
<script>

	$(document).ready(function () {
		$('.count-to').countTo();

		//Sales count to
		$('.sales-count-to').countTo({
			formatter: function (value, options) {
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
					label:'Data Upload Berita Harian ',
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
							beginAtZero:true
						}
					}]
				}
			}
		});
	});


</script>
@endsection
