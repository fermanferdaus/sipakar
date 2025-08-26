<?php
include('../part/akses.php');
include('../part/header.php');
include('../../config/koneksi.php'); // pastikan koneksi dimuat
$username = $_SESSION['username'];   // ambil username dari session

$qUser = mysqli_query($connect, "SELECT * FROM login WHERE username='$username'");
$dataUser = mysqli_fetch_assoc($qUser);
?>

<aside class="main-sidebar">
  <section class="sidebar">
    <ul class="sidebar-menu" data-widget="tree">
      <li class="header">MAIN NAVIGATION</li>
      <li class="active">
        <a href="#">
          <i class="fas fa-tachometer-alt"></i> <span>&nbsp;&nbsp;Home</span>
        </a>
      </li>
      <li>
        <a href="../data_penduduk/"><i class="fa fa-user"></i> <span>&nbsp;&nbsp;Data Penduduk</span></a>
      </li>
      <li>
        <a href="../tambah_penduduk">
          <i class="fas fa-user-plus"></i> <span>&nbsp;&nbsp;Tambah Data</span>
        </a>
      </li>
      <li>
        <a href="../profil/index.php?id=<?php echo $_SESSION['id']; ?>">
          <i class="fas fa-user-edit"></i> <span>&nbsp;&nbsp;Edit Profil</span>
        </a>
      </li>
      <li>
        <a href="../pengajuan_surat/">
          <i class="fas fa-envelope-open-text"></i> <span>&nbsp;&nbsp;Pengajuan Surat</span>
        </a>
      </li>
      <li>
        <a href="../surat/surat_selesai/">
          <i class="fas fa-envelope"></i> <span>&nbsp;&nbsp;Lihat Surat</span>
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
    <h1>Pengumuman</h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-tachometer-alt"></i> Home</a></li>
    </ol>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-default">
          <div class="box-header with-border">
            <h3 class="box-title"><i class="fa fa-bullhorn"></i> Pengumuman Terbaru</h3>
            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
              <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
            </div>
          </div>
          <div class="box-body">
            <?php
            $qPengumuman = mysqli_query($connect, "SELECT * FROM pengumuman ORDER BY tanggal DESC");
            if (mysqli_num_rows($qPengumuman) > 0) {
              while ($pengumuman = mysqli_fetch_assoc($qPengumuman)) {
                ?>
                <div class="media" style="margin-bottom: 25px;">
                  <div class="media-left">
                    <img class="media-object img-thumbnail img-fluid"
                      src="../../assets/img/<?php echo $pengumuman['gambar']; ?>" alt="Gambar Pengumuman"
                      style="width: 300px; height: 200px; object-fit: contain;">
                  </div>
                  <div class="media-body" style="padding-left: 20px;">
                    <h4 class="media-heading"><strong><?php echo $pengumuman['judul']; ?></strong></h4>
                    <p><?php echo $pengumuman['keterangan']; ?></p>
                    <small class="text-muted">Tanggal -
                      <?php echo date('Y-m-d', strtotime($pengumuman['tanggal'])); ?></small>
                  </div>
                </div>
                <hr>
                <?php
              }
            } else {
              echo "<div class='alert alert-info'><center>Belum ada pengumuman yang tersedia.</center></div>";
            }
            ?>
          </div>
        </div>
      </div>
    </div>
  </section>

</div>

<?php
include('../part/footer.php');
?>