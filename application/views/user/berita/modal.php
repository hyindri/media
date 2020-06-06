<div class="modal fade" id="modal-draft" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="defaultModalLabel">Tambah Draft</h4>
			</div>
			{{form_open('',['id'=>'form-draft','role'=>'form'])}}
			<div class="modal-body">
				<div class="form-group">
					<div class="form-line">
						<textarea id="judul_berita" name="judul_berita" class="form-control" placeholder="Judul berita" required></textarea>
					</div>
				</div>

				<div class="form-group">
					<div class="form-line">
						<textarea id="narasi_berita" name="narasi_berita" class="form-control" rows="17" placeholder="Narasi berita" required></textarea>
					</div>
				</div>

			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-link waves-effect" data-dismiss="modal">TUTUP</button>
				<button type="submit" class="btn btn-link waves-effect">SIMPAN</button>
			</div>
			{{form_close()}}
		</div>
	</div>
</div>



<div class="modal fade" id="modal-tambah" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="defaultModalLabel">Tambah {{$title}}</h4>
            </div>
            {{form_open('',['id'=>'form-tambah','role'=>'form', 'enctype'=>'multipart/form-data'])}}
            <div class="modal-body">
                <div class="form-group">
                    <div class="form-line">
                        <input type="text" name="link_berita" id="link_berita" class="form-control" placeholder="Link Berita" required>
                    </div>
                </div>

                <div class="form-group">
                    <div class="form-line">
                        <input name="share" id="share" class="form-control" placeholder="Dibagikan ke platform apa saja.." required>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-line">
                        <input name="jumlah_view" id="jumlah_view" class="form-control" placeholder="Jumlah orang yang melihat berita anda.." required>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-line">
                        <input type="file" name="file" id="file" class="form-control">
                    </div>
                </div>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">TUTUP</button>
                <button id="simpan_btn" type="submit" class="btn btn-link waves-effect">SIMPAN</button>
            </div>
            {{form_close()}}
        </div>
    </div>
</div>

<div class="modal fade" id="modal-ubah" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="defaultModalLabel">Ubah {{$title}}</h4>
            </div>
            {{form_open('',['id'=>'form-ubah','role'=>'form', 'enctype'=>'multipart/form-data'])}}
            <div class="modal-body">

                <div class="form-group">
                    <div class="form-line">
                        <input type="hidden" name="edit_id_berita" id="edit_id_berita" class="form-control" required>
                        <input type="text" name="ubah_link_berita" id="ubah_link_berita" class="form-control" placeholder="Link Berita" required>
                    </div>
                </div>

                <div class="form-group">
                    <div class="form-line">
                    <input type="checkbox" name="check[]" id="check_fb" class="filled-in chk-col-indigo">
                    <label for="check_fb">Facebook</label>
                    <input type="checkbox" name="check[]" id="check_twitter" class="filled-in chk-col-light-blue">
                    <label for="check_twitter">Twitter</label>
                    <input type="checkbox" name="check[]" id="check_wa" class="filled-in chk-col-teal">
                    <label for="check_wa">Whatsapp</label>
                    <input type="checkbox" name="check[]" id="check_line" class="filled-in chk-col-light-green">
                    <label for="check_line">Line</label>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-line">
                        <input name="ubah_jumlah_view" id="ubah_jumlah_view" class="form-control" placeholder="Jumlah orang yang melihat berita anda.." required>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-line">
                        <input type="file" name="file" id="ubah_file" class="form-control">
                        File lama
                        <span id="file_lama_view"></span>
                        <input type="hidden" name="old_file" id="file_lama" class="form-control">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">TUTUP</button>
                <button id="ubah_btn" type="submit" class="btn btn-link waves-effect">SIMPAN</button>
            </div>
            {{form_close()}}
        </div>
    </div>
</div>


<div class="modal fade" id="modal-ubah-draft" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="defaultModalLabel">Ubah Draft</h4>
			</div>
			{{form_open('',['id'=>'form-ubah-draft','role'=>'form'])}}
			<div class="modal-body">
				<div class="form-group">
					<div class="form-line">
						<input type="hidden" name="edit_id_berita2" id="edit_id_berita2" class="form-control" required>
					</div>
				</div>
				<div class="form-group">
					<div class="form-line">
						<textarea id="ubah_judul" name="ubah_judul" class="form-control" placeholder="Judul berita" required></textarea>
					</div>
				</div>

				<div class="form-group">
					<div class="form-line">
						<textarea id="ubah_narasi" name="ubah_narasi" class="form-control" rows="17" placeholder="Narasi berita" required></textarea>
					</div>
				</div>

			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-link waves-effect" data-dismiss="modal">TUTUP</button>
				<button type="submit" class="btn btn-link waves-effect">SIMPAN</button>
			</div>
			{{form_close()}}
		</div>
	</div>
