@extends("base.main_base")
@section("content")

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
                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                <i class="material-icons">more_vert</i>
                            </a>
                            <ul class="dropdown-menu pull-right">
                                <li><a data-toggle="modal" data-target="#modal-tambah">Tambah</a></li>

                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table id="table" class="table table-bordered table-striped table-hover" width="100%">
                            <thead>
                                <tr>
                                    <th style="width:10px;">No</th>
                                    <th>Nama Media</th>
                                    <th>Link Berita</th>
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
@include("admin.berita.modal")
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
            "searching": false,
            "info": true,
            "ordering": true,
            "order": [],

            "ajax": {
                "url": "{{site_url('berita/json')}}",
                "type": "POST"
            },


            "columnDefs": [{
                "targets": [0, 4],
                "orderable": false,
            },
            {
                "targets": [3,4],
                "class": "text-center",
            },],

        });

        $('#tambah-agenda').submit('click', function() {
            $.ajax({
                type: "POST",
                url: "{{base_url('agenda/tambah')}}",
                data: new FormData(this),
                processData: false,
                contentType: false,
                cache: false,
                async: false,
                success: function(data) {
                    $('#judul').val("");
                    $('#tanggal').val("");
                    $('#status').val("");
                    $('#file').val("");
                    $('#modal-tambah').modal('hide');
                    $('#tambah-agenda')[0].reset();
                    toastr.success('Agenda berhasil ditambahkan!');
                    table.ajax.reload();
                },
                error: function(data) {
                    toastr.warning('Agenda sudah pernah ditambahkan!');
                    $('#tambah-agenda')[0].reset();
                    table.ajax.reload();
                }
            });
            return false;
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
                    $('#dibuat_tanggal').html(data.dibuat_tanggal);
                    $('#dibuat_pukul').html(data.dibuat_pukul);
                    $('#keterangan').val(data.keterangan);
                    $('#link_berita').html('<a href="' + data.link_berita + '" target="_blank">' + data.link_berita + '</a>');
                    $('#screenshoot').html('<a href="{{site_url()}}upload/berita/' + data.screenshoot + '" target="_blank" class="thumbnail"> <img class="img-responsive" src="{{site_url()}}upload/berita/' + data.screenshoot + '" width="200px" height="200px"></a>');
                    if (data.status_berita == 'oke') {
                        $('#keterangan').prop("disabled", true);
                        $('#simpan_btn').prop("disabled", true);
                        $('#verif_status').prop('checked', true);
                    } else {
                        $('#keterangan').prop("disabled", false);
                        $("#keterangan").prop('required',true);
                        $('#simpan_btn').prop("disabled", false);
                        $('#verif_status').prop('checked', false);
                    }

                }
            });
        });

        $("#verif_status").change(function() {
            if ($(this).is(":checked")) {
                $(this).val("oke");
            } else {
                $(this).val("belum");;
            }
        });


        $('#verif_status').on('change', function() {
            let id_berita = $('#id_berita').val();
            let verif_status = $('#verif_status').val();

            $.ajax({
                type: "POST",
                url: "{{base_url('berita/verif')}}",
                data: {
                    id_berita: id_berita,
                    verif_status: verif_status
                },
                success: function(data) {
                    if (verif_status == 'oke') {
                        $('#keterangan').val('');
                        $('#keterangan').prop("disabled", true);
                        $('#simpan_btn').prop("disabled", true);
                        toastr.success('Status berita berhasil diverifikasi!');
                        table.ajax.reload();
                    } else {
                        $('#keterangan').prop("disabled", false);
                        $("#keterangan").prop('required',true);
                        $('#simpan_btn').prop("disabled", false);
                        toastr.error('Status berita tidak diverifikasi!');
                        table.ajax.reload();


                    }
                },
                error: function(data) {
                    toastr.warning('Status berita gagal diverifikasi!');
                }
            });
            return false;
        });

        $('#form-verif').submit('click', function() {
            $.ajax({
                type: "POST",
                url: "{{base_url('berita/belum_verif')}}",
                data: new FormData(this),
                processData: false,
                contentType: false,
                cache: false,
                async: false,
                success: function(data) {
                    toastr.success('Keterangan Berhasil ditambahkan');
                },
                error: function(data) {
                    toastr.warning('Keterangan Berhasil gagal ditambahkan!');
                }
            });
            return false;
        });

    });
</script>
@endsection