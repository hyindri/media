@extends("base.main_base")
@section("content")
@section('title','Manajemen Akun')

<div class="container-fluid">
    <div class="block-header">
        <ol class="breadcrumb">
            <li>HOME</li>
            <li>MANAJEMEN</li>
            <li class="active">MANAJEMEN AKUN</li>
        </ol>
    </div>
    <!-- end breadcrumb -->

    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>Akun</h2>
                    <div class="icon-button-demo align-right m-b--25">
                        <a data-toggle="modal" data-target="#modal-filter">
                            <button type="button" title="Filter" class="btn btn-primary waves-effect waves-light-blue">
                                <i class="material-icons">filter_list</i><span>Filter</span>
                            </button></a>
                        <a id="export">
                            <button type="button" title="Export PDF" class="btn btn-primary waves-effect waves-light-blue">
                                <i class="material-icons">picture_as_pdf</i><span>Export</span>
                            </button>
                        </a>
                        <a id="btn-reset"><button type="button" title="Refresh" class="btn btn-primary waves-effect waves-light-blue">
                                <i class="material-icons">replay</i><span>Refresh</span>
                            </button>
                        </a>
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
</div>
@include("admin.usermanagement.modal")
@endsection
@section("js")
<script type="text/javascript">
    var table;
    $(document).ready(function() {
        function getBase64FromImageUrl(url) {
            var img = new Image();
            img.crossOrigin = "anonymous";
            img.onload = function() {
                var canvas = document.createElement("canvas");
                canvas.width = this.width;
                canvas.height = this.height;
                var ctx = canvas.getContext("2d");
                ctx.drawImage(this, 0, 0);
                var dataURL = canvas.toDataURL("image/png");
                return dataURL.replace(/^data:image\/(png|jpg);base64,/, "");
            };
            img.src = url;
        }
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
            "searching": false,
            "info": true,
            "ordering": true,
            "order": [],
            "ajax": {
                "url": "{{site_url('usermanagement/json')}}",
                "type": "POST",
                "data": function(data) {
                    data.nama = $('#filter_nama').val();
                    data.status = $('#filter_status').val();
                    data.tipe_publikasi = $('#filter_tipe_publikasi').val();
                    data.tipe_media_massa = $('#filter_tipe_media_massa').val();
                }
            },
            "columnDefs": [{
                "targets": [0, 4, 5, 6],
                "orderable": false,
            }, ],
        });
        $('#btn-filter').click(function() {
            $('#modal-filter').modal('hide');
            table.ajax.reload();
        });
        $('#btn-reset').click(function() {
            $('#form-filter')[0].reset();
            table.ajax.reload();
        });

        $('#export').click(function() {
            var nama = $('#filter_nama').val();
            var status = $('#filter_status').val();
            var publikasi = $('#filter_tipe_publikasi').val();
            var tipemedia = $('#filter_tipe_media_massa').val();
            if (nama == '') {
                nama = 0;
            }
            if (status == '') {
                status = 0;
            }
            if (publikasi == '') {
                publikasi = 0;
            }
            if (tipemedia == '') {
                tipemedia = 0;
            }
            window.open('<?php echo base_url('usermanagement/export') ?>/' + nama + '/' + status + '/' + publikasi + '/' + tipemedia);
        });
        $('#table').on('click', '.ubah', function() {
            $('#modal-ubah').modal('show');
            $("#edit_id").val($(this).data('id'));
            $("#edit_status").val($(this).data('status'));
            if ($(this).data('status') == 'registrasi' || $(this).data('status') == 'suspend') {
                $("#edit_mulai_mou").val('');
                $("#edit_akhir_mou").val('');
            } else {
                $("#edit_mulai_mou").val($(this).data('mulai_mou'));
                $("#edit_akhir_mou").val($(this).data('akhir_mou'));
            }
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

        $('#table').on('click', '.reset', function() {
            $('#modal-reset').modal('show');
            $("#reset_id").val($(this).data('id'));
            $("#reset_username").val($(this).data('username'));
        });
        $('#reset-user').submit('click', function() {
            $.ajax({
                type: "POST",
                url: "{{base_url('usermanagement/reset')}}",
                data: new FormData(this),
                processData: false,
                contentType: false,
                cache: false,
                async: false,
                success: function(data) {
                    $('#modal-reset').modal('hide');
                    // $('#ubah-agenda')[0].reset();
                    toastr.success('Password user berhasil di reset!');
                    table.ajax.reload();
                },
                error: function(data) {
                    $('#modal-reset').modal('hide');
                    toastr.warning('Gagal reset password!');
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