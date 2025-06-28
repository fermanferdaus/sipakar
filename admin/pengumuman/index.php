<?php
include('../part/akses.php');
include('../part/header.php');
?>

<aside class="main-sidebar">
  <section class="sidebar">

    <ul class="sidebar-menu" data-widget="tree">
      <li class="header">MAIN NAVIGATION</li>
      <li>
        <a href="../dashboard/">
          <i class="fas fa-tachometer-alt"></i> <span>&nbsp;&nbsp;Dashboard</span>
        </a>
      </li>
      <li class="active">
        <a href="index.php"><i class="fa fa-info-circle"></i> <span>Kelola Informasi</span></a>
      </li>
      <li>
        <a href="../penduduk/"><i class="fa fa-users"></i> <span>Data Penduduk</span></a>
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
      <li>
        <a href="../laporan/">
          <i class="fas fa-chart-line"></i> <span>&nbsp;&nbsp;Laporan</span>
        </a>
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
    <h1>Kelola Informasi</h1>
    <ol class="breadcrumb">
      <li><a href="../dashboard/"><i class="fa fa-tachometer-alt"></i> Dashboard</a></li>
      <li class="active">Kelola Informasi</li>
    </ol>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-md-12">

        <?php
        if (isset($_GET['pesan'])) {
          if ($_GET['pesan'] == "gagal-menambah") {
            echo "<div class='alert alert-danger'><center>Gagal menambah data pengumuman.</center></div>";
          }
          if ($_GET['pesan'] == "gagal-menghapus") {
            echo "<div class='alert alert-danger'><center>Gagal menghapus data pengumuman.</center></div>";
          }
        }
        ?>

        <?php
        if (isset($_SESSION['lvl']) && ($_SESSION['lvl'] == 'Administrator' || $_SESSION['lvl'] == 'Kepala Desa')) {
          ?>
          <a class="btn btn-success btn-md" href='tambah-pengumuman.php'><i class="fa fa-plus"></i> Tambah Informasi</a>
        <?php } ?>
        <br><br>

        <div class="table-responsive">
          <table class="table table-striped table-bordered" id="data-table" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th style="width: 10px;"><strong>No</strong></th>
                <th style="width: 160px;"><strong>Gambar</strong></th>
                <th style="width: 100px;"><strong>Judul</strong></th>
                <th style="width: 500px;"><strong>Keterangan</strong></th>
                <th style="width: 50px;"><strong>Tanggal</strong></th>
                <?php
                if (isset($_SESSION['lvl']) && ($_SESSION['lvl'] == 'Administrator' || $_SESSION['lvl'] == 'Kepala Desa')) {
                  ?>
                  <th style="width: 70px; text-align: center;"><strong>Aksi</strong></th>
                <?php } ?>
              </tr>
            </thead>
            <tbody>
              <?php
              include('../../config/koneksi.php');
              $no = 1;
              $qTampil = mysqli_query($connect, "SELECT * FROM pengumuman ORDER BY tanggal DESC");
              foreach ($qTampil as $row) {
                ?>
                <tr>
                  <td><?php echo $no++; ?></td>
                  <td style="width: 160px; text-align: center;">
                    <img src="../../assets/img/<?php echo $row['gambar']; ?>" style="max-width: 200px; height: auto;"
                      class="img-thumbnail">
                  </td>
                  <td style="text-transform: capitalize;"><?php echo $row['judul']; ?></td>
                  <td style="text-transform: none;"><?php echo $row['keterangan']; ?></td>
                  <td><?php echo date('d-m-Y', strtotime($row['tanggal'])); ?></td>
                  <?php
                  if (isset($_SESSION['lvl']) && ($_SESSION['lvl'] == 'Administrator' || $_SESSION['lvl'] == 'Kepala Desa')) {
                    ?>
                    <td>
                      <a class="btn btn-success btn-sm"
                        href='edit-pengumuman.php?id=<?php echo $row['id_pengumuman']; ?>'><i class="fa fa-edit"></i></a>
                      <a class="btn btn-danger btn-sm" href='hapus-pengumuman.php?id=<?php echo $row['id_pengumuman']; ?>'
                        onclick="return confirm('Apakah Anda yakin ingin menghapus pengumuman ini?')"><i
                          class="fa fa-trash"></i></a>
                    </td>
                  <?php } ?>
                </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </section>
</div>

<?php
include('../part/footer.php');
?>