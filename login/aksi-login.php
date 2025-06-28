<?php
session_start();
include('../config/koneksi.php');

$username = $_POST['username'];
$password = md5($_POST['password']);

$qLogin = mysqli_query($connect, "SELECT * FROM login WHERE username='$username' AND password='$password'");
$row = mysqli_num_rows($qLogin);

if ($row > 0) {
	$login = mysqli_fetch_assoc($qLogin);

	// Set session umum
	$_SESSION['id'] = $login['id'];
	$_SESSION['username'] = $username;

	// Cek level
	if ($login['level'] == "admin") {
		$_SESSION['lvl'] = "Administrator";
		header("location:../admin/");
	} else if ($login['level'] == "kades") {
		$_SESSION['lvl'] = "Kepala Desa";
		header("location:../admin/");
	} else if ($login['level'] == "user") {
		$_SESSION['lvl'] = "User";
		header("location:../user/");
	} else {
		// Jika level tidak dikenali
		echo "<script>alert('Level tidak dikenali.'); window.location.href='index.php';</script>";
	}
} else {
	// Username atau password salah
	header("location:index.php?pesan=login-gagal");
}
?>
