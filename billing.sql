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
-- 테이블 구조 `billing`
--

CREATE TABLE `billing` (
  `no` int(11) NOT NULL,
  `company_name` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `sdate` date DEFAULT NULL,
  `buyer_name` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `buyer_tel_1` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `buyer_tel_2` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `buyer_tel_3` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `weight` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `imp_uid` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `pg_tid` varchar(50) NOT NULL,
  `paid` enum('Y','N') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 테이블의 덤프 데이터 `billing`
--

INSERT INTO `billing` (`no`, `company_name`, `sdate`, `buyer_name`, `buyer_tel_1`, `buyer_tel_2`, `buyer_tel_3`, `weight`, `amount`, `imp_uid`, `pg_tid`, `paid`) VALUES
(101, '화성시청', '2021-07-05', '홍길동', '010', '2378', '6398', 3000, 33000, 'imp_574506159350', 'StdpayCARDINIpayTest20210711180856799318', 'Y'),
(102, '용인시청', '2021-07-07', '김영희', '010', '2222', '3333', 5000, 55000, 'imp_363014678175', 'StdpayCARDINIpayTest20210711172728532331', 'Y'),
(103, '화성시청', '2021-07-08', '홍길동', '010', '2378', '6398', 1000, 11000, 'imp_349091532115', 'StdpayCARDINIpayTest20210711181843716526', 'Y');

--
-- 덤프된 테이블의 인덱스
--

--
-- 테이블의 인덱스 `billing`
--
ALTER TABLE `billing`
  ADD UNIQUE KEY `no` (`no`);

--
-- 덤프된 테이블의 AUTO_INCREMENT
--

--
-- 테이블의 AUTO_INCREMENT `billing`
--
ALTER TABLE `billing`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
