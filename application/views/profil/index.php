@extends('base.main_base')
@section('content')
<div class="container-fluid">
            <div class="row clearfix">
                <div class="col-xs-12 col-sm-3 col-lg-3">
                    <div class="card profile-card">
                        <div class="profile-header">&nbsp;</div>
                        <div class="profile-body">
                            <div class="image-area">
                                <img src="{{APP_ASSETS}}images/user-lg.jpg" alt="AdminBSB - Profile Image" />
                            </div>
                            <div class="content-area">
                                <h3>{{$this->session->userdata('nama')}}</h3>
                                <p>Tipe Media Massa</p>                                
                                <p>Tipe Publikasi</p>  
                                <p>Status : {{$this->session->userdata('status')}}</p>                                    
                            </div>
                        </div>                       
                    </div>
                </div>
                <div class="col-xs-12 col-sm-9 col-lg-9">                
                <div class="card card-about-me">
                        <div class="header">
                            <h2>Profil Media</h2>
                        </div>
                        <div class="body">
                            <ul>
                                <li>
                                    <div class="title">
                                        <i class="material-icons">person</i>
                                        Username
                                    </div>
                                    <div class="content">
                                        {{$this->session->userdata('username')}}
                                    </div>
                                </li>
                                <li>
                                    <div class="title">
                                        <i class="material-icons">vpn_key</i>
                                        Password
                                    </div>
                                    <div class="pull-right">
                                    <a href="{{site_url('profil/ubahpassword')}}">Ubah Password</a>
                                    </div>
                                    <div class="content">
                                       ••••••••••••••
                                    </div>                                    
                                </li>                                
                                <li>
                                    <div class="title">
                                        <i class="material-icons">person</i>
                                        Pemilik
                                    </div>     
                                    <div class="content">
                                        Malibu, California
                                    </div>                                    
                                </li>     
                                <li>
                                    <div class="title">
                                        <i class="material-icons">credit_card</i>
                                        NIK Pemilik
                                    </div>     
                                    <div class="content">
                                        Malibu, California
                                    </div>                                    
                                </li>     
                                <li>
                                    <div class="title">
                                        <i class="material-icons">credit_card</i>
                                        NPWP
                                    </div>     
                                    <div class="content">
                                        Malibu, California
                                    </div>                                    
                                </li> 
                                <li>
                                    <div class="title">
                                        <i class="material-icons">calendar_today</i>
                                        Mulai MOU
                                    </div>     
                                    <div class="content">
                                        Malibu, California
                                    </div>                                    
                                </li> 
                                <li>
                                    <div class="title">
                                        <i class="material-icons">calendar_today</i>
                                        Akhir MOU
                                    </div>     
                                    <div class="content">
                                        Malibu, California
                                    </div>                                    
                                </li> 
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection