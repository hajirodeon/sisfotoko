-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 06, 2018 at 05:23 AM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sisfotoko`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `kd` varchar(50) NOT NULL DEFAULT '',
  `username` varchar(15) NOT NULL DEFAULT '',
  `password` varchar(50) NOT NULL DEFAULT '',
  `postdate` datetime DEFAULT NULL,
  `time_login` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`kd`, `username`, `password`, `postdate`, `time_login`) VALUES
('e4ea2f7dfb2e5c51e38998599e90afc2', 'admin', '21232f297a57a5a743894a0e4a801fc3', '2011-01-15 14:37:27', '2018-03-06 05:23:06'),
('3f2356d42f7fa55bd3c3048819d7d780', 'hajir', '625198080f3e1e8fb9d1ddd0650bd611', '2008-06-23 16:54:50', '2008-12-15 12:54:28'),
('41dc0f511522db43f09a56ac956e311d', '1', 'c4ca4238a0b923820dcc509a6f75849b', '2010-12-19 10:57:52', '2010-12-19 10:58:58');

-- --------------------------------------------------------

--
-- Table structure for table `admks`
--

CREATE TABLE `admks` (
  `kd` varchar(50) NOT NULL DEFAULT '',
  `username` varchar(15) NOT NULL DEFAULT '',
  `password` varchar(50) NOT NULL DEFAULT '',
  `postdate` datetime DEFAULT NULL,
  `time_login` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admks`
--

INSERT INTO `admks` (`kd`, `username`, `password`, `postdate`, `time_login`) VALUES
('4e4050f2b46ead637ea2539efaac6566', 'admin', '21232f297a57a5a743894a0e4a801fc3', '2008-01-15 14:43:27', '2010-12-19 14:31:08'),
('aadb0e72a49a59c44a6f6643267606cb', 'hajir', '625198080f3e1e8fb9d1ddd0650bd611', '2008-09-07 03:41:24', '2010-12-19 10:12:54'),
('ce27368a079fd0b1fcbb2d3fba84fb29', '1', 'c4ca4238a0b923820dcc509a6f75849b', '2010-12-19 10:57:38', '2018-03-06 05:23:33');

-- --------------------------------------------------------

--
-- Table structure for table `akses_admin`
--

