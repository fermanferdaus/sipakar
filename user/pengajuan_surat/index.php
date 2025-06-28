<?php
include('../part/akses.php');
include('../part/header.php');
?>

<aside class="main-sidebar">
	<section class="sidebar">
		<ul class="sidebar-menu" data-widget="tree">
			<li class="header">MAIN NAVIGATION</li>
			<li>
				<a href="../dashboard/">
					<i class="fas fa-tachometer-alt"></i> <span>&nbsp;&nbsp;Home</span>
				</a>
			</li>
			<li>
				<a href="../profil/index.php?id=<?php echo $_SESSION['id']; ?>">
					<i class="fas fa-user-edit"></i> <span>&nbsp;&nbsp;Edit Profil</span>
				</a>
			</li>
			<li class="active">
				<a href="#">
					<i class="fas fa-envelope-open-text"></i> <span>&nbsp;&nbsp;Pengajuan Surat</span>
				</a>
			</li>
			<li>
				<a href="../surat/surat_selesai/">
					<i class="fas fa-envelope"></i> <span>&nbsp;&nbsp;Lihat Surat</span>
				</a>
			</li>
			<li class="header">Other</li>
			<li>
				<a href="../../login/logout.php">
					<i class="fas fa-sign-out-alt"></i> <span>&nbsp;&nbsp;Logout</span>
				</a>
			</li>
		</ul>
	</section>
</aside>
<div class="content-wrapper">
	<section class="content-header">
		<h1>Pengajuan Surat</h1>
		<ol class="breadcrumb">
			<li><a href="../../dashboard/"><i class="fa fa-tachometer-alt"></i> Home</a></li>
			<li class="active">Pengajuan Surat</li>
		</ol>
	</section>
	<section class="content">
		<?php if (isset($_GET['pesan']) && $_GET['pesan'] == "berhasil"): ?>
			<div class="alert alert-success text-center font-weight-bold">
				✅ Berhasil membuat surat! Silahkan ambil surat di Kantor Desa dalam 2-3 hari kerja.
			</div>
		<?php endif; ?>

		<div class="box box-white">
			<div class="box-header with-border">
				<h3 class="box-title"><i class="fa fa-edit"></i> Daftar Pengajuan Surat</h3>
				<div class="box-tools pull-right">
					<button type="button" class="btn btn-box-tool" data-widget="collapse"><i
							class="fa fa-minus"></i></button>
					<button type="button" class="btn btn-box-tool" data-widget="remove"><i
							class="fa fa-times"></i></button>
				</div>
			</div>

			<div class="box-body">
				<div class="row">
					<?php
					$data_surat = [
						["SK AHLI WARIS", "sk_ahli_waris/"],
						["SK JUAL BELI", "sk_jual_beli/"],
						["SK DOMISILI", "sk_domisili/"],
						["SK KEHILANGAN", "sk_kehilangan/"],
						["SK GANGGUAN JIWA", "sk_gangguan_jiwa/"],
						["SK KEMATIAN", "sk_kematian/"],
						["SK PENGHASILAN ORANG TUA", "sk_penghasilan_orang_tua/"],
						["SK PENGANTAR SKCK", "sk_pengantar_skck/"],
						["SK TIDAK MAMPU", "sk_tidak_mampu/"],
						["SK USAHA", "sk_usaha/"],
						["SURAT KUASA", "sk_kuasa/"],
					];

					foreach ($data_surat as $surat) {
						echo '
          <div class="col-md-6 col-lg-4 col-xl-3">
            <div class="box text-center" style="border: 1px solid #ddd; border-radius: 10px; padding: 20px; margin-bottom: 20px; box-shadow: 0 2px 6px rgba(0,0,0,0.1); transition: 0.3s;">
              <div class="mb-3">
                <i class="fa fa-file-alt text-primary" style="font-size: 48px;"></i>
              </div>
              <h4 class="font-weight-bold" style="font-size: 18px;">' . $surat[0] . '</h4>
              <hr>
              <a href="' . $surat[1] . '" class="btn btn-sm btn-primary mt-2">Buat Surat <i class="fa fa-arrow-right ml-1"></i></a>
            </div>
          </div>';
					}
					?>
				</div>
			</div>
		</div>
	</section>
</div>

<?php include('../part/footer.php'); ?>