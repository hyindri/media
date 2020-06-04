<!-- <div class="modal fade" id="modal-lihat" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-indigo">
                <h4 class="modal-title">Detail {{$title}}</h4>
            </div>
            <div class="modal-body">
                {{form_open('',['id'=>'form-verif','role'=>'form'])}}
                {{form_input($id_berita)}}
                <table class="table">
                    <tr>
                        <td style="width: 20%">Nama Media</td>
                        <td style="width: 10px;">:</td>
                        <td colspan="6">
                            <p id="nama"></p>
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 20%">Link Berita</td>
                        <td style="width: 10px;">:</td>
                        <td colspan="6">
                            <div id="link_berita"></div>
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 20%">Share</td>
                        <td style="width: 10px;">:</td>
                        <td colspan="6">
                            <p id="share"></p>
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 20%">Jumlah View</td>
                        <td style="width: 10px;">:</td>
                        <td colspan="6">
                            <p id="jumlah_view"></p>
                        </td>
                    </tr>
                    <tr>
                        <td class="bg-indigo text-white text-center" style="width: 20%" colspan="6">DILAPORKAN</td>
                    </tr>
                    <tr>
                        <td style="width: 20%"> Tanggal</td>
                        <td style="width: 10px;">:</td>
                        <td>
                            <p id="dibuat_tanggal"></p>
                        </td>
                        <td style="width: 20%"> Pukul</td>
                        <td style="width: 10px;">:</td>
                        <td>
                            <p id="dibuat_pukul"></p>
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 20%">Screenshoot</td>
                        <td style="width: 10px;">:</td>
                        <td colspan="6">
                            <div id="screenshoot"></div>
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 20%">Keterangan belum Diverifikasi</td>
                        <td style="width: 10px;">:</td>
                        <td colspan="6">
                            <div>
                                <textarea id="keterangan" name="keterangan" class="form-control"></textarea>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 20%">Status Berita</td>
                        <td style="width: 10px;">:</td>
                        <td colspan="6">
                            <div class="demo-switch">
                                <div class="switch">
                                    <label><span class="text-danger">BELUM</span><input id="verif_status" name="verif_status" type="checkbox"><span class="lever switch-col-green"></span> <span class="text-success">OK</span></label>
                                </div>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">TUTUP</button>
                <button id="simpan_btn" type="submit" class="btn btn-link waves-effect">SIMPAN</button>
            </div>
            {{form_close()}}
        </div>
    </div>
</div> -->

<div class="modal fade" id="modal-lihat" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-indigo">
                <h4 class="modal-title">Detail {{$title}}</h4>
            </div>
            {{form_open('',['id'=>'form-verif','role'=>'form'])}}
            {{form_input($id_berita)}}

            <div class="modal-body">
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
                    <!-- Link Berita  -->
                    <div class="row p-modal">
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
                    <div class="row p-modal">
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
                    <div class="row p-modal">
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
                        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-2">
                            <span>Tanggal</span>
                        </div>
                        <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
                            <span>:</span>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-3">
                            <span id="dibuat_tanggal"></span>
                        </div>
                        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-2">
                            <span>Pukul</span>
                        </div>
                        <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
                            <span>:</span>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-3">
                            <span id="dibuat_pukul"></span>
                        </div>
                    </div>
                    <!-- Screenshoot -->
                    <div class="row p-modal">
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
                            <span>Keterangan belum Diverifikasi</span>
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
                            <span>Status Berita</span>
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
                <button type="button" class="btn btn-link bg-red col-white waves-effect" data-dismiss="modal">TUTUP</button>
                <button id="simpan_btn" type="submit" class="btn btn-link bg-green col-white waves-effect">SIMPAN</button>
            </div>
            {{form_close()}}
        </div>
    </div>
</div>