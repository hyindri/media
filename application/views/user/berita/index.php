@extends("base.main_base")
@section("content")
@section('title','Berita')

<div class="container-fluid">
    <div class="block-header">
        <h2>
            Daftar {{$title}}
            <small>di Diskominfo <a href="https://datatables.net/" target="_blank">Kabupaten Bintan</a></small>
        </h2>
    </div>
    <!-- Basic Examples -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        {{$title}}
                    </h2>
                    <ul class="header-dropdown m-r--5">
                        <li>
                            <a data-toggle="modal" data-target="#modal-tambah" role="button" aria-haspopup="true" aria-expanded="false">
                                <i class="material-icons">note_add</i>
                            </a>
                        </li>
						<li class="dropdown">
							<a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
								<i class="material-icons">more_vert</i>
							</a>
							<ul class="dropdown-menu pull-right">
								<li><a data-toggle="modal" data-target="#modal-filter">Filter</a></li>
								<li><a id="btn-reset">Reset</a></li>
							</ul>
						</li>
                    </ul>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table id="table" class="table table-bordered table-striped table-hover display nowrap" width="100%">
                            <thead>
                                <tr>
                                    <th style="width:10px;">No</th>
                                    <th>Tanggal</th>
                                    <th>Judul Berita</th>
                                    <th>Screenshoot</th>
                                    <th>Dibagikan</th>
                                    <th>Jumlah View</th>
                                    <th>Status</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include("user.berita.modal")
@endsection

@section("js")
<script type="text/javascript">
    var table;
    $(document).ready(function() {
        table = $('#table').DataTable({
            "language": {
                "lengthMenu": "Tampilkan _MENU_ data per halaman",
                "infoEmpty": "Data dimana kamu",
                "zeroRecords": "Data tidak ada",
                "info": "Menampilkan halaman _PAGE_ dari _PAGES_",
                "infoFiltered": "(difilter dari _MAX_ total data)",
                "paginate": {
                    "first": "Pertama",
                    "last": "Terakhir",
                    "next": "Selanjutnya",
                    "previous": "Sebelumnya"
                },
            },
            "processing": true,
            "serverSide": true,
            "responsive": true,
            "searching": true,
            "info": true,
            "ordering": true,
            "order": [],

            "ajax": {
                "url": "{{site_url('berita/json')}}",
                "type": "POST",
                "data": function(data) {
                    data.dibuat_tanggal = $('#filter_tanggal').val();
                    data.status_berita = $('#filter_status_berita').val();
                }
            },


            "columnDefs": [{
                    "targets": [0, 7],
                    "orderable": false,
                },

            ],

        });

        $('#btn-filter').click(function() { 
            $('#modal-filter').modal('hide');
            table.ajax.reload(); 
        });
        $('#btn-reset').click(function() { 
            $('#form-filter')[0].reset();
            table.ajax.reload(); 
        });

        $('#table').on('click', '.lihat', function() {
            $('#modal-lihat').modal('show');

            $("#lihat_id_berita").val($(this).data('id'));
            let id_berita = $('#lihat_id_berita').val();

            $.ajax({
                type: "POST",
                url: "{{base_url('Berita/fetch_data')}}",
                data: {
                    id_berita: id_berita,
                },
                dataType: "JSON",
                success: function(data) {
                    $('#lihat_nama').html(data.nama);
                    $('#lihat_share').html(data.share);
                    $('#lihat_jumlah_view').html(data.jumlah_view);
                    $('#lihat_dibuat_tanggal').html(data.dibuat_tanggal);
                    $('#lihat_dibuat_pukul').html(data.dibuat_pukul);
                    $('#lihat_oleh').html(data.diperiksa_oleh);
                    $('#lihat_pada').html(data.diperiksa_pada);
                    $('#lihat_keterangan').html(data.keterangan);
                    $('#lihat_link_berita').html('<a href="' + data.link_berita + '" target="_blank">' + data.link_berita + '</a>');
                    $('#lihat_screenshoot').html('<a href="{{site_url()}}upload/berita/' + data.screenshoot + '" target="_blank" class="thumbnail"> <img class="img-responsive" src="{{site_url()}}upload/berita/' + data.screenshoot + '" width="200px" height="200px"></a>');
                    if (data.status_berita == 'oke') {
                        $('#lihat_keterangan').html("-");
                        $('#lihat_status_berita').html('<span class="badge bg-green">Valid</span>');
                    }else{
                        $('#lihat_status_berita').html('<span class="badge bg-red">Belum Valid</span>');
                    }
                }
            });
        });

        $('#table').on('click', '.ubah', function() {
            $('#modal-ubah').modal('show');

            $("#edit_id_berita").val($(this).data('id'));
            let id_berita = $('#edit_id_berita').val();

            $.ajax({
                type: "POST",
                url: "{{base_url('Berita/fetch_data')}}",
                data: {
                    id_berita: id_berita,
                },
                dataType: "JSON",
                success: function(data) {
                    $('#ubah_link_berita').val(data.link_berita);
                    $('#ubah_share').val(data.share);
                    $('#ubah_jumlah_view').val(data.jumlah_view);
                    $('#file_lama_view').html('<a href="{{site_url()}}upload/berita/' + data.screenshoot + '" target="_blank" class="thumbnail"> <img class="img-responsive" src="{{site_url()}}upload/berita/' + data.screenshoot + '" width="200px" height="200px"></a>');
                    $('#file_lama').val(data.screenshoot);
                }
            });
        });

        $('#table').on('click', '.hapus', function() {
            $('#modal-hapus').modal('show');
            $("#hapus_id_berita").val($(this).data('id'));
        });

        $('#form-tambah').submit('click', function() {
            $.ajax({
                type: "POST",
                url: "{{base_url('berita/tambah')}}",
                data: new FormData(this),
                processData: false,
                contentType: false,
                cache: false,
                async: false,
                success: function(data) {
                    $('#link_berita').val("");
                    $('#share').val("");
                    $('#jumlah_view').val("");
                    $('#file').val("");
                    $('#modal-tambah').modal('hide');
                    toastr.success('Laporan berita berhasil ditambahkan!');
                    table.ajax.reload();
                },
                error: function(data) {
                    toastr.warning('Laporan berita gagal ditambahkan!');
                    table.ajax.reload();
                }
            });
            return false;
        });


        $('#form-ubah').submit('click', function() {
            $.ajax({
                type: "POST",
                url: "{{base_url('berita/ubah')}}",
                data: new FormData(this),
                processData: false,
                contentType: false,
                cache: false,
                async: false,
                success: function(data) {
                    $('#modal-ubah').modal('hide');
                    toastr.success('Laporan berita berhasil diubah!');
                    table.ajax.reload();
                },
                error: function(data) {
                    toastr.warning('Laporan berita gagal diubah!');
                    table.ajax.reload();
                }
            });
            return false;
        });

        $('#form-hapus').submit('click', function() {
            $.ajax({
                type: "POST",
                url: "{{base_url('berita/hapus')}}",
                data: new FormData(this),
                processData: false,
                contentType: false,
                cache: false,
                async: false,
                success: function(data) {
                    $('#modal-hapus').modal('hide');
                    toastr.success('Laporan berita berhasil dihapus!');
                    table.ajax.reload();
                },
                error: function(data) {
                    toastr.warning('Laporan berita gagal dihapus!');
                    table.ajax.reload();
                }
            });
            return false;
        });


        $('.datepicker').bootstrapMaterialDatePicker({
            time: false
        });

    });
</script>
@endsection
