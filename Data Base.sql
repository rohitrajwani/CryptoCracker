-- phpMyAdmin SQL Dump
-- version 4.5.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 24, 2016 at 06:07 AM
-- Server version: 5.7.11
-- PHP Version: 5.6.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `2014159`
--

-- --------------------------------------------------------

--
-- Table structure for table `attempts`
--

CREATE TABLE `attempts` (
  `Username` varchar(200) NOT NULL,
  `Problem_Code` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `attempts`
--

INSERT INTO `attempts` (`Username`, `Problem_Code`) VALUES
('tri', '5006'),
('tri', '5007'),
('tri4', '5006'),
('tri4', '5007'),
('tri4', '5008'),
('trident', '5006'),
('trident', '5007');

-- --------------------------------------------------------

--
-- Table structure for table `contains`
--

CREATE TABLE `contains` (
  `ContestID` int(11) NOT NULL,
  `Problem_Code` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contains`
--

INSERT INTO `contains` (`ContestID`, `Problem_Code`) VALUES
(1000, '5001'),
(1000, '5002'),
(1002, '5002'),
(1002, '5003'),
(1003, '5004'),
(1003, '5005'),
(1004, '5006'),
(1004, '5007'),
(1004, '5008'),
(1005, '5009'),
(1005, '5010'),
(1005, '5011'),
(1006, '5012'),
(1006, '5013'),
(1006, '5014'),
(1007, '5003'),
(1007, '5004'),
(1007, '5005');

-- --------------------------------------------------------

--
-- Table structure for table `contest`
--

CREATE TABLE `contest` (
  `ContestID` int(11) NOT NULL,
  `ContestName` varchar(200) NOT NULL,
  `ContestType` int(11) NOT NULL,
  `Category` varchar(50) NOT NULL,
  `Description` varchar(1000) NOT NULL,
  `ProblemCount` int(11) NOT NULL,
  `Admin` varchar(200) NOT NULL,
  `StartTime` timestamp NOT NULL,
  `EndTime` timestamp NOT NULL,
  `Rules` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contest`
--

INSERT INTO `contest` (`ContestID`, `ContestName`, `ContestType`, `Category`, `Description`, `ProblemCount`, `Admin`, `StartTime`, `EndTime`, `Rules`) VALUES
(1000, 'Crypto - 1', 0, '1', 'None', 2, 'apptica', '2016-04-24 05:21:13', '2016-04-24 05:21:13', 'None'),
(1002, 'Crypto-2', 0, '1', 'This is where you code to win\r\n1st Price:1000\r\n2nd Price:750\r\n3rd Price:500', 2, 'altair', '2016-05-01 06:30:00', '2016-05-10 07:30:00', 'Just do it.'),
(1003, 'Crypto-3', 0, '1', 'This is where you code to win\r\n1st Price:1000\r\n2nd Price:750\r\n3rd Price:500', 2, 'altair', '2016-04-24 05:30:00', '2016-05-10 07:30:00', 'Just do it no rules'),
(1004, 'Crypto-5', 0, '1', 'This is where you code to win\r\n1st Price:1000\r\n2nd Price:750\r\n3rd Price:500', 3, 'apptica', '2016-04-24 05:27:00', '2016-05-10 07:30:00', 'No rules'),
(1005, 'Crypto-4', 0, '1', 'This is where you code to win\r\n1st Price:1000\r\n2nd Price:750\r\n3rd Price:500', 3, 'apptica', '2016-04-24 05:27:00', '2016-05-10 07:30:00', 'No rules'),
(1006, 'Crypto-4', 0, '1', 'This is where you code to win\r\n1st Price:1000\r\n2nd Price:750\r\n3rd Price:500', 3, 'apptica', '2016-04-24 05:27:00', '2016-05-10 07:30:00', 'No rules'),
(1007, 'Debugger', 0, '1', 'This is demo contest.\r\nNo prizes', 3, 'apptica', '2016-04-24 06:30:00', '2016-04-24 09:30:00', 'You have to complete the contest in 3 hours');

-- --------------------------------------------------------

--
-- Table structure for table `problems`
--

CREATE TABLE `problems` (
  `Problem_Code` varchar(200) NOT NULL,
  `Answer` varchar(200) NOT NULL,
  `Max_Score` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `problems`
--

INSERT INTO `problems` (`Problem_Code`, `Answer`, `Max_Score`) VALUES
('5001', '500', 100),
('5002', '500', 100),
('5003', '2', 100),
('5004', '1', 100),
('5005', '2', 100),
('5006', '1', 100),
('5007', '2', 100),
('5008', '3', 100),
('5009', '1', 100),
('5010', '2', 100),
('5011', '3', 100),
('5012', '1', 100),
('5013', '2', 100),
('5014', '1', 100);

-- --------------------------------------------------------

--
-- Table structure for table `registers`
--

CREATE TABLE `registers` (
  `Username` varchar(200) NOT NULL,
  `ContestID` int(11) NOT NULL,
  `Score` int(11) NOT NULL DEFAULT '0',
  `Timer` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `registers`
--

INSERT INTO `registers` (`Username`, `ContestID`, `Score`, `Timer`) VALUES
('tri', 1004, 200, 474),
('tri4', 1004, 300, 576),
('tri4', 1005, 0, 0),
('trident', 1004, 200, 414);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `Username` varchar(200) NOT NULL,
  `First_Name` varchar(200) NOT NULL,
  `Last_Name` varchar(200) NOT NULL,
  `Password` varchar(200) NOT NULL,
  `Email` varchar(200) NOT NULL,
  `Phone` varchar(200) NOT NULL,
  `IsAdmin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`Username`, `First_Name`, `Last_Name`, `Password`, `Email`, `Phone`, `IsAdmin`) VALUES
('alt1', 'Jack', 'Sparrow', 'backtrack', 'djw@gmail.com', '7861237586', 0),
('altair', 'Naman', 'Lal', '123456', 'dancepocket123@gmail.com', '9424764887', 1),
('altr1', 'Shubhank', 'Dubey', 'backtrack1', 'sd@gmail.com', '9384215674', 0),
('apptica', 'Saurabh', 'Joshi', '123456', 'technologycorporations@gmail.com', '8601251608', 1),
('lucky', 'shubsdja', 'dubey', 'shubhhash', 's@sckj', '98023323232', 0),
('tri', 'samay', 'Jain', 'backtrack1', 'sj@gmail.com', '4852941198', 0),
('tri4', 'Sid', 'Bac', 'backtrack1', 'sb@gmail.com', '9576184576', 0),
('trident', 'Rohit', 'Rajwani', 'backtrack1', 'dp@gmail.com', '7837694291', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attempts`
--
ALTER TABLE `attempts`
  ADD PRIMARY KEY (`Username`,`Problem_Code`),
  ADD KEY `Username` (`Username`),
  ADD KEY `Problem_Code` (`Problem_Code`);

--
-- Indexes for table `contains`
--
ALTER TABLE `contains`
  ADD PRIMARY KEY (`ContestID`,`Problem_Code`),
  ADD KEY `ContestID` (`ContestID`),
  ADD KEY `Problem_Code` (`Problem_Code`);

--
-- Indexes for table `contest`
--
ALTER TABLE `contest`
  ADD PRIMARY KEY (`ContestID`),
  ADD KEY `Admin` (`Admin`);

--
-- Indexes for table `problems`
--
ALTER TABLE `problems`
  ADD PRIMARY KEY (`Problem_Code`);

--
-- Indexes for table `registers`
--
ALTER TABLE `registers`
  ADD PRIMARY KEY (`Username`,`ContestID`),
  ADD KEY `Username` (`Username`),
  ADD KEY `ContestID` (`ContestID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`Username`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attempts`
--
ALTER TABLE `attempts`
  ADD CONSTRAINT `attempts_ibfk_1` FOREIGN KEY (`Username`) REFERENCES `user` (`Username`),
  ADD CONSTRAINT `attempts_ibfk_2` FOREIGN KEY (`Problem_Code`) REFERENCES `problems` (`Problem_Code`);

--
-- Constraints for table `contains`
--
ALTER TABLE `contains`
  ADD CONSTRAINT `contains_ibfk_1` FOREIGN KEY (`ContestID`) REFERENCES `contest` (`ContestID`),
  ADD CONSTRAINT `contains_ibfk_2` FOREIGN KEY (`Problem_Code`) REFERENCES `problems` (`Problem_Code`);

--
-- Constraints for table `contest`
--
ALTER TABLE `contest`
  ADD CONSTRAINT `contest_ibfk_1` FOREIGN KEY (`Admin`) REFERENCES `user` (`Username`);

--
-- Constraints for table `registers`
--
ALTER TABLE `registers`
  ADD CONSTRAINT `registers_ibfk_1` FOREIGN KEY (`Username`) REFERENCES `user` (`Username`),
  ADD CONSTRAINT `registers_ibfk_2` FOREIGN KEY (`ContestID`) REFERENCES `contest` (`ContestID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
