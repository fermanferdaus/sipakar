<?php
    include ('../../config/koneksi.php');

    if (isset($_POST['submit'])){
        $jenis_surat = "Surat Keterangan Ahli Waris";
        $nik = $_POST['fnik'];
        $status_kuasa =$_POST['fstatus_kuasa'];
        $nama_aw = $_POST['fnama_aw'];
        $tempat_lahir_aw = $_POST['ftempat_lahir_aw'];
        $tgl_lahir = $_POST['ftgl_lahir_aw'];
        $pekerjaan = $_POST['fpekerjaan_aw'];
        $jalan = $_POST['fjalan_aw'];
        $dusun = $_POST['fdusun_aw'];
        $rt = $_POST['frt_aw'];
        $rw = $_POST['frw_aw'];
        $desa = $_POST['fdesa_aw'];
        $kecamatan = $_POST['fkecamatan_aw'];
        $kabupaten = $_POST['fkota_aw'];
        $status_aw = $_POST['fstatus_aw'];
        $status_surat = "PENDING";
        $id_profil_desa = "1";

        $qTambahSurat = "INSERT INTO sk_ahli_waris (
            jenis_surat, nik, status_kuasa, nama_aw, tempat_lahir_aw, tgl_lahir_aw, pekerjaan_aw, 
            jalan_aw, dusun_aw, rt_aw, rw_aw, desa_aw, kecamatan_aw, kabupaten_aw, status_aw, status_surat, id_profil_desa
        ) VALUES (
            '$jenis_surat', '$nik', '$status_kuasa', '$nama_aw', '$tempat_lahir_aw', '$tgl_lahir', '$pekerjaan', 
            '$jalan', '$dusun', '$rt', '$rw', '$desa', '$kecamatan', '$kabupaten', '$status_aw', '$status_surat', '$id_profil_desa'
        )";

        $TambahSurat = mysqli_query($connect, $qTambahSurat);
        header("location:../index.php?pesan=berhasil");
    }
?>