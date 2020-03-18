-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 18, 2020 at 05:19 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.28

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
-- Table structure for table `budget`
--

CREATE TABLE `budget` (
  `idBudget` int(11) NOT NULL,
  `idDepartment` int(11) NOT NULL,
  `periode` int(11) NOT NULL,
  `budget` int(11) NOT NULL,
  `terpakai` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `cangepassword`
--

CREATE TABLE `cangepassword` (
  `idUser` int(11) NOT NULL,
  `oldPassword` varchar(50) NOT NULL,
  `newPassword` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cangepassword`
--

INSERT INTO `cangepassword` (`idUser`, `oldPassword`, `newPassword`) VALUES
(123456, 'bddacb5c604f017f1b80d97dd6d14d60', '21232f297a57a5a743894a0e4a801fc3');

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
-- Table structure for table `formulir_er`
--

CREATE TABLE `formulir_er` (
  `idFormulir` varchar(50) NOT NULL,
  `idPic` int(11) NOT NULL,
  `job` varchar(50) NOT NULL,
  `position` varchar(50) NOT NULL,
  `reques` int(11) NOT NULL,
  `repleace` varchar(255) NOT NULL,
  `joinDate` date NOT NULL,
  `typeDocument` varchar(50) NOT NULL,
  `document` text NOT NULL,
  `education` varchar(50) NOT NULL,
  `major` text NOT NULL,
  `experience` varchar(50) NOT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `jabatan`
--

CREATE TABLE `jabatan` (
  `id_jabatan` int(11) NOT NULL,
  `nama_jbt` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jabatan`
--

INSERT INTO `jabatan` (`id_jabatan`, `nama_jbt`) VALUES
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
  `id_jabatan` int(11) DEFAULT NULL,
  `marital_status` int(11) DEFAULT NULL,
  `tanggal_masuk` date DEFAULT NULL,
  `jenis_kelamin` varchar(20) DEFAULT NULL,
  `status_karyawan` varchar(50) DEFAULT NULL,
  `tempat_lahir` varchar(50) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `no_telepon` varchar(20) DEFAULT NULL,
  `foto` varchar(200) DEFAULT NULL,
  `hak_akses` enum('admin','pic','manager','karyawan') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `karyawan`
--

INSERT INTO `karyawan` (`id_karyawan`, `id_dept`, `username`, `password`, `nama`, `id_jabatan`, `marital_status`, `tanggal_masuk`, `jenis_kelamin`, `status_karyawan`, `tempat_lahir`, `tanggal_lahir`, `alamat`, `email`, `no_telepon`, `foto`, `hak_akses`) VALUES
(123456, 3, '234018202003', '21232f297a57a5a743894a0e4a801fc3', 'mutia oktavia', 1, 1, '2020-10-03', 'laki-laki', 'permanen', 'dadsdas', '1970-01-01', 'perumahan laguna raya blok i no 12b', 'acepalan3@gmail.com', '0812121212', '1584544993.PNG', 'manager'),
(15113034, NULL, 'aa', '4124bc0a9335c27f086f24ba207a4912', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `marital_status`
--

CREATE TABLE `marital_status` (
  `id_marital` int(11) NOT NULL,
  `nama_marital` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `marital_status`
--

INSERT INTO `marital_status` (`id_marital`, `nama_marital`) VALUES
(1, 'Single'),
(2, 'Married'),
(3, 'M1'),
(4, 'M2'),
(5, 'M3');

-- --------------------------------------------------------

--
-- Table structure for table `statusapproval`
--

CREATE TABLE `statusapproval` (
  `idStatus` int(11) NOT NULL,
  `idFormulir` varchar(50) NOT NULL,
  `status` smallint(6) NOT NULL,
  `isReadP` tinyint(1) DEFAULT NULL,
  `isReadA` tinyint(1) DEFAULT NULL,
  `isReadM` tinyint(1) DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `timeVerify` datetime DEFAULT NULL,
  `timeApprove` datetime DEFAULT NULL,
  `komentarA` text DEFAULT NULL,
  `komentarM` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `budget`
--
ALTER TABLE `budget`
  ADD PRIMARY KEY (`idBudget`);

--
-- Indexes for table `departemen`
--
ALTER TABLE `departemen`
  ADD PRIMARY KEY (`id_dept`);

--
-- Indexes for table `formulir_er`
--
ALTER TABLE `formulir_er`
  ADD PRIMARY KEY (`idFormulir`);

--
-- Indexes for table `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`id_jabatan`);

--
-- Indexes for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`id_karyawan`),
  ADD KEY `id_dept` (`id_dept`),
  ADD KEY `jabatan` (`id_jabatan`),
  ADD KEY `marital_status` (`marital_status`);

--
-- Indexes for table `marital_status`
--
ALTER TABLE `marital_status`
  ADD PRIMARY KEY (`id_marital`);

--
-- Indexes for table `statusapproval`
--
ALTER TABLE `statusapproval`
  ADD PRIMARY KEY (`idStatus`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `budget`
--
ALTER TABLE `budget`
  MODIFY `idBudget` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `departemen`
--
ALTER TABLE `departemen`
  MODIFY `id_dept` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `jabatan`
--
ALTER TABLE `jabatan`
  MODIFY `id_jabatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `karyawan`
--
ALTER TABLE `karyawan`
  MODIFY `id_karyawan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15113035;

--
-- AUTO_INCREMENT for table `marital_status`
--
ALTER TABLE `marital_status`
  MODIFY `id_marital` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `statusapproval`
--
ALTER TABLE `statusapproval`
  MODIFY `idStatus` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD CONSTRAINT `karyawan_ibfk_1` FOREIGN KEY (`id_dept`) REFERENCES `departemen` (`id_dept`),
  ADD CONSTRAINT `karyawan_ibfk_2` FOREIGN KEY (`id_jabatan`) REFERENCES `jabatan` (`id_jabatan`),
  ADD CONSTRAINT `karyawan_ibfk_3` FOREIGN KEY (`marital_status`) REFERENCES `marital_status` (`id_marital`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
