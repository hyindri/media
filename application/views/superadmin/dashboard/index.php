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
							<h2>Laporan Berita</h2>
						</div>
					</div>
				</div>
				<div class="body">
					<canvas id="grafik_harian" height="100"></canvas>
				</div>
				<div class="body text-center">
					<a id="down"
							download="ChartImage.jpg" 
							href=""
							class="btn btn-primary"
							title="Grafik">
							<!-- Download Icon -->
					Download Grafik
					</a>
				</div>
			</div>
		</div>
	</div>

	<div class="row clearfix">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<div class="card">
				<div class="header">
					<div class="row clearfix">
						<div class="col-xs-9 col-sm-9">
							<h2>GRAFIK BERITA MEDIA</h2>
						</div>
						<div class="col-xs-3 col-sm-3">
							<select class="form-control" id="tipe_grafik" name="tipe_grafik">
								<option value="">-- PILIH TIPE GRAFIK --</option>
								<option value="1">Harian</option>
								<option value="2">Bulanan</option>
								<option value="3">Tahunan</option>
							</select>
						</div>
					</div>
				</div>
				<div class="body">
					<canvas id="grafik_media" height="100"></canvas>
				</div>
				<div class="body text-center">
					<a id="download"
							download="ChartImage.jpg" 
							href=""
							class="btn btn-primary"
							title="Grafik">

							<!-- Download Icon -->
					Download Grafik
					</a>
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


		ajax_harian();
		ajax_media();
		
		function ajax_harian() {

			$.ajax({
				type : "POST",
				url : "{{site_url('Dashboard/get_chart_harian')}}",
				success : function (data) {
					var obj = jQuery.parseJSON(data);
					grafik_harian(obj);
				}
			});
		}

		function ajax_media(type='') {

			$.ajax({
				type : "POST",
				url : "{{site_url('Dashboard/get_chart_media')}}",
				data : {type:type},
				success : function (data) {
					var obj = jQuery.parseJSON(data);
					grafik_media(obj);
				}
			});
		}
		
		function grafik_harian(obj) {

			let labels = [];
			let dataset = [];

			$.each(obj, function (key, value) {
				labels=[];
				$.each(value, function (kunci, data) {
					labels.push(data.dibuat_tanggal);
					dataset.push(data.berita);
				});
			})


			let ctx = document.getElementById('grafik_harian').getContext('2d');
			let chart = new Chart(ctx, {
				type: 'bar',
				data: {
					labels: labels
							,
					datasets: [{
						label: 'Data Upload Berita Harian ',
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

		var chart
		function grafik_media(obj) {
			let labels = [];
			let dataset = [];

			$.each(obj, function (key, value) {
				labels=[];
				$.each(value, function (kunci, data) {
					labels.push(data.nama);
					dataset.push(data.berita);
				});
			})

			let ctx = document.getElementById('grafik_media').getContext('2d');
			chart = new Chart(ctx, {
				type: 'bar',
				data: {
					labels: labels,
					datasets: [{
						label: 'Data Upload Berita Harian ',
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
			});
		}

		$('#tipe_grafik').change(function () {
			if ($(this).val()!='')
			{
				chart.destroy();
				ajax_media($(this).val());
			}else{
				ajax_media();
			}
		});


		document.getElementById("download").addEventListener('click', function(){
			/*Get image of canvas element*/
			var url_base64jp = document.getElementById("grafik_media").toDataURL("image/jpg");
			/*get download button (tag: <a></a>) */
			var a =  document.getElementById("download");
			/*insert chart image url to download button (tag: <a></a>) */
			a.href = url_base64jp;
		});

		document.getElementById("down").addEventListener('click', function(){
			/*Get image of canvas element*/
			var url_base64jp = document.getElementById("grafik_harian").toDataURL("image/jpg");
			/*get download button (tag: <a></a>) */
			var a =  document.getElementById("down");
			/*insert chart image url to download button (tag: <a></a>) */
			a.href = url_base64jp;
		});


	});
</script>
@endsection
