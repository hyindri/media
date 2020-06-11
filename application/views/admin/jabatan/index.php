@extends("base.main_base")
@section("content")
@section('title','Jabatan')

<div class="container-fluid">
    <!-- Breadcrumb  -->
    <div class="block-header">
        <ol class="breadcrumb">
            <li>HOME</li>
            <li class="active">DAFTAR JABATAN</li>
        </ol>
    </div>
    <!-- end breadcrumb -->
    <!-- Basic Examples -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>Jabatan</h2>
                    <ul class="header-dropdown m-r--5">
                        <li>
                            <div class="icon-button-demo align-right m-b--25">
                                <button title="Tambah" type="button" class="btn bg-blue btn-block btn-xs waves-effect waves-light-blue" data-toggle="modal" data-target="#modal-tambah">
                                    <i class="material-icons">control_point</i>
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
                                    <th style="width: 10px;">No</th>
                                    <th class="text-center">Nama</th>
                                    <th class="text-center">Aksi</th>
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
    @include("admin.jabatan.modal")
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
                    "url": "{{site_url('jabatan/json')}}",
                    "type": "POST"
                },

                "columnDefs": [
                    {
                    "targets": [0, 2],
                    "orderable": false,
                    "class": "text-center"
                    },

                    
                    {
                    "targets": [1],
                    "orderable": false,
                    "class": "text-center"
                    }, 
                ],

            });

            $('#tambah-jabatan').submit('click', function() {
                $.ajax({
                    type: "POST",
                    url: "{{base_url('jabatan/tambah')}}",
                    data: new FormData(this),
                    processData: false,
                    contentType: false,
                    cache: false,
                    async: false,
                    success: function(data) {
                        $('#nama_jabatan').val("");
                        $('#modal-tambah').modal('hide');
                        $('#tambah-jabatan')[0].reset();
                        toastr.success('Jabatan berhasil ditambahkan!');
                        table.ajax.reload();
                    },
                    error: function(data) {
                        toastr.warning('Jabatan sudah pernah ditambahkan!');
                        $('#tambah-jabatan')[0].reset();
                        table.ajax.reload();
                    }
                });
                return false;
            });

            $('#table').on('click', '.ubah', function() {
                $('#modal-ubah').modal('show');
                $("#edit_id").val($(this).data('id'));
                $("#edit_nama_jabatan").val($(this).data('nama_jabatan'));
            });

            $('#ubah-jabatan').submit('click', function() {
                $.ajax({
                    type: "POST",
                    url: "{{base_url('jabatan/ubah')}}",
                    data: new FormData(this),
                    processData: false,
                    contentType: false,
                    cache: false,
                    async: false,
                    success: function(data) {
                        $('#modal-ubah').modal('hide');
                        // $('#ubah-agenda')[0].reset();
                        toastr.success('Jabatan berhasil diubah!');
                        table.ajax.reload();
                    },
                    error: function(data) {
                        $('#modal-ubah').modal('hide');
                        toastr.warning('Gagal mengubah jabatan!');
                        table.ajax.reload();
                    }
                });
                return false;
            });

        });
    </script>
    @endsection