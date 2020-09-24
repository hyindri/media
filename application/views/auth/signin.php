@extends('base.auth_base')
@section('content')
<div class="card">
    <div class="body sign">
        <form id="sign_in" method="POST" action="{{site_url('auth')}}">
            <div class="msg">Login</div>         
              
            {{$this->session->flashdata('message')}}
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
                    <input type="password" class="form-control" name="password" placeholder="Password" required>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 p-t-5">
                    <button class="btn btn-block bg-indigo waves-effect waves-light-blue" type="submit">LOGIN</button>
                </div>
            </div>
            <div class="row m-t-15 m-b--20">
                <div class="col-xs-12">
                    <a class="text-center" href="<?= site_url('auth/signup') ?>">Daftar Akun Baru</a>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection
