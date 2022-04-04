-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 04 Apr 2022 pada 04.41
-- Versi server: 10.7.3-MariaDB
-- Versi PHP: 8.1.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pakar_kucing`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `aturan`
--

CREATE TABLE `aturan` (
  `id` int(11) NOT NULL,
  `gejala` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_penyakit` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `aturan`
--

INSERT INTO `aturan` (`id`, `gejala`, `id_penyakit`) VALUES
(1, '1,4,6,10,18', 1),
(2, '1,2,3,5,7,11,12,19,20,21,22,24,25', 2),
(3, '1,2,3,4,5,7,13,14,26', 3),
(4, '1,2,5,15,27,28', 4),
(5, '2,9,13,28,29,30', 5),
(6, '1,2,4,6,7,10,31,32,33', 6),
(7, '2,3,4,5,6,7,8,12,35,55', 7),
(9, '3,7,9,14,36,37,38,39,53,54', 8),
(10, '1,11,17,40,41,42,43,44', 9),
(11, '1,3,8,45,46,47,48,50,51', 10),
(12, '2,3,14,16,38', 11),
(13, '4,5,7,10,15,52', 12);

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_gejala_konsultasi`
--

CREATE TABLE `detail_gejala_konsultasi` (
  `id` int(11) NOT NULL,
  `id_konsultasi` int(11) DEFAULT NULL,
  `id_gejala` int(11) DEFAULT NULL,
  `jawaban` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `detail_gejala_konsultasi`
--

INSERT INTO `detail_gejala_konsultasi` (`id`, `id_konsultasi`, `id_gejala`, `jawaban`) VALUES
(1, 1, 1, 0),
(2, 1, 2, 0),
(3, 1, 5, 0),
(4, 1, 12, 0),
(5, 1, 19, 0),
(6, 1, 22, 0),
(7, 1, 23, 0),
(8, 2, 1, 0),
(9, 2, 2, 0),
(10, 2, 19, 0),
(11, 2, 20, 0),
(12, 2, 22, 0),
(13, 3, 1, 0),
(14, 3, 2, 0),
(15, 3, 3, 0),
(16, 3, 9, 0),
(17, 3, 15, 0),
(18, 3, 18, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_penyakit_konsultasi`
--

