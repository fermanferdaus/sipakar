<?php
    include ('../../config/koneksi.php');

    if (isset($_POST['submit'])){
        $jenis_surat = "Surat Keterangan Kematian";
        $nik = $_POST['fnik'];
        $hari_m = $_POST['fhari_m'];
        $tgl_m = $_POST['ftgl_m'];
        $tempat_m = $_POST['ftempat_m'];
        $penyebab_m = $_POST['fpenyebab_m'];
        $ortu_m = $_POST['fortu_m'];
        $pasangan_m = $_POST['fpasangan_m'];
        $jumlah_anak = $_POST['fjumlah_anak'];
        $status_surat = "PENDING";
        $id_profil_desa = "1";

        // Inisialisasi semua anak ke null
        $anak = [];
        for ($i = 1; $i <= 10; $i++) {
            $anak[$i] = isset($_POST["fnama_anak$i"]) ? $_POST["fnama_anak$i"] : NULL;
        }

        $qTambahSurat = "INSERT INTO sk_kematian (
            jenis_surat, nik, hari_m, tgl_m, tempat_m, penyebab_m, ortu_m, pasangan_m, jumlah_anak,
            nama_anak_1, nama_anak_2, nama_anak_3, nama_anak_4, nama_anak_5,
            nama_anak_6, nama_anak_7, nama_anak_8, nama_anak_9, nama_anak_10,
            status_surat, id_profil_desa
        ) VALUES (
            '$jenis_surat', '$nik', '$hari_m', '$tgl_m', '$tempat_m', '$penyebab_m', '$ortu_m', '$pasangan_m', '$jumlah_anak',
            '{$anak[1]}', '{$anak[2]}', '{$anak[3]}', '{$anak[4]}', '{$anak[5]}',
            '{$anak[6]}', '{$anak[7]}', '{$anak[8]}', '{$anak[9]}', '{$anak[10]}',
            '$status_surat', '$id_profil_desa'
        )";

        $TambahSurat = mysqli_query($connect, $qTambahSurat);
        header("location:../index.php?pesan=berhasil");
    }
?>