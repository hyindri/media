<div class="modal fade" id="modal-lihat" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="defaultModalLabel">Lihat {{$title}}</h4>
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
                        <td class="bg-primary text-white text-center" style="width: 20%" colspan="6">DILAPORKAN</td>
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
</div>