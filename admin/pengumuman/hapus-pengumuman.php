<?php
	include ('../../config/koneksi.php');

	$id = $_GET['id'];

	// Ambil nama file gambar terlebih dahulu
	$qGambar = mysqli_query($connect, "SELECT gambar FROM pengumuman WHERE id_pengumuman = '$id'");
	$dataGambar = mysqli_fetch_assoc($qGambar);
	$gambar = $dataGambar['gambar'];

	// Hapus file gambar jika ada
	if ($gambar != '' && file_exists("../../assets/img/$gambar")) {
		unlink("../../assets/img/$gambar");
	}

	// Hapus data dari database
	$qHapus = mysqli_query($connect, "DELETE FROM pengumuman WHERE id_pengumuman = '$id'");

	if($qHapus){
		header('location:index.php');
	} else {
		header('location:index.php?pesan=gagal-menghapus');
	}
?>
