-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 08, 2020 at 02:12 PM
-- Server version: 8.0.17
-- PHP Version: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `slink`
--

-- --------------------------------------------------------

--
-- Table structure for table `link`
--

CREATE TABLE `dlink` (
  `sid` int(11) NOT NULL,
  `path` varchar(256) COLLATE utf8_bin NOT NULL,
  `link` varchar(256) COLLATE utf8_bin NOT NULL,
  `pin` int(11) DEFAULT NULL,
  `uid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `link`
--

INSERT INTO `dlink` (`sid`, `path`, `link`, `pin`, `uid`) VALUES
(58, 'thistine', 'thistine.com', 1234, 0),
(59, 'thistinebutlock', 'thistine.com', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `dlogin` (
  `uid` int(11) NOT NULL,
  `uname` varchar(256) COLLATE utf8_bin NOT NULL,
  `unick` varchar(256) COLLATE utf8_bin NOT NULL,
  `email` varchar(256) COLLATE utf8_bin NOT NULL,
  `pwd` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `login`
--

INSERT INTO `dlogin` (`uid`, `uname`, `unick`, `email`, `pwd`, `role`) VALUES
(10, 'user', 'user', 'user@mail.com', '$2y$10$5hwFIBWfXMq4MSHKlWfaxeqdR6mtXTOcn2ViQbdyvJv6FBzLg/baK', 2),
(11, 'admin', 'admin', 'admin@mail.com', '$2y$10$EQWe8dnCcKG7vFI2/gN8Ne1beCZ18GfgDSJ.279gRbuOaYR3jhGHy', 1);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `dsettings` (
  `settings` varchar(256) COLLATE utf8_bin NOT NULL,
  `value` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `settings`
--

INSERT INTO `dsettings` (`settings`, `value`) VALUES
('register', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `link`
--
ALTER TABLE `dlink`
  ADD PRIMARY KEY (`sid`);

--
-- Indexes for table `login`
--
ALTER TABLE `dlogin`
  ADD PRIMARY KEY (`uid`);

--
-- Indexes for table `settings`
--
ALTER TABLE `dsettings`
  ADD PRIMARY KEY (`settings`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `link`
--
ALTER TABLE `dlink`
  MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `dlogin`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
