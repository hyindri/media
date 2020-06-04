@extends("base.main_base")
@section("content")

<div class="container-fluid">
    <div class="block-header">
        <h2>
            Management Akun
            <small>di Diskominfo <a href="https://datatables.net/" target="_blank">Kabupaten Bintan</a></small>
        </h2>
    </div>
    <!-- Basic Examples -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        Akun
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
                                    <th>Username</th>
                                    <th>Dibuat pada</th>
                                    <th>Status</th>
                                    <th>Media</th>
                                    <th>Mulai MOU</th>
                                    <th>Akhir MOU</th>
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
@include("admin.usermanagement.modal")
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
                "url": "{{site_url('usermanagement/json')}}",
                "type": "POST"
            },

          
            "columnDefs": [{
                "targets": [0,4,5,6],
                "orderable": false,
            }, ],

        });

        $('#table').on('click', '.ubah', function() {
            $('#modal-ubah').modal('show');
            $("#edit_id").val($(this).data('id'));
            $("#edit_status").val($(this).data('status'));
            $("#edit_mulai_mou").val($(this).data('mulai_mou'));
            $("#edit_akhir_mou").val($(this).data('akhir_mou'));
        });

        $('#ubah-user').submit('click', function() {
            $.ajax({
                type: "POST",
                url: "{{base_url('usermanagement/ubah')}}",
                data: new FormData(this),
                processData: false,
                contentType: false,
                cache: false,
                async: false,
                success: function(data) {
                    $('#modal-ubah').modal('hide');
                    // $('#ubah-agenda')[0].reset();
                    toastr.success('User berhasil diubah!');
                    table.ajax.reload();
                },
                error: function(data) {
                    $('#modal-ubah').modal('hide');
                    toastr.warning('Gagal mengubah user!');
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