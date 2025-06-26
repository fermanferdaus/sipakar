<?php
	include ('../../../../../config/koneksi.php');

	$id 				= $_POST['id'];
	$id_pejabat_desa 	= $_POST['ft_tangan'];
	$status_surat 		= "SELESAI";

	$qUpdate = "UPDATE sk_jual_beli SET id_pejabat_desa='$id_pejabat_desa', status_surat='$status_surat' WHERE id_jb='$id'";
	$update = mysqli_query($connect, $qUpdate);

	if($update){
		header('location:../../');
	}else{
	 	echo ("<script LANGUAGE='JavaScript'>window.alert('Gagal mengonfirmasi surat'); window.location.href='#'</script>");
	}
?>