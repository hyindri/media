@extends('base.auth_base')
@section('content')
<div class="card">
    <div class="body">
        <form id="sign_up" method="POST" action="{{site_url('auth/signup')}}">
            <div class="msg">Pendaftaran Akun</div>
            <div class="input-group">
                <span class="input-group-addon">
                    <i class="material-icons">person</i>
                </span>
                <div class="form-line">
                    <input type="text" class="form-control" name="nama" placeholder="Nama" required autofocus>
                </div>
            </div>
            <div class="input-group">
                <span class="input-group-addon">
                    <i class="material-icons">person</i>
                </span>
                <div class="form-line">
                    <input type="text" class="form-control" name="nik" placeholder="NIK" required autofocus>
                </div>
            </div>
            <div class="input-group">
                <span class="input-group-addon">
                    <i class="material-icons">confirmation_number</i>
                </span>
                <div class="form-line">
                    <input type="text" class="form-control" name="npwp" placeholder="NPWP" required autofocus>
                </div>
            </div>
            <div class="input-group">
                <span class="input-group-addon">
                    <i class="material-icons">person</i>
                </span>
                <div class="form-line">
                    <input type="text" class="form-control" name="pendiri" placeholder="Pendiri" required autofocus>
                </div>
            </div>
            <!-- <div class="input-group">
                <span class="input-group-addon">
                    <i class="material-icons">view_list</i>
                </span>
                <div class="form-line">
                    <select class="form-control" name="tipe_publikasi" id="tipe_publikasi" required autofocus>
                    <option value="">Pilih tipe publikasi</option>
                    <option value="harian">Harian</option>
                    <option value="mingguan">Mingguan</option>
                    <option value="bulanan">Bulanan</option>
                    </select>
                </div>
            </div> -->
            <div class="input-group">
                <span class="input-group-addon">
                    <i class="material-icons">view_list</i>
                </span>
                <div class="form-line">
                    <select class="form-control" name="tipe_media_massa" id="tipe_media_massa" required autofocus>
                    <option value="">Pilih tipe media massa</option>
                    <option value="cetak">Cetak</option>
                    <option value="online">Online</option>
                    <option value="cetak dan online">Cetak & Online</option>
                    </select>
                </div>
            </div>
            <div class="input-group">
                <span class="input-group-addon">
                    <i class="material-icons">date_range</i>
                </span>
                <div class="form-line">
                    <input name="mulai_mou" class="form-control datepicker" placeholder="Please choose a date..." required autofocus>
                </div>
            </div>
            <div class="input-group">
                <span class="input-group-addon">
                    <i class="material-icons">date_range</i>
                </span>
                <div class="form-line">
                    <input class="form-control datepicker" name="akhir_mou" placeholder="Please choose a date..." required autofocus>
                </div>
            </div>
            <div class="input-group">
                <span class="input-group-addon">
                    <i class="material-icons">person</i>
                </span>
                <div class="form-line">
                    <input type="text" class="form-control" name="username" placeholder="Username" required autofocus>
                </div>
            </div>
            <div class="input-group">
                <span class="input-group-addon">
                    <i class="material-icons">lock</i>
                </span>
                <div class="form-line">
                    <input type="password" class="form-control" name="password"  placeholder="Password" required autofocus>
                </div>
            </div>
            <button class="btn btn-block btn-lg bg-pink waves-effect" type="submit">SIGN UP</button>
            <div class="m-t-25 m-b--5 align-center">
                <a href="<?= site_url('auth') ?>">Kembali ke Halaman Login</a>
            </div>
        </form>
    </div>
</div>
@endsection

@section('js')
<script>
$('.datepicker').bootstrapMaterialDatePicker({
    time: false
});
</script>
@endsection