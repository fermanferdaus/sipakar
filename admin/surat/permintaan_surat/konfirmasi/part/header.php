<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
  <link rel="shortcut icon" href="../../../../../assets/img/logo-lampura.png">
  <title>SIPAKAR | Admin</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="../../../../../assets/AdminLTE/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../../../../assets/AdminLTE/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="../../../../../assets/AdminLTE/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../../../../assets/AdminLTE/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
    folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="../../../../../assets/AdminLTE/dist/css/skins/_all-skins.min.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="../../../../../assets/AdminLTE/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  <!-- Font Awesome v5.8.2 -->
  <link rel="stylesheet" href="../../../../../assets/fontawesome-5.10.2/css/all.css">

  <!-- Google Font: Poppins -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">

  <style>
    body, html {
      font-family: 'Poppins', sans-serif !important;
    }
  </style>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
	<header class="main-header">
  	<a href="../../../../" class="logo" style="text-decoration:none">
      <span class="logo-mini" style="font-size: 18px; font-weight: bold; color: #fff;">
        <img src="../../../../../assets/img/logo-lampura.png" alt="Logo" style="height: 30px; margin-right: 8px;">
      </span>
      <span class="logo-lg" style="font-size: 20px; font-weight: bold; color: #fff; display: flex; align-items: center;">
        <img src="../../../../../assets/img/logo-lampura.png" alt="Logo" style="height: 30px; margin-right: 8px;">
        SIPAKAR
      </span>
    </a>
  	<nav class="navbar navbar-static-top">
		<!-- Hamburger menu -->
		<a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
			<span class="sr-only">Toggle navigation</span>
		</a>

		<!-- Tambahkan teks di sini -->
		<span class="navbar-brand" style="color: white; font-weight: bold; font-size: 16px; padding-left: 15px;">
			SISTEM INFORMASI PELAYANAN ADMINISTRASI SURAT DESA PAGAR
		</span>

		<div class="navbar-custom-menu">
			<ul class="nav navbar-nav" style="display: flex; align-items: center;">
			<!-- Logout button -->
			<li class="dropdown user user-menu">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">
					<?php  
					if(isset($_SESSION['lvl']) && ($_SESSION['lvl'] == 'Administrator')){
						echo '<img src="../../../../../assets/img/ava-admin-female.png" class="user-image" alt="User Image">';
					} else if(isset($_SESSION['lvl']) && ($_SESSION['lvl'] == 'Kepala Desa')){
						echo '<img src="../../../../../assets/img/ava-kades.png" class="user-image" alt="User Image">';
					}
					?>
					<span class="hidden-xs"><?php echo $_SESSION['lvl']; ?></span>
				</a>
				<ul class="dropdown-menu">
					<!-- User image di dalam dropdown -->
					<li class="user-header">
					<?php  
						if(isset($_SESSION['lvl']) && ($_SESSION['lvl'] == 'Administrator')){
						echo '<img src="../../../../../assets/img/ava-admin-female.png" class="img-circle" alt="User Image">';
						} else if(isset($_SESSION['lvl']) && ($_SESSION['lvl'] == 'Kepala Desa')){
						echo '<img src="../../../../../assets/img/ava-kades.png" class="img-circle" alt="User Image">';
						}
					?>
					<p>
						<?php echo $_SESSION['lvl']; ?>
						<small>Online</small>
					</p>
					</li>
					<!-- Menu Footer-->
					<li class="user-footer">
					<div class="pull-right">
						<a href="../../../../../login/logout.php" class="btn btn-default btn-flat">Logout</a>
					</div>
					</li>
				</ul>
				</li>
			</ul>
		</div>
	</nav>
	</header>