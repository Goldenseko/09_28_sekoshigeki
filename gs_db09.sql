-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 2018 年 2 月 08 日 16:01
-- サーバのバージョン： 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `gs_db09`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `gs_an_table`
--

CREATE TABLE IF NOT EXISTS `gs_an_table` (
`id` int(12) NOT NULL,
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `naiyou` text COLLATE utf8_unicode_ci NOT NULL,
  `indate` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- テーブルのデータのダンプ `gs_an_table`
--

INSERT INTO `gs_an_table` (`id`, `name`, `email`, `naiyou`, `indate`) VALUES
(2, 'WAKABAYASHI', 'test2@test.test', '<p>テスト323333</p>\r\n', '2016-09-03 15:43:01'),
(3, 'ジーズ三郎', 'test3@test.test', 'テスト3', '2016-09-03 15:45:57'),
(4, 'ジーズ次郎', 'test4@test.test', 'テスト4', '2016-09-03 15:46:49'),
(5, 'ジーズ次郎', 'test5@test.test', 'テスト5', '2016-09-03 15:47:06'),
(7, 'やまざき だいすけ', 'yamazaki@venezia-works.com', '今日はのりのりだね！！', '2016-09-10 16:02:35'),
(8, 'あああ', 'test@test', 'うううう', '2016-09-10 16:04:31'),
(10, 'すげー！！！', '1', '<p>ワードみたいに使ってね v（＊＾_＾＊）v</p>\r\n', '2016-10-01 15:28:55'),
(11, 'すげー！！！！！！', '1', '<p>ワードみたいに使ってね v（＊＾_＾＊）v</p>\r\n', '2016-10-01 15:30:48'),
(12, 'TEST', 'test@test.com', 'THIS IS AGAIN A TEST', '2018-02-06 22:15:39'),
(13, 'user', 'ssssss@sss.com', 'THI is is asa test', '2018-02-07 13:13:27'),
(14, 'user', 'aaaaa', 'aaa', '2018-02-07 13:14:22');

-- --------------------------------------------------------

--
-- テーブルの構造 `gs_bm_table`
--

CREATE TABLE IF NOT EXISTS `gs_bm_table` (
`id` int(12) NOT NULL,
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `b_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `b_url` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `b_comment` varchar(2000) COLLATE utf8_unicode_ci NOT NULL,
  `posttime` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- テーブルのデータのダンプ `gs_bm_table`
--

INSERT INTO `gs_bm_table` (`id`, `name`, `b_name`, `b_url`, `b_comment`, `posttime`) VALUES
(1, '一般user', 'Yamanotono', 'https://www.test.com', 'this is a test', '2018-02-06 22:13:28'),
(2, 'Shigeki Seko', 'Yamanoto2', 'httospsafdafasdf', 'this is a second commnet', '2018-02-06 22:13:15'),
(3, '一般hogehoge', 'RB', 'www.amazon.co.jp', 'Super Comment', '2018-02-06 22:20:24'),
(4, '一般hogehoge2', 'RB2', 'www.amazon.co.jp', 'Super Comment', '2018-02-06 22:20:24'),
(5, '一般hogehoge3', 'RB3', 'www.amazon.co.jp', 'Super Comment', '2018-02-06 22:20:24');

-- --------------------------------------------------------

--
-- テーブルの構造 `gs_user_table`
--

CREATE TABLE IF NOT EXISTS `gs_user_table` (
`id` int(11) NOT NULL,
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `lid` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `lpw` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `kanri_flg` int(1) NOT NULL DEFAULT '0',
  `life_flg` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- テーブルのデータのダンプ `gs_user_table`
--

INSERT INTO `gs_user_table` (`id`, `name`, `lid`, `lpw`, `kanri_flg`, `life_flg`) VALUES
(1, '管理者', 'admin', 'admin', 1, 0),
(2, '一般user', 'user', 'user', 0, 0),
(3, '退会者', 'taikai', 'taikai', 0, 1),
(4, '一般hogehoge', 'hogehoge', 'hogehoge', 0, 0),
(5, '一般hogehoge2', 'hogehoge2', 'hogehoge2', 0, 0),
(6, '一般hogehoge3', 'hogehoge3', 'hogehoge3', 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `gs_an_table`
--
ALTER TABLE `gs_an_table`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gs_bm_table`
--
ALTER TABLE `gs_bm_table`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gs_user_table`
--
ALTER TABLE `gs_user_table`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `gs_an_table`
--
ALTER TABLE `gs_an_table`
MODIFY `id` int(12) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `gs_bm_table`
--
ALTER TABLE `gs_bm_table`
MODIFY `id` int(12) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `gs_user_table`
--
ALTER TABLE `gs_user_table`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
