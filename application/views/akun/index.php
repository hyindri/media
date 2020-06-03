@extends('layouts.app')
@section('content')
<!-- DataTales Example -->
<div class="card shadow mb-4">
	<div class="card-header py-3">
		<h6 class="m-0 font-weight-bold text-primary">Manajemen Akun </h6>
		<button class="btn btn-primary" style="float: right" data-toggle="modal" data-target="#tambahModal">Tambah
			Data</button>
	</div>
	<div class="card-body">
		<div class="table-responsive">
			<table class="table table-bordered table-akun" width="100%" cellspacing="0">
				<thead>
					<tr>
						<th>No</th>
						<th>Username</th>
						<th>Email</th>
						<th>Nama</th>
						<th>No. Telp</th>
						<th>Level Akses</th>
						<th width="5%">Aksi</th>
					</tr>
				</thead>
			</table>
		</div>
	</div>
</div>

<div class="modal fade" id="tambahModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
	aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			{{form_open('',['id' => 'tambah-akun','role' => 'form'])}}
			<div class="modal-body">
				@php

				$email = [
				'type' => 'email',
				'id' => 'id_email',
				'name' => 'email',
				'class' => 'form-control',
				'required' => 'required'
				];

				$username = [
				'type' => 'text',
				'id' => 'id_username',
				'name' => 'username',
				'class' => 'form-control',
				'required' => 'required'
				];

				$password = [
				'type' => 'password',
				'id' => 'id_password',
				'name' => 'password',
				'class' => 'form-control',
				'required' => 'required'
				];

				$nama = [
				'type' => 'text',
				'id' => 'id_nama',
				'name' => 'nama',
				'class' => 'form-control',
				'required' => 'required'
				];

				$hp = [
				'type' => 'number',
				'id' => 'id_nomorhp',
				'name' => 'nomor_hp',
				'class' => 'form-control',
				'required' => 'required'
				];

				$level_akses = [
					'id' => 'level-akses',
					'class' => 'form-control',
					'required' => 'required',
					'name' => 'level_akses'
				];

				$option_level = [
					'admin' => 'Admin',
					'user' => 'User'
				];


                @endphp
                
                <div class="form-group">
                    {{form_label('Email')}}
                    {{form_input($email)}}
                </div>

                <div class="form-group">
                    {{form_label('Username')}}
                    {{form_input($username)}}
                </div>

                <div class="form-group">
                    {{form_label('Password')}}
                    {{form_input($password)}}
                </div>

                <div class="form-group">
                    {{form_label('Nama')}}
                    {{form_input($nama)}}
                </div>

                <div class="form-group">
                    {{form_label('Nomor Handphone')}}
                    {{form_input($hp)}}
                </div>
                
                <div class="form-group">
                    {{form_label('Level Akses')}}
					{{form_dropdown('level_akses',$option_level,'',$level_akses)}}
                </div>

			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
				{{form_submit('submit', 'Simpan', 'class="btn btn-primary"')}}
			</div>
			{{form_close()}}
		</div>
	</div>
</div>

<div class="modal fade" id="ubahModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
	aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Edit Data</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			{{form_open('',['id' => 'ubah-akun','role' => 'form'])}}
			<div class="modal-body">
				@php
				$id_user = [
				'type' => 'hidden',
				'id' => 'ubah-id',
				'name' => 'id_user',
				'class' => 'form-control',
				'required' => 'required'
				];

				$email = [
				'type' => 'email',
				'id' => 'ubah-email',
				'name' => 'email',
				'class' => 'form-control',
				'required' => 'required'
				];

				$username = [
				'type' => 'text',
				'id' => 'ubah-username',
				'name' => 'username',
				'class' => 'form-control',
				'required' => 'required'
				];

				$password = [
				'type' => 'password',
				'id' => 'ubah-password',
				'name' => 'password',
				'class' => 'form-control',				
				'placeholder' => 'Ubah password jika ingin mengubahnya'
				];

				$nama = [
				'type' => 'text',
				'id' => 'ubah-nama',
				'name' => 'nama',
				'class' => 'form-control',
				'required' => 'required'
				];

				$hp = [
				'type' => 'number',
				'id' => 'ubah-nomorhp',
				'name' => 'nomor_hp',
				'class' => 'form-control',
				'required' => 'required'
				];
				
				$level_akses = [
					'id' => 'ubah-level-akses',
					'class' => 'form-control',	
								
				];

				$option_level = [
					'admin' => 'Admin',
					'user' => 'User'
				];

				@endphp

				{{form_input($id_user)}}
				<div class="form-group">
                    {{form_label('Email')}}
                    {{form_input($email)}}
                </div>

                <div class="form-group">
                    {{form_label('Username')}}
                    {{form_input($username)}}
                </div>

                <div class="form-group">
                    {{form_label('Password')}}
                    {{form_input($password)}}
                </div>

                <div class="form-group">
                    {{form_label('Nama')}}
                    {{form_input($nama)}}
                </div>

                <div class="form-group">
                    {{form_label('Nomor Handphone')}}
                    {{form_input($hp)}}
                </div>
                
                <div class="form-group">
                    {{form_label('Level Akses')}}
					{{form_dropdown('ubah_level_akses',$option_level,'',$level_akses)}}
                </div>
			
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
				{{form_submit('submit', 'Simpan', 'class="btn btn-primary"')}}
			</div>
			{{form_close()}}
		</div>
	</div>
