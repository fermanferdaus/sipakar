-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 28, 2025 at 10:58 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_sipakar`
--

-- --------------------------------------------------------

--
-- Table structure for table `dusun`
--

CREATE TABLE `dusun` (
  `id_dusun` int(11) NOT NULL,
  `nama_dusun` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dusun`
--

INSERT INTO `dusun` (`id_dusun`, `nama_dusun`) VALUES
(1, 'Pagar Induk'),
(2, 'Kampung Baru'),
(3, 'Talang Pagar'),
(4, 'Pagar Baru');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id` int(11) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `username` varchar(15) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(32) NOT NULL,
  `level` varchar(10) NOT NULL,
  `foto_profil` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `nama`, `username`, `email`, `password`, `level`, `foto_profil`) VALUES
(1, 'Administrator', 'admin', 'admin@desa.id', '21232f297a57a5a743894a0e4a801fc3', 'admin', '1751033205_685ea575c5894.png'),
(2, 'Kepala Desa', 'kades', 'kepaladesa@desa.id', '0cfa66469d25bd0d9e55d7ba583f9f2f', 'kades', '1751034222_685ea96e38661.png'),
(3, 'Ferman Ferdaus', 'ferman', 'admin@gmail.com', 'd2d070cf081cedfd1271754500948792', 'user', '1751046380_685ed8ec5dfd0.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `pejabat_desa`
--

CREATE TABLE `pejabat_desa` (
  `id_pejabat_desa` int(11) NOT NULL,
  `nama_pejabat_desa` varchar(50) NOT NULL,
  `jabatan` varchar(20) NOT NULL,
  `foto` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pejabat_desa`
--

