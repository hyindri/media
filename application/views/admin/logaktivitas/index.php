@extends("base.main_base")
@section('content')
@section('title','Log Aktivitas Akun')

<div class="container-fluid">
	<!-- Breadcrumb  -->
	<div class="block-header">
		<ol class="breadcrumb">
			<li>HOME</li>
			<li>SETTING</li>
			<li class="active">LOG AKTIVITAS AKUN</li>
		</ol>
	</div>
	<!-- end breadcrumb -->

	<!-- Table -->
	<div class="row clearfix">
		<div class="col-xs-12 col-md-12 col-sm-12 col-lg-12 ">
			<div class="card">
				<div class="header">
					<h2>
						Log Aktivitas Akun
					</h2>
					<!-- <ul class="header-dropdown m-r--5">
						<li class="dropdown">
							<a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
								aria-expanded="false">
								<i class="material-icons">more_vert</i>
							</a>
							<ul class="dropdown-menu pull-right">
								<li><a data-toggle="modal" data-target="#modal-filter">Filter</a></li>
								<li><a id="btn-reset">Reset</a></li>
							</ul>
						</li>
					</ul> -->
				</div>
				<div class="body">
					<div class="table-responsive">
						<table id="data-log" class="table table-bordered table-striped table-hover display nowrap">
							<thead>
								<tr>
									<th style="width:10px;">No</th>
									<th>Username</th>
									<th>Aktivitas</th>
									<th>Waktu</th>
								</tr>
							</thead>
							<tbody>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection

@section('js')
<script type="text/javascript">
	$(document).ready(function () {

		let table = $('#data-log').DataTable({
			"processing": true,
			"responsive": true,
			"serverSide": true,
			"searching": false,
			"info": true,
			"ordering": true,
			"order": [],
			"language": {
				"lengthMenu": "Tampilkan _MENU_ data per halaman",
				"infoEmpty": "Data dimana kamu",
				"zeroRecords": "Data tidak ada",
				"info": "Menampilkan halaman _PAGE_ dari _PAGES_",
				"infoFiltered": "(difilter dari _MAX_ total data)",
				"paginate": {
					"first": "Pertama",
					"last": "Terakhir",
					"next": "Selanjutnya",
					"previous": "Sebelumnya"
				},
			},
			"ajax": {
				url: "{{base_url('logaktivitas/json')}}",
				type: "POST"
			},
			"columnDefs": [{
				'targets': [0, 2],
				'orderable': false,
			}, {
				'targets': [3],
				'className': 'text-center'
			}],
			"pageLength": 10,
		});
	});

</script>
@endsection
