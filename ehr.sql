-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 03, 2024 at 09:06 AM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
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
  `othersRemarks` varchar(500) DEFAULT NULL,
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `consultation`
--

INSERT INTO `consultation` (`id`, `rfid`, `status`, `nurseAssisting`, `date`, `time`, `type`, `categories`, `building`, `chiefComplaint`, `diagnosis`, `intervention`, `clinicRestFrom`, `clinicRestTo`, `meds`, `medsQty`, `bloodChemistry`, `cbc`, `urinalysis`, `fecalysis`, `xray`, `others`, `bp`, `temp`, `02sat`, `pr`, `rr`, `remarks`, `medicalLab`, `medicationDispense`, `othersRemarks`, `statusComplete`, `withPendingLab`, `finalDx`, `ftwApproval`, `ftwDepartment`, `ftwCategories`, `ftwConfinement`, `ftwDateOfSickLeaveFrom`, `ftwDateOfSickLeaveTo`, `ftwDays`, `ftwReasonOfAbsence`, `ftwRemarks`) VALUES
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
(44, '00048584956', 'done', 'GP-23-781', '2024-07-03', '07:31 AM', 'Initial', 'common', 'GPI 1', 'sample of reason of absence', 'this', 'Medication Only', '', '', 'Diatabs(3), biogesic(1)', 1, '', '', '', '', '', '', '', '', '', '', '', 'Fit to Work', '', '', 'This is a nurse remarks', 1, '', 'This is a sample Final Dx', 'head', 'Administration', 'counted', 'Hospital Confinement', '2024-07-03', '2024-07-03', 0, 'sample of reason of absence', 'Fit to Work');

-- --------------------------------------------------------

--
-- Table structure for table `diagnosis`
--

