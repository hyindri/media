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
                    <h2>
                        Agenda
                    </h2>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table id="datatable" class="table table-bordered table-striped table-hover display nowrap" width='100%'>
                            <thead>
                                <tr>
                                    <th style="width:10px;">No</th>
                                    <th class="text-center">Tanggal</th>
                                    <th>Judul</th>
                                    <th class="text-center">File</th>
                                    <th class="text-center">Status</th>
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
        table = $('#datatable').DataTable({
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
                "url": "{{site_url('agenda/json')}}",
                "type": "POST"
            },


            "columnDefs": [{
                "targets": [0, 3, 4],
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