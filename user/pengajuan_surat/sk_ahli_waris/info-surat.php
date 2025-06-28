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
								<h3 class="box-title"><i class="fas fa-envelope"></i> FORMULIR SURAT KETERANGAN AHLI WARIS</h3>
							</div>
							<form class="form-horizontal" method="post" action="simpan-surat.php">
								<div class="box-body">
									<div class="form-group">
										<label class="col-sm-2 control-label">Nama Lengkap</label>
										<div class="col-sm-10">
											<input type="text" class="form-control" name="fnama"
												value="<?php echo $data['nama']; ?>" readonly>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-2 control-label">Jenis Kelamin</label>
										<div class="col-sm-10">
											<input type="text" class="form-control" name="fjenis_kelamin"
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
											<input type="text" class="form-control" name="ftempat_tgl_lahir"
												value="<?php echo $data['tempat_lahir'] . ", " . $tgl . $blnIndo[$bln] . $thn; ?>"
												readonly>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-2 control-label">Agama</label>
										<div class="col-sm-10">
											<input type="text" class="form-control" name="fagama"
												value="<?php echo $data['agama']; ?>" readonly>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-2 control-label">Pekerjaan</label>
										<div class="col-sm-10">
											<input type="text" class="form-control" name="fpekerjaan"
												value="<?php echo $data['pekerjaan']; ?>" readonly>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-2 control-label">NIK</label>
										<div class="col-sm-10">
											<input type="text" class="form-control" name="fnik"
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
											<input type="text" class="form-control" name="fkewarganegaraan"
												value="<?php echo strtoupper($data['kewarganegaraan']); ?>" readonly>
										</div>
									</div>
									<hr>
									<!-- Formulir Informasi Kuasa -->
									<h4><b><i></i> Formulir Informasi Kuasa</b></h4>
									<hr>
									<div class="form-group">
										<label class="col-sm-2 control-label">Status Kuasa</label>
										<div class="col-sm-10">
											<input type="text" class="form-control" name="fstatus_kuasa" placeholder="Status"
												required>
										</div>
									</div>
									<hr>
									<!-- Formulir Informasi Ahli Waris -->
									<h4><b><i></i> Formulir Informasi Ahli Waris</b></h4>
									<hr>
									<div class="form-group">
										<label class="col-sm-2 control-label">Nama</label>
										<div class="col-sm-10">
											<input type="text" class="form-control" name="fnama_aw"
												placeholder="Masukkan nama ahli waris" required>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-2 control-label">Tempat Lahir</label>
										<div class="col-sm-10">
											<input type="text" class="form-control" name="ftempat_lahir_aw"
												placeholder="Tempat lahir" required>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-2 control-label">Tanggal Lahir</label>
										<div class="col-sm-10">
											<input type="date" class="form-control" name="ftgl_lahir_aw" required>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-2 control-label">Pekerjaan</label>
										<div class="col-sm-10">
											<input type="text" class="form-control" name="fpekerjaan_aw" placeholder="Pekerjaan"
												required>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-2 control-label">Jalan</label>
										<div class="col-sm-10">
											<input type="text" name="fjalan_aw" class="form-control"
												style="text-transform: capitalize;" placeholder="Jalan" required>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-2 control-label">RT</label>
										<div class="col-sm-4">
											<input type="text" name="frt_aw" class="form-control" placeholder="RT" required>
										</div>
										<label class="col-sm-2 control-label">RW</label>
										<div class="col-sm-4">
											<input type="text" name="frw_aw" class="form-control" placeholder="RW" required>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-2 control-label">Dusun</label>
										<div class="col-sm-10">
											<select name="fdusun_aw" class="form-control" required>
												<option value="">-- Pilih Dusun --</option>
												<?php
												$qDusun = mysqli_query($connect, "SELECT * FROM dusun");
												while ($dusun = mysqli_fetch_assoc($qDusun)) {
													echo "<option value='{$dusun['nama_dusun']}'>{$dusun['nama_dusun']}</option>";
												}
												?>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-2 control-label">Desa</label>
										<div class="col-sm-10">
											<input type="text" name="fdesa_aw" class="form-control"
												style="text-transform: capitalize;" placeholder="Desa" required>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-2 control-label">Kecamatan</label>
										<div class="col-sm-10">
											<input type="text" name="fkecamatan_aw" class="form-control"
												style="text-transform: capitalize;" placeholder="Kecamatan" required>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-2 control-label">Kabupaten/Kota</label>
										<div class="col-sm-10">
											<input type="text" name="fkota_aw" class="form-control"
												style="text-transform: capitalize;" placeholder="Kabupaten/Kota" required>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-2 control-label">Status Ahli Waris</label>
										<div class="col-sm-10">
											<input type="text" class="form-control" name="fstatus_aw"
												placeholder="Status ahli waris" required>
										</div>
									</div>
								</div>
								<div class="box-footer">
									<div class="pull-right">
										<button type="reset" class="btn btn-warning">Batal</button>
										<button type="submit" name="submit" class="btn btn-info">Submit</button>
									</div>
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