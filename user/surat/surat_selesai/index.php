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
        <a href="../../data_penduduk/"><i class="fa fa-user"></i> <span>&nbsp;&nbsp;Data Penduduk</span></a>
      </li>
      <li>
        <a href="../../tambah_penduduk">
          <i class="fas fa-user-plus"></i> <span>&nbsp;&nbsp;Tambah Data</span>
        </a>
      </li>
      <li>
        <a href="../../profil/index.php?id=<?php echo $_SESSION['id']; ?>">
          <i class="fas fa-user-edit"></i> <span>&nbsp;&nbsp;Edit Profil</span>
        </a>
      </li>
      <li>
        <a href="../../pengajuan_surat/">
          <i class="fas fa-envelope-open-text"></i> <span>&nbsp;&nbsp;Pengajuan Surat</span>
        </a>
      </li>
      <li class="active">
        <a href="#">
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
  <section class="content-header">
    <h1>Surat Selesai</h1>
    <ol class="breadcrumb">
      <li><a href="../../dashboard/"><i class="fa fa-tachometer-alt"></i> Home</a></li>
      <li class="active">Surat Selesai</li>
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
              <th><strong>No. Surat</strong></th>
              <th><strong>NIK</strong></th>
              <th><strong>Nama</strong></th>
              <th><strong>Jenis Surat</strong></th>
              <th><strong>Status</strong></th>
            </tr>
          </thead>
          <tbody>
            <?php
            include('../../../config/koneksi.php');

            $no = 1;
            $qTampil = mysqli_query($connect, "SELECT penduduk.nama, sk_ahli_waris.id_aw AS id, sk_ahli_waris.no_surat, sk_ahli_waris.nik, sk_ahli_waris.jenis_surat, sk_ahli_waris.status_surat, sk_ahli_waris.tanggal_surat FROM penduduk LEFT JOIN sk_ahli_waris ON sk_ahli_waris.nik = penduduk.nik WHERE sk_ahli_waris.status_surat IN ('selesai', 'pending', 'ditolak')
                UNION SELECT penduduk.nama, surat_keterangan_domisili.id_skd, surat_keterangan_domisili.no_surat , surat_keterangan_domisili.nik , surat_keterangan_domisili.jenis_surat , surat_keterangan_domisili.status_surat , surat_keterangan_domisili.tanggal_surat FROM penduduk LEFT JOIN surat_keterangan_domisili ON surat_keterangan_domisili.nik = penduduk.nik WHERE surat_keterangan_domisili.status_surat IN ('selesai', 'pending', 'ditolak')
                UNION SELECT penduduk.nama, sk_kehilangan.id_kh AS id, sk_kehilangan.no_surat, sk_kehilangan.nik, sk_kehilangan.jenis_surat, sk_kehilangan.status_surat, sk_kehilangan.tanggal_surat FROM sk_kehilangan LEFT JOIN penduduk ON sk_kehilangan.nik = penduduk.nik WHERE sk_kehilangan.status_surat IN ('selesai', 'pending', 'ditolak')
                UNION SELECT penduduk.nama, sk_gangguan_jiwa.id_gj AS id, sk_gangguan_jiwa.no_surat, sk_gangguan_jiwa.nik, sk_gangguan_jiwa.jenis_surat, sk_gangguan_jiwa.status_surat, sk_gangguan_jiwa.tanggal_surat FROM sk_gangguan_jiwa LEFT JOIN penduduk ON sk_gangguan_jiwa.nik = penduduk.nik WHERE sk_gangguan_jiwa.status_surat IN ('selesai', 'pending', 'ditolak')
                UNION SELECT penduduk.nama, sk_tidak_mampu.id_tm AS id, sk_tidak_mampu.no_surat, sk_tidak_mampu.nik, sk_tidak_mampu.jenis_surat, sk_tidak_mampu.status_surat, sk_tidak_mampu.tanggal_surat FROM sk_tidak_mampu LEFT JOIN penduduk ON sk_tidak_mampu.nik = penduduk.nik WHERE sk_tidak_mampu.status_surat IN ('selesai', 'pending', 'ditolak')
                UNION SELECT penduduk.nama, sk_penghasilan_orang_tua.id_pot AS id, sk_penghasilan_orang_tua.no_surat, sk_penghasilan_orang_tua.nik, sk_penghasilan_orang_tua.jenis_surat, sk_penghasilan_orang_tua.status_surat, sk_penghasilan_orang_tua.tanggal_surat FROM sk_penghasilan_orang_tua LEFT JOIN penduduk ON sk_penghasilan_orang_tua.nik = penduduk.nik WHERE sk_penghasilan_orang_tua.status_surat IN ('selesai', 'pending', 'ditolak')
                UNION SELECT penduduk.nama, sk_pengantar_skck.id_sps AS id, sk_pengantar_skck.no_surat, sk_pengantar_skck.nik, sk_pengantar_skck.jenis_surat, sk_pengantar_skck.status_surat, sk_pengantar_skck.tanggal_surat FROM sk_pengantar_skck LEFT JOIN penduduk ON sk_pengantar_skck.nik = penduduk.nik WHERE sk_pengantar_skck.status_surat IN ('selesai', 'pending', 'ditolak')
                UNION SELECT penduduk.nama, sk_usaha.id_u AS id, sk_usaha.no_surat, sk_usaha.nik, sk_usaha.jenis_surat, sk_usaha.status_surat, sk_usaha.tanggal_surat FROM sk_usaha LEFT JOIN penduduk ON sk_usaha.nik = penduduk.nik WHERE sk_usaha.status_surat IN ('selesai', 'pending', 'ditolak')
                UNION SELECT penduduk.nama, sk_kematian.id_m AS id, sk_kematian.no_surat, sk_kematian.nik, sk_kematian.jenis_surat, sk_kematian.status_surat, sk_kematian.tanggal_surat FROM sk_kematian LEFT JOIN penduduk ON sk_kematian.nik = penduduk.nik WHERE sk_kematian.status_surat IN ('selesai', 'pending', 'ditolak')
                UNION SELECT penduduk.nama, sk_kuasa.id_kuasa AS id, '-' AS no_surat, sk_kuasa.nik, sk_kuasa.jenis_surat, sk_kuasa.status_surat, sk_kuasa.tanggal_surat FROM sk_kuasa LEFT JOIN penduduk ON sk_kuasa.nik = penduduk.nik WHERE sk_kuasa.status_surat IN ('selesai', 'pending', 'ditolak')
                UNION SELECT penduduk.nama, sk_jual_beli.id_jb AS id, '-' AS no_surat, sk_jual_beli.nik, sk_jual_beli.jenis_surat, sk_jual_beli.status_surat, sk_jual_beli.tanggal_surat FROM sk_jual_beli LEFT JOIN penduduk ON sk_jual_beli.nik = penduduk.nik WHERE sk_jual_beli.status_surat IN ('selesai', 'pending', 'ditolak')");
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
                <td><?php echo $row['no_surat']; ?></td>
                <td><?php echo $row['nik']; ?></td>
                <td style="text-transform: capitalize;"><?php echo $row['nama']; ?></td>
                <td><?php echo $row['jenis_surat']; ?></td>
                <?php
                $status = strtolower($row['status_surat']);
                if ($status == "selesai") {
                  $label = "success";
                  $icon = "check";
                } elseif ($status == "pending") {
                  $label = "warning";
                  $icon = "hourglass-half";
                } elseif ($status == "ditolak") {
                  $label = "danger";
                  $icon = "times";
                } else {
                  $label = "default";
                  $icon = "question";
                }
                ?>
                <td>
                  <span class="btn btn-<?php echo $label; ?> btn-sm">
                    <i class="fa fa-<?php echo $icon; ?>"></i>
                    <b><?php echo ucfirst($status); ?></b>
                  </span>
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