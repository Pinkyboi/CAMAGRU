-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: mysql:3306
-- Generation Time: Oct 18, 2019 at 01:40 PM
-- Server version: 5.7.28
-- PHP Version: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Camagru`
--

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `ID` int(11) NOT NULL,
  `USER` int(11) NOT NULL,
  `COMMENT` text COLLATE utf8_unicode_ci NOT NULL,
  `imageID` int(11) NOT NULL,
  `comment_id` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `ID` int(11) NOT NULL,
  `Path` text COLLATE utf8_unicode_ci NOT NULL,
  `USER` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`ID`, `Path`, `USER`) VALUES
(118, '../gallery/5da1ec139046e.png', 39),
(119, '../gallery/5da1ec1a15870.png', 39),
(120, '../gallery/5da1ec7419893.png', 39),
(123, '../gallery/5da31757e2356.png', 41),
(124, '../gallery/5da38deccdb8b.png', 41),
(129, '../gallery/5da53cf4d5d32.png', 44),
(130, '../gallery/5da53d4d48402.png', 44),
(131, '../gallery/5da53dcfa0dc4.png', 44),
(133, '../gallery/5da9b0beea357.png', 46);

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `ID` int(11) NOT NULL,
  `imageID` int(11) NOT NULL,
  `USER` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`ID`, `imageID`, `USER`) VALUES
(1, 118, 46);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset`
--

