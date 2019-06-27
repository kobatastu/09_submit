-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: 2019 年 6 月 27 日 16:21
-- サーバのバージョン： 10.1.38-MariaDB
-- PHP Version: 7.3.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `09_submit`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `good_table`
--

CREATE TABLE `good_table` (
  `id` int(255) NOT NULL,
  `user_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `rest_id` int(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- テーブルのデータのダンプ `good_table`
--

INSERT INTO `good_table` (`id`, `user_name`, `rest_id`) VALUES
(6, 'koba', 11),
(7, 'koba', 8),
(9, 'koba', 4),
(10, 'koba', 2),
(13, 'haru', 9),
(14, 'haru', 2),
(15, 'haru', 3),
(28, 'haru', 8),
(31, 'haru', 11),
(32, 'tetsu', 6),
(33, 'tetsu', 5),
(34, 'tetsu', 1),
(52, 'hayato', 4),
(68, 'hayato', 8),
(70, 'hayato', 7);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `good_table`
--
ALTER TABLE `good_table`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `good_table`
--
ALTER TABLE `good_table`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
