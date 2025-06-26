<?php
include('../../config/koneksi.php');

if (isset($_POST['submit'])) {
    $jenis_surat = "Surat Keterangan Jual Beli";
    $nik = $_POST['fnik'];
    $nama_penjual = $_POST['fnama_penjual'];
    $umur_penjual = $_POST['fumur_penjual'];
    $pekerjaan_penjual = $_POST['fpekerjaan_penjual'];
    $alamat_penjual = $_POST['falamat_penjual'];

    $hari_transaksi = $_POST['fhari_transaksi'];
    $tanggal_transaksi = $_POST['ftanggal_transaksi'];

    $kategori_tanah = $_POST['fkategori_tanah'];
    $luas_tanah = $_POST['fluas_tanah'];
    $ukuran_tanah = $_POST['fukuran_tanah'];
    $lokasi_tanah = $_POST['flokasi_tanah'];
    $harga_tanah = $_POST['fharga'];

    $batas_utara = $_POST['fbatas_utara'];
    $batas_selatan = $_POST['fbatas_selatan'];
    $batas_timur = $_POST['fbatas_timur'];
    $batas_barat = $_POST['fbatas_barat'];

    $jumlah_saksi = $_POST['fjumlah_saksi'];
    $saksi_data = [];

    for ($i = 1; $i <= 5; $i++) {
        if ($i <= $jumlah_saksi) {
            $saksi_data["nama_saksi$i"] = $_POST["fnama_saksi_$i"];
            $saksi_data["alamat_saksi$i"] = $_POST["falamat_saksi_$i"];
        } else {
            $saksi_data["nama_saksi$i"] = '';
            $saksi_data["alamat_saksi$i"] = '';
        }
    }


    $status_surat = "PENDING";
    $id_profil_desa = "1";

    $qTambahSurat = "INSERT INTO sk_jual_beli (
        jenis_surat, nik,
        nama_penjual, umur_penjual, pekerjaan_penjual, alamat_penjual,
        hari_transaksi, tanggal_transaksi,
        kategori_tanah, luas_tanah, ukuran_tanah, lokasi_tanah, harga_tanah,
        batas_utara, batas_selatan, batas_timur, batas_barat,
        jumlah_saksi,
        nama_saksi1, alamat_saksi1,
        nama_saksi2, alamat_saksi2,
        nama_saksi3, alamat_saksi3,
        nama_saksi4, alamat_saksi4,
        nama_saksi5, alamat_saksi5,
        status_surat, id_profil_desa
    ) VALUES (
        '$jenis_surat', '$nik',
        '$nama_penjual', '$umur_penjual', '$pekerjaan_penjual', '$alamat_penjual',
        '$hari_transaksi', '$tanggal_transaksi',
        '$kategori_tanah', '$luas_tanah', '$ukuran_tanah', '$lokasi_tanah', '$harga_tanah',
        '$batas_utara', '$batas_selatan', '$batas_timur', '$batas_barat',
        '$jumlah_saksi',
        '{$saksi_data['nama_saksi1']}', '{$saksi_data['alamat_saksi1']}',
        '{$saksi_data['nama_saksi2']}', '{$saksi_data['alamat_saksi2']}',
        '{$saksi_data['nama_saksi3']}', '{$saksi_data['alamat_saksi3']}',
        '{$saksi_data['nama_saksi4']}', '{$saksi_data['alamat_saksi4']}',
        '{$saksi_data['nama_saksi5']}', '{$saksi_data['alamat_saksi5']}',
        '$status_surat', '$id_profil_desa'
    )";
    $TambahSurat = mysqli_query($connect, $qTambahSurat);
    header("location:../index.php?pesan=berhasil");
}
?>