CREATE TABLE `diagnosis` (
  `id` int(11) NOT NULL,
  `diagnosisName` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(12, 'this is a ');

-- --------------------------------------------------------

--
-- Table structure for table `emaillist`
--

CREATE TABLE `emaillist` (
  `id` int(10) NOT NULL,
  `name` varchar(60) DEFAULT NULL,
  `department` varchar(20) DEFAULT NULL,
  `email` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `rfidNumber` varchar(100) NOT NULL,
  `idNumber` varchar(20) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `age` int(2) NOT NULL,
  `sex` varchar(6) NOT NULL,
  `address` varchar(100) NOT NULL,
  `civilStatus` varchar(20) NOT NULL,
  `employer` varchar(100) NOT NULL,
  `department` varchar(50) NOT NULL,
  `secDept` varchar(50) NOT NULL,
  `position` varchar(50) NOT NULL,
  `dateHired` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employeespersonalinfo`
--

INSERT INTO `employeespersonalinfo` (`id`, `rfidNumber`, `idNumber`, `Name`, `age`, `sex`, `address`, `civilStatus`, `employer`, `department`, `secDept`, `position`, `dateHired`) VALUES
(1, '0012511458', 'gp-22-722', 'Cedrick James Orozo', 24, 'male', 'Palangue 2, Naic, Cavite', 'Single', 'GPI', 'Administration', 'MIS/Administration', 'Specialist', '04/06/2022'),
(2, '0013618307', 'cg-772-696', 'Mark Ely Aragon', 24, 'male', 'Rosario, Cavite', 'Married', 'Maxim', 'Administration', 'MIS/Administration', 'Technical Support', '09/05/2023'),
(3, '0009727321', 'cg-772-739', 'Yoshiyuki John Daganta', 24, 'male', 'Trece Martirez City, Cavite', 'Divorced', 'Maxim', 'Administration', 'MIS/Administration', 'Technical Support', '11/14/2023'),
(4, '0013572190', 'gp-17-571', 'Felmhar Vivo', 24, 'male', 'Rosario, Cavite', 'Single', 'GPI', 'Administration', 'MIS/Administration', 'Specialist', '04/06/2019'),
(5, '0008584232', 'cg-231-232', 'Raquel Morillo', 24, 'male', 'Palangue 2, Naic, Cavite', 'Single', 'Nippi', 'Administration', 'MIS/Administration', 'Specialist', '04/06/2022'),
(6, '0013612345', 'cg-772-123', 'Silene Oliveira', 24, 'male', 'Rosario, Cavite', 'Married', 'Powerlane', 'Administration', 'MIS/Administration', 'Technical Support', '09/05/2023'),
(7, '0009727323', 'cg-772-245', 'Andrés de Fonollosa', 24, 'male', 'Trece Martirez City, Cavite', 'Divorced', 'Otrelo', 'Administration', 'MIS/Administration', 'Technical Support', '11/14/2023'),
(8, '0013572123', 'gp-17-123', 'Sergio Marquina', 24, 'male', 'Rosario, Cavite', 'Single', 'Mangreat', 'Administration', 'MIS/Administration', 'Specialist', '04/06/2019'),
(9, '0009727367', 'cg-772-122', 'Ágata Jiménez', 24, 'male', 'Trece Martirez City, Cavite', 'Divorced', 'Alarm', 'Administration', 'MIS/Administration', 'Technical Support', '11/14/2023'),
(10, '0013721743', 'gp-17-149', 'Aníbal Cortés', 24, 'male', 'Rosario, Cavite', 'Single', 'Canteen', 'Administration', 'MIS/Administration', 'Specialist', '04/06/2019'),
(11, '04008584126', 'GP-24-578', 'Juan Dela Cruz', 24, 'male', '0233 Palangue 2, Naic, Cavite', 'single', 'GPI', 'Administration', 'MIS', 'Staff', '2024-02-26'),
(13, '00048584956', 'GP-24-548', 'Kevin Marero', 28, 'male', '0233 Palangue 2, Naic, Cavite', 'single', 'GPI', 'Administration', 'MIS ', 'Staff', '2024-02-26'),
(14, '0008282956', 'GP-24-748', 'Aileen Domo', 28, 'female', '0233 Palangue 2, Naic, Cavite', 'single', 'GPI', 'Administration', 'MIS ', 'Staff', '2024-02-29'),
(17, '0010068629', 'GP-23-781', 'Janella Francisco', 24, 'male', 'sldkfhslkdjfh', 'single', 'GPI', 'Administration', 'Health Benefits', 'Nurse', '2023-06-13'),
(18, '0012521874', 'GP-23-822', 'Christian John Lopez', 25, 'M', 'Metrogate Tanza Cavite', 'Signle', 'GPI', 'Administration', 'Information System', 'Specialist', '6-Dec-23');

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
  `othersRemarks` varchar(500) DEFAULT NULL,
  `statusComplete` tinyint(1) DEFAULT NULL,
  `withPedingLab` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `fittowork`
--

INSERT INTO `fittowork` (`id`, `approval`, `department`, `rfid`, `date`, `time`, `categories`, `building`, `confinementType`, `medicalCategory`, `medicine`, `fromDateOfSickLeave`, `toDateOfSickLeave`, `days`, `reasonOfAbsence`, `diagnosis`, `bloodChemistry`, `cbc`, `urinalysis`, `fecalysis`, `xray`, `others`, `bp`, `temp`, `02sat`, `pr`, `rr`, `remarks`, `othersRemarks`, `statusComplete`, `withPedingLab`) VALUES
(36, 'head', 'Administration', '0012511458', '2024-05-21', '10:26 AM', 'common', 'GPI 1', 'Hospital Confinement', 'counted', NULL, '2024-05-21', '2024-05-21', 0, 'LBM', 'IMS', '', '', '', '', '', '', '', '', '', '', '', 'Fit to Work', 'This is a nurse others remarks', 1, ''),
(37, 'head', 'Administration', '0012521874', '2024-06-04', '12:41 PM', 'counted', 'GPI1', 'Hospital Confinement', 'Common', 'Diatabs(1)', '2024-06-04', '2024-06-04', 1, 'LBM', 'IMS', '', '', '', '', '', '', '', '', '', '', '', 'Fit to Work', '', 1, ''),
(38, 'head', 'Administration', '0012511458', '2024-05-21', '09:52 AM', 'common', 'GPI 1', 'Home Confinement', 'counted', NULL, '2024-05-17', '2024-05-17', 1, 'LBM', 'IMS', '', '', '', '', '', '', '', '', '', '', '', 'Fit to Work', 'This is a nurse remarks', 1, ''),
(39, 'head', 'Administration', '0012521874', '2024-06-04', '12:52 PM', 'common', 'GPI 1', 'Hospital Confinement', 'counted', NULL, '2024-06-04', '2024-06-04', 0, '', 'IMS', '', '', '', '', '', '', '', '', '', '', '', 'Fit to Work', 'Rest for 1 week', 1, ''),
(40, 'head', 'Administration', '0012521874', '2024-06-25', '09:42 AM', 'common', 'GPI 1', 'Home Confinement', 'notCounted', NULL, '2024-06-25', '2024-06-25', 1, 'Severe Headache', '', 'abc', 'def', 'ghi', 'jkl', 'mno', 'pwr', 'stu', 'vwx', 'yz', '12', '3', 'Fit to Work', 'Rest for 1 week', 1, ''),
(41, 'head', 'Administration', '0012521874', '2024-06-25', '12:24 PM', 'common', 'GPI 1', 'Home Confinement', 'counted', NULL, '2024-06-25', '2024-06-25', 1, 'Severe Headache', 'diagnosis2', '123', '456', '789', '10 11 12', 'n/a', 'n/a', '110/80', '36.5', '233', 'n/a', '3', 'Fit to Work', 'Rest for 1 week', 1, ''),
(42, 'head', 'Administration', '0012511458', '2024-06-24', '08:58 AM', 'Work Related', 'GPI 1', 'Hospital Confinement', 'counted', NULL, '2024-06-25', '2024-06-25', 1, 'Severe Headache', 'Stress', '', '', '', '', '', '', '', '', '', '', '', 'Fit to Work', 'Rest', 1, ''),
(44, 'head', 'Administration', '0013572190', '2024-06-25', '01:03 PM', 'notCounted', 'GPI 1', 'Home Confinement', 'Long Term', 'asda(1)', '2024-06-25', '2024-06-25', 0, 'Severe Headache', 'diagnosis2', '', '', '', '', '', '', '', '', '', '', '', 'Fit to Work', 'Rest for 1 week', 1, ''),
(45, 'head', 'Administration', '00048584956', '2024-07-03', '07:31 AM', 'counted', 'GPI 1', 'Hospital Confinement', 'common', 'Diatabs(3), biogesic(1)', '2024-07-03', '2024-07-03', 1, 'sample of reason of absence', 'this', '', '', '', '', '', '', '', '', '', '', '', 'Fit to Work', 'This is a nurse remarks', 1, '');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pastmedicalhistory`
--

INSERT INTO `pastmedicalhistory` (`id`, `rfidNumber`, `smoking`, `drugs`, `alcohol`, `asthma`, `ptb`, `diabetes`, `heartDisease`, `hpn`, `renalDisease`, `othersFH`, `pastAndPresentMedHistory`, `far`, `near`, `adequate`, `inadequate`, `surgicalHistory`, `presentMedication`, `allergies`, `intervalMH`, `duration`, `flow`, `menorrhagia`, `metrorrhagia`, `amenorrhea`, `dysmenorrhea`, `gravida`, `para`, `termBirth`, `livingChildren`, `preTermBirth`, `abortion`, `multiplePregnancies`) VALUES
(1, '0008584956', 0, 0, 1, 0, 0, 1, 1, 0, 1, '', '(+) Vehicular Accident - 2022\r\nFam Hx.: (+) DM II - Fathers side', '40/50', '20/20', 0, 1, '(+) NSD - G3P2 - 2006     (+) Appendectomy - 2009', 'Mefenamic Acid 500mg', 'NKA', '28-30 days', '5-7 days', 'Heavy', 1, 0, 1, 1, '3', '3', '3', '3', '0', '0', '0'),
(2, '0013618307', 1, 1, 1, 1, 1, 1, 1, 1, 1, 'zsd', '(+) Vehicular Accident - 2022\r\nFam Hx.: (+) DM II - Fathers side1', '40/501', '20/201', 0, 1, '(+) NSD - G3P2 - 2006     (+) Appendectomy - 20091', 'Mefenamic Acid 500mg1', 'NKA1', '28-30 days1', '5-7 days1', 'Heavy1', 1, 1, 1, 1, '31', '31', '31', '31', '01', '01', '01'),
(3, '0012521874', 1, 0, 0, 0, 0, 0, 1, 0, 1, '', '(+) Vehicular Accident - 2022\r\nFam Hx.: (+) DM II - Fathers side', '40/50', '20/20', 0, 1, '(+) NSD - G3P2 - 2006     (+) Appendectomy - 2009', 'Mefenamic Acid 500mg', 'NKA', '', '', '', 0, 0, 0, 0, '', '', '', '', '', '', '');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `queing`
--

INSERT INTO `queing` (`id`, `rfidNumber`, `status`, `nurseAssisting`, `date`) VALUES
(2, '0013618307', 'done', 'GP-23-781', ''),
(3, '0009727321', 'done', 'GP-23-781', ''),
(17, '0008584956', 'processing', 'GP-23-781', ''),
(18, '0010068629', 'done', 'GP-23-781', ''),
(20, '0012511458', 'done', 'GP-23-781', ''),
(26, '0012521874', 'done', 'GP-23-781', ''),
(27, '0013572190', 'processing', 'GP-23-781', ''),
(29, '0012511458', 'processing', 'GP-23-781', ''),
(30, '00048584956', 'processing', 'GP-23-781', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sender`
--

CREATE TABLE `sender` (
  `id` int(11) NOT NULL,
  `email` varchar(30) DEFAULT NULL,
  `password` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `password` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL,
  `department` varchar(50) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(7, 'GP-23-783', 'Olive Bugarin', 'Olive', '$2y$10$P24ON3qHXn5cII02KAk5AOLpVICrmkoabyF36oMF6AiQI9t5on9re', 'nurse', 'Administration', 'o.bugarin@glory.com.ph', 0),
(10, 'GP-23-783', 'olive bugarin', 'olive', '$2y$10$P24ON3qHXn5cII02KAk5AOLpVICrmkoabyF36oMF6AiQI9t5on9re', 'nurse', 'ICT', 'o.bugarin@glory.com.ph', 1);

--
-- Indexes for dumped tables
--

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `consultation`
--
ALTER TABLE `consultation`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `diagnosis`
--
ALTER TABLE `diagnosis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `emaillist`
--
ALTER TABLE `emaillist`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `employeespersonalinfo`
--
ALTER TABLE `employeespersonalinfo`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `fittowork`
--
ALTER TABLE `fittowork`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `medicalcertificate`
--
ALTER TABLE `medicalcertificate`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `pastmedicalhistory`
--
ALTER TABLE `pastmedicalhistory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `queing`
--
ALTER TABLE `queing`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `sender`
--
ALTER TABLE `sender`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
