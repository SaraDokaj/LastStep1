-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 09, 2020 at 08:32 PM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laststep`
--

-- --------------------------------------------------------

--
-- Table structure for table `kerkesa`
--

CREATE TABLE `kerkesa` (
  `id_s` int(11) UNSIGNED NOT NULL,
  `id_p` int(11) UNSIGNED NOT NULL,
  `refuzuar` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kerkesa`
--

INSERT INTO `kerkesa` (`id_s`, `id_p`, `refuzuar`) VALUES
(1, 1, 0),
(2, 1, 1),
(2, 2, 1),
(3, 1, 0),
(3, 2, 0),
(4, 1, 0),
(4, 2, 0),
(5, 1, 1),
(5, 4, 0),
(7, 1, 0),
(7, 2, 0),
(8, 1, 0),
(9, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `njoftim`
--

CREATE TABLE `njoftim` (
  `id` int(11) UNSIGNED NOT NULL,
  `permbajtje` longtext NOT NULL,
  `autor` int(11) UNSIGNED NOT NULL,
  `datenjoftim` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `njoftim`
--

INSERT INTO `njoftim` (`id`, `permbajtje`, `autor`, `datenjoftim`) VALUES
(1, 'Diten e merkure ne oren 14:00 tek salla 214 do te kemi mundesi te takohemi per t\'ju pergjigjur te gjitha pyetjeve tuaja lidhurn me punen personale te zhvilluar deri tani.', 1, '2020-02-02 15:47');

-- --------------------------------------------------------

--
-- Table structure for table `pedagog`
--

CREATE TABLE `pedagog` (
  `id` int(11) UNSIGNED NOT NULL,
  `p_email` varchar(50) NOT NULL,
  `p_emri` varchar(50) NOT NULL,
  `password` varchar(300) NOT NULL,
  `fusha` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pedagog`
--

INSERT INTO `pedagog` (`id`, `p_email`, `p_emri`, `password`, `fusha`) VALUES
(1, 'b.muraku@fti.edu.al', 'Besiana Muraku', 'besiana123', 'Software Engineering'),
(2, 'i.papadhopulli@fti.edu.al', 'Ina Papadhopulli', 'inaina123', 'Arkitekture Kompjuteri'),
(4, 'n.kote@fti.edu.al', 'Nelda Kote ', '$2y$10$5B1J1.3YkaPdkffKzzKmTe63P6LSsjtjP0etQ4gNTsxVliUHZztkm', 'Web Development'),
(5, 'i.tafa@fti.edu.al', 'Igli Tafa', '$2y$10$9vuMtxRJdIz.Vbwh9Ftu3evAKNFCchYJP/2l/5CjG0eU0tzjl1dnS', 'Rrjetat Kompjuterike');

-- --------------------------------------------------------

--
-- Table structure for table `pranuar`
--

CREATE TABLE `pranuar` (
  `id_studentp` int(11) UNSIGNED NOT NULL,
  `id_pedagog` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pranuar`
--

INSERT INTO `pranuar` (`id_studentp`, `id_pedagog`) VALUES
(1, 1),
(4, 1),
(7, 1),
(8, 1),
(9, 1),
(3, 2),
(5, 4);

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `id` int(11) UNSIGNED NOT NULL,
  `email` varchar(50) NOT NULL,
  `emri` varchar(50) NOT NULL,
  `password` varchar(300) NOT NULL,
  `grupi` varchar(10) NOT NULL,
  `id_tema` int(11) UNSIGNED DEFAULT NULL,
  `dorezuar` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `email`, `emri`, `password`, `grupi`, `id_tema`, `dorezuar`) VALUES
(1, 'sara.dokaj@fti.edu.al', 'Sara Dokaj', 'sarita123', 'c', 1, 1),
(2, 'ingrid.duraku@fti.edu.al', 'Ingrid Duraku', 'ingrid123', 'c', NULL, 0),
(3, 'elidjana.isufaj@fti.edu.al', 'Elidjana Isufaj', 'elidjana123', 'b', 2, 1),
(4, 'enkela.bregu@fti.edu.al', 'Enkela Bregu', 'enkela123', 'c', NULL, 0),
(5, 'anisa.leti@fti.edu.al', 'anisa leti', 'anisa123', 'c', NULL, 0),
(7, 'besa.salimusaj@fti.edu.al', 'Besa Salimusaj', '$2y$10$.nis0ILS9Jv0bRMcK.3IMuPb6HpcjlWO/wR2m7S7PKzhHkvv1QOpG', 'c', NULL, 0),
(8, 'eranda.kurtulaj@fti.edu.al', 'Eranda Kurtulaj', '$2y$10$Az8R7AwyEP20CWaZmBxO/uymqwlppG2VuXRfsyovPREzlnO/iUYp.', 'c', NULL, 0),
(9, 'marsida.ballkoci@fti.edu.al', 'Marsida Ballkoci', '$2y$10$ock.UoSNYG6ThVDSHjIiHetpEG7O6KJHUnjpbfXM4ucT/QmhfLSWC', 'b', NULL, 0),
(10, 'deborah.jace@fti.edu.al', 'Deborah Jace', 'deborah123', 'c', NULL, 0),
(11, 'iris.kelmendi@fti.edu.al', 'iris kelmendi', '$2y$10$KcSwMbruGG.SjGKAhMtFwOChtJUK8og0rMpj.g1kbIF01WL9eGrOa', 'c', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tema`
--

CREATE TABLE `tema` (
  `id_t` int(11) UNSIGNED NOT NULL,
  `titulli` varchar(50) NOT NULL,
  `deadline` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tema`
--

INSERT INTO `tema` (`id_t`, `titulli`, `deadline`) VALUES
(1, 'Paradoksi i Braess ne rrjetat kompjuterike', '2020-06-20'),
(2, 'Nje aplikacion i krijuar per te menaxhuar shpernda', '2020-06-23'),
(3, 'I am the best', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kerkesa`
--
ALTER TABLE `kerkesa`
  ADD PRIMARY KEY (`id_s`,`id_p`,`refuzuar`) USING BTREE,
  ADD KEY `id_p` (`id_p`);

--
-- Indexes for table `njoftim`
--
ALTER TABLE `njoftim`
  ADD PRIMARY KEY (`id`),
  ADD KEY `autor` (`autor`);

--
-- Indexes for table `pedagog`
--
ALTER TABLE `pedagog`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pranuar`
--
ALTER TABLE `pranuar`
  ADD PRIMARY KEY (`id_studentp`),
  ADD KEY `id_pedagog` (`id_pedagog`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_tema` (`id_tema`);

--
-- Indexes for table `tema`
--
ALTER TABLE `tema`
  ADD PRIMARY KEY (`id_t`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `njoftim`
--
ALTER TABLE `njoftim`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pedagog`
--
ALTER TABLE `pedagog`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tema`
--
ALTER TABLE `tema`
  MODIFY `id_t` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `kerkesa`
--
ALTER TABLE `kerkesa`
  ADD CONSTRAINT `kerkesa_ibfk_1` FOREIGN KEY (`id_s`) REFERENCES `student` (`id`),
  ADD CONSTRAINT `kerkesa_ibfk_2` FOREIGN KEY (`id_p`) REFERENCES `pedagog` (`id`);

--
-- Constraints for table `njoftim`
--
ALTER TABLE `njoftim`
  ADD CONSTRAINT `njoftim_ibfk_1` FOREIGN KEY (`autor`) REFERENCES `pedagog` (`id`);

--
-- Constraints for table `pranuar`
--
ALTER TABLE `pranuar`
  ADD CONSTRAINT `pranuar_ibfk_1` FOREIGN KEY (`id_studentp`) REFERENCES `student` (`id`),
  ADD CONSTRAINT `pranuar_ibfk_2` FOREIGN KEY (`id_pedagog`) REFERENCES `pedagog` (`id`);

--
-- Constraints for table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `student_ibfk_1` FOREIGN KEY (`id_tema`) REFERENCES `tema` (`id_t`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
