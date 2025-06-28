<?php
include('../../config/koneksi.php');
include('../part/akses.php');
include('../part/header.php');
?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script type='text/javascript'>
  $(window).load(function () {
    $("#ktp").change(function () {
      console.log($("#ktp option:selected").val());
      if ($("#ktp option:selected").val() == 'Tidak Ada') {
        $('#no_ktp').prop('hidden', 'true');
      } else {
        $('#no_ktp').prop('hidden', false);
      }
    });
  });
</script>

<aside class="main-sidebar">
  <section class="sidebar">

    <ul class="sidebar-menu" data-widget="tree">
      <li class="header">MAIN NAVIGATION</li>
      <li>
        <a href="../dashboard/">
          <i class="fas fa-tachometer-alt"></i> <span>&nbsp;&nbsp;Dashboard</span>
        </a>
      </li>
      <li>
        <a href="../pengumuman"><i class="fa fa-info-circle"></i> <span>Kelola Informasi</span></a>
      </li>
      <li>
        <a href="../penduduk/">
          <i class="fa fa-users"></i> <span>Data Penduduk</span>
        </a>
      </li>
      <li>
        <a href="../perangkat_desa/"><i class="fa fa-user-tie"></i> <span>Perangkat Desa</span></a>
      </li>
      <li>
        <a href="../profil_desa/"><i class="fa fa-cogs"></i> <span>Kelola Profil Desa</span></a>
      </li>
      <?php
      if (isset($_SESSION['lvl']) && ($_SESSION['lvl'] == 'Administrator')) {
        ?>
        <li class="treeview">
          <a href="#">
            <i class="fas fa-envelope-open-text"></i> <span>&nbsp;&nbsp;Surat</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li>
              <a href="../surat/permintaan_surat/"><i class="fa fa-circle-notch"></i> Permintaan Surat</a>
            </li>
            <li>
              <a href="../surat/surat_selesai/"><i class="fa fa-circle-notch"></i> Surat Selesai</a>
            </li>
            <li class="">
              <a href="../surat/surat_ditolak/"><i class="fa fa-circle-notch"></i> Surat Ditolak
              </a>
            </li>
          </ul>
        </li>
        <?php
      } else {

      }
      ?>
      <li class="active">
        <a href="#"><i class="fas fa-chart-line"></i> <span>&nbsp;&nbsp;Laporan</span></a>
      </li>
      <li class="header">Other</li>
      <li>
        <a href="../../login/logout.php">
          <i class="fas fa-sign-out-alt"></i> <span>&nbsp;&nbsp;Logout</span>
        </a>
      </li>
    </ul>
  </section>
