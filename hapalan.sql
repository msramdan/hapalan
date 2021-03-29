-- --------------------------------------------------------
-- Host:                         localhost
-- Server version:               5.7.24 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping structure for table hapalan.akses_kelas_guru
CREATE TABLE IF NOT EXISTS `akses_kelas_guru` (
  `akses_kelas_guru_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `kelas_id` int(11) NOT NULL,
  PRIMARY KEY (`akses_kelas_guru_id`),
  KEY `kelas_id` (`kelas_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table hapalan.akses_kelas_guru: ~9 rows (approximately)
DELETE FROM `akses_kelas_guru`;
/*!40000 ALTER TABLE `akses_kelas_guru` DISABLE KEYS */;
INSERT INTO `akses_kelas_guru` (`akses_kelas_guru_id`, `user_id`, `kelas_id`) VALUES
	(4, 22, 2),
	(7, 22, 1),
	(8, 24, 2),
	(9, 24, 1),
	(10, 22, 3),
	(11, 25, 3),
	(12, 26, 2),
	(13, 38, 2),
	(14, 39, 1);
/*!40000 ALTER TABLE `akses_kelas_guru` ENABLE KEYS */;

-- Dumping structure for table hapalan.akses_kelas_walikelas
CREATE TABLE IF NOT EXISTS `akses_kelas_walikelas` (
  `akses_kelas_walikelas_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `kelas_id` int(11) NOT NULL,
  PRIMARY KEY (`akses_kelas_walikelas_id`),
  KEY `user_id` (`user_id`),
  KEY `kelas_id` (`kelas_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table hapalan.akses_kelas_walikelas: ~4 rows (approximately)
DELETE FROM `akses_kelas_walikelas`;
/*!40000 ALTER TABLE `akses_kelas_walikelas` DISABLE KEYS */;
INSERT INTO `akses_kelas_walikelas` (`akses_kelas_walikelas_id`, `user_id`, `kelas_id`) VALUES
	(4, 22, 3),
	(6, 25, 1),
	(7, 41, 3),
	(8, 41, 1);
/*!40000 ALTER TABLE `akses_kelas_walikelas` ENABLE KEYS */;

-- Dumping structure for table hapalan.guru
CREATE TABLE IF NOT EXISTS `guru` (
  `guru_id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_guru` varchar(200) NOT NULL,
  `jenis_kelamin` varchar(50) NOT NULL,
  `no_hp` varchar(200) NOT NULL,
  `alamat` text NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`guru_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table hapalan.guru: ~3 rows (approximately)
DELETE FROM `guru`;
/*!40000 ALTER TABLE `guru` DISABLE KEYS */;
INSERT INTO `guru` (`guru_id`, `nama_guru`, `jenis_kelamin`, `no_hp`, `alamat`, `user_id`) VALUES
	(1, 'guru abang', 'Laki Laki', '12345', '12345', 38),
	(2, 'guru_kelas1', 'Perempuan', 'guru_kelas1', 'guru_kelas1', 39),
	(3, 'walikelas', 'Laki Laki', 'walikelas', 'walikelas', 41);
/*!40000 ALTER TABLE `guru` ENABLE KEYS */;

-- Dumping structure for table hapalan.history_karyawan
CREATE TABLE IF NOT EXISTS `history_karyawan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `info` varchar(255) NOT NULL,
  `tanggal` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_agent` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- Dumping data for table hapalan.history_karyawan: ~8 rows (approximately)
DELETE FROM `history_karyawan`;
/*!40000 ALTER TABLE `history_karyawan` DISABLE KEYS */;
INSERT INTO `history_karyawan` (`id`, `username`, `info`, `tanggal`, `user_id`, `user_agent`) VALUES
	(1, 'admin', 'admin Telah melakukan login', '26/03/2021 13:24:16', 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.90 Safari/537.36'),
	(2, 'guruu', 'guruu Telah melakukan login', '26/03/2021 17:42:06', 38, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.90 Safari/537.36'),
	(3, 'admin', 'admin Telah melakukan login', '26/03/2021 17:46:20', 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.90 Safari/537.36'),
	(4, 'walikelas123', 'walikelas123 Telah melakukan login', '26/03/2021 18:07:25', 41, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.90 Safari/537.36'),
	(5, 'admin', 'admin Telah melakukan login', '26/03/2021 18:08:02', 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.90 Safari/537.36'),
	(6, 'walikelas123', 'walikelas123 Telah melakukan login', '26/03/2021 18:09:26', 41, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.90 Safari/537.36'),
	(7, 'admin', 'admin Telah melakukan login', '26/03/2021 18:15:21', 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.90 Safari/537.36'),
	(8, 'walikelas123', 'walikelas123 Telah melakukan login', '26/03/2021 18:17:32', 41, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.90 Safari/537.36');
/*!40000 ALTER TABLE `history_karyawan` ENABLE KEYS */;

-- Dumping structure for table hapalan.kelas
CREATE TABLE IF NOT EXISTS `kelas` (
  `kelas_id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_kelas` varchar(200) NOT NULL,
  PRIMARY KEY (`kelas_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table hapalan.kelas: ~3 rows (approximately)
DELETE FROM `kelas`;
/*!40000 ALTER TABLE `kelas` DISABLE KEYS */;
INSERT INTO `kelas` (`kelas_id`, `nama_kelas`) VALUES
	(1, 'Kelas 1'),
	(2, 'Kelas 2'),
	(3, 'Kelas 3');
/*!40000 ALTER TABLE `kelas` ENABLE KEYS */;

-- Dumping structure for table hapalan.nilai
CREATE TABLE IF NOT EXISTS `nilai` (
  `nilai_id` int(11) NOT NULL AUTO_INCREMENT,
  `siswa_id` int(11) NOT NULL,
  `ayat_mulai` int(11) DEFAULT NULL,
  `ayat_selesai` int(11) DEFAULT NULL,
  `surat_id_mulai` int(11) DEFAULT NULL,
  `surat_id_selesai` int(11) DEFAULT NULL,
  `juz` int(11) DEFAULT NULL,
  `akumulasi` int(11) DEFAULT NULL,
  `nilai` int(11) NOT NULL,
  `tipe` enum('1','2','') DEFAULT NULL COMMENT '1:harian;2:ujian;',
  `tanggal` date NOT NULL,
  `tahun_ajaran_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`nilai_id`),
  KEY `siswa_id` (`siswa_id`),
  KEY `surat_id_mulai` (`surat_id_mulai`),
  KEY `surat_id_selesai` (`surat_id_selesai`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table hapalan.nilai: ~2 rows (approximately)
DELETE FROM `nilai`;
/*!40000 ALTER TABLE `nilai` DISABLE KEYS */;
INSERT INTO `nilai` (`nilai_id`, `siswa_id`, `ayat_mulai`, `ayat_selesai`, `surat_id_mulai`, `surat_id_selesai`, `juz`, `akumulasi`, `nilai`, `tipe`, `tanggal`, `tahun_ajaran_id`) VALUES
	(4, 7, 100, 123, 1, 1, NULL, NULL, 100, '1', '2021-03-26', 2),
	(5, 7, 100, 120, 2, 3, NULL, NULL, 100, '1', '2021-03-26', 1);
/*!40000 ALTER TABLE `nilai` ENABLE KEYS */;

-- Dumping structure for table hapalan.siswa
CREATE TABLE IF NOT EXISTS `siswa` (
  `siswa_id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_siswa` varchar(200) NOT NULL,
  `jenis_kelamin` varchar(50) NOT NULL,
  `kelas_id` int(11) NOT NULL,
  `nama_ibu` varchar(200) NOT NULL,
  `nama_ayah` varchar(200) NOT NULL,
  `no_hp_wali_murid` varchar(20) NOT NULL,
  `user_id` varchar(200) NOT NULL,
  PRIMARY KEY (`siswa_id`),
  KEY `user_id` (`user_id`),
  KEY `kelas_id` (`kelas_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table hapalan.siswa: ~2 rows (approximately)
DELETE FROM `siswa`;
/*!40000 ALTER TABLE `siswa` DISABLE KEYS */;
INSERT INTO `siswa` (`siswa_id`, `nama_siswa`, `jenis_kelamin`, `kelas_id`, `nama_ibu`, `nama_ayah`, `no_hp_wali_murid`, `user_id`) VALUES
	(6, 'siswa', 'Laki Laki', 3, 'siswa ibu 1', 'siswa ayah 1', '312', '37'),
	(7, 'siswa_kelas1', 'Laki Laki', 1, 'siswa_kelas1', 'siswa_kelas1', '123', '40');
/*!40000 ALTER TABLE `siswa` ENABLE KEYS */;

-- Dumping structure for table hapalan.surat
CREATE TABLE IF NOT EXISTS `surat` (
  `surat_id` int(11) NOT NULL AUTO_INCREMENT,
  `surat_indonesia` varchar(50) NOT NULL,
  `surat_arab` varchar(50) CHARACTER SET utf8 NOT NULL,
  `arti` varchar(100) NOT NULL,
  `jumlah_ayat` int(11) NOT NULL,
  `tempat_turun` varchar(50) NOT NULL,
  `urutan_pewahyuan` int(11) NOT NULL,
  PRIMARY KEY (`surat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=115 DEFAULT CHARSET=latin1;

-- Dumping data for table hapalan.surat: ~114 rows (approximately)
DELETE FROM `surat`;
/*!40000 ALTER TABLE `surat` DISABLE KEYS */;
INSERT INTO `surat` (`surat_id`, `surat_indonesia`, `surat_arab`, `arti`, `jumlah_ayat`, `tempat_turun`, `urutan_pewahyuan`) VALUES
	(1, 'Surah Al-Fatihah', 'الفاتحة', 'Pembukaan', 7, 'Mekkah', 5),
	(2, 'Surah Al-Baqarah', 'البقرة', 'Sapi Betina', 286, 'Madinah', 87),
	(3, 'Surah Ali `Imran', 'آل عمران', 'Keluarga `Imran', 200, 'Madinah', 89),
	(4, 'Surah An-Nisa`', 'النّساء', 'Wanita', 176, 'Madinah', 92),
	(5, 'Surah Al-Ma`idah', 'المآئدة', 'Jamuan (hidangan makanan)', 120, 'Madinah', 112),
	(6, 'Surah Al-An`am', 'الانعام', 'Binatang Ternak', 165, 'Mekkah', 55),
	(7, 'Surah Al-A’raf', 'الأعراف', 'Tempat yang tertinggi', 206, 'Mekkah', 39),
	(8, 'Surah Al-Anfal', 'الأنفال', 'Harta rampasan perang', 75, 'Madinah', 88),
	(9, 'Surah At-Taubah', 'التوبة‎‎', 'Pengampunan', 129, 'Madinah', 113),
	(10, 'Surah Yunus', 'ينوس', 'Nabi Yunus', 109, 'Mekkah', 51),
	(11, 'Surah Hud', 'هود', 'Nabi Hud', 123, 'Mekkah', 52),
	(12, 'Surah Yusuf', 'يسوف', 'Nabi Yusuf', 111, 'Mekkah', 53),
	(13, 'Surah Ar-Ra’d', 'الرّعد', 'Guruh (petir)', 43, 'Mekkah', 96),
	(14, 'Surah Ibrahim', 'إبراهيم', 'Nabi Ibrahim', 52, 'Mekkah', 72),
	(15, 'Surah Al-Hijr', 'الحجر', 'Al Hijr (nama gunung)', 99, 'Mekkah', 54),
	(16, 'Surah An-Nahl', 'النّحل', 'Lebah', 128, 'Mekkah', 70),
	(17, 'Surah Al-Isra`', 'الإسرا', 'Perjalanan Malam', 111, 'Mekkah', 50),
	(18, 'Surah Al-Kahf', 'الكهف', 'Penghuni-penghuni gua', 110, 'Mekkah', 69),
	(19, 'Surah Maryam', 'مريم', 'Maryam (Maria)', 98, 'Mekkah', 44),
	(20, 'Surah Ta Ha', 'طه', 'Ta Ha', 135, 'Mekkah', 45),
	(21, 'Surah Al-Anbiya', 'الأنبياء', 'Nabi-Nabi', 112, 'Mekkah', 73),
	(22, 'Surah Al-Hajj', 'الحجّ', 'Haji', 78, 'Madinah & Makkah', 103),
	(23, 'Surah Al-Mu’minun', 'المؤمنون', 'Orang-orang mukmin', 118, 'Mekkah', 74),
	(24, 'Surah An-Nur', 'النّور', 'Cahaya', 64, 'Madinah', 102),
	(25, 'Surah Al-Furqan', 'الفرقان', 'Pembeda', 77, 'Mekkah', 42),
	(26, 'Surah Asy-Syu`ara`', 'الشّعراء', 'Penyair', 227, 'Mekkah', 47),
	(27, 'Surah An-Naml', 'النّمل', 'Semut', 93, 'Mekkah', 48),
	(28, 'Surah Al-Qasas', 'القصص', 'Cerita', 88, 'Mekkah', 49),
	(29, 'Surah Al-`Ankabut', 'العنكبوت', 'Laba-laba', 69, 'Mekkah', 85),
	(30, 'Surah Ar-Rum', 'الرّوم', 'Bangsa Romawi', 60, 'Mekkah', 84),
	(31, 'Surah Luqman', 'لقمان', 'Keluarga Luqman', 34, 'Mekkah', 57),
	(32, 'Surah As-Sajdah', 'السّجدة', 'Sajdah', 30, 'Mekkah', 75),
	(33, 'Surah Al-Ahzab', 'الْأحزاب', 'Golongan-Golongan yang bersekutu', 73, 'Madinah', 90),
	(34, 'Surah Saba’', 'سبا', 'Kaum Saba`', 54, 'Mekkah', 58),
	(35, 'Surah Fatir', 'فاطر', 'Pencipta', 45, 'Mekkah', 43),
	(36, 'Surah Ya Sin', 'يس', 'Yaasiin', 83, 'Mekkah', 41),
	(37, 'Surah As-Saffat', 'الصّافات', 'Barisan-barisan', 182, 'Mekkah', 56),
	(38, 'Surah Sad', 'ص', 'Shaad', 88, 'Mekkah', 38),
	(39, 'Surah Az-Zumar', 'الزّمر', 'Rombongan-rombongan', 75, 'Mekkah', 59),
	(40, 'Surah Al-Mu’min', 'المؤمن', 'Orang yg Beriman', 85, 'Mekkah', 60),
	(41, 'Surah Fussilat', 'فصّلت', 'Yang dijelaskan', 54, 'Mekkah', 61),
	(42, 'Surah Asy-Syura', 'الشّورى', 'Musyawarah', 53, 'Mekkah', 62),
	(43, 'Surah Az-Zukhruf', 'الزّخرف', 'Perhiasan', 89, 'Mekkah', 63),
	(44, 'Surah Ad-Dukhan', 'الدّخان', 'Kabut', 59, 'Mekkah', 64),
	(45, 'Surah Al-Jasiyah', 'الجاثية', 'Yang bertekuk lutut', 37, 'Mekkah', 65),
	(46, 'Surah Al-Ahqaf', 'الَأحقاف', 'Bukit-bukit pasir', 35, 'Mekkah', 66),
	(47, 'Surah Muhammad', 'محمّد', 'Muhammad', 38, 'Madinah', 95),
	(48, 'Surah Al-Fath', 'الفتح', 'Kemenangan', 29, 'Madinah', 111),
	(49, 'Surah Al-Hujurat', 'الحجرات', 'Kamar-kamar', 18, 'Madinah', 106),
	(50, 'Surah Qaf', 'ق', 'Qaaf', 45, 'Mekkah', 34),
	(51, 'Surah Az-Zariyat', 'الذّاريات', 'Angin yang menerbangkan', 60, 'Mekkah', 67),
	(52, 'Surah At-Tur', 'الطّور', 'Bukit', 49, 'Mekkah', 76),
	(53, 'Surah An-Najm', 'النّجْم', 'Bintang', 62, 'Mekkah', 23),
	(54, 'Surah Al-Qamar', 'القمر', 'Bulan', 55, 'Mekkah', 37),
	(55, 'Surah Ar-Rahman', 'الرّحْمن', 'Yang Maha Pemurah', 78, 'Madinah & Mekkah', 97),
	(56, 'Surah Al-Waqi’ah', 'الواقعه', 'Hari Kiamat', 96, 'Mekkah', 46),
	(57, 'Surah Al-Hadid', 'الحديد', 'Besi', 29, 'Madinah', 94),
	(58, 'Surah Al-Mujadilah', 'المجادلة', 'Wanita yang mengajukan gugatan', 22, 'Madinah', 105),
	(59, 'Surah Al-Hasyr', 'الحشْر', 'Pengusiran', 24, 'Madinah', 101),
	(60, 'Surah Al-Mumtahanah', 'الممتحنة', 'Wanita yang diuji', 13, 'Madinah', 91),
	(61, 'Surah As-Saff', 'الصّفّ', 'Satu barisan', 14, 'Madinah', 109),
	(62, 'Surah Al-Jumu’ah', 'الجمعة', 'Hari Jum’at', 11, 'Madinah', 110),
	(63, 'Surah Al-Munafiqun', 'المنافقون', 'Orang-orang yang munafik', 11, 'Madinah', 104),
	(64, 'Surah At-Tagabun', 'التّغابن', 'Hari dinampakkan kesalahan-kesalahan', 18, 'Madinah', 108),
	(65, 'Surah At-Talaq', 'الطّلاق', 'Talak', 12, 'Madinah', 99),
	(66, 'Surah At-Tahrim', 'التّحريم', 'Mengharamkan', 12, 'Madinah', 107),
	(67, 'Surah Al-Mulk', 'الملك', 'Kerajaan', 30, 'Mekkah', 77),
	(68, 'Surah Al-Qalam', 'القلم', 'Pena', 52, 'Mekkah', 2),
	(69, 'Surah Al-Haqqah', 'الحآقّة', 'Hari kiamat', 52, 'Mekkah', 78),
	(70, 'Surah Al-Ma’arij', 'المعارج', 'Tempat naik', 44, 'Mekkah', 79),
	(71, 'Surah Nuh', 'نوح', 'Nuh', 28, 'Mekkah', 71),
	(72, 'Surah Al-Jinn', 'الجنّ', 'Jin', 28, 'Mekkah', 40),
	(73, 'Surah Al-Muzzammil', 'المزمّل', 'Orang yang berselimut', 20, 'Mekkah', 3),
	(74, 'Surah Al-Muddassir', 'المدشّر', 'Orang yang berkemul', 56, 'Mekkah', 4),
	(75, 'Surah Al-Qiyamah', 'القيمة', 'Hari Kiamat', 40, 'Mekkah', 31),
	(76, 'Surah Al-Insan', 'الْاٍنسان', 'Manusia', 31, 'Madinah', 98),
	(77, 'Surah Al-Mursalat', 'المرسلات', 'Malaikat-Malaikat Yang Diutus', 50, 'Mekkah', 33),
	(78, 'Surah An-Naba’', 'النّبا', 'Berita besar', 40, 'Mekkah', 80),
	(79, 'Surah An-Nazi’at', 'النّازعات', 'Malaikat-Malaikat Yang Mencabut', 46, 'Mekkah', 81),
	(80, 'Surah `Abasa', 'عبس', 'Ia Bermuka masam', 42, 'Mekkah', 24),
	(81, 'Surah At-Takwir', 'التّكوير', 'Menggulung', 29, 'Mekkah', 7),
	(82, 'Surah Al-Infitar', 'الانفطار', 'Terbelah', 19, 'Mekkah', 82),
	(83, 'Surah Al-Tatfif', 'المطفّفين', 'Orang-orang yang curang', 36, 'Mekkah', 86),
	(84, 'Surah Al-Insyiqaq', 'الانشقاق', 'Terbelah', 25, 'Mekkah', 83),
	(85, 'Surah Al-Buruj', 'البروج', 'Gugusan bintang', 22, 'Mekkah', 27),
	(86, 'Surah At-Tariq', 'الطّارق', 'Yang datang di malam hari', 17, 'Mekkah', 36),
	(87, 'Surah Al-A’la', 'الْأعلى', 'Yang paling tinggi', 19, 'Mekkah', 8),
	(88, 'Surah Al-Gasyiyah', 'الغاشية', 'Hari Pembalasan', 26, 'Mekkah', 68),
	(89, 'Surah Al-Fajr', 'الفجر', 'Fajar', 30, 'Mekkah', 10),
	(90, 'Surah Al-Balad', 'البلد', 'Negeri', 20, 'Mekkah', 35),
	(91, 'Surah Asy-Syams', 'الشّمس', 'Matahari', 15, 'Mekkah', 26),
	(92, 'Surah Al-Lail', 'الّيل', 'Malam', 21, 'Mekkah', 9),
	(93, 'Surah Ad-Duha', 'الضحى‎‎', 'Waktu matahari sepenggalahan naik (Dhuha)', 11, 'Mekkah', 11),
	(94, 'Surah Al-Insyirah', 'الانشراح‎‎', 'Melapangkan', 8, 'Mekkah', 12),
	(95, 'Surah At-Tin', 'التِّينِ', 'Buah Tin', 8, 'Mekkah', 28),
	(96, 'Surah Al-`Alaq', 'العَلَق', 'Segumpal Darah', 19, 'Mekkah', 1),
	(97, 'Surah Al-Qadr', 'الْقَدْرِ', 'Kemuliaan', 5, 'Mekkah', 25),
	(98, 'Surah Al-Bayyinah', 'الْبَيِّنَةُ', 'Pembuktian', 8, 'Madinah', 100),
	(99, 'Surah Az-Zalzalah', 'الزلزلة‎‎', 'Kegoncangan', 8, 'Madinah', 93),
	(100, 'Surah Al-`Adiyat', 'العاديات‎‎', 'Berlari kencang', 11, 'Mekkah', 14),
	(101, 'Surah Al-Qari`ah', 'القارعة‎‎', 'Hari Kiamat', 11, 'Mekkah', 30),
	(102, 'Surah At-Takasur', 'التكاثر‎‎', 'Bermegah-megahan', 8, 'Mekkah', 16),
	(103, 'Surah Al-`Asr', 'العصر', 'Masa/Waktu', 3, 'Mekkah', 13),
	(104, 'Surah Al-Humazah', 'الهُمَزة‎‎', 'Pengumpat', 9, 'Mekkah', 32),
	(105, 'Surah Al-Fil', 'الْفِيلِ', 'Gajah', 5, 'Mekkah', 19),
	(106, 'Surah Quraisy', 'قُرَيْشٍ', 'Suku Quraisy', 4, 'Mekkah', 29),
	(107, 'Surah Al-Ma’un', 'الْمَاعُونَ', 'Barang-barang yang berguna', 7, 'Mekkah', 17),
	(108, 'Surah Al-Kausar', 'الكوثر', 'Nikmat yang berlimpah', 3, 'Mekkah', 15),
	(109, 'Surah Al-Kafirun', 'الْكَافِرُونَ', 'Orang-orang kafir', 6, 'Mekkah', 18),
	(110, 'Surah An-Nasr', 'النصر‎‎', 'Pertolongan', 3, 'Madinah', 114),
	(111, 'Surah Al-Lahab', 'المسد‎‎', 'Gejolak Api/ Sabut', 5, 'Mekkah', 6),
	(112, 'Surah Al-Ikhlas', 'الإخلاص‎‎', 'Ikhlas', 4, 'Mekkah', 22),
	(113, 'Surah Al-Falaq', 'الْفَلَقِ', 'Waktu Subuh', 5, 'Mekkah', 20),
	(114, 'Surah An-Nas', 'النَّاسِ', 'Manusia', 6, 'Mekkah', 21);
/*!40000 ALTER TABLE `surat` ENABLE KEYS */;

-- Dumping structure for table hapalan.tahun_ajaran
CREATE TABLE IF NOT EXISTS `tahun_ajaran` (
  `tahun_ajaran_id` int(11) NOT NULL AUTO_INCREMENT,
  `tahun_ajaran` varchar(50) DEFAULT NULL,
  `semester` enum('1','2','') DEFAULT '',
  `status` enum('0','1') DEFAULT '0' COMMENT '0:nonaktif;1:aktif;',
  PRIMARY KEY (`tahun_ajaran_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table hapalan.tahun_ajaran: ~2 rows (approximately)
DELETE FROM `tahun_ajaran`;
/*!40000 ALTER TABLE `tahun_ajaran` DISABLE KEYS */;
INSERT INTO `tahun_ajaran` (`tahun_ajaran_id`, `tahun_ajaran`, `semester`, `status`) VALUES
	(1, '2019/2020', '1', '1'),
	(2, '2019/2020', '2', '1');
/*!40000 ALTER TABLE `tahun_ajaran` ENABLE KEYS */;

-- Dumping structure for table hapalan.user
CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `level` int(1) NOT NULL COMMENT 'from user_role table',
  `email` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  KEY `level` (`level`),
  CONSTRAINT `user_ibfk_1` FOREIGN KEY (`level`) REFERENCES `user_role` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table hapalan.user: ~11 rows (approximately)
DELETE FROM `user`;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`user_id`, `username`, `password`, `level`, `email`) VALUES
	(1, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 1, 'admin@email.com'),
	(22, 'ramdan', 'c82d0d61d09a320743d6602a998b3d48a0ac4f82', 2, 'saepulramdan2444@gmail.com'),
	(23, 'reza4', 'c82d0d61d09a320743d6602a998b3d48a0ac4f82', 4, 'reza@gmail.com'),
	(24, 'guru123', 'c82d0d61d09a320743d6602a998b3d48a0ac4f82', 3, 'guru@gmail.com'),
	(25, 'walikelas', 'c858d81f76993346613bb529f2428236998e33a8', 2, 'walikelas@email.com'),
	(26, 'guru1', '0179623986141524e6531c21334ba9227e57a6bf', 3, 'guru@email.com'),
	(37, 'siswa', '7a24156a1971d85acf2ae64d9dbdf5322566636f', 4, 'siswa@email.com'),
	(38, 'guruu', '0179623986141524e6531c21334ba9227e57a6bf', 3, 'guru1@email.com'),
	(39, 'guru_kelas1', 'fa305b6d7b4ce3f51176402b18c94c4fc3e5cd32', 3, 'guru_kelas1@email.com'),
	(40, 'siswa_kelas1', 'e3122e7211fd688817f156ea3f55a2e243cc1eb1', 4, 'siswa_kelas1@email.com'),
	(41, 'walikelas123', 'c858d81f76993346613bb529f2428236998e33a8', 2, 'walikelas123@email.com');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

-- Dumping structure for table hapalan.user_role
CREATE TABLE IF NOT EXISTS `user_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table hapalan.user_role: ~4 rows (approximately)
DELETE FROM `user_role`;
/*!40000 ALTER TABLE `user_role` DISABLE KEYS */;
INSERT INTO `user_role` (`id`, `role`) VALUES
	(1, 'Admin Aplikasi'),
	(2, 'Wali Kelas'),
	(3, 'Guru'),
	(4, 'Murid');
/*!40000 ALTER TABLE `user_role` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
