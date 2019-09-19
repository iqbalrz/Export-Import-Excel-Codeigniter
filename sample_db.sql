-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 19, 2019 at 12:08 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `coba01db`
--

-- --------------------------------------------------------

--
-- Table structure for table `applicant`
--

CREATE TABLE `applicant` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `gender` varchar(50) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `skill` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `applicant`
--

INSERT INTO `applicant` (`id`, `first_name`, `last_name`, `gender`, `phone`, `email`, `skill`) VALUES
(1, 'Giustina', 'Shacklady', 'Female', '+86-193-474-9545', 'gshacklady0@tuttocitta.it', 'Talent Management'),
(2, 'Ewart', 'Chambers', 'Male', '+86-155-904-9342', 'echambers1@icq.com', 'GDAL'),
(3, 'Tricia', 'Badam', 'Female', '+63-686-671-2745', 'tbadam2@miitbeian.gov.cn', 'Nursing Process'),
(4, 'Rudolf', 'Stockin', 'Male', '+52-817-901-6896', 'rstockin3@youku.com', 'AP Style'),
(5, 'Berty', 'Haythorn', 'Female', '+1-719-284-4325', 'bhaythorn4@pbs.org', 'Chamber Music'),
(6, 'Doria', 'Bloan', 'Female', '+62-945-377-4761', 'dbloan5@elpais.com', 'Voice Acting'),
(7, 'Davy', 'Burkert', 'Male', '+7-451-928-3918', 'dburkert6@yellowpages.com', 'MCS'),
(8, 'Jemmy', 'Giovanitti', 'Female', '+62-844-678-5813', 'jgiovanitti7@narod.ru', 'Dell KACE'),
(9, 'Tirrell', 'Handrock', 'Male', '+48-799-889-5758', 'thandrock8@instagram.com', 'Focus Groups'),
(10, 'Nikolas', 'Leddie', 'Male', '+351-242-453-1898', 'nleddie9@businessinsider.com', 'OLED'),
(11, 'Josie', 'Clemensen', 'Female', '+62-486-896-3621', 'jclemensena@goo.ne.jp', 'SAP EBP'),
(12, 'Aveline', 'Kliement', 'Female', '+33-941-817-1345', 'akliementb@utexas.edu', 'Credit Unions'),
(13, 'Querida', 'Dunbobin', 'Female', '+86-218-379-5573', 'qdunbobinc@acquirethisname.com', 'PC building'),
(14, 'Jamill', 'Innott', 'Male', '+994-926-271-3675', 'jinnottd@huffingtonpost.com', 'RNC'),
(15, 'Benjie', 'Hritzko', 'Male', '+7-248-309-7293', 'bhritzkoe@rakuten.co.jp', 'MRIS'),
(16, 'Margret', 'Shearston', 'Female', '+54-144-382-3026', 'mshearstonf@blogs.com', 'XPages'),
(17, 'Sibel', 'McClifferty', 'Female', '+53-445-986-4359', 'smccliffertyg@state.gov', 'RTI'),
(18, 'Cherye', 'Pagan', 'Female', '+84-623-278-2212', 'cpaganh@ca.gov', 'Warehouse Management'),
(19, 'Chick', 'Keeves', 'Male', '+967-228-893-5879', 'ckeevesi@netlog.com', 'Luxury Travel'),
(20, 'Claudius', 'Lippi', 'Male', '+7-685-170-7677', 'clippij@tripod.com', 'EEO Investigations'),
(21, 'Clayborn', 'Clayworth', 'Male', '+420-700-348-9761', 'cclayworthk@mozilla.org', 'MFC'),
(22, 'Andre', 'Gunning', 'Male', '+970-678-889-0853', 'agunningl@a8.net', 'EBMS'),
(23, 'Edlin', 'Gobourn', 'Male', '+86-308-987-6370', 'egobournm@bbb.org', 'Classical Guitar'),
(24, 'Charla', 'O\'Kynsillaghe', 'Female', '+55-777-803-3699', 'cokynsillaghen@sphinn.com', 'Kickboxing'),
(25, 'Judd', 'Brachell', 'Male', '+63-717-187-2672', 'jbrachello@spiegel.de', 'HDI'),
(26, 'Tedman', 'Carpe', 'Male', '+62-232-437-5967', 'tcarpep@eventbrite.com', 'PJM'),
(27, 'Valentia', 'Jansens', 'Female', '+966-935-129-5718', 'vjansensq@jalbum.net', 'OB/GYN'),
(28, 'Happy', 'Hanks', 'Female', '+62-359-413-5531', 'hhanksr@deviantart.com', 'NFPA 101'),
(29, 'Carmel', 'Giovannini', 'Female', '+62-140-658-6803', 'cgiovanninis@nbcnews.com', 'Human Capital'),
(30, 'Hermine', 'Butterwick', 'Female', '+84-230-237-4199', 'hbutterwickt@webmd.com', 'Environmental Issues'),
(31, 'Jonathan', 'Scouse', 'Male', '+27-137-914-8694', 'jscouseu@simplemachines.org', 'RTC'),
(32, 'Hoyt', 'Soars', 'Male', '+375-212-595-8311', 'hsoarsv@123-reg.co.uk', 'Entity Framework'),
(33, 'Dermot', 'Tremayne', 'Male', '+81-137-502-1141', 'dtremaynew@sina.com.cn', 'ZFS'),
(34, 'Veriee', 'Decreuze', 'Female', '+62-671-963-8311', 'vdecreuzex@addtoany.com', 'Classroom Management'),
(35, 'Alma', 'Heaford', 'Female', '+1-392-181-3042', 'aheafordy@ted.com', 'IAR Embedded Workbench'),
(36, 'Alene', 'Tibalt', 'Female', '+92-463-486-0558', 'atibaltz@yale.edu', 'MRP'),
(37, 'Martguerita', 'Slayford', 'Female', '+55-846-945-9995', 'mslayford10@ibm.com', 'Two-way Radio'),
(38, 'Gibby', 'Alliot', 'Male', '+33-158-221-3782', 'galliot11@wsj.com', 'TDM'),
(39, 'Ellen', 'Sayward', 'Female', '+84-913-511-5413', 'esayward12@ow.ly', 'CFIA'),
(40, 'Dulcea', 'Burfield', 'Female', '+46-648-234-0065', 'dburfield13@webs.com', 'BMR'),
(41, 'Eward', 'Muldowney', 'Male', '+387-605-998-5089', 'emuldowney14@cnbc.com', 'SAP BPM'),
(42, 'Brett', 'Vannini', 'Male', '+30-108-134-7476', 'bvannini15@youtu.be', 'Middle Eastern Studies'),
(43, 'Boot', 'Carah', 'Male', '+63-208-186-3326', 'bcarah16@go.com', 'Oil &amp; Gas Exploration'),
(44, 'Ulick', 'Coopland', 'Male', '+46-678-592-2920', 'ucoopland17@technorati.com', 'Foreign Affairs'),
(45, 'Briggs', 'Conry', 'Male', '+46-971-220-4586', 'bconry18@blog.com', 'Geometric Dimensioning &amp; Tolerancing'),
(46, 'Murvyn', 'Manuele', 'Male', '+55-852-171-8638', 'mmanuele19@360.cn', 'Zero Waste'),
(47, 'Harper', 'Kemery', 'Male', '+970-464-147-7538', 'hkemery1a@shop-pro.jp', 'CQ'),
(48, 'Sean', 'Aronoff', 'Male', '+86-662-266-6965', 'saronoff1b@skype.com', 'ICP-OES'),
(49, 'Cliff', 'Hentzeler', 'Male', '+57-340-727-1600', 'chentzeler1c@sina.com.cn', 'Job Scheduling'),
(50, 'Lanie', 'Bryett', 'Male', '+374-267-618-1403', 'lbryett1d@msu.edu', 'RFP Design');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `applicant`
--
ALTER TABLE `applicant`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `applicant`
--
ALTER TABLE `applicant`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
