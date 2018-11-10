

-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 07, 2018 at 11:17 AM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mscthesis`
--

-- --------------------------------------------------------

--
-- Table structure for table `area`
--

CREATE TABLE `area` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `area`
--

INSERT INTO `area` (`id`, `name`) VALUES
(8, 'Big Data'),
(9, 'Bioinformatics'),
(7, 'Cloud Computing'),
(10, 'GIS'),
(1, 'Image Processing '),
(11, 'IoT'),
(4, 'Machine Learning'),
(5, 'Networks/Security'),
(6, 'NLP and Semantics');

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `thesis_id` int(11) NOT NULL,
  `mid_term` date DEFAULT NULL,
  `final` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`thesis_id`, `mid_term`, `final`) VALUES
(1, '0000-00-00', '2015-09-10'),
(2, '0000-00-00', '2015-09-10'),
(3, '0000-00-00', '2016-10-27'),
(4, '0000-00-00', '2014-11-02'),
(5, '0000-00-00', '2014-11-02'),
(6, '0000-00-00', '2016-04-25'),
(7, '0000-00-00', '2015-06-23'),
(8, '0000-00-00', '2016-10-27'),
(9, '0000-00-00', '2016-10-27'),
(10, '0000-00-00', '2015-02-10'),
(11, '0000-00-00', '2016-10-27'),
(12, '0000-00-00', '2014-11-02'),
(13, '0000-00-00', '2016-04-25'),
(14, '0000-00-00', '2016-10-27'),
(15, '0000-00-00', '2015-02-10'),
(16, '0000-00-00', '2014-11-02'),
(17, '0000-00-00', '2016-10-27'),
(18, '0000-00-00', '2014-11-02'),
(19, '0000-00-00', '2014-11-02'),
(20, '0000-00-00', '2017-02-07'),
(21, '0000-00-00', '2017-11-10'),
(22, '0000-00-00', '2016-04-25'),
(23, '0000-00-00', '2015-09-10'),
(24, '0000-00-00', '2017-02-07'),
(25, '0000-00-00', '2015-09-10'),
(26, '0000-00-00', '2017-02-07'),
(27, '0000-00-00', '2016-04-25'),
(28, '0000-00-00', '2017-11-10'),
(29, '0000-00-00', '2015-09-19'),
(30, '0000-00-00', '2016-04-25'),
(31, '0000-00-00', '2015-09-19'),
(32, '0000-00-00', '2017-04-24'),
(33, '0000-00-00', '2016-10-27'),
(34, '0000-00-00', '2016-10-27'),
(35, '0000-00-00', '2017-04-24'),
(36, '0000-00-00', '2016-10-27'),
(37, '0000-00-00', '2017-02-07'),
(38, '0000-00-00', '2018-05-23'),
(39, '0000-00-00', '2017-04-24'),
(40, '0000-00-00', '2017-11-10'),
(41, '0000-00-00', '2017-11-10'),
(42, '0000-00-00', '2017-11-10'),
(43, '0000-00-00', '2017-11-10'),
(44, '0000-00-00', '2017-11-10'),
(45, '0000-00-00', '2017-11-10'),
(46, '0000-00-00', '2017-11-10');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `batch` varchar(5) NOT NULL,
  `department` varchar(5) NOT NULL,
  `class_rollno` varchar(5) NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `middle_name` varchar(20) DEFAULT NULL,
  `last_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`batch`, `department`, `class_rollno`, `first_name`, `middle_name`, `last_name`) VALUES