</div>

<div class="modal fade" id="hapusModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
	aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header bg-danger">
				<h5 class="modal-title text-white" id="exampleModalLabel">Edit Data</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			{{form_open('',['id' => 'hapus-akun','role' => 'form'])}}
			<div class="modal-body">
				@php
				$id_user = [
				'type' => 'hidden',
				'id' => 'delete-id',
				'name' => 'id_user',
				'class' => 'form-control',
				'required' => 'required'
				];


				@endphp

				{{form_input($id_user)}}
				<p>Apakah anda yakin ingin menghapus data ini ?</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
				{{form_submit('submit', 'Hapus', 'class="btn btn-danger"')}}
			</div>
			{{form_close()}}
		</div>
	</div>
</div>



@endsection
@section('js')
<script>
	$(document).ready(function () {
		var table = $('.table-akun').DataTable({
			"dom": 'lTfgitp',
			"processing": true,
			"serverSide": true,
			"responsive": true,
			"order": [],
			"ajax": {
				url: "{{base_url('akun/ambil_data')}}",
				type: "POST"
			},
			"pageLength": 10,
		});

		$('#tambah-akun').submit('click', function () {
			$.ajax({
				type: 'POST',
				url: "{{base_url('akun/tambah_data')}}",
				data: new FormData(this),
				processData: false,
				contentType: false,
				cache: false,
				success: function (data) {
					$('#tambahModal').modal('hide');
					table.ajax.reload();
				},
				error: function (data) {
					table.ajax.reload();
				}
			});
			return false;
		});

		$('.table-akun').on('click', '#get-ubahModal', function () {
			let id_user = $(this).data('id');
			$.ajax({
				url: "{{base_url('akun/ambil_satu_data')}}",
				method: "POST",
				data: {
					id_user: id_user
				},
				dataType: "json",
				success: function (data) {
					$('#ubahModal').modal('show');
					$('#ubah-id').val(data.id);
					$('#ubah-email').val(data.email);
					$('#ubah-username').val(data.username);
					$('#ubah-nama').val(data.nama);
					$('#ubah-nomorhp').val(data.nomor_hp)
					$('#ubah-level-akses').val(data.level_akses);
				}
			})
		});

		$('#ubah-akun').submit('click', function () {
			$.ajax({
				type: "POST",
				url: "{{base_url('akun/ubah_data')}}",
				data: new FormData(this),
				processData: false,
				contentType: false,
				cache: false,
				success: function (data) {
					$('#ubahModal').modal('hide');
					table.ajax.reload();
				},
				error: function (data) {
					table.ajax.reload();
				}
			});
			return false;
		});

		$('.table-akun').on('click', '#get-hapusModal', function () {
			let id_user = $(this).data('id');
			$.ajax({
				url: "{{base_url('akun/ambil_satu_data')}}",
				method: "POST",
				data: {
					id_user: id_user
				},
				dataType: "json",
				success: function (data) {
					$('#hapusModal').modal('show');
					$('#delete-id').val(data.id);
				}
			})

		});

		$('#hapus-akun').submit('click', function () {
			$.ajax({
				type: 'POST',
				url: "{{base_url('akun/hapus_data')}}",
				data: new FormData(this),
				processData: false,
				contentType: false,
				cache: false,
				success: function (data) {
					$('#hapusModal').modal('hide');
					table.ajax.reload();
				},
				error: function (data) {
					table.ajax.reload();
				}
			});
			return false;
		})
	});

</script>
</script>
@endsection
