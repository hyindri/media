@extends('base.main_base')
@section('content')
@section('title','Profil')
<div class="container-fluid">
    <!-- Breadcrumb  -->
    <div class="block-header">
        <ol class="breadcrumb">
            <li>HOME</li>
            <li class="active">PROFIL</li>
        </ol>
    </div>
    <!-- end breadcrumb -->
    <div class="row clearfix">
        <div class="col-xs-12 col-sm-3 col-lg-3">
            <div class="card profile-card">
                <div class="profile-header">&nbsp;</div>
                <div class="profile-body">
                    <div class="image-area">
                        <img src="{{APP_ASSETS}}images/user-lg.jpg" alt="Gambar Profil" />
                    </div>
                    <div class="content-area">
                        <h3>{{$nama}}</h3>
                        <p>Tipe Media Massa : {{$tipe_mediamassa}}</p>
                        <p>Tipe Publikasi: {{$tipe_publikasi}}</p>
                        <p>Status : {{$status}}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-9 col-lg-9">
            <div class="card card-about-me">
                <div class="header">
                    @if($this->session->userdata('level') == 'user')
                    <a href="<?php echo site_url('profil/ubah/' . $this->session->userdata('id_user')); ?>" class="pull-right btn bg-indigo col-white">Ubah Informasi Profil</a>
                    @endif
                    <h2>Informasi Profil Media</h2>
                </div>
                <div class="body">
                    {{$this->session->flashdata('notif')}}
                    <ul>
                        @if($this->session->userdata('level') == 'user')
                        <li>
                            <div class="title">
                                <i class="material-icons">person</i>
                                Username
                            </div>
                            <div class="content">
                                {{$username}}
                            </div>
                        </li>
                        <li>
                            <div class="title">
                                <i class="material-icons">vpn_key</i>
                                Password
                            </div>
                            <div class="pull-right btn bg-indigo">
                                <a class="col-white deco-off"href="{{site_url('profil/ubahpassword')}}">Ubah Password</a>
                            </div>
                            <div class="content">
                                ••••••••••••••
                            </div>
                        </li>
                        @endif
                        <li>
                            <div class="title">
                                <i class="material-icons">domain</i>
                                Nama Perusahaan
                            </div>
                            <div class="content">
                                {{$perusahaan}}
                            </div>
                        </li>
                        <li>
                            <div class="title">
                                <i class="material-icons">location_on</i>
                                Alamat
                            </div>
                            <div class="content">
                                {{$alamat_per}}
                            </div>
                        </li>
                        <li>
                            <div class="title">
                                <i class="material-icons">person</i>
                                Pimpinan
                            </div>
                            <div class="content">
                                {{$pimpinan}}
                            </div>
                        </li>
                        <li>
                            <div class="title">
                                <i class="material-icons">account_balance_wallet</i>
                                Nomor Rekening
                            </div>
                            <div class="content">
                                {{$rekening}}
                            </div>
                        </li>
                        <li>
                            <div class="title">
                                <i class="material-icons">person</i>
                                Kabiro
                            </div>
                            <div class="content">
                                {{$kabiro}}
                            </div>
                        </li>
                        <li>
                            <div class="title">
                                <i class="material-icons">email</i>
                                Surat Kabiro
                            </div>
                            <div class="content">
                                {{$surat_kabiro}}
                            </div>
                        </li>
                        <li>
                            <div class="title">
                                <i class="material-icons">call</i>
                                Nomor Telepon
                            </div>
                            <div class="content">
                                {{$telp}}
                            </div>
                        </li>
                        <li>
                            <div class="title">
                                <i class="material-icons">camera_alt</i>
                                Wartawan
                            </div>
                            <div class="content">
                                {{$wartawan}}
                            </div>
                        </li>
                        <li>
                            <div class="title">
                                <i class="material-icons">description</i>
                                Sertifikat Uji
                            </div>
                            <div class="content">
                                {{$sertifikat}}
                            </div>
                        </li>
                        <li>
                            <div class="title">
                                <i class="material-icons">verified_user</i>
                                Verifikasi Pers
                            </div>
                            <div class="content">
                                {{$verifikasi}}
                            </div>
                        </li>
                        <li>
                            <div class="title">
                                <i class="material-icons">business_center</i>
                                Penawaran Kerja Sama
                            </div>
                            <div class="content">
                                {{$penawaran_kerjasama}}
                            </div>
                        </li>
                        <li>
                            <div class="title">
                                <i class="material-icons">credit_card</i>
                                NPWP
                            </div>
                            <div class="content">
                                {{$npwp}}
                            </div>
                        </li>
                        <li>
                            <div class="title">
                                <i class="material-icons">calendar_today</i>
                                Mulai MOU
                            </div>
                            <div class="content">
                                {{$mulai_mou}}
                            </div>
                        </li>
                        <li>
                            <div class="title">
                                <i class="material-icons">calendar_today</i>
                                Akhir MOU
                            </div>
                            <div class="content">
                                {{$akhir_mou}}
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection