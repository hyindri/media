@extends('base.auth_base')
@section('content')
<div class="card">
    <div class="body">
        <form id="forgot_password" method="POST">
            <div class="msg">
                Masukkan password terbaru anda.
            </div>
            <div class="input-group">
                <span class="input-group-addon">
                    <i class="material-icons">vpn_key</i>
                </span>
                <div class="form-line">
                    <input type="password" class="form-control" name="new_password" placeholder="Masukkan Password Baru" required autofocus>
                </div>
            </div>
            <button class="btn btn-block btn-lg bg-pink waves-effect" type="submit">Ubah Password</button>
            <div class="row m-t-20 m-b--5 align-center">
                <a href="{{site_url('profil')}}">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection