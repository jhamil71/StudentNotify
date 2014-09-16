-- phpMyAdmin SQL Dump
-- version 2.11.11.3
-- http://www.phpmyadmin.net
--
-- Host: 50.63.231.31
-- Generation Time: May 06, 2013 at 07:47 AM
-- Server version: 5.0.96
-- PHP Version: 5.1.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `teacherstudent`
--

-- --------------------------------------------------------

--
-- Table structure for table `Course`
--

CREATE TABLE `Course` (
  `CourseID` varchar(11) NOT NULL,
  `TeacherID` varchar(15) NOT NULL,
  PRIMARY KEY  (`CourseID`),
  KEY `TeacherID` (`TeacherID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Course`
--

-- --------------------------------------------------------

--
-- Table structure for table `Course-Student`
--

CREATE TABLE `Course-Student` (
  `CourseID` varchar(11) NOT NULL,
  `StudentID` varchar(15) NOT NULL,
  KEY `CourseID` (`CourseID`),
  KEY `StudentID` (`StudentID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Course-Student`
--

-- --------------------------------------------------------

--
-- Table structure for table `Student`
--

CREATE TABLE `Student` (
  `StudentID` varchar(15) NOT NULL,
  `Address` varchar(160) NOT NULL,
  `Password` varchar(30) NOT NULL,
  `FirstName` varchar(40) NOT NULL,
  `LastName` varchar(40) NOT NULL,
  `HomePhone` varchar(10) NOT NULL,
  `CellPhone` varchar(10) NOT NULL,
  `Email` varchar(160) NOT NULL,
  `ContactPreference` enum('Email','Text') NOT NULL,
  `Carrier` enum('Verizon','AT&T','T-Mobile','Sprint') NOT NULL,
  `Major` varchar(50) NOT NULL,
  `EducationalGoals` varchar(50) NOT NULL,
  `HobbiesInterests` varchar(1000) NOT NULL,
  `EmploymentStatus` enum('Full-time','Part-time','Unemployed') NOT NULL,
  PRIMARY KEY  (`StudentID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Student`
--


-- --------------------------------------------------------

--
-- Table structure for table `Teacher`
--

CREATE TABLE `Teacher` (
  `TeacherID` varchar(15) NOT NULL,
  `Password` varchar(30) NOT NULL,
  `OfficeLocation` varchar(8) NOT NULL,
  `FirstName` varchar(40) NOT NULL,
  `LastName` varchar(40) NOT NULL,
  `OfficePhone` varchar(14) NOT NULL,
  `CellPhone` varchar(10) NOT NULL,
  `Email` varchar(160) NOT NULL,
  PRIMARY KEY  (`TeacherID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Teacher`
--


--
-- Constraints for dumped tables
--

--
-- Constraints for table `Course`
--
ALTER TABLE `Course`
  ADD CONSTRAINT `Course_ibfk_1` FOREIGN KEY (`TeacherID`) REFERENCES `Teacher` (`TeacherID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Course-Student`
--
ALTER TABLE `Course-Student`
  ADD CONSTRAINT `Course-Student_ibfk_2` FOREIGN KEY (`StudentID`) REFERENCES `Student` (`StudentID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Course-Student_ibfk_1` FOREIGN KEY (`CourseID`) REFERENCES `Course` (`CourseID`) ON DELETE CASCADE ON UPDATE CASCADE;
