-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 25, 2022 at 09:49 PM
-- Server version: 10.6.7-MariaDB-2ubuntu1.1
-- PHP Version: 8.1.11

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
-- Table structure for table `ms_gejala`
--

CREATE TABLE `ms_gejala` (
  `id_ms_gejala` int(11) NOT NULL,
  `kode_gejala` varchar(255) DEFAULT NULL,
  `nama_gejala` varchar(255) DEFAULT NULL,
  `is_utama` tinyint(1) NOT NULL,
  `is_priority` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ms_gejala`
--

INSERT INTO `ms_gejala` (`id_ms_gejala`, `kode_gejala`, `nama_gejala`, `is_utama`, `is_priority`) VALUES
(1, 'G01', 'Nyeri', 1, 1),
(2, 'G02', 'Rasa Terbakar', 0, 0),
(3, 'G03', 'Tidak Nyeri', 1, 1),
(4, 'G04', 'Nyeri Saat Menelan', 0, 1),
(5, 'G05', 'Nyeri Saat Mengunyah', 0, 0),
(6, 'G06', 'Sariawan Besar ', 0, 0),
(7, 'G07', 'Sariawan Kecil', 0, 1),
(8, 'G08', 'Sariawan Berbentuk Bulat', 0, 1),
(9, 'G09', 'Sariawan Berjumlah 1 Atau Lebih', 0, 1),
(10, 'G10', 'Berjumlah 1 - 5 Sariawan', 0, 0),
(11, 'G11', 'Berwarna Putih Kekuningan', 0, 1),
(12, 'G12', 'Sariawan Berwarna Putih Kekuningan', 0, 1),
(13, 'G13', 'Sariawan Terjadi Secara Berulang ', 0, 1),
(14, 'G14', 'Stres Akademik / Pekerjaan / Lainnya', 0, 1),
(15, 'G15', 'Tidak Suka Makan Buah Dan Sayur', 0, 1),
(16, 'G16', 'Usia Di Bawah 40 Tahun', 0, 1),
(17, 'G17', 'Terjadi 2 Minggu Hingga 3 Bulan', 0, 0),
(18, 'G18', 'Sariawan Pinggiran Berwarna Merah', 0, 1),
(19, 'G19', 'Pinggiran Berwarna Merah', 0, 0),
(20, 'G20', 'Terjadi 1-2 Minggu', 0, 1),
(21, 'G21', 'Berjumlah Lebih Dari 10 Sariawan', 0, 0),
(22, 'G22', 'Dapat Dikerok Dan Timbul Kemerahan', 0, 0),
(23, 'G23', 'Bau Mulut', 0, 0),
(24, 'G24', 'Mempunyai Riwayat HIV / AIDS / Diabetes / Kanker', 0, 0),
(25, 'G25', 'Menggunakan Gigi Palsu', 0, 0),
(26, 'G26', 'Permukaan Seperti Beludru', 0, 0),
(27, 'G27', 'Demam', 0, 1),
(28, 'G28', 'Pipi Bengkak', 0, 0),
(29, 'G29', 'Rasa Tidak Nyaman Di Telinga', 0, 0),
(30, 'G30', 'Sariawan / Luka Di Lidah / Pipi / Gusi', 0, 0),
(31, 'G31', 'Tidak Sengaja Tergigit', 0, 0),
(32, 'G32', 'Tercolok Behel', 0, 0),
(33, 'G33', 'Bibir Kering', 0, 1),
(34, 'G34', 'Bibir Mengelupas', 0, 1),
(35, 'G35', 'Rasa Terbakar Pada Sudut Mulut', 0, 0),
(36, 'G36', 'Muncul Keropeng', 0, 0),
(37, 'G37', 'Luka Di Sudut Bibir', 0, 0),
(38, 'G38', 'Bibir Berdarah', 0, 1),
(39, 'G39', 'Bibir Kemerahan Dan Kasar', 0, 1),
(40, 'G40', 'Terjadi Sepanjang Tahun', 0, 0),
(41, 'G41', 'Sering Beraktivitas Di Luar Ruangan', 0, 0),
(42, 'G42', 'Tonjolan Garis Putih Lurus Di Kedua Pipi', 0, 0),
(43, 'G43', 'Sering Menggigit-gigit Pipi', 0, 0),
(44, 'G44', 'Tidak Timbul Kemerahan Ketika Digosok Menggunakan Kasa / Kapas', 0, 0),
(45, 'G45', 'Perokok Aktif', 0, 0),
(46, 'G46', 'Bintik Kemerahan / Sariawan Pada Langit Mulut', 0, 0),
(47, 'G47', 'Terdapat Pecah-pecah Di Langit-langit Mulut', 0, 0),
(48, 'G48', 'Tidak Dapat Dikerok', 0, 0),
(49, 'G49', 'Bercak Berbentuk Seperti Pulau-pulau Dengan Lokasi Dan Ukuran Yang Berbeda-beda', 0, 0),
(50, 'G50', 'Tonjolan Di Tengah Langit-langit Mulut', 0, 0),
(51, 'G51', 'Bercak Kemerahan Di Lidah Dan Hilang Timbul', 0, 0),
(52, 'G52', 'Berbentuk Bintik-bintik Kecil', 0, 0),
(53, 'G53', 'Berjumlah Banyak', 0, 0),
(54, 'G54', 'Lokasi Di Pipi / Bibir / Kemaluan', 0, 0),
(55, 'G55', 'Sariawan / Pembengkakan / Tonjolan Yang Tidak Sembuh-sembuh', 0, 0),
(56, 'G56', 'Berwarna Putih Kekuningan / Merah / Campuran', 0, 0),
(57, 'G57', 'Luka/sariawan Di Lidah Dengan Tepi Menonjol', 0, 0),
(58, 'G58', 'Perokok Aktif / Tembakau / Menyirih', 0, 0),
(59, 'G59', 'Lokasi Di Lidah / Mulut / Leher', 0, 0),
(60, 'G60', 'Penurunan Berat Badan', 0, 0),
(61, 'G61', 'Berbentuk Jajar Genjang Atau Oval', 0, 0),
(62, 'G62', 'Berwarna Merah', 0, 0),
(63, 'G63', 'Permukaan Licin Bila Disentuh', 0, 0),
(64, 'G64', 'Lokasi Di Belakang Tengah Lidah', 0, 0),
(65, 'G65', 'Memiliki Riwayat Penggunaan Gigi Palsu / Merokok', 0, 0),
(66, 'G66', 'Gusi Berwarna Coklat Muda / Tua', 0, 0),
(67, 'G67', 'Perokok Aktif / Bukan Perokok', 0, 0),
(68, 'G68', 'Lokasi Di Semua Gusi (kanan Dan Kiri)', 0, 0),
(69, 'G69', 'Terjadi Di Semua Gusi Yang Dekat Dengan Dengan Gigi', 0, 0),
(70, 'G70', 'Memiliki Tambalan Gigi Amalgam (tambalan Berwarna Hitam)', 0, 0),
(71, 'G71', 'Lokasi Di Gusi Atau Bibir', 0, 0),
(72, 'G72', 'Bercak Berwarna Abu-abu Kebiruan Hingga Kehitaman', 0, 0),
(73, 'G73', 'Bentuk Bulat Kecil', 0, 0),
(74, 'G74', 'Rasa Gatal / Terbakar / Kesemutan Di Area Bibir/mulut', 0, 0),
(75, 'G75', 'Terdapat Benjolan Di Leher Dan Nyeri', 0, 1),
(76, 'G76', 'Lemas, Letih, Dan Lesu', 0, 1),
(77, 'G77', 'Lentingan / Benjolan Kecil Berisi Cairan Di Bibir / Mulut', 0, 0),
(78, 'G78', 'Belum Pernah Mengalami Hal Yang Sama Sebelumnya', 0, 0),
(79, 'G79', 'Pernah Mengalami Hal Yang Sama Sebelumnya', 0, 0),
(80, 'G80', 'Bercak Kemerahan Di Dada / Punggung / Wajah / Seluruh Tubuh', 0, 0),
(81, 'G81', 'Lentingan / Benjolan Kecil Berisi Cairan Di Bibir / Mulut / Wajah / Mata / Badan', 0, 0),
(82, 'G82', 'Sakit Tenggorokan', 0, 0),
(83, 'G83', 'Terjadi Di Salah Satu Sisi Tubuh (kanan / Kiri)', 0, 0),
(84, 'G84', 'Terdapat Celah / Pecah-pecah Lebih Dari 1 Di Lidah', 0, 0),
(85, 'G85', 'Berwarna Normal (merah Lidah)', 0, 0),
(86, 'G86', 'Tonjolan Yang Ada Di Rahang Bawah', 0, 0),
(87, 'G87', 'Jika Disentuh Padat Dan Keras', 0, 0),
(88, 'G88', 'Tonjolan Berjumlah 1 Atau Lebih', 0, 0);

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
(6, 'P06', 'Ulser Trraumatitis', 'Dapat Mengoleskan Salep Kortikosteroid Topikal Triamcinolone Acetonide 0,1%, Kumur Dengan Obat Kumur Antiseptik Atau Air Garam, Tetap Rutin Gosok Gigi Dua Kali Sehari (sesudah Sarapan Dan Sebelum Tidur), Dan Kontrol Ke Dokter Gigi Spesialis Ortodonsia Untuk Memperbaiki Behel, Atau Ke Dokter Gigi Atau Dokter Gigi Spesialis Penyakit Mulut Untuk Mengetahui Penyebab Lainnya'),
(7, 'P07', 'Angular Cheilitis', 'Dapat Mengoleskan Salep Kortikosteroid Topikal Triamcinolone Acetonide 0,1%, Obat Antijamur (harus Dengan Resep Dokter Gigi), Menambah Asupan Nutrisi (buah Dan Sayur), Memperbaiki Gigi Palsu (apabila Penyakitnya Terjadi Akibat Pemakaian Gigi Palsu), Tetap Rutin Gosok Gigi Dua Kali Sehari (sesudah Sarapan Dan Sebelum Tidur) Serta Kontrol Rutin 6 Bulan Sekali Ke Dokter Gigi'),
(8, 'P08', 'Exfoliative Cheilitis', 'Dapat Mengoleskan Salep Kortikosteroid Topikal Triamcinolone Acetonide 0,1%, Obat Antijamur (harus Dengan Resep Dokter Gigi), Menambah Asupan Nutrisi (buah Dan Sayur), Hindari Menghisap/menjilati Bibir, Manajemen Stres (jika Perlu Dapat Berkonsultasi Ke Psikolog/psikiater), Tetap Rutin Gosok Gigi Dua Kali Sehari (sesudah Sarapan Dan Sebelum Tidur) Serta Kontrol Rutin 6 Bulan Sekali Ke Dokter Gigi'),
(9, 'P09', 'Actinic Cheilitis', 'Dapat Mengoleskan Salep Kortikosteroid Topikal Triamcinolone Acetonide 0,1%, Pelembab Bibir Atau Tabir Surya Yang Mengandung SPF, Hindari Merokok, Hindari Menghisap Bibir, Hindari Kontak Langsung Dengan Matahari (masker Wajah, Payung, Dll), Menambah Asupan Nutrisi (buah Dan Sayur), Tetap Rutin Gosok Gigi Dua Kali Sehari (sesudah Sarapan Dan Sebelum Tidur) Serta Kontrol Rutin 6 Bulan Sekali Ke Dokter Gigi'),
(10, 'P10', 'Linea Alba Buccalis', 'Tidak Memerlukan Perawatan Karena Merupakan Kondisi Yang Normal Dan Tidak Berbahaya, Tetap Rutin Gosok Gigi Dua Kali Sehari (sesudah Sarapan Dan Sebelum Tidur) Serta Kontrol Rutin 6 Bulan Sekali Ke Dokter Gigi'),
(11, 'P11', 'Nicotinic Stomatitis', 'Berhenti Merokok Dengan Cara Manajemen Stres (bila Merokok Adalah Pelarian Dari Stres), Konsultasi Ke Psikolog Atau Psikiater Untuk Melakukan Psikoterapi Dalam Program Penghentian Merokok Atau Terapi Stres, Tetap Rutin Gosok Gigi Dua Kali Sehari (sesudah Sarapan Dan Sebelum Tidur) Serta Kontrol Rutin 6 Bulan Sekali Ke Dokter Gigi'),
(12, 'P12', 'Geographic Tongue', 'Tidak Memerlukan Perawatan Karena Merupakan Kondisi Yang Normal Dan Tidak Berbahaya, Tetap Rutin Gosok Gigi Dua Kali Sehari (sesudah Sarapan Dan Sebelum Tidur) Serta Kontrol Rutin 6 Bulan Sekali Ke Dokter Gigi'),
(13, 'P13', 'Fordyce’s Granules', 'Tidak Memerlukan Perawatan Karena Merupakan Kondisi Yang Normal Dan Tidak Berbahaya, Jika Kondisi Tersebut Mengganggu Penampilan Maka Dapat Dilakukan Perawatan Laser Ablasi CO2, Tetap Rutin Gosok Gigi Dua Kali Sehari (sesudah Sarapan Dan Sebelum Tidur) Serta Kontrol Rutin 6 Bulan Sekali Ke Dokter Gigi'),
(14, 'P14', 'Kanker Mulut (Kanker Sel Skuamosa)', 'Dugaan Keganasan/kanker Mulut, Segera Ke Dokter Gigi, Dokter Gigi Spesialis Penyakit Mulut, Atau Dokter Gigi Spesialis Bedah Mulut Dan Maksilofasial Untuk Pemeriksaan Lebih Lanjut. Perawatan Dapat Dilakukan Dengan Operasi Untuk Pengangkatan Sel Kanker, Terapi Radiasi, Kemoterapi, Kombinasi Operasi Dan Radiasi. Tetap Rutin Gosok Gigi Dua Kali Sehari (sesudah Sarapan Dan Sebelum Tidur) Serta Kontrol Rutin 6 Bulan Sekali Ke Dokter Gigi'),
(15, 'P15', 'Median Rhomboid Glossitis', 'Tidak Memerlukan Perawatan Karena Merupakan Kondisi Yang Normal Dan Tidak Berbahaya, Jika Memakai Gigi Palsu Maka Harus Rutin Membersihkan Gigi Palsunya, Hindari Merokok, Tetap Rutin Gosok Gigi Dua Kali Sehari (sesudah Sarapan Dan Sebelum Tidur) Serta Kontrol Rutin 6 Bulan Sekali Ke Dokter Gigi\n \n'),
(16, 'P16', 'Pigmentasi', 'Tidak Memerlukan Perawatan Karena Merupakan Kondisi Yang Normal Dan Tidak Berbahaya, Tetap Rutin Gosok Gigi Dua Kali Sehari (sesudah Sarapan Dan Sebelum Tidur) Serta Kontrol Rutin 6 Bulan Sekali Ke Dokter Gigi'),
(17, 'P17', 'Amalgam Tatto', 'Tidak Memerlukan Perawatan Karena Merupakan Kondisi Yang Normal Dan Tidak Berbahaya, Tetap Rutin Gosok Gigi Dua Kali Sehari (sesudah Sarapan Dan Sebelum Tidur) Serta Kontrol Rutin 6 Bulan Sekali Ke Dokter Gigi'),
(18, 'P18', 'Herpes Labialis ', 'Konsumsi Obat Pereda Nyeri Dan Demam Seperti Paracetamol, Asam Mefenamat Atau Ibuprofen Dan Obat Antivirus Seperti Acyclovir, Valacyclovir, Atau Famciclovir(harus Dengan Resep Dokter), Konsumsi Air Putih Yang Banyak, Istirahat Yang Cukup, Makan Makanan Yang Lembut (bubur), Makan Makanan Tinggi Kalori Dan Tinggi Protein (diet TKTP), Menginformasikan Bahwa Ini Merupakan Penyakit Yang Menular Sehingga Diharapkan Isolasi Atau Tidak Kontak Dengan Orang Lain, Tetap Rutin Gosok Gigi Dua Kali Sehari (sesudah Sarapan Dan Sebelum Tidur) Serta Periksakan Lebih Lanjut Ke Dokter Gigi, Dokter Gigi Spesialis Penyakit Mulut Atau Dokter Gigi Spesialis Kulit Dan Kelamin'),
(19, 'P19', 'Herpes Zoster ', 'Konsumsi Obat Pereda Nyeri Dan Demam Seperti Paracetamol, Asam Mefenamat Atau Ibuprofen Dan Obat Antivirus Seperti Acyclovir, Valacyclovir, Atau Famciclovir(harus Dengan Resep Dokter), Konsumsi Air Putih Yang Banyak, Istirahat Yang Cukup, Makan Makanan Yang Lembut (bubur), Makan Makanan Tinggi Kalori Dan Tinggi Protein (diet TKTP), Menginformasikan Bahwa Ini Merupakan Penyakit Yang Menular Sehingga Diharapkan Isolasi Atau Tidak Kontak Dengan Orang Lain, Tetap Rutin Gosok Gigi Dua Kali Sehari (sesudah Sarapan Dan Sebelum Tidur) Serta Periksakan Lebih Lanjut Ke Dokter Gigi, Dokter Gigi Spesialis Penyakit Mulut Atau Dokter Gigi Spesialis Kulit Dan Kelamin'),
(20, 'P20', 'Fisured Tongue', 'Tidak Memerlukan Perawatan Karena Merupakan Kondisi Yang Normal Dan Tidak Berbahaya, Tetap Rutin Gosok Gigi Dua Kali Sehari (sesudah Sarapan Dan Sebelum Tidur), Rutin Membersihkan Lidah Dari Sisa-sisa Makanan Yang Mungkin Menyelip Di Antara Sela-sela Lidah Serta Kontrol Rutin 6 Bulan Sekali Ke Dokter Gigi'),
(21, 'P21', 'Torus Mandibularis', 'Tidak Memerlukan Perawatan Karena Merupakan Kondisi Yang Normal Dan Tidak Berbahaya, Namun Jika Ingin Membuat/menggunakan Gigi Palsu Maka Harus Dilakukan Tindakan Operasi Pengangkatan Benjolan Tulang Tersebut. Selain Itu Tetap Rutin Gosok Gigi Dua Kali Sehari (sesudah Sarapan Dan Sebelum Tidur) Serta Kontrol Rutin 6 Bulan Sekali Ke Dokter Gigi'),
(22, 'P22', 'Torus Palatinus', 'Tidak Memerlukan Perawatan Karena Merupakan Kondisi Yang Normal Dan Tidak Berbahaya, Namun Jika Ingin Membuat/menggunakan Gigi Palsu Maka Harus Dilakukan Tindakan Operasi Pengangkatan Benjolan Tulang Tersebut. Selain Itu Tetap Rutin Gosok Gigi Dua Kali Sehari (sesudah Sarapan Dan Sebelum Tidur) Serta Kontrol Rutin 6 Bulan Sekali Ke Dokter Gigi');

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
(6, 1, '1,2,6,8,9,12,13,14,15,16,17'),
(7, 2, '1,7,8,10,12,13,14,15,16,18'),
(8, 3, '1,7,8,12,14,15,16,18,20'),
(9, 4, '3,11,19,22,23,24,25'),
(10, 5, '1,4,5,27,28'),
(11, 6, '1,9,30,31,32'),
(12, 7, '1,15,33,34,35,36,37'),
(13, 8, '1,14,33,34,38,39'),
(14, 9, '1,16,33,38,39,41'),
(15, 10, '3,42,43,44'),
(16, 11, '1,45,46,47,48'),
(17, 12, '3,14,49,51'),
(18, 13, '3,11,52,53,54'),
(19, 14, '1,3,4,55,56,57,58,59,60'),
(20, 15, '3,61,62,63,64,65'),
(21, 16, '3,66,68,69,77'),
(22, 17, '3,70,71,72,73'),
(23, 18, '1,27,74,75,76,77,78'),
(24, 19, '1,14,27,75,76,79,80,81,82,83'),
(25, 20, '3,84,85'),
(26, 21, '3,86,87,88'),
(27, 22, '3,50,87,88');

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
(15, 6, 1, 2, NULL),
(16, 6, 2, 6, NULL),
(17, 6, 6, 8, NULL),
(18, 6, 8, 9, NULL),
(19, 6, 9, 12, NULL),
(20, 6, 12, 13, NULL),
(21, 6, 13, 14, NULL),
(22, 6, 14, 15, NULL),
(23, 6, 15, 16, NULL),
(24, 6, 16, 17, NULL),
(25, 6, 17, NULL, 1),
(26, 7, 1, 7, NULL),
(27, 7, 7, 8, NULL),
(28, 7, 8, 10, NULL),
(29, 7, 10, 12, NULL),
(30, 7, 12, 13, NULL),
(31, 7, 13, 14, NULL),
(32, 7, 14, 15, NULL),
(33, 7, 15, 16, NULL),
(34, 7, 16, 18, NULL),
(35, 7, 18, NULL, 2),
(36, 8, 1, 7, NULL),
(37, 8, 7, 8, NULL),
(38, 8, 8, 12, NULL),
(39, 8, 12, 14, NULL),
(40, 8, 14, 15, NULL),
(41, 8, 15, 16, NULL),
(42, 8, 16, 18, NULL),
(43, 8, 18, 20, NULL),
(44, 8, 20, NULL, 3),
(45, 9, 3, 11, NULL),
(46, 9, 11, 19, NULL),
(47, 9, 19, 22, NULL),
(48, 9, 22, 23, NULL),
(49, 9, 23, 24, NULL),
(50, 9, 24, 25, NULL),
(51, 9, 25, NULL, 4),
(52, 10, 1, 4, NULL),
(53, 10, 4, 5, NULL),
(54, 10, 5, 27, NULL),
(55, 10, 27, 28, NULL),
(56, 10, 28, NULL, 5),
(57, 11, 1, 9, NULL),
(58, 11, 9, 30, NULL),
(59, 11, 30, 31, NULL),
(60, 11, 31, 32, NULL),
(61, 11, 32, NULL, 6),
(62, 12, 1, 15, NULL),
(63, 12, 15, 33, NULL),
(64, 12, 33, 34, NULL),
(65, 12, 34, 35, NULL),
(66, 12, 35, 36, NULL),
(67, 12, 36, 37, NULL),
(68, 12, 37, NULL, 7),
(69, 13, 1, 14, NULL),
(70, 13, 14, 33, NULL),
(71, 13, 33, 34, NULL),
(72, 13, 34, 38, NULL),
(73, 13, 38, 39, NULL),
(74, 13, 39, NULL, 8),
(75, 14, 1, 16, NULL),
(76, 14, 16, 33, NULL),
(77, 14, 33, 38, NULL),
(78, 14, 38, 39, NULL),
(79, 14, 39, 41, NULL),
(80, 14, 41, NULL, 9),
(81, 15, 3, 42, NULL),
(82, 15, 42, 43, NULL),
(83, 15, 43, 44, NULL),
(84, 15, 44, NULL, 10),
(85, 16, 1, 45, NULL),
(86, 16, 45, 46, NULL),
(87, 16, 46, 47, NULL),
(88, 16, 47, 48, NULL),
(89, 16, 48, NULL, 11),
(90, 17, 3, 14, NULL),
(91, 17, 14, 49, NULL),
(92, 17, 49, 51, NULL),
(93, 17, 51, NULL, 12),
(94, 18, 3, 11, NULL),
(95, 18, 11, 52, NULL),
(96, 18, 52, 53, NULL),
(97, 18, 53, 54, NULL),
(98, 18, 54, NULL, 13),
(99, 19, 1, 3, NULL),
(100, 19, 3, 4, NULL),
(101, 19, 4, 55, NULL),
(102, 19, 55, 56, NULL),
(103, 19, 56, 57, NULL),
(104, 19, 57, 58, NULL),
(105, 19, 58, 59, NULL),
(106, 19, 59, 60, NULL),
(107, 19, 60, NULL, 14),
(108, 20, 3, 61, NULL),
(109, 20, 61, 62, NULL),
(110, 20, 62, 63, NULL),
(111, 20, 63, 64, NULL),
(112, 20, 64, 65, NULL),
(113, 20, 65, NULL, 15),
(114, 21, 3, 66, NULL),
(115, 21, 66, 68, NULL),
(116, 21, 68, 69, NULL),
(117, 21, 69, 77, NULL),
(118, 21, 77, NULL, 16),
(119, 22, 3, 70, NULL),
(120, 22, 70, 71, NULL),
(121, 22, 71, 72, NULL),
(122, 22, 72, 73, NULL),
(123, 22, 73, NULL, 17),
(124, 23, 1, 27, NULL),
(125, 23, 27, 74, NULL),
(126, 23, 74, 75, NULL),
(127, 23, 75, 76, NULL),
(128, 23, 76, 77, NULL),
(129, 23, 77, 78, NULL),
(130, 23, 78, NULL, 18),
(131, 24, 1, 14, NULL),
(132, 24, 14, 27, NULL),
(133, 24, 27, 75, NULL),
(134, 24, 75, 76, NULL),
(135, 24, 76, 79, NULL),
(136, 24, 79, 80, NULL),
(137, 24, 80, 81, NULL),
(138, 24, 81, 82, NULL),
(139, 24, 82, 83, NULL),
(140, 24, 83, NULL, 19),
(141, 25, 3, 84, NULL),
(142, 25, 84, 85, NULL),
(143, 25, 85, NULL, 20),
(144, 26, 3, 86, NULL),
(145, 26, 86, 87, NULL),
(146, 26, 87, 88, NULL),
(147, 26, 88, NULL, 21),
(148, 27, 3, 50, NULL),
(149, 27, 50, 87, NULL),
(150, 27, 87, 88, NULL),
(151, 27, 88, NULL, 22);

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
-- Indexes for table `ms_gejala`
--
ALTER TABLE `ms_gejala`
  ADD PRIMARY KEY (`id_ms_gejala`);

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
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_role` (`id_role`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ms_gejala`
--
ALTER TABLE `ms_gejala`
  MODIFY `id_ms_gejala` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT for table `ms_penyakit`
--
ALTER TABLE `ms_penyakit`
  MODIFY `id_ms_penyakit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `rule`
--
ALTER TABLE `rule`
  MODIFY `id_rule` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `rule_breadth`
--
ALTER TABLE `rule_breadth`
  MODIFY `id_rule_breadth` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=152;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

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
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`id_role`) REFERENCES `role` (`id`);


CREATE TABLE tmp_konsultasi (
	id_tmp_konsultasi int PRIMARY KEY AUTO_INCREMENT,
    id_ms_gejala int,
    id_prev_gejala int,
    id_user int,
    FOREIGN KEY(id_ms_gejala) REFERENCES ms_gejala(id_ms_gejala),
    FOREIGN KEY(id_prev_gejala) REFERENCES ms_gejala(id_ms_gejala),
    FOREIGN KEY(id_user) REFERENCES users(id)
);
  
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
