@extends('base.main_base')
@section('content')
@section('title','Profil')
<div class="container-fluid">
	<!-- Breadcrumb  -->
	<div class="block-header">
		<ol class="breadcrumb">
			<li>HOME</li>
			<li class="active">PROFIL MEDIA</li>
		</ol>
	</div>
	<!-- end breadcrumb -->
	<div class="row clearfix">
		<div class="col-xs-12 col-sm-3 col-lg-3">
			<div class="card profile-card">
				<div class="profile-header">&nbsp;</div>
				<div class="profile-body">
					@if($file_logo_media > 1)
					<div class="image-area">
						<img class="bg-white"
							src="<?= base_url('upload/media/'.$this->session->userdata('username').'/logo_media/'.$this->session->userdata('file_logo_media'));?>"
							alt="Gambar Profil" width="50%" />

					</div>
					@elseif($file_logo_media == NULL)
					<div class="image-area">
						<img class="bg-white" src="{{base_url('assets/images/person.svg')}}" alt="Gambar Profil"
							width="50%" />
					</div>
					@endif
					<div class="content-area">
						<h3>{{$nama}}</h3>
						{{$perusahaan}}
						<p>Status : {{$status}}</p>
					</div>
					<div class="profile-footer">
						<ul>
							<li>
								<span>Tipe Media Massa</span>
								<span>{{$tipe_mediamassa}}</span>
							</li>
							<li>
								<span>Tipe Publikasi</span>
								<span>{{$tipe_publikasi}}</span>
							</li>
						</ul>
					</div>
				</div>
			</div>
			<div class="card card-about-me">
				<div class="header bg-indigo">
					<h2>Kontak Media</h2>
				</div>
				<div class="body">
					<ul>
						<li>
							<div class="title">
								<i class="material-icons">location_on</i>
								Alamat Perusahaan
							</div>
							<div class="content">
								{{$alamat}}
							</div>
						</li>
						<li>
							<div class="title">
								<i class="material-icons">call</i>
								Nomor Telepon
							</div>
							<div class="content">
								{{$telp}}
							</div>
						</li>
						<li>
							<div class="title">
								<i class="material-icons">email</i>
								Email
							</div>
							<div class="content">
								{{$email}}
							</div>
						</li>
					</ul>
				</div>
			</div>
			<div class="card card-about-me">
				<div class="header bg-indigo">
					<h2>Sosial Media</h2>
				</div>
				<div class="body">
					<ul>
						<li>
							<div class="title">
								Facebook
							</div>
							<div class="content">
								<p><b> Username :</b> {{$username_fb}}</p>
								<b>Jumlah Pengikut : </b>{{$pengikut_fb}}
							</div>
						</li>
						<li>
							<div class="title">
								Instagram
							</div>
							<div class="content">
								<p><b> Username :</b> {{$username_ig}}</p>
								<b>Jumlah Pengikut : </b>{{$pengikut_ig}}
							</div>
						</li>
						<li>
							<div class="title">
								Twitter
							</div>
							<div class="content">
								<p><b> Username :</b> {{$username_twitter}}</p>
								<b>Jumlah Pengikut : </b>{{$pengikut_twitter}}
							</div>
						</li>
						<li>
							<div class="title">
								Youtube
							</div>
							<div class="content">
								<p><b> Channel :</b> <span class="w-break">{{$channel_yt}}</span></p>
								<b>Jumlah <i>Subscribers</i> : </b>{{$subs_yt}}
							</div>
						</li>
					</ul>
				</div>
			</div>
		</div>
		<div class="col-xs-12 col-sm-9 col-lg-9">
			<div class="card card-about-me">
				@if($this->session->userdata('level') == 'user')
				<div class="header">
					<a href="<?php echo site_url('profil/ubah/' . $this->session->userdata('id_user')); ?>"
						class="pull-right btn bg-indigo col-white">Ubah Informasi Profil</a>
					<h4 class="font-20">Informasi Akun Media</h4>
				</div>
				@endif
				<div class="body">
					{{$this->session->flashdata('notif')}}
					<ul>
						@if($this->session->userdata('level') == 'user')
						<li>
							<div class="title">
								<i class="material-icons">person</i>
								Username
							</div>
							<div class="content">
								{{$username}}
							</div>
						</li>
						<li>
							<div class="title">
								<i class="material-icons">vpn_key</i>
								Password
							</div>
							<div class="pull-right btn bg-indigo">
								<a class="col-white deco-off" href="{{site_url('profil/ubahpassword')}}">Ubah
									Password</a>
							</div>
							<div class="content">
								••••••••••••••
							</div>
						</li>
						@endif
						<br>
						<h4 class="font-20">Informasi Media Lainnya</h4>
						<hr>
						<li>
							<div class="title">
								<i class="material-icons">account_balance_wallet</i>
								Nomor Rekening
							</div>
							<div class="content">
								<b>No. Rekening : </b>{{$rekening}}
								<br>
								@if($file_rekening > 0 )
								<a href="{{site_url()}}upload/media/{{$username}}/rekening/{{$file_rekening}}"
									target="_blank" class="btn bg-indigo">Lihat File</a>
								@elseif($file_rekening == null AND $this->session->userdata('level') != 'admin')
								<small class="text-danger">File belum ada, silahkan upload file</small>
								@elseif($this->session->userdata('level') == 'admin' AND $file_rekening == null)
								<small class="text-danger">File Belum Diupload</small>
								@endif
							</div>
						</li>

						<li>
							<div class="title">
								<i class="material-icons">credit_card</i>
								NPWP
							</div>
							<div class="content">
								<b>No. NPWP : </b>{{$npwp}}
								<br>
								@if($file_npwp > 0)
								<a href="{{site_url()}}upload/media/{{$username}}/npwp/{{$file_npwp}}" target="_blank"
									class="btn bg-indigo">Lihat File</a>
								@elseif($file_npwp == 0 AND $this->session->userdata('level') != 'admin')
								<small class="text-danger">File belum ada, silahkan upload file</small>
								@elseif($this->session->userdata('level') == 'admin' AND $file_rekening == null)
								<small class="text-danger">File Belum Diupload</small>
								@endif
							</div>
						</li>
						<li>
							<div class="title">
								<i class="material-icons">calendar_today</i>
								Mulai MoU
							</div>
							<div class="content">
								{{$mulai_mou}}
							</div>
						</li>
						<li>
							<div class="title">
								<i class="material-icons">calendar_today</i>
								Akhir MoU
							</div>
							<div class="content">
								{{$akhir_mou}}
							</div>
						</li>
						<li>
							<div class="title">
								<i class="material-icons">attach_money</i>
								Jumlah Saham
							</div>
							<div class="content">
								{{$jumlah_saham}}
							</div>
						</li>
						<br>
						<h4 class="font-20">Berkas Pendukung Media</h4>
						<hr>
						<li>
							<div class="title">
								<i class="material-icons">description</i>
								Sertifikat Uji
							</div>
							<div class="content">
								@if($file_sertifikat_uji > 0)
								<a href="{{site_url()}}upload/media/{{$username}}/sertifikat_uji/{{$file_sertifikat_uji}}"
									target="_blank" class="btn bg-indigo">Lihat File</a>
								@elseif($file_sertifikat_uji == null AND $this->session->userdata('level') != 'admin')
								<small class="text-danger">File belum ada, silahkan upload file</small>
								@elseif($this->session->userdata('level') == 'admin')
								<small class="text-danger">File Belum Diupload</small>
								@endif
							</div>
						</li>
						<li>
							<div class="title">
								<i class="material-icons">verified_user</i>
								Verifikasi Pers
							</div>
							<div class="content">
								@if($file_verifikasi_pers > 0)
								<a href="{{site_url()}}upload/media/{{$username}}/verifikasi_pers/{{$file_verifikasi_pers}}"
									target="_blank" class="btn bg-indigo">Lihat File</a>
								@elseif($file_verifikasi_pers == null AND $this->session->userdata('level') != 'admin')
								<small class="text-danger">File belum ada, silahkan upload file</small>
								@elseif($this->session->userdata('level') == 'admin')
								<small class="text-danger">File Belum Diupload</small>
								@endif
							</div>
						</li>
						<li>
							<div class="title">
								<i class="material-icons">business_center</i>
								Penawaran Kerja Sama (MoU)
							</div>
							<div class="content">
								@if($file_mou > 0)
								<a href="{{site_url()}}upload/media/{{$username}}/mou/{{$file_mou}}" target="_blank"
									class="btn bg-indigo">Lihat File</a>
								@elseif($file_mou == null AND $this->session->userdata('level') != 'admin')
								<small class="text-danger">File belum ada, silahkan upload file</small>
								@elseif($this->session->userdata('level') == 'admin')
								<small class="text-danger">File Belum Diupload</small>
								@endif
							</div>
						</li>
						<li>
							<div class="title">
								<i class="material-icons">description</i>
								Akta Pendirian dan Perubahan Terakhir
							</div>
							<div class="content">
								@if($file_akta_pendirian > 0)
								<a href="{{site_url()}}upload/media/{{$username}}/akta_pendirian/{{$file_akta_pendirian}}"
									target="_blank" class="btn bg-indigo">Lihat File</a>
								@elseif($file_akta_pendirian == null AND $this->session->userdata('level') != 'admin')
								<small class="text-danger">File belum ada, silahkan upload file</small>
								@elseif($this->session->userdata('level') == 'admin')
								<small class="text-danger">File Belum Diupload</small>
								@endif
							</div>
						</li>
						<li>
							<div class="title">
								<i class="material-icons">description</i>
								SITU ( Surat Izin Tempat Usaha )
							</div>
							<div class="content">
								@if($file_situ > 0)
								<a href="{{site_url()}}upload/media/{{$username}}/situ/{{$file_situ}}" target="_blank"
									class="btn bg-indigo">Lihat File</a>
								@elseif($file_situ == null AND $this->session->userdata('level') != 'admin')
								<small class="text-danger">File belum ada, silahkan upload file</small>
								@elseif($this->session->userdata('level') == 'admin')
								<small class="text-danger">File Belum Diupload</small>
								@endif
							</div>
						</li>
						<li>
							<div class="title">
								<i class="material-icons">description</i>
								SIUP ( Surat Izin Usaha Perdagangan )
							</div>
							<div class="content">
								@if($file_siup > 0)
								<a href="{{site_url()}}upload/media/{{$username}}/siup/{{$file_siup}}" target="_blank"
									class="btn bg-indigo">Lihat File</a>
								@elseif($file_siup == null AND $this->session->userdata('level') != 'admin')
								<small class="text-danger">File belum ada, silahkan upload file</small>
								@elseif($this->session->userdata('level') == 'admin')
								<small class="text-danger">File Belum Diupload</small>
								@endif
							</div>
						</li>
						<li>
							<div class="title">
								<i class="material-icons">description</i>
								TDP ( Tanda Daftar Perusahaan )
							</div>
							<div class="content">
								@if($file_tdp > 0)
								<a href="{{site_url()}}upload/media/{{$username}}/tdp/{{$file_tdp}}" target="_blank"
									class="btn bg-indigo">Lihat File</a>
								@elseif($file_tdp == null AND $this->session->userdata('level') != 'admin')
								<small class="text-danger">File belum ada, silahkan upload file</small>
								@elseif($this->session->userdata('level') == 'admin')
								<small class="text-danger">File Belum Diupload</small>
								@endif
							</div>
						</li>
						<li>
							<div class="title">
								<i class="material-icons">description</i>
								Laporan Pajak ( 3 Bulan Terakhir )
							</div>
							<div class="content">
								@if($file_laporan_pajak > 0 )
								<a href="{{site_url()}}upload/media/{{$username}}/laporan_pajak/{{$file_laporan_pajak}}"
									target="_blank" class="btn bg-indigo">Lihat File</a>
								@elseif($file_laporan_pajak == null AND $this->session->userdata('level') != 'admin')
								<small class="text-danger">File belum ada, silahkan upload file</small>
								@elseif($this->session->userdata('level') == 'admin')
								<small class="text-danger">File Belum Diupload</small>
								@endif
							</div>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<div class="row clearfix">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="card">
				<div class="header">
					<h2>
						Personel Media
					</h2>
				</div>
				<div class="body">
					<div class="table-responsive">
						<table class="table table-bordered table-striped table-hover js-basic-example dataTable"
							id="data-tenaga">
							<thead>
								<tr>
									<th>No.</th>
									<th width="25%">Nama</th>
									<th>Jabatan</th>
									<th width="15%">NIK</th>
									<th>No. Handphone</th>
									<th width="10%">File KTP</th>
									<th width="10%">File Sertifikat</th>
									<th width="5%">Aksi</th>
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
@include("profil.modal")
@endsection
@section('js')
<script type="text/javascript">
	$(document).ready(function () {

		let table = $('#data-tenaga').DataTable({
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
				url: "{{base_url('profil/json')}}",
				type: "POST"
			},
			"columnDefs": [{
				'targets': [1, 3, 4, 5, 6],
				'orderable': false,
			}, {
				'targets': [0, 5, 6],
				'className': 'text-center'
			}],
			"pageLength": 10,
		});

		$('#data-tenaga').on('click', '.edit-tenaga', function () {

			let id_tenaga = $(this).data('id');
			$.ajax({
				url: "{{base_url('profil/get_detail_tenaga')}}",
				method: "POST",
				data: {
					id_tenaga: id_tenaga
				},
				dataType: "json",
				success: function (data) {
					$('#modal-edit').modal('show');
					$('#id-tenaganya').val(data.id_tenaga);
					$('#jabatan_idnya').val(data.id_jabatan);
					$('#nama-tenaga').val(data.nama_tenaga);
					$('#jabatan-tenaga').val(data.jabatan_tenaga);
					$('#no-handphone').val(data.no_handphone);
					$('#file-ktp-old').val(data.file_ktp);
					$('#file-sertifikat-old').val(data.file_sertifikat);
				}
			})
		});

		$('#ubah-personel').submit('click', function () {
			$.ajax({
				type: "POST",
				url: "{{base_url('profil/ubah_personel')}}",
				data: new FormData(this),
				processData: false,
				contentType: false,
				cache: false,
				async: false,
				success: function (data) {
					$('#modal-edit').modal('hide');
					toastr.success('Data Personel Berhasil Diubah', 'Sukses!');
                    table.ajax.reload();
                    location.href="{{site_url('profil')}}"
				},
				error: function (data) {
					$('#modal-edit').modal('hide');
					toastr.error('Data Personel tidak Berhasil Diubah', 'Gagal');
                    table.ajax.reload();
                    location.href="{{site_url('profil')}}"
				}
			});
			return false;
		});
	});

</script>
@endsection
