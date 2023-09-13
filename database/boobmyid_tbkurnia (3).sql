-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 14, 2023 at 05:10 AM
-- Server version: 10.6.14-MariaDB
-- PHP Version: 8.1.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `boobmyid_tbkurnia`
--

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `idkategori` int(11) NOT NULL,
  `nama_kategori` varchar(100) NOT NULL,
  `tgl_dibuat` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`idkategori`, `nama_kategori`, `tgl_dibuat`) VALUES
(9, 'Cat tembok', '2023-05-18 02:16:53'),
(11, 'Kloset ', '2023-05-18 11:04:24'),
(12, 'Asbes', '2023-05-18 11:04:52'),
(13, 'Paralon', '2023-05-18 11:05:31'),
(14, 'Semen', '2023-05-18 11:05:56'),
(15, 'Besi', '2023-05-18 11:06:06'),
(16, 'Kalsiboard', '2023-05-18 11:06:29'),
(17, 'Bata merah', '2023-05-18 11:06:47'),
(18, 'Hebel', '2023-05-18 11:06:58'),
(19, 'Toren air', '2023-05-18 11:10:53'),
(20, 'Paku', '2023-07-27 16:59:57'),
(21, 'Bendrat', '2023-07-27 17:03:24'),
(22, 'Pasir', '2023-07-27 17:11:28'),
(23, 'Baja', '2023-07-27 17:22:01'),
(25, 'Thiner ', '2023-07-31 17:04:01'),
(26, 'kuas', '2023-07-31 17:06:50'),
(27, 'Thiner 2', '2023-08-02 19:48:31');

-- --------------------------------------------------------

--
-- Table structure for table `keranjang`
--

