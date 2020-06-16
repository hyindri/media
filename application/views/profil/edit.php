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
						<input type="hidden" name="old_file_logo" value="{{$data_profil->file_logo_media}}">
						<label for=" ">Logo Media Massa</label>
						<div style="margin-bottom: 2rem">
								<img src="<?= base_url('upload/media/'.$this->session->userdata('username').'/logo_media/'.$this->session->userdata('file_logo_media'));?>" alt="" width="20%">
						</div>						
						<div class="form-group">							
							<div class="form-line">
								<input type="file" class="form-control" name="file_logo_media">
							</div>
						</div>		
						<label for="">Nama Media Massa</label>
						<div class="form-group">
							<div class="form-line">
								<input type="text" id="nama_media" class="form-control" placeholder="Masukkan Nama Media" name="nama_media" value="{{$data_profil->nama_media}}" required>
							</div>
						</div>
						<label for=" ">Nama Perusahaan</label>
						<div class="form-group">
							<div class="form-line">
								<input type="text" id="nama_perusahaan" class="form-control" placeholder="Masukkan Nama Perusahaan" name="nama_perusahaan" value="{{$data_profil->nama_perusahaan}}" required>
							</div>
						</div>
						<br>				
						<h4>Informasi Kontak Media</h4>
						<hr>						
						<label for=" ">Alamat</label>
						<div class="form-group">
							<div class="form-line">								
								<textarea name="alamat_kantor" id="alamat_per" cols="30" rows="2" class="form-control" placeholder="Masukkan Alamat Kantor Media" required>{{$data_profil->alamat_perusahaan}}</textarea>
							</div>
						</div>
						<label for="">Email</label>
						<div class="form-group">
							<div class="form-line">
								<input type="email" name="email_media" id="email_media" class="form-control" placeholder="Masukkan Alamat Email" value="{{$data_profil->email}}">
							</div>
						</div>	
						<label for="">Nomor Telepon</label>					
						<div class="form-group">
							<div class="form-line">
								<input type="number" name="no_telp" id="no_telp" class="form-control" placeholder="Masukkan Nomor Telepon" value="{{$data_profil->no_telp}}">
							</div>
						</div>
						<br>
						<h4>Informasi Media Lainnya</h4>
						<hr>
						<label for="">NPWP</label>
						<div class="form-group">
							<div class="form-line">							
								<small>File Scan NPWP <b class="text-danger">*File dengan format JPG/JPEG/PNG/PDF dan Maks. 2MB</b></small>
								<input type="file" id="file_npwp" class="form-control"
									placeholder="Upload NPWP" name="file_npwp">
								<input type="hidden" id="old_file_npwp" name="old_file_npwp"
									value="{{$data_profil->file_npwp}}">
								<small>Nomor NPWP</small>
								<input type="text" id="npwp" class="form-control" placeholder="Masukkan Nomor NPWP"
								name="npwp" value="{{$data_profil->npwp}}" required>
							</div>
						</div>															
						<label for=" ">Rekening</label>
						<div class="form-group">
							<div class="form-line">
								<small>File Scan Buku Rekening <b class="text-danger">*File dengan format JPG/JPEG/PNG/PDF dan Maks. 2MB</b></small>
								<input type="file" id="file_rekening" class="form-control"
									placeholder="Masukkan Rekening" name="file_rekening">
								<input type="hidden" id="old_file_rekening" value="{{$data_profil->file_rekening}}" name="old_file_rekening">
								<small>Nomor Rekening</small>
								<input type="text" id="no_rek" class="form-control" placeholder="Masukkan No. Rekening" name="no_rek" value="{{$data_profil->rekening}}" required>									
							</div>
						</div>	
						
						<br>
						<h4>Berkas Pendukung</h4>
						<small class="text-danger">*Silahkan upload file jika anda ingin mengubahnya</small>
						<hr>						
																											
						<label for=" ">Sertifikat Uji</label>
						<div class="form-group">
							<div class="form-line">
								<small><b class="text-danger">*File dengan format JPG/JPEG/PNG/PDF dan Maks. 2MB</b></small>
								<input type="file" id="file_sertifikat_uji" class="form-control"
									placeholder="Upload Sertifikat Uji" name="file_sertifikat_uji">
								<input type="hidden" id="old_file_sertifikat_uji" name="old_file_sertifikat_uji"
									value="{{$data_profil->file_sertifikat_uji}}">
							</div>
						</div>						
						<label for=" ">Verifikasi Pers</label>
						<div class="form-group">
							<div class="form-line">
								<small><b class="text-danger">*File dengan format JPG/JPEG/PNG/PDF dan Maks. 2MB</b></small>
								<input type="file" id="file_verifikasi_pers" class="form-control"
									placeholder="Masukkan Penawaran Kerja Sama" name="file_verifikasi_pers">
								<input type="hidden" id="old_file_verifikasi_pers"
								 	name="old_file_verifikasi_pers" value="{{$data_profil->file_verifikasi_pers}}">
							</div>
						</div>						
						<label for=" ">Penawaran Kerja Sama (MoU)</label>
						<div class="form-group">
							<div class="form-line">
								<small><b class="text-danger">*File dengan format JPG/JPEG/PNG/PDF dan Maks. 2MB</b></small>
								<input type="file" id="file_mou" class="form-control"
									placeholder="Masukkan Penawaran Kerja Sama" name="file_mou">
								<input type="hidden" id="old_file_mou" name="old_file_mou"
									value="{{$data_profil->file_mou}}">
							</div>
						</div>
						<label for=" ">Akta Pendirian</label>
						<div class="form-group">
							<div class="form-line">
								<small><b class="text-danger">*File dengan format JPG/JPEG/PNG/PDF dan Maks. 2MB</b></small>
								<input type="file" id="file_akta_pendirian" class="form-control"
									placeholder="Masukkan Penawaran Kerja Sama" name="file_akta_pendirian">
								<input type="hidden" id="old_file_akta_pendirian" name="old_file_akta_pendirian"
									value="{{$data_profil->file_akta_pendirian}}">
							</div>
						</div>
						<label for=" ">SITU ( Surat Izin Tempat Usaha )</label>
						<div class="form-group">
							<div class="form-line">
								<small><b class="text-danger">*File dengan format JPG/JPEG/PNG/PDF dan Maks. 2MB</b></small>
								<input type="file" id="file_situ" class="form-control"
									placeholder="Masukkan Penawaran Kerja Sama" name="file_situ">
								<input type="hidden" id="old_file_situ" name="old_file_situ"
									value="{{$data_profil->file_situ}}">
							</div>
						</div>
						<label for=" ">SIUP ( Surat Izin Usaha Perdagangan )</label>
						<div class="form-group">
							<div class="form-line">
								<small><b class="text-danger">*File dengan format JPG/JPEG/PNG/PDF dan Maks. 2MB</b></small>
								<input type="file" id="file_siup" class="form-control"
									placeholder="Masukkan Penawaran Kerja Sama" name="file_siup">
								<input type="hidden" id="old_file_siup" name="old_file_siup"
									value="{{$data_profil->file_siup}}">
							</div>
						</div>
						<label for=" ">TDP ( Tanda Daftar Perusahaan ) </label>
						<div class="form-group">
							<div class="form-line">
								<small><b class="text-danger">*File dengan format JPG/JPEG/PNG/PDF dan Maks. 2MB</b></small>
								<input type="file" id="file_tdp" class="form-control"
									placeholder="Masukkan Penawaran Kerja Sama" name="file_tdp">
								<input type="hidden" id="old_file_tdp" name="old_file_tdp"
									value="{{$data_profil->file_tdp}}">
							</div>
						</div>
						<label for=" ">Laporan Pajak</label>
						<div class="form-group">
							<div class="form-line">
								<small><b class="text-danger">*File dengan format JPG/JPEG/PNG/PDF dan Maks. 2MB</b></small>
								<input type="file" id="file_laporan_pajak" class="form-control"
									placeholder="Masukkan Penawaran Kerja Sama" name="file_laporan_pajak">
								<input type="hidden" id="old_file_laporan_pajak" name="old_file_laporan_pajak"
									value="{{$data_profil->file_laporan_pajak}}">
							</div>
						</div>
						<br>
						<h4>Sosial Media </h4>
						<hr>
						<label for="">Facebook</label>
						<div class="form-group">
							<div class="col-lg-6">
								<label for="" style="font-weight: 400">Username</label>
								<div class="form-line">
									<input type="text" class='form-control' name="username_fb" value="{{$data_profil->username_fb}}">
								</div>
							</div>							
							<div class="col-lg-6">
								<label for="" style="font-weight: 400">Pengikut</label>
								<div class="form-line">	
									<input type="number" class='form-control' name="pengikut_fb" value="{{$data_profil->pengikut_fb}}">
								</div>
							</div>
						</div>
						<label for="">Twitter</label>
						<div class="form-group">
							<div class="col-lg-6">
								<label for="" style="font-weight: 400">Username</label>
								<div class="form-line">
									<input type="text" class='form-control' name="username_twitter" value="{{$data_profil->username_twitter}}">
								</div>
							</div>							
							<div class="col-lg-6">
								<label for="" style="font-weight: 400">Pengikut</label>
								<div class="form-line">	
									<input type="number" class='form-control' name="pengikut_twitter" value="{{$data_profil->pengikut_twitter}}">
								</div>
							</div>
						</div>
						<label for="">Instagram</label>
						<div class="form-group">
							<div class="col-lg-6">
								<label for="" style="font-weight: 400">Username</label>
								<div class="form-line">
									<input type="text" class='form-control' name="username_ig" value="{{$data_profil->username_ig}}">
								</div>
							</div>							
							<div class="col-lg-6">
								<label for="" style="font-weight: 400">Pengikut</label>
								<div class="form-line">	
									<input type="number" class='form-control' name="pengikut_ig" value="{{$data_profil->pengikut_ig}}">
								</div>
							</div>
						</div>
						<label for="">Saluran Youtube</label>
						<div class="form-group">
							<div class="col-lg-6">
								<label for="" style="font-weight: 400">Link Youtube</label>
								<div class="form-line">
									<input type="text" class='form-control' name="channel_youtube" value="{{$data_profil->channel_youtube}}">
								</div>
							</div>							
							<div class="col-lg-6">
								<label for="" style="font-weight: 400">Pengikut</label>
								<div class="form-line">	
									<input type="number" class='form-control' name="subsriber_youtube" value="{{$data_profil->subscriber_youtube}}">
								</div>
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