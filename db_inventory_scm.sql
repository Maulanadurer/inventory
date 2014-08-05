-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 22, 2014 at 10:53 AM
-- Server version: 5.6.12-log
-- PHP Version: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_inventory_scm`
--
CREATE DATABASE IF NOT EXISTS `db_inventory_scm` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `db_inventory_scm`;

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
('BRG001', 'REM', 'Rem ini adalah produk yang bagus.', 200, 'ADM001'),
('BRG002', 'KABEL', 'Kabel ini adalah produk yang bagus.', 250, 'ADM001');

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
-- Table structure for table `tb_distrubusi_brg`
--

CREATE TABLE IF NOT EXISTS `tb_distrubusi_brg` (
  `id_distribusi` int(11) NOT NULL AUTO_INCREMENT,
  `kode_cabang` varchar(30) NOT NULL,
  `tgl_distribusi` varchar(30) NOT NULL,
  `kode_brg` varchar(30) NOT NULL,
  `jumlah_brg` bigint(20) NOT NULL,
  `kode_user` varchar(30) NOT NULL,
  PRIMARY KEY (`id_distribusi`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
  `tgl_update` date NOT NULL,
  `jam_update` time NOT NULL,
  `stok_awal` int(11) NOT NULL,
  `stok_akhir` int(11) NOT NULL,
  `kode_barang` varchar(30) NOT NULL,
  `kode_user` varchar(30) NOT NULL,
  `id_transaksi` varchar(30) NOT NULL,
  PRIMARY KEY (`num_log`),
  KEY `kode_barang` (`kode_barang`,`kode_user`,`id_transaksi`),
  KEY `kode_user` (`kode_user`),
  KEY `faktur_jual` (`id_transaksi`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
  `no_faktur` varchar(50) NOT NULL,
  `tgl_jual` date NOT NULL,
  `kode_barang` varchar(50) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `kode_cabang` varchar(30) NOT NULL,
  `kode_jenistransaksijual` varchar(30) NOT NULL,
  PRIMARY KEY (`id_transaksi`),
  KEY `kode_cabang` (`kode_cabang`,`kode_jenistransaksijual`),
  KEY `kode_jenistransaksijual` (`kode_jenistransaksijual`),
  KEY `kode_barang` (`kode_barang`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_penjualan`
--

