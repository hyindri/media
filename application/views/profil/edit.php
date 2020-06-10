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
					<?php echo form_open_multipart(site_url('profil/updatedata'));?>
						<input type="hidden" value="{{$data_profil->id}}" name="id_media">
						<input type="hidden" name="logo_lama" value="{{$data_profil->file_logo_media}}">
						<label for=" ">Foto atau Logo Media</label>
						<div style="margin-bottom: 2rem">
								<img src="<?= base_url('upload/logo-media/'.$this->session->userdata('logo_media'));?>" alt="" width="20%">
						</div>						
						<div class="form-group">							
							<div class="form-line">
								<input type="file" class="form-control" name="file_logo_media">
							</div>
						</div>
						<label for=" ">Nama Media</label>
						<div class="form-group">
							<div class="form-line">
								<input type="text" id="nama_media" class="form-control" placeholder="Masukkan Nama Media" name="nama_media" value="{{$data_profil->nama}}" required>
							</div>
						</div>
						<label for=" ">Nama Perusahaan</label>
						<div class="form-group">
							<div class="form-line">
								<input type="text" id="nama_perusahaan" class="form-control" placeholder="Masukkan Nama Perusahaan" name="nama_perusahaan" value="{{$data_profil->perusahaan}}" required>
							</div>
						</div>
						<label for=" ">Alamat</label>
						<div class="form-group">
							<div class="form-line">								
								<textarea name="alamat_kantor" id="alamat_per" cols="30" rows="2" class="form-control" placeholder="Masukkan Alamat Kantor Media" required>{{$data_profil->alamat}}</textarea>
							</div>
						</div>
						<label for=" ">NPWP</label>
						<div class="form-group">
							<div class="form-line">							
								<small>File Scan NPWP <b class="text-danger">*File dengan format JPG/JPEG/PNG dan Maks. 2MB</b></small>
								<input type="file" id="file_npwp" class="form-control"
									placeholder="Upload NPWP" name="file_npwp">
								<input type="hidden" id="old_file_npwp" name="old_file_npwp"
									value="{{$data_profil->file_npwp}}">
								<small>Nomor NPWP</small>
								<input type="text" id="npwp" class="form-control" placeholder="Masukkan Nomor NPWP"
								name="npwp" value="{{$data_profil->npwp}}" required>
							</div>
						</div>						
						<label for=" ">Pimpinan</label>
						<div class="form-group">
							<div class="form-line">
								<input type="text" id="pimpinan" class="form-control" placeholder="Masukkan Pimpinan" name="pimpinan" value="{{$data_profil->pimpinan}}" required>
							</div>
						</div>						
						<label for=" ">Rekening</label>
						<div class="form-group">
							<div class="form-line">
								<small>File Scan Buku Rekening <b class="text-danger">*File dengan format JPG/JPEG/PNG dan Maks. 2MB</b></small>
								<input type="file" id="file_rekening" class="form-control"
									placeholder="Masukkan Rekening" name="file_rekening">
								<input type="hidden" id="old_file_rekening" value="{{$data_profil->file_rekening}}">
								<small>Nomor Rekening</small>
								<input type="text" id="no_rek" class="form-control" placeholder="Masukkan No. Rekening" name="no_rek" value="{{$data_profil->rekening}}" required>									
							</div>
						</div>
						<label for=" ">Kabiro</label>
						<div class="form-group">
							<div class="form-line">
								<input type="text" id="kabiro" class="form-control" placeholder="Masukkan Kabiro" name="kabiro" value="{{$data_profil->kabiro}}" required>
							</div>
						</div>						
						<label for=" ">Surat Kabiro</label>
						<div class="form-group">
							<div class="form-line">
								<small><b class="text-danger">*File dengan format JPG/JPEG/PNG dan Maks. 2MB</b></small>
								<input type="file" id="file_surat_kabiro" class="form-control" placeholder="Masukkan Surat Kabiro" name="file_surat_kabiro">
								<input type="hidden" id="old_file_surat_kabiro" name="old_file_surat_kabiro" value="{{$data_profil->file_surat_kabiro}}" required>
							</div>
						</div>
						<label for=" ">Nomor Telepon</label>
						<div class="form-group">
							<div class="form-line">
								<input type="text" id="no_telp" class="form-control" placeholder="Masukkan Nomor Telepon" name="no_telp" value="{{$data_profil->no_telp}}" required>
							</div>
						</div>
						<label for=" ">Wartawan</label>
						<div class="form-group">
							<div class="form-line">
								<input type="text" id="wartawan" class="form-control" placeholder="Masukkan Wartawan" name="wartawan" value="{{$data_profil->wartawan}}" required>
							</div>
						</div>						
						<label for=" ">Sertifikat Uji</label>
						<div class="form-group">
							<div class="form-line">
								<small><b class="text-danger">*File dengan format PDF dan Maks. 2MB</b></small>
								<input type="file" id="file_sertifikat_uji" class="form-control"
									placeholder="Upload Sertifikat Uji" name="file_sertifikat_uji">
								<input type="hidden" id="old_file_sertifikat_uji" name="old_file_sertifikat_uji"
									value="{{$data_profil->file_sertifikat_uji}}">
							</div>
						</div>						
						<label for=" ">Verifikasi Pers</label>
						<div class="form-group">
							<div class="form-line">
								<small><b class="text-danger">*File dengan format PDF dan Maks. 2MB</b></small>
								<input type="file" id="file_verifikasi_pers" class="form-control"
									placeholder="Masukkan Penawaran Kerja Sama" name="file_verifikasi_pers">
								<input type="hidden" id="old_file_verifikasi_pers"
								 	name="old_file_verifikasi_pers" value="{{$data_profil->file_verifikasi_pers}}">
							</div>
						</div>						
						<label for=" ">Penawaran Kerja Sama (MoU)</label>
						<div class="form-group">
							<div class="form-line">
								<small><b class="text-danger">*File dengan format PDF dan Maks. 2MB</b></small>
								<input type="file" id="file_penawaran_kerja_sama" class="form-control"
									placeholder="Masukkan Penawaran Kerja Sama" name="file_penawaran_kerja_sama">
								<input type="hidden" id="old_file_penawaran_kerja_sama" name="old_file_penawaran_kerja_sama"
									value="{{$data_profil->file_penawaran_kerja_sama}}">
							</div>
						</div>
						<input type="hidden" name="tipe_media_massa" value="{{$data_profil->tipe_media_massa}}">
						
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