-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 29, 2014 at 05:21 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_inventory_scm`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_admin`
--

CREATE TABLE IF NOT EXISTS `tb_admin` (
  `kode_admin` varchar(30) NOT NULL,
  `username_admin` varchar(75) NOT NULL,
  `password_admin` varchar(75) NOT NULL,
  `nama_admin` varchar(75) NOT NULL,
  `email_admin` varchar(75) NOT NULL,
  `level` varchar(30) NOT NULL,
  PRIMARY KEY (`kode_admin`),
  UNIQUE KEY `username` (`username_admin`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_admin`
--

INSERT INTO `tb_admin` (`kode_admin`, `username_admin`, `password_admin`, `nama_admin`, `email_admin`, `level`) VALUES
('ADM001', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'mimin', 'mimin@gmail.com', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `tb_barang`
--

CREATE TABLE IF NOT EXISTS `tb_barang` (
  `kode_barang` varchar(30) NOT NULL,
  `nama_barang` varchar(75) NOT NULL,
  `deskripsi_barang` varchar(250) NOT NULL,
  `stok_barang` int(11) NOT NULL,
  `kode_admin` varchar(30) NOT NULL,
  PRIMARY KEY (`kode_barang`),
  KEY `kode_satuan` (`kode_admin`),
  KEY `admin_id` (`kode_admin`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_barang`
--

INSERT INTO `tb_barang` (`kode_barang`, `nama_barang`, `deskripsi_barang`, `stok_barang`, `kode_admin`) VALUES
('BRG001', 'Clutch Cover (Tutup kopling)', 'Kopling ini adalah produk yang bagus.', 1500, 'ADM001'),
('BRG002', 'Clutch Disc (Pelat Kopling)', 'Pelat Kopling ini adalah produk yang bagus.', 1500, 'ADM001');

-- --------------------------------------------------------

--
-- Table structure for table `tb_cabang`
--

CREATE TABLE IF NOT EXISTS `tb_cabang` (
  `kode_cabang` varchar(30) NOT NULL,
  `nama_cabang` varchar(75) NOT NULL,
  `alamat_cabang` varchar(200) NOT NULL,
  `telepon_cabang` varchar(20) NOT NULL,
  `kode_admin` varchar(35) NOT NULL,
  PRIMARY KEY (`kode_cabang`),
  KEY `kode_admin` (`kode_admin`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_cabang`
--

INSERT INTO `tb_cabang` (`kode_cabang`, `nama_cabang`, `alamat_cabang`, `telepon_cabang`, `kode_admin`) VALUES
('CAB001', 'Barokah Jaya', 'Cihanjuang', '0224567890', 'ADM001'),
('CAB002', 'Cabang Polban', 'Ciwaruga', '0221234567', 'ADM001'),
('CAB003', 'Family', 'Cikutra', '022345678', 'ADM001'),
('CAB004', 'Kurnia Motor', 'Cigadung', '0221234532', 'ADM001');

-- --------------------------------------------------------

--
-- Table structure for table `tb_detailpembelian`
--

CREATE TABLE IF NOT EXISTS `tb_detailpembelian` (
  `num_beli` int(11) NOT NULL AUTO_INCREMENT,
  `qty_beli` int(11) NOT NULL,
  `kode_barang` varchar(30) NOT NULL,
  `faktur_beli` varchar(30) NOT NULL,
  PRIMARY KEY (`num_beli`),
  KEY `kode_barang` (`kode_barang`,`faktur_beli`),
  KEY `kode_jenistransaksibeli` (`faktur_beli`),
  KEY `faktur_beli` (`faktur_beli`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tb_detail_distribusi`
--

CREATE TABLE IF NOT EXISTS `tb_detail_distribusi` (
  `id_distribusi` varchar(20) NOT NULL,
  `kode_barang` varchar(50) NOT NULL,
  `jumlah` int(11) NOT NULL,
  KEY `id_distribusi` (`id_distribusi`),
  KEY `kode_barang` (`kode_barang`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_detail_distribusi`
--

INSERT INTO `tb_detail_distribusi` (`id_distribusi`, `kode_barang`, `jumlah`) VALUES
('DIS001', 'BRG001', 100),
('DIS001', 'BRG002', 150),
('DIS002', 'BRG001', 150),
('DIS002', 'BRG002', 135);

-- --------------------------------------------------------

--
-- Table structure for table `tb_detail_pemesanan`
--

CREATE TABLE IF NOT EXISTS `tb_detail_pemesanan` (
  `kode_pesan` varchar(30) NOT NULL,
  `kode_barang` varchar(30) NOT NULL,
  `qty` int(11) NOT NULL,
  KEY `kode_pesan` (`kode_pesan`,`kode_barang`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_detail_penjualan`
--

CREATE TABLE IF NOT EXISTS `tb_detail_penjualan` (
  `id_transaksi` varchar(16) NOT NULL,
  `kode_barang` varchar(16) NOT NULL,
  `jumlah` int(11) NOT NULL,
  KEY `id_transaksi` (`id_transaksi`),
  KEY `kode_barang` (`kode_barang`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_detail_penjualan`
--

INSERT INTO `tb_detail_penjualan` (`id_transaksi`, `kode_barang`, `jumlah`) VALUES
('POP001', 'BRG001', 100),
('POP001', 'BRG002', 150),
('POP002', 'BRG001', 150),
('POP002', 'BRG002', 135);

-- --------------------------------------------------------

--
-- Table structure for table `tb_detail_permintaan`
--

CREATE TABLE IF NOT EXISTS `tb_detail_permintaan` (
  `id_permintaan` varchar(16) NOT NULL,
  `kode_barang` varchar(16) NOT NULL,
  `jumlah` int(11) NOT NULL,
  KEY `id_permintaan` (`id_permintaan`),
  KEY `kode_barang` (`kode_barang`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_detail_permintaan`
--

INSERT INTO `tb_detail_permintaan` (`id_permintaan`, `kode_barang`, `jumlah`) VALUES
('POI001', 'BRG001', 100),
('POI001', 'BRG002', 150),
('POI002', 'BRG001', 150),
('POI002', 'BRG002', 135);

-- --------------------------------------------------------

--
-- Table structure for table `tb_distribusi_brg`
--

CREATE TABLE IF NOT EXISTS `tb_distribusi_brg` (
  `id_distribusi` varchar(20) NOT NULL,
  `kode_cabang` varchar(30) NOT NULL,
  `tgl_jual` date NOT NULL DEFAULT '0000-00-00',
  `tgl_distribusi` date NOT NULL DEFAULT '0000-00-00',
  `status` tinyint(3) NOT NULL,
  PRIMARY KEY (`id_distribusi`),
  KEY `kode_cabang` (`kode_cabang`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_distribusi_brg`
--

INSERT INTO `tb_distribusi_brg` (`id_distribusi`, `kode_cabang`, `tgl_jual`, `tgl_distribusi`, `status`) VALUES
('DIS001', 'CAB001', '2014-12-29', '2014-12-29', 1),
('DIS002', 'CAB002', '2014-12-29', '2014-12-29', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_jenistransaksibeli`
--

CREATE TABLE IF NOT EXISTS `tb_jenistransaksibeli` (
  `kode_jenistransaksibeli` varchar(30) NOT NULL,
  `jenis_transaksibeli` varchar(75) NOT NULL,
  PRIMARY KEY (`kode_jenistransaksibeli`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_jenistransaksibeli`
--

INSERT INTO `tb_jenistransaksibeli` (`kode_jenistransaksibeli`, `jenis_transaksibeli`) VALUES
('JENB001', 'Pembelian'),
('JENB002', 'Retur Pembelian');

-- --------------------------------------------------------

--
-- Table structure for table `tb_jenistransaksijual`
--

CREATE TABLE IF NOT EXISTS `tb_jenistransaksijual` (
  `kode_jenistransaksijual` varchar(35) NOT NULL,
  `jenis_transaksijual` varchar(75) NOT NULL,
  PRIMARY KEY (`kode_jenistransaksijual`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_jenistransaksijual`
--

INSERT INTO `tb_jenistransaksijual` (`kode_jenistransaksijual`, `jenis_transaksijual`) VALUES
('JENJ001', 'Penjualan'),
('JENJ002', 'Retur Penjualan');

-- --------------------------------------------------------

--
-- Table structure for table `tb_logstokbeli`
--

CREATE TABLE IF NOT EXISTS `tb_logstokbeli` (
  `num_log` int(11) NOT NULL AUTO_INCREMENT,
  `tgl_update` date NOT NULL,
  `jam_update` time NOT NULL,
  `stok_awal` int(11) NOT NULL,
  `stok_akhir` int(11) NOT NULL,
  `kode_barang` varchar(30) NOT NULL,
  `kode_admin` varchar(30) NOT NULL,
  `faktur_beli` varchar(30) NOT NULL,
  PRIMARY KEY (`num_log`),
  KEY `kode_barang` (`kode_barang`,`kode_admin`,`faktur_beli`),
  KEY `kode_admin` (`kode_admin`),
  KEY `faktur_beli` (`faktur_beli`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tb_logstokjual`
--

CREATE TABLE IF NOT EXISTS `tb_logstokjual` (
  `num_log` int(11) NOT NULL AUTO_INCREMENT,
  `tgl_update` datetime NOT NULL,
  `stok_awal` int(11) NOT NULL,
  `stok_akhir` int(11) NOT NULL,
  `kode_barang` varchar(30) NOT NULL,
  `id_transaksi` varchar(30) NOT NULL,
  PRIMARY KEY (`num_log`),
  KEY `kode_barang` (`kode_barang`,`id_transaksi`),
  KEY `faktur_jual` (`id_transaksi`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `tb_logstokjual`
--

INSERT INTO `tb_logstokjual` (`num_log`, `tgl_update`, `stok_awal`, `stok_akhir`, `kode_barang`, `id_transaksi`) VALUES
(5, '2013-01-29 09:50:23', 200, 300, 'BRG001', 'POP001'),
(6, '2013-01-29 09:50:23', 150, 300, 'BRG002', 'POP001'),
(7, '2013-01-25 09:50:23', 100, 250, 'BRG001', 'POP002'),
(8, '2013-01-25 09:50:23', 0, 135, 'BRG002', 'POP002');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pembelian`
--

CREATE TABLE IF NOT EXISTS `tb_pembelian` (
  `faktur_beli` varchar(30) NOT NULL,
  `tgl_beli` date NOT NULL,
  `kode_supplier` varchar(30) NOT NULL,
  `kode_jenistransaksibeli` varchar(30) NOT NULL,
  PRIMARY KEY (`faktur_beli`),
  KEY `kode_supplier` (`kode_supplier`,`kode_jenistransaksibeli`),
  KEY `kode_jenistransaksibeli` (`kode_jenistransaksibeli`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_pemesanan`
--

CREATE TABLE IF NOT EXISTS `tb_pemesanan` (
  `kode_pesan` varchar(30) NOT NULL,
  `kode_suplier` varchar(30) NOT NULL,
  `tgl_beli` date NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`kode_pesan`),
  KEY `kode_suplier` (`kode_suplier`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_penjualan`
--

CREATE TABLE IF NOT EXISTS `tb_penjualan` (
  `id_transaksi` varchar(30) NOT NULL,
  `tgl_jual` date NOT NULL,
  `kode_cabang` varchar(30) NOT NULL,
  `kode_admin` varchar(16) NOT NULL,
  `kode_jenistransaksijual` varchar(30) NOT NULL,
  PRIMARY KEY (`id_transaksi`),
  KEY `kode_cabang` (`kode_cabang`,`kode_jenistransaksijual`),
  KEY `kode_jenistransaksijual` (`kode_jenistransaksijual`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_penjualan`
--

INSERT INTO `tb_penjualan` (`id_transaksi`, `tgl_jual`, `kode_cabang`, `kode_admin`, `kode_jenistransaksijual`) VALUES
('POP001', '2013-01-29', 'CAB001', 'ADM001', 'JENJ001'),
('POP002', '2013-01-25', 'CAB002', 'ADM001', 'JENJ001');

-- --------------------------------------------------------

--
-- Table structure for table `tb_peramalan`
--

CREATE TABLE IF NOT EXISTS `tb_peramalan` (
  `id_peramalan` int(11) NOT NULL AUTO_INCREMENT,
  `kode_barang` varchar(50) NOT NULL,
  `by_month` bigint(20) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `kode_cabang` varchar(30) NOT NULL,
  `tgl_peramalan` date NOT NULL,
  PRIMARY KEY (`id_peramalan`),
  KEY `kode_cabang` (`kode_cabang`),
  KEY `kode_barang` (`kode_barang`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=115 ;

--
-- Dumping data for table `tb_peramalan`
--

INSERT INTO `tb_peramalan` (`id_peramalan`, `kode_barang`, `by_month`, `jumlah`, `kode_cabang`, `tgl_peramalan`) VALUES
(55, 'BRG002', 201301, 282, 'CAB001', '2014-06-08'),
(56, 'BRG002', 201302, 284, 'CAB001', '2014-06-08'),
(57, 'BRG002', 201303, 282, 'CAB001', '2014-06-08'),
(58, 'BRG002', 201304, 281, 'CAB001', '2014-06-08'),
(59, 'BRG002', 201305, 278, 'CAB001', '2014-06-08'),
(60, 'BRG002', 201306, 283, 'CAB001', '2014-06-08'),
(61, 'BRG001', 201301, 83, 'CAB001', '2014-06-08'),
(62, 'BRG001', 201302, 220, 'CAB001', '2014-06-08'),
(63, 'BRG001', 201303, 260, 'CAB001', '2014-06-08'),
(64, 'BRG001', 201304, 310, 'CAB001', '2014-06-08'),
(65, 'BRG001', 201305, 324, 'CAB001', '2014-06-08'),
(66, 'BRG001', 201306, 226, 'CAB001', '2014-06-08'),
(103, 'BRG002', 201401, 282, 'CAB001', '0000-00-00'),
(104, 'BRG002', 201402, 284, 'CAB001', '0000-00-00'),
(105, 'BRG002', 201403, 282, 'CAB001', '0000-00-00'),
(106, 'BRG002', 201404, 281, 'CAB001', '0000-00-00'),
(107, 'BRG002', 201405, 278, 'CAB001', '0000-00-00'),
(108, 'BRG002', 201406, 283, 'CAB001', '0000-00-00'),
(109, 'BRG001', 201401, 253, 'CAB001', '0000-00-00'),
(110, 'BRG001', 201402, 303, 'CAB001', '0000-00-00'),
(111, 'BRG001', 201403, 274, 'CAB001', '0000-00-00'),
(112, 'BRG001', 201404, 238, 'CAB001', '0000-00-00'),
(113, 'BRG001', 201405, 228, 'CAB001', '0000-00-00'),
(114, 'BRG001', 201406, 346, 'CAB001', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `tb_permintaan`
--

CREATE TABLE IF NOT EXISTS `tb_permintaan` (
  `id_permintaan` varchar(30) NOT NULL,
  `tgl_jual` datetime NOT NULL,
  `kode_cabang` varchar(30) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_permintaan`),
  KEY `kode_cabang` (`kode_cabang`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_permintaan`
--

INSERT INTO `tb_permintaan` (`id_permintaan`, `tgl_jual`, `kode_cabang`, `status`) VALUES
('POI001', '2013-01-29 09:50:23', 'CAB001', 1),
('POI002', '2013-01-25 09:50:23', 'CAB002', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_supplier`
--

CREATE TABLE IF NOT EXISTS `tb_supplier` (
  `kode_supplier` varchar(30) NOT NULL,
  `nama_supplier` varchar(75) NOT NULL,
  `alamat_supplier` varchar(300) NOT NULL,
  `kode_admin` varchar(30) NOT NULL,
  PRIMARY KEY (`kode_supplier`),
  KEY `admin_id` (`kode_admin`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_supplier`
--

INSERT INTO `tb_supplier` (`kode_supplier`, `nama_supplier`, `alamat_supplier`, `kode_admin`) VALUES
('SUP001', 'Mitra Jaya Motor', 'A.H.Yani', 'ADM001');

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE IF NOT EXISTS `tb_user` (
  `kode_user` varchar(30) NOT NULL,
  `username_user` varchar(75) NOT NULL,
  `password_user` varchar(75) NOT NULL,
  `nama_user` varchar(75) NOT NULL,
  `email_user` varchar(75) NOT NULL,
  `kode_cabang` varchar(30) NOT NULL,
  `kode_admin` varchar(30) NOT NULL,
  PRIMARY KEY (`kode_user`),
  KEY `kode_cabang` (`kode_cabang`,`kode_admin`),
  KEY `kode_admin` (`kode_admin`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`kode_user`, `username_user`, `password_user`, `nama_user`, `email_user`, `kode_cabang`, `kode_admin`) VALUES
('USR001', 'user1', '24c9e15e52afc47c225b757e7bee1f9d', 'User Satu', 'user1@yahoo.com', 'CAB001', 'ADM001'),
('USR002', 'user2', '7e58d63b60197ceb55a1c487989a3720', 'User Dua', 'user2@windowslive.com', 'CAB002', 'ADM001'),
('USR003', 'user3', '92877af70a45fd6a2ed7fe81e1236b78', 'User Tiga', 'user3@gmail.com', 'CAB003', 'ADM001'),
('USR004', 'user4', '3f02ebe3d7929b091e3d8ccfde2f3bc6', 'User Empat', 'user4@live.com', 'CAB004', 'ADM001');

-- --------------------------------------------------------

--
-- Table structure for table `temp_permintaan`
--

CREATE TABLE IF NOT EXISTS `temp_permintaan` (
  `kode` int(11) NOT NULL AUTO_INCREMENT,
  `kode_barang` varchar(30) NOT NULL,
  `kode_cabang` varchar(30) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `jumlah` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`kode`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `temp_pesan`
--

CREATE TABLE IF NOT EXISTS `temp_pesan` (
  `kode` int(11) NOT NULL AUTO_INCREMENT,
  `kode_barang` varchar(30) NOT NULL,
  `kode_supplier` varchar(30) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `jumlah` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`kode`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_barang`
--
ALTER TABLE `tb_barang`
  ADD CONSTRAINT `tb_barang_ibfk_1` FOREIGN KEY (`kode_admin`) REFERENCES `tb_admin` (`kode_admin`);

--
-- Constraints for table `tb_cabang`
--
ALTER TABLE `tb_cabang`
  ADD CONSTRAINT `tb_cabang_ibfk_1` FOREIGN KEY (`kode_admin`) REFERENCES `tb_admin` (`kode_admin`);

--
-- Constraints for table `tb_detailpembelian`
--
ALTER TABLE `tb_detailpembelian`
  ADD CONSTRAINT `tb_detailpembelian_ibfk_1` FOREIGN KEY (`kode_barang`) REFERENCES `tb_barang` (`kode_barang`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_detailpembelian_ibfk_2` FOREIGN KEY (`faktur_beli`) REFERENCES `tb_pembelian` (`faktur_beli`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_detail_distribusi`
--
ALTER TABLE `tb_detail_distribusi`
  ADD CONSTRAINT `tb_detail_distribusi_ibfk_2` FOREIGN KEY (`kode_barang`) REFERENCES `tb_barang` (`kode_barang`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_detail_distribusi_ibfk_1` FOREIGN KEY (`id_distribusi`) REFERENCES `tb_distribusi_brg` (`id_distribusi`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_detail_pemesanan`
--
ALTER TABLE `tb_detail_pemesanan`
  ADD CONSTRAINT `tb_detail_pemesanan_ibfk_1` FOREIGN KEY (`kode_pesan`) REFERENCES `tb_pemesanan` (`kode_pesan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_detail_penjualan`
--
ALTER TABLE `tb_detail_penjualan`
  ADD CONSTRAINT `tb_detail_penjualan_ibfk_3` FOREIGN KEY (`id_transaksi`) REFERENCES `tb_penjualan` (`id_transaksi`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_detail_penjualan_ibfk_2` FOREIGN KEY (`kode_barang`) REFERENCES `tb_barang` (`kode_barang`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_detail_permintaan`
--
ALTER TABLE `tb_detail_permintaan`
  ADD CONSTRAINT `tb_detail_permintaan_ibfk_1` FOREIGN KEY (`id_permintaan`) REFERENCES `tb_permintaan` (`id_permintaan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_detail_permintaan_ibfk_2` FOREIGN KEY (`kode_barang`) REFERENCES `tb_barang` (`kode_barang`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_distribusi_brg`
--
ALTER TABLE `tb_distribusi_brg`
  ADD CONSTRAINT `tb_distribusi_brg_ibfk_1` FOREIGN KEY (`kode_cabang`) REFERENCES `tb_cabang` (`kode_cabang`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_logstokbeli`
--
ALTER TABLE `tb_logstokbeli`
  ADD CONSTRAINT `tb_logstokbeli_ibfk_1` FOREIGN KEY (`kode_barang`) REFERENCES `tb_barang` (`kode_barang`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_logstokbeli_ibfk_2` FOREIGN KEY (`kode_admin`) REFERENCES `tb_admin` (`kode_admin`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_logstokbeli_ibfk_3` FOREIGN KEY (`faktur_beli`) REFERENCES `tb_pembelian` (`faktur_beli`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_logstokjual`
--
ALTER TABLE `tb_logstokjual`
  ADD CONSTRAINT `tb_logstokjual_ibfk_1` FOREIGN KEY (`kode_barang`) REFERENCES `tb_barang` (`kode_barang`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_logstokjual_ibfk_3` FOREIGN KEY (`id_transaksi`) REFERENCES `tb_penjualan` (`id_transaksi`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_pembelian`
--
ALTER TABLE `tb_pembelian`
  ADD CONSTRAINT `tb_pembelian_ibfk_1` FOREIGN KEY (`kode_supplier`) REFERENCES `tb_supplier` (`kode_supplier`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_pembelian_ibfk_2` FOREIGN KEY (`kode_jenistransaksibeli`) REFERENCES `tb_jenistransaksibeli` (`kode_jenistransaksibeli`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_pemesanan`
--
ALTER TABLE `tb_pemesanan`
  ADD CONSTRAINT `tb_pemesanan_ibfk_1` FOREIGN KEY (`kode_suplier`) REFERENCES `tb_supplier` (`kode_supplier`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_penjualan`
--
ALTER TABLE `tb_penjualan`
  ADD CONSTRAINT `tb_penjualan_ibfk_1` FOREIGN KEY (`kode_cabang`) REFERENCES `tb_cabang` (`kode_cabang`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_penjualan_ibfk_2` FOREIGN KEY (`kode_jenistransaksijual`) REFERENCES `tb_jenistransaksijual` (`kode_jenistransaksijual`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_permintaan`
--
ALTER TABLE `tb_permintaan`
  ADD CONSTRAINT `tb_permintaan_ibfk_1` FOREIGN KEY (`kode_cabang`) REFERENCES `tb_cabang` (`kode_cabang`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_supplier`
--
ALTER TABLE `tb_supplier`
  ADD CONSTRAINT `tb_supplier_ibfk_1` FOREIGN KEY (`kode_admin`) REFERENCES `tb_admin` (`kode_admin`);

--
-- Constraints for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD CONSTRAINT `tb_user_ibfk_1` FOREIGN KEY (`kode_cabang`) REFERENCES `tb_cabang` (`kode_cabang`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_user_ibfk_2` FOREIGN KEY (`kode_admin`) REFERENCES `tb_supplier` (`kode_admin`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
