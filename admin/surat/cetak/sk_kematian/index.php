<?php
include('../../permintaan_surat/konfirmasi/part/akses.php');
include('../../../../config/koneksi.php');

$id = $_GET['id'];
$qCek = mysqli_query($connect, "SELECT penduduk.*, sk_kematian.* FROM penduduk LEFT JOIN sk_kematian ON sk_kematian.nik = penduduk.nik WHERE sk_kematian.id_m='$id'");
while ($row = mysqli_fetch_array($qCek)) {

	$qTampilDesa = mysqli_query($connect, "SELECT * FROM profil_desa WHERE id_profil_desa = '1'");
	foreach ($qTampilDesa as $rows) {

		$id_pejabat_desa = $row['id_pejabat_desa'];
		$qCekPejabatDesa = mysqli_query($connect, "SELECT pejabat_desa.jabatan, pejabat_desa.nama_pejabat_desa FROM pejabat_desa LEFT JOIN sk_kematian ON sk_kematian.id_pejabat_desa = pejabat_desa.id_pejabat_desa WHERE sk_kematian.id_pejabat_desa = '$id_pejabat_desa' AND sk_kematian.id_m='$id'");
		while ($rowss = mysqli_fetch_array($qCekPejabatDesa)) {
			?>

			<html>

			<head>
				<link rel="shortcut icon" href="../../../../assets/img/mini-logo.png">
				<title>CETAK SURAT KETERANGAN KEMATIAN</title>
				<link href="../../../../assets/formsuratCSS/formsurat.css" rel="stylesheet" type="text/css" />
			</head>

			<body>
				<div>
					<table width="100%">
						<div class="kop-gambar">
							<img src="../../../../assets/img/kop-surat.png" style="width:100%; height:auto;">
						</div>
						<br>
						<div align="center"><u>
								<h4 class="kop3">SURAT KETERANGAN KEMATIAN</h4>
							</u></div>
						<div align="center">
							<h4 class="kop">Nomor :&nbsp;&nbsp;&nbsp;<?php echo $row['no_surat']; ?></h4>
						</div>
					</table>
					<br>
					<div class="clear"></div>
					<div id="isi3">
						<table width="100%">
							<tr>
								<td>Yang bertanda tangan di bawah ini <a
										style="text-transform: capitalize;"><?php echo $rowss['jabatan'] . " " . $rows['nama_desa']; ?>,
										Kecamatan <?php echo $rows['kecamatan']; ?>, <?php echo $rows['kota']; ?></a> :
								</td>
							</tr>
						</table>
						<br>
						<table width="100%" style="text-transform: capitalize;">
							<tr>
								<td width="30%" class="indentasi">Nama</td>
								<td width="2%">:</td>
								<td width="68%" style="text-transform: uppercase; font-weight: bold;"><?php echo $row['nama']; ?>
								</td>
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
								<td class="indentasi">Agama</td>
								<td>:</td>
								<td><?php echo $row['agama']; ?></td>
							</tr>
							<tr>
								<td class="indentasi">NIK</td>
								<td>:</td>
								<td><?php echo $row['nik']; ?></td>
							</tr>
							<tr>
								<td class="indentasi">Alamat</td>
								<td>:</td>
								<td><?php echo $row['jalan'] . ", RT" . $row['rt'] . "/RW" . $row['rw'] . ", Dusun " . $row['dusun'] . ", Desa " . $row['desa'] . ", Kecamatan " . $row['kecamatan'] . ", " . $row['kota']; ?>
								</td>
							</tr>
						</table>
						<br>
						<table width="100%">
							<tr>
								<td>Adalah benar Penduduk Desa <?php echo strtoupper($rows['nama_desa']); ?> Terdaftar dalam Buku
									Induk Kependudukan Desa <?php echo strtoupper($rows['nama_desa']); ?> Kecamatan
									<?php echo $rows['kecamatan']; ?> dan benar telah Meninggal Dunia pada :</td>
							</tr>
						</table>
						<br>
						<table width="100%" style="text-transform: capitalize;">
							<tr>
								<td width="30%" class="indentasi">Hari</td>
								<td width="2%">:</td>
								<td width="68%"><?php echo $row['hari_m']; ?>
								</td>
							</tr>
							<?php
							$tgl_lhr = date($row['tgl_m']);
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
								<td class="indentasi">Tanggal</td>
								<td>:</td>
								<td><?php echo $tgl . $blnIndo[$bln] . $thn; ?></td>
							</tr>
							<tr>
								<td class="indentasi">Dimakamkan di</td>
								<td>:</td>
								<td><?php echo $row['tempat_m']; ?></td>
							</tr>
							<tr>
								<td class="indentasi">Penyebab</td>
								<td>:</td>
								<td><?php echo $row['penyebab_m']; ?></td>
							</tr>
							<tr></tr>
							<tr></tr>
							<tr></tr>
							<tr></tr>
							<tr></tr>
							<tr></tr>
							<tr>
								<td class="indentasi">Ahli Waris</td>
								<td></td>
								<td></td>
							</tr>
							<tr></tr>
							<tr></tr>
							<tr></tr>
							<tr></tr>
							<tr></tr>
							<tr></tr>
							<tr>
								<td class="indentasi">Bapak/Ibu</td>
								<td>:</td>
								<td><?php echo $row['ortu_m']; ?></td>
							</tr>
							<tr>
								<td class="indentasi">Suami/Isteri</td>
								<td>:</td>
								<td><?php echo $row['pasangan_m']; ?></td>
							</tr>
							<tr>
								<td class="indentasi">Anak</td>
								<td>:</td>
								<td>
									<?php
									$jumlah_anak = intval($row['jumlah_anak']);
									for ($i = 1; $i <= $jumlah_anak; $i++) {
										$nama = isset($row["nama_anak_$i"]) ? $row["nama_anak_$i"] : '';
										if (!empty($nama)) {
											echo $i . '. ' . htmlspecialchars($nama) . '<br>';
										}
									}
									?>
								</td>
							</tr>
						</table>
						<br>
						<table width="100%">
							<tr>
								<td>Demikian Surat Keterangan Kematian ini kami buat dengan sebenarnya untuk dapat digunakan sebagaimana mestinya, bagi yang berkepentingan di ucapkan terima kasih.</td>
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
							<td align="center" style="text-transform: uppercase;">
								<u><b><?php echo $rowss['nama_pejabat_desa']; ?></b></u>
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