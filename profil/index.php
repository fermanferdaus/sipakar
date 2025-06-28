<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" href="../assets/img/logo-lampura.png">
	<title>SIPAKAR | Profil</title>
	<link rel="stylesheet" href="../assets/fontawesome-5.10.2/css/all.css">
	<link rel="stylesheet" href="../assets/bootstrap-4.3.1/dist/css/bootstrap.min.css">
	<style type="text/css">
		/* Menambahkan efek blur pada background */
		body {
			position: relative;
			height: 100%;
			margin: 0;
		}

		/* Efek blur pada background */
		body::after {
			content: '';
			position: absolute;
			top: 0;
			left: 0;
			width: 100%;
			height: 100%;
			background: url('../assets/img/background.jpeg') center center / cover no-repeat;
			-webkit-filter: blur(8px);
			filter: blur(8px);
			z-index: -1;
			/* Memastikan background berada di bawah konten */
			background-attachment: fixed;
		}

		/* Tampilan konten lainnya */
		.container {
			position: relative;
			z-index: 1;
			max-height: cover;
			padding-top: 50px;
			padding-bottom: 120px;
			text-align: center;
		}

		/* Mengubah warna tombol dan teks agar terlihat jelas di atas background */
		.text-light {
			color: white;
		}

		.btn-outline-light {
			border-color: white;
			color: white;
		}

		.btn-outline-light:hover {
			background-color: white;
			color: black;
		}

		.btn-custom {
			background-color: #17a2b8;
			color: white;
			border-radius: 25px;
			padding: 8px 22px;
			transition: 0.3s;
			font-weight: 600;
			text-transform: uppercase;
			font-size: 0.9rem;
		}

		.btn-custom:hover {
			background-color: #138496;
			color: white;
			transform: scale(1.05);
		}
	</style>
</head>

<body>
	<div>
		<navbar class="navbar navbar-expand-lg navbar-dark bg-transparent">
			<button class="navbar-toggler mr-4 mt-3" type="button" data-toggle="collapse"
				data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false"
				aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse" id="navbarTogglerDemo02">
				<ul class="navbar-nav ml-auto mt-lg-3 mr-5 position-relative text-right">
					<li class="nav-item ">
						<a class="nav-link" href="../"><i class="fas fa-home"></i>&nbsp;HOME</a>
					</li>
					<li class="nav-item active">
						<a class="nav-link" href="#">PROFIL</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="../pengumuman/">&nbsp;PENGUMUMAN</a>
					</li>
					<li class="nav-item active ml-5">
						<?php
						session_start();

						if (empty($_SESSION['username'])) {
							echo '<a class="btn btn-light text-info" href="../login/"><i class="fas fa-sign-in-alt"></i>&nbsp;LOGIN</a>';
						} else if (isset($_SESSION['lvl'])) {
							echo '<a class="btn btn-transparent text-light" href="../admin/"><i class="fa fa-user-cog"></i> ';
							echo $_SESSION['lvl'];
							echo '</a>';
							echo '<a class="btn btn-transparent text-light" href="../login/logout.php"><i class="fas fa-power-off"></i></a>';
						}
						?>
					</li>
				</ul>
			</div>
		</navbar>
	</div>
	<div class="container" style="padding-top:50px; padding-bottom:120px;" align="center">
		<?php
		include('../config/koneksi.php');
		$qTampilDesa = mysqli_query($connect, "SELECT * FROM profil_desa WHERE id_profil_desa = '1'");
		foreach ($qTampilDesa as $row) {
			?>
			<!-- Card Utama -->
			<div class="card mx-auto shadow-lg rounded" <div class="card mx-auto shadow-lg rounded"
				style="max-width: 1000px; background-color: #ffffff;">
				<div class="card-body">

					<!-- Nama Desa dan Kota -->
					<h4 class="text-dark text-uppercase"><strong>Desa <?php echo $row['nama_desa']; ?></strong></h4>
					<h5 class="text-dark text-uppercase mb-4"><strong><?php echo $row['kota']; ?></strong></h5>

					<!-- Gambar Desa -->
					<img src="../assets/img/<?php echo $row['gambar_desa']; ?>" class="img-fluid rounded shadow mb-4"
						style="max-width: 100%;">

					<!-- Card Deskripsi -->
					<div class="card mb-4 mx-auto shadow" style="max-width: 90%;">
						<div class="card-body text-dark text-justify">
							<?php echo nl2br($row['deskripsi']); ?>
						</div>
					</div>

					<?php
					// Ambil data kepala desa
					$qKepala = mysqli_query($connect, "SELECT * FROM pejabat_desa WHERE jabatan = 'Kepala Desa' LIMIT 1");
					$kepala = mysqli_fetch_assoc($qKepala);
					if ($kepala) {
						?>
						<!-- Card Kepala Desa -->
						<div class="card mx-auto shadow-sm rounded mb-3" style="max-width: 300px;">
							<img src="../assets/img/profil/<?php echo $kepala['foto']; ?>" class="card-img-top" alt="Foto Kepala Desa">
							<div class="card-body text-center">
								<h5 class="card-title">Kepala Desa</h5>
								<p class="mb-1"><strong><?php echo $kepala['nama_pejabat_desa']; ?></strong></p>
								<p class="small">Alamat: <?php echo $row['alamat']; ?></p>
							</div>
						</div>
					<?php } ?>

				</div> <!-- card-body -->
			</div> <!-- card utama -->
		<?php } ?>
	</div>

	<footer class="text-center py-3 shadow-sm rounded mt-5 mx-3" style="background-color: transparent;">
		<span class="text-secondary small">
			&copy; 2025 <strong><a href="#" class="text-decoration-none text-info">SIPAKAR</a></strong>. All rights
			reserved.
		</span>
	</footer>

</body>

</html>