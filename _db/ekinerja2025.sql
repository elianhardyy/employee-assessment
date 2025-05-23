-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3307
-- Generation Time: May 23, 2025 at 03:15 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ekinerja2023`
--

-- --------------------------------------------------------

--
-- Table structure for table `jabatan`
--

CREATE TABLE `jabatan` (
  `id` int NOT NULL,
  `nama_jabatan` varchar(40) NOT NULL,
  `job_desc` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jabatan`
--

INSERT INTO `jabatan` (`id`, `nama_jabatan`, `job_desc`) VALUES
(3, 'Koordinator Produksi', 'sdskdksdkd'),
(4, 'Staf Produksi', 'trrddt'),
(5, 'Koordinator Penjualan', 'koordinator-penjualan'),
(6, 'Staf Penjualan', 'staf-penjualan'),
(7, 'Koordinator Gudang', 'bagian gudang\r\n'),
(8, 'Staf Gudang', 'staf gudang');

-- --------------------------------------------------------

--
-- Table structure for table `karyawan`
--

CREATE TABLE `karyawan` (
  `id` int NOT NULL,
  `nama` varchar(125) NOT NULL,
  `jenis_kelamin` varchar(255) DEFAULT NULL,
  `no_hp` varchar(255) DEFAULT NULL,
  `jabatan` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `karyawan`
--

INSERT INTO `karyawan` (`id`, `nama`, `jenis_kelamin`, `no_hp`, `jabatan`) VALUES
(2, 'Bskjasksdsdsd', 'Perempuan', '82331687039', 'Staf Produksi'),
(3, 'Auda hasib', 'Perempuan', '83845417223', 'Staf Produksi'),
(4, 'Bulla', 'Laki - laki', '82334431737', 'Staf Produksi'),
(6, 'Faruq', 'Laki - laki', '81999954797', 'Staf Produksi'),
(7, 'Holik', 'Laki - laki', '82335385175', 'Staf Produksi'),
(8, 'Irvan aini', 'Laki - laki', '87877446863', 'Staf Produksi'),
(10, 'Moch Sohib', 'Laki - laki', '81234331510', 'Staf Produksi'),
(11, 'Muhar Rahmad', 'Laki - laki', '87814507865', 'Staf Produksi'),
(13, 'Rofiah Madura', 'Perempuan', '85785824384', 'Staf Produksi'),
(14, 'Rofii Kusal', 'Laki - laki', '81999533474', 'Staf Produksi'),
(15, 'Rotul', 'Perempuan', '85813575804', 'Staf Produksi'),
(16, ' So Minsari ', 'Perempuan', '85233324272', 'Staf Produksi'),
(17, 'Sumiran', 'Laki - laki', '81235142712', 'Staf Produksi'),
(18, ' Wahid ', 'Laki - laki', '81232603311', 'Staf Produksi'),
(20, 'Hamideh', 'Perempuan', '882009063666', 'Staf Produksi'),
(21, 'Anwar', 'Perempuan', '85258248905', 'Staf Produksi'),
(22, 'Abah Saroni', 'Laki - laki', '85234855125', 'Staf Produksi'),
(23, 'Eli', 'Laki - laki', '85159511833', 'Koordinator Penjualan'),
(24, 'syafi’i', 'Laki - laki', '83129312976', 'Staf Penjualan'),
(25, 'Evi', 'Perempuan', '895351427715', 'Staf Penjualan'),
(28, 'Nur', 'Perempuan', '81330430218', 'Pemilik'),
(2110, 'Janjay', 'Laki - laki', '19293890', 'Staf Penjualan'),
(2111, 'kdjskldjs', 'Laki - laki', '090', 'Staf Penjualan'),
(2112, 'ananan', 'Laki - laki', '089677', 'Staf Produksi');

-- --------------------------------------------------------

--
-- Table structure for table `penilaian_akhir_koor_gudang`
--

CREATE TABLE `penilaian_akhir_koor_gudang` (
  `id_penilaian_akhir_koor_gudang` int NOT NULL,
  `id_karyawan_fk_gudang` int NOT NULL,
  `nilai_akhir` float NOT NULL,
  `id_periode_bulan_fk` int NOT NULL,
  `id_periode_tahun_fk` varchar(100) NOT NULL,
  `komentar_gudang` varchar(255) NOT NULL,
  `created_at_koor_gudang` datetime NOT NULL,
  `updated_at_koor_gudang` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `penilaian_akhir_koor_penjualan`
--

CREATE TABLE `penilaian_akhir_koor_penjualan` (
  `id_penilaian_akhir_koor_penjualan` int NOT NULL,
  `id_karyawan_fk_penjualan` int NOT NULL,
  `nilai_akhir` float NOT NULL,
  `id_periode_bulan_fk` int NOT NULL,
  `id_periode_tahun_fk` varchar(100) NOT NULL,
  `komentar_penjualan` varchar(255) NOT NULL,
  `created_at_koor_penjualan` datetime NOT NULL,
  `updated_at_koor_penjualan` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penilaian_akhir_koor_penjualan`
--

INSERT INTO `penilaian_akhir_koor_penjualan` (`id_penilaian_akhir_koor_penjualan`, `id_karyawan_fk_penjualan`, `nilai_akhir`, `id_periode_bulan_fk`, `id_periode_tahun_fk`, `komentar_penjualan`, `created_at_koor_penjualan`, `updated_at_koor_penjualan`) VALUES
(10, 24, 85, 12, '2024', 'bwolehhh', '2024-12-03 10:37:10', '2024-12-03 10:37:10'),
(11, 24, 44, 10, '2024', 'sndmsnd', '2024-12-22 14:08:49', '2024-12-22 14:08:49');

-- --------------------------------------------------------

--
-- Table structure for table `penilaian_akhir_koor_produksi`
--

CREATE TABLE `penilaian_akhir_koor_produksi` (
  `id_penilaian_akhir_koor_produksi` int NOT NULL,
  `id_karyawan_fk_produksi` int NOT NULL,
  `nilai_akhir` float NOT NULL,
  `id_periode_bulan_fk` int NOT NULL,
  `id_periode_tahun_fk` varchar(100) NOT NULL,
  `komentar_produksi` varchar(255) NOT NULL,
  `created_at_koor_produksi` datetime NOT NULL,
  `updated_at_koor_produksi` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penilaian_akhir_koor_produksi`
--

INSERT INTO `penilaian_akhir_koor_produksi` (`id_penilaian_akhir_koor_produksi`, `id_karyawan_fk_produksi`, `nilai_akhir`, `id_periode_bulan_fk`, `id_periode_tahun_fk`, `komentar_produksi`, `created_at_koor_produksi`, `updated_at_koor_produksi`) VALUES
(17, 2, 85.2, 12, '2024', 'good', '2024-12-02 17:40:39', '2024-12-02 17:40:39'),
(18, 3, 48, 11, '2024', 'sjfdjkfhdef', '2024-12-26 07:28:23', '2024-12-26 07:28:23'),
(19, 3, 65.4667, 1, '2025', 'nnkn', '2025-01-16 03:35:40', '2025-01-16 03:35:40'),
(20, 3, 41.4, 12, '2024', 'hello', '2025-01-26 13:20:59', '2025-01-26 13:20:59'),
(21, 3, 100, 2, '2025', 'okokok', '2025-02-02 16:27:11', '2025-02-02 16:27:11');

-- --------------------------------------------------------

--
-- Table structure for table `penilaian_akhir_pemilik`
--

CREATE TABLE `penilaian_akhir_pemilik` (
  `id_penilaian_akhir_pemilik` int NOT NULL,
  `id_karyawan_fk_pemilik` int NOT NULL,
  `nilai_akhir_pemilik` float NOT NULL,
  `id_periode_bulan_fk` int NOT NULL,
  `nama_periode_tahun_fk` varchar(255) NOT NULL,
  `bagian` varchar(100) NOT NULL,
  `komentar_pemilik` varchar(255) NOT NULL,
  `created_at_pemilik` datetime NOT NULL,
  `updated_at_pemilik` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penilaian_akhir_pemilik`
--

INSERT INTO `penilaian_akhir_pemilik` (`id_penilaian_akhir_pemilik`, `id_karyawan_fk_pemilik`, `nilai_akhir_pemilik`, `id_periode_bulan_fk`, `nama_periode_tahun_fk`, `bagian`, `komentar_pemilik`, `created_at_pemilik`, `updated_at_pemilik`) VALUES
(57, 2, 82.0667, 12, '2024', 'produksi', 'bagus', '2024-12-02 17:37:58', '2024-12-02 17:37:58'),
(58, 24, 83, 12, '2024', 'penjualan', 'bagus sih gan', '2024-12-03 10:34:30', '2024-12-03 10:34:30'),
(60, 3, 78.5333, 12, '2024', 'produksi', 'knknknkkn', '2024-12-21 16:28:19', '2024-12-21 16:28:19'),
(61, 2, 100, 11, '2024', 'produksi', 'babbababa', '2024-12-21 16:58:50', '2024-12-21 16:58:50'),
(62, 2, 70.6, 10, '2024', 'produksi', 'jbnbnbxcxc', '2024-12-22 13:32:29', '2024-12-22 13:32:29'),
(64, 3, 36.9333, 11, '2024', 'produksi', 'nm,n,m', '2024-12-26 07:19:01', '2024-12-26 07:19:01'),
(65, 3, 74.1333, 1, '2025', 'produksi', 'knk', '2025-01-16 03:34:14', '2025-01-16 03:34:14'),
(66, 3, 100, 2, '2025', 'produksi', 'oke', '2025-02-02 16:24:46', '2025-02-02 16:24:46');

-- --------------------------------------------------------

--
-- Table structure for table `penilaian_koor_gudang`
--

CREATE TABLE `penilaian_koor_gudang` (
  `id_koor_gudang` int NOT NULL,
  `id_karyawan_fk` int NOT NULL,
  `id_sub_kriteria_fk` int NOT NULL,
  `id_kriteria_fk_penilaian_gudang` int NOT NULL,
  `periode_penilaian_gudang` date NOT NULL,
  `nilai_akhir_gudang` int NOT NULL,
  `id_bulan_fk_gudang` int DEFAULT NULL,
  `id_tahun_fk_gudang` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `penilaian_koor_penjualan`
--

CREATE TABLE `penilaian_koor_penjualan` (
  `id_koor_penjualan` int NOT NULL,
  `id_karyawan_fk` int NOT NULL,
  `id_sub_kriteria_fk` int NOT NULL,
  `id_kriteria_fk_penilaian_penjualan` int NOT NULL,
  `periode_penilaian_penjualan` date NOT NULL,
  `nilai_akhir_penjualan` int NOT NULL,
  `id_bulan_fk_penjualan` int DEFAULT NULL,
  `id_tahun_fk_penjualan` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penilaian_koor_penjualan`
--

INSERT INTO `penilaian_koor_penjualan` (`id_koor_penjualan`, `id_karyawan_fk`, `id_sub_kriteria_fk`, `id_kriteria_fk_penilaian_penjualan`, `periode_penilaian_penjualan`, `nilai_akhir_penjualan`, `id_bulan_fk_penjualan`, `id_tahun_fk_penjualan`) VALUES
(82, 24, 1, 1, '2024-12-03', 4, 12, '2024'),
(83, 24, 2, 1, '2024-12-03', 5, 12, '2024'),
(84, 24, 3, 2, '2024-12-03', 4, 12, '2024'),
(85, 24, 4, 2, '2024-12-03', 3, 12, '2024'),
(86, 24, 5, 3, '2024-12-03', 4, 12, '2024'),
(87, 24, 6, 3, '2024-12-03', 3, 12, '2024'),
(88, 24, 7, 3, '2024-12-03', 5, 12, '2024'),
(89, 24, 8, 3, '2024-12-03', 5, 12, '2024'),
(90, 24, 9, 4, '2024-12-03', 4, 12, '2024'),
(91, 24, 10, 4, '2024-12-03', 5, 12, '2024'),
(92, 24, 1, 1, '2024-12-22', 5, 10, '2024'),
(93, 24, 2, 1, '2024-12-22', 5, 10, '2024'),
(94, 24, 3, 2, '2024-12-22', 3, 10, '2024'),
(95, 24, 4, 2, '2024-12-22', 1, 10, '2024'),
(96, 24, 5, 3, '2024-12-22', 1, 10, '2024'),
(97, 24, 6, 3, '2024-12-22', 1, 10, '2024'),
(98, 24, 6, 3, '2024-12-22', 1, 10, '2024'),
(99, 24, 5, 3, '2024-12-22', 1, 10, '2024'),
(100, 24, 9, 4, '2024-12-22', 1, 10, '2024'),
(101, 24, 10, 4, '2024-12-22', 1, 10, '2024');

-- --------------------------------------------------------

--
-- Table structure for table `penilaian_koor_produksi`
--

CREATE TABLE `penilaian_koor_produksi` (
  `id_koor_produksi` int NOT NULL,
  `id_karyawan_fk` int NOT NULL,
  `id_sub_kriteria_fk` int NOT NULL,
  `id_kriteria_fk_penilaian_produksi` int NOT NULL,
  `periode_penilaian_produksi` datetime NOT NULL,
  `nilai_akhir_produksi` int NOT NULL,
  `id_bulan_fk_produksi` int DEFAULT NULL,
  `id_tahun_fk_produksi` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penilaian_koor_produksi`
--

INSERT INTO `penilaian_koor_produksi` (`id_koor_produksi`, `id_karyawan_fk`, `id_sub_kriteria_fk`, `id_kriteria_fk_penilaian_produksi`, `periode_penilaian_produksi`, `nilai_akhir_produksi`, `id_bulan_fk_produksi`, `id_tahun_fk_produksi`) VALUES
(228, 2, 1, 1, '2024-12-02 17:39:42', 4, 12, '2024'),
(229, 2, 2, 1, '2024-12-02 17:39:42', 4, 12, '2024'),
(230, 2, 3, 1, '2024-12-02 17:39:42', 5, 12, '2024'),
(231, 2, 4, 1, '2024-12-02 17:39:42', 5, 12, '2024'),
(232, 2, 5, 1, '2024-12-02 17:39:42', 5, 12, '2024'),
(233, 2, 6, 2, '2024-12-02 17:39:53', 3, 12, '2024'),
(234, 2, 7, 2, '2024-12-02 17:39:53', 3, 12, '2024'),
(235, 2, 8, 3, '2024-12-02 17:40:39', 5, 12, '2024'),
(236, 2, 9, 3, '2024-12-02 17:40:39', 5, 12, '2024'),
(237, 2, 10, 3, '2024-12-02 17:40:39', 5, 12, '2024'),
(238, 3, 1, 1, '2024-12-26 07:28:02', 1, 11, '2024'),
(239, 3, 2, 1, '2024-12-26 07:28:02', 1, 11, '2024'),
(240, 3, 3, 1, '2024-12-26 07:28:02', 1, 11, '2024'),
(241, 3, 4, 1, '2024-12-26 07:28:02', 1, 11, '2024'),
(242, 3, 5, 1, '2024-12-26 07:28:02', 1, 11, '2024'),
(243, 3, 6, 2, '2024-12-26 07:28:10', 1, 11, '2024'),
(244, 3, 7, 2, '2024-12-26 07:28:10', 1, 11, '2024'),
(245, 3, 8, 3, '2024-12-26 07:28:23', 5, 11, '2024'),
(246, 3, 9, 3, '2024-12-26 07:28:23', 5, 11, '2024'),
(247, 3, 10, 3, '2024-12-26 07:28:23', 5, 11, '2024'),
(248, 3, 1, 1, '2025-01-16 03:35:22', 4, 1, '2025'),
(249, 3, 2, 1, '2025-01-16 03:35:22', 2, 1, '2025'),
(250, 3, 3, 1, '2025-01-16 03:35:22', 2, 1, '2025'),
(251, 3, 4, 1, '2025-01-16 03:35:22', 2, 1, '2025'),
(252, 3, 5, 1, '2025-01-16 03:35:22', 2, 1, '2025'),
(253, 3, 6, 2, '2025-01-16 03:35:29', 5, 1, '2025'),
(254, 3, 7, 2, '2025-01-16 03:35:29', 5, 1, '2025'),
(255, 3, 8, 3, '2025-01-16 03:35:40', 4, 1, '2025'),
(256, 3, 9, 3, '2025-01-16 03:35:40', 3, 1, '2025'),
(257, 3, 10, 3, '2025-01-16 03:35:40', 1, 1, '2025'),
(258, 3, 1, 1, '2025-01-26 13:20:32', 5, 12, '2024'),
(259, 3, 2, 1, '2025-01-26 13:20:32', 5, 12, '2024'),
(260, 3, 3, 1, '2025-01-26 13:20:32', 3, 12, '2024'),
(261, 3, 4, 1, '2025-01-26 13:20:32', 2, 12, '2024'),
(262, 3, 5, 1, '2025-01-26 13:20:32', 1, 12, '2024'),
(263, 3, 6, 2, '2025-01-26 13:20:44', 2, 12, '2024'),
(264, 3, 7, 2, '2025-01-26 13:20:44', 2, 12, '2024'),
(265, 3, 8, 3, '2025-01-26 13:20:59', 1, 12, '2024'),
(266, 3, 9, 3, '2025-01-26 13:20:59', 1, 12, '2024'),
(267, 3, 10, 3, '2025-01-26 13:20:59', 1, 12, '2024'),
(268, 3, 1, 1, '2025-02-02 16:26:33', 5, 2, '2025'),
(269, 3, 2, 1, '2025-02-02 16:26:33', 5, 2, '2025'),
(270, 3, 3, 1, '2025-02-02 16:26:33', 5, 2, '2025'),
(271, 3, 4, 1, '2025-02-02 16:26:33', 5, 2, '2025'),
(272, 3, 5, 1, '2025-02-02 16:26:33', 5, 2, '2025'),
(273, 3, 6, 2, '2025-02-02 16:26:55', 5, 2, '2025'),
(274, 3, 7, 2, '2025-02-02 16:26:55', 5, 2, '2025'),
(275, 3, 8, 3, '2025-02-02 16:27:11', 5, 2, '2025'),
(276, 3, 9, 3, '2025-02-02 16:27:11', 5, 2, '2025'),
(277, 3, 10, 3, '2025-02-02 16:27:11', 5, 2, '2025');

-- --------------------------------------------------------

--
-- Table structure for table `penilaian_kriteria_koor_gudang`
--

CREATE TABLE `penilaian_kriteria_koor_gudang` (
  `id_penilaian_akhir_koor_gudang` int NOT NULL,
  `id_karyawan_fk` int NOT NULL,
  `id_kriteria_fk` int NOT NULL,
  `nilai_kriteria_koor_gudang` float NOT NULL,
  `id_kriteria_bulan_koor_gudang` int NOT NULL,
  `id_kriteria_tahun_koor_gudang` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `penilaian_kriteria_koor_penjualan`
--

CREATE TABLE `penilaian_kriteria_koor_penjualan` (
  `id_penilaian_kriteria_koor_penjualan` int NOT NULL,
  `id_karyawan_fk` int NOT NULL,
  `id_kriteria_fk` int NOT NULL,
  `nilai_kriteria_koor_penjualan` float NOT NULL,
  `id_kriteria_bulan_koor_penjualan` int NOT NULL,
  `id_kriteria_tahun_koor_penjualan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penilaian_kriteria_koor_penjualan`
--

INSERT INTO `penilaian_kriteria_koor_penjualan` (`id_penilaian_kriteria_koor_penjualan`, `id_karyawan_fk`, `id_kriteria_fk`, `nilai_kriteria_koor_penjualan`, `id_kriteria_bulan_koor_penjualan`, `id_kriteria_tahun_koor_penjualan`) VALUES
(28, 24, 1, 27, 12, '2024'),
(29, 24, 2, 14, 12, '2024'),
(30, 24, 3, 17, 12, '2024'),
(31, 24, 4, 27, 12, '2024'),
(32, 24, 1, 30, 10, '2024'),
(33, 24, 2, 8, 10, '2024'),
(34, 24, 4, 6, 10, '2024');

-- --------------------------------------------------------

--
-- Table structure for table `penilaian_kriteria_koor_produksi`
--

CREATE TABLE `penilaian_kriteria_koor_produksi` (
  `id_penilaian_kriteria_koor_produksi` int NOT NULL,
  `id_karyawan_fk` int NOT NULL,
  `id_kriteria_fk` int NOT NULL,
  `nilai_kriteria_koor_produksi` float NOT NULL,
  `id_kriteria_bulan_koor_produksi` int NOT NULL,
  `id_kriteria_tahun_koor_produksi` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penilaian_kriteria_koor_produksi`
--

INSERT INTO `penilaian_kriteria_koor_produksi` (`id_penilaian_kriteria_koor_produksi`, `id_karyawan_fk`, `id_kriteria_fk`, `nilai_kriteria_koor_produksi`, `id_kriteria_bulan_koor_produksi`, `id_kriteria_tahun_koor_produksi`) VALUES
(52, 2, 1, 32.2, 12, '2024'),
(53, 2, 2, 18, 12, '2024'),
(54, 2, 3, 35, 12, '2024'),
(55, 3, 1, 7, 11, '2024'),
(56, 3, 2, 6, 11, '2024'),
(57, 3, 3, 35, 11, '2024'),
(58, 3, 1, 16.8, 1, '2025'),
(59, 3, 2, 30, 1, '2025'),
(60, 3, 3, 18.6667, 1, '2025'),
(61, 3, 1, 22.4, 12, '2024'),
(62, 3, 2, 12, 12, '2024'),
(63, 3, 3, 7, 12, '2024'),
(64, 3, 1, 35, 2, '2025'),
(65, 3, 2, 30, 2, '2025'),
(66, 3, 3, 35, 2, '2025');

-- --------------------------------------------------------

--
-- Table structure for table `penilaian_kriteria_pemilik`
--

CREATE TABLE `penilaian_kriteria_pemilik` (
  `id_kriteria_pemilik` int NOT NULL,
  `id_karyawan_fk` int NOT NULL,
  `id_kriteria_fk` int NOT NULL,
  `nilai_kriteria_pemilik` float NOT NULL,
  `id_kriteria_bulan_pemilik` int DEFAULT NULL,
  `id_kriteria_tahun_pemilik` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penilaian_kriteria_pemilik`
--

INSERT INTO `penilaian_kriteria_pemilik` (`id_kriteria_pemilik`, `id_karyawan_fk`, `id_kriteria_fk`, `nilai_kriteria_pemilik`, `id_kriteria_bulan_pemilik`, `id_kriteria_tahun_pemilik`) VALUES
(169, 2, 1, 29.4, 12, '2024'),
(170, 2, 2, 27, 12, '2024'),
(171, 2, 3, 25.6667, 12, '2024'),
(172, 24, 1, 24, 12, '2024'),
(173, 24, 2, 20, 12, '2024'),
(174, 24, 3, 12, 12, '2024'),
(175, 24, 4, 27, 12, '2024'),
(180, 3, 1, 25.2, 12, '2024'),
(181, 3, 2, 30, 12, '2024'),
(182, 3, 3, 23.3333, 12, '2024'),
(183, 2, 1, 35, 11, '2024'),
(184, 2, 2, 30, 11, '2024'),
(185, 2, 3, 35, 11, '2024'),
(186, 2, 1, 19.6, 10, '2024'),
(187, 2, 2, 30, 10, '2024'),
(188, 2, 3, 21, 10, '2024'),
(193, 3, 1, 12.6, 11, '2024'),
(194, 3, 2, 15, 11, '2024'),
(195, 3, 3, 9.33333, 11, '2024'),
(196, 3, 1, 23.8, 1, '2025'),
(197, 3, 2, 27, 1, '2025'),
(198, 3, 3, 23.3333, 1, '2025'),
(199, 3, 1, 35, 2, '2025'),
(200, 3, 2, 30, 2, '2025'),
(201, 3, 3, 35, 2, '2025');

-- --------------------------------------------------------

--
-- Table structure for table `penilaian_pemilik`
--

CREATE TABLE `penilaian_pemilik` (
  `id_pemilik` int NOT NULL,
  `id_karyawan_fk` int NOT NULL,
  `id_sub_kriteria_fk` int NOT NULL,
  `id_kriteria_fk_penilaian_pemilik` int NOT NULL,
  `periode_penilaian_pemilik` date NOT NULL,
  `nilai_akhir_pemilik` int NOT NULL,
  `bagian` varchar(255) NOT NULL,
  `id_bulan_fk_pemilik` int DEFAULT NULL,
  `id_tahun_fk_pemilik` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penilaian_pemilik`
--

INSERT INTO `penilaian_pemilik` (`id_pemilik`, `id_karyawan_fk`, `id_sub_kriteria_fk`, `id_kriteria_fk_penilaian_pemilik`, `periode_penilaian_pemilik`, `nilai_akhir_pemilik`, `bagian`, `id_bulan_fk_pemilik`, `id_tahun_fk_pemilik`) VALUES
(831, 2, 1, 1, '2024-12-02', 4, 'produksi', 12, '2024'),
(832, 2, 2, 1, '2024-12-02', 3, 'produksi', 12, '2024'),
(833, 2, 3, 1, '2024-12-02', 5, 'produksi', 12, '2024'),
(834, 2, 4, 1, '2024-12-02', 5, 'produksi', 12, '2024'),
(835, 2, 5, 1, '2024-12-02', 4, 'produksi', 12, '2024'),
(836, 2, 6, 2, '2024-12-02', 4, 'produksi', 12, '2024'),
(837, 2, 7, 2, '2024-12-02', 5, 'produksi', 12, '2024'),
(838, 2, 8, 3, '2024-12-02', 3, 'produksi', 12, '2024'),
(839, 2, 9, 3, '2024-12-02', 4, 'produksi', 12, '2024'),
(840, 2, 10, 3, '2024-12-02', 4, 'produksi', 12, '2024'),
(841, 24, 1, 1, '2024-12-03', 4, 'penjualan', 12, '2024'),
(842, 24, 2, 1, '2024-12-03', 4, 'penjualan', 12, '2024'),
(843, 24, 3, 2, '2024-12-03', 5, 'penjualan', 12, '2024'),
(844, 24, 4, 2, '2024-12-03', 5, 'penjualan', 12, '2024'),
(845, 24, 5, 3, '2024-12-03', 3, 'penjualan', 12, '2024'),
(846, 24, 6, 3, '2024-12-03', 3, 'penjualan', 12, '2024'),
(847, 24, 7, 3, '2024-12-03', 3, 'penjualan', 12, '2024'),
(848, 24, 8, 3, '2024-12-03', 3, 'penjualan', 12, '2024'),
(849, 24, 9, 4, '2024-12-03', 4, 'penjualan', 12, '2024'),
(850, 24, 10, 4, '2024-12-03', 5, 'penjualan', 12, '2024'),
(859, 0, 10, 3, '2024-12-13', 0, '', 12, '2024'),
(862, 3, 1, 1, '2024-12-21', 3, 'produksi', 12, '2024'),
(863, 3, 2, 1, '2024-12-21', 3, 'produksi', 12, '2024'),
(864, 3, 3, 1, '2024-12-21', 4, 'produksi', 12, '2024'),
(865, 3, 4, 1, '2024-12-21', 3, 'produksi', 12, '2024'),
(866, 3, 5, 1, '2024-12-21', 5, 'produksi', 12, '2024'),
(867, 3, 6, 2, '2024-12-21', 5, 'produksi', 12, '2024'),
(868, 3, 7, 2, '2024-12-21', 5, 'produksi', 12, '2024'),
(869, 3, 8, 3, '2024-12-21', 4, 'produksi', 12, '2024'),
(870, 3, 9, 3, '2024-12-21', 3, 'produksi', 12, '2024'),
(871, 3, 10, 3, '2024-12-21', 3, 'produksi', 12, '2024'),
(872, 2, 1, 1, '2024-12-21', 5, 'produksi', 11, '2024'),
(873, 2, 2, 1, '2024-12-21', 5, 'produksi', 11, '2024'),
(874, 2, 3, 1, '2024-12-21', 5, 'produksi', 11, '2024'),
(875, 2, 4, 1, '2024-12-21', 5, 'produksi', 11, '2024'),
(876, 2, 5, 1, '2024-12-21', 5, 'produksi', 11, '2024'),
(877, 2, 6, 2, '2024-12-21', 5, 'produksi', 11, '2024'),
(878, 2, 7, 2, '2024-12-21', 5, 'produksi', 11, '2024'),
(879, 2, 8, 3, '2024-12-21', 5, 'produksi', 11, '2024'),
(880, 2, 9, 3, '2024-12-21', 5, 'produksi', 11, '2024'),
(881, 2, 10, 3, '2024-12-21', 5, 'produksi', 11, '2024'),
(882, 2, 1, 1, '2024-12-22', 5, 'produksi', 10, '2024'),
(883, 2, 2, 1, '2024-12-22', 3, 'produksi', 10, '2024'),
(884, 2, 3, 1, '2024-12-22', 2, 'produksi', 10, '2024'),
(885, 2, 4, 1, '2024-12-22', 3, 'produksi', 10, '2024'),
(886, 2, 5, 1, '2024-12-22', 1, 'produksi', 10, '2024'),
(887, 2, 6, 2, '2024-12-22', 5, 'produksi', 10, '2024'),
(888, 2, 7, 2, '2024-12-22', 5, 'produksi', 10, '2024'),
(889, 2, 8, 3, '2024-12-22', 3, 'produksi', 10, '2024'),
(890, 2, 9, 3, '2024-12-22', 3, 'produksi', 10, '2024'),
(891, 2, 10, 3, '2024-12-22', 3, 'produksi', 10, '2024'),
(902, 3, 1, 1, '2024-12-26', 2, 'produksi', 11, '2024'),
(903, 3, 2, 1, '2024-12-26', 2, 'produksi', 11, '2024'),
(904, 3, 3, 1, '2024-12-26', 2, 'produksi', 11, '2024'),
(905, 3, 4, 1, '2024-12-26', 1, 'produksi', 11, '2024'),
(906, 3, 5, 1, '2024-12-26', 2, 'produksi', 11, '2024'),
(907, 3, 6, 2, '2024-12-26', 4, 'produksi', 11, '2024'),
(908, 3, 7, 2, '2024-12-26', 1, 'produksi', 11, '2024'),
(909, 3, 8, 3, '2024-12-26', 2, 'produksi', 11, '2024'),
(910, 3, 9, 3, '2024-12-26', 1, 'produksi', 11, '2024'),
(911, 3, 10, 3, '2024-12-26', 1, 'produksi', 11, '2024'),
(912, 3, 1, 1, '2025-01-16', 5, 'produksi', 1, '2025'),
(913, 3, 2, 1, '2025-01-16', 4, 'produksi', 1, '2025'),
(914, 3, 3, 1, '2025-01-16', 3, 'produksi', 1, '2025'),
(915, 3, 4, 1, '2025-01-16', 3, 'produksi', 1, '2025'),
(916, 3, 5, 1, '2025-01-16', 2, 'produksi', 1, '2025'),
(917, 3, 6, 2, '2025-01-16', 5, 'produksi', 1, '2025'),
(918, 3, 7, 2, '2025-01-16', 4, 'produksi', 1, '2025'),
(919, 3, 8, 3, '2025-01-16', 5, 'produksi', 1, '2025'),
(920, 3, 9, 3, '2025-01-16', 3, 'produksi', 1, '2025'),
(921, 3, 10, 3, '2025-01-16', 2, 'produksi', 1, '2025'),
(922, 3, 1, 1, '2025-02-02', 5, 'produksi', 2, '2025'),
(923, 3, 2, 1, '2025-02-02', 5, 'produksi', 2, '2025'),
(924, 3, 3, 1, '2025-02-02', 5, 'produksi', 2, '2025'),
(925, 3, 4, 1, '2025-02-02', 5, 'produksi', 2, '2025'),
(926, 3, 5, 1, '2025-02-02', 5, 'produksi', 2, '2025'),
(927, 3, 6, 2, '2025-02-02', 5, 'produksi', 2, '2025'),
(928, 3, 7, 2, '2025-02-02', 5, 'produksi', 2, '2025'),
(929, 3, 8, 3, '2025-02-02', 5, 'produksi', 2, '2025'),
(930, 3, 9, 3, '2025-02-02', 5, 'produksi', 2, '2025'),
(931, 3, 10, 3, '2025-02-02', 5, 'produksi', 2, '2025');

-- --------------------------------------------------------

--
-- Table structure for table `periode_bulan`
--

CREATE TABLE `periode_bulan` (
  `id_periode_bulan` int NOT NULL,
  `nama_bulan` varchar(255) DEFAULT NULL,
  `aksi_bulan` enum('on','off') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `periode_bulan`
--

INSERT INTO `periode_bulan` (`id_periode_bulan`, `nama_bulan`, `aksi_bulan`) VALUES
(1, 'januari', 'off'),
(2, 'februari', 'on'),
(3, 'maret', 'off'),
(4, 'april', 'off'),
(5, 'mei', 'off'),
(6, 'juni', 'off'),
(7, 'juli', 'off'),
(8, 'agustus', 'off'),
(9, 'september', 'off'),
(10, 'oktober', 'off'),
(11, 'november', 'off'),
(12, 'desember', 'off');

-- --------------------------------------------------------

--
-- Table structure for table `periode_tahun`
--

CREATE TABLE `periode_tahun` (
  `id_periode_tahun` int NOT NULL,
  `nama_tahun` varchar(255) DEFAULT NULL,
  `aksi_tahun` enum('on','off') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `periode_tahun`
--

INSERT INTO `periode_tahun` (`id_periode_tahun`, `nama_tahun`, `aksi_tahun`) VALUES
(1, '2024', 'off'),
(2, '2025', 'on'),
(3, '2026', 'off'),
(4, '2027', 'off');

-- --------------------------------------------------------

--
-- Table structure for table `sub_kriteria`
--

CREATE TABLE `sub_kriteria` (
  `id_sub_kriteria` int NOT NULL,
  `nama_sub_kriteria` varchar(255) NOT NULL,
  `nilai_sub_kriteria` int NOT NULL,
  `id_test_kriteria_fk` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sub_kriteria`
--

INSERT INTO `sub_kriteria` (`id_sub_kriteria`, `nama_sub_kriteria`, `nilai_sub_kriteria`, `id_test_kriteria_fk`) VALUES
(138, 'Penggunaan bahan baku produksi', 80, 1),
(139, 'Penggunaan peralatan produksi', 40, 1),
(144, 'Penggunaan blablabla', 30, 1),
(148, 'Akurasi pencatatan barang masuk dan keluar', 20, 2),
(149, 'Kelengkapan data stok barang', 20, 2),
(150, 'Ketepatan waktu pelaporan stok barang', 10, 2),
(151, 'tata letak penyimpanan barang', 10, 3),
(152, 'Minimnya kerusakan barang', 10, 3),
(153, 'Efisiensi penggunaan ruang gudang', 10, 3),
(154, 'Kebersihan gudang', 10, 4),
(155, 'Keamanan gudang', 20, 4),
(156, 'Penyimpanan barang yang tepat', 10, 5),
(157, 'Pemeriksaan barang secara berkala', 20, 5);

-- --------------------------------------------------------

--
-- Table structure for table `tb_kriteria_gudang`
--

CREATE TABLE `tb_kriteria_gudang` (
  `id_kriteria_gudang` int NOT NULL,
  `nama_kriteria_gudang` varchar(255) NOT NULL,
  `bobot_gudang` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_kriteria_gudang`
--

INSERT INTO `tb_kriteria_gudang` (`id_kriteria_gudang`, `nama_kriteria_gudang`, `bobot_gudang`) VALUES
(1, 'Akurasi pencatatan dan pengelolaan stok', 0.35),
(2, 'Efisiensi Penyimpanan', 0.15),
(3, 'Keamanan dan Kondisi Gudang', 0.25),
(4, 'Kondisi Barang', 0.25);

-- --------------------------------------------------------

--
-- Table structure for table `tb_kriteria_penjualan`
--

CREATE TABLE `tb_kriteria_penjualan` (
  `id_kriteria_penjualan` int NOT NULL,
  `nama_kriteria_penjualan` varchar(255) NOT NULL,
  `bobot_penjualan` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_kriteria_penjualan`
--

INSERT INTO `tb_kriteria_penjualan` (`id_kriteria_penjualan`, `nama_kriteria_penjualan`, `bobot_penjualan`) VALUES
(1, 'Pencapaian Target Penjualan', 0.3),
(2, 'Akuisisi Pelanggan Baru', 0.2),
(3, 'Keterampilan dan Pengetahuan Penjualan', 0.2),
(4, 'Kepuasan Pelanggan', 0.3);

-- --------------------------------------------------------

--
-- Table structure for table `tb_kriteria_produksi`
--

CREATE TABLE `tb_kriteria_produksi` (
  `id_kriteria_produksi` int NOT NULL,
  `nama_kriteria_produksi` varchar(255) NOT NULL,
  `bobot_produksi` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_kriteria_produksi`
--

INSERT INTO `tb_kriteria_produksi` (`id_kriteria_produksi`, `nama_kriteria_produksi`, `bobot_produksi`) VALUES
(1, 'Kualitas Produk ', 0.35),
(2, 'Efisiensi Proses Produksi', 0.3),
(3, 'Pencapaian Target Produksi', 0.35);

-- --------------------------------------------------------

--
-- Table structure for table `tb_sub_kriteria_gudang`
--

CREATE TABLE `tb_sub_kriteria_gudang` (
  `id_sub_kriteria_gudang` int NOT NULL,
  `nama_sub_kriteria_gudang` varchar(255) NOT NULL,
  `id_kriteria_gudang_fk` int NOT NULL,
  `m1_gudang` varchar(255) DEFAULT NULL,
  `m2_gudang` varchar(255) DEFAULT NULL,
  `m3_gudang` varchar(255) DEFAULT NULL,
  `m4_gudang` varchar(255) DEFAULT NULL,
  `m5_gudang` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_sub_kriteria_gudang`
--

INSERT INTO `tb_sub_kriteria_gudang` (`id_sub_kriteria_gudang`, `nama_sub_kriteria_gudang`, `id_kriteria_gudang_fk`, `m1_gudang`, `m2_gudang`, `m3_gudang`, `m4_gudang`, `m5_gudang`) VALUES
(3, 'Akurasi Pencatatan Barang Masuk dan Keluar', 1, '81% - 100% melakukan kesalahan', '61% - 80% melakukan kesalahan', '41% - 60% melakukan kesalahan', '21% - 40 melakukan kesalahan', '0% - 20% melakukan kesalahan'),
(4, 'Kelengkapan Data Stok Barang', 1, 'Data stok tidak akurat sesuai digudang', 'Data stok jarang akurat sesuai digudang', 'Data stok cukup akurat sesuai digudang', 'Data stok sering akurat sesuai digudang', 'Data stok selalu akurat sesuai digudang'),
(5, 'Ketetapan Waktu Pelaporan Stok Barang', 1, '>3 kali telat', '3 kali telat', '2 kali telat', '1 kali telat', 'Selalu tepat waktu'),
(6, 'Tata Letak Penyimpanan Barang', 2, 'Tidak rapi', 'Jarang rapi', 'Cukup rapi', 'Sering rapi', 'Selalu rapi'),
(7, 'Minimnya Kerusakan Barang', 2, '>3 pcs barang rusak', '3 pcs barang rusak', '2 pcs barang rusak', '1 pcs barang rusak', 'Tidak ada barang rusak'),
(8, 'Efisiensi Penggunaan Ruang Gudang', 2, 'Tidak memanfaatkan ruang gudang dengan baik', 'Jarang memanfaatkan ruang gudang dengan baik', 'Cukup memanfaatkan ruang gudang dengan baik', 'Sering memanfaatkan ruang gudang dengan baik', 'Selalu memanfaatkan ruang gudang dengan baik'),
(9, 'Kebersihan Gudang', 3, 'Tidak bersih', 'Jarang bersih', 'Cukup bersih', 'Sering bersih', 'Selalu bersih'),
(10, 'Keamanan Gudang', 3, '>3 pcs barang hilang', '3 pcs barang hilang', '2 pcs barang hilang', '1 pcs barang hilang', 'Tidak ada barang hilang'),
(11, 'Penyimpanan Barang Yang Tepat', 4, 'Tidak menyimpan sesuai jenis produk', 'Jarang menyimpan sesuai jenis produk', 'Cukup menyimpan sesuai jenis produk', 'Sering menyimpan sesuai jenis produk', 'Selalu menyimpan sesuai jenis produk'),
(12, 'Pemeriksaan Barang Secara Berkala', 4, 'Sebulan 0 – 5 kali pengecekan', 'Sebulan 6 - 10 kali pengecekan', 'Sebulan 11-15 kali pengecekan', 'Sebulan 16 - 20 kali pengecekan', 'Sebulan 21 - 25 kali pengecekan');

-- --------------------------------------------------------

--
-- Table structure for table `tb_sub_kriteria_penjualan`
--

CREATE TABLE `tb_sub_kriteria_penjualan` (
  `id_sub_kriteria_penjualan` int NOT NULL,
  `nama_sub_kriteria_penjualan` varchar(255) NOT NULL,
  `id_kriteria_penjualan_fk` int NOT NULL,
  `m1_penjualan` varchar(255) DEFAULT NULL,
  `m2_penjualan` varchar(255) DEFAULT NULL,
  `m3_penjualan` varchar(255) DEFAULT NULL,
  `m4_penjualan` varchar(255) DEFAULT NULL,
  `m5_penjualan` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_sub_kriteria_penjualan`
--

INSERT INTO `tb_sub_kriteria_penjualan` (`id_sub_kriteria_penjualan`, `nama_sub_kriteria_penjualan`, `id_kriteria_penjualan_fk`, `m1_penjualan`, `m2_penjualan`, `m3_penjualan`, `m4_penjualan`, `m5_penjualan`) VALUES
(1, 'Volume Penjualan', 1, 'Sebulan 0 -1 transaksi', 'Sebulan 2 - 4  transaksi', 'Sebulan 5 - 7 transaksi', 'Sebulan 8- 10 transaksi', 'Sebulan > 10 transaksi'),
(2, 'Persentase Pencapaian Target', 1, '0% - 20% sesuai target penjualan', '21% - 40% sesuai target penjualan', '41% - 60% sesuai target penjualan', '61% - 80% sesuai target penjualan', '81% - 100% sesuai target penjualan'),
(3, 'Jumlah Pelanggan Baru', 2, 'Tidak ada pelanggan baru dalam 1  bulan.', '1 pelanggan baru dalam 1 bulan', '2 pelanggan baru dalam 1 bulan', '3 pelanggan baru dalam 1 bulan', '>3 pelanggan baru dalam 1 bulan'),
(4, 'Potensi Keuntungan Pelanggan Baru', 2, '0% - 1 % dari target omset yang di tentukan', '2% - 4% dari target omset yang di tentukan', '5 % - 7% dari target omset yang di tentukan', '8% - 10% dari target omset yang di tentukan', '>10% dari target omset yang di tentukan'),
(5, 'Pengetahuan produk', 3, 'Tidak paham dengan produk yang dijual', 'Kurang paham dengan produk yang dijual', 'Cukup paham dengan produk yang dijual', 'Sering paham dengan produk yang dijual', 'Sangat paham dengan produk yang dijual'),
(6, 'Keterampilan komunikasi', 3, 'Tidak Baik', 'Kurang Baik', 'Cukup Baik', 'Baik', 'Sangat Baik'),
(7, 'Keterampilan negosiasi', 3, 'Tidak Baik', 'Kurang Baik', 'Cukup Baik', 'Baik', 'Sangat Baik'),
(8, 'Keterampilan teknik penjualan', 3, 'Tidak Menarik', 'Kurang Menarik', 'Cukup Menarik', 'Menarik', 'Sangat Menarik'),
(9, 'Tingkat kepuasan pelanggan', 4, '0% - 20% pelanggan puas', '21% - 40% pelanggan puas', '41% - 60% pelanggan puas', '61% - 80% pelanggan puas', '81% - 100% pelanggan puas'),
(10, 'Tingkat keluhan pelanggan', 4, '>3 komplain dalam 1 bulan', '3 komplain dalam 1 bulan', '2 komplain dalam 1 bulan', '1 komplain dalam 1 bulan', 'Tidak ada komplain sama sekali dalam 1 bulan');

-- --------------------------------------------------------

--
-- Table structure for table `tb_sub_kriteria_produksi`
--

CREATE TABLE `tb_sub_kriteria_produksi` (
  `id_sub_kriteria_produksi` int NOT NULL,
  `nama_sub_kriteria_produksi` varchar(255) NOT NULL,
  `id_kriteria_produksi_fk` int NOT NULL,
  `m1_produksi` varchar(255) DEFAULT NULL,
  `m2_produksi` varchar(255) DEFAULT NULL,
  `m3_produksi` varchar(255) DEFAULT NULL,
  `m4_produksi` varchar(255) DEFAULT NULL,
  `m5_produksi` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_sub_kriteria_produksi`
--

INSERT INTO `tb_sub_kriteria_produksi` (`id_sub_kriteria_produksi`, `nama_sub_kriteria_produksi`, `id_kriteria_produksi_fk`, `m1_produksi`, `m2_produksi`, `m3_produksi`, `m4_produksi`, `m5_produksi`) VALUES
(1, 'Persentase Produk Cacat', 1, '81 % - 100% produk cacat', '61 % - 80% produk cacat', '41 % - 60% produk cacat', '21 % - 40% produk cacat', '0 % - 20% produk cacat'),
(2, 'Kepatuhan Terhadap Standar Kualitas', 1, 'Melanggar >3 kali', 'Melanggar 3 kali kali ', 'Melanggar 2 kali', 'Melanggar 1 kalijjjj', 'Tidak pernah melanggartftfggf'),
(3, 'Akurasi Pengerjaan', 1, '0% - 20% produk sesuai standart ditetapkan', '21% - 40% produk sesuai standart ditetapkan', '41% - 60% produk sesuai standart ditetapkan', '61% - 80% produk sesuai standart ditetapkannnnnbbbb', '81% - 100% produk sesuai standart ditetapkan'),
(4, 'Minimnya reworks', 1, '>3 kali rework', '3 kali reworkpopopopop', '2 kali reworkddddsdsd', '1 kali reworksiiiipaapapapapupupupupupupapaso', 'Tidak pernah reworkkkkkkk'),
(5, 'Konsistensi Kualitas Produk', 1, '0% - 20% jahitan rapi', '21% - 40% jahitan rapi', '41% - 60% jahitan rapi', '61% - 80% jahitan rapi', '81% - 100% jahitan rapi'),
(6, 'Penggunaan Bahan Baku Produksi', 2, 'Tidak menggunakan bahan baku digunakan secara optimal', 'Jarang menggunakan bahan baku secara optimal', 'Cukup menggunakan bahan baku secara optimal', 'Sering menggunakan bahan baku secara optimal', 'Selalu menggunakan bahan baku secara optimal'),
(7, 'Penggunaan Peralatan Produksi', 2, 'Tidak menggunakan peralatan produksi dengan benar', 'Jarang menggunakan peralatan produksi dengan benar', 'Cukup menggunakan peralatan produksi dengan benar', 'Sering menggunakan peralatan produksi dengan benar', 'Selalu menggunakan peralatan produksi dengan benar'),
(8, 'Persentase Pencapaian Target Produk', 3, '0% - 20% sesuai target', '21% - 40% sesuai target', '41% - 60% sesuai target', '61% - 80% sesuai target', '81% - 100% sesuai'),
(9, 'Tingkat Konsistensi Pembuatan Produk', 3, '0 pcs – 20 pcs dalam 1 bulan', '21 pcs – 40 pcs dalam 1 bulan', '41 pcs – 60 pcs dalam 1 bulan', '61 pcs – 80 pcs dalam 1 bulan', '81 pcs – 100 pcs dalam 1 bulan'),
(10, 'Kemampuan menyelesaikan pekerjaan tepat waktu', 3, 'Tidak tepat waktu', 'Jarang tepat waktu', 'Cukup tepat waktu', 'Sering tepat waktu', 'Selalu tepat waktu');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int NOT NULL,
  `nama` varchar(125) NOT NULL,
  `username` varchar(125) NOT NULL,
  `password` varchar(125) NOT NULL,
  `level` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nama`, `username`, `password`, `level`) VALUES
(1, 'pemilik', 'pemilik', 'pemilik', 'pemilik'),
(2, 'koordinator produksi', 'produksi', 'produksi', 'produksi'),
(3, 'koordinator gudang', 'gudang', 'gudang', 'gudang'),
(4, 'koordinator penjualan', 'penjualan', 'penjualan', 'penjualan');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jabatan` (`jabatan`);

--
-- Indexes for table `penilaian_akhir_koor_gudang`
--
ALTER TABLE `penilaian_akhir_koor_gudang`
  ADD PRIMARY KEY (`id_penilaian_akhir_koor_gudang`),
  ADD KEY `id_karyawan_fk_gudang` (`id_karyawan_fk_gudang`),
  ADD KEY `id_periode_bulan_fk` (`id_periode_bulan_fk`),
  ADD KEY `id_periode_tahun_fk` (`id_periode_tahun_fk`);

--
-- Indexes for table `penilaian_akhir_koor_penjualan`
--
ALTER TABLE `penilaian_akhir_koor_penjualan`
  ADD PRIMARY KEY (`id_penilaian_akhir_koor_penjualan`),
  ADD KEY `id_karyawan_fk_penjualan` (`id_karyawan_fk_penjualan`),
  ADD KEY `id_periode_bulan_fk` (`id_periode_bulan_fk`),
  ADD KEY `id_periode_tahun_fk` (`id_periode_tahun_fk`);

--
-- Indexes for table `penilaian_akhir_koor_produksi`
--
ALTER TABLE `penilaian_akhir_koor_produksi`
  ADD PRIMARY KEY (`id_penilaian_akhir_koor_produksi`),
  ADD KEY `id_karyawan_fk` (`id_karyawan_fk_produksi`),
  ADD KEY `id_periode_bulan_fk` (`id_periode_bulan_fk`),
  ADD KEY `id_periode_tahun_fk` (`id_periode_tahun_fk`);

--
-- Indexes for table `penilaian_akhir_pemilik`
--
ALTER TABLE `penilaian_akhir_pemilik`
  ADD PRIMARY KEY (`id_penilaian_akhir_pemilik`),
  ADD KEY `id_karyawan_fk` (`id_karyawan_fk_pemilik`),
  ADD KEY `id_periode_bulan_fk` (`id_periode_bulan_fk`),
  ADD KEY `nama_periode_tahun_fk` (`nama_periode_tahun_fk`) USING BTREE;

--
-- Indexes for table `penilaian_koor_gudang`
--
ALTER TABLE `penilaian_koor_gudang`
  ADD PRIMARY KEY (`id_koor_gudang`),
  ADD KEY `id_karyawan_fk` (`id_karyawan_fk`),
  ADD KEY `id_sub_kriteria_fk` (`id_sub_kriteria_fk`),
  ADD KEY `id_bulan_fk_gudang` (`id_bulan_fk_gudang`),
  ADD KEY `id_tahun_fk_gudang` (`id_tahun_fk_gudang`),
  ADD KEY `id_kriteria_fk_penilaian_gudang` (`id_kriteria_fk_penilaian_gudang`);

--
-- Indexes for table `penilaian_koor_penjualan`
--
ALTER TABLE `penilaian_koor_penjualan`
  ADD PRIMARY KEY (`id_koor_penjualan`),
  ADD KEY `id_karyawan_fk` (`id_karyawan_fk`),
  ADD KEY `id_sub_kriteria_fk` (`id_sub_kriteria_fk`);

--
-- Indexes for table `penilaian_koor_produksi`
--
ALTER TABLE `penilaian_koor_produksi`
  ADD PRIMARY KEY (`id_koor_produksi`),
  ADD KEY `id_karyawan_fk` (`id_karyawan_fk`),
  ADD KEY `id_sub_kriteria_fk` (`id_sub_kriteria_fk`),
  ADD KEY `id_kriteria_fk_penilaian_produksi` (`id_kriteria_fk_penilaian_produksi`),
  ADD KEY `id_bulan_fk_produksi` (`id_bulan_fk_produksi`),
  ADD KEY `id_tahun_fk_produksi` (`id_tahun_fk_produksi`);

--
-- Indexes for table `penilaian_kriteria_koor_gudang`
--
ALTER TABLE `penilaian_kriteria_koor_gudang`
  ADD PRIMARY KEY (`id_penilaian_akhir_koor_gudang`),
  ADD KEY `id_karyawan_fk` (`id_karyawan_fk`),
  ADD KEY `id_kriteria_fk` (`id_kriteria_fk`),
  ADD KEY `id_kriteria_tahun_koor_gudang` (`id_kriteria_tahun_koor_gudang`) USING BTREE,
  ADD KEY `id_kriteria_bulan_koor_gudang` (`id_kriteria_bulan_koor_gudang`) USING BTREE;

--
-- Indexes for table `penilaian_kriteria_koor_penjualan`
--
ALTER TABLE `penilaian_kriteria_koor_penjualan`
  ADD PRIMARY KEY (`id_penilaian_kriteria_koor_penjualan`),
  ADD KEY `id_kriteria_fk` (`id_kriteria_fk`),
  ADD KEY `id_kriteria_tahun_koor_penjualan` (`id_kriteria_tahun_koor_penjualan`) USING BTREE,
  ADD KEY `id_kriteria_bulan_koor_penjualan` (`id_kriteria_bulan_koor_penjualan`) USING BTREE,
  ADD KEY `id_karyawan_fk` (`id_karyawan_fk`) USING BTREE;

--
-- Indexes for table `penilaian_kriteria_koor_produksi`
--
ALTER TABLE `penilaian_kriteria_koor_produksi`
  ADD PRIMARY KEY (`id_penilaian_kriteria_koor_produksi`),
  ADD KEY `id_karyawan_fk` (`id_karyawan_fk`),
  ADD KEY `id_kriteria_fk` (`id_kriteria_fk`),
  ADD KEY `id_kriteria_bulan_koor_produksi` (`id_kriteria_bulan_koor_produksi`),
  ADD KEY `id_kriteria_tahun_koor_produksi` (`id_kriteria_tahun_koor_produksi`);

--
-- Indexes for table `penilaian_kriteria_pemilik`
--
ALTER TABLE `penilaian_kriteria_pemilik`
  ADD PRIMARY KEY (`id_kriteria_pemilik`),
  ADD KEY `id_karyawan_fk` (`id_karyawan_fk`),
  ADD KEY `id_kriteria_fk` (`id_kriteria_fk`),
  ADD KEY `id_kriteria_bulan_pemilik` (`id_kriteria_bulan_pemilik`),
  ADD KEY `id_kriteria_tahun_pemilik` (`id_kriteria_tahun_pemilik`);

--
-- Indexes for table `penilaian_pemilik`
--
ALTER TABLE `penilaian_pemilik`
  ADD PRIMARY KEY (`id_pemilik`),
  ADD KEY `id_karyawan_fk` (`id_karyawan_fk`),
  ADD KEY `id_sub_kriteria_fk` (`id_sub_kriteria_fk`),
  ADD KEY `id_bulan_fk_pemilik` (`id_bulan_fk_pemilik`),
  ADD KEY `id_tahun_fk_pemilik` (`id_tahun_fk_pemilik`),
  ADD KEY `id_kriteria_fk_penilaian_pemilik` (`id_kriteria_fk_penilaian_pemilik`);

--
-- Indexes for table `periode_bulan`
--
ALTER TABLE `periode_bulan`
  ADD PRIMARY KEY (`id_periode_bulan`);

--
-- Indexes for table `periode_tahun`
--
ALTER TABLE `periode_tahun`
  ADD PRIMARY KEY (`id_periode_tahun`);

--
-- Indexes for table `sub_kriteria`
--
ALTER TABLE `sub_kriteria`
  ADD PRIMARY KEY (`id_sub_kriteria`),
  ADD KEY `id_test_kriteria_fk` (`id_test_kriteria_fk`);

--
-- Indexes for table `tb_kriteria_gudang`
--
ALTER TABLE `tb_kriteria_gudang`
  ADD PRIMARY KEY (`id_kriteria_gudang`);

--
-- Indexes for table `tb_kriteria_penjualan`
--
ALTER TABLE `tb_kriteria_penjualan`
  ADD PRIMARY KEY (`id_kriteria_penjualan`);

--
-- Indexes for table `tb_kriteria_produksi`
--
ALTER TABLE `tb_kriteria_produksi`
  ADD PRIMARY KEY (`id_kriteria_produksi`);

--
-- Indexes for table `tb_sub_kriteria_gudang`
--
ALTER TABLE `tb_sub_kriteria_gudang`
  ADD PRIMARY KEY (`id_sub_kriteria_gudang`),
  ADD KEY `id_kriteria_gudang_fk` (`id_kriteria_gudang_fk`);

--
-- Indexes for table `tb_sub_kriteria_penjualan`
--
ALTER TABLE `tb_sub_kriteria_penjualan`
  ADD PRIMARY KEY (`id_sub_kriteria_penjualan`),
  ADD KEY `id_kriteria_penjualan_fk` (`id_kriteria_penjualan_fk`);

--
-- Indexes for table `tb_sub_kriteria_produksi`
--
ALTER TABLE `tb_sub_kriteria_produksi`
  ADD PRIMARY KEY (`id_sub_kriteria_produksi`),
  ADD KEY `id_kriteria_produksi_fk` (`id_kriteria_produksi_fk`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jabatan`
--
ALTER TABLE `jabatan`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `karyawan`
--
ALTER TABLE `karyawan`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2113;

--
-- AUTO_INCREMENT for table `penilaian_akhir_koor_gudang`
--
ALTER TABLE `penilaian_akhir_koor_gudang`
  MODIFY `id_penilaian_akhir_koor_gudang` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `penilaian_akhir_koor_penjualan`
--
ALTER TABLE `penilaian_akhir_koor_penjualan`
  MODIFY `id_penilaian_akhir_koor_penjualan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `penilaian_akhir_koor_produksi`
--
ALTER TABLE `penilaian_akhir_koor_produksi`
  MODIFY `id_penilaian_akhir_koor_produksi` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `penilaian_akhir_pemilik`
--
ALTER TABLE `penilaian_akhir_pemilik`
  MODIFY `id_penilaian_akhir_pemilik` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `penilaian_koor_gudang`
--
ALTER TABLE `penilaian_koor_gudang`
  MODIFY `id_koor_gudang` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT for table `penilaian_koor_penjualan`
--
ALTER TABLE `penilaian_koor_penjualan`
  MODIFY `id_koor_penjualan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT for table `penilaian_koor_produksi`
--
ALTER TABLE `penilaian_koor_produksi`
  MODIFY `id_koor_produksi` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=278;

--
-- AUTO_INCREMENT for table `penilaian_kriteria_koor_gudang`
--
ALTER TABLE `penilaian_kriteria_koor_gudang`
  MODIFY `id_penilaian_akhir_koor_gudang` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `penilaian_kriteria_koor_penjualan`
--
ALTER TABLE `penilaian_kriteria_koor_penjualan`
  MODIFY `id_penilaian_kriteria_koor_penjualan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `penilaian_kriteria_koor_produksi`
--
ALTER TABLE `penilaian_kriteria_koor_produksi`
  MODIFY `id_penilaian_kriteria_koor_produksi` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `penilaian_kriteria_pemilik`
--
ALTER TABLE `penilaian_kriteria_pemilik`
  MODIFY `id_kriteria_pemilik` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=202;

--
-- AUTO_INCREMENT for table `penilaian_pemilik`
--
ALTER TABLE `penilaian_pemilik`
  MODIFY `id_pemilik` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=932;

--
-- AUTO_INCREMENT for table `periode_bulan`
--
ALTER TABLE `periode_bulan`
  MODIFY `id_periode_bulan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `periode_tahun`
--
ALTER TABLE `periode_tahun`
  MODIFY `id_periode_tahun` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sub_kriteria`
--
ALTER TABLE `sub_kriteria`
  MODIFY `id_sub_kriteria` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=158;

--
-- AUTO_INCREMENT for table `tb_kriteria_gudang`
--
ALTER TABLE `tb_kriteria_gudang`
  MODIFY `id_kriteria_gudang` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_kriteria_penjualan`
--
ALTER TABLE `tb_kriteria_penjualan`
  MODIFY `id_kriteria_penjualan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tb_kriteria_produksi`
--
ALTER TABLE `tb_kriteria_produksi`
  MODIFY `id_kriteria_produksi` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_sub_kriteria_gudang`
--
ALTER TABLE `tb_sub_kriteria_gudang`
  MODIFY `id_sub_kriteria_gudang` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tb_sub_kriteria_penjualan`
--
ALTER TABLE `tb_sub_kriteria_penjualan`
  MODIFY `id_sub_kriteria_penjualan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tb_sub_kriteria_produksi`
--
ALTER TABLE `tb_sub_kriteria_produksi`
  MODIFY `id_sub_kriteria_produksi` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
