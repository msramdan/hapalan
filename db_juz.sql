-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 07, 2021 at 03:15 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_juz`
--

-- --------------------------------------------------------

--
-- Table structure for table `access_guru_to_kelompok`
--

CREATE TABLE `access_guru_to_kelompok` (
  `access_guru_to_kelompok_id` int(11) NOT NULL,
  `guru_id` int(11) NOT NULL,
  `kelompok_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `app_setting`
--

CREATE TABLE `app_setting` (
  `id` int(11) NOT NULL,
  `nama_aplikasi` varchar(200) NOT NULL,
  `nama_sekolah` varchar(200) NOT NULL,
  `alamat_sekolah` text NOT NULL,
  `logo_sekolah` varchar(200) NOT NULL,
  `author` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `app_setting`
--

INSERT INTO `app_setting` (`id`, `nama_aplikasi`, `nama_sekolah`, `alamat_sekolah`, `logo_sekolah`, `author`) VALUES
(1, 'Aplikasi Hapalan Quran', 'SMP 12 Sukabumi', 'Perumahan Sai', 'File-211201-dbdc3ec94d.png', 'Muhammad Saeful Ramdan');

-- --------------------------------------------------------

--
-- Table structure for table `guru`
--

CREATE TABLE `guru` (
  `guru_id` int(11) NOT NULL,
  `nip` varchar(50) NOT NULL,
  `nama_guru` varchar(200) NOT NULL,
  `jenis_kelamin` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `guru`
--

INSERT INTO `guru` (`guru_id`, `nip`, `nama_guru`, `jenis_kelamin`, `alamat`, `user_id`) VALUES
(133, '9090', 'ramdan', 'Laki Laki', 'Bekasi', 54);

--
-- Triggers `guru`
--
DELIMITER $$
CREATE TRIGGER `del_akses_guru_to_kel` AFTER DELETE ON `guru` FOR EACH ROW BEGIN
DELETE FROM access_guru_to_kelompok
    WHERE access_guru_to_kelompok.guru_id = old.guru_id;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `del_user` AFTER DELETE ON `guru` FOR EACH ROW BEGIN
DELETE FROM user
    WHERE user.user_id = old.user_id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `history_login`
--

CREATE TABLE `history_login` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `info` varchar(255) NOT NULL,
  `tanggal` varchar(255) NOT NULL,
  `user_agent` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `history_login`
--

INSERT INTO `history_login` (`id`, `user_id`, `info`, `tanggal`, `user_agent`) VALUES
(194, 45, 'guru Telah melakukan login', '05/12/2021 04:30:32', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.45 Safari/537.36'),
(195, 45, 'guru Telah melakukan login', '05/12/2021 04:47:31', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.45 Safari/537.36'),
(196, 14, 'admin Telah melakukan login', '05/12/2021 04:50:38', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.45 Safari/537.36'),
(197, 45, 'guru Telah melakukan login', '05/12/2021 04:51:17', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.45 Safari/537.36'),
(198, 14, 'admin Telah melakukan login', '05/12/2021 05:01:43', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.45 Safari/537.36'),
(199, 27, 'guru Telah melakukan login', '05/12/2021 05:02:35', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.45 Safari/537.36'),
(200, 14, 'admin Telah melakukan login', '05/12/2021 05:12:15', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.45 Safari/537.36'),
(201, 14, 'admin Telah melakukan login', '05/12/2021 22:05:30', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.45 Safari/537.36'),
(202, 14, 'admin Telah melakukan login', '06/12/2021 09:56:33', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.45 Safari/537.36'),
(203, 14, 'admin Telah melakukan login', '06/12/2021 15:07:07', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.45 Safari/537.36'),
(204, 14, 'admin Telah melakukan login', '06/12/2021 20:41:05', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.45 Safari/537.36'),
(205, 52, '9090 Telah melakukan login', '06/12/2021 21:08:43', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.45 Safari/537.36'),
(206, 14, 'admin Telah melakukan login', '06/12/2021 22:20:07', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.45 Safari/537.36');

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `kelas_id` int(11) NOT NULL,
  `tingkat_id` int(11) NOT NULL,
  `nama_kelas` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`kelas_id`, `tingkat_id`, `nama_kelas`) VALUES
(2, 6, 'Kelas 6a'),
(3, 6, 'Kelas 6b'),
(4, 6, 'Kelas 6c'),
(5, 6, 'Kelas 6d'),
(6, 6, 'Kelas 6e'),
(7, 5, 'Kelas 5a');

-- --------------------------------------------------------

--
-- Table structure for table `kelompok`
--

CREATE TABLE `kelompok` (
  `kelompok_id` int(11) NOT NULL,
  `nama_kelompok` varchar(100) NOT NULL,
  `tahun_ajaran_id` int(11) NOT NULL,
  `tingkat_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kelompok`
--

INSERT INTO `kelompok` (`kelompok_id`, `nama_kelompok`, `tahun_ajaran_id`, `tingkat_id`) VALUES
(18, 'Kelompok 1A', 3, 6),
(19, 'Kelompok 1B', 8, 6),
(20, 'Kelompok 1E', 9, 6),
(21, 'Kelompok 1B', 3, 6),
(22, 'rewrew', 8, 6);

--
-- Triggers `kelompok`
--
DELIMITER $$
CREATE TRIGGER `del_kelompok_member` AFTER DELETE ON `kelompok` FOR EACH ROW BEGIN
DELETE FROM kelompok_member
    WHERE kelompok_member.kelompok_id = old.kelompok_id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `kelompok_detail`
--

CREATE TABLE `kelompok_detail` (
  `detail_kelompok_id` int(11) NOT NULL,
  `kelompok_id` int(11) NOT NULL,
  `semester` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kelompok_detail`
--

INSERT INTO `kelompok_detail` (`detail_kelompok_id`, `kelompok_id`, `semester`) VALUES
(1, 1, 1),
(2, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `kelompok_member`
--

CREATE TABLE `kelompok_member` (
  `kelompok_member_id` int(11) NOT NULL,
  `kelompok_id` int(11) NOT NULL,
  `siswa_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `sikap`
--

CREATE TABLE `sikap` (
  `sikap_id` int(11) NOT NULL,
  `siswa_id` int(11) DEFAULT NULL,
  `tertib` char(2) DEFAULT NULL,
  `disiplin` char(2) DEFAULT NULL,
  `motivasi` char(2) DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `tahun_ajaran_id` varchar(3) DEFAULT NULL,
  `semester` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sikap`
--

INSERT INTO `sikap` (`sikap_id`, `siswa_id`, `tertib`, `disiplin`, `motivasi`, `keterangan`, `tahun_ajaran_id`, `semester`) VALUES
(76, 124, 'C', 'B', 'A', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. ', '3', 1),
(79, 125, 'A', 'B', 'D', 'Bagus', '3', 0),
(80, 126, 'B', 'C', 'A', 'Bagus', '3', 0),
(81, 125, 'A', 'A', 'A', 'Bagus', '3', 1),
(82, 126, 'B', 'B', 'B', 'Kurang', '3', 1);

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `siswa_id` int(11) NOT NULL,
  `nis` varchar(200) DEFAULT NULL,
  `nisn` varchar(100) NOT NULL,
  `nama_siswa` varchar(200) NOT NULL,
  `jenis_kelamin` varchar(50) NOT NULL,
  `kelas_id` int(11) NOT NULL,
  `nama_ibu` varchar(200) NOT NULL,
  `nama_ayah` varchar(200) NOT NULL,
  `no_hp_wali_murid` varchar(20) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`siswa_id`, `nis`, `nisn`, `nama_siswa`, `jenis_kelamin`, `kelas_id`, `nama_ibu`, `nama_ayah`, `no_hp_wali_murid`, `user_id`) VALUES
(127, '2017310023', '1', 'murid1', 'Laki Laki', 7, 'Solihat', 'Ade', '83874731480', 55),
(128, '2017310024', '2', 'murid2', 'Laki Laki', 7, 'Solihat', 'Ade', '83874731480', 56),
(129, '2017310025', '3', 'murid3', 'Laki Laki', 7, 'Solihat', 'Ade', '83874731480', 57),
(130, '2017310026', '4', 'murid4', 'Laki Laki', 7, 'Solihat', 'Ade', '83874731480', 58);

--
-- Triggers `siswa`
--
DELIMITER $$
CREATE TRIGGER `del_user_siswa` AFTER DELETE ON `siswa` FOR EACH ROW BEGIN
DELETE FROM user
    WHERE user.user_id = old.user_id;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `hapus_daftar_siswa_kelompok_member` AFTER DELETE ON `siswa` FOR EACH ROW BEGIN
DELETE FROM kelompok_member
    WHERE kelompok_member.siswa_id = old.siswa_id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `surat`
--

CREATE TABLE `surat` (
  `surat_id` int(11) NOT NULL,
  `nama_surat` varchar(100) NOT NULL,
  `jumlah_ayat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `surat`
--

INSERT INTO `surat` (`surat_id`, `nama_surat`, `jumlah_ayat`) VALUES
(1, 'An Naba', 40),
(2, 'An Naazi’aat', 46);

-- --------------------------------------------------------

--
-- Table structure for table `tahun_ajaran`
--

CREATE TABLE `tahun_ajaran` (
  `tahun_ajaran_id` int(11) NOT NULL,
  `tahun_ajaran` varchar(50) DEFAULT NULL,
  `status` enum('0','1') DEFAULT '0' COMMENT '0:nonaktif;1:aktif;'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tahun_ajaran`
--

INSERT INTO `tahun_ajaran` (`tahun_ajaran_id`, `tahun_ajaran`, `status`) VALUES
(3, '2021/2022', '0'),
(8, '2022/2023', '1'),
(9, '2023/2024', '0');

-- --------------------------------------------------------

--
-- Table structure for table `tingkat`
--

CREATE TABLE `tingkat` (
  `tingkat_id` int(11) NOT NULL,
  `nama_tingkat` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tingkat`
--

INSERT INTO `tingkat` (`tingkat_id`, `nama_tingkat`) VALUES
(1, 'Tingkat 1'),
(2, 'Tingkat 2'),
(3, 'Tingkat 3'),
(4, 'Tingkat 4'),
(5, 'Tingkat 5'),
(6, 'Tingkat 6');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(200) NOT NULL,
  `photo` varchar(200) NOT NULL DEFAULT 'default.jpg',
  `level` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `password`, `photo`, `level`) VALUES
(14, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'default.jpg', 'ADMIN'),
(54, '9090', '143ad82c245be0610f3b3dc3b0bc94b2db721a3b', 'default.jpg', 'GURU'),
(55, '2017310023', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'default.jpg', 'SISWA'),
(56, '2017310024', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'default.jpg', 'SISWA'),
(57, '2017310025', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'default.jpg', 'SISWA'),
(58, '2017310026', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'default.jpg', 'SISWA');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `access_guru_to_kelompok`
--
ALTER TABLE `access_guru_to_kelompok`
  ADD PRIMARY KEY (`access_guru_to_kelompok_id`);

--
-- Indexes for table `app_setting`
--
ALTER TABLE `app_setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `guru`
--
ALTER TABLE `guru`
  ADD PRIMARY KEY (`guru_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `history_login`
--
ALTER TABLE `history_login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`kelas_id`),
  ADD KEY `tingkat_id` (`tingkat_id`);

--
-- Indexes for table `kelompok`
--
ALTER TABLE `kelompok`
  ADD PRIMARY KEY (`kelompok_id`),
  ADD KEY `tahun_ajaran_id` (`tahun_ajaran_id`),
  ADD KEY `tingkat_id` (`tingkat_id`);

--
-- Indexes for table `kelompok_detail`
--
ALTER TABLE `kelompok_detail`
  ADD PRIMARY KEY (`detail_kelompok_id`);

--
-- Indexes for table `kelompok_member`
--
ALTER TABLE `kelompok_member`
  ADD PRIMARY KEY (`kelompok_member_id`);

--
-- Indexes for table `sikap`
--
ALTER TABLE `sikap`
  ADD PRIMARY KEY (`sikap_id`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`siswa_id`),
  ADD KEY `kelas_id` (`kelas_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `surat`
--
ALTER TABLE `surat`
  ADD PRIMARY KEY (`surat_id`);

--
-- Indexes for table `tahun_ajaran`
--
ALTER TABLE `tahun_ajaran`
  ADD PRIMARY KEY (`tahun_ajaran_id`);

--
-- Indexes for table `tingkat`
--
ALTER TABLE `tingkat`
  ADD PRIMARY KEY (`tingkat_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `access_guru_to_kelompok`
--
ALTER TABLE `access_guru_to_kelompok`
  MODIFY `access_guru_to_kelompok_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `app_setting`
--
ALTER TABLE `app_setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `guru`
--
ALTER TABLE `guru`
  MODIFY `guru_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=134;

--
-- AUTO_INCREMENT for table `history_login`
--
ALTER TABLE `history_login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=207;

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `kelas_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `kelompok`
--
ALTER TABLE `kelompok`
  MODIFY `kelompok_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `kelompok_detail`
--
ALTER TABLE `kelompok_detail`
  MODIFY `detail_kelompok_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `kelompok_member`
--
ALTER TABLE `kelompok_member`
  MODIFY `kelompok_member_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT for table `sikap`
--
ALTER TABLE `sikap`
  MODIFY `sikap_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT for table `siswa`
--
ALTER TABLE `siswa`
  MODIFY `siswa_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=131;

--
-- AUTO_INCREMENT for table `surat`
--
ALTER TABLE `surat`
  MODIFY `surat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tahun_ajaran`
--
ALTER TABLE `tahun_ajaran`
  MODIFY `tahun_ajaran_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tingkat`
--
ALTER TABLE `tingkat`
  MODIFY `tingkat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `guru`
--
ALTER TABLE `guru`
  ADD CONSTRAINT `guru_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `kelas`
--
ALTER TABLE `kelas`
  ADD CONSTRAINT `kelas_ibfk_1` FOREIGN KEY (`tingkat_id`) REFERENCES `tingkat` (`tingkat_id`);

--
-- Constraints for table `kelompok`
--
ALTER TABLE `kelompok`
  ADD CONSTRAINT `kelompok_ibfk_1` FOREIGN KEY (`tahun_ajaran_id`) REFERENCES `tahun_ajaran` (`tahun_ajaran_id`),
  ADD CONSTRAINT `kelompok_ibfk_2` FOREIGN KEY (`tingkat_id`) REFERENCES `tingkat` (`tingkat_id`);

--
-- Constraints for table `siswa`
--
ALTER TABLE `siswa`
  ADD CONSTRAINT `siswa_ibfk_1` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`kelas_id`),
  ADD CONSTRAINT `siswa_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
