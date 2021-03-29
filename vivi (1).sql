-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 24, 2021 at 01:33 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vivi`
--

-- --------------------------------------------------------

--
-- Table structure for table `akses_kelas_guru`
--

CREATE TABLE `akses_kelas_guru` (
  `akses_kelas_guru_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `kelas_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `akses_kelas_guru`
--

INSERT INTO `akses_kelas_guru` (`akses_kelas_guru_id`, `user_id`, `kelas_id`) VALUES
(4, 22, 2),
(7, 22, 1),
(8, 24, 2),
(9, 24, 1),
(10, 22, 3);

-- --------------------------------------------------------

--
-- Table structure for table `akses_kelas_walikelas`
--

CREATE TABLE `akses_kelas_walikelas` (
  `akses_kelas_walikelas_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `kelas_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `akses_kelas_walikelas`
--

INSERT INTO `akses_kelas_walikelas` (`akses_kelas_walikelas_id`, `user_id`, `kelas_id`) VALUES
(4, 22, 3);

-- --------------------------------------------------------

--
-- Table structure for table `guru`
--

CREATE TABLE `guru` (
  `guru_id` int(11) NOT NULL,
  `nama_guru` varchar(200) NOT NULL,
  `jenis_kelamin` varchar(50) NOT NULL,
  `no_hp` varchar(200) NOT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `guru`
--

INSERT INTO `guru` (`guru_id`, `nama_guru`, `jenis_kelamin`, `no_hp`, `alamat`) VALUES
(1, 'anisa', 'Perempuan', '083874731480', 'Bekasi');

-- --------------------------------------------------------

--
-- Table structure for table `history_karyawan`
--

CREATE TABLE `history_karyawan` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `info` varchar(255) NOT NULL,
  `tanggal` varchar(255) NOT NULL,
  `user_agent` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `history_karyawan`
--

INSERT INTO `history_karyawan` (`id`, `nama`, `info`, `tanggal`, `user_agent`) VALUES
(888, 'Admin Aplikasi', 'Admin Aplikasi Telah melakukan login', '04/12/2020 14:55:41', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.198 Safari/537.36'),
(889, 'Admin Aplikasi', 'Admin Aplikasi Telah melakukan login', '04/12/2020 14:57:32', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:83.0) Gecko/20100101 Firefox/83.0'),
(890, 'Admin Aplikasi', 'Admin Aplikasi Telah melakukan login', '04/12/2020 19:16:25', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.198 Safari/537.36'),
(891, 'Admin Aplikasi', 'Admin Aplikasi Telah melakukan login', '05/12/2020 09:14:36', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.198 Safari/537.36'),
(892, 'Admin Aplikasi', 'Admin Aplikasi Telah melakukan login', '05/12/2020 10:10:58', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.198 Safari/537.36'),
(893, 'Admin Aplikasi', 'Admin Aplikasi Telah melakukan login', '05/12/2020 10:14:29', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.198 Safari/537.36'),
(894, 'Admin Aplikasi', 'Admin Aplikasi Telah melakukan login', '05/12/2020 10:21:37', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.198 Safari/537.36'),
(895, 'Admin Aplikasi', 'Admin Aplikasi Telah melakukan login', '06/12/2020 16:46:04', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.198 Safari/537.36'),
(896, 'Admin Aplikasi', 'Admin Aplikasi Telah melakukan login', '07/12/2020 10:06:18', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.198 Safari/537.36'),
(897, 'Admin Aplikasi', 'Admin Aplikasi Telah melakukan login', '08/12/2020 00:24:57', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.198 Safari/537.36'),
(898, 'adminwad', 'adminwad Telah melakukan login', '08/12/2020 00:40:19', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.198 Safari/537.36'),
(899, 'Admin Aplikasi', 'Admin Aplikasi Telah melakukan login', '08/12/2020 01:04:16', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.198 Safari/537.36'),
(900, 'Admin Aplikasi', 'Admin Aplikasi Telah melakukan login', '08/12/2020 18:54:15', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.198 Safari/537.36'),
(901, 'adminwad', 'adminwad Telah melakukan login', '08/12/2020 19:11:53', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.198 Safari/537.36'),
(902, 'adminksp', 'adminksp Telah melakukan login', '08/12/2020 19:12:34', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.198 Safari/537.36'),
(903, 'adminwad', 'adminwad Telah melakukan login', '08/12/2020 19:22:20', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.198 Safari/537.36'),
(904, 'Admin Aplikasi', 'Admin Aplikasi Telah melakukan login', '08/12/2020 19:41:41', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.198 Safari/537.36'),
(905, 'adminwad', 'adminwad Telah melakukan login', '08/12/2020 19:44:05', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.198 Safari/537.36'),
(906, 'Admin Aplikasi', 'Admin Aplikasi Telah melakukan login', '08/12/2020 20:24:32', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.198 Safari/537.36'),
(907, 'adminwad', 'adminwad Telah melakukan login', '08/12/2020 20:29:28', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.198 Safari/537.36'),
(908, 'Admin Aplikasi', 'Admin Aplikasi Telah melakukan login', '09/12/2020 18:34:02', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.198 Safari/537.36'),
(909, 'Admin Aplikasi', 'Admin Aplikasi Telah melakukan login', '09/12/2020 18:35:54', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.198 Safari/537.36'),
(910, 'adminwad', 'adminwad Telah melakukan login', '09/12/2020 18:36:08', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.198 Safari/537.36'),
(911, 'Admin Aplikasi', 'Admin Aplikasi Telah melakukan login', '10/12/2020 17:03:14', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.88 Safari/537.36'),
(912, 'Admin Aplikasi', 'Admin Aplikasi Telah melakukan login', '10/12/2020 17:43:23', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.88 Safari/537.36'),
(913, 'Admin Aplikasi', 'Admin Aplikasi Telah melakukan login', '11/12/2020 19:11:25', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.88 Safari/537.36'),
(914, 'Admin Aplikasi', 'Admin Aplikasi Telah melakukan login', '11/12/2020 20:25:48', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.88 Safari/537.36'),
(915, 'Admin Aplikasi', 'Admin Aplikasi Telah melakukan login', '11/12/2020 20:26:26', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.88 Safari/537.36'),
(916, 'Admin Aplikasi', 'Admin Aplikasi Telah melakukan login', '13/12/2020 10:40:55', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.88 Safari/537.36'),
(917, 'Admin Aplikasi', 'Admin Aplikasi Telah melakukan login', '13/12/2020 11:58:51', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.88 Safari/537.36'),
(918, 'Admin Aplikasi', 'Admin Aplikasi Telah melakukan login', '13/12/2020 11:59:03', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.88 Safari/537.36'),
(919, 'Admin Aplikasi', 'Admin Aplikasi Telah melakukan login', '13/12/2020 19:24:27', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.88 Safari/537.36'),
(920, 'Admin Aplikasi', 'Admin Aplikasi Telah melakukan login', '13/12/2020 21:00:09', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.88 Safari/537.36'),
(921, 'Admin Aplikasi', 'Admin Aplikasi Telah melakukan login', '13/12/2020 21:11:51', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.88 Safari/537.36'),
(922, 'Admin Aplikasi', 'Admin Aplikasi Telah melakukan login', '13/12/2020 21:12:43', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.88 Safari/537.36'),
(923, 'Admin Aplikasi', 'Admin Aplikasi Telah melakukan login', '13/12/2020 21:13:50', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.88 Safari/537.36'),
(924, 'Admin Aplikasi', 'Admin Aplikasi Telah melakukan login', '13/12/2020 21:14:25', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.88 Safari/537.36'),
(925, 'Admin Aplikasi', 'Admin Aplikasi Telah melakukan login', '13/12/2020 21:38:36', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.88 Safari/537.36'),
(926, 'Admin Aplikasi', 'Admin Aplikasi Telah melakukan login', '13/12/2020 21:39:32', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.88 Safari/537.36'),
(927, 'Admin Aplikasi', 'Admin Aplikasi Telah melakukan login', '13/12/2020 21:39:50', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.88 Safari/537.36'),
(928, 'ramdan', 'ramdan Telah melakukan login', '14/12/2020 01:22:10', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.88 Safari/537.36'),
(929, 'Admin Aplikasi', 'Admin Aplikasi Telah melakukan login', '14/12/2020 01:24:28', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.88 Safari/537.36'),
(930, 'Admin Aplikasi', 'Admin Aplikasi Telah melakukan login', '14/12/2020 11:02:17', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.88 Safari/537.36'),
(931, 'Admin Aplikasi', 'Admin Aplikasi Telah melakukan login', '15/12/2020 13:48:50', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.88 Safari/537.36'),
(932, 'Admin Aplikasi', 'Admin Aplikasi Telah melakukan login', '16/12/2020 12:35:13', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.88 Safari/537.36'),
(933, 'Admin Aplikasi', 'Admin Aplikasi Telah melakukan login', '20/12/2020 18:13:05', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.88 Safari/537.36'),
(934, 'Admin Aplikasi', 'Admin Aplikasi Telah melakukan login', '20/12/2020 19:04:24', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.88 Safari/537.36'),
(935, 'Admin Aplikasi', 'Admin Aplikasi Telah melakukan login', '20/12/2020 19:07:32', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.88 Safari/537.36'),
(936, 'Admin Aplikasi', 'Admin Aplikasi Telah melakukan login', '20/12/2020 19:39:50', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.88 Safari/537.36'),
(937, 'Admin Aplikasi', 'Admin Aplikasi Telah melakukan login', '20/12/2020 19:40:43', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.88 Safari/537.36'),
(938, 'Admin Aplikasi', 'Admin Aplikasi Telah melakukan login', '20/12/2020 19:46:17', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.88 Safari/537.36'),
(939, 'Admin Aplikasi', 'Admin Aplikasi Telah melakukan login', '20/12/2020 20:14:39', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.88 Safari/537.36'),
(940, 'Admin Aplikasi', 'Admin Aplikasi Telah melakukan login', '21/12/2020 12:33:28', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.88 Safari/537.36'),
(941, 'Admin Aplikasi', 'Admin Aplikasi Telah melakukan login', '21/12/2020 21:33:58', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.88 Safari/537.36'),
(942, 'Admin Aplikasi', 'Admin Aplikasi Telah melakukan login', '22/12/2020 15:56:23', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.88 Safari/537.36'),
(943, 'Admin Aplikasi', 'Admin Aplikasi Telah melakukan login', '23/12/2020 21:00:16', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.88 Safari/537.36'),
(944, 'Admin Aplikasi', 'Admin Aplikasi Telah melakukan login', '24/12/2020 01:32:39', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.88 Safari/537.36'),
(945, 'Admin Aplikasi', 'Admin Aplikasi Telah melakukan login', '24/12/2020 12:14:18', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.88 Safari/537.36'),
(946, 'Admin Aplikasi', 'Admin Aplikasi Telah melakukan login', '24/12/2020 12:15:13', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.88 Safari/537.36'),
(947, 'Admin Aplikasi', 'Admin Aplikasi Telah melakukan login', '26/01/2021 23:06:00', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.104 Safari/537.36'),
(948, 'Admin Aplikasi', 'Admin Aplikasi Telah melakukan login', '02/02/2021 13:26:15', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.104 Safari/537.36'),
(949, 'Admin Aplikasi', 'Admin Aplikasi Telah melakukan login', '16/02/2021 11:07:40', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.150 Safari/537.36'),
(950, 'Admin Aplikasi', 'Admin Aplikasi Telah melakukan login', '16/02/2021 11:20:07', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.150 Safari/537.36'),
(951, 'Admin Aplikasi', 'Admin Aplikasi Telah melakukan login', '19/02/2021 21:00:59', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.182 Safari/537.36'),
(952, 'Admin Aplikasi', 'Admin Aplikasi Telah melakukan login', '02/03/2021 13:36:30', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.190 Safari/537.36'),
(953, 'Admin Aplikasi', 'Admin Aplikasi Telah melakukan login', '04/03/2021 15:01:26', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.190 Safari/537.36'),
(954, 'Admin Aplikasi', 'Admin Aplikasi Telah melakukan login', '16/03/2021 10:54:15', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36'),
(955, 'Admin Aplikasi', 'Admin Aplikasi Telah melakukan login', '16/03/2021 12:40:15', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36'),
(956, 'Admin Aplikasi', 'Admin Aplikasi Telah melakukan login', '16/03/2021 12:42:13', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36'),
(957, 'Admin Aplikasi', 'Admin Aplikasi Telah melakukan login', '16/03/2021 13:02:18', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36'),
(958, 'Admin Aplikasi', 'Admin Aplikasi Telah melakukan login', '16/03/2021 14:28:25', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36'),
(959, 'Admin Aplikasi', 'Admin Aplikasi Telah melakukan login', '16/03/2021 14:29:36', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36'),
(960, 'Admin Aplikasi', 'Admin Aplikasi Telah melakukan login', '16/03/2021 14:30:05', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36'),
(961, 'Admin Aplikasi', 'Admin Aplikasi Telah melakukan login', '23/03/2021 19:08:48', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.90 Safari/537.36'),
(962, 'Admin Aplikasi', 'Admin Aplikasi Telah melakukan login', '24/03/2021 06:39:00', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.90 Safari/537.36'),
(963, 'Admin Aplikasi', 'Admin Aplikasi Telah melakukan login', '24/03/2021 06:39:18', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.90 Safari/537.36'),
(964, 'ramdan', 'ramdan Telah melakukan login', '24/03/2021 06:51:57', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.90 Safari/537.36');

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `kelas_id` int(11) NOT NULL,
  `nama_kelas` varchar(200) NOT NULL,
  `guru_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`kelas_id`, `nama_kelas`, `guru_id`) VALUES
