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
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-8">
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
                            <span id="share"></span>
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
                    <!-- Screenshoot -->
                    <div class="row p-modal screenshot">
                        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-3">
                            <span>Screenshoot</span>
                        </div>
                        <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
                            <span>:</span>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-8">
                            <span id="screenshoot"></span>
                        </div>
                    </div>
                    <!-- Keterangan belum di verifikasi -->
                    <div class="row p-modal">
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
                    <!-- Screenshoot -->
                    <div class="row p-modal">
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
                <button type="button" class="btn bg-red col-white waves-effect" data-dismiss="modal">TUTUP</button>
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
                            <select id="filter_nama" class="form-control show-tick">
                                <option value=""> - </option>
                                @foreach($media as $row)
                                <option value="{{$row->nama}}">{{$row->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

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
                    <button type="button" class="btn bg-red col-white waves-effect" data-dismiss="modal">BATAL</button>
                    <button id="btn-filter" type="button" class="btn bg-green  col-white waves-effect waves-blue">CARI</button>
                </div>
            </form>
        </div>
    </div>
</div>