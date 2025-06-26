<?php
    include ('../../config/koneksi.php');

    if (isset($_POST['submit'])){
        $jenis_surat = "Surat Keterangan Gangguan Jiwa";
        $nik = $_POST['fnik'];
        $status_surat = "PENDING";
        $id_profil_desa = "1";

        $qTambahSurat = "INSERT INTO sk_gangguan_jiwa (jenis_surat, nik, status_surat, id_profil_desa) 
        VALUES('$jenis_surat', '$nik', '$status_surat', '$id_profil_desa')";
        
        $TambahSurat = mysqli_query($connect, $qTambahSurat);
        header("location:../index.php?pesan=berhasil");
    }
?>