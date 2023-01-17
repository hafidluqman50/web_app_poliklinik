-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 02, 2017 at 02:17 PM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `poliklinik_2017`
--

-- --------------------------------------------------------

--
-- Table structure for table `detail`
--

CREATE TABLE `detail` (
  `id_detail` int(11) NOT NULL,
  `id_resep` int(11) NOT NULL,
  `id_obat` int(11) NOT NULL,
  `banyak_obat` int(11) NOT NULL,
  `dosis` varchar(10) NOT NULL,
  `sub_total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail`
--

INSERT INTO `detail` (`id_detail`, `id_resep`, `id_obat`, `banyak_obat`, `dosis`, `sub_total`) VALUES
(6, 4, 4, 10, '1x4 hari', 200000),
(7, 4, 5, 10, '1x4 hari', 200000),
(10, 6, 5, 1, '1x3 Hari', 20000),
(11, 6, 4, 10, '1x4 Hari', 200000),
(12, 7, 4, 1, '1x2 hari', 20000),
(13, 7, 5, 10, '1x2 hari', 200000),
(14, 8, 4, 1, '1x1 hari', 20000),
(15, 8, 5, 1, '1x1 hari', 20000);

-- --------------------------------------------------------

--
-- Table structure for table `dokter`
--

CREATE TABLE `dokter` (
  `id_dkt` int(11) NOT NULL,
  `nama_dkt` varchar(70) NOT NULL,
  `spesialis` varchar(50) NOT NULL,
  `alamat_dkt` text NOT NULL,
  `telepon_dkt` varchar(20) NOT NULL,
  `id_poli` int(11) DEFAULT NULL,
  `tarif` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dokter`
--

INSERT INTO `dokter` (`id_dkt`, `nama_dkt`, `spesialis`, `alamat_dkt`, `telepon_dkt`, `id_poli`, `tarif`) VALUES
(1, 'Kamisama', 'Son of god', 'asdasdasdasds', '999999999', 4, 200000),
(2, 'amaterasu', 'mata', 'asdassdasad', '123121332', 3, 1212);

-- --------------------------------------------------------

--
-- Table structure for table `obat`
--

CREATE TABLE `obat` (
  `id_obat` int(11) NOT NULL,
  `nama_obat` varchar(70) NOT NULL,
  `jenis_obat` varchar(70) NOT NULL,
  `kategori` varchar(50) NOT NULL,
  `harga_obat` int(11) NOT NULL,
  `jumlah_obat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `obat`
--

INSERT INTO `obat` (`id_obat`, `nama_obat`, `jenis_obat`, `kategori`, `harga_obat`, `jumlah_obat`) VALUES
(4, 'Paramex', 'Generic', 'Kejagawan', 20000, 10000),
(5, 'Bionix', 'Jagaw', 'Kehebatan', 20000, 100000);

-- --------------------------------------------------------

--
-- Table structure for table `pasien`
--

CREATE TABLE `pasien` (
  `id_pasien` int(11) NOT NULL,
  `nama_pasien` varchar(70) NOT NULL,
  `alamat_pasien` text NOT NULL,
  `gender_pasien` enum('Laki - Laki','Perempuan') NOT NULL,
  `umur_pasien` int(11) NOT NULL,
  `telpon_pasien` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pasien`
--

INSERT INTO `pasien` (`id_pasien`, `nama_pasien`, `alamat_pasien`, `gender_pasien`, `umur_pasien`, `telpon_pasien`) VALUES
(18, 'asdassadsaasdas', 'asdasdsad', 'Laki - Laki', 12312331, '123123213213'),
(19, 'adsasdasd', 'asdasdasd', 'Laki - Laki', 123123, '123123'),
(20, 'Pattoricku', 'Jalan Ke rumah', 'Laki - Laki', 17, '0853912131231212');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_pembayaran` int(11) NOT NULL,
  `id_pendaftaran` int(11) NOT NULL,
  `tgl_byr` date NOT NULL,
  `jumlah_byr` int(11) NOT NULL,
  `bayar` int(11) DEFAULT NULL,
  `kembali` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id_pembayaran`, `id_pendaftaran`, `tgl_byr`, `jumlah_byr`, `bayar`, `kembali`) VALUES
(9, 23, '2017-09-22', 250000, 500000, 250000),
(10, 24, '2017-09-22', 250000, 250000, 0),
(11, 25, '2017-09-29', 250000, 250000, 0),
(12, 26, '2017-09-30', 250000, 250000, 0),
(13, 27, '2017-09-30', 250000, 250000, 0);

-- --------------------------------------------------------

--
-- Table structure for table `pendaftaran`
--

CREATE TABLE `pendaftaran` (
  `id_pendaftaran` int(11) NOT NULL,
  `tgl_daftar` date NOT NULL,
  `id_dkt` int(11) NOT NULL,
  `id_pasien` int(11) NOT NULL,
  `id_poli` int(11) NOT NULL,
  `biaya` int(11) NOT NULL,
  `ket` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pendaftaran`
--

INSERT INTO `pendaftaran` (`id_pendaftaran`, `tgl_daftar`, `id_dkt`, `id_pasien`, `id_poli`, `biaya`, `ket`) VALUES
(23, '2017-09-22', 1, 18, 4, 50000, 'asnsasakasdkjsdsjkdkjasd'),
(24, '2017-09-22', 1, 20, 4, 50000, 'Sakit Parut ku :('),
(25, '2017-09-29', 1, 18, 4, 50000, 'Sakit'),
(26, '2017-09-30', 1, 18, 4, 50000, 'Sakit Duduk'),
(27, '2017-09-30', 1, 18, 4, 50000, 'asdasdsadsad');

-- --------------------------------------------------------

--
-- Table structure for table `poliklinik`
--

CREATE TABLE `poliklinik` (
  `id_poli` int(11) NOT NULL,
  `nama_poli` varchar(70) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `poliklinik`
--

INSERT INTO `poliklinik` (`id_poli`, `nama_poli`) VALUES
(1, 'Anak'),
(2, 'Kuda'),
(3, 'Jantung'),
(4, 'Kedewaan');

-- --------------------------------------------------------

--
-- Table structure for table `resep`
--

CREATE TABLE `resep` (
  `id_resep` int(11) NOT NULL,
  `tgl_resep` date NOT NULL,
  `id_dkt` int(11) NOT NULL,
  `id_pasien` int(11) NOT NULL,
  `id_poli` int(11) NOT NULL,
  `total_harga` varchar(255) NOT NULL,
  `bayar` varchar(255) NOT NULL,
  `kembali` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `resep`
--

INSERT INTO `resep` (`id_resep`, `tgl_resep`, `id_dkt`, `id_pasien`, `id_poli`, `total_harga`, `bayar`, `kembali`) VALUES
(4, '2017-09-21', 1, 18, 4, '40000000', '40050000', '50000'),
(6, '2017-09-22', 1, 20, 4, '400000', '450000', '50000'),
(7, '2017-09-29', 1, 18, 4, '400000', '40000', '-360000'),
(8, '2017-09-30', 1, 18, 4, '40000', '40000', '0');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_users` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(75) NOT NULL,
  `stts_login` int(11) NOT NULL,
  `stts_akun` int(11) NOT NULL,
  `level` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_users`, `username`, `password`, `stts_login`, `stts_akun`, `level`) VALUES
(1, 'admin', '$2y$10$6S0jereltEEOT3qhBBDjXeNeqQBnkrV2SU9n9Ek/EPv0qubvviAAi', 0, 1, 2),
(2, 'operator', '$2y$10$A8BNA9YUno77/WphM3MFFehoM7Djxp.wl6NBIti9L4H3hP7jn9Ude', 0, 1, 0),
(3, 'petugas', '$2y$10$JsH4s0lLOfAZ8ktr4Zump.tun8QgYxDklS5JGrQUl4nh4TwsCz3QS', 0, 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `detail`
--
ALTER TABLE `detail`
  ADD PRIMARY KEY (`id_detail`),
  ADD KEY `id_resep` (`id_resep`) USING BTREE,
  ADD KEY `id_obat` (`id_obat`);

--
-- Indexes for table `dokter`
--
ALTER TABLE `dokter`
  ADD PRIMARY KEY (`id_dkt`),
  ADD KEY `poli_dokter` (`id_poli`);

--
-- Indexes for table `obat`
--
ALTER TABLE `obat`
  ADD PRIMARY KEY (`id_obat`);

--
-- Indexes for table `pasien`
--
ALTER TABLE `pasien`
  ADD PRIMARY KEY (`id_pasien`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`),
  ADD KEY `pembayaran_ibfk_1` (`id_pendaftaran`);

--
-- Indexes for table `pendaftaran`
--
ALTER TABLE `pendaftaran`
  ADD PRIMARY KEY (`id_pendaftaran`),
  ADD KEY `id_dkt` (`id_dkt`),
  ADD KEY `id_pasien` (`id_pasien`),
  ADD KEY `id_poli` (`id_poli`);

--
-- Indexes for table `poliklinik`
--
ALTER TABLE `poliklinik`
  ADD PRIMARY KEY (`id_poli`);

--
-- Indexes for table `resep`
--
ALTER TABLE `resep`
  ADD PRIMARY KEY (`id_resep`),
  ADD KEY `id_dkt` (`id_dkt`),
  ADD KEY `id_pasien` (`id_pasien`),
  ADD KEY `id_poli` (`id_poli`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_users`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detail`
--
ALTER TABLE `detail`
  MODIFY `id_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `dokter`
--
ALTER TABLE `dokter`
  MODIFY `id_dkt` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `obat`
--
ALTER TABLE `obat`
  MODIFY `id_obat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `pasien`
--
ALTER TABLE `pasien`
  MODIFY `id_pasien` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id_pembayaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `pendaftaran`
--
ALTER TABLE `pendaftaran`
  MODIFY `id_pendaftaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `poliklinik`
--
ALTER TABLE `poliklinik`
  MODIFY `id_poli` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `resep`
--
ALTER TABLE `resep`
  MODIFY `id_resep` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_users` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `detail`
--
ALTER TABLE `detail`
  ADD CONSTRAINT `detail_ibfk_1` FOREIGN KEY (`id_resep`) REFERENCES `resep` (`id_resep`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detail_ibfk_2` FOREIGN KEY (`id_obat`) REFERENCES `obat` (`id_obat`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `dokter`
--
ALTER TABLE `dokter`
  ADD CONSTRAINT `poli_dokter` FOREIGN KEY (`id_poli`) REFERENCES `poliklinik` (`id_poli`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD CONSTRAINT `pembayaran_ibfk_1` FOREIGN KEY (`id_pendaftaran`) REFERENCES `pendaftaran` (`id_pendaftaran`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pendaftaran`
--
ALTER TABLE `pendaftaran`
  ADD CONSTRAINT `pendaftaran_ibfk_1` FOREIGN KEY (`id_dkt`) REFERENCES `dokter` (`id_dkt`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pendaftaran_ibfk_2` FOREIGN KEY (`id_pasien`) REFERENCES `pasien` (`id_pasien`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pendaftaran_ibfk_3` FOREIGN KEY (`id_poli`) REFERENCES `poliklinik` (`id_poli`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `resep`
--
ALTER TABLE `resep`
  ADD CONSTRAINT `resep_ibfk_1` FOREIGN KEY (`id_dkt`) REFERENCES `dokter` (`id_dkt`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `resep_ibfk_2` FOREIGN KEY (`id_pasien`) REFERENCES `pasien` (`id_pasien`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `resep_ibfk_3` FOREIGN KEY (`id_poli`) REFERENCES `poliklinik` (`id_poli`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
