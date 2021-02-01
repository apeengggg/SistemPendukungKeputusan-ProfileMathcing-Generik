-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 01 Feb 2021 pada 06.27
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
-- Struktur dari tabel `admin`
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
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id_user`, `username`, `password`, `nama`, `level`, `foto`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Administrator', 'Administrator', 'IMG_20190924_082057.jpg'),
(2, 'user', '21232f297a57a5a743894a0e4a801fc3', 'User', 'User', 'images (4).png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `alternatif`
--

CREATE TABLE `alternatif` (
  `id_alternatif` int(3) UNSIGNED NOT NULL,
  `nama_alternatif` varchar(100) NOT NULL,
  `id_spk` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_spkuser` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `alternatif`
--

INSERT INTO `alternatif` (`id_alternatif`, `nama_alternatif`, `id_spk`, `id_user`, `id_spkuser`) VALUES
(289, 'Apeng1234', NULL, NULL, 17),
(284, 'Alt1', NULL, NULL, 17),
(272, 'Si Apenk', NULL, NULL, 1),
(271, 'Si Irfan', NULL, NULL, 1),
(278, 'Si Ganteng', NULL, NULL, 1),
(285, 'Alt2', NULL, NULL, 17),
(287, 'Si Apenggggg', NULL, NULL, 1),
(288, 'Si Awip', NULL, NULL, 1);

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
  `id_spk` int(11) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `aspek`
--

