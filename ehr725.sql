-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 25, 2024 at 10:26 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ehr`
--

-- --------------------------------------------------------

--
-- Table structure for table `annualphysicalexam`
--

CREATE TABLE `annualphysicalexam` (
  `id` int(10) NOT NULL,
  `dateReceived` date DEFAULT NULL,
  `datePerformed` date DEFAULT NULL,
  `rfidNumber` varchar(20) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `section` varchar(20) DEFAULT NULL,
  `building` varchar(20) DEFAULT NULL,
  `IMC` varchar(20) DEFAULT NULL,
  `OEH` varchar(20) DEFAULT NULL,
  `PE` varchar(20) DEFAULT NULL,
  `CBC` varchar(20) DEFAULT NULL,
  `U_A` varchar(20) DEFAULT NULL,
  `FA` varchar(20) DEFAULT NULL,
  `CXR` varchar(20) DEFAULT NULL,
  `VA` varchar(20) DEFAULT NULL,
  `DEN` varchar(20) DEFAULT NULL,
  `DT` varchar(20) DEFAULT NULL,
  `PT` varchar(20) DEFAULT NULL,
  `otherTest` varchar(20) DEFAULT NULL,
  `followUpStatus` varchar(20) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `confirmationDate` varchar(20) DEFAULT NULL,
  `FMC` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bloodchem`
--

CREATE TABLE `bloodchem` (
  `id` int(10) DEFAULT NULL,
  `rfid` varchar(20) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `time` time DEFAULT NULL,
  `building` varchar(20) DEFAULT NULL,
  `diagnosis` varchar(20) DEFAULT NULL,
  `intervention` varchar(20) DEFAULT NULL,
  `medications` varchar(20) DEFAULT NULL,
  `followupdate` date DEFAULT NULL,
  `FBS` varchar(20) DEFAULT NULL,
  `cholesterol` varchar(20) DEFAULT NULL,
  `triglycerides` varchar(20) DEFAULT NULL,
  `HDL` varchar(20) DEFAULT NULL,
  `LDL` varchar(20) DEFAULT NULL,
  `BUN` varchar(20) DEFAULT NULL,
  `BUA` varchar(20) DEFAULT NULL,
  `SGPT` varchar(20) DEFAULT NULL,
  `SGOT` varchar(20) DEFAULT NULL,
  `HBA1C` varchar(20) DEFAULT NULL,
  `others` varchar(50) DEFAULT NULL,
  `remarks` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `consultation`
--

CREATE TABLE `consultation` (
  `id` int(20) NOT NULL,
  `rfid` varchar(20) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL COMMENT 'nurse,doc,nurse2,done',
  `nurseAssisting` varchar(50) DEFAULT NULL,
  `date` varchar(20) DEFAULT NULL,
  `time` varchar(20) DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL,
  `categories` varchar(50) DEFAULT NULL,
  `building` varchar(20) DEFAULT NULL,
  `chiefComplaint` varchar(40) DEFAULT NULL,
  `diagnosis` varchar(500) DEFAULT NULL,
  `intervention` varchar(100) DEFAULT NULL,
  `clinicRestFrom` varchar(20) DEFAULT NULL,
  `clinicRestTo` varchar(20) DEFAULT NULL,
  `meds` varchar(100) DEFAULT NULL,
  `medsQty` int(10) NOT NULL,
  `bloodChemistry` varchar(30) DEFAULT NULL,
  `cbc` varchar(30) DEFAULT NULL,
  `urinalysis` varchar(30) DEFAULT NULL,
  `fecalysis` varchar(30) DEFAULT NULL,
  `xray` varchar(30) DEFAULT NULL,
  `others` varchar(30) DEFAULT NULL,
  `bp` varchar(30) DEFAULT NULL,
  `temp` varchar(30) DEFAULT NULL,
  `02sat` varchar(30) DEFAULT NULL,
  `pr` varchar(30) DEFAULT NULL,
  `rr` varchar(30) DEFAULT NULL,
  `remarks` varchar(30) DEFAULT NULL,
  `medicalLab` varchar(200) DEFAULT NULL,
  `medicationDispense` varchar(200) DEFAULT NULL,
  `otherRemarks` varchar(500) DEFAULT NULL,
  `statusComplete` tinyint(1) DEFAULT NULL,
  `withPendingLab` varchar(100) DEFAULT NULL,
  `finalDx` varchar(1000) DEFAULT NULL,
  `ftwApproval` varchar(20) DEFAULT NULL,
  `ftwDepartment` varchar(20) DEFAULT NULL,
  `ftwCategories` varchar(20) DEFAULT NULL,
  `ftwConfinement` varchar(30) DEFAULT NULL,
  `ftwDateOfSickLeaveFrom` varchar(20) DEFAULT NULL,
  `ftwDateOfSickLeaveTo` varchar(20) DEFAULT NULL,
  `ftwDays` int(5) DEFAULT NULL,
  `ftwReasonOfAbsence` varchar(200) DEFAULT NULL,
  `ftwRemarks` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `consultation`
--

INSERT INTO `consultation` (`id`, `rfid`, `status`, `nurseAssisting`, `date`, `time`, `type`, `categories`, `building`, `chiefComplaint`, `diagnosis`, `intervention`, `clinicRestFrom`, `clinicRestTo`, `meds`, `medsQty`, `bloodChemistry`, `cbc`, `urinalysis`, `fecalysis`, `xray`, `others`, `bp`, `temp`, `02sat`, `pr`, `rr`, `remarks`, `medicalLab`, `medicationDispense`, `otherRemarks`, `statusComplete`, `withPendingLab`, `finalDx`, `ftwApproval`, `ftwDepartment`, `ftwCategories`, `ftwConfinement`, `ftwDateOfSickLeaveFrom`, `ftwDateOfSickLeaveTo`, `ftwDays`, `ftwReasonOfAbsence`, `ftwRemarks`) VALUES
(34, '0012511458', 'done', 'GP-23-781', '2024-05-21', '09:52 AM', 'Initial', 'common', 'GPI 1', 'LBM', 'IMS', 'Medication Only', '', '', 'Diatabs(1)', 1, '', '', '', '', '', '', '', '', '', '', '', 'Fit to Work', '', '', 'This is a nurse remarks', 1, '', 'This is a sample Final Dx', 'head', 'Administration', 'counted', 'Home Confinement', '2024-05-17', '2024-05-17', 1, 'LBM', 'Others'),
(35, '0012511458', 'done', 'GP-23-781', '2024-05-21', '10:26 AM', 'Initial', 'common', 'GPI 1', 'LBM', 'IMS', 'Medication Only', '', '', 'Diatabs(1)', 1, '', '', '', '', '', '', '', '', '', '', '', 'Fit to Work', '', '', 'This is a nurse others remarks', 1, '', 'This is a sample Final Dx', 'head', 'Administration', 'counted', 'Hospital Confinement', '2024-05-21', '2024-05-21', 0, 'LBM', 'Fit to Work'),
(36, '0012521874', 'done', 'GP-23-781', '2024-06-04', '12:52 PM', 'Initial', 'common', 'GPI 1', 'Severe Headache', 'IMS', 'Medication Only', '', '', 'Diatabs(1)', 1, '', '', '', '', '', '', '', '', '', '', '', 'Fit to Work', '', '', 'Rest for 1 week', 1, '', 'This is a sample Final Dx', 'head', 'Administration', 'counted', 'Hospital Confinement', '2024-06-04', '2024-06-04', 0, '', 'Fit to Work'),
(37, '0012511458', 'done', 'GP-23-781', '2024-06-24', '08:58 AM', 'Initial', 'Work Related', 'GPI 1', 'Severe Headache', 'Stress', 'Medication Only', '', '', 'bioflu(1)', 1, '', '', '', '', '', '', '', '', '', '', '', 'Fit to Work', '', '', 'Rest', 1, '', 'This is a sample Final Dx', 'head', 'Administration', 'counted', 'Hospital Confinement', '', '', 0, '', 'Fit to Work'),
(38, '0012521874', 'done', 'GP-23-781', '2024-06-25', '09:42 AM', 'Initial', 'common', 'GPI 1', 'Severe Headache', '', 'Medication, Clinic Rest and Medical Consultation', '09:47', '10:48', 'bioflu(1)', 1, 'abc', 'def', 'ghi', 'jkl', 'mno', 'pwr', 'stu', 'vwx', 'yz', '12', '3', 'Fit to Work', '', '', 'Rest for 1 week', 1, '', 'This is a sample Final Dx', 'head', 'Administration', 'counted', 'Hospital Confinement', '', '', 0, '', 'Fit to Work'),
(39, '0012521874', 'done', 'GP-23-781', '2024-06-25', '12:24 PM', 'Initial', 'common', 'GPI 1', 'Severe Headache', 'diagnosis2', 'Medication Only', '', '', 'Diatabs(3)', 3, '123', '456', '789', '10 11 12', 'n/a', 'n/a', '110/80', '36.5', '233', 'n/a', '3', 'Fit to Work', '', '', 'Rest for 1 week', 1, '', 'This is a sample Final Dx', 'head', 'Administration', 'counted', 'Hospital Confinement', '', '', 0, '', 'Fit to Work'),
(40, '0013572190', 'done', 'GP-23-781', '2024-06-25', '01:03 PM', 'Initial', 'Long Term', 'GPI 1', '', 'diagnosis2', 'Medication Only', '', '', 'asda(1)', 1, '', '', '', '', '', '', '', '', '', '', '', 'Fit to Work', '', '', 'Rest for 1 week', 1, '', 'asdasdasd', 'head', 'Administration', 'counted', 'Hospital Confinement', '', '', 0, '', 'Fit to Work'),
(41, '0013572190', 'nurse2', 'GP-23-781', '2024-06-25', '02:45 PM', 'Initial', 'Long Term', 'GPI 1', 'LBM', 'diagnosis', 'Medication Only', '', '', 'xvdsdf(1)', 1, '', '', '', '', '', '', '', '', '', '', '', 'Others', NULL, NULL, 'Rest for 1 week', NULL, NULL, 'This is a sample Final Dx', 'head', 'Administration', 'counted', 'Hospital Confinement', '', '', 0, '', 'Fit to Work'),
(42, '0012511458', 'done', 'GP-23-781', '2024-06-25', '02:47 PM', 'Initial', 'common', 'GPI 1', 'Stomachache', 'diagnosis4', 'Medication, Clinic Rest and Medical Consultation', '14:47', '15:47', 'bioflu(1)', 1, '', '', '', '', '', '', '', '', '', '', '', 'For Medical Laboratory', 'this is a sample medical laboratory', '', 'Rest for 1 week', 1, '', 'This is a sample Final Dx', 'head', 'Administration', 'counted', 'Hospital Confinement', '', '', 0, '', 'Fit to Work'),
(43, '0013572190', 'doc', 'GP-23-781', '2024-06-26', '08:11 AM', 'Initial', 'Work Related', 'GPI 5', 'LBM', 'diagnosis', 'Medication, Clinic Rest and Medical Consultation', '08:11', '09:11', 'Diatabs(1)', 1, '', '', '', '', '', '', '', '', '', '', '', 'Others', NULL, NULL, 'Rest', NULL, NULL, 'acute gastroenteritis', 'head', 'Administration', 'counted', 'Hospital Confinement', '', '', 0, '', 'Fit to Work'),
(44, '00048584956', 'done', 'GP-23-781', '2024-07-03', '07:31 AM', 'Initial', 'common', 'GPI 1', 'sample of reason of absence', 'this', 'Medication Only', '', '', 'Diatabs(3), biogesic(1)', 1, '', '', '', '', '', '', '', '', '', '', '', 'Fit to Work', '', '', 'This is a nurse remarks', 1, '', 'This is a sample Final Dx', 'head', 'Administration', 'counted', 'Hospital Confinement', '2024-07-03', '2024-07-03', 0, 'sample of reason of absence', 'Fit to Work'),
(45, '0009727321', 'doc', 'GP-23-783', '2024-07-24', '02:16 PM', 'Initial', 'common', 'GPI 1', 'test', 'IMS', 'Medical Consultation', '', '', '', 1, '', '', '', '', '', '', '', '', '', '', '', 'Fit To Work', NULL, NULL, 'test', NULL, NULL, NULL, 'head', 'ICT', 'counted', 'Hospital Confinement', '', '', 0, '', 'Fit to Work'),
(46, '0009727321', 'doc', 'GP-23-783', '2024-07-24', '02:16 PM', 'Initial', 'common', 'GPI 1', 'test', 'IMS', 'Medication Only', '', '', '', 1, '', '', '', '', '', '', '', '', '', '', '', 'Fit To Work', NULL, NULL, 'test', NULL, NULL, NULL, 'head', 'ICT', 'counted', 'Hospital Confinement', '', '', 0, 'test', 'Fit to Work'),
(47, '00048584956', 'doc', 'GP-23-781', '2024-07-03', '07:31 AM', 'Initial', 'common', 'GPI 1', 'sample of reason of absence', '', 'Medication Only', '', '', 'Diatabs(3), biogesic(1)', 1, '', '', '', '', '', '', '', '', '', '', '', 'Fit To Work', NULL, NULL, 'This is a nurse remarks', NULL, NULL, NULL, 'head', 'ICT', 'counted', 'Hospital Confinement', '2024-07-03', '2024-07-03', 0, 'sample of reason of absence', 'Fit to Work');

-- --------------------------------------------------------

--
-- Table structure for table `diagnosis`
--

CREATE TABLE `diagnosis` (
  `id` int(11) NOT NULL,
  `diagnosisName` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `diagnosis`
--

INSERT INTO `diagnosis` (`id`, `diagnosisName`) VALUES
(1, 'IMS'),
(2, 'diagnosis2'),
(3, 'diagnosis4'),
(4, 'diagnosis5'),
(5, 'diagnosis '),
(6, 'diagnosis7'),
(7, 'masakit ul'),
(8, 'Diarrhea'),
(9, 'Diarrhea'),
(10, 'Stress'),
(11, 'depressed'),
(12, 'this is a '),
(13, '123'),
(27, '123'),
(28, '123'),
(29, 'test'),
(30, 'oo'),
(31, 'add'),
(32, '1');

-- --------------------------------------------------------

--
-- Table structure for table `emaillist`
--

CREATE TABLE `emaillist` (
  `id` int(10) NOT NULL,
  `name` varchar(60) DEFAULT NULL,
  `department` varchar(20) DEFAULT NULL,
  `email` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `emaillist`
--

INSERT INTO `emaillist` (`id`, `name`, `department`, `email`) VALUES
(1, 'Felmhar Vivo', 'Administration', 'mis@glory.com.ph'),
(2, 'Jonathan Nemedez', 'Administration', 'mis.dev@glory.com.ph');

-- --------------------------------------------------------

--
-- Table structure for table `employeespersonalinfo`
--

CREATE TABLE `employeespersonalinfo` (
  `id` int(20) NOT NULL,
  `rfidNumber` varchar(100) DEFAULT NULL,
  `idNumber` varchar(20) DEFAULT NULL,
  `Name` varchar(100) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `age` int(2) DEFAULT NULL,
  `sex` varchar(6) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `civilStatus` varchar(20) DEFAULT NULL,
  `employer` varchar(100) DEFAULT NULL,
  `building` varchar(20) DEFAULT NULL,
  `department` varchar(50) DEFAULT NULL,
  `section` varchar(50) DEFAULT NULL,
  `position` varchar(50) DEFAULT NULL,
  `level` varchar(20) DEFAULT NULL,
  `dateHired` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employeespersonalinfo`
--

INSERT INTO `employeespersonalinfo` (`id`, `rfidNumber`, `idNumber`, `Name`, `email`, `age`, `sex`, `address`, `civilStatus`, `employer`, `building`, `department`, `section`, `position`, `level`, `dateHired`) VALUES
(1, '0012511458', 'gp-22-722', 'Cedrick James Orozo', NULL, 24, 'male', 'Palangue 2, Naic, Cavite', 'Single', 'GPI', NULL, 'ICT', 'MIS/Administration', 'Specialist', '', '04/06/2022'),
(2, '0013618307', 'cg-772-696', 'Mark Ely Aragon', NULL, 24, 'male', 'Rosario, Cavite', 'Married', 'Maxim', NULL, 'ICT', 'MIS/Administration', 'Technical Support', '', '09/05/2023'),
(3, '0009727321', 'cg-772-739', 'Yoshiyuki John Daganta', NULL, 24, 'male', 'Trece Martirez City, Cavite', 'Divorced', 'Maxim', NULL, 'ICT', 'MIS/Administration', 'Technical Support', '', '11/14/2023'),
(4, '0013572190', 'gp-17-571', 'Felmhar Vivo', 'k.marero@glorylocal.com.ph', 24, 'male', 'Rosario, Cavite', 'married', 'GPI', NULL, 'ICT', 'Information Security', 'Specialist', 'head', ''),
(5, '00097273212', 'cg-231-232', 'Raquel Morillo', NULL, 24, 'male', 'Palangue 2, Naic, Cavite', 'Single', 'Nippi', NULL, 'Administration', 'MIS/Administration', 'Specialist', '', '04/06/2022'),
(6, '0013612345', 'cg-772-123', 'Silene Oliveira', 'test@glorylocal.com.ph', 24, 'male', 'Rosario, Cavite', '', 'Powerlane', NULL, 'Administration', 'MIS/Administration', 'Technical Support', '', ''),
(7, '0009727323', 'cg-772-245', 'Andrés de Fonollosa', NULL, 24, 'male', 'Trece Martirez City, Cavite', 'Divorced', 'Otrelo', NULL, 'Administration', 'MIS/Administration', 'Technical Support', '', '11/14/2023'),
(8, '0013572123', 'gp-17-123', 'Sergio Marquina', NULL, 24, 'male', 'Rosario, Cavite', 'Single', 'Mangreat', NULL, 'Administration', 'MIS/Administration', 'Specialist', '', '04/06/2019'),
(9, '0009727367', 'cg-772-122', 'ï¿½gata Jimï¿½nez', 'email@glory.com.ph', 24, 'male', 'Trece Martirez City, Cavite', 'married', 'Alarm', NULL, 'Administration', 'MIS/Administration', 'Technical Support', '', ''),
(10, '0013721743', 'gp-17-149', 'Anï¿½bal Cortï¿½s', 'email@glory.com.ph', 24, 'male', 'Rosario, Cavite', 'single', 'Canteen', NULL, 'Administration', 'MIS/Administration', 'Specialist', '', '2024-07-03'),
(11, '04008584126', 'GP-24-578', 'Juan Dela Cruz', NULL, 24, 'male', '0233 Palangue 2, Naic, Cavite', 'single', 'GPI', NULL, 'Administration', 'MIS', 'Staff', '', '2024-02-26'),
(13, '00048584956', 'GP-22-729', 'Kevin Marero', NULL, 28, 'male', '0233 Palangue 2, Naic, Cavite', 'single', 'GPI', NULL, 'ICT', 'Information Security', 'Specialist', '', '2024-02-26'),
(14, '0008282956', 'GP-24-748', 'Aileen Domo', 'mis.staff@glorylocal.com.ph', 29, 'female', '0233 Palangue 2, Naic, Cavite', 'single', 'GPI', NULL, 'Administration', 'MIS ', 'Staff', '', '2024-02-29'),
(17, '0010068629', 'GP-23-781', 'Janella Francisco', NULL, 24, 'male', 'sldkfhslkdjfh', 'single', 'GPI', NULL, 'Administration', 'Health Benefits', 'Nurse', '', '2023-06-13'),
(18, '0012521874', 'GP-23-822', 'Christian John Lopez', NULL, 25, 'M', 'Metrogate Tanza Cavite', 'Signle', 'GPI', NULL, 'Administration', 'Information System', 'Specialist', '', '6-Dec-23'),
(19, '', 'GP-11-306', 'Nathan Mendez', 'o.bugarin@glory.com.ph', 0, '', '', '', '', NULL, 'ICT', 'ICT', 'Supervisor', 'head', ''),
(21, NULL, 'GP-15-437', 'Rose Ann Alega', 'mis.dev@glory.com.ph', NULL, NULL, NULL, NULL, NULL, NULL, 'Administration', 'HR', 'HR', 'hr', NULL),
(22, '04008584129', 'GP-12-123', 'test', NULL, 25, 'male', 'test', 'single', 'GPI', NULL, 'Production 1', 'test', 'test', NULL, '2023-06-11'),
(23, '00123456', 'Gp-11-111', 'John Doe', NULL, 25, 'male', '123 Finland St', 'Single', 'GPI', NULL, 'Administration', 'HR', 'HR', NULL, '1/22/2023'),
(24, '00123451', 'Gp-11-112', 'John Doe', NULL, 25, 'male', '123 Finland St', 'Single', 'GPI', NULL, 'Administration', 'HR', 'HR', NULL, '1/22/2023'),
(25, '001234598', 'gp-22-726', 'Juan Miguel', NULL, 24, 'male', 'Palangue 2, Naic, Cavite', 'Single', 'Nippi', NULL, 'ICT', 'MIS/Administration', 'Specialist', '', '04/06/2022'),
(26, '00123334598', 'gp-22-126', 'Juan Miguel', NULL, 24, 'male', 'Palangue 2, Naic, Cavite', 'Single', 'Maxim', NULL, 'ICT', 'MIS/Administration', 'Specialist', '', '04/06/2022'),
(27, '0063549446', 'GP-23-822', 'Christian John Lopez', NULL, 25, 'M', 'Metrogate Tanza Cavite', 'Signle', 'Otrelo', NULL, 'Administration', 'Information System', 'Specialist', '', '6-Dec-23'),
(28, '002302150468', 'GP-11-123', 'Michelle Cortez', NULL, 29, 'female', 'General Trias Cavite', 'single', 'GPI', NULL, 'Accounting', 'Accounting', 'Specialist', NULL, '2023-01-17'),
(30, '12365498789', 'GP-11-111', 'Name', 'email1@email.com', 30, 'female', 'Cavite City', 'single', 'GPI', NULL, 'ICT', 'Information System', 'Staff', '', '2024-05-16'),
(31, '12365498789', 'GP-11-111', 'Name2', 'email2@email.com', 30, 'male', 'Cavite City', 'single', 'GPI', NULL, 'ICT', 'Information System', 'Specialist', '', '2024-05-16'),
(33, '12364896', 'CG-1236', 'Anna', 'email@glory.com.ph', 30, 'female', 'general trias cavite', 'single', 'Powerlane', NULL, 'ict', 'is', 'staff', '', '1/5/2024');

-- --------------------------------------------------------

--
-- Table structure for table `fittowork`
--

CREATE TABLE `fittowork` (
  `id` int(20) NOT NULL,
  `approval` varchar(20) DEFAULT NULL,
  `department` varchar(50) DEFAULT NULL,
  `rfid` varchar(20) DEFAULT NULL,
  `date` varchar(20) DEFAULT NULL,
  `time` varchar(20) DEFAULT NULL,
  `categories` varchar(50) DEFAULT NULL,
  `building` varchar(20) DEFAULT NULL,
  `confinementType` varchar(40) DEFAULT NULL,
  `medicalCategory` varchar(20) DEFAULT NULL,
  `medicine` varchar(100) DEFAULT NULL,
  `fromDateOfSickLeave` varchar(20) DEFAULT NULL,
  `toDateOfSickLeave` varchar(20) DEFAULT NULL,
  `days` int(5) DEFAULT NULL,
  `reasonOfAbsence` varchar(500) DEFAULT NULL,
  `diagnosis` varchar(500) DEFAULT NULL,
  `bloodChemistry` varchar(30) DEFAULT NULL,
  `cbc` varchar(30) DEFAULT NULL,
  `urinalysis` varchar(30) DEFAULT NULL,
  `fecalysis` varchar(30) DEFAULT NULL,
  `xray` varchar(30) DEFAULT NULL,
  `others` varchar(30) DEFAULT NULL,
  `bp` varchar(30) DEFAULT NULL,
  `temp` varchar(30) DEFAULT NULL,
  `02sat` varchar(30) DEFAULT NULL,
  `pr` varchar(30) DEFAULT NULL,
  `rr` varchar(30) DEFAULT NULL,
  `remarks` varchar(30) DEFAULT NULL,
  `otherRemarks` varchar(500) DEFAULT NULL,
  `statusComplete` tinyint(1) DEFAULT 0,
  `withPendingLab` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fittowork`
--

INSERT INTO `fittowork` (`id`, `approval`, `department`, `rfid`, `date`, `time`, `categories`, `building`, `confinementType`, `medicalCategory`, `medicine`, `fromDateOfSickLeave`, `toDateOfSickLeave`, `days`, `reasonOfAbsence`, `diagnosis`, `bloodChemistry`, `cbc`, `urinalysis`, `fecalysis`, `xray`, `others`, `bp`, `temp`, `02sat`, `pr`, `rr`, `remarks`, `otherRemarks`, `statusComplete`, `withPendingLab`) VALUES
(36, 'head', 'Administration', '0012511458', '2024-05-21', '10:26 AM', 'not counted', 'GPI 5', 'Hospital Confinement', 'Common', NULL, '2024-05-21', '2024-05-21', 0, 'LBM', 'IMS', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', 'Fit to Work', 'This is a nurse others remarks', 0, 'Test'),
(37, 'head', 'Administration', '0012521874', '2024-06-04', '12:41 PM', 'counted', 'GPI 1', 'Hospital Confinement', 'Common', 'Diatabs(1)', '2024-06-04', '2024-06-04', 1, 'LBM', 'IMS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Fit to Work', NULL, 1, NULL),
(38, 'head', 'Administration', '0012511458', '2024-05-21', '09:52 AM', 'counted', 'GPI 1', 'Home Confinement', 'Common', NULL, '2024-05-17', '2024-05-17', 1, 'LBM', 'IMS', '', '', '', '', '', '', '', '', '', '', '', 'Fit to Work', 'This is a nurse remarks', 1, ''),
(39, 'head', 'Administration', '0012521874', '2024-06-04', '12:52 PM', 'counted', 'GPI 1', 'Hospital Confinement', 'Common', NULL, '2024-06-04', '2024-06-04', 0, '', 'IMS', '', '', '', '', '', '', '', '', '', '', '', 'Fit to Work', 'Rest for 1 week', 1, ''),
(40, 'head', 'Administration', '0012521874', '2024-06-25', '09:42 AM', 'counted', 'GPI 1', 'Home Confinement', 'Common', NULL, '2024-06-25', '2024-06-25', 1, 'Severe Headache', '', 'abc', 'def', 'ghi', 'jkl', 'mno', 'pwr', 'stu', 'vwx', 'yz', '12', '3', 'Fit to Work', 'Rest for 1 week', 1, ''),
(41, 'head', 'Administration', '0012521874', '2024-06-25', '12:24 PM', 'counted', 'GPI 1', 'Home Confinement', 'Common', NULL, '2024-06-25', '2024-06-25', 1, 'Severe Headache', 'diagnosis2', '123', '456', '789', '10 11 12', 'n/a', 'n/a', '110/80', '36.5', '233', 'n/a', '3', 'Fit to Work', 'Rest for 1 week', 1, ''),
(42, 'head', 'Administration', '0012511458', '2024-06-24', '08:58 AM', 'not counted', 'GPI 1', 'Hospital Confinement', 'Common', NULL, '2024-06-25', '2024-06-25', 1, 'Severe Headache', 'Stress', '', '', '', '', '', '', '', '', '', '', '', 'Fit to Work', 'Rest', 1, ''),
(44, 'head', 'Administration', '0013572190', '2024-06-25', '01:03 PM', 'not counted', 'GPI 1', 'Home Confinement', 'Long Term', 'asda(1)', '2024-06-25', '2024-06-25', 0, 'Severe Headache', 'diagnosis2', '', '', '', '', '', '', '', '', '', '', '', 'Fit to Work', 'Rest for 1 week', 1, ''),
(45, 'head', 'ICT', '00048584956', '2024-07-03', '07:31 AM', 'counted', 'GPI 1', 'Hospital Confinement', 'Common', 'Diatabs(3), biogesic(1)', '2024-07-03', '2024-07-03', 1, 'sample of reason of absence', 'this', '', '', '', '', '', '', '', '', '', '', '', 'Fit to Work', 'This is a nurse remarks', 1, ''),
(46, 'head', 'ICT', '0013618307', '2024-07-04', '08:57 AM', 'counted', 'GPI 1', 'Home Confinement', 'Common', 'test(4)', '2024-07-03', '2024-07-03', 1, 'headache', 'test', '', '', '', '', '', '', '', '', '', '', '', 'Fit to Work', 'test', 1, ''),
(47, 'head', 'ICT', '0013618307', '2024-07-04', '08:57 AM', 'counted', 'GPI 1', 'Home Confinement', 'Common', 'test(4)', '2024-07-04', '2024-07-04', 0, 'headache', '', '', '', '', '', '', '', '', '', '', '', '', 'Fit to Work', 'test', 1, ''),
(48, 'head', 'ICT', '0013618307', '2024-07-04', '08:57 AM', 'counted', 'GPI 1', 'Home Confinement', 'Common', 'test(4)', '2024-07-03', '2024-07-03', 1, 'headache', 'diagnosis2', '', '', '', '', '', '', '', '', '', '', '', 'Fit to Work', 'test', 1, ''),
(49, 'head', 'ICT', '0013618307', '2024-07-04', '08:57 AM', 'counted', 'GPI 1', 'Home Confinement', 'Common', 'test(4)', '2024-07-04', '2024-07-05', 2, 'headache11', 'diagnosis2', '', '', '', '', '', '', '', '', '', '', '', 'Fit to Work', 'test11', 1, ''),
(50, 'head', 'ICT', '0012511458', '2024-07-05', '08:17 AM', 'counted', 'GPI 1', 'Hospital Confinement', 'Common', 'test(4)', '2024-07-04', '2024-07-04', 1, 'headache', 'diagnosis2', '', '', '', '', '', '', '', '', '', '', '', 'Fit to Work', 'test', 1, ''),
(51, 'head', 'ICT', '0012511458', '2024-07-05', '08:24 AM', 'counted', 'GPI 1', 'Hospital Confinement', 'Common', 'sssss(3)', '2024-07-05', '2024-07-05', 1, 'test', 'depressed', '', '', '', '', '', '', '', '', '', '', '', 'Fit to Work', 'gggggggg', 1, ''),
(52, 'head', 'ICT', '0013618307', '2024-07-05', '08:51 AM', 'counted', 'GPI 1', 'Hospital Confinement', 'Common', '', '2024-07-05', '2024-07-05', 1, '', '', '', '', '', '', '', '', '', '', '', '', '', 'Fit to Work', '', 0, ''),
(53, 'head', 'ICT', '00048584956', '2024-07-05', '01:35 PM', 'counted', 'GPI 1', 'Hospital Confinement', 'Common', 'test(5)', '2024-07-05', '2024-07-05', 1, 'headache', 'diagnosis2', '1', '2', '3', '3', '3', '3', '3', '3', '3', '3', '3', 'Fit to Work', 'test', 1, ''),
(54, 'head', 'ICT', '0013618307', '2024-07-08', '12:13 PM', 'not counted', 'GPI 1', 'Hospital Confinement', 'Common', 'paracetamol(3)', '2024-07-05', '2024-07-05', 1, 'headache', 'IMS', '', '', '', '', '', '', '', '', '', '', '', 'Fit to Work', '', 1, ''),
(55, 'head', 'ICT', '0009727321', '2024-07-08', '03:08 PM', 'counted', 'GPI 1', 'Hospital Confinement', 'Common', 'test(5)', '2024-07-05', '2024-07-05', 1, 'test', 'Diarrhea', '', '', '', '', '', '', '', '', '', '', '', 'Fit to Work', '', 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `medicalcertificate`
--

CREATE TABLE `medicalcertificate` (
  `id` int(10) NOT NULL,
  `rfid` varchar(20) NOT NULL,
  `consultationId` varchar(10) NOT NULL,
  `date` varchar(20) NOT NULL,
  `treatedOn` varchar(300) NOT NULL,
  `dueTo` varchar(2000) NOT NULL,
  `diagnosis` varchar(2000) NOT NULL,
  `remarks` varchar(2000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `medicalcertificate`
--

INSERT INTO `medicalcertificate` (`id`, `rfid`, `consultationId`, `date`, `treatedOn`, `dueTo`, `diagnosis`, `remarks`) VALUES
(5, '0013618307', '13', '2024-03-04', 'LBM', 'Gastroentritis', 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. ', 'Non omnis minima perspiciatis reiciendis repellendus ut dolores. Sed saepe eaque assumenda itaque repellat sint. Iusto repellat commodi, ea ducimus voluptatibus magni?'),
(6, '0013618307', '13', '2024-03-04', 'LBM', 'Gastroentritis', 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. ', 'Non omnis minima perspiciatis reiciendis repellendus ut dolores. Sed saepe eaque assumenda itaque repellat sint. Iusto repellat commodi, ea ducimus voluptatibus magni?'),
(7, '0010068629', '14', '2024-03-07', 'March 07, 2024', 'Body Pain', 'MSS', 'Rest for 2 days'),
(8, '0013618307', '15', '2024-05-06', '2024-05-06', 'SDf', 'asetq4qw', 'efwgedg'),
(9, '0013572190', '18', '2024-05-09', '2024-05-09', 'pigsa', 'aksjch', 'amsjufd'),
(10, '0012511458', '19', '2024-05-09', '2024-05-09', 'lbm', 'Gastroentheristis', 'Ok'),
(11, '0012511458', '31', '2024-05-21', '2024-05-21', 'LBM', 'Acute Gastroentritis', ''),
(16, '0012511458', '34', '2024-05-21', '2024-05-21', 'sdfg', 'asdfaSDFA', 'SDFASDFADFA'),
(17, '0012511458', '34', '2024-06-04', '2024-06-04', 'wsf', 'asdfasd', 'fasdfad'),
(18, '0012511458', '34', '2024-06-04', '2024-06-04', 'cjkg', 'huklvhj', 'mb '),
(19, '0012521874', '36', '2024-06-21', '2024-06-21', 'severe head ache', 'stress', 'n/a'),
(20, '0012521874', '36', '2024-06-21', '2024-06-21', 'severe head ache', 'stress', 'n/a'),
(21, '0012521874', '36', '2024-06-25', '2024-06-25', 'asd', 'asdasd', 'asdasdasd'),
(22, '0012521874', '38', '2024-06-25', '2024-06-25', 'sdfhdfg', 'mfjh,hjms', 'sdsdfgaws'),
(23, '0012521874', '39', '2024-06-25', '2024-06-25', 'qweq', 'weqweqwe', 'qweqweqwqweqwe'),
(24, '0012511458', '37', '2024-06-25', '2024-06-25', 'asd', 'bdfgdfad', 'swertgdsv'),
(25, '0013572190', '40', '2024-06-25', '2024-06-25', 'asfdgl', 'sdrhuk', 'fghasdfasdasd'),
(26, '0012511458', '42', '2024-06-25', '2024-06-25', 'sdg', 'asdfasdf', 'asdfasdfsdf'),
(27, '00048584956', '44', '2024-07-03', '2024-07-03', 'kajsdfagh', 'owisfodfjkwha', 'osidfyosidfoisdofiwsfi');

-- --------------------------------------------------------

--
-- Table structure for table `pastmedicalhistory`
--

CREATE TABLE `pastmedicalhistory` (
  `id` int(11) NOT NULL,
  `rfidNumber` varchar(50) NOT NULL,
  `smoking` tinyint(1) DEFAULT NULL,
  `drugs` tinyint(1) DEFAULT NULL,
  `alcohol` tinyint(1) DEFAULT NULL,
  `asthma` tinyint(1) DEFAULT NULL,
  `ptb` tinyint(1) DEFAULT NULL,
  `diabetes` tinyint(1) DEFAULT NULL,
  `heartDisease` tinyint(1) DEFAULT NULL,
  `hpn` tinyint(1) DEFAULT NULL,
  `renalDisease` tinyint(1) DEFAULT NULL,
  `othersFH` varchar(300) DEFAULT NULL,
  `pastAndPresentMedHistory` varchar(3000) DEFAULT NULL,
  `far` varchar(100) DEFAULT NULL,
  `near` varchar(100) DEFAULT NULL,
  `adequate` tinyint(1) DEFAULT NULL,
  `inadequate` tinyint(1) DEFAULT NULL,
  `surgicalHistory` varchar(1000) DEFAULT NULL,
  `presentMedication` varchar(1000) DEFAULT NULL,
  `allergies` varchar(1000) DEFAULT NULL,
  `intervalMH` varchar(100) DEFAULT NULL,
  `duration` varchar(100) DEFAULT NULL,
  `flow` varchar(100) DEFAULT NULL,
  `menorrhagia` tinyint(1) DEFAULT NULL,
  `metrorrhagia` tinyint(1) DEFAULT NULL,
  `amenorrhea` tinyint(1) DEFAULT NULL,
  `dysmenorrhea` tinyint(1) DEFAULT NULL,
  `gravida` varchar(100) DEFAULT NULL,
  `para` varchar(100) DEFAULT NULL,
  `termBirth` varchar(100) DEFAULT NULL,
  `livingChildren` varchar(100) DEFAULT NULL,
  `preTermBirth` varchar(100) DEFAULT NULL,
  `abortion` varchar(100) DEFAULT NULL,
  `multiplePregnancies` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pastmedicalhistory`
--

INSERT INTO `pastmedicalhistory` (`id`, `rfidNumber`, `smoking`, `drugs`, `alcohol`, `asthma`, `ptb`, `diabetes`, `heartDisease`, `hpn`, `renalDisease`, `othersFH`, `pastAndPresentMedHistory`, `far`, `near`, `adequate`, `inadequate`, `surgicalHistory`, `presentMedication`, `allergies`, `intervalMH`, `duration`, `flow`, `menorrhagia`, `metrorrhagia`, `amenorrhea`, `dysmenorrhea`, `gravida`, `para`, `termBirth`, `livingChildren`, `preTermBirth`, `abortion`, `multiplePregnancies`) VALUES
(1, '0008584956', 0, 0, 1, 0, 0, 1, 1, 0, 1, '', '(+) Vehicular Accident - 2022\r\nFam Hx.: (+) DM II - Fathers side', '40/50', '20/20', 0, 1, '(+) NSD - G3P2 - 2006     (+) Appendectomy - 2009', 'Mefenamic Acid 500mg', 'NKA', '28-30 days', '5-7 days', 'Heavy', 1, 0, 1, 1, '3', '3', '3', '3', '0', '0', '0'),
(2, '0013618307', 1, 1, 1, 1, 1, 1, 1, 1, 1, 'zsd', '(+) Vehicular Accident - 2022\r\nFam Hx.: (+) DM II - Fathers side1', '40/501', '20/201', 0, 1, '(+) NSD - G3P2 - 2006     (+) Appendectomy - 20091', 'Mefenamic Acid 500mg1', 'NKA1', '28-30 days1', '5-7 days1', 'Heavy1', 1, 1, 1, 1, '31', '31', '31', '31', '01', '01', '01'),
(3, '0012521874', 1, 0, 0, 0, 0, 0, 1, 0, 1, '', '(+) Vehicular Accident - 2022\r\nFam Hx.: (+) DM II - Fathers side', '40/50', '20/20', 0, 1, '(+) NSD - G3P2 - 2006     (+) Appendectomy - 2009', 'Mefenamic Acid 500mg', 'NKA', '', '', '', 0, 0, 0, 0, '', '', '', '', '', '', ''),
(6, '0009727321', 1, 0, 0, 0, 0, 0, 1, 0, 1, '', '(+) Vehicular Accident - 2022\r\nFam Hx.: (+) DM II - Fathers side', '40/50', '20/20', 0, 1, '(+) NSD - G3P2 - 2006     (+) Appendectomy - 2009', 'Mefenamic Acid 500mg', 'NKA', '', '', '', 0, 0, 0, 0, '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `preemployment`
--

CREATE TABLE `preemployment` (
  `id` int(10) NOT NULL,
  `dateReceived` date DEFAULT NULL,
  `datePerformed` date DEFAULT NULL,
  `rfidNumber` varchar(20) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `section` varchar(20) DEFAULT NULL,
  `IMC` varchar(20) DEFAULT NULL,
  `OEH` varchar(20) DEFAULT NULL,
  `PE` varchar(20) DEFAULT NULL,
  `CBC` varchar(20) DEFAULT NULL,
  `U_A` varchar(20) DEFAULT NULL,
  `FA` varchar(20) DEFAULT NULL,
  `CXR` varchar(20) DEFAULT NULL,
  `VA` varchar(20) DEFAULT NULL,
  `DEN` varchar(20) DEFAULT NULL,
  `DT` varchar(20) DEFAULT NULL,
  `PT` varchar(20) DEFAULT NULL,
  `otherTest` varchar(20) DEFAULT NULL,
  `followUpStatus` varchar(20) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `attendee` varchar(50) DEFAULT NULL,
  `confirmationDate` varchar(20) DEFAULT NULL,
  `FMC` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `preemployment`
--

INSERT INTO `preemployment` (`id`, `dateReceived`, `datePerformed`, `rfidNumber`, `name`, `section`, `IMC`, `OEH`, `PE`, `CBC`, `U_A`, `FA`, `CXR`, `VA`, `DEN`, `DT`, `PT`, `otherTest`, `followUpStatus`, `status`, `attendee`, `confirmationDate`, `FMC`) VALUES
(1, '2024-07-15', '2024-07-12', '04008584126', 'Juan Dela Cruz', 'MIS', '21', '2', '2', '2', '2', '2', '2', '2', '1', '2', '2', 'test', 'test', 'complied', '', '2024-07-15', 't'),
(3, '2024-07-15', '2024-07-12', '0012511458', 'Cedrick James Orozo', 'MIS/Administration', '2', '2', '2', '2', '2', '2', '2', '2', '2', '2', '2', ' test', ' test', 'complied', 'Nurse J', '2024-07-15', 't'),
(24, '2024-07-15', '2024-07-12', '0013572190', 'Felmhar Vivo', 'Information Security', '2', '2', '2', '2', '2', '2', '2', '2', '1', '2', '2', ' test', ' test', 'complied', 'n/A', '2024-07-15', 't'),
(25, '2024-07-16', '2024-07-04', '0013618307', 'Mark Ely Aragon', 'MIS/Administration', 'g', 'f', 'f', 'f', 'f', 'f', 'f', 'f', '1', 'f', 'f', 'f', 'f', 'pending', NULL, '2024-07-15', 'f'),
(26, '2024-07-15', '2024-07-05', '0009727321', 'Full name', 'QA', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', 'pending', '', '2024-07-16', '11'),
(29, '2024-07-17', '2024-07-19', '00097273212', 'Raquel Morillo', 'MIS/Administration', '2', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', 'pending', NULL, '2024-07-15', '1'),
(30, '2024-07-22', '2024-07-22', '001234598', 'Juan Miguel', 'MIS/Administration', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', ' 1', ' 1', 'pending', NULL, '2024-07-22', '1'),
(31, '2024-07-22', '2024-07-22', '00123334598', 'Juan Miguel', 'MIS/Administration', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', 'pending', NULL, '2024-07-22', '1'),
(32, '2024-07-16', '2024-07-10', '0013612345', 'Silene Oliveira', 'MIS/Administration', 'gy', 'r', 'r', 'r', 'r', 'r', 'r', 'r', '1', 'r', 'r', 'r', 'r', 'pending', NULL, '2024-07-15', 'r'),
(33, '2024-06-03', '2024-07-12', '0009727323', 'Andrï¿½s de Fonollosa', 'MIS/Administration', 'gg', 'g', 'g', 'g', 'g', 'g', 'g', 'g', '1', 'g', 'g', 'g', 'g', 'complied', NULL, '2024-07-12', 'g'),
(34, '2024-07-03', '2024-06-03', '0063549446', 'Christian John Lopez', 'Information System', 'f', 'f', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'e', '', ' e', ' e', 'pending', NULL, '2024-07-03', '1'),
(37, '2024-07-17', '2024-07-18', '00048584956', 'Kevin Marero', 'Information Security', 'r', 'r', 'r', 'r', 'r', 'r', 'r', 'r', '', 'r', 'r', 'r', 'r', 'pending', NULL, '2024-07-17', 'r'),
(43, '2024-07-10', '2024-07-16', '0008282956', 'Aileen Domo', 'MIS ', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'e', '', 'e', 'e', 'e', 'e', 'pending', NULL, '2024-07-18', 'e'),
(44, '2024-07-16', '2024-07-16', '0012521874', 'Christian John Lopez', 'Information System', 'imc', 'oeh', 'pe', 'cbc', 'u/a', 'fa', 'cxr', 'va', '', 'dt', 'pt', 'others', 'status', 'pending', NULL, '2024-07-16', 'fmc'),
(45, '2024-07-16', '2024-07-16', '04008584129', 'test', 'test', '1', '2', '3', '4', '5', '6', '7', '8', '56', '10', '11', '12', '13', 'pending', NULL, '2024-07-16', '14'),
(46, '2024-07-17', '2024-07-22', '0009727367', 'ï¿½gata Jimï¿½nez', 'MIS/Administration', 'imc11', 'oeh', 'pe', 'cbc', 'ua', 'fa', 'cxr', 'va', 'den', 'dt', 'pt', 'others', 'status', 'complied', '', '2024-07-16', 'fmc'),
(48, '2024-07-16', '2024-07-17', '0013721743', 'Anï¿½bal Cortï¿½s', 'MIS/Administration', 'imc1', 'oeh', 'pe', 'cbc', 'ua', 'fa', 'cxr', 'va', 'den', 'dt', 'pt', 'others', 'status', 'pending', NULL, '2024-07-16', 'fmc'),
(49, '2024-07-23', '2024-07-19', '00123451', 'John Doe', 'HR', 'g', 'g', 'g', 'g', 'g', 'g', 'g', 'g', 'g', 'g', 'g', 'g', 'g', 'pending', 'ggg', '2024-07-24', 'g');

-- --------------------------------------------------------

--
-- Table structure for table `queing`
--

CREATE TABLE `queing` (
  `id` int(20) NOT NULL,
  `rfidNumber` varchar(100) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `nurseAssisting` varchar(30) DEFAULT NULL,
  `date` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `queing`
--

INSERT INTO `queing` (`id`, `rfidNumber`, `status`, `nurseAssisting`, `date`) VALUES
(2, '0013618307', 'done', 'GP-23-781', ''),
(3, '0009727321', 'done', 'GP-23-781', ''),
(17, '0008584956', 'processing', 'GP-23-783', ''),
(18, '0010068629', 'done', 'GP-23-781', ''),
(20, '0012511458', 'done', 'GP-23-781', ''),
(26, '0012521874', 'done', 'GP-23-781', ''),
(27, '0013572190', 'processing', 'GP-23-781', ''),
(29, '0012511458', 'processing', 'GP-23-781', ''),
(30, '00048584956', 'processing', 'GP-23-783', NULL),
(31, '0013618307', 'done', 'GP-23-783', NULL),
(32, '0009727321', 'processing', 'GP-23-783', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sender`
--

CREATE TABLE `sender` (
  `id` int(11) NOT NULL,
  `email` varchar(30) DEFAULT NULL,
  `password` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sender`
--

INSERT INTO `sender` (`id`, `email`, `password`) VALUES
(1, 'helpdesk@glorylocal.com.ph', 'Xc71k9^h1');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(5) NOT NULL,
  `idNumber` varchar(20) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `userName` varchar(20) DEFAULT NULL,
  `password` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL,
  `department` varchar(50) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `idNumber`, `name`, `userName`, `password`, `type`, `department`, `email`, `status`) VALUES
(1, 'GP-23-781', 'Janella Mae Francisco', 'janella', '$2y$10$P24ON3qHXn5cII02KAk5AOLpVICrmkoabyF36oMF6AiQI9t5on9re', 'nurse', 'Administration', '', 1),
(2, 'GP-20-688', 'Alyssa Prudente', 'alyssa', '$2y$10$P24ON3qHXn5cII02KAk5AOLpVICrmkoabyF36oMF6AiQI9t5on9re', 'nurse', 'Administration', '', 1),
(3, 'GP-19-683', 'Lenlyn Marcilla', 'lenlyn', '$2y$10$P24ON3qHXn5cII02KAk5AOLpVICrmkoabyF36oMF6AiQI9t5on9re', 'nurse', 'Administration', '', 1),
(4, 'GP-11-306', 'Jonathan Nemedez', 'nathan', '$2y$10$P24ON3qHXn5cII02KAk5AOLpVICrmkoabyF36oMF6AiQI9t5on9re', 'head', 'ICT', 'mis.dev@glory.com.ph', 1),
(5, 'GP-15-437', 'Rose Ann Alega', 'rose', '$2y$10$P24ON3qHXn5cII02KAk5AOLpVICrmkoabyF36oMF6AiQI9t5on9re', 'hr', 'Administration', 'mis.dev@glory.com.ph', 1),
(6, '660150', 'Dr. John Alden Amores', 'alden', '$2y$10$P24ON3qHXn5cII02KAk5AOLpVICrmkoabyF36oMF6AiQI9t5on9re', 'doctor', 'Administration', '', 1),
(7, 'GP-23-783', 'Olive Bugarin', 'olive', '$2y$10$P24ON3qHXn5cII02KAk5AOLpVICrmkoabyF36oMF6AiQI9t5on9re', 'nurse', 'Administration', 'o.bugarin@glory.com.ph', 1),
(11, '', '', '', '$2y$10$dau1iL0tJsu3HwiHP0EbUu5SaAdBMN0jcu2l/h13f3WBeXPieryqS', 'nurse', 'ICT', '', 0),
(12, 'GP-22-740', 'Bobby John Solomon', 'bobby', '$2y$10$2kqnTUFoh8M/aGaq1/F3zenLx6dPCk5UWKhFPO0Y7n1G9FOpb1CMW', 'nurse', 'ICT', 'b.solomon@glory.com.ph', 1),
(13, 'GP-23-822', 'Christian John Lopez', 'christian', '$2y$10$nmCI6u61p9v0oQc4ohREQewiWkYUoZI5mOpXsshB8zC4lHsFutZXq', 'nurse', 'ICT', 'cj.lopez@glory.com.ph', 1);

-- --------------------------------------------------------

--
-- Table structure for table `vaccination`
--

CREATE TABLE `vaccination` (
  `id` int(10) NOT NULL,
  `rfid` varchar(20) DEFAULT NULL,
  `vaccineType` varchar(20) DEFAULT NULL,
  `vaccineBrand` varchar(50) DEFAULT NULL,
  `firstDose` date DEFAULT NULL,
  `provider1` varchar(50) DEFAULT NULL,
  `secondDose` date DEFAULT NULL,
  `provider2` varchar(50) DEFAULT NULL,
  `thirdDose` date DEFAULT NULL,
  `provider3` varchar(50) DEFAULT NULL,
  `remarks` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `vaccination`
--

INSERT INTO `vaccination` (`id`, `rfid`, `vaccineType`, `vaccineBrand`, `firstDose`, `provider1`, `secondDose`, `provider2`, `thirdDose`, `provider3`, `remarks`) VALUES
(1, '0009727321', 'Hepa B', 'Hepatitis B', '2024-07-25', 'Olive Bugarin', '2024-08-25', 'Olive Bugarin', '2024-09-25', 'Olive Bugarin', 'Done 3rd dose'),
(2, '0009727321', 'Flu', 'Fluarix', '2024-07-25', 'Olive Bugarin', '0000-00-00', '', '0000-00-00', '', 'Vaccination completed'),
(3, '00048584956', 'Cervical', 'HPV', '2024-07-25', 'Olive Bugarin', '0000-00-00', '', '0000-00-00', '', 'Done 1st dose'),
(4, '00048584956', 'Hepa B', 'Hepatitis B', '2024-07-25', 'Olive Bugarin', '0000-00-00', '', '0000-00-00', '', ''),
(5, '00048584956', 'Flu', 'Fluarix', '2024-07-25', 'Olive Bugarin', '0000-00-00', '', '0000-00-00', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `annualphysicalexam`
--
ALTER TABLE `annualphysicalexam`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `consultation`
--
ALTER TABLE `consultation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `diagnosis`
--
ALTER TABLE `diagnosis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `emaillist`
--
ALTER TABLE `emaillist`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employeespersonalinfo`
--
ALTER TABLE `employeespersonalinfo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fittowork`
--
ALTER TABLE `fittowork`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `medicalcertificate`
--
ALTER TABLE `medicalcertificate`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pastmedicalhistory`
--
ALTER TABLE `pastmedicalhistory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `preemployment`
--
ALTER TABLE `preemployment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `queing`
--
ALTER TABLE `queing`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sender`
--
ALTER TABLE `sender`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vaccination`
--
ALTER TABLE `vaccination`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `annualphysicalexam`
--
ALTER TABLE `annualphysicalexam`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `consultation`
--
ALTER TABLE `consultation`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `diagnosis`
--
ALTER TABLE `diagnosis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `emaillist`
--
ALTER TABLE `emaillist`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `employeespersonalinfo`
--
ALTER TABLE `employeespersonalinfo`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `fittowork`
--
ALTER TABLE `fittowork`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `medicalcertificate`
--
ALTER TABLE `medicalcertificate`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `pastmedicalhistory`
--
ALTER TABLE `pastmedicalhistory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `preemployment`
--
ALTER TABLE `preemployment`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `queing`
--
ALTER TABLE `queing`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `sender`
--
ALTER TABLE `sender`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `vaccination`
--
ALTER TABLE `vaccination`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
