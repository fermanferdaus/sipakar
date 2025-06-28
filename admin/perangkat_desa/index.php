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
      <li>
        <a href="../pengumuman"><i class="fa fa-info-circle"></i> <span>Kelola Informasi</span></a>
      </li>
      <li>
        <a href="../penduduk"><i class="fa fa-users"></i> <span>Data Penduduk</span></a>
      </li>
      <li class="active">
        <a href="index.php"><i class="fa fa-user-tie"></i> <span>Perangkat Desa</span></a>
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
    <h1>Data Perangkat Desa</h1>
    <ol class="breadcrumb">
      <li><a href="../dashboard/"><i class="fa fa-tachometer-alt"></i> Dashboard</a></li>
      <li class="active">Data Perangkat Desa</li>
    </ol>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div>
          <?php
          if (isset($_GET['pesan'])) {
            if ($_GET['pesan'] == "gagal-menambah") {
              echo "<div class='alert alert-danger'><center>Anda tidak bisa menambah data. NIK tersebut sudah digunakan.</center></div>";
            }
            if ($_GET['pesan'] == "gagal-menghapus") {
              echo "<div class='alert alert-danger'><center>Anda tidak bisa menghapus data tersebut.</center></div>";
            }
          }
          ?>
        </div>
        <?php
        if (isset($_SESSION['lvl']) && ($_SESSION['lvl'] == 'Administrator')) {
          ?>
          <a class="btn btn-success btn-md" href='tambah-perangkat.php'><i class="fa fa-user-plus"></i> Tambah Data
            Perangkat Desa</a>
          <?php
        } else {

        }
        ?>
        <br><br>
        <table class="table table-striped table-bordered table-responsive" id="data-table" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th><strong>No</strong></th>
              <th><strong>Foto</strong></th>
              <th><strong>Nama</strong></th>
              <th><strong>Jabatan</strong></th>
              <?php
              if (isset($_SESSION['lvl']) && ($_SESSION['lvl'] == 'Administrator')) {
                ?>
                <th><strong>Aksi</strong></th>
                <?php
              } else {

              }
              ?>
            </tr>
          </thead>
          <tbody>
            <?php
            include('../../config/koneksi.php');

            $no = 1;
            $qTampil = mysqli_query($connect, "SELECT * FROM pejabat_desa");
            foreach ($qTampil as $row) {
              ?>
              <tr>
                <td><?php echo $no++; ?></td>
                <td style="width: 160px; text-align: center;">
                  <img
                    src="../../assets/img/profil/<?php echo empty($row['foto']) ? 'default-avatar.png' : $row['foto']; ?>"
                    style="max-width: 100px; height: auto;" class="img-thumbnail">
                </td>
                <td style="text-transform: capitalize;"><?php echo $row['nama_pejabat_desa']; ?></td>
                <td style="text-transform: none;"><?php echo $row['jabatan']; ?></td>
                <?php
                if (isset($_SESSION['lvl']) && ($_SESSION['lvl'] == 'Administrator')) {
                  ?>
                  <td>
                    <a class="btn btn-success btn-sm" href='edit-perangkat.php?id=<?php echo $row['id_pejabat_desa']; ?>'><i
                        class="fa fa-edit"></i></a>
                    <a class="btn btn-danger btn-sm" href='hapus-perangkat.php?id=<?php echo $row['id_pejabat_desa']; ?>'
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
  </section>
</div>

<?php
include('../part/footer.php');
?>