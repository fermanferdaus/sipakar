<?php
    include ('../../config/koneksi.php');

    if (isset($_POST['submit'])){
        $nama = $_POST['fnama'];
        $jabatan =  $_POST['fjabatan'];

        // Upload gambar
        $namaFile   = $_FILES['ffoto']['name'];
        $tmpFile    = $_FILES['ffoto']['tmp_name'];
        $folder     = "../../assets/img/profil/";

        // Pastikan nama file unik
        $namaBaru = time() . "_" . $namaFile;
        $upload   = move_uploaded_file($tmpFile, $folder . $namaBaru);

        if ($upload) {
            $qTambahPengumuman = "INSERT INTO pejabat_desa VALUES(NULL, '$nama', '$jabatan', '$namaBaru')";
            $tambahPengumuman = mysqli_query($connect, $qTambahPengumuman);
            
            if ($tambahPengumuman) {
                header("location:index.php");
            } else {
                echo "<script>alert('Gagal menambahkan data ke database.'); history.back();</script>";
            }
        } else {
            echo "<script>alert('Gagal mengupload gambar.'); history.back();</script>";
        }
    }
?>
