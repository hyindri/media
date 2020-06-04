@extends('base.main_base')
@section('content')
@section('title','Ubah Password')
<div class="col-lg-6">
	<div class="card">
		<div class="body">
			<form id="forgot_password" method="POST" action="{{site_url('auth/changepassword')}}">
            <input type="hidden" name="id" value="{{$this->session->userdata('id')}}">
				<h4>
					Ubah Password
                </h4>
				<div class="input-group">
					<div class="form-line">
						<input type="password" class="form-control" name="new_password"
							placeholder="Masukkan Password Terbaru Anda" required autofocus>
					</div>
				</div>
				<button class="btn btn-block btn-lg bg-pink waves-effect" type="submit">Simpan</button>
				<div class="row m-t-20 m-b--5 align-center">
					<a href="{{site_url('profil')}}">Batal</a>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection