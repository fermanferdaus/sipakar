<?php
include('../../config/koneksi.php');

if (isset($_POST['submit'])) {
    $id       = $_POST['id'];
    $nama     = mysqli_real_escape_string($connect, $_POST['fnama']);
    $email    = mysqli_real_escape_string($connect, $_POST['femail']);
    $fotoLama = $_POST['foto_lama'];

    // Proses password
    $password   = $_POST['fpassword'];
    $konfirmasi = $_POST['fkonfirmasi'];
    $updatePassword = "";

    if (!empty($password)) {
        if ($password !== $konfirmasi) {
            echo "<script>alert('Password dan konfirmasi tidak cocok.'); history.back();</script>";
            exit;
        }

        // Gunakan md5 karena itu yang kamu pakai sekarang (saran: ganti password_hash nanti)
        $hashPassword = md5($password);
        $updatePassword = ", password='$hashPassword'";
    }

    // Proses upload foto baru
    if ($_FILES['ffoto']['name'] != '') {
        $namaFile = $_FILES['ffoto']['name'];
        $tmpFile  = $_FILES['ffoto']['tmp_name'];
        $folder   = "../../assets/img/profil/";
        $ext      = pathinfo($namaFile, PATHINFO_EXTENSION);
        $namaBaru = time() . "_" . uniqid() . "." . $ext;

        $upload = move_uploaded_file($tmpFile, $folder . $namaBaru);

        if ($upload) {
            // Hapus foto lama jika bukan default
            if (!empty($fotoLama) && file_exists($folder . $fotoLama) && $fotoLama != 'default-avatar.png') {
                unlink($folder . $fotoLama);
            }
            $foto = $namaBaru;
        } else {
            echo "<script>alert('Gagal mengupload foto.'); history.back();</script>";
            exit;
        }
    } else {
        $foto = $fotoLama;
    }

    // Bangun query update
    $qUpdate = "UPDATE login SET 
        nama='$nama', 
        email='$email', 
        foto_profil='$foto'
        $updatePassword 
        WHERE id='$id'";

    $update = mysqli_query($connect, $qUpdate);

    if ($update) {
        header("location:../dashboard/index.php");
    } else {
        die("QUERY ERROR: " . mysqli_error($connect));
    }
}
?>