('069', 'MSCS', '651', 'Amar', 'Bahadur', 'Gurung'),
('069', 'MSCS', '652', 'Bharat', '', 'Sharma'),
('069', 'MSCS', '653', 'BIKRAM', 'KUMAR', 'KC'),
('069', 'MSCS', '654', 'BISHO', 'RAJ', 'KAPHALE'),
('069', 'MSCS', '655', 'DIPESH', '', 'SHRESTHA'),
('069', 'MSCS', '656', 'KESHAV', 'RAJ', 'JOSHI'),
('069', 'MSCS', '657', 'KRISHNA', 'PRASAD', 'NEUPANE'),
('069', 'MSCS', '658', 'MANOJ', 'KUMAR', 'GURAGAI'),
('069', 'MSCS', '659', 'OM', 'PRAKASH', 'MAHATO'),
('069', 'MSCS', '660', 'PRATISTHA', '', 'MALLA'),
('069', 'MSCS', '661', 'RAM', 'CHANDRA', 'PANDEY'),
('069', 'MSCS', '663', 'ROSHAN', '', 'ACHARYA'),
('069', 'MSCS', '664', 'ROSHAN', '', 'POKHREL'),
('069', 'MSCS', '665', 'SANTOSH', '', 'BARAL'),
('069', 'MSCS', '666', 'SANTOSH', '', 'PAUDEL'),
('069', 'MSCS', '667', 'SUBIN', '', 'SHRESTHA'),
('069', 'MSCS', '668', 'SURAJ', 'PRAKASH', 'ARYAL'),
('069', 'MSCS', '669', 'UJJWAL', '', 'PRAJAPATI'),
('069', 'MSCS', '670', 'JANESHWAR', '', 'BOHARA'),
('070', 'MSCS', '651', 'ALIZA', '', 'TANDUKAR'),
('070', 'MSCS', '652', 'AMRIT', '', 'NEPAL'),
('070', 'MSCS', '653', 'ANUP', '', 'DEVKOTA'),
('070', 'MSCS', '654', 'BINOD', '', 'BASNET'),
('070', 'MSCS', '656', 'DIPAK', '', 'KC'),
('070', 'MSCS', '659', 'NARENDRA', '', 'MAHARJAN'),
('070', 'MSCS', '661', 'PRAMINA', '', 'SHRESTHA'),
('070', 'MSCS', '664', 'SHAMBHABI', '', 'POUDYAL'),
('070', 'MSCS', '665', 'SUBHASH', '', 'PAUDEL'),
('070', 'MSCS', '666', 'SUNENA', '', 'GWACHHA'),
('070', 'MSCS', '668', 'TANTRA', 'NATH', 'JHA'),
('070', 'MSCS', '670', 'YOGENDRA', '', 'TAMANG'),
('071', 'MSCS', '655', 'MD HASAN', '', 'ANSARI'),
('071', 'MSCS', '656', 'NABIN', '', 'NEUPANE'),
('071', 'MSCS', '657', 'NARAYAN', 'PRASAD', 'KANDEL'),
('071', 'MSCS', '658', 'NITESH', '', 'KARNA'),
('071', 'MSCS', '663', 'SANDEEP', '', 'SIGDEL'),
('071', 'MSCS', '665', 'SHAILESH', '', 'SINGH'),
('071', 'MSCS', '667', 'SHYAM', 'KRISHNA', 'KHADKA'),
('071', 'MSCS', '668', 'SUJIT', '', 'MAHARJAN'),
('072', 'MSCS', '654', 'DEEPESH', '', 'LEKHAK'),
('072', 'MSCS', '660', 'PRAVESH', '', 'KOIRALA'),
('072', 'MSCS', '662', 'RAJU', '', 'SHRESTHA'),
('072', 'MSCS', '663', 'RHITWIK', '', 'TIWARI'),
('072', 'MSCS', '664', 'SARALA', '', 'GHIMIRE'),
('072', 'MSCS', '667', 'SHYAM', '', 'DAHAL'),
('072', 'MSCS', '669', 'SUSHMA', '', 'SHRESTHA');

-- --------------------------------------------------------

--
-- Table structure for table `student_writes_thesis`
--

