<html>

<head>
  <link rel="shortcut icon" href="../../assets/img/mini-logo.png">
  <title>CETAK LAPORAN</title>
  <style>
    @page {
      margin: 2cm;
      color: none;
    }

    body {
      font-family: "Times New Roman", Times, serif;
    }

    hr {
      border-bottom: 1px solid #000000;
      height: 0px;
    }
  </style>
</head>

<body>
  <?php
  include "../../config/koneksi.php";
  if (isset($_GET['filter']) && !empty($_GET['filter'])) {
    $filter = $_GET['filter'];
    if ($filter == '1') {
      echo '
          <div class="header">
            <div align="center" style="font-size: 14pt;"><b>Laporan Surat Administrasi Desa - Surat Keluar Desa Pagar</b></div>
            <hr>
          </div><br>
        ';

      $query = "
              SELECT penduduk.nama, penduduk.dusun, penduduk.rt, penduduk.rw, sk_ahli_waris.no_surat, sk_ahli_waris.tanggal_surat, 'SK Ahli Waris' AS jenis_surat 
              FROM penduduk LEFT JOIN sk_ahli_waris ON sk_ahli_waris.nik = penduduk.nik WHERE sk_ahli_waris.status_surat='selesai'
              
              UNION
              SELECT penduduk.nama, penduduk.dusun, penduduk.rt, penduduk.rw, sk_gangguan_jiwa.no_surat, sk_gangguan_jiwa.tanggal_surat, 'SK Gangguan Jiwa' AS jenis_surat 
              FROM penduduk LEFT JOIN sk_gangguan_jiwa ON sk_gangguan_jiwa.nik = penduduk.nik WHERE sk_gangguan_jiwa.status_surat='selesai'

              UNION
              SELECT penduduk.nama, penduduk.dusun, penduduk.rt, penduduk.rw, NULL AS no_surat, sk_jual_beli.tanggal_surat, 'SK Jual Beli' AS jenis_surat 
              FROM penduduk LEFT JOIN sk_jual_beli ON sk_jual_beli.nik = penduduk.nik WHERE sk_jual_beli.status_surat='selesai'

              UNION
              SELECT penduduk.nama, penduduk.dusun, penduduk.rt, penduduk.rw, sk_kehilangan.no_surat, sk_kehilangan.tanggal_surat, 'SK Kehilangan' AS jenis_surat 
              FROM penduduk LEFT JOIN sk_kehilangan ON sk_kehilangan.nik = penduduk.nik WHERE sk_kehilangan.status_surat='selesai'

              UNION
              SELECT penduduk.nama, penduduk.dusun, penduduk.rt, penduduk.rw, sk_kematian.no_surat, sk_kematian.tanggal_surat, 'SK Kematian' AS jenis_surat 
              FROM penduduk LEFT JOIN sk_kematian ON sk_kematian.nik = penduduk.nik WHERE sk_kematian.status_surat='selesai'

              UNION
              SELECT penduduk.nama, penduduk.dusun, penduduk.rt, penduduk.rw, NULL AS no_surat, sk_kuasa.tanggal_surat, 'SK Kuasa' AS jenis_surat 
              FROM penduduk LEFT JOIN sk_kuasa ON sk_kuasa.nik = penduduk.nik WHERE sk_kuasa.status_surat='selesai'

              UNION
              SELECT penduduk.nama, penduduk.dusun, penduduk.rt, penduduk.rw, sk_pengantar_skck.no_surat, sk_pengantar_skck.tanggal_surat, 'SK Pengantar SKCK' AS jenis_surat 
              FROM penduduk LEFT JOIN sk_pengantar_skck ON sk_pengantar_skck.nik = penduduk.nik WHERE sk_pengantar_skck.status_surat='selesai'

              UNION
              SELECT penduduk.nama, penduduk.dusun, penduduk.rt, penduduk.rw, sk_penghasilan_orang_tua.no_surat, sk_penghasilan_orang_tua.tanggal_surat, 'SK Penghasilan Orang Tua' AS jenis_surat 
              FROM penduduk LEFT JOIN sk_penghasilan_orang_tua ON sk_penghasilan_orang_tua.nik = penduduk.nik WHERE sk_penghasilan_orang_tua.status_surat='selesai'

              UNION
              SELECT penduduk.nama, penduduk.dusun, penduduk.rt, penduduk.rw, sk_tidak_mampu.no_surat, sk_tidak_mampu.tanggal_surat, 'SK Tidak Mampu' AS jenis_surat 
              FROM penduduk LEFT JOIN sk_tidak_mampu ON sk_tidak_mampu.nik = penduduk.nik WHERE sk_tidak_mampu.status_surat='selesai'

              UNION
              SELECT penduduk.nama, penduduk.dusun, penduduk.rt, penduduk.rw, sk_usaha.no_surat, sk_usaha.tanggal_surat, 'SK Usaha' AS jenis_surat 
              FROM penduduk LEFT JOIN sk_usaha ON sk_usaha.nik = penduduk.nik WHERE sk_usaha.status_surat='selesai'

              UNION
              SELECT penduduk.nama, penduduk.dusun, penduduk.rt, penduduk.rw, surat_keterangan_domisili.no_surat, surat_keterangan_domisili.tanggal_surat, 'Surat Keterangan Domisili' AS jenis_surat 
              FROM penduduk LEFT JOIN surat_keterangan_domisili ON surat_keterangan_domisili.nik = penduduk.nik WHERE surat_keterangan_domisili.status_surat='selesai'
              
              ORDER BY tanggal_surat
            ";
    } else if ($filter == '2') {
      $tgl = date('d-m-y', strtotime($_GET['tanggal']));
      echo '
          <div class="header">
            <div align="center" style="font-size: 12pt;"><b>Laporan Surat Administrasi Desa - Surat Keluar Desa Pagar</b></div>
            <div align="center" style="font-size: 12pt;"><b>Tanggal ' . $tgl . '</b></div>
            <hr>
          </div><br>
        ';

      $tanggal = $_GET['tanggal'];
      $query = "
              SELECT penduduk.nama, penduduk.dusun, penduduk.rt, penduduk.rw, sk_ahli_waris.no_surat, sk_ahli_waris.tanggal_surat, 'SK Ahli Waris' AS jenis_surat 
              FROM penduduk 
              LEFT JOIN sk_ahli_waris ON sk_ahli_waris.nik = penduduk.nik 
              WHERE sk_ahli_waris.status_surat='selesai' AND DATE(sk_ahli_waris.tanggal_surat) = '$tanggal'

              UNION
              SELECT penduduk.nama, penduduk.dusun, penduduk.rt, penduduk.rw, sk_gangguan_jiwa.no_surat, sk_gangguan_jiwa.tanggal_surat, 'SK Gangguan Jiwa' AS jenis_surat 
              FROM penduduk 
              LEFT JOIN sk_gangguan_jiwa ON sk_gangguan_jiwa.nik = penduduk.nik 
              WHERE sk_gangguan_jiwa.status_surat='selesai' AND DATE(sk_gangguan_jiwa.tanggal_surat) = '$tanggal'

              UNION
              SELECT penduduk.nama, penduduk.dusun, penduduk.rt, penduduk.rw, NULL AS no_surat, sk_jual_beli.tanggal_surat, 'SK Jual Beli' AS jenis_surat 
              FROM penduduk 
              LEFT JOIN sk_jual_beli ON sk_jual_beli.nik = penduduk.nik 
              WHERE sk_jual_beli.status_surat='selesai' AND DATE(sk_jual_beli.tanggal_surat) = '$tanggal'

              UNION
              SELECT penduduk.nama, penduduk.dusun, penduduk.rt, penduduk.rw, sk_kehilangan.no_surat, sk_kehilangan.tanggal_surat, 'SK Kehilangan' AS jenis_surat 
              FROM penduduk 
              LEFT JOIN sk_kehilangan ON sk_kehilangan.nik = penduduk.nik 
              WHERE sk_kehilangan.status_surat='selesai' AND DATE(sk_kehilangan.tanggal_surat) = '$tanggal'

              UNION
              SELECT penduduk.nama, penduduk.dusun, penduduk.rt, penduduk.rw, sk_kematian.no_surat, sk_kematian.tanggal_surat, 'SK Kematian' AS jenis_surat 
              FROM penduduk 
              LEFT JOIN sk_kematian ON sk_kematian.nik = penduduk.nik 
              WHERE sk_kematian.status_surat='selesai' AND DATE(sk_kematian.tanggal_surat) = '$tanggal'

              UNION
              SELECT penduduk.nama, penduduk.dusun, penduduk.rt, penduduk.rw, NULL AS no_surat, sk_kuasa.tanggal_surat, 'SK Kuasa' AS jenis_surat 
              FROM penduduk 
              LEFT JOIN sk_kuasa ON sk_kuasa.nik = penduduk.nik 
              WHERE sk_kuasa.status_surat='selesai' AND DATE(sk_kuasa.tanggal_surat) = '$tanggal'

              UNION
              SELECT penduduk.nama, penduduk.dusun, penduduk.rt, penduduk.rw, sk_pengantar_skck.no_surat, sk_pengantar_skck.tanggal_surat, 'SK Pengantar SKCK' AS jenis_surat 
              FROM penduduk 
              LEFT JOIN sk_pengantar_skck ON sk_pengantar_skck.nik = penduduk.nik 
              WHERE sk_pengantar_skck.status_surat='selesai' AND DATE(sk_pengantar_skck.tanggal_surat) = '$tanggal'

              UNION
              SELECT penduduk.nama, penduduk.dusun, penduduk.rt, penduduk.rw, sk_penghasilan_orang_tua.no_surat, sk_penghasilan_orang_tua.tanggal_surat, 'SK Penghasilan Orang Tua' AS jenis_surat 
              FROM penduduk 
              LEFT JOIN sk_penghasilan_orang_tua ON sk_penghasilan_orang_tua.nik = penduduk.nik 
              WHERE sk_penghasilan_orang_tua.status_surat='selesai' AND DATE(sk_penghasilan_orang_tua.tanggal_surat) = '$tanggal'

              UNION
              SELECT penduduk.nama, penduduk.dusun, penduduk.rt, penduduk.rw, sk_tidak_mampu.no_surat, sk_tidak_mampu.tanggal_surat, 'SK Tidak Mampu' AS jenis_surat 
              FROM penduduk 
              LEFT JOIN sk_tidak_mampu ON sk_tidak_mampu.nik = penduduk.nik 
              WHERE sk_tidak_mampu.status_surat='selesai' AND DATE(sk_tidak_mampu.tanggal_surat) = '$tanggal'

              UNION
              SELECT penduduk.nama, penduduk.dusun, penduduk.rt, penduduk.rw, sk_usaha.no_surat, sk_usaha.tanggal_surat, 'SK Usaha' AS jenis_surat 
              FROM penduduk 
              LEFT JOIN sk_usaha ON sk_usaha.nik = penduduk.nik 
              WHERE sk_usaha.status_surat='selesai' AND DATE(sk_usaha.tanggal_surat) = '$tanggal'

              UNION
              SELECT penduduk.nama, penduduk.dusun, penduduk.rt, penduduk.rw, surat_keterangan_domisili.no_surat, surat_keterangan_domisili.tanggal_surat, 'Surat Keterangan Domisili' AS jenis_surat 
              FROM penduduk 
              LEFT JOIN surat_keterangan_domisili ON surat_keterangan_domisili.nik = penduduk.nik 
              WHERE surat_keterangan_domisili.status_surat='selesai' AND DATE(surat_keterangan_domisili.tanggal_surat) = '$tanggal'

              ORDER BY tanggal_surat
            ";
    } else if ($filter == '3') {
      $nama_bulan = array('', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
      echo '
          <div class="header">
            <div align="center" style="font-size: 12pt;"><b>Laporan Surat Administrasi Desa - Surat Keluar Desa Pagar</b></div>
            <div align="center" style="font-size: 12pt;"><b>Bulan ' . $nama_bulan[$_GET['bulan']] . ' ' . $_GET['tahun'] . '</b></div>
            <hr>
          </div><br>
        ';

      $bulan = $_GET['bulan'];
      $tahun = $_GET['tahun'];
      $query = "
              SELECT penduduk.nama, penduduk.dusun, penduduk.rt, penduduk.rw, sk_ahli_waris.no_surat, sk_ahli_waris.tanggal_surat, 'SK Ahli Waris' AS jenis_surat 
              FROM penduduk 
              LEFT JOIN sk_ahli_waris ON sk_ahli_waris.nik = penduduk.nik 
              WHERE sk_ahli_waris.status_surat='selesai' AND MONTH(sk_ahli_waris.tanggal_surat) = '$bulan' AND YEAR(sk_ahli_waris.tanggal_surat) = '$tahun'

              UNION
              SELECT penduduk.nama, penduduk.dusun, penduduk.rt, penduduk.rw, sk_gangguan_jiwa.no_surat, sk_gangguan_jiwa.tanggal_surat, 'SK Gangguan Jiwa' AS jenis_surat 
              FROM penduduk 
              LEFT JOIN sk_gangguan_jiwa ON sk_gangguan_jiwa.nik = penduduk.nik 
              WHERE sk_gangguan_jiwa.status_surat='selesai' AND MONTH(sk_gangguan_jiwa.tanggal_surat) = '$bulan' AND YEAR(sk_gangguan_jiwa.tanggal_surat) = '$tahun'

              UNION
              SELECT penduduk.nama, penduduk.dusun, penduduk.rt, penduduk.rw, NULL AS no_surat, sk_jual_beli.tanggal_surat, 'SK Jual Beli' AS jenis_surat 
              FROM penduduk 
              LEFT JOIN sk_jual_beli ON sk_jual_beli.nik = penduduk.nik 
              WHERE sk_jual_beli.status_surat='selesai' AND MONTH(sk_jual_beli.tanggal_surat) = '$bulan' AND YEAR(sk_jual_beli.tanggal_surat) = '$tahun'

              UNION
              SELECT penduduk.nama, penduduk.dusun, penduduk.rt, penduduk.rw, sk_kehilangan.no_surat, sk_kehilangan.tanggal_surat, 'SK Kehilangan' AS jenis_surat 
              FROM penduduk 
              LEFT JOIN sk_kehilangan ON sk_kehilangan.nik = penduduk.nik 
              WHERE sk_kehilangan.status_surat='selesai' AND MONTH(sk_kehilangan.tanggal_surat) = '$bulan' AND YEAR(sk_kehilangan.tanggal_surat) = '$tahun'

              UNION
              SELECT penduduk.nama, penduduk.dusun, penduduk.rt, penduduk.rw, sk_kematian.no_surat, sk_kematian.tanggal_surat, 'SK Kematian' AS jenis_surat 
              FROM penduduk 
              LEFT JOIN sk_kematian ON sk_kematian.nik = penduduk.nik 
              WHERE sk_kematian.status_surat='selesai' AND MONTH(sk_kematian.tanggal_surat) = '$bulan' AND YEAR(sk_kematian.tanggal_surat) = '$tahun'

              UNION
              SELECT penduduk.nama, penduduk.dusun, penduduk.rt, penduduk.rw, NULL AS no_surat, sk_kuasa.tanggal_surat, 'SK Kuasa' AS jenis_surat 
              FROM penduduk 
              LEFT JOIN sk_kuasa ON sk_kuasa.nik = penduduk.nik 
              WHERE sk_kuasa.status_surat='selesai' AND MONTH(sk_kuasa.tanggal_surat) = '$bulan' AND YEAR(sk_kuasa.tanggal_surat) = '$tahun'

              UNION
              SELECT penduduk.nama, penduduk.dusun, penduduk.rt, penduduk.rw, sk_pengantar_skck.no_surat, sk_pengantar_skck.tanggal_surat, 'SK Pengantar SKCK' AS jenis_surat 
              FROM penduduk 
              LEFT JOIN sk_pengantar_skck ON sk_pengantar_skck.nik = penduduk.nik 
              WHERE sk_pengantar_skck.status_surat='selesai' AND MONTH(sk_pengantar_skck.tanggal_surat) = '$bulan' AND YEAR(sk_pengantar_skck.tanggal_surat) = '$tahun'

              UNION
              SELECT penduduk.nama, penduduk.dusun, penduduk.rt, penduduk.rw, sk_penghasilan_orang_tua.no_surat, sk_penghasilan_orang_tua.tanggal_surat, 'SK Penghasilan Orang Tua' AS jenis_surat 
              FROM penduduk 
              LEFT JOIN sk_penghasilan_orang_tua ON sk_penghasilan_orang_tua.nik = penduduk.nik 
              WHERE sk_penghasilan_orang_tua.status_surat='selesai' AND MONTH(sk_penghasilan_orang_tua.tanggal_surat) = '$bulan' AND YEAR(sk_penghasilan_orang_tua.tanggal_surat) = '$tahun'

              UNION
              SELECT penduduk.nama, penduduk.dusun, penduduk.rt, penduduk.rw, sk_tidak_mampu.no_surat, sk_tidak_mampu.tanggal_surat, 'SK Tidak Mampu' AS jenis_surat 
              FROM penduduk 
              LEFT JOIN sk_tidak_mampu ON sk_tidak_mampu.nik = penduduk.nik 
              WHERE sk_tidak_mampu.status_surat='selesai' AND MONTH(sk_tidak_mampu.tanggal_surat) = '$bulan' AND YEAR(sk_tidak_mampu.tanggal_surat) = '$tahun'

              UNION
              SELECT penduduk.nama, penduduk.dusun, penduduk.rt, penduduk.rw, sk_usaha.no_surat, sk_usaha.tanggal_surat, 'SK Usaha' AS jenis_surat 
              FROM penduduk 
              LEFT JOIN sk_usaha ON sk_usaha.nik = penduduk.nik 
              WHERE sk_usaha.status_surat='selesai' AND MONTH(sk_usaha.tanggal_surat) = '$bulan' AND YEAR(sk_usaha.tanggal_surat) = '$tahun'

              UNION
              SELECT penduduk.nama, penduduk.dusun, penduduk.rt, penduduk.rw, surat_keterangan_domisili.no_surat, surat_keterangan_domisili.tanggal_surat, 'Surat Keterangan Domisili' AS jenis_surat 
              FROM penduduk 
              LEFT JOIN surat_keterangan_domisili ON surat_keterangan_domisili.nik = penduduk.nik 
              WHERE surat_keterangan_domisili.status_surat='selesai' AND MONTH(surat_keterangan_domisili.tanggal_surat) = '$bulan' AND YEAR(surat_keterangan_domisili.tanggal_surat) = '$tahun'

              ORDER BY tanggal_surat
            ";
    } else if ($filter == '4') {
      echo '
          <div class="header">
            <div align="center" style="font-size: 12pt;"><b>Laporan Surat Administrasi Desa - Surat Keluar Desa Pagar</b></div>
            <div align="center" style="font-size: 12pt;"><b>Tahun ' . $_GET['tahun'] . '</b></div>
            <hr>
          </div><br>
        ';

      $tahun = $_GET['tahun'];
      $query = "
              SELECT penduduk.nama, penduduk.dusun, penduduk.rt, penduduk.rw, sk_ahli_waris.no_surat, sk_ahli_waris.tanggal_surat, 'SK Ahli Waris' AS jenis_surat 
              FROM penduduk 
              LEFT JOIN sk_ahli_waris ON sk_ahli_waris.nik = penduduk.nik 
              WHERE sk_ahli_waris.status_surat='selesai' AND YEAR(sk_ahli_waris.tanggal_surat) = '$tahun'

              UNION
              SELECT penduduk.nama, penduduk.dusun, penduduk.rt, penduduk.rw, sk_gangguan_jiwa.no_surat, sk_gangguan_jiwa.tanggal_surat, 'SK Gangguan Jiwa' AS jenis_surat 
              FROM penduduk 
              LEFT JOIN sk_gangguan_jiwa ON sk_gangguan_jiwa.nik = penduduk.nik 
              WHERE sk_gangguan_jiwa.status_surat='selesai' AND YEAR(sk_gangguan_jiwa.tanggal_surat) = '$tahun'

              UNION
              SELECT penduduk.nama, penduduk.dusun, penduduk.rt, penduduk.rw, NULL AS no_surat, sk_jual_beli.tanggal_surat, 'SK Jual Beli' AS jenis_surat 
              FROM penduduk 
              LEFT JOIN sk_jual_beli ON sk_jual_beli.nik = penduduk.nik 
              WHERE sk_jual_beli.status_surat='selesai' AND YEAR(sk_jual_beli.tanggal_surat) = '$tahun'

              UNION
              SELECT penduduk.nama, penduduk.dusun, penduduk.rt, penduduk.rw, sk_kehilangan.no_surat, sk_kehilangan.tanggal_surat, 'SK Kehilangan' AS jenis_surat 
              FROM penduduk 
              LEFT JOIN sk_kehilangan ON sk_kehilangan.nik = penduduk.nik 
              WHERE sk_kehilangan.status_surat='selesai' AND YEAR(sk_kehilangan.tanggal_surat) = '$tahun'

              UNION
              SELECT penduduk.nama, penduduk.dusun, penduduk.rt, penduduk.rw, sk_kematian.no_surat, sk_kematian.tanggal_surat, 'SK Kematian' AS jenis_surat 
              FROM penduduk 
              LEFT JOIN sk_kematian ON sk_kematian.nik = penduduk.nik 
              WHERE sk_kematian.status_surat='selesai' AND YEAR(sk_kematian.tanggal_surat) = '$tahun'

              UNION
              SELECT penduduk.nama, penduduk.dusun, penduduk.rt, penduduk.rw, NULL AS no_surat, sk_kuasa.tanggal_surat, 'SK Kuasa' AS jenis_surat 
              FROM penduduk 
              LEFT JOIN sk_kuasa ON sk_kuasa.nik = penduduk.nik 
              WHERE sk_kuasa.status_surat='selesai' AND YEAR(sk_kuasa.tanggal_surat) = '$tahun'

              UNION
              SELECT penduduk.nama, penduduk.dusun, penduduk.rt, penduduk.rw, sk_pengantar_skck.no_surat, sk_pengantar_skck.tanggal_surat, 'SK Pengantar SKCK' AS jenis_surat 
              FROM penduduk 
              LEFT JOIN sk_pengantar_skck ON sk_pengantar_skck.nik = penduduk.nik 
              WHERE sk_pengantar_skck.status_surat='selesai' AND YEAR(sk_pengantar_skck.tanggal_surat) = '$tahun'

              UNION
              SELECT penduduk.nama, penduduk.dusun, penduduk.rt, penduduk.rw, sk_penghasilan_orang_tua.no_surat, sk_penghasilan_orang_tua.tanggal_surat, 'SK Penghasilan Orang Tua' AS jenis_surat 
              FROM penduduk 
              LEFT JOIN sk_penghasilan_orang_tua ON sk_penghasilan_orang_tua.nik = penduduk.nik 
              WHERE sk_penghasilan_orang_tua.status_surat='selesai' AND YEAR(sk_penghasilan_orang_tua.tanggal_surat) = '$tahun'

              UNION
              SELECT penduduk.nama, penduduk.dusun, penduduk.rt, penduduk.rw, sk_tidak_mampu.no_surat, sk_tidak_mampu.tanggal_surat, 'SK Tidak Mampu' AS jenis_surat 
              FROM penduduk 
              LEFT JOIN sk_tidak_mampu ON sk_tidak_mampu.nik = penduduk.nik 
              WHERE sk_tidak_mampu.status_surat='selesai' AND YEAR(sk_tidak_mampu.tanggal_surat) = '$tahun'

              UNION
              SELECT penduduk.nama, penduduk.dusun, penduduk.rt, penduduk.rw, sk_usaha.no_surat, sk_usaha.tanggal_surat, 'SK Usaha' AS jenis_surat 
              FROM penduduk 
              LEFT JOIN sk_usaha ON sk_usaha.nik = penduduk.nik 
              WHERE sk_usaha.status_surat='selesai' AND YEAR(sk_usaha.tanggal_surat) = '$tahun'

              UNION
              SELECT penduduk.nama, penduduk.dusun, penduduk.rt, penduduk.rw, surat_keterangan_domisili.no_surat, surat_keterangan_domisili.tanggal_surat, 'Surat Keterangan Domisili' AS jenis_surat 
              FROM penduduk 
              LEFT JOIN surat_keterangan_domisili ON surat_keterangan_domisili.nik = penduduk.nik 
              WHERE surat_keterangan_domisili.status_surat='selesai' AND YEAR(surat_keterangan_domisili.tanggal_surat) = '$tahun'

              ORDER BY tanggal_surat
            ";
    }
  } else {
    echo '
          <div class="header">
            <div align="center" style="font-size: 12pt;"><b>Laporan Surat Administrasi Desa - Surat Keluar Desa Pagar</b></div>
            <hr>
          </div><br>
        ';
    $query = "
            SELECT penduduk.nama, penduduk.dusun, penduduk.rt, penduduk.rw, sk_ahli_waris.no_surat, sk_ahli_waris.tanggal_surat, 'SK Ahli Waris' AS jenis_surat 
            FROM penduduk 
            LEFT JOIN sk_ahli_waris ON sk_ahli_waris.nik = penduduk.nik 
            WHERE sk_ahli_waris.status_surat='selesai'

            UNION
            SELECT penduduk.nama, penduduk.dusun, penduduk.rt, penduduk.rw, sk_gangguan_jiwa.no_surat, sk_gangguan_jiwa.tanggal_surat, 'SK Gangguan Jiwa' AS jenis_surat 
            FROM penduduk 
            LEFT JOIN sk_gangguan_jiwa ON sk_gangguan_jiwa.nik = penduduk.nik 
            WHERE sk_gangguan_jiwa.status_surat='selesai'

            UNION
            SELECT penduduk.nama, penduduk.dusun, penduduk.rt, penduduk.rw, NULL AS no_surat, sk_jual_beli.tanggal_surat, 'SK Jual Beli' AS jenis_surat 
            FROM penduduk 
            LEFT JOIN sk_jual_beli ON sk_jual_beli.nik = penduduk.nik 
            WHERE sk_jual_beli.status_surat='selesai'

            UNION
            SELECT penduduk.nama, penduduk.dusun, penduduk.rt, penduduk.rw, sk_kehilangan.no_surat, sk_kehilangan.tanggal_surat, 'SK Kehilangan' AS jenis_surat 
            FROM penduduk 
            LEFT JOIN sk_kehilangan ON sk_kehilangan.nik = penduduk.nik 
            WHERE sk_kehilangan.status_surat='selesai'

            UNION
            SELECT penduduk.nama, penduduk.dusun, penduduk.rt, penduduk.rw, sk_kematian.no_surat, sk_kematian.tanggal_surat, 'SK Kematian' AS jenis_surat 
            FROM penduduk 
            LEFT JOIN sk_kematian ON sk_kematian.nik = penduduk.nik 
            WHERE sk_kematian.status_surat='selesai'

            UNION
            SELECT penduduk.nama, penduduk.dusun, penduduk.rt, penduduk.rw, NULL AS no_surat, sk_kuasa.tanggal_surat, 'SK Kuasa' AS jenis_surat 
            FROM penduduk 
            LEFT JOIN sk_kuasa ON sk_kuasa.nik = penduduk.nik 
            WHERE sk_kuasa.status_surat='selesai'

            UNION
            SELECT penduduk.nama, penduduk.dusun, penduduk.rt, penduduk.rw, sk_pengantar_skck.no_surat, sk_pengantar_skck.tanggal_surat, 'SK Pengantar SKCK' AS jenis_surat 
            FROM penduduk 
            LEFT JOIN sk_pengantar_skck ON sk_pengantar_skck.nik = penduduk.nik 
            WHERE sk_pengantar_skck.status_surat='selesai'

            UNION
            SELECT penduduk.nama, penduduk.dusun, penduduk.rt, penduduk.rw, sk_penghasilan_orang_tua.no_surat, sk_penghasilan_orang_tua.tanggal_surat, 'SK Penghasilan Orang Tua' AS jenis_surat 
            FROM penduduk 
            LEFT JOIN sk_penghasilan_orang_tua ON sk_penghasilan_orang_tua.nik = penduduk.nik 
            WHERE sk_penghasilan_orang_tua.status_surat='selesai'

            UNION
            SELECT penduduk.nama, penduduk.dusun, penduduk.rt, penduduk.rw, sk_tidak_mampu.no_surat, sk_tidak_mampu.tanggal_surat, 'SK Tidak Mampu' AS jenis_surat 
            FROM penduduk 
            LEFT JOIN sk_tidak_mampu ON sk_tidak_mampu.nik = penduduk.nik 
            WHERE sk_tidak_mampu.status_surat='selesai'

            UNION
            SELECT penduduk.nama, penduduk.dusun, penduduk.rt, penduduk.rw, sk_usaha.no_surat, sk_usaha.tanggal_surat, 'SK Usaha' AS jenis_surat 
            FROM penduduk 
            LEFT JOIN sk_usaha ON sk_usaha.nik = penduduk.nik 
            WHERE sk_usaha.status_surat='selesai'

            UNION
            SELECT penduduk.nama, penduduk.dusun, penduduk.rt, penduduk.rw, surat_keterangan_domisili.no_surat, surat_keterangan_domisili.tanggal_surat, 'Surat Keterangan Domisili' AS jenis_surat 
            FROM penduduk 
            LEFT JOIN surat_keterangan_domisili ON surat_keterangan_domisili.nik = penduduk.nik 
            WHERE surat_keterangan_domisili.status_surat='selesai'

            ORDER BY tanggal_surat
          ";
  }
  ?>
  <table width="100%" border="1" cellpadding="5" style="border-collapse:collapse;">
    <tr>
      <th>No. Surat</th>
      <th>Tanggal</th>
      <th>Nama</th>
      <th>Jenis Surat</th>
      <th>Alamat</th>
    </tr>
    <?php
    $sql = mysqli_query($connect, $query);
    $row = mysqli_num_rows($sql);
    if ($row > 0) {
      while ($data = mysqli_fetch_assoc($sql)) {
        $tgl = date('d-m-Y', strtotime($data['tanggal_surat']));
        echo "<tr>";
        echo "<td>" . $data['no_surat'] . "</td>";
        echo "<td>" . $tgl . "</td>";
        echo "<td>" . $data['nama'] . "</td>";
        echo "<td>" . $data['jenis_surat'] . "</td>";
        echo "<td>Dsn. " . $data['dusun'] . ", RT" . $data['rt'] . "/RW" . $data['rw'] . "</td>";
        echo "</tr>";
      }
    } else {
      echo "<tr><td colspan='5'>Data tidak ditemukan.</td></tr>";
    }
    ?>
  </table>
  <script>
    window.print();
  </script>
</body>

</html>