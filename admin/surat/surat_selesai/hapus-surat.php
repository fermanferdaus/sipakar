<?php
include('../../../config/koneksi.php');

$id = $_GET['id'];
$jenis = $_GET['jenis'];

// Escape untuk keamanan dasar
$id = mysqli_real_escape_string($connect, $id);
$jenis = mysqli_real_escape_string($connect, $jenis);

switch ($jenis) {
    case "Surat Keterangan Usaha":
        $query = "DELETE FROM sk_usaha WHERE id_u = '$id'";
        break;
    case "Surat Keterangan Kehilangan":
        $query = "DELETE FROM sk_kehilangan WHERE id_kh = '$id'";
        break;
    case "Surat Keterangan Kematian":
        $query = "DELETE FROM sk_kematian WHERE id_m = '$id'";
        break;
    case "Surat Keterangan Gangguan Jiwa":
        $query = "DELETE FROM sk_gangguan_jiwa WHERE id_gj = '$id'";
        break;
    case "Surat Keterangan Ahli Waris":
        $query = "DELETE FROM sk_ahli_waris WHERE id_aw = '$id'";
        break;
    case "Surat Keterangan Tidak Mampu":
        $query = "DELETE FROM sk_tidak_mampu WHERE id_tm = '$id'";
        break;
    case "Surat Keterangan Penghasilan Orang Tua":
        $query = "DELETE FROM sk_penghasilan_orang_tua WHERE id_pot = '$id'";
        break;
    case "Surat Pengantar SKCK":
        $query = "DELETE FROM sk_pengantar_skck WHERE id_sps = '$id'";
        break;
    case "Surat Keterangan Domisili":
        $query = "DELETE FROM surat_keterangan_domisili WHERE id_skd = '$id'";
        break;
    case "Surat Kuasa":
        $query = "DELETE FROM sk_kuasa WHERE id_kuasa = '$id'";
        break;
    case "Surat Keterangan Jual Beli":
        $query = "DELETE FROM sk_jual_beli WHERE id_jb = '$id'";
        break;
    default:
        echo "<script>alert('Jenis surat tidak dikenali.'); history.back();</script>";
        exit;
}

$hapus = mysqli_query($connect, $query);

if ($hapus) {
    echo "<script>alert('Data surat berhasil dihapus.'); window.location.href='/surat_selesai/';</script>";
} else {
    echo "<script>alert('Gagal menghapus data.'); history.back();</script>";
}
?>