INSERT INTO `pejabat_desa` (`id_pejabat_desa`, `nama_pejabat_desa`, `jabatan`, `foto`) VALUES
(1, 'ADI SOPYAN', 'Kepala Desa', '1751096088_Daco_1062754.png'),
(2, 'MASYHUR KUMAR', 'Pj Kepala Desa', NULL),
(3, 'CHIKO DASMIRA', 'Bendahara', NULL),
(4, 'DONNY ALENDRA', 'OPERATOR SISK-NG', NULL),
(5, 'RINI SAFITRI', 'OPERATOR SISKUEDES', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `penduduk`
--

CREATE TABLE `penduduk` (
  `id_penduduk` int(11) NOT NULL,
  `nik` varchar(20) DEFAULT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `tempat_lahir` varchar(50) DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `jenis_kelamin` varchar(15) DEFAULT NULL,
  `agama` varchar(15) DEFAULT NULL,
  `jalan` varchar(100) DEFAULT NULL,
  `dusun` varchar(50) DEFAULT NULL,
  `rt` varchar(5) DEFAULT NULL,
  `rw` varchar(5) DEFAULT NULL,
  `desa` varchar(50) DEFAULT NULL,
  `kecamatan` varchar(50) DEFAULT NULL,
  `kota` varchar(50) DEFAULT NULL,
  `no_kk` varchar(20) DEFAULT NULL,
  `pend_kk` varchar(25) DEFAULT NULL,
  `pend_terakhir` varchar(25) DEFAULT NULL,
  `pend_ditempuh` varchar(20) DEFAULT NULL,
  `pekerjaan` varchar(50) DEFAULT NULL,
  `status_perkawinan` varchar(20) DEFAULT NULL,
  `status_dlm_keluarga` varchar(20) DEFAULT NULL,
  `kewarganegaraan` varchar(10) DEFAULT NULL,
  `nama_ayah` varchar(100) DEFAULT NULL,
  `nama_ibu` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `penduduk`
--

INSERT INTO `penduduk` (`id_penduduk`, `nik`, `nama`, `tempat_lahir`, `tgl_lahir`, `jenis_kelamin`, `agama`, `jalan`, `dusun`, `rt`, `rw`, `desa`, `kecamatan`, `kota`, `no_kk`, `pend_kk`, `pend_terakhir`, `pend_ditempuh`, `pekerjaan`, `status_perkawinan`, `status_dlm_keluarga`, `kewarganegaraan`, `nama_ayah`, `nama_ibu`) VALUES
(1, '12345', 'FERMAN OKU', 'OKU', '2003-11-12', 'Laki-laki', 'Islam', 'semar', 'Kampung Baru', '001', '001', 'Pager', 'Bambangan Pager', 'Kabupaten Lampung Utara', '123456', 'S1/SEDERAJAT', 'S1/SEDERAJAT', 'S1/SEDERAJAT', 'PELAJAR/MAHASISWA', 'Belum Menikah', 'Anak', 'WNI', 'e', 'e');

-- --------------------------------------------------------

--
-- Table structure for table `pengumuman`
--

CREATE TABLE `pengumuman` (
  `id_pengumuman` int(11) NOT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `judul` varchar(255) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `tanggal` date DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pengumuman`
--

INSERT INTO `pengumuman` (`id_pengumuman`, `gambar`, `judul`, `keterangan`, `tanggal`) VALUES
(5, '1751034122_1751022508_Desain_Arsitektur_Alat_page-0001.jpg', 'Kades Baru', 'Adi Sopyan', '2025-06-27'),
(6, '1751045975_download LOGO Universitas Teknokrat PNG.png', 'apaaja', 'asasasaasa', '2025-06-28');

-- --------------------------------------------------------

--
-- Table structure for table `profil_desa`
--

CREATE TABLE `profil_desa` (
  `id_profil_desa` int(11) NOT NULL,
  `nama_desa` varchar(50) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `no_telpon` varchar(20) NOT NULL,
  `kecamatan` varchar(50) NOT NULL,
  `kota` varchar(50) NOT NULL,
  `provinsi` varchar(20) NOT NULL,
  `kode_pos` varchar(10) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `gambar_desa` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `profil_desa`
--

INSERT INTO `profil_desa` (`id_profil_desa`, `nama_desa`, `alamat`, `no_telpon`, `kecamatan`, `kota`, `provinsi`, `kode_pos`, `deskripsi`, `gambar_desa`) VALUES
(1, 'pagar', 'Jln. Lintas Sumatera, Kecamatan Blambangan Pagar, Kabupaten Lampung Utara, Provinsi Lampung.', '082330827777', 'Blambangan Pagar', 'kabupaten Lampung Utara', 'Lampung', '34161 ', 'Desa Pagar, Blambangan Pagar, Lampung Utara adalah sebuah desa di Kecamatan Blambangan Pagar, Kabupaten Lampung Utara, Provinsi Lampung, Indonesia.', 'Background.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `sk_ahli_waris`
--

CREATE TABLE `sk_ahli_waris` (
  `id_aw` int(11) NOT NULL,
  `jenis_surat` varchar(255) NOT NULL,
  `no_surat` varchar(255) DEFAULT NULL,
  `nik` varchar(20) NOT NULL,
  `status_kuasa` varchar(255) NOT NULL,
  `nama_aw` varchar(255) NOT NULL,
  `tempat_lahir_aw` varchar(255) NOT NULL,
  `tgl_lahir_aw` date NOT NULL,
  `pekerjaan_aw` varchar(255) DEFAULT NULL,
  `jalan_aw` varchar(255) DEFAULT NULL,
  `dusun_aw` varchar(255) DEFAULT NULL,
  `rt_aw` varchar(10) DEFAULT NULL,
  `rw_aw` varchar(10) DEFAULT NULL,
  `desa_aw` varchar(255) DEFAULT NULL,
  `kecamatan_aw` varchar(255) DEFAULT NULL,
  `kabupaten_aw` varchar(255) DEFAULT NULL,
  `status_aw` varchar(50) DEFAULT NULL,
  `status_surat` varchar(15) NOT NULL,
  `tanggal_surat` datetime NOT NULL DEFAULT current_timestamp(),
  `id_pejabat_desa` int(11) DEFAULT NULL,
  `id_profil_desa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sk_ahli_waris`
--

INSERT INTO `sk_ahli_waris` (`id_aw`, `jenis_surat`, `no_surat`, `nik`, `status_kuasa`, `nama_aw`, `tempat_lahir_aw`, `tgl_lahir_aw`, `pekerjaan_aw`, `jalan_aw`, `dusun_aw`, `rt_aw`, `rw_aw`, `desa_aw`, `kecamatan_aw`, `kabupaten_aw`, `status_aw`, `status_surat`, `tanggal_surat`, `id_pejabat_desa`, `id_profil_desa`) VALUES
(6, 'Surat Keterangan Ahli Waris', '593 / PGR / 010 / I / 2018', '12345', 'Anak', 'Wiyono', 'Palembang', '2025-06-01', 'Petani', 'Jl. Semar', 'Pagar Induk', '001', '001', 'pagar', 'Blambangan Pagar', 'Lampung Utara', 'Ayah', 'SELESAI', '2025-06-21 01:04:06', 2, 1),
(7, 'Surat Keterangan Ahli Waris', NULL, '12345', 'Anak', 'Wiyono', 'Lampung', '2025-06-28', 'Petani', 'Jl. Semar', 'Pagar Baru', '001', '001', 'pagar', 'Blambangan Pagar', 'Lampung Utara', 'Ayah', 'PENDING', '2025-06-28 03:46:02', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sk_gangguan_jiwa`
--

CREATE TABLE `sk_gangguan_jiwa` (
  `id_gj` int(11) NOT NULL,
  `jenis_surat` varchar(100) NOT NULL,
  `no_surat` varchar(100) DEFAULT NULL,
  `nik` varchar(20) NOT NULL,
  `tanggal_surat` datetime NOT NULL DEFAULT current_timestamp(),
  `id_pejabat_desa` int(11) DEFAULT NULL,
  `status_surat` varchar(50) DEFAULT NULL,
  `id_profil_desa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sk_gangguan_jiwa`
--

INSERT INTO `sk_gangguan_jiwa` (`id_gj`, `jenis_surat`, `no_surat`, `nik`, `tanggal_surat`, `id_pejabat_desa`, `status_surat`, `id_profil_desa`) VALUES
(1, 'Surat Keterangan Gangguan Jiwa', '472.41/PGR/ 004 / I / 2025', '12345', '2025-06-23 00:00:00', 1, 'SELESAI', 1),
(2, 'Surat Keterangan Gangguan Jiwa', NULL, '12345', '2025-06-28 04:00:26', NULL, 'PENDING', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sk_jual_beli`
--

CREATE TABLE `sk_jual_beli` (
  `id_jb` int(11) NOT NULL,
  `jenis_surat` varchar(100) DEFAULT NULL,
  `nik` varchar(20) DEFAULT NULL,
  `nama_penjual` varchar(100) DEFAULT NULL,
  `umur_penjual` int(11) DEFAULT NULL,
  `pekerjaan_penjual` varchar(100) DEFAULT NULL,
  `alamat_penjual` text DEFAULT NULL,
  `hari_transaksi` varchar(20) DEFAULT NULL,
  `tanggal_transaksi` date DEFAULT NULL,
  `kategori_tanah` varchar(100) DEFAULT NULL,
  `luas_tanah` float DEFAULT NULL,
  `ukuran_tanah` varchar(50) DEFAULT NULL,
  `lokasi_tanah` text DEFAULT NULL,
  `harga_tanah` varchar(200) DEFAULT NULL,
  `batas_utara` varchar(100) DEFAULT NULL,
  `batas_selatan` varchar(100) DEFAULT NULL,
  `batas_timur` varchar(100) DEFAULT NULL,
  `batas_barat` varchar(100) DEFAULT NULL,
  `jumlah_saksi` int(11) DEFAULT NULL,
  `nama_saksi1` varchar(100) DEFAULT NULL,
  `alamat_saksi1` varchar(255) DEFAULT NULL,
  `nama_saksi2` varchar(100) DEFAULT NULL,
  `alamat_saksi2` varchar(255) DEFAULT NULL,
  `nama_saksi3` varchar(100) DEFAULT NULL,
  `alamat_saksi3` varchar(255) DEFAULT NULL,
  `nama_saksi4` varchar(100) DEFAULT NULL,
  `alamat_saksi4` varchar(255) DEFAULT NULL,
  `nama_saksi5` varchar(100) DEFAULT NULL,
  `alamat_saksi5` varchar(255) DEFAULT NULL,
  `tanggal_surat` datetime DEFAULT current_timestamp(),
  `id_pejabat_desa` int(11) DEFAULT NULL,
  `status_surat` varchar(20) DEFAULT NULL,
  `id_profil_desa` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sk_jual_beli`
--

INSERT INTO `sk_jual_beli` (`id_jb`, `jenis_surat`, `nik`, `nama_penjual`, `umur_penjual`, `pekerjaan_penjual`, `alamat_penjual`, `hari_transaksi`, `tanggal_transaksi`, `kategori_tanah`, `luas_tanah`, `ukuran_tanah`, `lokasi_tanah`, `harga_tanah`, `batas_utara`, `batas_selatan`, `batas_timur`, `batas_barat`, `jumlah_saksi`, `nama_saksi1`, `alamat_saksi1`, `nama_saksi2`, `alamat_saksi2`, `nama_saksi3`, `alamat_saksi3`, `nama_saksi4`, `alamat_saksi4`, `nama_saksi5`, `alamat_saksi5`, `tanggal_surat`, `id_pejabat_desa`, `status_surat`, `id_profil_desa`) VALUES
(5, 'Surat Keterangan Jual Beli', '12345', 'Paijo', 65, 'Petani', 'RT/RW. 01 / 04  Desa Pagar  Kec. Blambangan Pagar  Kab. Lampung Utara', 'Kamis', '2025-06-26', 'Pekarangan', 1050, '15 m x 70 m', 'RT/RW. 01 / 04  Desa Pagar  Kec. Blambangan Pagar  Kab. Lampung Utara', 'Rp 30.000.000', 'Jalan Dusun', 'Tanah Ekwandi', 'Tanah Maryono', 'Tanah Sugeng', 4, 'WAGIMIN', 'Kadus 04', 'SUTAMI ', 'RT 01', 'SUGENG    ', '', 'MARYONO', '', '', '', '2025-06-26 01:48:14', 1, 'SELESAI', 1),
(6, 'Surat Keterangan Jual Beli', '12345', 'rere', 50, 'petani', 'sddsdssd', 'qwqw', '2025-06-28', 'dsdsds', 1050, '15 m x 70 m', 'rt01', 'Rp 35.000.000', 'sasa', 'asas', 'dsd', 'asas', 2, 'wew', '', 'ewew', '', '', '', '', '', '', '', '2025-06-28 04:20:37', NULL, 'PENDING', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sk_kehilangan`
--

CREATE TABLE `sk_kehilangan` (
  `id_kh` int(11) NOT NULL,
  `jenis_surat` varchar(100) NOT NULL,
  `no_surat` varchar(50) DEFAULT NULL,
  `nik` varchar(20) NOT NULL,
  `barang_hilang` varchar(255) NOT NULL,
  `hari` varchar(15) NOT NULL,
  `tanggal_kehilangan` date NOT NULL,
  `jam_kehilangan` time NOT NULL,
  `tempat_kehilangan` varchar(255) NOT NULL,
  `tanggal_surat` timestamp NOT NULL DEFAULT current_timestamp(),
  `id_pejabat_desa` int(11) DEFAULT NULL,
  `status_surat` varchar(50) DEFAULT NULL,
  `id_profil_desa` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sk_kehilangan`
--

INSERT INTO `sk_kehilangan` (`id_kh`, `jenis_surat`, `no_surat`, `nik`, `barang_hilang`, `hari`, `tanggal_kehilangan`, `jam_kehilangan`, `tempat_kehilangan`, `tanggal_surat`, `id_pejabat_desa`, `status_surat`, `id_profil_desa`) VALUES
(1, 'Surat Keterangan Kehilangan', '730/PGR/007/II/2025', '12345', 'motor Beat Deluxe', 'MInggu', '2025-06-22', '22:53:00', 'Kosan', '2025-06-22 15:53:56', 1, 'SELESAI', 1),
(2, 'Surat Keterangan Kehilangan', NULL, '12345', 'motor Beat Deluxe', 'MInggu', '2025-06-23', '08:59:00', 'Kosan', '2025-06-27 21:57:26', NULL, 'PENDING', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sk_kematian`
--

CREATE TABLE `sk_kematian` (
  `id_m` int(11) NOT NULL,
  `jenis_surat` varchar(100) NOT NULL,
  `no_surat` varchar(100) DEFAULT NULL,
  `nik` varchar(20) NOT NULL,
  `hari_m` varchar(20) NOT NULL,
  `tgl_m` date NOT NULL,
  `tempat_m` varchar(100) NOT NULL,
  `penyebab_m` text NOT NULL,
  `ortu_m` varchar(100) NOT NULL,
  `pasangan_m` varchar(100) NOT NULL,
  `jumlah_anak` int(11) NOT NULL,
  `nama_anak_1` varchar(100) DEFAULT NULL,
  `nama_anak_2` varchar(100) DEFAULT NULL,
  `nama_anak_3` varchar(100) DEFAULT NULL,
  `nama_anak_4` varchar(100) DEFAULT NULL,
  `nama_anak_5` varchar(100) DEFAULT NULL,
  `nama_anak_6` varchar(100) DEFAULT NULL,
  `nama_anak_7` varchar(100) DEFAULT NULL,
  `nama_anak_8` varchar(100) DEFAULT NULL,
  `nama_anak_9` varchar(100) DEFAULT NULL,
  `nama_anak_10` varchar(100) DEFAULT NULL,
  `tanggal_surat` datetime NOT NULL DEFAULT current_timestamp(),
  `id_pejabat_desa` int(11) DEFAULT NULL,
  `status_surat` varchar(20) DEFAULT NULL,
  `id_profil_desa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sk_kematian`
--

INSERT INTO `sk_kematian` (`id_m`, `jenis_surat`, `no_surat`, `nik`, `hari_m`, `tgl_m`, `tempat_m`, `penyebab_m`, `ortu_m`, `pasangan_m`, `jumlah_anak`, `nama_anak_1`, `nama_anak_2`, `nama_anak_3`, `nama_anak_4`, `nama_anak_5`, `nama_anak_6`, `nama_anak_7`, `nama_anak_8`, `nama_anak_9`, `nama_anak_10`, `tanggal_surat`, `id_pejabat_desa`, `status_surat`, `id_profil_desa`) VALUES
(2, 'Surat Keterangan Kematian', '472.12/ PGR /094/VII/ 2018', '12345', 'Selasa', '2025-06-24', 'Kuburan', 'Sakit', 'Sutrisno', 'Ica', 2, 'Paijo', 'Paijan', '', '', '', '', '', '', '', '', '2025-06-24 20:49:40', 2, 'SELESAI', 1),
(3, 'Surat Keterangan Kematian', NULL, '12345', 'Jumat', '2025-06-28', 'dimanamana', 'sakit hati', 'wagino', 'muji', 2, 'hadi', 'yusuf', '', '', '', '', '', '', '', '', '2025-06-28 05:04:11', NULL, 'PENDING', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sk_kuasa`
--

CREATE TABLE `sk_kuasa` (
  `id_kuasa` int(11) NOT NULL,
  `jenis_surat` varchar(100) DEFAULT NULL,
  `nik` varchar(20) DEFAULT NULL,
  `nama_kuasa` varchar(100) DEFAULT NULL,
  `jenis_kelamin_kuasa` varchar(20) DEFAULT NULL,
  `kewarganegaraan_kuasa` varchar(50) DEFAULT NULL,
  `alamat_kuasa` varchar(255) DEFAULT NULL,
  `kondisi_pihak1` varchar(255) DEFAULT NULL,
  `keterangan_kuasa` varchar(255) DEFAULT NULL,
  `tanggal_surat` datetime DEFAULT current_timestamp(),
  `id_pejabat_desa` int(11) DEFAULT NULL,
  `status_surat` varchar(20) DEFAULT NULL,
  `id_profil_desa` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sk_kuasa`
--

INSERT INTO `sk_kuasa` (`id_kuasa`, `jenis_surat`, `nik`, `nama_kuasa`, `jenis_kelamin_kuasa`, `kewarganegaraan_kuasa`, `alamat_kuasa`, `kondisi_pihak1`, `keterangan_kuasa`, `tanggal_surat`, `id_pejabat_desa`, `status_surat`, `id_profil_desa`) VALUES
(1, 'Surat Kuasa', '12345', 'Medy', 'Laki-laki', 'WNI', 'Kotabumi, Lampung Utara', 'sakit', 'mengurus obat', '2025-06-25 22:04:32', 1, 'SELESAI', 1),
(2, 'Surat Kuasa', '12345', 'assa', 'Laki-laki', 'WNI', 'saasadefdscx', 'weewds', 'dsdsd', '2025-06-28 05:08:58', NULL, 'PENDING', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sk_pengantar_skck`
--

CREATE TABLE `sk_pengantar_skck` (
  `id_sps` int(11) NOT NULL,
  `jenis_surat` varchar(50) NOT NULL,
  `no_surat` varchar(20) DEFAULT NULL,
  `nik` varchar(20) NOT NULL,
  `keperluan` varchar(50) NOT NULL,
  `tanggal_surat` datetime DEFAULT current_timestamp(),
  `id_pejabat_desa` int(11) DEFAULT NULL,
  `status_surat` varchar(15) NOT NULL,
  `id_profil_desa` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sk_pengantar_skck`
--

INSERT INTO `sk_pengantar_skck` (`id_sps`, `jenis_surat`, `no_surat`, `nik`, `keperluan`, `tanggal_surat`, `id_pejabat_desa`, `status_surat`, `id_profil_desa`) VALUES
(1, 'Surat Pengantar SKCK', '471.11/PGR/00/IV/202', '12345', 'Melamar Pekerjaan', '2025-06-24 11:23:48', 1, 'SELESAI', 1),
(2, 'Surat Pengantar SKCK', NULL, '12345', 'Melamar Pekerjaan ', '2025-06-28 05:17:25', NULL, 'PENDING', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sk_penghasilan_orang_tua`
--

CREATE TABLE `sk_penghasilan_orang_tua` (
  `id_pot` int(11) NOT NULL,
  `nik` varchar(20) NOT NULL,
  `no_surat` varchar(50) DEFAULT NULL,
  `jenis_surat` varchar(100) NOT NULL,
  `penghasilan` varchar(100) NOT NULL,
  `tanggungan` int(11) DEFAULT NULL,
  `nama_pot` varchar(100) NOT NULL,
  `tempat_lahir_pot` varchar(100) NOT NULL,
  `tgl_lahir_pot` date NOT NULL,
  `prodi` varchar(100) NOT NULL,
  `hubungan_keluarga` varchar(100) NOT NULL,
  `keperluan` varchar(255) NOT NULL,
  `tanggal_surat` datetime DEFAULT current_timestamp(),
  `id_pejabat_desa` int(11) DEFAULT NULL,
  `status_surat` varchar(50) DEFAULT NULL,
  `id_profil_desa` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sk_penghasilan_orang_tua`
--

INSERT INTO `sk_penghasilan_orang_tua` (`id_pot`, `nik`, `no_surat`, `jenis_surat`, `penghasilan`, `tanggungan`, `nama_pot`, `tempat_lahir_pot`, `tgl_lahir_pot`, `prodi`, `hubungan_keluarga`, `keperluan`, `tanggal_surat`, `id_pejabat_desa`, `status_surat`, `id_profil_desa`) VALUES
(3, '12345', '474.11/PGR /    /V I / 2025', 'Surat Keterangan Penghasilan Orang Tua', 'Rp 10.000.000', 1, 'Budi', 'Kolong Jembatan', '2025-06-01', 'Teknik Komputer', 'Anak', 'syarat Daftar Ulang SNBT di ITERA Tahun 2025', '2025-06-24 00:30:49', 1, 'SELESAI', 1),
(4, '12345', NULL, 'Surat Keterangan Penghasilan Orang Tua', 'Rp 2.000.000', 2, 'dsaa', 'sds', '2025-06-28', 'dsd', 'sd', 'dssd', '2025-06-28 05:20:10', NULL, 'PENDING', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sk_tidak_mampu`
--

CREATE TABLE `sk_tidak_mampu` (
  `id_tm` int(11) NOT NULL,
  `nik` varchar(20) NOT NULL,
  `no_surat` varchar(50) DEFAULT NULL,
  `jenis_surat` varchar(100) NOT NULL,
  `keperluan` varchar(255) NOT NULL,
  `nama_tm` varchar(100) NOT NULL,
  `tempat_lahir_tm` varchar(100) NOT NULL,
  `tgl_lahir_tm` date NOT NULL,
  `pekerjaan_tm` varchar(100) NOT NULL,
  `jalan_tm` varchar(100) NOT NULL,
  `rt_tm` varchar(5) NOT NULL,
  `rw_tm` varchar(5) NOT NULL,
  `dusun_tm` varchar(100) NOT NULL,
  `desa_tm` varchar(100) NOT NULL,
  `kecamatan_tm` varchar(100) NOT NULL,
  `kabupaten_tm` varchar(100) NOT NULL,
  `agama_tm` varchar(100) NOT NULL,
  `kewarganegaraan_tm` varchar(50) NOT NULL,
  `tanggal_surat` datetime NOT NULL DEFAULT current_timestamp(),
  `id_pejabat_desa` int(11) DEFAULT NULL,
  `status_surat` varchar(50) DEFAULT NULL,
  `id_profil_desa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sk_tidak_mampu`
--

INSERT INTO `sk_tidak_mampu` (`id_tm`, `nik`, `no_surat`, `jenis_surat`, `keperluan`, `nama_tm`, `tempat_lahir_tm`, `tgl_lahir_tm`, `pekerjaan_tm`, `jalan_tm`, `rt_tm`, `rw_tm`, `dusun_tm`, `desa_tm`, `kecamatan_tm`, `kabupaten_tm`, `agama_tm`, `kewarganegaraan_tm`, `tanggal_surat`, `id_pejabat_desa`, `status_surat`, `id_profil_desa`) VALUES
(1, '12345', '470 /PGR/ 249 /VII/2024', 'Surat Keterangan Tidak Mampu', 'Mendaftar Kuliah', 'Ratu Aulia', 'Kalibalangan', '2025-05-31', 'Belum Bekerja', 'jalan Jalan', '001', '001', 'Pagar Induk', 'Pagar', 'Blambangan Pagar', 'Lampung Utara', 'Islam', 'WNI', '2025-06-23 22:06:36', 1, 'SELESAI', 1),
(2, '12345', NULL, 'Surat Keterangan Tidak Mampu', 'syarat Daftar Ulang SNBT di ITERA Tahun 2025', 'Ratu Aulia', 'Kalibalangan', '2025-06-28', 'Belum Bekerja', 'jalan Jalan', '001', '001', 'Kampung Baru', 'Pagar', 'Blambangan Pagar', 'Lampung Utara', 'Islam', '', '2025-06-28 05:25:05', NULL, 'PENDING', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sk_usaha`
--

CREATE TABLE `sk_usaha` (
  `id_u` int(11) NOT NULL,
  `jenis_surat` varchar(100) NOT NULL,
  `no_surat` varchar(100) DEFAULT NULL,
  `nik` varchar(20) NOT NULL,
  `jumlah_usaha` int(11) NOT NULL,
  `jenis_usaha_1` varchar(100) DEFAULT NULL,
  `jenis_usaha_2` varchar(100) DEFAULT NULL,
  `jenis_usaha_3` varchar(100) DEFAULT NULL,
  `jenis_usaha_4` varchar(100) DEFAULT NULL,
  `jenis_usaha_5` varchar(100) DEFAULT NULL,
  `tanggal_surat` datetime NOT NULL DEFAULT current_timestamp(),
  `id_pejabat_desa` int(11) DEFAULT NULL,
  `status_surat` varchar(50) DEFAULT NULL,
  `id_profil_desa` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sk_usaha`
--

INSERT INTO `sk_usaha` (`id_u`, `jenis_surat`, `no_surat`, `nik`, `jumlah_usaha`, `jenis_usaha_1`, `jenis_usaha_2`, `jenis_usaha_3`, `jenis_usaha_4`, `jenis_usaha_5`, `tanggal_surat`, `id_pejabat_desa`, `status_surat`, `id_profil_desa`) VALUES
(2, 'Surat Keterangan Usaha', '504 / PGR / 00 / VII /2023', '12345', 2, 'KEBUN  SINGKONG ', 'PANGKAS RAMBUT', '', '', '', '2025-06-24 15:07:48', 1, 'SELESAI', 1),
(3, 'Surat Keterangan Usaha', NULL, '12345', 2, 'KEBUN  SINGKONG ', 'PANGKAS RAMBUT', '', '', '', '2025-06-28 05:27:07', NULL, 'PENDING', 1);

-- --------------------------------------------------------

--
-- Table structure for table `surat_keterangan_domisili`
--

CREATE TABLE `surat_keterangan_domisili` (
  `id_skd` int(11) NOT NULL,
  `jenis_surat` varchar(50) NOT NULL,
  `no_surat` varchar(20) DEFAULT NULL,
  `nik` varchar(20) NOT NULL,
  `tanggal_surat` datetime DEFAULT current_timestamp(),
  `id_pejabat_desa` int(11) DEFAULT NULL,
  `status_surat` varchar(15) NOT NULL,
  `id_profil_desa` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `surat_keterangan_domisili`
--

INSERT INTO `surat_keterangan_domisili` (`id_skd`, `jenis_surat`, `no_surat`, `nik`, `tanggal_surat`, `id_pejabat_desa`, `status_surat`, `id_profil_desa`) VALUES
(1, 'Surat Keterangan Domisili', '593 / PGR / 010 / I', '12345', '2025-06-21 01:11:12', 1, 'SELESAI', 1),
(2, 'Surat Keterangan Domisili', NULL, '12345', '2025-06-27 21:28:00', NULL, 'ditolak', 1),
(5, 'Surat Keterangan Domisili', NULL, '12345', '2025-06-28 03:57:00', NULL, 'PENDING', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dusun`
--
ALTER TABLE `dusun`
  ADD PRIMARY KEY (`id_dusun`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pejabat_desa`
--
ALTER TABLE `pejabat_desa`
  ADD PRIMARY KEY (`id_pejabat_desa`);

--
-- Indexes for table `penduduk`
--
ALTER TABLE `penduduk`
  ADD PRIMARY KEY (`id_penduduk`),
  ADD UNIQUE KEY `nik` (`nik`);

--
-- Indexes for table `pengumuman`
--
ALTER TABLE `pengumuman`
  ADD PRIMARY KEY (`id_pengumuman`);

--
-- Indexes for table `profil_desa`
--
ALTER TABLE `profil_desa`
  ADD PRIMARY KEY (`id_profil_desa`);

--
-- Indexes for table `sk_ahli_waris`
--
ALTER TABLE `sk_ahli_waris`
  ADD PRIMARY KEY (`id_aw`),
  ADD KEY `id_pejabat_desa` (`id_pejabat_desa`),
  ADD KEY `id_profil_desa` (`id_profil_desa`);

--
-- Indexes for table `sk_gangguan_jiwa`
--
ALTER TABLE `sk_gangguan_jiwa`
  ADD PRIMARY KEY (`id_gj`),
  ADD KEY `id_pejabat_desa` (`id_pejabat_desa`),
  ADD KEY `id_profil_desa` (`id_profil_desa`);

--
-- Indexes for table `sk_jual_beli`
--
ALTER TABLE `sk_jual_beli`
  ADD PRIMARY KEY (`id_jb`),
  ADD KEY `id_pejabat_desa` (`id_pejabat_desa`),
  ADD KEY `id_profil_desa` (`id_profil_desa`);

--
-- Indexes for table `sk_kehilangan`
--
ALTER TABLE `sk_kehilangan`
  ADD PRIMARY KEY (`id_kh`),
  ADD KEY `id_pejabat_desa` (`id_pejabat_desa`),
  ADD KEY `id_profil_desa` (`id_profil_desa`);

--
-- Indexes for table `sk_kematian`
--
ALTER TABLE `sk_kematian`
  ADD PRIMARY KEY (`id_m`),
  ADD KEY `id_pejabat_desa` (`id_pejabat_desa`),
  ADD KEY `id_profil_desa` (`id_profil_desa`);

--
-- Indexes for table `sk_kuasa`
--
ALTER TABLE `sk_kuasa`
  ADD PRIMARY KEY (`id_kuasa`),
  ADD KEY `id_pejabat_desa` (`id_pejabat_desa`),
  ADD KEY `id_profil_desa` (`id_profil_desa`);

--
-- Indexes for table `sk_pengantar_skck`
--
ALTER TABLE `sk_pengantar_skck`
  ADD PRIMARY KEY (`id_sps`),
  ADD KEY `id_pejabat_desa` (`id_pejabat_desa`),
  ADD KEY `id_profil_desa` (`id_profil_desa`);

--
-- Indexes for table `sk_penghasilan_orang_tua`
--
ALTER TABLE `sk_penghasilan_orang_tua`
  ADD PRIMARY KEY (`id_pot`),
  ADD KEY `id_pejabat_desa` (`id_pejabat_desa`),
  ADD KEY `id_profil_desa` (`id_profil_desa`);

--
-- Indexes for table `sk_tidak_mampu`
--
ALTER TABLE `sk_tidak_mampu`
  ADD PRIMARY KEY (`id_tm`),
  ADD KEY `id_pejabat_desa` (`id_pejabat_desa`),
  ADD KEY `id_profil_desa` (`id_profil_desa`);

--
-- Indexes for table `sk_usaha`
--
ALTER TABLE `sk_usaha`
  ADD PRIMARY KEY (`id_u`),
  ADD KEY `id_pejabat_desa` (`id_pejabat_desa`),
  ADD KEY `id_profil_desa` (`id_profil_desa`);

--
-- Indexes for table `surat_keterangan_domisili`
--
ALTER TABLE `surat_keterangan_domisili`
  ADD PRIMARY KEY (`id_skd`),
  ADD KEY `id_pejabat_desa` (`id_pejabat_desa`),
  ADD KEY `id_profil_desa` (`id_profil_desa`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dusun`
--
ALTER TABLE `dusun`
  MODIFY `id_dusun` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pejabat_desa`
--
ALTER TABLE `pejabat_desa`
  MODIFY `id_pejabat_desa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `penduduk`
--
ALTER TABLE `penduduk`
  MODIFY `id_penduduk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pengumuman`
--
ALTER TABLE `pengumuman`
  MODIFY `id_pengumuman` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `profil_desa`
--
ALTER TABLE `profil_desa`
  MODIFY `id_profil_desa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sk_ahli_waris`
--
ALTER TABLE `sk_ahli_waris`
  MODIFY `id_aw` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `sk_gangguan_jiwa`
--
ALTER TABLE `sk_gangguan_jiwa`
  MODIFY `id_gj` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sk_jual_beli`
--
ALTER TABLE `sk_jual_beli`
  MODIFY `id_jb` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `sk_kehilangan`
--
ALTER TABLE `sk_kehilangan`
  MODIFY `id_kh` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sk_kematian`
--
ALTER TABLE `sk_kematian`
  MODIFY `id_m` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sk_kuasa`
--
ALTER TABLE `sk_kuasa`
  MODIFY `id_kuasa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sk_pengantar_skck`
--
ALTER TABLE `sk_pengantar_skck`
  MODIFY `id_sps` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sk_penghasilan_orang_tua`
--
ALTER TABLE `sk_penghasilan_orang_tua`
  MODIFY `id_pot` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sk_tidak_mampu`
--
ALTER TABLE `sk_tidak_mampu`
  MODIFY `id_tm` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sk_usaha`
--
ALTER TABLE `sk_usaha`
  MODIFY `id_u` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `surat_keterangan_domisili`
--
ALTER TABLE `surat_keterangan_domisili`
  MODIFY `id_skd` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `sk_ahli_waris`
--
ALTER TABLE `sk_ahli_waris`
  ADD CONSTRAINT `sk_ahli_waris_ibfk_1` FOREIGN KEY (`id_pejabat_desa`) REFERENCES `pejabat_desa` (`id_pejabat_desa`),
  ADD CONSTRAINT `sk_ahli_waris_ibfk_2` FOREIGN KEY (`id_profil_desa`) REFERENCES `profil_desa` (`id_profil_desa`);

--
-- Constraints for table `sk_gangguan_jiwa`
--
ALTER TABLE `sk_gangguan_jiwa`
  ADD CONSTRAINT `sk_gangguan_jiwa_ibfk_1` FOREIGN KEY (`id_pejabat_desa`) REFERENCES `pejabat_desa` (`id_pejabat_desa`),
  ADD CONSTRAINT `sk_gangguan_jiwa_ibfk_2` FOREIGN KEY (`id_profil_desa`) REFERENCES `profil_desa` (`id_profil_desa`);

--
-- Constraints for table `sk_jual_beli`
--
ALTER TABLE `sk_jual_beli`
  ADD CONSTRAINT `sk_jual_beli_ibfk_1` FOREIGN KEY (`id_pejabat_desa`) REFERENCES `pejabat_desa` (`id_pejabat_desa`),
  ADD CONSTRAINT `sk_jual_beli_ibfk_2` FOREIGN KEY (`id_profil_desa`) REFERENCES `profil_desa` (`id_profil_desa`);

--
-- Constraints for table `sk_kehilangan`
--
ALTER TABLE `sk_kehilangan`
  ADD CONSTRAINT `sk_kehilangan_ibfk_1` FOREIGN KEY (`id_pejabat_desa`) REFERENCES `pejabat_desa` (`id_pejabat_desa`),
  ADD CONSTRAINT `sk_kehilangan_ibfk_2` FOREIGN KEY (`id_profil_desa`) REFERENCES `profil_desa` (`id_profil_desa`);

--
-- Constraints for table `sk_kematian`
--
ALTER TABLE `sk_kematian`
  ADD CONSTRAINT `sk_kematian_ibfk_1` FOREIGN KEY (`id_pejabat_desa`) REFERENCES `pejabat_desa` (`id_pejabat_desa`),
  ADD CONSTRAINT `sk_kematian_ibfk_2` FOREIGN KEY (`id_profil_desa`) REFERENCES `profil_desa` (`id_profil_desa`);

--
-- Constraints for table `sk_kuasa`
--
ALTER TABLE `sk_kuasa`
  ADD CONSTRAINT `sk_kuasa_ibfk_1` FOREIGN KEY (`id_pejabat_desa`) REFERENCES `pejabat_desa` (`id_pejabat_desa`),
  ADD CONSTRAINT `sk_kuasa_ibfk_2` FOREIGN KEY (`id_profil_desa`) REFERENCES `profil_desa` (`id_profil_desa`);

--
-- Constraints for table `sk_pengantar_skck`
--
ALTER TABLE `sk_pengantar_skck`
  ADD CONSTRAINT `sk_pengantar_skck_ibfk_1` FOREIGN KEY (`id_pejabat_desa`) REFERENCES `pejabat_desa` (`id_pejabat_desa`),
  ADD CONSTRAINT `sk_pengantar_skck_ibfk_2` FOREIGN KEY (`id_profil_desa`) REFERENCES `profil_desa` (`id_profil_desa`);

--
-- Constraints for table `sk_penghasilan_orang_tua`
--
ALTER TABLE `sk_penghasilan_orang_tua`
  ADD CONSTRAINT `sk_penghasilan_orang_tua_ibfk_1` FOREIGN KEY (`id_pejabat_desa`) REFERENCES `pejabat_desa` (`id_pejabat_desa`),
  ADD CONSTRAINT `sk_penghasilan_orang_tua_ibfk_2` FOREIGN KEY (`id_profil_desa`) REFERENCES `profil_desa` (`id_profil_desa`);

--
-- Constraints for table `sk_tidak_mampu`
--
ALTER TABLE `sk_tidak_mampu`
  ADD CONSTRAINT `sk_tidak_mampu_ibfk_1` FOREIGN KEY (`id_pejabat_desa`) REFERENCES `pejabat_desa` (`id_pejabat_desa`),
  ADD CONSTRAINT `sk_tidak_mampu_ibfk_2` FOREIGN KEY (`id_profil_desa`) REFERENCES `profil_desa` (`id_profil_desa`);

--
-- Constraints for table `sk_usaha`
--
ALTER TABLE `sk_usaha`
  ADD CONSTRAINT `sk_usaha_ibfk_1` FOREIGN KEY (`id_pejabat_desa`) REFERENCES `pejabat_desa` (`id_pejabat_desa`),
  ADD CONSTRAINT `sk_usaha_ibfk_2` FOREIGN KEY (`id_profil_desa`) REFERENCES `profil_desa` (`id_profil_desa`);

--
-- Constraints for table `surat_keterangan_domisili`
--
ALTER TABLE `surat_keterangan_domisili`
  ADD CONSTRAINT `surat_keterangan_domisili_ibfk_1` FOREIGN KEY (`id_pejabat_desa`) REFERENCES `pejabat_desa` (`id_pejabat_desa`),
  ADD CONSTRAINT `surat_keterangan_domisili_ibfk_2` FOREIGN KEY (`id_profil_desa`) REFERENCES `profil_desa` (`id_profil_desa`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
