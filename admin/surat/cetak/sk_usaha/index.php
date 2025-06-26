<?php 
	include ('../../permintaan_surat/konfirmasi/part/akses.php');
  	include ('../../../../config/koneksi.php');

  	$id = $_GET['id'];
  	$qCek = mysqli_query($connect,"SELECT penduduk.*, sk_usaha.* FROM penduduk LEFT JOIN sk_usaha ON sk_usaha.nik = penduduk.nik WHERE sk_usaha.id_u='$id'");
  	while($row = mysqli_fetch_array($qCek)){

  		$qTampilDesa = mysqli_query($connect, "SELECT * FROM profil_desa WHERE id_profil_desa = '1'");
        foreach($qTampilDesa as $rows){

			$id_pejabat_desa = $row['id_pejabat_desa'];
		  	$qCekPejabatDesa = mysqli_query($connect,"SELECT pejabat_desa.jabatan, pejabat_desa.nama_pejabat_desa FROM pejabat_desa LEFT JOIN sk_usaha ON sk_usaha.id_pejabat_desa = pejabat_desa.id_pejabat_desa WHERE sk_usaha.id_pejabat_desa = '$id_pejabat_desa' AND sk_usaha.id_u='$id'");
		  	while($rowss = mysqli_fetch_array($qCekPejabatDesa)){
?>

<html>
<head>
	<link rel="shortcut icon" href="../../../../assets/img/mini-logo.png">
	<title>CETAK SURAT KETERANGAN USAHA</title>
	<link href="../../../../assets/formsuratCSS/formsurat.css" rel="stylesheet" type="text/css"/>
</head>
<body>
<div>
	<table width="100%">
		 <div class="kop-gambar">
            <img src="../../../../assets/img/kop-surat.png" style="width:100%; height:auto;">
        </div>
		<br>
		<div align="center"><u><h4 class="kop3">SURAT KETERANGAN USAHA</h4></u></div>
		<div align="center"><h4 class="kop">Nomor :&nbsp;&nbsp;&nbsp;<?php echo $row['no_surat']; ?></h4></div>
	</table>
	<br>
	<div class="clear"></div>
	<div id="isi3">
		<table width="100%">
			<tr>
				<td>Yang bertanda tangan dibawah ini :
				</td>
			</tr>
		</table>
		<br>
		<table width="100%" style="text-transform: capitalize;">
			<tr>
				<td width="30%" class="indentasi">NAMA</td>
				<td width="2%">:</td>
				<td width="68%" style="text-transform: uppercase; font-weight: bold;"><?php echo $rowss['nama_pejabat_desa']; ?></td>
			</tr>
			<tr>
				<td class="indentasi">Jabatan</td>
				<td>:</td>
				<td><?php echo $rowss['jabatan']; ?> <?php echo strtoupper($rows['nama_desa']); ?></td>
			</tr>
		</table>
		<br>
		<table width="100%">
			<tr>
				<td>Menerangkan bahwa tersebut dibawah ini :</td>
			</tr>
		</table>
		<br>
		<table width="100%" style="text-transform: capitalize;">
			<tr>
				<td width="30%" class="indentasi">NAMA</td>
				<td width="2%">:</td>
				<td width="68%" style="text-transform: uppercase; font-weight: bold;"><?php echo $row['nama']; ?></td>
			</tr>
			<tr>
				<td class="indentasi">Jenis Kelamin</td>
				<td>:</td>
				<td><?php echo $row['jenis_kelamin']; ?></td>
			</tr>
			<?php
				$tgl_lhr = date($row['tgl_lahir']);
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
			<tr>
				<td class="indentasi">Tempat/Tgl. Lahir</td>
				<td>:</td>
				<td><?php echo $row['tempat_lahir'] . ", " . $tgl . $blnIndo[$bln] . $thn; ?></td>
			</tr>
			<tr>
				<td class="indentasi">NIK</td>
				<td>:</td>
				<td><?php echo $row['nik']; ?></td>
			</tr>
			<tr>
				<td class="indentasi">Kewarganegaraan</td>
				<td>:</td>
				<td style="text-transform: uppercase;"><?php echo $row['kewarganegaraan']; ?></td>
			</tr>
			<tr>
				<td class="indentasi">Agama</td>
				<td>:</td>
				<td><?php echo $row['agama']; ?></td>
			</tr>
			<tr>
				<td class="indentasi">Status Perkawinan</td>
				<td>:</td>
				<td><?php echo $row['status_perkawinan']; ?></td>
			</tr>
			<tr>
				<td class="indentasi">Pekerjaan</td>
				<td>:</td>
				<td><?php echo $row['pekerjaan']; ?></td>
			</tr>
			<tr>
				<td class="indentasi">Alamat</td>
				<td>:</td>
				<td><?php echo $row['jalan'] . ", RT" . $row['rt'] . "/RW" . $row['rw'] . ", Dusun " . $row['dusun'] . ", Desa " . $row['desa'] . ", Kecamatan " . $row['kecamatan'] . ", " . $row['kota']; ?></td>
			</tr>
		</table>
		<br>
		<table width="100%">
			<tr>
				<td>
					Orang tersebut adalah benar penduduk Desa <?php echo strtoupper($row['desa']); ?>, 
					terdaftar dalam Buku Induk Kependudukan Desa tersebut, Kecamatan <?php echo $row['kecamatan']; ?>. 
					Orang tersebut juga benar berdomisili dan bertempat tinggal di RT <?php echo $row['rt']; ?>/RW <?php echo $row['rw']; ?>, 
					Dusun <?php echo $row['dusun']; ?>, Desa <?php echo $row['desa']; ?>, Kecamatan <?php echo $row['kecamatan']; ?>.
				</td>	
			</tr>
			<tr>
				<td> Orang tersebut diatas benar memiliki Usaha :</td>
			</tr>
			<tr>
				<td>
					<div style="text-align: center;">
						<ol style="display: inline-block; text-align: left; font-weight: bold; text-transform: uppercase; margin-top: 5px; padding-left: 20px;">
							<?php 
							$jumlah = intval($row['jumlah_usaha']);
							for ($i = 1; $i <= $jumlah; $i++) {
								$usaha = isset($row["jenis_usaha_$i"]) ? $row["jenis_usaha_$i"] : '';
								if (!empty($usaha)) {
									echo "<li>" . htmlspecialchars($usaha) . "</li>";
								}
							}
							?>
						</ol>
					</div>
				</td>
			</tr>
		</table>
		<table width="100%">
			<tr>
				<td>Demikianlah Surat Keterangan Usaha ini kami buat dengan sebenarnya sesuai laporan yang ada untuk dapat dipergunakan sebagaimana mestinya dan terima kasih.</td>
			</tr>
		</table>
	</div>
	<br>
	<table width="100%" style="text-transform: capitalize;">
		<tr></tr>
		<tr></tr>
		<tr></tr>
		<tr></tr>
		<tr></tr>
		<tr></tr>
		<tr></tr>
		<tr></tr>
		<tr>
			<td width="10%"></td>
			<td width="30%"></td>
			<td width="10%"></td>
			<td align="center">
				<?php echo $rows['nama_desa']; ?>, 
				<?php
					$tanggal = date('d F Y');
					$bulan = date('F', strtotime($tanggal));
					$bulanIndo = array(
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
					echo date('d ') . $bulanIndo[$bulan] . date(' Y');
				?>
			</td>
		</tr>
		<tr>
			<td></td>
			<td></td>
			<td></td>
			<td align="center"><?php echo $rowss['jabatan'] . " " . $rows['nama_desa']; ?></td>
		</tr>
		<tr></tr>
		<tr></tr>
		<tr></tr>
		<tr></tr>
		<tr></tr>
		<tr></tr>
		<tr></tr>
		<tr></tr>
		<tr></tr>
		<tr></tr>
		<tr></tr>
		<tr></tr>
		<tr></tr>
		<tr></tr>
		<tr></tr>
		<tr></tr>
		<tr></tr>
		<tr></tr>
		<tr></tr>
		<tr></tr>
		<tr></tr>
		<tr></tr>
		<tr></tr>
		<tr></tr>
		<tr></tr>
		<tr></tr>
		<tr></tr>
		<tr></tr>
		<tr></tr>
		<tr></tr>
		<tr></tr>
		<tr></tr>
		<tr></tr>
		<tr></tr>
		<tr></tr>
		<tr></tr>
		<tr></tr>
		<tr></tr>
		<tr></tr>
		<tr></tr>
		<tr>
			<td></td>
			<td></td>
			<td></td>
			<td align="center" style="text-transform: uppercase;"><u><b><?php echo $rowss['nama_pejabat_desa']; ?></b></u></td>
		</tr>
	</table>
</div>
<script>
	window.print();
</script>
</body>
</html>

<?php
			}
		}
  	}
?>