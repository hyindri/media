  @extends('base.main_base')
  @section('content')
  @section('title','Setting')

  <div class="block-header">
      <ol class="breadcrumb">
          <li>HOME</li>
          <li>SETTING</li>
          <li class="active">MEDIA SOSIAL</li>
      </ol>
  </div>
  <div class="row clearfix">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <div class="card">
              <div class="header">
                  <h2>
                      Pengaturan Waktu Pengingat
                  </h2>
              </div>
              <div class="body">
                  <form action="" id="ubah-jam">
                      <div class="demo-masked-input">
                          <div class="row clearfix">
                              <div class="col-md-4">
                                  <div class="form-group">
                                      <div class="input-group">
                                          <span class="input-group-addon">
                                              <i class="material-icons">access_time</i>
                                          </span>
                                          <div class="form-line">
                                              <input id="id" name="id" type="hidden" class="form-control">
                                              <input id="waktu" name="waktu" type="text" class="form-control time24" placeholder="Atur Batas Waktu Pelaporan..">
                                          </div>
                                      </div>
                                  </div>
                              </div>
                              <div class="col-md-6">
                                  {{form_submit('submit', 'Simpan', 'class="btn bg-indigo btn-lg m-l-15 waves-effect"')}}
                              </div>
                          </div>
                      </div>
                  </form>
              </div>
          </div>
      </div>
  </div>
  <!-- Table -->
  <div class="row clearfix">
      <div class="col-xs-12 col-md-12 col-sm-12 col-lg-12 ">
          <div class="card">
              <div class="header">
                  <h2>
                      Media Sosial
                  </h2>
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
                      <table id="table" class="table table-bordered table-striped table-hover display wrap" width="100%">
                          <thead>
                              <tr>
                                  <th style="width:10px;">No</th>
                                  <th>Nama</th>
                                  <th>Logo</th>
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
  @include("admin.setting.modal")

  @endsection
  @section('js')
  <script>
      $(document).ready(function() {
          var $demoMaskedInput = $('.demo-masked-input');
          $demoMaskedInput.find('.time24').inputmask('hh:mm', {
              placeholder: '__:__ _m',
              alias: 'time24',
              hourFormat: '24'
          });

          var table = $('#table').DataTable({
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
                  "url": "{{site_url('setting/json')}}",
                  "type": "POST"
              },
              "columnDefs": [{
                  "targets": [0, 3],
                  "orderable": false,
              }, ],
          });

          $.ajax({
              type: "GET",
              url: "{{base_url('Setting/json_waktu')}}",
              dataType: "JSON",
              success: function(data) {
                  $('#id').val(data.id);
                  $('#setting').val(data.waktu);

              }
          });

          $('#table').on('click', '.ubah', function() {
              $('#modal-ubah').modal('show');
              $("#edit_id").val($(this).data('id'));
              $("#edit_nama").val($(this).data('nama'));
              var logo = $(this).data('logo');
              $('#file_lama').html('<a href="{{site_url()}}upload/logo/' + logo + '"  class="thumbnail"> <embed class="img-responsive" src="{{site_url()}}upload/logo/' + logo + '" width="50" height="50"></a>');
          });


          $('#tambah-sosmed').submit('click', function() {
              $.ajax({
                  type: "POST",
                  url: "{{base_url('setting/tambah')}}",
                  data: new FormData(this),
                  processData: false,
                  contentType: false,
                  cache: false,
                  async: false,
                  success: function(data) {
                      $('#nama').val("");
                      $('#file').val("");
                      $('#modal-tambah').modal('hide');
                      $('#tambah-sosmed')[0].reset();
                      toastr.success('Sosmed berhasil ditambahkan!');
                      table.ajax.reload();
                  },
                  error: function(data) {
                      toastr.warning('Sosmed sudah pernah ditambahkan!');
                      $('#tambah-sosmed')[0].reset();
                      table.ajax.reload();
                  }
              });
              return false;
          });

          $('#ubah-sosmed').submit('click', function() {
              $.ajax({
                  type: "POST",
                  url: "{{base_url('setting/ubah')}}",
                  data: new FormData(this),
                  processData: false,
                  contentType: false,
                  cache: false,
                  async: false,
                  success: function(data) {
                      $('#modal-ubah').modal('hide');
                      toastr.success('Sosmed berhasil diubah!');
                      table.ajax.reload();
                  },
                  error: function(data) {
                      $('#modal-ubah').modal('hide');
                      toastr.warning('Sosmed mengubah agenda!');
                      table.ajax.reload();
                  }
              });
              return false;
          });

          $('#ubah-jam').submit('click', function() {
              $.ajax({
                  type: "POST",
                  url: "{{base_url('setting/ubah_jam')}}",
                  data: new FormData(this),
                  processData: false,
                  contentType: false,
                  cache: false,
                  async: false,
                  success: function(data) {
                      toastr.success('Setting waktu berhasil diubah', 'Berhasil');
                  },
                  error: function(data) {
                      toastr.warning('Setting waktu gagal diubah', 'Gagal');
                  }
              });
              return false;
          });
      });
  </script>
  @endsection