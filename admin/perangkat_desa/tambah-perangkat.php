<?php
include('../part/akses.php');
include('../part/header.php');
include('../../config/koneksi.php');
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
    <h1>&nbsp;</h1>
    <ol class="breadcrumb">
      <li><a href="../dashboard/"><i class="fa fa-tachometer-alt"></i> Dashboard</a></li>
      <li class="active">Kelola Informasi</li>
    </ol>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-default">
          <div class="box-header with-border">
            <h3 class="box-title"><i class="fa fa-bullhorn"></i> Tambah Perangkat Desa</h3>
            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
              <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
            </div>
          </div>

          <div class="box-body">
            <div class="row">
              <form class="form-horizontal" method="post" action="simpan-perangkat.php" enctype="multipart/form-data">
                <div class="col-md-8">
                  <div class="box-body">
                    <div class="form-group">
                      <label class="col-sm-3 control-label">Nama Lengkap</label>
                      <div class="col-sm-9">
                        <input type="text" name="fnama" class="form-control"
                          placeholder="Masukkan Masukkan Nama Perangkat Desa" required>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-3 control-label">Jabatan</label>
                      <div class="col-sm-9">
                        <input type="text" name="fjabatan" class="form-control" placeholder="Masukkan Jabatan" required>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-3 control-label">Foto Profil</label>
                      <div class="col-sm-9">
                        <input type="file" name="ffoto" class="form-control" accept="image/*" required>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="box-footer">
                    <input type="reset" class="btn btn-default" value="Batal">
                    <input type="submit" name="submit" class="btn btn-info" value="Simpan">
                  </div>
                </div>
              </form>
            </div>
          </div>
          <div class="box-footer"></div>
        </div>
      </div>
    </div>
  </section>
</div>

<?php
include('../part/footer.php');
?>