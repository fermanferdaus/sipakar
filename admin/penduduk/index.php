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
      <li class="active">
        <a href="index.php"><i class="fa fa-users"></i> <span>Data Penduduk</span></a>
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
    <h1>Data Penduduk</h1>
    <ol class="breadcrumb">
      <li><a href="../dashboard/"><i class="fa fa-tachometer-alt"></i> Dashboard</a></li>
      <li class="active">Data Penduduk</li>
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
          <a class="btn btn-success btn-md" href='tambah-penduduk.php'><i class="fa fa-user-plus"></i> Tambah Data
            Penduduk</a>
          <a target="_blank" class="btn btn-info btn-md" href='export-penduduk.php'><i class="fas fa-file-export"></i>
            Export .XLS</a>
        <?php
        } else {

        }
        ?>
        <br><br>
        <table class="table table-striped table-bordered table-responsive" id="data-table" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th><strong>No</strong></th>
              <th><strong>NIK</strong></th>
              <th><strong>Nama</strong></th>
              <th><strong>Tempat/Tgl Lahir</strong></th>
              <th><strong>Jenis Kelamin</strong></th>
              <th><strong>Agama</strong></th>
              <th><strong>Alamat</strong></th>
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
            $qTampil = mysqli_query($connect, "SELECT * FROM penduduk");
            foreach ($qTampil as $row) {
              $tanggal = $row['tgl_lahir'];
              ?>
              <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo $row['nik']; ?></td>
                <td style="text-transform: capitalize;"><?php echo $row['nama']; ?></td>
                <?php
                $tanggal = date('d', strtotime($row['tgl_lahir']));
                $bulan = date('F', strtotime($row['tgl_lahir']));
                $tahun = date('Y', strtotime($row['tgl_lahir']));
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
                ?>
                <td style="text-transform: capitalize;">
                  <?php echo $row['tempat_lahir'] . ", " . $tanggal . " " . $bulanIndo[$bulan] . " " . $tahun; ?></td>
                <td style="text-transform: capitalize;"><?php echo $row['jenis_kelamin']; ?></td>
                <td style="text-transform: capitalize;"><?php echo $row['agama']; ?></td>
                <td style="text-transform: capitalize;">
                  <?php echo 'Dsn. ', $row['dusun'], ', RT', $row['rt'], '/RW', $row['rw']; ?></td>
                <?php
                if (isset($_SESSION['lvl']) && ($_SESSION['lvl'] == 'Administrator')) {
                  ?>
                  <td>
                    <a class="btn btn-success btn-sm" href='edit-penduduk.php?id=<?php echo $row['id_penduduk']; ?>'><i
                        class="fa fa-edit"></i></a>
                    <a class="btn btn-danger btn-sm" href='hapus-penduduk.php?id=<?php echo $row['id_penduduk']; ?>'
                      onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')"><i
                        class="fa fa-trash"></i></a>
                  </td>
                <?php
                } else {

                }
                ?>
              </tr>
              <?php
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </section>
</div>

<?php
include('../part/footer.php');
?>