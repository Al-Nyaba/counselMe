-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 25, 2019 at 05:40 PM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.2.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `counsellingdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `administrators`
--

CREATE TABLE `administrators` (
  `adminID` int(11) UNSIGNED NOT NULL,
  `username` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `location` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `dateAdded` datetime NOT NULL DEFAULT current_timestamp(),
  `roleID` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `administrators`
--

INSERT INTO `administrators` (`adminID`, `username`, `email`, `password`, `location`, `dateAdded`, `roleID`) VALUES
(1, 'Admin1', 'adm1@live.com', '$2y$10$V9xid4HWnK1wpyE7l3kHveqPGTZWRl/gxh1bZmJGjAFi3Wyjmi11O', 'Navrongo', '0000-00-00 00:00:00', NULL),
(2, 'Admin2', 'adm2@gmail.com', '$2y$10$V9xid4HWnK1wpyE7l3kHveqPGTZWRl/gxh1bZmJGjAFi3Wyjmi11O', 'Navrongo', '2019-11-17 12:24:18', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `adminroles`
--

CREATE TABLE `adminroles` (
  `roleID` int(11) UNSIGNED NOT NULL COMMENT 'The ID which identifies each role',
  `roleDescription` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `dateAdded` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `adminroles`
--

INSERT INTO `adminroles` (`roleID`, `roleDescription`, `dateAdded`) VALUES
(1, 'Remove Users', '2019-11-14 19:22:56');

-- --------------------------------------------------------

--
-- Table structure for table `counselling`
--

CREATE TABLE `counselling` (
  `counsellingID` int(10) UNSIGNED NOT NULL,
  `userID` int(10) UNSIGNED NOT NULL,
  `expertID` int(10) UNSIGNED DEFAULT NULL,
  `dateRequested` datetime NOT NULL DEFAULT current_timestamp(),
  `dateScheduled` datetime NOT NULL,
  `dateCompleted` datetime DEFAULT NULL,
  `location` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `userRating` decimal(5,2) NOT NULL,
  `counsellingCatID` int(11) DEFAULT NULL,
  `counsellingSubCatID` int(11) DEFAULT NULL,
  `emergencyPhone` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `counsellingcat`
--

CREATE TABLE `counsellingcat` (
  `counsellingCatID` int(11) NOT NULL,
  `name` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `addedBy` int(11) DEFAULT NULL,
  `dateAdded` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `counsellingcat`
--

INSERT INTO `counsellingcat` (`counsellingCatID`, `name`, `description`, `addedBy`, `dateAdded`) VALUES
(1, 'Addiction', 'Addiction includes substance abuse as well as drup abuse', NULL, '2019-11-15 23:09:35'),
(5, 'Marriage', 'For marital issues, whether pre-marital or marital issues', NULL, '0000-00-00 00:00:00');

--
-- Triggers `counsellingcat`
--
DELIMITER $$
CREATE TRIGGER `changeSCatID` AFTER DELETE ON `counsellingcat` FOR EACH ROW UPDATE `counsellingsubcat` SET `cCatID` = 1
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `counsellingsubcat`
--

CREATE TABLE `counsellingsubcat` (
  `cSCID` int(11) NOT NULL,
  `cCatID` int(11) DEFAULT NULL COMMENT 'Foreign key linking counsellingCatID in the counsellingCat table',
  `name` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `dateAdded` datetime NOT NULL DEFAULT current_timestamp(),
  `addedBy` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `counsellingsubcat`
--

INSERT INTO `counsellingsubcat` (`cSCID`, `cCatID`, `name`, `dateAdded`, `addedBy`) VALUES
(1, 1, 'Drug Abuse', '2019-11-15 23:15:39', NULL),
(2, 1, 'Pornography', '2019-11-15 23:15:39', NULL),
(3, 5, 'In-laws issues', '2019-11-15 23:15:39', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `expertrequest`
--

CREATE TABLE `expertrequest` (
  `requestID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `paymentMethodID` int(10) UNSIGNED NOT NULL,
  `cardDetails` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dateReceived` datetime NOT NULL DEFAULT current_timestamp(),
  `approved` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `expertrequest`
--

INSERT INTO `expertrequest` (`requestID`, `userID`, `paymentMethodID`, `cardDetails`, `dateReceived`, `approved`) VALUES
(1, 1, 1, 'cardName: portala, cardNumber: 78878, cardSecurityNumber: 34344343', '2019-11-17 21:08:31', 0);

-- --------------------------------------------------------

--
-- Table structure for table `experts`
--

CREATE TABLE `experts` (
  `expertID` int(11) NOT NULL,
  `userID` int(11) DEFAULT NULL,
  `rating` float(5,2) UNSIGNED DEFAULT NULL,
  `dateAdded` datetime NOT NULL DEFAULT current_timestamp(),
  `category` int(11) DEFAULT NULL,
  `verified` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `expertsrating`
--

CREATE TABLE `expertsrating` (
  `ratingID` int(11) DEFAULT NULL,
  `expertID` int(11) NOT NULL,
  `rating` int(1) DEFAULT NULL,
  `review` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dateReviewed` datetime NOT NULL DEFAULT current_timestamp(),
  `dateModified` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `paymentmethods`
