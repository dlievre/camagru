-- phpMyAdmin SQL Dump
-- version 4.6.0
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 21, 2017 at 06:10 PM
-- Server version: 5.7.11
-- PHP Version: 7.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `camagru`
--

-- --------------------------------------------------------

--
-- Table structure for table `photos_like`
--

DROP TABLE IF EXISTS `photos_like`;
CREATE TABLE `photos_like` (
  `Id` int(11) NOT NULL,
  `Id_tblphotos` int(11) NOT NULL,
  `Id_img` int(11) NOT NULL,
  `Id_user_comment` int(11) NOT NULL,
  `Comment` varchar(255) NOT NULL,
  `Grave_bien` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `photos_like`
--

INSERT INTO `photos_like` (`Id`, `Id_tblphotos`, `Id_img`, `Id_user_comment`, `Comment`, `Grave_bien`) VALUES
(0, 3, 1487264490, 1, 'grave bien cette photo', 1),
(3, 3, 1487264490, 2, 'trop fort cette photo', 1),
(7, 2, 1487261170, 1, 'beau montage', 0),
(9, 9, 1487692326, 2, 'super ce chat', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `photos_like`
--
ALTER TABLE `photos_like`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Id_img` (`Id_tblphotos`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `photos_like`
--
ALTER TABLE `photos_like`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `photos_like`
--
ALTER TABLE `photos_like`
  ADD CONSTRAINT `delete_img` FOREIGN KEY (`Id_tblphotos`) REFERENCES `photos` (`Id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
