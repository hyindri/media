<div class="modal fade" id="modal-lihat" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-indigo">
                <h4 class="modal-title">Detail {{$title}}</h4>
            </div>
            {{form_open('',['id'=>'form-verif','role'=>'form'])}}
            <div class="modal-body">
                {{form_input($id_berita)}}

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
                            <span id="nama"></span>
                        </div>
                    </div>
                    <!-- Judul Berita  -->
                    <div class="row p-modal">
                        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-3">
                            <span>Judul Berita</span>
                        </div>
                        <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
                            <span>:</span>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-8">
                            <span id="judul_berita"></span>
                        </div>
                    </div>
                    <!-- Narasi Berita  -->
                    <div class="row p-modal">
                        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-3">
                            <span>Narasi Berita</span>
                        </div>
                        <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
                            <span>:</span>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-8">
                            <span id="narasi_berita"></span>
                        </div>
                    </div>
                    <!-- Link Berita  -->
                    <div class="row p-modal link">
                        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-3">
                            <span>Link Berita</span>
                        </div>
                        <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
                            <span>:</span>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-8">
                            <span id="link_berita"></span>
                        </div>
                    </div>
                    <!-- Share  -->
                    <div class="row p-modal share">
                        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-3">
                            <span>Share</span>
                        </div>
                        <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
                            <span>:</span>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-8">
                            <div id="share"></div>
                        </div>
                    </div>
                    <!-- Jumlah View  -->
                    <div class="row p-modal view">
                        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-3">
                            <span>Jumlah View</span>
                        </div>
                        <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
                            <span>:</span>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-8">
                            <span id="jumlah_view"></span>
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
                            <span id="dibuat_tanggal"></span>
                        </div>
                    </div>
                    <!-- File -->
                    <div class="row p-modal screenshot">
                        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-3">
                            <span>File</span>
                        </div>
                        <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
                            <span>:</span>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <span id="file"></span>
                        </div>
                    </div>
                    <!-- Keterangan belum di verifikasi -->
                    <div class="row p-modal keterangan">
                        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-3">
                            <span>Keterangan</span>
                        </div>
                        <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
                            <span>:</span>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <textarea id="keterangan" name="keterangan" rows="5" class="form-control"></textarea>
                        </div>
                    </div>
                    <!-- Status Draft -->
                    <div class="row p-modal status_berita">
                        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-3">
                            <span>Status Draft Berita</span>
                        </div>
                        <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
                            <span>:</span>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-8">
                            <div class="demo-switch">
                                <div class="switch">
                                    <label><span class="text-danger">BELUM</span><input id="verif_status" name="verif_status" type="checkbox"><span class="lever switch-col-green"></span> <span class="text-success">OK</span></label>
                                </div>
                            </div>
                        </div>
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
                            <select id="filter_nama" name="filter_nama" class="form-control show-tick">
                                <option value=""> - Pilih Nama Media - </option>
                                @foreach($media as $row)
                                <option value="{{$row->nama}}">{{$row->nama}}</option>
                                @endforeach
                            </select>
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
                                <input type="text" id="filter_tanggal_awal" class="form-control datepicker" placeholder="Tanggal Mulai">
                            </div>
                            <div class="col-md-6">
                                <input type="text" id="filter_tanggal_akhir" class="form-control datepicker" placeholder="Tanggal Akhir">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">

                    <button type="button" class="btn bg-red col-white waves-effect" data-dismiss="modal">BATAL</button>
                    <button id="btn-filter" type="button" class="btn bg-green  col-white waves-effect waves-blue">CARI</button>
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
                        <select id="export_nama" name="export_nama" class="form-control show-tick">
                            <option value=""> - Pilih Nama Media - </option>
                            @foreach($media as $row)
                            <option value="{{$row->nama}}">{{$row->nama}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
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