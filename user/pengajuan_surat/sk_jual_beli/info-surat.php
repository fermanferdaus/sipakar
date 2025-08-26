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
								<h3 class="box-title"><i class="fas fa-envelope"></i> FORMULIR SURAT KETERANGAN JUAL BELI</h3>
							</div>

							<form class="form-horizontal" method="post" action="simpan-surat.php">
								<div class="box-body">

									<!-- INFORMASI PRIBADI -->
									<h4><b>Informasi Pribadi</b></h4>
									<hr>
									<!-- Nama -->
									<div class="form-group">
										<label class="col-sm-2 control-label">Nama Lengkap</label>
										<div class="col-sm-10">
											<input type="text" name="fnama" class="form-control"
												value="<?php echo $data['nama']; ?>" readonly>
										</div>
									</div>

									<!-- Jenis Kelamin -->
									<div class="form-group">
										<label class="col-sm-2 control-label">Jenis Kelamin</label>
										<div class="col-sm-10">
											<input type="text" name="fjenis_kelamin" class="form-control"
												value="<?php echo $data['jenis_kelamin']; ?>" readonly>
										</div>
									</div>

									<!-- Tempat Tgl Lahir -->
									<div class="form-group">
										<label class="col-sm-2 control-label">Tempat, Tgl Lahir</label>
										<div class="col-sm-10">
											<?php
											$tgl_lhr = $data['tgl_lahir'];
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

									<!-- Agama -->
									<div class="form-group">
										<label class="col-sm-2 control-label">Agama</label>
										<div class="col-sm-10">
											<input type="text" name="fagama" class="form-control"
												value="<?php echo $data['agama']; ?>" readonly>
										</div>
									</div>

									<!-- Pekerjaan -->
									<div class="form-group">
										<label class="col-sm-2 control-label">Pekerjaan</label>
										<div class="col-sm-10">
											<input type="text" name="fpekerjaan" class="form-control"
												value="<?php echo $data['pekerjaan']; ?>" readonly>
										</div>
									</div>

									<!-- NIK -->
									<div class="form-group">
										<label class="col-sm-2 control-label">NIK</label>
										<div class="col-sm-10">
											<input type="text" name="fnik" class="form-control"
												value="<?php echo $data['nik']; ?>" readonly>
										</div>
									</div>

									<!-- Alamat -->
									<div class="form-group">
										<label class="col-sm-2 control-label">Alamat</label>
										<div class="col-sm-10">
											<textarea name="falamat" class="form-control" rows="2" readonly><?php
											echo $data['jalan'] . ", RT" . $data['rt'] . "/RW" . $data['rw'] . ", Dusun " . $data['dusun'] .
												", Desa " . $data['desa'] . ", Kecamatan " . $data['kecamatan'] . ", " . $data['kota'];
											?></textarea>
										</div>
									</div>

									<!-- Kewarganegaraan -->
									<div class="form-group">
										<label class="col-sm-2 control-label">Kewarganegaraan</label>
										<div class="col-sm-10">
											<input type="text" name="fkewarganegaraan" class="form-control"
												value="<?php echo $data['kewarganegaraan']; ?>" readonly>
										</div>
									</div>
									<hr>
									<!-- INFORMASI TANAH -->
									<h4><b>Informasi Tanah yang Dijual</b></h4>
									<hr>

									<?php
									function inputField($label, $name, $type = 'text', $placeholder = '', $required = true)
									{
										$oninput = ($name === 'fharga') ? 'oninput="formatRupiah(this)" maxlength="20"' : '';
										echo '
									<div class="form-group">
										<label class="col-sm-2 control-label">' . $label . '</label>
										<div class="col-sm-10">
											<input type="' . $type . '" name="' . $name . '" class="form-control" placeholder="' . $placeholder . '" ' . $oninput . ' ' . ($required ? 'required' : '') . '>
										</div>
									</div>';
									}

									inputField('Luas Tanah (m²)', 'fluas_tanah', 'number', 'Contoh: 1050');
									inputField('Ukuran Tanah (P x L dalam meter)', 'fukuran_tanah', 'text', 'Contoh: 15 m x 70 m');
									inputField('Harga (Rupiah)', 'fharga', 'text', 'Contoh: 35000000');
									inputField('Lokasi Tanah', 'flokasi_tanah', 'text', 'Contoh: RT01/RW04 Dusun Pagar Baru');
									inputField('Batas Utara', 'fbatas_utara');
									inputField('Batas Selatan', 'fbatas_selatan');
									inputField('Batas Timur', 'fbatas_timur');
									inputField('Batas Barat', 'fbatas_barat');
									?>
									<script>
										function formatRupiah(el) {
											let value = el.value.replace(/[^,\d]/g, '').toString();
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

									<hr>
									<!-- IDENTITAS PENJUAL -->
									<h4><b>Identitas Pihak Pertama (Penjual)</b></h4>
									<hr>
									<?php
									inputField('Nama Penjual', 'fnama_penjual');
									inputField('Umur Penjual', 'fumur_penjual', 'number');
									inputField('Pekerjaan Penjual', 'fpekerjaan_penjual');
									echo '
									<div class="form-group">
										<label class="col-sm-2 control-label">Alamat Penjual</label>
										<div class="col-sm-10">
											<textarea name="falamat_penjual" class="form-control" required></textarea>
										</div>
									</div>';
									?>
									<hr>
									<!-- INFORMASI TRANSAKSI -->
									<h4><b>Informasi Transaksi</b></h4>
									<hr>
									<?php
									inputField('Hari Transaksi', 'fhari_transaksi');
									inputField('Tanggal Transaksi', 'ftanggal_transaksi', 'date');
									inputField('Kategori Tanah', 'fkategori_tanah', 'text', 'Contoh: Sawah / Kebun / Pekarangan');
									?>
									<hr>
									<!-- INFORMASI SAKSI -->
									<h4><b>Informasi Saksi</b></h4>
									<hr>
									<div class="form-group">
										<label class="col-sm-2 control-label">Jumlah Saksi</label>
										<div class="col-sm-10">
											<input type="number" name="fjumlah_saksi" id="jumlahSaksi" class="form-control"
												min="1" max="5" placeholder="Masukkan jumlah saksi"
												oninput="generateSaksi(this.value)" required>
										</div>
									</div>

									<div id="formSaksiDinamis"></div>

									<script>
										function generateSaksi(jumlah) {
											const container = document.getElementById("formSaksiDinamis");
											container.innerHTML = "";
											jumlah = parseInt(jumlah);

											if (isNaN(jumlah) || jumlah < 1 || jumlah > 5) return;

											for (let i = 1; i <= jumlah; i++) {
												container.innerHTML += `
												<div class="form-group">
													<label class="col-sm-2 control-label">Nama Saksi ${i}</label>
													<div class="col-sm-10">
														<input type="text" name="fnama_saksi_${i}" class="form-control" required>
													</div>
												</div>
												<div class="form-group">
													<label class="col-sm-2 control-label">Alamat Saksi ${i}</label>
													<div class="col-sm-10">
														<input type="text" name="falamat_saksi_${i}" class="form-control" placeholder="Contoh: RT01/RW01">
													</div>
												</div>`;
											}
										}
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