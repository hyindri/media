@extends("base.main_base")
@section("content")

<div class="container-fluid">
    <div class="block-header">
        <h2>
            Daftar Agenda
            <small>di Diskominfo <a href="https://datatables.net/" target="_blank">Kabupaten Bintan</a></small>
        </h2>
    </div>
    <!-- Basic Examples -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        Agenda
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
@include("agenda.modal")
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

          
            "columnDefs": [{
                "targets": [0,4,5,6],
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