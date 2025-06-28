<?php
include('../../../config/koneksi.php');

$id     = $_GET['id'];
$jenis  = $_GET['jenis'];

$jenis = mysqli_real_escape_string($connect, $jenis);

// Tentukan tabel dan kolom ID-nya berdasarkan jenis surat
$mapping = [
    'Surat Keterangan Kehilangan' => ['table' => 'sk_kehilangan', 'id_col' => 'id_kh'],
    'Surat Keterangan Domisili' => ['table' => 'surat_keterangan_domisili', 'id_col' => 'id_skd'],
    'Surat Keterangan Ahli Waris' => ['table' => 'sk_ahli_waris', 'id_col' => 'id_aw'],
    'Surat Keterangan Gangguan Jiwa' => ['table' => 'sk_gangguan_jiwa', 'id_col' => 'id_gj'],
    'Surat Keterangan Tidak Mampu' => ['table' => 'sk_tidak_mampu', 'id_col' => 'id_tm'],
    'Surat Keterangan Penghasilan Orang Tua' => ['table' => 'sk_penghasilan_orang_tua', 'id_col' => 'id_pot'],
    'Surat Pengantar SKCK' => ['table' => 'sk_pengantar_skck', 'id_col' => 'id_sps'],
    'Surat Keterangan Usaha' => ['table' => 'sk_usaha', 'id_col' => 'id_u'],
    'Surat Keterangan Kematian' => ['table' => 'sk_kematian', 'id_col' => 'id_m'],
    'Surat Kuasa' => ['table' => 'sk_kuasa', 'id_col' => 'id_kuasa'],
    'Surat Keterangan Jual Beli' => ['table' => 'sk_jual_beli', 'id_col' => 'id_jb'],
];

// Cek apakah jenis surat valid
if (array_key_exists($jenis, $mapping)) {
    $table  = $mapping[$jenis]['table'];
    $id_col = $mapping[$jenis]['id_col'];

    // Update status jadi "ditolak"
    $query = "UPDATE $table SET status_surat='DITOLAK' WHERE $id_col='$id'";
    $update = mysqli_query($connect, $query);

    if ($update) {
        header("Location: permintaan_surat/?status=tolak-berhasil");
    } else {
        echo "<script>alert('Gagal menolak surat'); history.back();</script>";
    }
} else {
    echo "<script>alert('Jenis surat tidak dikenali.'); history.back();</script>";
}
?>