</div>

<div class="modal fade" id="modal-hapus" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-col-red">
            <div class="modal-header">
                <h4 class="modal-title" id="defaultModalLabel">Hapus {{$title}}</h4>
            </div>
            {{form_open('',['id'=>'form-hapus','role'=>'form'])}}
            <div class="modal-body">
                <input type="hidden" name="hapus_id_berita" id="hapus_id_berita" class="form-control" required>
                <p>Laporan berita ingin dihapus?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">TUTUP</button>
                <button id="hapus_btn" type="submit" class="btn btn-link waves-effect">HAPUS</button>
            </div>
            {{form_close()}}
        </div>
    </div>
</div>

<div class="modal fade" id="modal-lihat" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="defaultModalLabel">Lihat {{$title}}</h4>
            </div>
            <div class="modal-body">
                <input type="hidden" name="lihat_id_berita" id="lihat_id_berita" class="form-control" required>
                <table class="table">
                    <tr>
                        <td style="width: 20%">Nama Media</td>
                        <td style="width: 10px;">:</td>
                        <td colspan="6">
                            <p id="lihat_nama"></p>
                        </td>
                    </tr>
					<tr>
						<td style="width: 20%">Judul Berita</td>
						<td style="width: 10px;">:</td>
						<td colspan="6">
							<div id="lihat_judul_berita"></div>
						</td>
					</tr>
					<tr>
						<td style="width: 20%">Narasi Berita</td>
						<td style="width: 10px;">:</td>
						<td colspan="6">
							<div id="lihat_narasi_berita"></div>
						</td>
					</tr>
                    <tr id="link">
                        <td style="width: 20%">Link Berita</td>
                        <td style="width: 10px;">:</td>
                        <td colspan="6">
                            <div id="lihat_link_berita"></div>
                        </td>
                    </tr>
					<tr id="sharing">
                        <td style="width: 20%">Share</td>
                        <td style="width: 10px;">:</td>
                        <td colspan="6">
                            <p id="lihat_share"></p>
                        </td>
                    </tr>
                    <tr id="view">
                        <td style="width: 20%">Jumlah View</td>
                        <td style="width: 10px;">:</td>
                        <td colspan="6">
                            <p id="lihat_jumlah_view"></p>
                        </td>
                    </tr>

                    <tr id="screenshot">
                        <td style="width: 20%">Screenshoot</td>
                        <td style="width: 10px;">:</td>
                        <td colspan="6">
                            <div id="lihat_screenshoot"></div>
                        </td>
                    </tr>
                    <tr>
                        <td class="bg-primary text-white text-center" style="width: 20%" colspan="6">DILAPORKAN</td>
                    </tr>
                    <tr>
                        <td style="width: 20%"> Tanggal</td>
                        <td style="width: 10px;">:</td>
                        <td>
                            <p id="lihat_dibuat_tanggal"></p>
                        </td>
                        <td style="width: 20%"> Pukul</td>
                        <td style="width: 10px;">:</td>
                        <td>
                            <p id="lihat_dibuat_pukul"></p>
                        </td>
                    </tr>
                    <tr>
                        <td class="bg-primary text-white text-center" style="width: 20%" colspan="6">DIPERIKSA</td>
                    </tr>
                    <tr>
                        <td style="width: 20%"> Oleh</td>
                        <td style="width: 10px;">:</td>
                        <td><span id="lihat_oleh"> - </span></td>
                        <td style="width: 20%"> Pada</td>
                        <td style="width: 10px;">:</td>
                        <td><span id="lihat_pada"> - </span></td>
                    </tr>
                    <tr>
                        <td style="width: 20%">Status Berita</td>
                        <td style="width: 10px;">:</td>
                        <td colspan="6">
                            <div id="lihat_status_berita"></div>
                        </td>
                    </tr>

                    <tr>
                        <td style="width: 20%">Keterangan</td>
                        <td style="width: 10px;">:</td>
                        <td colspan="6">
                            <p class="text-justify" id="lihat_keterangan"> - </p>
                        </td>
                    </tr>
                </table>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">TUTUP</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-filter" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="defaultModalLabel">FILTER</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form-filter">
                <div class="modal-body">

                    <div class="form-group form-float">
                        <div class="form-line">
                            <input type="text" id="filter_tanggal" class="form-control datepicker" placeholder="Tanggal">
                        </div>
                    </div>

                    <div class="form-group form-float">
                        <div class="form-line">
                            <select id="filter_status_berita" class="form-control">
                            <option value=""> - Pilih - </option>
                                <option value="valid">Valid</option>
                                <option value="oke">Draft Valid</option>
                                <option value="belum">Belum Valid</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="btn-filter" type="button" class="btn btn-link waves-effect waves-blue">CARI</button>
                </div>
            </form>
        </div>
    </div>
</div>
