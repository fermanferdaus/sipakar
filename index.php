<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" href="assets/img/mini-logo.png">
	<title>SIPAKAR | Dashboard</title>
  	<link rel="stylesheet" href="assets/fontawesome-5.10.2/css/all.css">
	<link rel="stylesheet" href="assets/bootstrap-4.3.1/dist/css/bootstrap.min.css">
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
			background: url('assets/img/background.jpeg') center center / cover no-repeat;
			-webkit-filter: blur(8px);
			filter: blur(8px);
			z-index: -1; /* Memastikan background berada di bawah konten */
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
	  	<button class="navbar-toggler mr-4 mt-3" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
	    	<span class="navbar-toggler-icon"></span>
	  	</button>

	  	<div class="collapse navbar-collapse" id="navbarTogglerDemo02">
	    	<ul class="navbar-nav ml-auto mt-lg-3 mr-5 position-relative text-right">
	      		<li class="nav-item active">
	        		<a class="nav-link" href="#"><i class="fas fa-home"></i>&nbsp;HOME</a>
	      		</li>
	      		<li class="nav-item">
	        		<a class="nav-link" href="surat/">BUAT SURAT</a>
	      		</li>
	      		<li class="nav-item active ml-5">
	      			<?php
						session_start();

						if(empty($_SESSION['username'])){
						    echo '<a class="btn btn-light text-info" href="login/"><i class="fas fa-sign-in-alt"></i>&nbsp;LOGIN</a>';
						}else if(isset($_SESSION['lvl'])){
							echo '<a class="btn btn-transparent text-light" href="admin/"><i class="fa fa-user-cog"></i> '; echo $_SESSION['lvl']; echo '</a>';
							echo '<a class="btn btn-transparent text-light" href="login/logout.php"><i class="fas fa-power-off"></i></a>';
						}
					?>
	      		</li>
	    	</ul>
	  	</div>
	</navbar>
</div>
<div class="container" style="max-height:cover; padding-top:50px; padding-bottom:120px" align="center">
	<img src="assets/img/logo-lampura.png"><hr>
	<a class="text-light" style="font-size:18pt"><strong>SISTEM INFORMASI PELAYANAN ADMINISTRASI SURAT DESA</strong></a><br>
	<?php  
		include('config/koneksi.php');

        $qTampilDesa = mysqli_query($connect, "SELECT * FROM profil_desa WHERE id_profil_desa = '1'");
        foreach($qTampilDesa as $row){
    ?>
	<a class="text-light" style="font-size:15pt; text-transform: uppercase;"><strong>DESA <?php echo $row['nama_desa']; ?></strong><br>
	<a class="text-light" style="font-size:15pt; text-transform: uppercase;"><strong><?php echo $row['kota']; ?></strong></a><hr>
	<?php  
		}
	?>
	<a href="surat/" class="btn btn-outline-light" style="font-size:15pt"><i class="fas fa-envelope"></i> BUAT SURAT</a>
</div>
<footer class="bg-white text-center py-3 shadow-sm rounded mt-5 mx-3">
    <span class="text-secondary small">
        &copy; 2025 <strong><a href="#" class="text-decoration-none text-info">SIPAKAR</a></strong>. All rights reserved.
    </span>
</footer>

</body>
</html>