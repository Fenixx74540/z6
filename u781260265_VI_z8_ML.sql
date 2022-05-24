-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 24, 2022 at 10:41 AM
-- Server version: 10.5.13-MariaDB-cll-lve
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u781260265_VI_z8_ML`
--

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE `files` (
  `idf` int(11) NOT NULL,
  `idu` int(11) NOT NULL,
  `nazwa_pliku` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `sciezka_pliku` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `files`
--

INSERT INTO `files` (`idf`, `idu`, `nazwa_pliku`, `sciezka_pliku`) VALUES
(1, 2, 'wallpaper_1.jpg', 'users/user2'),
(2, 2, 'Screenshots', 'users/user2'),
(3, 2, 'mem.jpg', 'users/user2/Screenshots');

-- --------------------------------------------------------

--
-- Table structure for table `lock_account`
--

CREATE TABLE `lock_account` (
  `idla` int(11) NOT NULL,
  `idu` int(11) NOT NULL,
  `datetime` datetime NOT NULL DEFAULT current_timestamp(),
  `ip_adress` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `ACK` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lock_account`
--

INSERT INTO `lock_account` (`idla`, `idu`, `datetime`, `ip_adress`, `ACK`) VALUES
(1, 1, '2022-05-24 09:57:10', '2a02:a311:c100:5a00:57:11eb:a82b:befa', 0),
(2, 1, '2022-05-24 09:57:13', '2a02:a311:c100:5a00:57:11eb:a82b:befa', 0),
(3, 1, '2022-05-24 09:57:17', '2a02:a311:c100:5a00:57:11eb:a82b:befa', 0),
(4, 2, '2022-05-24 10:02:30', '2a02:a311:c100:5a00:57:11eb:a82b:befa', 0),
(5, 2, '2022-05-24 10:02:35', '2a02:a311:c100:5a00:57:11eb:a82b:befa', 0),
(6, 2, '2022-05-24 10:02:40', '2a02:a311:c100:5a00:57:11eb:a82b:befa', 0),
(7, 2, '2022-05-24 10:02:51', '2a02:a311:c100:5a00:57:11eb:a82b:befa', 0),
(8, 1, '2022-05-24 10:15:39', '2a02:a311:c100:5a00:57:11eb:a82b:befa', 0);

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `idl` int(11) NOT NULL,
  `idu` int(11) NOT NULL,
  `datetime` datetime NOT NULL DEFAULT current_timestamp(),
  `result` tinyint(1) NOT NULL,
  `ip_adress` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`idl`, `idu`, `datetime`, `result`, `ip_adress`) VALUES
(1, 1, '2022-05-24 09:17:28', 1, '2a02:a311:c100:5a00:57:11eb:a82b:befa'),
(2, 1, '2022-05-24 09:18:10', 1, '2a02:a311:c100:5a00:57:11eb:a82b:befa'),
(3, 1, '2022-05-24 09:40:41', 1, '2a02:a311:c100:5a00:57:11eb:a82b:befa'),
(4, 1, '2022-05-24 09:40:46', 1, '2a02:a311:c100:5a00:57:11eb:a82b:befa'),
(5, 1, '2022-05-24 09:41:20', 1, '2a02:a311:c100:5a00:57:11eb:a82b:befa'),
(6, 2, '2022-05-24 09:42:54', 1, '2a02:a311:c100:5a00:57:11eb:a82b:befa'),
(7, 1, '2022-05-24 09:57:03', 0, '2a02:a311:c100:5a00:57:11eb:a82b:befa'),
(8, 1, '2022-05-24 09:57:07', 0, '2a02:a311:c100:5a00:57:11eb:a82b:befa'),
(9, 1, '2022-05-24 09:57:10', 0, '2a02:a311:c100:5a00:57:11eb:a82b:befa'),
(10, 1, '2022-05-24 09:57:13', 0, '2a02:a311:c100:5a00:57:11eb:a82b:befa'),
(11, 1, '2022-05-24 09:57:17', 0, '2a02:a311:c100:5a00:57:11eb:a82b:befa'),
(12, 2, '2022-05-24 10:02:30', 0, '2a02:a311:c100:5a00:57:11eb:a82b:befa'),
(13, 2, '2022-05-24 10:02:35', 0, '2a02:a311:c100:5a00:57:11eb:a82b:befa'),
(14, 2, '2022-05-24 10:02:40', 0, '2a02:a311:c100:5a00:57:11eb:a82b:befa'),
(15, 2, '2022-05-24 10:02:51', 0, '2a02:a311:c100:5a00:57:11eb:a82b:befa'),
(16, 1, '2022-05-24 10:15:39', 0, '2a02:a311:c100:5a00:57:11eb:a82b:befa');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `idu` int(11) NOT NULL,
  `login` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `proby_logowania` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`idu`, `login`, `password`, `proby_logowania`) VALUES
(1, 'user1', 'pass1', 2),
(2, 'user2', 'pass2', 0),
(3, 'user3', 'pass3', 0),
(4, 'user4', 'pass4', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`idf`);

--
-- Indexes for table `lock_account`
--
ALTER TABLE `lock_account`
  ADD PRIMARY KEY (`idla`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`idl`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`idu`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
  MODIFY `idf` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `lock_account`
--
ALTER TABLE `lock_account`
  MODIFY `idla` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `idl` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `idu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
