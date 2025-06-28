<?php
    include ('../../config/koneksi.php');

    if (isset($_POST['submit'])){
        $id         = $_POST['id'];
        $nama      = $_POST['fnama'];
        $jabatan = $_POST['fjabatan'];
        $gambarLama = $_POST['foto_lama'];

        // Cek apakah user upload gambar baru
        if ($_FILES['ffoto']['name'] != '') {
            $namaFile = $_FILES['ffoto']['name'];
            $tmpFile  = $_FILES['ffoto']['tmp_name'];
            $folder   = "../../assets/img/profil/";

            // Buat nama file unik
            $namaBaru = time() . "_" . $namaFile;
            $upload   = move_uploaded_file($tmpFile, $folder . $namaBaru);

            if ($upload) {
                $gambar = $namaBaru;
            } else {
                echo "<script>alert('Gagal mengupload foto.'); history.back();</script>";
                exit;
            }
        } else {
            $gambar = $gambarLama;
        }

        $qUpdate = "UPDATE pejabat_desa SET nama_pejabat_desa='$nama', jabatan='$jabatan', foto='$gambar' WHERE id_pejabat_desa='$id'";
        $update = mysqli_query($connect, $qUpdate);

        if ($update) {
            header("location:index.php");
        } else {
            echo "<script>alert('Gagal memperbarui data.'); history.back();</script>";
        }
    }
?>
