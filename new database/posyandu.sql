-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 01, 2022 at 06:41 AM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 7.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `posyandu`
--

-- --------------------------------------------------------

--
-- Table structure for table `anak`
--

CREATE TABLE `anak` (
  `id_anak` int(11) NOT NULL,
  `nik_anak` varchar(16) NOT NULL,
  `nama_anak` varchar(50) NOT NULL,
  `tempat_lahir` varchar(30) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `jenis_kelamin` enum('Laki-Laki','Perempuan') NOT NULL,
  `ibu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `anak`
--

INSERT INTO `anak` (`id_anak`, `nik_anak`, `nama_anak`, `tempat_lahir`, `tgl_lahir`, `jenis_kelamin`, `ibu_id`) VALUES
(13, '23423423________', 'sasuke', 'marelan', '2022-08-03', 'Laki-Laki', 3),
(14, '34334343________', 'dfdfdfdf', 'sdfdfdsf', '2022-08-06', 'Laki-Laki', 2),
(15, '3543534534534___', 'james bond', 'amerika serikat', '2022-08-05', 'Laki-Laki', 2),
(16, '123456789_______', 'Arianto', 'Marelan Pasar 2', '1994-08-28', 'Laki-Laki', 4),
(17, '123234567891____', 'Helmi', 'Marelan Pasar 3', '1998-06-12', 'Laki-Laki', 4);

-- --------------------------------------------------------

--
-- Table structure for table `bidan`
--

CREATE TABLE `bidan` (
  `id_bidan` int(11) NOT NULL,
  `nama_bidan` varchar(50) NOT NULL,
  `tempat_lahir` varchar(30) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `no_hp` varchar(13) NOT NULL,
  `pendidikan_terakhir` varchar(30) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bidan`
--

INSERT INTO `bidan` (`id_bidan`, `nama_bidan`, `tempat_lahir`, `tanggal_lahir`, `no_hp`, `pendidikan_terakhir`, `user_id`) VALUES
(2, 'Halimah', 'medan', '2022-08-08', '0977-7766-544', 'sda', 2),
(3, 'nuraida', 'binjai', '2022-08-03', '0945-8458-364', 'S2', 1),
(4, 'Suhesi', 'Lombok', '1986-09-12', '0834-5943-594', 'D3', 9);

-- --------------------------------------------------------

--
-- Table structure for table `ibu`
--

CREATE TABLE `ibu` (
  `id_ibu` int(11) NOT NULL,
  `nama_ibu` varchar(50) NOT NULL,
  `tempat_lahir` varchar(30) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `gol_dar` varchar(2) NOT NULL,
  `pendidikan` varchar(200) NOT NULL,
  `pekerjaan` varchar(30) NOT NULL,
  `nama_suami` varchar(50) NOT NULL,
  `tempat_lahir_suami` varchar(30) NOT NULL,
  `tgl_lahir_suami` date NOT NULL,
  `pendidikan_suami` varchar(200) NOT NULL,
  `pekerjaan_suami` varchar(30) NOT NULL,
  `alamat` text NOT NULL,
  `kecamatan` varchar(30) NOT NULL,
  `kota` varchar(30) NOT NULL,
  `no_tlp` varchar(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ibu`
--

INSERT INTO `ibu` (`id_ibu`, `nama_ibu`, `tempat_lahir`, `tgl_lahir`, `gol_dar`, `pendidikan`, `pekerjaan`, `nama_suami`, `tempat_lahir_suami`, `tgl_lahir_suami`, `pendidikan_suami`, `pekerjaan_suami`, `alamat`, `kecamatan`, `kota`, `no_tlp`) VALUES
(2, 'Linda3', 'Karawang', '1987-09-20', 'S', 's1', 'Ibu Rumah Tangga', 'Waluyu Santoso', 'Blora', '1985-03-08', 'SMK', 'Karyawan Swasta', 'Jl. Sukapura Jaya RT 04/010', 'Cilincing', 'Jakarta Utara', '0822-7402-739'),
(3, 'Faridah Hanum', 'marelan', '2022-08-06', 'B', 'smp', 'rumah tangga', 'dahrul', 'medan', '2022-08-31', 'SD', 'Ahli Strategi', 'medan, belawan hamparan perak Jl.Desa Lama Dusun 2, medan, belawan hamparan perak Jl.Desa Lama Dusun 2', 'hamparan perak', 'belawan', '0822-7402-739'),
(4, 'Siti Aisyah', 'Medan', '1986-08-20', 'O', 'D3', 'Rumah tangga', 'Akbar Hanavi', 'Jakarta', '1984-07-20', 'S1', 'PNS', 'Marelan', 'Hamparan Perak', 'Medan', '0852-9673-123');

-- --------------------------------------------------------

--
-- Table structure for table `imunisasi`
--

CREATE TABLE `imunisasi` (
  `id_imunisasi` int(11) NOT NULL,
  `anak_id` int(11) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `jenis_kelamin` enum('Laki-Laki','Perempuan') NOT NULL,
  `ibu_id` int(11) NOT NULL,
  `tgl_skrng` date NOT NULL,
  `usia` int(11) NOT NULL,
  `imunisasi` varchar(30) NOT NULL,
  `vit_a` enum('Merah','Biru') NOT NULL,
  `ket` text NOT NULL,
  `created_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `imunisasi`
--

INSERT INTO `imunisasi` (`id_imunisasi`, `anak_id`, `tgl_lahir`, `jenis_kelamin`, `ibu_id`, `tgl_skrng`, `usia`, `imunisasi`, `vit_a`, `ket`, `created_by`) VALUES
(1, 1, '2012-06-06', 'Perempuan', 2, '2019-02-12', 84, 'flu', 'Merah', '', 0),
(3, 1, '2012-06-06', 'Perempuan', 2, '2021-02-12', 108, 'flu', 'Merah', '', 0),
(4, 15, '2022-08-05', 'Laki-Laki', 2, '2022-08-14', 4, 'Demam Berdarah', 'Merah', 'penyakit yang sangat hebat dan kronis', 1),
(6, 13, '2022-08-03', 'Laki-Laki', 3, '2022-08-14', 3, 'Demam Berdarah', 'Biru', 'karena penyakit clan uchiha', 1),
(7, 14, '2022-08-06', 'Laki-Laki', 2, '2022-08-17', 4, 'Demam Berdarah', 'Biru', 'dfdfdf', 1),
(8, 14, '2022-08-06', 'Laki-Laki', 2, '0000-00-00', 0, '', 'Merah', '', 1),
(9, 16, '1994-08-28', 'Laki-Laki', 4, '2022-08-15', 7, 'Demam Berdarah', 'Merah', 'Sangat Buruk Sekali', 9);

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

CREATE TABLE `login_attempts` (
  `user_id` int(11) NOT NULL,
  `date_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login_attempts`
--

INSERT INTO `login_attempts` (`user_id`, `date_time`) VALUES
(1, '2021-01-30 10:23:29'),
(1, '2021-01-30 10:34:46'),
(1, '2021-01-30 10:43:56'),
(1, '2021-01-31 02:28:21'),
(1, '2021-01-31 03:22:35'),
(1, '2021-01-31 09:10:44'),
(1, '2021-01-31 09:26:10'),
(1, '2021-01-31 09:29:54'),
(1, '2021-01-31 09:30:32'),
(1, '2021-02-03 01:44:40'),
(1, '2021-02-05 07:31:28'),
(2, '2021-02-07 11:30:13'),
(1, '2021-02-07 12:51:05'),
(2, '2021-02-07 01:55:44'),
(1, '2021-02-07 01:56:42'),
(1, '2021-02-07 02:20:01'),
(2, '2021-02-07 02:26:00'),
(2, '2021-02-07 05:10:55'),
(1, '2021-02-07 05:12:08'),
(2, '2021-02-07 05:20:27'),
(1, '2021-02-07 05:21:00'),
(1, '2021-02-07 08:28:31'),
(1, '2021-02-07 09:37:56'),
(1, '2021-02-11 03:17:12'),
(1, '2021-02-11 03:21:59'),
(1, '2021-02-11 09:34:17'),
(1, '2021-02-11 09:50:11'),
(1, '2021-02-12 07:32:48'),
(1, '2021-02-12 10:15:28'),
(1, '2021-02-12 10:44:02'),
(1, '2022-08-14 01:07:07'),
(1, '2022-08-14 02:28:11'),
(1, '2022-08-14 02:33:31'),
(2, '2022-08-14 05:29:47'),
(1, '2022-08-14 05:30:08'),
(2, '2022-08-14 06:49:13'),
(1, '2022-08-14 07:02:59'),
(8, '2022-08-14 07:42:09'),
(1, '2022-08-14 08:08:27'),
(1, '2022-08-14 07:21:05'),
(9, '2022-08-14 07:23:03'),
(9, '2022-08-15 07:46:49'),
(9, '2022-08-15 07:50:37'),
(1, '2022-08-20 06:05:34'),
(1, '2022-09-21 07:12:27'),
(1, '2022-09-23 07:12:18'),
(1, '2022-10-01 11:40:20');

-- --------------------------------------------------------

--
-- Table structure for table `penimbangan`
--

CREATE TABLE `penimbangan` (
  `id_penimbangan` int(11) NOT NULL,
  `anak_id` int(11) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `jenis_kelamin` enum('Laki-Laki','Perempuan') NOT NULL,
  `ibu_id` int(11) NOT NULL,
  `tgl_skrng` date NOT NULL,
  `usia` int(11) NOT NULL,
  `bb` double NOT NULL,
  `tb` double NOT NULL,
  `deteksi` enum('Sesuai','Tidak Sesuai') NOT NULL,
  `ket` text NOT NULL,
  `created_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penimbangan`
--

INSERT INTO `penimbangan` (`id_penimbangan`, `anak_id`, `tgl_lahir`, `jenis_kelamin`, `ibu_id`, `tgl_skrng`, `usia`, `bb`, `tb`, `deteksi`, `ket`, `created_by`) VALUES
(1, 1, '2012-06-06', 'Perempuan', 2, '2021-02-05', 106, 4, 4, 'Sesuai', '', 0),
(3, 1, '2012-06-06', 'Perempuan', 2, '2019-01-11', 84, -4, 5, 'Sesuai', '', 0),
(4, 1, '2012-06-06', 'Perempuan', 2, '2019-01-11', 84, -4, 5, 'Sesuai', '', 0),
(5, 1, '2012-06-06', 'Perempuan', 2, '2021-02-12', 108, 9.5, 64, 'Sesuai', '', 0),
(6, 13, '2022-08-03', 'Laki-Laki', 3, '2022-08-14', 5, 3, 123, 'Sesuai', 'ini sangat buruk', 1),
(8, 15, '2022-08-05', 'Laki-Laki', 2, '2022-08-14', 2, 23, 123, 'Sesuai', 'mantul', 1),
(9, 16, '1994-08-28', 'Laki-Laki', 4, '2022-08-15', 7, 3, 40, 'Sesuai', 'Sudah di rehabilitas', 9);

-- --------------------------------------------------------

--
-- Table structure for table `petugas`
--

CREATE TABLE `petugas` (
  `id_petugas` int(11) NOT NULL,
  `nama_petugas` varchar(50) NOT NULL,
  `tempat_lahir` varchar(30) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `no_hp` varchar(13) NOT NULL,
  `jabatan` enum('Ketua','Bendahara','Sekretaris','Anggota') NOT NULL,
  `pendidikan_terakhir` varchar(30) NOT NULL,
  `lama_kerja` int(11) NOT NULL,
  `tugas_pokok` text NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `petugas`
--

INSERT INTO `petugas` (`id_petugas`, `nama_petugas`, `tempat_lahir`, `tgl_lahir`, `no_hp`, `jabatan`, `pendidikan_terakhir`, `lama_kerja`, `tugas_pokok`, `user_id`) VALUES
(2, 'bayu', 'marelan', '2022-08-20', '0852-9735-267', 'Bendahara', 'SMA', 2, 'jaga harimau', 1),
(3, 'joko', 'medan', '2022-08-25', '3434-3434-343', 'Ketua', 'S1', 5, 'mencabut bulu dada', 1),
(4, 'Samsudin', 'Jakarta', '1988-12-15', '0852-8171-927', 'Anggota', 'D3', 5, 'KDR', 9);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_users` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level_id` int(11) NOT NULL,
  `is_active` int(1) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_users`, `name`, `username`, `image`, `password`, `level_id`, `is_active`, `date_created`) VALUES
(1, 'Putri Nugraheni', 'punug', '279917011_1011922383046582_1453912302309680637_n.jpg', 'qwerty', 1, 1, 0),
(2, 'Lutfiana', 'fia', 'icon-02.png', 'qwerty', 1, 1, 111),
(8, 'bayu setiawan', 'bayus90', '', '123456', 1, 1, 1660437715),
(9, 'Bayu Setiawan', 'm90', 'pexels-engin-akyurt-2098602.jpg', '123456', 1, 1, 1660479768);

-- --------------------------------------------------------

--
-- Table structure for table `users_level`
--

CREATE TABLE `users_level` (
  `id_level` int(11) NOT NULL,
  `level` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_level`
--

INSERT INTO `users_level` (`id_level`, `level`) VALUES
(1, 'Petugas'),
(2, 'Bidan'),
(3, 'Ibu');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `anak`
--
ALTER TABLE `anak`
  ADD PRIMARY KEY (`id_anak`);

--
-- Indexes for table `bidan`
--
ALTER TABLE `bidan`
  ADD PRIMARY KEY (`id_bidan`);

--
-- Indexes for table `ibu`
--
ALTER TABLE `ibu`
  ADD PRIMARY KEY (`id_ibu`);

--
-- Indexes for table `imunisasi`
--
ALTER TABLE `imunisasi`
  ADD PRIMARY KEY (`id_imunisasi`);

--
-- Indexes for table `penimbangan`
--
ALTER TABLE `penimbangan`
  ADD PRIMARY KEY (`id_penimbangan`);

--
-- Indexes for table `petugas`
--
ALTER TABLE `petugas`
  ADD PRIMARY KEY (`id_petugas`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_users`);

--
-- Indexes for table `users_level`
--
ALTER TABLE `users_level`
  ADD PRIMARY KEY (`id_level`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `anak`
--
ALTER TABLE `anak`
  MODIFY `id_anak` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `bidan`
--
ALTER TABLE `bidan`
  MODIFY `id_bidan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `ibu`
--
ALTER TABLE `ibu`
  MODIFY `id_ibu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `imunisasi`
--
ALTER TABLE `imunisasi`
  MODIFY `id_imunisasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `penimbangan`
--
ALTER TABLE `penimbangan`
  MODIFY `id_penimbangan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `petugas`
--
ALTER TABLE `petugas`
  MODIFY `id_petugas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_users` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `users_level`
--
ALTER TABLE `users_level`
  MODIFY `id_level` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
