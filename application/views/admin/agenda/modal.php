<div class="modal fade" id="modal-tambah" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-indigo">
                <h4 class="modal-title">Tambah Agenda</h4>
            </div>
            {{form_open('',['id' => 'tambah-agenda','role'=>'form'])}}
            <div class="modal-body">
                <div class="form-group">
                    <div class="form-line">
                        <input type="text" name="judul" id="judul" class="form-control" placeholder="Judul" required>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-line">
                        <input name="tanggal" id="tanggal" class="form-control datepicker" placeholder="Tanggal" required>
                    </div>
                </div>
                <div class="form-group">
                    <select name="status" id="status" class="form-control show-tick" required>
                        <option value="">-- Pilih Status --</option>
                        <option value="aktif">Aktif</option>
                        <option value="nonaktif">Non Aktif</option>
                    </select>
                </div>
                <div class="form-group">
                    <div class="form-line">
                        <input type="file" name="file" id="file" class="form-control">
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
                <h4 class="modal-title" id="defaultModalLabel">Ubah Agenda</h4>
            </div>
            {{form_open('',['id' => 'ubah-agenda','role'=>'form'])}}
            <div class="modal-body">
                <div class="form-group" hidden>
                    <div class="form-line">
                        <input type="text" name="edit_id" id="edit_id" class="form-control" hidden>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-line">
                        <input type="text" name="edit_judul" id="edit_judul" class="form-control" placeholder="Judul" required>
                    </div>
                </div>

                <div class="form-group">
                    <div class="form-line">
                        <input name="edit_tanggal" id="edit_tanggal" class="form-control datepicker" placeholder="Tanggal" required>
                    </div>
                </div>
                <div class="form-group">
                    <select name="edit_status" id="edit_status" class="form-control show-tick" required>
                        <option value="">-- Pilih Status --</option>
                        <option value="aktif">Aktif</option>
                        <option value="nonaktif">Non Aktif</option>
                    </select>
                </div>
                <div class="form-group">
                    <div class="form-line">
                        <input type="file" name="file" class="form-control">
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