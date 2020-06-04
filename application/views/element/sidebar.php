<section>
	<!-- Left Sidebar -->
	<aside id="leftsidebar" class="sidebar">
		<!-- User Info -->
		<div class="user-info">
			<div class="image">
				<img src="{{APP_ASSETS}}images/person.svg" width="48" height="48" alt="User" />
			</div>
			<div class="info-container">
				<div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					{{$this->session->userdata('username')}}</div>
				<div class="email">{{$this->session->userdata('status')}}</div>
				<div class="btn-group user-helper-dropdown">
					<i class="material-icons" data-toggle="dropdown" aria-haspopup="true"
						aria-expanded="true">keyboard_arrow_down</i>
					<ul class="dropdown-menu pull-right">
						<li><a href="{{site_url('profil')}}"><i class="material-icons">person</i>Profile</a></li>
						<li role="separator" class="divider"></li>
						<li><a href="{{site_url('auth/logout')}}"><i class="material-icons">exit_to_app</i>Logout</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
		<!-- #User Info -->
		<!-- Menu -->
		<div class="menu">
			<ul class="list">
				<li class="header">MENU</li>
				<li>
					<a href="{{site_url('dashboard')}}">
						<i class="material-icons">home</i>
						<span>Dashboard</span>
					</a>
				</li>
				<li>
					<a href="{{site_url('berita')}}">
						<i class="material-icons">article</i>
						<span>Berita</span>
					</a>
				</li>
				<li>
					<a href="{{site_url('agenda')}}">
						<i class="material-icons">event</i>
						<span>Agenda</span>
					</a>
				</li>
				@if($this->session->userdata('level') == 'user')
				<li>
					<a href="{{site_url('profil')}}">
						<i class="material-icons">person</i>
						<span>Profil</span>
					</a>
				</li>
				@elseif($this->session->userdata('level') == 'admin')
				<li>
					<a href="{{site_url('usermanagement')}}">
						<i class="material-icons">group</i>
						<span>Manajemen Akun</span>
					</a>
				</li>
				<li>
					<a href="{{site_url('profil/ubahpassword')}}">
						<i class="material-icons">vpn_key</i>
						<span>Ubah Password</span>
					</a>
				</li>
				@endif
				<li>
					<a href="{{site_url('auth/logout')}}">
						<i class="material-icons">exit_to_app</i>
						<span>Logout</span>
					</a>
				</li>
			</ul>
		</div>
		<!-- #Menu -->
		@include('element.footer')
	</aside>
	<!-- #END# Left Sidebar -->
</section>
