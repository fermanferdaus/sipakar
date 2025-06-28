<?php
    include ('../../config/koneksi.php');

    if (isset($_POST['submit'])){
        $judul      = $_POST['fjudul'];
        $keterangan = addslashes($_POST['fketerangan']);

        // Upload gambar
        $namaFile   = $_FILES['fgambar']['name'];
        $tmpFile    = $_FILES['fgambar']['tmp_name'];
        $folder     = "../../assets/img/";

        // Pastikan nama file unik
        $namaBaru = time() . "_" . $namaFile;
        $upload   = move_uploaded_file($tmpFile, $folder . $namaBaru);

        if ($upload) {
            $qTambahPengumuman = "INSERT INTO pengumuman VALUES(NULL, '$namaBaru', '$judul', '$keterangan', NOW())";
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
