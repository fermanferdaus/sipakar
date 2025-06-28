<?php
include('../part/akses.php');
include('../part/header.php');
include('../../config/koneksi.php');
$id = isset($_GET['id']) ? $_GET['id'] : null;

if (!$id) {
    echo "<div class='alert alert-danger'><center>ID tidak ditemukan di URL.</center></div>";
    exit;
}

$qCek = mysqli_query($connect, "SELECT * FROM login WHERE id='$id'");
while ($row = mysqli_fetch_array($qCek)) {
    ?>

    <aside class="main-sidebar">
        <section class="sidebar">

            <ul class="sidebar-menu" data-widget="tree">
                <li class="header">MAIN NAVIGATION</li>
                <li>
                    <a href="../dashboard/">
                        <i class="fas fa-tachometer-alt"></i> <span>&nbsp;&nbsp;Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="../pengumuman"><i class="fa fa-info-circle"></i> <span>Kelola Informasi</span></a>
                </li>
                <li>
                    <a href="../penduduk"><i class="fa fa-users"></i> <span>Data Penduduk</span></a>
                </li>
                <li>
                    <a href="../perangkat_desa/"><i class="fa fa-user-tie"></i> <span>Perangkat Desa</span></a>
                </li>
                <li>
                    <a href="../profil_desa/"><i class="fa fa-cogs"></i> <span>Kelola Profil Desa</span></a>
                </li>
                <?php
                if (isset($_SESSION['lvl']) && ($_SESSION['lvl'] == 'Administrator')) {
                    ?>
                    <li class="treeview">
                        <a href="#">
                            <i class="fas fa-envelope-open-text"></i> <span>&nbsp;&nbsp;Surat</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li>
                                <a href="../surat/permintaan_surat/"><i class="fa fa-circle-notch"></i> Permintaan Surat</a>
                            </li>
                            <li>
                                <a href="../surat/surat_selesai/"><i class="fa fa-circle-notch"></i> Surat Selesai</a>
                            </li>
                            <li class="">
                                <a href="../surat/surat_ditolak/"><i class="fa fa-circle-notch"></i> Surat Ditolak
                                </a>
                            </li>
                        </ul>
                    </li>
                    <?php
                } else {

                }
                ?>
                <li>
                    <a href="../laporan/">
                        <i class="fas fa-chart-line"></i> <span>&nbsp;&nbsp;Laporan</span>
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
            <h1>Edit Profil</h1>
            <ol class="breadcrumb">
                <li><a href="../dashboard/"><i class="fa fa-tachometer-alt"></i> Dashboard</a></li>
                <li class="active">Edit Profil</li>
            </ol>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-default">
                        <div class="box-header with-border">
                            <h3 class="box-title"><i class="fa fa-user-edit"></i> Edit Profil</h3>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                        class="fa fa-minus"></i></button>
                                <button type="button" class="btn btn-box-tool" data-widget="remove"><i
                                        class="fa fa-remove"></i></button>
                            </div>
                        </div>
                        <div class="box-body">
                            <form method="POST" action="simpan-profil.php" enctype="multipart/form-data">
                                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">

                                <!-- Foto Profil -->
                                <div class="form-group text-center">
                                    <label>Foto Profil</label><br>
                                    <?php if (!empty($row['foto_profil']) && file_exists("../../assets/img/profil/" . $row['foto_profil'])): ?>
                                        <img src="../../assets/img/profil/<?php echo $row['foto_profil']; ?>"
                                            class="img-thumbnail" style="max-width: 150px;">
                                    <?php else: ?>
                                        <img src="../../assets/img/default-avatar.png" class="img-thumbnail"
                                            style="max-width: 150px;">
                                    <?php endif; ?>
                                </div>

                                <!-- Upload Foto -->
                                <div class="form-group">
                                    <label>Upload Foto Baru</label>
                                    <input type="hidden" name="foto_lama" value="<?php echo $row['foto_profil']; ?>">
                                    <input type="file" name="ffoto" class="form-control">
                                    <small class="text-muted">Biarkan kosong jika tidak ingin mengubah.</small>
                                </div>

                                <!-- Nama -->
                                <div class="form-group">
                                    <label>Nama</label>
                                    <input type="text" name="fnama" class="form-control" style="text-transform: capitalize;"
                                        value="<?php echo htmlspecialchars($row['nama']); ?>" required>
                                </div>

                                <!-- Email -->
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" name="femail" class="form-control"
                                        value="<?php echo htmlspecialchars($row['email']); ?>" required>
                                </div>

                                <!-- Password -->
                                <div class="form-group">
                                    <label>Password Baru</label>
                                    <div class="input-group">
                                        <input type="password" name="fpassword" id="password" class="form-control"
                                            placeholder="Kosongkan jika tidak diubah">
                                        <span class="input-group-btn">
                                            <button class="btn btn-default reveal" type="button"
                                                onclick="togglePassword('password')">
                                                <i class="fa fa-eye" id="icon-password"></i>
                                            </button>
                                        </span>
                                    </div>
                                </div>

                                <!-- Konfirmasi Password -->
                                <div class="form-group">
                                    <label>Konfirmasi Password</label>
                                    <div class="input-group">
                                        <input type="password" name="fkonfirmasi" id="konfirmasi" class="form-control"
                                            placeholder="Ulangi password baru">
                                        <span class="input-group-btn">
                                            <button class="btn btn-default reveal" type="button"
                                                onclick="togglePassword('konfirmasi')">
                                                <i class="fa fa-eye" id="icon-konfirmasi"></i>
                                            </button>
                                        </span>
                                    </div>
                                </div>
                                <!-- Script Show/Hide Password -->
                                <script>
                                    function togglePassword(fieldId) {
                                        const input = document.getElementById(fieldId);
                                        const icon = document.getElementById("icon-" + fieldId);
                                        if (input.type === "password") {
                                            input.type = "text";
                                            icon.classList.remove("fa-eye");
                                            icon.classList.add("fa-eye-slash");
                                        } else {
                                            input.type = "password";
                                            icon.classList.remove("fa-eye-slash");
                                            icon.classList.add("fa-eye");
                                        }
                                    }
                                </script>

                                <!-- Tombol Simpan -->
                                <div class="form-group text-right">
                                    <a href="../dashboard/" class="btn btn-default">Batal</a>
                                    <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </form>
                        </div>
                        <div class="box-footer"></div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <?php
}
include('../part/footer.php');
?>