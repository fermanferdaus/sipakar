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
							<a class="col-sm-6"><h5><b>SURAT KETERANGAN AHLI WARIS</b></h5></a>
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
						<h6 class="container-fluid" align="right"><i class="fas fa-edit"></i> Formulir Informasi Kuasa</h6><hr width="97%">
						<div class="row">
							<div class="col-sm-12">
						      	<div class="form-group">
						           	<label class="col-sm-12" style="font-weight: 500;">Status Kuasa</label>
						           	<div class="col-sm-12">
						               	<input type="text" name="fstatus_kuasa" class="form-control" style="text-transform: capitalize;" placeholder="Status" required>
						           	</div>
						        </div>
						  	</div>
						</div>
						<br>
						<h6 class="container-fluid" align="right"><i class="fas fa-edit"></i> Formulir Informasi Ahli Waris</h6><hr width="97%">
						<div class="row">
						  	<div class="col-sm-6">
						      	<div class="form-group">
						           	<label class="col-sm-12" style="font-weight: 500;">Nama</label>
						           	<div class="col-sm-12">
						               	<input type="text" name="fnama_aw" class="form-control" style="text-transform: capitalize;" placeholder="Masukkan nama ahli waris" required>
						           	</div>
						        </div>
						    </div>
							<div class="col-sm-6">
						      	<div class="form-group">
						           	<label class="col-sm-12" style="font-weight: 500;">Tempat Lahir</label>
						           	<div class="col-sm-12">
						               	<input type="text" name="ftempat_lahir_aw" class="form-control" style="text-transform: capitalize;" placeholder="Masukkan tempat lahir" required>
						           	</div>
						        </div>
						    </div>
						  	<div class="col-sm-6">
						      	<div class="form-group">
									<label class="col-sm-12" style="font-weight: 500;">Tanggal Lahir</label>
									<div class="col-sm-12">
										<input type="date" name="ftgl_lahir_aw" class="form-control" required>
									</div>
								</div>
						  	</div>
						  	<div class="col-sm-6">
						      	<div class="form-group">
									<label class="col-sm-12" style="font-weight: 500;">Pekerjaan</label>
									<div class="col-sm-12">
										<input type="text" name="fpekerjaan_aw" class="form-control" style="text-transform: capitalize;" placeholder="Pekerjaan" required>
									</div>
								</div>
						  	</div>
						  	<div class="col-sm-6">
						      	<div class="form-group">
						           	<label class="col-sm-12" style="font-weight: 500;">Jalan</label>
						           	<div class="col-sm-12">
										<input type="text" name="fjalan_aw" class="form-control" style="text-transform: capitalize;" placeholder="Jalan" required>
									</div>
						        </div>
						  	</div>
						  	<div class="col-sm-6">
						      	<div class="form-group">
						           	<label class="col-sm-12" style="font-weight: 500;">Dusun</label>
						           	<div class="col-sm-12">
						               	<select name="fdusun_aw" class="form-control" style="text-transform: capitalize;" required>
											<option value="">-- Dusun --</option>
											<?php
												$qTampilDusun = "SELECT * FROM dusun";
												$tampilDusun = mysqli_query($connect, $qTampilDusun);
												while($rows = mysqli_fetch_assoc($tampilDusun)){
											?>
											<option value="<?php echo $rows['nama_dusun']; ?>"><?php echo $rows['nama_dusun']; ?></option>
											<?php 
												}
											?>
										</select>
						           	</div>
						        </div>
						  	</div>
						  	
						</div>
						<div class="row">
							<div class="col-sm-6">
						      	<div class="form-group">
						           	<label class="col-sm-12" style="font-weight: 500;">RT</label>
						           	<div class="col-sm-12">
						               	<input type="text" name="frt_aw" class="form-control" placeholder="Masukkan RT" required>
						           	</div>
						        </div>
						  	</div>
							<div class="col-sm-6">
						      	<div class="form-group">
						           	<label class="col-sm-12" style="font-weight: 500;">RW</label>
						           	<div class="col-sm-12">
                        				<input type="text" name="frw_aw" class="form-control" placeholder="Masukkan RW" required>
						           	</div>
						        </div>
						  	</div>
						  	<div class="col-sm-6">
						      	<div class="form-group">
						           	<label class="col-sm-12" style="font-weight: 500;">Desa</label>
						           	<div class="col-sm-12">
                        				<input type="text" name="fdesa_aw" class="form-control" style="text-transform: capitalize;" placeholder="Desa" required>
						           	</div>
						        </div>
						  	</div>
						  	<div class="col-sm-6">
						      	<div class="form-group">
						           	<label class="col-sm-12" style="font-weight: 500;">Kecamatan</label>
						           	<div class="col-sm-12">
                        				<input type="text" name="fkecamatan_aw" class="form-control" style="text-transform: capitalize;" placeholder="Kecamatan" required>
						           	</div>
						        </div>
						  	</div>
						  	<div class="col-sm-6">
						      	<div class="form-group">
						           	<label class="col-sm-12" style="font-weight: 500;">Kabupaten</label>
						           	<div class="col-sm-12">
                        				<input type="text" name="fkota_aw" class="form-control" style="text-transform: capitalize;" placeholder="Kota" required>
						           	</div>
						        </div>
						  	</div>
						  	<div class="col-sm-6">
						      	<div class="form-group">
						           	<label class="col-sm-12" style="font-weight: 500;">Status Ahli Waris</label>
						           	<div class="col-sm-12">
						               	<input type="text" name="fstatus_aw" class="form-control" style="text-transform: capitalize;" placeholder="Status" required>
						           	</div>
						        </div>
						  	</div>
						</div>
						
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