-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- 생성 시간: 21-07-11 12:54
-- 서버 버전: 10.4.11-MariaDB
-- PHP 버전: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 데이터베이스: `hyangwooinc`
--

-- --------------------------------------------------------

--
-- 테이블 구조 `result`
--

CREATE TABLE `result` (
  `no` int(11) NOT NULL,
  `imp_uid` varchar(50) NOT NULL,
  `merchant_uid` varchar(50) NOT NULL,
  `paid_amount` int(10) NOT NULL,
  `apply_num` varchar(50) NOT NULL,
  `pg_tid` varchar(50) NOT NULL,
  `receipt_url` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 테이블의 덤프 데이터 `result`
--

INSERT INTO `result` (`no`, `imp_uid`, `merchant_uid`, `paid_amount`, `apply_num`, `pg_tid`, `receipt_url`) VALUES
(2, 'imp_227018545953', 'merchant_1625975018092', 33000, '00593093', '', ''),
(3, 'imp_468592386568', 'merchant_1625975591785', 33000, '00406789', '', ''),
(4, 'imp_378865470112', 'merchant_1625993864725', 0, '', '', ''),
(5, 'imp_914991628898', 'merchant_1625993990967', 33000, '00684747', 'StdpayCARDINIpayTest20210711180022816251', 'https://iniweb.inicis.com/DefaultWebApp/mall/cr/cm/mCmReceipt_head.jsp?noTid=StdpayCARDINIpayTest20210711180022816251&noMethod=1'),
(6, 'imp_574506159350', 'merchant_1625994505535', 33000, '00108004', 'StdpayCARDINIpayTest20210711180856799318', 'https://iniweb.inicis.com/DefaultWebApp/mall/cr/cm/mCmReceipt_head.jsp?noTid=StdpayCARDINIpayTest20210711180856799318&noMethod=1'),
(7, 'imp_349091532115', 'merchant_1625995090798', 11000, '00135904', 'StdpayCARDINIpayTest20210711181843716526', 'https://iniweb.inicis.com/DefaultWebApp/mall/cr/cm/mCmReceipt_head.jsp?noTid=StdpayCARDINIpayTest20210711181843716526&noMethod=1');

--
-- 덤프된 테이블의 인덱스
--

--
-- 테이블의 인덱스 `result`
--
ALTER TABLE `result`
  ADD PRIMARY KEY (`no`),
  ADD KEY `no` (`no`);

--
-- 덤프된 테이블의 AUTO_INCREMENT
--

--
-- 테이블의 AUTO_INCREMENT `result`
--
ALTER TABLE `result`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
