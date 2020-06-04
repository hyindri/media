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
                        <input name="ubah_share" id="ubah_share" class="form-control" placeholder="Dibagikan ke platform apa saja.." required>
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
                        <span id="file_lama"></span>
                        <input type="hidden" name="old_file" class="form-control">
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
                        <td style="width: 20%">Link Berita</td>
                        <td style="width: 10px;">:</td>
                        <td colspan="6">
                            <div id="lihat_link_berita"></div>
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 20%">Share</td>
                        <td style="width: 10px;">:</td>
                        <td colspan="6">
                            <p id="lihat_share"></p>
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 20%">Jumlah View</td>
                        <td style="width: 10px;">:</td>
                        <td colspan="6">
                            <p id="lihat_jumlah_view"></p>
                        </td>
                    </tr>

                    <tr>
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
                                <option value="oke">Valid</option>
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