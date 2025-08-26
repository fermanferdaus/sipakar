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
								<h3 class="box-title"><i class="fas fa-envelope"></i> FORMULIR SURAT KETERANGAN HAJATAN</h3>
							</div>

							<form class="form-horizontal" method="post" action="simpan-surat.php">
								<div class="box-body">

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

									<hr>
									<h4><b>Formulir Bukti KTP / KK</b></h4>
									<hr>

									<div class="form-group">
										<label class="col-sm-2 control-label">Bukti KTP</label>
										<div class="col-sm-10">
											<input type="text" name="fbukti_ktp" class="form-control" maxlength="16"
												onkeypress="return event.charCode >= 48 && event.charCode <= 57"
												placeholder="Masukkan Nomor KTP" required>
										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-2 control-label">Bukti KK (Opsional)</label>
										<div class="col-sm-10">
											<input type="text" name="fbukti_kk" class="form-control" maxlength="16"
												onkeypress="return event.charCode >= 48 && event.charCode <= 57"
												placeholder="Masukkan Nomor KK">
										</div>
									</div>

									<hr>
									<h4><b>Formulir Hajatan</b></h4>
									<hr>

									<div class="form-group">
										<label class="col-sm-2 control-label">Jenis Hajat</label>
										<div class="col-sm-10">
											<select name="fjenis_hajat" class="form-control" required>
												<option value="">-- Jenis Hajat --</option>
												<option value="Pernikahan">Pernikahan</option>
												<option value="Khitanan">Khitanan</option>
												<option value="Tasyakuran">Tasyakuran</option>
											</select>
										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-2 control-label">Hari</label>
										<div class="col-sm-10">
											<select name="fhari" class="form-control" required>
												<option value="">-- Hari --</option>
												<option value="Senin">Senin</option>
												<option value="Selasa">Selasa</option>
												<option value="Rabu">Rabu</option>
												<option value="Kamis">Kamis</option>
												<option value="Jum'at">Jum'at</option>
												<option value="Sabtu">Sabtu</option>
												<option value="Minggu">Minggu</option>
											</select>
										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-2 control-label">Tanggal</label>
										<div class="col-sm-10">
											<input type="date" name="ftanggal" class="form-control" required>
										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-2 control-label">Jenis Hiburan</label>
										<div class="col-sm-10">
											<input type="text" name="fjenis_hiburan" class="form-control"
												placeholder="Masukkan Jenis Hiburan" required>
										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-2 control-label">Pemilik Hiburan</label>
										<div class="col-sm-10">
											<input type="text" name="fpemilik" class="form-control"
												placeholder="Masukkan Pemilik Hiburan" required>
										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-2 control-label">Alamat Pemilik Hiburan</label>
										<div class="col-sm-10">
											<input type="text" name="falamat_pemilik" class="form-control"
												placeholder="Masukkan Alamat Pemilik Hiburan" required>
										</div>
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
		</div>
		<?php
	}
} else {
	header("location:index.php?pesan=gagal");
}

include('../part/footer.php');
?>