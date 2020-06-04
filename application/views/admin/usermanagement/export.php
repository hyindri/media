<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html>
<head>
  <title><?php if (!empty($title)) echo $title;?></title>
</head>
<!-- @include('user.tambahan.script') -->
<style type="text/css">
tbody:before, tbody:after { display: none; }
#tbleft, #tbright, #tbcenter { page-break-inside: avoid; }
table, th, td { border: 1px solid black; }
</style>
<body>
    <div class="container page">
        <table style="border-collapse:collapse;border:none;width:100%;margin:0;padding:0;">
            <tr>
                <td rowspan="4" style="text-align:right;border:none;width:25%;"><img src="assets/images/bintan.png" width=100px;></td>
                <td style="text-align:center;font-size:20px;border:none;font-weight:bold;width:50%;">PEMERINTAH KABUPATEN BINTAN</td>
                <td rowspan="4" style="text-align:left;border:none;width:25%;"><img src="assets/images/kominfo.png" width=100px;></td>
            </tr>
            <tr>
                <td style="text-align:center;font-size:24px;border:none;font-weight:bold;">DINAS KOMUNIKASI DAN INFORMATIKA</td>
            </tr>
            <tr>
                <td style="text-align:center;font-size:16px;border:none;">Jl. Raya Tanjungpinang -  Tanjung Uban Km. 42</td>
            </tr>
            <tr>
                <td style="text-align:center;font-size:16px;border:none;">Email: Kominfo@bintankab.go.id</td>
            </tr>
        </table>
        <hr>
        <br>
        <h4 style="text-align:center;">DAFTAR MEDIA MASSA YANG MELAKUKAN KERJA SAMA DENGAN <br> PEMERINTAH KABUPATEN BINTAN</h4>
        <br>
        <table id="table" style="font-size:13px;border-collapse:collapse;width:100%;">
            <thead>
                <tr>
                    <th style="padding:3;height:30;">No</th>
                    <th style="padding:3;">Nama</th>
                    <th style="padding:3;">Perusahaan</th>
                    <th style="padding:3;">Pemimpin</th>
                    <th style="padding:3;">Kabiro</th>
                    <th style="padding:3;">Tipe Publikasi</th>
                    <th style="padding:3;">Jenis Media Massa</th>
                    <th style="padding:3;">Mulai MOU</th>
                    <th style="padding:3;">Akhir MOU</th>
                </tr>
            </thead>
            <tbody>
            <?php $no=1; ?>
            <?php foreach($mediamassa as $media){ ?>
                <tr>
                    <td style="text-align:center;padding:3;"><?= $no++; ?></td>
                    <td style="padding:3;word-wrap: break-word;"><?= $media->nama ?></td>
                    <td style="padding:3;word-wrap: break-word;"><?= $media->perusahaan ?></td>
                    <td style="padding:3;word-wrap: break-word;"><?= $media->pemimpin ?></td>
                    <td style="padding:3;word-wrap: break-word;"><?= $media->kabiro ?></td>
                    <td style="padding:3;text-align:center;"><?= ucfirst($media->tipe_publikasi) ?></td>
                    <td style="padding:3;text-align:center;"><?= ucwords(remo($media->tipe_media_massa)) ?></td>
                    
                    <td style="padding:3;text-align:center;"><?= tgl_indo($media->mulai_mou) ?></td>
                    <td style="padding:3;text-align:center;"><?= tgl_indo($media->akhir_mou) ?></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>

<?php
function tgl_indo($tanggal){
  $bulan = array (
    1 =>   'Januari',
    'Februari',
    'Maret',
    'April',
    'Mei',
    'Juni',
    'Juli',
    'Agustus',
    'September',
    'Oktober',
    'November',
    'Desember'
  );
  $pecahkan = explode('-', $tanggal);
  
  // variabel pecahkan 0 = tahun
  // variabel pecahkan 1 = bulan
  // variabel pecahkan 2 = tanggal

  return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
}

function remo($tipe)
{
    $pisah = str_replace(',', ', ',$tipe);
    return $pisah;
}
?>
</body>
</html>