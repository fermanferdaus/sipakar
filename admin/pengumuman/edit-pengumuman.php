<?php
include('../part/akses.php');
include('../../config/koneksi.php');
include('../part/header.php');

$id = $_GET['id'];
$qCek = mysqli_query($connect, "SELECT * FROM pengumuman WHERE id_pengumuman='$id'");
while ($row = mysqli_fetch_array($qCek)) {
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
      <h1>&nbsp;</h1>
      <ol class="breadcrumb">
        <li><a href="../dashboard/"><i class="fa fa-tachometer-alt"></i> Dashboard</a></li>
        <li class="active">Data Penduduk</li>
      </ol>
    </section>
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box box-default">
            <div class="box-header with-border">
              <h3 class="box-title"><i class="fas fa-edit"></i> Edit Informasi</h3>
            </div>
            <div class="box-body">
              <form class="form-horizontal" method="post" action="update-pengumuman.php" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?= $row['id_pengumuman']; ?>">
                <div class="form-group">
                  <label class="col-sm-2 control-label">Judul Pengumuman</label>
                  <div class="col-sm-10">
                    <input type="text" name="fjudul" class="form-control" value="<?= $row['judul']; ?>" required>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Isi Pengumuman</label>
                  <div class="col-sm-10">
                    <textarea name="fisi" class="form-control" rows="5" required><?= $row['keterangan']; ?></textarea>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Gambar Sekarang</label>
                  <div class="col-sm-10">
                    <?php if ($row['gambar'] != '') { ?>
                      <img src="../../assets/img/<?= $row['gambar']; ?>" style="max-height:150px;">
                    <?php } else { ?>
                      <p><i>Tidak ada gambar</i></p>
                    <?php } ?>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Update Gambar</label>
                  <div class="col-sm-10">
                    <input type="hidden" name="gambar_lama" value="<?= $row['gambar']; ?>">
                    <input type="file" name="fgambar" accept="image/*">
                    <p class="help-block">Kosongkan jika tidak ingin mengganti gambar</p>
                  </div>
                </div>
                <div class="box-footer pull-right">
                  <a href="index.php" class="btn btn-default">Batal</a>
                  <input type="submit" name="submit" class="btn btn-info" value="Simpan">
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  <?php
}

include('../part/footer.php');
?>