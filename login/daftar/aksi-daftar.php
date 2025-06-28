<?php
session_start();
include('../../config/koneksi.php');

$nama       = $_POST['nama'];
$username   = $_POST['username'];
$email      = $_POST['email'];
$password   = $_POST['password'];
$konfirmasi = $_POST['konfirmasi'];
$level = 'user';

// Cek konfirmasi password
if ($password != $konfirmasi) {
	echo "<script>alert('Password dan konfirmasi tidak sama!');
	window.location.href = 'index.php';</script>";
	exit;
}

// Cek apakah username sudah digunakan
$qCek = mysqli_query($connect, "SELECT * FROM login WHERE username='$username'");
if (mysqli_num_rows($qCek) > 0) {
	echo "<script>alert('Username sudah digunakan!');
	window.location.href = 'index.php';</script>";
	exit;
}

// Enkripsi password pakai md5 (agar konsisten dengan login)
$passwordHash = md5($password);

// Simpan ke database
$qDaftar = mysqli_query($connect, "INSERT INTO login (nama, username, email, password, level) VALUES ('$nama', '$username', '$email', '$passwordHash', '$level')");

if ($qDaftar) {
	echo "<script>alert('Pendaftaran berhasil! Silakan login.');
	window.location.href = '../index.php';</script>";
} else {
	echo "<script>alert('Gagal mendaftar. Silakan coba lagi!');
	window.location.href = 'index.php';</script>";
}
?>
