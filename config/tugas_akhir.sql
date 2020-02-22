-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 22, 2020 at 08:56 AM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tugas_akhir`
--

-- --------------------------------------------------------

--
-- Table structure for table `approval`
--

CREATE TABLE `approval` (
  `id_formulir` int(11) NOT NULL,
  `date` date NOT NULL,
  `approved_by` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `departemen`
--

CREATE TABLE `departemen` (
  `id_dept` int(11) NOT NULL,
  `nama_dept` varchar(50) NOT NULL,
  `cost_center` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `departemen`
--

INSERT INTO `departemen` (`id_dept`, `nama_dept`, `cost_center`) VALUES
(1, 'HRD', 'ID8642'),
(2, 'LnD', 'ID8644'),
(3, 'Compliance', 'ID8550'),
(4, 'Engineering', 'ID8230'),
(5, 'EQE', 'ID8211'),
(6, 'Facility', 'ID8240'),
(7, 'Finance', 'ID8660'),
(8, 'Laboratory', 'ID8510'),
(9, 'MS&T', 'ID8760'),
(10, 'Planning', 'ID8610');

-- --------------------------------------------------------

--
-- Table structure for table `formulir`
--

CREATE TABLE `formulir` (
  `id_pic` int(11) NOT NULL,
  `id_formulir` int(11) NOT NULL,
  `id_departemen` int(11) NOT NULL,
  `requester` varchar(50) NOT NULL,
  `job_type` varchar(50) NOT NULL,
  `status_verif` varchar(50) NOT NULL,
  `status_approved` varchar(50) NOT NULL,
  `approved_by` varchar(50) NOT NULL,
  `verif_by` varchar(50) NOT NULL,
  `open_position` varchar(50) NOT NULL,
  `budget` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `formulir`
--

INSERT INTO `formulir` (`id_pic`, `id_formulir`, `id_departemen`, `requester`, `job_type`, `status_verif`, `status_approved`, `approved_by`, `verif_by`, `open_position`, `budget`) VALUES
(1, 1, 1, 'Siantro', 'Officer', 'Disetujui', 'Ok', 'manager', 'Admin', 'Operator', 5);

-- --------------------------------------------------------

--
-- Table structure for table `jabatan`
--

CREATE TABLE `jabatan` (
  `id_jabatan` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jabatan`
--

INSERT INTO `jabatan` (`id_jabatan`, `nama`) VALUES
(1, 'Operator'),
(2, 'Line Leader '),
(3, 'Officer'),
(4, 'Senior Assistant'),
(5, 'Executive'),
(6, 'Senior Executive'),
(7, 'Manager'),
(8, 'Senior Manager'),
(9, 'SLT');

-- --------------------------------------------------------

--
-- Table structure for table `karyawan`
--