CREATE TABLE `detail_penyakit_konsultasi` (
  `id` int(11) NOT NULL,
  `id_konsultasi` int(11) DEFAULT NULL,
  `id_penyakit` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `detail_penyakit_konsultasi`
--

INSERT INTO `detail_penyakit_konsultasi` (`id`, `id_konsultasi`, `id_penyakit`) VALUES
(1, 1, 4),
(2, 2, 2),
(3, 2, 3),
(4, 2, 4),
(5, 2, 6),
(6, 3, 2),
(7, 3, 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `gejala`
--

CREATE TABLE `gejala` (
  `id` int(11) NOT NULL,
  `kode_gejala` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_gejala` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `penjelasan_gejala` text COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `gejala`
--

INSERT INTO `gejala` (`id`, `kode_gejala`, `nama_gejala`, `penjelasan_gejala`) VALUES
(1, 'G01', 'Penurunan Berat Badan', NULL),
(2, 'G02', 'Nafsu Makan Hilang', NULL),
(3, 'G03', 'Demam', NULL),
(4, 'G04', 'Muntah-muntah', NULL),
(5, 'G05', 'Diare', NULL),
(6, 'G06', 'Dehidrasi', NULL),
(7, 'G07', 'Lemas', NULL),
(8, 'G08', 'Depresi', '<p>Ciri &ndash; ciri kucing yang mengalami gejala depresi, sebagai berikut:</p>\r\n\r\n<ul>\r\n	<li><strong>Perubahan suara&nbsp;</strong>:&nbsp;Kucing mengeong lebih seringa tau kurang dari biasanya. Ini adalah indikasi yang sangat jelas bahwa kucing mungkin tengah tidak Bahagia. Suara-suara yang tidak menyenangkan ini biasanya terdengar melengkin dengan nada sedih.&nbsp;</li>\r\n	<li><strong>Bahasa tubuh&nbsp;</strong>:&nbsp;Terkadang bahasa tubuh kucing dapat ditunjukkan kepada pemilik kucing jika mereka sedang tidak bahagia. Hal ini bisa dilihat dari posisi mata, telinga, bulu, serta tubuh. Telinga tertahan, ekor terselip, bulu berdiri tegak, dan tanda tubuh lainnya adalah bentuk komunikasi diam yang menunjukkan kucing sedang bersedih.&nbsp;Tanda lain dari Bahasa tubuh yang ditunjukkan kucing adalah agresi atau ketakutan. Kucing yang sedang sedih cenderung lebih rektif dan berperilaku agresif atau ketakutan. Jika melihat perubahan perilaku yang menyebabkan kucing ketakutan atau agresif secara tidak normal, itu artinya kucing dalam kondisi sedih.</li>\r\n	<li><strong>Kehilangan minat&nbsp;</strong>:&nbsp;sama dengan manusia, kucing juga dapat kehilangan minat pada aktivitas apa pun saat sedih atau depresi. Kucing berubah memilih bersembunyi, pendiam, bermalas-malasan, serta menjadi penyendiri. Hal ini juga tak menutupi kemungkjnan pada kucing yang memiliki perangi pendiam. Kucing akan semakin pendiam serta takut terhadap orang asing saat mengalami depresi.</li>\r\n	<li><strong>Tidur berlebihan&nbsp;</strong>:&nbsp;Kucing biasanya banyak tidur, tetapi kucing yang tengah sedih atau depresi akan lebih sering tidur. Selain itu, mereka memilih tidur di tempat berbeda, yang bukan lokasi favoritnya.</li>\r\n	<li><strong>Perubahan penampilan&nbsp;</strong>:&nbsp;Kucing yang berubah penampilan menjadi terlihat kusam sudah pasti mengalami ketidakbahagiaan dan Kesehatan yang buruk. Kucing yang mengalami depresi sering berhenti merapikan diri atau enggan dirawat sehingga lebih kusam.</li>\r\n	<li><strong>Nafsu makan berubah</strong>&nbsp;:&nbsp;Apabila kucing berhenti makan atau nafsu makannya berubah, kucing mungkin tengah tidak senang terhadap sesuatu. Kucing yang depresi mungkin mengabaikan makanan yang sebelumnya mereka sukai, bahkan kehilangan minat pada cemilan favoritnya.</li>\r\n	<li><strong>Buang air kecil sembarangan&nbsp;</strong>:&nbsp;Kucing sedang sedih mungkin menggunakan baunya sendiri untuk merasa lebih baik dengan buang air kecil di tempat yang tidak tepat. Biasanya, kucing yang sedih akan buang air kecil di sembarang tempat dan menyebarkan bau mereka sendiri.</li>\r\n	<li><strong>Menggaruk berlebihan&nbsp;</strong>:&nbsp;Jika kucing sedih atau depresi, kucing mungkin mulai menggaruk benda lebih dari biasanya untuk menghilangkan stress dan menandai wilayahnya.&nbsp;&nbsp;&nbsp;</li>\r\n</ul>\r\n'),
(9, 'G09', 'Hidung Berlendir', NULL),
(10, 'G010', 'Kencing Secara Berlebihan', NULL),
(11, 'G011', 'Kejang', NULL),
(12, 'G012', 'Anemia', '<p>Ciri &ndash; ciri kucing yang mengalami anemia, sebagai berikut:</p>\r\n\r\n<ul>\r\n	<li><strong>Pucat</strong>&nbsp;:&nbsp;ini merupakan tanda umum pada kucing yang dapat dilihat melalui area sekitar mata dan mulutnya. Di kedua bagian tubuh itu, selaput lendir terlihat pucat karena hemoglobin dalam tubuh yang sedikit.</li>\r\n	<li><strong>Lemah </strong>:<strong>&nbsp;</strong>Ini merupakan salah satu tanda bahwa kucing mengalami anemia dengan tingkat berat. Selain itu bila anemia dalam kondisi parah, dapat meningkatkan detak jantung dan meningkatkan laju pernapasan.</li>\r\n	<li><strong>Kuning&nbsp;</strong>:&nbsp;Perubahan warna ini terlihat pada selaput lendir. Tanda &ndash; tanda penyakit kuning yang paling ditemui karena adanya masalah di bagian hati kucing karena rusaknya sel darah merah.</li>\r\n	<li><strong>Pica&nbsp;</strong>:&nbsp;Ini merupakan tanda kucing anemia dengan cirinya yaitu keinginan terhadap makanan yang nggak biasa. Paling sering, dimanifestasikan kepada perilaku kucing yang lebih menyukai menjilat beton, makanan tanah, bahkan makan kotorannya sendiri.</li>\r\n</ul>\r\n'),
(13, 'G013', 'Mata Berair', NULL),
(14, 'G014', 'Bersin', NULL),
(15, 'G015', 'Bulu Kering', NULL),
(16, 'G016', 'Hidung Berair', NULL),
(17, 'G017', 'Bulu Kusam', NULL),
(18, 'G018', 'Nafsu Makan Yang Berlebihan', NULL),
(19, 'G019', 'Gingivitis (gusi)', '<p>Gingivitis terjadi ketika gusi mengalami apabila peradangan yang di tandai dengan gusi berwarna merah dan bengkak, serta terasa sakit yang dimuali dari tahap 0 (normal) sampai tahap 4 (parah). Di tahap 1, bisa dilihat adanya tartar yang melapisi gigi serta gusi yang merah dan bengkak. Tahap selanjutnya gusi terlihat semakin membengkak dan kemungkinan adanya akar gigi yang hilang. Di tahap 3, hilangnya akar gigi semakain parah. Dan di tahap 4 kondisi semakin parah, mulai dari tartar yang semakin menumpuk, penyusutan lapisan gusi, kerusakan gigi, dan pengeroposan tulang gigi.</p>\r\n'),
(20, 'G020', 'Pembekakan Pada Kelenjar Getah Bening ', '<p>Pembekakan pada kelenjar getah bening terjadi linfoglandula yang selalu terdapat di area di bawah dagu, ketiak, dan kaki belakang.</p>\r\n'),
(21, 'G021', 'Lesi Kulit, Semacam Jaringan Abnormal Pada Kulit', NULL),
(22, 'G022', 'Sakit Kuning', NULL),
(23, 'G023', 'Anisocoria Atau Pupil Mata Kanan Berbeda Ukuran Dengan Mata Kiri', NULL),
(24, 'G024', 'Infeksi Pada Kulit, Kandung Kemih Dan Saluran Pernafasan', '<p>Infeksi pada kulit, kandung kemih terjadi buang air kecil lebih sedikit, tidak buang air kecil sama sekali, ketidaknyamanan saat buang air kecil, dan urin yang berwarna kemerahan (berdarah). Kondisi ini dapat disimpulkan bahwa kucing mengalami infeksi saluran kemih. Ini dapat menjadi penyebab atau akibat dari obstruksi kemih. Obstruksi kemih terjadi Ketika uretra tersumbat dan urin tidak bisa keluar. Ini disebabkan oleh sedimen atau kristal dalam urin atau peradangan dalam saluran kemih. Obstruksi saluran kemih lebih sering menyerang kucing jantan dari pada betina. Hal ini karena jantan memiliki uretra yang lebih panjang dan lebih sempit. Sejumlah kecil sedimen, lendir, atau peradangan jaringan dapat menghalangi uretra dan membuat buang air kecil menjadi sulit atau bahkan tidak keluar sama sekali.</p>\r\n'),
(25, 'G025', 'Infertilitas', '<p>Kucing jantan dan betina biasanya menunjukkan birahi pertama kali pada bulan 6 bulan atau 7 bulan tetapi sebaiknya tidak di kawinkan pada masa birahi pertama. Kucing mencapai pubertas setelah berumur lebih 1 tahun. Jika kucing betina mengalami kemandulan maka rahimnya di angkat. Sedangkan kucing jantan mengalami kemandulan maka harus di kebiri.</p>\r\n'),
(26, 'G026', 'Perut Membesar Dan Berisi Cairan', '<p>Asites pada kucing dapat dipengaruhi oleh banyak faktor penyebab. Asites pada kucing adalah suatu kondisi yang ditandai dengan akumulasi cairan di perut, dan dapat bervariasi dalam tingkat keparahan. Biasanya, pembentukan cairan prosesnya bertahap. Cairan yang terakumulasi ke perut akan berasal dari pembuluh darah, dan organ dalam.</p>\r\n'),
(27, 'G027', 'Infeksi Mulut', NULL),
(28, 'G028', 'Munculnya Beberapa Masalah Pernafasan', NULL),
(29, 'G029', 'Luka Pada Lidah Dan Bibir', NULL),
(30, 'G030', 'Sakit Sendi', NULL),
(31, 'G031', 'Mual', NULL),
(32, 'G032', 'Suara Bergemeretak Atau Retak Diradang', NULL),
(33, 'G033', 'Sembelit', NULL),
(34, 'G034', 'Halitosis', '<p>Halitosis merupakan bau mulut yang dialami kucing. Meski kerap menyalahkan makanan kucing sebagai penyebabnya, sumber bau sebenanrnya dari bakteri di mulut kucing. Bakteri bekerja dengan air liur, menghasilkan enzim yang memulai proses pencernaan. Selama proses tersebut, senyawa yang dihasilkan berbau busuk. Masalah bau mulut kucing kemudian bertambah parah Ketika terlalu banyak bakteri yang berkeliaran di mulutnya. Saat bakteri bertambah menumpuk di mulut kucing, mereka membentuk lapisan di sekitar gigi yang disebut plak. Jika ditangani, plak bercampur dengan mineral dalam air liur dan mengeras menjadi karang gigi. Saat karang gigi menebal, gusi di sekitarnya gigi menyusut, memperlihatkan akar gigi, dan mengakibatkan kerusakan gusi dan gigi.</p>\r\n'),
(35, 'G035', 'Menggigit Ekor Dan Kaki Belakang', NULL),
(36, 'G036', 'Hilang Kemampuan Kucing Dalam Mencium Bau', NULL),
(37, 'G037', 'Mata Mengeluarkan Kotoran', NULL),
(38, 'G038', 'Radang Mata', NULL),
(39, 'G039', 'Bahkan Hingga Keguguran', NULL),
(40, 'G040', 'Muntah Cacing', NULL),
(41, 'G041', 'Perut Membesar', NULL),
(42, 'G042', 'Pingsan', NULL),
(43, 'G043', 'Hingga Akhirnya Mati', NULL),
(44, 'G044', 'Pup Lemek, Kadang Terdapat Cacaing', NULL),
(45, 'G045', 'Konjungtivitis', '<p>Apabila mata kucing mulai membengkak dan kemerahan, atau keluarnya cairan berwarna (misalnya hijau atau kuning) dari mata, kemungkinan kucing mengalami kekambuhan kongjungtivitis. Gejala kekambuhan lainnya termasuk peningkatan produksi air mata, mata menyipit, dan sensitive terhadap cahaya terang.</p>\r\n'),
(46, 'G046', 'Menguap', NULL),
(47, 'G047', 'Perilaku Aneh', '<p>Perubahan perilaku ini ternyata bisa menjadi pertanda bahwa ada sesuatu yang tidak beres, sebagai berikut:</p>\r\n\r\n<ul>\r\n	<li><strong>Depresi&nbsp;</strong>:&nbsp;Seekor kucing yang bertingkah aneh mungkin sedang mengalami depresi. Seekor kucing yang kehilangan teman kesayangannya, misalnya, mungkin akan berperilaku serupa. Kucing menjadi mendadak tidak doyan makan, bahkan mengabaikan camilan, dan tidur lebih lama dari biasanya, yakni 18 jam per hari.</li>\r\n	<li><strong>Stress&nbsp;</strong>:&nbsp;Kucing mungkin terbiasa berlarian di rumah yang luas dengan halaman luas, kemudian di ajak untuk pindah ke apartemen yang sempit dan semuanya berbeda. Ini bisa membuat kucing merasa bingnug dan menjadi stress.&nbsp;</li>\r\n</ul>\r\n'),
(48, 'G048', 'Mengeluarkan Air Liur ', NULL),
(49, 'G049', 'Kejang Otot', NULL),
(50, 'G050', 'Hiperaktif', NULL),
(51, 'G051', 'Agresif', NULL),
(52, 'G052', 'Perubahan Nafsu Makan', NULL),
(53, 'G053', 'Sering Memejamkan Mata', NULL),
(54, 'G054', 'Bau Mulut Amis', NULL),
(55, 'G055', 'Bau Mulut Busuk', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `konsultasi`
--

CREATE TABLE `konsultasi` (
  `id` int(11) NOT NULL,
  `nama_pemilik_hewan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_hewan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `usia_hewan` int(11) DEFAULT NULL,
  `tanggal_konsultasi` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `konsultasi`
--

INSERT INTO `konsultasi` (`id`, `nama_pemilik_hewan`, `nama_hewan`, `usia_hewan`, `tanggal_konsultasi`) VALUES
(1, 'barok', 'hachi', 2, '2022-04-01'),
(2, 'barok', 'hachi', 5, '2022-04-01'),
(3, 'barok', 'hendri', 2, '2022-04-04');

-- --------------------------------------------------------

--
-- Struktur dari tabel `penyakit`
--

CREATE TABLE `penyakit` (
  `id` int(11) NOT NULL,
  `kode_penyakit` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_penyakit` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pengobatan_penyakit` text COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `penyakit`
--

INSERT INTO `penyakit` (`id`, `kode_penyakit`, `nama_penyakit`, `pengobatan_penyakit`) VALUES
(1, 'P1', 'Diabetes', '<ul>\r\n	<li>Pemberian anti vomit, anti diuretik, pola makannya di atur. Pada<br />\r\n	penyakit ini harus di periksa ke dokter hewan agar di beri racikan obat pada penyakit ini.</li>\r\n</ul>\r\n'),
(2, 'P2', 'Feline Leukimia Virus', '<ul>\r\n	<li>Pemberian obat radang, obat diare / transfusi darah, obat tetes mata /<br />\r\n	salep mata, injeksi obat antivirus, injeksi antibiotik, di paksa makan agar menaikan imunitas dengan di beri kuning telur mentah, madu, dll. Pada penyakit ini harus di periksa ke dokter hewan agar di beri penanganan lebih lanjut</li>\r\n</ul>\r\n'),
(3, 'P3', 'Feline Infectious Peritonitis', '<ul>\r\n	<li>Pemberian obat vitamin, antivomit, obat radang, obat flu, obat diare /<br />\r\n	transfusi darah, obat tetes mata / salep mata, injeksi antivirus, antibiotik, di paksa makan agar menaikan imunitas dengan di beri kuning telur mentah, madu, dll. Pada penyakit ini harus di periksa ke dokter hewan agar di beri penanganan lebih lanjut.</li>\r\n</ul>\r\n'),
(4, 'P4', 'Feline Immunodeficiency Virus', '<ul>\r\n	<li>Pemberian obat diare / transfusi darah, spray dental, injeksi antivirus,<br />\r\n	antibiotik, di paksa makan agar menaikan imunitas dengan di beri kuning telur mentah, madu, dll. Pada penyakit ini harus di periksa ke dokter hewan agar di beri penanganan lebih lanjut.</li>\r\n</ul>\r\n'),
(5, 'P5', 'Feline Calici Virus', '<ul>\r\n	<li>Pemberian spray dental, vaksin pada umur 2 bulan, obat tetes mata /<br />\r\n	salep mata, injeksi antivirus, antibiotik, di paksa makan agar menaikan imunitas dengan di beri kuning telur mentah, madu, dll. Pada penyakit ini harus di periksa ke dokter hewan agar di beri penanganan lebih lanjut.</li>\r\n</ul>\r\n'),
(6, 'P6', 'Gagal Ginjal', '<ul>\r\n	<li>Pemberian obat vitamin, obat diuretik, air rebusan kumis kucing, anti vomit&nbsp;di paksa makan agar menaikan imunitas dengan menggunakan alat suntik tanpa&nbsp;jarum di beri kuning telur mentah, madu, dll &nbsp;Jika si kucing tidak ingin untuk makan,&nbsp;maka pakannya harus di ganti. Pada penyakit ini harus di periksa ke dokter hewan&nbsp;agar di beri penanganan lebih lanjut</li>\r\n</ul>\r\n'),
(7, 'P7', 'Feline Panleukopenia Virus', '<ul>\r\n	<li>Pemberian injeksi antivirus, antibiotik, antivomit, obat diare /<br />\r\n	transfusi darah, obat vitamin, obat radang, di paksa makan agar menaikan imunitas dengan di beri kuning telur mentah, madu, dll &nbsp;Jika si kucing tidak berkeingin untuk makan, maka pakannya harus di ganti. Pada penyakit ini harus di periksa ke dokter hewan agar di beri penanganan lebih lanjut.</li>\r\n</ul>\r\n'),
(8, 'P8', 'Feline Rhinotracheitis', '<ul>\r\n	<li>Pemberian injeksi antivirus, antibiotik, obat radang, obat flu, vaksin pada umur 2 bulan, obat tetes mata / salep mata. Pada penyakit ini harus di periksa ke dokter hewan agar di beri racikan obat pada penyakit ini</li>\r\n</ul>\r\n'),
(9, 'P9', 'Herminthiasis', '<ul>\r\n	<li>Pemberian drontal cat, obat cacing tetes, vaksin pada umur 2 bulan.&nbsp;Pada penyakit ini harus di periksa ke dokter hewan agar di beri penanganan&nbsp;lebih lanjut</li>\r\n</ul>\r\n'),
(10, 'P10', 'Rabies', '<ul>\r\n	<li>Pemberian obat radang, vaksin pada umur 6 bulan, dieksekusi / di<br />\r\n	bunuh. Pada penyakit ini harus di periksa ke dokter hewan agar di beri penanganan lebih lanjut</li>\r\n</ul>\r\n'),
(11, 'P11', 'Chimydophilosis', '<ul>\r\n	<li>Pemberian obat radang, obat flu, obat tetes mata / salep mata, di paksa<br />\r\n	makan agar menaikan imunitas dengan menggunakan alat suntik tanpa jarum di beri kuning telur mentah, madu, dll. Pada penyakit ini harus di periksa ke dokter hewan agar di beri racikan obat pada penyakit ini.</li>\r\n</ul>\r\n'),
(12, 'P12', 'Hipertiroid', '<ul>\r\n	<li>Pemberian anti vomit, anti dioretik, obat diare / transfusi darah. Pada penyakit&nbsp;ini harus di periksa ke dokter hewan agar di beri penanganan lebih lanjut.</li>\r\n</ul>\r\n');

-- --------------------------------------------------------

--
-- Struktur dari tabel `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `nama_role` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `role`
--

INSERT INTO `role` (`id`, `nama_role`) VALUES
(1, 'admin'),
(2, 'user');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `id_role` int(11) DEFAULT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `id_role`, `username`, `password`) VALUES
(1, 1, 'admin', '0192023a7bbd73250516f069df18b500'),
(2, 2, 'user', '6ad14ba9986e3615423dfca256d04e3f');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `aturan`
--
ALTER TABLE `aturan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_penyakit` (`id_penyakit`);

--
-- Indeks untuk tabel `detail_gejala_konsultasi`
--
ALTER TABLE `detail_gejala_konsultasi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_konsultasi` (`id_konsultasi`),
  ADD KEY `id_gejala` (`id_gejala`);

--
-- Indeks untuk tabel `detail_penyakit_konsultasi`
--
ALTER TABLE `detail_penyakit_konsultasi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_konsultasi` (`id_konsultasi`),
  ADD KEY `id_penyakit` (`id_penyakit`);

--
-- Indeks untuk tabel `gejala`
--
ALTER TABLE `gejala`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `konsultasi`
--
ALTER TABLE `konsultasi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `penyakit`
--
ALTER TABLE `penyakit`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_role` (`id_role`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `aturan`
--
ALTER TABLE `aturan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `detail_gejala_konsultasi`
--
ALTER TABLE `detail_gejala_konsultasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `detail_penyakit_konsultasi`
--
ALTER TABLE `detail_penyakit_konsultasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `gejala`
--
ALTER TABLE `gejala`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT untuk tabel `konsultasi`
--
ALTER TABLE `konsultasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `penyakit`
--
ALTER TABLE `penyakit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `aturan`
--
ALTER TABLE `aturan`
  ADD CONSTRAINT `aturan_ibfk_1` FOREIGN KEY (`id_penyakit`) REFERENCES `penyakit` (`id`);

--
-- Ketidakleluasaan untuk tabel `detail_gejala_konsultasi`
--
ALTER TABLE `detail_gejala_konsultasi`
  ADD CONSTRAINT `detail_gejala_konsultasi_ibfk_1` FOREIGN KEY (`id_konsultasi`) REFERENCES `konsultasi` (`id`),
  ADD CONSTRAINT `detail_gejala_konsultasi_ibfk_2` FOREIGN KEY (`id_gejala`) REFERENCES `gejala` (`id`);

--
-- Ketidakleluasaan untuk tabel `detail_penyakit_konsultasi`
--
ALTER TABLE `detail_penyakit_konsultasi`
  ADD CONSTRAINT `detail_penyakit_konsultasi_ibfk_1` FOREIGN KEY (`id_konsultasi`) REFERENCES `konsultasi` (`id`),
  ADD CONSTRAINT `detail_penyakit_konsultasi_ibfk_2` FOREIGN KEY (`id_penyakit`) REFERENCES `penyakit` (`id`);

--
-- Ketidakleluasaan untuk tabel `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`id_role`) REFERENCES `role` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
