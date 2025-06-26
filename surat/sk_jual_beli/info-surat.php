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
										<h5><b>SURAT KETERANGAN JUAL BELI</b></h5>
									</a>
									<a class="col-sm-6">
										<h5><b>NOMOR SURAT : -</b></h5>
									</a>
								</div>
							</div>
							<hr>
							<form method="post" action="simpan-surat.php">
								<h6 class="container-fluid" align="right"><i class="fas fa-user"></i> Informasi Pribadi</h6>
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
								<h6 class="container-fluid" align="right"><i class="fas fa-home"></i> Informasi Tanah yang
									Dijual</h6>
								<hr width="97%">
								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">
											<label class="col-sm-12" style="font-weight: 500;">Luas Tanah (m²)</label>
											<div class="col-sm-12">
												<input type="number" name="fluas_tanah" class="form-control"
													placeholder="Contoh: 1050" required>
											</div>
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label class="col-sm-12" style="font-weight: 500;">Ukuran Tanah (P x L dalam
												meter)</label>
											<div class="col-sm-12">
												<input type="text" name="fukuran_tanah" class="form-control"
													placeholder="Contoh: 15 m x 70 m" required>
											</div>
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label class="col-sm-12" style="font-weight: 500;">Harga (Rupiah)</label>
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
												<input type="text" name="fharga" class="form-control" maxlength="20"
													oninput="formatRupiah(this)" placeholder="Contoh: 35000000" required>
											</div>
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label class="col-sm-12" style="font-weight: 500;">Lokasi Tanah</label>
											<div class="col-sm-12">
												<textarea name="flokasi_tanah" class="form-control"
													placeholder="Contoh: RT 01 / RW 04 Dusun Pagar Baru..." required></textarea>
											</div>
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">
											<label class="col-sm-12" style="font-weight: 500;">Batas Utara</label>
											<div class="col-sm-12">
												<input type="text" name="fbatas_utara" class="form-control"
													placeholder="Contoh: Jalan Dusun" required>
											</div>
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label class="col-sm-12" style="font-weight: 500;">Batas Selatan</label>
											<div class="col-sm-12">
												<input type="text" name="fbatas_selatan" class="form-control"
													placeholder="Contoh: Tanah Ekwandi" required>
											</div>
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label class="col-sm-12" style="font-weight: 500;">Batas Timur</label>
											<div class="col-sm-12">
												<input type="text" name="fbatas_timur" class="form-control"
													placeholder="Contoh: Tanah Maryono" required>
											</div>
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label class="col-sm-12" style="font-weight: 500;">Batas Barat</label>
											<div class="col-sm-12">
												<input type="text" name="fbatas_barat" class="form-control"
													placeholder="Contoh: Tanah Sugeng" required>
											</div>
										</div>
									</div>
								</div>
								<br>
								<h6 class="container-fluid" align="right"><i class="fas fa-user-tie"></i> Identitas Pihak
									Pertama (Penjual)</h6>
								<hr width="97%">
								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">
											<label class="col-sm-12" style="font-weight: 500;">Nama Penjual</label>
											<div class="col-sm-12">
												<input type="text" name="fnama_penjual" class="form-control"
													placeholder="Masukkan nama penjual" required>
											</div>
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label class="col-sm-12" style="font-weight: 500;">Umur Penjual</label>
											<div class="col-sm-12">
												<input type="number" name="fumur_penjual" class="form-control"
													placeholder="Contoh: 68" required>
											</div>
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label class="col-sm-12" style="font-weight: 500;">Pekerjaan Penjual</label>
											<div class="col-sm-12">
												<input type="text" name="fpekerjaan_penjual" class="form-control"
													placeholder="Masukkan pekerjaan penjual" required>
											</div>
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label class="col-sm-12" style="font-weight: 500;">Alamat Penjual</label>
											<div class="col-sm-12">
												<textarea name="falamat_penjual" class="form-control"
													placeholder="Contoh: RT 01 / RW 04 Dusun Pagar Baru..." required></textarea>
											</div>
										</div>
									</div>
								</div>

								<br>
								<h6 class="container-fluid" align="right"><i class="fas fa-calendar-alt"></i> Informasi
									Transaksi</h6>
								<hr width="97%">
								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">
											<label class="col-sm-12" style="font-weight: 500;">Hari Transaksi</label>
											<div class="col-sm-12">
												<input type="text" name="fhari_transaksi" class="form-control"
													placeholder="Contoh: Jumat" required>
											</div>
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label class="col-sm-12" style="font-weight: 500;">Tanggal Transaksi</label>
											<div class="col-sm-12">
												<input type="date" name="ftanggal_transaksi" class="form-control" required>
											</div>
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label class="col-sm-12" style="font-weight: 500;">Kategori Tanah</label>
											<div class="col-sm-12">
												<input type="text" name="fkategori_tanah" class="form-control"
													placeholder="Contoh: Pekarangan / Sawah / Kebun / Lainnya" required>
											</div>
										</div>
									</div>
								</div>

								<br>
								<h6 class="container-fluid" align="right"><i class="fas fa-users"></i> Informasi Saksi</h6>
								<hr width="97%">
								<div class="col-sm-12">
									<div class="form-group">
										<label class="col-sm-12" style="font-weight: 500;">Jumlah Saksi (maksimal 5)</label>
										<div class="col-sm-12">
											<input type="number" name="fjumlah_saksi" class="form-control" id="jumlahSaksi"
												min="1" max="5" placeholder="Masukkan jumlah saksi" required
												oninput="generateSaksi(this.value)">
										</div>
									</div>
								</div>

								<div id="formSaksiDinamis"></div>

								<script>
									function generateSaksi(jumlah) {
										const container = document.getElementById("formSaksiDinamis");
										container.innerHTML = ""; // Bersihkan sebelumnya
										jumlah = parseInt(jumlah);

										if (isNaN(jumlah) || jumlah < 1 || jumlah > 5) return;

										for (let i = 1; i <= jumlah; i++) {
											const saksiHTML = `
												<div class="row">
													<div class="col-sm-6">
														<div class="form-group">
															<label class="col-sm-12" style="font-weight: 500;">Nama Saksi ${i}</label>
															<div class="col-sm-12">
																<input type="text" name="fnama_saksi_${i}" class="form-control" placeholder="Nama saksi ${i}" required>
															</div>
														</div>
													</div>
													<div class="col-sm-6">
														<div class="form-group">
															<label class="col-sm-12" style="font-weight: 500;">Alamat Saksi ${i} (RT/RW)</label>
															<div class="col-sm-12">
																<input type="text" name="falamat_saksi_${i}" class="form-control" placeholder="Contoh: RT01/RW01">
															</div>
														</div>
													</div>
												</div>
												`;
											container.innerHTML += saksiHTML;
										}
									}
								</script>


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