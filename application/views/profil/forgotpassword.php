@extends('base.main_base')
@section('content')
@section('title','Ubah Password')
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	<!-- Breadcrumb  -->
	<div class="block-header">
		<ol class="breadcrumb">
			<li>HOME</li>
			<li class="active">UBAH PASSWORD</li>
		</ol>
	</div>
	<!-- end breadcrumb -->
	<div class="row clearfix">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="card">
				<div class="header">
					<h2>Ubah Password</h2>
					<div class="body">
						<form id="forgot_password" method="POST" action="{{site_url('auth/changepassword')}}">
							<input type="hidden" name="id" value="{{$this->session->userdata('id_user')}}">
							<div class="input-group">
								<div class="form-line">
									<input type="password" class="form-control" name="new_password" placeholder="Masukkan Password Terbaru Anda" required autofocus>
								</div>
							</div>
							<div class="form-group align-right">
								<button class="btn bg-red col-white waves-effect waves-light-blue" type="button">BATAL</button>
								<button class="btn bg-green col-white waves-effect waves-light-blue" type="submit">SIMPAN</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection