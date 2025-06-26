<?php
include('../../config/koneksi.php');
include('../part/header.php');

$nik = $_POST['fnik'];

$qCekNik = mysqli_query($connect, "SELECT * FROM penduduk WHERE nik = '$nik'");
$row = mysqli_num_rows($qCekNik);

if ($row > 0) {
	$data = mysqli_fetch_assoc($qCekNik);
	if ($data['nik'] == $nik) {
		$_SESSION['nik'] = $nik;
		?>

		<body class="bg-light">
			<div class="container"
				style="max-height:cover; padding-top:30px;  padding-bottom:60px; position:relative; min-height: 100%;">
				<div class="row">
					<div class="col-md-12">
						<div class="card">
							<h5 class="card-header"><i class="fas fa-envelope"></i> INFORMASI SURAT</h5>
							<br>
							<div class="container-fluid">
								<div class="row">
									<a class="col-sm-6">
										<h5><b>SURAT KETERANGAN PENGHASILAN ORANG TUA</b></h5>
									</a>
									<a class="col-sm-6">
										<h5><b>NOMOR SURAT : -</b></h5>
									</a>
								</div>
							</div>
							<hr>
							<form method="post" action="simpan-surat.php">
								<h6 class="container-fluid" align="right"><i class="fas fa-user"></i> Informasi Orang Tua</h6>
								<hr width="97%">
								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">
											<label class="col-sm-12" style="font-weight: 500;">Nama Lengkap</label>
											<div class="col-sm-12">
												<input type="text" name="fnama" class="form-control"
													style="text-transform: capitalize;" value="<?php echo $data['nama']; ?>"
													readonly>
											</div>
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label class="col-sm-12" style="font-weight: 500;">Jenis Kelamin</label>
											<div class="col-sm-12">
												<input type="text" name="fjenis_kelamin" class="form-control"
													style="text-transform: capitalize;"
													value="<?php echo $data['jenis_kelamin']; ?>" readonly>
											</div>
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label class="col-sm-12" style="font-weight: 500;">Tempat, Tgl Lahir</label>
											<div class="col-sm-12">
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
													style="text-transform: capitalize;"
													value="<?php echo $data['tempat_lahir'], ", ", $tgl . $blnIndo[$bln] . $thn; ?>"
													readonly>
											</div>
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label class="col-sm-12" style="font-weight: 500;">Agama</label>
											<div class="col-sm-12">
												<input type="text" name="fagama" class="form-control"
													style="text-transform: capitalize;" value="<?php echo $data['agama']; ?>"
													readonly>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">
											<label class="col-sm-12" style="font-weight: 500;">Pekerjaan</label>
											<div class="col-sm-12">
												<input type="text" name="fpekerjaan" class="form-control"
													style="text-transform: capitalize;"
													value="<?php echo $data['pekerjaan']; ?>" readonly>
											</div>
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label class="col-sm-12" style="font-weight: 500;">NIK</label>
											<div class="col-sm-12">
												<input type="text" name="fnik" class="form-control"
													value="<?php echo $data['nik']; ?>" readonly>
											</div>
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label class="col-sm-12" style="font-weight: 500;">Alamat</label>
											<div class="col-sm-12">
												<textarea type="text" name="falamat" class="form-control"
													style="text-transform: capitalize;"
													readonly><?php echo $data['jalan'] . ", RT" . $data['rt'] . "/RW" . $data['rw'] . ", Dusun " . $data['dusun'] . ",\nDesa " . $data['desa'] . ", Kecamatan " . $data['kecamatan'] . ", " . $data['kota']; ?></textarea>
											</div>
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label class="col-sm-12" style="font-weight: 500;">Kewarganegaraan</label>
											<div class="col-sm-12">
												<input type="text" name="fkewarganegaraan" class="form-control"
													style="text-transform: uppercase;"
													value="<?php echo $data['kewarganegaraan']; ?>" readonly>
											</div>
										</div>
									</div>
								</div>
								<br>
								<h6 class="container-fluid" align="right"><i class="fas fa-edit"></i> Formulir Penghasilan</h6>
								<hr width="97%">
								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">
											<label class="col-sm-12" style="font-weight: 500;">Penghasilan per Bulan</label>
											<div class="col-sm-12">
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
												<input type="text" name="fpenghasilan" class="form-control" maxlength="20"
													oninput="formatRupiah(this)" placeholder="Masukkan Penghasilan" required>
											</div>
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label class="col-sm-12" style="font-weight: 500;">Jumlah Tanggungan</label>
											<div class="col-sm-12">
												<input type="number" name="ftanggungan" class="form-control" min="0" max="99"
													placeholder="Masukkan Jumlah Tanggungan">
											</div>
										</div>
									</div>
								</div>
								<br>
								<h6 class="container-fluid" align="right"><i class="fas fa-edit"></i> Formulir Identitas</h6>
								<hr width="97%">
								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">
											<label class="col-sm-12" style="font-weight: 500;">Nama</label>
											<div class="col-sm-12">
												<input type="text" name="fnama_pot" class="form-control"
													style="text-transform: capitalize;" placeholder="Masukkan Jenis Hiburan"
													required>
											</div>
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label class="col-sm-12" style="font-weight: 500;">Tempat Lahir</label>
											<div class="col-sm-12">
												<input type="text" name="ftempat_lahir_pot" class="form-control"
													style="text-transform: capitalize;" placeholder="Masukkan tempat lahir"
													required>
											</div>
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label class="col-sm-12" style="font-weight: 500;">Tanggal Lahir</label>
											<div class="col-sm-12">
												<input type="date" name="ftgl_lahir_pot" class="form-control" required>
											</div>
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label class="col-sm-12" style="font-weight: 500;">Program Studi</label>
											<div class="col-sm-12">
												<input type="text" name="fprodi" class="form-control"
													style="text-transform: capitalize;" placeholder="Masukkan Pemilik Hiburan"
													required>
											</div>
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label class="col-sm-12" style="font-weight: 500;">Hubungan Keluarga</label>
											<div class="col-sm-12">
												<input type="text" name="fhubungan_keluarga" class="form-control"
													style="text-transform: capitalize;"
													placeholder="Masukkan Alamat Pemilik Hiburan" required>
											</div>
										</div>
									</div>
								</div>
								<h6 class="container-fluid" align="right"><i class="fas fa-edit"></i> Formulir Keperluan</h6>
								<hr width="97%">
								<div class="row">
									<div class="col-sm-12">
										<div class="form-group">
											<label class="col-sm-12" style="font-weight: 500;">Keperluan</label>
											<div class="col-sm-12">
												<input type="text" name="fkeperluan" class="form-control"
													style="text-transform: capitalize;" placeholder="Keperluan" required>
											</div>
										</div>
									</div>
								</div>
								<br>
								<hr width="97%">
								<div class="container-fluid">
									<input type="reset" class="btn btn-warning" value="Batal">
									<input type="submit" name="submit" class="btn btn-info" value="Submit">
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</body>

	<?php
	}
} else {
	header("location:index.php?pesan=gagal");
}

include('../part/footer.php');
?>