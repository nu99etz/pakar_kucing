-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 21, 2022 at 11:47 PM
-- Server version: 10.10.1-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pakar_dental`
--

-- --------------------------------------------------------

--
-- Table structure for table `certainly_factor`
--

CREATE TABLE `certainly_factor` (
  `id_certainly_factor` int(11) NOT NULL,
  `id_gejala` int(11) DEFAULT NULL,
  `id_penyakit` int(11) DEFAULT NULL,
  `mb_value` float DEFAULT NULL,
  `md_value` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `detail_konsultasi_gejala`
--

CREATE TABLE `detail_konsultasi_gejala` (
  `id_detail_konsultasi_gejala` int(11) NOT NULL,
  `id_konsultasi` int(11) DEFAULT NULL,
  `id_gejala` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `detail_konsultasi_penyakit`
--

CREATE TABLE `detail_konsultasi_penyakit` (
  `id_detail_konsultasi_penyakit` int(11) NOT NULL,
  `id_konsultasi` int(11) DEFAULT NULL,
  `id_penyakit` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `konsultasi`
--

CREATE TABLE `konsultasi` (
  `id_konsultasi` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `tanggal_konsultasi` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `konsultasi`
--

INSERT INTO `konsultasi` (`id_konsultasi`, `id_user`, `tanggal_konsultasi`) VALUES
(1, 1, '2022-10-28'),
(2, 1, '2022-10-28');

-- --------------------------------------------------------

--
-- Table structure for table `ms_gejala`
--

CREATE TABLE `ms_gejala` (
  `id_ms_gejala` int(11) NOT NULL,
  `id_ms_kategori_gejala` int(11) DEFAULT NULL,
  `kode_gejala` varchar(255) DEFAULT NULL,
  `nama_gejala` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ms_gejala`
--

INSERT INTO `ms_gejala` (`id_ms_gejala`, `id_ms_kategori_gejala`, `kode_gejala`, `nama_gejala`) VALUES
(1, 1, 'G01', 'Diam'),
(2, 1, 'G02', 'Makan'),
(3, 1, 'G03', 'Tidur'),
(4, 2, 'G04', 'Merah Bibir'),
(5, 2, 'G05', 'Pipi Dalam'),
(6, 2, 'G06', 'Bibir Atas'),
(7, 2, 'G07', 'Bibir Bawah'),
(8, 2, 'G08', 'Lidah'),
(9, 2, 'G09', 'Dasar Mulut'),
(10, 2, 'G10', 'Gusi'),
(11, 2, 'G11', 'Sudut Bibir'),
(12, 3, 'G12', 'Sariawan'),
(13, 3, 'G13', 'Bercak Merah'),
(14, 3, 'G14', 'Bercak  Putih'),
(15, 3, 'G15', 'Bercak Hitam'),
(16, 3, 'G16', 'Benjolan'),
(17, 3, 'G17', 'Celah'),
(18, 3, 'G18', 'Pebgelupasan'),
(19, 4, 'G19', '<3 Hari'),
(20, 4, 'G20', '<7 Hari'),
(21, 4, 'G21', '>7 Hari'),
(22, 5, 'G22', 'Ya'),
(23, 5, 'G23', 'Tidak'),
(24, 6, 'G24', 'Tergigit'),
(25, 6, 'G25', 'Alergi'),
(26, 6, 'G26', 'Tumpatan Gigi'),
(27, 6, 'G27', 'Auto Imun'),
(28, 6, 'G28', 'Obat'),
(29, 7, 'G29', 'DM'),
(30, 7, 'G30', 'Hipertensi'),
(31, 7, 'G31', 'Kanker'),
(32, 7, 'G32', 'Asma'),
(33, 7, 'G33', 'Gangguan Pencernaan'),
(34, 7, 'G34', 'Gangguan Darah'),
(35, 8, 'G35', 'Ya'),
(36, 8, 'G36', 'Tidak'),
(37, 9, 'G37', 'Ya'),
(38, 9, 'G38', 'Tidak'),
(39, 10, 'G39', 'Ya'),
(40, 10, 'G40', 'Tidak');

-- --------------------------------------------------------

--
-- Table structure for table `ms_kategori_gejala`
--

