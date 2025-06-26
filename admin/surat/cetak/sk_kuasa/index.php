<?php
include('../../permintaan_surat/konfirmasi/part/akses.php');
include('../../../../config/koneksi.php');

$id = $_GET['id'];
$qCek = mysqli_query($connect, "SELECT penduduk.*, sk_kuasa.* FROM penduduk LEFT JOIN sk_kuasa ON sk_kuasa.nik = penduduk.nik WHERE sk_kuasa.id_kuasa='$id'");
while ($row = mysqli_fetch_array($qCek)) {

	$qTampilDesa = mysqli_query($connect, "SELECT * FROM profil_desa WHERE id_profil_desa = '1'");
	foreach ($qTampilDesa as $rows) {

		$id_pejabat_desa = $row['id_pejabat_desa'];
		$qCekPejabatDesa = mysqli_query($connect, "SELECT pejabat_desa.jabatan, pejabat_desa.nama_pejabat_desa FROM pejabat_desa LEFT JOIN sk_kuasa ON sk_kuasa.id_pejabat_desa = pejabat_desa.id_pejabat_desa WHERE sk_kuasa.id_pejabat_desa = '$id_pejabat_desa' AND sk_kuasa.id_kuasa='$id'");
		while ($rowss = mysqli_fetch_array($qCekPejabatDesa)) {
			?>

			<html>

			<head>
				<link rel="shortcut icon" href="../../../../assets/img/mini-logo.png">
				<title>CETAK SURAT KUASA</title>
				<link href="../../../../assets/formsuratCSS/formsurat.css" rel="stylesheet" type="text/css" />
			</head>

			<body>
				<div>
					<table width="100%">
						<div align="center"><u>
								<h4 class="kop3">SURAT KUASA</h4>
							</u></div>
					</table>
					<br>
					<div class="clear"></div>
					<div id="isi3">
						<table width="100%">
							<tr>
								<td>Yang bertanda tangan dibawah ini :</td>
							</tr>
						</table>
						<br>
						<table width="100%" style="text-transform: capitalize;">
							<tr>
								<td width="3%">I.</td>
								<td width="30%" class="indentasi">Nama Lengkap</td>
								<td width="2%">:</td>
								<td width="68%" style="text-transform: uppercase; font-weight: bold;"><?php echo $row['nama']; ?>
								</td>
							</tr>
							<tr>
								<td width="3%" class="indentasi"></td>
								<td width="30%" class="indentasi">Jenis Kelamin</td>
								<td width="2%">:</td>
								<td width="68%"><?php echo $row['jenis_kelamin']; ?></td>
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
								<td width="3%" class="indentasi"></td>
								<td class="indentasi">Tempat/Tgl. Lahir</td>
								<td>:</td>
								<td><?php echo $row['tempat_lahir'] . ", " . $tgl . $blnIndo[$bln] . $thn; ?></td>
							</tr>
							<tr>
								<td width="3%" class="indentasi"></td>
								<td class="indentasi">Kewarganegaraan</td>
								<td>:</td>
								<td style="text-transform: uppercase;"><?php echo $row['kewarganegaraan']; ?></td>
							</tr>
							<tr>
								<td width="3%" class="indentasi"></td>
								<td class="indentasi">Tempat Tinggal</td>
								<td>:</td>
								<td><?php echo $row['jalan'] . ", RT" . $row['rt'] . "/RW" . $row['rw'] . ", Dusun " . $row['dusun'] . ", Desa " . $row['desa'] . ", Kecamatan " . $row['kecamatan'] . ", " . $row['kota']; ?>
								</td>
							</tr>
							<tr>
								<td width="3%" class="indentasi"></td>
								<td class="indentasi">NIK</td>
								<td>:</td>
								<td style="text-transform: uppercase;"><?php echo $row['nik']; ?></td>
							</tr>
						</table>
						<br>
						<table>
							<tr>
								<td><i>Selanjutnya dalam hal ini disebut PIHAK I (Memberi Kuasa)</i></td>
							</tr>
						</table>
						<br>
						<table width="100%" style="text-transform: capitalize;">
							<tr>
								<td width="3%">II.</td>
								<td width="30%" class="indentasi">Nama Lengkap</td>
								<td width="2%">:</td>
								<td width="68%" style="text-transform: uppercase; font-weight: bold;">
									<?php echo $row['nama_kuasa']; ?>
								</td>
							</tr>
							<tr>
								<td width="3%" class="indentasi"></td>
								<td width="30%" class="indentasi">Jenis Kelamin</td>
								<td width="2%">:</td>
								<td width="68%"><?php echo $row['jenis_kelamin_kuasa']; ?></td>
							</tr>
							<tr>
								<td width="3%" class="indentasi"></td>
								<td class="indentasi">Kewarganegaraan</td>
								<td>:</td>
								<td style="text-transform: uppercase;"><?php echo $row['kewarganegaraan_kuasa']; ?></td>
							</tr>
							<tr>
								<td width="3%" class="indentasi"></td>
								<td class="indentasi">Tempat Tinggal</td>
								<td>:</td>
								<td><?php echo $row['alamat_kuasa']; ?></td>
							</tr>
						</table>
						<br>
						<table>
							<tr>
								<td><i>Selanjutnya dalam hal ini disebut PIHAK II (Menerima Kuasa)</i></td>
							</tr>
						</table>
						<br>
						<table width="100%">
							<tr>
								<td>Pihak Ke-I, karena alasan <?php echo $row['kondisi_pihak1']; ?>, memberikan kuasa sepenuhnya
									kepada Pihak Ke-II untuk <?php echo $row['keterangan_kuasa']; ?>.</td>
							</tr>
						</table><br>
						<table width="100%">
							<tr>
								<td>Demikian Surat Kuasa ini dibuat dengan sebenarnya tanpa ada paksaan dari siapapun juga dan
									dibuat dalam keadaan tidak sedang lupa ingatan, Kepada yang bertugas diucapkan Terima Kasih.
								</td>
							</tr>
						</table>
					</div>
					<br>
					<table width="100%" style="text-transform: capitalize;">
						<!-- Baris Tanggal -->
						<tr>
							<td></td>
							<td></td>
							<td align="center" colspan="1" style="text-transform: capitalize;">
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
								echo $rows['nama_desa'] . ', ' . date('d ') . $bulanIndo[$bulan] . date(' Y');
								?>
							</td>
						</tr>

						<!-- Baris PIHAK I dan II -->
						<tr>
							<td align="center" width="45%">
								PIHAK II<br>
								Yang Menerima Kuasa
							</td>
							<td width="10%"></td>
							<td align="center" width="45%">
								PIHAK I<br>
								Yang Memberi Kuasa
							</td>
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
						<!-- Materai -->
						<tr>
							<td></td>
							<td colspan="3" align="center" height="40px" style="font-size: 11px;">Materai 10.000</td>
						</tr>

						<!-- Nama-nama -->
						<tr>
							<td align="center" style="text-transform: uppercase;"><b><u><?php echo $row['nama_kuasa']; ?></u></b>
							</td>
							<td></td>
							<td align="center" style="text-transform: uppercase;"><b><u><?php echo $row['nama']; ?></u></b></td>
						</tr>

						<!-- Kepala Desa -->
						<tr>
							<td colspan="3" height="40px"></td>
						</tr>
						<tr>
							<td colspan="3" align="center">Mengetahui<br>KEPALA DESA <?php echo strtoupper($rows['nama_desa']); ?>
							</td>
						</tr>
						<tr>
							<td colspan="3" height="60px"></td>
						</tr>
						<tr>
							<td colspan="3" align="center" style="text-transform: uppercase;">
								<b><u><?php echo $rowss['nama_pejabat_desa']; ?></u></b>
							</td>
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