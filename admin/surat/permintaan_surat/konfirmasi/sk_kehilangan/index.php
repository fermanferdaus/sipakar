<?php
include('../part/akses.php');
include('../../../../../config/koneksi.php');
include('../part/header.php');

$id = $_GET['id'];
$qCek = mysqli_query($connect, "
    SELECT penduduk.*, sk_kehilangan.* 
    FROM sk_kehilangan 
    LEFT JOIN penduduk ON sk_kehilangan.nik = penduduk.nik 
    WHERE sk_kehilangan.id_kh = '$id'
  ");
while ($row = mysqli_fetch_array($qCek)) {
  ?>

  <aside class="main-sidebar">
    <section class="sidebar">

      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li>
          <a href="../../../../dashboard/">
            <i class="fas fa-tachometer-alt"></i> <span>&nbsp;&nbsp;Dashboard</span>
          </a>
        </li>
        <li>
          <a href="../../../../pengumuman"><i class="fa fa-info-circle"></i> <span>Kelola Informasi</span></a>
        </li>
        <li>
          <a href="../../../../penduduk/">
            <i class="fa fa-users"></i> <span>Data Penduduk</span>
          </a>
        </li>
        <li>
          <a href="../../../../perangkat_desa/"><i class="fa fa-user-tie"></i> <span>Perangkat Desa</span></a>
        </li>
        <li>
          <a href="../../../../profil_desa/"><i class="fa fa-cogs"></i> <span>Kelola Profil Desa</span></a>
        </li>
        <li class="active treeview">
          <a href="#">
            <i class="fas fa-envelope-open-text"></i> <span>&nbsp;&nbsp;Surat</span>
            <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
          </a>
          <ul class="treeview-menu">
            <li class="active">
              <a href="#">
                <i class="fa fa-circle-notch"></i> Permintaan Surat
              </a>
            </li>
            <li>
              <a href="../../../../surat/surat_selesai/">
                <i class="fa fa-circle-notch"></i> Surat Selesai
              </a>
            </li>
            <li class="">
              <a href="../../../surat_ditolak/"><i class="fa fa-circle-notch"></i> Surat Ditolak
              </a>
            </li>
          </ul>
        </li>
        <li>
          <a href="../../../../laporan/">
            <i class="fas fa-chart-line"></i> <span>&nbsp;&nbsp;Laporan</span>
          </a>
        </li>
        <li class="header">Other</li>
        <li>
          <a href="../../../../../login/logout.php">
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
        <li><a href="../../../../dashboard/"><i class="fa fa-tachometer-alt"></i> Dashboard</a></li>
        <li class="active">Permintaan Surat</li>
      </ol>
    </section>
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box box-default">
            <div class="box-header with-border">
              <h2 class="box-title"><i class="fas fa-envelope"></i> Konfirmasi Surat Keterangan Berkelakuan Baik</h2>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
              </div>
            </div>
            <div class="box-body">
              <form class="form-horizontal" method="post" action="update-konfirmasi.php">
                <div class="row">
                  <div class="col-md-6">
                    <div class="box-body">
                      <div class="form-group">
                        <label class="col-sm-3 control-label">Tanda Tangan</label>
                        <div class="col-sm-9">
                          <select name="ft_tangan" class="form-control" style="text-transform: uppercase;" required>
                            <option value="">-- Pilih Tanda Tangan --</option>
                            <?php
                            $selectedPejabat = $row['jabatan'];
                            $qTampilPejabat = "SELECT * FROM pejabat_desa";
                            $tampilPejabat = mysqli_query($connect, $qTampilPejabat);
                            while ($rows = mysqli_fetch_assoc($tampilPejabat)) {
                              if ($rows['jabatan'] == $selectedPejabat) {
                                ?>
                                <option value="<?php echo $rows['id_pejabat_desa']; ?>" selected="selected">
                                  <?php echo $rows['jabatan']; ?></option>
                                <?php
                              } else {
                                ?>
                                <option value="<?php echo $rows['id_pejabat_desa']; ?>">
                                  <?php echo $rows['jabatan'], " (", $rows['nama_pejabat_desa'], ")"; ?></option>

                              <?php
                              }
                            }
                            ?>
                          </select>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="box-body">
                      <div class="form-group">
                        <label class="col-sm-3 control-label">No. Surat</label>
                        <div class="col-sm-9">
                          <input type="text" name="fno_surat" value="<?php echo $row['no_surat']; ?>" class="form-control"
                            placeholder="Masukkan No. Surat" required>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <h5 class="box-title pull-right" style="color: #696969;"><i class="fas fa-info-circle"></i> <b>Informasi
                    Penduduk</b></h5>
                <br>
                <hr style="border-bottom: 1px solid #DCDCDC;">
                <div class="row">
                  <div class="col-md-6">
                    <div class="box-body">
                      <div class="form-group">
                        <label class="col-sm-3 control-label">Nama Lengkap</label>
                        <div class="col-sm-9">
                          <input type="text" name="fnama" style="text-transform: uppercase;"
                            value="<?php echo $row['nama']; ?>" class="form-control" readonly>
                        </div>
                      </div>
                      <?php
                      $tgl_lhr = date($row['tgl_lahir']);
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
                      <div class="form-group">
                        <label class="col-sm-3 control-label">Tempat, Tgl Lahir</label>
                        <div class="col-sm-9">
                          <input type="text" name="ft_lahir" style="text-transform: capitalize;"
                            value="<?php echo $row['tempat_lahir'] . ", " . $tgl . $blnIndo[$bln] . $thn; ?>"
                            class="form-control" readonly>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-3 control-label">Pekerjaan</label>
                        <div class="col-sm-9">
                          <input type="text" name="fpekerjaan" style="text-transform: capitalize;"
                            value="<?php echo $row['pekerjaan']; ?>" class="form-control" readonly>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-3 control-label">Alamat</label>
                        <div class="col-sm-9">
                          <textarea rows="3" name="falamat" class="form-control" style="text-transform: capitalize;"
                            readonly><?php echo $row['jalan'] . ", RT" . $row['rt'] . "/RW" . $row['rw'] . ", Dusun " . $row['dusun'] . ", Desa " . $row['desa'] . ", Kecamatan " . $row['kecamatan'] . ", " . $row['kota']; ?></textarea>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="box-body">
                      <div class="form-group">
                        <label class="col-sm-3 control-label">Jenis Kelamin</label>
                        <div class="col-sm-9">
                          <input type="text" name="fj_kelamin" value="<?php echo $row['jenis_kelamin']; ?>"
                            class="form-control" readonly>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-3 control-label">Agama</label>
                        <div class="col-sm-9">
                          <input type="text" name="fagama" style="text-transform: capitalize;"
                            value="<?php echo $row['agama']; ?>" class="form-control" readonly>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-3 control-label">NIK</label>
                        <div class="col-sm-9">
                          <input type="text" name="fnik" value="<?php echo $row['nik']; ?>" class="form-control" readonly>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-3 control-label">Kewarganegaraan</label>
                        <div class="col-sm-9">
                          <input type="text" name="fkewarganegaraan" style="text-transform: uppercase;"
                            value="<?php echo $row['kewarganegaraan']; ?>" class="form-control" readonly>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <h5 class="box-title pull-right" style="color: #696969;"><i class="fas fa-info-circle"></i> <b>Informasi
                    Surat</b></h5>
                <br>
                <hr style="border-bottom: 1px solid #DCDCDC;">
                <div class="row">
                  <div class="col-md-6">
                    <div class="box-body">
                      <div class="form-group">
                        <label class="col-sm-3 control-label">Barang Hilang</label>
                        <div class="col-sm-9">
                          <input type="text" name="fbarang_hilang" style="text-transform: capitalize;"
                            value="<?php echo $row['barang_hilang']; ?>" class="form-control" readonly>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-3 control-label">Tempat Kehilangan</label>
                        <div class="col-sm-9">
                          <input type="text" name="ftempat_kehilangan" style="text-transform: capitalize;"
                            value="<?php echo $row['tempat_kehilangan']; ?>" class="form-control" readonly>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-3 control-label">Hari</label>
                        <div class="col-sm-9">
                          <input type="text" name="fhari" style="text-transform: capitalize;"
                            value="<?php echo $row['hari']; ?>" class="form-control" readonly>
                        </div>
                      </div>
                      <div>
                        <input type="hidden" name="id" value="<?php echo $row['id_kh']; ?>" class="form-control">
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="box-body">
                      <?php
                      $tgl_lhr = date($row['tanggal_kehilangan']);
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
                      <div class="form-group">
                        <label class="col-sm-3 control-label">Tanggal Kehilangan</label>
                        <div class="col-sm-9">
                          <input type="text" name="ftanggal_kehilangan" style="text-transform: capitalize;"
                            value="<?php echo $tgl . $blnIndo[$bln] . $thn; ?>" class="form-control" readonly>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-3 control-label">Waktu</label>
                        <div class="col-sm-9">
                          <input type="text" name="fwaktu_kehilangan"
                            value="<?php echo date('H:i', strtotime($row['jam_kehilangan'])); ?>" class="form-control"
                            readonly>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="box-body pull-right">
                      <input type="submit" name="submit" class="btn btn-success" value="Konfirmasi">
                    </div>
                  </div>
                </div>
              </form>
            </div>
            <div class="box-footer">
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