-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- 생성 시간: 21-08-05 13:34
-- 서버 버전: 10.1.13-MariaDB
-- PHP 버전: 7.3.1p1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
-- 테이블 구조 `member`
--

CREATE TABLE `member` (
  `no` int(11) NOT NULL,
  `id` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pwd` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ctel1` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ctel2` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ctel3` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pname` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ptel1` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ptel2` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ptel3` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 테이블의 덤프 데이터 `member`
--

INSERT INTO `member` (`no`, `id`, `pwd`, `company`, `ctel1`, `ctel2`, `ctel3`, `pname`, `ptel1`, `ptel2`, `ptel3`) VALUES
(11, 'hwmaster', '$2y$10$176Olhbh28xbNlolSEYuvOG3viHhGH9NCDS1eZHG2AjrBtIzGwuMW', '향우실업(주)', '031', '8059', '3974', '관리자', '031', '8059', '3974');

--
-- 덤프된 테이블의 인덱스
--

--
-- 테이블의 인덱스 `member`
--
ALTER TABLE `member`
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `no` (`no`);

--
-- 덤프된 테이블의 AUTO_INCREMENT
--

--
-- 테이블의 AUTO_INCREMENT `member`
--
ALTER TABLE `member`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