CREATE TABLE `karyawan` (
  `id_karyawan` int(11) NOT NULL,
  `id_dept` int(11) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `jabatan` varchar(50) DEFAULT NULL,
  `marital_status` varchar(50) DEFAULT NULL,
  `tanggal_masuk` date DEFAULT NULL,
  `jenis_kelamin` varchar(20) DEFAULT NULL,
  `status_karyawan` varchar(50) DEFAULT NULL,
  `tempat_lahir` varchar(50) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `alamat` text,
  `email` varchar(50) DEFAULT NULL,
  `no_telepon` varchar(20) DEFAULT NULL,
  `foto` varchar(200) DEFAULT NULL,
  `hak_akses` enum('admin','pic','manager','karyawan') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `karyawan`
--

INSERT INTO `karyawan` (`id_karyawan`, `id_dept`, `username`, `password`, `nama`, `jabatan`, `marital_status`, `tanggal_masuk`, `jenis_kelamin`, `status_karyawan`, `tempat_lahir`, `tanggal_lahir`, `alamat`, `email`, `no_telepon`, `foto`, `hak_akses`) VALUES
(1260, 6, NULL, NULL, 'Ivan5', '5', '2', '2012-11-30', 'Laki-laki', 'Permanen', 'Medan', '1997-11-27', 'Piayu', NULL, NULL, NULL, 'karyawan'),
(10301, 9, NULL, NULL, 'Rodo Sianturi', '2', '3', '1994-01-03', 'Laki-laki', 'Kontrak', 'Batam ', '1991-01-01', 'Batam', NULL, NULL, NULL, 'karyawan'),
(10302, 1, NULL, NULL, 'Dong Herti', '5', '4', '2018-10-25', 'Laki-laki', 'Permanen', 'Medan', '2006-07-25', 'Plamo Garden', NULL, NULL, NULL, 'karyawan'),
(44444, 5, NULL, NULL, 'Suparyono', '4', '4', '2007-11-29', 'Laki-laki', 'Permanen', 'Solo', '1987-02-09', 'Piayu', NULL, NULL, NULL, 'karyawan'),
(123456, 3, NULL, NULL, 'Rodo', '4', '3', '2013-10-29', 'Perempuan', 'Permanen', 'Padang', '1993-12-31', 'Batu Aji - Batam Center', NULL, NULL, NULL, 'karyawan');

-- --------------------------------------------------------

--
-- Table structure for table `manager`
--

CREATE TABLE `manager` (
  `id_dept` int(11) NOT NULL,
  `id_karyawan` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `manager`
--

INSERT INTO `manager` (`id_dept`, `id_karyawan`, `nama`) VALUES
(1, 10301, 'Rodo1'),
(2, 10302, 'Rodo2');

-- --------------------------------------------------------

--
-- Table structure for table `marital_status`
--

CREATE TABLE `marital_status` (
  `id_marital` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `marital_status`
--

INSERT INTO `marital_status` (`id_marital`, `nama`) VALUES
(1, 'Single'),
(2, 'Married'),
(3, 'M1'),
(4, 'M2'),
(5, 'M3');

-- --------------------------------------------------------

--
-- Table structure for table `pesan`
--

CREATE TABLE `pesan` (
  `id_pesan` int(11) NOT NULL,
  `pengirim` varchar(50) NOT NULL,
  `detail` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pesan`
--

INSERT INTO `pesan` (`id_pesan`, `pengirim`, `detail`) VALUES
(1, 'Manager', 'Pengajuan anda disetujui'),
(2, 'Admin', 'Pengajuan anda ditolak');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(256) NOT NULL,
  `departemen` varchar(50) NOT NULL,
  `hak_akses` enum('admin','pic','manager','') NOT NULL,
  `image` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `nama`, `username`, `password`, `departemen`, `hak_akses`, `image`, `email`) VALUES
(1, 'admin', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'HRD', 'admin', '', ''),
(2, 'pic', 'pic', 'ed09636a6ea24a292460866afdd7a89a', 'LND', 'pic', '', ''),
(3, 'manager', 'manager', '1d0258c2440a8d19e716292b231e3190', 'LND', 'manager', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `approval`
--
ALTER TABLE `approval`
  ADD PRIMARY KEY (`id_formulir`);

--
-- Indexes for table `departemen`
--
ALTER TABLE `departemen`
  ADD PRIMARY KEY (`id_dept`);

--
-- Indexes for table `formulir`
--
ALTER TABLE `formulir`
  ADD PRIMARY KEY (`id_formulir`);

--
-- Indexes for table `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`id_jabatan`);

--
-- Indexes for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`id_karyawan`);

--
-- Indexes for table `manager`
--
ALTER TABLE `manager`
  ADD PRIMARY KEY (`id_dept`),
  ADD UNIQUE KEY `id_karyawan` (`id_karyawan`);

--
-- Indexes for table `marital_status`
--
ALTER TABLE `marital_status`
  ADD PRIMARY KEY (`id_marital`);

--
-- Indexes for table `pesan`
--
ALTER TABLE `pesan`
  ADD PRIMARY KEY (`id_pesan`),
  ADD KEY `pengirim` (`pengirim`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `approval`
--
ALTER TABLE `approval`
  MODIFY `id_formulir` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `departemen`
--
ALTER TABLE `departemen`
  MODIFY `id_dept` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `formulir`
--
ALTER TABLE `formulir`
  MODIFY `id_formulir` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `jabatan`
--
ALTER TABLE `jabatan`
  MODIFY `id_jabatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `karyawan`
--
ALTER TABLE `karyawan`
  MODIFY `id_karyawan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123458;

--
-- AUTO_INCREMENT for table `manager`
--
ALTER TABLE `manager`
  MODIFY `id_dept` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `marital_status`
--
ALTER TABLE `marital_status`
  MODIFY `id_marital` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pesan`
--
ALTER TABLE `pesan`
  MODIFY `id_pesan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
