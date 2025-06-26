<?php
    include ('../../config/koneksi.php');

    if (isset($_POST['submit'])){
        $jenis_surat = "Surat Keterangan Kehilangan";
        $nik = $_POST['fnik'];
        $barang_hilang = $_POST['fbarang_hilang'];
        $hari = $_POST['fhari'];
        $tanggal_kehilangan = $_POST['ftgl_kehilangan'];
        $jam_kehilangan = $_POST['fjam_kehilangan'];
        $tempat_kehilangan = $_POST['ftempat_kehilangan'];
        $status_surat = "PENDING";
        $id_profil_desa = "1";

        $qTambahSurat = "INSERT INTO sk_kehilangan (jenis_surat, nik, barang_hilang, hari, tanggal_kehilangan,
        jam_kehilangan, tempat_kehilangan, status_surat, id_profil_desa) 
        VALUES ('$jenis_surat', '$nik', '$barang_hilang', '$hari', '$tanggal_kehilangan',
        '$jam_kehilangan', '$tempat_kehilangan', '$status_surat', '$id_profil_desa')";
        
        $TambahSurat = mysqli_query($connect, $qTambahSurat);
        header("location:../index.php?pesan=berhasil");
    }
?>