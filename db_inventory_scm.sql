-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 03, 2015 at 06:15 AM
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
('ADM001', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'mimin', 'mimin@gmail.com', 'admin'),
('ADM002', 'gudang', '202446dd1d6028084426867365b0c7a1', 'gudang', 'gudang@gmail.com', 'gudang'),
('ADM003', 'distribusi', '4a8a4a98ff830e7b6681ea6d94157507', 'distribusi', 'distribusi@gmail.com', 'distribusi');

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
  `safety_stock` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`kode_barang`),
  KEY `kode_satuan` (`kode_admin`),
  KEY `admin_id` (`kode_admin`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_barang`
--

INSERT INTO `tb_barang` (`kode_barang`, `nama_barang`, `deskripsi_barang`, `stok_barang`, `kode_admin`, `safety_stock`) VALUES
('BRG001', 'Clutch Cover (Tutup kopling)', 'Kopling ini adalah produk yang bagus.', 850, 'ADM001', 300),
('BRG002', 'Clutch Disc (Pelat Kopling)', 'Pelat Kopling ini adalah produk yang bagus.', 1550, 'ADM001', 200),
('BRG003', 'Water Pump', 'Water Pump ini adalah barang yang bagus', 250, 'ADM001', 200),
('BRG004', 'Klem Acu', 'Klem Acu ini adalah barang yang bagus', 1050, 'ADM001', 250),
('BRG005', 'Master Rem', 'Master Rem ini adalah barang  yang bagus', 850, 'ADM001', 200),
('BRG006', 'Pinion Gear', 'Pinion Gear ini adalah barang yang bagus', 350, 'ADM001', 250),
('BRG007', 'Side Gear', 'Side Gear ini adalah barang yang bagus', 900, 'ADM001', 300);

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
('CAB001', 'Barokah', 'Cihanjuang', '0224567890', 'ADM001'),
('CAB002', 'Irian', 'Ciwaruga', '0221234567', 'ADM001'),
('CAB003', 'Jaya Sparepart', 'Cikutra', '022345678', 'ADM001');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `tb_detailpembelian`
--

INSERT INTO `tb_detailpembelian` (`num_beli`, `qty_beli`, `kode_barang`, `faktur_beli`) VALUES
(1, 200, 'BRG003', 'POB001'),
(2, 100, 'BRG005', 'POB001'),
(3, 250, 'BRG002', 'POB001'),
(4, 400, 'BRG001', 'POB002'),
(5, 400, 'BRG002', 'POB002'),
(6, 300, 'BRG004', 'POB002');

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
('DIS002', 'BRG002', 135),
('DIS003', 'BRG003', 150),
('DIS003', 'BRG005', 150),
('DIS004', 'BRG007', 100),
('DIS005', 'BRG002', 100),
('DIS005', 'BRG003', 100),
('DIS006', 'BRG001', 200),
('DIS007', 'BRG003', 100),
('DIS008', 'BRG001', 200),
('DIS009', 'BRG006', 150),
('DIS010', 'BRG004', 100),
('DIS010', 'BRG005', 100),
('DIS010', 'BRG003', 200),
('DIS011', 'BRG004', 150),
('DIS011', 'BRG006', 100),
('DIS012', 'BRG006', 200),
('DIS013', 'BRG001', 200),
('DIS013', 'BRG002', 200),
('DIS014', 'BRG003', 300),
('DIS014', 'BRG001', 300),
('DIS015', 'BRG002', 300),
('DIS015', 'BRG004', 200),
('DIS016', 'BRG001', 150);

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

--
-- Dumping data for table `tb_detail_pemesanan`
--

INSERT INTO `tb_detail_pemesanan` (`kode_pesan`, `kode_barang`, `qty`) VALUES
('POS001', 'BRG003', 200),
('POS001', 'BRG005', 100),
('POS001', 'BRG002', 250),
('POS002', 'BRG001', 400),
('POS002', 'BRG002', 400),
('POS002', 'BRG004', 300);

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
('POP002', 'BRG002', 135),
('POP003', 'BRG003', 150),
('POP003', 'BRG005', 150),
('POP004', 'BRG007', 100),
('POP005', 'BRG002', 100),
('POP005', 'BRG003', 100),
('POP006', 'BRG001', 200),
('POP007', 'BRG003', 100),
('POP008', 'BRG001', 200),
('POP009', 'BRG006', 150),
('POP010', 'BRG004', 100),
('POP010', 'BRG005', 100),
('POP010', 'BRG003', 200),
('POP011', 'BRG004', 150),
('POP011', 'BRG006', 100),
('POP012', 'BRG006', 200),
('POP013', 'BRG001', 200),
('POP013', 'BRG002', 200),
('POP014', 'BRG003', 300),
('POP014', 'BRG001', 300),
('POP015', 'BRG002', 300),
('POP015', 'BRG004', 200),
('POP016', 'BRG001', 150);

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
('POI002', 'BRG002', 135),
('POI003', 'BRG003', 150),
('POI003', 'BRG005', 150),
('POI004', 'BRG007', 100),
('POI005', 'BRG001', 200),
('POI006', 'BRG003', 100),
('POI007', 'BRG001', 200),
('POI008', 'BRG006', 150),
('POI009', 'BRG002', 100),
('POI009', 'BRG003', 100),
('POI010', 'BRG004', 100),
('POI010', 'BRG005', 100),
('POI010', 'BRG003', 200),
('POI011', 'BRG004', 150),
('POI011', 'BRG006', 100),
('POI012', 'BRG006', 200),
('POI013', 'BRG002', 300),
('POI013', 'BRG004', 200),
('POI014', 'BRG003', 300),
('POI014', 'BRG001', 300),
('POI015', 'BRG001', 200),
('POI015', 'BRG002', 200),
('POI016', 'BRG001', 150);

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
('DIS001', 'CAB001', '2013-01-25', '2013-01-29', 2),
('DIS002', 'CAB002', '2013-01-25', '2013-01-29', 1),
('DIS003', 'CAB003', '2013-04-29', '2013-04-30', 0),
('DIS004', 'CAB001', '2013-03-29', '2014-12-29', 2),
('DIS005', 'CAB001', '2013-03-29', '2013-03-27', 2),
('DIS006', 'CAB001', '2013-04-29', '2013-04-30', 2),
('DIS007', 'CAB001', '2013-05-29', '0000-00-00', 0),
('DIS008', 'CAB001', '2013-05-25', '0000-00-00', 0),
('DIS009', 'CAB001', '2013-04-29', '0000-00-00', 0),
('DIS010', 'CAB001', '2013-06-29', '0000-00-00', 0),
('DIS011', 'CAB001', '0000-00-00', '0000-00-00', 0),
('DIS012', 'CAB001', '2013-06-29', '0000-00-00', 0),
('DIS013', 'CAB001', '2015-01-25', '0000-00-00', 0),
('DIS014', 'CAB002', '2013-02-27', '0000-00-00', 0),
('DIS015', 'CAB003', '2013-02-27', '0000-00-00', 0),
('DIS016', 'CAB001', '2013-02-12', '0000-00-00', 0);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `tb_logstokbeli`
--

INSERT INTO `tb_logstokbeli` (`num_log`, `tgl_update`, `jam_update`, `stok_awal`, `stok_akhir`, `kode_barang`, `kode_admin`, `faktur_beli`) VALUES
(1, '2014-12-29', '00:00:00', 1000, 1200, 'BRG003', 'ADM001', 'POB001'),
(2, '2014-12-29', '00:00:00', 1000, 1100, 'BRG005', 'ADM001', 'POB001'),
(3, '2014-12-29', '00:00:00', 1500, 1750, 'BRG002', 'ADM001', 'POB001'),
(4, '2015-01-08', '00:00:00', 1100, 1500, 'BRG001', 'ADM001', 'POB002'),
(5, '2015-01-08', '00:00:00', 1650, 2050, 'BRG002', 'ADM001', 'POB002'),
(6, '2015-01-08', '00:00:00', 950, 1250, 'BRG004', 'ADM001', 'POB002');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=31 ;

--
-- Dumping data for table `tb_logstokjual`
--

INSERT INTO `tb_logstokjual` (`num_log`, `tgl_update`, `stok_awal`, `stok_akhir`, `kode_barang`, `id_transaksi`) VALUES
(5, '2013-01-29 09:50:23', 200, 300, 'BRG001', 'POP001'),
(6, '2013-01-29 09:50:23', 150, 300, 'BRG002', 'POP001'),
(7, '2013-01-25 09:50:23', 100, 250, 'BRG001', 'POP002'),
(8, '2013-01-25 09:50:23', 0, 135, 'BRG002', 'POP002'),
(9, '2014-12-29 18:22:22', 1200, 1350, 'BRG003', 'POP003'),
(10, '2014-12-29 18:22:22', 1100, 1250, 'BRG005', 'POP003'),
(11, '2014-12-29 18:23:06', 1000, 1100, 'BRG007', 'POP004'),
(12, '2014-12-29 18:30:11', 1750, 1850, 'BRG002', 'POP005'),
(13, '2014-12-29 18:30:11', 1050, 1150, 'BRG003', 'POP005'),
(14, '2014-12-29 18:30:23', 1500, 1700, 'BRG001', 'POP006'),
(15, '2014-12-29 18:30:31', 950, 1050, 'BRG003', 'POP007'),
(16, '2014-12-29 18:30:37', 1300, 1500, 'BRG001', 'POP008'),
(17, '2014-12-29 18:30:44', 800, 950, 'BRG006', 'POP009'),
(18, '2014-12-29 18:30:54', 1200, 1300, 'BRG004', 'POP010'),
(19, '2014-12-29 18:30:55', 950, 1050, 'BRG005', 'POP010'),
(20, '2014-12-29 18:30:55', 850, 1050, 'BRG003', 'POP010'),
(21, '2014-12-29 18:31:03', 1100, 1250, 'BRG004', 'POP011'),
(22, '2014-12-29 18:31:03', 650, 750, 'BRG006', 'POP011'),
(23, '2014-12-29 18:31:09', 550, 750, 'BRG006', 'POP012'),
(24, '2015-01-25 06:50:50', 1500, 1700, 'BRG001', 'POP013'),
(25, '2015-01-25 06:50:50', 2050, 2250, 'BRG002', 'POP013'),
(26, '2013-02-27 00:00:00', 650, 950, 'BRG003', 'POP014'),
(27, '2013-02-27 00:00:00', 1300, 1600, 'BRG001', 'POP014'),
(28, '2013-02-27 00:00:00', 1850, 2150, 'BRG002', 'POP015'),
(29, '2013-02-27 00:00:00', 1250, 1450, 'BRG004', 'POP015'),
(30, '2013-02-12 00:00:00', 1000, 1150, 'BRG001', 'POP016');

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

--
-- Dumping data for table `tb_pembelian`
--

INSERT INTO `tb_pembelian` (`faktur_beli`, `tgl_beli`, `kode_supplier`, `kode_jenistransaksibeli`) VALUES
('POB001', '2014-12-29', 'SUP001', 'JENB001'),
('POB002', '2015-01-08', 'SUP001', 'JENB001');

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

--
-- Dumping data for table `tb_pemesanan`
--

INSERT INTO `tb_pemesanan` (`kode_pesan`, `kode_suplier`, `tgl_beli`, `status`) VALUES
('POS001', 'SUP001', '2014-12-29', 1),
('POS002', 'SUP001', '2015-01-08', 1);

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
('POP002', '2013-01-25', 'CAB002', 'ADM001', 'JENJ001'),
('POP003', '2013-02-27', 'CAB003', 'ADM001', 'JENJ001'),
('POP004', '2013-04-28', 'CAB001', 'ADM001', 'JENJ001'),
('POP005', '2013-03-29', 'CAB001', 'ADM001', 'JENJ001'),
('POP006', '2013-03-07', 'CAB001', 'ADM001', 'JENJ001'),
('POP007', '2013-04-29', 'CAB001', 'ADM001', 'JENJ001'),
('POP008', '2013-05-29', 'CAB001', 'ADM001', 'JENJ001'),
('POP009', '2013-05-16', 'CAB001', 'ADM001', 'JENJ001'),
('POP010', '2013-06-23', 'CAB001', 'ADM001', 'JENJ001'),
('POP011', '2013-06-06', 'CAB001', 'ADM001', 'JENJ001'),
('POP012', '2013-04-04', 'CAB001', 'ADM001', 'JENJ001'),
('POP013', '2015-01-25', 'CAB001', 'ADM001', 'JENJ001'),
('POP014', '2013-02-27', 'CAB002', 'ADM001', 'JENJ001'),
('POP015', '2013-02-27', 'CAB003', 'ADM001', 'JENJ001'),
('POP016', '2013-02-12', 'CAB001', 'ADM001', 'JENJ001');

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
  `tgl_jual` date NOT NULL,
  `kode_cabang` varchar(30) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_permintaan`),
  KEY `kode_cabang` (`kode_cabang`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_permintaan`
--

INSERT INTO `tb_permintaan` (`id_permintaan`, `tgl_jual`, `kode_cabang`, `status`) VALUES
('POI001', '2013-01-29', 'CAB001', 1),
('POI002', '2013-01-25', 'CAB002', 1),
('POI003', '2014-12-29', 'CAB003', 1),
('POI004', '2014-12-29', 'CAB001', 1),
('POI005', '2014-12-29', 'CAB001', 1),
('POI006', '2014-12-29', 'CAB001', 1),
('POI007', '2014-12-29', 'CAB001', 1),
('POI008', '2014-12-29', 'CAB001', 1),
('POI009', '2014-12-29', 'CAB001', 1),
('POI010', '2014-12-29', 'CAB001', 1),
('POI011', '2014-12-29', 'CAB001', 1),
('POI012', '2014-12-29', 'CAB001', 1),
('POI013', '2015-01-08', 'CAB003', 1),
('POI014', '2013-02-27', 'CAB002', 1),
('POI015', '2013-02-27', 'CAB001', 1),
('POI016', '2013-02-12', 'CAB001', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_stok_cabang`
--

CREATE TABLE IF NOT EXISTS `tb_stok_cabang` (
  `kode_stok` int(11) NOT NULL AUTO_INCREMENT,
  `kode_barang` varchar(30) NOT NULL,
  `kode_cabang` varchar(15) NOT NULL,
  `stok_cabang` int(11) NOT NULL,
  PRIMARY KEY (`kode_stok`),
  KEY `kode_cabang` (`kode_cabang`),
  KEY `kode_barang` (`kode_barang`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tb_stok_cabang`
--

INSERT INTO `tb_stok_cabang` (`kode_stok`, `kode_barang`, `kode_cabang`, `stok_cabang`) VALUES
(1, 'BRG001', 'CAB001', 200),
(2, 'BRG007', 'CAB001', 100);

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
('SUP001', 'Mitra Jaya', 'Jln.A.Yani', 'ADM001');

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
('USR003', 'user3', '92877af70a45fd6a2ed7fe81e1236b78', 'User Tiga', 'user3@gmail.com', 'CAB003', 'ADM001');

-- --------------------------------------------------------

--
-- Table structure for table `temp_permintaan`
--

CREATE TABLE IF NOT EXISTS `temp_permintaan` (
  `kode` int(11) NOT NULL AUTO_INCREMENT,
  `kode_barang` varchar(30) NOT NULL,
  `kode_cabang` varchar(30) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `tanggal` date NOT NULL,
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
  ADD CONSTRAINT `tb_detail_distribusi_ibfk_1` FOREIGN KEY (`id_distribusi`) REFERENCES `tb_distribusi_brg` (`id_distribusi`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_detail_distribusi_ibfk_2` FOREIGN KEY (`kode_barang`) REFERENCES `tb_barang` (`kode_barang`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_detail_pemesanan`
--
ALTER TABLE `tb_detail_pemesanan`
  ADD CONSTRAINT `tb_detail_pemesanan_ibfk_1` FOREIGN KEY (`kode_pesan`) REFERENCES `tb_pemesanan` (`kode_pesan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_detail_penjualan`
--
ALTER TABLE `tb_detail_penjualan`
  ADD CONSTRAINT `tb_detail_penjualan_ibfk_2` FOREIGN KEY (`kode_barang`) REFERENCES `tb_barang` (`kode_barang`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_detail_penjualan_ibfk_3` FOREIGN KEY (`id_transaksi`) REFERENCES `tb_penjualan` (`id_transaksi`) ON DELETE CASCADE ON UPDATE CASCADE;

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