CREATE TABLE `ms_kategori_gejala` (
  `id_ms_kategori_gejala` int(11) NOT NULL,
  `nama_ms_kategori` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ms_kategori_gejala`
--

INSERT INTO `ms_kategori_gejala` (`id_ms_kategori_gejala`, `nama_ms_kategori`) VALUES
(1, 'Nyeri'),
(2, 'Lokasi'),
(3, 'Bentuk Kelainan'),
(4, 'Muncul Kapan'),
(5, 'Kambuhan'),
(6, 'Diketahui Penyebabnya'),
(7, 'Riwayat Kesehatan'),
(8, 'Pembengkakan'),
(9, 'Apakah Pernah Berdarah'),
(10, 'Apakah Ada Bercak Atau Kondisi Yang Sama Ditemukan Di Kulit '),
(11, 'Apakah Pernah Diobati');

-- --------------------------------------------------------

--
-- Table structure for table `ms_penyakit`
--

CREATE TABLE `ms_penyakit` (
  `id_ms_penyakit` int(11) NOT NULL,
  `kode_penyakit` varchar(255) DEFAULT NULL,
  `nama_penyakit` varchar(255) DEFAULT NULL,
  `solusi_penyakit` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ms_penyakit`
--

INSERT INTO `ms_penyakit` (`id_ms_penyakit`, `kode_penyakit`, `nama_penyakit`, `solusi_penyakit`) VALUES
(1, 'P01', 'RAS MAYOR', 'Dapat Mengoleskan Salep Kortikosteroid Topikal Triamcinolone Acetonide 0,1%, Obat Kumur Antiseptik Atau Air Garam, Menambah Asupan Nutrisi (buah Dan Sayur), Manajemen Stres (jika Perlu Dapat Berkonsultasi Ke Psikolog/psikiater), Tetap Rutin Gosok Gigi Dua Kali Sehari (sesudah Sarapan Dan Sebelum Tidur) Serta Kontrol Rutin 6 Bulan Sekali Ke Dokter Gigi'),
(2, 'P02', 'RAS Minor', 'Dapat Mengoleskan Salep Kortikosteroid Topikal Triamcinolone Acetonide 0,1%, Obat Kumur Antiseptik Atau Air Garam, Menambah Asupan Nutrisi (buah Dan Sayur), Manajemen Stres (jika Perlu Dapat Berkonsultasi Ke Psikolog/psikiater), Tetap Rutin Gosok Gigi Dua Kali Sehari (sesudah Sarapan Dan Sebelum Tidur) Serta Kontrol Rutin 6 Bulan Sekali Ke Dokter Gigi'),
(3, 'P03', 'RAS Herpetiformis', 'Dapat Mengoleskan Salep Kortikosteroid Topikal Triamcinolone Acetonide 0,1%, Obat Kumur Antiseptik Atau Air Garam, Menambah Asupan Nutrisi (buah Dan Sayur), Manajemen Stres (jika Perlu Dapat Berkonsultasi Ke Psikolog/psikiater), Tetap Rutin Gosok Gigi Dua Kali Sehari (sesudah Sarapan Dan Sebelum Tidur) Serta Kontrol Rutin 6 Bulan Sekali Ke Dokter Gigi'),
(4, 'P04', 'Kandidiasis', 'Konsumsi Obat Antijamur Seperti Nystatine, Ketoconazole, Miconazole, Atau Lainnya (harus Dengan Resep Dokter Gigi), Obat Kumur Antiseptik Atau Air Garam, Hindari Merokok, Kontrol Rutin Ke Dokter Jika Memiliki Riwayat Penyakit Lain, Tetap Rutin Gosok Gigi Dan Lidah Dua Kali Sehari (sesudah Sarapan Dan Sebelum Tidur) Serta Kontrol Rutin 6 Bulan Sekali Ke Dokter Gigi Atau Dokter Gigi Spesialis Penyakit Mulut'),
(5, 'P05', 'Parotitis', 'Konsumsi Obat Penurun Demam Seperti Paracetamol Atau Ibuprofen, Konsumsi Air Putih Yang Banyak Untuk Menghindari Dehidrasi Akibat Demam, Istirahat Yang Cukup, Makan Makanan Yang Lembut (bubur), Menambah Asupan Nutrisi (buah Dan Sayur), Kompres Pipi Dengan Air Hangat/air Dingin, Tetap Rutin Gosok Gigi Dua Kali Sehari (sesudah Sarapan Dan Sebelum Tidur) Serta Kontrol Rutin 6 Bulan Sekali Ke Dokter Gigi'),
(6, 'P06', 'Ulser Traumatikus', '<p>Dapat Mengoleskan Salep Kortikosteroid Topikal Triamcinolone Acetonide 0,1%, Kumur Dengan Obat Kumur Antiseptik Atau Air Garam, Tetap Rutin Gosok Gigi Dua Kali Sehari (sesudah Sarapan Dan Sebelum Tidur), Dan Kontrol Ke Dokter Gigi Spesialis Ortodonsia Untuk Memperbaiki Behel, Atau Ke Dokter Gigi Atau Dokter Gigi Spesialis Penyakit Mulut Untuk Mengetahui Penyebab Lainnya</p>\r\n'),
(7, 'P07', 'Angular Cheilitis', 'Dapat Mengoleskan Salep Kortikosteroid Topikal Triamcinolone Acetonide 0,1%, Obat Antijamur (harus Dengan Resep Dokter Gigi), Menambah Asupan Nutrisi (buah Dan Sayur), Memperbaiki Gigi Palsu (apabila Penyakitnya Terjadi Akibat Pemakaian Gigi Palsu), Tetap Rutin Gosok Gigi Dua Kali Sehari (sesudah Sarapan Dan Sebelum Tidur) Serta Kontrol Rutin 6 Bulan Sekali Ke Dokter Gigi'),
(8, 'P08', 'Exfoliative Cheilitis', 'Dapat Mengoleskan Salep Kortikosteroid Topikal Triamcinolone Acetonide 0,1%, Obat Antijamur (harus Dengan Resep Dokter Gigi), Menambah Asupan Nutrisi (buah Dan Sayur), Hindari Menghisap/menjilati Bibir, Manajemen Stres (jika Perlu Dapat Berkonsultasi Ke Psikolog/psikiater), Tetap Rutin Gosok Gigi Dua Kali Sehari (sesudah Sarapan Dan Sebelum Tidur) Serta Kontrol Rutin 6 Bulan Sekali Ke Dokter Gigi'),
(9, 'P09', 'Actinic Cheilitis', 'Dapat Mengoleskan Salep Kortikosteroid Topikal Triamcinolone Acetonide 0,1%, Pelembab Bibir Atau Tabir Surya Yang Mengandung SPF, Hindari Merokok, Hindari Menghisap Bibir, Hindari Kontak Langsung Dengan Matahari (masker Wajah, Payung, Dll), Menambah Asupan Nutrisi (buah Dan Sayur), Tetap Rutin Gosok Gigi Dua Kali Sehari (sesudah Sarapan Dan Sebelum Tidur) Serta Kontrol Rutin 6 Bulan Sekali Ke Dokter Gigi'),
(10, 'P10', 'Linea Alba Buccalis', 'Tidak Memerlukan Perawatan Karena Merupakan Kondisi Yang Normal Dan Tidak Berbahaya, Tetap Rutin Gosok Gigi Dua Kali Sehari (sesudah Sarapan Dan Sebelum Tidur) Serta Kontrol Rutin 6 Bulan Sekali Ke Dokter Gigi'),
(12, 'P11', 'Geographic Tongue', 'Tidak Memerlukan Perawatan Karena Merupakan Kondisi Yang Normal Dan Tidak Berbahaya, Tetap Rutin Gosok Gigi Dua Kali Sehari (sesudah Sarapan Dan Sebelum Tidur) Serta Kontrol Rutin 6 Bulan Sekali Ke Dokter Gigi'),
(13, 'P12', 'Fordyce’s Granules', 'Tidak Memerlukan Perawatan Karena Merupakan Kondisi Yang Normal Dan Tidak Berbahaya, Jika Kondisi Tersebut Mengganggu Penampilan Maka Dapat Dilakukan Perawatan Laser Ablasi CO2, Tetap Rutin Gosok Gigi Dua Kali Sehari (sesudah Sarapan Dan Sebelum Tidur) Serta Kontrol Rutin 6 Bulan Sekali Ke Dokter Gigi'),
(14, 'P13', 'Kanker Mulut (Kanker Sel Skuamosa)', 'Dugaan Keganasan/kanker Mulut, Segera Ke Dokter Gigi, Dokter Gigi Spesialis Penyakit Mulut, Atau Dokter Gigi Spesialis Bedah Mulut Dan Maksilofasial Untuk Pemeriksaan Lebih Lanjut. Perawatan Dapat Dilakukan Dengan Operasi Untuk Pengangkatan Sel Kanker, Terapi Radiasi, Kemoterapi, Kombinasi Operasi Dan Radiasi. Tetap Rutin Gosok Gigi Dua Kali Sehari (sesudah Sarapan Dan Sebelum Tidur) Serta Kontrol Rutin 6 Bulan Sekali Ke Dokter Gigi'),
(15, 'P14', 'Median Rhomboid Glossitis', 'Tidak Memerlukan Perawatan Karena Merupakan Kondisi Yang Normal Dan Tidak Berbahaya, Jika Memakai Gigi Palsu Maka Harus Rutin Membersihkan Gigi Palsunya, Hindari Merokok, Tetap Rutin Gosok Gigi Dua Kali Sehari (sesudah Sarapan Dan Sebelum Tidur) Serta Kontrol Rutin 6 Bulan Sekali Ke Dokter Gigi\n \n'),
(16, 'P15', 'Amalgam Tatto', 'Tidak Memerlukan Perawatan Karena Merupakan Kondisi Yang Normal Dan Tidak Berbahaya, Tetap Rutin Gosok Gigi Dua Kali Sehari (sesudah Sarapan Dan Sebelum Tidur) Serta Kontrol Rutin 6 Bulan Sekali Ke Dokter Gigi'),
(17, 'P16', 'Herpes Labialis ', 'Konsumsi Obat Pereda Nyeri Dan Demam Seperti Paracetamol, Asam Mefenamat Atau Ibuprofen Dan Obat Antivirus Seperti Acyclovir, Valacyclovir, Atau Famciclovir(harus Dengan Resep Dokter), Konsumsi Air Putih Yang Banyak, Istirahat Yang Cukup, Makan Makanan Yang Lembut (bubur), Makan Makanan Tinggi Kalori Dan Tinggi Protein (diet TKTP), Menginformasikan Bahwa Ini Merupakan Penyakit Yang Menular Sehingga Diharapkan Isolasi Atau Tidak Kontak Dengan Orang Lain, Tetap Rutin Gosok Gigi Dua Kali Sehari (sesudah Sarapan Dan Sebelum Tidur) Serta Periksakan Lebih Lanjut Ke Dokter Gigi, Dokter Gigi Spesialis Penyakit Mulut Atau Dokter Gigi Spesialis Kulit Dan Kelamin'),
(18, 'P17', 'Herpes Zoster ', 'Konsumsi Obat Pereda Nyeri Dan Demam Seperti Paracetamol, Asam Mefenamat Atau Ibuprofen Dan Obat Antivirus Seperti Acyclovir, Valacyclovir, Atau Famciclovir(harus Dengan Resep Dokter), Konsumsi Air Putih Yang Banyak, Istirahat Yang Cukup, Makan Makanan Yang Lembut (bubur), Makan Makanan Tinggi Kalori Dan Tinggi Protein (diet TKTP), Menginformasikan Bahwa Ini Merupakan Penyakit Yang Menular Sehingga Diharapkan Isolasi Atau Tidak Kontak Dengan Orang Lain, Tetap Rutin Gosok Gigi Dua Kali Sehari (sesudah Sarapan Dan Sebelum Tidur) Serta Periksakan Lebih Lanjut Ke Dokter Gigi, Dokter Gigi Spesialis Penyakit Mulut Atau Dokter Gigi Spesialis Kulit Dan Kelamin'),
(19, 'P18', 'Fisured Tongue', 'Tidak Memerlukan Perawatan Karena Merupakan Kondisi Yang Normal Dan Tidak Berbahaya, Tetap Rutin Gosok Gigi Dua Kali Sehari (sesudah Sarapan Dan Sebelum Tidur), Rutin Membersihkan Lidah Dari Sisa-sisa Makanan Yang Mungkin Menyelip Di Antara Sela-sela Lidah Serta Kontrol Rutin 6 Bulan Sekali Ke Dokter Gigi'),
(20, 'P19', 'Coated Tongue', '<p>PENYAKIT NEW</p>\r\n'),
(21, 'P20', 'Torus Mandibularis', 'Tidak Memerlukan Perawatan Karena Merupakan Kondisi Yang Normal Dan Tidak Berbahaya, Namun Jika Ingin Membuat/menggunakan Gigi Palsu Maka Harus Dilakukan Tindakan Operasi Pengangkatan Benjolan Tulang Tersebut. Selain Itu Tetap Rutin Gosok Gigi Dua Kali Sehari (sesudah Sarapan Dan Sebelum Tidur) Serta Kontrol Rutin 6 Bulan Sekali Ke Dokter Gigi'),
(22, 'P21', 'Torus Palatinus', 'Tidak Memerlukan Perawatan Karena Merupakan Kondisi Yang Normal Dan Tidak Berbahaya, Namun Jika Ingin Membuat/menggunakan Gigi Palsu Maka Harus Dilakukan Tindakan Operasi Pengangkatan Benjolan Tulang Tersebut. Selain Itu Tetap Rutin Gosok Gigi Dua Kali Sehari (sesudah Sarapan Dan Sebelum Tidur) Serta Kontrol Rutin 6 Bulan Sekali Ke Dokter Gigi');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `nama_role` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `nama_role`) VALUES
(1, 'Super Admin'),
(2, 'User');

