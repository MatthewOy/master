-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2023-05-19 08:51:46
-- 伺服器版本： 10.4.27-MariaDB
-- PHP 版本： 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `member`
--

-- --------------------------------------------------------

--
-- 資料表結構 `board`
--

CREATE TABLE `board` (
  `boardid` int(11) UNSIGNED NOT NULL,
  `boardname` varchar(50) DEFAULT NULL,
  `boardsex` enum('男','女') NOT NULL DEFAULT '男',
  `boardsubject` varchar(100) DEFAULT NULL,
  `boardtime` datetime DEFAULT NULL,
  `boardcontent` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- 傾印資料表的資料 `board`
--

INSERT INTO `board` (`boardid`, `boardname`, `boardsex`, `boardsubject`, `boardtime`, `boardcontent`) VALUES
(1, 'user', '男', 'test', '2023-05-15 11:27:13', '123456789987654321'),
(2, '5678', '女', '5678', '2023-05-15 14:24:55', '567888888'),
(3, 'Dio', '男', '我不當人類啦JOJO', '2023-05-15 14:26:50', 'Wryyyyyyyyyyy'),
(4, 'Dio', '男', '你啊', '2023-05-15 14:29:19', '你會記得你至今吃過多少片麵包嗎'),
(5, '承太郎', '男', '歐啦歐啦歐啦', '2023-05-15 14:44:36', '歐啦歐啦歐啦歐啦歐啦歐啦歐啦歐啦歐啦歐啦歐啦歐啦歐啦歐啦歐啦'),
(6, 'Dio', '男', 'The World', '2023-05-15 14:46:31', '砸~瓦魯多~'),
(7, '藍染', '男', '無法理解嗎', '2023-05-15 18:29:59', '憧憬，是距離理解最遙遠的感情'),
(8, '黑崎一護', '男', '難...', '2023-05-15 18:30:47', '...打頭...?'),
(9, '緣一', '男', '兄長大人', '2023-05-15 18:35:16', '才智遠超我們的人此刻也在呱呱墜地，他們也會達到和我們相同的境界吧。什麼都不必擔心，無論何時，我們都可以心無牽掛地告別人世。'),
(10, '杏壽郎', '男', '炎柱', '2023-05-17 14:24:22', '我會履行我的職責！ 在場的任何一個人都不會死去！'),
(11, '杏壽郎', '男', '你們...', '2023-05-17 14:26:31', '胸を張って生きろ！(挺起胸膛活下去吧！)'),
(12, '炭治郎', '男', '上弦之三', '2023-05-17 14:28:04', '大哥沒有輸！！！'),
(13, '甘露寺蜜璃', '女', '戀柱', '2023-05-17 14:29:28', '我絕不讓同伴死去，鬼殺隊是我的歸宿，管你是上弦還是什麼!');

-- --------------------------------------------------------

--
-- 資料表結構 `diary`
--

CREATE TABLE `diary` (
  `id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- 傾印資料表的資料 `diary`
--

INSERT INTO `diary` (`id`, `member_id`, `title`, `content`, `created_at`, `updated_at`) VALUES
(1, 4, '0505', '下雨好煩:(', '2023-05-18 05:47:06', '2023-05-19 01:10:11'),
(3, 4, '3456', 'abcdefg65432', '2023-05-18 06:31:36', '2023-05-19 01:44:37'),
(4, 4, '001', 'abcdefg3', '2023-05-18 07:20:00', '2023-05-18 11:49:20'),
(5, 4, '今晚', '下雨，要大不大要小不小的QQ', '2023-05-18 11:50:02', '2023-05-18 14:30:52'),
(6, 5, '0500', '今天天氣悶悶，雨要下不下QQ', '2023-05-19 00:53:43', '2023-05-19 01:05:28'),
(7, 5, '0519', '今天天氣悶悶，雨要下不下', '2023-05-19 00:55:31', '2023-05-19 00:55:38'),
(8, 6, '00878', '00878國泰永續高股息^.<', '2023-05-19 01:06:27', '2023-05-19 01:06:27'),
(9, 10, '00900', '009000090000900\r\n00900\r\n00900', '2023-05-19 01:19:26', '2023-05-19 01:19:26'),
(10, 8, 'abcdefg', 'abcdefg\r\nabcdefg\r\nabcdefg\r\nabcdefg\r\nabcdef', '2023-05-19 01:54:04', '2023-05-19 01:54:15');

-- --------------------------------------------------------

--
-- 資料表結構 `memberdata`
--

CREATE TABLE `memberdata` (
  `m_id` int(11) NOT NULL,
  `m_name` varchar(20) NOT NULL,
  `m_username` varchar(20) NOT NULL,
  `m_passwd` varchar(100) NOT NULL,
  `m_sex` enum('男','女') NOT NULL,
  `m_birthday` date DEFAULT NULL,
  `m_level` enum('admin','member') NOT NULL DEFAULT 'member',
  `m_email` varchar(100) DEFAULT NULL,
  `m_url` varchar(100) DEFAULT NULL,
  `m_phone` varchar(100) DEFAULT NULL,
  `m_address` varchar(100) DEFAULT NULL,
  `m_login` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `m_logintime` datetime DEFAULT NULL,
  `m_jointime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- 傾印資料表的資料 `memberdata`
--

INSERT INTO `memberdata` (`m_id`, `m_name`, `m_username`, `m_passwd`, `m_sex`, `m_birthday`, `m_level`, `m_email`, `m_url`, `m_phone`, `m_address`, `m_login`, `m_logintime`, `m_jointime`) VALUES
(1, '金庸', 'admin001', '$2y$10$3Kbx5bRZlEhHKa5RC67CYO8.V1hqF.K4O6Cq3h3C9zAYdCG59vIwq', '男', '1924-03-10', 'admin', 'matthew.oyz@gmail.com', '', '123456789', '123456789', 34, '2023-05-19 14:50:46', '2023-05-06 22:50:14'),
(2, '郭靖', 'user001', '$2y$10$rhRL4s6yRsMBlaQCkVugPeWD0NNaM.Ed/7WjXEcev3zoocuF8DSP6', '男', '1200-10-10', 'member', 'abc123@gmail.com', '', '1234567789', '123456789', 7, '2023-05-18 23:56:55', '2023-05-06 23:12:18'),
(3, '楊過', 'user002', '$2y$10$rnYV8A8Qp0.ra0xoEsmFHOvOzs0wMn20ki4lcWrTat6E/T2OHig5O', '男', '1240-06-06', 'member', 'abc123@gmail.com', '', '123456789', '123456789', 2, '2023-05-17 09:54:53', '2023-05-06 23:13:26'),
(4, '張無忌', 'user003', '$2y$10$eYDs8QMUv5xmoqmOSKk/gumGLBm6t9Duht0WB7ltCNV31K6EG5tla', '男', '1300-05-05', 'member', 'abc123@yahoo.com.tw', '', '123456', '123456', 8, '2023-05-18 14:45:03', '2023-05-06 23:14:30'),
(5, '令狐冲', 'user004', '$2y$10$4cOebRoZ/6Tt9XR9vQ3vFu7FXaR5r5cWmsn34QXDJ19xjNef2Y8bi', '男', '1550-05-05', 'member', 'abc123@yahoo.com.tw', '', '123456', '123456', 5, '2023-05-19 08:53:08', '2023-05-06 23:21:26'),
(6, '喬峰', 'user005', '$2y$10$BPrriDyuUJHbK8EjKyZMPO7oArb66BwY/iBDfMngtbboylaXWw9I6', '男', '1600-06-06', 'member', 'user005@gmail.com', '', '005', '005', 3, '2023-05-19 09:05:45', '2023-05-06 23:22:42'),
(7, '段譽', 'user006', '$2y$10$trWhVPaQOvPE3JFhiJ/RCOy.8ImtY1JnuBlewTQImV5.SH4.vRMMO', '男', '1620-06-10', 'member', 'user006@gmail.com', '', '006', '006', 1, '2023-05-17 22:21:53', '2023-05-06 23:23:38'),
(8, '虛竹', 'user007', '$2y$10$pq.t21Paxi6vZ2jXG3w6r.G.3FzXBVRUx8qpvOscwUO6LYnUBcTsa', '男', '1615-01-05', 'member', 'user007@yahoo.com.tw', '', '007', '007', 4, '2023-05-19 14:49:46', '2023-05-06 23:24:20'),
(10, '黃蓉', 'user008', '$2y$10$znJTc0y61NySJs6.rENxjeshE47.1RJns.6rvTeijTCp6dI0uABeO', '女', '1205-10-10', 'member', 'abc123@yahoo.com.tw', '', '123456789', '123456789', 6, '2023-05-19 14:50:27', '2023-05-17 23:13:43');

-- --------------------------------------------------------

--
-- 資料表結構 `users`
--

CREATE TABLE `users` (
  `id` int(8) NOT NULL,
  `account` varchar(10) NOT NULL DEFAULT '',
  `password` varchar(10) NOT NULL DEFAULT '',
  `name` varchar(10) NOT NULL DEFAULT '',
  `sex` char(2) NOT NULL DEFAULT '',
  `year` tinyint(4) NOT NULL DEFAULT 0,
  `month` tinyint(4) NOT NULL DEFAULT 0,
  `day` tinyint(4) NOT NULL DEFAULT 0,
  `telephone` varchar(20) NOT NULL DEFAULT '',
  `cellphone` varchar(20) NOT NULL DEFAULT '',
  `address` varchar(50) NOT NULL DEFAULT '',
  `email` varchar(50) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- 傾印資料表的資料 `users`
--

INSERT INTO `users` (`id`, `account`, `password`, `name`, `sex`, `year`, `month`, `day`, `telephone`, `cellphone`, `address`, `email`) VALUES
(1, 'guest', 'guest', '阿凱', '男', 80, 6, 24, '(02) 2368-5978', '(0968) 568-854', '台北市大安區師大路 20 號', 'kai@ms17.url.com.tw'),
(2, 'boy001', '123456', '趙敏', '女', 72, 7, 2, '123456', '123456', '123456', '123456'),
(3, 'boy002', '123456', '張無忌', '男', 70, 7, 7, '123456', '123456', '123456', '123456'),
(4, 'boy003', '123456', '謝遜', '男', 20, 20, 20, '123456', '123456', '123456', '123456');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `board`
--
ALTER TABLE `board`
  ADD PRIMARY KEY (`boardid`);

--
-- 資料表索引 `diary`
--
ALTER TABLE `diary`
  ADD PRIMARY KEY (`id`),
  ADD KEY `member_id` (`member_id`);

--
-- 資料表索引 `memberdata`
--
ALTER TABLE `memberdata`
  ADD PRIMARY KEY (`m_id`);

--
-- 資料表索引 `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `board`
--
ALTER TABLE `board`
  MODIFY `boardid` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `diary`
--
ALTER TABLE `diary`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `memberdata`
--
ALTER TABLE `memberdata`
  MODIFY `m_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `users`
--
ALTER TABLE `users`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- 已傾印資料表的限制式
--

--
-- 資料表的限制式 `diary`
--
ALTER TABLE `diary`
  ADD CONSTRAINT `diary_ibfk_1` FOREIGN KEY (`member_id`) REFERENCES `memberdata` (`m_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
