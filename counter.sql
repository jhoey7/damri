-- phpMyAdmin SQL Dump
-- version 4.5.0.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 20, 2017 at 04:35 AM
-- Server version: 10.0.17-MariaDB
-- PHP Version: 5.6.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `counter`
--

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE `ci_sessions` (
  `id` varchar(40) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `data` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ci_sessions`
--

INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES
('2d4e2ff2badba063eb1d8de20398cbe56e3f46a9', '::1', 1487438587, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373433383538373b),
('340b1cd6946f51138bb7a47a22c431089070bc52', '::1', 1487434895, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373433343439393b6964656e746974797c733a31333a2261646d696e6973747261746f72223b757365726e616d657c733a31333a2261646d696e6973747261746f72223b656d61696c7c733a31353a2261646d696e4061646d696e2e636f6d223b757365725f69647c733a313a2231223b6c6576656c7c733a313a2230223b6d6573736167657c733a32343a2253657474696e6720426572686173696c2044697275626168223b5f5f63695f766172737c613a313a7b733a373a226d657373616765223b733a333a226f6c64223b7d),
('3dc6e474461501c0d47be1f22241e332c64e7362', '::1', 1487433786, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373433333434393b6964656e746974797c733a31333a2261646d696e6973747261746f72223b757365726e616d657c733a31333a2261646d696e6973747261746f72223b656d61696c7c733a31353a2261646d696e4061646d696e2e636f6d223b757365725f69647c733a313a2231223b6c6576656c7c733a313a2230223b),
('435a6665266656429d67f8b47aba3ae3acc41333', '::1', 1487426432, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373432363334353b6964656e746974797c733a31333a2261646d696e6973747261746f72223b757365726e616d657c733a31333a2261646d696e6973747261746f72223b656d61696c7c733a31353a2261646d696e4061646d696e2e636f6d223b757365725f69647c733a313a2231223b6c6576656c7c733a313a2230223b),
('6060a746f785574b4a8894ca5db86195c642613d', '::1', 1487438171, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373433373333303b6964656e746974797c733a31333a2261646d696e6973747261746f72223b757365726e616d657c733a31333a2261646d696e6973747261746f72223b656d61696c7c733a31353a2261646d696e4061646d696e2e636f6d223b757365725f69647c733a313a2231223b6c6576656c7c733a313a2230223b),
('6f3cbcceee8f92a8790f50611d3dea620ad3d8f0', '::1', 1487433170, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373433323733333b6964656e746974797c733a31333a2261646d696e6973747261746f72223b757365726e616d657c733a31333a2261646d696e6973747261746f72223b656d61696c7c733a31353a2261646d696e4061646d696e2e636f6d223b757365725f69647c733a313a2231223b6c6576656c7c733a313a2230223b),
('896d753369d3d773bf36efd8f0e13bd7007941ce', '::1', 1487430108, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373433303038353b6964656e746974797c733a31333a2261646d696e6973747261746f72223b757365726e616d657c733a31333a2261646d696e6973747261746f72223b656d61696c7c733a31353a2261646d696e4061646d696e2e636f6d223b757365725f69647c733a313a2231223b6c6576656c7c733a313a2230223b),
('92a7e91ac6d1133df0ea16b40152dba07be1a782', '::1', 1487557833, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373535373833323b),
('9c5362acf023ba8e33b1d21c2c96b3d7199f7517', '::1', 1487435160, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373433353135393b),
('b704c0f731195a1a9c9ae15a8fd26686d9472523', '::1', 1487438587, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373433383538373b),
('dd1163ef98e4ddce9dc4b29ba255f45e95f37375', '::1', 1487435160, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373433353136303b),
('f45ae8b9a41f5121ae2c7fac37d2623af0f36e8d', '::1', 1487425933, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373432353133343b6964656e746974797c733a31333a2261646d696e6973747261746f72223b757365726e616d657c733a31333a2261646d696e6973747261746f72223b656d61696c7c733a31353a2261646d696e4061646d696e2e636f6d223b757365725f69647c733a313a2231223b6c6576656c7c733a313a2230223b);

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `id_comp` int(11) NOT NULL,
  `nama_comp` varchar(255) DEFAULT NULL,
  `address1` text,
  `address2` text,
  `telp` char(15) DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_at` date DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `fax` char(15) DEFAULT NULL,
  `id_terminal` int(11) DEFAULT NULL,
  `id_counter` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`id_comp`, `nama_comp`, `address1`, `address2`, `telp`, `created_at`, `created_by`, `updated_at`, `updated_by`, `deleted_at`, `deleted_by`, `fax`, `id_terminal`, `id_counter`) VALUES
