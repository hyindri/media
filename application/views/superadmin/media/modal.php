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
                            <select id="filter_status" class="form-control">
                                <option value=""> - Pilih status - </option>
                                <option value="aktif">Aktif</option>
                                <option value="registrasi">Registrasi</option>
                                <option value="suspend">Suspend</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group form-float">
                        <div class="form-line">
                            <select id="filter_tipe_media_massa" class="form-control">
                                <option value=""> - Pilih tipe media massa - </option>
                                <option value="cetak">Cetak</option>
                                <option value="online">Online</option>
                                <option value="radio">Radio</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group form-float">
                        <div class="form-line">
                            <select id="filter_tipe_publikasi" class="form-control">
                                <option value=""> - Pilih tipe publikasi - </option>
                                <option value="harian">Harian</option>
                                <option value="mingguan">Mingguan</option>
                                <option value="bulanan">Bulanan</option>
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