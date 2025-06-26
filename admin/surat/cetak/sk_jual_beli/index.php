<?php
include('../../permintaan_surat/konfirmasi/part/akses.php');
include('../../../../config/koneksi.php');

$id = $_GET['id'];
$qCek = mysqli_query($connect, "SELECT penduduk.*, sk_jual_beli.* FROM penduduk LEFT JOIN sk_jual_beli ON sk_jual_beli.nik = penduduk.nik WHERE sk_jual_beli.id_jb='$id'");
while ($row = mysqli_fetch_array($qCek)) {

	$qTampilDesa = mysqli_query($connect, "SELECT * FROM profil_desa WHERE id_profil_desa = '1'");
	foreach ($qTampilDesa as $rows) {

		$id_pejabat_desa = $row['id_pejabat_desa'];
		$qCekPejabatDesa = mysqli_query($connect, "SELECT pejabat_desa.jabatan, pejabat_desa.nama_pejabat_desa FROM pejabat_desa LEFT JOIN sk_jual_beli ON sk_jual_beli.id_pejabat_desa = pejabat_desa.id_pejabat_desa WHERE sk_jual_beli.id_pejabat_desa = '$id_pejabat_desa' AND sk_jual_beli.id_jb='$id'");
		while ($rowss = mysqli_fetch_array($qCekPejabatDesa)) {
			?>

			<html>

			<head>
				<link rel="shortcut icon" href="../../../../assets/img/mini-logo.png">
				<title>CETAK SURAT JUAL BELI TANAH</title>
				<link href="../../../../assets/formsuratCSS/formsurat.css" rel="stylesheet" type="text/css" />
				<style>
					@page {
						margin: 1.25cm 1.25cm 1cm 1.25cm;
						/* top, right, bottom, left */
					}

					body {
						font-size: 10pt;
						transform: scale(0.95);
						transform-origin: top left;
						margin: 0;
						padding: 0;
					}
				</style>
			</head>

			<body>
				<div>
					<table width="100%">
						<div align="center"><u>
								<h4 class="kop3">SURAT KETERANGAN JUAL BELI TANAH</h4>
							</u></div>
					</table>
					<br>
					<div class="clear"></div>
					<div id="isi3">
						<table width="100%">
							<tr>
								<td>Kami yang bertanda tangan dibawah ini masing-masing :</td>
							</tr>
						</table>
						<table width="100%" style="text-transform: capitalize;">
							<tr>
								<td width="3%">I.</td>
								<td width="30%" class="indentasi">Nama</td>
								<td width="2%">:</td>
								<td width="68%" style="text-transform: uppercase; font-weight: bold;"><?php echo $row['nama']; ?>
								</td>
							</tr>
							<tr>
								<td width="3%" class="indentasi"></td>
								<td width="30%" class="indentasi">Umur</td>
								<td width="2%">:</td>
								<td width="68%">
									<?php
									$tgl_lahir = $row['tgl_lahir'];
									$today = new DateTime();
									$birthdate = new DateTime($tgl_lahir);
									$age = $today->diff($birthdate)->y;
									echo $age . " Tahun";
									?>
								</td>
							</tr>
							<tr>
								<td width="3%" class="indentasi"></td>
								<td class="indentasi">Pekerjaan</td>
								<td>:</td>
								<td style="text-transform: uppercase;"><?php echo $row['pekerjaan']; ?></td>
							</tr>
							<tr>
								<td width="3%" class="indentasi"></td>
								<td class="indentasi">Alamat</td>
								<td>:</td>
								<td><?php echo $row['jalan'] . ", RT" . $row['rt'] . "/RW" . $row['rw'] . ", Dusun " . $row['dusun'] . ", Desa " . $row['desa'] . ", Kecamatan " . $row['kecamatan'] . ", " . $row['kota']; ?>
								</td>
							</tr>
						</table>
						<table>
							<tr>
								<td><b><i>Nama tersebut dalam surat ini disebut Pihak Ke-I (Penjual)</i></b></td>
							</tr>
						</table>
						<table width="100%" style="text-transform: capitalize;">
							<tr>
								<td width="3%">II.</td>
								<td width="30%" class="indentasi">Nama</td>
								<td width="2%">:</td>
								<td width="68%" style="text-transform: uppercase; font-weight: bold;">
									<?php echo $row['nama_penjual']; ?>
								</td>
							</tr>
							<tr>
								<td width="3%" class="indentasi"></td>
								<td width="30%" class="indentasi">Umur</td>
								<td width="2%">:</td>
								<td width="68%"><?php echo $row['umur_penjual']; ?></td>
							</tr>
							<tr>
								<td width="3%" class="indentasi"></td>
								<td class="indentasi">Pekerjaan</td>
								<td>:</td>
								<td style="text-transform: uppercase;"><?php echo $row['pekerjaan_penjual']; ?></td>
							</tr>
							<tr>
								<td width="3%" class="indentasi"></td>
								<td class="indentasi">Alamat</td>
								<td>:</td>
								<td><?php echo $row['alamat_penjual']; ?></td>
							</tr>
						</table>
						<table>
							<tr>
								<td><b><i>Nama tersebut dalam surat ini disebut Pihak Ke-II (Pembeli)</i></b></td>
							</tr>
						</table>
						<?php
						$tgl_lhr = date($row['tanggal_transaksi']);
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
						<?php
						// Fungsi konversi angka ke huruf
						function terbilang($number)
						{
							$huruf = array("", "Satu", "Dua", "Tiga", "Empat", "Lima", "Enam", "Tujuh", "Delapan", "Sembilan", "Sepuluh", "Sebelas");

							if ($number < 12)
								return $huruf[$number];
							elseif ($number < 20)
								return terbilang($number - 10) . " Belas";
							elseif ($number < 100)
								return terbilang($number / 10) . " Puluh " . terbilang($number % 10);
							elseif ($number < 200)
								return "Seratus " . terbilang($number - 100);
							elseif ($number < 1000)
								return terbilang($number / 100) . " Ratus " . terbilang($number % 100);
							elseif ($number < 2000)
								return "Seribu " . terbilang($number - 1000);
							elseif ($number < 1000000)
								return terbilang($number / 1000) . " Ribu " . terbilang($number % 1000);
							elseif ($number < 1000000000)
								return terbilang($number / 1000000) . " Juta " . terbilang($number % 1000000);
							else
								return "Angka terlalu besar";
						}

						// Ambil dan bersihkan harga dari database
						$harga_string = $row['harga_tanah']; // Contoh: "Rp 30.000.000\r"
						$harga_bersih = preg_replace('/[^0-9]/', '', $harga_string); // Hasil: 30000000
						?>
						<table width="100%">
							<tr>
								<td>Pada hari ini <b> <?php echo $row['hari_transaksi']; ?></b> tanggal <b>
										<?php echo $tgl . $blnIndo[$bln] . $thn; ?></b>, Pihak Kesatu dan Pihak Kedua telah
									melakukan transaksi Jual-Beli Tanah
									<b><?php echo $row['kategori_tanah']; ?></b> berikut tanam tumbuhnya. Dengan ukuran Luas =
									<?php echo $row['luas_tanah']; ?> M2
									(<?php echo $row['ukuran_tanah']; ?>) tanah tersebut terletak di
									<?php echo $row['lokasi_tanah']; ?>. Dengan Harga :
									<b><?php echo $row['harga_tanah']; ?>,-</b> terbilang
									<b>(<?php echo ucwords(terbilang((int) $harga_bersih)); ?> Rupiah)</b> dengan bukti transaksi
									jual-beli.
								</td>
							</tr>
						</table>
						<br>
						<table width="100%">
							<tr>
								<td>Adapun Batas-batas Tanah tersebut adalah sebagai berikut :
								</td>
							</tr>
						</table>
						<table width="100%" style="text-transform: capitalize;">
							<tr>
								<td width="3%">-</td>
								<td width="20%">Sebelah UTARA</td>
								<td width="68%">
									Berbatasan dengan Tanah <?php echo $row['batas_utara']; ?>
								</td>
							</tr>
							<tr>
								<td width="3%">-</td>
								<td width="20%">Sebelah SELATAN</td>
								<td width="68%">
									Berbatasan dengan Tanah <?php echo $row['batas_selatan']; ?>
								</td>
							</tr>
							<tr>
								<td width="3%">-</td>
								<td width="20%">Sebelah TIMUR</td>
								<td width="68%">
									Berbatasan dengan Tanah <?php echo $row['batas_timur']; ?>
								</td>
							</tr>
							<tr>
								<td width="3%">-</td>
								<td width="20%">Sebelah BARAT</td>
								<td width="68%">
									Berbatasan dengan Tanah <?php echo $row['batas_barat']; ?>
								</td>
							</tr>
						</table>
						<br>
						<table width="100%">
							<tr>
								<td>Tanah dimaksud adalah hak milik sah Pihak Ke-Satu, tidak bersengketa, tidak dalam agunan, serta
									tidak berkaitan dengan pihak lain. Segala tuntutan yang timbul menjadi tanggung jawab Pihak
									Ke-Satu. Sejak surat ini ditandatangani, kepemilikan tanah secara sah beralih kepada Pihak
									Ke-Dua. Surat ini dibuat tanpa adanya tekanan dari pihak manapun dan ditandatangani di hadapan
									para saksi untuk digunakan sebagaimana mestinya.
								</td>
							</tr>
						</table>
						<br>
						<table width="100%">
							<tr>
								<td>Demikian Surat Keterangan Jual-beli ini dibuat dengan sebenar-benarnya tanpa ada paksaan dari
									Pihak manapun dan kami tanda tangani dihadapan saksi-saksi yang turut serta menanda tangani
									surat ini agar dapat dipergunakan sebagaimana mestinya.
								</td>
							</tr>
						</table>
					</div>
					<br>
					<!-- TANDA TANGAN PIHAK I & II -->
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
						<tr>
							<td align="center" width="33%">
								PIHAK KE-II (PEMBELI)
							</td>
							<td align="center" width="33%"></td>
							<td align="center" width="33%">
								PIHAK KE-I (PENJUAL)
							</td>
						</tr>

						<tr style="height: 65px;">
							<td></td>
							<td></td>
							<td align="center" style="font-size: 11px;"><br>Materai 10.000</td>
						</tr>

						<tr>
							<td align="center" style="text-transform: uppercase;">
								<b><u><?php echo $row['nama']; ?></u></b>
							</td>
							<td></td>
							<td align="center" style="text-transform: uppercase;">
								<b><u><?php echo $row['nama_penjual']; ?></u></b>
							</td>
						</tr>
					</table>

					<br>

					<!-- SAKSI-SAKSI & KEPALA DESA -->
					<table width="100%" style="font-size: 14px; text-transform: capitalize;">
						<tr>
							<td colspan="3"><b><i>SAKSI-SAKSI :</i></b></td>
							<td align="center" rowspan="6" valign="top">
								MENGETAHUI<br>
								<b>Kepala Desa <?php echo $rows['nama_desa']; ?></b><br><br><br><br>
								<b><u><?php echo $rowss['nama_pejabat_desa']; ?></u></b>
							</td>
						</tr>
						<tr>
							<td width="3%">1.</td>
							<td><b><?php echo $row['nama_saksi1']; ?></b> (<?php echo $row['alamat_saksi1']; ?>)</td>
							<td>(.......................)</td>
							<td></td>
						</tr>
						<tr>
							<td>2.</td>
							<td><b><?php echo $row['nama_saksi2']; ?></b> (<?php echo $row['alamat_saksi2']; ?>)</td>
							<td>(.......................)</td>
							<td></td>
						</tr>
						<tr>
							<td>3.</td>
							<td><b><?php echo $row['nama_saksi3']; ?></b></td>
							<td>(.......................)</td>
							<td></td>
						</tr>
						<tr>
							<td>4.</td>
							<td><b><?php echo $row['nama_saksi4']; ?></b></td>
							<td>(.......................)</td>
							<td></td>
						</tr>
						<?php if (!empty($row['nama_saksi5'])) { ?>
							<tr>
								<td>5.</td>
								<td><b><?php echo $row['nama_saksi5']; ?></b></td>
								<td>(.......................)</td>
								<td></td>
							</tr>
						<?php } ?>
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