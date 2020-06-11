<div class="modal fade" id="modal-draft" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-indigo">
                <h4 class="modal-title">Tambah Draft Berita</h4>
            </div>
            {{form_open('',['id'=>'form-draft','role'=>'form'])}}
            <div class="modal-body">
                <label class="form-label">Judul berita</label>
                <div class="form-group form-float">
                    <div class="form-line">
                        <textarea id="judul_berita" name="judul_berita" class="form-control" required></textarea>
                    </div>
                </div>
                <label class="form-label">Narasi berita</label>
                <div class="form-group form-float">
                    <div class="form-line">
                        <textarea id="narasi_berita" name="narasi_berita" class="form-control" rows="17"></textarea>
                    </div>
                </div>
                <label class="form-label">Upload File</label>
                <div class="form-group form-float">
                    <div class="form-line">
                        {{form_input($file_berita)}}
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

<div class="modal fade" id="modal-ubah-draft" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-indigo">
                <h4 class="modal-title">Ubah Draft</h4>
            </div>
            {{form_open('',['id'=>'form-ubah-draft','role'=>'form'])}}
            <div class="modal-body">
                <input type="hidden" name="edit_id_draft" id="edit_id_draft" class="form-control" required>
                <label class="form-label">Judul berita</label>
                <div class="form-group">
                    <div class="form-line">
                        <textarea id="ubah_judul" name="ubah_judul" class="form-control" required></textarea>
                    </div>
                </div>
                <label class="form-label">Narasi berita</label>
                <div class="form-group">
                    <div class="form-line">
                        <textarea id="ubah_narasi" name="ubah_narasi" class="form-control" rows="17"></textarea>
                    </div>
                </div>
                <label class="form-label">Upload File</label>
                <div class="form-group">
                    <div class="form-line">
                        {{form_input($ubah_file_berita)}}
                        <input type="hidden" name="old_file" id="file_lama_draft" class="form-control">
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


<div class="modal fade" id="modal-ubah" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-indigo">
                <h4 class="modal-title">Ubah {{$title}}</h4>
            </div>
            {{form_open('',['id'=>'form-ubah','role'=>'form', 'enctype'=>'multipart/form-data'])}}
            <div class="modal-body">
                <input type="hidden" name="edit_id_berita" id="edit_id_berita" class="form-control" required>
                <label for="ubah_link_berita">Link Berita</label>
                <div class="form-group">
                    <div class="form-line">
                        <textarea name="ubah_link_berita" id="ubah_link_berita" class="form-control" placeholder="Link Berita" required></textarea>
                    </div>
                </div>
                <label>Dibagikan</label>
                <div class="form-group">
                    <div class="form-line">
                        @php
                        $no = 0;
                        @endphp
                        @foreach ($sosmed as $row)
                        @php $no++ @endphp
                        <input type="checkbox" name="check[]" id="check_{{$no}}" class="filled-in chk-col-indigo" value="{{$row->id}}">
                        <label for="check_{{$no}}"><img src="{{site_url()}}/upload/logo/{{$row->logo}}" width="20" height="20"> {{$row->nama}}</label>
                        @endforeach
                    </div>
                </div>
                <label for="ubah_jumlah_view">Jumlah View</label>
                <div class="form-group">
                    <div class="form-line">
                        <input name="ubah_jumlah_view" id="ubah_jumlah_view" class="form-control" placeholder="Jumlah orang yang melihat berita anda.." required>
                    </div>
                </div>
                <label for="ubah_file">File</label>
                <div class="form-group">
                    <div class="form-line">
                        <input type="file" name="file" id="ubah_file"  data-max-size="5e+6" class="form-control">
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
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8">
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
                    <div class="row p-modal sharing">
                        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-3">
                            <span>Dibagikan</span>
                        </div>
                        <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
                            <span>:</span>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-8 m-t-10">
                            <div class="row" id="lihat_share"></div>
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
                            <span id="lihat_jumlah_view"></span>
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
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-8">
                            <span id="lihat_file"></span>
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
                    <div class="row p-modal keterangan">
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
                    <label for="filter">Tanggal</label>
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
                    <label for="filter">Bulan</label>
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
                    <label for="filter">Tahun</label>
                    <div class="form-group form-float">
                        <div class="form-line">
                            <select id="filter_tahun" class="form-control">
                                <option value=""> - Pilih Tahun - </option>
                                <option value="2020">2020</option>
                                <option value="2021">2021</option>
                            </select>
                        </div>
                    </div>
                    <label for="filter">Status</label>
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
                <label for="filter">Tanggal</label>
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
                <label for="filter">Bulan</label>
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
                <label for="filter">Tahun</label>
                <div class="form-group form-float">
                    <div class="form-line">
                        <select id="export_tahun" name="export_tahun" class="form-control">
                            <option value=""> - Pilih Tahun - </option>
                            <option value="2020">2020</option>
                            <option value="2021">2021</option>
                        </select>
                    </div>
                </div>
                <label for="filter">Status Berita</label>
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

            </div>
            <div class="modal-footer">
                <button type="button" class="btn bg-red col-white waves-effect" data-dismiss="modal">BATAL</button>
                <button type="submit" class="btn bg-green  col-white waves-effect waves-blue">EXPORT</button>
            </div>
            {{form_close()}}
        </div>
    </div>
</div>