INSERT INTO `aspek` (`id_aspek`, `nama_aspek`, `bobot`, `bobot_core`, `bobot_secondary`, `nama_singkat`, `id_spk`, `id_user`) VALUES
(20, 'Kecerdasan', 30, 70, 30, 'K', 13, 12),
(21, 'Sikap Kerja', 30, 70, 30, 'SK', 13, 12),
(22, 'Perilaku', 40, 70, 30, 'P', 13, 12),
(65, 'Aspek1', 30, 30, 70, 'PY', 36, 1),
(66, 'Aspek 2', 30, 70, 30, 'YT', 36, 1),
(67, 'Aspek 3', 20, 70, 30, 'RV', 36, 1),
(68, 'Aspek 4', 20, 70, 30, 'BV', 36, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `bobot`
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
-- Dumping data untuk tabel `bobot`
--

INSERT INTO `bobot` (`id_bobot`, `selisih`, `bobot`, `keterangan`, `id_spk`, `id_user`) VALUES
(100, 3, 2.5, 'Kompetensi individu kelebihan 3 tingkat/level', 36, 1),
(101, 2, 3.5, 'Kompetensi individu kelebihan 2 tingkat/level', 36, 1),
(102, 1, 4.5, 'Kompetensi individu kelebihan 1 tingkat/level', 36, 1),
(54, 0, 5, 'Tidak ada selisih  ( kompetensi sesuai yang dibutuhkan )', 13, 12),
(55, 1, 4.5, 'Kompetensi individu kelebihan 1 tingkat/level', 13, 12),
(56, -1, 4, 'Kompetensi individu kekurangan 1 tingkat/level', 13, 12),
(57, 2, 3.5, 'Kompetensi individu kelebihan 2 tingkat/level', 13, 12),
(58, -2, 3, 'Kompetensi individu kekurangan 2 tingkat/level', 13, 12),
(59, 3, 2.5, 'Kompetensi individu kelebihan 3 tingkat/level', 13, 12),
(60, -3, 2, 'Kompetensi individu kekurangan 3 tingkat/level', 13, 12),
(61, 4, 1.5, 'Kompetensi individu kelebihan 4 tingkat/level', 13, 12),
(62, -4, 1, 'Kompetensi individu kekurangan 4 tingkat/level', 13, 12),
(99, 4, 1.5, 'Kompetensi individu kelebihan 4 tingkat/level', 36, 1),
(98, 0, 5, 'Tidak ada selisih  ( kompetensi sesuai yang dibutuhkan...', 36, 1),
(97, -1, 4, 'Kompetensi individu kekurangan 1 tingkat/level', 36, 1),
(96, -2, 3, 'Kompetensi individu kekurangan 2 tingkat/level', 36, 1),
(95, -3, 2, 'Kompetensi individu kekurangan 3 tingkat/level', 36, 1),
(94, -4, 1, 'Kompetensi individu kekurangan 4 tingkat/level', 36, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `faktor`
--

CREATE TABLE `faktor` (
  `id_faktor` tinyint(3) UNSIGNED NOT NULL,
  `aspek` tinyint(3) UNSIGNED NOT NULL COMMENT 'FK tbl_aspek',
  `nama_faktor` varchar(50) NOT NULL,
  `target` tinyint(3) NOT NULL,
  `jenis` enum('1','2') DEFAULT NULL COMMENT '1=Core;2=Secondary',
  `id_spk` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_spkuser` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `faktor`
--

INSERT INTO `faktor` (`id_faktor`, `aspek`, `nama_faktor`, `target`, `jenis`, `id_spk`, `id_user`, `id_spkuser`) VALUES
(60, 20, 'common sense', 3, '2', 13, 12, 1),
(61, 20, 'verbalisasi ide', 3, '2', 13, 12, 1),
(62, 20, 'sistematika berpikir', 4, '1', 13, 12, 1),
(63, 20, 'penalaran dan solusi real', 4, '1', 13, 12, 1),
(64, 20, 'konsentrasi', 3, '2', 13, 12, 1),
(65, 20, 'logika praktis', 4, '1', 13, 12, 1),
(66, 20, 'fleksibiltas berpikir', 4, '1', 13, 12, 1),
(67, 20, 'imajinasi kreatif', 5, '1', 13, 12, 1),
(68, 20, 'antisipasi', 3, '2', 13, 12, 1),
(69, 20, 'potensi kecerdasan', 4, '1', 13, 12, 1),
(70, 21, 'energi psikis', 3, '2', 13, 12, 1),
(71, 21, 'ketelitian dan tanggung jawab', 4, '1', 13, 12, 1),
(72, 21, 'kehati-hatian', 2, '2', 13, 12, 1),
(73, 21, 'pengendalian perasaan', 3, '2', 13, 12, 1),
(74, 21, 'dorongan berprestasi', 3, '2', 13, 12, 1),
(75, 21, 'vitalitas dan perencanaan', 5, '1', 13, 12, 1),
(76, 22, 'kekuasaan', 3, '2', 13, 12, 1),
(77, 22, 'pengaruh', 3, '2', 13, 12, 1),
(78, 22, 'keteguhan hati', 4, '1', 13, 12, 1),
(79, 22, 'pemenuhan', 5, '1', 13, 12, 1),
(158, 65, 'Faktor 1', 5, '1', 36, 1, 0),
(148, 66, 'Faktor Aspek 2 A', 5, '1', 36, 1, 0),
(149, 67, 'Faktor ABC', 5, '1', 36, 1, 0),
(150, 68, 'faktor 134', 5, '1', 36, 1, 0),
(159, 65, 'Faktor 2', 4, '2', 36, 1, 0),
(152, 66, 'fhjgh', 3, '2', 36, 1, 0),
(153, 67, 'gjhjhj', 2, '2', 36, 1, 0),
(154, 68, 'hugyu', 1, '2', 36, 1, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `hasil`
--

CREATE TABLE `hasil` (
  `id` int(11) NOT NULL,
  `nama_alternatif` varchar(50) NOT NULL,
  `nilai` float NOT NULL,
  `id_spk` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_spkuser` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `hasil`
--

INSERT INTO `hasil` (`id`, `nama_alternatif`, `nilai`, `id_spk`, `id_user`, `id_spkuser`) VALUES
(342, 'Si Apenk', 2.0425, 13, 8, 1),
(341, 'Si Irfan', 2.3225, 13, 8, 1),
(337, 'Alt2', 3.225, 36, 8, 17),
(340, 'Si Ganteng', 3.6075, 13, 8, 1),
(339, 'Si Awip', 4.3175, 13, 8, 1),
(338, 'Si Apenggggg', 4.3175, 13, 8, 1),
(336, 'Alt1', 3.895, 36, 8, 17);

-- --------------------------------------------------------

--
-- Struktur dari tabel `nilai`
--

CREATE TABLE `nilai` (
  `id_nilai` int(11) UNSIGNED NOT NULL,
  `id_alternatif` int(11) UNSIGNED DEFAULT NULL,
  `faktor` tinyint(3) UNSIGNED DEFAULT NULL,
  `nilai` tinyint(3) UNSIGNED DEFAULT NULL,
  `id_spk` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_spkuser` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `nilai`
--

INSERT INTO `nilai` (`id_nilai`, `id_alternatif`, `faktor`, `nilai`, `id_spk`, `id_user`, `id_spkuser`) VALUES
(2049, 288, 79, 5, NULL, NULL, 1),
(2048, 288, 78, 5, NULL, NULL, 1),
(2047, 288, 77, 5, NULL, NULL, 1),
(2046, 288, 76, 5, NULL, NULL, 1),
(2045, 288, 75, 5, NULL, NULL, 1),
(2044, 288, 74, 5, NULL, NULL, 1),
(2043, 288, 73, 5, NULL, NULL, 1),
(2042, 288, 72, 5, NULL, NULL, 1),
(2041, 288, 71, 5, NULL, NULL, 1),
(2040, 288, 70, 5, NULL, NULL, 1),
(1959, 278, 79, 3, NULL, NULL, 1),
(1958, 278, 78, 5, NULL, NULL, 1),
(1957, 278, 77, 4, NULL, NULL, 1),
(1956, 278, 76, 2, NULL, NULL, 1),
(1955, 278, 75, 2, NULL, NULL, 1),
(1954, 278, 74, 3, NULL, NULL, 1),
(1953, 278, 73, 4, NULL, NULL, 1),
(1952, 278, 72, 3, NULL, NULL, 1),
(1951, 278, 71, 2, NULL, NULL, 1),
(1950, 278, 70, 3, NULL, NULL, 1),
(1949, 278, 69, 4, NULL, NULL, 1),
(1948, 278, 68, 1, NULL, NULL, 1),
(1947, 278, 67, 23, NULL, NULL, 1),
(1946, 278, 66, 3, NULL, NULL, 1),
(1945, 278, 65, 4, NULL, NULL, 1),
(1944, 278, 64, 3, NULL, NULL, 1),
(1943, 278, 63, 2, NULL, NULL, 1),
(1942, 278, 62, 3, NULL, NULL, 1),
(1941, 278, 61, 4, NULL, NULL, 1),
(1940, 278, 60, 5, NULL, NULL, 1),
(2039, 288, 69, 5, NULL, NULL, 1),
(2038, 288, 68, 5, NULL, NULL, 1),
(2037, 288, 67, 5, NULL, NULL, 1),
(2036, 288, 66, 5, NULL, NULL, 1),
(2035, 288, 65, 5, NULL, NULL, 1),
(2034, 288, 64, 5, NULL, NULL, 1),
(2033, 288, 63, 5, NULL, NULL, 1),
(2032, 288, 62, 5, NULL, NULL, 1),
(2031, 288, 61, 5, NULL, NULL, 1),
(2030, 288, 60, 5, NULL, NULL, 1),
(2029, 287, 79, 5, NULL, NULL, 1),
(2028, 287, 78, 5, NULL, NULL, 1),
(2027, 287, 77, 5, NULL, NULL, 1),
(2026, 287, 76, 5, NULL, NULL, 1),
(2025, 287, 75, 5, NULL, NULL, 1),
(2024, 287, 74, 5, NULL, NULL, 1),
(2023, 287, 73, 5, NULL, NULL, 1),
(2022, 287, 72, 5, NULL, NULL, 1),
(2021, 287, 71, 5, NULL, NULL, 1),
(2020, 287, 70, 5, NULL, NULL, 1),
(2019, 287, 69, 5, NULL, NULL, 1),
(2018, 287, 68, 5, NULL, NULL, 1),
(2017, 287, 67, 5, NULL, NULL, 1),
(2016, 287, 66, 5, NULL, NULL, 1),
(2015, 287, 65, 5, NULL, NULL, 1),
(2014, 287, 64, 5, NULL, NULL, 1),
(2013, 287, 63, 5, NULL, NULL, 1),
(2012, 287, 62, 5, NULL, NULL, 1),
(2011, 287, 61, 5, NULL, NULL, 1),
(2010, 287, 60, 5, NULL, NULL, 1),
(2009, 285, 154, 2, NULL, NULL, 17),
(2008, 285, 150, 2, NULL, NULL, 17),
(2007, 285, 153, 5, NULL, NULL, 17),
(2006, 285, 149, 4, NULL, NULL, 17),
(2005, 285, 152, 2, NULL, NULL, 17),
(2004, 285, 148, 3, NULL, NULL, 17),
(2003, 285, 151, 4, NULL, NULL, 17),
(2002, 285, 147, 5, NULL, NULL, 17),
(2001, 284, 154, 2, NULL, NULL, 17),
(2000, 284, 150, 5, NULL, NULL, 17),
(1999, 284, 153, 4, NULL, NULL, 17),
(1998, 284, 149, 3, NULL, NULL, 17),
(1997, 284, 152, 1, NULL, NULL, 17),
(1996, 284, 148, 4, NULL, NULL, 17),
(1995, 284, 151, 3, NULL, NULL, 17),
(1994, 284, 147, 5, NULL, NULL, 17),
(1839, 272, 79, 1, NULL, NULL, 1),
(1838, 272, 78, 1, NULL, NULL, 1),
(1837, 272, 77, 1, NULL, NULL, 1),
(1836, 272, 76, 1, NULL, NULL, 1),
(1835, 272, 75, 1, NULL, NULL, 1),
(1834, 272, 74, 1, NULL, NULL, 1),
(1833, 272, 73, 1, NULL, NULL, 1),
(1832, 272, 72, 1, NULL, NULL, 1),
(1831, 272, 71, 1, NULL, NULL, 1),
(1830, 272, 70, 1, NULL, NULL, 1),
(1829, 272, 69, 1, NULL, NULL, 1),
(1828, 272, 68, 1, NULL, NULL, 1),
(1827, 272, 67, 1, NULL, NULL, 1),
(1826, 272, 66, 1, NULL, NULL, 1),
(1825, 272, 65, 1, NULL, NULL, 1),
(1824, 272, 64, 1, NULL, NULL, 1),
(1823, 272, 63, 1, NULL, NULL, 1),
(1822, 272, 62, 1, NULL, NULL, 1),
(1821, 272, 61, 1, NULL, NULL, 1),
(1820, 272, 60, 1, NULL, NULL, 1),
(2057, 289, 154, 3, NULL, NULL, 17),
(2056, 289, 150, 5, NULL, NULL, 17),
(2055, 289, 153, 2, NULL, NULL, 17),
(2054, 289, 149, 4, NULL, NULL, 17),
(2053, 289, 152, 5, NULL, NULL, 17),
(2052, 289, 148, 4, NULL, NULL, 17),
(2051, 289, 159, 3, NULL, NULL, 17),
(2050, 289, 158, 5, NULL, NULL, 17),
(1819, 271, 79, 3, NULL, NULL, 1),
(1818, 271, 78, 1, NULL, NULL, 1),
(1817, 271, 77, 1, NULL, NULL, 1),
(1816, 271, 76, 1, NULL, NULL, 1),
(1815, 271, 75, 1, NULL, NULL, 1),
(1814, 271, 74, 1, NULL, NULL, 1),
(1813, 271, 73, 1, NULL, NULL, 1),
(1812, 271, 72, 1, NULL, NULL, 1),
(1811, 271, 71, 1, NULL, NULL, 1),
(1810, 271, 70, 1, NULL, NULL, 1),
(1809, 271, 69, 1, NULL, NULL, 1),
(1808, 271, 68, 1, NULL, NULL, 1),
(1807, 271, 67, 1, NULL, NULL, 1),
(1806, 271, 66, 1, NULL, NULL, 1),
(1805, 271, 65, 1, NULL, NULL, 1),
(1804, 271, 64, 1, NULL, NULL, 1),
(1803, 271, 63, 1, NULL, NULL, 1),
(1802, 271, 62, 1, NULL, NULL, 1),
(1801, 271, 61, 1, NULL, NULL, 1),
(1800, 271, 60, 1, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `spk`
--

CREATE TABLE `spk` (
  `id_spk` int(6) NOT NULL,
  `nama_spk` text NOT NULL,
  `keterangan` text NOT NULL,
  `tanggal` date NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `spk`
--

INSERT INTO `spk` (`id_spk`, `nama_spk`, `keterangan`, `tanggal`, `id_user`) VALUES
(13, 'Promosi Jabatan', 'Implementasi metode Profile Matching untuk promosi jabatan berdasarkan evaluasi kinerja karyawan', '2020-12-04', 12),
(36, 'Milih Laptop 123', 'ABC', '2021-01-31', 1),
(38, 'Beasiswa', 'SPK Profile Matching Untuk Beasiswa', '2021-02-01', 1);

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
(1, 8, 13, 'Jabatan Di PT. A', '2021-01-29'),
(13, 8, 34, '123', '2021-01-31'),
(16, 8, 13, 'PT. ABC', '2021-01-31'),
(17, 8, 36, 'Untuk Pemilihan Teman Saya', '2021-01-31');

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
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Administrator', 'Desa Keduanan Blok Kamas 1 rt 017 rw 008 Kec. Depok Kab. Cirebon', '083824021622', 'suhardiman65@gmail.com', 'admin', 'IMG-20200830-WA0008.jpg', 'Y', '', 1),
(8, 'member', 'aa08769cdcb26674c6706093503ff0a3', 'Member', 'Desa Keduanan Blok Kamas 1 rt 017 rw 008 Kec. Depok Kab. Cirebon', '083824021622', 'suhardiman64@gmail.com', 'user', '502378.jpg', 'Y', '', 1);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`username`),
  ADD KEY `id_user` (`id_user`);

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
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `alternatif`
--
ALTER TABLE `alternatif`
  MODIFY `id_alternatif` int(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=290;

--
-- AUTO_INCREMENT untuk tabel `aspek`
--
ALTER TABLE `aspek`
  MODIFY `id_aspek` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT untuk tabel `bobot`
--
ALTER TABLE `bobot`
  MODIFY `id_bobot` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT untuk tabel `faktor`
--
ALTER TABLE `faktor`
  MODIFY `id_faktor` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=160;

--
-- AUTO_INCREMENT untuk tabel `hasil`
--
ALTER TABLE `hasil`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=343;

--
-- AUTO_INCREMENT untuk tabel `nilai`
--
ALTER TABLE `nilai`
  MODIFY `id_nilai` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2058;

--
-- AUTO_INCREMENT untuk tabel `spk`
--
ALTER TABLE `spk`
  MODIFY `id_spk` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT untuk tabel `spk_user`
--
ALTER TABLE `spk_user`
  MODIFY `id_spkuser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
