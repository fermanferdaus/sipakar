<?php
include('../config/koneksi.php');
?>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="../assets/img/logo-lampura.png">
    <title>SIPAKAR | Pengumuman</title>
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
                    <li class="nav-item">
                        <a class="nav-link" href="../"><i class="fas fa-home"></i>&nbsp;HOME</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../profil/">PROFIL</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="#">&nbsp;PENGUMUMAN</a>
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
        <!-- Card Utama Pengumuman -->
        <div class="card mx-auto shadow-lg rounded" style="max-width: 1000px; background-color: #ffffff;">
            <div class="card-body">

                <h4 class="text-dark mb-4"><strong>Pengumuman Terbaru</strong></h4>

                <?php
                $qPengumuman = mysqli_query($connect, "SELECT * FROM pengumuman ORDER BY tanggal DESC LIMIT 5");
                while ($pengumuman = mysqli_fetch_assoc($qPengumuman)) {
                    ?>
                    <!-- Card Per Pengumuman -->
                    <div class="card mb-4 mx-auto shadow rounded" style="background-color: #f8f9fa; max-width: 90%;">
                        <div class="row no-gutters">
                            <div class="col-md-4">
                                <img src="../assets/img/<?php echo $pengumuman['gambar']; ?>"
                                    class="img-fluid h-100 rounded-left" style="object-fit: cover;" alt="Gambar Pengumuman">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body text-left">
                                    <h5 class="card-title font-weight-bold text-dark"><?php echo $pengumuman['judul']; ?>
                                    </h5>
                                    <p class="card-text text-muted">
                                        <?php
                                        $maxLength = 180;
                                        $keterangan = strip_tags($pengumuman['keterangan']);
                                        echo strlen($keterangan) > $maxLength
                                            ? substr($keterangan, 0, $maxLength) . '...'
                                            : $keterangan;
                                        ?>
                                    </p>
                                    <p class="card-text"><small class="text-muted">Tanggal:
                                            <?php echo date("d M Y", strtotime($pengumuman['tanggal'])); ?></small></p>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>

            </div>
        </div>
    </div>

    <footer class="text-center py-3 shadow-sm rounded mt-5 mx-3" style="background-color: transparent;">
        <span class="text-secondary small">
            &copy; 2025 <strong><a href="#" class="text-decoration-none text-info">SIPAKAR</a></strong>. All rights
            reserved.
        </span>
    </footer>

</body>

</html>