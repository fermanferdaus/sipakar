<?php 
	include ('../../permintaan_surat/konfirmasi/part/akses.php');
  	include ('../../../../config/koneksi.php');

  	$id = $_GET['id'];
  	$qCek = mysqli_query($connect,"SELECT penduduk.*, sk_pengantar_skck.* FROM penduduk LEFT JOIN sk_pengantar_skck ON sk_pengantar_skck.nik = penduduk.nik WHERE sk_pengantar_skck.id_sps='$id'");
  	while($row = mysqli_fetch_array($qCek)){

  		$qTampilDesa = mysqli_query($connect, "SELECT * FROM profil_desa WHERE id_profil_desa = '1'");
        foreach($qTampilDesa as $rows){

			$id_pejabat_desa = $row['id_pejabat_desa'];
		  	$qCekPejabatDesa = mysqli_query($connect,"SELECT pejabat_desa.jabatan, pejabat_desa.nama_pejabat_desa FROM pejabat_desa LEFT JOIN sk_pengantar_skck ON sk_pengantar_skck.id_pejabat_desa = pejabat_desa.id_pejabat_desa WHERE sk_pengantar_skck.id_pejabat_desa = '$id_pejabat_desa' AND sk_pengantar_skck.id_sps='$id'");
		  	while($rowss = mysqli_fetch_array($qCekPejabatDesa)){
?>

<html>
<head>
	<link rel="shortcut icon" href="../../../../assets/img/mini-logo.png">
	<title>CETAK SURAT PENGANTAR SKCK</title>
	<link href="../../../../assets/formsuratCSS/formsurat.css" rel="stylesheet" type="text/css"/>
</head>
<body>
<div>
	<!-- Kop Surat -->
	<div class="kop-gambar">
		<img src="../../../../assets/img/kop-surat.png" style="width:100%; height:auto;">
	</div>

	<!-- Tabel Header Surat -->
	<table width="100%" style="font-size: 11px; line-height: 1.8; margin-top: 10px;">
		<tr>
			<!-- Kolom Kiri -->
			<td width="60%" style="vertical-align: top; padding-top: 40px;">
				<table>
					<tr>
						<td style="vertical-align: top;">Nomor </td>
						<td style="vertical-align: top;"> : </td>
						<td style="vertical-align: top;"> <?php echo $row['no_surat']; ?></td>
					</tr>
					<tr>
						<td style="vertical-align: top;">Lampiran </td>
						<td style="vertical-align: top;"> : </td>
						<td style="vertical-align: top;"> -</td>
					</tr>
					<tr>
						<td style="vertical-align: top;">Perihal </td>
						<td style="vertical-align: top;"> : </td>
						<td style="vertical-align: top;">
							<b> Permohonan Surat Keterangan</b><br>
							<b> Catatan Kepolisian (SKCK)</b>
						</td>
					</tr>
				</table>
			</td>

			<!-- Kolom Kanan -->
			<td width="40%" style="font-size: 16px; vertical-align: top;">
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
					$tanggalIndo = date('d ') . $bulanIndo[$bulan] . date(' Y');
				?>
				Pagar, <?php echo $tanggalIndo; ?><br><br>
				Kepada Yth ;<br>
				Bapak KAPOLSEK Abung Selatan<br>
				Di, <br>
				<b>Kalibalangan</b>
			</td>
		</tr>
	</table>
	<br>
	<div class="clear"></div>
	<div id="isi3">
		<table width="100%">
			<tr>
				<td>Yang bertanda tangan di bawah ini, <a style="text-transform: capitalize;"><?php echo $rowss['jabatan'] . " " . $rows['nama_desa']; ?>, Kecamatan <?php echo $rows['kecamatan']; ?>, <?php echo $rows['kota']; ?></a>, Menerangkan bahwa tersebut  dibawah ini :
				</td>
			</tr>
		</table>
		<br>
		<table width="100%" style="text-transform: capitalize;">
			<tr>
				<td width="30%" class="indentasi">Nama</td>
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
				<td class="indentasi">Kewarganegaraan</td>
				<td>:</td>
				<td style="text-transform: uppercase;"><?php echo $row['kewarganegaraan']; ?></td>
			</tr>
			<tr>
				<td class="indentasi">Status Perkawinan</td>
				<td>:</td>
				<td><?php echo $row['status_perkawinan']; ?></td>
			</tr>
			<tr>
				<td class="indentasi">NIK</td>
				<td>:</td>
				<td><?php echo $row['nik']; ?></td>
			</tr>
			<tr>
				<td class="indentasi">Agama</td>
				<td>:</td>
				<td><?php echo $row['agama']; ?></td>
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
			<tr>
				<td class="indentasi">Keperluan</td>
				<td>:</td>
				<td style="text-transform: uppercase;"><strong><?php echo $row['keperluan']; ?></strong></td>
			</tr>
		</table><br>
		<table width="100%">
			<tr>
				<td>Orang tersebut adalah benar penduduk Desa Pagar, menurut pengawasan serta laporan bahwa orang tersebut.
				</td>
			</tr>
		</table>
		<table width="100%">
			<tr>
				<td style="text-align: center;">
				<div style="display: flex; align-items: center; justify-content: center; background-color: #d3d3d3; padding: 4px 0;">
					<span style="flex: 1; border-top: 2px dotted black;"></span>
					<span style="padding: 0 10px; font-weight: bold;">BERKELAKUAN BAIK</span>
					<span style="flex: 1; border-top: 2px dotted black;"></span>
				</div>
				</td>
			</tr>
		</table>
		<table width="100%">
			<tr>
				<td>Demikianlah Surat Keterangan ini kami buat dengan sebenarnya mohon bantuan petugas untuk dapat dipergunakan sebagaimana mestinya dan terima kasih.
				</td>
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
			<td align="center"></td>
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