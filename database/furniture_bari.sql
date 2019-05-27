-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 27, 2019 at 04:41 AM
-- Server version: 5.7.24
-- PHP Version: 7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `furniture_bari`
--

-- --------------------------------------------------------

--
-- Table structure for table `ji_accounts`
--

DROP TABLE IF EXISTS `ji_accounts`;
CREATE TABLE IF NOT EXISTS `ji_accounts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` varchar(255) NOT NULL,
  `account_name` varchar(255) NOT NULL,
  `access_type` varchar(255) NOT NULL,
  `account_category` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ji_accounts`
--

INSERT INTO `ji_accounts` (`id`, `date`, `account_name`, `access_type`, `account_category`) VALUES
(33, '10/08/2017', 'Bank (FB)', '1', 1),
(34, '10/08/2017', 'Cash In MDP', '4', 2),
(35, '10/08/2017', 'Bkash', '1', 2),
(36, '10/08/2017', 'Cash In Mirpur', '2', 2),
(37, '10/08/2017', 'Cash In Factory', '3', 2),
(38, '08/04/2018', 'Cash On MD', '1', 2),
(39, '08/04/2018', 'DBBL', '1', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ji_account_balance_reports`
--

DROP TABLE IF EXISTS `ji_account_balance_reports`;
CREATE TABLE IF NOT EXISTS `ji_account_balance_reports` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `account_name` varchar(255) NOT NULL,
  `ji_purchase_pay_bill_id` int(10) NOT NULL,
  `ji_worker_pay_bill_id` int(10) NOT NULL,
  `sales` varchar(255) NOT NULL,
  `service` varchar(255) NOT NULL,
  `invest_adjustment` varchar(255) NOT NULL,
  `bank_transfer_incoming` varchar(255) NOT NULL,
  `cash_transfer_incoming` varchar(255) NOT NULL,
  `bank_transfer_outgoing` varchar(255) NOT NULL,
  `cash_transfer_outgoing` varchar(255) NOT NULL,
  `expense` varchar(255) NOT NULL,
  `cash_purchase` varchar(255) NOT NULL,
  `vendor_pay` varchar(255) NOT NULL,
  `worker_pay` varchar(255) NOT NULL,
  `withdraw_adjustment` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=67 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ji_account_balance_reports`
--

INSERT INTO `ji_account_balance_reports` (`id`, `date`, `account_name`, `ji_purchase_pay_bill_id`, `ji_worker_pay_bill_id`, `sales`, `service`, `invest_adjustment`, `bank_transfer_incoming`, `cash_transfer_incoming`, `bank_transfer_outgoing`, `cash_transfer_outgoing`, `expense`, `cash_purchase`, `vendor_pay`, `worker_pay`, `withdraw_adjustment`) VALUES
(3, '2018-05-21', 'Bank (FB)', 0, 0, '', '', '3000', '', '', '', '', '', '', '', '', ''),
(4, '2018-05-21', 'Cash In Factory', 0, 0, '', '2500', '', '', '', '', '', '', '', '', '', ''),
(7, '2018-05-21', 'Bank (FB)', 0, 0, '', '', '', '2500', '', '', '', '', '', '', '', ''),
(8, '2018-05-21', 'Bkash', 0, 0, '', '', '', '', '1200', '', '', '', '', '', '', ''),
(9, '2018-05-21', 'Bank (FB)', 0, 0, '1000', '', '', '', '', '', '', '', '', '', '', ''),
(10, '2018-05-21', 'Bkash', 0, 0, '2500', '', '', '', '', '', '', '', '', '', '', ''),
(11, '2018-05-29', 'Bank (FB)', 0, 0, '', '', '', '', '', '', '', '', '1000', '', '', ''),
(12, '2018-05-29', 'Bank (FB)', 0, 0, '', '', '', '', '', '', '', '', '', '', '500', ''),
(16, '2018-05-29', 'Bank (FB)', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '450'),
(17, '2018-05-29', 'Cash In MDP', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '1500'),
(18, '2018-05-29', 'Cash In Mirpur', 0, 0, '', '', '', '', '', '', '', '12000', '', '', '', ''),
(19, '2018-05-29', 'Cash In Mirpur', 0, 0, '', '', '', '', '', '', '', '250', '', '', '', ''),
(20, '2018-06-05', 'Bank (FB)', 0, 0, '', '', '5000', '', '', '', '', '', '', '', '', ''),
(21, '2018-06-05', 'Bank (FB)', 0, 0, '', '', '', '5000', '', '', '', '', '', '', '', ''),
(22, '2018-06-05', 'Bank (FB)', 0, 0, '', '', '', '2000', '', '', '', '', '', '', '', ''),
(23, '2018-06-05', 'Bank (FB)', 0, 0, '', '', '', '3000', '', '', '', '', '', '', '', ''),
(24, '2018-06-05', 'Bank (FB)', 0, 0, '', '', '', '1500', '', '', '', '', '', '', '', ''),
(25, '2018-06-05', 'Cash In MDP', 0, 0, '', '', '', '1500', '', '', '', '', '', '', '', ''),
(26, '2018-06-05', 'Bank (FB)', 0, 0, '', '', '', '500', '', '', '', '', '', '', '', ''),
(27, '2018-06-05', 'Cash In MDP', 0, 0, '', '', '', '500', '', '', '', '', '', '', '', ''),
(28, '2018-06-25', 'Bank (FB)', 0, 0, '', '', '', '1500', '', '', '', '', '', '', '', ''),
(29, '2018-06-25', 'Cash In Mirpur', 0, 0, '', '', '', '1500', '', '', '', '', '', '', '', ''),
(30, '2018-06-25', 'Cash In Factory', 0, 0, '', '', '5000', '', '', '', '', '', '', '', '', ''),
(31, '2018-06-25', 'Cash In Factory', 0, 0, '', '', '5000', '', '', '', '', '', '', '', '', ''),
(32, '2018-06-25', 'Bank (FB)', 0, 0, '', '', '10000', '', '', '', '', '', '', '', '', ''),
(33, '2018-06-25', 'Bank (FB)', 0, 0, '', '', '10000', '', '', '', '', '', '', '', '', ''),
(34, '2018-06-25', 'Cash In Mirpur', 0, 0, '500', '', '', '', '', '', '', '', '', '', '', ''),
(35, '2018-06-25', 'Bkash', 0, 0, '1500', '', '', '', '', '', '', '', '', '', '', ''),
(36, '2018-06-25', 'Bkash', 0, 0, '1500', '', '', '', '', '', '', '', '', '', '', ''),
(37, '2018-06-25', 'Cash In Mirpur', 0, 0, '500', '', '', '', '', '', '', '', '', '', '', ''),
(38, '2018-06-25', 'Cash In Mirpur', 0, 0, '500', '', '', '', '', '', '', '', '', '', '', ''),
(39, '2018-06-25', 'Cash In Mirpur', 0, 0, '500', '', '', '', '', '', '', '', '', '', '', ''),
(40, '2018-06-25', 'Bkash', 0, 0, '1500', '', '', '', '', '', '', '', '', '', '', ''),
(41, '2018-06-25', 'Cash In Mirpur', 0, 0, '1500', '', '', '', '', '', '', '', '', '', '', ''),
(42, '2018-06-25', 'Cash In Mirpur', 0, 0, '1500', '', '', '', '', '', '', '', '', '', '', ''),
(43, '2018-06-25', 'Cash In Factory', 0, 0, '5000', '', '', '', '', '', '', '', '', '', '', ''),
(44, '2018-06-25', 'Cash In Factory', 0, 0, '', '1500', '', '', '', '', '', '', '', '', '', ''),
(45, '2018-06-25', 'Bank (FB)', 0, 0, '', '', '', '500', '', '', '', '', '', '', '', ''),
(46, '2018-06-25', 'Cash In Factory', 0, 0, '', '', '', '500', '', '', '', '', '', '', '', ''),
(47, '2018-06-25', 'Bank (FB)', 0, 0, '', '', '', '2500', '', '', '', '', '', '', '', ''),
(48, '2018-06-25', 'Cash In Factory', 0, 0, '', '', '', '2500', '', '', '', '', '', '', '', ''),
(49, '2018-06-25', 'Cash In MDP', 0, 0, '', '', '', '', '500', '', '', '', '', '', '', ''),
(50, '2018-06-25', 'Cash In Factory', 0, 0, '', '', '', '', '500', '', '', '', '', '', '', ''),
(51, '2018-06-25', 'Cash In Factory', 0, 0, '', '', '5000', '', '', '', '', '', '', '', '', ''),
(52, '2018-06-25', 'Cash In Factory', 0, 0, '', '', '1000', '', '', '', '', '', '', '', '', ''),
(53, '2018-06-25', 'Cash In Factory', 0, 0, '', '', '', '', '', '', '', '2000', '', '', '', ''),
(54, '2018-06-25', 'Cash In Factory', 0, 0, '', '', '', '', '', '', '', '', '', '', '500', ''),
(55, '2018-06-25', 'Cash In Factory', 0, 0, '', '', '', '', '1500', '', '', '', '', '', '', ''),
(56, '2018-06-25', 'Cash In Mirpur', 0, 0, '', '', '', '', '1500', '', '', '', '', '', '', ''),
(57, '2018-06-26', 'Bank (FB)', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '5200'),
(58, '2018-08-04', 'Cash On MD', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '50000'),
(59, '2018-08-04', 'Cash In Factory', 0, 0, '', '', '', '', '', '', '5000', '', '', '', '', ''),
(60, '2018-08-04', 'Cash In Mirpur', 0, 0, '', '', '', '', '5000', '', '', '', '', '', '', ''),
(61, '2018-08-11', 'Cash In Mirpur', 0, 0, '', '', '', '', '', '', '', '5000', '', '', '', ''),
(62, '2018-08-27', 'Cash In Mirpur', 0, 0, '', '', '', '', '', '', '', '', '', '500', '', ''),
(63, '2018-08-27', 'Cash In Mirpur', 0, 0, '', '', '', '', '', '', '', '', '500', '', '', ''),
(64, '2018-08-27', 'Cash In Mirpur', 49, 0, '', '', '', '', '', '', '', '', '1500', '', '', ''),
(65, '2018-08-27', 'Cash In Factory', 0, 37, '', '', '', '', '', '', '', '', '', '', '1000', ''),
(66, '2018-12-08', 'Bank (FB)', 0, 0, '30000', '', '', '', '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `ji_account_cash_inflow`
--

DROP TABLE IF EXISTS `ji_account_cash_inflow`;
CREATE TABLE IF NOT EXISTS `ji_account_cash_inflow` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ji_user_id` int(11) NOT NULL,
  `date` varchar(255) NOT NULL,
  `payment_type` varchar(255) NOT NULL,
  `reference_no` varchar(255) NOT NULL,
  `amount` varchar(255) NOT NULL,
  `account_name` varchar(255) NOT NULL,
  `remark` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ji_account_cash_inflow`
--

INSERT INTO `ji_account_cash_inflow` (`id`, `ji_user_id`, `date`, `payment_type`, `reference_no`, `amount`, `account_name`, `remark`) VALUES
(5, 0, '04/08/2017', 'Cash', 'Invest', '30000', 'Factory Balance', 'Showroom'),
(6, 0, '06/08/2017', 'Cash', 'Invest', '21000', 'Factory Balance', 'Jikrul'),
(7, 0, '05/08/2017', 'Cash', 'Invest', '15000', 'Factory Balance', 'Jikrul'),
(8, 0, '04/08/2017', 'Cash', 'Invest', '30000', 'Factory Balance', 'Masum'),
(9, 0, '08/17/2017', 'Cash', 'Invest', '4000', 'Factory Balance', ''),
(10, 1, '03/28/2018', 'Cash', 'Invest', '200000', 'Bank (FB)', 'test'),
(11, 1, '05/15/2018', 'Cash', 'Invest', '50000', 'Cash In Mirpur', 'test'),
(12, 1, '05/15/2018', 'Cash', 'Invest', '2500', 'Bank (FB)', ''),
(13, 1, '05/15/2018', 'Cash', 'Invest', '2500', 'Bank (FB)', ''),
(14, 1, '05/15/2018', 'Cash', 'Invest', '25000', 'Cash In Mirpur', 'test'),
(15, 1, '05/21/2018', 'Cash', 'Invest', '3000', 'Bank (FB)', 'test'),
(16, 1, '05/21/2018', 'Cash', 'Service', '2500', 'Cash In Factory', 'test'),
(17, 1, '06/05/2018', 'Cash', 'Invest', '5000', 'Bank (FB)', 'test'),
(18, 1, '06/25/2018', 'Cash', 'Invest', '5000', 'Cash In Factory', 'test'),
(19, 1, '06/25/2018', 'Cash', 'Invest', '5000', 'Cash In Factory', 'test'),
(20, 1, '06/25/2018', 'Cash', 'Invest', '10000', 'Bank (FB)', 'test'),
(21, 1, '06/25/2018', 'Cash', 'Invest', '10000', 'Bank (FB)', 'test'),
(22, 1, '06/25/2018', 'Cash', 'Service', '1500', 'Cash In Factory', 'test'),
(23, 1, '06/25/2018', 'Cash', 'Invest', '5000', 'Cash In Factory', 'test'),
(24, 1, '06/25/2018', 'Cash', 'Adjustment', '1000', 'Cash In Factory', 'test'),
(25, 1, '06/26/2018', 'Cash', 'Adjustment', '-5200', 'Bank (FB)', '');

-- --------------------------------------------------------

--
-- Table structure for table `ji_account_day_end`
--

DROP TABLE IF EXISTS `ji_account_day_end`;
CREATE TABLE IF NOT EXISTS `ji_account_day_end` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `ji_account_report_id` int(11) NOT NULL,
  `amount` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ji_account_incoming_reports`
--

DROP TABLE IF EXISTS `ji_account_incoming_reports`;
CREATE TABLE IF NOT EXISTS `ji_account_incoming_reports` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `ji_payment_id` int(11) NOT NULL,
  `ji_account_cash_inflow_id` int(11) NOT NULL,
  `BankFB` varchar(255) DEFAULT NULL,
  `CashInMDP` varchar(255) DEFAULT NULL,
  `Bkash` varchar(255) DEFAULT NULL,
  `CashInMirpur` varchar(255) DEFAULT NULL,
  `CashInFactory` varchar(255) DEFAULT NULL,
  `CashOnMD` varchar(255) DEFAULT NULL,
  `DBBL` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=85 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ji_account_incoming_reports`
--

INSERT INTO `ji_account_incoming_reports` (`id`, `date`, `ji_payment_id`, `ji_account_cash_inflow_id`, `BankFB`, `CashInMDP`, `Bkash`, `CashInMirpur`, `CashInFactory`, `CashOnMD`, `DBBL`) VALUES
(1, '2017-11-28', 0, 0, NULL, NULL, '1500', NULL, NULL, NULL, NULL),
(2, '2017-12-17', 0, 0, NULL, NULL, NULL, '2000', NULL, NULL, NULL),
(3, '2018-01-02', 457, 0, '30000', NULL, NULL, NULL, NULL, NULL, NULL),
(4, '2018-01-02', 458, 0, NULL, NULL, '15000', NULL, NULL, NULL, NULL),
(6, '2018-03-27', 0, 0, NULL, NULL, NULL, '12000', NULL, NULL, NULL),
(7, '2018-03-28', 0, 0, NULL, NULL, NULL, '10000', NULL, NULL, NULL),
(8, '2018-03-28', 0, 0, NULL, NULL, NULL, '5000', NULL, NULL, NULL),
(10, '2018-03-28', 0, 10, '200000', NULL, NULL, NULL, NULL, NULL, NULL),
(11, '2018-03-20', 459, 0, NULL, NULL, NULL, '30000', NULL, NULL, NULL),
(12, '2018-03-29', 0, 0, NULL, NULL, NULL, '2000', NULL, NULL, NULL),
(13, '2018-04-24', 0, 0, NULL, '2500', NULL, NULL, NULL, NULL, NULL),
(14, '2018-05-15', 460, 0, '5500', NULL, NULL, NULL, NULL, NULL, NULL),
(15, '2018-05-15', 461, 0, '5500', NULL, NULL, NULL, NULL, NULL, NULL),
(16, '2018-05-15', 462, 0, '2500', NULL, NULL, NULL, NULL, NULL, NULL),
(17, '2018-05-15', 463, 0, '12500', NULL, NULL, NULL, NULL, NULL, NULL),
(18, '2018-05-15', 464, 0, '35000', NULL, NULL, NULL, NULL, NULL, NULL),
(19, '2018-05-15', 465, 0, NULL, NULL, NULL, NULL, '25000', NULL, NULL),
(20, '2018-05-15', 466, 0, NULL, NULL, '5000', NULL, NULL, NULL, NULL),
(21, '2018-05-15', 467, 0, NULL, NULL, '5000', NULL, NULL, NULL, NULL),
(22, '2018-05-15', 0, 11, NULL, NULL, NULL, '50000', NULL, NULL, NULL),
(23, '2018-05-15', 0, 12, '2500', NULL, NULL, NULL, NULL, NULL, NULL),
(24, '2018-05-15', 0, 13, '2500', NULL, NULL, NULL, NULL, NULL, NULL),
(25, '2018-05-15', 0, 14, NULL, NULL, NULL, '25000', NULL, NULL, NULL),
(26, '2018-05-15', 0, 0, NULL, NULL, '1230', NULL, NULL, NULL, NULL),
(27, '2018-05-15', 0, 0, NULL, NULL, '1230', NULL, NULL, NULL, NULL),
(28, '2018-05-15', 0, 0, NULL, NULL, '1230', NULL, NULL, NULL, NULL),
(29, '2018-05-15', 0, 0, NULL, NULL, NULL, '2500', NULL, NULL, NULL),
(30, '2018-05-15', 0, 0, NULL, NULL, NULL, '2500', NULL, NULL, NULL),
(31, '2018-05-15', 0, 0, '4500', NULL, NULL, NULL, NULL, NULL, NULL),
(32, '2018-05-15', 468, 0, NULL, NULL, '2500', NULL, NULL, NULL, NULL),
(33, '2018-05-21', 469, 0, '1500', NULL, NULL, NULL, NULL, NULL, NULL),
(36, '2018-05-21', 470, 0, NULL, NULL, '3000', NULL, NULL, NULL, NULL),
(37, '2018-05-21', 471, 0, '2000', NULL, NULL, NULL, NULL, NULL, NULL),
(38, '2018-05-21', 472, 0, '2500', NULL, NULL, NULL, NULL, NULL, NULL),
(39, '2018-05-21', 473, 0, NULL, NULL, '3500', NULL, NULL, NULL, NULL),
(40, '2018-05-21', 474, 0, '5000', NULL, NULL, NULL, NULL, NULL, NULL),
(41, '2018-05-21', 0, 15, '3000', NULL, NULL, NULL, NULL, NULL, NULL),
(42, '2018-05-21', 0, 16, NULL, NULL, NULL, NULL, '2500', NULL, NULL),
(43, '2018-05-21', 0, 0, NULL, NULL, NULL, '12000', NULL, NULL, NULL),
(44, '2018-05-21', 0, 0, NULL, NULL, NULL, NULL, '5000', NULL, NULL),
(45, '2018-05-21', 0, 0, NULL, NULL, '2500', NULL, NULL, NULL, NULL),
(46, '2018-05-21', 0, 0, NULL, NULL, '1200', NULL, NULL, NULL, NULL),
(47, '2018-05-21', 0, 0, '100', NULL, NULL, NULL, NULL, NULL, NULL),
(48, '2018-05-21', 475, 0, '1000', NULL, NULL, NULL, NULL, NULL, NULL),
(49, '2018-05-21', 476, 0, NULL, NULL, '2500', NULL, NULL, NULL, NULL),
(50, '2018-06-05', 0, 17, '5000', NULL, NULL, NULL, NULL, NULL, NULL),
(51, '2018-06-05', 0, 0, NULL, '5000', NULL, NULL, NULL, NULL, NULL),
(52, '2018-06-05', 0, 0, NULL, '2000', NULL, NULL, NULL, NULL, NULL),
(53, '2018-06-05', 0, 0, NULL, '3000', NULL, NULL, NULL, NULL, NULL),
(54, '2018-06-05', 0, 0, NULL, '1500', NULL, NULL, NULL, NULL, NULL),
(55, '2018-06-05', 0, 0, NULL, '500', NULL, NULL, NULL, NULL, NULL),
(56, '2018-06-25', 0, 0, NULL, NULL, NULL, '1500', NULL, NULL, NULL),
(57, '2018-06-25', 0, 18, NULL, NULL, NULL, NULL, '5000', NULL, NULL),
(58, '2018-06-25', 0, 19, NULL, NULL, NULL, NULL, '5000', NULL, NULL),
(59, '2018-06-25', 0, 20, '10000', NULL, NULL, NULL, NULL, NULL, NULL),
(60, '2018-06-25', 0, 21, '10000', NULL, NULL, NULL, NULL, NULL, NULL),
(61, '2018-06-25', 477, 0, NULL, NULL, NULL, '500', NULL, NULL, NULL),
(62, '2018-06-25', 478, 0, NULL, NULL, '1500', NULL, NULL, NULL, NULL),
(63, '2018-06-25', 479, 0, NULL, NULL, '1500', NULL, NULL, NULL, NULL),
(64, '2018-06-25', 480, 0, NULL, NULL, NULL, '500', NULL, NULL, NULL),
(65, '2018-06-25', 481, 0, NULL, NULL, NULL, '500', NULL, NULL, NULL),
(66, '2018-06-25', 482, 0, NULL, NULL, NULL, '500', NULL, NULL, NULL),
(67, '2018-06-25', 483, 0, NULL, NULL, '1500', NULL, NULL, NULL, NULL),
(68, '2018-06-25', 484, 0, NULL, NULL, NULL, '1500', NULL, NULL, NULL),
(71, '2018-06-25', 0, 22, NULL, NULL, NULL, NULL, '1500', NULL, NULL),
(72, '2018-06-25', 0, 0, NULL, NULL, NULL, NULL, '500', NULL, NULL),
(73, '2018-06-25', 0, 0, NULL, NULL, NULL, NULL, '2500', NULL, NULL),
(74, '2018-06-25', 0, 0, NULL, NULL, NULL, NULL, '500', NULL, NULL),
(75, '2018-06-25', 0, 23, NULL, NULL, NULL, NULL, '5000', NULL, NULL),
(76, '2018-06-25', 0, 0, NULL, NULL, NULL, '1500', NULL, NULL, NULL),
(79, '2018-08-04', 0, 0, NULL, NULL, NULL, '5000', NULL, NULL, NULL),
(80, '2018-06-25', 486, 0, NULL, NULL, NULL, NULL, '5000', NULL, NULL),
(81, '2018-06-25', 485, 0, NULL, NULL, NULL, '1500', NULL, NULL, NULL),
(84, '2018-12-08', 487, 0, '50000', NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ji_account_outgoing_reports`
--

