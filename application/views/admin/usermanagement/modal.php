<div class="modal fade" id="modal-ubah" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-indigo">
                <h4 class="modal-title" id="defaultModalLabel">Ubah User</h4>
            </div>
            {{form_open('',['id' => 'ubah-user','role'=>'form'])}}
                <div class="modal-body">
                    <div class="form-group" hidden>
                        <div class="form-line">
                            <input type="text" name="edit_id" id="edit_id" class="form-control" hidden>
                        </div>
                    </div>
                    <div class="form-group">
                        <select name="edit_status" id="edit_status" class="form-control show-tick" required>
                            <option value="">-- Pilih Status --</option>
                            <option value="aktif">Aktif</option>
                            <option value="suspend">Suspend</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <div class="form-line">
                            <input name="edit_mulai_mou" id="edit_mulai_mou" class="form-control datepicker" placeholder="Mulai MOU" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-line">
                            <input name="edit_akhir_mou" id="edit_akhir_mou" class="form-control datepicker" placeholder="Akhir MOU" required>
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