  @extends('base.main_base')
  @section('content')
  <div class="row clearfix">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <div class="card">
              <div class="header">
                  <h2>
                      SETTING WAKTU
                  </h2>
                  <ul class="header-dropdown m-r--5">
                      <li class="dropdown">
                          <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                              <i class="material-icons">more_vert</i>
                          </a>
                          <ul class="dropdown-menu pull-right">
                              <li><a href="javascript:void(0);">Action</a></li>
                              <li><a href="javascript:void(0);">Another action</a></li>
                              <li><a href="javascript:void(0);">Something else here</a></li>
                          </ul>
                      </li>
                  </ul>
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
                              {{form_submit('submit', 'Simpan', 'class="btn btn-primary btn-lg m-l-15 waves-effect"')}}
                              </div>
                          </div>
                      </div>
                  </form>
              </div>
          </div>
      </div>
  </div>
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

          $.ajax({
                type: "GET",
                url: "{{base_url('Waktu/json')}}",
                dataType: "JSON",
                success: function(data) {
                    $('#id').val(data.id);
                    $('#waktu').val(data.waktu);

                }
            });

            $('#ubah-jam').submit('click', function() {
            $.ajax({
                type: "POST",
                url: "{{base_url('Waktu/ubah_jam')}}",
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