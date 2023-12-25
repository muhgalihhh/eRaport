-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 25, 2023 at 05:34 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_eraport`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_profiles`
--

CREATE TABLE `admin_profiles` (
  `user_id` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `foto` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_profiles`
--

INSERT INTO `admin_profiles` (`user_id`, `nama`, `foto`) VALUES
(4, 'Muhamad Gery', '../../asset/image/kamera.png'),
(23, 'Muhamad Galih', '../../asset/image/admin_admin3.jpg'),
(24, 'Mie Indomie Goreng', '../../asset/image/default.jpg');

--
-- Triggers `admin_profiles`
--
DELIMITER $$
CREATE TRIGGER `after_delete_admin_profiles` AFTER DELETE ON `admin_profiles` FOR EACH ROW BEGIN
    DELETE FROM users WHERE user_id = OLD.user_id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `guru`
--

CREATE TABLE `guru` (
  `guru_id` int(11) NOT NULL,
  `nama_guru` varchar(100) NOT NULL,
  `nip` varchar(10) NOT NULL,
  `jk` enum('L','P') DEFAULT NULL,
  `notelp` varchar(15) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `tempat_lahir` varchar(100) NOT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `mapel_id` int(11) DEFAULT NULL,
  `foto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `guru`
--

INSERT INTO `guru` (`guru_id`, `nama_guru`, `nip`, `jk`, `notelp`, `alamat`, `tempat_lahir`, `tanggal_lahir`, `mapel_id`, `foto`) VALUES
(2, 'Azizan S.Pd', '1231231231', '', '08213012308', 'Purbalingga', 'Purbalingga', '1995-01-31', 11, '../../asset/image/default.jpg'),
(3, 'Gery Prayoga', '1231231231', 'L', '08213012308', 'Jl Soedirman', 'Purbalingga', '2004-03-03', 9, '../../asset/image/guru_1231231231.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `kelas_id` int(11) NOT NULL,
  `nama_kelas` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`kelas_id`, `nama_kelas`) VALUES
(2, 'VII A'),
(3, 'VII B'),
(4, 'VIII A'),
(5, 'VIII B'),
(6, 'IX A'),
(7, 'IX B');

-- --------------------------------------------------------

--
-- Table structure for table `mata_pelajaran`
--

CREATE TABLE `mata_pelajaran` (
  `mapel_id` int(11) NOT NULL,
  `nama_mapel` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mata_pelajaran`
--

INSERT INTO `mata_pelajaran` (`mapel_id`, `nama_mapel`) VALUES
(7, 'Ilmu Pengetahuan Alam'),
(9, 'Bahasa Indonesia'),
(10, 'Matematika'),
(11, 'Bahasa Inggris'),
(12, 'Ilmu Pengetahuan Sosial');

-- --------------------------------------------------------

--
-- Table structure for table `nilai_ujian`
--

CREATE TABLE `nilai_ujian` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `ujian_id` int(11) DEFAULT NULL,
  `mapel_id` int(11) DEFAULT NULL,
  `nilai` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `nilai_ujian`
--

INSERT INTO `nilai_ujian` (`id`, `user_id`, `ujian_id`, `mapel_id`, `nilai`) VALUES
(20, 27, 9, 7, 60),
(21, 27, 9, 9, 44),
(22, 27, 9, 10, 70),
(23, 27, 10, 7, 100),
(24, 27, 10, 9, 100),
(25, 27, 10, 10, 100),
(26, 27, 11, 7, 100),
(27, 27, 11, 9, 100),
(28, 27, 11, 10, 100),
(29, 27, 12, 7, 100),
(30, 27, 12, 9, 100),
(31, 27, 12, 10, 100),
(32, 28, 13, 7, 95),
(33, 28, 13, 9, 86),
(34, 28, 13, 10, 41),
(35, 28, 13, 11, 65),
(36, 28, 14, 7, 92),
(37, 28, 14, 9, 32),
(38, 28, 14, 10, 71),
(39, 28, 14, 11, 67),
(40, 28, 15, 7, 74),
(41, 28, 15, 9, 74),
(42, 28, 15, 10, 84),
(43, 28, 15, 11, 78),
(44, 28, 16, 7, 95),
(45, 28, 16, 9, 72),
(46, 28, 16, 10, 83),
(47, 28, 16, 11, 81);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `role_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`role_name`) VALUES
('admin'),
('siswa'),
('walikelas');

-- --------------------------------------------------------

--
-- Table structure for table `sekolah`
--

CREATE TABLE `sekolah` (
  `sekolah_id` int(11) NOT NULL,
  `nama_sekolah` varchar(100) NOT NULL,
  `npsn` varchar(10) NOT NULL,
  `jenjang` varchar(10) NOT NULL,
  `status` varchar(10) NOT NULL,
  `alamat_sekolah` varchar(255) DEFAULT NULL,
  `tahun_berdiri` int(11) DEFAULT NULL,
  `akreditasi` varchar(10) DEFAULT NULL,
  `kepala_sekolah` varchar(100) DEFAULT NULL,
  `telepon_sekolah` varchar(15) DEFAULT NULL,
  `email_sekolah` varchar(50) DEFAULT NULL,
  `website_sekolah` varchar(100) DEFAULT NULL,
  `gambar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sekolah`
--

INSERT INTO `sekolah` (`sekolah_id`, `nama_sekolah`, `npsn`, `jenjang`, `status`, `alamat_sekolah`, `tahun_berdiri`, `akreditasi`, `kepala_sekolah`, `telepon_sekolah`, `email_sekolah`, `website_sekolah`, `gambar`) VALUES
(1, 'SMP N 01 Purbalingga', '0909209', 'SMP', 'Negeri/Akt', 'l. Piere Tendean No.8, RT.2/RW.3, Purbalingga, Purbalingga Lor, Kec. Purbalingga, Kabupaten Purbalingga, Jawa Tengah 53313', 1999, 'A', 'Drs. RUNTUT PRAMONO', '+021 02390 0101', 'smp.n1puralingga@sch.id', 'https://www.smpn1purbalingga.sch.id/', 'asset/image/sekolah_profile.png');

-- --------------------------------------------------------

--
-- Table structure for table `siswa_profiles`
--

CREATE TABLE `siswa_profiles` (
  `user_id` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `NIS` varchar(10) DEFAULT NULL,
  `alamat` varchar(100) DEFAULT NULL,
  `jk` enum('L','P') DEFAULT NULL,
  `tempat_lahir` varchar(100) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `notelp` varchar(15) DEFAULT NULL,
  `kelas_id` int(11) DEFAULT NULL,
  `foto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `siswa_profiles`
--

INSERT INTO `siswa_profiles` (`user_id`, `nama`, `NIS`, `alamat`, `jk`, `tempat_lahir`, `tanggal_lahir`, `notelp`, `kelas_id`, `foto`) VALUES
(27, 'MUHAMAD GALIH', 'SK0000001', 'Purbalingga', 'L', 'Cilacap', '2003-01-14', '08023812083', 2, '../../asset/image/default.jpg'),
(28, 'Gery Prayoga', 'SK0000002', 'Purbalingga', 'L', 'Cilacap', '2004-06-15', '08956756575', 3, '../../asset/image/default.jpg');

--
-- Triggers `siswa_profiles`
--
DELIMITER $$
CREATE TRIGGER `after_delete_siswaprofiles` AFTER DELETE ON `siswa_profiles` FOR EACH ROW BEGIN
    DELETE FROM users WHERE user_id = OLD.user_id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tahun_semester`
--

CREATE TABLE `tahun_semester` (
  `tahun_semester_id` int(11) NOT NULL,
  `nama_tahun` varchar(20) NOT NULL,
  `nama_semester` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tahun_semester`
--

INSERT INTO `tahun_semester` (`tahun_semester_id`, `nama_tahun`, `nama_semester`) VALUES
(5, '2022/2023', 'ganjil'),
(6, '2022/2023', 'genap'),
(7, '2023/2024', 'ganjil'),
(8, '2023/2024', 'genap');

-- --------------------------------------------------------

--
-- Table structure for table `ujian`
--

CREATE TABLE `ujian` (
  `ujian_id` int(11) NOT NULL,
  `nama_ujian` varchar(50) NOT NULL,
  `tanggal` date NOT NULL,
  `kelas_id` int(11) DEFAULT NULL,
  `tahun_semester_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ujian`
--

INSERT INTO `ujian` (`ujian_id`, `nama_ujian`, `tanggal`, `kelas_id`, `tahun_semester_id`) VALUES
(9, 'UTS', '2023-11-28', 2, 5),
(10, 'UAS', '2023-11-28', 2, 5),
(11, 'UTS', '2023-11-28', 2, 6),
(12, 'UAS', '2023-11-28', 3, 6),
(13, 'UTS', '2023-11-29', 2, 5),
(14, 'UAS', '2023-11-28', 2, 5),
(15, 'UTS', '2023-11-28', 2, 6),
(16, 'UAS', '2023-11-28', 3, 6);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `role`) VALUES
(4, 'admin1', '$2y$10$T3cSSRX5A9ZNccuzfqNm2.QIFA.JQpNoFcT1OjNrXvSETv55qLzfi', 'admin'),
(23, 'admin3', '$2y$10$CkQizkExGp8HjAPrGCXOReoQf6RMz99PuXnoNV2q5kRB.9x3lsEXu', 'admin'),
(24, 'admin2', '$2y$10$84Y0lf22i.SqhBpdjsKhCug7JNweJgHEaypnfkHGaA2jRghTQuX3y', 'admin'),
(26, 'supardi1', '$2y$10$rKfOGPLL/5sC6sjIqXFHTuxIH41UDU4/0vcOsqnz4mP4O/KaxiNoy', 'walikelas'),
(27, 'muhgalihhh', '$2y$10$JymaYdJhxBzZyrrOB1JLHu90ewzeHcB0AkFoW9hHEyxZBRFIX4WFa', 'siswa'),
(28, 'geryprayoga', '$2y$10$BmRlcPou3sApq3Xe1y9yvOheqEpioqQEosCHUVVEvVTq/JeUs0o7K', 'siswa');

-- --------------------------------------------------------

--
-- Table structure for table `walikelas_profiles`
--

CREATE TABLE `walikelas_profiles` (
  `user_id` int(11) NOT NULL,
  `nip` varchar(10) DEFAULT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `alamat` varchar(100) DEFAULT NULL,
  `jk` enum('L','P') DEFAULT NULL,
  `notelp` varchar(15) DEFAULT NULL,
  `kelas_id` int(11) DEFAULT NULL,
  `foto` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `walikelas_profiles`
--

INSERT INTO `walikelas_profiles` (`user_id`, `nip`, `nama`, `alamat`, `jk`, `notelp`, `kelas_id`, `foto`) VALUES
(26, '', 'Supardi S.Pd', 'Purbalingga', 'L', '085799196683', 2, '../../asset/image/default.jpg');

--
-- Triggers `walikelas_profiles`
--
DELIMITER $$
CREATE TRIGGER `after_delete_walikelasprofiles` AFTER DELETE ON `walikelas_profiles` FOR EACH ROW BEGIN
    DELETE FROM users WHERE user_id = OLD.user_id;
END
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_profiles`
--
ALTER TABLE `admin_profiles`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `guru`
--
ALTER TABLE `guru`
  ADD PRIMARY KEY (`guru_id`),
  ADD KEY `mapel_id` (`mapel_id`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`kelas_id`);

--
-- Indexes for table `mata_pelajaran`
--
ALTER TABLE `mata_pelajaran`
  ADD PRIMARY KEY (`mapel_id`);

--
-- Indexes for table `nilai_ujian`
--
ALTER TABLE `nilai_ujian`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `ujian_id` (`ujian_id`),
  ADD KEY `mapel_id` (`mapel_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`role_name`);

--
-- Indexes for table `sekolah`
--
ALTER TABLE `sekolah`
  ADD PRIMARY KEY (`sekolah_id`);

--
-- Indexes for table `siswa_profiles`
--
ALTER TABLE `siswa_profiles`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `kelas_id` (`kelas_id`);

--
-- Indexes for table `tahun_semester`
--
ALTER TABLE `tahun_semester`
  ADD PRIMARY KEY (`tahun_semester_id`);

--
-- Indexes for table `ujian`
--
ALTER TABLE `ujian`
  ADD PRIMARY KEY (`ujian_id`),
  ADD KEY `kelas_id` (`kelas_id`),
  ADD KEY `tahun_semester_id` (`tahun_semester_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `role` (`role`);

--
-- Indexes for table `walikelas_profiles`
--
ALTER TABLE `walikelas_profiles`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `kelas_id` (`kelas_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_profiles`
--
ALTER TABLE `admin_profiles`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `guru`
--
ALTER TABLE `guru`
  MODIFY `guru_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `kelas_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `mata_pelajaran`
--
ALTER TABLE `mata_pelajaran`
  MODIFY `mapel_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `nilai_ujian`
--
ALTER TABLE `nilai_ujian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `sekolah`
--
ALTER TABLE `sekolah`
  MODIFY `sekolah_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `siswa_profiles`
--
ALTER TABLE `siswa_profiles`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `tahun_semester`
--
ALTER TABLE `tahun_semester`
  MODIFY `tahun_semester_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `ujian`
--
ALTER TABLE `ujian`
  MODIFY `ujian_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `walikelas_profiles`
--
ALTER TABLE `walikelas_profiles`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin_profiles`
--
ALTER TABLE `admin_profiles`
  ADD CONSTRAINT `admin_profiles_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `guru`
--
ALTER TABLE `guru`
  ADD CONSTRAINT `guru_ibfk_1` FOREIGN KEY (`mapel_id`) REFERENCES `mata_pelajaran` (`mapel_id`);

--
-- Constraints for table `nilai_ujian`
--
ALTER TABLE `nilai_ujian`
  ADD CONSTRAINT `nilai_ujian_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `siswa_profiles` (`user_id`),
  ADD CONSTRAINT `nilai_ujian_ibfk_2` FOREIGN KEY (`ujian_id`) REFERENCES `ujian` (`ujian_id`),
  ADD CONSTRAINT `nilai_ujian_ibfk_3` FOREIGN KEY (`mapel_id`) REFERENCES `mata_pelajaran` (`mapel_id`);

--
-- Constraints for table `siswa_profiles`
--
ALTER TABLE `siswa_profiles`
  ADD CONSTRAINT `siswa_profiles_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `siswa_profiles_ibfk_2` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`kelas_id`);

--
-- Constraints for table `ujian`
--
ALTER TABLE `ujian`
  ADD CONSTRAINT `ujian_ibfk_1` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`kelas_id`),
  ADD CONSTRAINT `ujian_ibfk_2` FOREIGN KEY (`tahun_semester_id`) REFERENCES `tahun_semester` (`tahun_semester_id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role`) REFERENCES `roles` (`role_name`);

--
-- Constraints for table `walikelas_profiles`
--
ALTER TABLE `walikelas_profiles`
  ADD CONSTRAINT `walikelas_profiles_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `walikelas_profiles_ibfk_2` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`kelas_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