CREATE TABLE `student_writes_thesis` (
  `writes_id` int(11) NOT NULL,
  `stud_batch` varchar(5) NOT NULL,
  `stud_depart` varchar(5) NOT NULL,
  `stud_rollno` varchar(5) NOT NULL,
  `thesis_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_writes_thesis`
--

INSERT INTO `student_writes_thesis` (`writes_id`, `stud_batch`, `stud_depart`, `stud_rollno`, `thesis_id`) VALUES
(1, '069', 'MSCS', '651', 1),
(2, '069', 'MSCS', '652', 2),
(3, '069', 'MSCS', '653', 3),
(4, '069', 'MSCS', '654', 4),
(5, '069', 'MSCS', '655', 5),
(6, '069', 'MSCS', '656', 6),
(7, '069', 'MSCS', '657', 7),
(8, '069', 'MSCS', '658', 8),
(9, '069', 'MSCS', '659', 9),
(10, '069', 'MSCS', '660', 10),
(11, '069', 'MSCS', '661', 11),
(12, '069', 'MSCS', '663', 12),
(13, '069', 'MSCS', '664', 13),
(14, '069', 'MSCS', '665', 14),
(15, '069', 'MSCS', '666', 15),
(16, '069', 'MSCS', '667', 16),
(17, '069', 'MSCS', '668', 17),
(18, '069', 'MSCS', '669', 18),
(19, '069', 'MSCS', '670', 19),
(20, '070', 'MSCS', '651', 20),
(21, '070', 'MSCS', '652', 21),
(22, '070', 'MSCS', '653', 22),
(23, '070', 'MSCS', '654', 23),
(24, '070', 'MSCS', '656', 24),
(25, '070', 'MSCS', '659', 25),
(26, '070', 'MSCS', '661', 26),
(27, '070', 'MSCS', '664', 27),
(28, '070', 'MSCS', '665', 28),
(29, '070', 'MSCS', '666', 29),
(30, '070', 'MSCS', '668', 30),
(31, '070', 'MSCS', '670', 31),
(32, '071', 'MSCS', '655', 32),
(33, '071', 'MSCS', '656', 33),
(34, '071', 'MSCS', '657', 34),
(35, '071', 'MSCS', '658', 35),
(36, '071', 'MSCS', '663', 36),
(37, '071', 'MSCS', '665', 37),
(38, '071', 'MSCS', '667', 38),
(39, '071', 'MSCS', '668', 39),
(40, '072', 'MSCS', '654', 40),
(41, '072', 'MSCS', '660', 41),
(42, '072', 'MSCS', '662', 42),
(43, '072', 'MSCS', '663', 43),
(44, '072', 'MSCS', '664', 44),
(45, '072', 'MSCS', '667', 45),
(46, '072', 'MSCS', '669', 46);

-- --------------------------------------------------------

--
-- Table structure for table `supervisor`
--

CREATE TABLE `supervisor` (
  `id` int(11) NOT NULL,
  `title` varchar(15) DEFAULT NULL,
  `first_name` varchar(20) NOT NULL,
  `middle_name` varchar(20) DEFAULT NULL,
  `last_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supervisor`
--

INSERT INTO `supervisor` (`id`, `title`, `first_name`, `middle_name`, `last_name`) VALUES
(10, 'Dr.', 'Arun', '', 'Timilsina'),
(12, 'Dr.', 'Dibakar', 'Raj', 'Pant'),
(13, 'Dr.', 'Sanjeeb', 'Prasad', 'Panday'),
(14, 'Mr.', 'Babu', 'Ram', 'Dawadi'),
(15, 'Dr.', 'Basanta', '', 'Joshi'),
(16, 'Dr.', 'Aman', '', 'Shakya'),
(17, 'Mr.', 'Daya', 'Sagar', 'Baral'),
(18, 'Prof. Dr.', 'Subarna', '', 'Shakya'),
(19, 'Prof. Dr.', 'Shashidhar', 'Ram', 'Joshi');

-- --------------------------------------------------------

--
-- Table structure for table `thesis`
--

CREATE TABLE `thesis` (
  `id` int(11) NOT NULL,
  `sup_id` int(11) NOT NULL,
  `title` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `thesis`
--

INSERT INTO `thesis` (`id`, `sup_id`, `title`) VALUES
(1, 18, 'Performance comparison of blocking artifact reduction of compressed images using bilateral and Wiener Filter'),
(2, 19, 'A cross-layer cooperative scheme for collision resolution in data networks'),
(3, 19, '3D object modeling by phase shifting Profilometry; a performance comparison between sinusoidal and Sawtooth fringe pattern'),
(4, 18, 'Intrusion detection system using back propagation algorithm and compare its performance with Self Organizing Map'),
(5, 13, 'Visual Cryptography using Image pixel transparency'),
(6, 10, 'Information security auditing for internet banking web application'),
(7, 12, 'Spatio-temporal crime prediction model in Kathmandu valley in GIS'),
(8, 16, 'DETERMINATION OF URBAN CLASSIFICATION USING CART'),
(9, 16, 'DRUG AND PROTEIN INTERACTION PREDICTION USING DEEP BELIEF NETWORK'),
(10, 15, 'Text to speech using time domain pitch synchronous overlap add'),
(11, 14, 'Nepali Character and Word Recognition using Convolution Neural Network and Dictionary '),
(12, 14, 'Authenticity based on physically unclonnable function in IPv6 platform'),
(13, 10, 'Approach to user profile generation and outlier detection from system logs'),
(14, 18, 'Defense against denial of service attack using router-router model'),
(15, 19, 'Performance analysis of spatial and transform filters for efficient image noise reduction'),
(16, 13, 'Developing a faster R3 vewshed algorithm and finding the suitable viewshed algorithm for generation of the edges of the mountains'),
(17, 13, 'An analysis and research on CPU and network I/O workload performance tuning of virtual machines in para virtualized environment'),
(18, 18, 'Task scheduling in Grid computing using Genetic Algorithm'),
(19, 19, 'A map reduce based parallel algorithm for finding longest common subsequence in biosequences'),
(20, 12, 'Detect Digital Image Splicing Forgery'),
(21, 18, 'Server-side scalable geoâ€ clustering using MapReduce based on Geohash'),
(22, 19, 'Design and performance evaluation of near field communication enabled peer to peer mobile payment system using Lattice Cryptography'),
(23, 15, 'Voice morphing by linear predictive coding coefficeints mapping using deep neural network and itâ€™s comparision with gaussian mixture model'),
(24, 14, 'Packet loss control and recovery for VOIP using Forward Error Correction'),
(25, 18, 'Approximating k-center problem using Hierarchical Clustering'),
(26, 19, 'Robust digital watermarking using Symmetric and Asymmetric Cryptography'),
(27, 13, 'Techniques of Image Mosaicing for Steganography'),
(28, 16, 'ONTOLOGY BASED JOB-CANDIDATE MATCHING USING SKILL SETS'),
(29, 13, 'Super Resolution Image Reconstruction'),
(30, 14, 'Wireless sensor network based on intelligent hybrid MAC with wide traffic and battery power conditions for guaranteed QOS'),
(31, 19, 'Efficient Convolutional Neural Network for image classification'),
(32, 19, 'Parallelization of star alignment algorithm for multiple sequence alignment using MapReduce model'),
(33, 18, 'Comparative Analysis of Backpropagation Algorithm Variants for Network Intrusion Detection'),
(34, 19, 'A map reduce model to find longest common subsequence using non-alignment based approach'),
(35, 16, 'A Keyed Algorithm for Cryptographic Hash Function'),
(36, 18, 'An approach to develop the hybrid algorithm based on support vector machine and naÃ¯ve bayes for anamoly detection'),
(37, 15, 'Image classification based on Convolution Neural Network'),
(38, 18, 'Missing Data Imputation using Deep Autoencoder'),
(39, 15, 'Real time pothole detection system using smartphones with accelerometers'),
(40, 15, 'Object Detection in Video using Region-Based Convolution Neural Network'),
(41, 16, 'Rule Based Stemming of Nepali Text'),
(42, 18, 'A Map Reduce-Based Deep Belief Network for Intrusion Detection'),
(43, 13, 'A Genetic Algorithm for Protein Crystallization Screening'),
(44, 18, 'A Comparative Analysis of Cloud based Recommendation System on Mapreduce and Spark'),
(45, 14, 'Network Intrusion Detection using Resilient Backpropagation'),
(46, 13, 'Nepali Traffic Sign Recognition using Convolution Neural Network');

-- --------------------------------------------------------

--
-- Table structure for table `thesis_has_area`
--

CREATE TABLE `thesis_has_area` (
  `thesis_id` int(11) NOT NULL,
  `area_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `thesis_has_area`
--

INSERT INTO `thesis_has_area` (`thesis_id`, `area_id`) VALUES
(1, 1),
(2, 5),
(3, 1),
(4, 4),
(4, 5),
(5, 1),
(6, 5),
(7, 1),
(7, 4),
(7, 10),
(8, 4),
(9, 4),
(9, 9),
(10, 6),
(11, 4),
(11, 6),
(12, 5),
(13, 4),
(13, 5),
(14, 5),
(15, 1),
(16, 1),
(16, 10),
(17, 7),
(18, 4),
(18, 7),
(19, 9),
(20, 1),
(21, 8),
(21, 10),
(22, 5),
(23, 4),
(23, 6),
(24, 5),
(25, 4),
(26, 1),
(26, 5),
(27, 1),
(27, 5),
(28, 6),
(29, 1),
(30, 5),
(31, 1),
(31, 4),
(32, 8),
(32, 9),
(33, 1),
(33, 5),
(34, 8),
(34, 9),
(35, 5),
(36, 4),
(36, 5),
(37, 1),
(37, 4),
(38, 4),
(39, 11),
(40, 1),
(40, 4),
(41, 6),
(42, 4),
(42, 5),
(43, 4),
(43, 9),
(44, 7),
(44, 8),
(45, 4),
(45, 5),
(46, 1),
(46, 4);

-- --------------------------------------------------------

--

-- Indexes for dumped tables
--

--
-- Indexes for table `area`
--
ALTER TABLE `area`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD UNIQUE KEY `uni2` (`name`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD UNIQUE KEY `thesis_id` (`thesis_id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`batch`,`department`,`class_rollno`);

--
-- Indexes for table `student_writes_thesis`
--
ALTER TABLE `student_writes_thesis`
  ADD PRIMARY KEY (`writes_id`),
  ADD UNIQUE KEY `stud_batch` (`stud_batch`,`stud_depart`,`stud_rollno`),
  ADD UNIQUE KEY `thesis_id` (`thesis_id`);

--
-- Indexes for table `supervisor`
--
ALTER TABLE `supervisor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `thesis`
--
ALTER TABLE `thesis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sup_id` (`sup_id`);

--
-- Indexes for table `thesis_has_area`
--
ALTER TABLE `thesis_has_area`
  ADD UNIQUE KEY `thesis_id` (`thesis_id`,`area_id`),
  ADD KEY `area_id` (`area_id`);

--
-- Indexes for table `writen`


--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `area`
--
ALTER TABLE `area`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `student_writes_thesis`
--
ALTER TABLE `student_writes_thesis`
  MODIFY `writes_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;
--
-- AUTO_INCREMENT for table `supervisor`
--
ALTER TABLE `supervisor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `thesis`
--
ALTER TABLE `thesis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;
--
-- AUTO_INCREMENT for table `writen`

--

--
-- Constraints for table `status`
--
ALTER TABLE `status`
  ADD CONSTRAINT `status_ibfk_1` FOREIGN KEY (`thesis_id`) REFERENCES `thesis` (`id`) ON UPDATE CASCADE 
  ON DELETE CASCADE;

--
-- Constraints for table `thesis`
--
ALTER TABLE `thesis`
  ADD CONSTRAINT `thesis_ibfk_1` FOREIGN KEY (`sup_id`) REFERENCES `supervisor` (`id`) ON UPDATE CASCADE
  ON DELETE CASCADE;

--
-- Constraints for table `thesis_has_area`
--
ALTER TABLE `thesis_has_area`
  ADD CONSTRAINT `thesis_has_area_ibfk_1` FOREIGN KEY (`thesis_id`) REFERENCES `thesis` (`id`) ON UPDATE CASCADE
  ON DELETE CASCADE,
  ADD CONSTRAINT `thesis_has_area_ibfk_2` FOREIGN KEY (`area_id`) REFERENCES `area` (`id`) ON UPDATE CASCADE
  ON DELETE CASCADE;

--
ALTER TABLE `student_writes_thesis`
  ADD CONSTRAINT `student_writes_thesis_ibfk_1` FOREIGN KEY (`thesis_id`) REFERENCES `thesis` (`id`) ON UPDATE CASCADE
  ON DELETE CASCADE;



/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

mscthesis.sql
Failed to sync comments due to a network error.