CREATE TABLE `akses_admin` (
  `kd` varchar(50) NOT NULL DEFAULT '',
  `kd_admin` varchar(50) NOT NULL DEFAULT '',
  `kd_menu` varchar(50) NOT NULL DEFAULT '',
  `status` enum('false','true') NOT NULL DEFAULT 'false'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `akses_admin`
--

INSERT INTO `akses_admin` (`kd`, `kd_admin`, `kd_menu`, `status`) VALUES
('9357b8b9f2e5d1da279464930799736e', '3f2356d42f7fa55bd3c3048819d7d780', '39d506ef5aaceae06fa3f51d1e510dad9dd69', 'true'),
('92e949cbd5cb2a1327334b7bc59952d1', '3f2356d42f7fa55bd3c3048819d7d780', 'f91d09f9438a1d44b506e93701396df9d', 'true'),
('dfdf23e65419846f954d0ff0d77a721c', '3f2356d42f7fa55bd3c3048819d7d780', '0be7d3582a1f7a8867c0c563cdeb1532', 'true'),
('aa67578fa39c03aaa32a1db3ab044a1c', '3f2356d42f7fa55bd3c3048819d7d780', '05f281bafec4a683fee51502df160012', 'true'),
('56ce83a80496c00b74ec295954f52e62', '3f2356d42f7fa55bd3c3048819d7d780', 'aer353fda535f649439dae06fd69gf6vwop5he3403cba35e8', 'true'),
('17d69e0a5ce7995b6f8ddabc59c4c34e', '3f2356d42f7fa55bd3c3048819d7d780', '638a3f1303e96f628dac006fda506ef5aace', 'true'),
('591d86212f376a956b03425ce63a2783', '3f2356d42f7fa55bd3c3048819d7d780', '612006fda506ef5aace74939b91531351f', 'true'),
('26d09b2331a9c280d500fdc03936231e', '3f2356d42f7fa55bd3c3048819d7d780', '506ef5aace74707c9c04eecbaff82989', 'true'),
('33437f7e97bc29a245c77aa1a6d1cf3e', '3f2356d42f7fa55bd3c3048819d7d780', '9f9439dae1fb88e05ffe6b643eaab', 'true'),
('a023aee74424eed09b86eec03c920325', '3f2356d42f7fa55bd3c3048819d7d780', '6df9a16dac05ff5aace7411f99d49c9c0', 'true'),
('064591d68627c0dd94f94b53a158b659', '3f2356d42f7fa55bd3c3048819d7d780', '73d7dedac051d1e5166d841570789', 'true'),
('10a9a915a9c72b36560b06e54999ccdd', '3f2356d42f7fa55bd3c3048819d7d780', 'a16de41570789f8459b13c9eae90d2e2d', 'true'),
('764dac660e7cfd9c972b1f3568bcc4d0', '3f2356d42f7fa55bd3c3048819d7d780', '1d0e521bbc34c3c9382e5f1f098c5830', 'true'),
('a2799aeb0416e1bbcdc60bc87ae997e5', '3f2356d42f7fa55bd3c3048819d7d780', '694f4f94020d6de9dc501cf913d4b126', 'true'),
('1b111f9be58bf956aaccb7f462d2ce23', '3f2356d42f7fa55bd3c3048819d7d780', 'ce48242275e4da0a88ec6fe072e2d5d9', 'true'),
('eddf8a5b8f5283bb2b5ec256e456b9e8', '3f2356d42f7fa55bd3c3048819d7d780', '5ed83f06c8b1af2051a5f57c9c04e829', 'true'),
('db6f62f1864767f3804d1ea3295f2705', '3f2356d42f7fa55bd3c3048819d7d780', '75a02997bdf5a8e7a0ab73701396df9a', 'true'),
('826d52cd65b5e19f9053de9c9457ab50', '3f2356d42f7fa55bd3c3048819d7d780', '51c78ddfeb53b15955274b1dc5ac4cfe', 'true'),
('073d151cd6e1021d78d8cb788282c643', '3f2356d42f7fa55bd3c3048819d7d780', 'bfc4b9d0db7aca57ff98027547a4742b', 'true'),
('b6c8711965ae8352a5ea3387220ef5a7', '3f2356d42f7fa55bd3c3048819d7d780', '1486241c66305591cf00294d8590251b', 'true'),
('aa95c147089fc07cf84c54247f01289c', '3f2356d42f7fa55bd3c3048819d7d780', '19d6d52f80cd861164462a2275bad82d', 'true'),
('3b61814f9aa205fcbe58358f6f63d9b6', '3f2356d42f7fa55bd3c3048819d7d780', 'd3119dce04aa638a3f1303e96f4ea082', 'true'),
('5ec49a24f84aaa5e51b964b3aaf6fc95', '3f2356d42f7fa55bd3c3048819d7d780', '0e4479d16993aece37a3113b38622ba3', 'true'),
('22c8c920476f60db0245938740487007', '3f2356d42f7fa55bd3c3048819d7d780', 'bafec4a683570789f84fe4e5be57e5', 'true'),
('feeba0c10c97f6c15aefe316cf5ce73c', '3f2356d42f7fa55bd3c3048819d7d780', 'be9da7d3582a1f5ae49c7a311e510dad13', 'true'),
('c27f885e6463af574257a34b4a1a5efd', '3f2356d42f7fa55bd3c3048819d7d780', 'a3fdaf9439dae06fd69403cba35e8', 'true'),
('539fb304e3b0493461c25240f2c74b19', '3f2356d42f7fa55bd3c3048819d7d780', '428a1d44b506ef5aace7411f98f939b9', 'true'),
('bd3d5de117c00d235de320c1cb2b8cba', '3f2356d42f7fa55bd3c3048819d7d780', '6de41569403c9e2b5be51f09f9439da', 'true'),
('dd8549b424029a0bfecab4d6f25f9dc1', '3f2356d42f7fa55bd3c3048819d7d780', 'e5f1f444078c5b1be1a4fda506ef5aac73b1', 'true'),
('da88cfafe9db8a16c4a7e38682541078', '3f2356d42f7fa55bd3c3048819d7d780', '9fdad9dbda7d3582a1f7a80c563cdeb', 'true'),
('84409936c473d396d042b7bf63b819e6', '3f2356d42f7fa55bd3c3048819d7d780', '74939b9152a1f7a886e41570789f8459b13c', 'true'),
('620082ac2d230cbcd76af835859bfe1d', '3f2356d42f7fa55bd3c3048819d7d780', 'dbd36f91d09f39da7d3582a1f7a8867c0c', 'true'),
('e34938dec342262cac1c8d29de4c27ba', '3f2356d42f7fa55bd3c3048819d7d780', '396df9a16dac051d1e5102449e6d9dbd', 'true'),
('2ca14ab6243941e05b8fba18e3bb3e70', '3f2356d42f7fa55bd3c3048819d7d780', '1351f09f9439dae06fda506ef5aace', 'true'),
('a396cdbd08bc71830f78816b904cca13', '3f2356d42f7fa55bd3c3048819d7d780', 'c0fc5d6ecba3fdad9dbdef5aace74939b', 'true'),
('860d4dec0f0a1d39c635798f95008023', '3f2356d42f7fa55bd3c3048819d7d780', '6fda506e01e6b643eaa4e5be57a3113', 'true'),
('bf74bca3693591bc159971eab9a9772b', '3f2356d42f7fa55bd3c3048819d7d780', '8353b5j35bj56b346j345', 'true'),
('47bf37f4e0087cc24088f3551c5897f7', '3f2356d42f7fa55bd3c3048819d7d780', 'kj3b4jb6k3456345345h436', 'true'),
('e56dfd7248b9cb7584f0103a39fb649a', '41dc0f511522db43f09a56ac956e311d', '', 'false'),
('f2090cc26f4662168c2cfb5af90ca7d5', '41dc0f511522db43f09a56ac956e311d', '', 'false'),
('610acf339e91c7b4e568e78d2f7057df', '41dc0f511522db43f09a56ac956e311d', '', 'false'),
('484f22b993e62605027042fdaabea6c8', '41dc0f511522db43f09a56ac956e311d', '', 'false'),
('fc6f066366389b56d19ba4d3efb13b2a', '41dc0f511522db43f09a56ac956e311d', '', 'false'),
('cf0087c5f0193d9ab6779bc14001845d', '41dc0f511522db43f09a56ac956e311d', '', 'false'),
('6de65e786137d6ab40b65171978c7f05', '41dc0f511522db43f09a56ac956e311d', '', 'false'),
('72995ee5b2496dba712115acb7993dce', '41dc0f511522db43f09a56ac956e311d', '', 'false'),
('844bbd93c8b6d0cebbc0005b6e82ce5b', '41dc0f511522db43f09a56ac956e311d', '', 'false'),
('d9fafa8e060640d2ab9798f88a8a1bd9', '41dc0f511522db43f09a56ac956e311d', '', 'false'),
('47a216f936e7e42db2586f8f07c9dbe8', '41dc0f511522db43f09a56ac956e311d', '', 'false'),
('2a6ead7b58dd8dfd2152447f2d268899', '41dc0f511522db43f09a56ac956e311d', 'a16de41570789f8459b13c9eae90d2e2d', 'true'),
('deb193a17d901ac0dd8771702c8e459a', '41dc0f511522db43f09a56ac956e311d', '73d7dedac051d1e5166d841570789', 'true'),
('c47286d646c90d4c22adda61fa6df292', '41dc0f511522db43f09a56ac956e311d', '6df9a16dac05ff5aace7411f99d49c9c0', 'true'),
('e1df22de08937a1bc7b58d4d43f02911', '41dc0f511522db43f09a56ac956e311d', '9f9439dae1fb88e05ffe6b643eaab', 'true'),
('4fbbba650e56f11c03793d874ae5403c', '41dc0f511522db43f09a56ac956e311d', '506ef5aace74707c9c04eecbaff82989', 'true'),
('da3432d687def437255e7abc9bc39056', '41dc0f511522db43f09a56ac956e311d', '', 'false'),
('02422638dba358e9758b311f1e52ce55', '41dc0f511522db43f09a56ac956e311d', '', 'false'),
('e3a0aad71cb2af9d2a43c69c63dd6bf9', '41dc0f511522db43f09a56ac956e311d', '', 'false'),
('f5944bc1d66a0105d259e054675c9c6f', '41dc0f511522db43f09a56ac956e311d', '', 'false'),
('e53f3bc7286e432c74a1d4de940650d4', '41dc0f511522db43f09a56ac956e311d', '', 'false'),
('40cba21da87993d518920cf1a6c41218', '41dc0f511522db43f09a56ac956e311d', '', 'false'),
('4544ff3c41f75536051d92d7ea3b3dfc', '41dc0f511522db43f09a56ac956e311d', '', 'false'),
('c157019e138ce6d78475c6ec654fb12e', '41dc0f511522db43f09a56ac956e311d', '', 'false'),
('0415e861e4533f7b2edaf362c4b6f6b0', '41dc0f511522db43f09a56ac956e311d', '', 'false'),
('cc7245569b33d5598165be10f40bb54a', '41dc0f511522db43f09a56ac956e311d', '', 'false'),
('32ccb4a8b44e20cddc81217990d93f2d', '41dc0f511522db43f09a56ac956e311d', '', 'false'),
('ade83bc30b0afb4273b3d29de9a067d5', '41dc0f511522db43f09a56ac956e311d', '', 'false'),
('e704ce3b4e4dffdf443078032c979f91', '41dc0f511522db43f09a56ac956e311d', '', 'false'),
('9557826934f94c3ee4ae030cbccb7d13', '41dc0f511522db43f09a56ac956e311d', '', 'false'),
('9601363354f12882173c3d1b37181978', '41dc0f511522db43f09a56ac956e311d', '', 'false'),
('1cadc7fc538913b7f6c0c19f051b2f19', '41dc0f511522db43f09a56ac956e311d', '', 'false');

-- --------------------------------------------------------

--
-- Table structure for table `akses_menu`
--

CREATE TABLE `akses_menu` (
  `kd` varchar(50) NOT NULL DEFAULT '',
  `no` char(2) NOT NULL DEFAULT '',
  `no_sub` char(2) NOT NULL DEFAULT '',
  `no_kat` char(2) NOT NULL DEFAULT '',
  `judul` varchar(100) NOT NULL DEFAULT '',
  `pathx` varchar(255) NOT NULL DEFAULT '',
  `filex` varchar(255) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `akses_menu`
--

INSERT INTO `akses_menu` (`kd`, `no`, `no_sub`, `no_kat`, `judul`, `pathx`, `filex`) VALUES
('0e4479d16993aece37a3113b38622ba3', '1', '01', '1', 'Data Tahun Periode', '/adm/d/', 'tahun.php'),
('d3119dce04aa638a3f1303e96f4ea082', '1', '02', '2', 'Data Kategori', '/adm/d/', 'kategori.php'),
('19d6d52f80cd861164462a2275bad82d', '1', '03', '3', 'Data Satuan', '/adm/d/', 'satuan.php'),
('1486241c66305591cf00294d8590251b', '1', '04', '4', 'Data Merk', '/adm/d/', 'merk.php'),
('bfc4b9d0db7aca57ff98027547a4742b', '1', '05', '5', 'Data Kastumer', '/adm/d/', 'kastumer.php'),
('51c78ddfeb53b15955274b1dc5ac4cfe', '1', '06', '6', 'Data Supplier', '/adm/d/', 'supplier.php'),
('75a02997bdf5a8e7a0ab73701396df9a', '2', '01', '1', 'Stock Barang', '/adm/stock/', 'brg.php'),
('5ed83f06c8b1af2051a5f57c9c04e829', '2', '02', '1', 'Iron Stock', '/adm/stock/', 'iron.php'),
('9f9439dae1fb88e05ffe6b643eaab', '3', '04', '3', 'Lunas Pembelian [Per Bulan]', '/adm/trans/', 'lunas_beli_bln.php'),
('ce48242275e4da0a88ec6fe072e2d5d9', '2', '03', '1', 'Stock Rusak', '/adm/stock/', 'rusak.php'),
('694f4f94020d6de9dc501cf913d4b126', '2', '04', '1', 'Stock Hilang', '/adm/stock/', 'hilang.php'),
('1d0e521bbc34c3c9382e5f1f098c5830', '2', '05', '1', 'Stock Opname', '/adm/stock/', 'opname.php'),
('8353b5j35bj56b346j345', '5', '09', '1', 'Laporan Item Terlaris', '/adm/lap/', 'lap_item_laris.php'),
('612006fda506ef5aace74939b91531351f', '4', '01', '1', 'Set Barang', '/adm/trans/', 'set_brg.php'),
('428a1d44b506ef5aace7411f98f939b9', '5', '02', '1', 'Laporan History Pembelian', '/adm/lap/', 'lap_history_beli.php'),
('c0fc5d6ecba3fdad9dbdef5aace74939b', '5', '06', '1', 'Laporan History Nota', '/adm/lap/', 'lap_history_nota.php'),
('a3fdaf9439dae06fd69403cba35e8', '5', '01', '1', 'Laporan Pembelian', '/adm/lap/', 'lap_pembelian.php'),
('73d7dedac051d1e5166d841570789', '3', '02', '2', 'Hutang Pembelian [Per Bulan]', '/adm/trans/', 'hutang_beli_bln.php'),
('6fda506e01e6b643eaa4e5be57a3113', '5', '08', '1', 'Laporan History Penjualan', '/adm/lap/', 'lap_history_jual.php'),
('74939b9152a1f7a886e41570789f8459b13c', '5', '05', '1', 'Laporan Nota', '/adm/lap/', 'lap_nota.php'),
('6de41569403c9e2b5be51f09f9439da', '5', '03', '1', 'Laporan Barang Keluar [Penjualan]', '/adm/lap/', 'lap_brg_keluar_jual.php'),
('e5f1f444078c5b1be1a4fda506ef5aac73b1', '5', '04', '1', 'Laporan Barang Keluar [Nota]', '/adm/lap/', 'lap_brg_keluar_nota.php'),
('dbd36f91d09f39da7d3582a1f7a8867c0c', '5', '07', '1', 'Laporan Penjualan', '/adm/lap/', 'lap_penjualan.php'),
('a16de41570789f8459b13c9eae90d2e2d', '3', '01', '1', 'Pembelian', '/adm/trans/', 'beli.php'),
('638a3f1303e96f628dac006fda506ef5aace', '4', '03', '2', 'Penjualan', '/adm/trans/', 'jual.php'),
('f91d09f9438a1d44b506e93701396df9d', '4', '04', '4', 'Hutang Penjualan [Per Bulan]', '/adm/trans/', 'hutang_jual_bln.php'),
('bafec4a683570789f84fe4e5be57e5', '4', '06', '5', 'Lunas Penjualan [Per Bulan]', '/adm/trans/', 'lunas_jual_bln.php'),
('6df9a16dac05ff5aace7411f99d49c9c0', '3', '03', '2', 'Hutang Pembelian [Per Supplier]', '/adm/trans/', 'hutang_beli_sup.php'),
('506ef5aace74707c9c04eecbaff82989', '3', '05', '3', 'Lunas Pembelian [Per Supplier]', '/adm/trans/', 'lunas_beli_sup.php'),
('39d506ef5aaceae06fa3f51d1e510dad9dd69', '4', '05', '4', 'Hutang Penjualan [Per Kastumer]', '/adm/trans/', 'hutang_jual_kast.php'),
('be9da7d3582a1f5ae49c7a311e510dad13', '4', '07', '5', 'Lunas Penjualan [Per Kastumer]', '/adm/trans/', 'lunas_jual_kast.php'),
('aer353fda535f649439dae06fd69gf6vwop5he3403cba35e8', '4', '02', '2', 'Set Penawaran Harga Kastumer', '/adm/trans/', 'set_penawaran_kast.php');

-- --------------------------------------------------------

--
-- Table structure for table `beli`
--

CREATE TABLE `beli` (
  `kd` varchar(50) NOT NULL DEFAULT '',
  `no_faktur` varchar(255) NOT NULL DEFAULT '',
  `tgl_beli` date DEFAULT NULL,
  `kd_jns_byr` varchar(50) NOT NULL DEFAULT '',
  `kd_supplier` varchar(50) NOT NULL DEFAULT '',
  `diskon` varchar(5) NOT NULL DEFAULT '',
  `hr_jtempo` char(3) NOT NULL DEFAULT '',
  `tgl_jtempo` date DEFAULT NULL,
  `tgl_lunas` date DEFAULT NULL,
  `total_beli` varchar(15) NOT NULL DEFAULT '',
  `total_diskon` varchar(15) NOT NULL DEFAULT '',
  `ppn` char(2) NOT NULL DEFAULT '',
  `total_bayar` varchar(15) NOT NULL DEFAULT '',
  `bank` varchar(255) NOT NULL DEFAULT '',
  `postdate` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `beli`
--

INSERT INTO `beli` (`kd`, `no_faktur`, `tgl_beli`, `kd_jns_byr`, `kd_supplier`, `diskon`, `hr_jtempo`, `tgl_jtempo`, `tgl_lunas`, `total_beli`, `total_diskon`, `ppn`, `total_bayar`, `bank`, `postdate`) VALUES
('e3b0b223b6d452c263cfda119b056770', 'xyz', '2009-01-01', '', '7b3569bac85d801b5a858d95ec744c6d', '2', '', NULL, '0000-00-00', '254100', '5082', '10', '276686.67', '', '2008-11-13 11:59:57'),
('8047b2facfa734da14f5c9e934d0434a', 'yyy', '2009-01-01', '', '7b3569bac85d801b5a858d95ec744c6d', '', '', NULL, '2009-01-02', '51740.4', '0', '', '51740.4', '', '2008-11-13 12:01:28'),
('1ebc8d5e35966df457f7b6cf0778ecf7', '111', '2011-01-01', 'a737b85b3d8c5806b15ec1ac1f3a563f', '7b3569bac85d801b5a858d95ec744c6d', '', '', NULL, '0000-00-00', '', '0', '', '0', '', '2010-12-19 10:42:54');

-- --------------------------------------------------------

--
-- Table structure for table `beli_detail`
--

CREATE TABLE `beli_detail` (
  `kd` varchar(50) NOT NULL DEFAULT '',
  `kd_beli` varchar(50) NOT NULL DEFAULT '',
  `kd_brg` varchar(50) NOT NULL DEFAULT '',
  `qty` varchar(5) NOT NULL DEFAULT '',
  `qty_gudang` varchar(5) NOT NULL DEFAULT '',
  `qty_toko` varchar(5) NOT NULL DEFAULT '',
  `diskon` varchar(5) NOT NULL DEFAULT '',
  `diskon2` varchar(5) NOT NULL DEFAULT '',
  `hrg` varchar(15) NOT NULL DEFAULT '',
  `subtotal` varchar(15) NOT NULL DEFAULT '',
  `bonus` enum('true','false') NOT NULL DEFAULT 'false',
  `postdate` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `beli_detail`
--

INSERT INTO `beli_detail` (`kd`, `kd_beli`, `kd_brg`, `qty`, `qty_gudang`, `qty_toko`, `diskon`, `diskon2`, `hrg`, `subtotal`, `bonus`, `postdate`) VALUES
('2755700d8a42637a39fa875385d6db80', 'e3b0b223b6d452c263cfda119b056770', 'f8a9f5afd75a5c31a65d4515a03aaea9', '9', '3', '6', '', '', '1900', '17100', 'true', NULL),
('09385b14fa14a3c880db517a4e05fe18', 'e3b0b223b6d452c263cfda119b056770', '1df0e2d1ab371bbced524da4fa564ea3', '7', '3', '4', '', '', '4000', '28000', 'false', NULL),
('4382424c1324c0684461979d982a9a60', 'e3b0b223b6d452c263cfda119b056770', '1e16c9eeb928d1232c759d4d34f967b9', '19', '2', '17', '', '', '1900', '36100', 'false', NULL),
('399b463ed77271ccec0d1b35d4ad8449', '8047b2facfa734da14f5c9e934d0434a', 'e7aa9eef5badc2e5984d2f6c8e92e287', '3', '1', '2', '', '', '1900', '5700', 'false', NULL),
('148dce809ff350a56a7cead75c08e956', '8047b2facfa734da14f5c9e934d0434a', '1e16c9eeb928d1232c759d4d34f967b9', '29', '3', '26', '10', '2', '1800', '46040.4', 'false', NULL),
('a7355fee6de541b8409a314dae4e5ad6', 'e3b0b223b6d452c263cfda119b056770', 'f8a9f5afd75a5c31a65d4515a03aaea9', '100', '2', '98', '', '', '1900', '190000', 'false', NULL),
('dd4d2e8f468a76f8d4d3fb668e58360a', '1ebc8d5e35966df457f7b6cf0778ecf7', 'dbee12ad0740a58fddfc13947744c055', '3', '0', '05', '2', '1', '1800', '5239.08', 'true', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `item_laris`
--

CREATE TABLE `item_laris` (
  `kd` varchar(50) NOT NULL DEFAULT '',
  `bln` char(2) NOT NULL DEFAULT '',
  `thn` varchar(4) NOT NULL DEFAULT '',
  `kd_brg` varchar(50) NOT NULL DEFAULT '',
  `jml` varchar(10) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `item_laris`
--

INSERT INTO `item_laris` (`kd`, `bln`, `thn`, `kd_brg`, `jml`) VALUES
('f43757908c58c984d5fb449505700e52', '11', '2008', 'e7aa9eef5badc2e5984d2f6c8e92e287', '45'),
('f43757908c58c984d5fb449505700e52', '11', '2008', '1e16c9eeb928d1232c759d4d34f967b9', '5'),
('23e1578b52fd29fcc1b7b6e575f554a5', '11', '2008', 'f8a9f5afd75a5c31a65d4515a03aaea9', '10'),
('f43757908c58c984d5fb449505700e52', '12', '2008', 'ac53b65e398d2e557a28879b29354dbe', '3'),
('23e1578b52fd29fcc1b7b6e575f554a5', '12', '2008', 'f8a9f5afd75a5c31a65d4515a03aaea9', '1');

-- --------------------------------------------------------

--
-- Table structure for table `jual`
--

CREATE TABLE `jual` (
  `kd` varchar(50) NOT NULL DEFAULT '',
  `kd_kastumer` varchar(50) NOT NULL DEFAULT '',
  `no_faktur` varchar(20) NOT NULL DEFAULT '',
  `tgl_jual` date DEFAULT NULL,
  `total_jual` varchar(15) NOT NULL DEFAULT '',
  `kd_jns_byr` varchar(50) NOT NULL DEFAULT '',
  `tgl_bayar` date DEFAULT NULL,
  `postdate` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jual`
--

INSERT INTO `jual` (`kd`, `kd_kastumer`, `no_faktur`, `tgl_jual`, `total_jual`, `kd_jns_byr`, `tgl_bayar`, `postdate`) VALUES
('611daaaba5420f7045dfc6bfdfd90b44', 'b54d10d83deeec236e77b3928e2fa2f2', '20081124131638307', '2008-11-01', '66000', '', '0000-00-00', '2008-11-24 13:52:38'),
('12b26da8378737a072340eab81c919a1', 'b54d10d83deeec236e77b3928e2fa2f2', '20081206103904', '2009-01-01', '12000', '', '2009-01-01', '2008-12-06 10:40:13'),
('ad59c4e63d5be1aafd21354e716dd886', 'b54d10d83deeec236e77b3928e2fa2f2', '20101219104602', '2011-01-01', '4000', '', '0000-00-00', '2010-12-19 10:49:20');

-- --------------------------------------------------------

--
-- Table structure for table `jual_detail`
--

CREATE TABLE `jual_detail` (
  `kd` varchar(50) NOT NULL DEFAULT '',
  `kd_jual` varchar(50) NOT NULL DEFAULT '',
  `kd_brg` varchar(50) NOT NULL DEFAULT '',
  `qty` varchar(10) NOT NULL DEFAULT '',
  `qty_toko` varchar(10) NOT NULL DEFAULT '',
  `qty_gudang` varchar(10) NOT NULL DEFAULT '',
  `hrg_jual` varchar(50) NOT NULL DEFAULT '',
  `diskon` varchar(5) NOT NULL DEFAULT '',
  `hrg_jual_br` varchar(15) NOT NULL DEFAULT '',
  `subtotal` varchar(15) NOT NULL DEFAULT '',
  `postdate` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jual_detail`
--

INSERT INTO `jual_detail` (`kd`, `kd_jual`, `kd_brg`, `qty`, `qty_toko`, `qty_gudang`, `hrg_jual`, `diskon`, `hrg_jual_br`, `subtotal`, `postdate`) VALUES
('103c4905e193f24fc13c5ca8f9878efc', '611daaaba5420f7045dfc6bfdfd90b44', 'f8a9f5afd75a5c31a65d4515a03aaea9', '3', '3', '0', '2000', '0', '2000', '6000', NULL),
('2e2ada0539284ac0b8a323c832a8bfd6', '611daaaba5420f7045dfc6bfdfd90b44', 'e7aa9eef5badc2e5984d2f6c8e92e287', '45', '45', '0', '2000', '0', '2000', '90000', NULL),
('62c4d0e211a7d4f35ac3ae71acd28f3a', '12b26da8378737a072340eab81c919a1', 'e7aa9eef5badc2e5984d2f6c8e92e287', '2', '2', '0', '2000', '0', '2000', '4000', NULL),
('8e24fad56290628a8d2f1418f4903c81', '12b26da8378737a072340eab81c919a1', 'f8a9f5afd75a5c31a65d4515a03aaea9', '4', '4', '0', '2000', '0', '2000', '8000', NULL),
('2d644a7b45941a7ed79ff713371905b8', 'ad59c4e63d5be1aafd21354e716dd886', 'e7aa9eef5badc2e5984d2f6c8e92e287', '2', '2', '0', '2000', '', '2000', '4000', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `kastumer_brg`
--

CREATE TABLE `kastumer_brg` (
  `kd` varchar(50) NOT NULL DEFAULT '',
  `kd_kastumer` varchar(50) NOT NULL DEFAULT '',
  `tgl_penawaran` date NOT NULL DEFAULT '0000-00-00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kastumer_brg`
--

INSERT INTO `kastumer_brg` (`kd`, `kd_kastumer`, `tgl_penawaran`) VALUES
('93d8dc1fd7acd5e86f106a060b154e75', 'b54d10d83deeec236e77b3928e2fa2f2', '2009-01-01');

-- --------------------------------------------------------

--
-- Table structure for table `kastumer_brg_detail`
--

CREATE TABLE `kastumer_brg_detail` (
  `kd` varchar(50) NOT NULL DEFAULT '',
  `kd_kastumer_brg` varchar(50) NOT NULL DEFAULT '',
  `kd_brg` varchar(50) NOT NULL DEFAULT '',
  `hrg_jual` varchar(15) NOT NULL DEFAULT '',
  `diskon` char(2) NOT NULL DEFAULT '',
  `hrg_jual_br` varchar(15) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kastumer_brg_detail`
--

INSERT INTO `kastumer_brg_detail` (`kd`, `kd_kastumer_brg`, `kd_brg`, `hrg_jual`, `diskon`, `hrg_jual_br`) VALUES
('a21b3b36ece4d8b173c05c9fa3385c18', '93d8dc1fd7acd5e86f106a060b154e75', 'ac53b65e398d2e557a28879b29354dbe', '2000', '1', '2050'),
('4868cddba6957a13908c98197ae6a056', '93d8dc1fd7acd5e86f106a060b154e75', 'e7aa9eef5badc2e5984d2f6c8e92e287', '2000', '', '2000'),
('a62d3495e17f7979b9b7a3e94d2b4310', '93d8dc1fd7acd5e86f106a060b154e75', 'f8a9f5afd75a5c31a65d4515a03aaea9', '2000', '', '2000');

-- --------------------------------------------------------

--
-- Table structure for table `kastumer_set_diskon`
--

CREATE TABLE `kastumer_set_diskon` (
  `kd` varchar(50) NOT NULL DEFAULT '',
  `diskon` char(2) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `m_brg`
--

CREATE TABLE `m_brg` (
  `kd` varchar(50) NOT NULL DEFAULT '',
  `kd_kategori` varchar(50) NOT NULL DEFAULT '',
  `kd_merk` varchar(50) NOT NULL DEFAULT '',
  `kd_satuan` varchar(50) NOT NULL DEFAULT '',
  `kode` varchar(15) NOT NULL DEFAULT '',
  `barkode` varchar(30) NOT NULL DEFAULT '',
  `nama` varchar(100) NOT NULL DEFAULT '',
  `postdate` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_brg`
--

INSERT INTO `m_brg` (`kd`, `kd_kategori`, `kd_merk`, `kd_satuan`, `kode`, `barkode`, `nama`, `postdate`) VALUES
('e7aa9eef5badc2e5984d2f6c8e92e287', '203d9d0a80c1a20a36d58ad4d8877a3a', 'ce2846ab846c09d2a327f906e498ae92', 'ab49ad1b40f11a178bc23ee1a13c062a', 'SDAG0001', '', 'SDAG0001', '2008-11-11 09:23:18'),
('dbee12ad0740a58fddfc13947744c055', '203d9d0a80c1a20a36d58ad4d8877a3a', 'ce2846ab846c09d2a327f906e498ae92', 'ab49ad1b40f11a178bc23ee1a13c062a', 'SDAG0002', '', 'SDAG0002', '2008-11-11 09:23:51'),
('f8a9f5afd75a5c31a65d4515a03aaea9', '203d9d0a80c1a20a36d58ad4d8877a3a', 'f3436d3b70e539c8b5ca43753ed0718b', 'fa8a618e11c61c788ce8b4fb474829d6', 'ACA0001', '', 'ACA0001', '2008-11-13 11:41:48'),
('1e16c9eeb928d1232c759d4d34f967b9', '203d9d0a80c1a20a36d58ad4d8877a3a', 'f3436d3b70e539c8b5ca43753ed0718b', 'fa8a618e11c61c788ce8b4fb474829d6', 'ACA0002', '', 'ACA0002', '2008-11-13 11:42:16'),
('ac53b65e398d2e557a28879b29354dbe', '203d9d0a80c1a20a36d58ad4d8877a3a', 'f3436d3b70e539c8b5ca43753ed0718b', 'fa8a618e11c61c788ce8b4fb474829d6', 'ACA0003', '', 'ACA0003', '2008-11-13 11:42:39'),
('1df0e2d1ab371bbced524da4fa564ea3', '203d9d0a80c1a20a36d58ad4d8877a3a', 'f3436d3b70e539c8b5ca43753ed0718b', 'fa8a618e11c61c788ce8b4fb474829d6', 'ACA0004', '', 'ACA0004', '2008-11-13 11:44:31');

-- --------------------------------------------------------

--
-- Table structure for table `m_gudang`
--

CREATE TABLE `m_gudang` (
  `kd` varchar(50) NOT NULL DEFAULT '',
  `gudang` varchar(50) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_gudang`
--

INSERT INTO `m_gudang` (`kd`, `gudang`) VALUES
('5a3c8a4404129c455ad6e4cd33fee343', 'Toko'),
('10045569bb9b6a8a1d965879a5c33904', 'Gudang');

-- --------------------------------------------------------

--
-- Table structure for table `m_jns_byr`
--

CREATE TABLE `m_jns_byr` (
  `kd` varchar(50) NOT NULL DEFAULT '',
  `jns_byr` varchar(50) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_jns_byr`
--

INSERT INTO `m_jns_byr` (`kd`, `jns_byr`) VALUES
('a737b85b3d8c5806b15ec1ac1f3a563f', 'Kontan'),
('6006fda506ef5aace74939b91531351f', 'Kredit');

-- --------------------------------------------------------

--
-- Table structure for table `m_kastumer`
--

CREATE TABLE `m_kastumer` (
  `kd` varchar(50) NOT NULL DEFAULT '',
  `nama` varchar(100) NOT NULL DEFAULT '',
  `singkatan` varchar(50) NOT NULL DEFAULT '',
  `alamat` varchar(100) NOT NULL DEFAULT '',
  `telp` varchar(100) NOT NULL DEFAULT '',
  `hp` varchar(100) NOT NULL DEFAULT '',
  `fax` varchar(100) NOT NULL DEFAULT '',
  `email` varchar(100) NOT NULL DEFAULT '',
  `cp_nama` varchar(100) NOT NULL DEFAULT '',
  `cp_alamat` varchar(100) NOT NULL DEFAULT '',
  `cp_telp` varchar(100) NOT NULL DEFAULT '',
  `cp_hp` varchar(100) NOT NULL DEFAULT '',
  `cp_fax` varchar(100) NOT NULL DEFAULT '',
  `cp_email` varchar(100) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_kastumer`
--

INSERT INTO `m_kastumer` (`kd`, `nama`, `singkatan`, `alamat`, `telp`, `hp`, `fax`, `email`, `cp_nama`, `cp_alamat`, `cp_telp`, `cp_hp`, `cp_fax`, `cp_email`) VALUES
('b54d10d83deeec236e77b3928e2fa2f2', 'x', 'x', 'x', 'x', 'x', 'x', 'x', 'x', 'x', 'x', 'x', 'x', 'x'),
('f37acff899420f819891f3b5e09850b9', 'y', 'y', 'y', 'y', 'y', 'y', 'y', 'y', 'y', 'y', 'y', 'y', 'y'),
('248c97e4ef92ea12f02b0ebbd641cca8', 'z', 'z', 'z', 'z', 'z', 'z', 'z', 'z', 'z', 'z', 'z', 'z', 'z');

-- --------------------------------------------------------

--
-- Table structure for table `m_kategori`
--

CREATE TABLE `m_kategori` (
  `kd` varchar(50) NOT NULL DEFAULT '',
  `kategori` varchar(100) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_kategori`
--

INSERT INTO `m_kategori` (`kd`, `kategori`) VALUES
('5441803c6ce1266ca2828f26549d5521', 'Bolpen'),
('a592679aee5ff8a0a313feb727f94c79', 'Buku'),
('fc450c7e107e3b7630f2cf181fe78503', 'CDxgmringxDVD'),
('c2d7c285786019a6aac2476479826bc3', 'Calculator'),
('38e7f9c9a3394bde09af46c48ff65297', 'Amplop'),
('0170b2124adc2ed255ad3eb47dda6498', 'Album CD'),
('203d9d0a80c1a20a36d58ad4d8877a3a', 'Agenda');

-- --------------------------------------------------------

--
-- Table structure for table `m_merk`
--

CREATE TABLE `m_merk` (
  `kd` varchar(50) NOT NULL DEFAULT '',
  `merk` varchar(100) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_merk`
--

INSERT INTO `m_merk` (`kd`, `merk`) VALUES
('f685eacbaf05c38212501bdd0de33576', 'Faster'),
('ce2846ab846c09d2a327f906e498ae92', 'Sinar Dunia'),
('f3436d3b70e539c8b5ca43753ed0718b', 'Casio'),
('2cb8bd559ae1dc4cbff2e2a182458a76', 'Orang Tua');

-- --------------------------------------------------------

--
-- Table structure for table `m_satuan`
--

CREATE TABLE `m_satuan` (
  `kd` varchar(50) NOT NULL DEFAULT '',
  `satuan` varchar(50) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_satuan`
--

INSERT INTO `m_satuan` (`kd`, `satuan`) VALUES
('6c2e0f501757a50cb7e635826bf619d4', 'Lbr'),
('cac03f80b77f79150257f3005d96d865', 'meter'),
('ab49ad1b40f11a178bc23ee1a13c062a', 'Pak'),
('69ea8f40cc49144d7c4fb5f648a74cfe', 'Liter'),
('516370b43250ef4d8254662d7ed56639', 'Set'),
('5cdd01efb8eb4da99e95079b0f615321', 'Roll'),
('fa8a618e11c61c788ce8b4fb474829d6', 'Btl'),
('70457af7f23e3f958d09b2041d25a9cb', 'Pcs'),
('122fe0a55cffac5d8db3bf0ee71b10a2', 'Dus');

-- --------------------------------------------------------

--
-- Table structure for table `m_supplier`
--

CREATE TABLE `m_supplier` (
  `kd` varchar(50) NOT NULL DEFAULT '',
  `nama` varchar(100) NOT NULL DEFAULT '',
  `singkatan` varchar(50) NOT NULL DEFAULT '',
  `alamat` varchar(100) NOT NULL DEFAULT '',
  `telp` varchar(100) NOT NULL DEFAULT '',
  `hp` varchar(100) NOT NULL DEFAULT '',
  `fax` varchar(100) NOT NULL DEFAULT '',
  `email` varchar(100) NOT NULL DEFAULT '',
  `cp_nama` varchar(100) NOT NULL DEFAULT '',
  `cp_alamat` varchar(100) NOT NULL DEFAULT '',
  `cp_telp` varchar(100) NOT NULL DEFAULT '',
  `cp_hp` varchar(100) NOT NULL DEFAULT '',
  `cp_fax` varchar(100) NOT NULL DEFAULT '',
  `cp_email` varchar(100) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_supplier`
--

INSERT INTO `m_supplier` (`kd`, `nama`, `singkatan`, `alamat`, `telp`, `hp`, `fax`, `email`, `cp_nama`, `cp_alamat`, `cp_telp`, `cp_hp`, `cp_fax`, `cp_email`) VALUES
('7b3569bac85d801b5a858d95ec744c6d', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a'),
('e921fa7de1232b3254a2a21e41e549ef', 'b', 'b', 'b', 'b', 'b', 'b', 'b', 'b', 'b', 'b', 'b', 'b', 'b'),
('81e4c96a9867132a87fd99bfe6066d58', 'c', 'c', 'c', 'c', 'c', 'c', 'c', 'c', 'c', 'c', 'c', 'c', 'c');

-- --------------------------------------------------------

--
-- Table structure for table `m_tahun`
--

CREATE TABLE `m_tahun` (
  `kd` varchar(50) NOT NULL DEFAULT '',
  `tahun` varchar(4) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_tahun`
--

INSERT INTO `m_tahun` (`kd`, `tahun`) VALUES
('7b06fd9a61cde7831700603fc5fc8f8d', '2015'),
('dc5f669442b0e815870737845353fc4b', '2016'),
('4f910fa3c13acfff88053e8cc447605b', '2017');

-- --------------------------------------------------------

--
-- Table structure for table `nota`
--

CREATE TABLE `nota` (
  `kd` varchar(50) NOT NULL DEFAULT '',
  `pelanggan` varchar(100) NOT NULL DEFAULT '',
  `tgl` datetime DEFAULT NULL,
  `no_nota` varchar(20) NOT NULL DEFAULT '',
  `total` varchar(15) NOT NULL DEFAULT '',
  `total_bayar` varchar(15) NOT NULL DEFAULT '',
  `total_kembali` varchar(15) NOT NULL DEFAULT '',
  `pending` enum('true','false') NOT NULL DEFAULT 'false',
  `postdate` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nota`
--

INSERT INTO `nota` (`kd`, `pelanggan`, `tgl`, `no_nota`, `total`, `total_bayar`, `total_kembali`, `pending`, `postdate`) VALUES
('fd29014947b9baa7ed50a4c14d90c412', '', '2008-11-22 10:57:55', '20081122105755407', '', '', '', 'false', '2008-11-22 10:57:55'),
('ae1ac7563eb898f5000aa894e798711f', '', '2008-11-22 11:05:51', '20081122110551570', '10000', '', '', 'false', '2008-11-22 11:05:51'),
('5a9830fd8ff7bad2d74c30f62b9fa3ec', '', '2008-11-22 11:42:53', '20081122114253', '2000', '5000', '3000', 'false', '2008-11-22 11:42:53'),
('1a46e56113c7e29c1c1ccd396cd77aa0', 'ima', '2008-11-22 11:43:09', '20081122114309', '3900', '', '', 'false', '2008-11-22 11:43:09'),
('3e4a9b82972fa2aa88994a098b081aa7', 'hajir', '2008-11-24 13:35:33', '20081124133533', '23750', '', '', 'false', '2008-11-24 13:35:33'),
('bc32143803402cd7536221f8b36ddbef', '', '2008-11-28 11:34:39', '20081128113439', '', '', '', 'false', '2008-11-28 11:34:39'),
('43798b6ad950b9fdee820df49cb374cd', '', '2008-11-28 11:35:16', '20081128113516', '', '', '', 'false', '2008-11-28 11:35:16'),
('eb99f5d7e47cb6ead1b6082d70db4db4', '', '2008-11-28 11:40:24', '20081128114024', '22000', '', '', 'false', '2008-11-28 11:40:24'),
('7db7c2222ed5281b9f37a1550b4ce488', '', '2008-12-08 11:54:02', '20081208115402', '8000', '', '', 'false', '2008-12-08 11:54:02'),
('be5ebb42842bf2d55726051b1002743d', '', '2008-12-12 10:17:05', '20081212101705', '19900', '20000', '100', 'false', '2008-12-12 10:17:05'),
('16ef945bed9622cf127835483ed7894e', '', '2008-12-12 10:21:23', '20081212102123', '', '', '', 'false', '2008-12-12 10:21:23'),
('ddbbcea6f1160b6bda87514d97139d32', '', '2008-12-12 10:37:11', '20081212103711', '23650', '200000', '176350', 'false', '2008-12-12 10:37:11'),
('0b8f6ebf980371d711c10653f41cb403', '', '2010-12-19 09:52:59', '20101219095259', '', '', '', 'false', '2010-12-19 09:52:59'),
('0ae70aa9998300a8587a9ed0882d85a4', '', '2010-12-19 09:55:05', '20101219095505', '1950', '2000', '50', 'false', '2010-12-19 09:55:05'),
('ddd7552738f067da9214d5a36042eb3d', '', '2010-12-19 10:12:57', '20101219101257', '', '', '', 'false', '2010-12-19 10:12:57'),
('a797a8f22cfd2470896b9937b832d51b', '', '2010-12-19 10:14:27', '20101219101427', '4000', '10000', '6000', 'false', '2010-12-19 10:14:27'),
('dd546afd8b92c44e783f02c218577fa8', '', '2010-12-19 11:37:04', '20101219113704', '', '', '', 'false', '2010-12-19 11:37:04'),
('f22614683461d3ec760702105332de50', '', '2010-12-19 11:37:07', '20101219113707', '10000', '100000', '90000', 'false', '2010-12-19 11:37:07'),
('66adaf78da532318741a49617d7da7b5', '', '2010-12-19 11:37:57', '20101219113757', '', '', '', 'false', '2010-12-19 11:37:57'),
('348b65749de51fd92784c7c3a5c1e8b3', '', '2010-12-19 11:40:04', '20101219114004', '', '', '', 'false', '2010-12-19 11:40:04'),
('4b48832ad91d7a73926725acdc43575f', '', '2010-12-19 11:40:45', '20101219114045', '12000', '20000', '8000', 'true', '2010-12-19 11:40:45'),
('b1013e525e0168d3d8363d9d3527a089', '', '2010-12-19 11:42:07', '20101219114207', '', '', '', 'false', '2010-12-19 11:42:07'),
('3c714ed19f7a4e6313cb881c4bd00e5f', '', '2010-12-19 11:44:29', '20101219114429', '', '', '', 'false', '2010-12-19 11:44:29'),
('7a15a961ae15134dcaeabc27a67781f8', '', '2010-12-19 11:48:02', '20101219114802', '', '', '', 'false', '2010-12-19 11:48:02'),
('e975df150d2c8f583bb9bee55f905d89', '', '2010-12-19 11:50:47', '20101219115047', '', '', '', 'false', '2010-12-19 11:50:47'),
('391233c2647678607d9f6531521ac142', '', '2010-12-19 11:55:31', '20101219115531', '', '', '', 'false', '2010-12-19 11:55:31'),
('5cd10b1bafc5d8e7f8f3a307a3da1bd6', '', '2010-12-19 11:56:19', '20101219115619', '', '', '', 'false', '2010-12-19 11:56:19'),
('7156196cfa450a90c2a24a95fe953039', '', '2010-12-19 11:57:55', '20101219115755', '', '', '', 'false', '2010-12-19 11:57:55'),
('97bf4903a8c5dde9299233ed313aa19c', '', '2010-12-19 11:57:56', '20101219115756', '', '', '', 'false', '2010-12-19 11:57:56'),
('88abe7fbc7c80e16e851b077457221e2', '', '2010-12-19 11:58:02', '20101219115802', '', '', '', 'false', '2010-12-19 11:58:02'),
('4675280637f7fe93b2927d154cca850e', '7', '2010-12-19 12:02:39', '20101219120239', '', '', '', 'false', '2010-12-19 12:02:39'),
('8a13843f4a5f56f91c6f495d76f6342e', '7', '2010-12-19 12:02:43', '20101219120243', '', '', '', 'false', '2010-12-19 12:02:43'),
('f06b3e305aa956faaed83ad0e84357bc', '7a', '2010-12-19 12:02:47', '20101219120247', '', '', '', 'false', '2010-12-19 12:02:47'),
('0214f16292b978d2b0146591d2cf0104', '7a2', '2010-12-19 12:02:49', '20101219120249', '', '', '', 'false', '2010-12-19 12:02:49'),
('586db56164038ab621451e1f08095ef0', '7', '2010-12-19 12:03:01', '20101219120301', '', '', '', 'false', '2010-12-19 12:03:01'),
('6ec77d93644503904d470c67e54fa805', '7333', '2010-12-19 12:04:20', '20101219120420', '', '', '', 'false', '2010-12-19 12:04:20'),
('abf7e7f825825646695c287e22639c48', '7333', '2010-12-19 12:04:27', '20101219120427', '', '', '', 'false', '2010-12-19 12:04:27'),
('c380c2a0232fd62443cd9af0d260c429', '7333', '2010-12-19 13:47:32', '20101219134732', '', '', '', 'true', '2010-12-19 13:47:32'),
('13d14b2ed56fd98cd64ae224811bd536', '', '2010-12-19 13:54:30', '20101219135430', '', '', '', 'false', '2010-12-19 13:54:30'),
('9d4266086c395f6142d987299910dc20', 'a', '2010-12-19 13:55:56', '20101219135556', '45900', '100000', '54100', 'false', '2010-12-19 13:55:56'),
('317a7baf0970b51930ad1cdffd4fae65', '', '2010-12-19 14:26:20', '20101219142620', '1950', '10000', '8050', 'false', '2010-12-19 14:26:20'),
('ff7655c9ff9ce03d31387aece778ed42', '', '2017-09-23 04:18:36', '20170923041836', '2000', '10000', '8000', 'false', '2017-09-23 04:18:36');

-- --------------------------------------------------------

--
-- Table structure for table `nota_detail`
--

CREATE TABLE `nota_detail` (
  `kd` varchar(50) NOT NULL DEFAULT '',
  `kd_nota` varchar(50) NOT NULL DEFAULT '',
  `kd_brg` varchar(50) NOT NULL DEFAULT '',
  `qty` varchar(10) NOT NULL DEFAULT '',
  `qty_toko` varchar(10) NOT NULL DEFAULT '',
  `qty_gudang` varchar(10) NOT NULL DEFAULT '',
  `subtotal` varchar(15) NOT NULL DEFAULT '',
  `postdate` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nota_detail`
--

INSERT INTO `nota_detail` (`kd`, `kd_nota`, `kd_brg`, `qty`, `qty_toko`, `qty_gudang`, `subtotal`, `postdate`) VALUES
('651b68706d62fd29df64f5819a5f0603', '3e4a9b82972fa2aa88994a098b081aa7', 'f8a9f5afd75a5c31a65d4515a03aaea9', '7', '7', '0', '14000', '2008-11-24 13:35:42'),
('dffe6a7118d46a96505580121676b1e1', '3e4a9b82972fa2aa88994a098b081aa7', '1e16c9eeb928d1232c759d4d34f967b9', '5', '5', '0', '9750', '2008-11-24 13:35:53'),
('0b27f76dff146b876b27fba5c2d9b8ee', 'eb99f5d7e47cb6ead1b6082d70db4db4', 'f8a9f5afd75a5c31a65d4515a03aaea9', '3', '3', '0', '6000', '2008-11-28 11:40:33'),
('16bc38c7ff230a8c15d6fafc6e5b249a', 'eb99f5d7e47cb6ead1b6082d70db4db4', 'e7aa9eef5badc2e5984d2f6c8e92e287', '1', '1', '0', '2000', '2008-11-28 11:40:41'),
('69f1d19bcd10d0e92349c78c3afdfe2b', 'eb99f5d7e47cb6ead1b6082d70db4db4', 'ac53b65e398d2e557a28879b29354dbe', '7', '7', '0', '14000', '2008-11-28 11:40:54'),
('79c028b0c5f6289094d2460e6eac3dbd', '7db7c2222ed5281b9f37a1550b4ce488', 'f8a9f5afd75a5c31a65d4515a03aaea9', '1', '1', '0', '2000', '2008-12-08 11:54:10'),
('d9912f4db6c9e2ae349776d07465355d', '7db7c2222ed5281b9f37a1550b4ce488', 'ac53b65e398d2e557a28879b29354dbe', '3', '3', '0', '6000', '2008-12-08 11:54:19'),
('c0e7c73ae823adff60ad425b214931e0', 'be5ebb42842bf2d55726051b1002743d', '1e16c9eeb928d1232c759d4d34f967b9', '2', '2', '0', '3900', '2008-12-12 10:17:13'),
('cbacba076df6be000ace1644f51e109d', 'be5ebb42842bf2d55726051b1002743d', 'e7aa9eef5badc2e5984d2f6c8e92e287', '8', '8', '0', '16000', '2008-12-12 10:17:25'),
('e7b8fc1c2bfdb1522fb2a3ba48fa92d0', '5a9830fd8ff7bad2d74c30f62b9fa3ec', 'e7aa9eef5badc2e5984d2f6c8e92e287', '1', '1', '0', '2000', '2008-12-12 10:20:40'),
('32e42904d235686e9abdeb45dafa3bd5', 'ddbbcea6f1160b6bda87514d97139d32', 'ac53b65e398d2e557a28879b29354dbe', '2', '2', '0', '4000', '2008-12-12 10:37:18'),
('6f7f190f8a2e7471b4f2511bcecd2953', 'ddbbcea6f1160b6bda87514d97139d32', '1e16c9eeb928d1232c759d4d34f967b9', '7', '7', '0', '13650', '2008-12-12 10:37:26'),
('2f56edd07ed42481c84e137b947de327', 'ddbbcea6f1160b6bda87514d97139d32', 'dbee12ad0740a58fddfc13947744c055', '1', '1', '0', '2000', '2008-12-12 10:37:33'),
('dd9ac8f375a98f96a0cddb24fa5607db', 'ddbbcea6f1160b6bda87514d97139d32', 'e7aa9eef5badc2e5984d2f6c8e92e287', '1', '1', '0', '2000', '2008-12-12 10:37:40'),
('7b32a1d3424c80a36c2a1161e1967f5b', 'ddbbcea6f1160b6bda87514d97139d32', 'f8a9f5afd75a5c31a65d4515a03aaea9', '1', '1', '0', '2000', '2008-12-12 10:37:47'),
('2ab59e4664821a613d257531fa122ab9', '0ae70aa9998300a8587a9ed0882d85a4', '1e16c9eeb928d1232c759d4d34f967b9', '1', '1', '0', '1950', '2010-12-19 09:55:14'),
('4f86074d80b4144e6bca0007d9d859d9', 'ddd7552738f067da9214d5a36042eb3d', '1e16c9eeb928d1232c759d4d34f967b9', '2', '2', '0', '3900', '2010-12-19 10:13:10'),
('e665d8682ee5477f4b01ed480f7eb07c', 'a797a8f22cfd2470896b9937b832d51b', 'e7aa9eef5badc2e5984d2f6c8e92e287', '2', '2', '0', '4000', '2010-12-19 10:15:29'),
('623e4e776c438104bc29c3022401ad20', 'f22614683461d3ec760702105332de50', 'ac53b65e398d2e557a28879b29354dbe', '2', '2', '0', '4000', '2010-12-19 11:37:33'),
('b77304b5532c6e2aa8f7bbd7ec650318', 'f22614683461d3ec760702105332de50', 'e7aa9eef5badc2e5984d2f6c8e92e287', '3', '2', '1', '6000', '2010-12-19 11:37:40'),
('727528cc0ddc35ea99258d29060f44e4', '4b48832ad91d7a73926725acdc43575f', '1e16c9eeb928d1232c759d4d34f967b9', '2', '2', '0', '3900', '2010-12-19 11:48:44'),
('4bcec2013c74be518ad3040bbae91a99', '4b48832ad91d7a73926725acdc43575f', 'dbee12ad0740a58fddfc13947744c055', '2', '2', '0', '4000', '2010-12-19 11:48:57'),
('ee732b51cc5d969cacf09dbb78274f2b', '4b48832ad91d7a73926725acdc43575f', 'ac53b65e398d2e557a28879b29354dbe', '1', '1', '0', '2000', '2010-12-19 11:48:37'),
('dc24fd51e668fdab4e6bc0879cf99663', '5cd10b1bafc5d8e7f8f3a307a3da1bd6', '1e16c9eeb928d1232c759d4d34f967b9', '2', '2', '0', '3900', '2010-12-19 11:56:32'),
('631248417bd327d51e29c8c85326e1d1', '9d4266086c395f6142d987299910dc20', '1e16c9eeb928d1232c759d4d34f967b9', '2', '2', '0', '3900', '2010-12-19 13:56:33'),
('582e58321b2df4328595267e07558161', '9d4266086c395f6142d987299910dc20', 'f8a9f5afd75a5c31a65d4515a03aaea9', '21', '21', '0', '42000', '2010-12-19 13:56:57'),
('3bb057fe4210fe7dc360b01078318691', 'abf7e7f825825646695c287e22639c48', 'ac53b65e398d2e557a28879b29354dbe', '11', '11', '0', '22000', '2010-12-19 13:57:47'),
('58f5de3dec0cd17ae60cb62e6f5a54b9', '317a7baf0970b51930ad1cdffd4fae65', '1e16c9eeb928d1232c759d4d34f967b9', '1', '1', '0', '1950', '2010-12-19 14:26:27'),
('4e3154b74695269e6b6e3769d4e1be9b', 'ff7655c9ff9ce03d31387aece778ed42', 'f8a9f5afd75a5c31a65d4515a03aaea9', '1', '1', '0', '2000', '2017-09-23 04:18:52');

-- --------------------------------------------------------

--
-- Table structure for table `penawaran_brg`
--

CREATE TABLE `penawaran_brg` (
  `kd` varchar(50) NOT NULL DEFAULT '',
  `kd_brg` varchar(50) NOT NULL DEFAULT '',
  `hrg_jual` varchar(15) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penawaran_brg`
--

INSERT INTO `penawaran_brg` (`kd`, `kd_brg`, `hrg_jual`) VALUES
('ae787c386eb4408f5c55de25081e7d3b', 'e7aa9eef5badc2e5984d2f6c8e92e287', '2000'),
('886ecb001cd8d285834b41e43c66bcaf', 'f8a9f5afd75a5c31a65d4515a03aaea9', '2000'),
('33b823e7b470fbf1afb4eb508c222f2c', 'ac53b65e398d2e557a28879b29354dbe', '2000');

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `kd` varchar(50) NOT NULL DEFAULT '',
  `kd_brg` varchar(50) NOT NULL DEFAULT '',
  `jml_min` varchar(10) NOT NULL DEFAULT '',
  `jml_gudang` varchar(10) NOT NULL DEFAULT '',
  `jml_toko` varchar(10) NOT NULL DEFAULT '',
  `hrg_beli` varchar(15) NOT NULL DEFAULT '',
  `persen` varchar(5) NOT NULL DEFAULT '',
  `hrg_jual` varchar(15) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`kd`, `kd_brg`, `jml_min`, `jml_gudang`, `jml_toko`, `hrg_beli`, `persen`, `hrg_jual`) VALUES
('626439225f38be24483c2660230b862a', 'e7aa9eef5badc2e5984d2f6c8e92e287', '50', '135', '0', '1900', '5', '2000'),
('f8354d646d88af5b009fc55e3cb3d177', 'dbee12ad0740a58fddfc13947744c055', '25', '99', '612', '1746.36', '10', '2000'),
('e2e1415b5232710575da3633cdf7e9d1', 'f8a9f5afd75a5c31a65d4515a03aaea9', '10', '153', '183', '1900', '5', '2000'),
('dc3cb18957e2c54910310b23dee9982b', '1e16c9eeb928d1232c759d4d34f967b9', '10', '75', '97', '1843.38', '6', '1950'),
('ce431935e7bac43f2d415aeba81fd6ad', 'ac53b65e398d2e557a28879b29354dbe', '10', '30', '16', '2000', '0', '2000'),
('3e2f5978d798bb741157844a6f1ea565', '1df0e2d1ab371bbced524da4fa564ea3', '30', '12', '14', '4000', '0', '3000');

-- --------------------------------------------------------

--
-- Table structure for table `stock_hilang`
--

CREATE TABLE `stock_hilang` (
  `kd` varchar(50) NOT NULL DEFAULT '',
  `kd_brg` varchar(50) NOT NULL DEFAULT '',
  `kd_gudang` varchar(50) NOT NULL DEFAULT '',
  `jml` varchar(10) NOT NULL DEFAULT '',
  `postdate` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stock_hilang`
--

INSERT INTO `stock_hilang` (`kd`, `kd_brg`, `kd_gudang`, `jml`, `postdate`) VALUES
('33a32f62602d682a4d21d2725b93e6de', 'dbee12ad0740a58fddfc13947744c055', '10045569bb9b6a8a1d965879a5c33904', '1', '2008-11-13 11:46:33'),
('777aef60509afabc478ebdc3a387c49d', 'e7aa9eef5badc2e5984d2f6c8e92e287', '10045569bb9b6a8a1d965879a5c33904', '2', '2010-12-19 10:42:18');

-- --------------------------------------------------------

--
-- Table structure for table `stock_rusak`
--

CREATE TABLE `stock_rusak` (
  `kd` varchar(50) NOT NULL DEFAULT '',
  `kd_brg` varchar(50) NOT NULL DEFAULT '',
  `kd_gudang` varchar(50) NOT NULL DEFAULT '',
  `jml` varchar(10) NOT NULL DEFAULT '',
  `postdate` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stock_rusak`
--

INSERT INTO `stock_rusak` (`kd`, `kd_brg`, `kd_gudang`, `jml`, `postdate`) VALUES
('5b7c0e34648a34e3df9f7d51c5b197f2', 'f8a9f5afd75a5c31a65d4515a03aaea9', '10045569bb9b6a8a1d965879a5c33904', '2', '2008-11-13 11:45:51'),
('acd3ed46372c9c19b32102b64a6017c7', 'ac53b65e398d2e557a28879b29354dbe', '5a3c8a4404129c455ad6e4cd33fee343', '5', '2008-11-13 11:46:14'),
('9aa56a0502f6cd29a64161dab7ff16de', '1df0e2d1ab371bbced524da4fa564ea3', '10045569bb9b6a8a1d965879a5c33904', '1', '2010-12-19 10:41:56');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
