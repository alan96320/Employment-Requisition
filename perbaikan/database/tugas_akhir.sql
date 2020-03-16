-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 16, 2020 at 12:38 PM
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
-- Table structure for table `approval`
--

CREATE TABLE `approval` (
  `id_formulir` int(11) NOT NULL,
  `date` date NOT NULL,
  `approved_by` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

--
-- Dumping data for table `budget`
--

INSERT INTO `budget` (`idBudget`, `idDepartment`, `periode`, `budget`, `terpakai`) VALUES
(1, 8, 3030, 99, 2),
(3, 2, 2020, 67, 23),
(4, 3, 3030, 45, 0),
(5, 4, 2020, 34, 0);

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
  `join_date` date NOT NULL,
  `budget` int(11) NOT NULL,
  `education_req` varchar(100) NOT NULL,
  `major_function` varchar(250) NOT NULL,
  `experience_backgrnd` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `formulir`
--

INSERT INTO `formulir` (`id_pic`, `id_formulir`, `id_departemen`, `requester`, `job_type`, `status_verif`, `status_approved`, `approved_by`, `verif_by`, `open_position`, `join_date`, `budget`, `education_req`, `major_function`, `experience_backgrnd`) VALUES
(1, 1, 1, 'Siantro', 'Officer', 'Disetujui', 'Ok', 'manager', 'Admin', 'Operator', '2020-03-30', 5, 'SMK', 'vfafvdvzdvfz', '1 Year'),
(1, 9, 2, 'rodo', 'operator', 'ditolak', 'n/a', 'n/a', 'admin', 'operator', '2020-03-23', 12, 'jnasdkjnksacndcasjncdjnjndciuan', 'kjncankjnjnlmnh oa sdaksjnapdf', '1 tahun pengalaman');

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

--
-- Dumping data for table `formulir_er`
--

INSERT INTO `formulir_er` (`idFormulir`, `idPic`, `job`, `position`, `reques`, `repleace`, `joinDate`, `typeDocument`, `document`, `education`, `major`, `experience`, `created`) VALUES
('1520203103', 10302, 'kontrak', 'operator', 2, '12,123456', '2020-03-27', 'Role Profile', '1584269743.pdf', 'smk', 'Mencuci piring misalnya', '1 Year', '2020-03-15 00:00:00'),
('152020374103', 67544, 'permanen', 'operator', 23, '12', '2020-03-04', 'Organization Chart', '1584290293.pdf', 'd3/d4', 'as', '2 Year', '2020-03-15 00:00:00');

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
(12, 1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'mutia oktavia', 1, 2, '2020-03-10', 'Perempuan', 'permanen', 'das', '2020-03-13', 'perumahan laguna raya blok i no 12b', 'acepalan3@gmail.com', '081323432333', '1584250822.jpeg', 'admin'),
(10302, 1, 'pic', 'ed09636a6ea24a292460866afdd7a89a', 'Dong Herti', 5, 4, '1970-01-01', 'laki-laki', 'permanen', 'Medan', '1970-01-01', 'Plamo Garden', 'acepalan3@gmail.com', '13321231', '1584171144.png', 'pic'),
(67544, 2, 'andini', 'b3e0d57ba78cbdc6fcba9c7a467e8fad', 'andini', 3, 1, '2020-03-10', 'laki-laki', 'permanen', 'dadsdas', '1970-01-01', 'perumahan laguna raya blok i no 12b', 'acepalan3@gmail.com', '081323432333', '1584287201.jpeg', 'pic'),
(123456, 1, 'user', 'ee11cbb19052e40b07aac0ca060c23ee', 'mutia aja2', 2, 1, '1970-01-01', 'laki-laki', 'permanen', 'das', '1970-01-01', 'perumahan laguna raya blok i no 12b', 'acepalan3@gmail.com', '081356786677', '1584170870.JPG', 'admin');

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
-- Table structure for table `statusapproval`
--

CREATE TABLE `statusapproval` (
  `idStatus` int(11) NOT NULL,
  `idFormulir` varchar(50) NOT NULL,
  `status` smallint(6) NOT NULL,
  `isReadA` tinyint(1) DEFAULT NULL,
  `isReadM` tinyint(1) DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `statusapproval`
--

INSERT INTO `statusapproval` (`idStatus`, `idFormulir`, `status`, `isReadA`, `isReadM`, `created`) VALUES
(1, '1520203103', 5, NULL, NULL, '2020-03-15 17:55:43'),
(2, '152020374103', 5, NULL, NULL, '2020-03-15 23:38:12');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(256) NOT NULL,
  `departemen` int(11) NOT NULL,
  `hak_akses` enum('admin','pic','manager','') NOT NULL,
  `image` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `nama`, `username`, `password`, `departemen`, `hak_akses`, `image`, `email`) VALUES
(1, 'admin', 'admin', '21232f297a57a5a743894a0e4a801fc3', 1, 'admin', 'me.jpg', ''),
(2, 'pic', 'pic', 'ed09636a6ea24a292460866afdd7a89a', 2, 'pic', 'pic.png', ''),
(3, 'manager', 'manager', '1d0258c2440a8d19e716292b231e3190', 1, 'manager', 'mnger.png', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `approval`
--
ALTER TABLE `approval`
  ADD PRIMARY KEY (`id_formulir`);

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
-- Indexes for table `formulir`
--
ALTER TABLE `formulir`
  ADD PRIMARY KEY (`id_formulir`),
  ADD KEY `id_pic` (`id_pic`),
  ADD KEY `id_departemen` (`id_departemen`);

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
-- Indexes for table `statusapproval`
--
ALTER TABLE `statusapproval`
  ADD PRIMARY KEY (`idStatus`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `departemen` (`departemen`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `approval`
--
ALTER TABLE `approval`
  MODIFY `id_formulir` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `budget`
--
ALTER TABLE `budget`
  MODIFY `idBudget` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `departemen`
--
ALTER TABLE `departemen`
  MODIFY `id_dept` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `formulir`
--
ALTER TABLE `formulir`
  MODIFY `id_formulir` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `jabatan`
--
ALTER TABLE `jabatan`
  MODIFY `id_jabatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `karyawan`
--
ALTER TABLE `karyawan`
  MODIFY `id_karyawan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15113033;

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
-- AUTO_INCREMENT for table `statusapproval`
--
ALTER TABLE `statusapproval`
  MODIFY `idStatus` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `formulir`
--
ALTER TABLE `formulir`
  ADD CONSTRAINT `formulir_ibfk_1` FOREIGN KEY (`id_pic`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `formulir_ibfk_2` FOREIGN KEY (`id_departemen`) REFERENCES `departemen` (`id_dept`);

--
-- Constraints for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD CONSTRAINT `karyawan_ibfk_1` FOREIGN KEY (`id_dept`) REFERENCES `departemen` (`id_dept`),
  ADD CONSTRAINT `karyawan_ibfk_2` FOREIGN KEY (`id_jabatan`) REFERENCES `jabatan` (`id_jabatan`),
  ADD CONSTRAINT `karyawan_ibfk_3` FOREIGN KEY (`marital_status`) REFERENCES `marital_status` (`id_marital`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`departemen`) REFERENCES `departemen` (`id_dept`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
