@extends("base.main_base")
@section("content")
@section('title','Berita')

<div class="container-fluid">
    <!-- Breadcrumb  -->
    <div class="block-header">
        <ol class="breadcrumb">
            <li>HOME</li>
            <li class="active">DAFTAR BERITA</li>
        </ol>
    </div>
    <!-- end breadcrumb -->

    <!-- Table -->
    <div class="row clearfix">
        <div class="col-xs-12 col-md-12 col-sm-12 col-lg-12 ">
            <div class="card">
                <div class="header">
                    <h2>
                        {{$title}}
                    </h2>
                    <ul class="header-dropdown m-r--5">
                        <li>
                            <div class="icon-button-demo align-right m-b--25">
                            <a data-toggle="modal" data-target="#modal-export">
                                <button type="button" class="btn btn-primary waves-effect waves-light-blue">
                                    <i class="col-white material-icons">import_export</i><span>Export</span>
                                </button></a>
                            </div>
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
                        <table id="table" class="table table-bordered table-striped table-hover display wrap" width="100%">
                            <thead>
                                <tr>
                                    <th style="width:10px;">No</th>
                                    <th>Tanggal</th>
                                    <th>Nama Media</th>
                                    <th>Judul Berita</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- End table  -->
    </div>
    @include("admin.berita.modal")
    @endsection

    @section("js")
    <script type="text/javascript">
        $(document).ready(function() {
            var table;
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
                "responsive": true,
                "serverSide": true,
                "searching": false,
                "info": true,
                "ordering": true,
                "order": [],

                "ajax": {
                    "url": "{{site_url('berita/json')}}",
                    "type": "POST",
                    "data": function(data) {
                        data.nama = $('#filter_nama').val();
                        data.awal = $('#filter_tanggal_awal').val();
                        data.akhir = $('#filter_tanggal_akhir').val();
                        data.bulan = $('#filter_bulan').val();
                        data.tahun = $('#filter_tahun').val();
                        data.status_berita = $('#filter_status_berita').val();
                    }
                },
                "columnDefs": [{
                        "targets": [0, 5],
                        "orderable": false,
                    },
                    {
                        "targets": [4, 5],
                        "class": "text-center",
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

            $('#table').on('click', '.verif', function() {
                $('#modal-lihat').modal('show');
                $("#id_berita").val($(this).data('id'));
                let id_berita = $('#id_berita').val();

                $.ajax({
                    type: "POST",
                    url: "{{base_url('Berita/fetch_data')}}",
                    data: {
                        id_berita: id_berita,
                    },
                    dataType: "JSON",
                    success: function(data) {
                        $('#nama').html(data.nama);
                        $('#share').html(data.share);
                        $('#jumlah_view').html(data.jumlah_view);
                        $('#judul_berita').html(data.judul_berita);
                        $('#narasi_berita').html(data.narasi_berita);
                        $('#dibuat_tanggal').html(data.dibuat_tanggal + ' : ' + data.dibuat_pukul);
                        $('#keterangan').val(data.keterangan);
                        $('#link_berita').html('<a href="' + data.link_berita + '" target="_blank">' + data.link_berita + '</a>');
                        $('#screenshoot').html('<a href="{{site_url()}}upload/berita/' + data.screenshoot + '" target="_blank" class="thumbnail"> <img class="img-responsive" src="{{site_url()}}upload/berita/' + data.screenshoot + '" width="200px" height="200px"></a>');
                        if (data.status_berita == 'valid') {
                            $('#link_berita').html('<a href="' + data.link_berita + '" target="_blank">' + data.link_berita + '</a>');
                            $('#screenshoot').html('<a href="{{site_url()}}upload/berita/' + data.screenshoot + '" target="_blank" class="thumbnail"> <img class="img-responsive" src="{{site_url()}}upload/berita/' + data.screenshoot + '" width="200px" height="200px"></a>');
                            $("#keterangan").prop('disabled', true);
                            $('#verif_status').prop('checked', true);
                            $('#verif_status').val('oke');
                        } else if (data.status_berita == 'oke') {
                            $('#link_berita').html('<a href="' + data.link_berita + '" target="_blank">' + data.link_berita + '</a>');
                            $('#screenshoot').html('<a href="{{site_url()}}upload/berita/' + data.screenshoot + '" target="_blank" class="thumbnail"> <img class="img-responsive" src="{{site_url()}}upload/berita/' + data.screenshoot + '" width="200px" height="200px"></a>');
                            $("#keterangan").prop('disabled', true);
                            $('#verif_status').prop('checked', true);
                            $('#verif_status').val('oke');
                            $('.link').show();
                            $('.share').show();
                            $('.view').show();
                            $('.screenshot').show();
                        } else {
                            $('#link_berita').html('<a href="' + data.link_berita + '" target="_blank">' + data.link_berita + '</a>');
                            $('.link').hide();
                            $('.share').hide();
                            $('.view').hide();
                            $('.screenshot').hide();
                            $("#keterangan").prop('disabled', false);
                            $('#verif_status').prop('checked', false);
                            $('#verif_status').val('belum');
                        }
                    },
                });
            });

            $("#verif_status").change(function() {
                if ($(this).is(":checked")) {
                    $(this).val("oke");
                    $("#keterangan").prop('disabled', true);
                    $("#keterangan").val('');

                } else {
                    $(this).val("belum");
                    $("#keterangan").prop('disabled', false);
                    $("#keterangan").focus();
                    toastr.error('Mohon isi keterangan..');

                }
            });


            $('#form-verif').submit('click', function() {
                $.ajax({
                    type: "POST",
                    url: "{{base_url('berita/verif')}}",
                    data: new FormData(this),
                    processData: false,
                    contentType: false,
                    cache: false,
                    async: false,
                    success: function(data) {
                        if ($("#verif_status").val() == 'oke') {
                            $('#keterangan').val('');
                            $('#keterangan').prop("disabled", true);
                            $('#modal-lihat').modal('hide');
                            toastr.success('Draft berita berhasil diverifikasi!');
                            table.ajax.reload();
                        } else if ($("#verif_status").val() == 'belum') {
                            $('.link').hide();
                            $('.share').hide();
                            $('.view').hide();
                            $('.screenshot').hide();
                            $('#modal-lihat').modal('hide');
                            toastr.error('Draft berita tidak diverifikasi!');
                            table.ajax.reload();
                        }
                    },
                    error: function(data) {
                        toastr.warning('Status berita gagal diverifikasi!');
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