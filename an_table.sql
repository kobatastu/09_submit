-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: 2019 年 6 月 27 日 16:20
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
-- テーブルの構造 `an_table`
--

CREATE TABLE `an_table` (
  `id` int(64) NOT NULL,
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `name_rest` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `evaluation` int(2) NOT NULL,
  `title` text COLLATE utf8_unicode_ci NOT NULL,
  `comment` text COLLATE utf8_unicode_ci NOT NULL,
  `good` int(12) NOT NULL,
  `rest_pic` text COLLATE utf8_unicode_ci NOT NULL,
  `indate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- テーブルのデータのダンプ `an_table`
--

INSERT INTO `an_table` (`id`, `name`, `name_rest`, `evaluation`, `title`, `comment`, `good`, `rest_pic`, `indate`) VALUES
(1, 'koba', 'ラーメン研究所　ドレファラシド', 4, '伊勢原で最高のラーメン', '伊勢原ではNo.1の味。他でこのレベルの味噌ラーメンは食べることができない。', 2, '20190616020445d41d8cd98f00b204e9800998ecf8427e.jpg', '2019-06-09 00:31:59'),
(2, 'koba', 'とがくし', 5, '古き良き定食屋', '夫婦で経営している蕎麦屋。日替わり定食にはそばかうどんがついてくるので結構なボリュームである。サラダや漬物がついてくるのも嬉しい。', 1, '20190616020422d41d8cd98f00b204e9800998ecf8427e.jpg', '2019-06-09 16:19:28'),
(3, 'haru', 'おたふく', 4, '美味しいお好み焼き！', '作ってくれるタイプのお好み焼き屋。どの料理も美味しい！', 1, '20190616020540d41d8cd98f00b204e9800998ecf8427e.jpg', '2019-06-09 16:35:17'),
(4, 'tetsu', '麻釉', 4, 'とにかくなんでも多い！', '大盛りの店。最近少し盛りが少なくなったがそれでも多い。カツカレーがオススメ。', 1, '20190616020558d41d8cd98f00b204e9800998ecf8427e.jpg', '2019-06-09 16:40:52'),
(5, 'hayato', 'ジンギスカン　伊勢原店', 4, '食べやすいジンギスカン', '食べやすいジンギスカン、臭みもなくて良い。値段もお手頃。ただ店内は汚い。', 0, '20190616020659d41d8cd98f00b204e9800998ecf8427e.jpg', '2019-06-11 23:40:35'),
(6, 'sachiko', 'らーめん　ぎょうてん屋', 3, '伊勢原で唯一の家系ラーメン', '伊勢原で家系ラーメンを食べたい時はここで。ライス、刻み玉ねぎ、豆板醤無料が嬉しい。最近値上がりした', 0, '20190616021310d41d8cd98f00b204e9800998ecf8427e.jpg', '2019-06-12 00:19:19'),
(7, 'haru', '回転江戸前寿司　海鮮問屋　ふじ丸', 4, '新鮮な魚介類のお寿司屋さん', '新鮮な魚介類が売り。何を食べても美味しい。少し高いのが難点。', 0, '20190616021449d41d8cd98f00b204e9800998ecf8427e.jpg', '2019-06-12 23:13:57'),
(8, 'koba', '中華つくし', 4, '美味しい町中華', '美味しい中華料理店。自分で選んで数種のラーメン、チャーハン、餃子の中からセットを作れる。少々値段が張るので注意。', 1, '20190616021411d41d8cd98f00b204e9800998ecf8427e.jpg', '2019-06-15 10:58:04'),
(9, 'tetsu', 'イタリア料理　ラ　パチャーダ', 4, 'おしゃれなイタリアン', '伊勢原には場違いなイタリアン。料理、雰囲気ともに群を抜いているが、場違いなため閑散としている。ワインの種類が多い。', 1, '20190616021430d41d8cd98f00b204e9800998ecf8427e.jpg', '2019-06-15 11:02:36'),
(10, 'sachiko', 'Indian Oriental Cafe SUTAMINA2', 3, '本場のカレー屋', 'インド人(ネパール人？)が経営するカレー屋。常にナン、ライスおかわり自由なのが嬉しい。チーズナンがおすすめ。', 1, '20190616021349d41d8cd98f00b204e9800998ecf8427e.jpeg', '2019-06-15 11:07:38'),
(11, 'koba', 'わだらーめん', 5, 'すっきりとした醤油ラーメン', 'すっきり、あっさりとした醤油ラーメン。二日酔いの次の日に食べたくなるラーメン。', 0, '201906160231356d3e6ca784b429a00bf1278b681d2a4c.jpg', '2019-06-16 09:31:35');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `an_table`
--
ALTER TABLE `an_table`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `an_table`
--
ALTER TABLE `an_table`
  MODIFY `id` int(64) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
