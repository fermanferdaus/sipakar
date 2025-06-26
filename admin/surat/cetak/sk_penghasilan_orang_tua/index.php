<?php 
	include ('../../permintaan_surat/konfirmasi/part/akses.php');
  	include ('../../../../config/koneksi.php');

  	$id = $_GET['id'];
  	$qCek = mysqli_query($connect,"SELECT penduduk.*, sk_penghasilan_orang_tua.* FROM penduduk LEFT JOIN sk_penghasilan_orang_tua ON sk_penghasilan_orang_tua.nik = penduduk.nik WHERE sk_penghasilan_orang_tua.id_pot='$id'");
  	while($row = mysqli_fetch_array($qCek)){

  		$qTampilDesa = mysqli_query($connect, "SELECT * FROM profil_desa WHERE id_profil_desa = '1'");
        foreach($qTampilDesa as $rows){

			$id_pejabat_desa = $row['id_pejabat_desa'];
		  	$qCekPejabatDesa = mysqli_query($connect,"SELECT pejabat_desa.jabatan, pejabat_desa.nama_pejabat_desa FROM pejabat_desa LEFT JOIN sk_penghasilan_orang_tua ON sk_penghasilan_orang_tua.id_pejabat_desa = pejabat_desa.id_pejabat_desa WHERE sk_penghasilan_orang_tua.id_pejabat_desa = '$id_pejabat_desa' AND sk_penghasilan_orang_tua.id_pot='$id'");
		  	while($rowss = mysqli_fetch_array($qCekPejabatDesa)){
?>

<html>
<head>
	<link rel="shortcut icon" href="../../../../assets/img/mini-logo.png">
	<title>CETAK SURAT SURAT PERNYATAAN PENGHASILAN ORANG TUA</title>
	<link href="../../../../assets/formsuratCSS/formsurat.css" rel="stylesheet" type="text/css"/>
</head>
<body>
<div>
	<table width="100%">
		<div class="kop-gambar">
            <img src="../../../../assets/img/kop-surat.png" style="width:100%; height:auto;">
        </div>
		<br>
		<div align="center"><u><h4 class="kop3">SURAT PERNYATAAN PENGHASILAN ORANG TUA</h4></u></div>
		<div align="center"><h4 class="kop">Nomor :&nbsp;&nbsp;&nbsp;<?php echo $row['no_surat']; ?></h4></div>
	</table>
	<br>
	<div class="clear"></div>
	<div id="isi3">
		<table width="100%">
			<tr>
				<td>Yang bertanda tangan di bawah ini: 
				</td>
			</tr>
		</table>
		<br>
		<table width="100%" style="text-transform: capitalize;">
			<tr>
				<td width="30%" class="indentasi">Nama Lengkap</td>
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
				<td class="indentasi">Alamat</td>
				<td>:</td>
				<td><?php echo $row['jalan'] . ", RT" . $row['rt'] . "/RW" . $row['rw'] . ", Dusun " . $row['dusun'] . ", Desa " . $row['desa'] . ", Kecamatan " . $row['kecamatan'] . ", " . $row['kota']; ?></td>
			</tr>
		</table>
		<br>
		<table width="100%" style="text-transform: capitalize;">
			<tr>
				<td colspan="3">
				<p>
					Dengan ini menyatakan perihal pekerjaan saya <i>(lingkari yang sesuai)</i>, yaitu:
				</p>

				<ul style="list-style-type: lower-alpha; padding-left: 20px; margin-top: 4; margin-bottom: 4;">
					<li>Wirausaha/Pengusaha</li>
					<li>Petani</li>
					<li>Karyawan Swasta</li>
					<li>Buruh</li>
					<li>Ojek Online</li>
					<li>Pengangguran</li>
					<li>Lainnya: ...........................................</li>
				</ul>

				<p>
					Berkaitan dengan hal tersebut saya sampaikan bahwa:
				</p>
				</td>
			</tr>
		</table>
		<br>
		<table width="100%" style="text-transform: capitalize;">
			<tr>
				<td width="5%">1.</td>
				<td>Penghasilan sebesar = <?php echo $row['penghasilan']; ?>/Bulan</td>
			</tr>
			<tr>
				<td>2.</td>
				<td>Jumlah tanggungan = <?php echo $row['tanggungan']; ?> orang</td>
			</tr>
		</table>
		<br>
		<table width="100%">
			<tr>
				<td>Adapun surat pernyataan ini di buat sebagai <a><?php echo $row['keperluan'] ?></a>  atas :</td>
			</tr>
		</table>
		<table width="100%" style="text-transform: capitalize;">
			<tr>
				<td width="30%" class="indentasi">Nama Lengkap</td>
				<td width="2%">:</td>
				<td width="68%" style="text-transform: uppercase; font-weight: bold;"><?php echo $row['nama_pot']; ?></td>
			</tr>
			<?php
				$tgl_lhr = date($row['tgl_lahir_pot']);
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
				<td><?php echo $row['tempat_lahir_pot'] . ", " . $tgl . $blnIndo[$bln] . $thn; ?></td>
			</tr>
			<tr>
				<td class="indentasi">Program Studi</td>
				<td>:</td>
				<td><?php echo $row['prodi'] ?></td>
			</tr>
			<tr>
				<td class="indentasi">Hubungan Keluarga</td>
				<td>:</td>
				<td><?php echo $row['hubungan_keluarga'] ?></td>
			</tr>
		</table>
		<br>
		<table width="100%">
			<tr>
				<td>Demikian surat pernyataan ini saya buat,untuk dipergunakan sebagaimana mestinya.
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
		<tr></tr>
		<tr>
			<td></td>
			<td align="center">Mengetahui</td>
			<td></td>
			<td align="center">Yang membuat pernyataan</td>
		</tr>
		<tr>
			<td></td>
			<td align="center"><?php echo $rowss['jabatan'] . " " . $rows['nama_desa']; ?></td>
			<td></td>
			<td></td>
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
			<td align="center" style="text-transform: uppercase;"><b><u><?php echo $rowss['nama_pejabat_desa']; ?></u></b></td>
			<td></td>
			<td align="center" style="text-transform: uppercase"><b><u><?php echo $row['nama']; ?></u></b></td>
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