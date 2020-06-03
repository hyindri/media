@extends('base.auth_base')
@section('content')
<div class="card">
    <div class="body">
        <form id="forgot_password" method="POST" action="{{site_url('auth/forgotpassword')}}">
            <div class="msg">
                Masukkan password terbaru anda.
            </div>
            <div class="input-group">
                <div class="form-line">
                    <input type="email" class="form-control" name="email" placeholder="Username" required autofocus>
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