@extends('base.auth_base')
@section('content')
<div class="card">
    <div class="body">
        <form id="forgot_password" method="POST" action="{{site_url('auth/forgotpassword')}}">
            <div class="msg">
                Enter your email address that you used to register. We'll send you an email with your username and a
                link to reset your password.
            </div>
            <div class="input-group">
                <div class="form-line">
                    <input type="email" class="form-control" name="email" placeholder="Username" required autofocus>
                </div>
            </div>
            <button class="btn btn-block btn-lg bg-pink waves-effect" type="submit">RESET MY PASSWORD</button>
            <div class="row m-t-20 m-b--5 align-center">
            <a href="<?= site_url('auth') ?>" id="to-recover" type="button"><i class="fa fa-lock m-r-5"></i> Sign in!</a>
            </div>
        </form>
    </div>
</div>
@endsection