-- --------------------------------------------------------

--
-- Table structure for table `rule`
--

CREATE TABLE `rule` (
  `id_rule` int(11) NOT NULL,
  `id_ms_penyakit` int(11) DEFAULT NULL,
  `gejala` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rule`
--

INSERT INTO `rule` (`id_rule`, `id_ms_penyakit`, `gejala`) VALUES
(1, 2, '1,2,3,5,6,7,8,9,10,12,19,20,22,24,28,29,34,36,38,40'),
(2, 1, '1,2,3,5,6,7,8,9,10,12,19,20,21,22,24,25,27,28,29,33,34,35,38,40'),
(3, 3, '1,2,3,5,6,7,8,9,10,12,19,20,22,24,25,27,28,29,33,34,36,38,39,40'),
(4, 4, '1,2,3,5,6,7,8,9,10,11,12,13,14,18,20,21,22,27,28,29,30,31,33,34,36,37,40'),
(5, 5, '2,5,16,19,20,23,35,38,39'),
(6, 6, '1,2,3,5,6,7,8,9,10,11,12,19,20,23,24,35,38'),
(7, 7, '1,2,11,12,15,18,21,22,23,25,28,29,36,40'),
(8, 8, '1,2,4,11,18,21,22,25,28,29,34,36,37,40'),
(9, 9, '1,2,3,4,12,13,18,21,22,25,31,35,37,40'),
(10, 10, '5,14,21,23,24'),
(11, 12, '2,8,13,14,20,22,27,28,29,33,34,36,38,40'),
(12, 13, '4,5,14,21,23'),
(13, 14, '1,2,3,4,5,6,7,8,9,10,12,13,14,16,18,21,22,24,29,31,35,37,40'),
(14, 15, '2,8,13,21,23,28,29,34,36,38,40'),
(15, 16, '5,10,15,21,23,26,36,38,40'),
(16, 17, '1,2,3,4,6,7,11,12,16,20,22,36,38,40'),
(17, 18, '1,4,5,6,7,8,9,10,11,12,21,22,26,29,36,38,39'),
(18, 19, '8,17,21,22,36,38,40'),
(19, 20, '2,8,14,21,22,28,29,33,34,36,38,40'),
(20, 21, '10,16,21,23,35,37,40'),
(21, 22, '10,16,21,23,35,37,40');

-- --------------------------------------------------------

--
-- Table structure for table `rule_breadth`
--

CREATE TABLE `rule_breadth` (
  `id_rule_breadth` int(11) NOT NULL,
  `id_rule` int(11) DEFAULT NULL,
  `parent_ms_gejala` int(11) DEFAULT NULL,
  `child_ms_gejala` int(11) DEFAULT NULL,
  `id_ms_penyakit` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rule_breadth`
--

INSERT INTO `rule_breadth` (`id_rule_breadth`, `id_rule`, `parent_ms_gejala`, `child_ms_gejala`, `id_ms_penyakit`) VALUES
(21, 1, 1, 2, NULL),
(22, 1, 2, 3, NULL),
(23, 1, 3, 5, NULL),
(24, 1, 5, 6, NULL),
(25, 1, 6, 7, NULL),
(26, 1, 7, 8, NULL),
(27, 1, 8, 9, NULL),
(28, 1, 9, 10, NULL),
(29, 1, 10, 12, NULL),
(30, 1, 12, 19, NULL),
(31, 1, 19, 20, NULL),
(32, 1, 20, 22, NULL),
(33, 1, 22, 24, NULL),
(34, 1, 24, 28, NULL),
(35, 1, 28, 29, NULL),
(36, 1, 29, 34, NULL),
(37, 1, 34, 36, NULL),
(38, 1, 36, 38, NULL),
(39, 1, 38, 40, NULL),
(40, 1, 40, NULL, 2),
(41, 2, 1, 2, NULL),
(42, 2, 2, 3, NULL),
(43, 2, 3, 5, NULL),
(44, 2, 5, 6, NULL),
(45, 2, 6, 7, NULL),
(46, 2, 7, 8, NULL),
(47, 2, 8, 9, NULL),
(48, 2, 9, 10, NULL),
(49, 2, 10, 12, NULL),
(50, 2, 12, 19, NULL),
(51, 2, 19, 20, NULL),
(52, 2, 20, 21, NULL),
(53, 2, 21, 22, NULL),
(54, 2, 22, 24, NULL),
(55, 2, 24, 25, NULL),
(56, 2, 25, 27, NULL),
(57, 2, 27, 28, NULL),
(58, 2, 28, 29, NULL),
(59, 2, 29, 33, NULL),
(60, 2, 33, 34, NULL),
(61, 2, 34, 35, NULL),
(62, 2, 35, 38, NULL),
(63, 2, 38, 40, NULL),
(64, 2, 40, NULL, 1),
(65, 3, 1, 2, NULL),
(66, 3, 2, 3, NULL),
(67, 3, 3, 5, NULL),
(68, 3, 5, 6, NULL),
(69, 3, 6, 7, NULL),
(70, 3, 7, 8, NULL),
(71, 3, 8, 9, NULL),
(72, 3, 9, 10, NULL),
(73, 3, 10, 12, NULL),
(74, 3, 12, 19, NULL),
(75, 3, 19, 20, NULL),
(76, 3, 20, 22, NULL),
(77, 3, 22, 24, NULL),
(78, 3, 24, 25, NULL),
(79, 3, 25, 27, NULL),
(80, 3, 27, 28, NULL),
(81, 3, 28, 29, NULL),
(82, 3, 29, 33, NULL),
(83, 3, 33, 34, NULL),
(84, 3, 34, 36, NULL),
(85, 3, 36, 38, NULL),
(86, 3, 38, 39, NULL),
(87, 3, 39, 40, NULL),
(88, 3, 40, NULL, 3),
(89, 4, 1, 2, NULL),
(90, 4, 2, 3, NULL),
(91, 4, 3, 5, NULL),
(92, 4, 5, 6, NULL),
(93, 4, 6, 7, NULL),
(94, 4, 7, 8, NULL),
(95, 4, 8, 9, NULL),
(96, 4, 9, 10, NULL),
(97, 4, 10, 11, NULL),
(98, 4, 11, 12, NULL),
(99, 4, 12, 13, NULL),
(100, 4, 13, 14, NULL),
(101, 4, 14, 18, NULL),
(102, 4, 18, 20, NULL),
(103, 4, 20, 21, NULL),
(104, 4, 21, 22, NULL),
(105, 4, 22, 27, NULL),
(106, 4, 27, 28, NULL),
(107, 4, 28, 29, NULL),
(108, 4, 29, 30, NULL),
(109, 4, 30, 31, NULL),
(110, 4, 31, 33, NULL),
(111, 4, 33, 34, NULL),
(112, 4, 34, 36, NULL),
(113, 4, 36, 37, NULL),
(114, 4, 37, 40, NULL),
(115, 4, 40, NULL, 4),
(116, 5, 2, 5, NULL),
(117, 5, 5, 16, NULL),
(118, 5, 16, 19, NULL),
(119, 5, 19, 20, NULL),
(120, 5, 20, 23, NULL),
(121, 5, 23, 35, NULL),
(122, 5, 35, 38, NULL),
(123, 5, 38, 39, NULL),
(124, 5, 39, NULL, 5),
(125, 6, 1, 2, NULL),
(126, 6, 2, 3, NULL),
(127, 6, 3, 5, NULL),
(128, 6, 5, 6, NULL),
(129, 6, 6, 7, NULL),
(130, 6, 7, 8, NULL),
(131, 6, 8, 9, NULL),
(132, 6, 9, 10, NULL),
(133, 6, 10, 11, NULL),
(134, 6, 11, 12, NULL),
(135, 6, 12, 19, NULL),
(136, 6, 19, 20, NULL),
(137, 6, 20, 23, NULL),
(138, 6, 23, 24, NULL),
(139, 6, 24, 35, NULL),
(140, 6, 35, 38, NULL),
(141, 6, 38, NULL, 6),
(142, 7, 1, 2, NULL),
(143, 7, 2, 11, NULL),
(144, 7, 11, 12, NULL),
(145, 7, 12, 15, NULL),
(146, 7, 15, 18, NULL),
(147, 7, 18, 21, NULL),
(148, 7, 21, 22, NULL),
(149, 7, 22, 23, NULL),
(150, 7, 23, 25, NULL),
(151, 7, 25, 28, NULL),
(152, 7, 28, 29, NULL),
(153, 7, 29, 36, NULL),
(154, 7, 36, 40, NULL),
(155, 7, 40, NULL, 7),
(156, 8, 1, 2, NULL),
(157, 8, 2, 4, NULL),
(158, 8, 4, 11, NULL),
(159, 8, 11, 18, NULL),
(160, 8, 18, 21, NULL),
(161, 8, 21, 22, NULL),
(162, 8, 22, 25, NULL),
(163, 8, 25, 28, NULL),
(164, 8, 28, 29, NULL),
(165, 8, 29, 34, NULL),
(166, 8, 34, 36, NULL),
(167, 8, 36, 37, NULL),
(168, 8, 37, 40, NULL),
(169, 8, 40, NULL, 8),
(170, 9, 1, 2, NULL),
(171, 9, 2, 3, NULL),
(172, 9, 3, 4, NULL),
(173, 9, 4, 12, NULL),
(174, 9, 12, 13, NULL),
(175, 9, 13, 18, NULL),
(176, 9, 18, 21, NULL),
(177, 9, 21, 22, NULL),
(178, 9, 22, 25, NULL),
(179, 9, 25, 31, NULL),
(180, 9, 31, 35, NULL),
(181, 9, 35, 37, NULL),
(182, 9, 37, 40, NULL),
(183, 9, 40, NULL, 9),
(184, 10, 5, 14, NULL),
(185, 10, 14, 21, NULL),
(186, 10, 21, 23, NULL),
(187, 10, 23, 24, NULL),
(188, 10, 24, NULL, 10),
(189, 11, 2, 8, NULL),
(190, 11, 8, 13, NULL),
(191, 11, 13, 14, NULL),
(192, 11, 14, 20, NULL),
(193, 11, 20, 22, NULL),
(194, 11, 22, 27, NULL),
(195, 11, 27, 28, NULL),
(196, 11, 28, 29, NULL),
(197, 11, 29, 33, NULL),
(198, 11, 33, 34, NULL),
(199, 11, 34, 36, NULL),
(200, 11, 36, 38, NULL),
(201, 11, 38, 40, NULL),
(202, 11, 40, NULL, 12),
(203, 12, 4, 5, NULL),
(204, 12, 5, 14, NULL),
(205, 12, 14, 21, NULL),
(206, 12, 21, 23, NULL),
(207, 12, 23, NULL, 13),
(208, 13, 1, 2, NULL),
(209, 13, 2, 3, NULL),
(210, 13, 3, 4, NULL),
(211, 13, 4, 5, NULL),
(212, 13, 5, 6, NULL),
(213, 13, 6, 7, NULL),
(214, 13, 7, 8, NULL),
(215, 13, 8, 9, NULL),
(216, 13, 9, 10, NULL),
(217, 13, 10, 12, NULL),
(218, 13, 12, 13, NULL),
(219, 13, 13, 14, NULL),
(220, 13, 14, 16, NULL),
(221, 13, 16, 18, NULL),
(222, 13, 18, 21, NULL),
(223, 13, 21, 22, NULL),
(224, 13, 22, 24, NULL),
(225, 13, 24, 29, NULL),
(226, 13, 29, 31, NULL),
(227, 13, 31, 35, NULL),
(228, 13, 35, 37, NULL),
(229, 13, 37, 40, NULL),
(230, 13, 40, NULL, 14),
(231, 14, 2, 8, NULL),
(232, 14, 8, 13, NULL),
(233, 14, 13, 21, NULL),
(234, 14, 21, 23, NULL),
(235, 14, 23, 28, NULL),
(236, 14, 28, 29, NULL),
(237, 14, 29, 34, NULL),
(238, 14, 34, 36, NULL),
(239, 14, 36, 38, NULL),
(240, 14, 38, 40, NULL),
(241, 14, 40, NULL, 15),
(242, 15, 5, 10, NULL),
(243, 15, 10, 15, NULL),
(244, 15, 15, 21, NULL),
(245, 15, 21, 23, NULL),
(246, 15, 23, 26, NULL),
(247, 15, 26, 36, NULL),
(248, 15, 36, 38, NULL),
(249, 15, 38, 40, NULL),
(250, 15, 40, NULL, 16),
(251, 16, 1, 2, NULL),
(252, 16, 2, 3, NULL),
(253, 16, 3, 4, NULL),
(254, 16, 4, 6, NULL),
(255, 16, 6, 7, NULL),
(256, 16, 7, 11, NULL),
(257, 16, 11, 12, NULL),
(258, 16, 12, 16, NULL),
(259, 16, 16, 20, NULL),
(260, 16, 20, 22, NULL),
(261, 16, 22, 36, NULL),
(262, 16, 36, 38, NULL),
(263, 16, 38, 40, NULL),
(264, 16, 40, NULL, 17),
(265, 17, 1, 4, NULL),
(266, 17, 4, 5, NULL),
(267, 17, 5, 6, NULL),
(268, 17, 6, 7, NULL),
(269, 17, 7, 8, NULL),
(270, 17, 8, 9, NULL),
(271, 17, 9, 10, NULL),
(272, 17, 10, 11, NULL),
(273, 17, 11, 12, NULL),
(274, 17, 12, 21, NULL),
(275, 17, 21, 22, NULL),
(276, 17, 22, 26, NULL),
(277, 17, 26, 29, NULL),
(278, 17, 29, 36, NULL),
(279, 17, 36, 38, NULL),
(280, 17, 38, 39, NULL),
(281, 17, 39, NULL, 18),
(282, 18, 8, 17, NULL),
(283, 18, 17, 21, NULL),
(284, 18, 21, 22, NULL),
(285, 18, 22, 36, NULL),
(286, 18, 36, 38, NULL),
(287, 18, 38, 40, NULL),
(288, 18, 40, NULL, 19),
(289, 19, 2, 8, NULL),
(290, 19, 8, 14, NULL),
(291, 19, 14, 21, NULL),
(292, 19, 21, 22, NULL),
(293, 19, 22, 28, NULL),
(294, 19, 28, 29, NULL),
(295, 19, 29, 33, NULL),
(296, 19, 33, 34, NULL),
(297, 19, 34, 36, NULL),
(298, 19, 36, 38, NULL),
(299, 19, 38, 40, NULL),
(300, 19, 40, NULL, 20),
(301, 20, 10, 16, NULL),
(302, 20, 16, 21, NULL),
(303, 20, 21, 23, NULL),
(304, 20, 23, 35, NULL),
(305, 20, 35, 37, NULL),
(306, 20, 37, 40, NULL),
(307, 20, 40, NULL, 21),
(308, 21, 10, 16, NULL),
(309, 21, 16, 21, NULL),
(310, 21, 21, 23, NULL),
(311, 21, 23, 35, NULL),
(312, 21, 35, 37, NULL),
(313, 21, 37, 40, NULL),
(314, 21, 40, NULL, 22);

-- --------------------------------------------------------

--
-- Table structure for table `tmp_konsultasi`
--

CREATE TABLE `tmp_konsultasi` (
  `id_tmp_konsultasi` int(11) NOT NULL,
  `id_ms_gejala` int(11) DEFAULT NULL,
  `id_prev_gejala` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `answer` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `id_role` int(11) DEFAULT NULL,
  `nama_user` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `id_role`, `nama_user`, `username`, `password`, `created_at`) VALUES
(1, 1, 'Aan Super Admin', 'aan_admin', 'e10adc3949ba59abbe56e057f20f883e', '2022-10-15 15:24:00'),
(2, 2, 'Aan User', 'aan_user', 'e10adc3949ba59abbe56e057f20f883e', '2022-10-15 15:24:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `certainly_factor`
--
ALTER TABLE `certainly_factor`
  ADD PRIMARY KEY (`id_certainly_factor`),
  ADD KEY `id_gejala` (`id_gejala`),
  ADD KEY `id_penyakit` (`id_penyakit`);

--
-- Indexes for table `detail_konsultasi_gejala`
--
ALTER TABLE `detail_konsultasi_gejala`
  ADD PRIMARY KEY (`id_detail_konsultasi_gejala`),
  ADD KEY `id_konsultasi` (`id_konsultasi`),
  ADD KEY `id_gejala` (`id_gejala`);

--
-- Indexes for table `detail_konsultasi_penyakit`
--
ALTER TABLE `detail_konsultasi_penyakit`
  ADD PRIMARY KEY (`id_detail_konsultasi_penyakit`),
  ADD KEY `detail_konsultasi_penyakit_ibfk_1` (`id_konsultasi`),
  ADD KEY `detail_konsultasi_penyakit_ibfk_2` (`id_penyakit`);

--
-- Indexes for table `konsultasi`
--
ALTER TABLE `konsultasi`
  ADD PRIMARY KEY (`id_konsultasi`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `ms_gejala`
--
ALTER TABLE `ms_gejala`
  ADD PRIMARY KEY (`id_ms_gejala`),
  ADD KEY `id_ms_kategori_gejala` (`id_ms_kategori_gejala`);

--
-- Indexes for table `ms_kategori_gejala`
--
ALTER TABLE `ms_kategori_gejala`
  ADD PRIMARY KEY (`id_ms_kategori_gejala`);

--
-- Indexes for table `ms_penyakit`
--
ALTER TABLE `ms_penyakit`
  ADD PRIMARY KEY (`id_ms_penyakit`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rule`
--
ALTER TABLE `rule`
  ADD PRIMARY KEY (`id_rule`),
  ADD KEY `id_ms_penyakit` (`id_ms_penyakit`);

--
-- Indexes for table `rule_breadth`
--
ALTER TABLE `rule_breadth`
  ADD PRIMARY KEY (`id_rule_breadth`),
  ADD KEY `rule_breadth_ibfk_1` (`id_rule`),
  ADD KEY `rule_breadth_ibfk_2` (`parent_ms_gejala`),
  ADD KEY `rule_breadth_ibfk_3` (`child_ms_gejala`),
  ADD KEY `rule_breadth_ibfk_4` (`id_ms_penyakit`);

--
-- Indexes for table `tmp_konsultasi`
--
ALTER TABLE `tmp_konsultasi`
  ADD PRIMARY KEY (`id_tmp_konsultasi`),
  ADD KEY `tmp_konsultasi_ibfk_1` (`id_ms_gejala`),
  ADD KEY `tmp_konsultasi_ibfk_2` (`id_prev_gejala`),
  ADD KEY `tmp_konsultasi_ibfk_3` (`id_user`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_role` (`id_role`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `certainly_factor`
--
ALTER TABLE `certainly_factor`
  MODIFY `id_certainly_factor` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `detail_konsultasi_gejala`
--
ALTER TABLE `detail_konsultasi_gejala`
  MODIFY `id_detail_konsultasi_gejala` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `detail_konsultasi_penyakit`
--
ALTER TABLE `detail_konsultasi_penyakit`
  MODIFY `id_detail_konsultasi_penyakit` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `konsultasi`
--
ALTER TABLE `konsultasi`
  MODIFY `id_konsultasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ms_gejala`
--
ALTER TABLE `ms_gejala`
  MODIFY `id_ms_gejala` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `ms_kategori_gejala`
--
ALTER TABLE `ms_kategori_gejala`
  MODIFY `id_ms_kategori_gejala` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `ms_penyakit`
--
ALTER TABLE `ms_penyakit`
  MODIFY `id_ms_penyakit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `rule`
--
ALTER TABLE `rule`
  MODIFY `id_rule` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `rule_breadth`
--
ALTER TABLE `rule_breadth`
  MODIFY `id_rule_breadth` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=315;

--
-- AUTO_INCREMENT for table `tmp_konsultasi`
--
ALTER TABLE `tmp_konsultasi`
  MODIFY `id_tmp_konsultasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=171;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `certainly_factor`
--
ALTER TABLE `certainly_factor`
  ADD CONSTRAINT `certainly_factor_ibfk_1` FOREIGN KEY (`id_gejala`) REFERENCES `ms_gejala` (`id_ms_gejala`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `certainly_factor_ibfk_2` FOREIGN KEY (`id_penyakit`) REFERENCES `ms_penyakit` (`id_ms_penyakit`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `detail_konsultasi_gejala`
--
ALTER TABLE `detail_konsultasi_gejala`
  ADD CONSTRAINT `detail_konsultasi_gejala_ibfk_1` FOREIGN KEY (`id_konsultasi`) REFERENCES `konsultasi` (`id_konsultasi`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detail_konsultasi_gejala_ibfk_2` FOREIGN KEY (`id_gejala`) REFERENCES `ms_gejala` (`id_ms_gejala`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `detail_konsultasi_penyakit`
--
ALTER TABLE `detail_konsultasi_penyakit`
  ADD CONSTRAINT `detail_konsultasi_penyakit_ibfk_1` FOREIGN KEY (`id_konsultasi`) REFERENCES `konsultasi` (`id_konsultasi`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detail_konsultasi_penyakit_ibfk_2` FOREIGN KEY (`id_penyakit`) REFERENCES `ms_penyakit` (`id_ms_penyakit`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `konsultasi`
--
ALTER TABLE `konsultasi`
  ADD CONSTRAINT `konsultasi_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);

--
-- Constraints for table `ms_gejala`
--
ALTER TABLE `ms_gejala`
  ADD CONSTRAINT `ms_gejala_ibfk_1` FOREIGN KEY (`id_ms_kategori_gejala`) REFERENCES `ms_kategori_gejala` (`id_ms_kategori_gejala`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rule`
--
ALTER TABLE `rule`
  ADD CONSTRAINT `rule_ibfk_1` FOREIGN KEY (`id_ms_penyakit`) REFERENCES `ms_penyakit` (`id_ms_penyakit`);

--
-- Constraints for table `rule_breadth`
--
ALTER TABLE `rule_breadth`
  ADD CONSTRAINT `rule_breadth_ibfk_1` FOREIGN KEY (`id_rule`) REFERENCES `rule` (`id_rule`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rule_breadth_ibfk_2` FOREIGN KEY (`parent_ms_gejala`) REFERENCES `ms_gejala` (`id_ms_gejala`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rule_breadth_ibfk_3` FOREIGN KEY (`child_ms_gejala`) REFERENCES `ms_gejala` (`id_ms_gejala`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rule_breadth_ibfk_4` FOREIGN KEY (`id_ms_penyakit`) REFERENCES `ms_penyakit` (`id_ms_penyakit`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tmp_konsultasi`
--
ALTER TABLE `tmp_konsultasi`
  ADD CONSTRAINT `tmp_konsultasi_ibfk_1` FOREIGN KEY (`id_ms_gejala`) REFERENCES `ms_gejala` (`id_ms_gejala`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tmp_konsultasi_ibfk_2` FOREIGN KEY (`id_prev_gejala`) REFERENCES `ms_gejala` (`id_ms_gejala`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tmp_konsultasi_ibfk_3` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`id_role`) REFERENCES `role` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
