@extends("base.main_base")
@section("content")
@section('title','Berita')

<div class="container-fluid">
    <!-- Breadcrumb  -->
    <div class="block-header">
        <ol class="breadcrumb">
            <li>HOME</li>
            <li class="active">DAFTAR LAPORAN BERITA</li>
        </ol>
    </div>
    <!-- end breadcrumb -->

    <!-- Table -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        {{$title}}
                    </h2>
                    <ul class="header-dropdown m-r--5">
                        <li>
                            <div class="icon-button-demo align-right m-b--25">
                                <button title="Tambah" type="button" class="btn bg-blue btn-block btn-xs waves-effect" data-toggle="modal" data-target="#modal-draft">
                                    <i class="col-white material-icons">control_point</i>
                                </button>
                            </div>
                        </li>
                        <li>
                            <div class="icon-button-demo align-right m-b--25">
                                <button type="button" class="btn bg-blue btn-block btn-xs waves-effect" title="Export PDF" data-toggle="modal" data-target="#modal-export">
                                    <i class="col-white material-icons">picture_as_pdf</i> 
                                </button>
                            </div>
                            <!-- <a data-toggle="modal" data-target="#modal-draft" role="button" aria-haspopup="true" aria-expanded="false">
                                <i class="material-icons">note_add</i>
                            </a> -->
                        </li>
                        <li>
                            <div class="icon-button-demo align-right m-b--25">
                                <button title="Filter" type="button" class="btn bg-blue btn-block btn-xs waves-effect waves-light-blue" data-toggle="modal" data-target="#modal-filter">
                                    <i class="col-white material-icons">filter_list</i>
                                </button>
                            </div>
                        </li>
                        <li>
                            <div class="icon-button-demo align-right m-b--25">
                                <button title="Refresh" id="btn-reset" type="button" class="btn bg-blue btn-block btn-xs waves-effect waves-light-blue">
                                    <i class="col-white material-icons">replay</i>
                                </button>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table id="table" class="table table-bordered table-striped table-hover display wrap" width="100%">
                            <thead>
                                <tr>
                                    <th width="5%">No</th>
                                    <th class="text-center" width="10%">Tanggal</th>
                                    <th>Judul Berita</th>
                                    <th width="20%">File</th>
                                    <th class="text-center" width="10%">Status</th>
                                    <th class="text-center" width="15%">Aksi</th>
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
                    data.awal = $('#filter_tanggal_awal').val();
                    data.akhir = $('#filter_tanggal_akhir').val();
                    data.bulan = $('#filter_bulan').val();
                    data.tahun = $('#filter_tahun').val();
                    data.status_berita = $('#filter_status_berita').val();
                }
            },


            "columnDefs": [{
                    "targets": [0, 4, 5],
                    "orderable": false,
                    "class": "text-center"

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
                    $('#lihat_judul_berita').html(data.judul_berita);
                    $('#lihat_narasi_berita').html(data.narasi_berita);
                    $('#lihat_jumlah_view').html(data.jumlah_view);
                    $('#lihat_dibuat_tanggal').html(data.dibuat_tanggal);
                    $('#lihat_dibuat_pukul').html(data.dibuat_pukul);
                    $('#lihat_oleh').html(data.diperiksa_oleh);
                    $('#lihat_pada').html(data.diperiksa_pada);
                    $('#lihat_keterangan').html(data.keterangan);
                    if (data.status_berita == 'valid') {
                        $('#lihat_screenshoot').html('<a href="{{site_url()}}upload/berita/' + data.file + '" target="_blank" class="thumbnail"> <img class="img-responsive" src="{{site_url()}}upload/berita/' + data.file + '" width="200px" height="200px"></a>');
                        $('#lihat_link_berita').html('<a href="' + data.link_berita + '" target="_blank">' + data.link_berita + '</a>');
                        $('#lihat_keterangan').html("-");
                        $('#lihat_status_berita').html('<span class="badge bg-green">Valid</span>');
                    } else if (data.status_berita == 'oke') {
                        $('#lihat_status_berita').html('<span class="badge bg-blue">Draft Disetujui</span>');
                        if (data.file == '') {
                            $('#lihat_screenshoot').html('<span class="badge bg-red">Anda belum upload screenshot</span>');
                        } else {
                            $('#lihat_screenshoot').html('<a href="{{site_url()}}upload/berita/' + data.file + '" target="_blank" class="thumbnail"> <img class="img-responsive" src="{{site_url()}}upload/berita/' + data.file + '" width="200px" height="200px"></a>');
                        }
                        if (data.link_berita == '') {
                            $('#lihat_link_berita').html('<span class="badge bg-red">Anda belum upload link</span>');
                        } else {
                            $('#lihat_link_berita').html('<a href="' + data.link_berita + '" target="_blank">' + data.link_berita + '</a>');

                        }
                    } else {
                        $('#lihat_status_berita').html('<span class="badge bg-red">Draft Belum Valid</span>');
                        $('#link').hide();
                        $('#sharing').hide();
                        $('#view').hide();
                        $('#screenshot').hide();
                    }
                }
            });
        });

        $('#table').on('click', '.ubah', function() {
            var id_berita;
            if ($(this).data('status') == 'belum') {
                $('#modal-ubah-draft').modal('show');
                $("#edit_id_berita2").val($(this).data('id'));
                id_berita = $('#edit_id_berita2').val();
            } else {
                $('#modal-ubah').modal('show');
                $("#edit_id_berita").val($(this).data('id'));
                id_berita = $('#edit_id_berita').val();
            }

            $.ajax({
                type: "POST",
                url: "{{base_url('Berita/fetch_data')}}",
                data: {
                    id_berita: id_berita,
                },
                dataType: "JSON",
                success: function(data) {
                    $('#ubah_link_berita').val(data.link_berita);
                    $('#ubah_jumlah_view').val(data.jumlah_view);
                    $('#ubah_judul').val(data.judul_berita);
                    $('#ubah_narasi').val(data.narasi_berita);
                    $('#file_lama_view').html('<a href="{{site_url()}}upload/berita/'+"{{$this->session->userdata('username')}}"+'/'+id_berita+'/' + data.file + '" target="_blank" class="thumbnail"> <img class="img-responsive" src="{{site_url()}}upload/berita/'+"{{$this->session->userdata('username')}}"+'/'+id_berita+'/' + data.file + '" width="200px" height="200px"></a>');
                    $('#file_lama').val(data.file);
                    $('#check_fb').val('Facebook').prop('checked', false);
                    $('#check_twitter').val('Twitter').prop('checked', false);
                    $('#check_wa').val('Whatsapp').prop('checked', false);
                    $('#check_line').val('Line').prop('checked', false);
                    var result = data.share.split(", ");
                    for (var i = 0; i < result.length; i++) {
                        if (result[i] == "Facebook") {
                            $('#check_fb').prop('checked', true);
                        }
                        if (result[i] == "Twitter") {
                            $('#check_twitter').prop('checked', true);
                        }
                        if (result[i] == "Whatsapp") {
                            $('#check_wa').prop('checked', true);
                        }
                        if (result[i] == "Line") {
                            $('#check_line').prop('checked', true);
                        }
                    }


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


        $('#form-draft').submit('click', function() {
            $.ajax({
                type: "POST",
                url: "{{base_url('berita/draft')}}",
                data: new FormData(this),
                processData: false,
                contentType: false,
                cache: false,
                async: false,
                success: function(data) {
                    $('#judul_berita').val("");
                    $('#narasi_berita').val("");
                    $('#modal-draft').modal('hide');
                    toastr.success('Draft berita berhasil ditambahkan!');
                    table.ajax.reload();
                },
                error: function(data) {
                    toastr.warning('Draft berita gagal ditambahkan!');
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

        $('#form-ubah-draft').submit('click', function() {
            $.ajax({
                type: "POST",
                url: "{{base_url('berita/ubah_draft')}}",
                data: new FormData(this),
                processData: false,
                contentType: false,
                cache: false,
                async: false,
                success: function(data) {
                    $('#modal-ubah-draft').modal('hide');
                    toastr.success('Draft berita berhasil diubah!');
                    table.ajax.reload();
                },
                error: function(data) {
                    toastr.warning('Draft berita gagal diubah!');
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
