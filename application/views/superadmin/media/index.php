@extends("base.main_base")
@section("content")
@section('title','Agenda')
<div class="container-fluid">
    <!-- Breadcrumb  -->
    <div class="block-header">
        <ol class="breadcrumb">
            <li>HOME</li>
            <li class="active">DAFTAR MEDIA</li>
        </ol>
    </div>
    <!-- end breadcrumb -->
    <!-- Basic Examples -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        Media
                    </h2>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table id="table" class="table table-bordered table-striped table-hover display nowrap">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Username</th>
                                    <th>Dibuat pada</th>
                                    <th>Status</th>
                                    <th>Media</th>
                                    <th>Mulai MOU</th>
                                    <th>Akhir MOU</th>
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
            "responsive": true,
            "info": true,
            "ordering": true,
            "order": [], 
          
            "ajax": {
                "url": "{{site_url('usermanagement/fetch_data')}}",
                "type": "POST"
            },

          
            "columnDefs": [{
                "targets": [0,4,5,6],
                "orderable": false,
            }, ],

        });
    });
</script>
<script>
$('.datepicker').bootstrapMaterialDatePicker({
    time: false
});
</script>
@endsection