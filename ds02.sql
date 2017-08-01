-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: 2017-05-18 13:22:21
-- 服务器版本： 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ds02`
--

-- --------------------------------------------------------

--
-- 表的结构 `food_admin`
--

CREATE TABLE IF NOT EXISTS `food_admin` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` char(32) NOT NULL,
  `email` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- 转存表中的数据 `food_admin`
--

INSERT INTO `food_admin` (`id`, `username`, `password`, `email`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', '1469705186@qq.com'),
(2, 'lmq123', 'd2f27e8cd65c197360d1c83d6381466a', '1469705186@qq.com'),
(3, 'lmq1', 'e929ce29f9030fa8a4eb667d4c58f5ff', '1469705186@qq.com'),
(5, 'test', '098f6bcd4621d373cade4e832627b4f6', '1469705186@qq.com'),
(7, 'test1', '5a105e8b9d40e1329780d62ea2265d8a', '1469705186@qq.com');

-- --------------------------------------------------------

--
-- 表的结构 `food_album`
--

CREATE TABLE IF NOT EXISTS `food_album` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pid` int(10) unsigned NOT NULL,
  `albumPath` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- 转存表中的数据 `food_album`
--

INSERT INTO `food_album` (`id`, `pid`, `albumPath`) VALUES
(1, 1, '205f1c993641fb917440bb4b337ccb2b.jpg'),
(2, 1, 'd7f470e8ab3e9f84bcd65f6f479efede.jpg'),
(3, 1, 'e1a037be5ceb25dec4ec1bcfc7e39dc3.jpg'),
(4, 1, 'fa209f29696478cd7d2d7d01d72ea4fd.jpg'),
(5, 2, 'c11b5a0763d62a71ef114fadfe2db7b9.jpg'),
(6, 2, 'f710c59c5d74de97c86a9ccd1a3eab39.jpg'),
(8, 2, 'da92f4d422a66f5f814402edac9d2fa7.jpg'),
(9, 3, 'b51e3ab9fe406605dba6f4f8d0d16b6f.jpg'),
(12, 5, 'd198faaefcfb1038bbab86650e798c99.jpg'),
(13, 5, 'd0d38fcfae44f6ecbf420ca84f7a15b0.jpg'),
(14, 6, '7d3a77e670c6f8ecfe016fee5d67a9aa.jpg'),
(15, 6, 'ba396ef63ac5ce4e99f3327da69954fb.jpg'),
(16, 7, 'b4480b0c4e3f2675e28352fe17cd45ff.jpg'),
(17, 7, 'f97f23567638b87995c7ff2295afcd9f.jpg'),
(18, 8, '29119eb76a639dbe2907c0a92b6108b8.jpg'),
(19, 8, 'cc16048845834db23a1b1c833000eb78.png');

-- --------------------------------------------------------

--
-- 表的结构 `food_buy`
--

CREATE TABLE IF NOT EXISTS `food_buy` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `productid` bigint(20) unsigned NOT NULL DEFAULT '0',
  `userid` bigint(20) unsigned NOT NULL DEFAULT '0',
  `price` float(8,2) unsigned NOT NULL DEFAULT '0.00',
  `createtime` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `food_buy`
--

INSERT INTO `food_buy` (`id`, `productid`, `userid`, `price`, `createtime`) VALUES
(1, 3, 2, 75.00, 1495104305);

-- --------------------------------------------------------

--
-- 表的结构 `food_cate`
--

CREATE TABLE IF NOT EXISTS `food_cate` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `cName` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `cName` (`cName`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- 转存表中的数据 `food_cate`
--

INSERT INTO `food_cate` (`id`, `cName`) VALUES
(6, 'test'),
(7, 'test2'),
(8, 'test3'),
(1, '新品上市'),
(5, '缤纷甜点'),
(2, '鲜果时光');

-- --------------------------------------------------------

--
-- 表的结构 `food_pro`
--

CREATE TABLE IF NOT EXISTS `food_pro` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pName` varchar(50) NOT NULL,
  `pSn` varchar(50) NOT NULL,
  `pNum` int(10) unsigned DEFAULT '1',
  `mPrice` decimal(10,2) NOT NULL,
  `iPrice` decimal(10,2) NOT NULL,
  `pDesc` text,
  `pImg` varchar(50) NOT NULL,
  `pubTime` int(10) unsigned NOT NULL,
  `isShow` tinyint(1) DEFAULT '1',
  `isHot` tinyint(1) DEFAULT '0',
  `cId` smallint(5) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `pName` (`pName`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- 转存表中的数据 `food_pro`
--

INSERT INTO `food_pro` (`id`, `pName`, `pSn`, `pNum`, `mPrice`, `iPrice`, `pDesc`, `pImg`, `pubTime`, `isShow`, `isHot`, `cId`) VALUES
(1, '鲜橙汁', '1001', 20, '10.00', '5.00', '新鲜美味', '', 1492911963, 1, 0, 2),
(2, '甜蛋糕', '1002', 20, '30.00', '15.00', '香甜可口', '', 1492913480, 1, 0, 5),
(3, '北京烤鸭', '1005', 20, '90.00', '75.00', '<span style="color:#000000;font-family:宋体, Arial, Helvetica, sans-serif;font-size:16px;font-style:normal;font-weight:normal;line-height:30px;">烤鸭是具有世界声誉的北京著名菜式，由中国汉族人研制于明朝，在当时是宫廷食品。用料为优质肉食鸭北京鸭，果木炭火烤制，色泽红润，肉质肥而不腻，外脆里嫩。北京烤鸭分为两大流派，而北京最著名的烤鸭店也即是两派的代表。它以色泽红艳，肉质细嫩，味道醇厚，肥而不腻的特色，被誉为“天下美味”。</span>', '', 1493967904, 1, 0, 1),
(5, '123', '1234', 12, '12.00', '12.00', '分为红色的', '', 1494206965, 1, 0, 1),
(6, '2', '2', 2, '2.00', '2.00', '肉丸汤', '', 1494207030, 1, 0, 1),
(7, '6', '6', 6, '6.00', '6.00', '6', '', 1494207067, 1, 0, 1),
(8, '8', '8', 8, '8.00', '8.00', '8', '', 1494207099, 1, 0, 1);

-- --------------------------------------------------------

--
-- 表的结构 `food_user`
--

CREATE TABLE IF NOT EXISTS `food_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` char(32) NOT NULL,
  `sex` enum('男','女','保密') NOT NULL DEFAULT '保密',
  `face` varchar(50) NOT NULL,
  `regTime` int(10) unsigned NOT NULL,
  `email` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `food_user`
--

INSERT INTO `food_user` (`id`, `username`, `password`, `sex`, `face`, `regTime`, `email`) VALUES
(1, '11', '6512bd43d9caa6e02c990b0a82652dca', '男', 'b3c74bb6a13db2280a15b54ede1e5cee.jpg', 1495103377, '1'),
(2, 'ma', 'b74df323e3939b563635a2cba7a7afba', '女', 'e321bfd437326ec5c903b50b6f340480.jpg', 1495103409, '1469705186@qq.com');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