(1, 'Kelas 1', 1),
(2, 'Kelas 2', 1),
(3, 'Kelas 3', 1);

-- --------------------------------------------------------

--
-- Table structure for table `nilai`
--

CREATE TABLE `nilai` (
  `nilai_id` int(11) NOT NULL,
  `siswa_id` int(11) NOT NULL,
  `surat_jilid` varchar(200) NOT NULL,
  `ayat_halaman` int(11) NOT NULL,
  `nilai` int(11) NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `siswa_id` int(11) NOT NULL,
  `nama_siswa` varchar(200) NOT NULL,
  `jenis_kelamin` varchar(50) NOT NULL,
  `kelas_id` int(11) NOT NULL,
  `nama_ibu` varchar(200) NOT NULL,
  `nama_ayah` varchar(200) NOT NULL,
  `no_hp_wali_murid` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`siswa_id`, `nama_siswa`, `jenis_kelamin`, `kelas_id`, `nama_ibu`, `nama_ayah`, `no_hp_wali_murid`) VALUES
(1, 'siswa 1', 'Laki Laki', 1, 'solihat', 'ade', '083874731480');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `level` int(1) NOT NULL,
  `email` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `password`, `name`, `address`, `level`, `email`) VALUES
(1, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'Admin Aplikasi', 'Perumahan Sai Residance', 1, 'saepulramdan244@gmail.com'),
(22, 'ramdan', 'c82d0d61d09a320743d6602a998b3d48a0ac4f82', 'ramdan', 'bekasi', 2, 'saepulramdan2444@gmail.com'),
(23, 'reza4', 'c82d0d61d09a320743d6602a998b3d48a0ac4f82', 'reza', 'bekasi', 4, 'reza@gmail.com'),
(24, 'guru123', 'c82d0d61d09a320743d6602a998b3d48a0ac4f82', 'guru', 'bekasi', 3, 'guru@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `id` int(11) NOT NULL,
  `role` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`id`, `role`) VALUES