CREATE TABLE `keranjang` (
  `idcart` int(11) NOT NULL,
  `no_nota` varchar(100) NOT NULL,
  `idproduk` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `laporan`
--

CREATE TABLE `laporan` (
  `idlaporan` int(11) NOT NULL,
  `no_nota` varchar(50) NOT NULL,
  `idpelanggan` int(11) NOT NULL,
  `catatan` text NOT NULL,
  `totalbeli` int(11) NOT NULL,
  `pembayaran` int(11) NOT NULL,
  `kembalian` int(11) NOT NULL,
  `tgl_sub` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `diskon` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `laporan`
--

INSERT INTO `laporan` (`idlaporan`, `no_nota`, `idpelanggan`, `catatan`, `totalbeli`, `pembayaran`, `kembalian`, `tgl_sub`, `diskon`) VALUES
(102, 'AD3823337002', 13, '', 70000, 70000, 0, '2023-08-02 20:37:43', NULL),
(103, 'AD7823103003', 12, '', 40000, 100000, 60000, '2023-08-06 18:03:30', NULL),
(105, 'AD78231339004', 13, '', 70000, 100000, 30000, '2023-08-07 06:40:08', NULL),
(106, 'AD78231513901', 15, '', 76000, 80000, 4000, '2023-08-07 08:14:10', NULL),
(107, 'AD78231515391', 17, '', 219000, 219000, 0, '2023-08-07 08:15:37', NULL),
(108, 'AD78231520540', 21, '', 92000, 92000, 0, '2023-08-07 08:21:24', NULL),
(109, 'AD78232152055', 16, '', 35000, 100000, 65000, '2023-08-07 14:52:23', NULL),
(110, 'AD138231731206', 13, '', 140000, 130000, 0, '2023-08-13 10:31:49', 10000);

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id_login` int(11) NOT NULL,
  `nama_toko` varchar(20) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `telepon` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id_login`, `nama_toko`, `username`, `password`, `alamat`, `telepon`) VALUES
(1, 'Toko Bangunan Kurnia', 'fahesta', '$2y$10$3JJR4FIXA9tckFHlzdVinudhVUkGrWtq3CvtZKIwl.z1HXq0zjFOy', 'Ajibarang Kulon', '085803704920'),
(3, 'Toko Bangunan Kurnia', 'Admin_fahesta', '$2y$10$rJaat8fcy/GYgOXmVeMJ2uPEAy2UMcG1JpTyxDVU0/C3YzxCAr8ZO', 'Ajibarang Kulon rt 01/09\r\n', '082110375226'),
(4, 'Toko Bangunan Kurnia', 'Kasir_fahesta', '$2y$10$3JJR4FIXA9tckFHlzdVinudhVUkGrWtq3CvtZKIwl.z1HXq0zjFOy', '-', '234');

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `idpelanggan` int(11) NOT NULL,
  `nama_pelanggan` varchar(30) NOT NULL,
  `telepon_pelanggan` varchar(15) NOT NULL,
  `alamat_pelanggan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`idpelanggan`, `nama_pelanggan`, `telepon_pelanggan`, `alamat_pelanggan`) VALUES
(12, 'Faruq', '444 888 001', 'Purbalingga'),
(13, 'Fahes', '444 888 002', 'Wangon'),
(15, 'Edi', '-', 'Cilongok rt 01/12'),
(16, 'riki', '444888003', 'Purwokerto'),
(17, 'Sarno', '444 888 004', 'Gumelar'),
(18, 'Badri', '-', 'Paguyangan'),
(19, 'Eko', '-', 'Pekuncen'),
(20, 'Lukman', '-', 'Pandansari'),
(21, 'ibrahim', '444888006', 'ajibarang wetan rt 01/09'),
(22, 'Putra', '-', 'purwokerti barat');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `idproduk` int(11) NOT NULL,
  `idkategori` int(11) NOT NULL,
  `kode_produk` varchar(100) NOT NULL,
  `nama_produk` varchar(150) NOT NULL,
  `harga_modal` int(11) NOT NULL,
  `harga_jual` int(11) NOT NULL,
  `stock` int(11) NOT NULL,
  `tgl_input` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `satuan` varchar(100) NOT NULL,
  `detail` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`idproduk`, `idkategori`, `kode_produk`, `nama_produk`, `harga_modal`, `harga_jual`, `stock`, `tgl_input`, `satuan`, `detail`) VALUES
(12, 12, 'BRG003', 'Asbes (180) cm', 29000, 35000, 230, '2023-08-13 10:30:44', 'cm', 'Pinguin'),
(13, 12, 'BRG004', 'Asbes (210)cm', 33000, 40000, 85, '2023-08-12 17:20:59', 'cm', 'Pinguin'),
(14, 12, 'BRG005', 'Asbes (240)cm', 38000, 46000, 89, '2023-08-07 08:20:02', '', ''),
(15, 12, 'BRG006', 'Asbes (3)m', 55000, 65000, 94, '2023-08-07 08:00:11', '', ''),
(16, 17, 'BRG007', 'Bata merah/biji', 450, 600, 2000, '2023-08-07 14:38:23', '', ''),
(17, 15, 'BRG008', 'Besi (8)mm', 42000, 50000, 100, '2023-05-18 11:18:24', '', ''),
(18, 15, 'BRG009', 'Besi (6) mm', 27000, 35000, 98, '2023-07-30 06:54:00', '', ''),
(19, 15, 'BRG010', 'Besi (10) mm', 67000, 77000, 100, '2023-05-18 11:19:42', '', ''),
(23, 18, 'BRG011', 'Hebel', 550000, 650000, 100, '2023-07-11 12:51:06', '', ''),
(24, 19, 'BRG012', 'Torn Pwnguin 500 Liter', 970000, 1100000, 98, '2023-07-27 16:19:17', '', ''),
(25, 13, 'BRG013', 'Paralon Rucika 1/2 inch', 23000, 28500, 100, '2023-07-11 12:57:05', '', ''),
(26, 11, 'BRG014', 'Kloset ina', 200000, 250000, 100, '2023-07-11 12:57:47', '', ''),
(27, 13, 'BRG015', 'Paralon rucika 3/4 inch', 28000, 35000, 98, '2023-07-27 16:22:23', '', ''),
(28, 9, 'BRG016', 'cat avian 1 kg', 68000, 73000, 197, '2023-08-07 08:15:19', '', ''),
(29, 9, 'BRG017', 'cat avitex', 130000, 140000, 200, '2023-08-07 14:19:37', '', ''),
(30, 20, 'BRG018', 'Paku 1/2 kg', 6500, 10000, 100, '2023-07-27 17:01:54', '', ''),
(31, 20, 'BRG019', 'paku 1 kg', 12500, 17000, 100, '2023-08-08 10:18:01', '', ''),
(32, 21, 'BRG020', 'Bendrat', 15000, 17000, 200, '2023-07-27 17:04:08', '', ''),
(33, 22, 'BRG021', 'pasir 1 rit', 200000, 300000, 50, '2023-07-27 17:15:44', '', ''),
(34, 23, 'BRG022', 'Baja Ringan 1.00 mm', 166000, 190000, 200, '2023-07-27 17:23:13', '', ''),
(35, 23, 'BRG023', 'Baja ringan 0.75mm', 100000, 120000, 200, '2023-07-27 17:24:12', '', ''),
(36, 25, 'BRG024', 'Thiner 1 Lt', 34500, 38000, 200, '2023-07-31 17:04:56', '', ''),
(37, 26, 'BRG025', 'Kuas kecil', 1250, 3000, 202, '2023-08-07 08:13:21', '', ''),
(38, 12, 'BRG026', 'kuas besar', 2500, 6000, 400, '2023-08-07 08:25:35', '', ''),
(41, 14, 'BRG027', 'Semen Merah Putih', 65000, 70000, 0, '2023-08-07 18:32:49', 'cm', 'Bima'),
(42, 12, 'BRG028', 'Asbes 280', 45000, 50000, 0, '2023-08-09 03:06:51', 'cm', 'Pinguiin'),
(43, 23, 'BRG029', 'bbbb', 9999, 999999, 307, '2023-08-09 03:35:04', 'cm', 'mjnknlnl');

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `id_stock` int(11) NOT NULL,
  `idproduk` int(11) NOT NULL,
  `jumlah_stock` int(11) NOT NULL,
  `tanggal_stock` timestamp NOT NULL DEFAULT current_timestamp(),
  `status_stock` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`id_stock`, `idproduk`, `jumlah_stock`, `tanggal_stock`, `status_stock`) VALUES
(16, 12, 88, '2023-08-02 20:25:08', 1),
(17, 13, 86, '2023-08-02 20:25:08', 1),
(19, 12, 100, '2023-08-02 20:35:11', 1),
(20, 12, 5, '2023-08-02 20:35:47', 2),
(21, 12, 50, '2023-08-02 20:36:05', 1),
(22, 13, 2, '2023-08-02 20:36:35', 2),
(24, 12, 2, '2023-08-02 20:37:30', 2),
(25, 14, 91, '2023-08-02 20:42:03', 1),
(26, 15, 93, '2023-08-02 20:42:03', 1),
(27, 16, 1999, '2023-08-02 20:42:03', 1),
(28, 17, 100, '2023-08-02 20:42:03', 1),
(33, 18, 98, '2023-08-02 20:42:44', 1),
(34, 19, 100, '2023-08-02 20:42:44', 1),
(35, 23, 100, '2023-08-02 20:42:44', 1),
(36, 24, 98, '2023-08-02 20:42:44', 1),
(37, 25, 100, '2023-08-02 20:42:44', 1),
(38, 26, 100, '2023-08-02 20:42:44', 1),
(39, 27, 98, '2023-08-02 20:42:44', 1),
(40, 28, 200, '2023-08-02 20:42:44', 1),
(41, 29, 200, '2023-08-02 20:42:44', 1),
(42, 30, 100, '2023-08-02 20:42:44', 1),
(43, 31, 100, '2023-08-02 20:42:44', 1),
(44, 32, 200, '2023-08-02 20:42:44', 1),
(45, 33, 50, '2023-08-02 20:42:44', 1),
(46, 34, 200, '2023-08-02 20:42:44', 1),
(47, 35, 200, '2023-08-02 20:42:44', 1),
(48, 36, 200, '2023-08-02 20:42:44', 1),
(50, 38, 200, '2023-08-02 20:42:44', 1),
(54, 12, 5, '2023-08-02 20:59:09', 1),
(61, 12, 2, '2023-08-07 06:39:35', 2),
(62, 15, 1, '2023-08-07 08:00:11', 1),
(63, 12, 2, '2023-08-07 08:12:38', 2),
(66, 12, 1, '2023-08-07 08:14:30', 1),
(67, 12, 1, '2023-08-07 08:14:54', 1),
(68, 28, 3, '2023-08-07 08:15:19', 2),
(69, 14, 2, '2023-08-07 08:20:02', 2),
(71, 38, 200, '2023-08-07 08:25:35', 1),
(72, 16, 1, '2023-08-07 14:38:23', 1),
(73, 37, 202, '2023-08-07 14:48:02', 1),
(74, 40, 0, '2023-08-07 14:48:26', 1),
(75, 12, 1, '2023-08-07 14:52:14', 2),
(76, 41, 0, '2023-08-07 18:14:58', 1),
(78, 42, 0, '2023-08-09 03:06:51', 1),
(79, 43, 0, '2023-08-09 03:31:50', 1),
(80, 43, 99, '2023-08-09 03:33:03', 1),
(81, 43, 99, '2023-08-09 03:33:04', 1),
(82, 43, 99, '2023-08-09 03:33:04', 1),
(83, 43, 9, '2023-08-09 03:33:46', 1),
(84, 12, 1, '2023-08-09 03:34:46', 1),
(85, 43, 1, '2023-08-09 03:35:04', 1),
(89, 12, 4, '2023-08-13 10:30:44', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tabungan`
--

CREATE TABLE `tabungan` (
  `id` int(10) NOT NULL,
  `notransaksi` varchar(30) NOT NULL,
  `tgltransaksi` datetime NOT NULL DEFAULT current_timestamp(),
  `idpelanggan` int(11) NOT NULL,
  `total` double NOT NULL,
  `catatan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tabungan`
--

INSERT INTO `tabungan` (`id`, `notransaksi`, `tgltransaksi`, `idpelanggan`, `total`, `catatan`) VALUES
(11, 'TB58231426003', '2023-08-05 14:26:23', 13, 50000, '-'),
(13, 'AD78231057004', '2023-08-07 10:58:35', 12, 30000, 'Kembalian');

-- --------------------------------------------------------

--
-- Table structure for table `tb_nota`
--

CREATE TABLE `tb_nota` (
  `idnota` int(11) NOT NULL,
  `no_nota` varchar(100) NOT NULL,
  `idproduk` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_nota`
--

INSERT INTO `tb_nota` (`idnota`, `no_nota`, `idproduk`, `quantity`) VALUES
(131, 'AD3823337002', 12, 2),
(132, 'AD7823103003', 13, 1),
(134, 'AD78231339004', 12, 2),
(135, 'AD78231513901', 12, 2),
(136, 'AD78231513901', 37, 2),
(138, 'AD78231515391', 28, 3),
(139, 'AD78231520540', 14, 2),
(140, 'AD78232152055', 12, 1),
(141, 'AD138231731206', 12, 4);

-- --------------------------------------------------------

--
-- Table structure for table `tb_satuan`
--

CREATE TABLE `tb_satuan` (
  `idsatuan` int(11) NOT NULL,
  `satuan` varchar(155) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tb_satuan`
--

INSERT INTO `tb_satuan` (`idsatuan`, `satuan`) VALUES
(1, 'Kg'),
(2, 'Lbr'),
(3, 'cm'),
(5, 'liter'),
(7, 'Rim'),
(8, 'kg'),
(9, 'mm');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`idkategori`);

--
-- Indexes for table `keranjang`
--
ALTER TABLE `keranjang`
  ADD PRIMARY KEY (`idcart`);

--
-- Indexes for table `laporan`
--
ALTER TABLE `laporan`
  ADD PRIMARY KEY (`idlaporan`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id_login`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`idpelanggan`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`idproduk`);

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`id_stock`);

--
-- Indexes for table `tabungan`
--
ALTER TABLE `tabungan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_nota`
--
ALTER TABLE `tb_nota`
  ADD PRIMARY KEY (`idnota`);

--
-- Indexes for table `tb_satuan`
--
ALTER TABLE `tb_satuan`
  ADD PRIMARY KEY (`idsatuan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `idkategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `keranjang`
--
ALTER TABLE `keranjang`
  MODIFY `idcart` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `laporan`
--
ALTER TABLE `laporan`
  MODIFY `idlaporan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id_login` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `idpelanggan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `idproduk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `id_stock` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT for table `tabungan`
--
ALTER TABLE `tabungan`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tb_nota`
--
ALTER TABLE `tb_nota`
  MODIFY `idnota` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=142;

--
-- AUTO_INCREMENT for table `tb_satuan`
--
ALTER TABLE `tb_satuan`
  MODIFY `idsatuan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
