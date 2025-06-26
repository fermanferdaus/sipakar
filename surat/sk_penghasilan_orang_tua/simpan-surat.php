<?php
    include ('../../config/koneksi.php');

    if (isset($_POST['submit'])){
        $jenis_surat = "Surat Keterangan Penghasilan Orang Tua";
        $nik = $_POST['fnik'];
        $penghasilan = $_POST['fpenghasilan'];
        $tanggungan = $_POST['ftanggungan'];
        $nama_pot = $_POST['fnama_pot'];
        $tempat_lahir_pot = $_POST['ftempat_lahir_pot'];
        $tgl_lahir_pot = $_POST['ftgl_lahir_pot'];
        $prodi = $_POST['fprodi'];
        $hubungan_keluarga = $_POST['fhubungan_keluarga'];
        $keperluan = $_POST['fkeperluan'];
        $status_surat = "PENDING";
        $id_profil_desa = "1";

        $qTambahSurat = "INSERT INTO sk_penghasilan_orang_tua (jenis_surat, nik, penghasilan, tanggungan, nama_pot, tempat_lahir_pot,
        tgl_lahir_pot, prodi, hubungan_keluarga, status_surat, keperluan, id_profil_desa
        ) VALUES(
        '$jenis_surat', '$nik', '$penghasilan', '$tanggungan', '$nama_pot', '$tempat_lahir_pot', '$tgl_lahir_pot', '$prodi', '$hubungan_keluarga',
        '$status_surat', '$keperluan', '$id_profil_desa'
        )";
        $TambahSurat = mysqli_query($connect, $qTambahSurat);
        header("location:../index.php?pesan=berhasil");
    }
?>