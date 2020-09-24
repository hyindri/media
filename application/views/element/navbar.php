<!-- Search Bar -->
<div class="search-bar">
    <div class="search-icon">
        <i class="material-icons">search</i>
    </div>
    <input type="text" placeholder="START TYPING...">
    <div class="close-search">
        <i class="material-icons">close</i>
    </div>
</div>
<!-- #END# Search Bar -->
<!-- Top Bar -->
<nav class="navbar">
    <div class="container-fluid">
        <div class="navbar-header">
            <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
            <a href="javascript:void(0);" class="bars"></a>
            <a class="navbar-brand" href="{{site_url('/')}}">SIMADU</a>
        </div>
        <div class="collapse navbar-collapse" id="navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
                <!-- Call Search -->
                <!-- <li><a href="javascript:void(0);" class="js-search" data-close="true"><i class="material-icons">search</i></a></li> -->
                <!-- #END# Call Search -->
                <!-- Notifications -->
                <li class="dropdown">
                    @if($jumlah_notif > 0)
                    <a href="javascript:void(0);" class="ubah_notif dropdown-toggle" data-toggle="dropdown" role="button">
                        <i class="material-icons">notifications</i>
                        <span class="hilang_notif label-count">{{$jumlah_notif}}</span>
                    </a>
                    @else
                    <a href="javascript:void(0);" class="ubah_notif dropdown-toggle" data-toggle="dropdown" role="button">
                        <i class="material-icons">notifications</i>
                    </a>
                    @endif
                    <ul class="h-ul dropdown-menu">
                        <li class="header">NOTIFIKASI</li>
                        <li class="body">
                            <ul class="menu">
                                <li>
                                    @foreach ($notif->result() as $a)
                                    <a href="{{site_url().$a->link}}">
                                        <div class="menu-info">
                                            <h4>{{$a->judul}}</h4>
                                            <p style="color:black;">{{$a->pesan}}</p>
                                            <p>
                                                <i class="material-icons">access_time</i> {{tanggal($a->dibuat_tanggal)}} / {{date('h:i:s',strtotime($a->dibuat_pukul))}}
                                            </p>
                                        </div>
                                    </a>
                                    @endforeach
                                </li>
                            </ul>
                        </li>
                    </ul>
        </div>
    </div>
</nav>
<!-- #Top Bar -->