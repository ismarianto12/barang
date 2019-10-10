-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 29, 2019 at 04:16 AM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 5.6.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rn_barang`
--

-- --------------------------------------------------------

--
-- Table structure for table `rn_admin`
--

CREATE TABLE `rn_admin` (
  `id_admin` int(15) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `level` enum('admin','user','','') NOT NULL,
  `email` varchar(100) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `jk` enum('L','P') NOT NULL,
  `alamat` text NOT NULL,
  `foto` varchar(100) NOT NULL,
  `log` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `id_reset` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rn_admin`
--

INSERT INTO `rn_admin` (`id_admin`, `username`, `password`, `level`, `email`, `nama`, `jk`, `alamat`, `foto`, `log`, `id_reset`) VALUES
(1, 'admin', '202cb962ac59075b964b07152d234b70', 'admin', 'email@gmail.com', 'dasd', 'L', '', 'foto1533630109.jpg', '2018-10-30 04:00:19', ''),
(2, 'user', '202cb962ac59075b964b07152d234b70', 'user', 'user@gmail.com', 'user', 'L', '', 'foto1547279992.png', '2019-01-12 08:01:44', ''),
(3, 'user1', '202cb962ac59075b964b07152d234b70', 'user', 'user@gmail.com', 'user', 'L', '', 'foto1547280053.png', '2019-01-12 08:01:47', '');

-- --------------------------------------------------------

--
-- Table structure for table `rn_barang`
--

