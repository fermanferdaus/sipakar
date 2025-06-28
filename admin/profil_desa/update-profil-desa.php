<?php
    include ('../../config/koneksi.php');

    if (isset($_POST['submit'])){
        $id         = $_POST['id'];
        $deskripsi = addslashes($_POST['fdeskripsi']);
        $gambarLama = $_POST['gambar_lama'];

        // Cek apakah user upload gambar baru
        if ($_FILES['fgambar']['name'] != '') {
            $namaFile = $_FILES['fgambar']['name'];
            $tmpFile  = $_FILES['fgambar']['tmp_name'];
            $folder   = "../../assets/img/";

            // Buat nama file unik
            $namaBaru = time() . "_" . $namaFile;
            $upload   = move_uploaded_file($tmpFile, $folder . $namaBaru);

            if ($upload) {
                $gambar = $namaBaru;
            } else {
                echo "<script>alert('Gagal mengupload gambar.'); history.back();</script>";
                exit;
            }
        } else {
            $gambar = $gambarLama;
        }

        $qUpdate = "UPDATE profil_desa SET deskripsi='$deskripsi', gambar_desa='$gambar' WHERE id_profil_desa='$id'";
        $update = mysqli_query($connect, $qUpdate);

        if ($update) {
            header("location:index.php");
        } else {
            echo "<script>alert('Gagal memperbarui data.'); history.back();</script>";
        }
    }
?>
