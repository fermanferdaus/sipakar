<?php
include('../part/akses.php');
include('../part/header.php');
include('../../config/koneksi.php');

if (isset($_SESSION['id'])) {
  $id_login = $_SESSION['id'];

  // Ambil nama dari tabel login
  $qLogin = mysqli_query($connect, "SELECT nama FROM login WHERE id='$id_login'");
  $rowLogin = mysqli_fetch_assoc($qLogin);

  if ($rowLogin) {
    $nama = trim($rowLogin['nama']);

    // Ambil data penduduk berdasarkan nama
    $qCek = mysqli_query(
      $connect,
      "SELECT * FROM penduduk WHERE LOWER(TRIM(nama)) = LOWER(TRIM('$nama'))"
    );

    $cekRow = mysqli_num_rows($qCek);

    if ($cekRow > 0) {
      // ✅ Kalau ada data → ambil row pertama
      $row = mysqli_fetch_assoc($qCek);
      $alert = "";
    } else {
      // ❌ Kalau tidak ada → form kosong + tampilkan alert
      $row = [
        'id_penduduk' => '',
        'nik' => '',
        'nama' => '', // boleh langsung diisi dari login
        'tempat_lahir' => '',
        'tgl_lahir' => '',
        'jenis_kelamin' => '',
        'agama' => '',
        'jalan' => '',
        'dusun' => '',
        'rt' => '',
        'rw' => '',
        'desa' => '',
        'kecamatan' => '',
        'kota' => '',
        'no_kk' => '',
        'pend_kk' => '',
        'pend_terakhir' => '',
        'pend_ditempuh' => '',
        'pekerjaan' => '',
        'status_perkawinan' => '',
        'status_dlm_keluarga' => '',
        'kewarganegaraan' => '',
        'nama_ayah' => '',
        'nama_ibu' => '',
      ];
      $alert = '<div class="alert alert-warning">
                  <i class="fa fa-exclamation-triangle"></i> Data penduduk tidak ditemukan, silakan lengkapi data Anda.
                </div>';
    }
  }

  ?>

  <aside class="main-sidebar">
    <section class="sidebar">
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li>
          <a href="../dashboard">
            <i class="fas fa-tachometer-alt"></i> <span>&nbsp;&nbsp;Home</span>
          </a>
        </li>
        <li class="active">
          <a href="index.php"><i class="fa fa-user"></i> <span>&nbsp;&nbsp;Data Penduduk</span></a>
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
      <h1>&nbsp;</h1>
      <ol class="breadcrumb">
        <li><a href="../dashboard/"><i class="fa fa-tachometer-alt"></i> Dashboard</a></li>
        <li class="active">Data Penduduk</li>
      </ol>
    </section>
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <?= $alert; ?>
          <?php if ($cekRow > 0) { ?>
            <div class="box box-default">
              <div class="box-header with-border">
                <h3 class="box-title"><i class="fas fa-user"></i> Data Penduduk</h3>
                <div class="box-tools pull-right">
                  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                  <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
                </div>
              </div>
              <div class="box-body">
                <div class="row">
                  <form class="form-horizontal" method="post" action="update-penduduk.php">
                    <div class="col-md-6">
                      <div class="box-body">
                        <input type="hidden" name="id" class="form-control" value="<?php echo $row['id_penduduk']; ?>">
                        <div class="form-group">
                          <label class="col-sm-4 control-label">NIK</label>
                          <div class="col-sm-8">
                            <input type="text" name="fnik" maxlength="16" onkeypress="return hanyaAngka(event)"
                              class="form-control" value="<?php echo $row['nik']; ?>" readonly>
                            <script>
                              function hanyaAngka(evt) {
                                var charCode = (evt.which) ? evt.which : event.keyCode
                                if (charCode > 31 && (charCode < 48 || charCode > 57))
                                  return false;
                                return true;
                              }
                            </script>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-sm-4 control-label">Nama</label>
                          <div class="col-sm-8">
                            <input type="text" name="fnama" class="form-control" style="text-transform: capitalize;"
                              placeholder="Nama" value="<?php echo $row['nama']; ?>" readonly>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-sm-4 control-label">Tempat Lahir</label>
                          <div class="col-sm-8">
                            <input type="text" name="ftempat_lahir" class="form-control" style="text-transform: capitalize;"
                              value="<?php echo $row['tempat_lahir']; ?>" readonly>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-sm-4 control-label">Tanggal Lahir</label>
                          <div class="col-sm-8">
                            <input type="date" name="ftgl_lahir" class="form-control"
                              value="<?php echo $row['tgl_lahir']; ?>" readonly>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-sm-4 control-label">Jenis Kelamin</label>
                          <div class="col-sm-8">
                            <input type="text" name="fjenis_kelamin" class="form-control"
                              value="<?php echo $row['jenis_kelamin']; ?>" readonly>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-sm-4 control-label">Agama</label>
                          <div class="col-sm-8">
                            <input type="text" name="fagama" class="form-control" style="text-transform: capitalize;"
                              placeholder="Agama" value="<?php echo $row['agama']; ?>" readonly>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-sm-4 control-label">Jalan</label>
                          <div class="col-sm-8">
                            <input type="text" name="fjalan" class="form-control" style="text-transform: capitalize;"
                              placeholder="Jalan" value="<?php echo $row['jalan']; ?>" readonly>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-sm-4 control-label">Dusun</label>
                          <div class="col-sm-8">
                            <input type="text" name="fdusun" class="form-control" style="text-transform: capitalize;"
                              value="<?php echo $row['dusun']; ?>" readonly>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-sm-4 control-label">RT</label>
                          <div class="col-sm-8">
                            <input type="text" name="frt" class="form-control" value="<?php echo $row['rt']; ?>" readonly>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-sm-4 control-label">RW</label>
                          <div class="col-sm-8">
                            <input type="text" name="frw" class="form-control" value="<?php echo $row['rw']; ?>" readonly>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-sm-4 control-label">Desa</label>
                          <div class="col-sm-8">
                            <input type="text" name="fdesa" class="form-control" style="text-transform: capitalize;"
                              placeholder="Desa" value="<?php echo $row['desa']; ?>" readonly>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-sm-4 control-label">Kecamatan</label>
                          <div class="col-sm-8">
                            <input type="text" name="fkecamatan" class="form-control" style="text-transform: capitalize;"
                              placeholder="Kecamatan" value="<?php echo $row['kecamatan']; ?>" readonly>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-sm-4 control-label">Kota</label>
                          <div class="col-sm-8">
                            <input type="text" name="fkota" class="form-control" style="text-transform: capitalize;"
                              placeholder="Kota" value="<?php echo $row['kota']; ?>" readonly>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="box-body">
                        <div class="form-group">
                          <label class="col-sm-4 control-label">Nomor KK</label>
                          <div class="col-sm-8">
                            <input type="text" name="fno_kk" maxlength="16" onkeypress="return hanyaAngka(event)"
                              class="form-control" placeholder="Nomor KK" value="<?php echo $row['no_kk']; ?>" readonly>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-sm-4 control-label">Pendidikan di KK</label>
                          <div class="col-sm-8">
                            <input type="text" name="fpend_kk" class="form-control" value="<?php echo $row['pend_kk']; ?>"
                              readonly>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-sm-4 control-label">Pendidikan Terakhir</label>
                          <div class="col-sm-8">
                            <input type="text" name="fpend_terakhir" class="form-control"
                              value="<?php echo $row['pend_terakhir']; ?>" readonly>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-sm-4 control-label">Pendidikan Ditempuh</label>
                          <div class="col-sm-8">
                            <input type="text" name="fpend_ditempuh" class="form-control"
                              value="<?php echo $row['pend_ditempuh']; ?>" readonly>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-sm-4 control-label">Pekerjaan</label>
                          <div class="col-sm-8">
                            <input type="text" name="fpekerjaan" class="form-control" style="text-transform: capitalize;"
                              placeholder="Pekerjaan" value="<?php echo $row['pekerjaan']; ?>" readonly>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-sm-4 control-label">Status Perkawinan</label>
                          <div class="col-sm-8">
                            <input type="text" name="fstatus_perkawinan" class="form-control"
                              value="<?php echo $row['status_perkawinan']; ?>" readonly>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-sm-4 control-label">Status Dlm Keluarga</label>
                          <div class="col-sm-8">
                            <input type="text" name="fstatus_dlm_keluarga" class="form-control"
                              value="<?php echo $row['status_dlm_keluarga']; ?>" readonly>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-sm-4 control-label">Kewarganegaraan</label>
                          <div class="col-sm-8">
                            <input type="text" name="fkewarganegaraan" class="form-control"
                              value="<?php echo $row['kewarganegaraan']; ?>" readonly>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-sm-4 control-label">Nama Ayah</label>
                          <div class="col-sm-8">
                            <input type="text" name="fnama_ayah" class="form-control" style="text-transform: capitalize;"
                              value="<?php echo $row['nama_ayah']; ?>" readonly>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-sm-4 control-label">Nama Ibu</label>
                          <div class="col-sm-8">
                            <input type="text" name="fnama_ibu" class="form-control" style="text-transform: capitalize;"
                              value="<?php echo $row['nama_ibu']; ?>" readonly>
                          </div>
                        </div>
                      </div>
                      <div class="box-footer pull-right">
                        <a href="edit-penduduk.php?id=<?php echo $row['id_penduduk']; ?>" class="btn btn-info">Edit</a>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
              <div class="box-footer">
              </div>
            </div>
          <?php } ?>
        </div>
      </div>
    </section>
  </div>

  <?php
}

include('../part/footer.php');
?>