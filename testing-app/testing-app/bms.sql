-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 20, 2018 at 10:07 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bms`
--

-- --------------------------------------------------------

--
-- Table structure for table `l01-1`
--

CREATE TABLE `l01-1` (
  `No` int(11) NOT NULL,
  `Action` text COLLATE utf16_bin NOT NULL,
  `Expected Result` text COLLATE utf16_bin NOT NULL,
  `Status` int(11) NOT NULL,
  `Note` text COLLATE utf16_bin NOT NULL,
  `ID_Table` text COLLATE utf16_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_bin;

--
-- Dumping data for table `l01-1`
--

INSERT INTO `l01-1` (`No`, `Action`, `Expected Result`, `Status`, `Note`, `ID_Table`) VALUES
(1, 'Klik icon \'SDR\'', 'Tampil jendela SDR sesuai deskripsi', 1, '', 'L01');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `ID Test Case` text COLLATE utf16_bin NOT NULL,
  `Tittle` text COLLATE utf16_bin NOT NULL,
  `Severity` text COLLATE utf16_bin NOT NULL,
  `Version` text COLLATE utf16_bin NOT NULL,
  `Type Test` text COLLATE utf16_bin NOT NULL,
  `Description` text COLLATE utf16_bin NOT NULL,
  `Pre-Condition` text COLLATE utf16_bin NOT NULL,
  `ID_Table` text COLLATE utf16_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_bin;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`ID Test Case`, `Tittle`, `Severity`, `Version`, `Type Test`, `Description`, `Pre-Condition`, `ID_Table`) VALUES
('D-BMS-L01', 'CEK ID', 'HIGH', '2.1 Rev. 10_18', 'Functional', 'Informasi Ranpur sendiri terdiri dari :\r\n1. ID dan sebutan\r\n2. Posisi sendiri dalam satuan lat-long (DMS), karvak dan LCO (Datum84)\r\n3. Arah kendaraan terhadap utara\r\n4. Arah turret terhadp kendaraan\r\n5. Jumlah bahan bakar (L)\r\n6. Jumlah amunisi 1,2,3', 'Status sambungan dengan UK \"Data Masuk\'', 'L01');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `l01-1`
--
ALTER TABLE `l01-1`
  ADD PRIMARY KEY (`No`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`ID Test Case`(100));

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `l01-1`
--
ALTER TABLE `l01-1`
  MODIFY `No` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
