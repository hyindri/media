<div class="modal fade" id="modal-tambah" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-indigo">
                <h4 class="modal-title">Tambah Sosial Media</h4>
            </div>
            {{form_open('setting/tambah',['id' => 'tambah-sosmed','role'=>'form'])}}
            <div class="modal-body">
                <label for="nama">Nama Sosial Media</label>
                <div class="form-group">
                    <div class="form-line">
                        <input type="text" name="nama" id="nama" class="form-control" placeholder="Nama.." required>
                    </div>
                </div>
                <label for="nama">Logo </label>
                <div class="form-group">
                    <div class="form-line">
                        <input type="file" name="file" id="file" class="form-control">
                        <span class="text-danger">*Sebaiknya tipe PNG</span>

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn bg-red col-white" data-dismiss="modal">BATAL</button>
                <button type="submit" class="btn bg-green col-white">SIMPAN</button>
            </div>
            {{form_close()}}
        </div>
    </div>
</div>

<div class="modal fade" id="modal-ubah" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-indigo">
                <h4 class="modal-title" id="defaultModalLabel">Ubah Sosmed</h4>
            </div>
            {{form_open('',['id' => 'ubah-sosmed','role'=>'form'])}}
            <div class="modal-body">
                <div class="form-group" hidden>
                    <div class="form-line">
                        <input type="text" name="edit_id" id="edit_id" class="form-control" hidden>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-line">
                        <input type="text" name="edit_nama" id="edit_nama" class="form-control" placeholder="Nama.." required>
                    </div>
                </div>

                <div class="form-group">
                    <div class="form-line">
                        <input type="file" name="file" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-line">
                        <p>File lama</p>
                        <span id="file_lama"></span>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn bg-red col-white" data-dismiss="modal">BATAL</button>
                <button type="submit" class="btn bg-green col-white">SIMPAN</button>
            </div>
            {{form_close()}}
        </div>
    </div>
</div>