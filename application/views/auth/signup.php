
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Pendaftaran Akun Baru</title>
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

<body class="bg-cyan">
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
            <p>Mohon Tunggu Sebentar...</p>
        </div>
    </div>
    <!-- #END# Page Loader -->

    <div class="text-center" style="padding-top:70px;">
        <p style="font-size:35.5px;margin-bottom:0;"><b>Aplikasi Media</b></p>
        <small>Kabupaten Bintan</small>
    </div>
    <?php if (!empty($message)){
        echo $message;
    } ?>
    <section class="">
        <div class="container-fluid">
            
            <!-- Advanced Form Example With Validation -->
            <div class="row p-t-10">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h5 class="text-center">Registrasi</h5>
                            <p><?php echo $this->session->flashdata('message') ?></p>
                        </div>
                        <div class="body">
                            <?php echo form_open_multipart(site_url('auth/signup'), array('id' => 'wizard_with_validation', 'method' => 'POST'));?>
                                <h3>Informasi Akun</h3>
                                <fieldset>
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="username" value="<?php echo set_value('username'); ?>" required>
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
                                            <input type="text" class="form-control" name="nama_media" value="<?php echo set_value('nama_media'); ?>" required>
                                            <label class="form-label">Nama Media*</label>
                                        </div>
                                    </div>
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="nama_perusahaan" value="<?php echo set_value('nama_perusahaan'); ?>" required>
                                            <label class="form-label">Nama Perusahaan*</label>
                                        </div>
                                    </div>
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="alamat_perusahaan" value="<?php echo set_value('alamat_perusahaan'); ?>" required>
                                            <label class="form-label">Alamat Perusahaan*</label>
                                        </div>
                                    </div>
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="npwp" value="<?php echo set_value('npwp'); ?>" required>
                                            <label class="form-label">NPWP*</label>
                                        </div>
                                    </div>
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="rekening" value="<?php echo set_value('rekening'); ?>" required>
                                            <label class="form-label">Rekening*</label>
                                        </div>
                                    </div>
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="no_telp" value="<?php echo set_value('no_telp'); ?>" required>
                                            <label class="form-label">No. Telp*</label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <select class="form-control" name="tipe_publikasi" value="<?php echo set_value('tipe_publikasi'); ?>" required>
                                                <option value="">-- Pilih tipe publikasi --</option>
                                                <option value="harian" <?php if(set_value('tipe_publikasi') == "harian"){ ?> selected <?php } ?>>Harian</option>
                                                <option value="mingguan" <?php if(set_value('tipe_publikasi') == "mingguan"){ ?> selected <?php } ?>>Mingguan</option>
                                                <option value="bulanan" <?php if(set_value('tipe_publikasi') == "bulanan"){ ?> selected <?php } ?>>Bulanan</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <select class="form-control" name="tipe_media_massa" value="<?php echo set_value('tipe_media_massa'); ?>" required>
                                                <option value="">-- Pilih tipe media massa --</option>
                                                <option value="cetak" <?php if(set_value('tipe_media_massa') == "cetak"){ ?> selected <?php } ?>>Cetak</option>
                                                <option value="online" <?php if(set_value('tipe_media_massa') == "online"){ ?> selected <?php } ?>>Online</option>
                                                <option value="radio" <?php if(set_value('tipe_media_massa') == "radio"){ ?> selected <?php } ?>>Radio</option>
                                                <option value="tv" <?php if(set_value('tipe_media_massa') == "tv"){ ?> selected <?php } ?>>TV</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="jumlah_saham" value="<?php echo set_value('jumlah_saham'); ?>" required>
                                            <label class="form-label">Jumlah Saham*</label>
                                        </div>
                                    </div>
                                </fieldset>

                                <h3>Sosial Media</h3>
                                <fieldset>
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="email" class="form-control" name="email" value="<?php echo set_value('email'); ?>" required>
                                            <label class="form-label">Email*</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="text" class="form-control" name="username_fb" value="<?php echo set_value('username_fb'); ?>" required>
                                                    <label class="form-label">Facebook*</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="number" min="1" class="form-control" name="pengikut_fb" value="<?php echo set_value('pengikut_fb'); ?>" required>
                                                    <label class="form-label">Pengikut Facebook*</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="text" class="form-control" name="username_ig" value="<?php echo set_value('username_ig'); ?>" required>
                                                    <label class="form-label">Instagram*</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="number" min="1" class="form-control" name="pengikut_ig" value="<?php echo set_value('pengikut_ig'); ?>" required>
                                                    <label class="form-label">Pengikut Instagram*</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="text" class="form-control" name="username_twitter" value="<?php echo set_value('username_twitter'); ?>" required>
                                                    <label class="form-label">Twitter*</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="number" min="1" class="form-control" name="pengikut_twitter" value="<?php echo set_value('pengikut_twitter'); ?>" required>
                                                    <label class="form-label">Pengikut Twitter*</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="text" class="form-control" name="channel_youtube" value="<?php echo set_value('channel_youtube'); ?>" required>
                                                    <label class="form-label">Youtube*</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="number" min="1" class="form-control" name="subscriber_youtube" value="<?php echo set_value('subscriber_youtube'); ?>" required>
                                                    <label class="form-label">Subscriber Youtube*</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>

                                <h3>Berkas Pendukung</h3>
                                <fieldset>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="form-label">Akta Pendirian dan Perubahan Terakhir* <i>maks. 2MB</i></label>
                                            <div class="form-group form-float">
                                                <div class="form-line"> 
                                                    <input type="file" class="form-control" name="berkas_1" required accept="application/pdf">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Surat Izin Tempat Usaha (SITU)* <i>maks. 2MB</i></label>
                                            <div class="form-group form-float">
                                                <div class="form-line"> 
                                                <input type="file" class="form-control" name="berkas_2" required accept="application/pdf">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="form-label">Surat Izin Usaha Perdagangan (SIUP)* <i>maks. 2MB</i></label>
                                            <div class="form-group form-float">
                                                <div class="form-line"> 
                                                    <input type="file" class="form-control" name="berkas_3" required accept="application/pdf">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Tanda Daftar Perusahaan (TDP)* <i>maks. 2MB</i></label>
                                            <div class="form-group form-float">
                                                <div class="form-line"> 
                                                    <input type="file" class="form-control" name="berkas_4" required accept="application/pdf">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="form-label">Nomor Pokok Wajib Pajak (NPWP)* <i>maks. 2MB</i></label>
                                            <div class="form-group form-float">
                                                <div class="form-line"> 
                                                    <input type="file" class="form-control" name="berkas_5" required accept="image/*">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Rekening* <i>maks. 2MB</i></label>
                                            <div class="form-group form-float">
                                                <div class="form-line"> 
                                                <input type="file" class="form-control" name="berkas_6" required accept="image/*">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="form-label">MOU* <i>maks. 2MB</i></label>
                                            <div class="form-group form-float">
                                                <div class="form-line"> 
                                                    <input type="file" class="form-control" name="berkas_7" required accept="application/pdf">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Sertifikat Uji* <i>maks. 2MB</i></label>
                                            <div class="form-group form-float">
                                                <div class="form-line"> 
                                                    <input type="file" class="form-control" name="berkas_8" required accept="application/pdf">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="form-label">Logo Media* <i>maks. 2MB</i></label>
                                            <div class="form-group form-float">
                                                <div class="form-line"> 
                                                <input type="file" class="form-control" name="berkas_9" required accept="image/*">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Verifikasi Pers* <i>maks. 2MB</i></label>
                                            <div class="form-group form-float">
                                                <div class="form-line"> 
                                                    <input type="file" class="form-control" name="berkas_10" required accept="application/pdf">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="form-label">Laporan Pajak (3 bulan terakhir)* <i>maks. 2MB</i></label>
                                            <div class="form-group form-float">
                                                <div class="form-line"> 
                                                    <input type="file" class="form-control" name="berkas_11" required accept="application/pdf">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Sertifikat* <i>maks. 2MB</i></label>
                                            <div class="form-group form-float">
                                                <div class="form-line"> 
                                                    <input type="file" class="form-control" name="berkas_12" required accept="application/pdf">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>

                                <h3>Personel</h3>
                                <fieldset>
                                    <h4>Direktur</h4>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="form-label">Jabatan*</label>
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                <select class="form-control" name="jabatan_id1" value="<?php echo set_value('jabatan_id1'); ?>" required>
                                                    <option value="1">Direktur</option>
                                                </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Nama*</label>
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="text" class="form-control" name="nama_tenaga1" value="<?php echo set_value('nama_tenaga1'); ?>" required>  
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="form-label">NIK*</label>
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="text" class="form-control" name="nik1" value="<?php echo set_value('nik1'); ?>" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">File KTP* <i>maks. 2MB</i></label>
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="file" class="form-control" name="file1" required accept="image/*">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="form-label">No. Telp*</label>
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="text" class="form-control" name="no_hp1" value="<?php echo set_value('no_hp1'); ?>" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">File Sertifikat* <i>maks. 2MB</i></label>
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="file" class="form-control" name="file_sertifikat1" required accept="application/pdf">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <h4>Komanditer/Komisaris</h4>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="form-label">Jabatan*</label>
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                <select class="form-control" name="jabatan_id2" value="<?php echo set_value('jabatan_id2'); ?>" required>
                                                    <option value="2">Komanditer/Komisaris</option>
                                                </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Nama*</label>
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="text" class="form-control" name="nama_tenaga2" value="<?php echo set_value('nama_tenaga2'); ?>" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="form-label">NIK*</label>
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="text" class="form-control" name="nik2" value="<?php echo set_value('nik2'); ?>" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">File KTP* <i>maks. 2MB</i></label>
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="file" class="form-control" name="file2" required accept="image/*">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="form-label">No. Telp*</label>
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="text" class="form-control" name="no_hp2" value="<?php echo set_value('no_hp2'); ?>" required>  
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">File Sertifikat* <i>maks. 2MB</i></label>
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="file" class="form-control" name="file_sertifikat2" required accept="application/pdf">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <h4>Pimpinan Redaksi</h4>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="form-label">Jabatan*</label>
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                <select class="form-control" name="jabatan_id3" value="<?php echo set_value('jabatan_id3'); ?>" required>
                                                    <option value="3">Pimpinan Redaksi</option>
                                                </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Nama*</label>
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="text" class="form-control" name="nama_tenaga3" value="<?php echo set_value('nama_tenaga3'); ?>" required>  
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="form-label">NIK*</label>
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="text" class="form-control" name="nik3" value="<?php echo set_value('nik3'); ?>" required>  
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">File KTP* <i>maks. 2MB</i></label>
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="file" class="form-control" name="file3" required accept="image/*">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="form-label">No. Telp*</label>
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="text" class="form-control" name="no_hp3" value="<?php echo set_value('no_hp3'); ?>" required>  
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">File Sertifikat* <i>maks. 2MB</i></label>
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="file" class="form-control" name="file_sertifikat3" required accept="application/pdf">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <h4>Kepala Biro</h4>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="form-label">Jabatan*</label>
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                <select class="form-control" name="jabatan_id4" value="<?php echo set_value('jabatan_id4'); ?>" required>
                                                    <option value="4">Kabiro</option>
                                                </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Nama*</label>
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="text" class="form-control" name="nama_tenaga4" value="<?php echo set_value('nama_tenaga4'); ?>" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="form-label">NIK*</label>
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="text" class="form-control" name="nik4" value="<?php echo set_value('nik4'); ?>" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">File KTP* <i>maks. 2MB</i></label>
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="file" class="form-control" name="file4" required accept="image/*">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="form-label">No. Telp*</label>
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="text" class="form-control" name="no_hp4" value="<?php echo set_value('no_hp4'); ?>" required>   
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">File Sertifikat* <i>maks. 2MB</i></label>
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="file" class="form-control" name="file_sertifikat4" required accept="application/pdf">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <h4>Wartawan/Reporter</h4>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="form-label">Jabatan*</label>
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                <select class="form-control" name="jabatan_id5" value="<?php echo set_value('no_hp4'); ?>" required>
                                                    <option value="5">Wartawan/Reporter</option>
                                                </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Nama*</label>
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="text" class="form-control" name="nama_tenaga5" value="<?php echo set_value('nama_tenaga5'); ?>" required> 
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="form-label">NIK*</label>
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="text" class="form-control" name="nik5" value="<?php echo set_value('nik5'); ?>" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">File KTP* <i>maks. 2MB</i></label>
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="file" class="form-control" name="file5" required accept="image/*">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="form-label">No. Telp*</label>
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="text" class="form-control" name="no_hp5" value="<?php echo set_value('no_hp5'); ?>" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">File Sertifikat* <i>maks. 2MB</i></label>
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="file" class="form-control" name="file_sertifikat5" required accept="application/pdf">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <h4>Wartawan/Reporter</h4>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="form-label">Jabatan*</label>
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                <select class="form-control" name="jabatan_id6" value="<?php echo set_value('jabatan_id6'); ?>" required>
                                                    <option value="5">Wartawan/Reporter</option>
                                                </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Nama*</label>
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="text" class="form-control" name="nama_tenaga6" value="<?php echo set_value('nama_tenaga6'); ?>" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">NIK*</label>
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="text" class="form-control" name="nik6" value="<?php echo set_value('nik6'); ?>" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">File KTP* <i>maks. 2MB</i></label>
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="file" class="form-control" name="file6" required accept="image/*">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">No. Telp*</label>
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="text" class="form-control" name="no_hp6" value="<?php echo set_value('no_hp6'); ?>" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">File Sertifikat* <i>maks. 2MB</i></label>
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="file" class="form-control" name="file_sertifikat6" required accept="application/pdf">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <h4>Wartawan/Reporter</h4>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="form-label">Jabatan*</label>
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                <select class="form-control" name="jabatan_id7" value="<?php echo set_value('jabatan_id7'); ?>" required>
                                                <option value="5">Wartawan/Reporter</option>
                                                </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Nama*</label>
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="text" class="form-control" name="nama_tenaga7" value="<?php echo set_value('nama_tenaga7'); ?>" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="form-label">NIK*</label>
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="text" class="form-control" name="nik7" value="<?php echo set_value('nik7'); ?>" required> 
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">File KTP* <i>maks. 2MB</i></label>
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="file" class="form-control" name="file7" required accept="image/*">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="form-label">No. Telp*</label>
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="text" class="form-control" name="no_hp7" value="<?php echo set_value('no_hp7'); ?>" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">File Sertifikat* <i>maks. 2MB</i></label>
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="file" class="form-control" name="file_sertifikat7" required accept="application/pdf">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                                <?= form_close() ?>
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
    <!-- <script src="{{APP_ASSETS}}js/pages/forms/form-wizard.js"></script> -->

    <script>
        //Advanced form with validation
    var form = $('#wizard_with_validation').show();
    form.steps({
        headerTag: 'h3',
        bodyTag: 'fieldset',
        transitionEffect: 'slideLeft',
        onInit: function (event, currentIndex) {
            $.AdminBSB.input.activate();

            //Set tab width
            var $tab = $(event.currentTarget).find('ul[role="tablist"] li');
            var tabCount = $tab.length;
            $tab.css('width', (100 / tabCount) + '%');

            //set button waves effect
            setButtonWavesEffect(event);
        },
        onStepChanging: function (event, currentIndex, newIndex) {
            if (currentIndex > newIndex) { return true; }

            if (currentIndex < newIndex) {
                form.find('.body:eq(' + newIndex + ') label.error').remove();
                form.find('.body:eq(' + newIndex + ') .error').removeClass('error');
            }

            form.validate().settings.ignore = ':disabled,:hidden';
            return form.valid();
        },
        onStepChanged: function (event, currentIndex, priorIndex) {
            setButtonWavesEffect(event);
        },
        onFinishing: function (event, currentIndex) {
            form.validate().settings.ignore = ':disabled';
            return form.valid();
        },
        onFinished: function (event, currentIndex) {
           $('#wizard_with_validation').submit();
        }
    });
    </script>
</body>
</html>
