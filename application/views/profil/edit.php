@extends('base.main_base')
@section('content')
@section('title','Ubah Informasi Profil')
<div class="container-fluid">
	<!-- Breadcrumb  -->
	<div class="block-header">
		<ol class="breadcrumb">
			<li>HOME</li>
			<li>PROFIL</li>
			<li class="active">INFORMASI PROFIL</li>
		</ol>
	</div>
	<!-- end breadcrumb -->
	<!-- form -->
	<div class="row clearfix">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="card">
				<div class="header">
					<h2>
						Ubah Informasi Profil
					</h2>
				</div>
				<div class="body">
					<!-- <form action="{{site_url('profil/updatedata')}}" method="POST"> -->
					<?php echo form_open_multipart(site_url('profil/updatedata'));?>
						<input type="hidden" value="{{$data_profil->id}}" name="id_media">
						<label for=" ">Nama Media</label>
						<div class="form-group">
							<div class="form-line">
								<input type="text" id="nama_media" class="form-control" placeholder="Masukkan Nama Media" name="nama_media" value="{{$data_profil->nama}}">
							</div>
						</div>
						<label for=" ">Nama Perusahaan</label>
						<div class="form-group">
							<div class="form-line">
								<input type="text" id="nama_perusahaan" class="form-control" placeholder="Masukkan Nama Perusahaan" name="nama_perusahaan" value="{{$data_profil->perusahaan}}">
							</div>
						</div>
						<label for=" ">Alamat</label>
						<div class="form-group">
							<div class="form-line">
								<!-- <input type="text" id="nama_perusahaan" class="form-control"
									placeholder="Masukkan Nama Perusahaan" value="{{$data_profil->perusahaan}}"> -->
								<textarea name="alamat_kantor" id="alamat_per" cols="30" rows="2" class="form-control" placeholder="Masukkan Alamat Kantor Media">{{$data_profil->alamat}}</textarea>
							</div>
						</div>
						<label for=" ">NPWP</label>
						<div class="form-group">
							<div class="form-line">
								<input type="text" id="npwp" class="form-control" placeholder="Masukkan NPWP"
									name="npwp" value="{{$data_profil->npwp}}">
							</div>
						</div>
						<label for=" ">Upload NPWP</label>
						<div class="form-group">
							<div class="form-line">
								<input type="file" id="file_npwp" class="form-control"
									placeholder="Upload NPWP" name="file_npwp">
									<input type="text" id="old_file_npwp" class="form-control"
									placeholder="Upload NPWP" name="old_file_npwp"
									value="{{$data_profil->file_npwp}}">
							</div>
						</div>
						<label for=" ">Pimpinan</label>
						<div class="form-group">
							<div class="form-line">
								<input type="text" id="pimpinan" class="form-control" placeholder="Masukkan Pimpinan" name="pimpinan" value="{{$data_profil->pimpinan}}">
							</div>
						</div>
						<label for=" ">Nomor Rekening</label>
						<div class="form-group">
							<div class="form-line">
								<input type="text" id="no_rek" class="form-control" placeholder="Masukkan No. Rekening" name="no_rek" value="{{$data_profil->rekening}}">
							</div>
						</div>
						<label for=" ">Upload Rekening</label>
						<div class="form-group">
							<div class="form-line">
								<input type="file" id="file_rekening" class="form-control"
									placeholder="Masukkan Rekening" name="file_rekening">
									<input type="text" id="old_file_rekening" class="form-control"
									placeholder="Masukkan Rekening" name="old_file_rekening"
									value="{{$data_profil->file_rekening}}">
									
							</div>
						</div>
						<label for=" ">Kabiro</label>
						<div class="form-group">
							<div class="form-line">
								<input type="text" id="kabiro" class="form-control" placeholder="Masukkan Kabiro" name="kabiro" value="{{$data_profil->kabiro}}">
							</div>
						</div>
						<!-- Masih Belum tau bentuknya apa -->
						<label for=" ">Surat Kabiro</label>
						<div class="form-group">
							<div class="form-line">
								<input type="text" id="surat_kabiro" class="form-control" placeholder="Masukkan Surat Kabiro" name="surat_kabiro" value="{{$data_profil->surat_kabiro}}">
							</div>
						</div>
						<label for=" ">Nomor Telepon</label>
						<div class="form-group">
							<div class="form-line">
								<input type="text" id="no_telp" class="form-control" placeholder="Masukkan Nomor Telepon" name="no_telp" value="{{$data_profil->no_telp}}">
							</div>
						</div>
						<label for=" ">Wartawan</label>
						<div class="form-group">
							<div class="form-line">
								<input type="text" id="wartawan" class="form-control" placeholder="Masukkan Wartawan" name="wartawan" value="{{$data_profil->wartawan}}">
							</div>
						</div>
						<label for=" ">Sertifikat Uji</label>
						<div class="form-group">
							<div class="form-line">
								<input type="text" id="sertifikat_uji" class="form-control" placeholder="Masukkan Sertifikat Uji" name="sertifikat_uji" value="{{$data_profil->sertifikat_uji}}">
							</div>
						</div>
						<label for=" ">Upload Sertifikat Uji</label>
						<div class="form-group">
							<div class="form-line">
								<input type="file" id="file_sertifikat_uji" class="form-control"
									placeholder="Upload Sertifikat Uji" name="file_sertifikat_uji">
								<input type="text" id="old_file_sertifikat_uji" class="form-control"
									placeholder="Upload Sertifikat Uji" name="old_file_sertifikat_uji"
									value="{{$data_profil->file_sertifikat_uji}}">
							</div>
						</div>
						<label for=" ">Verifikasi Pers</label>
						<div class="form-group">
							<div class="form-line">
								<input type="text" id="verifikasi_pers" class="form-control" placeholder="Masukkan Verifikasi Pers" name="verifikasi_pers" value="{{$data_profil->verifikasi_pers}}">
							</div>
						</div>
						<label for=" ">Upload Verifikasi Pers</label>
						<div class="form-group">
							<div class="form-line">
								<input type="file" id="file_verifikasi_pers" class="form-control"
									placeholder="Masukkan Penawaran Kerja Sama" name="file_verifikasi_pers">
								<input type="text" id="old_file_verifikasi_pers" class="form-control"
									placeholder="Masukkan Penawaran Kerja Sama" name="old_file_verifikasi_pers"
									value="{{$data_profil->file_verifikasi_pers}}">
							</div>
						</div>
						<label for=" ">Penawaran Kerja Sama</label>
						<div class="form-group">
							<div class="form-line">
								<input type="text" id="penawaran_kerjasama" class="form-control" placeholder="Masukkan Penawaran Kerja Sama" name="penawaran_kerjasama" value="{{$data_profil->penawaran_kerja_sama}}">
							</div>
						</div>
						<label for=" ">Upload Penawaran Kerja Sama</label>
						<div class="form-group">
							<div class="form-line">
								<input type="file" id="file_penawaran_kerja_sama" class="form-control"
									placeholder="Masukkan Penawaran Kerja Sama" name="file_penawaran_kerja_sama">
								<input type="text" id="old_file_penawaran_kerja_sama" class="form-control"
									placeholder="Masukkan Penawaran Kerja Sama" name="old_file_penawaran_kerja_sama"
									value="{{$data_profil->file_penawaran_kerja_sama}}">
							</div>
						</div>

						<label for=" ">Tipe Media Massa</label>
						<div class="form-group">
							<div class="form-line">
								<select class="form-control show-tick" multiple="multiple" name="tipe_media_massa[]">

									<option value="cetak" @php if(in_array("cetak", $tipe_selected)) echo "selected" @endphp> Cetak</option>
									<option value="online" @php if(in_array("online", $tipe_selected)) echo "selected" @endphp>Online</option>
									<option value="radio" @php if(in_array("radio", $tipe_selected)) echo "selected" @endphp>Radio</option>

								</select>
							</div>
						</div>
						<a class="deco-off btn bg-red col-white m-t-15 waves-effect" href="{{site_url('dashboard')}}">
							BATAL
						</a>
						<button type="submit" class="btn bg-green m-t-15 waves-effect">SIMPAN</button>
					<?= form_close() ?>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection