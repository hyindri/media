<div class="modal fade" id="modal-draft" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-indigo">
                <h4 class="modal-title">Tambah Draft Berita</h4>
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
                <button type="button" class="btn bg-red col-white waves-effect" data-dismiss="modal">BATAL</button>
                <button type="submit" class="btn bg-green col-white waves-effect">SIMPAN</button>
            </div>
            {{form_close()}}
        </div>
    </div>
</div>

<div class="modal fade" id="modal-tambah" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-indigo">
                <h4 class="modal-title">Tambah {{$title}}</h4>
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
                <button type="button" class="btn bg-red col-white waves-effect" data-dismiss="modal">BATAL</button>
                <button id="simpan_btn" type="submit" class="btn bg-green col-white waves-effect">SIMPAN</button>
            </div>
            {{form_close()}}
        </div>
    </div>
</div>

<div class="modal fade" id="modal-ubah" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-indigo">
                <h4 class="modal-title">Ubah {{$title}}</h4>
            </div>
            {{form_open('',['id'=>'form-ubah','role'=>'form', 'enctype'=>'multipart/form-data'])}}
            <div class="modal-body">
                <div class="form-group">
                <label for="ubah_link_berita">Link Berita</label>
                    <div class="form-line">
                        <input type="hidden" name="edit_id_berita" id="edit_id_berita" class="form-control" required>
                        <input type="text" name="ubah_link_berita" id="ubah_link_berita" class="form-control" placeholder="Link Berita" required>
                    </div>
                </div>
                <div class="form-group">
                <label for="">Dibagikan</label>
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
                <label for="ubah_jumlah_view">Jumlah View</label>

                    <div class="form-line">
                        <input name="ubah_jumlah_view" id="ubah_jumlah_view" class="form-control" placeholder="Jumlah orang yang melihat berita anda.." required>
                    </div>
                </div>
                <div class="form-group">
                <label for="ubah_file">Screenshot</label>
                    <div class="form-line">
                        <input type="file" name="file" id="ubah_file" class="form-control">
                        File lama
                        <span id="file_lama_view"></span>
                        <input type="hidden" name="old_file" id="file_lama" class="form-control">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn bg-red col-white waves-effect" data-dismiss="modal">BATAL</button>
                <button id="ubah_btn" type="submit" class="btn bg-green col-white waves-effect">SIMPAN</button>
            </div>
            {{form_close()}}
        </div>
    </div>
</div>

<div class="modal fade" id="modal-ubah-draft" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-indigo">
                <h4 class="modal-title">Ubah Draft</h4>
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
                <button type="button" class="btn bg-red col-white waves-effect" data-dismiss="modal">BATAL</button>
                <button type="submit" class="btn bg-green col-white waves-effect">SIMPAN</button>
            </div>
            {{form_close()}}
        </div>
    </div>
</div>

<div class="modal fade" id="modal-hapus" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-col-red">
            <div class="modal-header">
                <h4 class="modal-title">Hapus {{$title}}</h4>
            </div>
            {{form_open('',['id'=>'form-hapus','role'=>'form'])}}
            <div class="modal-body">
                <input type="hidden" name="hapus_id_berita" id="hapus_id_berita" class="form-control" required>
                <p>Laporan berita ingin dihapus?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">BATAL</button>
                <button id="hapus_btn" type="submit" class="btn btn-link waves-effect">HAPUS</button>
            </div>
            {{form_close()}}
        </div>
    </div>
</div>

<div class="modal fade" id="modal-lihat" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-indigo">
                <h4 class="modal-title">Lihat {{$title}}</h4>
            </div>
            <div class="modal-body">
                <input type="hidden" name="lihat_id_berita" id="lihat_id_berita" class="form-control" required>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 w-break">
                    <!-- Nama Media  -->
                    <div class="row p-modal">
                        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-3">
                            <span>Nama Media</span>
                        </div>
                        <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
                            <span>:</span>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-8">
                            <span id="lihat_nama"></span>
                        </div>
                    </div>
                    <!-- Judul Berita -->
                    <div class="row p-modal">
                        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-3">
                            <span>Judul</span>
                        </div>
                        <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
                            <span>:</span>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-8">
                            <span id="lihat_judul_berita"></span>
                        </div>
                    </div>
                    <!-- Narasi Berita -->
                    <div class="row p-modal">
                        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-3">
                            <span>Narasi Berita</span>
                        </div>
                        <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
                            <span>:</span>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-8">
                            <span id="lihat_narasi_berita"></span>
                        </div>
                    </div>
                    <!-- Link Berita -->
                    <div class="row p-modal link">
                        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-3">
                            <span>Link Berita</span>
                        </div>
                        <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
                            <span>:</span>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-8">
                            <span id="lihat_link_berita"></span>
                        </div>
                    </div>
                    <!-- Sharing Berita -->
                    <div class="row p-modal share">
                        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-3">
                            <span>Sharing</span>
                        </div>
                        <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
                            <span>:</span>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-8">
                            <span id="lihat_share"></span>
                        </div>
                    </div>
                    <!-- View Berita -->
                    <div class="row p-modal view">
                        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-3">
                            <span>View</span>
                        </div>
                        <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
                            <span>:</span>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-8">
                            <span id="lihat_share"></span>
                        </div>
                    </div>
                    <!-- File  -->
                    <div class="row p-modal file">
                        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-3">
                            <span>File</span>
                        </div>
                        <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
                            <span>:</span>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-8">
                            <span id="lihat_screenshoot"></span>
                        </div>
                    </div>
                    <!-- Batas Biru  -->
                    <div class="row p-modal">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 bg-indigo text-white text-center p-modal">
                            <span>DILAPORKAN</td>
                        </div>
                    </div>
                    <!-- Tanggal di Buat  -->
                    <div class="row p-modal">
                        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-3">
                            <span>Tanggal</span>
                        </div>
                        <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
                            <span>:</span>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-3">
                            <span id="lihat_dibuat_tanggal"></span>
                            <span id="lihat_dibuat_pukul"></span>
                        </div>
                    </div>
                    <!-- Batas Biru  -->
                    <div class="row p-modal">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 bg-indigo text-white text-center p-modal">
                            <span>DIPERIKSA</td>
                        </div>
                    </div>
                    <!-- Pemeriksa & Tanggal Periksa  -->
                    <div class="row p-modal">
                        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-3">
                            <span>Pemeriksa</span>
                        </div>
                        <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
                            <span>:</span>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-2">
                            <span id="lihat_oleh"> - </span>
                        </div>
                        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-2">
                            <span>Pada</span>
                        </div>
                        <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
                            <span>:</span>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-2">
                            <span id="lihat_pada"> - </span>
                        </div>
                    </div>
                    <!-- Status Berita  -->
                    <div class="row p-modal">
                        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-3">
                            <span>Status Berita</span>
                        </div>
                        <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
                            <span>:</span>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-8">
                            <span id="lihat_status_berita"></span>
                        </div>
                    </div>
                    <!-- Keterangan  -->
                    <div class="row p-modal">
                        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-3">
                            <span>Keterangan</span>
                        </div>
                        <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
                            <span>:</span>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-8">
                            <span id="lihat_keterangan"> - </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn bg-indigo col-white waves-effect" data-dismiss="modal">TUTUP</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-filter" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-indigo">
                <h4 class="modal-title">FILTER</h4>
            </div>
            <form id="form-filter">
                <div class="modal-body">

                    <div class="form-group form-float">
                        <div class="form-line">
                            <div class="col-md-6">
                                <input type="text" id="filter_tanggal_awal" class="form-control datepicker" placeholder="Tanggal Mulai">
                            </div>
                            <div class="col-md-6">
                                <input type="text" id="filter_tanggal_akhir" class="form-control datepicker" placeholder="Tanggal Akhir">
                            </div>
                        </div>
                    </div>
                    <div class="form-group form-float">
                        <div class="form-line">
                            <select id="filter_bulan" class="form-control">
                                <option value=""> - Pilih Bulan - </option>
                                <option value="1">Januari</option>
                                <option value="2">Februari</option>
                                <option value="3">Maret</option>
                                <option value="4">April</option>
                                <option value="5">Mei</option>
                                <option value="6">Juni</option>
                                <option value="7">Juli</option>
                                <option value="8">Agustus</option>
                                <option value="9">September</option>
                                <option value="10">Oktober</option>
                                <option value="11">November</option>
                                <option value="12">Desember</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group form-float">
                        <div class="form-line">
                            <select id="filter_tahun" class="form-control">
                                <option value=""> - Pilih Tahun - </option>
                                <option value="2020">2020</option>
                                <option value="2021">2021</option>
                            </select>
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
                    <button type="button" class="btn bg-indigo col-white waves-effect" data-dismiss="modal">BATAL</button>
                    <button id="btn-filter" type="button" class="btn bg-green col-white waves-effect waves-blue">CARI</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-export" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-indigo">
                <h4 class="modal-title">Export</h4>
            </div>
            {{form_open('berita/export', ['id'=>'form-export'])}}
            <div class="modal-body">
                <div class="form-group form-float">
                    <div class="form-line">
                        <select id="export_bulan" name="export_bulan" class="form-control">
                            <option value=""> - Pilih Bulan - </option>
                            <option value="1">Januari</option>
                            <option value="2">Februari</option>
                            <option value="3">Maret</option>
                            <option value="4">April</option>
                            <option value="5">Mei</option>
                            <option value="6">Juni</option>
                            <option value="7">Juli</option>
                            <option value="8">Agustus</option>
                            <option value="9">September</option>
                            <option value="10">Oktober</option>
                            <option value="11">November</option>
                            <option value="12">Desember</option>
                        </select>
                    </div>
                </div>
                <div class="form-group form-float">
                    <div class="form-line">
                        <select id="export_tahun" name="export_tahun" class="form-control">
                            <option value=""> - Pilih Tahun - </option>
                            <option value="2020">2020</option>
                            <option value="2021">2021</option>
                        </select>
                    </div>
                </div>
                <div class="form-group form-float">
                    <div class="form-line">
                        <select id="export_status" name="export_status" class="form-control">
                            <option value=""> - Pilih Status Berita - </option>
                            <option value="valid">Valid</option>
                            <option value="oke">Draft Valid</option>
                            <option value="belum">Belum Valid</option>
                        </select>
                    </div>
                </div>
                <div class="form-group form-float">
                    <div class="form-line">
                        <div class="col-md-6">
                            <input type="text" id="export_tanggal_awal" name="export_tanggal_awal" class="form-control datepicker" placeholder="Tanggal Mulai">
                        </div>
                        <div class="col-md-6">
                            <input type="text" id="export_tanggal_akhir" name="export_tanggal_akhir" class="form-control datepicker" placeholder="Tanggal Akhir">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn bg-red col-white waves-effect" data-dismiss="modal">BATAL</button>
                <button type="submit" class="btn bg-green  col-white waves-effect waves-blue">EXPORT</button>
            </div>
            {{form_close()}}
        </div>
    </div>
</div>