CREATE TABLE `password_reset` (
  `ID` int(11) NOT NULL,
  `token` text COLLATE utf8_unicode_ci NOT NULL,
  `email` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `password_reset`
--

INSERT INTO `password_reset` (`ID`, `token`, `email`) VALUES
(1, '0c10ca73a43860965b73b44e0ee31d0c', 'ayman.benaissa2000@gmail.com'),
(2, '84a0a9ed1239089bfba95b769a5d2dbd', 'agoumi@noumi.com'),
(3, 'f4adda57e863e84db3a16bd5b4423dd7', 'aymane@aymane.ayman'),
(4, 'd4ca23a0c783fffe5f2c145c416d2517', 'abenaiss@benaiss.com'),
(6, 'e70eef9d187ac77e6e72718abd60a6b7', 't4q5rieerl@smart-email.me'),
(7, '798b3d1c1634ae8e53598d445ff8bcf0', '02hwfcuo0x@montokop.pw');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID` int(11) NOT NULL,
  `pseudo` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `passwrd` text COLLATE utf8_unicode_ci NOT NULL,
  `token` text COLLATE utf8_unicode_ci NOT NULL,
  `profile` text COLLATE utf8_unicode_ci NOT NULL,
  `notification` varchar(1) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `pseudo`, `email`, `passwrd`, `token`, `profile`, `notification`) VALUES
(38, 'abenaiss12', 'abenaiss@benaiss.com', '9a1a8ef93779c763549de8430915017a2b9ce1c50940d3f96c7f02a34d491f59c334ea23bb7cb38c83052a9a8556e0ba6c1d0e1fc25e2b448689e50c7f70cf08', '0', '../gallery/profile.png', '1'),
(39, 'abdechahid', 'ihya@gmail.com', '9a1a8ef93779c763549de8430915017a2b9ce1c50940d3f96c7f02a34d491f59c334ea23bb7cb38c83052a9a8556e0ba6c1d0e1fc25e2b448689e50c7f70cf08', 'faefd1948da759bd2993bc0a33b1677c', '../gallery/profile.png', '1'),
(40, 'NOMI', 'a@a.com', '9a1a8ef93779c763549de8430915017a2b9ce1c50940d3f96c7f02a34d491f59c334ea23bb7cb38c83052a9a8556e0ba6c1d0e1fc25e2b448689e50c7f70cf08', '0', '../gallery/profile.png', '1'),
(41, 'Roxeno191966', 'ayman.benaissa200000@gmail.com', '9a1a8ef93779c763549de8430915017a2b9ce1c50940d3f96c7f02a34d491f59c334ea23bb7cb38c83052a9a8556e0ba6c1d0e1fc25e2b448689e50c7f70cf08', '0', '../gallery/big_1536341489_image.jpg5da3174d2f84d.jpg', '0'),
(42, 'abenaiss001', '0amuly54m4@lalala.fun', '9a1a8ef93779c763549de8430915017a2b9ce1c50940d3f96c7f02a34d491f59c334ea23bb7cb38c83052a9a8556e0ba6c1d0e1fc25e2b448689e50c7f70cf08', '0', '../gallery/profile.png', '1'),
(43, 'bony', 'r57z6ajd70@montokop.pw', '5578ce3c4cd146d5c683935751b9fb752597678b6c8320e773f3d49af1d7bc9c141fbe019f5535700af4d44c052935f9891ca2592bc4b2fd7f730ea8e91bea38', '0', '../gallery/profile.png', '1'),
(44, 'borno', 't4q5rieerl@smart-email.me', '9a1a8ef93779c763549de8430915017a2b9ce1c50940d3f96c7f02a34d491f59c334ea23bb7cb38c83052a9a8556e0ba6c1d0e1fc25e2b448689e50c7f70cf08', '0', '../gallery/profile.png', '1'),
(45, 'nonie', 'emjrl0volu@montokop.pw', '9a1a8ef93779c763549de8430915017a2b9ce1c50940d3f96c7f02a34d491f59c334ea23bb7cb38c83052a9a8556e0ba6c1d0e1fc25e2b448689e50c7f70cf08', '0', '../gallery/profile.png', '1'),
(46, 'Xari', 'noc38hmj3g@lalala.fun', '9a1a8ef93779c763549de8430915017a2b9ce1c50940d3f96c7f02a34d491f59c334ea23bb7cb38c83052a9a8556e0ba6c1d0e1fc25e2b448689e50c7f70cf08', '0', '../gallery/profile.png', '1'),
(47, 'Nomino', 'x9ytyi7st1@lalala.fun', '9a1a8ef93779c763549de8430915017a2b9ce1c50940d3f96c7f02a34d491f59c334ea23bb7cb38c83052a9a8556e0ba6c1d0e1fc25e2b448689e50c7f70cf08', '0', '../gallery/profile.png', '1'),
(48, 'nonono', '02hwfcuo0x@montokop.pw', '9a1a8ef93779c763549de8430915017a2b9ce1c50940d3f96c7f02a34d491f59c334ea23bb7cb38c83052a9a8556e0ba6c1d0e1fc25e2b448689e50c7f70cf08', '0', '../gallery/profile.png', '1'),
(49, 'pottato', '8kym9pgl7a@montokop.pw', '9a1a8ef93779c763549de8430915017a2b9ce1c50940d3f96c7f02a34d491f59c334ea23bb7cb38c83052a9a8556e0ba6c1d0e1fc25e2b448689e50c7f70cf08', 'b73f8bdcc87314a1b6eaf0591ad34375', '../gallery/profile.png', '1'),
(50, 'test2', '8v0u78u6m4@montokop.pw', '9a1a8ef93779c763549de8430915017a2b9ce1c50940d3f96c7f02a34d491f59c334ea23bb7cb38c83052a9a8556e0ba6c1d0e1fc25e2b448689e50c7f70cf08', 'd9717b43243c56299411b1ce8262ae86', '../gallery/profile.png', '1'),
(51, 'hi', 'serayegik@ezmail.top', '9a1a8ef93779c763549de8430915017a2b9ce1c50940d3f96c7f02a34d491f59c334ea23bb7cb38c83052a9a8556e0ba6c1d0e1fc25e2b448689e50c7f70cf08', '7281c1d32127b45b1ea5a7708b9ef54c', '../gallery/profile.png', '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `password_reset`
--
ALTER TABLE `password_reset`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=134;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `password_reset`
--
ALTER TABLE `password_reset`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
