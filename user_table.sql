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
-- テーブルの構造 `user_table`
--

CREATE TABLE `user_table` (
  `id` int(12) NOT NULL,
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `lid` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lpw` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `kanri_flg` int(1) NOT NULL,
  `life_flg` int(1) NOT NULL,
  `my_pic` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- テーブルのデータのダンプ `user_table`
--

INSERT INTO `user_table` (`id`, `name`, `lid`, `lpw`, `kanri_flg`, `life_flg`, `my_pic`) VALUES
(1, 'koba', 't.kobayashi107@gmail.com', '$2y$10$fr1sjGQ4N3IwA6WKRV.jx.jJoyXhlHvwIWE6ZnUA6cOBBsxNsopmG', 1, 0, '201906151744224e87bbd88636103be4f9122d527b93cb.jpg'),
(2, 'haru', 'haru@gmail.com', '$2y$10$KQspA1.gzck/eClBuSP.SuGEqX6LAeyoXbPYZ6uOdt6aSdvZaRSMu', 0, 0, '20190615174451e3babd2ae6e9526a2d5354a6bf9ebf57.jpg'),
(3, 'tetsu', 'tetsu@gmail.com', '$2y$10$PEWjSSDlm5aJ55JFhlF19.Qc/6iLMbb0Z.uCsDmZORFRfSqDDUbf2', 0, 0, '201906151745126b306e5808b05056b713f6127a753a78.jpeg'),
(4, 'sachiko', 'sachiko.gmail.com', '$2y$10$aCb2R1l6Rxn1T.XkMXdSUOnDlz/s9TYM/f1jmMrDtkOYtb9X4FltG', 0, 0, '20190615174552f66e45493bd37da73cff79e4cb0e4d64.jpeg'),
(5, 'hayato', 'hayato@gmail.com', '$2y$10$l1bvVN2ib./9eOp5bfMtFuwJPpKRXgLrf.P3djPmikXYEPj8cTbWy', 0, 0, '20190615174606fbf94999de5caed39e2867819e67d85f.jpg'),
(6, 'miya', 'miya@gmail.com', '$2y$10$z6oOC7HbaL/42e1T522Hv.E/hE3WAhFQzjw/iahoxuIXWUxlXYEz.', 0, 0, 'test'),
(8, 'huse', 'huse@gmail.com', '$2y$10$cZTR3gem8hAnwonVvA/02u8aCMw4E97PnmtfLtFs8REEPoc36nWYG', 0, 0, '201906151746203e5916e9e580e712656055e0f62bd9f8.jpg'),
(12, 'sakura', 'sakura@gmail.com', '$2y$10$hcKxHpJvhVDXojdhVKpig.mIDw.E48N0DWLdJa9BssKi1/qzuIitq', 0, 0, '20190615173312754afca1367d9ebc46d495b76df65c98.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `user_table`
--
ALTER TABLE `user_table`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user_table`
--
ALTER TABLE `user_table`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
