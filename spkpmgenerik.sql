-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 22, 2021 at 07:45 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `promatch`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_user` int(11) NOT NULL,
  `username` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `password` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `nama` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `level` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `foto` varchar(100) COLLATE latin1_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_user`, `username`, `password`, `nama`, `level`, `foto`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Administrator', 'Administrator', 'IMG_20190924_082057.jpg'),
(2, 'user', 'ee11cbb19052e40b07aac0ca060c23ee', 'User', 'User', 'images (4).png');

-- --------------------------------------------------------

--
-- Table structure for table `alternatif`
--

CREATE TABLE `alternatif` (
  `id_alternatif` tinyint(3) UNSIGNED NOT NULL,
  `nama_alternatif` varchar(100) NOT NULL,
  `id_spk` int(11) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `alternatif`
--

INSERT INTO `alternatif` (`id_alternatif`, `nama_alternatif`, `id_spk`, `id_user`) VALUES
(14, '131038601', 2, 9),
(13, '104087404', 2, 9),
(12, 'Lisa', 1, 8),
(11, 'Deni', 1, 8),
(15, '109029709', 2, 9),
(16, '118059990', 2, 9),
(17, '126099101', 2, 9),
(18, 'Pak Yanto', 8, 8),
(19, 'Bu Erni', 8, 8),
(20, 'Pak Indra', 8, 8),
(26, 'Wawan', 13, 12),
(27, 'Tantri', 13, 12),
(28, 'James', 13, 12),
(29, 'Wawan', 14, 12),
(30, 'Tantri', 14, 12),
(31, 'James', 14, 12),
(34, 'Dewi', 28, 8),
(35, 'Cika', 28, 8),
(36, 'Rian', 28, 8);

-- --------------------------------------------------------

--
-- Table structure for table `aspek`
--

CREATE TABLE `aspek` (
  `id_aspek` tinyint(3) UNSIGNED NOT NULL,
  `nama_aspek` varchar(100) NOT NULL,
  `bobot` float NOT NULL,
  `bobot_core` float NOT NULL,
  `bobot_secondary` float NOT NULL,
  `nama_singkat` char(2) DEFAULT NULL,
  `id_spk` int(11) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `aspek`
--

INSERT INTO `aspek` (`id_aspek`, `nama_aspek`, `bobot`, `bobot_core`, `bobot_secondary`, `nama_singkat`, `id_spk`, `id_user`) VALUES
(40, 'kondisi rumah', 70, 60, 40, 'p', 32, 8),
(9, 'Pendidikan', 35, 70, 30, 'P', 2, 9),
(10, 'Penelitian', 45, 70, 30, 'N', 2, 9),
(11, 'Pendukung', 20, 70, 30, 'G', 2, 9),
(15, 'Extern', 40, 50, 50, 'E', 8, 8),
(14, 'Intern', 60, 60, 40, 'I', 8, 8),
(20, 'Kecerdasan', 30, 70, 30, 'K', 13, 12),
(21, 'Sikap Kerja', 30, 70, 30, 'SK', 13, 12),
(22, 'Perilaku', 40, 70, 30, 'P', 13, 12),
(23, 'Kecerdasan', 30, 70, 30, 'K', 14, 12),
(24, 'Sikap Kerja', 30, 70, 30, 'SK', 14, 12),
(25, 'Perilaku', 40, 70, 30, 'P', 14, 12),
(29, 'Pendidikan', 60, 60, 40, 'P', 28, 8),
(30, 'Ekonomi', 40, 60, 40, 'E', 28, 8),
(31, 'Intern', 30, 70, 30, 'P', 29, 8),
(33, 'kesuburan', 50, 50, 50, 'K', 31, 9),
(39, 'Pendidikan', 30, 70, 30, 'P', 32, 8);

-- --------------------------------------------------------

--
-- Table structure for table `bobot`
--

CREATE TABLE `bobot` (
  `id_bobot` int(11) NOT NULL,
  `selisih` tinyint(3) NOT NULL,
  `bobot` float NOT NULL,
  `keterangan` varchar(100) NOT NULL,
  `id_spk` int(11) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bobot`
--

INSERT INTO `bobot` (`id_bobot`, `selisih`, `bobot`, `keterangan`, `id_spk`, `id_user`) VALUES
(36, 0, 5, 'Tidak ada selisih  ( kompetensi sesuai yang dibutuhkan )', 2, 9),
(35, -4, 1, 'Kompetensi individu kekurangan 4 tingkat/level', 1, 8),
(34, 4, 1.5, 'Kompetensi individu kelebihan 4 tingkat/level', 1, 8),
(33, -3, 2, 'Kompetensi individu kekurangan 3 tingkat/level', 1, 8),
(32, 3, 2.5, 'Kompetensi individu kelebihan 3 tingkat/level', 1, 8),
(31, -2, 3, 'Kompetensi individu kekurangan 2 tingkat/level', 1, 8),
(22, 0, 5, 'Tidak ada selisih  ( kompetensi sesuai yang dibutuhkan )', 1, 8),
(28, 1, 4.5, 'Kompetensi individu kelebihan 1 tingkat/level', 1, 8),
(29, -1, 4, 'Kompetensi individu kekurangan 1 tingkat/level', 1, 8),
(30, 2, 3.5, 'Kompetensi individu kelebihan 2 tingkat/level', 1, 8),
(37, 1, 4.5, 'Kompetensi individu kelebihan 1 tingkat/level', 2, 9),
(38, -1, 4, 'Kompetensi individu kekurangan 1 tingkat/level', 2, 9),
(39, 2, 3.5, 'Kompetensi individu kelebihan 2 tingkat/level', 2, 9),
(40, -2, 3, 'Kompetensi individu kekurangan 2 tingkat/level', 2, 9),
(41, 3, 2.5, 'Kompetensi individu kelebihan 3 tingkat/level', 2, 9),
(42, -3, 2, 'Kompetensi individu kekurangan 3 tingkat/level', 2, 9),
(43, 4, 1.5, 'Kompetensi individu kelebihan 4 tingkat/level', 2, 9),
(44, -4, 1, 'Kompetensi individu kekurangan 4 tingkat/level', 2, 9),
(45, 0, 5, 'Tidak ada selisih  ( kompetensi sesuai yang dibutuhkan )', 8, 8),
(46, 1, 4.5, 'Kompetensi individu kelebihan 1 tingkat/level', 8, 8),
(47, -1, 4, 'Kompetensi individu kekurangan 1 tingkat/level', 8, 8),
(48, 2, 3.5, 'Kompetensi individu kelebihan 2 tingkat/level', 8, 8),
(49, -2, 3, 'Kompetensi individu kekurangan 2 tingkat/level', 8, 8),
(50, 3, 2.5, 'Kompetensi individu kelebihan 3 tingkat/level', 8, 8),
(51, -3, 2, 'Kompetensi individu kekurangan 3 tingkat/level', 8, 8),
(52, 4, 1.5, 'Kompetensi individu kelebihan 4 tingkat/level', 8, 8),
(53, -4, 1, 'Kompetensi individu kekurangan 4 tingkat/level', 8, 8),
(54, 0, 5, 'Tidak ada selisih  ( kompetensi sesuai yang dibutuhkan )', 13, 12),
(55, 1, 4.5, 'Kompetensi individu kelebihan 1 tingkat/level', 13, 12),
(56, -1, 4, 'Kompetensi individu kekurangan 1 tingkat/level', 13, 12),
(57, 2, 3.5, 'Kompetensi individu kelebihan 2 tingkat/level', 13, 12),
(58, -2, 3, 'Kompetensi individu kekurangan 2 tingkat/level', 13, 12),
(59, 3, 2.5, 'Kompetensi individu kelebihan 3 tingkat/level', 13, 12),
(60, -3, 2, 'Kompetensi individu kekurangan 3 tingkat/level', 13, 12),
(61, 4, 1.5, 'Kompetensi individu kelebihan 4 tingkat/level', 13, 12),
(62, -4, 1, 'Kompetensi individu kekurangan 4 tingkat/level', 13, 12),
(63, 0, 5, 'Tidak ada selisih  ( kompetensi sesuai yang dibutuhkan )', 14, 12),
(64, 1, 4.5, 'Kompetensi individu kelebihan 1 tingkat/level', 14, 12),
(65, -1, 4, 'Kompetensi individu kekurangan 1 tingkat/level', 14, 12),
(66, 2, 3.5, 'Kompetensi individu kelebihan 2 tingkat/level', 14, 12),
(67, -2, 3, 'Kompetensi individu kekurangan 2 tingkat/level', 14, 12),
(68, 3, 2.5, 'Kompetensi individu kelebihan 3 tingkat/level', 14, 12),
(69, -3, 2, 'Kompetensi individu kekurangan 3 tingkat/level', 14, 12),
(70, 4, 1.5, 'Kompetensi individu kelebihan 4 tingkat/level', 14, 12),
(71, -4, 1, 'Kompetensi individu kekurangan 4 tingkat/level', 14, 12),
(72, 0, 5, 'Tidak ada selisih  ( kompetensi sesuai yang dibutuhkan )', 28, 8),
(73, 1, 4.5, 'Kompetensi individu kelebihan 1 tingkat/level', 28, 8),
(74, -1, 4, 'Kompetensi individu kekurangan 1 tingkat/level', 28, 8),
(75, 2, 3.5, 'Kompetensi individu kelebihan 2 tingkat/level', 28, 8),
(76, -2, 3, 'Kompetensi individu kekurangan 2 tingkat/level', 28, 8),
(77, 3, 2.5, 'Kompetensi individu kelebihan 3 tingkat/level', 28, 8),
(78, -3, 2, 'Kompetensi individu kekurangan 3 tingkat/level', 28, 8),
(79, 4, 1.5, 'Kompetensi individu kelebihan 4 tingkat/level', 28, 8),
(80, -4, 1, 'Kompetensi individu kekurangan 4 tingkat/level', 28, 8),
(82, 0, 5, 'Kompetensi individu kelebihan 1 tingkat/level', 32, 8),
(83, 1, 4.5, 'Kompetensi individu kelebihan 2 tingkat/level', 32, 8),
(84, -1, 4, 'kompetensi ', 32, 8);

-- --------------------------------------------------------

--
-- Table structure for table `faktor`
--

CREATE TABLE `faktor` (
  `id_faktor` tinyint(3) UNSIGNED NOT NULL,
  `aspek` tinyint(3) UNSIGNED NOT NULL COMMENT 'FK tbl_aspek',
  `nama_faktor` varchar(50) NOT NULL,
  `target` tinyint(3) NOT NULL,
  `jenis` enum('1','2') DEFAULT NULL COMMENT '1=Core;2=Secondary',
  `id_spk` int(11) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `faktor`
--

INSERT INTO `faktor` (`id_faktor`, `aspek`, `nama_faktor`, `target`, `jenis`, `id_spk`, `id_user`) VALUES
(46, 10, 'Bidang penelitian', 5, '1', 2, 9),
(42, 8, 'Pengaruh', 2, '2', 1, 8),
(41, 8, 'Mandiri dan dinamis', 3, '2', 1, 8),
(40, 8, 'Kesungguhan', 4, '1', 1, 8),
(39, 8, 'Kepatuhan', 3, '1', 1, 8),
(38, 7, 'Hati hati', 4, '2', 1, 8),
(37, 7, 'Perencanaan', 3, '1', 1, 8),
(36, 7, 'Motivasi', 3, '2', 1, 8),
(35, 7, 'Pengendalian Perasaan', 2, '2', 1, 8),
(45, 9, 'Judul tesis', 4, '1', 2, 9),
(43, 9, 'Pengajaran', 5, '1', 2, 9),
(44, 9, 'Konsentrasi', 3, '2', 2, 9),
(108, 28, 'hhfgdhf', 3, '1', 22, 9),
(29, 6, 'Antisipasi', 3, '2', 1, 8),
(28, 6, 'Konsentrasi', 4, '2', 1, 8),
(27, 6, 'Potensi cerdas', 4, '1', 1, 8),
(26, 6, 'Gagasan ide', 3, '2', 1, 8),
(24, 6, 'Kreatif', 3, '1', 1, 8),
(25, 6, 'Penalaran dan solusi', 3, '1', 1, 8),
(47, 10, 'Topik Penelitian', 5, '2', 2, 9),
(48, 11, 'Seminar', 2, '1', 2, 9),
(49, 11, 'Workshop', 2, '2', 2, 9),
(50, 14, 'Menjaga nama baik sebagai pendidik', 3, '2', 8, 8),
(51, 14, 'Sikap ', 4, '1', 8, 8),
(53, 14, 'Pengajaran', 3, '1', 8, 8),
(54, 15, 'Motivasi', 3, '1', 8, 8),
(55, 15, 'Tanggung Jawab', 4, '1', 8, 8),
(56, 15, 'Pengaruh', 4, '2', 8, 8),
(57, 17, 'Kesuburan', 3, '1', 11, 12),
(58, 17, 'Kesuburan', 3, '1', 11, 12),
(59, 0, 'common sense', 3, '2', 13, 12),
(60, 20, 'common sense', 3, '2', 13, 12),
(61, 20, 'verbalisasi ide', 3, '2', 13, 12),
(62, 20, 'sistematika berpikir', 4, '1', 13, 12),
(63, 20, 'penalaran dan solusi real', 4, '1', 13, 12),
(64, 20, 'konsentrasi', 3, '2', 13, 12),
(65, 20, 'logika praktis', 4, '1', 13, 12),
(66, 20, 'fleksibiltas berpikir', 4, '1', 13, 12),
(67, 20, 'imajinasi kreatif', 5, '1', 13, 12),
(68, 20, 'antisipasi', 3, '2', 13, 12),
(69, 20, 'potensi kecerdasan', 4, '1', 13, 12),
(70, 21, 'energi psikis', 3, '2', 13, 12),
(71, 21, 'ketelitian dan tanggung jawab', 4, '1', 13, 12),
(72, 21, 'kehati-hatian', 2, '2', 13, 12),
(73, 21, 'pengendalian perasaan', 3, '2', 13, 12),
(74, 21, 'dorongan berprestasi', 3, '2', 13, 12),
(75, 21, 'vitalitas dan perencanaan', 5, '1', 13, 12),
(76, 22, 'kekuasaan', 3, '2', 13, 12),
(77, 22, 'pengaruh', 3, '2', 13, 12),
(78, 22, 'keteguhan hati', 4, '1', 13, 12),
(79, 22, 'pemenuhan', 5, '1', 13, 12),
(80, 23, 'common sense', 3, '2', 14, 12),
(81, 23, 'verbalisasi ide', 3, '2', 14, 12),
(82, 23, 'sistematika berpikir', 4, '1', 14, 12),
(83, 23, 'penalaran dan solusi real', 4, '1', 14, 12),
(84, 23, 'Konsentrasi', 3, '2', 14, 12),
(85, 23, 'logika praktis', 4, '1', 14, 12),
(86, 23, 'fleksibiltas berpikir', 4, '1', 14, 12),
(87, 23, 'imajinasi kreatif', 5, '1', 14, 12),
(88, 23, 'antisipasi', 3, '2', 14, 12),
(89, 23, 'potensi kecerdasan', 4, '1', 14, 12),
(90, 24, 'energi psikis', 3, '2', 14, 12),
(91, 24, 'ketelitian dan tanggung jawab', 4, '1', 14, 12),
(92, 24, 'kehati-hatian', 2, '2', 14, 12),
(93, 24, 'pengendalian perasaan', 3, '2', 14, 12),
(94, 24, 'dorongan berprestasi', 3, '2', 14, 12),
(95, 24, 'vitalitas dan perencanaan', 5, '1', 14, 12),
(96, 25, 'kekuasaan', 3, '2', 14, 12),
(97, 25, 'Pengaruh', 3, '2', 14, 12),
(98, 25, 'keteguhan hati', 4, '1', 14, 12),
(99, 25, 'pemenuhan', 5, '1', 14, 12),
(100, 26, 'xx', 3, '1', 16, 8),
(101, 26, 'xx', 3, '1', 16, 8),
(102, 0, 'xx', 2, '1', 0, 8),
(103, 0, '', 0, '', 0, 8),
(104, 0, '', 0, '', 0, 8),
(105, 26, 'xx', 3, '1', 16, 8),
(106, 26, 'xx', 3, '2', 16, 8),
(107, 26, 'xx', 4, '2', 16, 8),
(109, 29, 'Nilai Akademis', 5, '1', 28, 8),
(110, 29, 'Prestasi Non Akademik', 3, '2', 28, 8),
(111, 30, 'Tanggungan Keluarga', 4, '1', 28, 8),
(112, 30, 'Kondisi Rumah', 3, '2', 28, 8),
(115, 33, 'kondisi tanah', 3, '1', 31, 9),
(116, 33, 'kesegaran ', 5, '1', 31, 9),
(118, 0, '', 0, '', 0, 9),
(120, 33, 'kesubuhan', 3, '1', 31, 9),
(121, 39, 'Nilai Akademis', 3, '1', 32, 8),
(122, 39, 'nilai non akademis', 2, '2', 32, 8),
(123, 40, 'djjfjfhfhfj', 3, '1', 32, 8),
(124, 40, 'yuiiii', 4, '2', 32, 8);

-- --------------------------------------------------------

--
-- Table structure for table `hasil`
--

CREATE TABLE `hasil` (
  `id` int(11) NOT NULL,
  `nama_alternatif` varchar(50) NOT NULL,
  `nilai` float NOT NULL,
  `id_spk` int(11) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hasil`
--

INSERT INTO `hasil` (`id`, `nama_alternatif`, `nilai`, `id_spk`, `id_user`) VALUES
(154, 'Pak Yanto', 4.3, 8, 8),
(155, 'Pak Indra', 4.3, 8, 8),
(156, 'Bu Erni', 3.61, 8, 8);

-- --------------------------------------------------------

--
-- Table structure for table `nilai`
--

CREATE TABLE `nilai` (
  `id_nilai` int(11) UNSIGNED NOT NULL,
  `id_alternatif` tinyint(3) UNSIGNED DEFAULT NULL,
  `faktor` tinyint(3) UNSIGNED DEFAULT NULL,
  `nilai` tinyint(3) UNSIGNED DEFAULT NULL,
  `id_spk` int(11) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nilai`
--

INSERT INTO `nilai` (`id_nilai`, `id_alternatif`, `faktor`, `nilai`, `id_spk`, `id_user`) VALUES
(237, 13, 49, 3, 2, 9),
(236, 13, 48, 4, 2, 9),
(235, 13, 47, 5, 2, 9),
(234, 13, 46, 4, 2, 9),
(233, 13, 45, 5, 2, 9),
(232, 13, 44, 4, 2, 9),
(231, 13, 43, 5, 2, 9),
(230, 12, 29, 3, 1, 8),
(229, 12, 28, 2, 1, 8),
(228, 12, 27, 3, 1, 8),
(227, 12, 26, 3, 1, 8),
(226, 12, 25, 4, 1, 8),
(225, 12, 24, 3, 1, 8),
(224, 12, 38, 1, 1, 8),
(223, 12, 37, 4, 1, 8),
(222, 12, 36, 5, 1, 8),
(221, 12, 35, 5, 1, 8),
(220, 12, 30, 4, 1, 8),
(219, 12, 42, 4, 1, 8),
(218, 12, 41, 5, 1, 8),
(217, 12, 40, 5, 1, 8),
(216, 12, 39, 4, 1, 8),
(215, 11, 29, 4, 1, 8),
(214, 11, 28, 4, 1, 8),
(213, 11, 27, 3, 1, 8),
(212, 11, 26, 4, 1, 8),
(211, 11, 25, 5, 1, 8),
(210, 11, 24, 3, 1, 8),
(209, 11, 38, 2, 1, 8),
(208, 11, 37, 5, 1, 8),
(207, 11, 36, 5, 1, 8),
(206, 11, 35, 5, 1, 8),
(205, 11, 30, 1, 1, 8),
(204, 11, 42, 5, 1, 8),
(203, 11, 41, 5, 1, 8),
(202, 11, 40, 5, 1, 8),
(201, 11, 39, 1, 1, 8),
(200, 9, 29, 2, 1, 8),
(199, 9, 28, 2, 1, 8),
(198, 9, 27, 4, 1, 8),
(197, 9, 26, 2, 1, 8),
(196, 9, 25, 3, 1, 8),
(195, 9, 24, 5, 1, 8),
(194, 9, 38, 2, 1, 8),
(193, 9, 37, 4, 1, 8),
(192, 9, 36, 3, 1, 8),
(191, 9, 35, 3, 1, 8),
(190, 9, 30, 2, 1, 8),
(189, 9, 42, 4, 1, 8),
(188, 9, 41, 3, 1, 8),
(187, 9, 40, 3, 1, 8),
(186, 9, 39, 2, 1, 8),
(238, 18, 50, 4, 8, 8),
(239, 18, 51, 3, 8, 8),
(240, 18, 53, 3, 8, 8),
(241, 18, 54, 2, 8, 8),
(242, 18, 55, 3, 8, 8),
(243, 18, 56, 3, 8, 8),
(244, 19, 50, 1, 8, 8),
(245, 19, 51, 2, 8, 8),
(246, 19, 53, 3, 8, 8),
(247, 19, 54, 4, 8, 8),
(248, 19, 55, 3, 8, 8),
(249, 19, 56, 2, 8, 8),
(250, 20, 50, 4, 8, 8),
(251, 20, 51, 3, 8, 8),
(252, 20, 53, 3, 8, 8),
(253, 20, 54, 2, 8, 8),
(254, 20, 55, 3, 8, 8),
(255, 20, 56, 3, 8, 8),
(256, 14, 43, 4, 2, 9),
(257, 14, 44, 2, 2, 9),
(258, 14, 45, 4, 2, 9),
(259, 14, 46, 4, 2, 9),
(260, 14, 47, 3, 2, 9),
(261, 14, 48, 2, 2, 9),
(262, 14, 49, 3, 2, 9),
(263, 15, 43, 4, 2, 9),
(264, 15, 44, 3, 2, 9),
(265, 15, 45, 2, 2, 9),
(266, 15, 46, 5, 2, 9),
(267, 15, 47, 4, 2, 9),
(268, 15, 48, 5, 2, 9),
(269, 15, 49, 3, 2, 9),
(270, 16, 43, 4, 2, 9),
(271, 16, 44, 1, 2, 9),
(272, 16, 45, 4, 2, 9),
(273, 16, 46, 3, 2, 9),
(274, 16, 47, 3, 2, 9),
(275, 16, 48, 3, 2, 9),
(276, 16, 49, 5, 2, 9),
(277, 17, 43, 5, 2, 9),
(278, 17, 44, 3, 2, 9),
(279, 17, 45, 1, 2, 9),
(280, 17, 46, 4, 2, 9),
(281, 17, 47, 4, 2, 9),
(282, 17, 48, 3, 2, 9),
(283, 17, 49, 3, 2, 9),
(284, 25, 57, 4, 11, 12),
(285, 25, 58, 5, 11, 12),
(286, 26, 60, 5, 13, 12),
(287, 26, 61, 3, 13, 12),
(288, 26, 62, 2, 13, 12),
(289, 26, 63, 4, 13, 12),
(290, 26, 64, 2, 13, 12),
(291, 26, 65, 2, 13, 12),
(292, 26, 66, 4, 13, 12),
(293, 26, 67, 2, 13, 12),
(294, 26, 68, 3, 13, 12),
(295, 26, 69, 4, 13, 12),
(296, 26, 70, 2, 13, 12),
(297, 26, 71, 3, 13, 12),
(298, 26, 72, 3, 13, 12),
(299, 26, 73, 3, 13, 12),
(300, 26, 74, 4, 13, 12),
(301, 26, 75, 2, 13, 12),
(302, 26, 76, 3, 13, 12),
(303, 26, 77, 4, 13, 12),
(304, 26, 78, 5, 13, 12),
(305, 26, 79, 3, 13, 12),
(306, 27, 60, 3, 13, 12),
(307, 27, 61, 5, 13, 12),
(308, 27, 62, 4, 13, 12),
(309, 27, 63, 3, 13, 12),
(310, 27, 64, 4, 13, 12),
(311, 27, 65, 4, 13, 12),
(312, 27, 66, 3, 13, 12),
(313, 27, 67, 5, 13, 12),
(314, 27, 68, 4, 13, 12),
(315, 27, 69, 3, 13, 12),
(316, 27, 70, 1, 13, 12),
(317, 27, 71, 5, 13, 12),
(318, 27, 72, 5, 13, 12),
(319, 27, 73, 5, 13, 12),
(320, 27, 74, 5, 13, 12),
(321, 27, 75, 2, 13, 12),
(322, 27, 76, 3, 13, 12),
(323, 27, 77, 3, 13, 12),
(324, 27, 78, 4, 13, 12),
(325, 27, 79, 5, 13, 12),
(326, 28, 60, 3, 13, 12),
(327, 28, 61, 4, 13, 12),
(328, 28, 62, 3, 13, 12),
(329, 28, 63, 3, 13, 12),
(330, 28, 64, 2, 13, 12),
(331, 28, 65, 3, 13, 12),
(332, 28, 66, 4, 13, 12),
(333, 28, 67, 2, 13, 12),
(334, 28, 68, 4, 13, 12),
(335, 28, 69, 4, 13, 12),
(336, 28, 70, 4, 13, 12),
(337, 28, 71, 5, 13, 12),
(338, 28, 72, 5, 13, 12),
(339, 28, 73, 1, 13, 12),
(340, 28, 74, 4, 13, 12),
(341, 28, 75, 1, 13, 12),
(342, 28, 76, 4, 13, 12),
(343, 28, 77, 3, 13, 12),
(344, 28, 78, 4, 13, 12),
(345, 28, 79, 4, 13, 12),
(346, 29, 80, 5, 14, 12),
(347, 29, 81, 3, 14, 12),
(348, 29, 82, 2, 14, 12),
(349, 29, 83, 4, 14, 12),
(350, 29, 84, 2, 14, 12),
(351, 29, 85, 2, 14, 12),
(352, 29, 86, 4, 14, 12),
(353, 29, 87, 2, 14, 12),
(354, 29, 88, 3, 14, 12),
(355, 29, 89, 4, 14, 12),
(356, 29, 90, 2, 14, 12),
(357, 29, 91, 3, 14, 12),
(358, 29, 92, 3, 14, 12),
(359, 29, 93, 3, 14, 12),
(360, 29, 94, 4, 14, 12),
(361, 29, 95, 2, 14, 12),
(362, 29, 96, 3, 14, 12),
(363, 29, 97, 4, 14, 12),
(364, 29, 98, 5, 14, 12),
(365, 29, 99, 3, 14, 12),
(366, 30, 80, 3, 14, 12),
(367, 30, 81, 4, 14, 12),
(368, 30, 82, 3, 14, 12),
(369, 30, 83, 3, 14, 12),
(370, 30, 84, 2, 14, 12),
(371, 30, 85, 3, 14, 12),
(372, 30, 86, 4, 14, 12),
(373, 30, 87, 2, 14, 12),
(374, 30, 88, 4, 14, 12),
(375, 30, 89, 4, 14, 12),
(376, 30, 90, 4, 14, 12),
(377, 30, 91, 5, 14, 12),
(378, 30, 92, 5, 14, 12),
(379, 30, 93, 1, 14, 12),
(380, 30, 94, 4, 14, 12),
(381, 30, 95, 1, 14, 12),
(382, 30, 96, 4, 14, 12),
(383, 30, 97, 3, 14, 12),
(384, 30, 98, 4, 14, 12),
(385, 30, 99, 4, 14, 12),
(386, 31, 80, 3, 14, 12),
(387, 31, 81, 4, 14, 12),
(388, 31, 82, 3, 14, 12),
(389, 31, 83, 3, 14, 12),
(390, 31, 84, 2, 14, 12),
(391, 31, 85, 3, 14, 12),
(392, 31, 86, 4, 14, 12),
(393, 31, 87, 2, 14, 12),
(394, 31, 88, 4, 14, 12),
(395, 31, 89, 4, 14, 12),
(396, 31, 90, 4, 14, 12),
(397, 31, 91, 5, 14, 12),
(398, 31, 92, 5, 14, 12),
(399, 31, 93, 1, 14, 12),
(400, 31, 94, 4, 14, 12),
(401, 31, 95, 1, 14, 12),
(402, 31, 96, 4, 14, 12),
(403, 31, 97, 3, 14, 12),
(404, 31, 98, 4, 14, 12),
(405, 31, 99, 4, 14, 12),
(406, 33, 108, 4, 22, 9),
(407, 34, 109, 5, 28, 8),
(408, 34, 110, 4, 28, 8),
(409, 34, 111, 4, 28, 8),
(410, 34, 112, 4, 28, 8),
(411, 35, 109, 5, 28, 8),
(412, 35, 110, 4, 28, 8),
(413, 35, 111, 4, 28, 8),
(414, 35, 112, 4, 28, 8),
(415, 36, 109, 3, 28, 8),
(416, 36, 110, 2, 28, 8),
(417, 36, 111, 3, 28, 8),
(418, 36, 112, 5, 28, 8);

-- --------------------------------------------------------

--
-- Table structure for table `spk`
--

CREATE TABLE `spk` (
  `id_spk` int(6) NOT NULL,
  `nama_spk` text NOT NULL,
  `keterangan` text NOT NULL,
  `tanggal` date NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `spk`
--

INSERT INTO `spk` (`id_spk`, `nama_spk`, `keterangan`, `tanggal`, `id_user`) VALUES
(2, 'Rekomendasi Dosbing Skripsi', 'Sistem pendukung keputusan rekomendasi dosen pembimbing skripsi', '2020-11-04', 9),
(8, 'Guru terbaik', 'Sistem pendukung keputusan penentuan guru terbaik', '2020-11-12', 8),
(13, 'Promosi Jabatan', 'Implementasi metode Profile Matching untuk promosi jabatan berdasarkan evaluasi kinerja karyawan', '2020-12-04', 12),
(14, 'Promosi Jabatan ( 2 )', 'Implementasi metode Profile Matching untuk promosi jabatan berdasarkan evaluasi kinerja karyawan', '2020-12-05', 12),
(28, 'Pemilihan Calon Beasiswa', 'SPK Penentuan Calon Beasiswa', '2021-01-10', 8),
(31, 'pemilihan tanaman', 'spk pemilihan tanaman', '2021-01-16', 9),
(32, 'beasiswa', 'spk beasiswa', '2021-01-22', 8);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `password` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `nama` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `alamat` varchar(250) COLLATE latin1_general_ci NOT NULL,
  `tlp` varchar(15) COLLATE latin1_general_ci NOT NULL,
  `email` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `level` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `foto` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `aktif` char(1) COLLATE latin1_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `nama`, `alamat`, `tlp`, `email`, `level`, `foto`, `aktif`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Administrator', 'Desa Keduanan Blok Kamas 1 rt 017 rw 008 Kec. Depok Kab. Cirebon', '083824021622', 'suhardiman645@gmail.com', 'admin', 'IMG-20200830-WA0008.jpg', 'Y'),
(8, 'member', 'aa08769cdcb26674c6706093503ff0a3', 'Member', 'Desa Keduanan Blok Kamas 1 rt 017 rw 008 Kec. Depok Kab. Cirebon', '083824021622', 'suhardiman64@gmail.com', 'user', '502378.jpg', 'Y'),
(9, 'member2', '202cb962ac59075b964b07152d234b70', 'Member 2', 'Desa Keduanan Blok Kamas 1 rt 017 rw 008 Kec. Depok Kab. Cirebon', '083824021622', 'suhardiman6@gmail.com', 'user', '', 'Y'),
(12, 'hardyman', '827ccb0eea8a706c4c34a16891f84e7b', 'Hardyman', 'cirebon', '083824021622', 'suhardiman@gmail.com', 'user', '', 'Y');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`username`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `alternatif`
--
ALTER TABLE `alternatif`
  ADD PRIMARY KEY (`id_alternatif`);

--
-- Indexes for table `aspek`
--
ALTER TABLE `aspek`
  ADD PRIMARY KEY (`id_aspek`);

--
-- Indexes for table `bobot`
--
ALTER TABLE `bobot`
  ADD PRIMARY KEY (`id_bobot`);

--
-- Indexes for table `faktor`
--
ALTER TABLE `faktor`
  ADD PRIMARY KEY (`id_faktor`);

--
-- Indexes for table `hasil`
--
ALTER TABLE `hasil`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nilai`
--
ALTER TABLE `nilai`
  ADD PRIMARY KEY (`id_nilai`);

--
-- Indexes for table `spk`
--
ALTER TABLE `spk`
  ADD PRIMARY KEY (`id_spk`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `alternatif`
--
ALTER TABLE `alternatif`
  MODIFY `id_alternatif` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `aspek`
--
ALTER TABLE `aspek`
  MODIFY `id_aspek` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `bobot`
--
ALTER TABLE `bobot`
  MODIFY `id_bobot` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `faktor`
--
ALTER TABLE `faktor`
  MODIFY `id_faktor` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=125;

--
-- AUTO_INCREMENT for table `hasil`
--
ALTER TABLE `hasil`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=157;

--
-- AUTO_INCREMENT for table `nilai`
--
ALTER TABLE `nilai`
  MODIFY `id_nilai` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=419;

--
-- AUTO_INCREMENT for table `spk`
--
ALTER TABLE `spk`
  MODIFY `id_spk` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
