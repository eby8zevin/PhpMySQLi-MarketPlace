-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 09, 2020 at 05:03 PM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `uas`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `username`, `password`, `nama_lengkap`) VALUES
(1, 'admin', 'admin', 'Ahmad Abu Hasan');

-- --------------------------------------------------------

--
-- Table structure for table `ongkir`
--

CREATE TABLE `ongkir` (
  `id_ongkir` int(11) NOT NULL,
  `nama_kota` varchar(100) NOT NULL,
  `tarif` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ongkir`
--

INSERT INTO `ongkir` (`id_ongkir`, `nama_kota`, `tarif`) VALUES
(1, 'Bandung', 50000),
(2, 'Semarang', 75000),
(3, 'Surabaya', 100000);

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_pelanggan` int(11) NOT NULL,
  `nama_pelanggan` varchar(100) NOT NULL,
  `email_pelanggan` varchar(100) NOT NULL,
  `hp_pelanggan` varchar(25) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(50) NOT NULL,
  `alamat_pelanggan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `nama_pelanggan`, `email_pelanggan`, `hp_pelanggan`, `username`, `password`, `alamat_pelanggan`) VALUES
(1, 'Ahmad Abu Hasan', 'ahmadabuhasan@mhs.stmik-yadika.ac.id', '08123456789', 'user', 'user', ''),
(2, 'Cristiano Ronaldo', 'cristianoronaldo@gmail.com', '08987654321', 'user1', 'user1', ''),
(3, 'Lionel Messi', 'lionelmessi@gmail.com', '08123456789', 'user2', 'user2', '');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_pembayaran` int(11) NOT NULL,
  `id_pembelian` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `bank` varchar(50) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `bukti` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id_pembayaran`, `id_pembelian`, `nama`, `bank`, `jumlah`, `tanggal`, `bukti`) VALUES
(1, 1, 'Ahmad Abu Hasan', 'BCA', 900000, '2020-01-01', '20200101175345kecebong.png'),
(2, 2, 'Ahmad Abu Hasan', 'BNI', 975000, '2020-01-01', '20200101175421kecebong.png'),
(3, 3, 'Ahmad Abu Hasan', 'Mandiri', 390000, '2020-01-01', '20200101175455kecebong.png'),
(4, 8, 'Cristiano Ronaldo', 'BCA', 730000, '2020-01-02', '20200102170937kecebong.png'),
(5, 7, 'Cristiano Ronaldo', 'BNI', 440000, '2020-01-02', '20200102171000kecebong.png'),
(6, 6, 'Cristiano Ronaldo', 'Mandiri', 975000, '2020-01-02', '20200102171018kecebong.png'),
(7, 9, 'Lionel Messi', 'BCA', 200000, '2020-01-05', '20200105053428kecebong.png'),
(8, 10, 'Lionel Messi', 'BNI', 165000, '2020-01-05', '20200105053450kecebong.png'),
(9, 11, 'Lionel Messi', 'Mandiri', 130000, '2020-01-05', '20200105053514kecebong.png');

-- --------------------------------------------------------

--
-- Table structure for table `pembelian`
--

CREATE TABLE `pembelian` (
  `id_pembelian` int(11) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `id_ongkir` int(11) NOT NULL,
  `tanggal_pembelian` date NOT NULL,
  `total_pembelian` int(11) NOT NULL,
  `nama_kota` varchar(100) NOT NULL,
  `tarif` int(11) NOT NULL,
  `alamat_pengiriman` text NOT NULL,
  `status_pembelian` varchar(100) NOT NULL DEFAULT 'Menunggu Pembayaran',
  `resi_pengiriman` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pembelian`
--

INSERT INTO `pembelian` (`id_pembelian`, `id_pelanggan`, `id_ongkir`, `tanggal_pembelian`, `total_pembelian`, `nama_kota`, `tarif`, `alamat_pengiriman`, `status_pembelian`, `resi_pengiriman`) VALUES
(1, 1, 3, '2020-01-01', 900000, 'Surabaya', 100000, 'Jl. Pahlawan No.110, Kel. Alun-alun Contong, Kec. Bubutan, Kota Surabaya, Jawa Timur 60175', 'Transaksi Selesai', '12345678910'),
(2, 1, 2, '2020-01-01', 975000, 'Semarang', 75000, 'Jl. Pahlawan No.9, Kel. Mugassari, Kec. Semarang Selatan, Kota Semarang, Jawa Tengah 50249', 'Barang Dikirim', '10987654321'),
(3, 1, 1, '2020-01-01', 390000, 'Bandung', 50000, 'Jl. Diponegoro No. 22, Kel. Citarum, Kec. Bandung Wetan, Kota Bandung, Jawa Barat 40115', 'Dibayar', ''),
(4, 1, 3, '2020-01-01', 780000, 'Surabaya', 100000, 'Jl. Pahlawan No.110, Kel. Alun-alun Contong, Kec. Bubutan, Kota Surabaya, Jawa Timur 60175', 'Menunggu Pembayaran', ''),
(5, 2, 1, '2020-01-02', 850000, 'Bandung', 50000, 'Jl. Diponegoro No. 22, Kel. Citarum, Kec. Bandung Wetan, Kota Bandung, Jawa Barat 40115', 'Menunggu Pembayaran', ''),
(6, 2, 2, '2020-01-02', 975000, 'Semarang', 75000, 'Jl. Pahlawan No.9, Kel. Mugassari, Kec. Semarang Selatan, Kota Semarang, Jawa Tengah 50249', 'Dibayar', ''),
(7, 2, 3, '2020-01-02', 440000, 'Surabaya', 100000, 'Jl. Pahlawan No.110, Kel. Alun-alun Contong, Kec. Bubutan, Kota Surabaya, Jawa Timur 60175', 'Barang Dikirim', '10987654321'),
(8, 2, 1, '2020-01-02', 730000, 'Bandung', 50000, 'Jl. Diponegoro No. 22, Kel. Citarum, Kec. Bandung Wetan, Kota Bandung, Jawa Barat 40115', 'Transaksi Selesai', '12345678910'),
(9, 3, 3, '2020-01-05', 200000, 'Surabaya', 100000, 'Jl. Pahlawan No.110, Kel. Alun-alun Contong, Kec. Bubutan, Kota Surabaya, Jawa Timur 60175', 'Transaksi Selesai', '12345678910'),
(10, 3, 2, '2020-01-05', 165000, 'Semarang', 75000, 'Jl. Pahlawan No.9, Kel. Mugassari, Kec. Semarang Selatan, Kota Semarang, Jawa Tengah 50249', 'Barang Dikirim', '10987654321'),
(11, 3, 1, '2020-01-05', 130000, 'Bandung', 50000, 'Jl. Diponegoro No. 22, Kel. Citarum, Kec. Bandung Wetan, Kota Bandung, Jawa Barat 40115', 'Dibayar', ''),
(12, 3, 3, '2020-01-05', 170000, 'Surabaya', 100000, 'Jl. Pahlawan No.110, Kel. Alun-alun Contong, Kec. Bubutan, Kota Surabaya, Jawa Timur 60175', 'Menunggu Pembayaran', '');

-- --------------------------------------------------------

--
-- Table structure for table `pembelian_produk`
--

CREATE TABLE `pembelian_produk` (
  `id_pembelian_produk` int(11) NOT NULL,
  `id_pembelian` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `harga` int(11) NOT NULL,
  `subharga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pembelian_produk`
--

INSERT INTO `pembelian_produk` (`id_pembelian_produk`, `id_pembelian`, `id_produk`, `jumlah`, `nama`, `harga`, `subharga`) VALUES
(1, 1, 1, 1, 'Boneka Bantal BLACKPINK Lisa', 100000, 100000),
(2, 1, 2, 2, 'Boneka Bantal BLACKPINK Rose', 90000, 180000),
(3, 1, 3, 3, 'Boneka Bantal BLACKPINK Jennie', 80000, 240000),
(4, 1, 4, 4, 'Boneka Bantal BLACKPINK Jisoo', 70000, 280000),
(5, 2, 1, 4, 'Boneka Bantal BLACKPINK Lisa', 100000, 400000),
(6, 2, 2, 3, 'Boneka Bantal BLACKPINK Rose', 90000, 270000),
(7, 2, 3, 2, 'Boneka Bantal BLACKPINK Jennie', 80000, 160000),
(8, 2, 4, 1, 'Boneka Bantal BLACKPINK Jisoo', 70000, 70000),
(9, 3, 1, 1, 'Boneka Bantal BLACKPINK Lisa', 100000, 100000),
(10, 3, 2, 1, 'Boneka Bantal BLACKPINK Rose', 90000, 90000),
(11, 3, 3, 1, 'Boneka Bantal BLACKPINK Jennie', 80000, 80000),
(12, 3, 4, 1, 'Boneka Bantal BLACKPINK Jisoo', 70000, 70000),
(13, 4, 1, 2, 'Boneka Bantal BLACKPINK Lisa', 100000, 200000),
(14, 4, 2, 2, 'Boneka Bantal BLACKPINK Rose', 90000, 180000),
(15, 4, 3, 2, 'Boneka Bantal BLACKPINK Jennie', 80000, 160000),
(16, 4, 4, 2, 'Boneka Bantal BLACKPINK Jisoo', 70000, 140000),
(17, 5, 1, 1, 'Boneka Bantal BLACKPINK Lisa', 100000, 100000),
(18, 5, 2, 2, 'Boneka Bantal BLACKPINK Rose', 90000, 180000),
(19, 5, 3, 3, 'Boneka Bantal BLACKPINK Jennie', 80000, 240000),
(20, 5, 4, 4, 'Boneka Bantal BLACKPINK Jisoo', 70000, 280000),
(21, 6, 1, 4, 'Boneka Bantal BLACKPINK Lisa', 100000, 400000),
(22, 6, 2, 3, 'Boneka Bantal BLACKPINK Rose', 90000, 270000),
(23, 6, 3, 2, 'Boneka Bantal BLACKPINK Jennie', 80000, 160000),
(24, 6, 4, 1, 'Boneka Bantal BLACKPINK Jisoo', 70000, 70000),
(25, 7, 1, 1, 'Boneka Bantal BLACKPINK Lisa', 100000, 100000),
(26, 7, 2, 1, 'Boneka Bantal BLACKPINK Rose', 90000, 90000),
(27, 7, 3, 1, 'Boneka Bantal BLACKPINK Jennie', 80000, 80000),
(28, 7, 4, 1, 'Boneka Bantal BLACKPINK Jisoo', 70000, 70000),
(29, 8, 1, 2, 'Boneka Bantal BLACKPINK Lisa', 100000, 200000),
(30, 8, 2, 2, 'Boneka Bantal BLACKPINK Rose', 90000, 180000),
(31, 8, 3, 2, 'Boneka Bantal BLACKPINK Jennie', 80000, 160000),
(32, 8, 4, 2, 'Boneka Bantal BLACKPINK Jisoo', 70000, 140000),
(33, 9, 1, 1, 'Boneka Bantal BLACKPINK Lisa', 100000, 100000),
(34, 10, 2, 1, 'Boneka Bantal BLACKPINK Rose', 90000, 90000),
(35, 11, 3, 1, 'Boneka Bantal BLACKPINK Jennie', 80000, 80000),
(36, 12, 4, 1, 'Boneka Bantal BLACKPINK Jisoo', 70000, 70000);

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(11) NOT NULL,
  `nama_produk` varchar(100) NOT NULL,
  `harga_produk` int(11) NOT NULL,
  `foto_produk` varchar(100) NOT NULL,
  `deskripsi_produk` text NOT NULL,
  `stok_produk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id_produk`, `nama_produk`, `harga_produk`, `foto_produk`, `deskripsi_produk`, `stok_produk`) VALUES
(1, 'Boneka Bantal BLACKPINK Lisa', 100000, 'lisa.jpeg', 'Blackpink in Your Area <br>\r\nBlinks <br>\r\nMaterial Velboa <br>\r\nIsi Dacron <br>\r\nSize : 30cm x 35cm', 33),
(2, 'Boneka Bantal BLACKPINK Rose', 90000, 'rose.jpeg', 'Blackpink in Your Area <br>\r\nBlinks <br>\r\nMaterial Velboa <br>\r\nIsi Dacron <br>\r\nSize : 30cm x 35cm', 33),
(3, 'Boneka Bantal BLACKPINK Jennie', 80000, 'jennie.jpeg', 'Blackpink in Your Area <br>\r\nBlinks <br>\r\nMaterial Velboa <br>\r\nIsi Dacron <br>\r\nSize : 30cm x 35cm', 33),
(4, 'Boneka Bantal BLACKPINK Jisoo', 70000, 'jisoo.jpeg', 'Blackpink in Your Area <br>\r\nBlinks <br>\r\nMaterial Velboa <br>\r\nIsi Dacron <br>\r\nSize : 30cm x 35cm', 33),
(5, 'Boneka Bantal BLACKPINK K-pop', 60000, 'blackpink.jpeg', 'Blackpink in Your Area <br>\r\nBlinks <br>\r\nMaterial Velboa <br>\r\nIsi Dacron <br>\r\nSize : 30cm x 35cm', 50);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `ongkir`
--
ALTER TABLE `ongkir`
  ADD PRIMARY KEY (`id_ongkir`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`);

--
-- Indexes for table `pembelian`
--
ALTER TABLE `pembelian`
  ADD PRIMARY KEY (`id_pembelian`);

--
-- Indexes for table `pembelian_produk`
--
ALTER TABLE `pembelian_produk`
  ADD PRIMARY KEY (`id_pembelian_produk`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ongkir`
--
ALTER TABLE `ongkir`
  MODIFY `id_ongkir` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id_pelanggan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id_pembayaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `pembelian`
--
ALTER TABLE `pembelian`
  MODIFY `id_pembelian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `pembelian_produk`
--
ALTER TABLE `pembelian_produk`
  MODIFY `id_pembelian_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
