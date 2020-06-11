<div class="modal fade" id="modal-tambah" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-indigo">
                <h4 class="modal-title">Tambah Jabatan</h4>
            </div>
            {{form_open('',['id' => 'tambah-jabatan','role'=>'form'])}}
            <div class="modal-body">
                <div class="form-group">
                    <div class="form-line">
                        <input type="text" name="nama_jabatan" id="nama_jabatan" class="form-control" placeholder="Nama Jabatan" required>
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
                <h4 class="modal-title" id="defaultModalLabel">Ubah Jabatan</h4>
            </div>
            {{form_open('',['id' => 'ubah-jabatan','role'=>'form'])}}
            <div class="modal-body">
                <div class="form-group" hidden>
                    <div class="form-line">
                        <input type="text" name="edit_id" id="edit_id" class="form-control" hidden>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-line">
                        <input type="text" name="edit_nama_jabatan" id="edit_nama_jabatan" class="form-control" placeholder="Judul" required>
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