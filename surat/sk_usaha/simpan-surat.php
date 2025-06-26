<?php
    include ('../../config/koneksi.php');

    if (isset($_POST['submit'])){
        $jenis_surat = "Surat Keterangan Usaha";
        $nik = $_POST['fnik'];
        $jumlah_usaha = $_POST['fjumlah_usaha'];
        $jenis_usaha1 = $_POST['fjenis_usaha_1'] ?? NULL;
        $jenis_usaha2 = $_POST['fjenis_usaha_2'] ?? NULL;
        $jenis_usaha3 = $_POST['fjenis_usaha_3'] ?? NULL;
        $jenis_usaha4 = $_POST['fjenis_usaha_4'] ?? NULL;
        $jenis_usaha5 = $_POST['fjenis_usaha_5'] ?? NULL;
        $status_surat = "PENDING";
        $id_profil_desa = "1";

        $qTambahSurat = "INSERT INTO sk_usaha (
            jenis_surat, nik, jumlah_usaha, 
            jenis_usaha_1, jenis_usaha_2, jenis_usaha_3, jenis_usaha_4, jenis_usaha_5, 
            status_surat, id_profil_desa
        ) VALUES (
            '$jenis_surat', '$nik', '$jumlah_usaha', 
            '$jenis_usaha1', '$jenis_usaha2', '$jenis_usaha3', '$jenis_usaha4', '$jenis_usaha5', 
            '$status_surat', '$id_profil_desa'
        )";
        $TambahSurat = mysqli_query($connect, $qTambahSurat);
        header("location:../index.php?pesan=berhasil");
    }
?>