DROP TABLE IF EXISTS `ji_account_outgoing_reports`;
CREATE TABLE IF NOT EXISTS `ji_account_outgoing_reports` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `ji_purchase_pay_bill_id` int(11) NOT NULL,
  `ji_worker_pay_bill_id` int(11) NOT NULL,
  `ji_new_expanse_details_id` int(11) NOT NULL,
  `BankFB` varchar(255) DEFAULT NULL,
  `CashInMDP` varchar(255) DEFAULT NULL,
  `Bkash` varchar(255) DEFAULT NULL,
  `CashInMirpur` varchar(255) DEFAULT NULL,
  `CashInFactory` varchar(255) DEFAULT NULL,
  `CashOnMD` varchar(255) DEFAULT NULL,
  `DBBL` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=125 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ji_account_outgoing_reports`
--

INSERT INTO `ji_account_outgoing_reports` (`id`, `date`, `ji_purchase_pay_bill_id`, `ji_worker_pay_bill_id`, `ji_new_expanse_details_id`, `BankFB`, `CashInMDP`, `Bkash`, `CashInMirpur`, `CashInFactory`, `CashOnMD`, `DBBL`) VALUES
(1, '2017-11-28', 0, 0, 0, NULL, '1500', NULL, NULL, NULL, NULL, NULL),
(2, '2017-12-05', 0, 26, 0, NULL, NULL, NULL, '3000', NULL, NULL, NULL),
(3, '2017-12-05', 0, 0, 233, '1500', NULL, NULL, NULL, NULL, NULL, NULL),
(4, '2017-12-05', 0, 0, 234, NULL, NULL, NULL, NULL, '12000', NULL, NULL),
(17, '2017-12-05', 0, 0, 247, NULL, NULL, NULL, '2000', NULL, NULL, NULL),
(18, '2017-12-05', 0, 0, 248, NULL, NULL, NULL, '12000', NULL, NULL, NULL),
(25, '2017-12-17', 0, 0, 0, '2000', NULL, NULL, NULL, NULL, NULL, NULL),
(29, '2018-01-16', 0, 0, 258, NULL, NULL, NULL, '25000', NULL, NULL, NULL),
(31, '2018-01-16', 0, 0, 260, NULL, '2500', NULL, NULL, NULL, NULL, NULL),
(33, '2018-01-30', 0, 27, 0, NULL, NULL, NULL, NULL, '3500', NULL, NULL),
(34, '2018-01-30', 0, 28, 0, NULL, NULL, NULL, NULL, '5000', NULL, NULL),
(35, '2018-01-30', 0, 29, 0, NULL, NULL, NULL, NULL, '1470', NULL, NULL),
(36, '2018-01-30', 0, 30, 0, NULL, NULL, NULL, NULL, '2000', NULL, NULL),
(37, '2018-02-19', 0, 31, 0, NULL, NULL, NULL, NULL, '3000', NULL, NULL),
(38, '2018-02-19', 0, 32, 0, NULL, NULL, NULL, NULL, '3000', NULL, NULL),
(39, '2018-03-27', 0, 0, 0, '12000', NULL, NULL, NULL, NULL, NULL, NULL),
(40, '2018-03-28', 0, 0, 0, '10000', NULL, NULL, NULL, NULL, NULL, NULL),
(41, '2018-03-28', 0, 0, 0, '5000', NULL, NULL, NULL, NULL, NULL, NULL),
(44, '2018-03-29', 0, 0, 0, '2000', NULL, NULL, NULL, NULL, NULL, NULL),
(45, '2018-04-24', 0, 33, 0, NULL, NULL, NULL, NULL, '5000', NULL, NULL),
(46, '2018-04-24', 0, 0, 0, '2500', NULL, NULL, NULL, NULL, NULL, NULL),
(47, '2018-04-30', 0, 34, 0, '7200', NULL, NULL, NULL, NULL, NULL, NULL),
(48, '2018-05-15', 0, 0, 0, '1230', NULL, NULL, NULL, NULL, NULL, NULL),
(49, '2018-05-15', 0, 0, 0, '1230', NULL, NULL, NULL, NULL, NULL, NULL),
(50, '2018-05-15', 0, 0, 0, '1230', NULL, NULL, NULL, NULL, NULL, NULL),
(51, '2018-05-15', 0, 0, 0, '2500', NULL, NULL, NULL, NULL, NULL, NULL),
(52, '2018-05-15', 0, 0, 0, '2500', NULL, NULL, NULL, NULL, NULL, NULL),
(53, '2018-05-15', 0, 0, 0, NULL, '4500', NULL, NULL, NULL, NULL, NULL),
(54, '2018-05-21', 0, 0, 0, '12000', NULL, NULL, NULL, NULL, NULL, NULL),
(55, '2018-05-21', 0, 0, 0, '5000', NULL, NULL, NULL, NULL, NULL, NULL),
(56, '2018-05-21', 0, 0, 0, '2500', NULL, NULL, NULL, NULL, NULL, NULL),
(57, '2018-05-21', 0, 0, 0, NULL, NULL, NULL, '1200', NULL, NULL, NULL),
(58, '2018-05-21', 0, 0, 0, NULL, NULL, NULL, '100', NULL, NULL, NULL),
(59, '2018-05-29', 46, 0, 0, '1000', NULL, NULL, NULL, NULL, NULL, NULL),
(60, '2018-05-29', 0, 35, 0, '500', NULL, NULL, NULL, NULL, NULL, NULL),
(61, '2018-05-29', 0, 0, 0, NULL, '1500', NULL, NULL, NULL, NULL, NULL),
(67, '2018-05-29', 0, 0, 268, NULL, NULL, NULL, '250', NULL, NULL, NULL),
(68, '2018-05-29', 0, 0, 269, NULL, NULL, NULL, '12000', NULL, NULL, NULL),
(69, '2018-01-16', 0, 0, 270, '1300', NULL, NULL, NULL, NULL, NULL, NULL),
(71, '2018-01-16', 0, 0, 272, NULL, NULL, NULL, NULL, '12000', NULL, NULL),
(72, '2018-01-16', 0, 0, 273, NULL, '200', NULL, NULL, NULL, NULL, NULL),
(74, '2018-03-28', 0, 0, 275, '3000', NULL, NULL, NULL, NULL, NULL, NULL),
(77, '2018-03-28', 0, 0, 278, '3000', NULL, NULL, NULL, NULL, NULL, NULL),
(80, '2017-12-07', 0, 0, 281, NULL, NULL, NULL, NULL, '15000', NULL, NULL),
(88, '2018-03-28', 0, 0, 290, '3000', NULL, NULL, NULL, NULL, NULL, NULL),
(92, '2018-03-28', 0, 0, 296, '4000', NULL, NULL, NULL, NULL, NULL, NULL),
(95, '2018-03-28', 0, 0, 300, '4000', NULL, NULL, NULL, NULL, NULL, NULL),
(99, '2018-03-28', 0, 0, 304, '4000', NULL, NULL, NULL, NULL, NULL, NULL),
(102, '2018-03-28', 0, 0, 308, NULL, NULL, NULL, '1000', NULL, NULL, NULL),
(103, '2018-03-28', 0, 0, 309, NULL, NULL, NULL, NULL, '2000', NULL, NULL),
(104, '2018-06-05', 0, 0, 0, '5000', NULL, NULL, NULL, NULL, NULL, NULL),
(105, '2018-06-05', 0, 0, 0, '2000', NULL, NULL, NULL, NULL, NULL, NULL),
(106, '2018-06-05', 0, 0, 0, '3000', NULL, NULL, NULL, NULL, NULL, NULL),
(107, '2018-06-05', 0, 0, 0, '1500', NULL, NULL, NULL, NULL, NULL, NULL),
(108, '2018-06-05', 0, 0, 0, '500', NULL, NULL, NULL, NULL, NULL, NULL),
(109, '2018-06-25', 0, 0, 0, '1500', NULL, NULL, NULL, NULL, NULL, NULL),
(110, '2018-06-25', 0, 0, 0, '500', NULL, NULL, NULL, NULL, NULL, NULL),
(111, '2018-06-25', 0, 0, 0, '2500', NULL, NULL, NULL, NULL, NULL, NULL),
(112, '2018-06-25', 0, 0, 0, NULL, '500', NULL, NULL, NULL, NULL, NULL),
(113, '2018-06-25', 0, 0, 310, NULL, NULL, NULL, NULL, '2000', NULL, NULL),
(114, '2018-06-25', 0, 36, 0, NULL, NULL, NULL, NULL, '500', NULL, NULL),
(115, '2018-06-25', 0, 0, 0, NULL, NULL, NULL, NULL, '1500', NULL, NULL),
(116, '2018-06-21', 0, 0, 311, NULL, NULL, NULL, NULL, '500', NULL, NULL),
(117, '2018-08-04', 0, 0, 0, NULL, NULL, NULL, NULL, '5000', NULL, NULL),
(118, '2018-08-11', 0, 0, 312, NULL, NULL, NULL, '5000', NULL, NULL, NULL),
(119, '2018-08-27', 47, 0, 0, NULL, NULL, NULL, '500', NULL, NULL, NULL),
(120, '2018-08-27', 48, 0, 0, NULL, NULL, NULL, '500', NULL, NULL, NULL),
(122, '2018-08-27', 49, 0, 0, NULL, NULL, NULL, '1500', NULL, NULL, NULL),
(124, '2018-08-27', 0, 37, 0, NULL, NULL, NULL, NULL, '1000', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ji_account_reference`
--

DROP TABLE IF EXISTS `ji_account_reference`;
CREATE TABLE IF NOT EXISTS `ji_account_reference` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `reference_name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ji_account_reference`
--

INSERT INTO `ji_account_reference` (`id`, `reference_name`) VALUES
(3, 'Invest'),
(5, 'Service'),
(6, 'Adjustment');

-- --------------------------------------------------------

--
-- Table structure for table `ji_account_reports`
--

