<?php
require '../../vendor/autoload.php'; // sesuaikan path Composer autoload

use Dompdf\Dompdf;
use Dompdf\Options;

// koneksi database
include('../../config/koneksi.php');

// ambil data penduduk
$query = mysqli_query($connect, "SELECT * FROM penduduk");

// ambil profil desa (untuk nama_desa)
$qTampilDesa = mysqli_query($connect, "SELECT * FROM profil_desa WHERE id_profil_desa = '1'");
$rows = mysqli_fetch_assoc($qTampilDesa);

// atur opsi dompdf
$options = new Options();
$options->set('isRemoteEnabled', true);
$dompdf = new Dompdf($options);

// array bulan indo
$bulanIndo = array(
  'January' => 'Januari',
  'February' => 'Februari',
  'March' => 'Maret',
  'April' => 'April',
  'May' => 'Mei',
  'June' => 'Juni',
  'July' => 'Juli',
  'August' => 'Agustus',
  'September' => 'September',
  'October' => 'Oktober',
  'November' => 'November',
  'December' => 'Desember'
);

$tanggal = date('d');
$bulan = date('F');
$tahun = date('Y');
$tanggalCetak = $tanggal . ' ' . $bulanIndo[$bulan] . ' ' . $tahun;

// HTML awal
$html = '
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Cetak PDF</title>
  <link rel="shortcut icon" href="../../assets/img/logo-lampura.png" type="image/x-icon">
  <style>
    body { font-family: Cambria, "Times New Roman", serif; font-size: 12px; }
    table { border-collapse: collapse; width: 100%; }
    th, td { border: 1px solid #000; padding: 6px; }
    th { background: #f2f2f2; text-align: center; }
  </style>
</head>
<body>

<h2 style="text-align:center; margin-bottom:0;">Data Penduduk Desa Pagar</h2>
<h3 style="text-align:center; margin-top:5px; margin-bottom:20px;">
  Kecamatan Blambangan Pagar Kabupaten Lampung Utara
</h3>

<table>
  <thead>
    <tr>
      <th>No</th>
      <th>NIK</th>
      <th>Nama</th>
      <th>Tempat, Tanggal Lahir</th>
      <th>Jenis Kelamin</th>
      <th>Agama</th>
      <th>Alamat</th>
    </tr>
  </thead>
  <tbody>
';

$no = 1;
while ($row = mysqli_fetch_assoc($query)) {
  $tanggal = date('d', strtotime($row['tgl_lahir']));
  $bulan = date('F', strtotime($row['tgl_lahir']));
  $tahun = date('Y', strtotime($row['tgl_lahir']));
  $tgl_lahir = $tanggal . ' ' . $bulanIndo[$bulan] . ' ' . $tahun;

  $alamat = 'Dsn. ' . $row['dusun'] . ', RT' . $row['rt'] . '/RW' . $row['rw'];

  $html .= '
    <tr>
      <td style="text-align:center;">' . $no++ . '</td>
      <td>' . $row['nik'] . '</td>
      <td style="text-transform: capitalize;">' . $row['nama'] . '</td>
      <td style="text-transform: capitalize;">' . $row['tempat_lahir'] . ', ' . $tgl_lahir . '</td>
      <td style="text-align:center;">' . $row['jenis_kelamin'] . '</td>
      <td style="text-align:center;">' . $row['agama'] . '</td>
      <td style="text-transform: capitalize;">' . $alamat . '</td>
    </tr>
  ';
}

$html .= '
  </tbody>
</table>

<!-- Tanda Tangan -->
<table width="100%" style="margin-top:50px; border:none;">
  <tr style="border:none;">
    <td width="60%" style="border:none;"></td>
    <td width="40%" style="text-align:center; border:none;">
      ' . ucwords($rows['nama_desa']) . ', ' . $tanggalCetak . '
    </td>
  </tr>
  <tr style="border:none;">
    <td style="border:none;"></td>
    <td style="text-align:center; border:none;">
      Mengetahui,<br>Kasi Pelayanan
    </td>
  </tr>
  <tr style="border:none;">
    <td style="border:none;"></td>
    <td style="padding-top:80px; text-align:center; border:none;">
      <u><b>Ulfi Lailatul Fitri, Amd., P.</b></u>
    </td>
  </tr>
</table>

</body>
</html>
';

// load ke dompdf
$dompdf->loadHtml($html);

// set ukuran kertas dan orientasi
$dompdf->setPaper('A4', 'landscape');

// render pdf
$dompdf->render();

// output ke browser
$dompdf->stream("Data_Penduduk.pdf", array("Attachment" => false));
exit;
