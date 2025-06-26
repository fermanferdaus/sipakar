<?php 
	include ('../../permintaan_surat/konfirmasi/part/akses.php');
  	include ('../../../../config/koneksi.php');

  	$id = $_GET['id'];
	$qCek = mysqli_query($connect, 
	"SELECT penduduk.*, sk_kehilangan.* 
	FROM sk_kehilangan 
	LEFT JOIN penduduk ON sk_kehilangan.nik = penduduk.nik 
	WHERE sk_kehilangan.id_kh = '$id'
	");
  	while($row = mysqli_fetch_array($qCek)){

  		$qTampilDesa = mysqli_query($connect, "SELECT * FROM profil_desa WHERE id_profil_desa = '1'");
        foreach($qTampilDesa as $rows){

			$id_pejabat_desa = $row['id_pejabat_desa'];
			$qCekPejabatDesa = mysqli_query($connect, 
			"SELECT pejabat_desa.jabatan, pejabat_desa.nama_pejabat_desa 
			FROM pejabat_desa 
			LEFT JOIN sk_kehilangan ON sk_kehilangan.id_pejabat_desa = pejabat_desa.id_pejabat_desa 
			WHERE sk_kehilangan.id_pejabat_desa = '$id_pejabat_desa' 
				AND sk_kehilangan.id_kh = '$id'
			");
		  	while($rowss = mysqli_fetch_array($qCekPejabatDesa)){
?>

<html>
<head>
	<link rel="shortcut icon" href="../../../../assets/img/mini-logo.png">
	<title>CETAK SURAT KETERANGAN KEHILANGAN</title>
	<link href="../../../../assets/formsuratCSS/formsurat.css" rel="stylesheet" type="text/css"/>
</head>
<body>
<div>
	<table width="100%">
		 <div class="kop-gambar">
            <img src="../../../../assets/img/kop-surat.png" style="width:100%; height:auto;">
        </div>
		<br>
		<div align="center"><u><h4 class="kop3">SURAT KETERANGAN KEHILANGAN</h4></u></div>
		<div align="center"><h4 class="kop">Nomor :&nbsp;&nbsp;&nbsp;<?php echo $row['no_surat']; ?></h4></div>
	</table>
	<br>
	<div class="clear"></div>
	<div id="isi3">
		<table width="100%">
			<tr>
				<td>Yang bertanda tangan di bawah ini <a style="text-transform: capitalize;"><?php echo $rowss['jabatan'] . " " . $rows['nama_desa']; ?>, Kecamatan <?php echo $rows['kecamatan']; ?>, <?php echo $rows['kota']; ?></a> :
				</td>
			</tr>
		</table>
		<br>
		<table width="100%" style="text-transform: capitalize;">
			<tr>
				<td width="30%" class="indentasi">NAMA</td>
				<td width="2%">:</td>
				<td width="68%" style="text-transform: uppercase; font-weight: bold;"><?php echo $row['nama']; ?></td>
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
				<td class="indentasi">Jenis Kelamin</td>
				<td>:</td>
				<td><?php echo $row['jenis_kelamin']; ?></td>
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
				<td class="indentasi">NIK</td>
				<td>:</td>
				<td><?php echo $row['nik']; ?></td>
			</tr>
		</table>
		<br>
		<table width="100%">
			<?php
				$tgl_lhr = date($row['tanggal_kehilangan']);
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
				<td>
					Berdasarkan laporan orang tersebut di atas bahwa Pada hari 
					<a style="text-transform: capitalize;">
						<?php echo $row['hari']; ?>, 
						Tanggal <?php echo $tgl . $blnIndo[$bln] . $thn; ?>, 
						Pukul <?php echo date('H:i', strtotime($row['jam_kehilangan'])); ?> WIB telah kehilangan 
						<strong style="text-transform: capitalize;"><?php echo $row['barang_hilang']; ?></strong> di 
						<strong style="text-transform: capitalize;"><?php echo $row['tempat_kehilangan']; ?></strong>.
						Surat Keterangan ini bersipat pengantar untuk melapor kepada pihak dan untuk meminta surat kehilangan dari 
						<strong>POLSEK ABUNG SELATAN</strong>.
					</a>
				</td>
			</tr>
		</table>
		<br>
		<table width="100%">
			<tr>
				<td>Demikian surat ini di berikan kepada yang bersangkutan untuk dapat di pergunakan sebagai mana mestinya.</td>
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