(1, 'DAMRI BASOETTA', '   JL.TIPAR CAKUNG NO.39 CAKUNG JAKARTA UTARA      ', NULL, '(021) 6289 102', NULL, NULL, '2017-02-18', NULL, NULL, NULL, '(021) 6289 155', 7, 1);

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Administrator'),
(2, 'members', 'General User');

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

CREATE TABLE `login_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(15) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `pool`
--

CREATE TABLE `pool` (
  `id_pool` int(11) NOT NULL,
  `nama_pool` varbinary(50) DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_at` date DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pool`
--

INSERT INTO `pool` (`id_pool`, `nama_pool`, `created_at`, `created_by`, `updated_at`, `updated_by`, `deleted_at`, `deleted_by`) VALUES
(1, 0x5075706172, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 0x43616b756e67, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 0x42616e64617261, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 0x426f676f72, NULL, NULL, NULL, NULL, NULL, NULL),
(5, 0x4d6572616b, NULL, NULL, NULL, NULL, NULL, NULL),
(6, 0x50757277616b61727461, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pool_grup`
--

CREATE TABLE `pool_grup` (
  `id_grup` int(11) NOT NULL,
  `nama_grup` varchar(50) DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_at` date DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `tarif` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pool_grup`
--

INSERT INTO `pool_grup` (`id_grup`, `nama_grup`, `created_at`, `created_by`, `updated_at`, `updated_by`, `deleted_at`, `deleted_by`, `tarif`) VALUES
(1, 'Dalam Kota', NULL, NULL, NULL, NULL, NULL, NULL, 40000),
(2, 'Bekasi / HI', NULL, NULL, NULL, NULL, NULL, NULL, 45000),
(3, 'Bekasi Royal', NULL, NULL, NULL, NULL, NULL, NULL, 60000),
(4, 'Bogor', NULL, NULL, NULL, NULL, NULL, NULL, 55000),
(5, 'Bogor Royal', NULL, NULL, NULL, NULL, NULL, NULL, 75000),
(6, 'Cikarang / Grand', NULL, NULL, NULL, NULL, NULL, NULL, 50000),
(7, 'Purwakarta', NULL, NULL, NULL, NULL, NULL, NULL, 65000),
(8, 'Cilegon', NULL, NULL, NULL, NULL, NULL, NULL, 60000),
(9, 'Karawaci', NULL, NULL, NULL, NULL, NULL, NULL, 50000);

-- --------------------------------------------------------

--
-- Table structure for table `terminal`
--

CREATE TABLE `terminal` (
  `id_terminal` int(11) NOT NULL,
  `nama_terminal` varchar(50) DEFAULT NULL,
  `id_comp` int(11) DEFAULT NULL,
  `gm` varchar(100) DEFAULT NULL,
  `gm_nik` varchar(20) DEFAULT NULL,
  `staf` varchar(100) DEFAULT NULL,
  `staf_nik` varchar(20) DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_at` date DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `id_tg` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `terminal`
--

INSERT INTO `terminal` (`id_terminal`, `nama_terminal`, `id_comp`, `gm`, `gm_nik`, `staf`, `staf_nik`, `created_at`, `created_by`, `updated_at`, `updated_by`, `deleted_at`, `deleted_by`, `id_tg`) VALUES
(1, '37B', 1, 'JONI HENDRI, SH', '65925991', 'ANDHIKA P.  ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(2, 'IA', 1, 'JONI HENDRI, SH', '65925991', 'ANDHIKA P.  ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(3, 'IB', 1, 'JONI HENDRI, SH', '65925991', 'ANDHIKA P.  ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(4, 'IC', 1, 'JONI HENDRI, SH', '65925991', 'ANDHIKA P.  ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(5, 'IID', 1, 'JONI HENDRI, SH', '65925991', 'ANDHIKA P.  ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(6, 'IIF', 1, 'JONI HENDRI, SH', '65925991', 'ANDHIKA P.  ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(7, 'IIFL', 1, 'JONI HENDRI, SH', '65925991', 'ANDHIKA P.  ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(8, 'III', 1, 'JONI HENDRI, SH', '65925991', 'ANDHIKA P.  ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(9, 'Gambir', 1, 'JONI HENDRI, SH', '65925991', 'ANDHIKA P.  ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4),
(10, 'Bekasi', 1, 'JONI HENDRI, SH', '65925991', 'ANDHIKA P.  ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3),
(11, 'Cibinong', 1, 'JONI HENDRI, SH', '65925991', 'ANDHIKA P.  ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5),
(12, 'Bogor', 1, 'JONI HENDRI, SH', '65925991', 'ANDHIKA P.  ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2);

-- --------------------------------------------------------

--
-- Table structure for table `terminal_grup`
--

CREATE TABLE `terminal_grup` (
  `id_tg` int(11) NOT NULL,
  `nama_tg` varchar(20) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `terminal_grup`
--

INSERT INTO `terminal_grup` (`id_tg`, `nama_tg`, `created_at`, `created_by`, `updated_at`, `updated_by`, `deleted_at`, `deleted_by`) VALUES
(1, 'BANDARA', NULL, NULL, NULL, NULL, NULL, NULL),
(2, 'BOGOR', NULL, NULL, NULL, NULL, NULL, NULL),
(3, 'BEKASI', NULL, NULL, NULL, NULL, NULL, NULL),
(4, 'GAMBIR', NULL, NULL, NULL, NULL, NULL, NULL),
(5, 'CIBINONG', NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `trans`
--

CREATE TABLE `trans` (
  `id_trans` int(11) NOT NULL,
  `tgl_trans` datetime DEFAULT NULL,
  `id_trayek` int(11) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `id_counter` int(11) DEFAULT NULL,
  `shift` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `id_terminal` int(11) DEFAULT NULL,
  `no_trans` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `trans`
--

INSERT INTO `trans` (`id_trans`, `tgl_trans`, `id_trayek`, `qty`, `id_counter`, `shift`, `created_at`, `created_by`, `updated_at`, `updated_by`, `deleted_at`, `deleted_by`, `total`, `id_terminal`, `no_trans`) VALUES
(1, '2017-01-01 22:48:04', 1, 1, 1, 1, NULL, 2, NULL, NULL, NULL, NULL, 40000, NULL, NULL),
(2, '2017-01-05 22:52:13', 2, 2, 1, 1, NULL, 3, NULL, NULL, NULL, NULL, 80000, NULL, NULL),
(3, '2017-01-25 10:53:34', 4, 3, 1, 2, NULL, 3, NULL, NULL, NULL, NULL, 160000, NULL, NULL),
(4, '2017-01-26 10:54:38', 4, 2, 1, 2, NULL, 4, NULL, NULL, NULL, NULL, 80000, NULL, NULL),
(5, '2017-01-27 11:24:51', 3, 1, 2, 1, NULL, 4, NULL, NULL, NULL, NULL, 40000, NULL, NULL),
(6, '2017-01-26 14:24:21', 4, 1, 2, 2, NULL, 2, NULL, NULL, NULL, NULL, 40000, NULL, NULL),
(7, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(8, '2017-02-18 20:55:38', 6, 1, 1, 1, '2017-02-18 20:55:38', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(9, '2017-02-18 20:57:15', 18, 2, 1, 1, '2017-02-18 20:57:15', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `trayek`
--

CREATE TABLE `trayek` (
  `id_trayek` int(11) NOT NULL,
  `nama_trayek` varchar(100) DEFAULT NULL,
  `tarif` int(11) DEFAULT NULL,
  `id_pool` int(11) DEFAULT NULL,
  `id_group` int(11) DEFAULT NULL,
  `id_tg` int(11) DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_at` date DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `trayek`
--

INSERT INTO `trayek` (`id_trayek`, `nama_trayek`, `tarif`, `id_pool`, `id_group`, `id_tg`, `created_at`, `created_by`, `updated_at`, `updated_by`, `deleted_at`, `deleted_by`) VALUES
(1, 'BLOK M', 40000, 1, 1, NULL, '2017-02-09', NULL, '2017-02-09', NULL, NULL, NULL),
(2, 'Rawa Mangun', 40000, 1, 1, NULL, '2017-02-09', NULL, NULL, NULL, NULL, 1),
(3, 'Gambir', 40000, 2, 1, NULL, '2017-02-12', NULL, NULL, NULL, NULL, NULL),
(4, 'Kemayoran', 40000, 2, 1, NULL, '2017-02-12', NULL, NULL, NULL, NULL, NULL),
(5, 'Mangga Dua', 40000, 2, 1, NULL, '2017-02-12', NULL, NULL, NULL, NULL, NULL),
(6, 'KP. Rambutan', 40000, 2, 1, NULL, '2017-02-12', NULL, NULL, NULL, NULL, NULL),
(7, 'Pasar Minggu', 40000, 2, 1, NULL, '2017-02-12', NULL, NULL, NULL, NULL, NULL),
(8, 'Tanjung Priok', 40000, 1, 1, NULL, '2017-02-12', NULL, NULL, NULL, NULL, NULL),
(9, 'Lebak Bulus', 40000, 1, 1, NULL, '2017-02-12', NULL, NULL, NULL, NULL, NULL),
(10, 'Pulo Gebang', 40000, 1, 1, NULL, '2017-02-12', NULL, NULL, NULL, NULL, NULL),
(11, 'Pramuka City', 40000, 1, 1, NULL, '2017-02-12', NULL, NULL, NULL, NULL, NULL),
(12, 'WTC Serpong', 40000, 3, 1, NULL, '2017-02-12', NULL, NULL, NULL, NULL, NULL),
(13, 'Bekasi', 45000, 2, 2, NULL, '2017-02-12', NULL, NULL, NULL, NULL, NULL),
(14, 'Bekasi (VIP)', 60000, 2, 3, NULL, '2017-02-12', NULL, NULL, NULL, NULL, NULL),
(15, 'Bogor', 55000, 4, 4, NULL, '2017-02-12', NULL, NULL, NULL, NULL, NULL),
(16, 'Bogor (VIP)', 75000, 4, 5, NULL, '2017-02-12', NULL, NULL, NULL, NULL, NULL),
(17, 'Cikarang', 50000, 3, 6, NULL, '2017-02-12', NULL, NULL, NULL, NULL, NULL),
(18, 'Merak', 60000, 5, 8, NULL, '2017-02-12', NULL, NULL, NULL, NULL, NULL),
(19, 'Harapan Indah ', 45000, 1, 2, NULL, '2017-02-12', NULL, NULL, NULL, NULL, NULL),
(20, 'Purwakarta', 65000, 6, 7, NULL, '2017-02-12', NULL, NULL, NULL, NULL, NULL),
(21, 'Karawang', 65000, 6, 7, NULL, '2017-02-12', NULL, NULL, NULL, NULL, NULL),
(22, 'Cibinong', 55000, 4, 4, NULL, '2017-02-12', NULL, NULL, NULL, NULL, NULL),
(23, 'Karawaci', 50000, 3, 9, NULL, '2017-02-12', NULL, NULL, NULL, NULL, NULL),
(24, 'test', 70000, 3, 2, NULL, '2017-02-13', NULL, NULL, NULL, '2017-02-13', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `forgotten_password_time` int(11) UNSIGNED DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` int(11) UNSIGNED NOT NULL,
  `last_login` int(11) UNSIGNED DEFAULT NULL,
  `active` tinyint(1) UNSIGNED DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `level` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `id_terminal` int(11) DEFAULT NULL,
  `pass_counter` varchar(255) DEFAULT NULL,
  `counter` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `level`, `created_at`, `created_by`, `updated_at`, `updated_by`, `deleted_at`, `deleted_by`, `id_terminal`, `pass_counter`, `counter`) VALUES
(1, '127.0.0.1', 'administrator', '$2y$08$6bU4y4LtKe/rE1E1YPpgBOdJEhMKf7vm2I988MlK408i2/LPTWNC6', '', 'admin@admin.com', '', NULL, NULL, NULL, 1268889823, 1487437349, 1, 'Admin', 'istrator', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, '::1', 'marita', '$2y$08$UhLRa2ZUJSltlDnecg0B4eXkLYo7FOoQrDtywzd4Fu/DvJlh.R7G.', NULL, '', NULL, NULL, NULL, NULL, 0, NULL, 0, 'Dian', 'Marita', 1, '2017-02-07 00:00:00', NULL, NULL, NULL, NULL, 1, 1, NULL, NULL),
(3, '::1', 'Ari', '$2y$08$11X/.ZXFL2fWYY8rAgnX0uzIX9F7TqlvwfcCrtN2OCOcuBZ1j0gnO', NULL, '', NULL, NULL, NULL, NULL, 0, NULL, 1, 'Ari', 'Ansyah', 1, '2017-02-13 00:00:00', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(4, '::1', 'Joni', '$2y$08$WxE9EJ9bcHKra0JDQj950eJpUXNZwr5U84ete.qD6fl/LaKC2mHMW', NULL, '', NULL, NULL, NULL, NULL, 0, NULL, 1, 'Joni', 'Iskandar', 1, '2017-02-13 00:00:00', NULL, NULL, NULL, NULL, NULL, 7, NULL, NULL),
(5, '::1', 'ari_astuti', '$2y$08$4JnoP4Yce3A4XCR7u65D6eye1yWQXy/Y7GEtE4bnTyLgTagaZNG8G', NULL, '', NULL, NULL, NULL, NULL, 0, NULL, 1, 'Ari', 'Astuti', 0, '2017-02-13 00:00:00', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL),
(6, '::1', 'test', '$2y$08$Eyl1s0fT8gwBQfJZj6uf4eCkvzFFRVXiFNV3DDhgMeUHqcQaSHjce', NULL, '', NULL, NULL, NULL, NULL, 0, NULL, 1, 'test', 'aja', 1, '2017-02-13 00:00:00', NULL, NULL, NULL, NULL, NULL, 12, '087d7cb9512bff4b926c3fefb80a0752', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users_groups`
--

CREATE TABLE `users_groups` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `group_id` mediumint(8) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users_groups`
--

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 2, 2),
(4, 3, 2),
(5, 4, 2),
(6, 5, 2),
(7, 6, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ci_sessions`
--
ALTER TABLE `ci_sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ci_sessions_timestamp` (`timestamp`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`id_comp`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login_attempts`
--
ALTER TABLE `login_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pool`
--
ALTER TABLE `pool`
  ADD PRIMARY KEY (`id_pool`);

--
-- Indexes for table `pool_grup`
--
ALTER TABLE `pool_grup`
  ADD PRIMARY KEY (`id_grup`);

--
-- Indexes for table `terminal`
--
ALTER TABLE `terminal`
  ADD PRIMARY KEY (`id_terminal`);

--
-- Indexes for table `terminal_grup`
--
ALTER TABLE `terminal_grup`
  ADD PRIMARY KEY (`id_tg`);

--
-- Indexes for table `trans`
--
ALTER TABLE `trans`
  ADD PRIMARY KEY (`id_trans`);

--
-- Indexes for table `trayek`
--
ALTER TABLE `trayek`
  ADD PRIMARY KEY (`id_trayek`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_groups`
--
ALTER TABLE `users_groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  ADD KEY `fk_users_groups_users1_idx` (`user_id`),
  ADD KEY `fk_users_groups_groups1_idx` (`group_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `id_comp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pool`
--
ALTER TABLE `pool`
  MODIFY `id_pool` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `pool_grup`
--
ALTER TABLE `pool_grup`
  MODIFY `id_grup` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `terminal`
--
ALTER TABLE `terminal`
  MODIFY `id_terminal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `terminal_grup`
--
ALTER TABLE `terminal_grup`
  MODIFY `id_tg` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `trans`
--
ALTER TABLE `trans`
  MODIFY `id_trans` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `trayek`
--
ALTER TABLE `trayek`
  MODIFY `id_trayek` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `users_groups`
--
ALTER TABLE `users_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `users_groups`
--
ALTER TABLE `users_groups`
  ADD CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
