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
								<h3 class="box-title"><i class="fas fa-envelope"></i> FORMULIR SURAT KETERANGAN KEMATIAN</h3>
							</div>

							<form class="form-horizontal" method="post" action="simpan-surat.php">
								<div class="box-body">

									<!-- INFORMASI PRIBADI -->
									<h4><b>Informasi Pribadi</b></h4>
									<hr>

									<div class="form-group">
										<label class="col-sm-2 control-label">Nama Lengkap</label>
										<div class="col-sm-10">
											<input type="text" name="fnama" class="form-control"
												value="<?php echo $data['nama']; ?>" readonly>
										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-2 control-label">Jenis Kelamin</label>
										<div class="col-sm-10">
											<input type="text" name="fjenis_kelamin" class="form-control"
												value="<?php echo $data['jenis_kelamin']; ?>" readonly>
										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-2 control-label">Tempat, Tgl Lahir</label>
										<div class="col-sm-10">
											<?php
											$tgl_lhr = date($data['tgl_lahir']);
											$tgl = date('d ', strtotime($tgl_lhr));
											$bln = date('F', strtotime($tgl_lhr));
											$thn = date(' Y', strtotime($tgl_lhr));
											$blnIndo = array(
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
											);
											?>
											<input type="text" name="ftempat_tgl_lahir" class="form-control"
												value="<?php echo $data['tempat_lahir'] . ', ' . $tgl . $blnIndo[$bln] . $thn; ?>"
												readonly>
										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-2 control-label">Agama</label>
										<div class="col-sm-10">
											<input type="text" name="fagama" class="form-control"
												value="<?php echo $data['agama']; ?>" readonly>
										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-2 control-label">Pekerjaan</label>
										<div class="col-sm-10">
											<input type="text" name="fpekerjaan" class="form-control"
												value="<?php echo $data['pekerjaan']; ?>" readonly>
										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-2 control-label">NIK</label>
										<div class="col-sm-10">
											<input type="text" name="fnik" class="form-control"
												value="<?php echo $data['nik']; ?>" readonly>
										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-2 control-label">Alamat</label>
										<div class="col-sm-10">
											<textarea name="falamat" class="form-control" rows="2"
												readonly><?php echo $data['jalan'] . ", RT" . $data['rt'] . "/RW" . $data['rw'] . ", Dusun " . $data['dusun'] . ", Desa " . $data['desa'] . ", Kecamatan " . $data['kecamatan'] . ", " . $data['kota']; ?></textarea>
										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-2 control-label">Kewarganegaraan</label>
										<div class="col-sm-10">
											<input type="text" name="fkewarganegaraan" class="form-control"
												value="<?php echo strtoupper($data['kewarganegaraan']); ?>" readonly>
										</div>
									</div>

									<!-- FORMULIR KETERANGAN MENINGGAL -->
									<hr>
									<h4><b>Formulir Keterangan Meninggal</b></h4>
									<hr>

									<div class="form-group">
										<label class="col-sm-2 control-label">Hari</label>
										<div class="col-sm-10">
											<input type="text" name="fhari_m" class="form-control"
												placeholder="Masukkan hari meninggal" required>
										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-2 control-label">Tanggal Meninggal</label>
										<div class="col-sm-10">
											<input type="date" name="ftgl_m" class="form-control" required>
										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-2 control-label">Tempat Pemakaman</label>
										<div class="col-sm-10">
											<input type="text" name="ftempat_m" class="form-control"
												placeholder="Masukkan tempat pemakaman" required>
										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-2 control-label">Penyebab Meninggal</label>
										<div class="col-sm-10">
											<input type="text" name="fpenyebab_m" class="form-control"
												placeholder="Masukkan penyebab meninggal" required>
										</div>
									</div>

									<!-- INFORMASI AHLI WARIS -->
									<hr>
									<h4><b>Formulir Informasi Ahli Waris</b></h4>
									<hr>

									<div class="form-group">
										<label class="col-sm-2 control-label">Bapak/Ibu</label>
										<div class="col-sm-10">
											<input type="text" name="fortu_m" class="form-control"
												placeholder="Masukkan nama Bapak atau Ibu" required>
										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-2 control-label">Suami/Isteri</label>
										<div class="col-sm-10">
											<input type="text" name="fpasangan_m" class="form-control"
												placeholder="Masukkan nama Suami atau Isteri" required>
										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-2 control-label">Jumlah Anak</label>
										<div class="col-sm-10">
											<input type="number" name="fjumlah_anak" id="jumlah_anak" class="form-control"
												placeholder="Masukkan jumlah anak" min="1" max="10" required>
										</div>
									</div>

									<div id="form-anak-dinamis"></div>

									<script>
										document.getElementById("jumlah_anak").addEventListener("input", function () {
											const jumlah = parseInt(this.value);
											const container = document.getElementById("form-anak-dinamis");
											container.innerHTML = "";

											if (!isNaN(jumlah) && jumlah > 0 && jumlah <= 10) {
												for (let i = 1; i <= jumlah; i++) {
													const div = document.createElement("div");
													div.classList.add("form-group");
													div.innerHTML = `
														<label class="col-sm-2 control-label">Nama Anak ${i}</label>
														<div class="col-sm-10">
															<input type="text" name="fnama_anak${i}" class="form-control" placeholder="Masukkan nama anak ke-${i}" required>
														</div>
														`;
													container.appendChild(div);
												}
											}
										});
									</script>
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