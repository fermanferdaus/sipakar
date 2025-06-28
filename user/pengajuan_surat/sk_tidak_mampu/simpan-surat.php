<?php
    include ('../../../config/koneksi.php');

    if (isset($_POST['submit'])){
        $jenis_surat = "Surat Keterangan Tidak Mampu";
        $nik = $_POST['fnik'];
        $keperluan = $_POST['fkeperluan'];
        $nama_tm = $_POST['fnama_tm'];
        $tempat_lahir_tm = $_POST['ftempat_lahir_tm'];
        $tgl_lahir = $_POST['ftgl_lahir_tm'];
        $pekerjaan = $_POST['fpekerjaan_tm'];
        $jalan = $_POST['fjalan_tm'];
        $dusun = $_POST['fdusun_tm'];
        $rt = $_POST['frt_tm'];
        $rw = $_POST['frw_tm'];
        $desa = $_POST['fdesa_tm'];
        $kecamatan = $_POST['fkecamatan_tm'];
        $kabupaten = $_POST['fkota_tm'];
        $agama_tm = $_POST['fagama_tm'];
        $status_surat = "PENDING";
        $id_profil_desa = "1";

        $qTambahSurat = "INSERT INTO sk_tidak_mampu (
            jenis_surat, nik, keperluan, nama_tm, tempat_lahir_tm, tgl_lahir_tm, pekerjaan_tm, 
            jalan_tm, dusun_tm, rt_tm, rw_tm, desa_tm, kecamatan_tm, kabupaten_tm, agama_tm, status_surat, id_profil_desa
        ) VALUES (
            '$jenis_surat', '$nik', '$keperluan', '$nama_tm', '$tempat_lahir_tm', '$tgl_lahir', '$pekerjaan', 
            '$jalan', '$dusun', '$rt', '$rw', '$desa', '$kecamatan', '$kabupaten', '$agama_tm', '$status_surat', '$id_profil_desa'
        )";
        $TambahSurat = mysqli_query($connect, $qTambahSurat);
        header("location:../index.php?pesan=berhasil");
    }
?>