INSERT INTO `tb_penjualan` (`id_transaksi`, `no_faktur`, `tgl_jual`, `kode_barang`, `jumlah`, `kode_cabang`, `kode_jenistransaksijual`) VALUES
('CPT001', 'A0001', '2013-01-02', 'BRG001', 9, 'CAB001', 'JENJ001'),
('CPT002', 'A0002', '2013-01-02', 'BRG002', 1, 'CAB001', 'JENJ001'),
('CPT003', 'A0003', '2013-01-03', 'BRG001', 7, 'CAB001', 'JENJ001'),
('CPT004', 'A0004', '2013-01-03', 'BRG002', 9, 'CAB001', 'JENJ001'),
('CPT005', 'A0005', '2013-01-04', 'BRG001', 15, 'CAB001', 'JENJ001'),
('CPT006', 'A0006', '2013-01-04', 'BRG002', 16, 'CAB001', 'JENJ001'),
('CPT007', 'A0007', '2013-01-05', 'BRG001', 20, 'CAB001', 'JENJ001'),
('CPT008', 'A0008', '2013-01-05', 'BRG002', 13, 'CAB001', 'JENJ001'),
('CPT009', 'A0009', '2013-01-06', 'BRG001', 18, 'CAB001', 'JENJ001'),
('CPT010', 'A0010', '2013-01-06', 'BRG002', 10, 'CAB001', 'JENJ001'),
('CPT011', 'A0011', '2013-01-07', 'BRG001', 12, 'CAB001', 'JENJ001'),
('CPT012', 'A0012', '2013-01-07', 'BRG002', 5, 'CAB001', 'JENJ001'),
('CPT013', 'A0013', '2013-01-08', 'BRG001', 17, 'CAB001', 'JENJ001'),
('CPT014', 'A0014', '2013-01-08', 'BRG002', 8, 'CAB001', 'JENJ001'),
('CPT015', 'A0015', '2013-01-09', 'BRG001', 5, 'CAB001', 'JENJ001'),
('CPT016', 'A0016', '2013-01-09', 'BRG002', 10, 'CAB001', 'JENJ001'),
('CPT017', 'A0017', '2013-01-10', 'BRG001', 17, 'CAB001', 'JENJ001'),
('CPT018', 'A0018', '2013-01-10', 'BRG002', 19, 'CAB001', 'JENJ001'),
('CPT019', 'A0019', '2013-01-11', 'BRG001', 13, 'CAB001', 'JENJ001'),
('CPT020', 'A0020', '2013-01-11', 'BRG002', 7, 'CAB001', 'JENJ001'),
('CPT021', 'A0021', '2013-01-12', 'BRG001', 8, 'CAB001', 'JENJ001'),
('CPT022', 'A0022', '2013-01-12', 'BRG002', 5, 'CAB001', 'JENJ001'),
('CPT023', 'A0023', '2013-01-13', 'BRG001', 10, 'CAB001', 'JENJ001'),
('CPT024', 'A0024', '2013-01-13', 'BRG002', 3, 'CAB001', 'JENJ001'),
('CPT025', 'A0025', '2013-01-14', 'BRG001', 0, 'CAB001', 'JENJ001'),
('CPT026', 'A0026', '2013-01-14', 'BRG002', 14, 'CAB001', 'JENJ001'),
('CPT027', 'A0027', '2013-01-15', 'BRG001', 8, 'CAB001', 'JENJ001'),
('CPT028', 'A0028', '2013-01-15', 'BRG002', 14, 'CAB001', 'JENJ001'),
('CPT029', 'A0029', '2013-01-16', 'BRG001', 2, 'CAB001', 'JENJ001'),
('CPT030', 'A0030', '2013-01-16', 'BRG002', 18, 'CAB001', 'JENJ001'),
('CPT031', 'A0031', '2013-01-17', 'BRG001', 4, 'CAB001', 'JENJ001'),
('CPT032', 'A0032', '2013-01-17', 'BRG002', 14, 'CAB001', 'JENJ001'),
('CPT033', 'A0033', '2013-01-18', 'BRG001', 1, 'CAB001', 'JENJ001'),
('CPT034', 'A0034', '2013-01-18', 'BRG002', 3, 'CAB001', 'JENJ001'),
('CPT035', 'A0035', '2013-01-19', 'BRG001', 1, 'CAB001', 'JENJ001'),
('CPT036', 'A0036', '2013-01-19', 'BRG002', 1, 'CAB001', 'JENJ001'),
('CPT037', 'A0037', '2013-01-20', 'BRG001', 7, 'CAB001', 'JENJ001'),
('CPT038', 'A0038', '2013-01-20', 'BRG002', 11, 'CAB001', 'JENJ001'),
('CPT039', 'A0039', '2013-01-21', 'BRG001', 18, 'CAB001', 'JENJ001'),
('CPT040', 'A0040', '2013-01-21', 'BRG002', 2, 'CAB001', 'JENJ001'),
('CPT041', 'A0041', '2013-01-22', 'BRG001', 16, 'CAB001', 'JENJ001'),
('CPT042', 'A0042', '2013-01-22', 'BRG002', 9, 'CAB001', 'JENJ001'),
('CPT043', 'A0043', '2013-01-23', 'BRG001', 7, 'CAB001', 'JENJ001'),
('CPT044', 'A0044', '2013-01-23', 'BRG002', 7, 'CAB001', 'JENJ001'),
('CPT045', 'A0045', '2013-01-24', 'BRG001', 16, 'CAB001', 'JENJ001'),
('CPT046', 'A0046', '2013-01-24', 'BRG002', 0, 'CAB001', 'JENJ001'),
('CPT047', 'A0047', '2013-01-25', 'BRG001', 11, 'CAB001', 'JENJ001'),
('CPT048', 'A0048', '2013-01-25', 'BRG002', 12, 'CAB001', 'JENJ001'),
('CPT049', 'A0049', '2013-01-26', 'BRG001', 5, 'CAB001', 'JENJ001'),
('CPT050', 'A0050', '2013-01-26', 'BRG002', 3, 'CAB001', 'JENJ001'),
('CPT051', 'A0051', '2013-01-27', 'BRG001', 1, 'CAB001', 'JENJ001'),
('CPT052', 'A0052', '2013-01-27', 'BRG002', 4, 'CAB001', 'JENJ001'),
('CPT053', 'A0053', '2013-01-28', 'BRG001', 10, 'CAB001', 'JENJ001'),
('CPT054', 'A0054', '2013-01-28', 'BRG002', 17, 'CAB001', 'JENJ001'),
('CPT055', 'A0055', '2013-01-29', 'BRG001', 12, 'CAB001', 'JENJ001'),
('CPT056', 'A0056', '2013-01-29', 'BRG002', 9, 'CAB001', 'JENJ001'),
('CPT057', 'A0057', '2013-01-30', 'BRG001', 20, 'CAB001', 'JENJ001'),
('CPT058', 'A0058', '2013-01-30', 'BRG002', 16, 'CAB001', 'JENJ001'),
('CPT059', 'A0059', '2013-01-31', 'BRG001', 13, 'CAB001', 'JENJ001'),
('CPT060', 'A0060', '2013-01-31', 'BRG002', 8, 'CAB001', 'JENJ001'),
('CPT061', 'A0061', '2013-02-01', 'BRG001', 1, 'CAB001', 'JENJ001'),
('CPT062', 'A0062', '2013-02-01', 'BRG002', 19, 'CAB001', 'JENJ001'),
('CPT063', 'A0032', '2013-02-03', 'BRG001', 11, 'CAB001', 'JENJ001'),
('CPT064', 'A0033', '2013-02-03', 'BRG002', 4, 'CAB001', 'JENJ001'),
('CPT065', 'A0034', '2013-02-03', 'BRG001', 7, 'CAB001', 'JENJ001'),
('CPT066', 'A0035', '2013-02-03', 'BRG002', 5, 'CAB001', 'JENJ001'),
('CPT067', 'A0036', '2013-02-04', 'BRG001', 3, 'CAB001', 'JENJ001'),
('CPT068', 'A0037', '2013-02-04', 'BRG002', 8, 'CAB001', 'JENJ001'),
('CPT069', 'A0038', '2013-02-05', 'BRG001', 11, 'CAB001', 'JENJ001'),
('CPT070', 'A0039', '2013-02-05', 'BRG002', 7, 'CAB001', 'JENJ001'),
('CPT071', 'A0040', '2013-02-06', 'BRG001', 9, 'CAB001', 'JENJ001'),
('CPT072', 'A0041', '2013-02-06', 'BRG002', 1, 'CAB001', 'JENJ001'),
('CPT073', 'A0042', '2013-02-07', 'BRG001', 6, 'CAB001', 'JENJ001'),
('CPT074', 'A0043', '2013-02-07', 'BRG002', 6, 'CAB001', 'JENJ001'),
('CPT075', 'A0044', '2013-02-08', 'BRG001', 8, 'CAB001', 'JENJ001'),
('CPT076', 'A0045', '2013-02-08', 'BRG002', 7, 'CAB001', 'JENJ001'),
('CPT077', 'A0046', '2013-02-09', 'BRG001', 10, 'CAB001', 'JENJ001'),
('CPT078', 'A0047', '2013-02-09', 'BRG002', 10, 'CAB001', 'JENJ001'),
('CPT079', 'A0048', '2013-02-10', 'BRG001', 10, 'CAB001', 'JENJ001'),
('CPT080', 'A0049', '2013-02-10', 'BRG002', 9, 'CAB001', 'JENJ001'),
('CPT081', 'A0050', '2013-02-11', 'BRG001', 8, 'CAB001', 'JENJ001'),
('CPT082', 'A0051', '2013-02-11', 'BRG002', 0, 'CAB001', 'JENJ001'),
('CPT083', 'A0052', '2013-02-12', 'BRG001', 12, 'CAB001', 'JENJ001'),
('CPT084', 'A0053', '2013-02-12', 'BRG002', 8, 'CAB001', 'JENJ001'),
('CPT085', 'A0054', '2013-02-13', 'BRG001', 10, 'CAB001', 'JENJ001'),
('CPT086', 'A0055', '2013-02-13', 'BRG002', 5, 'CAB001', 'JENJ001'),
('CPT087', 'A0056', '2013-02-14', 'BRG001', 8, 'CAB001', 'JENJ001'),
('CPT088', 'A0057', '2013-02-14', 'BRG002', 12, 'CAB001', 'JENJ001'),
('CPT089', 'A0058', '2013-02-15', 'BRG001', 15, 'CAB001', 'JENJ001'),
('CPT090', 'A0059', '2013-02-15', 'BRG002', 10, 'CAB001', 'JENJ001'),
('CPT091', 'A0060', '2013-02-16', 'BRG001', 7, 'CAB001', 'JENJ001'),
('CPT092', 'A0061', '2013-02-16', 'BRG002', 8, 'CAB001', 'JENJ001'),
('CPT093', 'A0062', '2013-02-17', 'BRG001', 1, 'CAB001', 'JENJ001'),
('CPT094', 'A0063', '2013-02-17', 'BRG002', 14, 'CAB001', 'JENJ001'),
('CPT095', 'A0064', '2013-02-18', 'BRG001', 2, 'CAB001', 'JENJ001'),
('CPT096', 'A0065', '2013-02-18', 'BRG002', 10, 'CAB001', 'JENJ001'),
('CPT097', 'A0066', '2013-02-19', 'BRG001', 5, 'CAB001', 'JENJ001'),
('CPT098', 'A0067', '2013-02-19', 'BRG002', 6, 'CAB001', 'JENJ001'),
('CPT099', 'A0068', '2013-02-20', 'BRG001', 15, 'CAB001', 'JENJ001'),
('CPT100', 'A0069', '2013-02-20', 'BRG002', 11, 'CAB001', 'JENJ001'),
('CPT101', 'A0070', '2013-02-21', 'BRG001', 2, 'CAB001', 'JENJ001'),
('CPT102', 'A0071', '2013-02-21', 'BRG002', 11, 'CAB001', 'JENJ001'),
('CPT103', 'A0072', '2013-02-23', 'BRG001', 15, 'CAB001', 'JENJ001'),
('CPT104', 'A0073', '2013-02-23', 'BRG002', 8, 'CAB001', 'JENJ001'),
('CPT105', 'A0074', '2013-02-23', 'BRG001', 9, 'CAB001', 'JENJ001'),
('CPT106', 'A0075', '2013-02-23', 'BRG002', 11, 'CAB001', 'JENJ001'),
('CPT107', 'A0076', '2013-02-24', 'BRG001', 3, 'CAB001', 'JENJ001'),
('CPT108', 'A0077', '2013-02-24', 'BRG002', 11, 'CAB001', 'JENJ001'),
('CPT109', 'A0078', '2013-02-25', 'BRG001', 2, 'CAB001', 'JENJ001'),
('CPT110', 'A0079', '2013-02-25', 'BRG002', 12, 'CAB001', 'JENJ001'),
('CPT111', 'A0080', '2013-02-26', 'BRG001', 10, 'CAB001', 'JENJ001'),
('CPT112', 'A0081', '2013-02-26', 'BRG002', 4, 'CAB001', 'JENJ001'),
('CPT113', 'A0082', '2013-02-27', 'BRG001', 0, 'CAB001', 'JENJ001'),
('CPT114', 'A0083', '2013-02-27', 'BRG002', 8, 'CAB001', 'JENJ001'),
('CPT115', 'A0084', '2013-02-28', 'BRG001', 13, 'CAB001', 'JENJ001'),
('CPT116', 'A0085', '2013-02-28', 'BRG002', 9, 'CAB001', 'JENJ001'),
('CPT117', 'A0086', '2013-03-01', 'BRG001', 3, 'CAB001', 'JENJ001'),
('CPT118', 'A0087', '2013-03-01', 'BRG002', 6, 'CAB001', 'JENJ001'),
('CPT119', 'A0088', '2013-03-02', 'BRG001', 13, 'CAB001', 'JENJ001'),
('CPT120', 'A0089', '2013-03-02', 'BRG002', 11, 'CAB001', 'JENJ001'),
('CPT121', 'A0090', '2013-03-03', 'BRG001', 8, 'CAB001', 'JENJ001'),
('CPT122', 'A0091', '2013-03-03', 'BRG002', 1, 'CAB001', 'JENJ001'),
('CPT123', 'A0092', '2013-03-04', 'BRG001', 3, 'CAB001', 'JENJ001'),
('CPT124', 'A0093', '2013-03-04', 'BRG002', 6, 'CAB001', 'JENJ001'),
('CPT125', 'A0094', '2013-03-05', 'BRG001', 8, 'CAB001', 'JENJ001'),
('CPT126', 'A0095', '2013-03-05', 'BRG002', 11, 'CAB001', 'JENJ001'),
('CPT127', 'A0096', '2013-03-06', 'BRG001', 14, 'CAB001', 'JENJ001'),
('CPT128', 'A0097', '2013-03-06', 'BRG002', 14, 'CAB001', 'JENJ001'),
('CPT129', 'A0098', '2013-03-07', 'BRG001', 8, 'CAB001', 'JENJ001'),
('CPT130', 'A0099', '2013-03-07', 'BRG002', 10, 'CAB001', 'JENJ001'),
('CPT131', 'A0100', '2013-03-08', 'BRG001', 16, 'CAB001', 'JENJ001'),
('CPT132', 'A0101', '2013-03-08', 'BRG002', 1, 'CAB001', 'JENJ001'),
('CPT133', 'A0102', '2013-03-09', 'BRG001', 12, 'CAB001', 'JENJ001'),
('CPT134', 'A0103', '2013-03-09', 'BRG002', 13, 'CAB001', 'JENJ001'),
('CPT135', 'A0104', '2013-03-10', 'BRG001', 4, 'CAB001', 'JENJ001'),
('CPT136', 'A0105', '2013-03-10', 'BRG002', 15, 'CAB001', 'JENJ001'),
('CPT137', 'A0106', '2013-03-11', 'BRG001', 12, 'CAB001', 'JENJ001'),
('CPT138', 'A0107', '2013-03-11', 'BRG002', 11, 'CAB001', 'JENJ001'),
('CPT139', 'A0108', '2013-03-12', 'BRG001', 12, 'CAB001', 'JENJ001'),
('CPT140', 'A0109', '2013-03-12', 'BRG002', 0, 'CAB001', 'JENJ001'),
('CPT141', 'A0110', '2013-03-13', 'BRG001', 1, 'CAB001', 'JENJ001'),
('CPT142', 'A0111', '2013-03-13', 'BRG002', 3, 'CAB001', 'JENJ001'),
('CPT143', 'A0112', '2013-03-14', 'BRG001', 1, 'CAB001', 'JENJ001'),
('CPT144', 'A0113', '2013-03-14', 'BRG002', 17, 'CAB001', 'JENJ001'),
('CPT145', 'A0114', '2013-03-15', 'BRG001', 4, 'CAB001', 'JENJ001'),
('CPT146', 'A0115', '2013-03-15', 'BRG002', 6, 'CAB001', 'JENJ001'),
('CPT147', 'A0116', '2013-03-16', 'BRG001', 9, 'CAB001', 'JENJ001'),
('CPT148', 'A0117', '2013-03-16', 'BRG002', 0, 'CAB001', 'JENJ001'),
('CPT149', 'A0118', '2013-03-17', 'BRG001', 9, 'CAB001', 'JENJ001'),
('CPT150', 'A0119', '2013-03-17', 'BRG002', 0, 'CAB001', 'JENJ001'),
('CPT151', 'A0120', '2013-03-18', 'BRG001', 4, 'CAB001', 'JENJ001'),
('CPT152', 'A0121', '2013-03-18', 'BRG002', 15, 'CAB001', 'JENJ001'),
('CPT153', 'A0122', '2013-03-19', 'BRG001', 6, 'CAB001', 'JENJ001'),
('CPT154', 'A0123', '2013-03-19', 'BRG002', 13, 'CAB001', 'JENJ001'),
('CPT155', 'A0124', '2013-03-20', 'BRG001', 13, 'CAB001', 'JENJ001'),
('CPT156', 'A0125', '2013-03-20', 'BRG002', 16, 'CAB001', 'JENJ001'),
('CPT157', 'A0126', '2013-03-21', 'BRG001', 13, 'CAB001', 'JENJ001'),
('CPT158', 'A0127', '2013-03-21', 'BRG002', 17, 'CAB001', 'JENJ001'),
('CPT159', 'A0128', '2013-03-22', 'BRG001', 15, 'CAB001', 'JENJ001'),
('CPT160', 'A0129', '2013-03-22', 'BRG002', 0, 'CAB001', 'JENJ001'),
('CPT161', 'A0130', '2013-03-23', 'BRG001', 14, 'CAB001', 'JENJ001'),
('CPT162', 'A0131', '2013-03-23', 'BRG002', 6, 'CAB001', 'JENJ001'),
('CPT163', 'A0132', '2013-03-24', 'BRG001', 11, 'CAB001', 'JENJ001'),
('CPT164', 'A0133', '2013-03-24', 'BRG002', 6, 'CAB001', 'JENJ001'),
('CPT165', 'A0134', '2013-03-25', 'BRG001', 6, 'CAB001', 'JENJ001'),
('CPT166', 'A0135', '2013-03-25', 'BRG002', 13, 'CAB001', 'JENJ001'),
('CPT167', 'A0136', '2013-03-26', 'BRG001', 10, 'CAB001', 'JENJ001'),
('CPT168', 'A0137', '2013-03-26', 'BRG002', 14, 'CAB001', 'JENJ001'),
('CPT169', 'A0138', '2013-03-27', 'BRG001', 13, 'CAB001', 'JENJ001'),
('CPT170', 'A0139', '2013-03-27', 'BRG002', 6, 'CAB001', 'JENJ001'),
('CPT171', 'A0140', '2013-03-28', 'BRG001', 13, 'CAB001', 'JENJ001'),
('CPT172', 'A0141', '2013-03-28', 'BRG002', 4, 'CAB001', 'JENJ001'),
('CPT173', 'A0142', '2013-03-29', 'BRG001', 0, 'CAB001', 'JENJ001'),
('CPT174', 'A0143', '2013-03-29', 'BRG002', 3, 'CAB001', 'JENJ001'),
('CPT175', 'A0144', '2013-03-30', 'BRG001', 2, 'CAB001', 'JENJ001'),
('CPT176', 'A0145', '2013-03-30', 'BRG002', 16, 'CAB001', 'JENJ001'),
('CPT177', 'A0146', '2013-03-31', 'BRG001', 9, 'CAB001', 'JENJ001'),
('CPT178', 'A0147', '2013-03-31', 'BRG002', 11, 'CAB001', 'JENJ001'),
('CPT179', 'A0148', '2013-04-02', 'BRG001', 13, 'CAB001', 'JENJ001'),
('CPT180', 'A0149', '2013-04-02', 'BRG002', 10, 'CAB001', 'JENJ001'),
('CPT181', 'A0150', '2013-04-03', 'BRG001', 13, 'CAB001', 'JENJ001'),
('CPT182', 'A0151', '2013-04-03', 'BRG002', 11, 'CAB001', 'JENJ001'),
('CPT183', 'A0152', '2013-04-04', 'BRG001', 12, 'CAB001', 'JENJ001'),
('CPT184', 'A0153', '2013-04-04', 'BRG002', 18, 'CAB001', 'JENJ001'),
('CPT185', 'A0154', '2013-04-05', 'BRG001', 5, 'CAB001', 'JENJ001'),
('CPT186', 'A0155', '2013-04-05', 'BRG002', 3, 'CAB001', 'JENJ001'),
('CPT187', 'A0156', '2013-04-06', 'BRG001', 9, 'CAB001', 'JENJ001'),
('CPT188', 'A0157', '2013-04-06', 'BRG002', 10, 'CAB001', 'JENJ001'),
('CPT189', 'A0158', '2013-04-07', 'BRG001', 5, 'CAB001', 'JENJ001'),
('CPT190', 'A0159', '2013-04-07', 'BRG002', 8, 'CAB001', 'JENJ001'),
('CPT191', 'A0160', '2013-04-08', 'BRG001', 14, 'CAB001', 'JENJ001'),
('CPT192', 'A0161', '2013-04-08', 'BRG002', 11, 'CAB001', 'JENJ001'),
('CPT193', 'A0162', '2013-04-09', 'BRG001', 11, 'CAB001', 'JENJ001'),
('CPT194', 'A0163', '2013-04-09', 'BRG002', 11, 'CAB001', 'JENJ001'),
('CPT195', 'A0164', '2013-04-10', 'BRG001', 16, 'CAB001', 'JENJ001'),
('CPT196', 'A0165', '2013-04-10', 'BRG002', 6, 'CAB001', 'JENJ001'),
('CPT197', 'A0166', '2013-04-11', 'BRG001', 3, 'CAB001', 'JENJ001'),
('CPT198', 'A0167', '2013-04-11', 'BRG002', 10, 'CAB001', 'JENJ001'),
('CPT199', 'A0168', '2013-04-12', 'BRG001', 15, 'CAB001', 'JENJ001'),
('CPT200', 'A0169', '2013-04-12', 'BRG002', 4, 'CAB001', 'JENJ001'),
('CPT201', 'A0170', '2013-04-13', 'BRG001', 19, 'CAB001', 'JENJ001'),
('CPT202', 'A0171', '2013-04-13', 'BRG002', 11, 'CAB001', 'JENJ001'),
('CPT203', 'A0172', '2013-04-14', 'BRG001', 13, 'CAB001', 'JENJ001'),
('CPT204', 'A0173', '2013-04-14', 'BRG002', 5, 'CAB001', 'JENJ001'),
('CPT205', 'A0174', '2013-04-15', 'BRG001', 15, 'CAB001', 'JENJ001'),
('CPT206', 'A0175', '2013-04-15', 'BRG002', 18, 'CAB001', 'JENJ001'),
('CPT207', 'A0176', '2013-04-16', 'BRG001', 14, 'CAB001', 'JENJ001'),
('CPT208', 'A0177', '2013-04-16', 'BRG002', 3, 'CAB001', 'JENJ001'),
('CPT209', 'A0178', '2013-04-17', 'BRG001', 8, 'CAB001', 'JENJ001'),
('CPT210', 'A0179', '2013-04-17', 'BRG002', 8, 'CAB001', 'JENJ001'),
('CPT211', 'A0180', '2013-04-18', 'BRG001', 16, 'CAB001', 'JENJ001'),
('CPT212', 'A0181', '2013-04-18', 'BRG002', 6, 'CAB001', 'JENJ001'),
('CPT213', 'A0182', '2013-04-19', 'BRG001', 11, 'CAB001', 'JENJ001'),
('CPT214', 'A0183', '2013-04-19', 'BRG002', 15, 'CAB001', 'JENJ001'),
('CPT215', 'A0184', '2013-04-20', 'BRG001', 8, 'CAB001', 'JENJ001'),
('CPT216', 'A0185', '2013-04-20', 'BRG002', 8, 'CAB001', 'JENJ001'),
('CPT217', 'A0186', '2013-04-21', 'BRG001', 8, 'CAB001', 'JENJ001'),
('CPT218', 'A0187', '2013-04-21', 'BRG002', 10, 'CAB001', 'JENJ001'),
('CPT219', 'A0188', '2013-04-22', 'BRG001', 17, 'CAB001', 'JENJ001'),
('CPT220', 'A0189', '2013-04-22', 'BRG002', 17, 'CAB001', 'JENJ001'),
('CPT221', 'A0190', '2013-04-23', 'BRG001', 11, 'CAB001', 'JENJ001'),
('CPT222', 'A0191', '2013-04-23', 'BRG002', 9, 'CAB001', 'JENJ001'),
('CPT223', 'A0192', '2013-04-24', 'BRG001', 10, 'CAB001', 'JENJ001'),
('CPT224', 'A0193', '2013-04-24', 'BRG002', 9, 'CAB001', 'JENJ001'),
('CPT225', 'A0194', '2013-04-25', 'BRG001', 9, 'CAB001', 'JENJ001'),
('CPT226', 'A0195', '2013-04-25', 'BRG002', 16, 'CAB001', 'JENJ001'),
('CPT227', 'A0196', '2013-04-26', 'BRG001', 5, 'CAB001', 'JENJ001'),
('CPT228', 'A0197', '2013-04-26', 'BRG002', 17, 'CAB001', 'JENJ001'),
('CPT229', 'A0198', '2013-04-27', 'BRG001', 14, 'CAB001', 'JENJ001'),
('CPT230', 'A0199', '2013-04-27', 'BRG002', 13, 'CAB001', 'JENJ001'),
('CPT231', 'A0200', '2013-04-28', 'BRG001', 19, 'CAB001', 'JENJ001'),
('CPT232', 'A0201', '2013-04-28', 'BRG002', 11, 'CAB001', 'JENJ001'),
('CPT233', 'A0202', '2013-04-29', 'BRG001', 9, 'CAB001', 'JENJ001'),
('CPT234', 'A0203', '2013-04-29', 'BRG002', 12, 'CAB001', 'JENJ001'),
('CPT235', 'A0204', '2013-04-30', 'BRG001', 10, 'CAB001', 'JENJ001'),
('CPT236', 'A0205', '2013-04-30', 'BRG002', 5, 'CAB001', 'JENJ001'),
('CPT237', 'A0206', '2013-05-01', 'BRG001', 15, 'CAB001', 'JENJ001'),
('CPT238', 'A0207', '2013-05-01', 'BRG002', 17, 'CAB001', 'JENJ001'),
('CPT239', 'A0208', '2013-05-02', 'BRG001', 18, 'CAB001', 'JENJ001'),
('CPT240', 'A0209', '2013-05-02', 'BRG002', 10, 'CAB001', 'JENJ001'),
('CPT241', 'A0210', '2013-05-03', 'BRG001', 11, 'CAB001', 'JENJ001'),
('CPT242', 'A0211', '2013-05-03', 'BRG002', 18, 'CAB001', 'JENJ001'),
('CPT243', 'A0212', '2013-05-04', 'BRG001', 13, 'CAB001', 'JENJ001'),
('CPT244', 'A0213', '2013-05-04', 'BRG002', 6, 'CAB001', 'JENJ001'),
('CPT245', 'A0214', '2013-05-05', 'BRG001', 10, 'CAB001', 'JENJ001'),
('CPT246', 'A0215', '2013-05-05', 'BRG002', 4, 'CAB001', 'JENJ001'),
('CPT247', 'A0216', '2013-05-06', 'BRG001', 13, 'CAB001', 'JENJ001'),
('CPT248', 'A0217', '2013-05-06', 'BRG002', 17, 'CAB001', 'JENJ001'),
('CPT249', 'A0218', '2013-05-07', 'BRG001', 20, 'CAB001', 'JENJ001'),
('CPT250', 'A0219', '2013-05-07', 'BRG002', 4, 'CAB001', 'JENJ001'),
('CPT251', 'A0220', '2013-05-08', 'BRG001', 20, 'CAB001', 'JENJ001'),
('CPT252', 'A0221', '2013-05-08', 'BRG002', 8, 'CAB001', 'JENJ001'),
('CPT253', 'A0222', '2013-05-09', 'BRG001', 10, 'CAB001', 'JENJ001'),
('CPT254', 'A0223', '2013-05-09', 'BRG002', 10, 'CAB001', 'JENJ001'),
('CPT255', 'A0224', '2013-05-10', 'BRG001', 19, 'CAB001', 'JENJ001'),
('CPT256', 'A0225', '2013-05-10', 'BRG002', 18, 'CAB001', 'JENJ001'),
('CPT257', 'A0226', '2013-05-11', 'BRG001', 16, 'CAB001', 'JENJ001'),
('CPT258', 'A0227', '2013-05-11', 'BRG002', 5, 'CAB001', 'JENJ001'),
('CPT259', 'A0228', '2013-05-12', 'BRG001', 16, 'CAB001', 'JENJ001'),
('CPT260', 'A0229', '2013-05-12', 'BRG002', 9, 'CAB001', 'JENJ001'),
('CPT261', 'A0230', '2013-05-13', 'BRG001', 7, 'CAB001', 'JENJ001'),
('CPT262', 'A0231', '2013-05-13', 'BRG002', 15, 'CAB001', 'JENJ001'),
('CPT263', 'A0232', '2013-05-14', 'BRG001', 14, 'CAB001', 'JENJ001'),
('CPT264', 'A0233', '2013-05-14', 'BRG002', 3, 'CAB001', 'JENJ001'),
('CPT265', 'A0234', '2013-05-15', 'BRG001', 6, 'CAB001', 'JENJ001'),
('CPT266', 'A0235', '2013-05-15', 'BRG002', 20, 'CAB001', 'JENJ001'),
('CPT267', 'A0236', '2013-05-16', 'BRG001', 3, 'CAB001', 'JENJ001'),
('CPT268', 'A0237', '2013-05-16', 'BRG002', 15, 'CAB001', 'JENJ001'),
('CPT269', 'A0238', '2013-05-17', 'BRG001', 6, 'CAB001', 'JENJ001'),
('CPT270', 'A0239', '2013-05-17', 'BRG002', 8, 'CAB001', 'JENJ001'),
('CPT271', 'A0240', '2013-05-18', 'BRG001', 17, 'CAB001', 'JENJ001'),
('CPT272', 'A0241', '2013-05-18', 'BRG002', 11, 'CAB001', 'JENJ001'),
('CPT273', 'A0242', '2013-05-19', 'BRG001', 6, 'CAB001', 'JENJ001'),
('CPT274', 'A0243', '2013-05-19', 'BRG002', 16, 'CAB001', 'JENJ001'),
('CPT275', 'A0244', '2013-05-20', 'BRG001', 8, 'CAB001', 'JENJ001'),
('CPT276', 'A0245', '2013-05-20', 'BRG002', 11, 'CAB001', 'JENJ001'),
('CPT277', 'A0246', '2013-05-21', 'BRG001', 6, 'CAB001', 'JENJ001'),
('CPT278', 'A0247', '2013-05-21', 'BRG002', 18, 'CAB001', 'JENJ001'),
('CPT279', 'A0248', '2013-05-22', 'BRG001', 5, 'CAB001', 'JENJ001'),
('CPT280', 'A0249', '2013-05-22', 'BRG002', 14, 'CAB001', 'JENJ001'),
('CPT281', 'A0250', '2013-05-23', 'BRG001', 11, 'CAB001', 'JENJ001'),
('CPT282', 'A0251', '2013-05-23', 'BRG002', 7, 'CAB001', 'JENJ001'),
('CPT283', 'A0252', '2013-05-24', 'BRG001', 3, 'CAB001', 'JENJ001'),
('CPT284', 'A0253', '2013-05-24', 'BRG002', 4, 'CAB001', 'JENJ001'),
('CPT285', 'A0254', '2013-05-25', 'BRG001', 20, 'CAB001', 'JENJ001'),
('CPT286', 'A0255', '2013-05-25', 'BRG002', 13, 'CAB001', 'JENJ001'),
('CPT287', 'A0256', '2013-05-26', 'BRG001', 21, 'CAB001', 'JENJ001'),
('CPT288', 'A0257', '2013-05-26', 'BRG002', 20, 'CAB001', 'JENJ001'),
('CPT289', 'A0258', '2013-05-27', 'BRG001', 5, 'CAB001', 'JENJ001'),
('CPT290', 'A0259', '2013-05-27', 'BRG002', 6, 'CAB001', 'JENJ001'),
('CPT291', 'A0260', '2013-05-28', 'BRG001', 3, 'CAB001', 'JENJ001'),
('CPT292', 'A0261', '2013-05-28', 'BRG002', 13, 'CAB001', 'JENJ001'),
('CPT293', 'A0262', '2013-05-29', 'BRG001', 4, 'CAB001', 'JENJ001'),
('CPT294', 'A0263', '2013-05-29', 'BRG002', 11, 'CAB001', 'JENJ001'),
('CPT295', 'A0264', '2013-05-30', 'BRG001', 4, 'CAB001', 'JENJ001'),
('CPT296', 'A0265', '2013-05-30', 'BRG002', 19, 'CAB001', 'JENJ001'),
('CPT297', 'A0266', '2013-05-31', 'BRG001', 20, 'CAB001', 'JENJ001'),
('CPT298', 'A0267', '2013-05-31', 'BRG002', 15, 'CAB001', 'JENJ001'),
('CPT299', 'A0268', '2013-06-02', 'BRG001', 4, 'CAB001', 'JENJ001'),
('CPT300', 'A0269', '2013-06-02', 'BRG002', 11, 'CAB001', 'JENJ001'),
('CPT301', 'A0270', '2013-06-03', 'BRG001', 3, 'CAB001', 'JENJ001'),
('CPT302', 'A0271', '2013-06-03', 'BRG002', 14, 'CAB001', 'JENJ001'),
('CPT303', 'A0272', '2013-06-04', 'BRG001', 9, 'CAB001', 'JENJ001'),
('CPT304', 'A0273', '2013-06-04', 'BRG002', 7, 'CAB001', 'JENJ001'),
('CPT305', 'A0274', '2013-06-05', 'BRG001', 12, 'CAB001', 'JENJ001'),
('CPT306', 'A0275', '2013-06-05', 'BRG002', 15, 'CAB001', 'JENJ001'),
('CPT307', 'A0276', '2013-06-06', 'BRG001', 10, 'CAB001', 'JENJ001'),
('CPT308', 'A0277', '2013-06-06', 'BRG002', 8, 'CAB001', 'JENJ001'),
('CPT309', 'A0278', '2013-06-07', 'BRG001', 16, 'CAB001', 'JENJ001'),
('CPT310', 'A0279', '2013-06-07', 'BRG002', 7, 'CAB001', 'JENJ001'),
('CPT311', 'A0280', '2013-06-08', 'BRG001', 11, 'CAB001', 'JENJ001'),
('CPT312', 'A0281', '2013-06-08', 'BRG002', 9, 'CAB001', 'JENJ001'),
('CPT313', 'A0282', '2013-06-09', 'BRG001', 2, 'CAB001', 'JENJ001'),
('CPT314', 'A0283', '2013-06-09', 'BRG002', 9, 'CAB001', 'JENJ001'),
('CPT315', 'A0284', '2013-06-10', 'BRG001', 13, 'CAB001', 'JENJ001'),
('CPT316', 'A0285', '2013-06-10', 'BRG002', 2, 'CAB001', 'JENJ001'),
('CPT317', 'A0286', '2013-06-11', 'BRG001', 2, 'CAB001', 'JENJ001'),
('CPT318', 'A0287', '2013-06-11', 'BRG002', 14, 'CAB001', 'JENJ001'),
('CPT319', 'A0288', '2013-06-12', 'BRG001', 9, 'CAB001', 'JENJ001'),
('CPT320', 'A0289', '2013-06-12', 'BRG002', 13, 'CAB001', 'JENJ001'),
('CPT321', 'A0290', '2013-06-13', 'BRG001', 2, 'CAB001', 'JENJ001'),
('CPT322', 'A0291', '2013-06-13', 'BRG002', 6, 'CAB001', 'JENJ001'),
('CPT323', 'A0292', '2013-06-14', 'BRG001', 11, 'CAB001', 'JENJ001'),
('CPT324', 'A0293', '2013-06-14', 'BRG002', 7, 'CAB001', 'JENJ001'),
('CPT325', 'A0294', '2013-06-15', 'BRG001', 10, 'CAB001', 'JENJ001'),
('CPT326', 'A0295', '2013-06-15', 'BRG002', 2, 'CAB001', 'JENJ001'),
('CPT327', 'A0296', '2013-06-16', 'BRG001', 3, 'CAB001', 'JENJ001'),
('CPT328', 'A0297', '2013-06-16', 'BRG002', 2, 'CAB001', 'JENJ001'),
('CPT329', 'A0298', '2013-06-17', 'BRG001', 5, 'CAB001', 'JENJ001'),
('CPT330', 'A0299', '2013-06-17', 'BRG002', 16, 'CAB001', 'JENJ001'),
('CPT331', 'A0300', '2013-06-18', 'BRG001', 4, 'CAB001', 'JENJ001'),
('CPT332', 'A0301', '2013-06-18', 'BRG002', 15, 'CAB001', 'JENJ001'),
('CPT333', 'A0302', '2013-06-19', 'BRG001', 8, 'CAB001', 'JENJ001'),
('CPT334', 'A0303', '2013-06-19', 'BRG002', 7, 'CAB001', 'JENJ001'),
('CPT335', 'A0304', '2013-06-20', 'BRG001', 6, 'CAB001', 'JENJ001'),
('CPT336', 'A0305', '2013-06-20', 'BRG002', 6, 'CAB001', 'JENJ001'),
('CPT337', 'A0306', '2013-06-21', 'BRG001', 7, 'CAB001', 'JENJ001'),
('CPT338', 'A0307', '2013-06-21', 'BRG002', 8, 'CAB001', 'JENJ001'),
('CPT339', 'A0308', '2013-06-22', 'BRG001', 12, 'CAB001', 'JENJ001'),
('CPT340', 'A0309', '2013-06-22', 'BRG002', 6, 'CAB001', 'JENJ001'),
('CPT341', 'A0310', '2013-06-23', 'BRG001', 5, 'CAB001', 'JENJ001'),
('CPT342', 'A0311', '2013-06-23', 'BRG002', 4, 'CAB001', 'JENJ001'),
('CPT343', 'A0312', '2013-06-24', 'BRG001', 5, 'CAB001', 'JENJ001'),
('CPT344', 'A0313', '2013-06-24', 'BRG002', 10, 'CAB001', 'JENJ001'),
('CPT345', 'A0314', '2013-06-25', 'BRG001', 13, 'CAB001', 'JENJ001'),
('CPT346', 'A0315', '2013-06-25', 'BRG002', 5, 'CAB001', 'JENJ001'),
('CPT347', 'A0316', '2013-06-26', 'BRG001', 6, 'CAB001', 'JENJ001'),
('CPT348', 'A0317', '2013-06-26', 'BRG002', 7, 'CAB001', 'JENJ001'),
('CPT349', 'A0318', '2013-06-27', 'BRG001', 6, 'CAB001', 'JENJ001'),
('CPT350', 'A0319', '2013-06-27', 'BRG002', 7, 'CAB001', 'JENJ001'),
('CPT351', 'A0320', '2013-06-28', 'BRG001', 8, 'CAB001', 'JENJ001'),
('CPT352', 'A0321', '2013-06-28', 'BRG002', 11, 'CAB001', 'JENJ001'),
('CPT353', 'A0322', '2013-06-29', 'BRG001', 12, 'CAB001', 'JENJ001'),
('CPT354', 'A0323', '2013-06-29', 'BRG002', 15, 'CAB001', 'JENJ001'),
('CPT355', 'A0324', '2013-06-30', 'BRG001', 8, 'CAB001', 'JENJ001'),
('CPT356', 'A0325', '2013-06-30', 'BRG002', 6, 'CAB001', 'JENJ001'),
('CPT357', 'A0326', '2013-07-01', 'BRG001', 3, 'CAB001', 'JENJ001'),
('CPT358', 'A0327', '2013-07-01', 'BRG002', 12, 'CAB001', 'JENJ001');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=103 ;

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
(91, 'BRG002', 201401, 282, 'CAB001', '2014-06-09'),
(92, 'BRG002', 201402, 284, 'CAB001', '2014-06-09'),
(93, 'BRG002', 201403, 282, 'CAB001', '2014-06-09'),
(94, 'BRG002', 201404, 281, 'CAB001', '2014-06-09'),
(95, 'BRG002', 201405, 278, 'CAB001', '2014-06-09'),
(96, 'BRG002', 201406, 283, 'CAB001', '2014-06-09'),
(97, 'BRG001', 201401, 275, 'CAB001', '2014-06-22'),
(98, 'BRG001', 201402, 287, 'CAB001', '2014-06-22'),
(99, 'BRG001', 201403, 280, 'CAB001', '2014-06-22'),
(100, 'BRG001', 201404, 272, 'CAB001', '2014-06-22'),
(101, 'BRG001', 201405, 269, 'CAB001', '2014-06-22'),
(102, 'BRG001', 201406, 286, 'CAB001', '2014-06-22');

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
-- Constraints for table `tb_detail_pemesanan`
--
ALTER TABLE `tb_detail_pemesanan`
  ADD CONSTRAINT `tb_detail_pemesanan_ibfk_1` FOREIGN KEY (`kode_pesan`) REFERENCES `tb_pemesanan` (`kode_pesan`) ON DELETE CASCADE ON UPDATE CASCADE;

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
  ADD CONSTRAINT `tb_logstokjual_ibfk_2` FOREIGN KEY (`kode_user`) REFERENCES `tb_user` (`kode_user`) ON DELETE CASCADE ON UPDATE CASCADE,
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
  ADD CONSTRAINT `tb_penjualan_ibfk_2` FOREIGN KEY (`kode_jenistransaksijual`) REFERENCES `tb_jenistransaksijual` (`kode_jenistransaksijual`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_penjualan_ibfk_3` FOREIGN KEY (`kode_barang`) REFERENCES `tb_barang` (`kode_barang`) ON DELETE CASCADE ON UPDATE CASCADE;

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
