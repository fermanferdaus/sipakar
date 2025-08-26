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
								<h3 class="box-title"><i class="fas fa-envelope"></i> SURAT KETERANGAN PENGHASILAN ORANG TUA
								</h3>
							</div>

							<form class="form-horizontal" method="post" action="simpan-surat.php">
								<div class="box-body">

									<h4><b>Informasi Orang Tua</b></h4>
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
									<h4><b>Formulir Penghasilan</b></h4>
									<hr>

									<div class="form-group">
										<label class="col-sm-2 control-label">Penghasilan per Bulan</label>
										<div class="col-sm-10">
											<script>
												function formatRupiah(el) {
													let value = el.value.replace(/[^,\d]/g, '');
													let split = value.split(',');
													let sisa = split[0].length % 3;
													let rupiah = split[0].substr(0, sisa);
													let ribuan = split[0].substr(sisa).match(/\d{3}/gi);
													if (ribuan) {
														let separator = sisa ? '.' : '';
														rupiah += separator + ribuan.join('.');
													}
													rupiah = split[1] !== undefined ? rupiah + ',' + split[1] : rupiah;
													el.value = rupiah ? 'Rp ' + rupiah : '';
												}
											</script>
											<input type="text" name="fpenghasilan" class="form-control"
												oninput="formatRupiah(this)" required placeholder="Masukkan Penghasilan">
										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-2 control-label">Jumlah Tanggungan</label>
										<div class="col-sm-10">
											<input type="number" name="ftanggungan" class="form-control" min="0" max="99"
												placeholder="Masukkan Jumlah Tanggungan">
										</div>
									</div>

									<hr>
									<h4><b>Formulir Identitas Anak</b></h4>
									<hr>

									<div class="form-group">
										<label class="col-sm-2 control-label">Nama</label>
										<div class="col-sm-10">
											<input type="text" name="fnama_pot" class="form-control" placeholder="Masukkan Nama"
												required>
										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-2 control-label">Tempat Lahir</label>
										<div class="col-sm-10">
											<input type="text" name="ftempat_lahir_pot" class="form-control"
												placeholder="Masukkan Tempat Lahir" required>
										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-2 control-label">Tanggal Lahir</label>
										<div class="col-sm-10">
											<input type="date" name="ftgl_lahir_pot" class="form-control" required>
										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-2 control-label">Program Studi</label>
										<div class="col-sm-10">
											<input type="text" name="fprodi" class="form-control"
												placeholder="Masukkan Program Studi" required>
										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-2 control-label">Hubungan Keluarga</label>
										<div class="col-sm-10">
											<input type="text" name="fhubungan_keluarga" class="form-control"
												placeholder="Masukkan Hubungan Keluarga" required>
										</div>
									</div>

									<hr>
									<h4><b>Formulir Keperluan</b></h4>
									<hr>

									<div class="form-group">
										<label class="col-sm-2 control-label">Keperluan</label>
										<div class="col-sm-10">
											<input type="text" name="fkeperluan" class="form-control"
												placeholder="Masukkan Keperluan" required>
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