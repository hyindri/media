@extends('base.auth_base')
@section('content')
<div class="card col-12">
    <div class="body">
        <form id="sign_up" method="POST" action="{{site_url('auth/signup')}}">
            <div class="msg">Pendaftaran Akun</div>
            <div class="form-group">
                <div class="form-line">
                    <input type="text" class="form-control" name="nama" placeholder="Nama" required autofocus>
                </div>
            </div>
            <div class="form-group">
                <div class="form-line">
                    <input type="text" class="form-control" name="perusahaan" placeholder="Perusahaan" required autofocus>
                </div>
            </div>    
            <div class="form-group">
                <div class="form-line">
                    <input type="text" class="form-control" name="pemimpin" placeholder="Pemimpin" required autofocus>
                </div>
            </div>
            <div class="form-group">
                <div class="form-line">
                    <input type="text" class="form-control" name="no_telp" placeholder="No. Telp" required autofocus>
                </div>
            </div>
            <div class="form-group">
                <div class="form-line">
                    <select class="form-control" name="tipe_publikasi" id="tipe_publikasi" required autofocus>
                    <option value="harian">Harian</option>
                    <option value="mingguan">Mingguan</option>
                    <option value="bulanan">Bulanan</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <div class="form-line">
                    <select class="form-control show-tick" name="tipe_media_massa[]" id="tipe_media_massa" required autofocus multiple>
                    <option value="cetak">Cetak</option>
                    <option value="online">Online</option>
                    <option value="radio">Radio</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <div class="form-line">
                    <input type="text" class="form-control" name="username" placeholder="Username" required autofocus>
                </div>
            </div>
            <div class="form-group">
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