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
								<h3 class="box-title"><i class="fas fa-envelope"></i> SURAT KETERANGAN TIDAK MAMPU</h3>
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
												readonly><?= $data['jalan'] . ", RT" . $data['rt'] . "/RW" . $data['rw'] . ", Dusun " . $data['dusun'] . ", Desa " . $data['desa'] . ", Kecamatan " . $data['kecamatan'] . ", " . $data['kota']; ?></textarea>
										</div>
									</div>

									<?= formInput("Kewarganegaraan", "fkewarganegaraan", strtoupper($data['kewarganegaraan'])); ?>

									<hr>
									<h4><b>Formulir Identitas Anak</b></h4>
									<hr>

									<?php
									function inputField($label, $name, $type = 'text', $placeholder = '', $required = true)
									{
										$req = $required ? "required" : "";
										return "
											<div class='form-group'>
												<label class='col-sm-2 control-label'>$label</label>
												<div class='col-sm-10'>
													<input type='$type' name='$name' class='form-control' placeholder='$placeholder' style='text-transform: capitalize;' $req>
												</div>
											</div>";
									}
									?>

									<?= inputField("Nama", "fnama_tm", 'text', 'Masukkan Nama'); ?>
									<?= inputField("Tempat Lahir", "ftempat_lahir_tm", 'text', 'Tempat lahir'); ?>
									<?= inputField("Tanggal Lahir", "ftgl_lahir_tm", 'date', '', true); ?>
									<?= inputField("Pekerjaan", "fpekerjaan_tm", 'text', 'Pekerjaan'); ?>
									<?= inputField("Jalan", "fjalan_tm", 'text', 'Nama Jalan'); ?>

									<div class="form-group">
										<label class="col-sm-2 control-label">Dusun</label>
										<div class="col-sm-10">
											<select name="fdusun_tm" class="form-control" required>
												<option value="">-- Dusun --</option>
												<?php
												$qTampilDusun = "SELECT * FROM dusun";
												$tampilDusun = mysqli_query($connect, $qTampilDusun);
												while ($rows = mysqli_fetch_assoc($tampilDusun)) {
													echo "<option value='{$rows['nama_dusun']}'>{$rows['nama_dusun']}</option>";
												}
												?>
											</select>
										</div>
									</div>

									<?= inputField("RT", "frt_tm", 'text', 'RT'); ?>
									<?= inputField("RW", "frw_tm", 'text', 'RW'); ?>
									<?= inputField("Desa", "fdesa_tm", 'text', 'Desa'); ?>
									<?= inputField("Kecamatan", "fkecamatan_tm", 'text', 'Kecamatan'); ?>
									<?= inputField("Kabupaten", "fkota_tm", 'text', 'Kabupaten'); ?>
									<?= inputField("Agama", "fagama_tm", 'text', 'Agama'); ?>

									<hr>
									<h4><b>Formulir Keperluan</b></h4>
									<hr>

									<?= inputField("Keperluan", "fkeperluan", 'text', 'Keperluan'); ?>

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
		</div>
		<?php
	}
} else {
	header("location:index.php?pesan=gagal");
}

include('../part/footer.php');
?>