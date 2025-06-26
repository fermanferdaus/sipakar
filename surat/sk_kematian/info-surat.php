<?php
	include ('../../config/koneksi.php');
	include ('../part/header.php');
		 
	$nik = $_POST['fnik'];
	 
	$qCekNik = mysqli_query($connect,"SELECT * FROM penduduk WHERE nik = '$nik'");
	$row = mysqli_num_rows($qCekNik);
	 
	if($row > 0){
		$data = mysqli_fetch_assoc($qCekNik);
		if($data['nik']==$nik){
			$_SESSION['nik'] = $nik;
?>
<body class="bg-light">
	<div class="container" style="max-height:cover; padding-top:30px;  padding-bottom:60px; position:relative; min-height: 100%;">
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<h5 class="card-header"><i class="fas fa-envelope"></i> INFORMASI SURAT</h5>
					<br>
					<div class="container-fluid">
						<div class="row">
							<a class="col-sm-6"><h5><b>SURAT KETERANGAN KEMATIAN</b></h5></a>
							<a class="col-sm-6"><h5><b>NOMOR SURAT : -</b></h5></a>
						</div>
					</div>
					<hr>
					<form method="post" action="simpan-surat.php">
						<h6 class="container-fluid" align="right"><i class="fas fa-user"></i> Informasi Pribadi</h6><hr width="97%">
						<div class="row">
							<div class="col-sm-6">
							    <div class="form-group">
						           	<label class="col-sm-12" style="font-weight: 500;">Nama Lengkap</label>
						           	<div class="col-sm-12">
						               	<input type="text" name="fnama" class="form-control" style="text-transform: capitalize;" value="<?php echo $data['nama']; ?>" readonly>
						           	</div>
						        </div>
							</div>
							<div class="col-sm-6">
							    <div class="form-group">
						           	<label class="col-sm-12" style="font-weight: 500;">Jenis Kelamin</label>
						           	<div class="col-sm-12">
						               	<input type="text" name="fjenis_kelamin" class="form-control" style="text-transform: capitalize;" value="<?php echo $data['jenis_kelamin']; ?>" readonly>
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
						               	<input type="text" name="ftempat_tgl_lahir" class="form-control" style="text-transform: capitalize;" value="<?php echo $data['tempat_lahir'], ", ", $tgl . $blnIndo[$bln] . $thn; ?>" readonly>
						           	</div>
						        </div>
							</div>
							<div class="col-sm-6">
							    <div class="form-group">
						           	<label class="col-sm-12" style="font-weight: 500;">Agama</label>
						           	<div class="col-sm-12">
						               	<input type="text" name="fagama" class="form-control" style="text-transform: capitalize;" value="<?php echo $data['agama']; ?>" readonly>
						           	</div>
						        </div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-6">
							    <div class="form-group">
						           	<label class="col-sm-12" style="font-weight: 500;">Pekerjaan</label>
						           	<div class="col-sm-12">
						               	<input type="text" name="fpekerjaan" class="form-control" style="text-transform: capitalize;" value="<?php echo $data['pekerjaan']; ?>" readonly>
						           	</div>
						        </div>
							</div>
							<div class="col-sm-6">
						      	<div class="form-group">
						           	<label class="col-sm-12" style="font-weight: 500;">NIK</label>
						           	<div class="col-sm-12">
						               	<input type="text" name="fnik" class="form-control" value="<?php echo $data['nik']; ?>" readonly>
						           	</div>
						        </div>
						  	</div>
						  	<div class="col-sm-6">
						      	<div class="form-group">
						           	<label class="col-sm-12" style="font-weight: 500;">Alamat</label>
						           	<div class="col-sm-12">
						               	<textarea type="text" name="falamat" class="form-control" style="text-transform: capitalize;" readonly><?php echo $data['jalan'] . ", RT" . $data['rt'] . "/RW" . $data['rw'] . ", Dusun " . $data['dusun'] . ",\nDesa " . $data['desa'] . ", Kecamatan " . $data['kecamatan'] . ", " . $data['kota']; ?></textarea>
						           	</div>
						        </div>
						  	</div>
							<div class="col-sm-6">
							    <div class="form-group">
						           	<label class="col-sm-12" style="font-weight: 500;">Kewarganegaraan</label>
						           	<div class="col-sm-12">
						               	<input type="text" name="fkewarganegaraan" class="form-control" style="text-transform: uppercase;" value="<?php echo $data['kewarganegaraan']; ?>" readonly>
						           	</div>
						        </div>
							</div>
						</div>
						<br>
						<h6 class="container-fluid" align="right"><i class="fas fa-edit"></i> Formulir Keterangan Meninggal</h6><hr width="97%">
						<div class="row">
							<div class="col-sm-6">
						      	<div class="form-group">
						           	<label class="col-sm-12" style="font-weight: 500;">Hari</label>
						           	<div class="col-sm-12">
						               	<input type="text" name="fhari_m" class="form-control" style="text-transform: capitalize;" placeholder="Masukkan hari meninggal" required>
						           	</div>
						        </div>
						  	</div>
							<div class="col-sm-6">
						      	<div class="form-group">
									<label class="col-sm-12" style="font-weight: 500;">Tanggal Meninggal</label>
									<div class="col-sm-12">
										<input type="date" name="ftgl_m" class="form-control" required>
									</div>
								</div>
						  	</div>
						</div>
						<div class="row">
							<div class="col-sm-6">
						      	<div class="form-group">
						           	<label class="col-sm-12" style="font-weight: 500;">Tempat Pemakaman</label>
						           	<div class="col-sm-12">
						               	<input type="text" name="ftempat_m" class="form-control" style="text-transform: capitalize;" placeholder="Masukkan tempat pemakaman" required>
						           	</div>
						        </div>
						  	</div>
							<div class="col-sm-6">
						      	<div class="form-group">
						           	<label class="col-sm-12" style="font-weight: 500;">Penyebab Meninggal</label>
						           	<div class="col-sm-12">
						               	<input type="text" name="fpenyebab_m" class="form-control" style="text-transform: capitalize;" placeholder="Masukkan Penyebab Meninggal" required>
						           	</div>
						        </div>
						  	</div>
						</div>
						<br>
						<h6 class="container-fluid" align="right"><i class="fas fa-edit"></i> Formulir Informasi Ahli Waris</h6><hr width="97%">
						<div class="row">
						  	<div class="col-sm-6">
						      	<div class="form-group">
						           	<label class="col-sm-12" style="font-weight: 500;">Bapak/Ibu</label>
						           	<div class="col-sm-12">
						               	<input type="text" name="fortu_m" class="form-control" style="text-transform: capitalize;" placeholder="Masukkan nama Bapak atau Ibu" required>
						           	</div>
						        </div>
						    </div>
							<div class="col-sm-6">
						      	<div class="form-group">
						           	<label class="col-sm-12" style="font-weight: 500;">Suami/Isteri</label>
						           	<div class="col-sm-12">
						               	<input type="text" name="fpasangan_m" class="form-control" style="text-transform: capitalize;" placeholder="Masukkan nama Suami atau Isteri" required>
						           	</div>
						        </div>
						    </div>
						</div>  	
						<div class="row">
							<div class="col-sm-12">
								<div class="form-group">
									<label class="col-sm-12" style="font-weight: 500;">Jumlah Anak</label>
									<div class="col-sm-12">
										<input type="number" name="fjumlah_anak" id="jumlah_anak" class="form-control" placeholder="Masukkan Jumlah Anak" min="1" max="10" required>
									</div>
								</div>
								<div class="col-sm-12" id="form-anak-dinamis">
								<!-- Form anak akan muncul di sini -->
							</div>
							</div>
						</div>

						<script>
							document.getElementById("jumlah_anak").addEventListener("input", function() {
								const jumlah = parseInt(this.value);
								const container = document.getElementById("form-anak-dinamis");
								container.innerHTML = ""; // kosongkan dulu

								if (!isNaN(jumlah) && jumlah > 0 && jumlah <= 10) {
								for (let i = 1; i <= jumlah; i++) {
									const div = document.createElement("div");
									div.classList.add("form-group");
									div.innerHTML = `
									<label style="font-weight: 500;">Nama Anak ${i}</label>
									<input type="text" name="fnama_anak${i}" class="form-control" placeholder="Masukkan nama anak ke-${i}" required>
									`;
									container.appendChild(div);
								}
								}
							});
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
	}else{
		header("location:index.php?pesan=gagal");
	}

	include ('../part/footer.php');
?>