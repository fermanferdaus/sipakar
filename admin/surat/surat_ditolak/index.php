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
          <i class="fas fa-tachometer-alt"></i> <span>&nbsp;&nbsp;Dashboard</span>
        </a>
      </li>
      <li>
        <a href="../../pengumuman"><i class="fa fa-info-circle"></i> <span>Kelola Informasi</span></a>
      </li>
      <li>
        <a href="../../penduduk/">
          <i class="fa fa-users"></i> <span>Data Penduduk</span>
        </a>
      </li>
      <li>
        <a href="../../perangkat_desa/"><i class="fa fa-user-tie"></i> <span>Perangkat Desa</span></a>
      </li>
      <li>
        <a href="../../profil_desa/"><i class="fa fa-cogs"></i> <span>Kelola Profil Desa</span></a>
      </li>
      <li class="active treeview">
        <a href="#">
          <i class="fas fa-envelope-open-text"></i> <span>&nbsp;&nbsp;Surat</span>
          <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
        </a>
        <ul class="treeview-menu">
          <li>
            <a href="../../surat/permintaan_surat/">
              <i class="fa fa-circle-notch"></i> Permintaan Surat
            </a>
          </li>
          <li class="">
            <a href="../surat_selesai"><i class="fa fa-circle-notch"></i> Surat Selesai
            </a>
          </li>
          <li class="active">
            <a href="#"><i class="fa fa-circle-notch"></i> Surat Ditolak
            </a>
          </li>
        </ul>
      </li>
      <li>
        <a href="../../laporan/">
          <i class="fas fa-chart-line"></i> <span>&nbsp;&nbsp;Laporan</span>
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
  <section class="content-header">
    <h1>Surat Ditolak</h1>
    <ol class="breadcrumb">
      <li><a href="../../dashboard/"><i class="fa fa-tachometer-alt"></i> Dashboard</a></li>
      <li class="active">Surat Ditolak</li>
    </ol>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <br><br>
        <table class="table table-striped table-bordered table-responsive" id="data-table" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th><strong>Tanggal</strong></th>
              <th><strong>NIK</strong></th>
              <th><strong>Nama</strong></th>
              <th><strong>Jenis Surat</strong></th>
              <th style="width: 70px;"><strong>Status</strong></th>
              <th style="width: 20px;"><strong>Aksi</strong></th>
            </tr>
          </thead>
          <tbody>
            <?php
            include('../../../config/koneksi.php');

            $no = 1;
            $qTampil = mysqli_query($connect, "SELECT penduduk.nama, sk_ahli_waris.id_aw AS id, sk_ahli_waris.nik, sk_ahli_waris.jenis_surat, sk_ahli_waris.status_surat, sk_ahli_waris.tanggal_surat FROM penduduk LEFT JOIN sk_ahli_waris ON sk_ahli_waris.nik = penduduk.nik WHERE sk_ahli_waris.status_surat = 'ditolak' 
                UNION SELECT penduduk.nama, surat_keterangan_domisili.id_skd, surat_keterangan_domisili.nik , surat_keterangan_domisili.jenis_surat , surat_keterangan_domisili.status_surat , surat_keterangan_domisili.tanggal_surat FROM penduduk LEFT JOIN surat_keterangan_domisili ON surat_keterangan_domisili.nik = penduduk.nik WHERE surat_keterangan_domisili.status_surat='ditolak'
                UNION SELECT penduduk.nama, sk_kehilangan.id_kh AS id, sk_kehilangan.nik, sk_kehilangan.jenis_surat, sk_kehilangan.status_surat, sk_kehilangan.tanggal_surat FROM sk_kehilangan LEFT JOIN penduduk ON sk_kehilangan.nik = penduduk.nik WHERE sk_kehilangan.status_surat = 'ditolak'
                UNION SELECT penduduk.nama, sk_gangguan_jiwa.id_gj AS id, sk_gangguan_jiwa.nik, sk_gangguan_jiwa.jenis_surat, sk_gangguan_jiwa.status_surat, sk_gangguan_jiwa.tanggal_surat FROM sk_gangguan_jiwa LEFT JOIN penduduk ON sk_gangguan_jiwa.nik = penduduk.nik WHERE sk_gangguan_jiwa.status_surat = 'ditolak'
                UNION SELECT penduduk.nama, sk_tidak_mampu.id_tm AS id, sk_tidak_mampu.nik, sk_tidak_mampu.jenis_surat, sk_tidak_mampu.status_surat, sk_tidak_mampu.tanggal_surat FROM sk_tidak_mampu LEFT JOIN penduduk ON sk_tidak_mampu.nik = penduduk.nik WHERE sk_tidak_mampu.status_surat = 'ditolak'
                UNION SELECT penduduk.nama, sk_penghasilan_orang_tua.id_pot AS id, sk_penghasilan_orang_tua.nik, sk_penghasilan_orang_tua.jenis_surat, sk_penghasilan_orang_tua.status_surat, sk_penghasilan_orang_tua.tanggal_surat FROM sk_penghasilan_orang_tua LEFT JOIN penduduk ON sk_penghasilan_orang_tua.nik = penduduk.nik WHERE sk_penghasilan_orang_tua.status_surat = 'ditolak'
                UNION SELECT penduduk.nama, sk_pengantar_skck.id_sps AS id, sk_pengantar_skck.nik, sk_pengantar_skck.jenis_surat, sk_pengantar_skck.status_surat, sk_pengantar_skck.tanggal_surat FROM sk_pengantar_skck LEFT JOIN penduduk ON sk_pengantar_skck.nik = penduduk.nik WHERE sk_pengantar_skck.status_surat = 'ditolak'
                UNION SELECT penduduk.nama, sk_usaha.id_u AS id, sk_usaha.nik, sk_usaha.jenis_surat, sk_usaha.status_surat, sk_usaha.tanggal_surat FROM sk_usaha LEFT JOIN penduduk ON sk_usaha.nik = penduduk.nik WHERE sk_usaha.status_surat = 'ditolak'
                UNION SELECT penduduk.nama, sk_kematian.id_m AS id, sk_kematian.nik, sk_kematian.jenis_surat, sk_kematian.status_surat, sk_kematian.tanggal_surat FROM sk_kematian LEFT JOIN penduduk ON sk_kematian.nik = penduduk.nik WHERE sk_kematian.status_surat = 'ditolak'
                UNION SELECT penduduk.nama, sk_kuasa.id_kuasa AS id, sk_kuasa.nik, sk_kuasa.jenis_surat, sk_kuasa.status_surat, sk_kuasa.tanggal_surat FROM sk_kuasa LEFT JOIN penduduk ON sk_kuasa.nik = penduduk.nik WHERE sk_kuasa.status_surat = 'ditolak'
                UNION SELECT penduduk.nama, sk_jual_beli.id_jb AS id, sk_jual_beli.nik, sk_jual_beli.jenis_surat, sk_jual_beli.status_surat, sk_jual_beli.tanggal_surat FROM sk_jual_beli LEFT JOIN penduduk ON sk_jual_beli.nik = penduduk.nik WHERE sk_jual_beli.status_surat = 'ditolak'");
            foreach ($qTampil as $row) {
              ?>
              <tr>
                <?php
                $tgl_lhr = date($row['tanggal_surat']);
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
                <td><?php echo $tgl . $blnIndo[$bln] . $thn; ?></td>
                <td><?php echo $row['nik']; ?></td>
                <td style="text-transform: capitalize;"><?php echo $row['nama']; ?></td>
                <td><?php echo $row['jenis_surat']; ?></td>
                <td>
                  <a class="btn btn-danger btn-sm" href="#"><i class="fa fa-times-circle"></i><b>
                      <?php echo $row['status_surat']; ?></b></a>
                </td>
                <td>
                  <a href="hapus-surat.php?id=<?php echo $row['id']; ?>&jenis=<?php echo urlencode($row['jenis_surat']); ?>"
                    class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus surat ini?')">
                    <i class="fa fa-trash"></i>
                  </a>
                </td>
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