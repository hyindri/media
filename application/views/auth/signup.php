
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Form Wizard | Bootstrap Based Admin Template - Material Design</title>
    <!-- Favicon-->
    <link rel="icon" href="{{APP_ASSETS}}favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="{{APP_ASSETS}}plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="{{APP_ASSETS}}plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="{{APP_ASSETS}}plugins/animate-css/animate.css" rel="stylesheet" />

    <!-- Sweet Alert Css -->
    <link href="{{APP_ASSETS}}plugins/sweetalert/sweetalert.css" rel="stylesheet" />

    <!-- Bootstrap Select Css -->
    <link href="{{APP_ASSETS}}plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="{{APP_ASSETS}}css/style.css" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="{{APP_ASSETS}}css/themes/all-themes.css" rel="stylesheet" />
</head>

<body class="theme-red">
    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p>Please wait...</p>
        </div>
    </div>
    <!-- #END# Page Loader -->


    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>
                    FORM WIZARD
                    <small>Taken from <a href="https://github.com/rstaib/jquery-steps" target="_blank">github.com/rstaib/jquery-steps</a> & <a href="https://jqueryvalidation.org/" target="_blank">jqueryvalidation.org</a></small>
                </h2>
            </div>
            
            <!-- Advanced Form Example With Validation -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>FORM REGISTRASI</h2>
                            <ul class="header-dropdown m-r--5">
                            </ul>
                        </div>
                        <div class="body">
                            <form id="wizard_with_validation" method="POST">
                                <h3>Informasi Akun</h3>
                                <fieldset>
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="username" required>
                                            <label class="form-label">Username*</label>
                                        </div>
                                    </div>
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="password" class="form-control" name="password" id="password" required>
                                            <label class="form-label">Password*</label>
                                        </div>
                                    </div>
                                </fieldset>

                                <h3>Profil Media</h3>
                                <fieldset>
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="nama_media" required>
                                            <label class="form-label">Nama Media*</label>
                                        </div>
                                    </div>
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="nama_media" required>
                                            <label class="form-label">Nama Perusahaan*</label>
                                        </div>
                                    </div>
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="alamat_perusahaan" required>
                                            <label class="form-label">Alamat Perusahaan*</label>
                                        </div>
                                    </div>
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="npwp" required>
                                            <label class="form-label">NPWP*</label>
                                        </div>
                                    </div>
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="rekening" required>
                                            <label class="form-label">Rekening*</label>
                                        </div>
                                    </div>
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="no_telp" required>
                                            <label class="form-label">No. Telp*</label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <select class="form-control" name="tipe_publikasi" required>
                                                <option value="">-- Pilih tipe publikasi --</option>
                                                <option value="harian">Harian</option>
                                                <option value="mingguan">Mingguan</option>
                                                <option value="bulanan">Bulanan</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <select class="form-control" name="tipe_media_massa" required>
                                                <option value="">-- Pilih tipe media massa --</option>
                                                <option value="cetak">Cetak</option>
                                                <option value="online">Online</option>
                                                <option value="radio">Radio</option>
                                                <option value="tv">TV</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="jumlah_saham" required>
                                            <label class="form-label">Jumlah Saham*</label>
                                        </div>
                                    </div>
                                </fieldset>

                                <h3>Sosial Media</h3>
                                <fieldset>
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="email" class="form-control" name="email" required>
                                            <label class="form-label">Email*</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="text" class="form-control" name="username_fb" required>
                                                    <label class="form-label">Facebook*</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="number" min="1" class="form-control" name="pengikut_fb" required>
                                                    <label class="form-label">Pengikut Facebook*</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="text" class="form-control" name="username_ig" required>
                                                    <label class="form-label">Instagram*</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="number" min="1" class="form-control" name="pengikut_ig" required>
                                                    <label class="form-label">Pengikut Instagram*</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="text" class="form-control" name="username_twitter" required>
                                                    <label class="form-label">Twitter*</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="number" min="1" class="form-control" name="pengikut_twitter" required>
                                                    <label class="form-label">Pengikut Twitter*</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="text" class="form-control" name="channel_youtube" required>
                                                    <label class="form-label">Youtube*</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="number" min="1" class="form-control" name="subscriber_youtube" required>
                                                    <label class="form-label">Subscriber Youtube*</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>

                                <h3>Berkas Pendukung</h3>
                                <fieldset>
                                    <div class="form-group form-float">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <div class="form-line">
                                                    <label class="form-label">Akta Pendirian dan Perubahan Terakhir* <i>maks. 5MB</i></label>
                                                </div>
                                            </div>
                                            <div class="col-md-7">
                                                <div class="form-line">
                                                    <input type="file" class="form-control" name="file_akta_pendirian" required>
                                                </div>
                                            </div>  
                                        </div>
                                    </div>
                                    <div class="form-group form-float">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <div class="form-line">
                                                    <label class="form-label">Surat Izin Tempat Usaha (SITU)* <i>maks. 5MB</i></label>
                                                </div>
                                            </div>
                                            <div class="col-md-7">
                                                <div class="form-line">
                                                    <input type="file" class="form-control" name="file_situ" required>
                                                </div>
                                            </div>  
                                        </div>
                                    </div>
                                    <div class="form-group form-float">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <div class="form-line">
                                                    <label class="form-label">Surat Izin Usaha Perdagangan (SIUP)* <i>maks. 5MB</i></label>
                                                </div>
                                            </div>
                                            <div class="col-md-7">
                                                <div class="form-line">
                                                    <input type="file" class="form-control" name="file_siup" required>
                                                </div>
                                            </div>  
                                        </div>
                                    </div>
                                    <div class="form-group form-float">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <div class="form-line">
                                                    <label class="form-label">Tanda Daftar Perusahaan (TDP)* <i>maks. 5MB</i></label>
                                                </div>
                                            </div>
                                            <div class="col-md-7">
                                                <div class="form-line">
                                                    <input type="file" class="form-control" name="file_tdp" required>
                                                </div>
                                            </div>  
                                        </div>
                                    </div>
                                    <div class="form-group form-float">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <div class="form-line">
                                                    <label class="form-label">Nomor Pokok Wajib Pajak (NPWP)* <i>maks. 5MB</i></label>
                                                </div>
                                            </div>
                                            <div class="col-md-7">
                                                <div class="form-line">
                                                    <input type="file" class="form-control" name="file_tdp" required>
                                                </div>
                                            </div>  
                                        </div>
                                    </div>
                                    <div class="form-group form-float">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <div class="form-line">
                                                    <label class="form-label">Rekening* <i>maks. 5MB</i></label>
                                                </div>
                                            </div>
                                            <div class="col-md-7">
                                                <div class="form-line">
                                                    <input type="file" class="form-control" name="file_rekening" required>
                                                </div>
                                            </div>  
                                        </div>
                                    </div>
                                    <div class="form-group form-float">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <div class="form-line">
                                                    <label class="form-label">MOU* <i>maks. 5MB</i></label>
                                                </div>
                                            </div>
                                            <div class="col-md-7">
                                                <div class="form-line">
                                                    <input type="file" class="form-control" name="file_mou" required>
                                                </div>
                                            </div>  
                                        </div>
                                    </div>
                                    <div class="form-group form-float">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <div class="form-line">
                                                    <label class="form-label">Sertifikat Uji* <i>maks. 5MB</i></label>
                                                </div>
                                            </div>
                                            <div class="col-md-7">
                                                <div class="form-line">
                                                    <input type="file" class="form-control" name="file_sertifikat_uji" required>
                                                </div>
                                            </div>  
                                        </div>
                                    </div>
                                    <div class="form-group form-float">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <div class="form-line">
                                                    <label class="form-label">Verifikasi Pers* <i>maks. 5MB</i></label>
                                                </div>
                                            </div>
                                            <div class="col-md-7">
                                                <div class="form-line">
                                                    <input type="file" class="form-control" name="file_verifikasi_pers" required>
                                                </div>
                                            </div>  
                                        </div>
                                    </div>
                                    <div class="form-group form-float">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <div class="form-line">
                                                    <label class="form-label">Laporan Pajak (3 bulan terakhir)* <i>maks. 5MB</i></label>
                                                </div>
                                            </div>
                                            <div class="col-md-7">
                                                <div class="form-line">
                                                    <input type="file" class="form-control" name="file_laporan_pajak" required>
                                                </div>
                                            </div>  
                                        </div>
                                    </div>
                                </fieldset>

                                <h3>Personel</h3>
                                <fieldset>
                                    <div class="text-center">
                                        <button type="button" id="btn-tambah-form" class="btn btn-success"><i class="material-icons">person_add</i>Tambah Form Personel</button>
                                        <input type="text" id="jumlah-form" value="1" hidden>
                                    </div>
                                    <br>
                                    
                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                <select class="form-control" name="jabatan_id" required>
                                                    <option value="">-- Pilih jabatan --</option>
                                                    <?php foreach ($jabatan as $row){ ?>
                                                    <option value="<?=$row->id?>"><?=$row->nama_jabatan?></option>
                                                    <?php } ?>
                                                </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="text" class="form-control" name="nama_tenaga" required>
                                                    <label class="form-label">Nama*</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="text" class="form-control" name="nik" required>
                                                    <label class="form-label">NIK*</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="file" class="form-control" name="file" required>
                                                    <label class="form-label">File KTP*</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="text" class="form-control" name="no_hp" required>
                                                    <label class="form-label">No. Telp*</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-1">
                                            
                                        </div>
                                    </div>

                                    <div id="insert-form">
                                    </div>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Advanced Form Example With Validation -->
        </div>
    </section>

    

    <!-- Jquery Core Js -->
    <script src="{{APP_ASSETS}}plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="{{APP_ASSETS}}plugins/bootstrap/js/bootstrap.js"></script>

    <!-- JQuery Steps Plugin Js -->
    <script src="{{APP_ASSETS}}plugins/jquery-steps/jquery.steps.js"></script>

    <!-- Jquery Validation Plugin Css -->
    <script src="{{APP_ASSETS}}plugins/jquery-validation/jquery.validate.js"></script>

    <!-- Select Plugin Js -->
    <!-- <script src="{{APP_ASSETS}}plugins/bootstrap-select/js/bootstrap-select.js"></script> -->

    <!-- Slimscroll Plugin Js -->
    <script src="{{APP_ASSETS}}plugins/jquery-slimscroll/jquery.slimscroll.js"></script>

    <!-- Sweet Alert Plugin Js -->
    <script src="{{APP_ASSETS}}plugins/sweetalert/sweetalert.min.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="{{APP_ASSETS}}plugins/node-waves/waves.js"></script>

    <!-- Custom Js -->
    <script src="{{APP_ASSETS}}js/admin.js"></script>
    <script src="{{APP_ASSETS}}js/pages/forms/form-wizard.js"></script>

    <script>
    $(document).ready(function(){ // Ketika halaman sudah diload dan siap
        $("#btn-tambah-form").click(function(){ // Ketika tombol Tambah Data Form di klik
        var jumlah = parseInt($("#jumlah-form").val()); // Ambil jumlah data form pada textbox jumlah-form
        var nextform = jumlah + 1; // Tambah 1 untuk jumlah form nya  
        if (jumlah <= 50) {
        $("#insert-form").append(
            `<div class="row">
                <div class="col-md-2">
                    <div class="form-group form-float">
                        <div class="form-line">
                        <select class="form-control" name="jabatan_id" required>
                            <option value="">-- Pilih jabatan --</option>
                            <?php foreach ($jabatan as $row){ ?>
                            <option value="<?=$row->id?>"><?=$row->nama_jabatan?></option>
                            <?php } ?>
                        </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group form-float">
                        <div class="form-line">
                            <input type="text" class="form-control" name="nama_tenaga" required>
                            <label class="form-label">Nama*</label>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group form-float">
                        <div class="form-line">
                            <input type="text" class="form-control" name="nik" required>
                            <label class="form-label">NIK*</label>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group form-float">
                        <div class="form-line">
                            <input type="file" class="form-control" name="file" required>
                            <label class="form-label">File KTP*</label>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group form-float">
                        <div class="form-line">
                            <input type="text" class="form-control" name="no_hp" required>
                            <label class="form-label">No. Telp*</label>
                        </div>
                    </div>
                </div>
                <div class="col-md-1">
                <button type="button" id="remove" class="btn btn-danger"><i class="material-icons">delete_forever</i></button>
                </div>
            </div>`
        );

        $("#jumlah-form").val(nextform); // Ubah value textbox jumlah-form dengan variabel nextform
        }
        
        
        });
        
        // Buat fungsi untuk mereset form ke semula
        $("#reset-form").click(function(){
        $("#insert-form").html(""); // Kita kosongkan isi dari div insert-form
        $("#jumlah-form").val("0"); // Ubah kembali value jumlah form menjadi 1
        });
    });

    $(document).on('click', '#remove', function(){
        var jumlah = parseInt($("#jumlah-form").val()); // Ambil jumlah data form pada textbox jumlah-form
        var kurang = jumlah - 1;
        $("#jumlah-form").val(kurang); // Ubah value textbox jumlah-form dengan variabel nextform
        $(this).closest('.row').remove();

    })
</script>
</body>
</html>
