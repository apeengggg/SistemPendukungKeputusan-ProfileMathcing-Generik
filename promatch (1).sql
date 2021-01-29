-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 29 Jan 2021 pada 10.33
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
  `id_alternatif` tinyint(3) UNSIGNED NOT NULL,
  `nama_alternatif` varchar(100) NOT NULL,
  `id_spk` int(11) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `alternatif`
--

INSERT INTO `alternatif` (`id_alternatif`, `nama_alternatif`, `id_spk`, `id_user`) VALUES
(26, 'Wawan', 13, 12),
(27, 'Tantri', 13, 12),
(28, 'James', 13, 12);

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
(22, 'Perilaku', 40, 70, 30, 'P', 13, 12);

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
(54, 0, 5, 'Tidak ada selisih  ( kompetensi sesuai yang dibutuhkan )', 13, 12),
(55, 1, 4.5, 'Kompetensi individu kelebihan 1 tingkat/level', 13, 12),
(56, -1, 4, 'Kompetensi individu kekurangan 1 tingkat/level', 13, 12),
(57, 2, 3.5, 'Kompetensi individu kelebihan 2 tingkat/level', 13, 12),
(58, -2, 3, 'Kompetensi individu kekurangan 2 tingkat/level', 13, 12),
(59, 3, 2.5, 'Kompetensi individu kelebihan 3 tingkat/level', 13, 12),
(60, -3, 2, 'Kompetensi individu kekurangan 3 tingkat/level', 13, 12),
(61, 4, 1.5, 'Kompetensi individu kelebihan 4 tingkat/level', 13, 12),
(62, -4, 1, 'Kompetensi individu kekurangan 4 tingkat/level', 13, 12);

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
  `id_user` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `faktor`
--

INSERT INTO `faktor` (`id_faktor`, `aspek`, `nama_faktor`, `target`, `jenis`, `id_spk`, `id_user`) VALUES
(59, 20, 'common sense', 3, '2', 13, 12),
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
(79, 22, 'pemenuhan', 5, '1', 13, 12);

-- --------------------------------------------------------

--
-- Struktur dari tabel `hasil`
--

CREATE TABLE `hasil` (
  `id` int(11) NOT NULL,
  `nama_alternatif` varchar(50) NOT NULL,
  `nilai` float NOT NULL,
  `id_spk` int(11) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `hasil`
--

INSERT INTO `hasil` (`id`, `nama_alternatif`, `nilai`, `id_spk`, `id_user`) VALUES
(179, 'Tantri', 4.25975, 13, 1),
(180, 'James', 3.93375, 13, 1),
(181, 'Wawan', 3.811, 13, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `nilai`
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
-- Dumping data untuk tabel `nilai`
--

INSERT INTO `nilai` (`id_nilai`, `id_alternatif`, `faktor`, `nilai`, `id_spk`, `id_user`) VALUES
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
(345, 28, 79, 4, 13, 12);

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
(34, 'SPK Tambah SPK Baru', 'Ini Baru DItambahin', '2021-01-29', 1);

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
  `aktif` char(1) COLLATE latin1_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data untuk tabel `user`
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
  MODIFY `id_alternatif` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT untuk tabel `aspek`
--
ALTER TABLE `aspek`
  MODIFY `id_aspek` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT untuk tabel `bobot`
--
ALTER TABLE `bobot`
  MODIFY `id_bobot` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT untuk tabel `faktor`
--
ALTER TABLE `faktor`
  MODIFY `id_faktor` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=138;

--
-- AUTO_INCREMENT untuk tabel `hasil`
--
ALTER TABLE `hasil`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=182;

--
-- AUTO_INCREMENT untuk tabel `nilai`
--
ALTER TABLE `nilai`
  MODIFY `id_nilai` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=419;

--
-- AUTO_INCREMENT untuk tabel `spk`
--
ALTER TABLE `spk`
  MODIFY `id_spk` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
