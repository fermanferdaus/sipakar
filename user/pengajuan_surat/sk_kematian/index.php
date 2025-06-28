<?php
include('../part/akses.php');
include('../part/header.php');
?>

<aside class="main-sidebar">
  <section class="sidebar">
    <ul class="sidebar-menu" data-widget="tree">
      <li class="header">MAIN NAVIGATION</li>
      <li>
        <a href="../../dashboard/">
          <i class="fas fa-tachometer-alt"></i> <span>&nbsp;&nbsp;Home</span>
        </a>
      </li>
      <li>
        <a href="../../profil/index.php?id=<?php echo $_SESSION['id']; ?>">
          <i class="fas fa-user-edit"></i> <span>&nbsp;&nbsp;Edit Profil</span>
        </a>
      </li>
      <li class="active">
        <a href="../">
          <i class="fas fa-envelope-open-text"></i> <span>&nbsp;&nbsp;Pengajuan Surat</span>
        </a>
      </li>
      <li>
        <a href="../../surat/surat_selesai/">
          <i class="fas fa-envelope"></i> <span>&nbsp;&nbsp;Lihat Surat</span>
        </a>
      </li>
      <li class="header">Other</li>
      <li>
        <a href="../../../login/logout.php">
          <i class="fas fa-sign-out-alt"></i> <span>&nbsp;&nbsp;Logout</span>
        </a>
      </li>
    </ul>
  </section>
</aside>
<div class="content-wrapper">
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-default">
          <div class="box-header with-border">
            <h3 class="box-title"><i class="fa fa-id-card"></i> Cek NIK Anda</h3>
            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
              <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
            </div>
          </div>
          <div class="box-body">
            <?php
            if (isset($_GET['pesan']) && $_GET['pesan'] == "gagal") {
              echo "<div class='alert alert-danger text-center'>❌ NIK Anda tidak terdaftar. Silahkan hubungi Kantor Desa!</div>";
            }
            ?>

            <form action="info-surat.php" method="post">
              <div class="form-group">
                <label for="fnik"><strong>NIK</strong> <small class="text-muted">(Nomor Induk
                    Kependudukan)</small></label>
                <input type="text" class="form-control" maxlength="16" name="fnik" placeholder="Masukkan NIK Anda..."
                  onkeypress="return hanyaAngka(event)" required>
              </div>

              <script>
                function hanyaAngka(evt) {
                  var charCode = (evt.which) ? evt.which : event.keyCode;
                  if (charCode > 31 && (charCode < 48 || charCode > 57)) return false;
                  return true;
                }
              </script>

              <div class="form-group text-center">
                <button type="submit" class="btn btn-primary">
                  <i class="fa fa-search"></i> Cek NIK
                </button>
              </div>
            </form>
          </div>
          <div class="box-footer text-center text-muted">
            Pastikan NIK Anda sudah terdaftar di sistem.
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<?php
include('../part/footer.php');
?>