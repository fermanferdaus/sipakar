<?php
include('../part/akses.php');
include('../part/header.php');
?>

<aside class="main-sidebar">
  <section class="sidebar">
    <ul class="sidebar-menu" data-widget="tree">
      <li class="header">MAIN NAVIGATION</li>
      <li class="active">
        <a href="#">
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
            <li>
              <a href="../surat/surat_ditolak/"><i class="fa fa-circle-notch"></i> Surat Ditolak
              </a>
            </li>
          </ul>
        </li>
        <?php
      } else {
      }
      ?>
      <li>
        <a href="../laporan/"><i class="fas fa-chart-line"></i> <span>&nbsp;&nbsp;Laporan</span></a>
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
    <h1>Dashboard</h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-tachometer-alt"></i> Dashboard</a></li>
    </ol>
  </section>
  <section class="content">
    <div class="row">
      <?php
      if (isset($_SESSION['lvl']) && ($_SESSION['lvl'] == 'Administrator')) {
        ?>
        <div class="col-lg-4 col-xs-6">
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>
                <?php
                include('../../config/koneksi.php');

                $qTampil = mysqli_query($connect, "SELECT * FROM penduduk");
                $jumlahPenduduk = mysqli_num_rows($qTampil);
                echo $jumlahPenduduk;
                ?>
              </h3>
              <p>Data Penduduk</p>
            </div>
            <div class="icon">
              <i class="fas fa-users" style="font-size:70px"></i>
            </div>
            <a href="../penduduk/" class="small-box-footer">Lihat detail <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-4 col-xs-6">
          <div class="small-box bg-green">
            <div class="inner">
              <h3>
                <?php
                $qTampil = mysqli_query($connect, "SELECT tanggal_surat FROM sk_gangguan_jiwa WHERE status_surat='pending' 
                  UNION SELECT tanggal_surat FROM surat_keterangan_domisili WHERE status_surat='pending'
                  UNION SELECT tanggal_surat FROM sk_ahli_waris WHERE status_surat='pending'
                  UNION SELECT tanggal_surat FROM sk_kehilangan WHERE status_surat='pending'
                  UNION SELECT tanggal_surat FROM sk_tidak_mampu WHERE status_surat='pending'
                  UNION SELECT tanggal_surat FROM sk_penghasilan_orang_tua WHERE status_surat='pending'
                  UNION SELECT tanggal_surat FROM sk_pengantar_skck WHERE status_surat='pending'
                  UNION SELECT tanggal_surat FROM sk_usaha WHERE status_surat='pending'
                  UNION SELECT tanggal_surat FROM sk_kematian WHERE status_surat='pending'
                  UNION SELECT tanggal_surat FROM sk_kuasa WHERE status_surat='pending'
                  UNION SELECT tanggal_surat FROM sk_jual_beli WHERE status_surat='pending'");
                $jumlahPermintaanSurat = mysqli_num_rows($qTampil);
                echo $jumlahPermintaanSurat;
                ?>
              </h3>
              <p>Permintaan Surat</p>
            </div>
            <div class="icon">
              <i class="fas fa-envelope-open-text" style="font-size:70px"></i>
            </div>
            <a href="../surat/permintaan_surat/" class="small-box-footer">Lihat detail <i
                class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-4 col-xs-6">
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>
                <?php
                $qTampil = mysqli_query($connect, "SELECT tanggal_surat FROM sk_gangguan_jiwa WHERE status_surat='selesai' 
                  UNION SELECT tanggal_surat FROM surat_keterangan_domisili WHERE status_surat='selesai'
                  UNION SELECT tanggal_surat FROM sk_ahli_waris WHERE status_surat='selesai'
                  UNION SELECT tanggal_surat FROM sk_kehilangan WHERE status_surat='selesai'
                  UNION SELECT tanggal_surat FROM sk_tidak_mampu WHERE status_surat='selesai'
                  UNION SELECT tanggal_surat FROM sk_penghasilan_orang_tua WHERE status_surat='selesai'
                  UNION SELECT tanggal_surat FROM sk_pengantar_skck WHERE status_surat='selesai'
                  UNION SELECT tanggal_surat FROM sk_usaha WHERE status_surat='selesai'
                  UNION SELECT tanggal_surat FROM sk_kematian WHERE status_surat='selesai'
                  UNION SELECT tanggal_surat FROM sk_kuasa WHERE status_surat='selesai'
                  UNION SELECT tanggal_surat FROM sk_jual_beli WHERE status_surat='selesai'");
                $jumlahPermintaanSurat = mysqli_num_rows($qTampil);
                echo $jumlahPermintaanSurat;
                ?>
              </h3>
              <p>Surat Selesai</p>
            </div>
            <div class="icon">
              <i class="fas fa-envelope" style="font-size:70px"></i>
            </div>
            <a href="../surat/surat_selesai/" class="small-box-footer">Lihat detail <i
                class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-4 col-xs-6">
          <div class="small-box bg-red">
            <div class="inner">
              <h3>
                <?php
                $qTampil = mysqli_query($connect, "SELECT tanggal_surat FROM sk_gangguan_jiwa WHERE status_surat='ditolak' 
                  UNION SELECT tanggal_surat FROM surat_keterangan_domisili WHERE status_surat='ditolak'
                  UNION SELECT tanggal_surat FROM sk_ahli_waris WHERE status_surat='ditolak'
                  UNION SELECT tanggal_surat FROM sk_kehilangan WHERE status_surat='ditolak'
                  UNION SELECT tanggal_surat FROM sk_tidak_mampu WHERE status_surat='ditolak'
                  UNION SELECT tanggal_surat FROM sk_penghasilan_orang_tua WHERE status_surat='ditolak'
                  UNION SELECT tanggal_surat FROM sk_pengantar_skck WHERE status_surat='ditolak'
                  UNION SELECT tanggal_surat FROM sk_usaha WHERE status_surat='ditolak'
                  UNION SELECT tanggal_surat FROM sk_kematian WHERE status_surat='ditolak'
                  UNION SELECT tanggal_surat FROM sk_kuasa WHERE status_surat='ditolak'
                  UNION SELECT tanggal_surat FROM sk_jual_beli WHERE status_surat='ditolak'");
                $jumlahPermintaanSurat = mysqli_num_rows($qTampil);
                echo $jumlahPermintaanSurat;
                ?>
              </h3>
              <p>Surat Ditolak</p>
            </div>
            <div class="icon">
              <i class="fas fa-ban" style="font-size:70px"></i>
            </div>
            <a href="../surat/surat_ditolak/" class="small-box-footer">Lihat detail <i
                class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <?php
      } else if (isset($_SESSION['lvl']) && ($_SESSION['lvl'] == 'Kepala Desa')) {
        ?>
          <div class="col-lg-4 col-xs-6">
            <div class="small-box bg-aqua">
              <div class="inner">
                <h3>
                  <?php
                  include('../../config/koneksi.php');

                  $qTampil = mysqli_query($connect, "SELECT * FROM penduduk");
                  $jumlahPenduduk = mysqli_num_rows($qTampil);
                  echo $jumlahPenduduk;
                  ?>
                </h3>
                <p>Data Penduduk</p>
              </div>
              <div class="icon">
                <i class="fas fa-users" style="font-size:70px"></i>
              </div>
              <a href="../penduduk/" class="small-box-footer">Lihat detail <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-4 col-xs-6">
            <div class="small-box bg-yellow">
              <div class="inner">
                <h3>
                  <?php
                  $qTampil = mysqli_query($connect, "SELECT tanggal_surat FROM sk_gangguan_jiwa WHERE status_surat='selesai' 
                  UNION SELECT tanggal_surat FROM surat_keterangan_domisili WHERE status_surat='selesai'
                  UNION SELECT tanggal_surat FROM sk_ahli_waris WHERE status_surat='selesai'
                  UNION SELECT tanggal_surat FROM sk_kehilangan WHERE status_surat='selesai'
                  UNION SELECT tanggal_surat FROM sk_tidak_mampu WHERE status_surat='selesai'
                  UNION SELECT tanggal_surat FROM sk_penghasilan_orang_tua WHERE status_surat='selesai'
                  UNION SELECT tanggal_surat FROM sk_pengantar_skck WHERE status_surat='selesai'
                  UNION SELECT tanggal_surat FROM sk_usaha WHERE status_surat='selesai'
                  UNION SELECT tanggal_surat FROM sk_kematian WHERE status_surat='selesai'
                  UNION SELECT tanggal_surat FROM sk_kuasa WHERE status_surat='selesai'
                  UNION SELECT tanggal_surat FROM sk_jual_beli WHERE status_surat='selesai'");
                  $jumlahPermintaanSurat = mysqli_num_rows($qTampil);
                  echo $jumlahPermintaanSurat;
                  ?>
                </h3>
                <p>Surat Selesai</p>
              </div>
              <div class="icon">
                <i class="fas fa-envelope" style="font-size:70px"></i>
              </div>
              <a href="../surat/surat_selesai/" class="small-box-footer">Lihat detail <i
                  class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-4 col-xs-6">
            <div class="small-box bg-red">
              <div class="inner">
                <h3>
                  <?php
                  $qTampil = mysqli_query($connect, "SELECT tanggal_surat FROM sk_gangguan_jiwa WHERE status_surat='ditolak' 
                  UNION SELECT tanggal_surat FROM surat_keterangan_domisili WHERE status_surat='ditolak'
                  UNION SELECT tanggal_surat FROM sk_ahli_waris WHERE status_surat='ditolak'
                  UNION SELECT tanggal_surat FROM sk_kehilangan WHERE status_surat='ditolak'
                  UNION SELECT tanggal_surat FROM sk_tidak_mampu WHERE status_surat='ditolak'
                  UNION SELECT tanggal_surat FROM sk_penghasilan_orang_tua WHERE status_surat='ditolak'
                  UNION SELECT tanggal_surat FROM sk_pengantar_skck WHERE status_surat='ditolak'
                  UNION SELECT tanggal_surat FROM sk_usaha WHERE status_surat='ditolak'
                  UNION SELECT tanggal_surat FROM sk_kematian WHERE status_surat='ditolak'
                  UNION SELECT tanggal_surat FROM sk_kuasa WHERE status_surat='ditolak'
                  UNION SELECT tanggal_surat FROM sk_jual_beli WHERE status_surat='ditolak'");
                  $jumlahPermintaanSurat = mysqli_num_rows($qTampil);
                  echo $jumlahPermintaanSurat;
                  ?>
                </h3>
                <p>Surat Ditolak</p>
              </div>
              <div class="icon">
                <i class="fas fa-ban" style="font-size:70px"></i>
              </div>
              <a href="../surat/surat_ditolak/" class="small-box-footer">Lihat detail <i
                  class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
        <?php
      }
      ?>
    </div>
  </section>
</div>

<?php
include('../part/footer.php');
?>