(1, 'Admin Aplikasi'),
(2, 'Wali Kelas'),
(3, 'Guru'),
(4, 'Murid');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `akses_kelas_guru`
--
ALTER TABLE `akses_kelas_guru`
  ADD PRIMARY KEY (`akses_kelas_guru_id`);

--
-- Indexes for table `akses_kelas_walikelas`
--
ALTER TABLE `akses_kelas_walikelas`
  ADD PRIMARY KEY (`akses_kelas_walikelas_id`);

--
-- Indexes for table `guru`
--
ALTER TABLE `guru`
  ADD PRIMARY KEY (`guru_id`);

--
-- Indexes for table `history_karyawan`
--
ALTER TABLE `history_karyawan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`kelas_id`);

--
-- Indexes for table `nilai`
--
ALTER TABLE `nilai`
  ADD PRIMARY KEY (`nilai_id`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`siswa_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `level` (`level`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `akses_kelas_guru`
--
ALTER TABLE `akses_kelas_guru`
  MODIFY `akses_kelas_guru_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `akses_kelas_walikelas`
--
ALTER TABLE `akses_kelas_walikelas`
  MODIFY `akses_kelas_walikelas_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `guru`
--
ALTER TABLE `guru`
  MODIFY `guru_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `history_karyawan`
--
ALTER TABLE `history_karyawan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=965;

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `kelas_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `nilai`
--
ALTER TABLE `nilai`
  MODIFY `nilai_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `siswa`
--
ALTER TABLE `siswa`
  MODIFY `siswa_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`level`) REFERENCES `user_role` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
