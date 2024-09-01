-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 22, 2024 at 08:32 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `etilang`
--

-- --------------------------------------------------------

--
-- Table structure for table `pasal`
--

CREATE TABLE `pasal` (
  `id_pasal` char(11) NOT NULL,
  `nama_pasal` varchar(100) NOT NULL,
  `keterangan` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pasal`
--

INSERT INTO `pasal` (`id_pasal`, `nama_pasal`, `keterangan`) VALUES
('PSL001', 'Pasal 277 ayat (1) UU LLAJ - Mengemudikan kendaraan bermotor tanpa TNKB yang sah	', 'Rp.500.000'),
('PSL002', 'Pasal 277 ayat (2) UU LLAJ	- Mengemudikan kendaraan bermotor dengan TNKB yang tidak sesuai dengan ke', 'Rp.500.000');

-- --------------------------------------------------------

--
-- Table structure for table `tb_bidang`
--

CREATE TABLE `tb_bidang` (
  `kode_kategori` char(11) NOT NULL,
  `nama_bidang` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_bidang`
--

INSERT INTO `tb_bidang` (`kode_kategori`, `nama_bidang`) VALUES
('KT001', 'Slip Merah'),
('KT002', 'Slip Biru');

-- --------------------------------------------------------

--
-- Table structure for table `tb_masyarakat`
--

CREATE TABLE `tb_masyarakat` (
  `username` char(100) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `tempat_lahir` varchar(50) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `alamat` text NOT NULL,
  `no_hp` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `foto_user` varchar(200) NOT NULL,
  `token` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tb_masyarakat`
--

INSERT INTO `tb_masyarakat` (`username`, `nama`, `jenis_kelamin`, `tempat_lahir`, `tanggal_lahir`, `alamat`, `no_hp`, `password`, `foto_user`, `token`) VALUES
('juna', 'juna', 'L', 'Pangkajene, Sidrap', '2003-05-17', 'Pangkajene, Sidrap', '083865494851', '12345', 'user.png', 'fWOoVBAHQauHIzdB7hZZSP:APA91bHNgQ3AuYlQ9204BwVx7rPE8hoEen3yloPZgL-juXFVFNMHp7XzceuQ80hiLUiWEzXwdLIJaagQldn94X8M-mVXzxnGEXvO9paXyZ3JTsi1JWQMpiPemjh3mQp5riebeUln6Fe5');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pelanggaran`
--

CREATE TABLE `tb_pelanggaran` (
  `id_pelanggaran` int(11) NOT NULL,
  `id_laporan` varchar(100) NOT NULL,
  `id_pasal` char(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_pelanggaran`
--

INSERT INTO `tb_pelanggaran` (`id_pelanggaran`, `id_laporan`, `id_pasal`) VALUES
(136, 'TL001', 'PSL001'),
(137, 'TL001', 'PSL002'),
(138, 'TL002', 'PSL001'),
(139, 'TL002', 'PSL002');

-- --------------------------------------------------------

--
-- Table structure for table `tb_petugas`
--

CREATE TABLE `tb_petugas` (
  `id_petugas` int(11) NOT NULL,
  `nama_petugas` varchar(100) NOT NULL,
  `bagian` varchar(200) NOT NULL,
  `tempat_lahir` varchar(100) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `telp` varchar(20) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tb_petugas`
--

INSERT INTO `tb_petugas` (`id_petugas`, `nama_petugas`, `bagian`, `tempat_lahir`, `tanggal_lahir`, `jenis_kelamin`, `alamat`, `telp`, `username`, `password`) VALUES
(11, 'admin', 'Admin', 'admin', '2022-05-17', 'L', 'Parepare', '083865494851', 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `tb_tanggapan`
--

CREATE TABLE `tb_tanggapan` (
  `id_tanggapan` varchar(10) NOT NULL,
  `isi_tanggapan` varchar(500) NOT NULL,
  `tanggal_tanggapan` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_tilang`
--

CREATE TABLE `tb_tilang` (
  `id_tilang` char(100) NOT NULL,
  `jam` time NOT NULL,
  `tgl` date NOT NULL,
  `username` varchar(100) NOT NULL,
  `tgl_pelanggaran` date NOT NULL,
  `lati` varchar(100) NOT NULL,
  `longi` varchar(100) NOT NULL,
  `nama_pelanggar` varchar(100) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `no_hp` varchar(100) NOT NULL,
  `stnk` varchar(100) NOT NULL,
  `merk` varchar(100) NOT NULL,
  `plat` varchar(100) NOT NULL,
  `warna` varchar(100) NOT NULL,
  `kode_kategori` varchar(100) NOT NULL,
  `keterangan` text NOT NULL,
  `jadwal` date NOT NULL,
  `lokasi` varchar(100) NOT NULL,
  `tujuan` varchar(100) NOT NULL,
  `gambar` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL,
  `id_tanggapan` char(100) NOT NULL,
  `signature` varchar(255) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_tilang`
--

INSERT INTO `tb_tilang` (`id_tilang`, `jam`, `tgl`, `username`, `tgl_pelanggaran`, `lati`, `longi`, `nama_pelanggar`, `alamat`, `no_hp`, `stnk`, `merk`, `plat`, `warna`, `kode_kategori`, `keterangan`, `jadwal`, `lokasi`, `tujuan`, `gambar`, `status`, `id_tanggapan`, `signature`, `updated_at`) VALUES
('TL001', '22:46:24', '2024-07-27', 'juna', '2024-07-27', '37.4220936', '-122.083922', 'test', 'test', '083865494851', '73134456789', 'mio', 'dd 09493 pt', 'merah', 'KT002', 'tidak act', '1970-01-07', 'ssss', 'PMB002', 'TL001.jpeg', 'Proses', '-', '66a5169734afc.png', '2024-07-27 23:47:35');

-- --------------------------------------------------------

--
-- Table structure for table `tujuan_pembayaran`
--

CREATE TABLE `tujuan_pembayaran` (
  `id_tujuan` char(11) NOT NULL,
  `nama_tujuan` varchar(100) NOT NULL,
  `keterangan_pembayaran` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tujuan_pembayaran`
--

INSERT INTO `tujuan_pembayaran` (`id_tujuan`, `nama_tujuan`, `keterangan_pembayaran`) VALUES
('PMB001', '-', 'Slip Merah'),
('PMB002', 'BRI - 1234 5678 9123 456 A/N Arjuna', 'Slip Biru');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pasal`
--
ALTER TABLE `pasal`
  ADD PRIMARY KEY (`id_pasal`);

--
-- Indexes for table `tb_bidang`
--
ALTER TABLE `tb_bidang`
  ADD PRIMARY KEY (`kode_kategori`);

--
-- Indexes for table `tb_masyarakat`
--
ALTER TABLE `tb_masyarakat`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `tb_pelanggaran`
--
ALTER TABLE `tb_pelanggaran`
  ADD PRIMARY KEY (`id_pelanggaran`);

--
-- Indexes for table `tb_petugas`
--
ALTER TABLE `tb_petugas`
  ADD PRIMARY KEY (`id_petugas`);

--
-- Indexes for table `tb_tanggapan`
--
ALTER TABLE `tb_tanggapan`
  ADD PRIMARY KEY (`id_tanggapan`);

--
-- Indexes for table `tb_tilang`
--
ALTER TABLE `tb_tilang`
  ADD PRIMARY KEY (`id_tilang`);

--
-- Indexes for table `tujuan_pembayaran`
--
ALTER TABLE `tujuan_pembayaran`
  ADD PRIMARY KEY (`id_tujuan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_pelanggaran`
--
ALTER TABLE `tb_pelanggaran`
  MODIFY `id_pelanggaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=140;

--
-- AUTO_INCREMENT for table `tb_petugas`
--
ALTER TABLE `tb_petugas`
  MODIFY `id_petugas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
