@extends("base.main_base")
@section("content")
@section("title", "Media Massa")


<div class="container-fluid">
    <div class="block-header">
        <h2>
            Daftar Media Massa            
        </h2>
    </div>
    <!-- Basic Examples -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        TABEL
                    </h2>
                    <ul class="header-dropdown m-r--5">
                        <li class="dropdown">
                            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                <i class="material-icons">more_vert</i>
                            </a>
                            <ul class="dropdown-menu pull-right">
                                <li><a href="javascript:void(0);" data-toggle="modal" data-target="#modal-filter">Filter</a></li>
               
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
                                    <th>Nama</th>
                                    <th>NPWP</th>
                                    <th>Pimpinan</th>
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
@include("admin.media_massa.modal")
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
                "url": "{{site_url('media_massa/json')}}",
                "type": "POST",
                "data": function(data) {
                    data.nama = $('#nama').val();
                    data.npwp = $('#npwp').val();
                    data.pimpinan = $('#pimpinan').val();
                }
            },

          
            "columnDefs": [{
                "targets": [0,4],
                "orderable": false,
            }, ],

        });

        $('#btn-filter').click(function() { 
            table.ajax.reload(); 
        });
        $('#btn-reset').click(function() { 
            $('#form-filter')[0].reset();
            table.ajax.reload(); 
        });

    });
</script>
@endsection
