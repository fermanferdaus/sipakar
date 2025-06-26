<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" href="../assets/img/mini-logo.png">
	<title>SIPAKAR | Buat Surat</title>
  
  	<!-- Font & CSS -->
  	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="../assets/fontawesome-5.10.2/css/all.css">
	<link rel="stylesheet" href="../assets/bootstrap-4.3.1/dist/css/bootstrap.min.css">

	<style>
		* {
			font-family: 'Poppins', sans-serif;
		}

		body {
			position: relative;
			height: 100%;
			margin: 0;
			background-color: #f8f9fa;
		}

		body::after {
			content: '';
			position: absolute;
			top: 0;
			left: 0;
			width: 100%;
			height: 100%;
			background: url('../assets/img/background.jpeg') center center / cover no-repeat;
			filter: blur(8px);
			z-index: -1;
			background-attachment: fixed;
		}

		.container {
			position: relative;
			z-index: 1;
			padding-top: 60px;
			padding-bottom: 120px;
		}

		.navbar a.nav-link,
		.navbar a.btn {
			font-weight: 500;
		}

		.card-modern {
			border-radius: 20px;
			box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
			background: rgba(255, 255, 255, 0.95);
			border: 1px solid #eaeaea;
			text-align: center;
			padding: 40px 25px;
			transition: transform 0.3s ease, box-shadow 0.3s ease;
		}

		.card-modern:hover {
			transform: translateY(-8px);
			box-shadow: 0 12px 35px rgba(0, 0, 0, 0.12);
		}

		.card-modern .card-title {
			font-size: 1.05rem;
			font-weight: 600;
			color: #212529;
			min-height: 50px;
			margin-bottom: 20px;
		}

		.btn-custom {
			background-color: #4dabf7;
			color: #fff;
			border-radius: 30px;
			padding: 10px 24px;
			font-weight: 600;
			transition: all 0.3s ease;
			font-size: 0.9rem;
			text-transform: uppercase;
			box-shadow: 0 4px 12px rgba(13, 110, 253, 0.3);
			border: none;
		}

		.btn-custom:hover {
			background-color: #4dabf7;
			transform: translateY(-2px);
			color: white;
		}

		.alert-success {
			background-color: #e8f5e9;
			color: #2e7d32;
			border: none;
			border-radius: 8px;
		}

		footer {
			z-index: 2;
		}

		footer span {
			font-size: 0.875rem;
		}
	</style>
</head>
<body>
	<navbar class="navbar navbar-expand-lg navbar-dark bg-transparent">
	  	<button class="navbar-toggler mr-4 mt-3" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
	    	<span class="navbar-toggler-icon"></span>
	  	</button>

	  	<div class="collapse navbar-collapse" id="navbarTogglerDemo02">
	    	<ul class="navbar-nav ml-auto mt-lg-3 mr-5 position-relative text-right">
	      		<li class="nav-item">
	        		<a class="nav-link" href="../"><i class="fas fa-home"></i>&nbsp;HOME</a>
	      		</li>
	      		<li class="nav-item">
	        		<a class="nav-link active" href="#">BUAT SURAT</a>
	      		</li>
	      		<li class="nav-item active ml-5">
	      			<?php
						session_start();

						if(empty($_SESSION['username'])){
						    echo '<a class="btn btn-light text-info" href="../login/"><i class="fas fa-sign-in-alt"></i>&nbsp;LOGIN</a>';
						}else if(isset($_SESSION['lvl'])){
							echo '<a class="btn btn-transparent text-light" href="../admin/"><i class="fa fa-user-cog"></i> '; echo $_SESSION['lvl']; echo '</a>';
							echo '<a class="btn btn-transparent text-light" href="../login/logout.php"><i class="fas fa-power-off"></i></a>';
						}
					?>
	      		</li>
	    	</ul>
	  	</div>
	</navbar>

<div class="container-fluid">
	<?php 
		if(isset($_GET['pesan']) && $_GET['pesan']=="berhasil"){
	  		echo "<div class='alert alert-success text-center font-weight-bold'>✅ Berhasil membuat surat! Silahkan ambil surat di Kantor Desa dalam 2-3 hari kerja.</div>";
		}
	?>
	<div class="row justify-content-center">
		<?php
			$data_surat = [
				["SK AHLI WARIS", "sk_ahli_waris/"],
				["SK JUAL BELI", "sk_jual_beli/"],
				["SK DOMISILI", "sk_domisili/"],
				["SK KEHILANGAN", "sk_kehilangan/"],
				["SK GANGGUAN JIWA", "sk_gangguan_jiwa/"],
				["SK KEMATIAN", "sk_kematian/"],
				["SK PENGHASILAN ORANG TUA", "sk_penghasilan_orang_tua/"],
				["SK PENGANTAR SKCK", "sk_pengantar_skck/"],
				["SK TIDAK MAMPU", "sk_tidak_mampu/"],
				["SK USAHA", "sk_usaha/"],
				["SURAT KUASA", "sk_kuasa/"],
			];
			foreach($data_surat as $surat){
				echo '
				<div class="col-md-6 col-lg-4 col-xl-3 mt-4 d-flex align-items-stretch">
					<div class="card card-modern w-100">
						<div class="card-body">
							<h5 class="card-title">'.$surat[0].'</h5>
							<a href="'.$surat[1].'" class="btn btn-custom">Buat Surat</a>
						</div>
					</div>
				</div>';
			}
		?>
	</div>
</div>

<footer class="bg-white text-center py-3 shadow-sm rounded mt-5 mx-3">
    <span class="text-secondary small">
        &copy; 2025 <strong><a href="#" class="text-decoration-none text-info">SIPAKAR</a></strong>. All rights reserved.
    </span>
</footer>

<!-- Bootstrap JS (pastikan diletakkan di akhir body) -->
<script src="../assets/bootstrap-4.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
