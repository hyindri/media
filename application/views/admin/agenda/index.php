@extends("base.main_base")
@section("content")
@section('title','Agenda')

<div class="container-fluid">
    <!-- Breadcrumb  -->
    <div class="block-header">
        <ol class="breadcrumb">
            <li>HOME</li>
            <li class="active">DAFTAR AGENDA</li>
        </ol>
    </div>
    <!-- end breadcrumb -->
    <!-- Basic Examples -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>Agenda</h2>
                    <div class="icon-button-demo align-right m-b--25">
                        <a data-toggle="modal" data-target="#modal-tambah">
                            <button type="button" class="btn btn-primary waves-effect waves-light-blue">
                                <i class="material-icons">control_point</i>
                            </button></a>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table id="table" class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Judul</th>
                                        <th>Tanggal</th>
                                        <th>Status</th>
                                        <th>File</th>
                                        <th>Dibuat oleh</th>
                                        <th>Dibuat pada</th>
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
        </div>
    </div>
    @include("admin.agenda.modal")
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
                    "url": "{{site_url('agenda/json')}}",
                    "type": "POST"
                },

<<<<<<< HEAD
          
            "columnDefs": [{
                "targets": [0,4,7],
                "orderable": false,
            }, ],
=======
>>>>>>> 00bb803a06a50ddc035d3b4f48652dbd649c1f32

                "columnDefs": [{
                    "targets": [0, 4, 5, 6],
                    "orderable": false,
                }, ],

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

            $('#table').on('click', '.ubah', function() {
                $('#modal-ubah').modal('show');
                $("#edit_id").val($(this).data('id'));
                $("#edit_judul").val($(this).data('judul'));
                $("#edit_tanggal").val($(this).data('tanggal'));
                $("#edit_status").val($(this).data('status'));
            });

            $('#ubah-agenda').submit('click', function() {
                $.ajax({
                    type: "POST",
                    url: "{{base_url('agenda/ubah')}}",
                    data: new FormData(this),
                    processData: false,
                    contentType: false,
                    cache: false,
                    async: false,
                    success: function(data) {
                        $('#modal-ubah').modal('hide');
                        // $('#ubah-agenda')[0].reset();
                        toastr.success('Agenda berhasil diubah!');
                        table.ajax.reload();
                    },
                    error: function(data) {
                        $('#modal-ubah').modal('hide');
                        toastr.warning('Gagal mengubah agenda!');
                        table.ajax.reload();
                    }
                });
                return false;
            });

        });
    </script>
    <script>
        $('.datepicker').bootstrapMaterialDatePicker({
            time: false
        });
    </script>
    @endsection