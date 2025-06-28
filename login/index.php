<?php
session_start();
if (isset($_SESSION['admin']) || isset($_SESSION['kades'])) {
	header('location:../admin/dashboard/');
	exit;
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>SIPAKAR | Login</title>
	<link rel="shortcut icon" href="../assets/img/logo-lampura.png">
	<link rel="stylesheet" href="../assets/bootstrap-4.3.1/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="../assets/fontawesome-5.10.2/css/all.css">
	<style>
		body {
			background: linear-gradient(to right, #00b4db, #0083b0);
			min-height: 100vh;
			display: flex;
			justify-content: center;
			align-items: center;
			font-family: 'Segoe UI', sans-serif;
		}

		.card {
			border: none;
			border-radius: 1rem;
			box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
		}

		.card-header {
			background-color: transparent;
			border-bottom: none;
		}

		.login_btn {
			background-color: #0083b0;
			color: white;
			transition: 0.3s;
		}

		.login_btn:hover {
			background-color: #005f7f;
		}
	</style>
</head>

<body>
	<div class="container">
		<?php
		if (isset($_GET['pesan']) && $_GET['pesan'] == "login-gagal") {
			echo "<div class='alert alert-danger text-center'>Username atau Password Anda salah!</div>";
		}
		?>
		<div class="row justify-content-center">
			<div class="col-md-6 col-lg-5">
				<div class="card p-4">
					<div class="card-header text-center">
						<h3 class="text-info">Login SIPAKAR</h3>
					</div>
					<div class="card-body">
						<form method="POST" action="aksi-login.php">
							<div class="form-group">
								<label for="username">Username</label>
								<div class="input-group">
									<div class="input-group-prepend">
										<span class="input-group-text"><i class="fas fa-user"></i></span>
									</div>
									<input type="text" name="username" class="form-control"
										placeholder="Masukkan username" required>
								</div>
							</div>
							<div class="form-group">
                                <label for="password">Password</label>
                                <div class="input-group" id="show_hide_password">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                    </div>
                                    <input type="password" name="password" class="form-control"
                                        placeholder="Masukkan password" required>
                                    <div class="input-group-append">
                                        <span class="input-group-text toggle-password" style="cursor: pointer;"><i
                                                class="fas fa-eye"></i></span>
                                    </div>
                                </div>
                            </div>
							<button type="submit" class="btn login_btn btn-block mt-4">Login</button>
							<a href="daftar/" class="btn login_btn btn-block mt-2">Daftar</a>
						</form>
					</div>
					<div class="card-footer text-center">
						<small class="text-muted d-block">
							&copy; 2025 <a href="../"
								class="text-info font-weight-bold text-decoration-none">SIPAKAR</a><br>All rights
							reserved.
						</small>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script>
        document.querySelectorAll('.toggle-password').forEach(function (el) {
            el.addEventListener('click', function () {
                const input = this.parentElement.parentElement.querySelector('input');
                const icon = this.querySelector('i');
                if (input.type === "password") {
                    input.type = "text";
                    icon.classList.remove("fa-eye");
                    icon.classList.add("fa-eye-slash");
                } else {
                    input.type = "password";
                    icon.classList.remove("fa-eye-slash");
                    icon.classList.add("fa-eye");
                }
            });
        });
    </script>
</body>

</html>