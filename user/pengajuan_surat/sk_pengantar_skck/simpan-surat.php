<?php
    include ('../../../config/koneksi.php');

    if (isset($_POST['submit'])){
        $jenis_surat = "Surat Pengantar SKCK";
        $nik = $_POST['fnik'];
        $keperluan = $_POST['fkeperluan'];
        $status_surat = "PENDING";
        $id_profil_desa = "1";

        $qTambahSurat = "INSERT INTO sk_pengantar_skck (jenis_surat, nik, keperluan, status_surat, id_profil_desa) VALUES('$jenis_surat', '$nik', '$keperluan', '$status_surat', '$id_profil_desa')";
        $TambahSurat = mysqli_query($connect, $qTambahSurat);
        header("location:../index.php?pesan=berhasil");
    }
?>