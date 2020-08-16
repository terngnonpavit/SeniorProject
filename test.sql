-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 16, 2020 at 07:53 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `author` varchar(255) CHARACTER SET utf8 NOT NULL,
  `date` varchar(255) NOT NULL,
  `titleTH` varchar(255) CHARACTER SET utf8 NOT NULL,
  `city` varchar(255) NOT NULL,
  `publisher` varchar(255) NOT NULL,
  `id` int(11) NOT NULL,
  `page` varchar(255) NOT NULL,
  `titleEN` varchar(255) CHARACTER SET utf8 NOT NULL,
  `type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`author`, `date`, `titleTH`, `city`, `publisher`, `id`, `page`, `titleEN`, `type`) VALUES
('Lipson', '2011', 'ชื่อไรดีน้า', 'Chicago,IL ', 'University of Chicago Press', 1, '', 'A Quick guide to citation style', 'books'),
('Peter', '1999', 'ไม่รู้จ้า', 'london', 'UK', 2, '', 'i have no clue', 'books');

-- --------------------------------------------------------

--
-- Table structure for table `journals`
--

CREATE TABLE `journals` (
  `author` varchar(255) CHARACTER SET utf8 NOT NULL,
  `date` varchar(50) NOT NULL,
  `article_title` varchar(255) NOT NULL,
  `titleTH` varchar(255) CHARACTER SET utf8 NOT NULL,
  `volume` varchar(50) NOT NULL,
  `issue` varchar(50) NOT NULL,
  `pages` varchar(50) NOT NULL,
  `id` int(11) NOT NULL,
  `titleEN` varchar(255) CHARACTER SET utf8 NOT NULL,
  `type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `journals`
--

INSERT INTO `journals` (`author`, `date`, `article_title`, `titleTH`, `volume`, `issue`, `pages`, `id`, `titleEN`, `type`) VALUES
('Schoeman', '2009', 'Establishing a process', 'ชื่อไรไม่รู้', '55', '8', '990-1002', 1, '', 'journals'),
('Peter Parker', '1998', 'ofgkeeeeeeeee', 'ไๆำยสยสยะเ', '55', '8', '', 2, 'seflkwedrwiodr', 'journals');

-- --------------------------------------------------------

--
-- Table structure for table `proceedings`
--

CREATE TABLE `proceedings` (
  `titleEN` varchar(255) CHARACTER SET utf8 NOT NULL,
  `author` varchar(255) CHARACTER SET utf8 NOT NULL,
  `id` int(2) NOT NULL,
  `type` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `titleTH` varchar(255) CHARACTER SET utf8 NOT NULL,
  `date` varchar(255) CHARACTER SET utf8 NOT NULL,
  `place` varchar(255) NOT NULL,
  `titleConference` varchar(255) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `proceedings`
--

INSERT INTO `proceedings` (`titleEN`, `author`, `id`, `type`, `titleTH`, `date`, `place`, `titleConference`) VALUES
('IoT for Hydropronic Planting: Automatic Detection of Water Quality', 'บุณยวีร์ ยางสวย, สิทธิพล เหลืองรุ่งทรัพย์, รัชดาพร คณาวงษ์, จิตดำรง ปรีชาสุข', 1, 'proceedings', 'IoT สำหรับการปลูกผักไฮโดรโปนิกส์: การตรวจสอบคุณภาพน้ของน้ำ และค่า pH แบบอัตโนมัติ', '22-24 March 2019', 'SCIT, Chiang Rai Rajabhat University, Chiang Rai, Thailand', 'The 7th ASEAN Undergraduate Conference in Computing (AUCC) 2019'),
('', 'จุฑามาศ ศรนารายณ์, ธนารีย์ อุปยโส, วีณาวดี ม่วงอ้น, ทัศนวรรณ ศูนย์กลาง, และ สุนีย์ พงษ์พินิจภิญโญ', 2, 'proceedings', 'ระบบแชทบอทช่วยสนับสนุนการตัดสินใจเลือกซื้อกาแฟ', '22-24 March 2019', 'SCIT, Chiang Rai Rajabhat University, Chiang Rai, Thailand', 'The 7th ASEAN Undergraduate Conference in Computing (AUCC)'),
('i dont know', 'Peter', 4, 'proceedings', 'หนูไม่รู้', '1995', 'Bangkok', 'goo mai roo');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`username`, `password`, `id`) VALUES
('test', '12345678', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `journals`
--
ALTER TABLE `journals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `proceedings`
--
ALTER TABLE `proceedings`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `journals`
--
ALTER TABLE `journals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `proceedings`
--
ALTER TABLE `proceedings`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
