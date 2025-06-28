<?php
include('../../../config/koneksi.php');

if (isset($_POST['submit'])) {
    $jenis_surat = "Surat Kuasa";
    $nik = $_POST['fnik'];
    $nama_k = $_POST['fnama_k'];
    $jenis_kelamin_k = $_POST['fj_kelamin_K'];
    $kewarganegaraan_k = $_POST['fkewarganegaraan_k'];
    $alamat_k = $_POST['falamat_k'];
    $kondisi_pihak1 = $_POST['fkondisi_pihak1'];
    $keterangan_kuasa = $_POST['fkuasa_pihak2'];
    $status_surat = "PENDING";
    $id_profil_desa = "1";

    $qTambahSurat = "INSERT INTO sk_kuasa (
        jenis_surat, nik, nama_kuasa, jenis_kelamin_kuasa, kewarganegaraan_kuasa, alamat_kuasa,
        kondisi_pihak1, keterangan_kuasa, status_surat, id_profil_desa
    ) VALUES (
        '$jenis_surat', '$nik', '$nama_k', '$jenis_kelamin_k', '$kewarganegaraan_k', '$alamat_k',
        '$kondisi_pihak1', '$keterangan_kuasa', '$status_surat', '$id_profil_desa'
    )";
    $TambahSurat = mysqli_query($connect, $qTambahSurat);
    header("location:../index.php?pesan=berhasil");
}
?>