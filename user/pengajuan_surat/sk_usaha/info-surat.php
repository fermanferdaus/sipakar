<?php
include('../../../config/koneksi.php');
include('../part/header.php');

$nik = $_POST['fnik'];

$qCekNik = mysqli_query($connect, "SELECT * FROM penduduk WHERE nik = '$nik'");
$row = mysqli_num_rows($qCekNik);

if ($row > 0) {
	$data = mysqli_fetch_assoc($qCekNik);
	if ($data['nik'] == $nik) {
		$_SESSION['nik'] = $nik;
		?>
		<aside class="main-sidebar">
			<section class="sidebar">
				<ul class="sidebar-menu" data-widget="tree">
					<li class="header">MAIN NAVIGATION</li>
					<li>
						<a href="../../dashboard/">
							<i class="fas fa-tachometer-alt"></i> <span>&nbsp;&nbsp;Home</span>
						</a>
					</li>
					<li>
						<a href="../../data_penduduk/"><i class="fa fa-user"></i> <span>&nbsp;&nbsp;Data Penduduk</span></a>
					</li>
					<li>
						<a href="../../tambah_penduduk">
							<i class="fas fa-user-plus"></i> <span>&nbsp;&nbsp;Tambah Data</span>
						</a>
					</li>
					<li>
						<a href="../../profil/index.php?id=<?php echo $_SESSION['id']; ?>">
							<i class="fas fa-user-edit"></i> <span>&nbsp;&nbsp;Edit Profil</span>
						</a>
					</li>
					<li class="active">
						<a href="../">
							<i class="fas fa-envelope-open-text"></i> <span>&nbsp;&nbsp;Pengajuan Surat</span>
						</a>
					</li>
					<li>
						<a href="../../surat/surat_selesai/">
							<i class="fas fa-envelope"></i> <span>&nbsp;&nbsp;Lihat Surat</span>
						</a>
					</li>
					<li class="header">Other</li>
					<li>
						<a href="../../../login/logout.php">
							<i class="fas fa-sign-out-alt"></i> <span>&nbsp;&nbsp;Logout</span>
						</a>
					</li>
				</ul>
			</section>
		</aside>
		<div class="content-wrapper">
			<section class="content-header">
				<h1>Informasi Pengajuan Surat</h1>
			</section>
			<section class="content">
				<div class="row">
					<div class="col-md-12">
						<div class="box box-info">
							<div class="box-header with-border">
								<h3 class="box-title"><i class="fas fa-envelope"></i> SURAT KETERANGAN USAHA</h3>
							</div>

							<form class="form-horizontal" method="post" action="simpan-surat.php">
								<div class="box-body">

									<h4><b>Informasi Pribadi</b></h4>
									<hr>

									<?php
									$tgl_lhr = date($data['tgl_lahir']);
									$tgl = date('d ', strtotime($tgl_lhr));
									$bln = date('F', strtotime($tgl_lhr));
									$thn = date(' Y', strtotime($tgl_lhr));
									$blnIndo = [
										'January' => 'Januari',
										'February' => 'Februari',
										'March' => 'Maret',
										'April' => 'April',
										'May' => 'Mei',
										'June' => 'Juni',
										'July' => 'Juli',
										'August' => 'Agustus',
										'September' => 'September',
										'October' => 'Oktober',
										'November' => 'November',
										'December' => 'Desember'
									];
									?>

									<?php
									function formInput($label, $name, $value, $readonly = true)
									{
										$read = $readonly ? "readonly" : "";
										return "
                <div class='form-group'>
                  <label class='col-sm-2 control-label'>$label</label>
                  <div class='col-sm-10'>
                    <input type='text' name='$name' class='form-control' value='$value' $read>
                  </div>
                </div>";
									}
									?>

									<?= formInput("Nama Lengkap", "fnama", $data['nama']); ?>
									<?= formInput("Jenis Kelamin", "fjenis_kelamin", $data['jenis_kelamin']); ?>
									<?= formInput("Tempat, Tgl Lahir", "ftempat_tgl_lahir", $data['tempat_lahir'] . ", " . $tgl . $blnIndo[$bln] . $thn); ?>
									<?= formInput("Agama", "fagama", $data['agama']); ?>
									<?= formInput("Pekerjaan", "fpekerjaan", $data['pekerjaan']); ?>
									<?= formInput("NIK", "fnik", $data['nik']); ?>

									<div class="form-group">
										<label class="col-sm-2 control-label">Alamat</label>
										<div class="col-sm-10">
											<textarea name="falamat" class="form-control" rows="2"
												readonly><?=
													$data['jalan'] . ", RT" . $data['rt'] . "/RW" . $data['rw'] . ", Dusun " . $data['dusun'] . ", Desa " . $data['desa'] . ", Kecamatan " . $data['kecamatan'] . ", " . $data['kota']; ?></textarea>
										</div>
									</div>

									<?= formInput("Kewarganegaraan", "fkewarganegaraan", strtoupper($data['kewarganegaraan'])); ?>

									<hr>
									<h4><b>Formulir Usaha</b></h4>
									<hr>

									<div class="form-group">
										<label class="col-sm-2 control-label">Jumlah Usaha</label>
										<div class="col-sm-10">
											<select name="fjumlah_usaha" id="jumlah_usaha" class="form-control" required>
												<option value="">-- Jumlah Usaha --</option>
												<?php for ($i = 1; $i <= 5; $i++): ?>
													<option value="<?= $i ?>"><?= $i ?></option>
												<?php endfor; ?>
											</select>
										</div>
									</div>

									<!-- Form usaha dinamis -->
									<div class="form-group">
										<label class="col-sm-2 control-label">Jenis Usaha</label>
										<div class="col-sm-10" id="form-usaha-dinamis"></div>
									</div>

								</div>

								<div class="box-footer text-right">
									<button type="reset" class="btn btn-warning">Batal</button>
									<button type="submit" name="submit" class="btn btn-info">Submit</button>
								</div>

							</form>
						</div>
					</div>
				</div>
			</section>

			<script>
				document.getElementById("jumlah_usaha").addEventListener("change", function () {
					const jumlah = parseInt(this.value);
					const container = document.getElementById("form-usaha-dinamis");
					container.innerHTML = "";

					for (let i = 1; i <= jumlah; i++) {
						const input = document.createElement("input");
						input.type = "text";
						input.name = `fjenis_usaha_${i}`;
						input.placeholder = `Masukkan jenis usaha ke-${i}`;
						input.className = "form-control";
						input.required = true;
						input.style.marginBottom = "10px";
						container.appendChild(input);
					}
				});
			</script>
		</div>
		<?php
	}
} else {
	header("location:index.php?pesan=gagal");
}

include('../part/footer.php');
?>