--

CREATE TABLE `paymentmethods` (
  `ID` int(10) UNSIGNED NOT NULL,
  `provider` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `paymentmethods`
--

INSERT INTO `paymentmethods` (`ID`, `provider`, `name`) VALUES
(1, 'paypal', 'paypal'),
(2, 'Credit card', 'credit_card'),
(3, 'Debit Card', 'debit_card'),
(4, 'MTN GH MoMo', 'mtn_gh_momo');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userID` int(10) UNSIGNED NOT NULL,
  `firstName` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `lastName` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `location` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `dateAdded` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userID`, `firstName`, `lastName`, `username`, `email`, `password`, `phone`, `location`, `dateAdded`) VALUES
(1, 'Nyavowoyi', 'Ernest', 'Nyavowoyi', 'nyavowoyiernest@gmail.com', '$2y$10$V9xid4HWnK1wpyE7l3kHveqPGTZWRl/gxh1bZmJGjAFi3Wyjmi11O', '+233264660194', 'Pokuase', '2019-11-14 19:45:26'),
(11, 'Ghana', 'Boy', 'Ghana_Boy', 'gb@whatsapp.net', '$2y$10$V9xid4HWnK1wpyE7l3kHveqPGTZWRl/gxh1bZmJGjAFi3Wyjmi11O', '233264660194', 'Tema', '2019-11-15 14:41:43'),
(12, 'Tudent', 'Portala', 'Tudent_Portala', 'tudentportala@gmail.com', '$2y$10$m46zHz65JrMD72XyAkJieuYPKba2arXgcsaXzxtEOeqcaJAqNqRt6', '233552745724', 'Navrongo', '2019-11-15 16:07:10'),
(15, 'Captain', 'Elikem', 'Captain_Elikem', 'tudentportala@gmail.net', '$2y$10$BRGkRxAR9f61GGqC7gfLC.Bu83fa/oUHBeBA5R4kCNTge2.GWngte', '233264660195', 'Accra', '2019-11-15 16:09:24'),
(22, 'man', 'the', 'man_the', 'm2@gmail.com', '$2y$10$l45kOLjpB4ovRv4ZWoPKe.VL.QPrDE/sDJf8tBqyD0YnwsighaDqK', '233264660199', 'Yayra', '2019-11-15 17:25:15'),
(42, 'mama', 'rejoice', 'mama_rejoice', 'mr@gmail.com', '$2y$10$ALxmLJj829dZOjNPDbBRxuMrNjjVw7Uzy9RDXwHarcIxgbl.mJwGO', '233546068729', 'New Life', '2019-11-18 10:30:57'),
(43, 'Daddy', 'Felix', 'Daddy_Felix', 'df@gmail.com', '$2y$10$XUJf7GiEegnJaOxP4xuPEeUN00jNI.g5WBYdtMl4rcVNwVyOUye6O', '233243175920', 'New Life', '2019-11-18 10:33:20');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `administrators`
--
ALTER TABLE `administrators`
  ADD PRIMARY KEY (`adminID`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `adminroles`
--
ALTER TABLE `adminroles`
  ADD PRIMARY KEY (`roleID`);

--
-- Indexes for table `counselling`
--
ALTER TABLE `counselling`
  ADD PRIMARY KEY (`counsellingID`);

--
-- Indexes for table `counsellingcat`
--
ALTER TABLE `counsellingcat`
  ADD PRIMARY KEY (`counsellingCatID`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `counsellingsubcat`
--
ALTER TABLE `counsellingsubcat`
  ADD PRIMARY KEY (`cSCID`),
  ADD KEY `cCatID` (`cCatID`);

--
-- Indexes for table `expertrequest`
--
ALTER TABLE `expertrequest`
  ADD PRIMARY KEY (`requestID`),
  ADD UNIQUE KEY `userID` (`userID`);

--
-- Indexes for table `experts`
--
ALTER TABLE `experts`
  ADD PRIMARY KEY (`expertID`);

--
-- Indexes for table `paymentmethods`
--
ALTER TABLE `paymentmethods`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `phone` (`phone`),
  ADD KEY `username_2` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `administrators`
--
ALTER TABLE `administrators`
  MODIFY `adminID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `counselling`
--
ALTER TABLE `counselling`
  MODIFY `counsellingID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `counsellingcat`
--
ALTER TABLE `counsellingcat`
  MODIFY `counsellingCatID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `counsellingsubcat`
--
ALTER TABLE `counsellingsubcat`
  MODIFY `cSCID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `expertrequest`
--
ALTER TABLE `expertrequest`
  MODIFY `requestID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `experts`
--
ALTER TABLE `experts`
  MODIFY `expertID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `paymentmethods`
--
ALTER TABLE `paymentmethods`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `counsellingsubcat`
--
ALTER TABLE `counsellingsubcat`
  ADD CONSTRAINT `counsellingsubcat_ibfk_1` FOREIGN KEY (`cCatID`) REFERENCES `counsellingcat` (`counsellingCatID`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `counsellingsubcat_ibfk_2` FOREIGN KEY (`cCatID`) REFERENCES `counsellingcat` (`counsellingCatID`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