CREATE TABLE `rn_barang` (
  `id_barang` int(15) NOT NULL,
  `kode_barang` varchar(100) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `harga_beli` int(100) NOT NULL,
  `harga_jual` int(100) NOT NULL,
  `stok` int(15) NOT NULL,
  `satuan` varchar(100) NOT NULL,
  `id_lokasi` int(15) NOT NULL,
  `id_kategori` int(20) NOT NULL,
  `id_suplier` int(20) NOT NULL,
  `tanggal_barang` date NOT NULL,
  `id_admin` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rn_barang`
--

INSERT INTO `rn_barang` (`id_barang`, `kode_barang`, `nama_barang`, `harga_beli`, `harga_jual`, `stok`, `satuan`, `id_lokasi`, `id_kategori`, `id_suplier`, `tanggal_barang`, `id_admin`) VALUES
(7, 'dsada', 'erqweqw', 43, 33, -23, 'sadasd', 6, 1, 2, '2018-08-10', 1),
(9, '1123423', 'MSG Sulfacit', 20000, 20000, -11, 'PCS', 6, 1, 1, '2018-10-29', 1),
(10, '112342322', 'Catridge Warna', 12, 1200, 12, 'PCS', 6, 1, 1, '2018-10-30', 1),
(11, '1243141', 'Aqua Air Gelas', 120000, 100000, 12, 'PCS', 6, 1, 1, '2018-10-31', 1),
(12, '12000', 'Foil Glass', 12000, 12000, 12, 'PCS', 6, 1, 1, '2018-10-31', 1),
(13, '92024', 'asdkadsl', 9234204, 92042, 12, 'PCS', 6, 1, 0, '2019-01-12', 1),
(14, 'A-123123', 'sabun rinso', 1223131, 123131, 12, 'Lusin', 6, 1, 2, '2019-01-13', 1),
(15, 'A-2342', 'Mie Instant ', 222222, 213122, -22, 'PCS', 7, 2, 2, '2019-01-13', 1),
(16, '23', 'asda', 2132112, 123123131, 12, 'Pcs', 7, 2, 2, '2019-01-14', 1);

-- --------------------------------------------------------

--
-- Table structure for table `rn_barang_keluar`
--

CREATE TABLE `rn_barang_keluar` (
  `id_barang_keluar` int(100) NOT NULL,
  `kode_transaksi` varchar(150) NOT NULL,
  `id_barang` int(15) NOT NULL,
  `id_project` int(15) NOT NULL,
  `jumlah_keluar` int(15) NOT NULL,
  `penerima` varchar(100) NOT NULL,
  `id_admin` int(15) NOT NULL,
  `tanggal_keluar` date NOT NULL,
  `alamat_penerima` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rn_barang_keluar`
--

INSERT INTO `rn_barang_keluar` (`id_barang_keluar`, `kode_transaksi`, `id_barang`, `id_project`, `jumlah_keluar`, `penerima`, `id_admin`, `tanggal_keluar`, `alamat_penerima`) VALUES
(7, '34544', 2, 1, 2, '34', 1, '2018-08-10', 'asdaads'),
(8, '34544', 2, 1, 45, '45', 1, '2018-08-10', '45454'),
(11, 'A032990', 15, 0, 23, 'Pt Indah Kiat', 1, '2019-03-01', 'Padang'),
(12, '9234240-FE', 15, 0, 34, '34', 1, '2019-03-01', 'Padang sumatera barat ');

-- --------------------------------------------------------

--
-- Table structure for table `rn_client`
--

CREATE TABLE `rn_client` (
  `id_client` int(15) NOT NULL,
  `nama_client` varchar(100) NOT NULL,
  `perusahaan` varchar(100) NOT NULL,
  `divisi` varchar(100) NOT NULL,
  `no_telp` int(100) NOT NULL,
  `alamat` text NOT NULL,
  `tanggal_client` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `rn_kategori`
--

CREATE TABLE `rn_kategori` (
  `id_kategori` int(15) NOT NULL,
  `nama_kategori` varchar(100) NOT NULL,
  `tanggal_kategori` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rn_kategori`
--

INSERT INTO `rn_kategori` (`id_kategori`, `nama_kategori`, `tanggal_kategori`) VALUES
(2, 'Makanan', '2019-01-13'),
(4, '[removed]alert&#40;\'HACKED\'&#41;[removed]', '2019-01-14');

-- --------------------------------------------------------

--
-- Table structure for table `rn_lokasi`
--

CREATE TABLE `rn_lokasi` (
  `id_lokasi` int(15) NOT NULL,
  `nama_lokasi` varchar(100) NOT NULL,
  `gedung_utama` varchar(100) NOT NULL,
  `tanggal_lokasi` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rn_lokasi`
--

INSERT INTO `rn_lokasi` (`id_lokasi`, `nama_lokasi`, `gedung_utama`, `tanggal_lokasi`) VALUES
(7, 'Gedung satu', 'A12', '2019-01-13');

-- --------------------------------------------------------

--
-- Table structure for table `rn_purchase`
--

CREATE TABLE `rn_purchase` (
  `id_purchase` int(15) NOT NULL,
  `kode_purchase` varchar(100) NOT NULL,
  `suplier` text NOT NULL,
  `alamat_sup` text NOT NULL,
  `id_barang` int(100) NOT NULL,
  `tanggal_purchase` date NOT NULL,
  `detail` varchar(100) NOT NULL,
  `jumlah` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rn_purchase`
--

INSERT INTO `rn_purchase` (`id_purchase`, `kode_purchase`, `suplier`, `alamat_sup`, `id_barang`, `tanggal_purchase`, `detail`, `jumlah`) VALUES
(1, 'C123A', 'CV indah kiat sarana medika', 'padnag sumatrer baratr', 15, '2019-01-16', 'Pembelian untuk penambahan barang gudang', 23),
(2, 'C123A', 'CV indah kiat sarana medika', 'padnag sumatrer baratr', 16, '2019-01-16', 'Pembelian untuk penambahan barang gudang', 23),
(3, 'ACC', 'CV indah kiat sarana medika', 'padnag sumatrer baratr', 15, '2019-03-01', '23131', 12);

-- --------------------------------------------------------

--
-- Table structure for table `rn_setting`
--

CREATE TABLE `rn_setting` (
  `id_setting` int(11) NOT NULL,
  `parameter` varchar(100) NOT NULL,
  `nilai` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rn_setting`
--

INSERT INTO `rn_setting` (`id_setting`, `parameter`, `nilai`) VALUES
(1, 'nama_app', 'SISTEM INVENTORI BARANG'),
(2, 'hak_cipta', 'Ismarianto Putra'),
(3, 'alamat', 'Padang Sumatera Bart'),
(5, 'nama_perusahaan', 'PT . REKSADA DIWIRYA PADANG'),
(6, 'no_rek', '087832007790'),
(7, 'no_telp', '2323432423'),
(8, 'jalan', 'Jl.Merdeka Barat No.20 , Padang, Kuranji Sumatera Barat ,'),
(9, 'email', 'reksdiwirya@app_company.com');

-- --------------------------------------------------------

--
-- Table structure for table `rn_suplier`
--

CREATE TABLE `rn_suplier` (
  `id_suplier` int(15) NOT NULL,
  `nama_suplier` varchar(100) NOT NULL,
  `alamat_suplier` varchar(100) NOT NULL,
  `no_hp` int(100) NOT NULL,
  `no_rek` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rn_suplier`
--

INSERT INTO `rn_suplier` (`id_suplier`, `nama_suplier`, `alamat_suplier`, `no_hp`, `no_rek`) VALUES
(2, 'CV indah kiat sarana medika', 'padnag sumatrer baratr', 89458395, 2147483647);

-- --------------------------------------------------------

--
-- Table structure for table `tmp_purchase`
--

CREATE TABLE `tmp_purchase` (
  `id_barang` int(11) NOT NULL,
  `jumlah` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tmp_purchase`
--

INSERT INTO `tmp_purchase` (`id_barang`, `jumlah`) VALUES
(15, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `rn_admin`
--
ALTER TABLE `rn_admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `rn_barang`
--
ALTER TABLE `rn_barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indexes for table `rn_barang_keluar`
--
ALTER TABLE `rn_barang_keluar`
  ADD PRIMARY KEY (`id_barang_keluar`);

--
-- Indexes for table `rn_client`
--
ALTER TABLE `rn_client`
  ADD PRIMARY KEY (`id_client`),
  ADD KEY `id_client` (`id_client`);

--
-- Indexes for table `rn_kategori`
--
ALTER TABLE `rn_kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `rn_lokasi`
--
ALTER TABLE `rn_lokasi`
  ADD PRIMARY KEY (`id_lokasi`);

--
-- Indexes for table `rn_purchase`
--
ALTER TABLE `rn_purchase`
  ADD PRIMARY KEY (`id_purchase`);

--
-- Indexes for table `rn_setting`
--
ALTER TABLE `rn_setting`
  ADD PRIMARY KEY (`id_setting`);

--
-- Indexes for table `rn_suplier`
--
ALTER TABLE `rn_suplier`
  ADD PRIMARY KEY (`id_suplier`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `rn_admin`
--
ALTER TABLE `rn_admin`
  MODIFY `id_admin` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `rn_barang`
--
ALTER TABLE `rn_barang`
  MODIFY `id_barang` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `rn_barang_keluar`
--
ALTER TABLE `rn_barang_keluar`
  MODIFY `id_barang_keluar` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `rn_client`
--
ALTER TABLE `rn_client`
  MODIFY `id_client` int(15) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rn_kategori`
--
ALTER TABLE `rn_kategori`
  MODIFY `id_kategori` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `rn_lokasi`
--
ALTER TABLE `rn_lokasi`
  MODIFY `id_lokasi` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `rn_purchase`
--
ALTER TABLE `rn_purchase`
  MODIFY `id_purchase` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `rn_setting`
--
ALTER TABLE `rn_setting`
  MODIFY `id_setting` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `rn_suplier`
--
ALTER TABLE `rn_suplier`
  MODIFY `id_suplier` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