DROP TABLE IF EXISTS `ji_account_reports`;
CREATE TABLE IF NOT EXISTS `ji_account_reports` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `account_name` varchar(255) NOT NULL,
  `amount` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `account_name` (`account_name`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ji_account_reports`
--

INSERT INTO `ji_account_reports` (`id`, `account_name`, `amount`, `date`) VALUES
(36, 'Bank (FB)', '390210', '10/08/2017'),
(37, 'Cash In MDP', '107500', '10/08/2017'),
(38, 'Bkash', '76341', '10/08/2017'),
(39, 'Cash In Mirpur', '141450', '10/08/2017'),
(40, 'Cash In Factory', '245330', '10/08/2017'),
(41, 'Cash On MD', '50000', '08/04/2018'),
(42, 'DBBL', '0', '08/04/2018');

-- --------------------------------------------------------

--
-- Table structure for table `ji_account_transfer`
--

DROP TABLE IF EXISTS `ji_account_transfer`;
CREATE TABLE IF NOT EXISTS `ji_account_transfer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ji_user_id` int(11) NOT NULL,
  `from_account` varchar(255) NOT NULL,
  `to_account` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `amount` int(11) NOT NULL,
  `balance_from` int(11) NOT NULL,
  `balance_to` int(11) NOT NULL,
  `remark` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ji_account_transfer`
--

INSERT INTO `ji_account_transfer` (`id`, `ji_user_id`, `from_account`, `to_account`, `date`, `amount`, `balance_from`, `balance_to`, `remark`) VALUES
(13, 0, 'Bkash', 'Cash On Hand', '0000-00-00', 4000, 4583, 4350, ''),
(14, 0, 'Cash On Hand', 'Factory Balance', '0000-00-00', 12000, 27740, 103636, ''),
(16, 0, 'Bank (FurnitureBari)', 'Factory Balance', '0000-00-00', 5000, 30000, 27500, ''),
(17, 0, 'Bkash', 'Cash On Hand', '0000-00-00', 3500, 16500, 16500, ''),
(18, 0, 'Bkash', 'Cash On Hand', '0000-00-00', 2000, 20951, 22000, ''),
(19, 0, 'Bank (James)', 'Bkash', '0000-00-00', 1500, 89000, 27951, ''),
(20, 0, 'Bank (FurnitureBari)', 'Cash On Hand', '0000-00-00', 2000, 55000, 23500, 'test'),
(21, 1, 'Bank (FB)', 'Cash In Mirpur', '0000-00-00', 12000, 100200, 10500, 'test'),
(22, 1, 'Bank (FB)', 'Cash In Mirpur', '0000-00-00', 10000, 90200, 20500, 'test'),
(23, 1, 'Bank (FB)', 'Cash In Mirpur', '0000-00-00', 5000, 85200, 25500, 'test'),
(24, 1, 'Bank (FB)', 'Cash In Mirpur', '0000-00-00', 2000, 279700, 57500, 'test'),
(25, 8, 'Bank (FB)', 'Cash In MDP', '2018-04-24', 2500, 277200, 89000, 'test'),
(26, 1, 'Bank (FB)', 'Bkash', '2018-05-15', 1230, 334770, 54181, 'test'),
(27, 1, 'Bank (FB)', 'Bkash', '2018-05-15', 1230, 333540, 55411, 'test'),
(28, 1, 'Bank (FB)', 'Bkash', '2018-05-15', 1230, 332310, 56641, 'test'),
(29, 1, 'Bank (FB)', 'Cash In Mirpur', '2018-05-15', 2500, 329810, 135000, 'test'),
(30, 1, 'Bank (FB)', 'Cash In Mirpur', '2018-05-15', 2500, 327310, 137500, 'test'),
(31, 1, 'Cash In MDP', 'Bank (FB)', '2018-05-15', 4500, 84500, 331810, 'test'),
(32, 1, 'Bank (FB)', 'Cash In Mirpur', '2018-05-21', 12000, 333810, 149500, 'test'),
(33, 1, 'Bank (FB)', 'Cash In Factory', '2018-05-21', 5000, 328810, 239830, 'test'),
(34, 1, 'Bank (FB)', 'Bkash', '2018-05-21', 2500, 326310, 68141, 'test'),
(35, 1, 'Cash In Mirpur', 'Bkash', '2018-05-21', 1200, 148300, 69341, 'test'),
(36, 1, 'Cash In Mirpur', 'Bank (FB)', '2018-05-21', 100, 148200, 326410, 'test'),
(37, 1, 'Bank (FB)', 'Cash In MDP', '2018-06-05', 5000, 336910, 101000, 'test'),
(38, 1, 'Bank (FB)', 'Cash In MDP', '2018-06-05', 2000, 334910, 103000, 'test'),
(39, 1, 'Bank (FB)', 'Cash In MDP', '2018-06-05', 3000, 331910, 106000, 'test'),
(40, 1, 'Bank (FB)', 'Cash In MDP', '2018-06-05', 1500, 330410, 107500, 'test'),
(41, 1, 'Bank (FB)', 'Cash In MDP', '2018-06-05', 500, 329910, 108000, 'test'),
(42, 1, 'Bank (FB)', 'Cash In Mirpur', '2018-06-25', 1500, 328410, 137450, 'test'),
(43, 1, 'Bank (FB)', 'Cash In Factory', '2018-06-25', 500, 347910, 241830, 'test'),
(44, 1, 'Bank (FB)', 'Cash In Factory', '2018-06-25', 2500, 345410, 244330, 'test'),
(45, 1, 'Cash In MDP', 'Cash In Factory', '2018-06-25', 500, 107500, 244830, 'test'),
(46, 1, 'Cash In Factory', 'Cash In Mirpur', '2018-06-25', 1500, 246830, 143950, 'test'),
(47, 1, 'Cash In Factory', 'Cash In Mirpur', '2018-08-04', 5000, 246330, 148950, 'test');

-- --------------------------------------------------------

--
-- Table structure for table `ji_account_withdraw`
--

DROP TABLE IF EXISTS `ji_account_withdraw`;
CREATE TABLE IF NOT EXISTS `ji_account_withdraw` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` varchar(255) NOT NULL,
  `amount` varchar(255) NOT NULL,
  `account_name` varchar(255) NOT NULL,
  `balance` int(11) NOT NULL,
  `remark` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ji_account_withdraw`
--

INSERT INTO `ji_account_withdraw` (`id`, `date`, `amount`, `account_name`, `balance`, `remark`) VALUES
(17, '08/07/2017', '138000', 'Cash On Hand', 2000, 'Adjustment'),
(18, '08/08/2017', '10916.78', 'Bkash', 8583, 'James'),
(19, '08/11/2017', '500', 'Cash On Hand', 27240, 'MD'),
(20, '08/10/2017', '500', 'Factory Balance', 103136, 'MD'),
(21, '08/12/2017', '18000', 'Bkash', 83, 'MD'),
(22, '08/13/2017', '16000', 'Cash On Hand', -13107, 'MD'),
(23, '10/14/2017', '2000', 'Bank (FurnitureBari)', 28000, 'test'),
(24, '05/29/2018', '1500', 'Cash In MDP', 96000, 'test');

-- --------------------------------------------------------

--
-- Table structure for table `ji_delivery_by`
--

DROP TABLE IF EXISTS `ji_delivery_by`;
CREATE TABLE IF NOT EXISTS `ji_delivery_by` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `delivery_by_name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ji_delivery_by`
--

INSERT INTO `ji_delivery_by` (`id`, `delivery_by_name`) VALUES
(3, 'Courier'),
(4, 'Home');

-- --------------------------------------------------------

--
-- Table structure for table `ji_everyday_acount_balance_records`
--

DROP TABLE IF EXISTS `ji_everyday_acount_balance_records`;
CREATE TABLE IF NOT EXISTS `ji_everyday_acount_balance_records` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `account_name` varchar(255) NOT NULL,
  `amount` varchar(255) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ji_expanse`
--

DROP TABLE IF EXISTS `ji_expanse`;
CREATE TABLE IF NOT EXISTS `ji_expanse` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `expanse_name` varchar(100) NOT NULL,
  `expanse_category` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ji_expanse`
--

INSERT INTO `ji_expanse` (`id`, `expanse_name`, `expanse_category`) VALUES
(13, 'TA DA', 'Personal'),
(14, 'Mobile Bill', 'Personal'),
(15, 'Transport', 'Transport'),
(16, 'Courier Charge', 'Courier'),
(17, 'Van Driver', 'Salary'),
(18, 'Factory Exe.', 'Salary'),
(19, 'Office Exe.', 'Salary'),
(20, 'Worker Nasta', 'Meals'),
(21, 'Electricity Bill', 'Utility'),
(22, 'Water Bill', 'Utility'),
(23, 'Gas Bill', 'Utility'),
(24, 'Others', 'Utility'),
(25, 'Service', 'Repair'),
(26, 'Labour', 'Others'),
(27, 'Factory Rent', 'Utility'),
(28, 'Office Meals', 'Office Expense'),
(29, 'Office Others', 'Office Expense'),
(30, 'Noksha', 'Production Expense'),
(31, 'Product Service', 'Repair'),
(32, 'Office Rent', 'Utility');

-- --------------------------------------------------------

--
-- Table structure for table `ji_expanse_category`
--

DROP TABLE IF EXISTS `ji_expanse_category`;
CREATE TABLE IF NOT EXISTS `ji_expanse_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `expanse_category_name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ji_expanse_category`
--

INSERT INTO `ji_expanse_category` (`id`, `expanse_category_name`) VALUES
(15, 'Transport'),
(16, 'Personal'),
(17, 'Meals'),
(18, 'Others'),
(19, 'Salary'),
(20, 'Courier'),
(21, 'Utility'),
(22, 'Repair'),
(23, 'Office Expense'),
(24, 'Production Expense');

-- --------------------------------------------------------

--
-- Table structure for table `ji_expanse_report`
--

DROP TABLE IF EXISTS `ji_expanse_report`;
CREATE TABLE IF NOT EXISTS `ji_expanse_report` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ji_new_expanse_id` varchar(255) NOT NULL,
  `ji_purchase_pay_bill_id` varchar(255) NOT NULL,
  `ji_worker_pay_bill_id` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `expanse_total` varchar(255) NOT NULL,
  `purchase_expanse_total` varchar(255) NOT NULL,
  `worker_expanse_total` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ji_expanse_report`
--

INSERT INTO `ji_expanse_report` (`id`, `ji_new_expanse_id`, `ji_purchase_pay_bill_id`, `ji_worker_pay_bill_id`, `date`, `expanse_total`, `purchase_expanse_total`, `worker_expanse_total`) VALUES
(12, '58', '', '', '2017-10-14', '17500.00', '', ''),
(13, '59', '', '', '2017-10-17', '16500.00', '', ''),
(14, '60', '', '', '2017-11-03', '7049.00', '', ''),
(15, '', '', '26', '2017-12-05', '', '', '3000'),
(16, '61', '', '', '2017-12-05', '13500.00', '', ''),
(17, '62', '', '', '2017-12-05', '14000.00', '', ''),
(18, '63', '', '', '2017-12-07', '15000.00', '', ''),
(20, '65', '', '', '2018-01-16', '1300.00', '', ''),
(21, '', '', '27', '2018-01-30', '', '', '3500'),
(22, '', '', '28', '2018-01-30', '', '', '5000'),
(23, '', '', '29', '2018-01-30', '', '', '1470'),
(24, '', '', '30', '2018-01-30', '', '', '2000'),
(25, '', '', '31', '2018-02-19', '', '', '3000'),
(26, '', '', '32', '2018-02-19', '', '', '3000'),
(27, '66', '', '', '2018-03-28', '2000.00', '', ''),
(28, '', '', '33', '2018-04-24', '', '', '5000'),
(29, '', '', '34', '2018-04-30', '', '', '7200'),
(30, '', '46', '', '2018-05-29', '', '1000', ''),
(31, '', '', '35', '2018-05-29', '', '', '500'),
(32, '67', '', '', '2018-06-25', '2000.00', '', ''),
(33, '', '', '36', '2018-06-25', '', '', '500'),
(34, '68', '', '', '2018-06-21', '500.00', '', ''),
(35, '69', '', '', '2018-08-11', '5000.00', '', ''),
(36, '', '47', '', '2018-08-27', '', '500', ''),
(37, '', '48', '', '2018-08-27', '', '500', ''),
(38, '', '49', '', '2018-08-27', '', '1500', ''),
(39, '', '', '37', '2018-08-27', '', '', '1000');

-- --------------------------------------------------------

--
-- Table structure for table `ji_expanse_report_details`
--

DROP TABLE IF EXISTS `ji_expanse_report_details`;
CREATE TABLE IF NOT EXISTS `ji_expanse_report_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `expanse_name` varchar(255) NOT NULL,
  `expanse_category` varchar(255) NOT NULL,
  `amount` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ji_expanse_report_details`
--

INSERT INTO `ji_expanse_report_details` (`id`, `date`, `expanse_name`, `expanse_category`, `amount`) VALUES
(13, '2017-10-14', 'expanse', 'Utility', 12000),
(14, '2017-10-14', 'expanse', 'Production Expense', 5500),
(15, '2017-10-17', 'expanse', 'Office Expense', 15000),
(16, '2017-10-17', 'expanse', 'Utility', 1500),
(17, '2017-11-03', 'expanse', 'Utility', 7049),
(18, '2017-12-05', 'expanse', 'Utility', 1500),
(19, '2017-12-05', 'expanse', 'Office Expense', 12000),
(20, '2017-12-05', 'expanse', 'Salary', 2500),
(21, '2017-12-05', 'expanse', 'Production Expense', 12000),
(22, '2017-12-07', 'expanse', 'Office Expense', 15000),
(23, '2017-12-07', 'expanse', 'Production Expense', 1200),
(24, '2018-01-16', 'expanse', 'Production Expense', 12000),
(25, '2018-01-16', 'expanse', 'Production Expense', 25000),
(26, '2018-01-16', 'expanse', 'Production Expense', 1300),
(27, '2018-01-16', 'expanse', 'Meals', 2500),
(28, '2018-03-28', 'expanse', 'Office Expense', 1000),
(29, '2018-05-29', 'expanse', 'Office Expense', 12000),
(30, '2018-05-29', 'expanse', 'Office Expense', 250),
(31, '2018-06-25', 'expanse', 'Production Expense', 2000),
(32, '2018-06-21', 'expanse', 'Production Expense', 500),
(33, '2018-08-11', 'expanse', 'Repair', 5000);

-- --------------------------------------------------------

--
-- Table structure for table `ji_factory`
--

DROP TABLE IF EXISTS `ji_factory`;
CREATE TABLE IF NOT EXISTS `ji_factory` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `factory` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ji_factory`
--

INSERT INTO `ji_factory` (`id`, `factory`) VALUES
(2, 'Saiful'),
(3, 'Habib');

-- --------------------------------------------------------

--
-- Table structure for table `ji_invoice`
--

DROP TABLE IF EXISTS `ji_invoice`;
CREATE TABLE IF NOT EXISTS `ji_invoice` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ji_user_id` int(11) NOT NULL,
  `order_no` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `order_date` date NOT NULL,
  `sales_person` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `sales_assistent` varchar(255) NOT NULL,
  `delivery_date` date NOT NULL,
  `delivery_by` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `factory` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `total_amount` int(11) NOT NULL,
  `total_qty` int(11) NOT NULL,
  `remarks` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `status` enum('-1','0','1','2','3','4') CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT '1',
  `customer_name` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `mobile_no` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `payment_type` varchar(50) NOT NULL,
  `reference_no` varchar(100) NOT NULL,
  `urgency_status` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `address` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `delivery_charge` int(5) NOT NULL DEFAULT '0',
  `discount` int(5) NOT NULL DEFAULT '0',
  `order_by` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `net_total` varchar(11) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `reason` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=282 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ji_invoice`
--

INSERT INTO `ji_invoice` (`id`, `ji_user_id`, `order_no`, `order_date`, `sales_person`, `sales_assistent`, `delivery_date`, `delivery_by`, `factory`, `total_amount`, `total_qty`, `remarks`, `status`, `customer_name`, `mobile_no`, `payment_type`, `reference_no`, `urgency_status`, `amount`, `address`, `delivery_charge`, `discount`, `order_by`, `net_total`, `reason`) VALUES
(213, 0, '08171', '2017-08-04', 'mim', '', '2017-08-07', 'home delivery', '', 13000, 1, '', '1', 'suvo', '01711138197/01703568846', '', '', 0, 0, 'house # 8, Flat #4A Road 22 block # b mirpur 6 ', 500, 0, 'Show Room', '13500.00', ''),
(214, 0, '0817213', '2017-08-07', 'mim', '', '2017-08-13', 'courier', '', 15100, 1, '', '1', 'sahid', '01713239011', '', '', 0, 0, 'ponchogor', 2000, 0, 'Online', '17100.00', ''),
(215, 0, '0817214', '2017-08-07', 'mim', '', '2017-08-12', 'home delivery', '', 13000, 1, '', '1', 'sahed', '01717562312/01726362117', '', '', 0, 0, '240/p   rampura  ', 500, 0, 'Show Room', '13500.00', ''),
(220, 0, '0817215', '2017-08-03', 'mim', '', '2017-08-03', 'home delivery', '', 13000, 1, '', '1', 'sarika surbin', '01675419948', '', '', 0, 0, '300 feet pink city gate 2 te eshe fon dilei hobe', 500, 0, 'Online', '13500.00', ''),
(221, 0, '0817220', '2017-08-10', 'mim', '', '2017-08-11', 'home delivery', '', 13000, 1, '1 tr mdhe dite hobe', '1', 'sayeed', '01833317230', '', '', 0, 0, 'sahabag ', 500, 0, 'Online', '13500.00', ''),
(222, 0, '0817221', '2017-08-08', 'mim', '', '2017-08-11', 'home delivery', '', 40000, 1, '', '3', 'sifat uddin', '01715517619/01768408565', '', '', 0, 0, 'flat-b-4 section-g nhb building no-2 section -2 mirpur ', 0, 0, 'Show Room', '40000.00', ''),
(223, 0, '0817222', '2017-08-09', 'mim', '', '2017-08-17', 'home delivery', '', 44000, 1, '', '1', 'tanjila arefin', '01716910806', '', '', 0, 0, 'feni cadet college ', 4000, 0, 'Show Room', '48000.00', ''),
(224, 0, '0817223', '2017-08-09', 'mim', '', '2017-08-18', 'home delivery', '', 30000, 1, '', '1', 'safayet hossain', '01711104925', '', '', 0, 0, 'dhanmondi', 0, 0, 'Online', '30000.00', ''),
(225, 0, '0817224', '2017-07-30', 'mim', '', '2017-08-07', 'home delivery', '', 29000, 1, '', '1', 'atik', '01755587454,/019626455526', '', '', 0, 0, 'house 8 ,10 len 13 block section 1 avenew 5 mirpur', 0, 0, 'Online', '29000.00', ''),
(226, 0, '0817225', '2017-07-30', 'mim', '', '2017-08-10', 'home delivery', '', 51500, 1, '', '1', 'moshiur rahman', '01959497428', '', '', 0, 0, 'ashuliya', 0, 0, 'Online', '51500.00', ''),
(227, 0, '0817226', '2017-08-08', 'mim', '', '2017-08-01', 'home delivery', '', 13000, 1, '', '3', 'firoz', '01911357597', '', '', 0, 0, '31 no hatkhola mamun plaza 11c flat', 500, 0, 'Online', '13500.00', ''),
(228, 0, '0817227', '2017-08-05', 'mim', '', '2017-08-10', 'home delivery', '', 50000, 1, '7 tr mdhe pochate hobe\r\nhatol+center table+sidw table  (hd016) bookself er color hobe', '1', 'jamshed', '01819450777/01975540341', '', '', 0, 0, 'monipur school (girls) quet mosjid er opposite ', 0, 0, 'Online', '50000.00', ''),
(229, 0, '0817228', '2017-08-08', 'mim', '', '2017-08-01', 'home delivery', '', 15500, 1, '', '3', 'inna islam', '0177249597/01818559866', '', '', 0, 0, 'mirpur 1 sony chinrma hall er opposite', 1000, 0, 'Show Room', '16500.00', ''),
(230, 0, '0817229', '2017-07-28', 'mim', '', '2017-08-06', 'home delivery', '', 18000, 1, '', '1', 'lipa', '01821654216', '', '', 0, 0, 'uttora', 0, 0, 'Online', '18000.00', ''),
(231, 0, '0817230', '2017-07-28', 'mim', '', '2017-08-06', 'home delivery', '', 104000, 4, '', '1', 'rohim badsha', '01726206105/01941115550', '', '', 0, 0, 'khejur tek mirjanogor savar', 0, 6000, 'Show Room', '98000.00', ''),
(232, 0, '0817231', '2017-07-26', 'mim', '', '2017-08-02', '', '', 13000, 1, '', '1', 'morshed', '01732175594/01725118804', '', '', 0, 0, 'house c/d road 4 dhanmondi ', 500, 0, 'Show Room', '13500.00', ''),
(233, 0, '0817232', '2017-08-09', 'Nahid', '', '2017-08-18', 'home delivery', '', 36000, 1, '', '1', 'Nur Alam Khokon', '01711584878 / 01923693228', '', '', 0, 0, '42 mollika housing milk vita road section 7 pallobi', 0, 0, 'Online', '36000.00', ''),
(234, 0, '0817233', '2017-08-10', '', '', '2017-07-29', 'home delivery', '', 67000, 2, '', '3', 'abdul quddus', '01711484093', '', '', 0, 0, 'ashkona hajikamp maloncho society', 0, 65000, 'Show Room', '2000.00', ''),
(235, 0, '0817234', '2017-08-10', 'mim', '', '2017-08-11', 'home delivery', '', 19000, 1, '', '1', 'munni farzana', ' 01787722010 01732414304', '', '', 0, 0, 'East malibag chowduri para\r\nHaji para \r\nIndex apartment \r\nDhaka', 0, 0, 'Online', '19000.00', ''),
(236, 0, '0817235', '2017-07-24', 'mim', '', '2017-08-03', 'home delivery', '', 24000, 1, '', '1', 'himangshu ', '01922423433', '', '', 0, 0, 'mirpur 1 chineed sha ali bag', 0, 1000, 'Online', '23000.00', ''),
(237, 0, '0817236', '2017-08-06', 'mim', '', '2017-08-06', 'home delivery', 'saiful', 26300, 2, '', '1', 'Nadim Ahmed', '01688889990/01717307181', '', '', 0, 0, 'house 70/1 sha ali bag mirpur 1 3rd floor', 0, 500, 'Show Room', '25800.00', ''),
(238, 0, '0817237', '2017-08-10', 'mim', '', '2017-08-13', 'home delivery', '', 10000, 1, '', '1', 'nadita', '01711030938', '', '', 0, 0, 'flat 3-H 21 sukra bad', 1000, 0, 'Online', '11000.00', ''),
(239, 0, '0817238', '2017-07-15', 'mim', '', '2017-07-22', '', '', 41500, 2, '', '1', 'best dress wear', '01715997220/01707997220', '', '', 0, 0, 'vorari raj fulbaria', 1500, 1500, 'Show Room', '41500.00', ''),
(240, 0, '0817239', '2017-06-18', 'mim', '', '2017-07-14', '', '', 49000, 1, '', '1', 'razi mojumder shen', '01758322995', '', '', 0, 0, 'Chittagong jublee road ', 3000, 0, 'Online', '52000.00', ''),
(241, 0, '0817240', '2017-08-06', 'mim', '', '2017-07-29', 'home delivery', '', 67000, 2, '', '4', 'abdul quddus', '01711484093', '', '', 0, 0, 'ashkona hajikamp maloncho society', 0, 46000, 'Show Room', '21000.00', ''),
(242, 0, '0817241', '2017-08-02', 'mim', '', '2017-08-15', 'home delivery', '', 275000, 2, '', '1', 'shadat', '01717668078/01775009989', '', '', 0, 0, '3/A mollika romna police quater romna', 0, 10000, 'Online', '265000.00', ''),
(243, 0, '0817242', '2017-06-15', 'mim', '', '2017-06-15', 'courier', '', 26300, 2, '', '4', ' murad', '01813963938/01813907100', '', '', 0, 0, 'comilla choddogram', 3000, 23800, 'Online', '5500.00', ''),
(244, 0, '0817243', '2017-05-29', '', '', '2017-07-24', '', '', 14500, 1, '', '1', 'suvo', '01710857697/01677040203', '', '', 0, 0, 'jamalpur', 2000, 0, 'Online', '16500.00', ''),
(245, 0, '0817244', '2017-08-06', 'mim', '', '2017-08-08', '', 'saiful', 20000, 1, '', '1', 'MD Dulal', '01677528294/01959548720', '', '', 0, 0, '13/6 pollobi chorongi abashik', 0, 0, 'Show Room', '20000.00', ''),
(246, 0, '0817245', '2017-08-01', 'mim', '', '2017-08-15', '', '', 102000, 6, '', '1', 'mita ', '01744251474', '', '', 0, 0, 'mirpur-dohs avenew-4, H137', 0, 0, 'Online', '102000.00', ''),
(247, 0, '0817246', '2017-08-10', 'mim', '', '2017-08-10', 'home deiivery', '', 15500, 1, '', '1', 'shila', '01746494263', '', '', 0, 0, 'tongi', 1500, 0, 'Online', '17000.00', ''),
(248, 0, '0817247', '2017-07-25', '', '', '2017-08-03', '', 'Self', 30000, 1, '', '3', 'Mirza Shiblee', '01711568061', '', '', 0, 0, 'Shiblee mirza 1/2 block c lalmatia dhaka', 0, 0, 'Online', '30000.00', ''),
(249, 0, '0817248', '2017-08-09', 'mim', '', '2017-08-18', 'home delivery', '', 40000, 1, '', '1', 'Kohinoor Munshi', 'contact: 01620119488', '', '', 0, 0, 'dokhin bonsree  block# k, road#20/1 , house# 89\r\n', 0, 0, 'Online', '40000.00', ''),
(250, 0, '0817249', '2017-08-09', 'mim', '', '2017-08-18', 'home delivery', '', 43000, 1, '', '1', 'lipi', '01715026908', '', '', 0, 0, 'shemoli house-27/2/c road 3 sonali shopno flat a4', 0, 1000, 'Show Room', '42000.00', ''),
(251, 1, '0817250', '2017-08-10', 'Moumita Rahman Sonia', '', '2017-08-20', 'Home', 'Habib', 27000, 1, '', '1', 'popi voumik', '01749994000', '', '', 3, 0, 'pabna', 3000, 0, 'Online', '30000.00', ''),
(252, 1, '0817251', '2017-08-10', 'Nahid', '', '2017-08-25', 'Home', 'Habib', 35000, 1, 'finishing vlo hote hobe', '1', 'mustafa rahman', '01713000436', '', '', 2, 0, '12/16 tajmohol road mohammad pur', 0, 0, 'Show Room', '35000.00', ''),
(253, 0, '0817252', '2017-08-10', 'mim', '', '2017-08-15', 'home delivery', '', 27000, 1, '', '1', 'Sameer Golam', '01616386804', '', '', 0, 0, '1000 Building name islam bhaban Flat B9 Naya paltan', 0, 0, 'Online', '27000.00', ''),
(254, 1, '0817253', '2017-08-11', 'Nahid', '', '2017-08-11', 'Test', 'Habib', 35000, 1, '', '1', 'Anisur Rahman', '01881568090,/01711965302', '', '', 3, 0, 'Rajar bag pulish line 2 no get Shohid bag..1/2,895 sayeed uncle er goli\r\n', 0, 0, 'Online', '35000.00', ''),
(255, 1, '0817254', '2017-08-11', 'Nahid', '', '2017-08-13', 'Home', 'Habib', 13000, 1, 'Rat 10 tar moddhe pousate hobe basai...', '3', 'Kutub uddin vuya', '01817182547', '', '', 3, 0, 'Niketon 5 no get', 500, 0, 'Online', '13500.00', ''),
(256, 0, '0817255', '2017-08-11', 'Nahid', '', '2017-08-12', 'home delivery', 'Self', 13000, 1, 'Rat 10 tar moddhe pousate hobe basai...', '0', 'Kutub uddin vuya', '01817182547', '', '', 0, 0, 'Niketon 5 no get', 500, 0, 'Online', '13500.00', ''),
(257, 0, '0817256', '2017-08-11', 'Nahid', '', '2017-08-12', 'home delivery', 'Self', 13000, 1, 'Rat 10 tar moddhe pousate hobe basai...', '0', 'Kutub uddin vuya', '01817182547', '', '', 0, 0, 'Niketon 5 no get', 500, 0, 'Online', '13500.00', ''),
(258, 0, '0817257', '2017-08-11', 'Nahid', '', '2017-08-12', 'home delivery', 'Self', 13000, 1, 'Rat 10 tar moddhe pousate hobe basai...', '0', 'Kutub uddin vuya', '01817182547', '', '', 0, 0, 'Niketon 5 no get', 500, 0, 'Online', '13500.00', ''),
(259, 0, '0817258', '2017-08-11', 'Nahid', '', '2017-08-12', 'home delivery', 'Self', 13000, 1, 'Rat 10 tar moddhe pousate hobe basai...', '0', 'Kutub uddin vuya', '01817182547', '', '', 0, 0, 'Niketon 5 no get', 500, 0, 'Online', '13500.00', ''),
(260, 0, '0817259', '2017-08-11', 'Nahid', '', '2017-08-12', 'home delivery', 'Self', 13000, 1, 'Rat 10 tar moddhe pousate hobe basai...', '0', 'Kutub uddin vuya', '01817182547', '', '', 0, 0, 'Niketon 5 no get', 500, 0, 'Online', '13500.00', ''),
(261, 0, '0817260', '2017-08-11', 'jms ', '', '2017-08-11', 'home delivery', 'Self', 13000, 1, '', '3', 'Shanta', '01679254441', '', '', 0, 0, '', 0, 500, 'Show Room', '12500.00', ''),
(262, 0, '0817261', '2017-08-12', 'mim', '', '2017-08-13', 'courier', 'saiful', 27900, 2, '', '0', 'md zahedul korim ', '01718757677', '', '', 0, 0, 'jhinadaho', 3000, 0, 'Online', '30900.00', ''),
(263, 0, '0817262', '2017-08-12', 'mim', '', '2017-08-13', 'courier', 'saiful', 27900, 2, '', '0', 'md zahedul korim ', '01718757677', '', '', 0, 0, 'jhinadaho', 3000, 0, 'Online', '30900.00', ''),
(264, 1, '0817263', '2017-08-12', 'Nahid', '', '2017-08-13', 'Home', 'Habib', 27900, 2, '', '4', 'md zahedul korim ', '01718757677', '', '', 3, 0, 'jhinadaho', 3000, 0, 'Show Room', '30900.00', ''),
(265, 1, '0817264', '2017-08-12', 'Moumita Rahman Sonia', '', '2018-02-21', 'Home', 'Habib', 13000, 1, '', '1', 'Sharif Kashem', '01713080375', '', '', 3, 0, ' Address: Flat 1B, House 19, Road 12, Sector 3, Uttara.', 500, 0, 'Show Room', '13500.00', ''),
(266, 1, '0817265', '2017-08-12', 'Nahid', '', '2017-08-16', 'Home', 'Habib', 49000, 1, 'same to same', '3', 'md sofik', '01711005704', '', '', 3, 0, 'foridpur sodor', 3000, 0, 'Show Room', '52000.00', ''),
(267, 1, '0817266', '2018-05-08', 'Titas', '', '2018-05-15', 'Home', 'Habib', 48000, 1, '', '3', 'Imrul kayes', '01722419961', '', '', 3, 0, 'flat 302 building d the grand tarrace 45 new eskaton dhaka', 0, 0, 'Online', '48000.00', ''),
(278, 1, '1118267', '2018-11-17', 'Titas', 'Nahid', '2018-11-30', 'Home', 'Habib', 10000, 2, 'test', '1', 'Rakib', '01673120069', '', '', 3, 0, 'test', 1000, 0, 'Online', '11000.00', ''),
(279, 1, '1218278', '2018-12-08', 'Moumita Rahman Sonia', '', '2018-12-15', 'Home', 'Habib', 4000, 2, 'test', '0', 'Rakib Hossain', '01673120069', '', '', 3, 0, 'test', 0, 0, 'Online', '4000.00', ''),
(280, 1, '1218279', '2018-12-08', 'Nahid', '', '2018-12-15', 'Home', 'Habib', 15000, 3, 'test', '0', 'Rakib Hossain', '01673120069', '', '', 3, 0, 'test', 0, 0, 'Online', '15000.00', ''),
(281, 1, '1218280', '2018-12-08', 'Moumita Rahman Sonia', 'Nahid', '2018-12-15', 'Home', 'Habib', 50000, 1, 'test', '1', 'Rakib Hossain', '01673120069', '', '', 3, 0, 'test', 0, 0, 'Online', '50000.00', '');

-- --------------------------------------------------------

--
-- Table structure for table `ji_invoice_details`
--

DROP TABLE IF EXISTS `ji_invoice_details`;
CREATE TABLE IF NOT EXISTS `ji_invoice_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ji_invoice_id` int(11) NOT NULL,
  `item_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `stock_status` int(11) NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `qty` int(11) NOT NULL,
  `unit_price` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `total` int(11) NOT NULL,
  `item_code` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1591 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ji_invoice_details`
--

INSERT INTO `ji_invoice_details` (`id`, `ji_invoice_id`, `item_name`, `stock_status`, `description`, `qty`, `unit_price`, `total`, `item_code`) VALUES
(1332, 213, 'Sofa Cum Bed', 0, 'same', 1, '13000', 13000, 'SCB001'),
(1346, 220, 'Sofa Cum Bed', 0, 'same', 1, '13000', 13000, 'SCB001'),
(1353, 225, 'Dinning Table', 0, '4 chair and tool and 5x3 feet table', 1, '29000', 29000, 'DT301'),
(1357, 228, 'Sofa', 0, '3+1+divan+center table+side table+tool+pillow sofa r back foam + uporer foam e gp248 sofar ak dom back and nicher foam e fvl-203-c pillow showroom jata ase stai hobe', 1, '50000', 50000, 'W156'),
(1358, 226, 'Bed Set', 0, 'bed 6x7 feet , 2 bed side wordrobe  dressing table with sitter', 1, '51500', 51500, 'P201'),
(1362, 230, 'Dinning Table', 0, '6 chair', 1, '18000', 18000, 'DT215'),
(1370, 232, 'Sofa Cum Bed', 0, 'febric change pillow same fabric as bed', 1, '13000', 13000, 'SCB001'),
(1375, 236, 'Showcase', 0, 'same', 1, '24000', 24000, 'SG100'),
(1377, 237, 'Sofa', 0, '3+2+1 with pillow color black chap', 1, '21300', 21300, 'S602'),
(1378, 237, 'C.Table', 0, 'same', 1, '5000', 5000, 'CT100'),
(1380, 239, 'Divan', 0, '6 ft left side uchu right side nichu wooden color', 1, '22000', 22000, 'DV64'),
(1381, 239, 'Divan', 0, '5 ft left side nichu right uchu wooden color', 1, '19500', 19500, 'DV64'),
(1382, 240, 'Sofa', 0, '3+1+divan+center table+side table+tool\r\nj-5 color rexin', 1, '49000', 49000, 'W156'),
(1393, 244, 'Divan', 0, 'same', 1, '14500', 14500, 'DT207'),
(1394, 245, 'Sofa', 0, '3+2+1', 1, '20000', 20000, 'H548'),
(1401, 231, 'Sofa', 0, '2+2+1 ls008 black er rexin showroom ', 1, '48000', 48000, 'S318'),
(1402, 231, 'Almira', 0, '3 part oak', 1, '33000', 33000, 'A313'),
(1403, 231, 'Divan', 0, 'same rexin sofa', 1, '13000', 13000, 'DV251'),
(1404, 231, 'Coffee Table', 0, 'same rexin sofa', 1, '10000', 10000, 'GT100'),
(1411, 241, 'Sofa', 0, 'ready ase', 1, '49000', 49000, 'W156'),
(1412, 241, 'Coffee Table', 0, 'same', 1, '18000', 18000, 'HD025'),
(1418, 215, 'Divan', 0, 'bairer chap tetul bechi same color rexin', 1, '13000', 13000, 'DV251'),
(1422, 243, 'Sofa', 0, 'sofa with pillow', 1, '21300', 21300, 'S602'),
(1423, 243, 'C.Table', 0, 'same', 1, '5000', 5000, 'CT100'),
(1429, 229, 'Sofa', 0, '2+2+1', 1, '15500', 15500, 'H013'),
(1430, 227, 'Sofa Cum Bed', 0, 'same', 1, '13000', 13000, 'SCB001'),
(1432, 224, 'Two Stored Bed', 0, 'bed 6.5x4 feet stair 18\'\'', 1, '30000', 30000, 'HD016'),
(1433, 223, 'Sofa', 0, '3+2+1+center table+ side table sofa fabric fvl-203 -b pillow fvl -22- c', 1, '44000', 44000, 'WS01'),
(1434, 249, 'Dinning Table', 0, 'Dinning Table (8 chair ) round table MDF table bash 5feet	\r\n', 1, '40000', 40000, 'DT215'),
(1435, 233, 'Dinning Table', 0, '8 chair hobe same quality', 1, '36000', 36000, 'DT215'),
(1436, 250, 'Sofa', 0, '2+2+1 sit+uporer back j4 all over j 9', 1, '43000', 43000, 'S318'),
(1439, 235, 'Dinning Table', 0, '6 chair with table', 1, '19000', 19000, 'DT207'),
(1442, 221, 'Sofa Cum Bed', 0, 'same', 1, '13000', 13000, 'SCB004'),
(1453, 234, 'Sofa', 0, 'ready ase', 1, '49000', 49000, 'W156'),
(1454, 234, 'Coffee Table', 0, 'same', 1, '18000', 18000, 'HD025'),
(1459, 246, 'Almira', 0, '6X3 mdf', 1, '15000', 15000, 'AA22'),
(1460, 246, 'Bed', 0, '4x7 mdf same as almira', 1, '19000', 19000, 'B322'),
(1461, 246, 'Wordrobe ', 0, 'oak single', 1, '13000', 13000, 'CMZ04'),
(1462, 246, 'Woven Box', 0, 'mdf 3x3 ', 1, '15000', 15000, 'CMZ01'),
(1463, 246, 'Showbox', 0, 'mdf 3x2', 1, '13000', 13000, 'CMZ03'),
(1464, 246, 'Showcase', 0, 'oak 6x5 same as dinning table', 1, '27000', 27000, 'S212'),
(1465, 242, 'Bed Set', 0, 'bed 6x7 (p319 black color hobe samne khali thakbe) dressing table 3.5 feet x6 , almira (6x6.5 ) bed side 2 ta', 1, '195000', 195000, 'P314'),
(1466, 242, 'Sofa', 0, '3+2+2+divan+center table+side table 3 ta oak 2 ta color hobe', 1, '80000', 80000, 'W153'),
(1472, 256, 'Sofa Cum Bed', 0, 'office a je rokom cilo shei rokomi hote hobe', 1, '13000', 13000, 'SCB001'),
(1473, 257, 'Sofa Cum Bed', 0, 'office a je rokom cilo shei rokomi hote hobe', 1, '13000', 13000, 'SCB001'),
(1474, 258, 'Sofa Cum Bed', 0, 'office a je rokom cilo shei rokomi hote hobe', 1, '13000', 13000, 'SCB001'),
(1475, 259, 'Sofa Cum Bed', 0, 'office a je rokom cilo shei rokomi hote hobe', 1, '13000', 13000, 'SCB001'),
(1476, 260, 'Sofa Cum Bed', 0, 'office a je rokom cilo shei rokomi hote hobe', 1, '13000', 13000, 'SCB001'),
(1479, 261, 'Sofa Cum Bed', 1, 'Showroom', 1, '13000', 13000, 'SCB001'),
(1480, 253, 'Chair', 0, '6 ta mdf', 1, '27000', 27000, 'DT215'),
(1482, 262, 'Sofa', 0, '3+2+1 with pillow', 1, '22900', 22900, 'H548'),
(1483, 262, 'C.Table', 0, '5 mm', 1, '5000', 5000, 'CT100'),
(1484, 263, 'Sofa', 0, '3+2+1 with pillow', 1, '22900', 22900, 'H548'),
(1485, 263, 'C.Table', 0, '5 mm', 1, '5000', 5000, 'CT100'),
(1486, 248, 'Sofa', 1, 'L shape 92’’ right+76’’ left+1 sit 38’’+ 1 sit 38’’ 	\r\nrobour  foam and self fabric \r\n', 1, '30000', 30000, 'CMZ005'),
(1490, 247, 'Sofa', 0, '2+2+1', 1, '15500', 15500, 'F151'),
(1491, 238, 'Bookself', 0, '5 ft x 2.5 ft depth 12 \'\' tetul bichi color', 1, '10000', 10000, 'HD016'),
(1494, 222, 'Sofa', 0, '2+2+1', 1, '40000', 40000, 'S318'),
(1496, 214, 'Divan', 0, 'same 2 ta pillow ', 1, '15100', 15100, 'DV207'),
(1549, 269, 'Pull Out Bed', 0, 'test', 5, '50', 250, 'W159'),
(1550, 270, 'Pull Out Bed', 0, 'test', 2, '30', 60, 'SCB005'),
(1551, 270, 'Almira', 0, 'test', 3, '50', 150, 'AA22'),
(1552, 271, 'Sofa', 0, 'test', 2, '50', 100, 'F156'),
(1553, 272, 'Sofa', 0, 'test', 2, '50', 100, 'F156'),
(1554, 273, 'Sofa', 0, 'test', 2, '200', 400, 'H548'),
(1561, 254, 'Pull Out Bed', 0, 'full set with foam', 1, '35000', 35000, 'SCB005'),
(1563, 267, 'Sofa', 0, '3+2+1 sofa center table + side table + pillow', 1, '48000', 48000, 'WS01'),
(1564, 274, 'Bed', 0, 'test', 3, '2000', 6000, 'B259'),
(1567, 275, 'Chair', 0, 'test', 2, '30', 60, 'DT215'),
(1568, 276, 'Sofa', 0, 'test', 2, '10000', 20000, 'F404'),
(1569, 277, 'Sofa', 0, 'test', 2, '10000', 20000, 'F404'),
(1572, 278, 'Sofa', 0, 'test', 2, '5000', 10000, 'F404'),
(1575, 266, 'Sofa', 0, '3 sitter + 1 sitter +divan+tool+center table+side table+pillow', 1, '49000', 49000, 'W156'),
(1578, 264, 'Sofa', 0, '3+2+1 with pillow', 1, '22900', 22900, 'H548'),
(1579, 264, 'C.Table', 0, '5 mm', 1, '5000', 5000, 'CT100'),
(1580, 265, 'Sofa Cum Bed', 0, 'pillow chocolate color fabric ', 1, '13000', 13000, 'SCB004'),
(1581, 255, 'Sofa Cum Bed', 0, 'office a je rokom cilo shei rokomi hote hobe', 1, '13000', 13000, 'SCB001'),
(1583, 252, 'Pull Out Bed', 0, 'foam soho (b259 er bed er color ) tar uchu thakbe na   pashi chardige soman , chaka smooth hote hobe, drawer hatol wooden hobe', 1, '35000', 35000, 'SCB005'),
(1587, 251, 'Sofa', 0, '2+2+1 with pillow', 1, '27000', 27000, 'F404'),
(1588, 279, 'Wordrobe ', 0, 'test', 2, '2000', 4000, 'W306'),
(1589, 280, 'Sofa', 0, 'test', 3, '5000', 15000, 'CMZ005'),
(1590, 281, 'Almira', 0, 'test', 1, '50000', 50000, 'AA22');

-- --------------------------------------------------------

--
-- Table structure for table `ji_menus`
--

DROP TABLE IF EXISTS `ji_menus`;
CREATE TABLE IF NOT EXISTS `ji_menus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ji_menus`
--

INSERT INTO `ji_menus` (`id`, `name`) VALUES
(6, 'Menus'),
(7, 'Users'),
(8, 'Sales'),
(9, 'Payments'),
(10, 'Services'),
(11, 'Expenses'),
(12, 'Accounts'),
(13, 'Purchases'),
(14, 'Worker Managements'),
(15, 'Productions'),
(16, 'Stocks'),
(17, 'Marketing');

-- --------------------------------------------------------

--
-- Table structure for table `ji_menu_permissions`
--

DROP TABLE IF EXISTS `ji_menu_permissions`;
CREATE TABLE IF NOT EXISTS `ji_menu_permissions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ji_user_type_id` int(11) NOT NULL,
  `ji_menu_id` int(11) NOT NULL,
  `ji_sub_menu_id` int(11) NOT NULL,
  `view_status` int(1) NOT NULL DEFAULT '0',
  `create_status` int(1) NOT NULL DEFAULT '0',
  `edit_status` int(1) NOT NULL DEFAULT '0',
  `delete_status` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=121 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ji_menu_permissions`
--

INSERT INTO `ji_menu_permissions` (`id`, `ji_user_type_id`, `ji_menu_id`, `ji_sub_menu_id`, `view_status`, `create_status`, `edit_status`, `delete_status`) VALUES
(10, 1, 6, 17, 1, 1, 1, 1),
(11, 1, 6, 18, 1, 1, 1, 1),
(12, 1, 6, 19, 1, 1, 1, 1),
(13, 1, 7, 20, 1, 1, 1, 1),
(14, 1, 7, 21, 1, 1, 1, 1),
(15, 1, 7, 22, 1, 1, 1, 1),
(16, 1, 8, 23, 1, 1, 1, 1),
(17, 1, 8, 24, 1, 1, 1, 1),
(18, 1, 8, 25, 1, 1, 1, 1),
(19, 1, 8, 26, 1, 1, 1, 1),
(20, 1, 8, 27, 1, 1, 1, 1),
(21, 1, 8, 28, 1, 1, 1, 1),
(22, 1, 8, 29, 1, 1, 1, 1),
(23, 1, 8, 30, 1, 1, 1, 1),
(24, 1, 8, 31, 1, 1, 1, 1),
(25, 1, 9, 32, 1, 1, 1, 1),
(26, 1, 9, 33, 1, 1, 1, 1),
(27, 1, 9, 34, 1, 1, 1, 1),
(28, 1, 9, 35, 1, 1, 1, 1),
(29, 1, 9, 36, 1, 1, 1, 1),
(30, 1, 10, 37, 1, 1, 1, 1),
(31, 1, 10, 38, 1, 1, 1, 1),
(32, 1, 11, 39, 1, 1, 1, 1),
(33, 1, 11, 40, 1, 1, 1, 1),
(34, 1, 11, 41, 1, 1, 1, 1),
(35, 1, 11, 42, 1, 1, 1, 1),
(36, 1, 11, 43, 1, 1, 1, 1),
(37, 1, 12, 44, 1, 1, 1, 1),
(38, 1, 12, 45, 1, 1, 1, 1),
(39, 1, 12, 46, 1, 1, 1, 1),
(40, 1, 12, 47, 1, 1, 1, 1),
(41, 1, 12, 48, 1, 1, 1, 1),
(42, 1, 12, 49, 1, 1, 1, 1),
(43, 1, 12, 50, 1, 1, 1, 1),
(44, 1, 12, 51, 1, 1, 1, 1),
(45, 1, 12, 52, 1, 1, 1, 1),
(46, 1, 12, 53, 1, 1, 1, 1),
(47, 1, 13, 54, 1, 1, 1, 1),
(48, 1, 13, 55, 1, 1, 1, 1),
(49, 1, 13, 56, 1, 1, 1, 1),
(50, 1, 13, 57, 1, 1, 1, 1),
(51, 1, 13, 58, 1, 1, 1, 1),
(52, 1, 13, 59, 1, 1, 1, 1),
(53, 1, 14, 60, 1, 1, 1, 1),
(54, 1, 14, 61, 1, 1, 1, 1),
(55, 1, 14, 62, 1, 1, 1, 1),
(56, 1, 14, 63, 1, 1, 1, 1),
(57, 1, 14, 64, 1, 1, 1, 1),
(58, 1, 15, 65, 1, 1, 1, 1),
(59, 1, 15, 66, 1, 1, 1, 1),
(60, 1, 15, 67, 1, 1, 1, 1),
(61, 1, 15, 68, 1, 1, 1, 1),
(62, 1, 15, 69, 1, 1, 1, 1),
(63, 1, 16, 70, 1, 1, 1, 1),
(64, 1, 16, 71, 1, 1, 1, 1),
(65, 5, 6, 19, 1, 1, 1, 1),
(66, 5, 7, 20, 1, 1, 1, 0),
(67, 5, 7, 21, 1, 1, 1, 0),
(68, 5, 7, 22, 1, 1, 1, 0),
(69, 5, 8, 23, 1, 1, 1, 0),
(70, 5, 8, 24, 1, 1, 1, 0),
(71, 5, 8, 25, 1, 1, 1, 0),
(72, 5, 8, 26, 1, 1, 1, 0),
(73, 5, 8, 27, 1, 1, 1, 0),
(74, 5, 8, 28, 1, 1, 1, 0),
(75, 5, 8, 29, 1, 1, 1, 0),
(76, 5, 8, 30, 1, 1, 1, 0),
(77, 5, 8, 31, 1, 1, 1, 0),
(78, 5, 9, 32, 1, 1, 1, 0),
(79, 5, 9, 33, 1, 1, 1, 0),
(80, 5, 9, 34, 1, 1, 1, 0),
(81, 5, 9, 35, 1, 1, 1, 0),
(82, 5, 9, 36, 1, 1, 1, 0),
(83, 5, 10, 37, 1, 1, 1, 0),
(84, 5, 10, 38, 1, 1, 1, 0),
(85, 5, 11, 39, 1, 1, 1, 0),
(86, 5, 11, 40, 1, 1, 1, 0),
(87, 5, 11, 41, 1, 1, 1, 0),
(88, 5, 11, 42, 1, 1, 1, 0),
(89, 5, 11, 43, 1, 1, 1, 0),
(90, 5, 12, 44, 1, 1, 1, 0),
(91, 5, 12, 45, 1, 1, 1, 0),
(92, 5, 12, 46, 1, 1, 1, 0),
(93, 5, 12, 47, 1, 1, 1, 0),
(94, 5, 12, 48, 1, 1, 1, 0),
(95, 5, 12, 49, 1, 1, 1, 0),
(96, 5, 12, 50, 1, 1, 1, 0),
(97, 5, 12, 51, 1, 1, 1, 0),
(98, 5, 12, 52, 1, 1, 1, 0),
(99, 5, 12, 53, 1, 1, 1, 0),
(100, 5, 13, 54, 1, 1, 1, 0),
(101, 5, 13, 55, 1, 1, 1, 0),
(102, 5, 13, 56, 1, 1, 1, 0),
(103, 5, 13, 57, 1, 1, 1, 0),
(104, 5, 13, 58, 1, 1, 1, 0),
(105, 5, 13, 59, 1, 1, 1, 0),
(106, 5, 14, 60, 1, 1, 1, 0),
(107, 5, 14, 61, 1, 1, 1, 0),
(108, 5, 14, 62, 1, 1, 1, 0),
(109, 5, 14, 63, 1, 1, 1, 0),
(110, 5, 14, 64, 1, 1, 1, 0),
(111, 5, 15, 65, 1, 1, 1, 0),
(112, 5, 15, 66, 1, 1, 1, 0),
(113, 5, 15, 67, 1, 1, 1, 0),
(114, 5, 15, 68, 1, 1, 1, 0),
(115, 5, 15, 69, 1, 1, 1, 0),
(116, 5, 16, 70, 1, 1, 1, 0),
(117, 5, 16, 71, 1, 1, 1, 0),
(118, 1, 17, 73, 1, 1, 1, 1),
(119, 1, 17, 74, 1, 1, 1, 1),
(120, 1, 17, 75, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `ji_new_expanse`
--

DROP TABLE IF EXISTS `ji_new_expanse`;
CREATE TABLE IF NOT EXISTS `ji_new_expanse` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ji_user_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `user` int(11) NOT NULL DEFAULT '1',
  `remark` text NOT NULL,
  `net_total` varchar(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=70 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ji_new_expanse`
--

INSERT INTO `ji_new_expanse` (`id`, `ji_user_id`, `date`, `user`, `remark`, `net_total`) VALUES
(32, 0, '0000-00-00', 1, '', '5075.00'),
(33, 0, '0000-00-00', 1, '', '450.00'),
(34, 0, '0000-00-00', 1, '', '400.00'),
(35, 0, '0000-00-00', 1, '', '800.00'),
(36, 0, '0000-00-00', 1, '', '5075.00'),
(37, 0, '0000-00-00', 1, '', '2850.00'),
(38, 0, '0000-00-00', 1, '', '5940.00'),
(39, 0, '0000-00-00', 1, '', '3400.00'),
(40, 0, '0000-00-00', 1, '', '3620.00'),
(41, 0, '0000-00-00', 1, '', '4130.00'),
(42, 0, '0000-00-00', 1, '', '2430.00'),
(43, 0, '0000-00-00', 1, '', '4330.00'),
(44, 0, '0000-00-00', 1, '', '500.00'),
(45, 0, '0000-00-00', 1, '', '105.00'),
(47, 0, '0000-00-00', 1, '', '4340.00'),
(48, 0, '0000-00-00', 1, 'S318', '1000.00'),
(49, 0, '0000-00-00', 1, '', '27000.00'),
(51, 0, '0000-00-00', 1, '', '7190.00'),
(52, 0, '0000-00-00', 1, '', '105.00'),
(54, 0, '0000-00-00', 1, 'test', '22000.00'),
(57, 0, '0000-00-00', 1, 'test', '8000.00'),
(58, 0, '0000-00-00', 1, 'test', '17500.00'),
(59, 0, '0000-00-00', 1, 'test', '16500.00'),
(60, 0, '0000-00-00', 1, 'test', '7049.00'),
(62, 0, '2017-12-05', 1, 'test', '14000.00'),
(63, 1, '2017-12-07', 1, 'test', '15000.00'),
(65, 1, '2018-01-16', 2, 'test', '1300.00'),
(66, 1, '2018-03-28', 1, 'test', '2000.00'),
(67, 1, '2018-06-25', 1, 'test', '2000.00'),
(68, 1, '2018-06-21', 1, 'test', '500.00'),
(69, 1, '2018-08-11', 1, 'test', '5000.00');

-- --------------------------------------------------------

--
-- Table structure for table `ji_new_expanse_details`
--

DROP TABLE IF EXISTS `ji_new_expanse_details`;
CREATE TABLE IF NOT EXISTS `ji_new_expanse_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ji_new_expanse_id` int(11) NOT NULL,
  `expanse_name` varchar(255) NOT NULL,
  `expanse_category` varchar(255) NOT NULL,
  `account` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `amount` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=313 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ji_new_expanse_details`
--

INSERT INTO `ji_new_expanse_details` (`id`, `ji_new_expanse_id`, `expanse_name`, `expanse_category`, `account`, `description`, `amount`) VALUES
(103, 32, 'Transport', 'Transport', 'Factory Balance', 'Mirpur-1, ', '1000'),
(104, 32, 'Transport', 'Transport', 'Factory Balance', 'Tikatoli,', '900'),
(105, 32, 'Transport', 'Transport', 'Factory Balance', 'Van Board', '400'),
(106, 32, 'Worker Nasta', 'Meals', 'Factory Balance', 'Ajad', '275'),
(107, 32, 'Labour', 'Others', 'Factory Balance', 'Mirpur-1', '200'),
(108, 32, 'Service', 'Repair', 'Factory Balance', 'Compressor', '2000'),
(109, 32, 'Service', 'Repair', 'Factory Balance', 'Fan', '300'),
(110, 33, 'Office Others', 'Office Expense', 'Cash On Hand', 'watter+griz+ felexi load (P)', '450'),
(111, 34, 'Office Others', 'Office Expense', 'Cash On Hand', 'Medicine+jms vai\r\n', '400'),
(112, 35, 'Office Others', 'Office Expense', 'Cash On Hand', 'Net Bill', '800'),
(113, 36, 'Transport', 'Transport', 'Factory Balance', 'mirpur', '1000'),
(114, 36, 'Transport', 'Transport', 'Factory Balance', 'tikatuli', '900'),
(115, 36, 'Transport', 'Transport', 'Factory Balance', 'Van Board', '400'),
(116, 36, 'Worker Nasta', 'Meals', 'Factory Balance', 'Ajad', '275'),
(117, 36, 'Labour', 'Others', 'Factory Balance', 'Mirpur', '200'),
(118, 36, 'Service', 'Repair', 'Factory Balance', 'Compressor', '2000'),
(119, 36, 'Service', 'Repair', 'Factory Balance', 'Fan', '300'),
(120, 37, 'Transport', 'Transport', 'Factory Balance', 'Van', '500'),
(121, 37, 'Transport', 'Transport', 'Factory Balance', 'DOHS', '1500'),
(122, 37, 'Worker Nasta', 'Meals', 'Factory Balance', 'Nasta(D/N)', '350'),
(123, 37, 'Others', 'Others', 'Factory Balance', 'van factory cleam', '200'),
(124, 37, 'Others', 'Others', 'Factory Balance', 'Lebour(DOHS)', '300'),
(125, 38, 'Transport', 'Transport', 'Factory Balance', '300 fit pikup ', '1000'),
(126, 38, 'Transport', 'Transport', 'Factory Balance', 'Lalmatia', '1000'),
(127, 38, 'Transport', 'Transport', 'Factory Balance', 'Mirpur pikup & office Dinning table', '1500'),
(128, 38, 'Transport', 'Transport', 'Factory Balance', '300 fit-office pikup', '500'),
(129, 38, 'Worker Nasta', 'Meals', 'Factory Balance', 'Nasta(D/N)', '390'),
(130, 38, 'Others', 'Others', 'Factory Balance', 'Net Bill', '500'),
(131, 38, 'Others', 'Others', 'Factory Balance', 'Kating', '450'),
(132, 38, 'Labour', 'Others', 'Factory Balance', 'Lalmatia+Mirpur', '600'),
(133, 39, 'Noksha', 'Production Expense', 'Factory Balance', 'Ajad', '3400'),
(137, 41, 'Transport', 'Transport', 'Factory Balance', 'fac+office+fac', '1500'),
(138, 41, 'Electricity Bill', 'Utility', 'Factory Balance', 'Utility', '2420'),
(139, 41, 'Others', 'Others', 'Factory Balance', 'Print', '210'),
(140, 42, 'Transport', 'Transport', 'Factory Balance', 'van wood', '200'),
(141, 42, 'Transport', 'Transport', 'Factory Balance', 'van board', '300'),
(142, 42, 'Worker Nasta', 'Meals', 'Factory Balance', 'Nasta', '310'),
(143, 42, 'Others', 'Others', 'Factory Balance', 'Filter Watter(2)', '240'),
(144, 42, 'Others', 'Others', 'Factory Balance', 'Filter Watter(1)', '1380'),
(145, 43, 'Transport', 'Transport', 'Factory Balance', 'Mirzanagor', '4000'),
(146, 43, 'Worker Nasta', 'Meals', 'Factory Balance', 'Nasta', '330'),
(147, 44, 'Others', 'Others', 'Cash On Hand', 'Bazar+Rickshwa vara', '500'),
(148, 40, 'Office Exe.', 'Salary', 'Cash On Hand', 'Bua', '2000'),
(149, 40, 'Office Exe.', 'Salary', 'Cash On Hand', 'Monir', '1500'),
(150, 40, 'Office Exe.', 'Others', 'Cash On Hand', 'senary', '120'),
(153, 45, 'Office Others', 'Office Expense', 'Cash On Hand', 'tar,suitch bord,', '105'),
(154, 47, 'Transport', 'Transport', 'Factory Balance', 'Mirpur(U/P)', '1500'),
(155, 47, 'Transport', 'Transport', 'Factory Balance', 'van', '100'),
(156, 47, 'Worker Nasta', 'Meals', 'Factory Balance', 'Nasta', '240'),
(157, 47, 'Others', 'Others', 'Factory Balance', 'Van Run', '2500'),
(161, 48, 'Product Service', 'Repair', 'Factory Balance', 'Eqbal', '1000'),
(170, 51, 'Courier Charge', 'Courier', 'Cash On Hand', 'sofa+divan', '3800'),
(171, 51, 'Van Driver', 'Transport', 'Cash On Hand', 'T-Table+Rick', '3390'),
(175, 52, 'Office Exe.', 'Office Expense', 'Cash On Hand', 'File cover (4)', '80'),
(176, 52, 'Office Meals', 'Meals', 'Cash On Hand', 'Customar Nasta', '25'),
(215, 49, 'Office Exe.', 'Salary', 'Cash On Hand', 'Nahid', '8000'),
(216, 49, 'Office Exe.', 'Salary', 'Cash On Hand', 'Mim', '9000'),
(217, 49, 'Office Exe.', 'Salary', 'Cash On Hand', 'Rakib', '10000'),
(220, 54, 'Office Rent', 'Office Expense', 'Bank (James)', 'test', '12000'),
(221, 54, 'Product Service', 'Production Expense', 'Factory Balance', 'test', '10000'),
(226, 57, 'Office Rent', 'Office Expense', 'Bank (James)', 'test', '3000'),
(227, 57, 'Product Service', 'Production Expense', 'Bank (FurnitureBari)', 'test', '5000'),
(228, 58, 'Factory Rent', 'Utility', 'Factory Balance', 'test', '12000'),
(229, 58, 'Labour', 'Production Expense', 'Factory Balance', 'test', '5500'),
(230, 59, 'Office Rent', 'Office Expense', 'Bank (James)', 'test', '15000'),
(231, 59, 'Gas Bill', 'Utility', 'Bank (FurnitureBari)', 'test', '1500'),
(232, 60, 'Gas Bill', 'Utility', 'Bkash', 'test', '7049'),
(247, 62, 'Labour', 'Salary', 'Cash On Hand', 'test', '2000'),
(248, 62, 'Noksha', 'Production Expense', 'Cash On Hand', 'test', '12000'),
(270, 65, 'Noksha', 'Production Expense', 'Bank (FB)', 'test', '1300'),
(281, 63, 'Office Rent', 'Office Expense', 'Cash In Factory', 'test', '15000'),
(309, 66, 'Office Rent', 'Office Expense', 'Cash In Factory', 'test', '2000'),
(310, 67, 'Noksha', 'Production Expense', 'Cash In Factory', 'test', '2000'),
(311, 68, 'Noksha', 'Production Expense', 'Cash In Factory', 'test', '500'),
(312, 69, 'Noksha', 'Repair', 'Cash In Mirpur', 'test', '5000');

-- --------------------------------------------------------

--
-- Table structure for table `ji_order_by`
--

DROP TABLE IF EXISTS `ji_order_by`;
CREATE TABLE IF NOT EXISTS `ji_order_by` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_by_name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ji_order_by`
--

INSERT INTO `ji_order_by` (`id`, `order_by_name`) VALUES
(2, 'Show Room'),
(3, 'Online');

-- --------------------------------------------------------

--
-- Table structure for table `ji_payment`
--

DROP TABLE IF EXISTS `ji_payment`;
CREATE TABLE IF NOT EXISTS `ji_payment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ji_user_id` int(11) NOT NULL,
  `ji_invoice_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `payment_type` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `reference_no` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `account_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `amount` int(11) NOT NULL,
  `remarks` text COLLATE utf8_unicode_ci,
  `status` enum('0','1') COLLATE utf8_unicode_ci DEFAULT '1',
  `receive_status` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=488 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ji_payment`
--

INSERT INTO `ji_payment` (`id`, `ji_user_id`, `ji_invoice_id`, `date`, `payment_type`, `reference_no`, `account_name`, `amount`, `remarks`, `status`, `receive_status`) VALUES
(372, 0, 213, '2017-08-04', 'Cash', 'Advance', 'Cash On Hand', 2000, '', '1', 0),
(373, 0, 214, '2017-08-04', 'Bkash', 'Advance', 'Bkash', 2000, '', '1', 0),
(374, 0, 215, '2017-08-04', 'Cash', 'Advance', 'Cash On Hand', 1000, '', '1', 0),
(376, 0, 220, '2017-08-05', 'Bkash', 'Advance', 'Bkash', 1000, '', '1', 0),
(377, 0, 222, '2017-08-05', 'Cash', 'Advance', 'Cash On Hand', 2000, '', '1', 0),
(378, 0, 223, '2017-08-05', 'Bank', 'Advance', 'Bank (James)', 20000, '', '1', 0),
(379, 0, 224, '2017-08-05', 'Bkash', 'Advance', 'Bkash', 5000, '', '1', 0),
(380, 0, 225, '2017-08-05', 'Cash', 'Advance', 'Cash On Hand', 2000, '', '1', 0),
(381, 0, 226, '2017-08-05', 'Bkash', 'Advance', 'Cash On Hand', 3000, '', '1', 0),
(382, 0, 227, '2017-08-05', 'Bkash', 'Advance', 'Bkash', 1000, '', '1', 0),
(383, 0, 228, '2017-08-05', 'Cash', 'Advance', 'Cash On Hand', 5000, '', '1', 0),
(384, 0, 229, '2017-08-05', 'Cash', 'Advance', 'Cash On Hand', 1000, '', '1', 0),
(385, 0, 220, '2017-08-03', 'Cash', 'Delivery', 'Factory Balance', 12500, 'Ajad', '1', 0),
(386, 0, 230, '2017-08-06', 'Bkash', 'Advance', 'Bkash', 2000, '', '1', 0),
(387, 0, 231, '2017-08-06', 'Cash', 'Advance', 'Cash On Hand', 10000, '', '1', 0),
(388, 0, 232, '2017-08-06', 'Cash', 'Advance', 'Cash On Hand', 1000, '', '1', 0),
(389, 0, 233, '2017-08-06', 'Cash', 'Advance', 'Cash On Hand', 20000, '', '1', 0),
(390, 0, 234, '2017-08-06', 'Cash', 'Advance', 'Cash On Hand', 2000, '', '1', 0),
(391, 0, 235, '2017-08-06', 'Bkash', 'Advance', 'Bkash', 1000, '', '1', 0),
(392, 0, 236, '2017-08-06', 'Bkash', 'Advance', 'Cash On Hand', 1000, '', '1', 0),
(393, 0, 237, '2017-08-06', 'Cash', 'Advance', 'Cash On Hand', 5000, '', '1', 0),
(394, 0, 238, '2017-08-06', 'Bkash', 'Advance', 'Bkash', 1000, '', '1', 0),
(395, 0, 239, '2017-08-06', 'Cash', 'Advance', 'Cash On Hand', 10000, '', '1', 0),
(396, 0, 240, '2017-08-06', 'Cash', 'Advance', 'Cash On Hand', 2000, '', '1', 0),
(397, 0, 241, '2017-08-06', 'Cash', 'Advance', 'Cash On Hand', 2000, '', '1', 0),
(398, 0, 242, '2017-08-06', 'Cash', 'Advance', 'Cash On Hand', 50000, '', '1', 0),
(399, 0, 243, '2017-08-06', 'Bkash', 'Advance', 'Bkash', 3000, '', '1', 0),
(400, 0, 244, '2017-08-06', 'Bkash', 'Advance', 'Bkash', 2000, '', '1', 0),
(401, 0, 245, '2017-08-06', 'Cash', 'Advance', 'Cash On Hand', 1000, '', '1', 0),
(402, 0, 246, '2017-08-06', 'Cash', 'Advance', 'Cash On Hand', 20000, '', '1', 0),
(403, 0, 247, '2017-08-08', 'Bkash', 'Advance', 'Bkash', 1500, '', '1', 0),
(404, 0, 227, '2017-08-01', 'Cash', 'Delivery', 'Factory Balance', 12500, 'Ajad', '1', 0),
(405, 0, 229, '2017-08-01', 'Cash', 'Delivery', 'Factory Balance', 15500, 'Ajad', '1', 0),
(406, 0, 232, '2017-08-02', 'Cash', 'Delivery', 'Factory Balance', 12500, '', '1', 0),
(407, 0, 248, '2017-08-03', 'Cash', 'Delivery', 'Factory Balance', 30000, 'Ajad', '1', 0),
(408, 0, 236, '2017-08-03', 'Cash', 'Delivery', 'Factory Balance', 22000, 'Ajad', '1', 0),
(409, 0, 231, '2017-08-06', 'Cash', 'Delivery', 'Factory Balance', 50000, 'Ajad', '1', 0),
(410, 0, 237, '2017-08-06', 'Cash', 'Delivery', 'Factory Balance', 19000, 'Ajad', '1', 0),
(411, 0, 213, '2017-08-07', 'Cash', 'Delivery', 'Factory Balance', 11500, 'Ajad', '1', 0),
(412, 0, 225, '2017-08-07', 'Cash', 'Delivery', 'Factory Balance', 27000, 'Ajad', '1', 0),
(413, 0, 251, '2017-08-10', 'Bkash', 'Advance', 'Bkash', 3000, '', '1', 0),
(414, 0, 252, '2017-08-10', 'Cash', 'Advance', 'Cash On Hand', 2000, '', '1', 0),
(415, 0, 253, '2017-08-10', 'Bkash', 'Advance', 'Bkash', 4000, '', '1', 0),
(416, 0, 249, '2017-08-09', 'Bkash', 'Advance', 'Bkash', 5000, '', '1', 0),
(417, 0, 250, '2017-08-10', 'Cash', 'Advance', 'Cash On Hand', 2000, '', '1', 0),
(418, 0, 254, '2017-08-11', 'Bkash', 'Advance', 'Bkash', 10000, '', '1', 0),
(419, 0, 233, '2017-08-11', 'Cash', 'Advance', 'Cash On Hand', 10000, '', '1', 0),
(420, 0, 228, '2017-08-10', 'Cash', 'Delivery', 'Factory Balance', 45000, 'Jikrul', '1', 0),
(421, 0, 247, '2017-08-10', 'Cash', 'Delivery', 'Factory Balance', 15500, 'Jikrul', '1', 0),
(422, 0, 255, '2017-08-11', 'Bkash', 'Advance', 'Cash On Hand', 1000, '', '1', 0),
(423, 0, 261, '2017-08-11', 'Cash', 'Delivery', 'Cash On Hand', 12500, '', '1', 0),
(424, 0, 264, '2017-08-12', 'Bkash', 'Advance', 'Bkash', 3000, '', '1', 0),
(425, 0, 265, '2017-08-12', 'Cash', 'Advance', 'Cash On Hand', 1000, '', '1', 0),
(426, 0, 266, '2017-08-12', 'Bkash', 'Advance', 'Bkash', 3500, '', '1', 0),
(427, 0, 222, '2017-08-17', 'Cash', 'Delivery', 'Cash On Hand', 40000, 'nothing', '1', 0),
(428, 0, 267, '2017-08-13', 'Bkash', 'Advance', 'Bkash', 5000, '', '1', 0),
(429, 0, 268, '2017-08-13', 'Cash', 'Advance', 'Cash On Hand', 23000, '', '0', 0),
(430, 0, 267, '2017-08-17', 'Cash', 'Advance', 'Factory Balance', 1000, '', '1', 0),
(431, 0, 267, '2017-09-26', 'Cash', 'Advance', 'Cash On Hand', 1000, '', '1', 0),
(432, 0, 214, '2017-10-02', 'Bank', 'Delivery', 'Bank (FurnitureBari)', 4000, 'test', '0', 0),
(433, 0, 214, '2017-10-02', 'Bank', 'Delivery', 'Bank (FurnitureBari)', 5000, 'test', '0', 0),
(434, 0, 214, '2017-10-02', 'Bank', 'Delivery', 'Bank (FurnitureBari)', 5000, 'test', '0', 0),
(435, 0, 214, '2017-10-02', 'Bank', 'Delivery', 'Bank (FurnitureBari)', 5000, 'test', '0', 0),
(436, 0, 214, '2017-10-02', 'Bank', 'Delivery', 'Bank (FurnitureBari)', 5000, 'test', '0', 0),
(437, 0, 214, '2017-10-02', 'Bank', 'Delivery', 'Bank (FurnitureBari)', 5000, 'test', '0', 0),
(438, 0, 214, '2017-10-02', 'Bank', 'Delivery', 'Bank (FurnitureBari)', 5000, 'test', '0', 0),
(439, 0, 214, '2017-10-02', 'Bank', 'Delivery', 'Bank (FurnitureBari)', 5000, 'test', '0', 0),
(440, 0, 214, '2017-10-02', 'Bank', 'Delivery', 'Bank (FurnitureBari)', 5000, 'test', '0', 0),
(441, 0, 214, '2017-10-02', 'Bank', 'Delivery', 'Bank (FurnitureBari)', 5000, 'test', '0', 0),
(442, 0, 215, '2017-10-08', 'Cash', 'Advance', 'Cash On Hand', 3000, 'test', '1', 0),
(443, 0, 214, '2017-10-08', 'Cash', 'Advance', 'Cash On Hand', 25000, 'Test', '1', 0),
(444, 0, 214, '2017-10-08', 'Bkash', 'Advance', 'Bkash', 3000, 'Test', '1', 0),
(445, 0, 214, '2017-10-08', 'Bank', 'Advance', 'Bank (FurnitureBari)', 27000, 'test', '1', 0),
(446, 0, 214, '2017-10-08', 'Bank', 'Advance', 'Bank (FurnitureBari)', 30000, 'test', '1', 0),
(447, 0, 220, '2017-10-08', 'Cash', 'Advance', 'Bkash', 2000, 'test', '1', 0),
(448, 0, 225, '2017-10-12', 'Cash', 'Advance', 'Bank (James)', 30000, 'test', '1', 0),
(449, 0, 267, '2017-11-03', 'Bank', 'Delivery', 'Bank (FurnitureBari)', 6500, 'test', '1', 0),
(450, 0, 214, '2017-11-11', 'Cash', 'Advance', 'Bank (James)', 2500, 'test', '1', 0),
(451, 0, 231, '2017-11-19', 'Cash', 'Advance', 'Bkash', 3500, 'test', '1', 0),
(452, 0, 234, '2017-11-19', 'Cash', 'Advance', 'Cash On Hand', 5000, 'test', '1', 0),
(453, 0, 231, '2017-11-19', 'Cash', 'Advance', 'Cash On Hand', 7000, 'test', '1', 0),
(454, 0, 224, '2017-11-19', 'Cash', 'Advance', 'Cash On Hand', 5000, 'test', '1', 0),
(455, 0, 267, '2017-11-19', 'Cash', 'Advance', 'Bkash', 2000, 'test', '1', 0),
(456, 0, 215, '2017-11-19', 'Cash', 'Advance', 'Bank (James)', 3000, 'test', '0', 0),
(457, 0, 267, '2018-01-02', 'Cash', 'Advance', 'Bank (FurnitureBari)', 30000, 'test', '1', 0),
(458, 0, 225, '2018-01-02', 'Cash', 'Advance', 'Bkash', 15000, 'test', '1', 0),
(459, 1, 235, '2018-03-20', 'Cash', 'Advance', 'Cash In Mirpur', 30000, 'test', '1', 0),
(460, 1, 266, '2018-05-15', 'Cash', 'Advance', 'Bank (FB)', 5500, 'test', '1', 0),
(461, 1, 266, '2018-05-15', 'Cash', 'Advance', 'Bank (FB)', 5500, 'test', '1', 0),
(462, 1, 266, '2018-05-15', 'Cash', 'Advance', 'Bank (FB)', 2500, 'test', '1', 0),
(463, 1, 266, '2018-05-15', 'Cash', 'Delivery', 'Bank (FB)', 12500, 'test', '1', 0),
(464, 1, 266, '2018-05-15', 'Cash', 'Delivery', 'Bank (FB)', 35000, 'test', '1', 0),
(465, 1, 265, '2018-05-15', 'Cash', 'Delivery', 'Cash In Factory', 25000, 'test', '1', 0),
(466, 1, 264, '2018-05-15', 'Cash', 'Advance', 'Bkash', 5000, 'test', '1', 0),
(467, 1, 264, '2018-05-15', 'Cash', 'Advance', 'Bkash', 5000, 'test', '1', 0),
(468, 1, 255, '2018-05-15', 'Cash', 'Advance', 'Bkash', 2500, 'test', '1', 0),
(469, 1, 275, '2018-05-21', 'Cash', 'Advance', 'Bank (FB)', 1500, 'test', '1', 0),
(470, 1, 222, '2018-05-21', 'Bkash', 'Delivery', 'Bkash', 3000, 'test', '1', 0),
(471, 1, 215, '2018-05-21', 'Cash', 'Delivery', 'Bank (FB)', 2000, 'test', '0', 0),
(472, 1, 220, '2018-05-21', 'Cash', 'Delivery', 'Bank (FB)', 2500, 'test', '0', 0),
(473, 1, 221, '2018-05-21', 'Bkash', 'Advance', 'Bkash', 3500, 'test', '1', 0),
(474, 1, 264, '2018-05-21', 'Cash', 'Delivery', 'Bank (FB)', 5000, 'test', '1', 0),
(475, 1, 264, '2018-05-21', 'Cash', 'Advance', 'Bank (FB)', 1000, 'test', '1', 0),
(476, 1, 255, '2018-05-21', 'Cash', 'Advance', 'Bkash', 2500, '', '1', 0),
(477, 1, 232, '2018-06-25', 'Cash', 'Delivery', 'Cash In Mirpur', 500, 'test', '1', 0),
(478, 1, 222, '2018-06-25', 'Cash', 'Delivery', 'Bkash', 1500, 'test', '1', 0),
(479, 1, 222, '2018-06-25', 'Cash', 'Delivery', 'Bkash', 1500, 'test', '1', 0),
(480, 1, 224, '2018-06-25', 'Cash', 'Delivery', 'Cash In Mirpur', 500, 'test', '1', 0),
(481, 1, 224, '2018-06-25', 'Cash', 'Delivery', 'Cash In Mirpur', 500, 'test', '1', 0),
(482, 1, 224, '2018-06-25', 'Cash', 'Delivery', 'Cash In Mirpur', 500, 'test', '1', 0),
(483, 1, 222, '2018-06-25', 'Cash', 'Delivery', 'Bkash', 1500, 'test', '1', 0),
(484, 1, 214, '2018-06-25', 'Cash', 'Advance', 'Cash In Mirpur', 1500, 'test', '1', 0),
(485, 1, 214, '2018-06-25', 'Cash', 'Advance', 'Cash In Mirpur', 1500, 'test', '1', 1),
(486, 1, 275, '2018-06-25', 'Bkash', 'Advance', 'Cash In Factory', 5000, 'test', '1', 1),
(487, 1, 281, '2018-12-08', 'Cash', 'Delivery', 'Bank (FB)', 50000, 'test', '1', 0);

-- --------------------------------------------------------

--
-- Table structure for table `ji_payment_type`
--

DROP TABLE IF EXISTS `ji_payment_type`;
CREATE TABLE IF NOT EXISTS `ji_payment_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ji_payment_type`
--

INSERT INTO `ji_payment_type` (`id`, `type`) VALUES
(4, 'Cash'),
(5, 'Bkash'),
(6, 'Bank');

-- --------------------------------------------------------

--
-- Table structure for table `ji_production_activity`
--

DROP TABLE IF EXISTS `ji_production_activity`;
CREATE TABLE IF NOT EXISTS `ji_production_activity` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `activity` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ji_production_activity`
--

INSERT INTO `ji_production_activity` (`id`, `activity`) VALUES
(5, 'Plan/Budget'),
(6, 'Frame'),
(7, 'Foam Pasting'),
(8, 'Noksha'),
(9, 'Coloring'),
(10, 'Jali'),
(11, 'QC'),
(12, 'Finishing');

-- --------------------------------------------------------

--
-- Table structure for table `ji_production_activity_item`
--

DROP TABLE IF EXISTS `ji_production_activity_item`;
CREATE TABLE IF NOT EXISTS `ji_production_activity_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item_name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ji_production_activity_item`
--

INSERT INTO `ji_production_activity_item` (`id`, `item_name`) VALUES
(18, 'Sofa Item'),
(19, 'Board Item');

-- --------------------------------------------------------

--
-- Table structure for table `ji_production_activity_item_details`
--

DROP TABLE IF EXISTS `ji_production_activity_item_details`;
CREATE TABLE IF NOT EXISTS `ji_production_activity_item_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ji_production_activity_item_id` int(11) NOT NULL,
  `activity` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=66 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ji_production_activity_item_details`
--

INSERT INTO `ji_production_activity_item_details` (`id`, `ji_production_activity_item_id`, `activity`) VALUES
(53, 18, 'Plan/Budget'),
(54, 18, 'Frame'),
(55, 18, 'Foam Pasting'),
(56, 18, 'Noksha'),
(57, 18, 'Coloring'),
(58, 18, 'QC'),
(59, 19, 'Plan/Budget'),
(60, 19, 'Jali'),
(61, 19, 'Noksha'),
(62, 19, 'Frame'),
(63, 19, 'Coloring'),
(64, 19, 'Finishing'),
(65, 19, 'QC');

-- --------------------------------------------------------

--
-- Table structure for table `ji_production_budget`
--

DROP TABLE IF EXISTS `ji_production_budget`;
CREATE TABLE IF NOT EXISTS `ji_production_budget` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` varchar(255) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `item_code` varchar(255) NOT NULL,
  `invoice_no` varchar(255) NOT NULL,
  `po_id` varchar(255) NOT NULL,
  `total_material_qty` varchar(255) NOT NULL,
  `total_material_amount` varchar(255) NOT NULL,
  `total_operational_qty` varchar(255) NOT NULL,
  `total_operational_amount` varchar(255) NOT NULL,
  `total_qty` varchar(255) NOT NULL,
  `total_amount` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ji_production_budget`
--

INSERT INTO `ji_production_budget` (`id`, `date`, `item_name`, `item_code`, `invoice_no`, `po_id`, `total_material_qty`, `total_material_amount`, `total_operational_qty`, `total_operational_amount`, `total_qty`, `total_amount`) VALUES
(12, '08/10/2017', 'Two Stored Bed', 'HD016', '0817223', 'PO-020', '12', '20650.77', '2', '7000.00', '14', '27650.77'),
(13, '07/28/2018', 'Two Stored Bed', 'HD016', '0817223', 'PO-020', '12', '20650.77', '2', '7000.00', '14', '27650.77');

-- --------------------------------------------------------

--
-- Table structure for table `ji_production_cost`
--

DROP TABLE IF EXISTS `ji_production_cost`;
CREATE TABLE IF NOT EXISTS `ji_production_cost` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` varchar(255) NOT NULL,
  `invoice_no` varchar(255) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `item_code` varchar(255) NOT NULL,
  `po_id` varchar(255) NOT NULL,
  `total_material_qty` varchar(255) NOT NULL,
  `total_material_amount` varchar(255) NOT NULL,
  `total_operational_qty` varchar(255) NOT NULL,
  `total_operational_amount` varchar(255) NOT NULL,
  `total_qty` varchar(255) NOT NULL,
  `total_amount` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ji_production_material_budget`
--

DROP TABLE IF EXISTS `ji_production_material_budget`;
CREATE TABLE IF NOT EXISTS `ji_production_material_budget` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ji_production_budget_id` int(11) NOT NULL,
  `purchase_item` varchar(255) NOT NULL,
  `purchase_item_code` varchar(255) NOT NULL,
  `qty` varchar(255) NOT NULL,
  `unit_price` varchar(255) NOT NULL,
  `total` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ji_production_material_budget`
--

INSERT INTO `ji_production_material_budget` (`id`, `ji_production_budget_id`, `purchase_item`, `purchase_item_code`, `qty`, `unit_price`, `total`) VALUES
(18, 12, 'Keroshin', 'BATAM', '3.93', '789', '3100.77'),
(19, 12, 'Fly Board', 'GORJON PLY', '2', '2100', '4200.00'),
(20, 12, 'MDF', '4X8X18MM', '2', '1700', '3400.00'),
(21, 12, 'Hardware', 'OTHERS', '1', '1000', '1000.00'),
(22, 12, 'Hardware', 'OTHERS', '1', '4000', '4000.00'),
(23, 12, 'Foam', '4', '3', '1650', '4950.00'),
(24, 13, 'Keroshin', 'BATAM', '3.93', '789', '3100.77'),
(25, 13, 'Fly Board', 'GORJON PLY', '2', '2100', '4200.00'),
(26, 13, 'MDF', '4X8X18MM', '2', '1700', '3400.00'),
(27, 13, 'Hardware', 'OTHERS', '1', '1000', '1000.00'),
(28, 13, 'Hardware', 'OTHERS', '1', '4000', '4000.00'),
(29, 13, 'Foam', '4', '3', '1650', '4950.00');

-- --------------------------------------------------------

--
-- Table structure for table `ji_production_material_cost`
--

DROP TABLE IF EXISTS `ji_production_material_cost`;
CREATE TABLE IF NOT EXISTS `ji_production_material_cost` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ji_production_cost_id` int(11) NOT NULL,
  `purchase_item` varchar(255) NOT NULL,
  `purchase_item_code` varchar(255) NOT NULL,
  `qty` varchar(255) NOT NULL,
  `unit_price` varchar(255) NOT NULL,
  `total` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ji_production_operation_budget`
--

DROP TABLE IF EXISTS `ji_production_operation_budget`;
CREATE TABLE IF NOT EXISTS `ji_production_operation_budget` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ji_production_budget_id` int(11) NOT NULL,
  `activity` varchar(255) NOT NULL,
  `qty` varchar(255) NOT NULL,
  `unit_price` varchar(255) NOT NULL,
  `total` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ji_production_operation_budget`
--

INSERT INTO `ji_production_operation_budget` (`id`, `ji_production_budget_id`, `activity`, `qty`, `unit_price`, `total`) VALUES
(20, 12, 'Frame', '1', '4000', '4000.00'),
(21, 12, 'Coloring', '1', '3000', '3000.00'),
(22, 13, 'Frame', '1', '4000', '4000.00'),
(23, 13, 'Coloring', '1', '3000', '3000.00');

-- --------------------------------------------------------

--
-- Table structure for table `ji_production_operation_cost`
--

DROP TABLE IF EXISTS `ji_production_operation_cost`;
CREATE TABLE IF NOT EXISTS `ji_production_operation_cost` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ji_production_cost_id` int(11) NOT NULL,
  `activity` varchar(255) NOT NULL,
  `qty` varchar(255) NOT NULL,
  `unit_price` varchar(255) NOT NULL,
  `total` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ji_production_process`
--

DROP TABLE IF EXISTS `ji_production_process`;
CREATE TABLE IF NOT EXISTS `ji_production_process` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `invoice_no` varchar(255) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `item_code` varchar(255) NOT NULL,
  `po_id` varchar(255) NOT NULL,
  `stock_status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ji_production_process`
--

INSERT INTO `ji_production_process` (`id`, `invoice_no`, `item_name`, `item_code`, `po_id`, `stock_status`) VALUES
(20, 'Select An Invoice', 'Sofa', 'H2012L', 'PO-01', 1),
(21, '0817223', 'Two Stored Bed', 'HD016', 'PO-020', 0),
(22, 'Select An Invoice', 'Sofa', 'H2012L', 'PO-021', 1),
(23, '0817247', 'Sofa', 'CMZ005', 'PO-022', 0),
(24, 'Select An Invoice', 'Sofa Cum Bed', 'SCB001', 'PO-023', 1),
(25, 'Select An Invoice', 'Sofa Cum Bed', 'SCB001', 'PO-024', 1),
(26, 'Select An Invoice', 'Sofa Cum Bed', 'SCB001', 'PO-025', 1),
(27, 'Select An Invoice', 'Sofa Cum Bed', 'SCB001', 'PO-026', 1),
(28, 'Select An Invoice', 'Sofa Cum Bed', 'SCB001', 'PO-027', 1),
(29, '0817227', 'Sofa', 'W156', 'PO-028', 0),
(30, 'Select An Invoice', 'Sofa', 'W156', 'PO-029', 1),
(31, 'Select An Invoice', 'Almira', 'A320', 'PO-030', 1),
(32, '0817241', 'Bed Set', 'P314', 'PO-031', 0);

-- --------------------------------------------------------

--
-- Table structure for table `ji_production_process_details`
--

DROP TABLE IF EXISTS `ji_production_process_details`;
CREATE TABLE IF NOT EXISTS `ji_production_process_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ji_production_process_id` int(11) NOT NULL,
  `activity` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=259 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ji_production_process_details`
--

INSERT INTO `ji_production_process_details` (`id`, `ji_production_process_id`, `activity`, `status`) VALUES
(195, 20, 'Plan/Budget', 'Complete'),
(196, 20, 'Frame', 'Complete'),
(197, 20, 'Foam Pasting', 'Pending'),
(198, 20, 'Noksha', 'Pending'),
(199, 20, 'Coloring', 'Pending'),
(200, 20, 'QC', 'Pending'),
(201, 21, 'Plan/Budget', 'Pending'),
(202, 21, 'Frame', 'Pending'),
(203, 21, 'Coloring', 'Pending'),
(204, 21, 'Finishing', 'Pending'),
(205, 21, 'QC', 'Pending'),
(206, 22, 'Plan/Budget', 'Pending'),
(207, 22, 'Frame', 'Pending'),
(208, 22, 'Foam Pasting', 'Pending'),
(209, 22, 'Coloring', 'Pending'),
(210, 22, 'QC', 'Pending'),
(211, 23, 'Plan/Budget', 'Pending'),
(212, 23, 'Frame', 'Pending'),
(213, 23, 'Foam Pasting', 'Pending'),
(214, 23, 'QC', 'Pending'),
(215, 24, 'Plan/Budget', 'Pending'),
(216, 24, 'Frame', 'Pending'),
(217, 24, 'Foam Pasting', 'Pending'),
(218, 24, 'QC', 'Pending'),
(219, 25, 'Plan/Budget', 'Pending'),
(220, 25, 'Frame', 'Pending'),
(221, 25, 'Foam Pasting', 'Pending'),
(222, 25, 'QC', 'Pending'),
(223, 26, 'Plan/Budget', 'Pending'),
(224, 26, 'Frame', 'Pending'),
(225, 26, 'Foam Pasting', 'Pending'),
(226, 26, 'QC', 'Pending'),
(227, 27, 'Plan/Budget', 'Pending'),
(228, 27, 'Frame', 'Pending'),
(229, 27, 'Foam Pasting', 'Pending'),
(230, 27, 'QC', 'Pending'),
(231, 28, 'Plan/Budget', 'Pending'),
(232, 28, 'Frame', 'Pending'),
(233, 28, 'Foam Pasting', 'Pending'),
(234, 28, 'QC', 'Pending'),
(235, 29, 'Plan/Budget', 'Pending'),
(236, 29, 'Frame', 'Pending'),
(237, 29, 'Foam Pasting', 'Pending'),
(238, 29, 'Coloring', 'Pending'),
(239, 29, 'QC', 'Pending'),
(240, 30, 'Plan/Budget', 'Pending'),
(241, 30, 'Frame', 'Pending'),
(242, 30, 'Foam Pasting', 'Pending'),
(243, 30, 'Coloring', 'Pending'),
(244, 30, 'QC', 'Pending'),
(245, 31, 'Plan/Budget', 'Pending'),
(246, 31, 'Jali', 'Pending'),
(247, 31, 'Noksha', 'Pending'),
(248, 31, 'Frame', 'Pending'),
(249, 31, 'Coloring', 'Pending'),
(250, 31, 'Finishing', 'Pending'),
(251, 31, 'QC', 'Pending'),
(252, 32, 'Plan/Budget', 'Pending'),
(253, 32, 'Jali', 'Pending'),
(254, 32, 'Noksha', 'Pending'),
(255, 32, 'Frame', 'Pending'),
(256, 32, 'Coloring', 'Pending'),
(257, 32, 'Finishing', 'Pending'),
(258, 32, 'QC', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `ji_product_item`
--

DROP TABLE IF EXISTS `ji_product_item`;
CREATE TABLE IF NOT EXISTS `ji_product_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item_name` varchar(100) NOT NULL,
  `item_code` varchar(100) NOT NULL,
  `item_group` varchar(100) NOT NULL,
  `purchase_item` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=78 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ji_product_item`
--

INSERT INTO `ji_product_item` (`id`, `item_name`, `item_code`, `item_group`, `purchase_item`) VALUES
(28, 'Sofa Cum Bed', 'SCB001', 'Inventory', 0),
(29, 'Sofa Cum Bed', 'SCB004', 'Inventory', 0),
(30, 'Almira', 'A313', 'Inventory', 1),
(31, 'Sofa', 'S318', 'Inventory', 0),
(32, 'Sofa', 'WS01', 'Inventory', 0),
(33, 'Divan', 'DV251', 'Inventory', 1),
(34, 'Two Stored Bed', 'HD016', 'Inventory', 0),
(35, 'Bed Set', 'P201', 'Inventory', 1),
(36, 'Divan', 'DV207', 'Inventory', 1),
(37, 'Dinning Table', 'DT207', 'Inventory', 1),
(38, 'Dinning Table', 'DT301', 'Inventory', 1),
(39, 'Sofa', 'H013', 'Inventory', 1),
(40, 'Dinning Table', 'DT215', 'Inventory', 1),
(41, 'Sofa', 'W156', 'Inventory', 0),
(42, 'Sofa', 'H2012L', 'Inventory', 0),
(43, 'Coffee Table', 'GT100', 'Inventory', 0),
(44, 'Sofa', 'H2012W', 'Inventory', 0),
(45, 'Divan', 'DV64', 'Inventory', 0),
(46, 'Sofa', 'S004', 'Inventory', 1),
(47, 'Sofa', 'S021', 'Inventory', 1),
(48, 'Showcase', 'S204', 'Inventory', 1),
(49, 'Wordrobe ', 'W306', 'Inventory', 1),
(50, 'Sofa', 'S602', 'Inventory', 1),
(51, 'Dinning Table', 'DT213', 'Inventory', 0),
(52, 'Bookself', 'HD016', 'Inventory', 0),
(53, 'Coffee Table', 'HD025', 'Inventory', 0),
(54, 'Showcase', 'SG100', 'Inventory', 1),
(55, 'C.Table', 'CT100', 'Inventory', 0),
(56, 'Bed Set', 'P314', 'Inventory', 0),
(57, 'Sofa', 'W153', 'Inventory', 0),
(58, 'Sofa', 'H548', 'Inventory', 1),
(59, 'Woven Box', 'CMZ01', 'Inventory', 0),
(60, 'Showcase', 'CMZ02', 'Inventory', 0),
(61, 'Showbox', 'CMZ03', 'Inventory', 0),
(62, 'Wordrobe ', 'CMZ04', 'Inventory', 0),
(63, 'Bed', 'B322', 'Inventory', 0),
(64, 'Showcase', 'S212', 'Inventory', 0),
(65, 'Almira', 'AA22', 'Inventory', 1),
(66, 'Bed', 'B259', 'Inventory', 0),
(67, 'Pull Out Bed', 'SCB005', 'Inventory', 0),
(68, 'Bed Side', 'BS210', 'Inventory', 0),
(69, 'Bed', 'B263', 'Inventory', 0),
(70, 'Sofa', 'CMZ005', 'Inventory', 0),
(71, 'Sofa', 'F151', 'Inventory', 1),
(72, 'Sofa', 'F156', 'Inventory', 1),
(73, 'Sofa', 'F404', 'Inventory', 0),
(74, 'Chair', 'DT215', 'Inventory', 1),
(75, 'Almira', 'A320', 'Inventory', 1),
(76, 'Pull Out Bed', 'W159', 'Inventory', 0),
(77, 'Pull Out Bed', 'F155', 'Inventory', 0);

-- --------------------------------------------------------

--
-- Table structure for table `ji_product_item_group`
--

DROP TABLE IF EXISTS `ji_product_item_group`;
CREATE TABLE IF NOT EXISTS `ji_product_item_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item_group_name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ji_product_item_group`
--

INSERT INTO `ji_product_item_group` (`id`, `item_group_name`) VALUES
(6, 'Inventory');

-- --------------------------------------------------------

--
-- Table structure for table `ji_product_item_name`
--

DROP TABLE IF EXISTS `ji_product_item_name`;
CREATE TABLE IF NOT EXISTS `ji_product_item_name` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item_name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ji_product_item_name`
--

INSERT INTO `ji_product_item_name` (`id`, `item_name`) VALUES
(5, 'Sofa'),
(6, 'Showcase'),
(7, 'Showbox'),
(8, 'Dinning Table'),
(9, 'Sofa Cum Bed'),
(10, 'Dressing Table'),
(11, 'Divan'),
(12, 'Bed'),
(13, 'Almira'),
(14, 'Bookself'),
(15, 'Chair'),
(16, 'Coffee Table'),
(17, 'Wordrobe '),
(18, 'Woven Box'),
(19, 'Kitchen  Cabinet '),
(20, 'Board'),
(21, 'Bed Side'),
(22, 'Reading Table'),
(23, 'Two Stored Bed'),
(24, 'Pull Out Bed'),
(25, 'Table'),
(26, 'Bed Set'),
(27, 'Board Item'),
(28, 'Sofa Item'),
(29, 'C.Table'),
(30, 'Pull Out Bed');

-- --------------------------------------------------------

--
-- Table structure for table `ji_purchase_bills`
--

DROP TABLE IF EXISTS `ji_purchase_bills`;
CREATE TABLE IF NOT EXISTS `ji_purchase_bills` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ji_user_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `supplier` varchar(255) NOT NULL,
  `total_qty` varchar(255) NOT NULL,
  `total_amount` varchar(255) NOT NULL,
  `discount` int(5) NOT NULL,
  `net_total` varchar(11) NOT NULL,
  `remark` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=85 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ji_purchase_bills`
--

INSERT INTO `ji_purchase_bills` (`id`, `ji_user_id`, `date`, `supplier`, `total_qty`, `total_amount`, `discount`, `net_total`, `remark`) VALUES
(46, 0, '0000-00-00', 'M/S Chadpur Kath Bitan', '29', '12320.00', 0, '', ''),
(47, 0, '0000-00-00', 'Sheikh Furniture', '1', '23000.00', 0, '', ''),
(48, 0, '0000-00-00', 'Vai Vai Hardware', '1', '520.00', 0, '', ''),
(51, 0, '0000-00-00', 'Delux Furnishing', '2', '1160.00', 0, '', ''),
(52, 0, '0000-00-00', 'Ideal Foam & Rexin House ', '20', '9520.00', 0, '', ''),
(53, 0, '0000-00-00', 'Shopno Bilas', '1', '12000.00', 0, '', ''),
(54, 0, '0000-00-00', 'Shopno Bilas', '2', '24500.00', 0, '', ''),
(55, 0, '0000-00-00', 'M/S Maa Hardware & Paint', '4', '900.00', 0, '', ''),
(56, 0, '0000-00-00', 'SD Furniture', '1', '2300.00', 0, '', ''),
(58, 0, '0000-00-00', 'Ideal Foam & Rexin House ', '7', '3040.00', 0, '', ''),
(59, 0, '0000-00-00', 'M/S Islam Treders', '1', '2200.00', 0, '', ''),
(60, 0, '0000-00-00', 'Shopno Bilas', '1', '15500.00', 0, '', ''),
(61, 0, '0000-00-00', 'Fabrics Vew', '2', '800.00', 0, '', ''),
(62, 0, '0000-00-00', 'Soha Lacquer & Hardware ', '1', '600.00', 0, '', ''),
(63, 0, '0000-00-00', 'New S.A Thai Aluminium Fabricators & Glass Center', '2', '2200.00', 0, '', ''),
(64, 0, '0000-00-00', 'M/S Chadpur Kath Bitan', '2', '5300.00', 0, '', ''),
(65, 0, '0000-00-00', 'Khan & Rose Lacquer', '1', '540.00', 0, '', ''),
(66, 0, '0000-00-00', 'Ideal Foam & Rexin House ', '3', '1140.00', 0, '', ''),
(67, 0, '0000-00-00', 'M/S Mlon Timbar treaders', '1', '3543.00', 0, '', ''),
(68, 0, '0000-00-00', 'Fabrics Vew', '11', '7150.00', 0, '', ''),
(69, 0, '0000-00-00', 'Sheikh Furniture', '2', '57000.00', 0, '', ''),
(70, 0, '2018-01-02', 'Shopno Bilas', '1', '10000.00', 0, '', ''),
(82, 0, '2018-01-01', 'Fabrics Vew', '17', '4850.00', 500, '4350.00', 'test'),
(83, 0, '2018-02-13', 'SD Furniture', '5', '41000.00', 0, '41000.00', 'test'),
(84, 1, '2018-03-29', 'M/S Mlon Timbar treaders', '5', '360.00', 0, '360.00', 'test');

-- --------------------------------------------------------

--
-- Table structure for table `ji_purchase_bill_details`
--

DROP TABLE IF EXISTS `ji_purchase_bill_details`;
CREATE TABLE IF NOT EXISTS `ji_purchase_bill_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ji_purchase_bill_id` int(11) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `item_code` varchar(255) NOT NULL,
  `po_id` varchar(255) NOT NULL,
  `qty` varchar(255) NOT NULL,
  `unit_price` varchar(255) NOT NULL,
  `total` varchar(255) NOT NULL,
  `stock_status` int(11) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=237 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ji_purchase_bill_details`
--

INSERT INTO `ji_purchase_bill_details` (`id`, `ji_purchase_bill_id`, `item_name`, `item_code`, `po_id`, `qty`, `unit_price`, `total`, `stock_status`, `description`) VALUES
(149, 46, 'Keroshin', 'BATAM', '', '7', '800', '5600.00', 1, ''),
(150, 46, 'Ply Wood', 'KEROSHIN PLY', '', '20', '300', '6000.00', 1, ''),
(151, 46, 'Ply Wood', 'KEROSHIN PLY', '', '2', '360', '720.00', 1, ''),
(152, 47, 'Sofa', 'S318', '', '1', '23000', '23000.00', 1, ''),
(153, 48, 'Hardware', 'PUDING', '', '1', '520', '520.00', 1, ''),
(158, 51, 'Fabrics', 'DOUBLE', '', '2', '580', '1160.00', 1, ''),
(165, 52, 'Rexin', 'LEATHER TOUCH', '', '16', '500', '8000.00', 1, ''),
(166, 52, 'Rexin', 'JAMUNA', '', '4', '380', '1520.00', 1, ''),
(170, 53, 'Sofa', 'H013', '', '1', '12000', '12000.00', 1, ''),
(171, 54, 'Sofa', 'DV251', '', '1', '10000', '10000.00', 1, ''),
(172, 54, 'Sofa', 'S602', '', '1', '14500', '14500.00', 1, ''),
(175, 55, 'Hardware', 'DOBA HATOL', '', '1', '300', '300.00', 1, '6 pcs'),
(176, 55, 'Hardware', 'OTHERS', '', '3', '200', '600.00', 1, ''),
(177, 56, 'Bord Cutting', 'CUTTING', '', '1', '2300', '2300.00', 1, ''),
(179, 58, 'Rexin', 'LEATHER TOUCH', '', '1.9', '400', '760.00', 1, ''),
(180, 58, 'Rexin', 'JAMUNA', '', '6', '380', '2280.00', 1, ''),
(181, 59, 'Keroshin', 'BATAM', '', '1', '2200', '2200.00', 1, '2.55 kb'),
(182, 60, 'Sofa', 'H548', '', '1', '15500', '15500.00', 1, ''),
(183, 61, 'Sofa', 'FEBRICS', '', '1', '500', '500.00', 1, '1 yrd'),
(184, 61, 'Sofa', 'FEBRICS', '', '1', '300', '300.00', 1, 'so'),
(185, 62, 'Hardware', 'OTHERS', '', '1', '600', '600.00', 1, ''),
(190, 63, 'Select Item', 'GLASS', '', '1', '1200', '1200.00', 1, '10c mili china taj 30x30'),
(191, 63, 'Select Item', 'GLASS', '', '1', '1000', '1000.00', 1, 'Chamili Taj'),
(192, 64, 'Keroshin', 'BATAM', '', '1', '2500', '2500.00', 1, 'Boro'),
(193, 64, 'Keroshin', 'BATAM', '', '1', '2800', '2800.00', 1, '3x1'),
(194, 65, 'Pudding', 'PUDDING', '', '1', '540', '540.00', 1, '1kg'),
(195, 66, 'Rexin', 'OTHERS', '', '3', '380', '1140.00', 1, ''),
(196, 67, 'Mehguni', 'MEHGUNI', '', '1', '3543', '3543.00', 1, '3.93708 poriman'),
(197, 68, 'Fabrics', 'DOUBLE', '', '11', '650', '7150.00', 1, ''),
(205, 69, 'Sofa', 'S318', '', '2', '28500', '57000.00', 1, ''),
(229, 82, 'Mehguni', 'MEHGUNI', 'PO-020', '12', '300', '3600.00', 0, 'test'),
(230, 82, 'Bed Set', 'P201', 'PO-020', '5', '250', '1250.00', 0, 'test'),
(231, 70, 'Ply Wood', 'KEROSHIN PLY', '', '1', '10000', '10000.00', 1, 'a'),
(232, 83, 'C.Table', 'CT100', 'PO-020', '2', '2500', '5000.00', 0, 'test'),
(233, 83, 'Bed Set', 'P201', 'PO-022', '3', '12000', '36000.00', 0, 'test'),
(235, 84, 'Mehguni', 'MEHGUNI', 'PO-020', '2', '30', '60.00', 0, 'test'),
(236, 84, 'Almira', 'AA22', 'PO-021', '3', '100', '300.00', 0, 'test');

-- --------------------------------------------------------

--
-- Table structure for table `ji_purchase_item`
--

DROP TABLE IF EXISTS `ji_purchase_item`;
CREATE TABLE IF NOT EXISTS `ji_purchase_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item_name` varchar(255) NOT NULL,
  `item_code` varchar(255) NOT NULL,
  `item_group` varchar(255) NOT NULL,
  `sales_item` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=98 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ji_purchase_item`
--

INSERT INTO `ji_purchase_item` (`id`, `item_name`, `item_code`, `item_group`, `sales_item`) VALUES
(33, 'Almira', 'A313', 'Inventory', 1),
(34, 'Divan', 'DV251', 'Inventory', 1),
(35, 'Bed Set', 'P201', 'Inventory', 1),
(36, 'Divan', 'DV207', 'Inventory', 1),
(37, 'Dinning Table', 'DT207', 'Inventory', 1),
(38, 'Dinning Table', 'DT301', 'Inventory', 1),
(39, 'Sofa', 'H013', 'Inventory', 1),
(40, 'Dinning Table', 'DT215', 'Inventory', 1),
(41, 'Fabrics', 'SINGLE', 'Current Asset', 0),
(42, 'Fabrics', 'DOUBLE', 'Current Asset', 0),
(43, 'Rexin', 'JAMUNA', 'Current Asset', 0),
(44, 'Rexin', 'LEATHER TOUCH', 'Current Asset', 0),
(45, 'MDF', '4X8X18MM', 'Current Asset', 0),
(46, 'Foam', '22X22X4', 'Current Asset', 0),
(47, 'Foam', '22X22X3', 'Current Asset', 0),
(48, 'Keroshin', '3X1', 'Current Asset', 0),
(49, 'Sofa', 'S004', 'Inventory', 1),
(50, 'Sofa', 'S021', 'Inventory', 1),
(51, 'Showcase', 'S204', 'Inventory', 1),
(52, 'Wordrobe ', 'W306', 'Inventory', 1),
(53, 'Sofa', 'S602', 'Inventory', 1),
(54, 'Showcase', 'SG100', 'Inventory', 1),
(55, 'Sofa', 'H548', 'Inventory', 1),
(56, 'Tula', 'TULA', 'Current Asset', 0),
(57, 'Sobla', 'SOBLA', 'Current Asset', 0),
(58, 'MDF', '4X8X15MM', 'Current Asset', 0),
(59, 'MDF', '4X8X12MM', 'Current Asset', 0),
(60, 'OAK', '12MM', 'Current Asset', 0),
(61, 'OAK', '15MM', 'Current Asset', 0),
(62, 'OAK', '18MM', 'Current Asset', 0),
(63, 'Ply Wood', 'GORJON PLY', 'Current Asset', 0),
(64, 'Ply Wood', 'KEROSHIN PLY', 'Current Asset', 0),
(65, 'Sofa', 'F151', 'Inventory', 1),
(66, 'Fly Board', '3MM', 'Current Asset', 0),
(67, 'Fly Board', '18MM', 'Current Asset', 0),
(68, 'Foam', '5\"X22X22', 'Current Asset', 0),
(69, 'Foam', '6\"X22X22', 'Current Asset', 0),
(70, 'Foam', 'CUTTING', 'Current Asset', 0),
(71, 'Foam', 'FAT TULA', 'Current Asset', 0),
(72, 'Foam', '2\"X22X22', 'Current Asset', 0),
(73, 'Foam', '6\"X36X72', 'Current Asset', 0),
(74, 'Foam', '5\"X36X72', 'Current Asset', 0),
(75, 'Foam', '4\"X36X72', 'Current Asset', 0),
(76, 'Foam', '3\"X36X72', 'Current Asset', 0),
(77, 'Foam', '2\"X36X72', 'Current Asset', 0),
(78, 'Foam', '1.5\"X36X72', 'Current Asset', 0),
(79, 'Foam', '1\"X36X72', 'Current Asset', 0),
(80, 'Foam', '.5\"X36X72', 'Current Asset', 0),
(81, 'Foam', '.3X36X72', 'Current Asset', 0),
(82, 'Rexin', 'OTHERS', 'Current Asset', 0),
(83, 'Hardware', 'PUDING', 'Current Asset', 0),
(84, 'Keroshin', 'BATAM', 'Current Asset', 0),
(85, 'Sofa', 'S318', 'Current Asset', 0),
(86, 'Hardware', 'DOBA HATOL', 'Current Asset', 0),
(87, 'Sofa', 'FEBRICS', 'Current Asset', 0),
(88, 'Select Item', 'GLASS', 'Select Item Group', 0),
(89, 'Sofa', 'F156', 'Inventory', 1),
(90, 'Almira', 'AA22', 'Inventory', 1),
(91, 'Almira', 'AA22', 'Inventory', 1),
(92, 'Chair', 'DT215', 'Inventory', 1),
(94, 'Almira', 'A320', 'Inventory', 1),
(95, 'Pudding', 'PUDDING', 'Current Asset', 0),
(97, 'Mehguni', 'MEHGUNI', 'Current Asset', 0);

-- --------------------------------------------------------

--
-- Table structure for table `ji_purchase_item_group`
--

DROP TABLE IF EXISTS `ji_purchase_item_group`;
CREATE TABLE IF NOT EXISTS `ji_purchase_item_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item_group_name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ji_purchase_item_group`
--

INSERT INTO `ji_purchase_item_group` (`id`, `item_group_name`) VALUES
(9, 'Current Asset'),
(10, 'Fixed Assets'),
(11, 'Others Asset');

-- --------------------------------------------------------

--
-- Table structure for table `ji_purchase_item_name`
--

DROP TABLE IF EXISTS `ji_purchase_item_name`;
CREATE TABLE IF NOT EXISTS `ji_purchase_item_name` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item_name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ji_purchase_item_name`
--

INSERT INTO `ji_purchase_item_name` (`id`, `item_name`) VALUES
(10, 'Fabrics'),
(11, 'Rexin'),
(12, 'Gorjon'),
(13, 'MDF'),
(14, 'OAK'),
(15, 'Lacar'),
(16, 'Glass'),
(17, 'Noksha Wood'),
(18, 'Hardware'),
(20, 'C. Table'),
(21, 'Keroshin'),
(22, 'Rantee'),
(23, 'Foam'),
(24, 'Tula'),
(25, 'Sobla'),
(26, 'Ply Wood'),
(27, 'Fly Board'),
(28, 'Mehguni'),
(29, 'Sofa'),
(30, 'Bord Cutting'),
(32, 'Pudding');

-- --------------------------------------------------------

--
-- Table structure for table `ji_purchase_pay_bills`
--

DROP TABLE IF EXISTS `ji_purchase_pay_bills`;
CREATE TABLE IF NOT EXISTS `ji_purchase_pay_bills` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ji_user_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `supplier` varchar(255) NOT NULL,
  `payment_type` varchar(255) NOT NULL,
  `account` varchar(255) NOT NULL,
  `amount` varchar(255) NOT NULL,
  `reference_no` varchar(255) NOT NULL,
  `remark` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ji_purchase_pay_bills`
--

INSERT INTO `ji_purchase_pay_bills` (`id`, `ji_user_id`, `date`, `supplier`, `payment_type`, `account`, `amount`, `reference_no`, `remark`) VALUES
(42, 0, '0000-00-00', 'SD Furniture', 'Cash', 'Cash On Hand', '6000', 'test', 'test'),
(43, 0, '0000-00-00', 'Soha Lacquer & Hardware ', 'Bank', 'Bkash', '4000', 'test', 'test'),
(44, 0, '0000-00-00', 'SD Furniture', 'Bank', 'Bank (James)', '2000', 'test', 'test'),
(45, 0, '0000-00-00', 'SD Furniture', 'Bank', 'Bank (James)', '2500', 'test', 'test'),
(46, 1, '2018-05-29', 'M/S Mlon Timbar treaders', 'Bank', 'Bank (FB)', '1000', 'test', 'test'),
(47, 1, '2018-08-27', 'Vai Vai Hardware', 'Cash', 'Cash In Mirpur', '500', 'test', 'test'),
(48, 1, '2018-08-27', 'SD Furniture', 'Cash', 'Cash In Mirpur', '500', 'test', 'test'),
(49, 1, '2018-08-27', 'Bismillah Foam House', 'Cash', 'Cash In Mirpur', '1500', 'test', 'test');

-- --------------------------------------------------------

--
-- Table structure for table `ji_sales_person`
--

DROP TABLE IF EXISTS `ji_sales_person`;
CREATE TABLE IF NOT EXISTS `ji_sales_person` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ji_user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ji_sales_person`
--

INSERT INTO `ji_sales_person` (`id`, `ji_user_id`) VALUES
(5, 5),
(6, 10),
(7, 12);

-- --------------------------------------------------------

--
-- Table structure for table `ji_send_sms`
--

DROP TABLE IF EXISTS `ji_send_sms`;
CREATE TABLE IF NOT EXISTS `ji_send_sms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ji_user_id` int(11) NOT NULL,
  `ji_invoice_id` int(11) NOT NULL,
  `sms_type` int(11) NOT NULL,
  `date` date NOT NULL,
  `time` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ji_send_sms`
--

INSERT INTO `ji_send_sms` (`id`, `ji_user_id`, `ji_invoice_id`, `sms_type`, `date`, `time`) VALUES
(2, 1, 274, 2, '2018-03-29', '08:28:45pm'),
(3, 1, 274, 1, '2018-04-25', '01:50:45pm'),
(4, 1, 274, 3, '2018-04-25', '01:51:53pm'),
(7, 1, 281, 1, '2018-12-08', '03:59:19pm'),
(8, 1, 487, 3, '2018-12-08', '06:02:18pm'),
(9, 1, 487, 4, '2018-12-08', '06:16:56pm'),
(10, 1, 281, 2, '2018-12-08', '06:32:03pm');

-- --------------------------------------------------------

--
-- Table structure for table `ji_services`
--

DROP TABLE IF EXISTS `ji_services`;
CREATE TABLE IF NOT EXISTS `ji_services` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ji_user_id` int(11) NOT NULL,
  `ji_invoice_id` int(11) NOT NULL,
  `invoice_no` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `followup_date` date NOT NULL,
  `delivery_date` date NOT NULL,
  `status` int(11) NOT NULL,
  `due` varchar(255) NOT NULL,
  `remarks` text NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `mobile_no` varchar(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ji_services`
--

INSERT INTO `ji_services` (`id`, `ji_user_id`, `ji_invoice_id`, `invoice_no`, `date`, `followup_date`, `delivery_date`, `status`, `due`, `remarks`, `customer_name`, `address`, `mobile_no`) VALUES
(1, 1, 264, '0817263', '2018-08-04', '2018-08-04', '2017-08-13', 1, '11900', 'test', 'md zahedul korim ', 'jhinadaho', '01718757677'),
(2, 1, 0, '', '2018-08-04', '2018-08-11', '2018-08-18', 2, '0', 'test', 'Rakib', 'test', '01673120069');

-- --------------------------------------------------------

--
-- Table structure for table `ji_service_comments`
--

DROP TABLE IF EXISTS `ji_service_comments`;
CREATE TABLE IF NOT EXISTS `ji_service_comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ji_user_id` int(11) NOT NULL,
  `ji_service_id` int(11) NOT NULL,
  `comment_date` date NOT NULL,
  `comment` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ji_service_comments`
--

INSERT INTO `ji_service_comments` (`id`, `ji_user_id`, `ji_service_id`, `comment_date`, `comment`) VALUES
(1, 1, 1, '2018-08-04', 'test'),
(2, 1, 2, '2018-08-04', 'test');

-- --------------------------------------------------------

--
-- Table structure for table `ji_service_details`
--

DROP TABLE IF EXISTS `ji_service_details`;
CREATE TABLE IF NOT EXISTS `ji_service_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ji_user_id` int(11) NOT NULL,
  `ji_service_id` int(11) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `item_code` varchar(255) NOT NULL,
  `item_problem_status` int(11) NOT NULL,
  `problem` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ji_service_details`
--

INSERT INTO `ji_service_details` (`id`, `ji_user_id`, `ji_service_id`, `item_name`, `item_code`, `item_problem_status`, `problem`) VALUES
(1, 1, 1, 'Sofa', 'H548', 0, 'test'),
(2, 1, 1, 'C.Table', 'CT100', 1, 'test');

-- --------------------------------------------------------

--
-- Table structure for table `ji_sms_marketing`
--

DROP TABLE IF EXISTS `ji_sms_marketing`;
CREATE TABLE IF NOT EXISTS `ji_sms_marketing` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ji_user_id` int(11) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `to_customer` int(11) NOT NULL COMMENT '0 => All users, 1 => Last 1 month users, 2 => Last 4 months users, 3 => Last 6 months users, 4 => Last 12 months users',
  `send_sms_date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ji_sms_marketing`
--

INSERT INTO `ji_sms_marketing` (`id`, `ji_user_id`, `subject`, `message`, `to_customer`, `send_sms_date`) VALUES
(8, 1, 'SMS marketing test', 'Dear Rakib, SMS marketing from Furniture Bari.', 4, '2018-11-17'),
(9, 1, 'SMS marketing test', 'Dear Rakib, SMS marketing from Furniture Bari.', 4, '2018-11-17');

-- --------------------------------------------------------

--
-- Table structure for table `ji_stock`
--

DROP TABLE IF EXISTS `ji_stock`;
CREATE TABLE IF NOT EXISTS `ji_stock` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item_category` varchar(255) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `item_code` varchar(255) NOT NULL,
  `qty` varchar(255) NOT NULL,
  `unit_price` varchar(255) NOT NULL,
  `total` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=80 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ji_stock`
--

INSERT INTO `ji_stock` (`id`, `item_category`, `item_name`, `item_code`, `qty`, `unit_price`, `total`) VALUES
(35, 'Sales Item', 'Sofa', 'S318', '4', '13000', '52000'),
(36, 'Purchase Item', 'Sofa', 'W156', '3', '30000', '90000'),
(37, 'Purchase Item', 'Sofa Cum Bed', 'SCB001', '1', '14000', '14000'),
(38, 'Sales Item', 'Dinning Table', 'DT301', '2', '25000', '50000'),
(40, 'Sales Item', 'Bed', 'B259', '3', '11000', '33000'),
(41, 'Sales Item', 'Dinning Table', 'DT213', '1', '17000', '17000.00'),
(42, 'Sales Item', 'Pull Out Bed', 'SCB005', '2', '22000', '44000'),
(43, 'sales item', 'Bed', 'B259', '3', '11000', '33000'),
(44, 'sales item', 'Bed Side', 'BS210', '2', '3000', '6000.00'),
(45, 'sales item', 'Wordrobe ', 'W306', '1', '10000', '10000.00'),
(46, 'Sales Item', 'Bed', 'B263', '2', '25000', '50000.00'),
(47, 'Sales Item', 'Coffee Table', 'GT100', '1', '6000', '6000.00'),
(48, 'Purchase Item', 'Two Stored Bed', 'HD016', '2', '6000', '12000'),
(49, 'Purchase Item', 'Sofa', 'CMZ005', '1', '90000', '90000'),
(50, 'Purchase Item', 'Hardware', 'PUDING', '2', '520', '1040'),
(51, 'Purchase Item', 'Keroshin', 'BATAM', '10', '1310', '13100'),
(52, 'Purchase Item', 'Ply Wood', 'KEROSHIN PLY', '23', '900.86956521739', '20720'),
(53, 'Sales Item', 'Sofa', 'H013', '2', '12000', '24000'),
(54, 'Sales Item', 'Sofa', 'DV251', '2', '10000', '20000'),
(55, 'Sales Item', 'Sofa', 'S602', '2', '14500', '29000'),
(56, 'Purchase Item', 'Fabrics', 'DOUBLE', '13', '639.230769231', '8310'),
(57, 'Purchase Item', 'Rexin', 'LEATHER TOUCH', '17.9', '489.38547486', '8760'),
(58, 'Purchase Item', 'Rexin', 'JAMUNA', '10', '380', '3800'),
(59, 'Purchase Item', 'Hardware', 'DOBA HATOL', '1', '300', '300'),
(60, 'Purchase Item', 'Hardware', 'OTHERS', '8', '717.5', '5740'),
(61, 'Purchase Item', 'Bord Cutting', 'CUTTING', '1', '2300', '2300.00'),
(63, 'Purchase Item', 'Sofa', 'FEBRICS', '2', '400', '800'),
(64, 'Purchase Item', 'Glass', 'GLASS', '2', '1100', '2200'),
(65, 'Purchase Item', 'Pudding', 'PUDDING', '1', '540', '540.00'),
(66, 'Purchase Item', 'Mehguni', 'MEHGUNI', '1', '3543', '3543'),
(67, 'Purchase Item', 'Select Item Name', 'Select Item Code', '2', '3', '6.00'),
(68, 'Purchase Item', 'C.Table', 'CT100', '25', '387.24', '9681'),
(69, 'Purchase Item', 'Coffee Table', 'HD025', '5', '3', '15.00'),
(70, 'Purchase Item', 'C.Table', 'CT100', '25', '387.24', '9681'),
(71, 'Purchase Item', 'C.Table', 'CT100', '25', '387.24', '9681'),
(72, 'Purchase Item', 'C.Table', 'CT100', '25', '387.24', '9681'),
(73, 'Purchase Item', 'Coffee Table', 'HD025', '3', '5', '15.00'),
(74, 'Purchase Item', 'Pull Out Bed', 'W159', '2', '3', '6'),
(75, 'Purchase Item', 'C.Table', 'CT100', '25', '387.24', '9681'),
(76, 'Purchase Item', 'C.Table', 'CT100', '25', '387.24', '9681'),
(77, 'Sales Item', 'Chair', 'DT215', '2', '3', '6'),
(78, 'Sales Item', 'Bed Set', 'P201', '15', '2551', '38265'),
(79, 'Sales Item', 'Almira', 'AA22', '3', '100', '300.00');

-- --------------------------------------------------------

--
-- Table structure for table `ji_sub_menus`
--

DROP TABLE IF EXISTS `ji_sub_menus`;
CREATE TABLE IF NOT EXISTS `ji_sub_menus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ji_menu_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=76 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ji_sub_menus`
--

INSERT INTO `ji_sub_menus` (`id`, `ji_menu_id`, `name`, `url`) VALUES
(17, 6, 'Create Menu', 'admin/create/menu'),
(18, 6, 'Create Sub-Menu', 'admin/create/submenu'),
(19, 6, 'Menu Permissions', 'admin/menu/permission/view'),
(20, 7, 'User Types', 'admin/user/type'),
(21, 7, 'Users', 'admin/user'),
(22, 7, 'User Activity', 'user/activity'),
(23, 8, 'Create Sales Item', 'sales/create/item'),
(24, 8, 'Create Sales Person', 'sales/create/person'),
(25, 8, 'Create New Order By', 'sales/create/order-by'),
(26, 8, 'Create New Delivery By', 'sales/create/delivery-by'),
(27, 8, 'Create New Factory', 'sales/create/factory'),
(28, 8, 'Invoice List', 'admin/invoice/list'),
(29, 8, 'Invoice Report', 'admin/reports/invoice'),
(30, 8, 'Invoice Graph Report', 'admin/invoice/graph/reports'),
(31, 8, 'Invoice Summery Report', 'admin/invoice/summery/reports/current-month'),
(32, 9, 'Payment Type', 'admin/payment/type'),
(33, 9, 'Payment List', 'admin/payment/list'),
(34, 9, 'Payment Report', 'admin/reports/payment'),
(35, 9, 'Payment Graph Report', 'admin/payment/graph/reports'),
(36, 9, 'Payment Summery Report', 'admin/payment/summery/reports/current-month'),
(37, 10, 'Create Service', 'service/create'),
(38, 10, 'Service List', 'service/list'),
(39, 11, 'Create New Expense', 'admin/expanse'),
(40, 11, 'Expense List', 'admin/expanse/list'),
(41, 11, 'Expense List Details', 'admin/expanse/list/details'),
(42, 11, 'Expense Report', 'admin/expanse/report/current-month'),
(43, 11, 'Expense Summery Report', 'admin/expanse/summery/report'),
(44, 12, 'Create New Account', 'admin/account'),
(45, 12, 'Create New Reference', 'account/create/reference'),
(46, 12, 'Account Adjustment', 'admin/account/adjustment'),
(47, 12, 'Account Withdraw', 'admin/account/withdraw'),
(48, 12, 'Account Transfer', 'account/transfer'),
(49, 12, 'Account Cash Inflow', 'account/cashinflow'),
(50, 12, 'Account Balance Report', 'admin/account/balance/reports/view'),
(51, 12, 'Account Current Balance', 'admin/account/current/balance'),
(52, 12, 'Account Monthly Incoming Report', 'account/incoming/reports/current-month'),
(53, 12, 'Account Monthly outgoing Report', 'account/outgoing/reports/current-month'),
(54, 13, 'Purchase Item', 'purchase/item'),
(55, 13, 'Purchase Bills', 'purchase/bill'),
(56, 13, 'Purchase Pay Bills', 'purchase/pay/bill'),
(57, 13, 'Purchase Supplier', 'purchase/supplier'),
(58, 13, 'Purchase Supplier Report', 'purchase/supplier/report'),
(59, 13, 'Purchase Report', 'purchase/report'),
(60, 14, 'Workers', 'worker/workers'),
(61, 14, 'Worker Bills', 'worker/bill'),
(62, 14, 'Worker Pay Bills', 'worker/pay/bill'),
(63, 14, 'Worker Bill Report', 'worker/bill/report'),
(64, 14, 'Worker Pay Bill Report', 'worker/paybill/report'),
(65, 15, 'Production Activity', 'production/activity'),
(66, 15, 'Production Item Wise Activity', 'production/item/activity'),
(67, 15, 'Production Process Order', 'production/process'),
(68, 15, 'Production Budget', 'production/budget'),
(69, 15, 'Production Cost', 'production/cost'),
(70, 16, 'Stock Adjustment', 'stock/create/adjustment'),
(71, 16, 'Stock Report', 'stock/report'),
(73, 17, 'Send Marketing SMS', 'marketing/send/sms/view'),
(74, 17, 'Marketing SMS List', 'marketing/list/sms'),
(75, 17, 'Send SMS', 'marketing/send/single/sms/view');

-- --------------------------------------------------------

--
-- Table structure for table `ji_supplier`
--

DROP TABLE IF EXISTS `ji_supplier`;
CREATE TABLE IF NOT EXISTS `ji_supplier` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `phone` varchar(255) NOT NULL,
  `balance` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `supplier_category` varchar(255) NOT NULL DEFAULT 'cash',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ji_supplier`
--

INSERT INTO `ji_supplier` (`id`, `name`, `address`, `phone`, `balance`, `type`, `supplier_category`) VALUES
(11, 'Bismillah Foam House', '233 Alir mor, Purbachal', '01929326061', '67255', 'Foam Supplier', 'cash'),
(12, 'Vai Vai Hardware', 'H#22, Lan#09, Purbachal', '01912189371, 01724589604', '28000', 'Hardware Supplier', 'credit'),
(13, 'Mainul Partical Center', 'Dag#114, Prbachal Road', '01929621242, 01718680855', '54100', 'Board Supplier', 'cash'),
(14, 'Khan & Rose Lacquer', '265-A Malek Market, Purbanchal', '01714591445, 01933301488', '0', 'Lacar Supplier', 'cash'),
(15, 'M/S Afrid Lacquer', 'Bhaoalia para, Shatarkul road', '01914488698', '21246', 'Lacar Supplier', 'cash'),
(17, 'Saima Furniture', 'Purbachal', '01841503629', '-39500', 'Finish Goods', 'cash'),
(18, 'Sheikh Furniture', 'Purbachal', '01927132010', '27200', 'Finish Goods', 'cash'),
(19, 'Masud', 'Purbachal', '01759899903', '0', 'Finish Goods', 'cash'),
(20, 'M/S Chadpur Kath Bitan', 'Lan-16-17, Purbachal', '01954410904, 01959792985', '0', 'Wood Supplier', 'cash'),
(21, 'Delux Furnishing', 'House-27 Len-10,panir pamp purbachal road,uttar badda', '01819464263,01740967570', '0', 'Fabrics/Rexin', 'cash'),
(22, 'Ideal Foam & Rexin House ', 'cha-104/1,Bir uttam rafiqul Islam Avnew,Uttar Badda', '01835460663', '0', 'Fabrics/Rexin', 'cash'),
(23, 'Shopno Bilas', 'Shadhinota', '01747579017', '169050', 'Finish Goods', 'cash'),
(24, 'M/S Maa Hardware & Paint', 'G,P,K-55/3,Dhaka Farma Goli.Shajadpur Gulshan', '01686531217,01742429412', '0', 'Hardware Supplier', 'cash'),
(25, 'SD Furniture', '237,Uttar Badda Satarkul Road', '01686201637,01917900081', '16000', 'Finish Goods', 'cash'),
(26, 'M/S Islam Treders', 'Cha-104/2 haji sona mia matabbor road Uttar Badda', '01712547113,01972547113', '0', 'Wood Supplier', 'cash'),
(27, 'Fabrics Vew', 'Cha-73/2,Osen tower,Nichtola,Uttar Badda', '01822890928,01732648748', '452', 'Fabrics/Rexin', 'cash'),
(28, 'Soha Lacquer & Hardware ', '160,purbo vaoalia para,Uttar Badda', '01940122057,01628050036', '-3979', 'Hardware Supplier', 'cash'),
(29, 'New S.A Thai Aluminium Fabricators & Glass Center', '238,SatarkulRoad,Abdullah Bagh More,Uttar Badda', '01712083430,0192', '-10000', 'Glass center', 'cash'),
(31, 'M/S Mlon Timbar treaders', '243,Abdullah bag,UttarBadda,Satarkul Road', '01911703206,01818101424', '15360', 'Wood Supplier', 'credit');

-- --------------------------------------------------------

--
-- Table structure for table `ji_supplier_type`
--

DROP TABLE IF EXISTS `ji_supplier_type`;
CREATE TABLE IF NOT EXISTS `ji_supplier_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ji_supplier_type`
--

INSERT INTO `ji_supplier_type` (`id`, `type`) VALUES
(10, 'Foam Supplier'),
(11, 'Board Supplier'),
(12, 'Hardware Supplier'),
(13, 'Lacar Supplier'),
(14, 'Wood Supplier'),
(15, 'Fabrics/Rexin'),
(16, 'Finish Goods'),
(17, 'Glass center');

-- --------------------------------------------------------

--
-- Table structure for table `ji_user`
--

DROP TABLE IF EXISTS `ji_user`;
CREATE TABLE IF NOT EXISTS `ji_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `role` int(11) NOT NULL,
  `status` enum('0','1') COLLATE utf8_unicode_ci DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ji_user`
--

INSERT INTO `ji_user` (`id`, `name`, `username`, `password`, `role`, `status`) VALUES
(1, 'Super Admin', 'admin', '4acb4bc224acbbe3c2bfdcaa39a4324e', 1, '1'),
(2, 'A.K. James', 'Admin', 'c65bb94c71208efceeef4fccf9463f62', 5, '1'),
(5, 'Moumita Rahman Sonia', 'moumi', 'd83cb6c6af189b86e33be57582885387', 2, '1'),
(10, 'Titas', 'titas', 'f76775a6e765ef913d8fd33fbe978a22', 2, '1'),
(11, 'Sabuz', 'sabuz', '4f0ff435f7c4d0151a362f1326765520', 3, '1'),
(12, 'Nahid', 'nahid', 'cdf663d2e7451d1be76afa20dd75b6f3', 2, '1'),
(13, 'Abdur Rashid', 'rashid', 'f4b76fec5fc59318a8d65a818245aca2', 4, '1'),
(18, 'General', 'general', 'c4218bd12902c0a24669f7c47d07faf3', 3, '1'),
(19, 'Service User', 'service', 'c4218bd12902c0a24669f7c47d07faf3', 6, '1');

-- --------------------------------------------------------

--
-- Table structure for table `ji_user_activity`
--

DROP TABLE IF EXISTS `ji_user_activity`;
CREATE TABLE IF NOT EXISTS `ji_user_activity` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ji_user_id` int(11) NOT NULL,
  `ji_invoice_id` int(11) NOT NULL,
  `ji_payment_id` int(11) NOT NULL,
  `ji_new_expanse_id` int(11) NOT NULL,
  `ji_account_cash_inflow_id` int(11) NOT NULL,
  `ji_account_transfer_id` int(11) NOT NULL,
  `ji_purchase_bill_id` int(11) NOT NULL,
  `ji_purchase_pay_bill_id` int(11) NOT NULL,
  `ji_worker_bill_id` int(11) NOT NULL,
  `ji_worker_pay_bill_id` int(11) NOT NULL,
  `activity_type` int(11) NOT NULL,
  `date` date NOT NULL,
  `time` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=152 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ji_user_activity`
--

INSERT INTO `ji_user_activity` (`id`, `ji_user_id`, `ji_invoice_id`, `ji_payment_id`, `ji_new_expanse_id`, `ji_account_cash_inflow_id`, `ji_account_transfer_id`, `ji_purchase_bill_id`, `ji_purchase_pay_bill_id`, `ji_worker_bill_id`, `ji_worker_pay_bill_id`, `activity_type`, `date`, `time`) VALUES
(7, 1, 274, 0, 0, 0, 0, 0, 0, 0, 0, 2, '2018-03-28', '01:20:47pm'),
(8, 1, 0, 0, 0, 10, 0, 0, 0, 0, 0, 1, '2018-03-28', '02:02:01pm'),
(9, 1, 0, 0, 0, 10, 0, 0, 0, 0, 0, 2, '2018-03-28', '02:10:46pm'),
(10, 1, 0, 459, 0, 0, 0, 0, 0, 0, 0, 2, '2018-03-28', '02:41:30pm'),
(11, 1, 0, 0, 66, 0, 0, 0, 0, 0, 0, 1, '2018-03-28', '03:03:58pm'),
(12, 1, 0, 0, 66, 0, 0, 0, 0, 0, 0, 2, '2018-03-28', '03:05:44pm'),
(13, 1, 274, 0, 0, 0, 0, 0, 0, 0, 0, 2, '2018-03-29', '12:33:39pm'),
(14, 1, 274, 0, 0, 0, 0, 0, 0, 0, 0, 2, '2018-03-29', '01:34:38pm'),
(15, 1, 254, 0, 0, 0, 0, 0, 0, 0, 0, 2, '2018-03-29', '01:52:38pm'),
(16, 1, 0, 0, 0, 0, 0, 84, 0, 0, 0, 1, '2018-03-29', '04:53:30pm'),
(17, 1, 0, 0, 0, 0, 24, 0, 0, 0, 0, 1, '2018-03-29', '05:13:02pm'),
(18, 1, 0, 0, 0, 0, 0, 84, 0, 0, 0, 2, '2018-03-29', '05:29:42pm'),
(19, 1, 274, 0, 0, 0, 0, 0, 0, 0, 0, 2, '2018-03-29', '08:22:33pm'),
(20, 1, 0, 0, 0, 0, 0, 0, 0, 0, 33, 1, '2018-04-24', '12:39:42pm'),
(21, 8, 0, 0, 0, 0, 25, 0, 0, 0, 0, 1, '2018-04-24', '03:33:38pm'),
(22, 1, 0, 0, 0, 0, 0, 0, 0, 0, 34, 1, '2018-04-30', '01:52:20pm'),
(23, 1, 267, 0, 0, 0, 0, 0, 0, 0, 0, 2, '2018-05-08', '03:54:50pm'),
(24, 1, 274, 0, 0, 0, 0, 0, 0, 0, 0, 2, '2018-05-08', '03:57:07pm'),
(25, 1, 0, 461, 0, 0, 0, 0, 0, 0, 0, 1, '2018-05-15', '05:16:56pm'),
(26, 1, 0, 462, 0, 0, 0, 0, 0, 0, 0, 1, '2018-05-15', '05:25:41pm'),
(27, 1, 0, 463, 0, 0, 0, 0, 0, 0, 0, 1, '2018-05-15', '05:28:07pm'),
(28, 1, 0, 464, 0, 0, 0, 0, 0, 0, 0, 1, '2018-05-15', '05:29:46pm'),
(29, 1, 0, 465, 0, 0, 0, 0, 0, 0, 0, 1, '2018-05-15', '05:35:22pm'),
(30, 1, 0, 467, 0, 0, 0, 0, 0, 0, 0, 1, '2018-05-15', '06:02:33pm'),
(31, 1, 0, 0, 0, 11, 0, 0, 0, 0, 0, 1, '2018-05-15', '06:18:30pm'),
(32, 1, 0, 0, 0, 14, 0, 0, 0, 0, 0, 1, '2018-05-15', '06:25:17pm'),
(33, 1, 0, 0, 0, 0, 30, 0, 0, 0, 0, 1, '2018-05-15', '07:24:06pm'),
(34, 1, 0, 0, 0, 0, 31, 0, 0, 0, 0, 1, '2018-05-15', '07:24:30pm'),
(35, 1, 0, 468, 0, 0, 0, 0, 0, 0, 0, 1, '2018-05-15', '07:38:55pm'),
(36, 1, 275, 0, 0, 0, 0, 0, 0, 0, 0, 1, '2018-05-15', '09:00:01pm'),
(37, 1, 275, 0, 0, 0, 0, 0, 0, 0, 0, 2, '2018-05-15', '09:01:22pm'),
(38, 1, 275, 0, 0, 0, 0, 0, 0, 0, 0, 2, '2018-05-15', '09:01:55pm'),
(39, 1, 0, 469, 0, 0, 0, 0, 0, 0, 0, 1, '2018-05-21', '01:44:57pm'),
(40, 1, 0, 470, 0, 0, 0, 0, 0, 0, 0, 1, '2018-05-21', '01:46:03pm'),
(41, 1, 0, 470, 0, 0, 0, 0, 0, 0, 0, 2, '2018-05-21', '01:46:53pm'),
(42, 1, 0, 470, 0, 0, 0, 0, 0, 0, 0, 2, '2018-05-21', '01:46:56pm'),
(43, 1, 0, 471, 0, 0, 0, 0, 0, 0, 0, 1, '2018-05-21', '01:48:37pm'),
(44, 1, 0, 472, 0, 0, 0, 0, 0, 0, 0, 1, '2018-05-21', '01:50:34pm'),
(45, 1, 0, 473, 0, 0, 0, 0, 0, 0, 0, 1, '2018-05-21', '01:51:32pm'),
(46, 1, 0, 474, 0, 0, 0, 0, 0, 0, 0, 1, '2018-05-21', '01:52:06pm'),
(47, 1, 0, 0, 0, 15, 0, 0, 0, 0, 0, 1, '2018-05-21', '02:22:37pm'),
(48, 1, 0, 0, 0, 16, 0, 0, 0, 0, 0, 1, '2018-05-21', '02:23:16pm'),
(49, 1, 0, 0, 0, 0, 32, 0, 0, 0, 0, 1, '2018-05-21', '02:39:37pm'),
(50, 1, 0, 0, 0, 0, 33, 0, 0, 0, 0, 1, '2018-05-21', '02:46:42pm'),
(51, 1, 0, 0, 0, 0, 34, 0, 0, 0, 0, 1, '2018-05-21', '02:49:28pm'),
(52, 1, 0, 0, 0, 0, 35, 0, 0, 0, 0, 1, '2018-05-21', '03:13:14pm'),
(53, 1, 0, 0, 0, 0, 36, 0, 0, 0, 0, 1, '2018-05-21', '03:13:42pm'),
(54, 1, 0, 475, 0, 0, 0, 0, 0, 0, 0, 1, '2018-05-21', '04:38:57pm'),
(55, 1, 0, 476, 0, 0, 0, 0, 0, 0, 0, 1, '2018-05-21', '04:39:26pm'),
(56, 1, 0, 0, 0, 0, 0, 0, 46, 0, 0, 1, '2018-05-29', '03:45:37pm'),
(57, 1, 0, 0, 0, 0, 0, 0, 0, 0, 35, 1, '2018-05-29', '03:46:20pm'),
(58, 1, 0, 0, 67, 0, 0, 0, 0, 0, 0, 1, '2018-05-29', '04:46:12pm'),
(59, 1, 0, 0, 67, 0, 0, 0, 0, 0, 0, 2, '2018-06-05', '12:03:29pm'),
(60, 1, 0, 0, 67, 0, 0, 0, 0, 0, 0, 2, '2018-06-05', '12:04:00pm'),
(61, 1, 0, 0, 67, 0, 0, 0, 0, 0, 0, 2, '2018-06-05', '12:24:23pm'),
(62, 1, 0, 0, 65, 0, 0, 0, 0, 0, 0, 2, '2018-06-05', '12:38:17pm'),
(63, 1, 0, 0, 64, 0, 0, 0, 0, 0, 0, 2, '2018-06-05', '12:39:46pm'),
(64, 1, 0, 0, 64, 0, 0, 0, 0, 0, 0, 2, '2018-06-05', '12:41:44pm'),
(65, 1, 0, 0, 66, 0, 0, 0, 0, 0, 0, 2, '2018-06-05', '02:17:13pm'),
(66, 1, 0, 0, 66, 0, 0, 0, 0, 0, 0, 2, '2018-06-05', '02:27:37pm'),
(67, 1, 0, 0, 66, 0, 0, 0, 0, 0, 0, 2, '2018-06-05', '03:05:13pm'),
(68, 1, 0, 0, 63, 0, 0, 0, 0, 0, 0, 2, '2018-06-05', '03:19:56pm'),
(69, 1, 0, 0, 66, 0, 0, 0, 0, 0, 0, 2, '2018-06-05', '03:28:10pm'),
(70, 1, 0, 0, 66, 0, 0, 0, 0, 0, 0, 2, '2018-06-05', '03:43:10pm'),
(71, 1, 0, 0, 66, 0, 0, 0, 0, 0, 0, 2, '2018-06-05', '04:22:14pm'),
(72, 1, 0, 0, 66, 0, 0, 0, 0, 0, 0, 2, '2018-06-05', '04:47:26pm'),
(73, 1, 0, 0, 66, 0, 0, 0, 0, 0, 0, 2, '2018-06-05', '04:49:44pm'),
(74, 1, 0, 0, 66, 0, 0, 0, 0, 0, 0, 2, '2018-06-05', '04:49:53pm'),
(75, 1, 0, 0, 66, 0, 0, 0, 0, 0, 0, 2, '2018-06-05', '04:50:37pm'),
(76, 1, 0, 0, 66, 0, 0, 0, 0, 0, 0, 2, '2018-06-05', '04:52:23pm'),
(77, 1, 0, 0, 66, 0, 0, 0, 0, 0, 0, 2, '2018-06-05', '05:01:46pm'),
(78, 1, 0, 0, 66, 0, 0, 0, 0, 0, 0, 2, '2018-06-05', '05:29:42pm'),
(79, 1, 0, 0, 66, 0, 0, 0, 0, 0, 0, 2, '2018-06-05', '05:34:13pm'),
(80, 1, 0, 0, 66, 0, 0, 0, 0, 0, 0, 2, '2018-06-05', '05:34:55pm'),
(81, 1, 0, 0, 66, 0, 0, 0, 0, 0, 0, 2, '2018-06-05', '05:47:19pm'),
(82, 1, 0, 0, 66, 0, 0, 0, 0, 0, 0, 2, '2018-06-05', '05:48:14pm'),
(83, 1, 0, 0, 0, 17, 0, 0, 0, 0, 0, 1, '2018-06-05', '09:40:23pm'),
(84, 1, 0, 0, 0, 0, 37, 0, 0, 0, 0, 1, '2018-06-05', '10:00:36pm'),
(85, 1, 0, 0, 0, 0, 38, 0, 0, 0, 0, 1, '2018-06-05', '10:04:40pm'),
(86, 1, 0, 0, 0, 0, 39, 0, 0, 0, 0, 1, '2018-06-05', '10:06:58pm'),
(87, 1, 0, 0, 0, 0, 40, 0, 0, 0, 0, 1, '2018-06-05', '10:13:50pm'),
(88, 1, 0, 0, 0, 0, 41, 0, 0, 0, 0, 1, '2018-06-05', '10:26:31pm'),
(89, 1, 0, 0, 0, 0, 42, 0, 0, 0, 0, 1, '2018-06-25', '02:21:36pm'),
(90, 1, 0, 0, 0, 18, 0, 0, 0, 0, 0, 1, '2018-06-25', '02:49:10pm'),
(91, 1, 0, 0, 0, 19, 0, 0, 0, 0, 0, 1, '2018-06-25', '02:49:31pm'),
(92, 1, 0, 0, 0, 20, 0, 0, 0, 0, 0, 1, '2018-06-25', '03:11:36pm'),
(93, 1, 0, 0, 0, 21, 0, 0, 0, 0, 0, 1, '2018-06-25', '03:12:04pm'),
(94, 1, 0, 477, 0, 0, 0, 0, 0, 0, 0, 1, '2018-06-25', '03:21:18pm'),
(95, 1, 0, 478, 0, 0, 0, 0, 0, 0, 0, 1, '2018-06-25', '03:49:38pm'),
(96, 1, 0, 479, 0, 0, 0, 0, 0, 0, 0, 1, '2018-06-25', '03:50:21pm'),
(97, 1, 0, 480, 0, 0, 0, 0, 0, 0, 0, 1, '2018-06-25', '03:57:39pm'),
(98, 1, 0, 481, 0, 0, 0, 0, 0, 0, 0, 1, '2018-06-25', '03:58:37pm'),
(99, 1, 0, 482, 0, 0, 0, 0, 0, 0, 0, 1, '2018-06-25', '03:59:09pm'),
(100, 1, 0, 483, 0, 0, 0, 0, 0, 0, 0, 1, '2018-06-25', '04:01:44pm'),
(101, 1, 0, 484, 0, 0, 0, 0, 0, 0, 0, 1, '2018-06-25', '04:02:46pm'),
(102, 1, 0, 485, 0, 0, 0, 0, 0, 0, 0, 1, '2018-06-25', '04:03:08pm'),
(103, 1, 0, 486, 0, 0, 0, 0, 0, 0, 0, 1, '2018-06-25', '05:42:44pm'),
(104, 1, 0, 0, 0, 22, 0, 0, 0, 0, 0, 1, '2018-06-25', '05:43:43pm'),
(105, 1, 0, 0, 0, 0, 43, 0, 0, 0, 0, 1, '2018-06-25', '05:44:16pm'),
(106, 1, 0, 0, 0, 0, 44, 0, 0, 0, 0, 1, '2018-06-25', '06:50:53pm'),
(107, 1, 0, 0, 0, 0, 45, 0, 0, 0, 0, 1, '2018-06-25', '06:51:47pm'),
(108, 1, 0, 0, 0, 23, 0, 0, 0, 0, 0, 1, '2018-06-25', '06:52:52pm'),
(109, 1, 0, 0, 0, 24, 0, 0, 0, 0, 0, 1, '2018-06-25', '06:53:29pm'),
(110, 1, 0, 0, 67, 0, 0, 0, 0, 0, 0, 1, '2018-06-25', '06:55:00pm'),
(111, 1, 0, 0, 0, 0, 0, 0, 0, 0, 36, 1, '2018-06-25', '07:04:35pm'),
(112, 1, 0, 0, 0, 0, 46, 0, 0, 0, 0, 1, '2018-06-25', '08:05:34pm'),
(113, 1, 0, 0, 68, 0, 0, 0, 0, 0, 0, 1, '2018-06-25', '08:21:26pm'),
(114, 1, 0, 0, 0, 25, 0, 0, 0, 0, 0, 1, '2018-06-26', '02:22:44pm'),
(115, 18, 0, 486, 0, 0, 0, 0, 0, 0, 0, 2, '2018-07-28', '01:08:39pm'),
(116, 18, 0, 486, 0, 0, 0, 0, 0, 0, 0, 2, '2018-07-28', '01:22:23pm'),
(117, 1, 0, 0, 0, 0, 47, 0, 0, 0, 0, 1, '2018-08-04', '07:10:35pm'),
(118, 1, 0, 0, 69, 0, 0, 0, 0, 0, 0, 1, '2018-08-11', '06:14:05pm'),
(119, 1, 0, 0, 0, 0, 0, 0, 47, 0, 0, 1, '2018-08-27', '01:38:51pm'),
(120, 1, 0, 0, 0, 0, 0, 0, 48, 0, 0, 1, '2018-08-27', '01:43:59pm'),
(121, 1, 0, 0, 0, 0, 0, 0, 49, 0, 0, 1, '2018-08-27', '03:32:00pm'),
(122, 1, 0, 0, 0, 0, 0, 0, 49, 0, 0, 2, '2018-08-27', '03:56:52pm'),
(123, 1, 0, 0, 0, 0, 0, 0, 0, 0, 37, 1, '2018-08-27', '04:24:58pm'),
(124, 1, 0, 0, 0, 0, 0, 0, 0, 0, 37, 2, '2018-08-27', '04:29:25pm'),
(125, 1, 0, 486, 0, 0, 0, 0, 0, 0, 0, 2, '2018-11-16', '02:55:31pm'),
(126, 1, 0, 485, 0, 0, 0, 0, 0, 0, 0, 2, '2018-11-16', '02:55:53pm'),
(127, 1, 276, 0, 0, 0, 0, 0, 0, 0, 0, 1, '2018-11-17', '05:56:43pm'),
(128, 1, 277, 0, 0, 0, 0, 0, 0, 0, 0, 1, '2018-11-17', '07:37:43pm'),
(129, 1, 278, 0, 0, 0, 0, 0, 0, 0, 0, 1, '2018-11-17', '07:41:15pm'),
(131, 1, 278, 0, 0, 0, 0, 0, 0, 0, 0, 2, '2018-12-01', '10:56:51am'),
(132, 1, 278, 0, 0, 0, 0, 0, 0, 0, 0, 2, '2018-12-01', '06:43:17pm'),
(133, 1, 266, 0, 0, 0, 0, 0, 0, 0, 0, 2, '2018-12-08', '12:44:56pm'),
(134, 1, 266, 0, 0, 0, 0, 0, 0, 0, 0, 2, '2018-12-08', '12:57:08pm'),
(135, 1, 266, 0, 0, 0, 0, 0, 0, 0, 0, 2, '2018-12-08', '12:58:17pm'),
(136, 1, 264, 0, 0, 0, 0, 0, 0, 0, 0, 2, '2018-12-08', '01:03:23pm'),
(137, 1, 264, 0, 0, 0, 0, 0, 0, 0, 0, 2, '2018-12-08', '01:04:08pm'),
(138, 1, 265, 0, 0, 0, 0, 0, 0, 0, 0, 2, '2018-12-08', '01:07:15pm'),
(139, 1, 255, 0, 0, 0, 0, 0, 0, 0, 0, 2, '2018-12-08', '01:09:06pm'),
(140, 1, 252, 0, 0, 0, 0, 0, 0, 0, 0, 2, '2018-12-08', '01:21:11pm'),
(141, 1, 252, 0, 0, 0, 0, 0, 0, 0, 0, 2, '2018-12-08', '01:21:32pm'),
(142, 1, 251, 0, 0, 0, 0, 0, 0, 0, 0, 2, '2018-12-08', '01:23:31pm'),
(143, 1, 251, 0, 0, 0, 0, 0, 0, 0, 0, 2, '2018-12-08', '01:24:00pm'),
(144, 1, 251, 0, 0, 0, 0, 0, 0, 0, 0, 2, '2018-12-08', '01:27:45pm'),
(145, 1, 251, 0, 0, 0, 0, 0, 0, 0, 0, 2, '2018-12-08', '01:31:16pm'),
(146, 1, 279, 0, 0, 0, 0, 0, 0, 0, 0, 1, '2018-12-08', '02:02:22pm'),
(147, 1, 280, 0, 0, 0, 0, 0, 0, 0, 0, 1, '2018-12-08', '03:52:17pm'),
(148, 1, 281, 0, 0, 0, 0, 0, 0, 0, 0, 1, '2018-12-08', '03:59:15pm'),
(149, 1, 0, 487, 0, 0, 0, 0, 0, 0, 0, 1, '2018-12-08', '06:02:16pm'),
(150, 1, 0, 487, 0, 0, 0, 0, 0, 0, 0, 2, '2018-12-08', '06:04:43pm'),
(151, 1, 0, 487, 0, 0, 0, 0, 0, 0, 0, 2, '2018-12-08', '06:16:53pm');

-- --------------------------------------------------------

--
-- Table structure for table `ji_user_activity_fields`
--

DROP TABLE IF EXISTS `ji_user_activity_fields`;
CREATE TABLE IF NOT EXISTS `ji_user_activity_fields` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ji_user_activity_id` int(11) NOT NULL,
  `field_name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ji_user_activity_fields`
--

INSERT INTO `ji_user_activity_fields` (`id`, `ji_user_activity_id`, `field_name`) VALUES
(3, 131, 'Delivery Date'),
(4, 132, 'Sales Person'),
(5, 133, 'Sales Person'),
(6, 133, 'Factory'),
(7, 133, 'Delivery By'),
(8, 133, 'Status'),
(9, 133, 'Urgency'),
(10, 134, 'Order By'),
(11, 135, 'Address'),
(12, 136, 'Sales Person'),
(13, 136, 'Factory'),
(14, 136, 'Order By'),
(15, 136, 'Delivery By'),
(16, 136, 'Urgency'),
(17, 137, 'Status'),
(18, 138, 'Sales Person'),
(19, 138, 'Factory'),
(20, 138, 'Delivery By'),
(21, 138, 'Urgency'),
(22, 139, 'Factory'),
(23, 139, 'Delivery By'),
(24, 139, 'Status'),
(25, 139, 'Urgency'),
(26, 145, 'Delivery Date');

-- --------------------------------------------------------

--
-- Table structure for table `ji_user_type`
--

DROP TABLE IF EXISTS `ji_user_type`;
CREATE TABLE IF NOT EXISTS `ji_user_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ji_user_type`
--

INSERT INTO `ji_user_type` (`id`, `type`) VALUES
(1, 'Super Admin'),
(2, 'Mirpur User'),
(3, 'Factory User'),
(4, 'MDP User'),
(5, 'Admin'),
(6, 'Service User');

-- --------------------------------------------------------

--
-- Table structure for table `ji_workers`
--

DROP TABLE IF EXISTS `ji_workers`;
CREATE TABLE IF NOT EXISTS `ji_workers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `balance` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ji_workers`
--

INSERT INTO `ji_workers` (`id`, `name`, `balance`, `type`) VALUES
(11, 'Ali', '300', 'Frame'),
(12, 'Enamul', '-1830', 'Com. Noksha'),
(13, 'Eqbal', '10414', 'Godi'),
(14, 'Aktar', '17351', 'Color'),
(15, 'Esmail', '-17600', 'Board'),
(16, 'Zaidul', '9585', 'Noksha'),
(17, 'Lokma', '-7200', 'Zali');

-- --------------------------------------------------------

--
-- Table structure for table `ji_worker_bills`
--

DROP TABLE IF EXISTS `ji_worker_bills`;
CREATE TABLE IF NOT EXISTS `ji_worker_bills` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ji_user_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `worker` varchar(255) NOT NULL,
  `total_qty` varchar(255) NOT NULL,
  `total_amount` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ji_worker_bills`
--

INSERT INTO `ji_worker_bills` (`id`, `ji_user_id`, `date`, `worker`, `total_qty`, `total_amount`) VALUES
(8, 0, '0000-00-00', 'Ali', '', '8500.00'),
(10, 0, '0000-00-00', 'Eqbal', '', '6500.00'),
(11, 0, '0000-00-00', 'Aktar', '', '12600.00'),
(12, 0, '0000-00-00', 'Zaidul', '', '10000.00'),
(13, 0, '0000-00-00', 'Enamul', '', '900.00'),
(14, 0, '0000-00-00', 'Aktar', '', '1500.00'),
(15, 0, '0000-00-00', 'Zaidul', '', '5500.00'),
(18, 0, '0000-00-00', 'Lokma', '', '1200.00'),
(19, 0, '2018-01-30', 'Lokma', '3', '1500.00'),
(21, 0, '2018-01-30', 'Lokma', '2', '300.00'),
(22, 0, '2018-02-13', 'Zaidul', '2', '500.00');

-- --------------------------------------------------------

--
-- Table structure for table `ji_worker_bill_details`
--

DROP TABLE IF EXISTS `ji_worker_bill_details`;
CREATE TABLE IF NOT EXISTS `ji_worker_bill_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ji_worker_bill_id` int(11) NOT NULL,
  `po_id` varchar(255) NOT NULL,
  `item_code` varchar(255) NOT NULL,
  `activity` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `amount` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ji_worker_bill_details`
--

INSERT INTO `ji_worker_bill_details` (`id`, `ji_worker_bill_id`, `po_id`, `item_code`, `activity`, `description`, `amount`) VALUES
(15, 8, 'PO-029', 'W156', 'Frame', '', '2000.00'),
(16, 8, 'PO-028', 'W156', 'Frame', '', '2000.00'),
(17, 8, 'PO-027', 'SCB001', 'Frame', '', '500.00'),
(18, 8, 'PO-026', 'SCB001', 'Frame', '', '500.00'),
(19, 8, 'PO-025', 'SCB001', 'Frame', '', '500.00'),
(20, 8, 'PO-024', 'SCB001', 'Frame', '', '500.00'),
(21, 8, 'PO-023', 'SCB001', 'Frame', '', '500.00'),
(22, 8, 'PO-021', 'H2012L', 'Frame', '', '2000.00'),
(27, 11, 'PO-030', 'A320', 'Coloring', '', '12600.00'),
(28, 12, 'PO-031', 'P314', 'Noksha', '', '10000.00'),
(29, 13, 'PO-030', 'A320', 'Noksha', '', '900.00'),
(31, 10, 'PO-022', 'CMZ005', 'Foam Pasting', '', '6500.00'),
(34, 14, 'PO-031', 'A320', 'Foam Pasting', '', '1500.00'),
(37, 15, 'PO-029', 'W156', 'Frame', 'test', '2500.00'),
(38, 15, 'PO-027', 'SCB001', 'Select Activity', 'test', '3000.00'),
(39, 16, 'PO-031', 'P314', 'Plan/Budget', 'test', '120.00'),
(40, 16, 'PO-030', 'A320', 'Frame', 'test', '250.00'),
(41, 17, 'PO-029', 'W156', 'Foam Pasting', 'test', '5000.00'),
(42, 17, 'PO-029', 'W156', 'Frame', 'test', '2000.00'),
(43, 17, 'PO-029', 'SCB001', 'Coloring', 'test', '12300.00'),
(46, 19, 'PO-029', 'W156', 'Foam Pasting', 'test', '300.00'),
(47, 19, 'PO-029', 'SCB001', 'Noksha', 'test', '800.00'),
(48, 19, 'PO-023', 'SCB001', 'Coloring', 'test', '400.00'),
(49, 18, 'PO-031', 'P314', 'Plan/Budget', 'test', '200.00'),
(50, 18, 'PO-030', 'A320', 'Frame', 'test', '1000.00'),
(59, 21, 'PO-027', 'SCB001', 'Frame', 'test', '100.00'),
(60, 21, 'PO-028', 'W156', 'Coloring', 'test', '200.00'),
(61, 22, 'PO-030', 'A320', 'Plan/Budget', 'test', '200.00'),
(62, 22, 'PO-030', 'DT215', 'Frame', 'test', '300.00');

-- --------------------------------------------------------

--
-- Table structure for table `ji_worker_pay_bills`
--

DROP TABLE IF EXISTS `ji_worker_pay_bills`;
CREATE TABLE IF NOT EXISTS `ji_worker_pay_bills` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ji_user_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `po_id` varchar(255) NOT NULL,
  `worker` varchar(255) NOT NULL,
  `payment_type` varchar(255) NOT NULL,
  `account` varchar(255) NOT NULL,
  `amount` varchar(255) NOT NULL,
  `reference_no` varchar(255) NOT NULL,
  `remark` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ji_worker_pay_bills`
--

INSERT INTO `ji_worker_pay_bills` (`id`, `ji_user_id`, `date`, `po_id`, `worker`, `payment_type`, `account`, `amount`, `reference_no`, `remark`) VALUES
(20, 0, '0000-00-00', '', 'Lokma', 'Cash', 'Cash On Hand', '3000', 'test', 'test'),
(21, 0, '0000-00-00', '', 'Zaidul', 'Bkash', 'Bkash', '3000', 'test', 'test'),
(23, 0, '0000-00-00', '', 'Esmail', 'Cash', 'Cash On Hand', '5000', 'test', 'test'),
(24, 0, '0000-00-00', '', 'Aktar', 'Cash', 'Cash On Hand', '2000', '', 'test'),
(25, 0, '0000-00-00', '', 'Eqbal', 'Bank', 'Bank (FurnitureBari)', '3000', 'test', 'test'),
(26, 0, '0000-00-00', '', 'Ali', 'Cash', 'Cash On Hand', '3000', 'test', 'test'),
(30, 0, '2018-01-30', '', 'Lokma', 'Cash', 'Cash In Factory', '2000', 'nahid', 'test'),
(32, 0, '2018-02-19', 'PO-029', 'Eqbal', 'Cash', 'Cash In Factory', '3000', 'nahid', 'test'),
(33, 1, '2018-04-24', 'PO-021', 'Lokma', 'Bank', 'Cash In Factory', '5000', 'test', 'test'),
(34, 1, '2018-04-30', 'PO-025', 'Lokma', 'Bank', 'Bank (FB)', '7200', 'test', 'test'),
(35, 1, '2018-05-29', 'PO-028', 'Zaidul', 'Bank', 'Bank (FB)', '500', 'test', 'test'),
(36, 1, '2018-06-25', 'PO-028', 'Aktar', 'Bank', 'Cash In Factory', '500', 'test', 'test'),
(37, 1, '2018-08-27', 'PO-028', 'Zaidul', 'Cash', 'Cash In Factory', '1000', 'test', 'test');

-- --------------------------------------------------------

--
-- Table structure for table `ji_worker_type`
--

DROP TABLE IF EXISTS `ji_worker_type`;
CREATE TABLE IF NOT EXISTS `ji_worker_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ji_worker_type`
--

INSERT INTO `ji_worker_type` (`id`, `type`) VALUES
(8, 'Frame'),
(9, 'Noksha'),
(10, 'Godi'),
(11, 'Color'),
(12, 'Board'),
(13, 'Zali'),
(14, 'Com. Noksha');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
