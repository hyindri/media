<div class="modal fade" id="modal-edit" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="defaultModalLabel">Ubah Data Personel Media</h4>
			</div>
			<div class="modal-body">
				<form action="" id="ubah-personel">
					<input type="hidden" id="id-tenaganya" name="edit_id">
					<!-- <input type="hidden" name="id_media" value="{{$this->session->userdata('id_media')}}"> -->
					<div class="form-group">
						<label for="">Nama Tenaga</label>
						<div class="form-line">
							<input type="text" name="nama_tenaga" id="nama-tenaga" class="form-control">
						</div>
					</div>
					<div class="form-group">
						<label for="">Jabatan</label>
						<div class="form-line">
							<input type="hidden" id="jabatan_idnya" name="jabatan_idnya">
							<input type="text" id="jabatan-tenaga" class="form-control" disabled>
						</div>
					</div>
					<div class="form-group">
						<label for="">Nomor Handphone</label>
						<div class="form-line">
							<input type="text" name="no_hp" id="no-handphone" class="form-control">
						</div>
					</div>
					<div class="form-group">
						<label for="">File KTP</label>
						<div class="from-line">
							<input type="hidden" name="file_ktp_old" id="file-ktp-old">
							<input type="file" name="file_ktp" class="form-control" accept="image/*">
						</div>
					</div>
					<div class="form-group">
						<label for="">File Sertifikat</label>
						<div class="form-line">
							<input type="hidden" name="file_sertifikat_old" id="file-sertifikat-old">
							<input type="file" name="file_sertifikat" class="form-control" accept="application/pdf">
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-link waves-effect" data-dismiss="modal">Batal</button>
						<button type="submit" class="btn btn-primary waves-effect">Simpan</button>
					</div>
				</form>
			</div>

		</div>
	</div>
</div>
