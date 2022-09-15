-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 15, 2022 at 10:58 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sges`
--

-- --------------------------------------------------------

--
-- Table structure for table `ref_access_level`
--

CREATE TABLE `ref_access_level` (
  `id` int(11) NOT NULL,
  `access_level` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ref_access_level`
--

INSERT INTO `ref_access_level` (`id`, `access_level`) VALUES
(1, 'admin'),
(2, 'comelec'),
(3, 'voter');

-- --------------------------------------------------------

--
-- Table structure for table `ref_division`
--

CREATE TABLE `ref_division` (
  `id` int(11) NOT NULL,
  `ref_region_id` int(11) DEFAULT NULL,
  `division_name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ref_division`
--

INSERT INTO `ref_division` (`id`, `ref_region_id`, `division_name`) VALUES
(1, 14, 'Abra'),
(2, 14, 'Apayao'),
(3, 14, 'Baguio City'),
(4, 14, 'Benguet'),
(5, 14, 'Ifugao'),
(6, 14, 'Kalinga'),
(7, 14, 'Mt. Province'),
(8, 14, 'Tabuk City'),
(9, 13, 'Caloocan City'),
(10, 13, 'City of San Juan'),
(11, 13, 'Las Piñas City'),
(12, 13, 'Makati City'),
(13, 13, 'Malabon City'),
(14, 13, 'Mandaluyong City'),
(15, 13, 'Manila'),
(16, 13, 'Marikina City'),
(17, 13, 'Muntinlupa City'),
(18, 13, 'Navotas'),
(19, 13, 'Paranaque City'),
(20, 13, 'Pasay City'),
(21, 13, 'Pasig City'),
(22, 13, 'Quezon City'),
(23, 13, 'Taguig'),
(24, 13, 'Valenzuela City'),
(25, 1, 'Alaminos City'),
(26, 1, 'Batac City'),
(27, 1, 'Candon City'),
(28, 1, 'Dagupan City'),
(29, 1, 'Ilocos Norte'),
(30, 1, 'Ilocos Sur'),
(31, 1, 'La Union'),
(32, 1, 'Laoag City'),
(33, 1, 'Pangasinan I, Lingayen'),
(34, 1, 'Pangasinan II, Binalonan'),
(35, 1, 'San Carlos City, Pangasinan'),
(36, 1, 'San Fernando City, La Union'),
(37, 1, 'Urdaneta City'),
(38, 1, 'Vigan City'),
(39, 2, 'Batanes'),
(40, 2, 'Cagayan'),
(41, 2, 'Cauayan City'),
(42, 2, 'City of Ilagan'),
(43, 2, 'Isabela'),
(44, 2, 'Nueva Vizcaya'),
(45, 2, 'Quirino'),
(46, 2, 'Santiago City'),
(47, 2, 'Tuguegarao City'),
(48, 3, 'Angeles City'),
(49, 3, 'Aurora'),
(50, 3, 'Balanga City'),
(51, 3, 'Bataan'),
(52, 3, 'Bulacan'),
(53, 3, 'Cabanatuan City'),
(54, 3, 'City of San Fernando'),
(55, 3, 'City of San Jose Del Monte'),
(56, 3, 'Gapan City'),
(57, 3, 'Mabalacat City'),
(58, 3, 'Malolos'),
(59, 3, 'Meycauayan City'),
(60, 3, 'Nueva Ecija'),
(61, 3, 'Olongapo City'),
(62, 3, 'Pampanga'),
(63, 3, 'San Jose City'),
(64, 3, 'Science City of Muñoz'),
(65, 3, 'Tarlac City'),
(66, 3, 'Tarlac Province'),
(67, 3, 'Zambales'),
(68, 4, 'Antipolo City'),
(69, 4, 'Bacoor City'),
(70, 4, 'Batangas Province'),
(71, 4, 'Batangas City'),
(72, 4, 'Binan City'),
(73, 4, 'Calamba City'),
(74, 4, 'Cabuyao City'),
(75, 4, 'Cavite Province'),
(76, 4, 'Cavite City'),
(77, 4, 'Dasmarinas City'),
(78, 4, 'General Trias City'),
(79, 4, 'Imus City'),
(80, 4, 'Laguna'),
(81, 4, 'Lipa City'),
(82, 4, 'Lucena City'),
(83, 4, 'Quezon Province'),
(84, 4, 'Rizal'),
(85, 4, 'San Pablo City'),
(86, 4, 'Sta. Rosa City'),
(87, 4, 'Tanauan City'),
(88, 4, 'Tayabas City'),
(89, 17, 'Calapan City'),
(90, 17, 'Marinduque'),
(91, 17, 'Occidental Mindoro'),
(92, 17, 'Oriental Mindoro'),
(93, 17, 'Palawan'),
(94, 17, 'Puerto Princesa City'),
(95, 17, 'Romblon'),
(96, 5, 'Albay'),
(97, 5, 'Camarines Norte'),
(98, 5, 'Camarines Sur'),
(99, 5, 'Catanduanes'),
(100, 5, 'Iriga City'),
(101, 5, 'Legaspi City'),
(102, 5, 'Ligao City'),
(103, 5, 'Masbate'),
(104, 5, 'Masbate City'),
(105, 5, 'Naga City'),
(106, 5, 'Sorsogon'),
(107, 5, 'Sorsogon City'),
(108, 5, 'Tabaco City'),
(109, 6, 'Aklan'),
(110, 6, 'Antique'),
(111, 6, 'Bacolod City'),
(112, 6, 'Bago City'),
(113, 6, 'Cadiz City'),
(114, 6, 'Capiz'),
(115, 6, 'Escalante City'),
(116, 6, 'Guimaras'),
(117, 6, 'Iloilo'),
(118, 6, 'Iloilo City'),
(119, 6, 'Kabankalan City'),
(120, 6, 'La Carlota City'),
(121, 6, 'Negros Occidental'),
(122, 6, 'Passi City'),
(123, 6, 'Roxas City'),
(124, 6, 'Sagay City'),
(125, 6, 'San Carlos City, Negros Occidental'),
(126, 6, 'Silay City'),
(127, 7, 'Bais City'),
(128, 7, 'Bayawan City'),
(129, 7, 'Bogo City'),
(130, 7, 'Bohol'),
(131, 7, 'Carcar City'),
(132, 7, 'Cebu City'),
(133, 7, 'Cebu'),
(134, 7, 'City of Naga, Cebu'),
(135, 7, 'Danao City'),
(136, 7, 'Dumaguete City'),
(137, 7, 'Guihulngan City'),
(138, 7, 'Lapu-Lapu City'),
(139, 7, 'Mandaue City'),
(140, 7, 'Negros Oriental'),
(141, 7, 'Siquijor'),
(142, 7, 'Tagbilaran City'),
(143, 7, 'Talisay City'),
(144, 7, 'Tanjay City'),
(145, 7, 'Toledo City'),
(146, 8, 'Baybay City'),
(147, 8, 'Biliran'),
(148, 8, 'Borongan City'),
(149, 8, 'Calbayog City'),
(150, 8, 'Catbalogan City'),
(151, 8, 'Eastern Samar'),
(152, 8, 'Leyte'),
(153, 8, 'Maasin City'),
(154, 8, 'Northern Samar'),
(155, 8, 'Ormoc City'),
(156, 8, 'Samar (Western Samar)'),
(157, 8, 'Southern Leyte'),
(158, 8, 'Tacloban City'),
(159, 9, 'Dapitan City'),
(160, 9, 'Dipolog City'),
(161, 9, 'Isabela City'),
(162, 9, 'Pagadian City'),
(163, 9, 'Zamboanga City'),
(164, 9, 'Zamboanga del Norte'),
(165, 9, 'Zamboanga del Sur'),
(166, 9, 'Zamboanga Sibugay'),
(167, 15, 'BASILAN'),
(168, 15, 'LANAO SUR II'),
(169, 15, 'TAWI-TAWI'),
(170, 15, 'Lanao del Sur I'),
(171, 15, 'MARAWI CITY'),
(172, 15, 'LAMITAN CITY'),
(173, 15, 'MAGUINDANAO II'),
(174, 15, 'MAGUINDANAO I'),
(175, 15, 'SULU'),
(176, 16, 'Agusan del Norte'),
(177, 16, 'Agusan del Sur'),
(178, 16, 'Bayugan City'),
(179, 16, 'Bislig City'),
(180, 16, 'Butuan City'),
(181, 16, 'Cabadbaran City'),
(182, 16, 'Dinagat Island'),
(183, 16, 'Siargao'),
(184, 16, 'Surigao City'),
(185, 16, 'Surigao del Norte'),
(186, 16, 'Surigao del Sur'),
(187, 16, 'Tandag City'),
(188, 10, 'Bukidnon'),
(189, 10, 'Cagayan de Oro City'),
(190, 10, 'Camiguin'),
(191, 10, 'El Salvador'),
(192, 10, 'Gingoog City'),
(193, 10, 'Iligan City'),
(194, 10, 'Lanao del Norte'),
(195, 10, 'Malaybalay City'),
(196, 10, 'Misamis Occidental'),
(197, 10, 'Misamis Oriental'),
(198, 10, 'Oroquieta City'),
(199, 10, 'Ozamis City'),
(200, 10, 'Tangub City'),
(201, 10, 'Valencia City'),
(202, 11, 'Compostela Valley'),
(203, 11, 'Davao City'),
(204, 11, 'Davao del Norte'),
(205, 11, 'Davao del Sur'),
(206, 11, 'Davao Oriental'),
(207, 11, 'Davao Occidental'),
(208, 11, 'Digos City'),
(209, 11, 'Island Garden City of Samal'),
(210, 11, 'Mati City'),
(211, 11, 'Panabo City'),
(212, 11, 'Tagum City'),
(213, 12, 'Cotabato City'),
(214, 12, 'General Santos City'),
(215, 12, 'Kidapawan City'),
(216, 12, 'Koronadal City'),
(217, 12, 'North Cotabato'),
(218, 12, 'Sarangani'),
(219, 12, 'South Cotabato'),
(220, 12, 'Sultan Kudarat'),
(221, 12, 'Tacurong City');

-- --------------------------------------------------------

--
-- Table structure for table `ref_grade_level`
--

CREATE TABLE `ref_grade_level` (
  `id` int(11) NOT NULL,
  `grade` varchar(50) DEFAULT NULL,
  `for_candidate` int(10) DEFAULT NULL,
  `for_elem` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ref_grade_level`
--

INSERT INTO `ref_grade_level` (`id`, `grade`, `for_candidate`, `for_elem`) VALUES
(1, 'Grade 4', NULL, 1),
(2, 'Grade 5', 1, 1),
(3, 'Grade 6', 1, 1),
(4, 'Grade 7', 1, NULL),
(5, 'Grade 8', 1, NULL),
(6, 'Grade 9', 1, NULL),
(7, 'Grade 10', 1, NULL),
(8, 'Grade 11', 1, NULL),
(9, 'Grade 12', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ref_position`
--

CREATE TABLE `ref_position` (
  `id` int(11) NOT NULL,
  `position_name` varchar(50) DEFAULT NULL,
  `position_description` varchar(50) DEFAULT NULL,
  `position_select_limit` int(5) DEFAULT NULL,
  `position_selected_grade` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ref_position`
--

INSERT INTO `ref_position` (`id`, `position_name`, `position_description`, `position_select_limit`, `position_selected_grade`) VALUES
(1, 'President', NULL, NULL, NULL),
(2, 'Vice-President', NULL, NULL, NULL),
(3, 'Secretary', NULL, NULL, NULL),
(4, 'Treasurer', NULL, NULL, NULL),
(5, 'Auditor', NULL, NULL, NULL),
(6, 'Public Information Officer', NULL, NULL, NULL),
(7, 'Peace Officer', NULL, NULL, NULL),
(8, 'Representative', NULL, NULL, 1),
(9, 'Chairman', NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `ref_region`
--

CREATE TABLE `ref_region` (
  `id` int(11) NOT NULL,
  `rank` int(10) DEFAULT NULL,
  `region_short_name` varchar(50) DEFAULT NULL,
  `region_name` varchar(50) DEFAULT NULL,
  `nscb_code` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ref_region`
--

INSERT INTO `ref_region` (`id`, `rank`, `region_short_name`, `region_name`, `nscb_code`) VALUES
(1, 1, 'Region I', 'Ilocos Region', '1'),
(2, 2, 'Region II', 'Cagayan Valley', '2'),
(3, 3, 'Region III', 'Central Luzon', '3'),
(4, 4, 'Region IV-A', 'CALABARZON', '4'),
(5, 6, 'Region V', 'Bicol Region', '5'),
(6, 7, 'Region VI', 'Western Visayas', '6'),
(7, 8, 'Region VII', 'Central Visayas', '7'),
(8, 9, 'Region VIII', 'Eastern Visayas', '8'),
(9, 10, 'Region IX', 'Zamboanga Peninsula', '9'),
(10, 11, 'Region X', 'Northern Mindanao', '10'),
(11, 12, 'Region XI', 'Davao Region', '11'),
(12, 13, 'Region XII', 'Soccsksargen', '12'),
(13, 17, 'NCR', 'National Capital Region', '13'),
(14, 16, 'CAR', 'Cordillera Administrative Region', '14'),
(15, 15, 'BARMM', 'Bangsamoro Autonomous Region in Muslin Mindanao', '15'),
(16, 14, 'CARAGA', 'CARAGA', '16'),
(17, 5, 'Region IV-B', 'MIMAROPA', '17');

-- --------------------------------------------------------

--
-- Table structure for table `ref_school`
--

CREATE TABLE `ref_school` (
  `id` int(11) NOT NULL,
  `school_id` varchar(50) DEFAULT NULL,
  `school_name` varchar(50) DEFAULT NULL,
  `school_logo` varchar(50) DEFAULT NULL,
  `ref_classification_id` int(10) DEFAULT NULL,
  `school_year` varchar(50) DEFAULT NULL,
  `ref_region_id` int(10) DEFAULT NULL,
  `ref_division_id` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ref_school`
--

INSERT INTO `ref_school` (`id`, `school_id`, `school_name`, `school_logo`, `ref_classification_id`, `school_year`, `ref_region_id`, `ref_division_id`) VALUES
(4, '123456', 'San Rafael Elementary School', '/school/4.jpg', 2, NULL, 13, 21);

-- --------------------------------------------------------

--
-- Table structure for table `ref_school_classification`
--

CREATE TABLE `ref_school_classification` (
  `id` int(11) NOT NULL,
  `classification_name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ref_school_classification`
--

INSERT INTO `ref_school_classification` (`id`, `classification_name`) VALUES
(1, 'Elementary'),
(2, 'Secondary');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_ballot`
--

CREATE TABLE `tbl_ballot` (
  `id` int(5) NOT NULL,
  `tbl_user_id` int(5) DEFAULT NULL,
  `ref_position_id` int(5) DEFAULT NULL,
  `tbl_candidate_id` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_ballot`
--

INSERT INTO `tbl_ballot` (`id`, `tbl_user_id`, `ref_position_id`, `tbl_candidate_id`) VALUES
(1, 4, 1, 2),
(2, 4, 2, 5),
(3, 4, 3, NULL),
(4, 4, 4, NULL),
(5, 4, 5, NULL),
(6, 4, 6, NULL),
(7, 4, 7, NULL),
(8, 4, 8, 8),
(9, 4, 9, 11);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_candidate`
--

CREATE TABLE `tbl_candidate` (
  `id` int(11) NOT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `middle_name` varchar(50) DEFAULT NULL,
  `ref_position_id` int(5) DEFAULT NULL,
  `tbl_party_id` int(5) DEFAULT NULL,
  `ref_grade_level_id` int(5) DEFAULT NULL,
  `photo` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_candidate`
--

INSERT INTO `tbl_candidate` (`id`, `last_name`, `first_name`, `middle_name`, `ref_position_id`, `tbl_party_id`, `ref_grade_level_id`, `photo`) VALUES
(1, '1', 'President', '', 1, 1, NULL, NULL),
(2, '2', 'President', '', 1, 2, NULL, NULL),
(3, '3', 'President', '', 1, 3, NULL, NULL),
(4, '1', 'Vice-President', '', 2, 1, NULL, NULL),
(5, '2', 'Vice-President', '', 2, 2, NULL, NULL),
(6, '3', 'Vice-President', '', 2, 3, NULL, NULL),
(7, '1', 'Representative', '', 8, 1, 4, NULL),
(8, '2', 'Representative', '', 8, 2, 4, NULL),
(10, '1', 'Chairman', '', 9, 1, 4, NULL),
(11, '2', 'Chairman', '', 9, 3, 4, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_party`
--

CREATE TABLE `tbl_party` (
  `id` int(11) NOT NULL,
  `party_name` varchar(50) NOT NULL,
  `description` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_party`
--

INSERT INTO `tbl_party` (`id`, `party_name`, `description`) VALUES
(1, 'Independent', NULL),
(2, 'Party 1', 'Part 1 Description'),
(3, 'Party 2', 'Party 2 Description');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_profile`
--

CREATE TABLE `tbl_profile` (
  `id` int(11) NOT NULL,
  `tbl_user_id` int(11) NOT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `middle_name` varchar(50) DEFAULT NULL,
  `lrn` varchar(50) DEFAULT NULL,
  `ref_grade_level_id` varchar(50) DEFAULT NULL,
  `section` varchar(50) DEFAULT NULL,
  `nickname` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_profile`
--

INSERT INTO `tbl_profile` (`id`, `tbl_user_id`, `last_name`, `first_name`, `middle_name`, `lrn`, `ref_grade_level_id`, `section`, `nickname`) VALUES
(1, 1, 'user', 'super', '', NULL, NULL, NULL, 'oppabee'),
(2, 2, 'Doe', 'John', '', NULL, NULL, NULL, NULL),
(4, 4, '1', 'Student', '', '123456789123', '4', 'Section 1', NULL);

-- --------------------------------------------------------

--
-- Stand-in structure for view `tbl_report_view`
-- (See below for the actual view)
--
CREATE TABLE `tbl_report_view` (
`tbl_candidate_id` int(5)
,`MAX(bilang)` bigint(21)
,`ref_position_id` int(5)
,`first_name` varchar(50)
,`last_name` varchar(50)
,`middle_name` varchar(50)
,`photo` varchar(50)
,`party_name` varchar(50)
,`position_name` varchar(50)
,`posid` int(5)
);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `ref_access_level_id` int(5) NOT NULL,
  `password_salt` varchar(50) DEFAULT NULL,
  `created_by` varchar(50) DEFAULT NULL,
  `is_voted` varchar(255) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `username`, `password`, `ref_access_level_id`, `password_salt`, `created_by`, `is_voted`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 1, NULL, NULL, '0'),
(2, 'comelec', '5f4dcc3b5aa765d61d8327deb882cf99', 2, NULL, '1', '0'),
(4, '123456789123', 'df96220fa161767c5cbb95567855c86b', 3, '573b792e', '2', 'voted');

-- --------------------------------------------------------

--
-- Structure for view `tbl_report_view`
--
DROP TABLE IF EXISTS `tbl_report_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `tbl_report_view`  AS SELECT `result`.`tbl_candidate_id` AS `tbl_candidate_id`, max(`result`.`bilang`) AS `MAX(bilang)`, `result`.`ref_position_id` AS `ref_position_id`, `tbl_candidate`.`first_name` AS `first_name`, `tbl_candidate`.`last_name` AS `last_name`, `tbl_candidate`.`middle_name` AS `middle_name`, `tbl_candidate`.`photo` AS `photo`, `tbl_party`.`party_name` AS `party_name`, `ref_position`.`position_name` AS `position_name`, `tbl_candidate`.`ref_position_id` AS `posid` FROM ((((select count(0) AS `bilang`,`tbl_ballot`.`ref_position_id` AS `ref_position_id`,`tbl_ballot`.`tbl_candidate_id` AS `tbl_candidate_id` from `tbl_ballot` where `tbl_ballot`.`tbl_candidate_id` is not null group by `tbl_ballot`.`ref_position_id`,`tbl_ballot`.`tbl_candidate_id` order by count(0) desc) `result` left join `tbl_candidate` on(`tbl_candidate`.`id` = `result`.`tbl_candidate_id`)) left join `tbl_party` on(`tbl_candidate`.`tbl_party_id` = `tbl_candidate`.`tbl_party_id`)) left join `ref_position` on(`ref_position`.`id` = `tbl_candidate`.`ref_position_id`)) GROUP BY `result`.`ref_position_id``ref_position_id`  ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ref_access_level`
--
ALTER TABLE `ref_access_level`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ref_division`
--
ALTER TABLE `ref_division`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `ref_grade_level`
--
ALTER TABLE `ref_grade_level`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ref_position`
--
ALTER TABLE `ref_position`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ref_region`
--
ALTER TABLE `ref_region`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ref_school`
--
ALTER TABLE `ref_school`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ref_school_classification`
--
ALTER TABLE `ref_school_classification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_ballot`
--
ALTER TABLE `tbl_ballot`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_candidate`
--
ALTER TABLE `tbl_candidate`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_party`
--
ALTER TABLE `tbl_party`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_profile`
--
ALTER TABLE `tbl_profile`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ref_access_level`
--
ALTER TABLE `ref_access_level`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ref_division`
--
ALTER TABLE `ref_division`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=222;

--
-- AUTO_INCREMENT for table `ref_grade_level`
--
ALTER TABLE `ref_grade_level`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `ref_position`
--
ALTER TABLE `ref_position`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `ref_region`
--
ALTER TABLE `ref_region`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `ref_school`
--
ALTER TABLE `ref_school`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ref_school_classification`
--
ALTER TABLE `ref_school_classification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_ballot`
--
ALTER TABLE `tbl_ballot`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_candidate`
--
ALTER TABLE `tbl_candidate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tbl_party`
--
ALTER TABLE `tbl_party`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_profile`
--
ALTER TABLE `tbl_profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
