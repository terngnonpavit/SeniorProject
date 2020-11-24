-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 24, 2020 at 06:54 PM
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
  `date` varchar(255) CHARACTER SET utf8 NOT NULL,
  `titleTH` varchar(255) CHARACTER SET utf8 NOT NULL,
  `publisher` varchar(255) CHARACTER SET utf8 NOT NULL,
  `id` int(11) NOT NULL,
  `page` varchar(255) CHARACTER SET utf8 NOT NULL,
  `titleEN` varchar(255) CHARACTER SET utf8 NOT NULL,
  `type` varchar(255) CHARACTER SET utf8 NOT NULL,
  `file_path` varchar(255) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`author`, `date`, `titleTH`, `publisher`, `id`, `page`, `titleEN`, `type`, `file_path`) VALUES
('Charles Bostian, Thomas Rondeau', '2009', '-', 'Artech', 44, '150', 'Artificial Intelligence in Wireless Communications', 'books', 'http://localhost/seniorproject/uploads/BSIT62T3-07.pdf'),
('อาจารย์ ดร.คทา ประดิษฐวงศ์', '2555', 'โครงสร้างการคำนวณแบบไม่ต่อเนื่อง', 'โรงพิมพ์มหาวิทยาลัยศิลปากร', 46, '243', 'Discrete Computational Structures', 'books', 'http://localhost/seniorproject/uploads/BSIT62T3-07.pdf'),
('ผู้ช่วยศาสตราจารย์ ดร.คทา ประดิษฐ์วงศ์', '2555', 'การวิเคราะห์และออกแบบอัลกอริทึม', 'โรงพิมพ์มหาวิทยาลัยศิลปากร', 47, '243', 'Analysis and Design of Algorithms', 'books', 'http://localhost/seniorproject/uploads/BSIT62T3-07.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `journals`
--

CREATE TABLE `journals` (
  `author` varchar(255) CHARACTER SET utf8 NOT NULL,
  `date` varchar(50) CHARACTER SET utf8 NOT NULL,
  `publishedin` varchar(255) CHARACTER SET utf8 NOT NULL,
  `titleTH` varchar(255) CHARACTER SET utf8 NOT NULL,
  `volume` varchar(50) CHARACTER SET utf8 NOT NULL,
  `number` varchar(50) CHARACTER SET utf8 NOT NULL,
  `page` varchar(50) CHARACTER SET utf8 NOT NULL,
  `id` int(11) NOT NULL,
  `titleEN` varchar(255) CHARACTER SET utf8 NOT NULL,
  `type` varchar(255) CHARACTER SET utf8 NOT NULL,
  `file_path` varchar(255) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `journals`
--

INSERT INTO `journals` (`author`, `date`, `publishedin`, `titleTH`, `volume`, `number`, `page`, `id`, `titleEN`, `type`, `file_path`) VALUES
('Jitdumrong Preechasuk and Punpiti Piamsa-nga ', 'December 2015 ', 'Journal of Information Processing Systems(JIPS)', '-', '11 ', '4 ', '538-555 ', 7, 'Event Detection on Motion Activities Using a Dynamic Grid ', 'journals', 'http://localhost/seniorproject/uploads/BSIT62T1-05.pdf'),
('อ.จิตดำรง ปรีชาสุข', '2016', 'Journal of Information Processing Systems(JIPS)', '-', '2', '1', '150', 12, 'Image Analysis of Mushroom Types Classification by Convolution Neural Networks', 'journals', 'http://localhost/seniorproject/uploads/BSIT62T3-07.pdf'),
('อ.ดร.กฤษณะ สีพนมวัน', 'November 2019', 'ECTI Transaction on Computer And Information Technology', '-', 'vol.13', 'No.2', '-', 13, 'Acquisition and Utilization of Mental Imagery Capability in Robotic Action Sequencing Tasks', 'journals', 'http://localhost/seniorproject/uploads/BSIT62T3-07.pdf'),
('อ.ดร.กฤษณะ สีพนมวัน', 'November 2019', 'ECTI Transaction on Computer And Information Technology', 'อ.ดร.กฤษณะ สีพนมวัน', 'vol.13', 'No.2', '-', 14, 'Acquisition and Utilization of Mental Imagery Capability in Robotic Action Sequencing Tasks ECTI Transaction on Computer And Information Technology', 'journals', 'http://localhost/seniorproject/uploads/BSIT62T3-07.pdf');

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
  `place` varchar(255) CHARACTER SET utf8 NOT NULL,
  `titleConference` varchar(255) CHARACTER SET utf8 NOT NULL,
  `file_path` varchar(255) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `proceedings`
--

INSERT INTO `proceedings` (`titleEN`, `author`, `id`, `type`, `titleTH`, `date`, `place`, `titleConference`, `file_path`) VALUES
('IoT for Hydropronic Planting: Automatic Detection of Water Quality', 'บุณยวีร์ ยางสวย, สิทธิพล เหลืองรุ่งทรัพย์, รัชดาพร คณาวงษ์, จิตดำรง ปรีชาสุข', 1, 'proceedings', 'IoT สำหรับการปลูกผักไฮโดรโปนิกส์: การตรวจสอบคุณภาพน้ของน้ำ และค่า pH แบบอัตโนมัติ', '22-24 March 2019', 'SCIT, Chiang Rai Rajabhat University, Chiang Rai, Thailand', 'The 7th ASEAN Undergraduate Conference in Computing (AUCC) 2019', 'http://localhost/seniorproject/uploads/BSIT62T1-05.pdf'),
('Chatbot system supports coffee shopping', 'จุฑามาศ ศรนารายณ์, ธนารีย์ อุปยโส, วีณาวดี ม่วงอ้น, ทัศนวรรณ ศูนย์กลาง, และ สุนีย์ พงษ์พินิจภิญโญ', 2, 'proceedings', 'ระบบแชทบอทช่วยสนับสนุนการตัดสินใจเลือกซื้อกาแฟ', '22-24 March 2019', 'SCIT, Chiang Rai Rajabhat University, Chiang Rai, Thailand', 'The 7th ASEAN Undergraduate Conference in Computing (AUCC)', 'http://localhost/seniorproject/uploads/BSIT62T3-07.pdf'),
('Image Analysis of Mushroom Types Classification by Convolution Neural Networks', 'อาจารย์ จิตดำรง ปรีชาสุข', 19, 'proceedings', '-', '2020', 'Kobe University, Kobe, Japan', 'kkk', 'http://localhost/seniorproject/uploads/BSIT62T1-05.pdf'),
('SOS Application', 'อ.ดร.สิรักข์  แก้วจำนงค์', 20, 'proceedings', 'แอปพลิเคชันขอความช่วยเหลือบนระบบปฏิบัติการแอนดรอยด์', ' วันที่ 22-24 มีนาคม พ.ศ. 2562', 'มหาวิทยาลัยราชภัฏเชียงราย เชียงราย', 'The 7th ASEAN Undergraduate Conference in Computing (AUC2) 2019', 'http://localhost/seniorproject/uploads/BSIT62T3-07.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `scholarship_book`
--

CREATE TABLE `scholarship_book` (
  `year` varchar(255) CHARACTER SET utf8 NOT NULL,
  `date` varchar(255) CHARACTER SET utf8 NOT NULL,
  `titleTH` varchar(255) CHARACTER SET utf8 NOT NULL,
  `titleEN` varchar(255) CHARACTER SET utf8 NOT NULL,
  `author` varchar(255) CHARACTER SET utf8 NOT NULL,
  `writer_name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `writer_department` varchar(255) CHARACTER SET utf8 NOT NULL,
  `write_ratio` varchar(255) CHARACTER SET utf8 NOT NULL,
  `co_writer_name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `co_writer_department` varchar(255) CHARACTER SET utf8 NOT NULL,
  `co_write_ratio` varchar(255) CHARACTER SET utf8 NOT NULL,
  `keywordTH` varchar(255) CHARACTER SET utf8 NOT NULL,
  `keywordEN` varchar(255) CHARACTER SET utf8 NOT NULL,
  `amount` varchar(255) CHARACTER SET utf8 NOT NULL,
  `amount_text` varchar(255) CHARACTER SET utf8 NOT NULL,
  `subject_no` varchar(255) CHARACTER SET utf8 NOT NULL,
  `subject` varchar(255) CHARACTER SET utf8 NOT NULL,
  `for_student` varchar(255) CHARACTER SET utf8 NOT NULL,
  `student_year` varchar(255) CHARACTER SET utf8 NOT NULL,
  `page_amount` varchar(255) CHARACTER SET utf8 NOT NULL,
  `chapter_no` varchar(255) CHARACTER SET utf8 NOT NULL,
  `chapter_name` text CHARACTER SET utf8 NOT NULL,
  `content` text CHARACTER SET utf8 NOT NULL,
  `teaching_history` varchar(255) CHARACTER SET utf8 NOT NULL,
  `applicant` varchar(255) CHARACTER SET utf8 NOT NULL,
  `head_of_department` varchar(255) CHARACTER SET utf8 NOT NULL,
  `department_name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `publisher` varchar(255) CHARACTER SET utf8 NOT NULL,
  `id` int(11) NOT NULL,
  `type` varchar(255) CHARACTER SET utf8 NOT NULL,
  `file_path` varchar(255) CHARACTER SET utf8 NOT NULL,
  `check_scholarship` varchar(255) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `scholarship_book`
--

INSERT INTO `scholarship_book` (`year`, `date`, `titleTH`, `titleEN`, `author`, `writer_name`, `writer_department`, `write_ratio`, `co_writer_name`, `co_writer_department`, `co_write_ratio`, `keywordTH`, `keywordEN`, `amount`, `amount_text`, `subject_no`, `subject`, `for_student`, `student_year`, `page_amount`, `chapter_no`, `chapter_name`, `content`, `teaching_history`, `applicant`, `head_of_department`, `department_name`, `publisher`, `id`, `type`, `file_path`, `check_scholarship`) VALUES
('2020', '20/08/2550', 'โครงสร้างการคำนวณแบบไม่ต่อเนื่อง', 'Discrete Computational Structures', 'ผศ.ดร.คทา ประดิษฐวงศ์', 'ผศ.ดร.คทา ประดิษฐวงศ์', 'คอมพิวเตอร์', '100', '-', 'คอมพิวเตอร์', '-', '', '', 'aaa', 'aaa', 'aaa', 'aaa', 'ปริญญาตรี', '1', '243', ',,,', ',,,', ',,,', '', 'ผศ.ดร.รัชดาพร คณาวงษ์', 'ณัฐโชติ พรหมฤทธิ์', 'คอมพิวเตอร์', 'aaa', 19, 'scholarship_book', '', 'true'),
('2020', '20/08/2550', 'การวิเคราะห์และออกแบบอัลกอริทึม', 'Analysis and Design of Algorithms', 'อ.ดร.ณัฐโชติ พรหมฤทธิ์,ผศ.ดร.อรวรรณ เชาวลิต', 'ผศ.ดร.คทา ประดิษฐวงศ์', 'คอมพิวเตอร์', '50', 'ผศ.ดร.อรวรรณ เชาวลิต', 'คอมพิวเตอร์', '50', '', '', 'aaa', 'aaa', 'aaa', 'aaa', 'ปริญญาตรี', '1', '303', ',,,', ',,,', ',,,', '', 'ผศ.ดร.คทา ประดิษฐวงศ์', 'ณัฐโชติ พรหมฤทธิ์', 'คอมพิวเตอร์', 'aaa', 20, 'scholarship_book', '', 'true');

-- --------------------------------------------------------

--
-- Table structure for table `scholarship_journal`
--

CREATE TABLE `scholarship_journal` (
  `author` varchar(255) CHARACTER SET utf8 NOT NULL,
  `department` varchar(255) CHARACTER SET utf8 NOT NULL,
  `titleTH` varchar(255) CHARACTER SET utf8 NOT NULL,
  `titleEN` varchar(255) CHARACTER SET utf8 NOT NULL,
  `journal_name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `volume` varchar(255) CHARACTER SET utf8 NOT NULL,
  `number` varchar(255) CHARACTER SET utf8 NOT NULL,
  `date` varchar(255) CHARACTER SET utf8 NOT NULL,
  `type_of_document` varchar(255) CHARACTER SET utf8 NOT NULL,
  `type_of_publication` varchar(255) CHARACTER SET utf8 NOT NULL,
  `database_name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `approval` varchar(255) CHARACTER SET utf8 NOT NULL,
  `participation` varchar(255) CHARACTER SET utf8 NOT NULL,
  `amount` varchar(255) CHARACTER SET utf8 NOT NULL,
  `amount_text` varchar(255) CHARACTER SET utf8 NOT NULL,
  `applicant` varchar(255) CHARACTER SET utf8 NOT NULL,
  `head_of_department` varchar(255) CHARACTER SET utf8 NOT NULL,
  `department_name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `page` varchar(255) CHARACTER SET utf8 NOT NULL,
  `id` int(11) NOT NULL,
  `type` varchar(255) CHARACTER SET utf8 NOT NULL,
  `file_path` varchar(255) CHARACTER SET utf8 NOT NULL,
  `check_scholarship` varchar(255) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `scholarship_journal`
--

INSERT INTO `scholarship_journal` (`author`, `department`, `titleTH`, `titleEN`, `journal_name`, `volume`, `number`, `date`, `type_of_document`, `type_of_publication`, `database_name`, `approval`, `participation`, `amount`, `amount_text`, `applicant`, `head_of_department`, `department_name`, `page`, `id`, `type`, `file_path`, `check_scholarship`) VALUES
('อ.ดร.กฤษณะ สีพนมวัน', 'ภาควิชาคอมพิวเตอร์', '', 'Acquisition and Utilization of Mental Imagery Capability in Robotic Action Sequencing Tasks ', 'ECTI Transaction on Computer And Information Technology', '', '', 'Mar 16, 2020 ', 'research_article', 'วารสารระดับนานาชาติที่ปรากฏในฐานข้อมูล ISI/Scopus รางวัลละไม่เกิน 30,000 บาท', '', 'กรณีที่ 1 ไม่เป็น (ได้รับการสนับสนุนเต็มจำนวน)', 'กรณีที่ 1 First Author', '30,000', 'สามหมื่นบาทถ้วน', 'อ.ดร.กฤษณะ สีพนมวัน', 'อ.ดร.ณัฐโชติ พรมฤทธิ์', 'คอมพิวเตอร์', '', 6, 'scholarship_journal', 'http://localhost/seniorproject/uploads/BSIT62T3-07.pdf', 'false'),
('อ.จิตดำรง ปรีชาสุข', 'ภาควิชาคอมพิวเตอร์', ' การวิเคราะห์ภาพของการจำแนกประเภทเห็ดโดย Convolution Neural Networks', 'Image Analysis of Mushroom Types Classification by Convolution Neural Networks', 'ECTI Transaction on Computer And Information Technology', '1', '1', '21-23 ธันวาคม พ.ศ. 2562', 'research_article', 'วารสารระดับนานาชาติที่ปรากฏในฐานข้อมูล ISI/Scopus รางวัลละไม่เกิน 30,000 บาท', '', 'กรณีที่ 1 ไม่เป็น (ได้รับการสนับสนุนเต็มจำนวน)', 'กรณีที่ 1 First Author', '30,000', 'สามหมื่นบาทถ้วน', 'อ.ดร.สิรักข์ แก้วจำนงค์', 'อ.ดร.ณัฐโชติ พรมฤทธิ์', 'คอมพิวเตอร์', '', 8, 'scholarship_journal', '', 'true');

-- --------------------------------------------------------

--
-- Table structure for table `scholarship_proceeding`
--

CREATE TABLE `scholarship_proceeding` (
  `author` varchar(255) CHARACTER SET utf8 NOT NULL,
  `department` varchar(255) CHARACTER SET utf8 NOT NULL,
  `titleTH` varchar(255) CHARACTER SET utf8 NOT NULL,
  `titleEN` varchar(255) CHARACTER SET utf8 NOT NULL,
  `conference_name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `place` varchar(255) CHARACTER SET utf8 NOT NULL,
  `date` varchar(255) CHARACTER SET utf8 NOT NULL,
  `type_of_document` varchar(255) CHARACTER SET utf8 NOT NULL,
  `type_of_publication` varchar(255) CHARACTER SET utf8 NOT NULL,
  `approval` varchar(255) CHARACTER SET utf8 NOT NULL,
  `participation` varchar(255) CHARACTER SET utf8 NOT NULL,
  `form_document` varchar(255) CHARACTER SET utf8 NOT NULL,
  `amount` varchar(255) CHARACTER SET utf8 NOT NULL,
  `amount_text` varchar(255) CHARACTER SET utf8 NOT NULL,
  `applicant` varchar(255) CHARACTER SET utf8 NOT NULL,
  `head_of_department` varchar(255) CHARACTER SET utf8 NOT NULL,
  `department_name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `id` int(11) NOT NULL,
  `type` varchar(255) CHARACTER SET utf8 NOT NULL,
  `file_path` varchar(255) CHARACTER SET utf8 NOT NULL,
  `check_scholarship` varchar(255) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `scholarship_proceeding`
--

INSERT INTO `scholarship_proceeding` (`author`, `department`, `titleTH`, `titleEN`, `conference_name`, `place`, `date`, `type_of_document`, `type_of_publication`, `approval`, `participation`, `form_document`, `amount`, `amount_text`, `applicant`, `head_of_department`, `department_name`, `id`, `type`, `file_path`, `check_scholarship`) VALUES
('อ.ดร.กฤษณะ สีพนมวัน', 'ภาควิชาคอมพิวเตอร์', '', 'An Economical Echo State Network for Time Series Generation Task', 'The 5th International Conference on Control and Robotics Engineering (ICCRE2020)', 'Online Presentation, 24-26 เม.ย. 2563', '', 'abstract', 'บทคัดย่อตีพิมพ์ในเอกสารสืบเนื่องจากการประชุมวิชาการระดับชาติ', 'กรณีที่ 2 เป็น (ได้รับการสนับสนุน 20% ของเงินรางวัลที่กำหนด)', 'กรณีที่ 2 เป็นผู้ร่วมเขียน', 'รูปเล่ม หรือ หนังสือ,ซีดี,เว็บไซต์,IEEExplore', '3,000', 'สามพันบาทถ้วน', 'อ.จิตดำรง ปรีชาสุข', 'อาจารย์ ดร.ณัฐโชติ พรมฤทธิ์', 'คอมพิวเตอร์', 16, 'scholarship_proceeding', '', 'false'),
('อ.จิตดำรง ปรีชาสุข', 'ภาควิชาคอมพิวเตอร์', '', 'Image Analysis of Mushroom Types Classification by Convolution Neural Networks', '2019 2nd Artificial Intelligence and Cloud Computing Conference', 'Kobe University, Kobe, Japan, วันที่ 21-23 ธันวาคม พ.ศ. 2562', '', 'research_article', 'Proceedings ตีพิมพ์ในเอกสารสืบเนื่องจาการประชุมวิชาการระดับนานาชาติ', 'กรณีที่ 1 ไม่เป็น (ได้รับการสนับสนุนเต็มจำนวน)', 'กรณีที่ 1 First Author', 'เว็บไซต์,ACM Digital Library', '3,000', 'สามพันบาทถ้วน', 'อ.จิตดำรง ปรีชาสุข', 'อ.ดร.ณัฐโชติ พรมฤทธิ์', 'คอมพิวเตอร์', 17, 'scholarship_proceeding', '', 'false'),
('อ.จิตดำรง ปรีชาสุข', 'ภาควิชาคอมพิวเตอร์', 'การพัฒนาเว็บแอปพลิเคชันสำหรับการบริหารจัดการรายวิชาโครงงานวิจัย', 'A Development of Web-based Application for Course Management of Research Project', 'The 8th Asia Undergraduate Conference on Computing (AUC2) 2020', 'มหาวิทยาลัยสวนดุสิต กรุงเทพมหานคร, วันที่ 14-16 กุมภาพันธ์ พ.ศ. 2563', '', 'research_article', 'Proceedings ตีพิมพ์ในเอกสารสืบเนื่องจาการประชุมวิชาการระดับชาติ', 'กรณีที่ 1 ไม่เป็น (ได้รับการสนับสนุนเต็มจำนวน)', 'กรณีที่ 1 Corresponding Author', 'เว็บไซต์,', '2,000', 'สองพันบาทถ้วน', 'อ.จิตดำรง ปรีชาสุข', 'อาจารย์ ดร.ณัฐโชติ พรหมฤทธิ์', 'คอมพิวเตอร์', 19, 'scholarship_proceeding', '', 'false'),
('อ.จิตดำรง ปรีชาสุข', 'ภาควิชาคอมพิวเตอร์', 'การจำแนกประเภทโรคเชื้อราของใบยางพาราด้วยการวิเคราะห์จากภาพถ่าย', 'A Classification of fungal in rubber leaves by image analysis', 'The 8th Asia Undergraduate Conference on Computing (AUC2) 2020', 'มหาวิทยาลัยสวนดุสิต กรุงเทพมหานคร, วันที่ 14-16 กุมภาพันธ์ พ.ศ. 2563', '', 'research_article', 'Proceedings ตีพิมพ์ในเอกสารสืบเนื่องจาการประชุมวิชาการระดับชาติ', 'กรณีที่ 1 ไม่เป็น (ได้รับการสนับสนุนเต็มจำนวน)', 'กรณีที่ 1 Corresponding Author', 'เว็บไซต์,', '2,000', 'สองพันบาทถ้วน', 'อ.จิตดำรง ปรีชาสุข', 'อาจารย์ ดร.ณัฐโชติ พรหมฤทธิ์', 'คอมพิวเตอร์', 20, 'scholarship_proceeding', '', 'false'),
('อ.ดร.ณัฐโชติ พรหมฤทธิ์', 'ภาควิชาคอมพิวเตอร์', 'การเพิ่มประสิทธิภาพการตรวจจับป้ายสำหรับผู้พิการทางสายตาโดยใช้เทคนิคการขยายภาพ', 'Improving Signs Detection for Blind by Using Image Augmentation Technique', 'The 8th Asia Undergraduate Conference on Computing (AUC2) 2020', 'มหาวิทยาลัยสวนดุสิต กรุงเทพมหานคร, วันที่ 14-16 กุมภาพันธ์ พ.ศ. 2563', '', 'research_article', 'Proceedings ตีพิมพ์ในเอกสารสืบเนื่องจาการประชุมวิชาการระดับชาติ', 'กรณีที่ 1 ไม่เป็น (ได้รับการสนับสนุนเต็มจำนวน)', 'กรณีที่ 1 Corresponding Author', 'เว็บไซต์,', '2,000', 'สองพันบาทถ้วน', 'อ.ดร.ณัฐโชติ พรหมฤทธิ์', 'อ.ดร.ณัฐโชติ พรมฤทธิ์', 'คอมพิวเตอร์', 21, 'scholarship_proceeding', '', 'false'),
('อ.ดร.ณัฐโชติ พรหมฤทธิ์', 'ภาควิชาคอมพิวเตอร์', 'ต้นแบบการตรวจจับท่าวิ่งที่ส่งผลต่อการบาดเจ็บ', 'The Prototype of Running Posture Analysis for injury Prediction', 'The 8th Asia Undergraduate Conference on Computing (AUC2) 2020', 'มหาวิทยาลัยสวนดุสิต กรุงเทพมหานคร, วันที่ 14-16 กุมภาพันธ์ พ.ศ. 2563', '', 'research_article', 'Proceedings ตีพิมพ์ในเอกสารสืบเนื่องจาการประชุมวิชาการระดับชาติ', 'กรณีที่ 1 ไม่เป็น (ได้รับการสนับสนุนเต็มจำนวน)', 'กรณีที่ 1 Corresponding Author', 'เว็บไซต์,', '2,000', 'สองพันบาทถ้วน', 'อ.ดร.ณัฐโชติ พรหมฤทธิ์', 'อาจารย์ ดร.ณัฐโชติ พรหมฤทธิ์', 'คอมพิวเตอร์', 22, 'scholarship_proceeding', '', 'false'),
('อ.ดร.ณัฐโชติ พรหมฤทธิ์', 'ภาควิชาคอมพิวเตอร์', 'การวิเคราะห์ข้อความจากโซเชียลมีเดียที่มีต่อศิลปินด้วยเทคนิคการเรียนรู้เชิงลึก กรณีตัวอย่าง BNK48', 'Social Media Sentences Analysis Using Deep Learning: Case Study BNK48', 'The 8th Asia Undergraduate Conference on Computing (AUC2) 2020', 'มหาวิทยาลัยสวนดุสิต กรุงเทพมหานคร, วันที่ 14-16 กุมภาพันธ์ พ.ศ. 2563', '', 'research_article', 'Proceedings ตีพิมพ์ในเอกสารสืบเนื่องจาการประชุมวิชาการระดับชาติ', 'กรณีที่ 1 ไม่เป็น (ได้รับการสนับสนุนเต็มจำนวน)', 'กรณีที่ 1 Corresponding Author', 'เว็บไซต์,', '2,000', 'สองพันบาทถ้วน', 'อ.ดร.ณัฐโชติ พรหมฤทธิ์', 'อ.ดร.ณัฐโชติ พรมฤทธิ์', 'คอมพิวเตอร์', 23, 'scholarship_proceeding', '', 'false'),
('อ.ดร.ณัฐโชติ  พรหมฤทธิ์', 'ภาควิชาคอมพิวเตอร์', 'ต้นแบบตัวประเมินผล Usability Test โดยอารมณ์บนใบหน้าและการคลิกเมาส์', 'The Prototype of the Usability Test Evaluation System by Analysis from Facial Motions and Mouse Click', 'The 8th Asia Undergraduate Conference on Computing (AUC2) 2020', 'มหาวิทยาลัยสวนดุสิต  กรุงเทพมหานคร, วันที่ 14-16 กุมภาพันธ์ พ.ศ. 2563', '', 'research_article', 'Proceedings ตีพิมพ์ในเอกสารสืบเนื่องจาการประชุมวิชาการระดับชาติ', 'กรณีที่ 1 ไม่เป็น (ได้รับการสนับสนุนเต็มจำนวน)', 'กรณีที่ 1 Corresponding Author', 'เว็บไซต์,', '2,000', 'สองพันบาทถ้วน', 'อ.ดร.ณัฐโชติ พรหมฤทธิ์', 'อ.ดร.ณัฐโชติ พรมฤทธิ์', 'คอมพิวเตอร์', 24, 'scholarship_proceeding', '', 'false'),
('อ.ดร.รัชดาพร  คณาวงษ์', 'ภาควิชาคอมพิวเตอร์', 'การตรวจจับ BIB ด้วยการวิเคราะห์รูปภาพโดยโครงข่ายประสาทแบบคอนโวลูชัน', 'BIB Number Detection by Image Analysis based on Convolution Neural Network', 'The 8th Asia Undergraduate Conference on Computing (AUC2) 2020', 'มหาวิทยาลัยสวนดุสิต กรุงเทพมหานคร, วันที่ 14-16 กุมภาพันธ์ พ.ศ. 2563', '', 'research_article', 'Proceedings ตีพิมพ์ในเอกสารสืบเนื่องจาการประชุมวิชาการระดับชาติ', 'กรณีที่ 1 ไม่เป็น (ได้รับการสนับสนุนเต็มจำนวน)', 'กรณีที่ 1 Corresponding Author', 'เว็บไซต์,', '2,000', 'สองพันบาทถ้วน', 'อ.ดร.รัชดาพร  คณาวงษ์', 'อาจารย์ ดร.ณัฐโชติ พรหมฤทธิ์', 'คอมพิวเตอร์', 25, 'scholarship_proceeding', '', 'false'),
('อ.ดร.รัชดาพร  คณาวงษ์', 'ภาควิชาคอมพิวเตอร์', 'การตรวจนับยานพาหนะบนถนนด้วยกล้องโทรทัศน์วงจรปิด', 'Vehicle Counting on the Road by Using CCTV', 'The 8th Asia Undergraduate Conference on Computing (AUC2) 2020', 'มหาวิทยาลัยสวนดุสิต  กรุงเทพมหานคร, วันที่ 14-16 กุมภาพันธ์ พ.ศ. 2563', '', 'research_article', 'Proceedings ตีพิมพ์ในเอกสารสืบเนื่องจาการประชุมวิชาการระดับชาติ', 'กรณีที่ 1 ไม่เป็น (ได้รับการสนับสนุนเต็มจำนวน)', 'กรณีที่ 1 Corresponding Author', 'เว็บไซต์,', '2,000', 'สองพันบาทถ้วน', 'อ.ดร.รัชดาพร  คณาวงษ์', 'อาจารย์ ดร.ณัฐโชติ  พรหมฤทธิ์', 'คอมพิวเตอร์', 26, 'scholarship_proceeding', '', 'false'),
('อ.ดร.รัชดาพร  คณาวงษ์', 'ภาควิชาคอมพิวเตอร์', 'เว็บแอพพลิเคชันรองรับทุกอุปกรณ์สำหรับตรวจอาการตาบอดสีเบื้องต้น พร้อมวิเคราะห์พฤติกรรมการมองระหว่างทำการทดสอบ', 'Responsive Web Application for Primary Color Blindness Test and the Eye Gaze Behavior Analysis', 'The 8th Asia Undergraduate Conference on Computing (AUC2) 2020', 'มหาวิทยาลัยสวนดุสิต กรุงเทพมหานคร, วันที่ 14-16 กุมภาพันธ์ พ.ศ. 2563', '', 'research_article', 'Proceedings ตีพิมพ์ในเอกสารสืบเนื่องจาการประชุมวิชาการระดับชาติ', 'กรณีที่ 1 ไม่เป็น (ได้รับการสนับสนุนเต็มจำนวน)', 'กรณีที่ 1 Corresponding Author', 'เว็บไซต์,', '2,000', 'สองพันบาทถ้วน', 'อ.ดร.รัชดาพร  คณาวงษ์', 'อาจารย์ ดร.ณัฐโชติ  พรหมฤทธิ์', 'คอมพิวเตอร์', 27, 'scholarship_proceeding', '', 'false'),
('อ.ดร.สิรักข์  แก้วจำนงค์', 'ภาควิชาคอมพิวเตอร์', 'การพัฒนาต้นแบบระบบติดตามตำแหน่ง โดยใช้เครือข่าย NB-IoT', '-', 'The 7th ASEAN Undergraduate Conference in Computing (AUC2) 2019', '', '', 'research_article', 'Proceedings ตีพิมพ์ในเอกสารสืบเนื่องจาการประชุมวิชาการระดับชาติ', 'กรณีที่ 1 ไม่เป็น (ได้รับการสนับสนุนเต็มจำนวน)', 'กรณีที่ 1 Corresponding Author', 'เว็บไซต์,', '2,000', 'สองพันบาทถ้วน', 'อ.ดร.สิรักข์ แก้วจำนงค์', 'อาจารย์ ดร.ณัฐโชติ พรหมฤทธิ์', 'คอมพิวเตอร์', 29, 'scholarship_proceeding', '', 'false'),
('อ.ดร.สิรักข์  แก้วจำนงค์', 'ภาควิชาคอมพิวเตอร์', 'แอปพลิเคชันขอความช่วยเหลือบนระบบปฏิบัติการแอนดรอยด์', 'SOS Application', 'The 7th ASEAN Undergraduate Conference in Computing (AUC2) 2019', 'มหาวิทยาลัยราชภัฏเชียงราย เชียงราย, วันที่ 22-24 มีนาคม พ.ศ. 2562', '', 'research_article', 'Proceedings ตีพิมพ์ในเอกสารสืบเนื่องจาการประชุมวิชาการระดับนานาชาติ', 'กรณีที่ 1 ไม่เป็น (ได้รับการสนับสนุนเต็มจำนวน)', 'กรณีที่ 1 First Author', 'ซีดี,เว็บไซต์,', '2,000', 'สองพันบาทถ้วน', 'อ.ดร.สิรักข์ แก้วจำนงค์', 'อาจารย์ ดร.ณัฐโชติ พรหมฤทธิ์', 'คอมพิวเตอร์', 30, 'scholarship_proceeding', '', 'false'),
('อ.ดร.กฤษณะ สีพนมวัน', 'ภาควิชาคอมพิวเตอร์', 'แอปพลิเคชันขอความช่วยเหลือบนระบบปฏิบัติการแอนดรอยด์', 'Image Analysis of Mushroom Types Classification by Convolution Neural Networks', '2019 2nd Artificial Intelligence and Cloud Computing Conference', 'มหาวิทยาลัยสวนดุสิต กรุงเทพมหานคร, วันที่ 14-16 กุมภาพันธ์ พ.ศ. 2563', '', 'research_article', 'Proceedings ตีพิมพ์ในเอกสารสืบเนื่องจาการประชุมวิชาการระดับนานาชาติ', 'กรณีที่ 1 ไม่เป็น (ได้รับการสนับสนุนเต็มจำนวน)', 'กรณีที่ 1 First Author', 'ซีดี,เว็บไซต์,', '2,000', 'สองพันบาทถ้วน', 'อ.ดร.สิรักข์ แก้วจำนงค์', 'อ.ดร.ณัฐโชติ พรมฤทธิ์', 'คอมพิวเตอร์', 31, 'scholarship_proceeding', '', 'true'),
('อ.จิตดำรง ปรีชาสุข', 'ภาควิชาคอมพิวเตอร์', ' การวิเคราะห์ภาพของการจำแนกประเภทเห็ดโดย Convolution Neural Networks', 'Image Analysis of Mushroom Types Classification by Convolution Neural Networks', 'The 8th Asia Undergraduate Conference on Computing (AUC2) 2020', 'Online Presentation, 24-26 เม.ย. 2563', '', 'research_article', 'Proceedings ตีพิมพ์ในเอกสารสืบเนื่องจาการประชุมวิชาการระดับนานาชาติ', 'กรณีที่ 1 ไม่เป็น (ได้รับการสนับสนุนเต็มจำนวน)', 'กรณีที่ 1 First Author', 'ซีดี,เว็บไซต์,', '3,000', 'สามพันบาทถ้วน', 'อ.จิตดำรง ปรีชาสุข', 'อ.ดร.ณัฐโชติ พรมฤทธิ์', 'คอมพิวเตอร์', 32, 'scholarship_proceeding', '', 'true');

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE `teacher` (
  `teacher_code` varchar(255) CHARACTER SET utf8 NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `status` varchar(255) CHARACTER SET utf8 NOT NULL,
  `position` varchar(255) CHARACTER SET utf8 NOT NULL,
  `id` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`teacher_code`, `title`, `name`, `status`, `position`, `id`) VALUES
('1', 'อ.ดร.', 'ณัฐโชติ พรหมฤทธิ์', 'Active', 'หัวหน้าภาควิชา', 5),
('2', 'ผศ.ดร.', 'รัชดาพร คณาวงษ์', 'Active', 'อาจารย์', 6),
('3', 'ผศ.ดร.', 'อรวรรณ เชาวลิต', 'Active', 'อาจารย์', 7),
('4', 'รศ.ดร.', 'ปานใจ ธารทัศนวงศ์', 'Active', 'อาจารย์', 8),
('5', 'ผศ.ดร.', 'กรัญญา สิทธิสงวน', 'Active', 'อาจารย์', 9),
('6', 'ผศ.ดร.', 'คทา ประดิษฐวงศ์', 'Active', 'อาจารย์', 10),
('7', 'ผศ.ดร.', 'ทัศนวรรณ ศูนย์กลาง', 'Active', 'อาจารย์', 11),
('8', 'ผศ.ดร.', 'ภิญโญ แท้ประสาทสิทธิ์', 'Active', 'อาจารย์', 12),
('9', 'ผศ.ดร.', 'วีณาวดี ม่วงอ้น', 'Active', 'อาจารย์', 13),
('10', 'ผศ.ดร.', 'สุนีย์ พงษ์พินิจภิญโญ', 'Active', 'อาจารย์', 14),
('11', 'ผศ.', 'บัณฑิต ภูริชิติพร', 'Active', 'อาจารย์', 15),
('12', 'ผศ.', 'โอภาส วงษ์ทวีทรัพย์', 'Active', 'อาจารย์', 16),
('13', 'อ.ดร.', 'กฤษณะ สีพนมวัน', 'Active', 'อาจารย์', 17),
('14', 'อ.ดร.', 'วัสรา รอดเหตุภัย', 'Active', 'อาจารย์', 18),
('15', 'อ.ดร.', 'สัจจาภรณ์ ไวจรรยา', 'Active', 'อาจารย์', 19),
('16', 'อ.ดร.', 'สิรักข์ แก้วจำนงค์', 'Active', 'อาจารย์', 20),
('17', 'อ.ดร.', 'เสาวลักษณ์ อร่ามพงศานุวัต', 'Active', 'อาจารย์', 21),
('18', 'อ.', 'จิตดำรง ปรีชาสุข', 'Active', 'อาจารย์', 22),
('19', 'อ.', 'อภิเษก หงษ์วิทยากร', 'Active', 'อาจารย์', 23),
('20', 'อ.', 'เสฐลัทธ์ รอดเหตุภัย', 'Active', 'อาจารย์', 24);

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
('admin', '1234', 1);

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
-- Indexes for table `scholarship_book`
--
ALTER TABLE `scholarship_book`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `scholarship_journal`
--
ALTER TABLE `scholarship_journal`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `scholarship_proceeding`
--
ALTER TABLE `scholarship_proceeding`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `journals`
--
ALTER TABLE `journals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `proceedings`
--
ALTER TABLE `proceedings`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `scholarship_book`
--
ALTER TABLE `scholarship_book`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `scholarship_journal`
--
ALTER TABLE `scholarship_journal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `scholarship_proceeding`
--
ALTER TABLE `scholarship_proceeding`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `teacher`
--
ALTER TABLE `teacher`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
