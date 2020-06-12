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
                                <button title="Export PDF" type="button" class="btn bg-blue btn-block btn-xs waves-effect waves-light-blue" data-toggle="modal" data-target="#modal-export">
                                    <i class="col-white material-icons">picture_as_pdf</i>
                                </button>
                            </div>
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
                        <table id="table" class="table table-bordered table-striped table-hover display nowrap" width="100%">
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
                        $('#share').empty();
                        $('#nama').html(data.nama);
                        $('#jumlah_view').html(data.jumlah_view);
                        $('#judul_berita').html(data.judul_berita);
                        $('#narasi_berita').html(data.narasi_berita);
                        $('#tipe_media_massa').html(data.tipe_media_massa);
                        $('#dibuat_tanggal').html(data.dibuat_tanggal + ' : ' + data.dibuat_pukul);
                        $('#keterangan').val(data.keterangan);
                        $('#link_berita').html('<a href="' + data.link_berita + '" target="_blank">' + data.link_berita + '</a>');


                        var nama = [];
                        var logo = [];
                        $.each(data.sosmed, function(key, value) {
                            nama.push(value.nama);
                            logo.push(value.logo);
                            $('#share').append('<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3"><a class="deco-off"><img class="logo-sm m-logo" src="{{site_url()}}upload/logo/' + value.logo + '" ">' + value.nama + '</a></div>');
                        });
                        if (data.status_berita == 'valid') {
                            if (data.tipe_media_massa == 'radio') {
                                $('#file').html('<audio controls target="_blank" class="thumbnail col-xs-12 col-sm-12 col-md-6 col-lg-8"><source src="{{site_url()}}upload/berita/' + data.dibuat_oleh + '/' + id_berita + '/' + data.file + '" type="audio/mp3"></audio>');
                            } else {
                                $('#file').html('<a href="{{site_url()}}upload/berita/' + data.dibuat_oleh + '/' + id_berita + '/' + data.file + '" target="_blank" class="thumbnail"> <img class="img-responsive" src="{{site_url()}}upload/berita/' + data.dibuat_oleh + '/' + id_berita + '/' + data.file + '" width="200px" height="200px"></a>');
                            }
                            $('.link').show();
                            $('.share').show();
                            $('.view').show();
                            $('.file').show();
                            $('.keterangan').hide();
                            $('.status_berita').hide();
                            $('#simpan_btn').prop('disabled', true);
                            $('#link_berita').html('<a href="' + data.link_berita + '" target="_blank">' + data.link_berita + '</a>');
                            $("#keterangan").prop('disabled', true);
                            $('#verif_status').prop('checked', true);
                        } else if (data.status_berita == 'oke') {
                            if (data.tipe_media_massa == 'radio') {
                                $('#file').html('<audio controls target="_blank" class="thumbnail col-xs-12 col-sm-12 col-md-6 col-lg-8"><source src="{{site_url()}}upload/berita/' + data.dibuat_oleh + '/' + id_berita + '/' + data.file + '" type="audio/mp3"></audio>');
                                $('.file').hide();
                            } else {
                                $('#file').html('<a href="{{site_url()}}upload/berita/' + data.dibuat_oleh + '/' + id_berita + '/' + data.file + '" target="_blank" class="thumbnail"> <img class="img-responsive" src="{{site_url()}}upload/berita/' + data.dibuat_oleh + '/' + id_berita + '/' + data.file + '" width="200px" height="200px"></a>');
                                $('.file').show();
                            }
                            $('#link_berita').html('<a href="' + data.link_berita + '" target="_blank">' + data.link_berita + '</a>');
                            $('.link').hide();
                            $('.share').hide();
                            $('.view').hide();
                            $('.keterangan').show();
                            $('.status_berita').show();
                            $("#keterangan").prop('disabled', true);
                            $('#simpan_btn').prop('disabled', true);
                            $('#verif_status').prop('checked', true);
                        } else {
                            if (data.tipe_media_massa == 'radio') {
                                $('.file').hide();
                                $('#file').html('<audio controls target="_blank" class="thumbnail col-xs-12 col-sm-12 col-md-6 col-lg-8"><source src="{{site_url()}}upload/berita/' + data.dibuat_oleh + '/' + id_berita + '/' + data.file + '" type="audio/mp3"></audio>');
                            } else {
                                $('.file').show();
                                $('#file').html('<a href="{{site_url()}}upload/berita/' + data.dibuat_oleh + '/' + id_berita + '/' + data.file + '" target="_blank" class="thumbnail"> <img class="img-responsive" src="{{site_url()}}upload/berita/' + data.dibuat_oleh + '/' + id_berita + '/' + data.file + '" width="200px" height="200px"></a>');
                            }
                            if ($('#verif_status').is(":checked")) {
                                $('#verif_status').val("oke");
                                $("#keterangan").prop('disabled', true);
                                $("#keterangan").val('');
                            } else {
                                $('#verif_status').val("belum");
                                $('#simpan_btn').prop('disabled', false);
                                $("#keterangan").prop('disabled', false);
                                $("#keterangan").prop('required', true);
                                $("#keterangan").focus();
                                toastr.warning('Mohon isi keterangan jika draft belum di validasi..');
                            }
                            $('.link').hide();
                            $('.share').hide();
                            $('.view').hide();
                            $('.keterangan').show();
                            $('.status_berita').show();
                            $('#simpan_btn').prop('disabled', false);
                            $("#keterangan").prop('disabled', false);
                            $('#verif_status').prop('checked', false);
                            $('#link_berita').html('<a href="' + data.link_berita + '" target="_blank">' + data.link_berita + '</a>');

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
                    $('#simpan_btn').prop('disabled', false);
                    $("#keterangan").prop('disabled', false);
                    $("#keterangan").prop('required', true);
                    $("#keterangan").focus();
                    toastr.warning('Mohon isi keterangan..');
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
                            $('#keterangan').prop("disabled", true);
                            $('#modal-lihat').modal('hide');
                            toastr.success('Draft berita berhasil diverifikasi!');
                            table.ajax.reload();
                        } else if ($("#verif_status").val() == 'belum') {
                            $('#modal-lihat').modal('hide');
                            toastr.error('Draft berita tidak diverifikasi!');
                            table.ajax.reload();
                        } else {
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