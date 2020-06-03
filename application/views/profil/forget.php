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
<<<<<<< HEAD:application/views/profil/forget.php
                <a href="{{site_url('profil')}}">Batal</a>
=======
            <a href="<?= site_url('auth') ?>" id="to-recover" type="button"><i class="fa fa-lock m-r-5"></i> Sign in!</a>
>>>>>>> 9e0c757f3962d42d7d5ac0eb623dd40ffd509104:application/views/auth/forgotpassword.php
            </div>
        </form>
    </div>
</div>
@endsection