</aside>
<div class="content-wrapper">
  <section class="content-header">
    <?php
    if (isset($_GET['filter']) && !empty($_GET['filter'])) {
      $filter = $_GET['filter'];
      if ($filter == '1') {
        echo '<h1>Laporan Surat Administrasi Desa - Surat Keluar</h1>';
      } else if ($filter == '2') {
        $tgl_lhr = date($_GET['tanggal']);
        $tgl = date('d ', strtotime($tgl_lhr));
        $bln = date('F', strtotime($tgl_lhr));
        $thn = date(' Y', strtotime($tgl_lhr));
        $blnIndo = array(
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
        echo '<h1>Laporan Surat Administrasi Desa - Surat Keluar (Tanggal ' . $tgl . $blnIndo[$bln] . $thn . ')</b>';
      } else if ($filter == '3') {
        $nama_bulan = array('', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
        echo '<h1>Laporan Surat Administrasi Desa - Surat Keluar (Bulan ' . $nama_bulan[$_GET['bulan']] . ' ' . $_GET['tahun'] . ')</b>';
      } else if ($filter == '4') {
        echo '<h1>Laporan Surat Administrasi Desa - Surat Keluar (Tahun ' . $_GET['tahun'] . ')</b>';
      }
    } else {
      echo '<h1>Laporan Surat Administrasi Desa - Surat Keluar</h1>';
    }
    ?>
    <h1></h1>
    <ol class="breadcrumb">
      <li><a href="../dashboard/"><i class="fa fa-tachometer-alt"></i> Dashboard</a></li>
      <li class="active">Laporan</li>
    </ol>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="col-md-9">
          <?php
          if (isset($_GET['filter']) && !empty($_GET['filter'])) {
            $filter = $_GET['filter'];
            if ($filter == '1') {
              echo '<a name="cetak" target="output" class="btn btn-primary btn-md" href="cetak-laporan.php"><i class="fas fa-print"></i> Cetak Laporan</a>';
            } else if ($filter == '2') {
              $tgl = date('d-m-y', strtotime($_GET['tanggal']));
              echo '<a name="cetak" target="output" class="btn btn-primary btn-md" href="cetak-laporan.php?filter=2&tanggal=' . $_GET['tanggal'] . '"><i class="fas fa-print"></i> Cetak Laporan</a>';
            } else if ($filter == '3') {
              $nama_bulan = array('', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
              echo '<a name="cetak" target="output" class="btn btn-primary btn-md" href="cetak-laporan.php?filter=3&bulan=' . $_GET['bulan'] . '&tahun=' . $_GET['tahun'] . '"><i class="fas fa-print"></i> Cetak Laporan</a>';
            } else if ($filter == '4') {
              echo '<a name="cetak" target="output" class="btn btn-primary btn-md" href="cetak-laporan.php?filter=4&tahun=' . $_GET['tahun'] . '"><i class="fas fa-print"></i> Cetak Laporan</a>';
            }
          } else {
            echo '<a name="cetak" target="output" class="btn btn-primary btn-md" href="cetak-laporan.php"><i class="fas fa-print"></i> Cetak Laporan</a>';
          }
          ?>
        </div>
        <div class="col-md-3" align="right">
          <a name="filter" target="output" class="btn btn-primary btn-md" data-toggle="modal"
            data-target="#exampleModal"><i class="fas fa-filter"></i> Filter</a>
          <a href="../laporan/" name="filter" class="btn btn-danger btn-md"><i class="fas fa-eraser"></i> Reset
            Filter</a>
        </div><br>
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
          aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <form method="get" action="">
                <div class="modal-body">
                  <div class="form-group">
                    <label>Filter Berdasarkan</label>
                    <select class="form-control" name="filter" id="filter">
                      <option value="1">Semua Waktu</option>
                      <option value="2">Per Tanggal</option>
                      <option value="3">Per Bulan</option>
                      <option value="4">Per Tahun</option>
                    </select>
                  </div>
                  <div class="form-group" id="form-tanggal">
                    <label>Tanggal</label><br>
                    <input class="form-control" type="date" name="tanggal">
                  </div>
                  <div class="form-group" id="form-bulan">
                    <label>Bulan</label><br>
                    <select class="form-control" name="bulan">
                      <option value="">Pilih</option>
                      <option value="1">Januari</option>
                      <option value="2">Februari</option>
                      <option value="3">Maret</option>
                      <option value="4">April</option>
                      <option value="5">Mei</option>
                      <option value="6">Juni</option>
                      <option value="7">Juli</option>
                      <option value="8">Agustus</option>
                      <option value="9">September</option>
                      <option value="10">Oktober</option>
                      <option value="11">November</option>
                      <option value="12">Desember</option>
                    </select>
                  </div>
                  <div class="form-group" id="form-tahun">
                    <label>Tahun</label><br>
                    <select class="form-control" name="tahun">
                      <option value="">Pilih</option>
                      <?php
                      $query = "SELECT YEAR(tanggal_surat) AS tahun FROM sk_ahli_waris GROUP BY YEAR(tanggal_surat)";
                      $sql = mysqli_query($connect, $query);
                      while ($data = mysqli_fetch_array($sql)) {
                        echo '<option value="' . $data['tahun'] . '">' . $data['tahun'] . '</option>';
                      }
                      ?>
                    </select>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="submit" class="btn btn-primary">Tampilkan</button>
                </div>
              </form>
            </div>
          </div>
        </div><br><br>
        <?php
        if (isset($_GET['filter']) && !empty($_GET['filter'])) {
          $filter = $_GET['filter'];
          if ($filter == '1') {
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
        <table class="table table-striped table-bordered table-responsive" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>No. Surat</th>
              <th>Tanggal</th>
              <th>Nama</th>
              <th>Jenis Surat</th>
              <th>Alamat</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $result = mysqli_query($connect, $query);
            if (!$result) {
              die("SQL Error: " . mysqli_error($connect));
            }
            $row = mysqli_num_rows($result);

            if ($row > 0) {
              while ($data = mysqli_fetch_array($result)) {
                ?>
                <tr>
                  <td><?php echo ($data['no_surat']) ? $data['no_surat'] : '-'; ?></td>
                  <?php
                  $tgl_lhr = date($data['tanggal_surat']);
                  $tgl = date('d ', strtotime($tgl_lhr));
                  $bln = date('F', strtotime($tgl_lhr));
                  $thn = date(' Y', strtotime($tgl_lhr));
                  $blnIndo = array(
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
                  ?>
                  <td><?php echo $tgl . $blnIndo[$bln] . $thn; ?></td>
                  <td style="text-transform: capitalize;"><?php echo $data['nama']; ?></td>
                  <td><?php echo $data['jenis_surat']; ?></td>
                  <td style="text-transform: capitalize;">
                    <?php echo "Dsn." . $data['dusun'] . ", RT" . $data['rt'] . "/RW" . $data['rw']; ?>
                  </td>
                </tr>
                <?php
              }
            } else {
              echo "<tr><td colspan='5' align='center'>Data tidak ditemukan.</td></tr>";
            }
            ?>
          </tbody>
        </table><br>
        <script>
          $(document).ready(function () {
            $('#form-tanggal, #form-bulan, #form-tahun').hide();
            $('#filter').change(function () {
              if ($(this).val() == '1') {
                $('#form-tanggal, #form-bulan, #form-tahun').hide();
              } else if ($(this).val() == '2') {
                $('#form-bulan, #form-tahun').hide();
                $('#form-tanggal').show();
              } else if ($(this).val() == '3') {
                $('#form-tanggal').hide();
                $('#form-bulan, #form-tahun').show();
              } else {
                $('#form-tanggal, #form-bulan').hide();
                $('#form-tahun').show();
              }
              $('#form-tanggal input, #form-bulan select, #form-tahun select').val('');
            })
          })
        </script>
      </div>
    </div>
  </section>
</div>

<?php
include('../part/footer.php');
?>