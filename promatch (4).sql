-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 04 Feb 2021 pada 08.43
-- Versi server: 10.4.17-MariaDB
-- Versi PHP: 7.4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
-- Struktur dari tabel `alternatif`
--

CREATE TABLE `alternatif` (
  `id_alternatif` int(3) UNSIGNED NOT NULL,
  `nama_alternatif` varchar(100) NOT NULL,
  `id_spkuser` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `alternatif`
--

INSERT INTO `alternatif` (`id_alternatif`, `nama_alternatif`, `id_spkuser`) VALUES
(310, 'A1', 25),
(313, 'A1', 27),
(306, 'A4', 24),
(272, 'Si Apenk', 1),
(303, 'A1', 23),
(278, 'Si Ganteng', 1),
(305, 'A1', 24),
(287, 'Si Irfan Manaf', 1),
(288, 'Si Awip', 1),
(304, 'A2', 23),
(311, 'A12', 25),
(312, 'A13', 25),
(314, 'A2', 27);

--
-- Trigger `alternatif`
--
DELIMITER $$
CREATE TRIGGER `create_alternatif` AFTER INSERT ON `alternatif` FOR EACH ROW BEGIN

INSERT INTO `log_alternatif` (action, id_alternatif, `nama_alternatif`, `id_spkuser`) VALUES
('CREATE', new.id_alternatif, new.nama_alternatif, new.id_spkuser);

END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `delete_alternatif` AFTER DELETE ON `alternatif` FOR EACH ROW BEGIN

INSERT INTO `log_alternatif` (action, id_alternatif, `nama_alternatif`, `id_spkuser`) VALUES
('DELETE', old.id_alternatif, old.nama_alternatif, old.id_spkuser);

END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_alternatif_after` BEFORE UPDATE ON `alternatif` FOR EACH ROW BEGIN

INSERT INTO `log_alternatif` (action, id_alternatif, `nama_alternatif`, `id_spkuser`) VALUES
('UPDATE NEW', new.id_alternatif, new.nama_alternatif, new.id_spkuser);

END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_alternatif_before` BEFORE UPDATE ON `alternatif` FOR EACH ROW BEGIN

INSERT INTO `log_alternatif` (action, id_alternatif, `nama_alternatif`, `id_spkuser`) VALUES
('UPDATE', old.id_alternatif, old.nama_alternatif, old.id_spkuser);

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `aspek`
--

CREATE TABLE `aspek` (
  `id_aspek` tinyint(3) UNSIGNED NOT NULL,
  `nama_aspek` varchar(100) NOT NULL,
  `bobot` float NOT NULL,
  `bobot_core` float NOT NULL,
  `bobot_secondary` float NOT NULL,
  `nama_singkat` char(2) DEFAULT NULL,
  `id_spk` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `aspek`
--

INSERT INTO `aspek` (`id_aspek`, `nama_aspek`, `bobot`, `bobot_core`, `bobot_secondary`, `nama_singkat`, `id_spk`) VALUES
(20, 'Kecerdasan a', 0.1, 70, 30, 'K2', 13),
(21, 'Sikap Kerja', 0.375, 70, 30, 'SK', 13),
(22, 'Perilaku', 0.375, 70, 30, 'P', 13),
(85, 'memory', 0.571429, 50, 50, 'm', 52),
(84, 'Harga', 0.428571, 50, 50, 'H', 52),
(83, 'Aspek1', 70, 50, 50, 'A1', 51),
(82, 'Apske Baru', 15, 70, 30, 'AB', 13),
(77, 'Aspek 2', 0.1, 10, 90, 'A2', 50),
(76, 'Aspek 1', 0.9, 90, 10, 'AP', 50),
(75, 'Aspek 1', 100, 80, 20, 'A1', 49);

--
-- Trigger `aspek`
--
DELIMITER $$
CREATE TRIGGER `create_aspek` AFTER INSERT ON `aspek` FOR EACH ROW BEGIN

INSERT INTO `log_aspek` (action, id_aspek, `nama_aspek`, `bobot`, `bobot_core`, `bobot_secondary`, `nama_singkat`, `id_spk`) VALUES
('CREATE', new.id_aspek, new.nama_aspek, new.bobot, new.bobot_core, new.bobot_secondary, new.nama_singkat, new.id_spk);

END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `delete_aspek` AFTER DELETE ON `aspek` FOR EACH ROW BEGIN

INSERT INTO `log_aspek` (action, id_aspek, `nama_aspek`, `bobot`, `bobot_core`, `bobot_secondary`, `nama_singkat`, `id_spk`) VALUES
('DELETE', old.id_aspek, old.nama_aspek, old.bobot, old.bobot_core, old.bobot_secondary, old.nama_singkat, old.id_spk);

END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_aspek_after` BEFORE UPDATE ON `aspek` FOR EACH ROW BEGIN

INSERT INTO `log_aspek` (action, id_aspek, `nama_aspek`, `bobot`, `bobot_core`, `bobot_secondary`, `nama_singkat`, `id_spk`) VALUES
('UPDATE NEW', new.id_aspek, new.nama_aspek, new.bobot, new.bobot_core, new.bobot_secondary, new.nama_singkat, new.id_spk);

END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_aspek_before` BEFORE UPDATE ON `aspek` FOR EACH ROW BEGIN

INSERT INTO `log_aspek` (action, id_aspek, `nama_aspek`, `bobot`, `bobot_core`, `bobot_secondary`, `nama_singkat`, `id_spk`) VALUES
('UPDATE', old.id_aspek, old.nama_aspek, old.bobot, old.bobot_core, old.bobot_secondary, old.nama_singkat, old.id_spk);

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `bobot`
--

CREATE TABLE `bobot` (
  `id_bobot` int(11) NOT NULL,
  `selisih` tinyint(3) NOT NULL,
  `bobot` float NOT NULL,
  `keterangan` varchar(100) NOT NULL,
  `id_spk` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `bobot`
--

INSERT INTO `bobot` (`id_bobot`, `selisih`, `bobot`, `keterangan`, `id_spk`) VALUES
(54, 0, 5, 'Tidak ada selisih  ( kompetensi sesuai yang dibutuhkan )', 13),
(55, 1, 4.5, 'Kompetensi individu kelebihan 1 tingkat/level', 13),
(56, -1, 4, 'Kompetensi individu kekurangan 1 tingkat/level', 13),
(57, 2, 3.5, 'Kompetensi individu kelebihan 2 tingkat/level', 13),
(58, -2, 3, 'Kompetensi individu kekurangan 2 tingkat/level', 13),
(59, 3, 2.5, 'Kompetensi individu kelebihan 3 tingkat/level', 13),
(60, -3, 2, 'Kompetensi individu kekurangan 3 tingkat/level', 13),
(61, 4, 1.5, 'Kompetensi individu kelebihan 4 tingkat/level', 13),
(62, -4, 1, 'Kompetensi individu kekurangan 4 tingkat/level', 13);

--
-- Trigger `bobot`
--
DELIMITER $$
CREATE TRIGGER `create_bobot` AFTER INSERT ON `bobot` FOR EACH ROW BEGIN

INSERT INTO `log_bobot` (action, id_bobot, `selisih`, `bobot`, `keterangan`, `id_spk`) VALUES
('CREATE', new.id_bobot, new.selisih, new.bobot, new.keterangan, new.id_spk);

END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `delete_bobot` AFTER DELETE ON `bobot` FOR EACH ROW BEGIN

INSERT INTO `log_bobot` (action, id_bobot, `selisih`, `bobot`, `keterangan`, `id_spk`) VALUES
('DELETE', old.id_bobot, old.selisih, old.bobot, old.keterangan, old.id_spk);

END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_bobot_after` BEFORE UPDATE ON `bobot` FOR EACH ROW BEGIN

INSERT INTO `log_bobot` (action, id_bobot, `selisih`, `bobot`, `keterangan`, `id_spk`) VALUES
('UPDATE NEW', new.id_bobot, new.selisih, new.bobot, new.keterangan, new.id_spk);

END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_bobot_before` BEFORE UPDATE ON `bobot` FOR EACH ROW BEGIN

INSERT INTO `log_bobot` (action, id_bobot, `selisih`, `bobot`, `keterangan`, `id_spk`) VALUES
('UPDATE', old.id_bobot, old.selisih, old.bobot, old.keterangan, old.id_spk);

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `faktor`
--

CREATE TABLE `faktor` (
  `id_faktor` tinyint(3) UNSIGNED NOT NULL,
  `aspek` tinyint(3) UNSIGNED NOT NULL COMMENT 'FK tbl_aspek',
  `nama_faktor` varchar(50) NOT NULL,
  `target` tinyint(3) NOT NULL,
  `jenis` enum('1','2') DEFAULT NULL COMMENT '1=Core;2=Secondary'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `faktor`
--

INSERT INTO `faktor` (`id_faktor`, `aspek`, `nama_faktor`, `target`, `jenis`) VALUES
(60, 20, 'common sense', 4, '2'),
(61, 20, 'verbalisasi ide', 3, '2'),
(62, 20, 'sistematika berpikir', 4, '1'),
(63, 20, 'penalaran dan solusi real', 4, '1'),
(64, 20, 'konsentrasi', 3, '2'),
(65, 20, 'logika praktis', 4, '1'),
(66, 20, 'fleksibiltas berpikir', 4, '1'),
(67, 20, 'imajinasi kreatif', 5, '1'),
(68, 20, 'antisipasi', 3, '2'),
(69, 20, 'potensi kecerdasan', 4, '1'),
(70, 21, 'energi psikis', 3, '2'),
(71, 21, 'ketelitian dan tanggung jawab', 4, '1'),
(72, 21, 'kehati-hatian', 2, '2'),
(73, 21, 'pengendalian perasaan', 3, '2'),
(74, 21, 'dorongan berprestasi', 3, '2'),
(75, 21, 'vitalitas dan perencanaan', 5, '1'),
(76, 22, 'kekuasaan', 3, '2'),
(77, 22, 'pengaruh', 3, '2'),
(78, 22, 'keteguhan hati', 4, '1'),
(79, 22, 'pemenuhan', 5, '1'),
(193, 84, '3jt-5jt', 4, '2'),
(192, 85, 'rom', 4, '2'),
(191, 85, 'ram', 3, '1'),
(190, 84, '1-2 juta', 3, '1'),
(189, 83, 'Faktor', 2, '2'),
(188, 83, 'Faktor1', 5, '1'),
(181, 77, 'Faktor 2', 5, '2'),
(180, 77, 'Faktor 1', 5, '1'),
(179, 76, 'F3', 5, '2'),
(178, 76, 'F1', 5, '1'),
(177, 75, 'Faktor 2', 5, '2'),
(176, 75, 'F1', 4, '1');

--
-- Trigger `faktor`
--
DELIMITER $$
CREATE TRIGGER `create_faktor` AFTER INSERT ON `faktor` FOR EACH ROW BEGIN

INSERT INTO `log_faktor` (action, id_faktor, `aspek`, `nama_faktor`, `target`, `jenis`) VALUES
('CREATE', new.id_faktor, new.aspek, new.nama_faktor, new.target, new.jenis);

END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `delete_faktor` AFTER DELETE ON `faktor` FOR EACH ROW BEGIN

INSERT INTO `log_faktor` (action, id_faktor, `aspek`, `nama_faktor`, `target`, `jenis`) VALUES
('DELETE', old.id_faktor, old.aspek, old.nama_faktor, old.target, old.jenis);

END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_faktor_after` BEFORE UPDATE ON `faktor` FOR EACH ROW BEGIN

INSERT INTO `log_faktor` (action, id_faktor, `aspek`, `nama_faktor`, `target`, `jenis`) VALUES
('UPDATE NEW', new.id_faktor, new.aspek, new.nama_faktor, new.target, new.jenis);

END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_faktor_before` BEFORE UPDATE ON `faktor` FOR EACH ROW BEGIN

INSERT INTO `log_faktor` (action, id_faktor, `aspek`, `nama_faktor`, `target`, `jenis`) VALUES
('UPDATE', old.id_faktor, old.aspek, old.nama_faktor, old.target, old.jenis);

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `hasil`
--

CREATE TABLE `hasil` (
  `id` int(11) NOT NULL,
  `nama_alternatif` varchar(50) NOT NULL,
  `nilai` float NOT NULL,
  `id_spkuser` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `hasil`
--

INSERT INTO `hasil` (`id`, `nama_alternatif`, `nilai`, `id_spkuser`) VALUES
(435, 'A13', 3.69226, 25),
(417, 'Si Apenk', 2.01771, 1),
(380, 'A2', 3.8, 23),
(379, 'A1', 5, 23),
(416, 'Si Ganteng', 3.67188, 1),
(441, 'A1', 4.78571, 27),
(415, 'Si Awip', 4.33646, 1),
(414, 'Si Apeng', 4.33646, 1),
(440, 'A4', 2.91, 24),
(439, 'A1', 4.89, 24),
(434, 'A12', 3.89558, 25),
(433, 'A1', 3.89613, 25),
(442, 'A2', 4.03571, 27);

--
-- Trigger `hasil`
--
DELIMITER $$
CREATE TRIGGER `create_hasil` AFTER INSERT ON `hasil` FOR EACH ROW BEGIN

INSERT INTO `log_hasil` (action, id, `nama_alternatif`, `nilai`, `id_spkuser`) VALUES
('CREATE', new.id, new.nama_alternatif, new.nilai, new.id_spkuser);

END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `delete_hasil` AFTER DELETE ON `hasil` FOR EACH ROW BEGIN

INSERT INTO `log_hasil` (action, id, `nama_alternatif`, `nilai`, `id_spkuser`) VALUES
('DELETE', old.id, old.nama_alternatif, old.nilai, old.id_spkuser);

END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_hasil_after` BEFORE UPDATE ON `hasil` FOR EACH ROW BEGIN

INSERT INTO `log_hasil` (action, id, `nama_alternatif`, `nilai`, `id_spkuser`) VALUES
('UPDATE NEW', new.id, new.nama_alternatif, new.nilai, new.id_spkuser);

END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_hasil_before` BEFORE UPDATE ON `hasil` FOR EACH ROW BEGIN

INSERT INTO `log_hasil` (action, id, `nama_alternatif`, `nilai`, `id_spkuser`) VALUES
('UPDATE', old.id, old.nama_alternatif, old.nilai, old.id_spkuser);

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `log_alternatif`
--

CREATE TABLE `log_alternatif` (
  `id_log` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `action` varchar(10) NOT NULL,
  `id_alternatif` int(11) NOT NULL,
  `nama_alternatif` varchar(100) NOT NULL,
  `id_spkuser` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `log_alternatif`
--

INSERT INTO `log_alternatif` (`id_log`, `date`, `action`, `id_alternatif`, `nama_alternatif`, `id_spkuser`) VALUES
(1, '2021-02-04 12:12:44', 'CREATE', 313, 'A1', 27),
(2, '2021-02-04 12:13:00', 'CREATE', 314, 'A2', 27),
(3, '2021-02-04 12:22:05', 'UPDATE NEW', 287, 'Si Irfan Manaf', 1),
(4, '2021-02-04 12:22:05', 'UPDATE', 287, 'Si Apeng', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `log_aspek`
--

CREATE TABLE `log_aspek` (
  `id_log` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `action` varchar(10) NOT NULL,
  `id_aspek` int(11) NOT NULL,
  `nama_aspek` varchar(100) NOT NULL,
  `bobot` float NOT NULL,
  `bobot_core` float NOT NULL,
  `bobot_secondary` float NOT NULL,
  `nama_singkat` char(2) NOT NULL,
  `id_spk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `log_aspek`
--

INSERT INTO `log_aspek` (`id_log`, `date`, `action`, `id_aspek`, `nama_aspek`, `bobot`, `bobot_core`, `bobot_secondary`, `nama_singkat`, `id_spk`) VALUES
(1, '2021-02-04 11:50:43', 'UPDATE NEW', 20, 'Kecerdasan a', 0.1, 70, 30, 'K2', 13),
(2, '2021-02-04 11:50:43', 'UPDATE', 20, 'Kecerdasan a', 0.25, 70, 30, 'K2', 13),
(3, '2021-02-04 11:51:20', 'CREATE', 82, 'Apske Baru', 15, 70, 30, 'AB', 13),
(4, '2021-02-04 11:53:30', 'CREATE', 83, 'Aspek1', 70, 50, 50, 'A1', 51),
(5, '2021-02-04 12:02:57', 'CREATE', 84, 'Harga', 30, 50, 50, 'H', 52),
(6, '2021-02-04 12:06:15', 'CREATE', 85, 'memory', 40, 50, 50, 'm', 52),
(7, '2021-02-04 12:13:20', 'UPDATE NEW', 85, 'memory', 0.571429, 50, 50, 'm', 52),
(8, '2021-02-04 12:13:20', 'UPDATE', 85, 'memory', 40, 50, 50, 'm', 52),
(9, '2021-02-04 12:13:20', 'UPDATE NEW', 84, 'Harga', 0.428571, 50, 50, 'H', 52),
(10, '2021-02-04 12:13:20', 'UPDATE', 84, 'Harga', 30, 50, 50, 'H', 52);

-- --------------------------------------------------------

--
-- Struktur dari tabel `log_bobot`
--

CREATE TABLE `log_bobot` (
  `id_log` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `action` varchar(10) NOT NULL,
  `id_bobot` int(11) NOT NULL,
  `selisih` tinyint(3) NOT NULL,
  `bobot` float NOT NULL,
  `keterangan` varchar(100) NOT NULL,
  `id_spk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `log_bobot`
--

INSERT INTO `log_bobot` (`id_log`, `date`, `action`, `id_bobot`, `selisih`, `bobot`, `keterangan`, `id_spk`) VALUES
(1, '2021-02-04 11:56:24', 'CREATE', 159, -4, 1, 'Kompetensi individu kekurangan 4 tingkat/level', 51),
(2, '2021-02-04 11:56:29', 'CREATE', 160, -3, 2, 'Kompetensi individu kekurangan 3 tingkat/level', 51),
(3, '2021-02-04 11:56:36', 'CREATE', 161, -2, 3, 'Kompetensi individu kekurangan 2 tingkat/level', 51),
(4, '2021-02-04 11:56:41', 'CREATE', 162, -1, 4, 'Kompetensi individu kekurangan 1 tingkat/level', 51),
(5, '2021-02-04 11:56:46', 'CREATE', 163, 0, 5, 'Tidak ada selisih  ( kompetensi sesuai yang dibutuhkan...', 51),
(6, '2021-02-04 11:56:51', 'CREATE', 164, 4, 1.5, 'Kompetensi individu kelebihan 4 tingkat/level', 51),
(7, '2021-02-04 11:56:55', 'CREATE', 165, 3, 2.5, 'Kompetensi individu kelebihan 3 tingkat/level', 51),
(8, '2021-02-04 11:57:00', 'CREATE', 166, 2, 3.5, 'Kompetensi individu kelebihan 2 tingkat/level', 51),
(9, '2021-02-04 11:57:04', 'CREATE', 167, 1, 4.5, 'Kompetensi individu kelebihan 1 tingkat/level', 51),
(10, '2021-02-04 13:23:08', 'DELETE', 167, 1, 4.5, 'Kompetensi individu kelebihan 1 tingkat/level', 51),
(11, '2021-02-04 13:23:08', 'DELETE', 166, 2, 3.5, 'Kompetensi individu kelebihan 2 tingkat/level', 51),
(12, '2021-02-04 13:23:08', 'DELETE', 165, 3, 2.5, 'Kompetensi individu kelebihan 3 tingkat/level', 51),
(13, '2021-02-04 13:23:08', 'DELETE', 164, 4, 1.5, 'Kompetensi individu kelebihan 4 tingkat/level', 51),
(14, '2021-02-04 13:23:08', 'DELETE', 163, 0, 5, 'Tidak ada selisih  ( kompetensi sesuai yang dibutuhkan...', 51),
(15, '2021-02-04 13:23:08', 'DELETE', 162, -1, 4, 'Kompetensi individu kekurangan 1 tingkat/level', 51),
(16, '2021-02-04 13:23:08', 'DELETE', 161, -2, 3, 'Kompetensi individu kekurangan 2 tingkat/level', 51),
(17, '2021-02-04 13:23:08', 'DELETE', 160, -3, 2, 'Kompetensi individu kekurangan 3 tingkat/level', 51),
(18, '2021-02-04 13:23:08', 'DELETE', 159, -4, 1, 'Kompetensi individu kekurangan 4 tingkat/level', 51),
(19, '2021-02-04 13:23:08', 'DELETE', 158, 1, 4.5, 'Kompetensi individu kelebihan 1 tingkat/level', 50),
(20, '2021-02-04 13:23:08', 'DELETE', 157, 2, 3.5, 'Kompetensi individu kelebihan 2 tingkat/level', 50),
(21, '2021-02-04 13:23:08', 'DELETE', 156, 3, 2.5, 'Kompetensi individu kelebihan 3 tingkat/level', 50),
(22, '2021-02-04 13:23:08', 'DELETE', 155, 4, 1.5, 'Kompetensi individu kelebihan 4 tingkat/level', 50),
(23, '2021-02-04 13:23:08', 'DELETE', 154, 0, 5, 'Tidak ada selisih  ( kompetensi sesuai yang dibutuhkan...', 50),
(24, '2021-02-04 13:23:08', 'DELETE', 153, -1, 4, 'Kompetensi individu kekurangan 1 tingkat/level', 50),
(25, '2021-02-04 13:23:08', 'DELETE', 152, -2, 3, 'Kompetensi individu kekurangan 2 tingkat/level', 50),
(26, '2021-02-04 13:23:08', 'DELETE', 151, -3, 2, 'Kompetensi individu kekurangan 3 tingkat/level', 50),
(27, '2021-02-04 13:23:08', 'DELETE', 150, -4, 1, 'Kompetensi individu kekurangan 4 tingkat/level', 50),
(28, '2021-02-04 13:23:08', 'DELETE', 147, 1, 4.5, 'Kompetensi individu kelebihan 1 tingkat/level', 49),
(29, '2021-02-04 13:23:08', 'DELETE', 146, 2, 3.5, 'Kompetensi individu kelebihan 2 tingkat/level', 49),
(30, '2021-02-04 13:23:08', 'DELETE', 145, 3, 2.5, 'Kompetensi individu kelebihan 3 tingkat/level', 49),
(31, '2021-02-04 13:23:08', 'DELETE', 144, 4, 1.5, 'Kompetensi individu kelebihan 4 tingkat/level', 49),
(32, '2021-02-04 13:23:08', 'DELETE', 143, 0, 5, 'Tidak ada selisih  ( kompetensi sesuai yang dibutuhkan...', 49),
(33, '2021-02-04 13:23:08', 'DELETE', 142, -1, 4, 'Kompetensi individu kekurangan 1 tingkat/level', 49),
(34, '2021-02-04 13:23:08', 'DELETE', 141, -2, 3, 'Kompetensi individu kekurangan 2 tingkat/level', 49),
(35, '2021-02-04 13:23:08', 'DELETE', 140, -3, 2, 'Kompetensi individu kekurangan 3 tingkat/level', 49),
(36, '2021-02-04 13:23:08', 'DELETE', 149, -4, 1, 'Kompetensi individu kekurangan 4 tingkat/level', 49);

-- --------------------------------------------------------

--
-- Struktur dari tabel `log_faktor`
--

CREATE TABLE `log_faktor` (
  `id_log` int(11) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `action` varchar(10) NOT NULL,
  `id_faktor` int(11) NOT NULL,
  `aspek` tinyint(3) NOT NULL,
  `nama_faktor` varchar(50) NOT NULL,
  `target` tinyint(3) NOT NULL,
  `jenis` enum('1','2') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `log_faktor`
--

INSERT INTO `log_faktor` (`id_log`, `date`, `action`, `id_faktor`, `aspek`, `nama_faktor`, `target`, `jenis`) VALUES
(1, '2021-02-04', 'CREATE', 188, 83, 'Faktor1', 5, '1'),
(2, '2021-02-04', 'CREATE', 189, 83, 'Faktor', 2, '2'),
(3, '2021-02-04', 'CREATE', 190, 84, '1-2 juta', 3, '1'),
(4, '2021-02-04', 'CREATE', 191, 85, 'ram', 3, '1'),
(5, '2021-02-04', 'CREATE', 192, 85, 'rom', 4, '2'),
(6, '2021-02-04', 'CREATE', 193, 84, '3jt-5jt', 4, '2');

-- --------------------------------------------------------

--
-- Struktur dari tabel `log_hasil`
--

CREATE TABLE `log_hasil` (
  `id_log` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `action` varchar(10) NOT NULL,
  `id` int(11) NOT NULL,
  `nama_alternatif` varchar(50) NOT NULL,
  `nilai` float NOT NULL,
  `id_spkuser` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `log_hasil`
--

INSERT INTO `log_hasil` (`id_log`, `date`, `action`, `id`, `nama_alternatif`, `nilai`, `id_spkuser`) VALUES
(1, '2021-02-04 12:13:20', 'CREATE', 441, 'A1', 4.78571, 27),
(2, '2021-02-04 12:13:20', 'CREATE', 442, 'A2', 4.03571, 27);

-- --------------------------------------------------------

--
-- Struktur dari tabel `log_nilai`
--

CREATE TABLE `log_nilai` (
  `id_log` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `action` varchar(10) NOT NULL,
  `id_nilai` int(11) NOT NULL,
  `id_alternatif` int(11) NOT NULL,
  `faktor` tinyint(3) NOT NULL,
  `nilai` tinyint(3) NOT NULL,
  `id_spkuser` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `log_nilai`
--

INSERT INTO `log_nilai` (`id_log`, `date`, `action`, `id_nilai`, `id_alternatif`, `faktor`, `nilai`, `id_spkuser`) VALUES
(1, '2021-02-04 12:12:52', 'CREATE', 754334, 313, 127, 4, 27),
(2, '2021-02-04 12:12:53', 'CREATE', 754335, 313, 127, 5, 27),
(3, '2021-02-04 12:12:53', 'CREATE', 754336, 313, 127, 3, 27),
(4, '2021-02-04 12:12:53', 'CREATE', 754337, 313, 127, 4, 27),
(5, '2021-02-04 12:13:07', 'CREATE', 754338, 314, 127, 5, 27),
(6, '2021-02-04 12:13:07', 'CREATE', 754339, 314, 127, 3, 27),
(7, '2021-02-04 12:13:07', 'CREATE', 754340, 314, 127, 2, 27),
(8, '2021-02-04 12:13:07', 'CREATE', 754341, 314, 127, 5, 27);

-- --------------------------------------------------------

--
-- Struktur dari tabel `log_spk`
--

CREATE TABLE `log_spk` (
  `id_log` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `action` varchar(10) NOT NULL,
  `id_spk` int(11) NOT NULL,
  `nama_spk` text NOT NULL,
  `keterangan` text NOT NULL,
  `tanggal` date NOT NULL,
  `id_user` int(11) NOT NULL,
  `jenis` tinyint(1) NOT NULL,
  `status_verif` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `log_spk`
--

INSERT INTO `log_spk` (`id_log`, `date`, `action`, `id_spk`, `nama_spk`, `keterangan`, `tanggal`, `id_user`, `jenis`, `status_verif`) VALUES
(1, '2021-02-04 02:50:21', 'UPDATE', 50, 'SPK Private', 'SPK Private', '2021-02-02', 8, 1, 1),
(2, '2021-02-04 02:50:21', 'UPDATE NEW', 50, 'SPK Private 123', 'SPK Private', '2021-02-02', 8, 1, 1),
(3, '2021-02-04 11:53:12', 'CREATE', 51, 'SPK Baru Tambah', 'SPK Baru Tambah 1', '2021-02-04', 8, 0, 0),
(4, '2021-02-04 11:58:27', 'UPDATE', 51, 'SPK Baru Tambah', 'SPK Baru Tambah 1', '2021-02-04', 8, 0, 0),
(5, '2021-02-04 11:58:27', 'UPDATE NEW', 51, 'SPK Baru Tambah', 'SPK Baru Tambah 1', '2021-02-04', 8, 0, 1),
(6, '2021-02-04 11:59:26', 'UPDATE', 51, 'SPK Baru Tambah', 'SPK Baru Tambah 1', '2021-02-04', 8, 0, 1),
(7, '2021-02-04 11:59:26', 'UPDATE NEW', 51, 'SPK Baru Tambah', 'SPK Baru Tambah 1', '2021-02-04', 8, 0, 2),
(8, '2021-02-04 11:59:35', 'UPDATE', 51, 'SPK Baru Tambah', 'SPK Baru Tambah 1', '2021-02-04', 8, 0, 2),
(9, '2021-02-04 11:59:35', 'UPDATE NEW', 51, 'SPK Baru Tambah', 'SPK Baru Tambah 1', '2021-02-04', 8, 0, 1),
(10, '2021-02-04 12:01:55', 'CREATE', 52, 'Hp', 'buat saya', '2021-02-04', 35, 0, 0),
(11, '2021-02-04 13:35:35', 'UPDATE', 52, 'Hp', 'buat saya', '2021-02-04', 35, 0, 0),
(12, '2021-02-04 13:35:35', 'UPDATE NEW', 52, 'Hp', 'buat saya', '2021-02-04', 35, 0, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `log_spk_user`
--

CREATE TABLE `log_spk_user` (
  `id_log` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `action` varchar(10) NOT NULL,
  `id_spkuser` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_spk` int(11) NOT NULL,
  `ket` varchar(100) NOT NULL,
  `tgl` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `log_spk_user`
--

INSERT INTO `log_spk_user` (`id_log`, `date`, `action`, `id_spkuser`, `id_user`, `id_spk`, `ket`, `tgl`) VALUES
(1, '2021-02-04 12:00:16', 'CREATE', 26, 35, 51, 'Lasdamda', '2021-02-04'),
(2, '2021-02-04 12:12:28', 'CREATE', 27, 35, 52, 'Hp A', '2021-02-04'),
(3, '2021-02-04 12:19:19', 'CREATE', 1, 8, 13, 'JABATANNNNNN', '2021-01-29'),
(4, '2021-02-04 12:19:19', 'CREATE', 1, 8, 13, 'Jabatan Di PT. A', '2021-01-29'),
(5, '2021-02-04 14:23:47', 'CREATE', 28, 8, 13, '123', '2021-02-04');

-- --------------------------------------------------------

--
-- Struktur dari tabel `log_user`
--

CREATE TABLE `log_user` (
  `id_log` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `action` varchar(10) NOT NULL,
  `id_user` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `alamat` varchar(250) NOT NULL,
  `tlp` varchar(15) NOT NULL,
  `email` varchar(100) NOT NULL,
  `level` varchar(50) NOT NULL,
  `foto` varchar(100) NOT NULL,
  `aktif` char(1) NOT NULL,
  `verif_code` text NOT NULL,
  `is_verif` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `log_user`
--

INSERT INTO `log_user` (`id_log`, `date`, `action`, `id_user`, `username`, `password`, `nama`, `alamat`, `tlp`, `email`, `level`, `foto`, `aktif`, `verif_code`, `is_verif`) VALUES
(1, '2021-02-04 02:21:31', 'CREATE', 36, '123', '123', '132', '123', '123', '123', '123', '123', 'Y', '123', 0),
(3, '2021-02-04 02:27:00', 'UPDATE', 36, 'apeng123', '123', '132', '123', '123', '123', '123', '123', 'Y', '123', 0),
(4, '2021-02-04 02:27:00', 'UPDATE NEW', 36, 'apeng123', '123', 'apeng123', '123', '123', '123', '123', '123', 'Y', '123', 0),
(5, '2021-02-04 02:27:41', 'DELETE', 36, 'apeng123', '123', 'apeng123', '123', '123', '123', '123', '123', 'Y', '123', 0),
(6, '2021-02-04 02:41:28', 'UPDATE NEW', 35, 'member1', 'aa08769cdcb26674c6706093503ff0a3', 'apeng', 'cirebon', '08080808', 'suhardiman1@gmail.com', 'user', '', 'Y', '', 1),
(7, '2021-02-04 02:41:28', 'UPDATE', 35, 'member1', 'aa08769cdcb26674c6706093503ff0a3', 'member1', 'cirebon', '08080808', 'suhardiman1@gmail.com', 'user', '', 'Y', '', 1),
(8, '2021-02-04 02:42:38', 'UPDATE', 35, 'member1', 'aa08769cdcb26674c6706093503ff0a3', 'apeng', 'cirebon', '08080808', 'suhardiman1@gmail.com', 'user', '', 'Y', '', 1),
(9, '2021-02-04 02:42:38', 'UPDATE NEW', 35, 'member1', 'aa08769cdcb26674c6706093503ff0a3', 'apeng ganteng', 'cirebon', '08080808', 'suhardiman1@gmail.com', 'user', '', 'Y', '', 1),
(10, '2021-02-04 14:28:53', 'UPDATE', 8, 'member', 'aa08769cdcb26674c6706093503ff0a3', 'Member', 'Desa Keduanan Blok Kamas 1 rt 017 rw 008 Kec. Depok Kab. Cirebon', '083824021622', 'suhardiman65@gmail.com', 'user', '502378.jpg', 'Y', '', 1),
(11, '2021-02-04 14:28:53', 'UPDATE NEW', 8, 'member', 'aa08769cdcb26674c6706093503ff0a3', 'Member', 'Desa Keduanan Blok Kamas 1 rt 017 rw 008 Kec. Depok Kab. Cirebon', '083824021622', 'mirfanmanaf0804@gmail.com', 'user', '502378.jpg', 'Y', '', 1),
(12, '2021-02-04 14:29:56', 'UPDATE', 8, 'member', 'aa08769cdcb26674c6706093503ff0a3', 'Member', 'Desa Keduanan Blok Kamas 1 rt 017 rw 008 Kec. Depok Kab. Cirebon', '083824021622', 'mirfanmanaf0804@gmail.com', 'user', '502378.jpg', 'Y', '', 1),
(13, '2021-02-04 14:29:56', 'UPDATE NEW', 8, 'member', 'aa08769cdcb26674c6706093503ff0a3', 'Member', 'Desa Keduanan Blok Kamas 1 rt 017 rw 008 Kec. Depok Kab. Cirebon', '083824021622', 'mirfanmanaf0804@gmail.com', 'user', '502378.jpg', 'Y', 'b275fdf88e9e0a9dcd1714859bbde0e7', 1),
(14, '2021-02-04 14:30:58', 'UPDATE', 8, 'member', 'aa08769cdcb26674c6706093503ff0a3', 'Member', 'Desa Keduanan Blok Kamas 1 rt 017 rw 008 Kec. Depok Kab. Cirebon', '083824021622', 'mirfanmanaf0804@gmail.com', 'user', '502378.jpg', 'Y', 'b275fdf88e9e0a9dcd1714859bbde0e7', 1),
(15, '2021-02-04 14:30:58', 'UPDATE NEW', 8, 'member', 'aa08769cdcb26674c6706093503ff0a3', 'Member', 'Desa Keduanan Blok Kamas 1 rt 017 rw 008 Kec. Depok Kab. Cirebon', '083824021622', 'mirfanmanaf0804@gmail.com', 'user', '502378.jpg', 'Y', 'b275fdf88e9e0a9dcd1714859bbde0e7', 1),
(16, '2021-02-04 14:32:06', 'UPDATE', 8, 'member', 'aa08769cdcb26674c6706093503ff0a3', 'Member', 'Desa Keduanan Blok Kamas 1 rt 017 rw 008 Kec. Depok Kab. Cirebon', '083824021622', 'mirfanmanaf0804@gmail.com', 'user', '502378.jpg', 'Y', 'b275fdf88e9e0a9dcd1714859bbde0e7', 1),
(17, '2021-02-04 14:32:06', 'UPDATE NEW', 8, 'member', 'aa08769cdcb26674c6706093503ff0a3', 'Member', 'Desa Keduanan Blok Kamas 1 rt 017 rw 008 Kec. Depok Kab. Cirebon', '083824021622', 'suhardiman645@gmail.com', 'user', '502378.jpg', 'Y', 'b275fdf88e9e0a9dcd1714859bbde0e7', 1),
(18, '2021-02-04 14:32:36', 'UPDATE', 8, 'member', 'aa08769cdcb26674c6706093503ff0a3', 'Member', 'Desa Keduanan Blok Kamas 1 rt 017 rw 008 Kec. Depok Kab. Cirebon', '083824021622', 'suhardiman645@gmail.com', 'user', '502378.jpg', 'Y', 'b275fdf88e9e0a9dcd1714859bbde0e7', 1),
(19, '2021-02-04 14:32:36', 'UPDATE NEW', 8, 'member', 'aa08769cdcb26674c6706093503ff0a3', 'Member', 'Desa Keduanan Blok Kamas 1 rt 017 rw 008 Kec. Depok Kab. Cirebon', '083824021622', 'suhardiman645@gmail.com', 'user', '502378.jpg', 'Y', '4d51d62073b6243802eb27b6d1e7f61c', 1),
(20, '2021-02-04 14:34:21', 'UPDATE', 8, 'member', 'aa08769cdcb26674c6706093503ff0a3', 'Member', 'Desa Keduanan Blok Kamas 1 rt 017 rw 008 Kec. Depok Kab. Cirebon', '083824021622', 'suhardiman645@gmail.com', 'user', '502378.jpg', 'Y', '4d51d62073b6243802eb27b6d1e7f61c', 1),
(21, '2021-02-04 14:34:21', 'UPDATE NEW', 8, 'member', 'aa08769cdcb26674c6706093503ff0a3', 'Member', 'Desa Keduanan Blok Kamas 1 rt 017 rw 008 Kec. Depok Kab. Cirebon', '083824021622', 'suhardiman1@gmail.com', 'user', '502378.jpg', 'Y', '4d51d62073b6243802eb27b6d1e7f61c', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `nilai`
--

CREATE TABLE `nilai` (
  `id_nilai` int(11) UNSIGNED NOT NULL,
  `id_alternatif` int(11) UNSIGNED DEFAULT NULL,
  `faktor` tinyint(3) UNSIGNED DEFAULT NULL,
  `nilai` tinyint(3) UNSIGNED DEFAULT NULL,
  `id_spkuser` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `nilai`
--

INSERT INTO `nilai` (`id_nilai`, `id_alternatif`, `faktor`, `nilai`, `id_spkuser`) VALUES
(2049, 288, 79, 5, 1),
(2048, 288, 78, 5, 1),
(2047, 288, 77, 5, 1),
(2046, 288, 76, 5, 1),
(2045, 288, 75, 5, 1),
(2044, 288, 74, 5, 1),
(2043, 288, 73, 5, 1),
(2042, 288, 72, 5, 1),
(2041, 288, 71, 5, 1),
(2040, 288, 70, 5, 1),
(1959, 278, 79, 3, 1),
(1958, 278, 78, 5, 1),
(1957, 278, 77, 4, 1),
(1956, 278, 76, 2, 1),
(1955, 278, 75, 2, 1),
(1954, 278, 74, 3, 1),
(1953, 278, 73, 4, 1),
(1952, 278, 72, 3, 1),
(1951, 278, 71, 2, 1),
(1950, 278, 70, 3, 1),
(1949, 278, 69, 4, 1),
(1948, 278, 68, 1, 1),
(1947, 278, 67, 3, 1),
(1946, 278, 66, 3, 1),
(1945, 278, 65, 4, 1),
(1944, 278, 64, 3, 1),
(1943, 278, 63, 2, 1),
(1942, 278, 62, 3, 1),
(1941, 278, 61, 4, 1),
(1940, 278, 60, 5, 1),
(2039, 288, 69, 5, 1),
(2038, 288, 68, 5, 1),
(2037, 288, 67, 5, 1),
(2036, 288, 66, 5, 1),
(2035, 288, 65, 5, 1),
(2034, 288, 64, 5, 1),
(2033, 288, 63, 5, 1),
(2032, 288, 62, 5, 1),
(2031, 288, 61, 5, 1),
(2030, 288, 60, 5, 1),
(2029, 287, 79, 5, 1),
(2028, 287, 78, 5, 1),
(2027, 287, 77, 5, 1),
(2026, 287, 76, 5, 1),
(2025, 287, 75, 5, 1),
(2024, 287, 74, 5, 1),
(2023, 287, 73, 5, 1),
(2022, 287, 72, 5, 1),
(2021, 287, 71, 5, 1),
(2020, 287, 70, 5, 1),
(2019, 287, 69, 5, 1),
(2018, 287, 68, 5, 1),
(2017, 287, 67, 5, 1),
(2016, 287, 66, 5, 1),
(2015, 287, 65, 5, 1),
(2014, 287, 64, 5, 1),
(2013, 287, 63, 5, 1),
(2012, 287, 62, 5, 1),
(2011, 287, 61, 5, 1),
(2010, 287, 60, 5, 1),
(2129, 307, 183, 4, 24),
(754323, 312, 179, 1, 25),
(754240, 310, 180, 5, 25),
(754301, 311, 179, 3, 25),
(2128, 307, 182, 3, 24),
(754322, 312, 178, 4, 25),
(1839, 272, 79, 1, 1),
(1838, 272, 78, 1, 1),
(1837, 272, 77, 1, 1),
(1836, 272, 76, 1, 1),
(1835, 272, 75, 1, 1),
(1834, 272, 74, 1, 1),
(1833, 272, 73, 1, 1),
(1832, 272, 72, 1, 1),
(1831, 272, 71, 1, 1),
(1830, 272, 70, 1, 1),
(1829, 272, 69, 1, 1),
(1828, 272, 68, 1, 1),
(1827, 272, 67, 1, 1),
(1826, 272, 66, 1, 1),
(1825, 272, 65, 1, 1),
(1824, 272, 64, 1, 1),
(1823, 272, 63, 1, 1),
(1822, 272, 62, 1, 1),
(1821, 272, 61, 1, 1),
(1820, 272, 60, 1, 1),
(754300, 311, 178, 4, 25),
(2115, 304, 177, 1, 23),
(2114, 304, 176, 5, 23),
(754303, 311, 181, 3, 25),
(754239, 310, 179, 3, 25),
(754238, 310, 178, 4, 25),
(2113, 303, 177, 5, 23),
(2112, 303, 176, 4, 23),
(754302, 311, 180, 4, 25),
(754241, 310, 181, 3, 25),
(1819, 271, 79, 3, 1),
(1818, 271, 78, 1, 1),
(1817, 271, 77, 1, 1),
(1816, 271, 76, 1, 1),
(1815, 271, 75, 1, 1),
(1814, 271, 74, 1, 1),
(1813, 271, 73, 1, 1),
(1812, 271, 72, 1, 1),
(1811, 271, 71, 1, 1),
(1810, 271, 70, 1, 1),
(1809, 271, 69, 1, 1),
(1808, 271, 68, 1, 1),
(1807, 271, 67, 1, 1),
(1806, 271, 66, 1, 1),
(1805, 271, 65, 1, 1),
(1804, 271, 64, 1, 1),
(1803, 271, 63, 1, 1),
(1802, 271, 62, 1, 1),
(1801, 271, 61, 1, 1),
(1800, 271, 60, 1, 1),
(2080, 290, 60, 5, 1),
(2081, 290, 61, 4, 1),
(2082, 290, 62, 3, 1),
(2083, 290, 63, 4, 1),
(2084, 290, 64, 4, 1),
(2085, 290, 65, 5, 1),
(2086, 290, 66, 5, 1),
(2087, 290, 67, 5, 1),
(2088, 290, 68, 3, 1),
(2089, 290, 69, 4, 1),
(2090, 290, 70, 5, 1),
(2091, 290, 71, 2, 1),
(2092, 290, 72, 2, 1),
(2093, 290, 73, 2, 1),
(2094, 290, 74, 3, 1),
(2095, 290, 75, 3, 1),
(2096, 290, 76, 3, 1),
(2097, 290, 77, 2, 1),
(2098, 290, 78, 2, 1),
(2099, 290, 79, 3, 1),
(754341, 314, 192, 5, 27),
(754340, 314, 191, 2, 27),
(754339, 314, 193, 3, 27),
(754338, 314, 190, 5, 27),
(754337, 313, 192, 4, 27),
(754336, 313, 191, 3, 27),
(754335, 313, 193, 5, 27),
(754334, 313, 190, 4, 27),
(754333, 306, 181, 3, 24),
(754332, 306, 180, 3, 24),
(754331, 306, 179, 2, 24),
(754330, 306, 178, 3, 24),
(754329, 305, 181, 5, 24),
(754328, 305, 180, 3, 24),
(754327, 305, 179, 4, 24),
(754326, 305, 178, 5, 24),
(754325, 312, 181, 2, 25),
(754324, 312, 180, 5, 25);

--
-- Trigger `nilai`
--
DELIMITER $$
CREATE TRIGGER `create_nilai` AFTER INSERT ON `nilai` FOR EACH ROW BEGIN

INSERT INTO `log_nilai` (action, id_nilai, `id_alternatif`, `faktor`, `nilai`, `id_spkuser`) VALUES
('CREATE', new.id_nilai, new.id_alternatif, new.faktor, new.nilai, new.id_spkuser);

END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `delete_nilai` AFTER DELETE ON `nilai` FOR EACH ROW BEGIN

INSERT INTO `log_nilai` (action, id_nilai, `id_alternatif`, `faktor`, `nilai`, `id_spkuser`) VALUES
('DELETE', old.id_nilai, old.id_alternatif, old.faktor, old.nilai, old.id_spkuser);

END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_nilai_after` BEFORE UPDATE ON `nilai` FOR EACH ROW BEGIN

INSERT INTO `log_nilai` (action, id_nilai, `id_alternatif`, `faktor`, `nilai`, `id_spkuser`) VALUES
('UPDATE NEW', new.id_nilai, new.id_alternatif, new.faktor, new.nilai, new.id_spkuser);

END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_nilai_before` BEFORE UPDATE ON `nilai` FOR EACH ROW BEGIN

INSERT INTO `log_nilai` (action, id_nilai, `id_alternatif`, `faktor`, `nilai`, `id_spkuser`) VALUES
('UPDATE', old.id_nilai, old.id_alternatif, old.faktor, old.nilai, old.id_spkuser);

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `spk`
--

CREATE TABLE `spk` (
  `id_spk` int(6) NOT NULL,
  `nama_spk` text NOT NULL,
  `keterangan` text NOT NULL,
  `tanggal` date NOT NULL,
  `id_user` int(11) NOT NULL,
  `jenis` tinyint(1) NOT NULL,
  `status_verif` int(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `spk`
--

INSERT INTO `spk` (`id_spk`, `nama_spk`, `keterangan`, `tanggal`, `id_user`, `jenis`, `status_verif`) VALUES
(13, 'Promosi Jabatan', 'Implementasi metode Profile Matching untuk promosi jabatan berdasarkan evaluasi kinerja karyawan', '2020-12-04', 1, 0, 1),
(49, 'SPK Buatan Member', 'SPK Buatan Member', '2021-02-02', 8, 0, 1),
(50, 'SPK Private 123', 'SPK Private', '2021-02-02', 8, 1, 1),
(51, 'SPK Baru Tambah', 'SPK Baru Tambah 1', '2021-02-04', 8, 0, 1),
(52, 'Hp', 'buat saya', '2021-02-04', 35, 0, 1);

--
-- Trigger `spk`
--
DELIMITER $$
CREATE TRIGGER `create_spk` AFTER INSERT ON `spk` FOR EACH ROW BEGIN

INSERT INTO `log_spk` (action, id_spk, `nama_spk`, `keterangan`, `tanggal`, `id_user`, `jenis`, `status_verif`) VALUES
('CREATE', new.id_spk, new.nama_spk, new.keterangan, new.tanggal, new.id_user, new.jenis, new.status_verif);

END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `delete_spk` AFTER DELETE ON `spk` FOR EACH ROW BEGIN

INSERT INTO `log_spk` (action, id_spk, `nama_spk`, `keterangan`, `tanggal`, `id_user`, `jenis`, `status_verif`) VALUES
('DELETE', old.id_spk, old.nama_spk, old.keterangan, old.tanggal, old.id_user, old.jenis, old.status_verif);

END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_spk_after` BEFORE UPDATE ON `spk` FOR EACH ROW BEGIN

INSERT INTO `log_spk` (action, id_spk, `nama_spk`, `keterangan`, `tanggal`, `id_user`, `jenis`, `status_verif`) VALUES
('UPDATE NEW', new.id_spk, new.nama_spk, new.keterangan, new.tanggal, new.id_user, new.jenis, new.status_verif);

END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_spk_before` BEFORE UPDATE ON `spk` FOR EACH ROW BEGIN

INSERT INTO `log_spk` (action, id_spk, `nama_spk`, `keterangan`, `tanggal`, `id_user`, `jenis`, `status_verif`) VALUES
('UPDATE', old.id_spk, old.nama_spk, old.keterangan, old.tanggal, old.id_user, old.jenis, old.status_verif);

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `spk_user`
--

CREATE TABLE `spk_user` (
  `id_spkuser` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_spk` int(11) NOT NULL,
  `ket` varchar(100) NOT NULL,
  `tgl` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `spk_user`
--

INSERT INTO `spk_user` (`id_spkuser`, `id_user`, `id_spk`, `ket`, `tgl`) VALUES
(1, 8, 13, 'JABATANNNNNN', '2021-01-29'),
(23, 35, 49, 'SPK Buatan Member 123', '2021-02-03'),
(24, 8, 50, 'SPK Private Coba', '2021-02-03'),
(25, 8, 50, 'SPK Private 2', '2021-02-03'),
(26, 35, 51, 'Lasdamda', '2021-02-04'),
(27, 35, 52, 'Hp A', '2021-02-04'),
(28, 8, 13, '123', '2021-02-04');

--
-- Trigger `spk_user`
--
DELIMITER $$
CREATE TRIGGER `create_spk_user` AFTER INSERT ON `spk_user` FOR EACH ROW BEGIN

INSERT INTO `log_spk_user` (action, id_spkuser, `id_user`, `id_spk`, `ket`, `tgl`) VALUES
('CREATE', new.id_spkuser, new.id_user, new.id_spk, new.ket, new.tgl);

END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `delete_spk_user` AFTER DELETE ON `spk_user` FOR EACH ROW BEGIN

INSERT INTO `log_spk_user` (action, id_spkuser, `id_user`, `id_spk`, `ket`, `tgl`) VALUES
('CREATE', old.id_spkuser, old.id_user, old.id_spk, old.ket, old.tgl);

END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_spk_user_after` BEFORE UPDATE ON `spk_user` FOR EACH ROW BEGIN

INSERT INTO `log_spk_user` (action, id_spkuser, `id_user`, `id_spk`, `ket`, `tgl`) VALUES
('CREATE', new.id_spkuser, new.id_user, new.id_spk, new.ket, new.tgl);

END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_spk_user_before` BEFORE UPDATE ON `spk_user` FOR EACH ROW BEGIN

INSERT INTO `log_spk_user` (action, id_spkuser, `id_user`, `id_spk`, `ket`, `tgl`) VALUES
('CREATE', old.id_spkuser, old.id_user, old.id_spk, old.ket, old.tgl);

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
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
  `aktif` char(1) COLLATE latin1_general_ci NOT NULL,
  `verif_code` text COLLATE latin1_general_ci NOT NULL,
  `is_verif` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `nama`, `alamat`, `tlp`, `email`, `level`, `foto`, `aktif`, `verif_code`, `is_verif`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Administrator', 'Desa Keduanan Blok Kamas 1 rt 017 rw 008 Kec. Depok Kab. Cirebon 123', '083824021622', 'suhardiman64@gmail.com', 'admin', 'IMG-20200830-WA0008.jpg', 'Y', 'b275fdf88e9e0a9dcd1714859bbde0e7', 1),
(8, 'member', 'aa08769cdcb26674c6706093503ff0a3', 'Member', 'Desa Keduanan Blok Kamas 1 rt 017 rw 008 Kec. Depok Kab. Cirebon', '083824021622', 'suhardiman1@gmail.com', 'user', '502378.jpg', 'Y', '4d51d62073b6243802eb27b6d1e7f61c', 1),
(35, 'member1', 'aa08769cdcb26674c6706093503ff0a3', 'apeng ganteng', 'cirebon', '08080808', 'suhardiman1@gmail.com', 'user', '', 'Y', '', 1);

--
-- Trigger `user`
--
DELIMITER $$
CREATE TRIGGER `create_user` AFTER INSERT ON `user` FOR EACH ROW BEGIN

INSERT INTO `log_user` (action, id_user, `username`, `password`, `nama`, `alamat`, `tlp`, `email`, `level`, `foto`, `aktif`, `verif_code`, `is_verif`) VALUES
('CREATE', new.id_user, new.username, new.password, new.nama, new.alamat, new.tlp, new.email, new.level, new.foto, new.aktif, new.verif_code, new.is_verif);

END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `delete_user` AFTER DELETE ON `user` FOR EACH ROW BEGIN

INSERT INTO `log_user` (action, id_user, `username`, `password`, `nama`, `alamat`, `tlp`, `email`, `level`, `foto`, `aktif`, `verif_code`, `is_verif`) VALUES
('DELETE', old.id_user, old.username, old.password, old.nama, old.alamat, old.tlp, old.email, old.level, old.foto, old.aktif, old.verif_code, old.is_verif);

END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_user_after` AFTER UPDATE ON `user` FOR EACH ROW BEGIN

INSERT INTO `log_user` (action, id_user, `username`, `password`, `nama`, `alamat`, `tlp`, `email`, `level`, `foto`, `aktif`, `verif_code`, `is_verif`) VALUES
('UPDATE NEW', new.id_user, new.username, new.password, new.nama, new.alamat, new.tlp, new.email, new.level, new.foto, new.aktif, new.verif_code, new.is_verif);

END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_user_before` BEFORE UPDATE ON `user` FOR EACH ROW BEGIN

INSERT INTO `log_user` (action, id_user, `username`, `password`, `nama`, `alamat`, `tlp`, `email`, `level`, `foto`, `aktif`, `verif_code`, `is_verif`) VALUES
('UPDATE', old.id_user, old.username, old.password, old.nama, old.alamat, old.tlp, old.email, old.level, old.foto, old.aktif, old.verif_code, old.is_verif);

END
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `alternatif`
--
ALTER TABLE `alternatif`
  ADD PRIMARY KEY (`id_alternatif`);

--
-- Indeks untuk tabel `aspek`
--
ALTER TABLE `aspek`
  ADD PRIMARY KEY (`id_aspek`);

--
-- Indeks untuk tabel `bobot`
--
ALTER TABLE `bobot`
  ADD PRIMARY KEY (`id_bobot`);

--
-- Indeks untuk tabel `faktor`
--
ALTER TABLE `faktor`
  ADD PRIMARY KEY (`id_faktor`);

--
-- Indeks untuk tabel `hasil`
--
ALTER TABLE `hasil`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `log_alternatif`
--
ALTER TABLE `log_alternatif`
  ADD PRIMARY KEY (`id_log`);

--
-- Indeks untuk tabel `log_aspek`
--
ALTER TABLE `log_aspek`
  ADD PRIMARY KEY (`id_log`);

--
-- Indeks untuk tabel `log_bobot`
--
ALTER TABLE `log_bobot`
  ADD PRIMARY KEY (`id_log`);

--
-- Indeks untuk tabel `log_faktor`
--
ALTER TABLE `log_faktor`
  ADD PRIMARY KEY (`id_log`);

--
-- Indeks untuk tabel `log_hasil`
--
ALTER TABLE `log_hasil`
  ADD PRIMARY KEY (`id_log`);

--
-- Indeks untuk tabel `log_nilai`
--
ALTER TABLE `log_nilai`
  ADD PRIMARY KEY (`id_log`);

--
-- Indeks untuk tabel `log_spk`
--
ALTER TABLE `log_spk`
  ADD PRIMARY KEY (`id_log`);

--
-- Indeks untuk tabel `log_spk_user`
--
ALTER TABLE `log_spk_user`
  ADD PRIMARY KEY (`id_log`);

--
-- Indeks untuk tabel `log_user`
--
ALTER TABLE `log_user`
  ADD PRIMARY KEY (`id_log`);

--
-- Indeks untuk tabel `nilai`
--
ALTER TABLE `nilai`
  ADD PRIMARY KEY (`id_nilai`);

--
-- Indeks untuk tabel `spk`
--
ALTER TABLE `spk`
  ADD PRIMARY KEY (`id_spk`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `spk_user`
--
ALTER TABLE `spk_user`
  ADD PRIMARY KEY (`id_spkuser`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `username` (`username`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `alternatif`
--
ALTER TABLE `alternatif`
  MODIFY `id_alternatif` int(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=315;

--
-- AUTO_INCREMENT untuk tabel `aspek`
--
ALTER TABLE `aspek`
  MODIFY `id_aspek` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT untuk tabel `bobot`
--
ALTER TABLE `bobot`
  MODIFY `id_bobot` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=168;

--
-- AUTO_INCREMENT untuk tabel `faktor`
--
ALTER TABLE `faktor`
  MODIFY `id_faktor` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=194;

--
-- AUTO_INCREMENT untuk tabel `hasil`
--
ALTER TABLE `hasil`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=443;

--
-- AUTO_INCREMENT untuk tabel `log_alternatif`
--
ALTER TABLE `log_alternatif`
  MODIFY `id_log` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `log_aspek`
--
ALTER TABLE `log_aspek`
  MODIFY `id_log` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `log_bobot`
--
ALTER TABLE `log_bobot`
  MODIFY `id_log` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT untuk tabel `log_faktor`
--
ALTER TABLE `log_faktor`
  MODIFY `id_log` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `log_hasil`
--
ALTER TABLE `log_hasil`
  MODIFY `id_log` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `log_nilai`
--
ALTER TABLE `log_nilai`
  MODIFY `id_log` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `log_spk`
--
ALTER TABLE `log_spk`
  MODIFY `id_log` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `log_spk_user`
--
ALTER TABLE `log_spk_user`
  MODIFY `id_log` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `log_user`
--
ALTER TABLE `log_user`
  MODIFY `id_log` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT untuk tabel `nilai`
--
ALTER TABLE `nilai`
  MODIFY `id_nilai` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=754342;

--
-- AUTO_INCREMENT untuk tabel `spk`
--
ALTER TABLE `spk`
  MODIFY `id_spk` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT untuk tabel `spk_user`
--
ALTER TABLE `spk_user`
  MODIFY `id_spkuser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
