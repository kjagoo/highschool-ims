-- MySQL dump 10.10
--
-- Host: localhost    Database: highschool
-- ------------------------------------------------------
-- Server version	5.0.7-beta-nt

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `balances`
--

DROP TABLE IF EXISTS `balances`;
CREATE TABLE `balances` (
  `admno` varchar(100) NOT NULL default '',
  `balance` double default NULL,
  `term` varchar(100) NOT NULL default '',
  `year` varchar(100) NOT NULL default '',
  `form` varchar(100) NOT NULL default '',
  PRIMARY KEY  (`admno`,`term`,`year`,`form`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `balances`
--


/*!40000 ALTER TABLE `balances` DISABLE KEYS */;
LOCK TABLES `balances` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `balances` ENABLE KEYS */;

--
-- Table structure for table `bank_accounts`
--

DROP TABLE IF EXISTS `bank_accounts`;
CREATE TABLE `bank_accounts` (
  `account_number` varchar(255) NOT NULL,
  `bank_name` varchar(255) NOT NULL,
  `branch` varchar(255) NOT NULL,
  `account_name` varchar(255) NOT NULL,
  PRIMARY KEY  (`account_number`,`bank_name`,`branch`,`account_name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bank_accounts`
--


/*!40000 ALTER TABLE `bank_accounts` DISABLE KEYS */;
LOCK TABLES `bank_accounts` WRITE;
INSERT INTO `bank_accounts` VALUES ('0311083872','BARCLAYS BANK','THIKA','OUR LADY OF FATIMA KIRIKO GIRLS SECONDARY SCHOOL'),('1106606388','KCB TUITION ACC','THIKA','OUR LADY OF FATIMA KIRIKO'),('1106606450','KCB OPERATIONS ACC','THIKA','OUR LADY OF FATIMA KIRIKO OPS ACC2'),('1166222950','KCB DEVELOPMENT ACC','THIKA','OUR LADY OF FATIMA KIRIKO SEC'),('522123','LIPA KARO NA MPESA','THIKA','OUR LADY OF FATIMA KIRIKO GIRLS SECONDARY SCHOOL'),('CASH','PETTY CASH','SCHOOL','OUR LADY OF FATIMA KIRIKO  PETTY CASH');
UNLOCK TABLES;
/*!40000 ALTER TABLE `bank_accounts` ENABLE KEYS */;

--
-- Table structure for table `books_invemtory`
--

DROP TABLE IF EXISTS `books_invemtory`;
CREATE TABLE `books_invemtory` (
  `bookid` int(100) NOT NULL auto_increment,
  `title` varchar(255) NOT NULL,
  `author` varchar(100) NOT NULL,
  `publisher` varchar(100) NOT NULL,
  `sn` varchar(100) NOT NULL,
  `category` varchar(100) NOT NULL,
  `form` varchar(100) NOT NULL,
  `yrofedition` int(4) NOT NULL,
  `noofpcs` int(10) NOT NULL,
  `btype` varchar(100) NOT NULL,
  `bookstatus` varchar(100) NOT NULL default 'Available',
  `comments` text NOT NULL,
  PRIMARY KEY  (`bookid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `books_invemtory`
--


/*!40000 ALTER TABLE `books_invemtory` DISABLE KEYS */;
LOCK TABLES `books_invemtory` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `books_invemtory` ENABLE KEYS */;

--
-- Table structure for table `bursaries`
--

DROP TABLE IF EXISTS `bursaries`;
CREATE TABLE `bursaries` (
  `cheque_no` varchar(200) NOT NULL,
  `cheque_from` varchar(100) NOT NULL,
  `amount` float(18,2) NOT NULL,
  `account_no` varchar(100) NOT NULL,
  `comments` text,
  `year` int(4) NOT NULL,
  `term` int(1) NOT NULL,
  PRIMARY KEY  (`cheque_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bursaries`
--


/*!40000 ALTER TABLE `bursaries` DISABLE KEYS */;
LOCK TABLES `bursaries` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `bursaries` ENABLE KEYS */;

--
-- Table structure for table `bursaries_allocations`
--

DROP TABLE IF EXISTS `bursaries_allocations`;
CREATE TABLE `bursaries_allocations` (
  `id` int(100) NOT NULL auto_increment,
  `cheque_no` varchar(100) NOT NULL,
  `admno` varchar(100) NOT NULL,
  `amount` float(18,2) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bursaries_allocations`
--


/*!40000 ALTER TABLE `bursaries_allocations` DISABLE KEYS */;
LOCK TABLES `bursaries_allocations` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `bursaries_allocations` ENABLE KEYS */;

--
-- Table structure for table `catoutof`
--

DROP TABLE IF EXISTS `catoutof`;
CREATE TABLE `catoutof` (
  `subject` varchar(20) NOT NULL,
  `cat` int(5) NOT NULL,
  `form` int(5) NOT NULL,
  `year` int(5) NOT NULL,
  `term` int(5) NOT NULL,
  `outof` int(5) NOT NULL,
  `states` varchar(100) NOT NULL,
  PRIMARY KEY  (`subject`,`cat`,`form`,`year`,`term`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `catoutof`
--


/*!40000 ALTER TABLE `catoutof` DISABLE KEYS */;
LOCK TABLES `catoutof` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `catoutof` ENABLE KEYS */;

--
-- Table structure for table `chequeexpenses`
--

DROP TABLE IF EXISTS `chequeexpenses`;
CREATE TABLE `chequeexpenses` (
  `no` int(100) NOT NULL,
  `paymentof` varchar(100) NOT NULL,
  `chequeno` varchar(20) NOT NULL,
  `bankname` varchar(20) NOT NULL,
  `dateofpay` varchar(20) NOT NULL,
  `amount` double NOT NULL,
  `votehead` varchar(100) NOT NULL,
  `accountno` varchar(100) NOT NULL,
  `year` varchar(100) NOT NULL,
  `payee` varchar(100) NOT NULL,
  PRIMARY KEY  (`no`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `chequeexpenses`
--


/*!40000 ALTER TABLE `chequeexpenses` DISABLE KEYS */;
LOCK TABLES `chequeexpenses` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `chequeexpenses` ENABLE KEYS */;

--
-- Table structure for table `contacts_groups`
--

DROP TABLE IF EXISTS `contacts_groups`;
CREATE TABLE `contacts_groups` (
  `group_id` int(100) NOT NULL auto_increment,
  `group_name` varchar(100) NOT NULL,
  `telephones` int(100) NOT NULL,
  PRIMARY KEY  (`group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contacts_groups`
--


/*!40000 ALTER TABLE `contacts_groups` DISABLE KEYS */;
LOCK TABLES `contacts_groups` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `contacts_groups` ENABLE KEYS */;

--
-- Table structure for table `current_op`
--

DROP TABLE IF EXISTS `current_op`;
CREATE TABLE `current_op` (
  `code` int(1) NOT NULL default '1',
  `term` int(1) default NULL,
  `year` int(4) default NULL,
  PRIMARY KEY  (`code`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `current_op`
--


/*!40000 ALTER TABLE `current_op` DISABLE KEYS */;
LOCK TABLES `current_op` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `current_op` ENABLE KEYS */;

--
-- Table structure for table `d_locks`
--

DROP TABLE IF EXISTS `d_locks`;
CREATE TABLE `d_locks` (
  `d_lock` varchar(100) NOT NULL,
  PRIMARY KEY  (`d_lock`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `d_locks`
--


/*!40000 ALTER TABLE `d_locks` DISABLE KEYS */;
LOCK TABLES `d_locks` WRITE;
INSERT INTO `d_locks` VALUES ('open');
UNLOCK TABLES;
/*!40000 ALTER TABLE `d_locks` ENABLE KEYS */;

--
-- Table structure for table `department`
--

DROP TABLE IF EXISTS `department`;
CREATE TABLE `department` (
  `dname` varchar(100) NOT NULL,
  `did` varchar(100) NOT NULL,
  `hodname` varchar(100) NOT NULL,
  PRIMARY KEY  (`dname`,`did`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `department`
--


/*!40000 ALTER TABLE `department` DISABLE KEYS */;
LOCK TABLES `department` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `department` ENABLE KEYS */;

--
-- Table structure for table `examoutof`
--

DROP TABLE IF EXISTS `examoutof`;
CREATE TABLE `examoutof` (
  `subject` varchar(20) NOT NULL,
  `form` int(5) NOT NULL,
  `outof` int(5) NOT NULL,
  `years` int(5) NOT NULL,
  `states` varchar(100) NOT NULL,
  PRIMARY KEY  (`subject`,`form`,`years`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `examoutof`
--


/*!40000 ALTER TABLE `examoutof` DISABLE KEYS */;
LOCK TABLES `examoutof` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `examoutof` ENABLE KEYS */;

--
-- Table structure for table `examstatus`
--

DROP TABLE IF EXISTS `examstatus`;
CREATE TABLE `examstatus` (
  `year` int(100) NOT NULL,
  `term` int(100) NOT NULL,
  `form` int(10) NOT NULL,
  `stream` varchar(100) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `examtype` varchar(100) NOT NULL,
  `s_status` varchar(100) NOT NULL,
  PRIMARY KEY  (`year`,`term`,`form`,`stream`,`subject`,`examtype`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `examstatus`
--


/*!40000 ALTER TABLE `examstatus` DISABLE KEYS */;
LOCK TABLES `examstatus` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `examstatus` ENABLE KEYS */;

--
-- Table structure for table `expenses`
--

DROP TABLE IF EXISTS `expenses`;
CREATE TABLE `expenses` (
  `ref` int(100) NOT NULL auto_increment,
  `t_date` varchar(100) NOT NULL,
  `account` varchar(100) NOT NULL,
  `e_mode` varchar(100) NOT NULL,
  `bank` varchar(100) NOT NULL,
  `expense_on` varchar(100) NOT NULL,
  `amount` float(18,2) NOT NULL,
  `refno` varchar(255) NOT NULL,
  PRIMARY KEY  (`ref`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `expenses`
--


/*!40000 ALTER TABLE `expenses` DISABLE KEYS */;
LOCK TABLES `expenses` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `expenses` ENABLE KEYS */;

--
-- Table structure for table `fees`
--

DROP TABLE IF EXISTS `fees`;
CREATE TABLE `fees` (
  `payable` double NOT NULL,
  `form` varchar(100) NOT NULL,
  `term` varchar(100) NOT NULL,
  `year` varchar(100) NOT NULL,
  `bes` double NOT NULL,
  `ses` double NOT NULL,
  `pe` double NOT NULL,
  `activity` double NOT NULL,
  `medical` double NOT NULL,
  `ewc` double NOT NULL,
  `rmi` double NOT NULL,
  `ltt` double NOT NULL,
  `contigencies` double NOT NULL,
  `development` double NOT NULL,
  `caution` double NOT NULL,
  `pocket` double NOT NULL,
  `mock` double NOT NULL,
  `uniform` double NOT NULL,
  `lunch` double NOT NULL,
  `harambee` double NOT NULL,
  PRIMARY KEY  (`form`,`term`,`year`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fees`
--


/*!40000 ALTER TABLE `fees` DISABLE KEYS */;
LOCK TABLES `fees` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `fees` ENABLE KEYS */;

--
-- Table structure for table `feestructures`
--

DROP TABLE IF EXISTS `feestructures`;
CREATE TABLE `feestructures` (
  `serialno` int(100) NOT NULL,
  `admno` int(100) NOT NULL,
  `amount` double NOT NULL,
  `modeofpay` varchar(10) default NULL,
  `chequeno` varchar(100) NOT NULL,
  `bankname` varchar(100) NOT NULL,
  `boarding` double NOT NULL,
  `tution` double NOT NULL,
  `pe` double NOT NULL,
  `activity` double NOT NULL,
  `medical` double NOT NULL,
  `ewc` double NOT NULL,
  `rmi` double NOT NULL,
  `ltt` double NOT NULL,
  `constigency` double NOT NULL,
  `develop` double NOT NULL,
  `caution` double NOT NULL,
  `pocket` double NOT NULL,
  `mock` double NOT NULL,
  `uniform` double NOT NULL,
  `bank` double default NULL,
  `installment` int(10) default NULL,
  `term` int(11) NOT NULL default '0',
  `year` int(11) NOT NULL default '0',
  PRIMARY KEY  (`serialno`,`admno`,`term`,`year`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `feestructures`
--


/*!40000 ALTER TABLE `feestructures` DISABLE KEYS */;
LOCK TABLES `feestructures` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `feestructures` ENABLE KEYS */;

--
-- Table structure for table `finance_added_fees`
--

DROP TABLE IF EXISTS `finance_added_fees`;
CREATE TABLE `finance_added_fees` (
  `admno` varchar(100) NOT NULL,
  `fiscal_year` int(4) NOT NULL,
  `term` varchar(10) NOT NULL,
  `votehead` varchar(100) NOT NULL,
  `amount` decimal(18,2) NOT NULL,
  PRIMARY KEY  (`admno`,`fiscal_year`,`term`,`votehead`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `finance_added_fees`
--


/*!40000 ALTER TABLE `finance_added_fees` DISABLE KEYS */;
LOCK TABLES `finance_added_fees` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `finance_added_fees` ENABLE KEYS */;

--
-- Table structure for table `finance_balances`
--

DROP TABLE IF EXISTS `finance_balances`;
CREATE TABLE `finance_balances` (
  `admno` varchar(100) NOT NULL,
  `form` varchar(10) NOT NULL default '',
  `term` varchar(10) NOT NULL default '',
  `year` int(4) NOT NULL,
  `balance` float(18,2) NOT NULL,
  `updated` int(4) NOT NULL,
  PRIMARY KEY  (`admno`,`form`,`term`,`year`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `finance_balances`
--


/*!40000 ALTER TABLE `finance_balances` DISABLE KEYS */;
LOCK TABLES `finance_balances` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `finance_balances` ENABLE KEYS */;

--
-- Table structure for table `finance_estimates`
--

DROP TABLE IF EXISTS `finance_estimates`;
CREATE TABLE `finance_estimates` (
  `fiscal_yr` int(20) NOT NULL,
  `votehead` varchar(255) NOT NULL,
  `amount` decimal(18,2) default '0.00',
  PRIMARY KEY  (`fiscal_yr`,`votehead`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `finance_estimates`
--


/*!40000 ALTER TABLE `finance_estimates` DISABLE KEYS */;
LOCK TABLES `finance_estimates` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `finance_estimates` ENABLE KEYS */;

--
-- Table structure for table `finance_fees`
--

DROP TABLE IF EXISTS `finance_fees`;
CREATE TABLE `finance_fees` (
  `fiscal_yr` int(20) NOT NULL,
  `term` varchar(255) NOT NULL,
  `form` varchar(255) NOT NULL,
  `votehead` varchar(255) NOT NULL,
  `amount` decimal(18,2) default '0.00',
  PRIMARY KEY  (`fiscal_yr`,`votehead`,`term`,`form`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `finance_fees`
--


/*!40000 ALTER TABLE `finance_fees` DISABLE KEYS */;
LOCK TABLES `finance_fees` WRITE;
INSERT INTO `finance_fees` VALUES (2018,'TERM 1','FORM 1','ACTIVITY','125.00'),(2018,'TERM 1','FORM 2','ACTIVITY','125.00'),(2018,'TERM 1','FORM 3','ACTIVITY','125.00'),(2018,'TERM 1','FORM 4','ACTIVITY','125.00'),(2018,'TERM 2','FORM 1','ACTIVITY','75.00'),(2018,'TERM 2','FORM 2','ACTIVITY','75.00'),(2018,'TERM 2','FORM 3','ACTIVITY','75.00'),(2018,'TERM 2','FORM 4','ACTIVITY','75.00'),(2018,'TERM 3','FORM 1','ACTIVITY','50.00'),(2018,'TERM 3','FORM 2','ACTIVITY','50.00'),(2018,'TERM 3','FORM 3','ACTIVITY','50.00'),(2018,'TERM 3','FORM 4','ACTIVITY','50.00'),(2018,'TERM 1','FORM 1','ADMIN_COST','925.00'),(2018,'TERM 1','FORM 2','ADMIN_COST','925.00'),(2018,'TERM 1','FORM 3','ADMIN_COST','925.00'),(2018,'TERM 1','FORM 4','ADMIN_COST','925.00'),(2018,'TERM 2','FORM 1','ADMIN_COST','555.00'),(2018,'TERM 2','FORM 2','ADMIN_COST','555.00'),(2018,'TERM 2','FORM 3','ADMIN_COST','555.00'),(2018,'TERM 2','FORM 4','ADMIN_COST','555.00'),(2018,'TERM 3','FORM 1','ADMIN_COST','370.00'),(2018,'TERM 3','FORM 2','ADMIN_COST','370.00'),(2018,'TERM 3','FORM 3','ADMIN_COST','370.00'),(2018,'TERM 3','FORM 4','ADMIN_COST','370.00'),(2018,'TERM 1','FORM 1','BES','13693.00'),(2018,'TERM 1','FORM 2','BES','13693.00'),(2018,'TERM 1','FORM 3','BES','13693.00'),(2018,'TERM 1','FORM 4','BES','13693.00'),(2018,'TERM 2','FORM 1','BES','8215.00'),(2018,'TERM 2','FORM 2','BES','8215.00'),(2018,'TERM 2','FORM 3','BES','8215.00'),(2018,'TERM 2','FORM 4','BES','8215.00'),(2018,'TERM 3','FORM 1','BES','5477.00'),(2018,'TERM 3','FORM 2','BES','5477.00'),(2018,'TERM 3','FORM 3','BES','5477.00'),(2018,'TERM 3','FORM 4','BES','5477.00'),(2018,'TERM 1','FORM 1','CAUTION','0.00'),(2018,'TERM 1','FORM 2','CAUTION','0.00'),(2018,'TERM 1','FORM 3','CAUTION','0.00'),(2018,'TERM 1','FORM 4','CAUTION','0.00'),(2018,'TERM 1','FORM 1','EWC','2450.00'),(2018,'TERM 1','FORM 2','EWC','2450.00'),(2018,'TERM 1','FORM 3','EWC','2450.00'),(2018,'TERM 1','FORM 4','EWC','2450.00'),(2018,'TERM 2','FORM 1','EWC','1470.00'),(2018,'TERM 2','FORM 2','EWC','1470.00'),(2018,'TERM 2','FORM 3','EWC','1470.00'),(2018,'TERM 2','FORM 4','EWC','1470.00'),(2018,'TERM 3','FORM 1','EWC','980.00'),(2018,'TERM 3','FORM 2','EWC','980.00'),(2018,'TERM 3','FORM 3','EWC','980.00'),(2018,'TERM 3','FORM 4','EWC','980.00'),(2018,'TERM 1','FORM 1','LT&T','325.00'),(2018,'TERM 1','FORM 2','LT&T','325.00'),(2018,'TERM 1','FORM 3','LT&T','325.00'),(2018,'TERM 1','FORM 4','LT&T','325.00'),(2018,'TERM 2','FORM 1','LT&T','195.00'),(2018,'TERM 2','FORM 2','LT&T','195.00'),(2018,'TERM 2','FORM 3','LT&T','195.00'),(2018,'TERM 2','FORM 4','LT&T','195.00'),(2018,'TERM 3','FORM 1','LT&T','130.00'),(2018,'TERM 3','FORM 2','LT&T','130.00'),(2018,'TERM 3','FORM 3','LT&T','130.00'),(2018,'TERM 3','FORM 4','LT&T','130.00'),(2018,'TERM 1','FORM 1','PE','1550.00'),(2018,'TERM 1','FORM 2','PE','1550.00'),(2018,'TERM 1','FORM 3','PE','1550.00'),(2018,'TERM 1','FORM 4','PE','1550.00'),(2018,'TERM 2','FORM 1','PE','1230.00'),(2018,'TERM 2','FORM 2','PE','1230.00'),(2018,'TERM 2','FORM 3','PE','1230.00'),(2018,'TERM 2','FORM 4','PE','1230.00'),(2018,'TERM 3','FORM 1','PE','320.00'),(2018,'TERM 3','FORM 2','PE','320.00'),(2018,'TERM 3','FORM 3','PE','320.00'),(2018,'TERM 3','FORM 4','PE','320.00'),(2018,'TERM 1','FORM 1','RMI','1200.00'),(2018,'TERM 1','FORM 2','RMI','1200.00'),(2018,'TERM 1','FORM 3','RMI','1200.00'),(2018,'TERM 1','FORM 4','RMI','1200.00'),(2018,'TERM 2','FORM 1','RMI','720.00'),(2018,'TERM 2','FORM 2','RMI','720.00'),(2018,'TERM 2','FORM 3','RMI','720.00'),(2018,'TERM 2','FORM 4','RMI','720.00'),(2018,'TERM 3','FORM 1','RMI','480.00'),(2018,'TERM 3','FORM 2','RMI','480.00'),(2018,'TERM 3','FORM 3','RMI','480.00'),(2018,'TERM 3','FORM 4','RMI','480.00');
UNLOCK TABLES;
/*!40000 ALTER TABLE `finance_fees` ENABLE KEYS */;

--
-- Table structure for table `finance_feestructures`
--

DROP TABLE IF EXISTS `finance_feestructures`;
CREATE TABLE `finance_feestructures` (
  `receipt_no` int(100) NOT NULL,
  `admno` int(100) NOT NULL,
  `dateofpay` varchar(100) NOT NULL,
  `modeofpay` varchar(100) NOT NULL,
  `votehead` varchar(100) NOT NULL,
  `votehead_amt` decimal(18,2) NOT NULL default '0.00',
  `term` varchar(100) NOT NULL,
  `year` int(100) NOT NULL,
  `statusis` varchar(100) NOT NULL,
  `servedby` varchar(100) NOT NULL,
  `total_amount` decimal(18,2) NOT NULL default '0.00',
  `words` text NOT NULL,
  `bank_account` varchar(100) default NULL,
  `balance` decimal(18,2) default '0.00',
  `payment_for` varchar(100) default 'School',
  `bankreceipt` varchar(1000) default NULL,
  PRIMARY KEY  (`receipt_no`,`admno`,`dateofpay`,`modeofpay`,`votehead`,`votehead_amt`,`term`,`year`,`statusis`,`servedby`,`total_amount`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `finance_feestructures`
--


/*!40000 ALTER TABLE `finance_feestructures` DISABLE KEYS */;
LOCK TABLES `finance_feestructures` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `finance_feestructures` ENABLE KEYS */;

--
-- Table structure for table `finance_fiscalyr`
--

DROP TABLE IF EXISTS `finance_fiscalyr`;
CREATE TABLE `finance_fiscalyr` (
  `fiscal_year` int(4) NOT NULL,
  `status` varchar(100) default 'OPEN',
  PRIMARY KEY  (`fiscal_year`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `finance_fiscalyr`
--


/*!40000 ALTER TABLE `finance_fiscalyr` DISABLE KEYS */;
LOCK TABLES `finance_fiscalyr` WRITE;
INSERT INTO `finance_fiscalyr` VALUES (2017,'OPEN');
UNLOCK TABLES;
/*!40000 ALTER TABLE `finance_fiscalyr` ENABLE KEYS */;

--
-- Table structure for table `finance_operationalvoteheads`
--

DROP TABLE IF EXISTS `finance_operationalvoteheads`;
CREATE TABLE `finance_operationalvoteheads` (
  `fiscal_year` int(4) NOT NULL default '0',
  `term` varchar(100) NOT NULL default '',
  `votehead` varchar(100) NOT NULL default '',
  `code` varchar(100) NOT NULL default '',
  PRIMARY KEY  (`fiscal_year`,`term`,`votehead`,`code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `finance_operationalvoteheads`
--


/*!40000 ALTER TABLE `finance_operationalvoteheads` DISABLE KEYS */;
LOCK TABLES `finance_operationalvoteheads` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `finance_operationalvoteheads` ENABLE KEYS */;

--
-- Table structure for table `finance_paybills`
--

DROP TABLE IF EXISTS `finance_paybills`;
CREATE TABLE `finance_paybills` (
  `ref` int(100) NOT NULL auto_increment,
  `payee` varchar(100) NOT NULL,
  `invoice` varchar(100) NOT NULL,
  `p_type` varchar(100) NOT NULL,
  `bank` varchar(100) NOT NULL,
  `t_date` varchar(100) NOT NULL,
  `amount` float(18,2) NOT NULL,
  `group_category` varchar(100) NOT NULL,
  `expense_on` varchar(100) default NULL,
  `memo` text NOT NULL,
  PRIMARY KEY  (`ref`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `finance_paybills`
--


/*!40000 ALTER TABLE `finance_paybills` DISABLE KEYS */;
LOCK TABLES `finance_paybills` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `finance_paybills` ENABLE KEYS */;

--
-- Table structure for table `finance_student_invoices`
--

DROP TABLE IF EXISTS `finance_student_invoices`;
CREATE TABLE `finance_student_invoices` (
  `admno` varchar(100) NOT NULL,
  `year` int(4) NOT NULL,
  `term` varchar(100) NOT NULL,
  `form` varchar(100) NOT NULL,
  `amount` float(18,2) NOT NULL,
  PRIMARY KEY  (`admno`,`year`,`term`,`form`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `finance_student_invoices`
--


/*!40000 ALTER TABLE `finance_student_invoices` DISABLE KEYS */;
LOCK TABLES `finance_student_invoices` WRITE;
INSERT INTO `finance_student_invoices` VALUES ('4134',2018,'TERM 1','FORM 4',20268.00),('4134',2018,'TERM 2','FORM 4',12460.00),('4134',2018,'TERM 3','FORM 4',7807.00),('4136',2018,'TERM 1','FORM 4',20268.00),('4136',2018,'TERM 2','FORM 4',12460.00),('4136',2018,'TERM 3','FORM 4',7807.00),('4137',2018,'TERM 1','FORM 4',20268.00),('4137',2018,'TERM 2','FORM 4',12460.00),('4137',2018,'TERM 3','FORM 4',7807.00),('4139',2018,'TERM 1','FORM 4',20268.00),('4139',2018,'TERM 2','FORM 4',12460.00),('4139',2018,'TERM 3','FORM 4',7807.00),('4140',2018,'TERM 1','FORM 4',20268.00),('4140',2018,'TERM 2','FORM 4',12460.00),('4140',2018,'TERM 3','FORM 4',7807.00),('4141',2018,'TERM 1','FORM 4',20268.00),('4141',2018,'TERM 2','FORM 4',12460.00),('4141',2018,'TERM 3','FORM 4',7807.00),('4142',2018,'TERM 1','FORM 4',20268.00),('4142',2018,'TERM 2','FORM 4',12460.00),('4142',2018,'TERM 3','FORM 4',7807.00),('4143',2018,'TERM 1','FORM 4',20268.00),('4143',2018,'TERM 2','FORM 4',12460.00),('4143',2018,'TERM 3','FORM 4',7807.00),('4144',2018,'TERM 1','FORM 4',20268.00),('4144',2018,'TERM 2','FORM 4',12460.00),('4144',2018,'TERM 3','FORM 4',7807.00),('4145',2018,'TERM 1','FORM 4',20268.00),('4145',2018,'TERM 2','FORM 4',12460.00),('4145',2018,'TERM 3','FORM 4',7807.00),('4146',2018,'TERM 1','FORM 4',20268.00),('4146',2018,'TERM 2','FORM 4',12460.00),('4146',2018,'TERM 3','FORM 4',7807.00),('4148',2018,'TERM 1','FORM 4',20268.00),('4148',2018,'TERM 2','FORM 4',12460.00),('4148',2018,'TERM 3','FORM 4',7807.00),('4149',2018,'TERM 1','FORM 4',20268.00),('4149',2018,'TERM 2','FORM 4',12460.00),('4149',2018,'TERM 3','FORM 4',7807.00),('4150',2018,'TERM 1','FORM 4',20268.00),('4150',2018,'TERM 2','FORM 4',12460.00),('4150',2018,'TERM 3','FORM 4',7807.00),('4151',2018,'TERM 1','FORM 4',20268.00),('4151',2018,'TERM 2','FORM 4',12460.00),('4151',2018,'TERM 3','FORM 4',7807.00),('4152',2018,'TERM 1','FORM 4',20268.00),('4152',2018,'TERM 2','FORM 4',12460.00),('4152',2018,'TERM 3','FORM 4',7807.00),('4153',2018,'TERM 1','FORM 4',20268.00),('4153',2018,'TERM 2','FORM 4',12460.00),('4153',2018,'TERM 3','FORM 4',7807.00),('4154',2018,'TERM 1','FORM 4',20268.00),('4154',2018,'TERM 2','FORM 4',12460.00),('4154',2018,'TERM 3','FORM 4',7807.00),('4155',2018,'TERM 1','FORM 4',20268.00),('4155',2018,'TERM 2','FORM 4',12460.00),('4155',2018,'TERM 3','FORM 4',7807.00),('4157',2018,'TERM 1','FORM 4',20268.00),('4157',2018,'TERM 2','FORM 4',12460.00),('4157',2018,'TERM 3','FORM 4',7807.00),('4158',2018,'TERM 1','FORM 4',20268.00),('4158',2018,'TERM 2','FORM 4',12460.00),('4158',2018,'TERM 3','FORM 4',7807.00),('4159',2018,'TERM 1','FORM 4',20268.00),('4159',2018,'TERM 2','FORM 4',12460.00),('4159',2018,'TERM 3','FORM 4',7807.00),('4160',2018,'TERM 1','FORM 4',20268.00),('4160',2018,'TERM 2','FORM 4',12460.00),('4160',2018,'TERM 3','FORM 4',7807.00),('4161',2018,'TERM 1','FORM 4',20268.00),('4161',2018,'TERM 2','FORM 4',12460.00),('4161',2018,'TERM 3','FORM 4',7807.00),('4162',2018,'TERM 1','FORM 4',20268.00),('4162',2018,'TERM 2','FORM 4',12460.00),('4162',2018,'TERM 3','FORM 4',7807.00),('4163',2018,'TERM 1','FORM 4',20268.00),('4163',2018,'TERM 2','FORM 4',12460.00),('4163',2018,'TERM 3','FORM 4',7807.00),('4164',2018,'TERM 1','FORM 4',20268.00),('4164',2018,'TERM 2','FORM 4',12460.00),('4164',2018,'TERM 3','FORM 4',7807.00),('4165',2018,'TERM 1','FORM 4',20268.00),('4165',2018,'TERM 2','FORM 4',12460.00),('4165',2018,'TERM 3','FORM 4',7807.00),('4166',2018,'TERM 1','FORM 4',20268.00),('4166',2018,'TERM 2','FORM 4',12460.00),('4166',2018,'TERM 3','FORM 4',7807.00),('4167',2018,'TERM 1','FORM 4',20268.00),('4167',2018,'TERM 2','FORM 4',12460.00),('4167',2018,'TERM 3','FORM 4',7807.00),('4168',2018,'TERM 1','FORM 4',20268.00),('4168',2018,'TERM 2','FORM 4',12460.00),('4168',2018,'TERM 3','FORM 4',7807.00),('4170',2018,'TERM 1','FORM 4',20268.00),('4170',2018,'TERM 2','FORM 4',12460.00),('4170',2018,'TERM 3','FORM 4',7807.00),('4171',2018,'TERM 1','FORM 4',20268.00),('4171',2018,'TERM 2','FORM 4',12460.00),('4171',2018,'TERM 3','FORM 4',7807.00),('4172',2018,'TERM 1','FORM 4',20268.00),('4172',2018,'TERM 2','FORM 4',12460.00),('4172',2018,'TERM 3','FORM 4',7807.00),('4173',2018,'TERM 1','FORM 4',20268.00),('4173',2018,'TERM 2','FORM 4',12460.00),('4173',2018,'TERM 3','FORM 4',7807.00),('4174',2018,'TERM 1','FORM 4',20268.00),('4174',2018,'TERM 2','FORM 4',12460.00),('4174',2018,'TERM 3','FORM 4',7807.00),('4175',2018,'TERM 1','FORM 4',20268.00),('4175',2018,'TERM 2','FORM 4',12460.00),('4175',2018,'TERM 3','FORM 4',7807.00),('4176',2018,'TERM 1','FORM 4',20268.00),('4176',2018,'TERM 2','FORM 4',12460.00),('4176',2018,'TERM 3','FORM 4',7807.00),('4177',2018,'TERM 1','FORM 4',20268.00),('4177',2018,'TERM 2','FORM 4',12460.00),('4177',2018,'TERM 3','FORM 4',7807.00),('4179',2018,'TERM 1','FORM 4',20268.00),('4179',2018,'TERM 2','FORM 4',12460.00),('4179',2018,'TERM 3','FORM 4',7807.00),('4180',2018,'TERM 1','FORM 4',20268.00),('4180',2018,'TERM 2','FORM 4',12460.00),('4180',2018,'TERM 3','FORM 4',7807.00),('4181',2018,'TERM 1','FORM 4',20268.00),('4181',2018,'TERM 2','FORM 4',12460.00),('4181',2018,'TERM 3','FORM 4',7807.00),('4182',2018,'TERM 1','FORM 4',20268.00),('4182',2018,'TERM 2','FORM 4',12460.00),('4182',2018,'TERM 3','FORM 4',7807.00),('4183',2018,'TERM 1','FORM 4',20268.00),('4183',2018,'TERM 2','FORM 4',12460.00),('4183',2018,'TERM 3','FORM 4',7807.00),('4184',2018,'TERM 1','FORM 4',20268.00),('4184',2018,'TERM 2','FORM 4',12460.00),('4184',2018,'TERM 3','FORM 4',7807.00),('4186',2018,'TERM 1','FORM 4',20268.00),('4186',2018,'TERM 2','FORM 4',12460.00),('4186',2018,'TERM 3','FORM 4',7807.00),('4187',2018,'TERM 1','FORM 4',20268.00),('4187',2018,'TERM 2','FORM 4',12460.00),('4187',2018,'TERM 3','FORM 4',7807.00),('4188',2018,'TERM 1','FORM 4',20268.00),('4188',2018,'TERM 2','FORM 4',12460.00),('4188',2018,'TERM 3','FORM 4',7807.00),('4189',2018,'TERM 1','FORM 4',20268.00),('4189',2018,'TERM 2','FORM 4',12460.00),('4189',2018,'TERM 3','FORM 4',7807.00),('4190',2018,'TERM 1','FORM 4',20268.00),('4190',2018,'TERM 2','FORM 4',12460.00),('4190',2018,'TERM 3','FORM 4',7807.00),('4191',2018,'TERM 1','FORM 4',20268.00),('4191',2018,'TERM 2','FORM 4',12460.00),('4191',2018,'TERM 3','FORM 4',7807.00),('4193',2018,'TERM 1','FORM 4',20268.00),('4193',2018,'TERM 2','FORM 4',12460.00),('4193',2018,'TERM 3','FORM 4',7807.00),('4194',2018,'TERM 1','FORM 4',20268.00),('4194',2018,'TERM 2','FORM 4',12460.00),('4194',2018,'TERM 3','FORM 4',7807.00),('4195',2018,'TERM 1','FORM 4',20268.00),('4195',2018,'TERM 2','FORM 4',12460.00),('4195',2018,'TERM 3','FORM 4',7807.00),('4196',2018,'TERM 1','FORM 4',20268.00),('4196',2018,'TERM 2','FORM 4',12460.00),('4196',2018,'TERM 3','FORM 4',7807.00),('4197',2018,'TERM 1','FORM 4',20268.00),('4197',2018,'TERM 2','FORM 4',12460.00),('4197',2018,'TERM 3','FORM 4',7807.00),('4198',2018,'TERM 1','FORM 4',20268.00),('4198',2018,'TERM 2','FORM 4',12460.00),('4198',2018,'TERM 3','FORM 4',7807.00),('4199',2018,'TERM 1','FORM 4',20268.00),('4199',2018,'TERM 2','FORM 4',12460.00),('4199',2018,'TERM 3','FORM 4',7807.00),('4200',2018,'TERM 1','FORM 4',20268.00),('4200',2018,'TERM 2','FORM 4',12460.00),('4200',2018,'TERM 3','FORM 4',7807.00),('4202',2018,'TERM 1','FORM 4',20268.00),('4202',2018,'TERM 2','FORM 4',12460.00),('4202',2018,'TERM 3','FORM 4',7807.00),('4203',2018,'TERM 1','FORM 4',20268.00),('4203',2018,'TERM 2','FORM 4',12460.00),('4203',2018,'TERM 3','FORM 4',7807.00),('4204',2018,'TERM 1','FORM 4',20268.00),('4204',2018,'TERM 2','FORM 4',12460.00),('4204',2018,'TERM 3','FORM 4',7807.00),('4205',2018,'TERM 1','FORM 3',20268.00),('4205',2018,'TERM 2','FORM 3',12460.00),('4205',2018,'TERM 3','FORM 3',7807.00),('4206',2018,'TERM 1','FORM 4',20268.00),('4206',2018,'TERM 2','FORM 4',12460.00),('4206',2018,'TERM 3','FORM 4',7807.00),('4207',2018,'TERM 1','FORM 4',20268.00),('4207',2018,'TERM 2','FORM 4',12460.00),('4207',2018,'TERM 3','FORM 4',7807.00),('4208',2018,'TERM 1','FORM 4',20268.00),('4208',2018,'TERM 2','FORM 4',12460.00),('4208',2018,'TERM 3','FORM 4',7807.00),('4209',2018,'TERM 1','FORM 4',20268.00),('4209',2018,'TERM 2','FORM 4',12460.00),('4209',2018,'TERM 3','FORM 4',7807.00),('4210',2018,'TERM 1','FORM 4',20268.00),('4210',2018,'TERM 2','FORM 4',12460.00),('4210',2018,'TERM 3','FORM 4',7807.00),('4211',2018,'TERM 1','FORM 4',20268.00),('4211',2018,'TERM 2','FORM 4',12460.00),('4211',2018,'TERM 3','FORM 4',7807.00),('4212',2018,'TERM 1','FORM 4',20268.00),('4212',2018,'TERM 2','FORM 4',12460.00),('4212',2018,'TERM 3','FORM 4',7807.00),('4213',2018,'TERM 1','FORM 4',20268.00),('4213',2018,'TERM 2','FORM 4',12460.00),('4213',2018,'TERM 3','FORM 4',7807.00),('4214',2018,'TERM 1','FORM 4',20268.00),('4214',2018,'TERM 2','FORM 4',12460.00),('4214',2018,'TERM 3','FORM 4',7807.00),('4215',2018,'TERM 1','FORM 4',20268.00),('4215',2018,'TERM 2','FORM 4',12460.00),('4215',2018,'TERM 3','FORM 4',7807.00),('4216',2018,'TERM 1','FORM 4',20268.00),('4216',2018,'TERM 2','FORM 4',12460.00),('4216',2018,'TERM 3','FORM 4',7807.00),('4218',2018,'TERM 1','FORM 4',20268.00),('4218',2018,'TERM 2','FORM 4',12460.00),('4218',2018,'TERM 3','FORM 4',7807.00),('4220',2018,'TERM 1','FORM 4',20268.00),('4220',2018,'TERM 2','FORM 4',12460.00),('4220',2018,'TERM 3','FORM 4',7807.00),('4221',2018,'TERM 1','FORM 4',20268.00),('4221',2018,'TERM 2','FORM 4',12460.00),('4221',2018,'TERM 3','FORM 4',7807.00),('4222',2018,'TERM 1','FORM 4',20268.00),('4222',2018,'TERM 2','FORM 4',12460.00),('4222',2018,'TERM 3','FORM 4',7807.00),('4223',2018,'TERM 1','FORM 4',20268.00),('4223',2018,'TERM 2','FORM 4',12460.00),('4223',2018,'TERM 3','FORM 4',7807.00),('4224',2018,'TERM 1','FORM 4',20268.00),('4224',2018,'TERM 2','FORM 4',12460.00),('4224',2018,'TERM 3','FORM 4',7807.00),('4225',2018,'TERM 1','FORM 4',20268.00),('4225',2018,'TERM 2','FORM 4',12460.00),('4225',2018,'TERM 3','FORM 4',7807.00),('4226',2018,'TERM 1','FORM 4',20268.00),('4226',2018,'TERM 2','FORM 4',12460.00),('4226',2018,'TERM 3','FORM 4',7807.00),('4228',2018,'TERM 1','FORM 4',20268.00),('4228',2018,'TERM 2','FORM 4',12460.00),('4228',2018,'TERM 3','FORM 4',7807.00),('4229',2018,'TERM 1','FORM 4',20268.00),('4229',2018,'TERM 2','FORM 4',12460.00),('4229',2018,'TERM 3','FORM 4',7807.00),('4230',2018,'TERM 1','FORM 4',20268.00),('4230',2018,'TERM 2','FORM 4',12460.00),('4230',2018,'TERM 3','FORM 4',7807.00),('4231',2018,'TERM 1','FORM 4',20268.00),('4231',2018,'TERM 2','FORM 4',12460.00),('4231',2018,'TERM 3','FORM 4',7807.00),('4232',2018,'TERM 1','FORM 4',20268.00),('4232',2018,'TERM 2','FORM 4',12460.00),('4232',2018,'TERM 3','FORM 4',7807.00),('4233',2018,'TERM 1','FORM 4',20268.00),('4233',2018,'TERM 2','FORM 4',12460.00),('4233',2018,'TERM 3','FORM 4',7807.00),('4234',2018,'TERM 1','FORM 4',20268.00),('4234',2018,'TERM 2','FORM 4',12460.00),('4234',2018,'TERM 3','FORM 4',7807.00),('4235',2018,'TERM 1','FORM 4',20268.00),('4235',2018,'TERM 2','FORM 4',12460.00),('4235',2018,'TERM 3','FORM 4',7807.00),('4236',2018,'TERM 1','FORM 4',20268.00),('4236',2018,'TERM 2','FORM 4',12460.00),('4236',2018,'TERM 3','FORM 4',7807.00),('4237',2018,'TERM 1','FORM 4',20268.00),('4237',2018,'TERM 2','FORM 4',12460.00),('4237',2018,'TERM 3','FORM 4',7807.00),('4238',2018,'TERM 1','FORM 4',20268.00),('4238',2018,'TERM 2','FORM 4',12460.00),('4238',2018,'TERM 3','FORM 4',7807.00),('4240',2018,'TERM 1','FORM 4',20268.00),('4240',2018,'TERM 2','FORM 4',12460.00),('4240',2018,'TERM 3','FORM 4',7807.00),('4241',2018,'TERM 1','FORM 4',20268.00),('4241',2018,'TERM 2','FORM 4',12460.00),('4241',2018,'TERM 3','FORM 4',7807.00),('4245',2018,'TERM 1','FORM 4',20268.00),('4245',2018,'TERM 2','FORM 4',12460.00),('4245',2018,'TERM 3','FORM 4',7807.00),('4247',2018,'TERM 1','FORM 4',20268.00),('4247',2018,'TERM 2','FORM 4',12460.00),('4247',2018,'TERM 3','FORM 4',7807.00),('4248',2018,'TERM 1','FORM 4',20268.00),('4248',2018,'TERM 2','FORM 4',12460.00),('4248',2018,'TERM 3','FORM 4',7807.00),('4249',2018,'TERM 1','FORM 4',20268.00),('4249',2018,'TERM 2','FORM 4',12460.00),('4249',2018,'TERM 3','FORM 4',7807.00),('4251',2018,'TERM 1','FORM 4',20268.00),('4251',2018,'TERM 2','FORM 4',12460.00),('4251',2018,'TERM 3','FORM 4',7807.00),('4252',2018,'TERM 1','FORM 4',20268.00),('4252',2018,'TERM 2','FORM 4',12460.00),('4252',2018,'TERM 3','FORM 4',7807.00),('4253',2018,'TERM 1','FORM 4',20268.00),('4253',2018,'TERM 2','FORM 4',12460.00),('4253',2018,'TERM 3','FORM 4',7807.00),('4255',2018,'TERM 1','FORM 4',20268.00),('4255',2018,'TERM 2','FORM 4',12460.00),('4255',2018,'TERM 3','FORM 4',7807.00),('4256',2018,'TERM 1','FORM 4',20268.00),('4256',2018,'TERM 2','FORM 4',12460.00),('4256',2018,'TERM 3','FORM 4',7807.00),('4258',2018,'TERM 1','FORM 4',20268.00),('4258',2018,'TERM 2','FORM 4',12460.00),('4258',2018,'TERM 3','FORM 4',7807.00),('4259',2018,'TERM 1','FORM 4',20268.00),('4259',2018,'TERM 2','FORM 4',12460.00),('4259',2018,'TERM 3','FORM 4',7807.00),('4261',2018,'TERM 1','FORM 4',20268.00),('4261',2018,'TERM 2','FORM 4',12460.00),('4261',2018,'TERM 3','FORM 4',7807.00),('4262',2018,'TERM 1','FORM 4',20268.00),('4262',2018,'TERM 2','FORM 4',12460.00),('4262',2018,'TERM 3','FORM 4',7807.00),('4264',2018,'TERM 1','FORM 3',20268.00),('4264',2018,'TERM 2','FORM 3',12460.00),('4264',2018,'TERM 3','FORM 3',7807.00),('4267',2018,'TERM 1','FORM 3',20268.00),('4267',2018,'TERM 2','FORM 3',12460.00),('4267',2018,'TERM 3','FORM 3',7807.00),('4269',2018,'TERM 1','FORM 3',20268.00),('4269',2018,'TERM 2','FORM 3',12460.00),('4269',2018,'TERM 3','FORM 3',7807.00),('4271',2018,'TERM 1','FORM 3',20268.00),('4271',2018,'TERM 2','FORM 3',12460.00),('4271',2018,'TERM 3','FORM 3',7807.00),('4272',2018,'TERM 1','FORM 3',20268.00),('4272',2018,'TERM 2','FORM 3',12460.00),('4272',2018,'TERM 3','FORM 3',7807.00),('4274',2018,'TERM 1','FORM 3',20268.00),('4274',2018,'TERM 2','FORM 3',12460.00),('4274',2018,'TERM 3','FORM 3',7807.00),('4275',2018,'TERM 1','FORM 3',20268.00),('4275',2018,'TERM 2','FORM 3',12460.00),('4275',2018,'TERM 3','FORM 3',7807.00),('4276',2018,'TERM 1','FORM 3',20268.00),('4276',2018,'TERM 2','FORM 3',12460.00),('4276',2018,'TERM 3','FORM 3',7807.00),('4277',2018,'TERM 1','FORM 3',20268.00),('4277',2018,'TERM 2','FORM 3',12460.00),('4277',2018,'TERM 3','FORM 3',7807.00),('4278',2018,'TERM 1','FORM 3',20268.00),('4278',2018,'TERM 2','FORM 3',12460.00),('4278',2018,'TERM 3','FORM 3',7807.00),('4280',2018,'TERM 1','FORM 3',20268.00),('4280',2018,'TERM 2','FORM 3',12460.00),('4280',2018,'TERM 3','FORM 3',7807.00),('4281',2018,'TERM 1','FORM 3',20268.00),('4281',2018,'TERM 2','FORM 3',12460.00),('4281',2018,'TERM 3','FORM 3',7807.00),('4282',2018,'TERM 1','FORM 3',20268.00),('4282',2018,'TERM 2','FORM 3',12460.00),('4282',2018,'TERM 3','FORM 3',7807.00),('4283',2018,'TERM 1','FORM 3',20268.00),('4283',2018,'TERM 2','FORM 3',12460.00),('4283',2018,'TERM 3','FORM 3',7807.00),('4284',2018,'TERM 1','FORM 3',20268.00),('4284',2018,'TERM 2','FORM 3',12460.00),('4284',2018,'TERM 3','FORM 3',7807.00),('4285',2018,'TERM 1','FORM 3',20268.00),('4285',2018,'TERM 2','FORM 3',12460.00),('4285',2018,'TERM 3','FORM 3',7807.00),('4286',2018,'TERM 1','FORM 3',20268.00),('4286',2018,'TERM 2','FORM 3',12460.00),('4286',2018,'TERM 3','FORM 3',7807.00),('4287',2018,'TERM 1','FORM 3',20268.00),('4287',2018,'TERM 2','FORM 3',12460.00),('4287',2018,'TERM 3','FORM 3',7807.00),('4288',2018,'TERM 1','FORM 3',20268.00),('4288',2018,'TERM 2','FORM 3',12460.00),('4288',2018,'TERM 3','FORM 3',7807.00),('4289',2018,'TERM 1','FORM 3',20268.00),('4289',2018,'TERM 2','FORM 3',12460.00),('4289',2018,'TERM 3','FORM 3',7807.00),('4290',2018,'TERM 1','FORM 3',20268.00),('4290',2018,'TERM 2','FORM 3',12460.00),('4290',2018,'TERM 3','FORM 3',7807.00),('4292',2018,'TERM 1','FORM 3',20268.00),('4292',2018,'TERM 2','FORM 3',12460.00),('4292',2018,'TERM 3','FORM 3',7807.00),('4293',2018,'TERM 1','FORM 3',20268.00),('4293',2018,'TERM 2','FORM 3',12460.00),('4293',2018,'TERM 3','FORM 3',7807.00),('4294',2018,'TERM 1','FORM 3',20268.00),('4294',2018,'TERM 2','FORM 3',12460.00),('4294',2018,'TERM 3','FORM 3',7807.00),('4295',2018,'TERM 1','FORM 3',20268.00),('4295',2018,'TERM 2','FORM 3',12460.00),('4295',2018,'TERM 3','FORM 3',7807.00),('4296',2018,'TERM 1','FORM 3',20268.00),('4296',2018,'TERM 2','FORM 3',12460.00),('4296',2018,'TERM 3','FORM 3',7807.00),('4297',2018,'TERM 1','FORM 3',20268.00),('4297',2018,'TERM 2','FORM 3',12460.00),('4297',2018,'TERM 3','FORM 3',7807.00),('4298',2018,'TERM 1','FORM 3',20268.00),('4298',2018,'TERM 2','FORM 3',12460.00),('4298',2018,'TERM 3','FORM 3',7807.00),('4299',2018,'TERM 1','FORM 3',20268.00),('4299',2018,'TERM 2','FORM 3',12460.00),('4299',2018,'TERM 3','FORM 3',7807.00),('4300',2018,'TERM 1','FORM 3',20268.00),('4300',2018,'TERM 2','FORM 3',12460.00),('4300',2018,'TERM 3','FORM 3',7807.00),('4301',2018,'TERM 1','FORM 3',20268.00),('4301',2018,'TERM 2','FORM 3',12460.00),('4301',2018,'TERM 3','FORM 3',7807.00),('4302',2018,'TERM 1','FORM 3',20268.00),('4302',2018,'TERM 2','FORM 3',12460.00),('4302',2018,'TERM 3','FORM 3',7807.00),('4303',2018,'TERM 1','FORM 3',20268.00),('4303',2018,'TERM 2','FORM 3',12460.00),('4303',2018,'TERM 3','FORM 3',7807.00),('4304',2018,'TERM 1','FORM 3',20268.00),('4304',2018,'TERM 2','FORM 3',12460.00),('4304',2018,'TERM 3','FORM 3',7807.00),('4306',2018,'TERM 1','FORM 3',20268.00),('4306',2018,'TERM 2','FORM 3',12460.00),('4306',2018,'TERM 3','FORM 3',7807.00),('4309',2018,'TERM 1','FORM 3',20268.00),('4309',2018,'TERM 2','FORM 3',12460.00),('4309',2018,'TERM 3','FORM 3',7807.00),('4311',2018,'TERM 1','FORM 3',20268.00),('4311',2018,'TERM 2','FORM 3',12460.00),('4311',2018,'TERM 3','FORM 3',7807.00),('4312',2018,'TERM 1','FORM 3',20268.00),('4312',2018,'TERM 2','FORM 3',12460.00),('4312',2018,'TERM 3','FORM 3',7807.00),('4313',2018,'TERM 1','FORM 3',20268.00),('4313',2018,'TERM 2','FORM 3',12460.00),('4313',2018,'TERM 3','FORM 3',7807.00),('4314',2018,'TERM 1','FORM 3',20268.00),('4314',2018,'TERM 2','FORM 3',12460.00),('4314',2018,'TERM 3','FORM 3',7807.00),('4315',2018,'TERM 1','FORM 3',20268.00),('4315',2018,'TERM 2','FORM 3',12460.00),('4315',2018,'TERM 3','FORM 3',7807.00),('4317',2018,'TERM 1','FORM 3',20268.00),('4317',2018,'TERM 2','FORM 3',12460.00),('4317',2018,'TERM 3','FORM 3',7807.00),('4318',2018,'TERM 1','FORM 3',20268.00),('4318',2018,'TERM 2','FORM 3',12460.00),('4318',2018,'TERM 3','FORM 3',7807.00),('4319',2018,'TERM 1','FORM 3',20268.00),('4319',2018,'TERM 2','FORM 3',12460.00),('4319',2018,'TERM 3','FORM 3',7807.00),('4320',2018,'TERM 1','FORM 3',20268.00),('4320',2018,'TERM 2','FORM 3',12460.00),('4320',2018,'TERM 3','FORM 3',7807.00),('4321',2018,'TERM 1','FORM 3',20268.00),('4321',2018,'TERM 2','FORM 3',12460.00),('4321',2018,'TERM 3','FORM 3',7807.00),('4322',2018,'TERM 1','FORM 3',20268.00),('4322',2018,'TERM 2','FORM 3',12460.00),('4322',2018,'TERM 3','FORM 3',7807.00),('4323',2018,'TERM 1','FORM 3',20268.00),('4323',2018,'TERM 2','FORM 3',12460.00),('4323',2018,'TERM 3','FORM 3',7807.00),('4324',2018,'TERM 1','FORM 3',20268.00),('4324',2018,'TERM 2','FORM 3',12460.00),('4324',2018,'TERM 3','FORM 3',7807.00),('4326',2018,'TERM 1','FORM 3',20268.00),('4326',2018,'TERM 2','FORM 3',12460.00),('4326',2018,'TERM 3','FORM 3',7807.00),('4327',2018,'TERM 1','FORM 3',20268.00),('4327',2018,'TERM 2','FORM 3',12460.00),('4327',2018,'TERM 3','FORM 3',7807.00),('4328',2018,'TERM 1','FORM 3',20268.00),('4328',2018,'TERM 2','FORM 3',12460.00),('4328',2018,'TERM 3','FORM 3',7807.00),('4329',2018,'TERM 1','FORM 3',20268.00),('4329',2018,'TERM 2','FORM 3',12460.00),('4329',2018,'TERM 3','FORM 3',7807.00),('4330',2018,'TERM 1','FORM 3',20268.00),('4330',2018,'TERM 2','FORM 3',12460.00),('4330',2018,'TERM 3','FORM 3',7807.00),('4332',2018,'TERM 1','FORM 3',20268.00),('4332',2018,'TERM 2','FORM 3',12460.00),('4332',2018,'TERM 3','FORM 3',7807.00),('4333',2018,'TERM 1','FORM 3',20268.00),('4333',2018,'TERM 2','FORM 3',12460.00),('4333',2018,'TERM 3','FORM 3',7807.00),('4334',2018,'TERM 1','FORM 3',20268.00),('4334',2018,'TERM 2','FORM 3',12460.00),('4334',2018,'TERM 3','FORM 3',7807.00),('4335',2018,'TERM 1','FORM 3',20268.00),('4335',2018,'TERM 2','FORM 3',12460.00),('4335',2018,'TERM 3','FORM 3',7807.00),('4336',2018,'TERM 1','FORM 3',20268.00),('4336',2018,'TERM 2','FORM 3',12460.00),('4336',2018,'TERM 3','FORM 3',7807.00),('4337',2018,'TERM 1','FORM 3',20268.00),('4337',2018,'TERM 2','FORM 3',12460.00),('4337',2018,'TERM 3','FORM 3',7807.00),('4338',2018,'TERM 1','FORM 3',20268.00),('4338',2018,'TERM 2','FORM 3',12460.00),('4338',2018,'TERM 3','FORM 3',7807.00),('4339',2018,'TERM 1','FORM 3',20268.00),('4339',2018,'TERM 2','FORM 3',12460.00),('4339',2018,'TERM 3','FORM 3',7807.00),('4340',2018,'TERM 1','FORM 3',20268.00),('4340',2018,'TERM 2','FORM 3',12460.00),('4340',2018,'TERM 3','FORM 3',7807.00),('4341',2018,'TERM 1','FORM 3',20268.00),('4341',2018,'TERM 2','FORM 3',12460.00),('4341',2018,'TERM 3','FORM 3',7807.00),('4342',2018,'TERM 1','FORM 3',20268.00),('4342',2018,'TERM 2','FORM 3',12460.00),('4342',2018,'TERM 3','FORM 3',7807.00),('4343',2018,'TERM 1','FORM 3',20268.00),('4343',2018,'TERM 2','FORM 3',12460.00),('4343',2018,'TERM 3','FORM 3',7807.00),('4345',2018,'TERM 1','FORM 3',20268.00),('4345',2018,'TERM 2','FORM 3',12460.00),('4345',2018,'TERM 3','FORM 3',7807.00),('4346',2018,'TERM 1','FORM 3',20268.00),('4346',2018,'TERM 2','FORM 3',12460.00),('4346',2018,'TERM 3','FORM 3',7807.00),('4347',2018,'TERM 1','FORM 3',20268.00),('4347',2018,'TERM 2','FORM 3',12460.00),('4347',2018,'TERM 3','FORM 3',7807.00),('4348',2018,'TERM 1','FORM 3',20268.00),('4348',2018,'TERM 2','FORM 3',12460.00),('4348',2018,'TERM 3','FORM 3',7807.00),('4351',2018,'TERM 1','FORM 3',20268.00),('4351',2018,'TERM 2','FORM 3',12460.00),('4351',2018,'TERM 3','FORM 3',7807.00),('4352',2018,'TERM 1','FORM 3',20268.00),('4352',2018,'TERM 2','FORM 3',12460.00),('4352',2018,'TERM 3','FORM 3',7807.00),('4353',2018,'TERM 1','FORM 3',20268.00),('4353',2018,'TERM 2','FORM 3',12460.00),('4353',2018,'TERM 3','FORM 3',7807.00),('4356',2018,'TERM 1','FORM 3',20268.00),('4356',2018,'TERM 2','FORM 3',12460.00),('4356',2018,'TERM 3','FORM 3',7807.00),('4358',2018,'TERM 1','FORM 3',20268.00),('4358',2018,'TERM 2','FORM 3',12460.00),('4358',2018,'TERM 3','FORM 3',7807.00),('4359',2018,'TERM 1','FORM 3',20268.00),('4359',2018,'TERM 2','FORM 3',12460.00),('4359',2018,'TERM 3','FORM 3',7807.00),('4360',2018,'TERM 1','FORM 3',20268.00),('4360',2018,'TERM 2','FORM 3',12460.00),('4360',2018,'TERM 3','FORM 3',7807.00),('4361',2018,'TERM 1','FORM 3',20268.00),('4361',2018,'TERM 2','FORM 3',12460.00),('4361',2018,'TERM 3','FORM 3',7807.00),('4362',2018,'TERM 1','FORM 3',20268.00),('4362',2018,'TERM 2','FORM 3',12460.00),('4362',2018,'TERM 3','FORM 3',7807.00),('4363',2018,'TERM 1','FORM 3',20268.00),('4363',2018,'TERM 2','FORM 3',12460.00),('4363',2018,'TERM 3','FORM 3',7807.00),('4365',2018,'TERM 1','FORM 3',20268.00),('4365',2018,'TERM 2','FORM 3',12460.00),('4365',2018,'TERM 3','FORM 3',7807.00),('4366',2018,'TERM 1','FORM 3',20268.00),('4366',2018,'TERM 2','FORM 3',12460.00),('4366',2018,'TERM 3','FORM 3',7807.00),('4368',2018,'TERM 1','FORM 3',20268.00),('4368',2018,'TERM 2','FORM 3',12460.00),('4368',2018,'TERM 3','FORM 3',7807.00),('4370',2018,'TERM 1','FORM 3',20268.00),('4370',2018,'TERM 2','FORM 3',12460.00),('4370',2018,'TERM 3','FORM 3',7807.00),('4371',2018,'TERM 1','FORM 4',20268.00),('4371',2018,'TERM 2','FORM 4',12460.00),('4371',2018,'TERM 3','FORM 4',7807.00),('4372',2018,'TERM 1','FORM 4',20268.00),('4372',2018,'TERM 2','FORM 4',12460.00),('4372',2018,'TERM 3','FORM 4',7807.00),('4373',2018,'TERM 1','FORM 3',20268.00),('4373',2018,'TERM 2','FORM 3',12460.00),('4373',2018,'TERM 3','FORM 3',7807.00),('4374',2018,'TERM 1','FORM 3',20268.00),('4374',2018,'TERM 2','FORM 3',12460.00),('4374',2018,'TERM 3','FORM 3',7807.00),('4375',2018,'TERM 1','FORM 3',20268.00),('4375',2018,'TERM 2','FORM 3',12460.00),('4375',2018,'TERM 3','FORM 3',7807.00),('4377',2018,'TERM 1','FORM 3',20268.00),('4377',2018,'TERM 2','FORM 3',12460.00),('4377',2018,'TERM 3','FORM 3',7807.00),('4378',2018,'TERM 1','FORM 2',20268.00),('4378',2018,'TERM 2','FORM 2',12460.00),('4378',2018,'TERM 3','FORM 2',7807.00),('4379',2018,'TERM 1','FORM 2',20268.00),('4379',2018,'TERM 2','FORM 2',12460.00),('4379',2018,'TERM 3','FORM 2',7807.00),('4380',2018,'TERM 1','FORM 2',20268.00),('4380',2018,'TERM 2','FORM 2',12460.00),('4380',2018,'TERM 3','FORM 2',7807.00),('4381',2018,'TERM 1','FORM 2',20268.00),('4381',2018,'TERM 2','FORM 2',12460.00),('4381',2018,'TERM 3','FORM 2',7807.00),('4382',2018,'TERM 1','FORM 2',20268.00),('4382',2018,'TERM 2','FORM 2',12460.00),('4382',2018,'TERM 3','FORM 2',7807.00),('4383',2018,'TERM 1','FORM 2',20268.00),('4383',2018,'TERM 2','FORM 2',12460.00),('4383',2018,'TERM 3','FORM 2',7807.00),('4384',2018,'TERM 1','FORM 2',20268.00),('4384',2018,'TERM 2','FORM 2',12460.00),('4384',2018,'TERM 3','FORM 2',7807.00),('4385',2018,'TERM 1','FORM 2',20268.00),('4385',2018,'TERM 2','FORM 2',12460.00),('4385',2018,'TERM 3','FORM 2',7807.00),('4386',2018,'TERM 1','FORM 2',20268.00),('4386',2018,'TERM 2','FORM 2',12460.00),('4386',2018,'TERM 3','FORM 2',7807.00),('4387',2018,'TERM 1','FORM 2',20268.00),('4387',2018,'TERM 2','FORM 2',12460.00),('4387',2018,'TERM 3','FORM 2',7807.00),('4388',2018,'TERM 1','FORM 2',20268.00),('4388',2018,'TERM 2','FORM 2',12460.00),('4388',2018,'TERM 3','FORM 2',7807.00),('4389',2018,'TERM 1','FORM 2',20268.00),('4389',2018,'TERM 2','FORM 2',12460.00),('4389',2018,'TERM 3','FORM 2',7807.00),('4390',2018,'TERM 1','FORM 2',20268.00),('4390',2018,'TERM 2','FORM 2',12460.00),('4390',2018,'TERM 3','FORM 2',7807.00),('4391',2018,'TERM 1','FORM 2',20268.00),('4391',2018,'TERM 2','FORM 2',12460.00),('4391',2018,'TERM 3','FORM 2',7807.00),('4392',2018,'TERM 1','FORM 2',20268.00),('4392',2018,'TERM 2','FORM 2',12460.00),('4392',2018,'TERM 3','FORM 2',7807.00),('4394',2018,'TERM 1','FORM 2',20268.00),('4394',2018,'TERM 2','FORM 2',12460.00),('4394',2018,'TERM 3','FORM 2',7807.00),('4395',2018,'TERM 1','FORM 2',20268.00),('4395',2018,'TERM 2','FORM 2',12460.00),('4395',2018,'TERM 3','FORM 2',7807.00),('4396',2018,'TERM 1','FORM 2',20268.00),('4396',2018,'TERM 2','FORM 2',12460.00),('4396',2018,'TERM 3','FORM 2',7807.00),('4397',2018,'TERM 1','FORM 2',20268.00),('4397',2018,'TERM 2','FORM 2',12460.00),('4397',2018,'TERM 3','FORM 2',7807.00),('4398',2018,'TERM 1','FORM 2',20268.00),('4398',2018,'TERM 2','FORM 2',12460.00),('4398',2018,'TERM 3','FORM 2',7807.00),('4399',2018,'TERM 1','FORM 2',20268.00),('4399',2018,'TERM 2','FORM 2',12460.00),('4399',2018,'TERM 3','FORM 2',7807.00),('4400',2018,'TERM 1','FORM 2',20268.00),('4400',2018,'TERM 2','FORM 2',12460.00),('4400',2018,'TERM 3','FORM 2',7807.00),('4401',2018,'TERM 1','FORM 2',20268.00),('4401',2018,'TERM 2','FORM 2',12460.00),('4401',2018,'TERM 3','FORM 2',7807.00),('4402',2018,'TERM 1','FORM 2',20268.00),('4402',2018,'TERM 2','FORM 2',12460.00),('4402',2018,'TERM 3','FORM 2',7807.00),('4403',2018,'TERM 1','FORM 2',20268.00),('4403',2018,'TERM 2','FORM 2',12460.00),('4403',2018,'TERM 3','FORM 2',7807.00),('4404',2018,'TERM 1','FORM 2',20268.00),('4404',2018,'TERM 2','FORM 2',12460.00),('4404',2018,'TERM 3','FORM 2',7807.00),('4405',2018,'TERM 1','FORM 2',20268.00),('4405',2018,'TERM 2','FORM 2',12460.00),('4405',2018,'TERM 3','FORM 2',7807.00),('4406',2018,'TERM 1','FORM 2',20268.00),('4406',2018,'TERM 2','FORM 2',12460.00),('4406',2018,'TERM 3','FORM 2',7807.00),('4407',2018,'TERM 1','FORM 2',20268.00),('4407',2018,'TERM 2','FORM 2',12460.00),('4407',2018,'TERM 3','FORM 2',7807.00),('4408',2018,'TERM 1','FORM 2',20268.00),('4408',2018,'TERM 2','FORM 2',12460.00),('4408',2018,'TERM 3','FORM 2',7807.00),('4409',2018,'TERM 1','FORM 2',20268.00),('4409',2018,'TERM 2','FORM 2',12460.00),('4409',2018,'TERM 3','FORM 2',7807.00),('4410',2018,'TERM 1','FORM 2',20268.00),('4410',2018,'TERM 2','FORM 2',12460.00),('4410',2018,'TERM 3','FORM 2',7807.00),('4411',2018,'TERM 1','FORM 2',20268.00),('4411',2018,'TERM 2','FORM 2',12460.00),('4411',2018,'TERM 3','FORM 2',7807.00),('4412',2018,'TERM 1','FORM 2',20268.00),('4412',2018,'TERM 2','FORM 2',12460.00),('4412',2018,'TERM 3','FORM 2',7807.00),('4413',2018,'TERM 1','FORM 2',20268.00),('4413',2018,'TERM 2','FORM 2',12460.00),('4413',2018,'TERM 3','FORM 2',7807.00),('4414',2018,'TERM 1','FORM 2',20268.00),('4414',2018,'TERM 2','FORM 2',12460.00),('4414',2018,'TERM 3','FORM 2',7807.00),('4415',2018,'TERM 1','FORM 2',20268.00),('4415',2018,'TERM 2','FORM 2',12460.00),('4415',2018,'TERM 3','FORM 2',7807.00),('4416',2018,'TERM 1','FORM 2',20268.00),('4416',2018,'TERM 2','FORM 2',12460.00),('4416',2018,'TERM 3','FORM 2',7807.00),('4417',2018,'TERM 1','FORM 2',20268.00),('4417',2018,'TERM 2','FORM 2',12460.00),('4417',2018,'TERM 3','FORM 2',7807.00),('4418',2018,'TERM 1','FORM 2',20268.00),('4418',2018,'TERM 2','FORM 2',12460.00),('4418',2018,'TERM 3','FORM 2',7807.00),('4420',2018,'TERM 1','FORM 2',20268.00),('4420',2018,'TERM 2','FORM 2',12460.00),('4420',2018,'TERM 3','FORM 2',7807.00),('4421',2018,'TERM 1','FORM 2',20268.00),('4421',2018,'TERM 2','FORM 2',12460.00),('4421',2018,'TERM 3','FORM 2',7807.00),('4422',2018,'TERM 1','FORM 2',20268.00),('4422',2018,'TERM 2','FORM 2',12460.00),('4422',2018,'TERM 3','FORM 2',7807.00),('4423',2018,'TERM 1','FORM 2',20268.00),('4423',2018,'TERM 2','FORM 2',12460.00),('4423',2018,'TERM 3','FORM 2',7807.00),('4424',2018,'TERM 1','FORM 2',20268.00),('4424',2018,'TERM 2','FORM 2',12460.00),('4424',2018,'TERM 3','FORM 2',7807.00),('4425',2018,'TERM 1','FORM 2',20268.00),('4425',2018,'TERM 2','FORM 2',12460.00),('4425',2018,'TERM 3','FORM 2',7807.00),('4426',2018,'TERM 1','FORM 2',20268.00),('4426',2018,'TERM 2','FORM 2',12460.00),('4426',2018,'TERM 3','FORM 2',7807.00),('4427',2018,'TERM 1','FORM 2',20268.00),('4427',2018,'TERM 2','FORM 2',12460.00),('4427',2018,'TERM 3','FORM 2',7807.00),('4428',2018,'TERM 1','FORM 2',20268.00),('4428',2018,'TERM 2','FORM 2',12460.00),('4428',2018,'TERM 3','FORM 2',7807.00),('4429',2018,'TERM 1','FORM 2',20268.00),('4429',2018,'TERM 2','FORM 2',12460.00),('4429',2018,'TERM 3','FORM 2',7807.00),('4430',2018,'TERM 1','FORM 2',20268.00),('4430',2018,'TERM 2','FORM 2',12460.00),('4430',2018,'TERM 3','FORM 2',7807.00),('4431',2018,'TERM 1','FORM 2',20268.00),('4431',2018,'TERM 2','FORM 2',12460.00),('4431',2018,'TERM 3','FORM 2',7807.00),('4433',2018,'TERM 1','FORM 2',20268.00),('4433',2018,'TERM 2','FORM 2',12460.00),('4433',2018,'TERM 3','FORM 2',7807.00),('4434',2018,'TERM 1','FORM 2',20268.00),('4434',2018,'TERM 2','FORM 2',12460.00),('4434',2018,'TERM 3','FORM 2',7807.00),('4435',2018,'TERM 1','FORM 2',20268.00),('4435',2018,'TERM 2','FORM 2',12460.00),('4435',2018,'TERM 3','FORM 2',7807.00),('4436',2018,'TERM 1','FORM 2',20268.00),('4436',2018,'TERM 2','FORM 2',12460.00),('4436',2018,'TERM 3','FORM 2',7807.00),('4438',2018,'TERM 1','FORM 2',20268.00),('4438',2018,'TERM 2','FORM 2',12460.00),('4438',2018,'TERM 3','FORM 2',7807.00),('4439',2018,'TERM 1','FORM 2',20268.00),('4439',2018,'TERM 2','FORM 2',12460.00),('4439',2018,'TERM 3','FORM 2',7807.00),('4440',2018,'TERM 1','FORM 2',20268.00),('4440',2018,'TERM 2','FORM 2',12460.00),('4440',2018,'TERM 3','FORM 2',7807.00),('4441',2018,'TERM 1','FORM 2',20268.00),('4441',2018,'TERM 2','FORM 2',12460.00),('4441',2018,'TERM 3','FORM 2',7807.00),('4442',2018,'TERM 1','FORM 2',20268.00),('4442',2018,'TERM 2','FORM 2',12460.00),('4442',2018,'TERM 3','FORM 2',7807.00),('4443',2018,'TERM 1','FORM 2',20268.00),('4443',2018,'TERM 2','FORM 2',12460.00),('4443',2018,'TERM 3','FORM 2',7807.00),('4444',2018,'TERM 1','FORM 2',20268.00),('4444',2018,'TERM 2','FORM 2',12460.00),('4444',2018,'TERM 3','FORM 2',7807.00),('4446',2018,'TERM 1','FORM 2',20268.00),('4446',2018,'TERM 2','FORM 2',12460.00),('4446',2018,'TERM 3','FORM 2',7807.00),('4447',2018,'TERM 1','FORM 2',20268.00),('4447',2018,'TERM 2','FORM 2',12460.00),('4447',2018,'TERM 3','FORM 2',7807.00),('4448',2018,'TERM 1','FORM 2',20268.00),('4448',2018,'TERM 2','FORM 2',12460.00),('4448',2018,'TERM 3','FORM 2',7807.00),('4449',2018,'TERM 1','FORM 2',20268.00),('4449',2018,'TERM 2','FORM 2',12460.00),('4449',2018,'TERM 3','FORM 2',7807.00),('4450',2018,'TERM 1','FORM 2',20268.00),('4450',2018,'TERM 2','FORM 2',12460.00),('4450',2018,'TERM 3','FORM 2',7807.00),('4451',2018,'TERM 1','FORM 2',20268.00),('4451',2018,'TERM 2','FORM 2',12460.00),('4451',2018,'TERM 3','FORM 2',7807.00),('4452',2018,'TERM 1','FORM 2',20268.00),('4452',2018,'TERM 2','FORM 2',12460.00),('4452',2018,'TERM 3','FORM 2',7807.00),('4453',2018,'TERM 1','FORM 2',20268.00),('4453',2018,'TERM 2','FORM 2',12460.00),('4453',2018,'TERM 3','FORM 2',7807.00),('4454',2018,'TERM 1','FORM 2',20268.00),('4454',2018,'TERM 2','FORM 2',12460.00),('4454',2018,'TERM 3','FORM 2',7807.00),('4455',2018,'TERM 1','FORM 2',20268.00),('4455',2018,'TERM 2','FORM 2',12460.00),('4455',2018,'TERM 3','FORM 2',7807.00),('4456',2018,'TERM 1','FORM 2',20268.00),('4456',2018,'TERM 2','FORM 2',12460.00),('4456',2018,'TERM 3','FORM 2',7807.00),('4457',2018,'TERM 1','FORM 2',20268.00),('4457',2018,'TERM 2','FORM 2',12460.00),('4457',2018,'TERM 3','FORM 2',7807.00),('4458',2018,'TERM 1','FORM 2',20268.00),('4458',2018,'TERM 2','FORM 2',12460.00),('4458',2018,'TERM 3','FORM 2',7807.00),('4459',2018,'TERM 1','FORM 2',20268.00),('4459',2018,'TERM 2','FORM 2',12460.00),('4459',2018,'TERM 3','FORM 2',7807.00),('4460',2018,'TERM 1','FORM 2',20268.00),('4460',2018,'TERM 2','FORM 2',12460.00),('4460',2018,'TERM 3','FORM 2',7807.00),('4461',2018,'TERM 1','FORM 2',20268.00),('4461',2018,'TERM 2','FORM 2',12460.00),('4461',2018,'TERM 3','FORM 2',7807.00),('4463',2018,'TERM 1','FORM 2',20268.00),('4463',2018,'TERM 2','FORM 2',12460.00),('4463',2018,'TERM 3','FORM 2',7807.00),('4464',2018,'TERM 1','FORM 2',20268.00),('4464',2018,'TERM 2','FORM 2',12460.00),('4464',2018,'TERM 3','FORM 2',7807.00),('4465',2018,'TERM 1','FORM 2',20268.00),('4465',2018,'TERM 2','FORM 2',12460.00),('4465',2018,'TERM 3','FORM 2',7807.00),('4466',2018,'TERM 1','FORM 2',20268.00),('4466',2018,'TERM 2','FORM 2',12460.00),('4466',2018,'TERM 3','FORM 2',7807.00),('4467',2018,'TERM 1','FORM 2',20268.00),('4467',2018,'TERM 2','FORM 2',12460.00),('4467',2018,'TERM 3','FORM 2',7807.00),('4468',2018,'TERM 1','FORM 2',20268.00),('4468',2018,'TERM 2','FORM 2',12460.00),('4468',2018,'TERM 3','FORM 2',7807.00),('4469',2018,'TERM 1','FORM 2',20268.00),('4469',2018,'TERM 2','FORM 2',12460.00),('4469',2018,'TERM 3','FORM 2',7807.00),('4470',2018,'TERM 1','FORM 2',20268.00),('4470',2018,'TERM 2','FORM 2',12460.00),('4470',2018,'TERM 3','FORM 2',7807.00),('4471',2018,'TERM 1','FORM 2',20268.00),('4471',2018,'TERM 2','FORM 2',12460.00),('4471',2018,'TERM 3','FORM 2',7807.00),('4472',2018,'TERM 1','FORM 2',20268.00),('4472',2018,'TERM 2','FORM 2',12460.00),('4472',2018,'TERM 3','FORM 2',7807.00),('4473',2018,'TERM 1','FORM 2',20268.00),('4473',2018,'TERM 2','FORM 2',12460.00),('4473',2018,'TERM 3','FORM 2',7807.00),('4475',2018,'TERM 1','FORM 2',20268.00),('4475',2018,'TERM 2','FORM 2',12460.00),('4475',2018,'TERM 3','FORM 2',7807.00),('4476',2018,'TERM 1','FORM 2',20268.00),('4476',2018,'TERM 2','FORM 2',12460.00),('4476',2018,'TERM 3','FORM 2',7807.00),('4477',2018,'TERM 1','FORM 2',20268.00),('4477',2018,'TERM 2','FORM 2',12460.00),('4477',2018,'TERM 3','FORM 2',7807.00),('4478',2018,'TERM 1','FORM 2',20268.00),('4478',2018,'TERM 2','FORM 2',12460.00),('4478',2018,'TERM 3','FORM 2',7807.00),('4479',2018,'TERM 1','FORM 2',20268.00),('4479',2018,'TERM 2','FORM 2',12460.00),('4479',2018,'TERM 3','FORM 2',7807.00),('4480',2018,'TERM 1','FORM 2',20268.00),('4480',2018,'TERM 2','FORM 2',12460.00),('4480',2018,'TERM 3','FORM 2',7807.00),('4482',2018,'TERM 1','FORM 2',20268.00),('4482',2018,'TERM 2','FORM 2',12460.00),('4482',2018,'TERM 3','FORM 2',7807.00),('4483',2018,'TERM 1','FORM 2',20268.00),('4483',2018,'TERM 2','FORM 2',12460.00),('4483',2018,'TERM 3','FORM 2',7807.00),('4484',2018,'TERM 1','FORM 2',20268.00),('4484',2018,'TERM 2','FORM 2',12460.00),('4484',2018,'TERM 3','FORM 2',7807.00),('4485',2018,'TERM 1','FORM 2',20268.00),('4485',2018,'TERM 2','FORM 2',12460.00),('4485',2018,'TERM 3','FORM 2',7807.00),('4486',2018,'TERM 1','FORM 2',20268.00),('4486',2018,'TERM 2','FORM 2',12460.00),('4486',2018,'TERM 3','FORM 2',7807.00),('4487',2018,'TERM 1','FORM 2',20268.00),('4487',2018,'TERM 2','FORM 2',12460.00),('4487',2018,'TERM 3','FORM 2',7807.00),('4488',2018,'TERM 1','FORM 2',20268.00),('4488',2018,'TERM 2','FORM 2',12460.00),('4488',2018,'TERM 3','FORM 2',7807.00),('4489',2018,'TERM 1','FORM 2',20268.00),('4489',2018,'TERM 2','FORM 2',12460.00),('4489',2018,'TERM 3','FORM 2',7807.00),('4490',2018,'TERM 1','FORM 2',20268.00),('4490',2018,'TERM 2','FORM 2',12460.00),('4490',2018,'TERM 3','FORM 2',7807.00),('4491',2018,'TERM 1','FORM 2',20268.00),('4491',2018,'TERM 2','FORM 2',12460.00),('4491',2018,'TERM 3','FORM 2',7807.00),('4492',2018,'TERM 1','FORM 2',20268.00),('4492',2018,'TERM 2','FORM 2',12460.00),('4492',2018,'TERM 3','FORM 2',7807.00),('4493',2018,'TERM 1','FORM 2',20268.00),('4493',2018,'TERM 2','FORM 2',12460.00),('4493',2018,'TERM 3','FORM 2',7807.00),('4494',2018,'TERM 1','FORM 2',20268.00),('4494',2018,'TERM 2','FORM 2',12460.00),('4494',2018,'TERM 3','FORM 2',7807.00),('4495',2018,'TERM 1','FORM 2',20268.00),('4495',2018,'TERM 2','FORM 2',12460.00),('4495',2018,'TERM 3','FORM 2',7807.00),('4497',2018,'TERM 1','FORM 2',20268.00),('4497',2018,'TERM 2','FORM 2',12460.00),('4497',2018,'TERM 3','FORM 2',7807.00),('4498',2018,'TERM 1','FORM 2',20268.00),('4498',2018,'TERM 2','FORM 2',12460.00),('4498',2018,'TERM 3','FORM 2',7807.00),('4499',2018,'TERM 1','FORM 2',20268.00),('4499',2018,'TERM 2','FORM 2',12460.00),('4499',2018,'TERM 3','FORM 2',7807.00),('4500',2018,'TERM 1','FORM 2',20268.00),('4500',2018,'TERM 2','FORM 2',12460.00),('4500',2018,'TERM 3','FORM 2',7807.00),('4501',2018,'TERM 1','FORM 2',20268.00),('4501',2018,'TERM 2','FORM 2',12460.00),('4501',2018,'TERM 3','FORM 2',7807.00),('4503',2018,'TERM 1','FORM 2',20268.00),('4503',2018,'TERM 2','FORM 2',12460.00),('4503',2018,'TERM 3','FORM 2',7807.00),('4504',2018,'TERM 1','FORM 2',20268.00),('4504',2018,'TERM 2','FORM 2',12460.00),('4504',2018,'TERM 3','FORM 2',7807.00),('4505',2018,'TERM 1','FORM 2',20268.00),('4505',2018,'TERM 2','FORM 2',12460.00),('4505',2018,'TERM 3','FORM 2',7807.00),('4506',2018,'TERM 1','FORM 2',20268.00),('4506',2018,'TERM 2','FORM 2',12460.00),('4506',2018,'TERM 3','FORM 2',7807.00),('4507',2018,'TERM 1','FORM 4',20268.00),('4507',2018,'TERM 2','FORM 4',12460.00),('4507',2018,'TERM 3','FORM 4',7807.00),('4508',2018,'TERM 1','FORM 2',20268.00),('4508',2018,'TERM 2','FORM 2',12460.00),('4508',2018,'TERM 3','FORM 2',7807.00),('4509',2018,'TERM 1','FORM 1',20268.00),('4509',2018,'TERM 2','FORM 1',12460.00),('4509',2018,'TERM 3','FORM 1',7807.00),('4510',2018,'TERM 1','FORM 1',20268.00),('4510',2018,'TERM 2','FORM 1',12460.00),('4510',2018,'TERM 3','FORM 1',7807.00),('4511',2018,'TERM 1','FORM 1',20268.00),('4511',2018,'TERM 2','FORM 1',12460.00),('4511',2018,'TERM 3','FORM 1',7807.00),('4512',2018,'TERM 1','FORM 1',20268.00),('4512',2018,'TERM 2','FORM 1',12460.00),('4512',2018,'TERM 3','FORM 1',7807.00),('4513',2018,'TERM 1','FORM 1',20268.00),('4513',2018,'TERM 2','FORM 1',12460.00),('4513',2018,'TERM 3','FORM 1',7807.00),('4514',2018,'TERM 1','FORM 1',20268.00),('4514',2018,'TERM 2','FORM 1',12460.00),('4514',2018,'TERM 3','FORM 1',7807.00),('4515',2018,'TERM 1','FORM 1',20268.00),('4515',2018,'TERM 2','FORM 1',12460.00),('4515',2018,'TERM 3','FORM 1',7807.00),('4516',2018,'TERM 1','FORM 1',20268.00),('4516',2018,'TERM 2','FORM 1',12460.00),('4516',2018,'TERM 3','FORM 1',7807.00),('4517',2018,'TERM 1','FORM 1',20268.00),('4517',2018,'TERM 2','FORM 1',12460.00),('4517',2018,'TERM 3','FORM 1',7807.00),('4518',2018,'TERM 1','FORM 1',20268.00),('4518',2018,'TERM 2','FORM 1',12460.00),('4518',2018,'TERM 3','FORM 1',7807.00),('4519',2018,'TERM 1','FORM 1',20268.00),('4519',2018,'TERM 2','FORM 1',12460.00),('4519',2018,'TERM 3','FORM 1',7807.00),('4520',2018,'TERM 1','FORM 1',20268.00),('4520',2018,'TERM 2','FORM 1',12460.00),('4520',2018,'TERM 3','FORM 1',7807.00),('4521',2018,'TERM 1','FORM 1',20268.00),('4521',2018,'TERM 2','FORM 1',12460.00),('4521',2018,'TERM 3','FORM 1',7807.00),('4522',2018,'TERM 1','FORM 1',20268.00),('4522',2018,'TERM 2','FORM 1',12460.00),('4522',2018,'TERM 3','FORM 1',7807.00),('4523',2018,'TERM 1','FORM 1',20268.00),('4523',2018,'TERM 2','FORM 1',12460.00),('4523',2018,'TERM 3','FORM 1',7807.00),('4524',2018,'TERM 1','FORM 1',20268.00),('4524',2018,'TERM 2','FORM 1',12460.00),('4524',2018,'TERM 3','FORM 1',7807.00),('4525',2018,'TERM 1','FORM 1',20268.00),('4525',2018,'TERM 2','FORM 1',12460.00),('4525',2018,'TERM 3','FORM 1',7807.00),('4526',2018,'TERM 1','FORM 1',20268.00),('4526',2018,'TERM 2','FORM 1',12460.00),('4526',2018,'TERM 3','FORM 1',7807.00),('4527',2018,'TERM 1','FORM 1',20268.00),('4527',2018,'TERM 2','FORM 1',12460.00),('4527',2018,'TERM 3','FORM 1',7807.00),('4528',2018,'TERM 1','FORM 1',20268.00),('4528',2018,'TERM 2','FORM 1',12460.00),('4528',2018,'TERM 3','FORM 1',7807.00),('4529',2018,'TERM 1','FORM 1',20268.00),('4529',2018,'TERM 2','FORM 1',12460.00),('4529',2018,'TERM 3','FORM 1',7807.00),('4530',2018,'TERM 1','FORM 1',20268.00),('4530',2018,'TERM 2','FORM 1',12460.00),('4530',2018,'TERM 3','FORM 1',7807.00),('4531',2018,'TERM 1','FORM 1',20268.00),('4531',2018,'TERM 2','FORM 1',12460.00),('4531',2018,'TERM 3','FORM 1',7807.00),('4532',2018,'TERM 1','FORM 1',20268.00),('4532',2018,'TERM 2','FORM 1',12460.00),('4532',2018,'TERM 3','FORM 1',7807.00),('4533',2018,'TERM 1','FORM 1',20268.00),('4533',2018,'TERM 2','FORM 1',12460.00),('4533',2018,'TERM 3','FORM 1',7807.00),('4534',2018,'TERM 1','FORM 1',20268.00),('4534',2018,'TERM 2','FORM 1',12460.00),('4534',2018,'TERM 3','FORM 1',7807.00),('4535',2018,'TERM 1','FORM 1',20268.00),('4535',2018,'TERM 2','FORM 1',12460.00),('4535',2018,'TERM 3','FORM 1',7807.00),('4536',2018,'TERM 1','FORM 1',20268.00),('4536',2018,'TERM 2','FORM 1',12460.00),('4536',2018,'TERM 3','FORM 1',7807.00),('4537',2018,'TERM 1','FORM 1',20268.00),('4537',2018,'TERM 2','FORM 1',12460.00),('4537',2018,'TERM 3','FORM 1',7807.00),('4538',2018,'TERM 1','FORM 1',20268.00),('4538',2018,'TERM 2','FORM 1',12460.00),('4538',2018,'TERM 3','FORM 1',7807.00),('4539',2018,'TERM 1','FORM 1',20268.00),('4539',2018,'TERM 2','FORM 1',12460.00),('4539',2018,'TERM 3','FORM 1',7807.00),('4540',2018,'TERM 1','FORM 1',20268.00),('4540',2018,'TERM 2','FORM 1',12460.00),('4540',2018,'TERM 3','FORM 1',7807.00),('4541',2018,'TERM 1','FORM 1',20268.00),('4541',2018,'TERM 2','FORM 1',12460.00),('4541',2018,'TERM 3','FORM 1',7807.00),('4542',2018,'TERM 1','FORM 1',20268.00),('4542',2018,'TERM 2','FORM 1',12460.00),('4542',2018,'TERM 3','FORM 1',7807.00),('4543',2018,'TERM 1','FORM 1',20268.00),('4543',2018,'TERM 2','FORM 1',12460.00),('4543',2018,'TERM 3','FORM 1',7807.00),('4544',2018,'TERM 1','FORM 1',20268.00),('4544',2018,'TERM 2','FORM 1',12460.00),('4544',2018,'TERM 3','FORM 1',7807.00),('4545',2018,'TERM 1','FORM 1',20268.00),('4545',2018,'TERM 2','FORM 1',12460.00),('4545',2018,'TERM 3','FORM 1',7807.00),('4546',2018,'TERM 1','FORM 1',20268.00),('4546',2018,'TERM 2','FORM 1',12460.00),('4546',2018,'TERM 3','FORM 1',7807.00),('4547',2018,'TERM 1','FORM 1',20268.00),('4547',2018,'TERM 2','FORM 1',12460.00),('4547',2018,'TERM 3','FORM 1',7807.00),('4548',2018,'TERM 1','FORM 1',20268.00),('4548',2018,'TERM 2','FORM 1',12460.00),('4548',2018,'TERM 3','FORM 1',7807.00),('4549',2018,'TERM 1','FORM 1',20268.00),('4549',2018,'TERM 2','FORM 1',12460.00),('4549',2018,'TERM 3','FORM 1',7807.00),('4550',2018,'TERM 1','FORM 1',20268.00),('4550',2018,'TERM 2','FORM 1',12460.00),('4550',2018,'TERM 3','FORM 1',7807.00),('4551',2018,'TERM 1','FORM 1',20268.00),('4551',2018,'TERM 2','FORM 1',12460.00),('4551',2018,'TERM 3','FORM 1',7807.00),('4552',2018,'TERM 1','FORM 1',20268.00),('4552',2018,'TERM 2','FORM 1',12460.00),('4552',2018,'TERM 3','FORM 1',7807.00),('4553',2018,'TERM 1','FORM 1',20268.00),('4553',2018,'TERM 2','FORM 1',12460.00),('4553',2018,'TERM 3','FORM 1',7807.00),('4554',2018,'TERM 1','FORM 1',20268.00),('4554',2018,'TERM 2','FORM 1',12460.00),('4554',2018,'TERM 3','FORM 1',7807.00),('4555',2018,'TERM 1','FORM 1',20268.00),('4555',2018,'TERM 2','FORM 1',12460.00),('4555',2018,'TERM 3','FORM 1',7807.00),('4556',2018,'TERM 1','FORM 1',20268.00),('4556',2018,'TERM 2','FORM 1',12460.00),('4556',2018,'TERM 3','FORM 1',7807.00),('4557',2018,'TERM 1','FORM 1',20268.00),('4557',2018,'TERM 2','FORM 1',12460.00),('4557',2018,'TERM 3','FORM 1',7807.00),('4558',2018,'TERM 1','FORM 1',20268.00),('4558',2018,'TERM 2','FORM 1',12460.00),('4558',2018,'TERM 3','FORM 1',7807.00),('4559',2018,'TERM 1','FORM 1',20268.00),('4559',2018,'TERM 2','FORM 1',12460.00),('4559',2018,'TERM 3','FORM 1',7807.00),('4560',2018,'TERM 1','FORM 1',20268.00),('4560',2018,'TERM 2','FORM 1',12460.00),('4560',2018,'TERM 3','FORM 1',7807.00),('4561',2018,'TERM 1','FORM 1',20268.00),('4561',2018,'TERM 2','FORM 1',12460.00),('4561',2018,'TERM 3','FORM 1',7807.00),('4562',2018,'TERM 1','FORM 1',20268.00),('4562',2018,'TERM 2','FORM 1',12460.00),('4562',2018,'TERM 3','FORM 1',7807.00),('4563',2018,'TERM 1','FORM 1',20268.00),('4563',2018,'TERM 2','FORM 1',12460.00),('4563',2018,'TERM 3','FORM 1',7807.00),('4564',2018,'TERM 1','FORM 1',20268.00),('4564',2018,'TERM 2','FORM 1',12460.00),('4564',2018,'TERM 3','FORM 1',7807.00),('4565',2018,'TERM 1','FORM 1',20268.00),('4565',2018,'TERM 2','FORM 1',12460.00),('4565',2018,'TERM 3','FORM 1',7807.00),('4566',2018,'TERM 1','FORM 1',20268.00),('4566',2018,'TERM 2','FORM 1',12460.00),('4566',2018,'TERM 3','FORM 1',7807.00),('4567',2018,'TERM 1','FORM 1',20268.00),('4567',2018,'TERM 2','FORM 1',12460.00),('4567',2018,'TERM 3','FORM 1',7807.00),('4568',2018,'TERM 1','FORM 1',20268.00),('4568',2018,'TERM 2','FORM 1',12460.00),('4568',2018,'TERM 3','FORM 1',7807.00),('4569',2018,'TERM 1','FORM 1',20268.00),('4569',2018,'TERM 2','FORM 1',12460.00),('4569',2018,'TERM 3','FORM 1',7807.00),('4570',2018,'TERM 1','FORM 1',20268.00),('4570',2018,'TERM 2','FORM 1',12460.00),('4570',2018,'TERM 3','FORM 1',7807.00),('4571',2018,'TERM 1','FORM 1',20268.00),('4571',2018,'TERM 2','FORM 1',12460.00),('4571',2018,'TERM 3','FORM 1',7807.00),('4572',2018,'TERM 1','FORM 1',20268.00),('4572',2018,'TERM 2','FORM 1',12460.00),('4572',2018,'TERM 3','FORM 1',7807.00),('4573',2018,'TERM 1','FORM 1',20268.00),('4573',2018,'TERM 2','FORM 1',12460.00),('4573',2018,'TERM 3','FORM 1',7807.00),('4574',2018,'TERM 1','FORM 1',20268.00),('4574',2018,'TERM 2','FORM 1',12460.00),('4574',2018,'TERM 3','FORM 1',7807.00),('4575',2018,'TERM 1','FORM 1',20268.00),('4575',2018,'TERM 2','FORM 1',12460.00),('4575',2018,'TERM 3','FORM 1',7807.00),('4576',2018,'TERM 1','FORM 1',20268.00),('4576',2018,'TERM 2','FORM 1',12460.00),('4576',2018,'TERM 3','FORM 1',7807.00),('4577',2018,'TERM 1','FORM 1',20268.00),('4577',2018,'TERM 2','FORM 1',12460.00),('4577',2018,'TERM 3','FORM 1',7807.00),('4578',2018,'TERM 1','FORM 1',20268.00),('4578',2018,'TERM 2','FORM 1',12460.00),('4578',2018,'TERM 3','FORM 1',7807.00),('4579',2018,'TERM 1','FORM 1',20268.00),('4579',2018,'TERM 2','FORM 1',12460.00),('4579',2018,'TERM 3','FORM 1',7807.00),('4580',2018,'TERM 1','FORM 1',20268.00),('4580',2018,'TERM 2','FORM 1',12460.00),('4580',2018,'TERM 3','FORM 1',7807.00),('4581',2018,'TERM 1','FORM 1',20268.00),('4581',2018,'TERM 2','FORM 1',12460.00),('4581',2018,'TERM 3','FORM 1',7807.00),('4582',2018,'TERM 1','FORM 1',20268.00),('4582',2018,'TERM 2','FORM 1',12460.00),('4582',2018,'TERM 3','FORM 1',7807.00),('4583',2018,'TERM 1','FORM 1',20268.00),('4583',2018,'TERM 2','FORM 1',12460.00),('4583',2018,'TERM 3','FORM 1',7807.00),('4584',2018,'TERM 1','FORM 1',20268.00),('4584',2018,'TERM 2','FORM 1',12460.00),('4584',2018,'TERM 3','FORM 1',7807.00),('4585',2018,'TERM 1','FORM 1',20268.00),('4585',2018,'TERM 2','FORM 1',12460.00),('4585',2018,'TERM 3','FORM 1',7807.00),('4586',2018,'TERM 1','FORM 1',20268.00),('4586',2018,'TERM 2','FORM 1',12460.00),('4586',2018,'TERM 3','FORM 1',7807.00),('4587',2018,'TERM 1','FORM 1',20268.00),('4587',2018,'TERM 2','FORM 1',12460.00),('4587',2018,'TERM 3','FORM 1',7807.00),('4588',2018,'TERM 1','FORM 1',20268.00),('4588',2018,'TERM 2','FORM 1',12460.00),('4588',2018,'TERM 3','FORM 1',7807.00),('4589',2018,'TERM 1','FORM 1',20268.00),('4589',2018,'TERM 2','FORM 1',12460.00),('4589',2018,'TERM 3','FORM 1',7807.00),('4590',2018,'TERM 1','FORM 1',20268.00),('4590',2018,'TERM 2','FORM 1',12460.00),('4590',2018,'TERM 3','FORM 1',7807.00),('4591',2018,'TERM 1','FORM 1',20268.00),('4591',2018,'TERM 2','FORM 1',12460.00),('4591',2018,'TERM 3','FORM 1',7807.00),('4592',2018,'TERM 1','FORM 1',20268.00),('4592',2018,'TERM 2','FORM 1',12460.00),('4592',2018,'TERM 3','FORM 1',7807.00),('4593',2018,'TERM 1','FORM 1',20268.00),('4593',2018,'TERM 2','FORM 1',12460.00),('4593',2018,'TERM 3','FORM 1',7807.00),('4594',2018,'TERM 1','FORM 1',20268.00),('4594',2018,'TERM 2','FORM 1',12460.00),('4594',2018,'TERM 3','FORM 1',7807.00),('4595',2018,'TERM 1','FORM 1',20268.00),('4595',2018,'TERM 2','FORM 1',12460.00),('4595',2018,'TERM 3','FORM 1',7807.00),('4596',2018,'TERM 1','FORM 1',20268.00),('4596',2018,'TERM 2','FORM 1',12460.00),('4596',2018,'TERM 3','FORM 1',7807.00),('4597',2018,'TERM 1','FORM 1',20268.00),('4597',2018,'TERM 2','FORM 1',12460.00),('4597',2018,'TERM 3','FORM 1',7807.00),('4598',2018,'TERM 1','FORM 1',20268.00),('4598',2018,'TERM 2','FORM 1',12460.00),('4598',2018,'TERM 3','FORM 1',7807.00),('4599',2018,'TERM 1','FORM 1',20268.00),('4599',2018,'TERM 2','FORM 1',12460.00),('4599',2018,'TERM 3','FORM 1',7807.00),('4600',2018,'TERM 1','FORM 1',20268.00),('4600',2018,'TERM 2','FORM 1',12460.00),('4600',2018,'TERM 3','FORM 1',7807.00),('4601',2018,'TERM 1','FORM 1',20268.00),('4601',2018,'TERM 2','FORM 1',12460.00),('4601',2018,'TERM 3','FORM 1',7807.00),('4602',2018,'TERM 1','FORM 1',20268.00),('4602',2018,'TERM 2','FORM 1',12460.00),('4602',2018,'TERM 3','FORM 1',7807.00),('4603',2018,'TERM 1','FORM 1',20268.00),('4603',2018,'TERM 2','FORM 1',12460.00),('4603',2018,'TERM 3','FORM 1',7807.00),('4604',2018,'TERM 1','FORM 1',20268.00),('4604',2018,'TERM 2','FORM 1',12460.00),('4604',2018,'TERM 3','FORM 1',7807.00),('4605',2018,'TERM 1','FORM 1',20268.00),('4605',2018,'TERM 2','FORM 1',12460.00),('4605',2018,'TERM 3','FORM 1',7807.00),('4606',2018,'TERM 1','FORM 1',20268.00),('4606',2018,'TERM 2','FORM 1',12460.00),('4606',2018,'TERM 3','FORM 1',7807.00),('4607',2018,'TERM 1','FORM 1',20268.00),('4607',2018,'TERM 2','FORM 1',12460.00),('4607',2018,'TERM 3','FORM 1',7807.00),('4608',2018,'TERM 1','FORM 1',20268.00),('4608',2018,'TERM 2','FORM 1',12460.00),('4608',2018,'TERM 3','FORM 1',7807.00),('4609',2018,'TERM 1','FORM 1',20268.00),('4609',2018,'TERM 2','FORM 1',12460.00),('4609',2018,'TERM 3','FORM 1',7807.00),('4610',2018,'TERM 1','FORM 1',20268.00),('4610',2018,'TERM 2','FORM 1',12460.00),('4610',2018,'TERM 3','FORM 1',7807.00),('4611',2018,'TERM 1','FORM 1',20268.00),('4611',2018,'TERM 2','FORM 1',12460.00),('4611',2018,'TERM 3','FORM 1',7807.00),('4612',2018,'TERM 1','FORM 1',20268.00),('4612',2018,'TERM 2','FORM 1',12460.00),('4612',2018,'TERM 3','FORM 1',7807.00),('4613',2018,'TERM 1','FORM 1',20268.00),('4613',2018,'TERM 2','FORM 1',12460.00),('4613',2018,'TERM 3','FORM 1',7807.00),('4614',2018,'TERM 1','FORM 1',20268.00),('4614',2018,'TERM 2','FORM 1',12460.00),('4614',2018,'TERM 3','FORM 1',7807.00),('4615',2018,'TERM 1','FORM 1',20268.00),('4615',2018,'TERM 2','FORM 1',12460.00),('4615',2018,'TERM 3','FORM 1',7807.00),('4616',2018,'TERM 1','FORM 1',20268.00),('4616',2018,'TERM 2','FORM 1',12460.00),('4616',2018,'TERM 3','FORM 1',7807.00),('4617',2018,'TERM 1','FORM 1',20268.00),('4617',2018,'TERM 2','FORM 1',12460.00),('4617',2018,'TERM 3','FORM 1',7807.00),('4618',2018,'TERM 1','FORM 1',20268.00),('4618',2018,'TERM 2','FORM 1',12460.00),('4618',2018,'TERM 3','FORM 1',7807.00),('4619',2018,'TERM 1','FORM 1',20268.00),('4619',2018,'TERM 2','FORM 1',12460.00),('4619',2018,'TERM 3','FORM 1',7807.00),('4620',2018,'TERM 1','FORM 1',20268.00),('4620',2018,'TERM 2','FORM 1',12460.00),('4620',2018,'TERM 3','FORM 1',7807.00),('4621',2018,'TERM 1','FORM 1',20268.00),('4621',2018,'TERM 2','FORM 1',12460.00),('4621',2018,'TERM 3','FORM 1',7807.00),('4622',2018,'TERM 1','FORM 3',20268.00),('4622',2018,'TERM 2','FORM 3',12460.00),('4622',2018,'TERM 3','FORM 3',7807.00),('4623',2018,'TERM 1','FORM 1',20268.00),('4623',2018,'TERM 2','FORM 1',12460.00),('4623',2018,'TERM 3','FORM 1',7807.00),('4624',2018,'TERM 1','FORM 1',20268.00),('4624',2018,'TERM 2','FORM 1',12460.00),('4624',2018,'TERM 3','FORM 1',7807.00),('4625',2018,'TERM 1','FORM 1',20268.00),('4625',2018,'TERM 2','FORM 1',12460.00),('4625',2018,'TERM 3','FORM 1',7807.00),('4626',2018,'TERM 1','FORM 1',20268.00),('4626',2018,'TERM 2','FORM 1',12460.00),('4626',2018,'TERM 3','FORM 1',7807.00),('4627',2018,'TERM 1','FORM 1',20268.00),('4627',2018,'TERM 2','FORM 1',12460.00),('4627',2018,'TERM 3','FORM 1',7807.00),('4628',2018,'TERM 1','FORM 1',20268.00),('4628',2018,'TERM 2','FORM 1',12460.00),('4628',2018,'TERM 3','FORM 1',7807.00),('4629',2018,'TERM 1','FORM 4',20268.00),('4629',2018,'TERM 2','FORM 4',12460.00),('4629',2018,'TERM 3','FORM 4',7807.00),('4630',2018,'TERM 1','FORM 1',20268.00),('4630',2018,'TERM 2','FORM 1',12460.00),('4630',2018,'TERM 3','FORM 1',7807.00),('4631',2018,'TERM 1','FORM 1',20268.00),('4631',2018,'TERM 2','FORM 1',12460.00),('4631',2018,'TERM 3','FORM 1',7807.00),('4632',2018,'TERM 1','FORM 1',20268.00),('4632',2018,'TERM 2','FORM 1',12460.00),('4632',2018,'TERM 3','FORM 1',7807.00),('4633',2018,'TERM 1','FORM 1',20268.00),('4633',2018,'TERM 2','FORM 1',12460.00),('4633',2018,'TERM 3','FORM 1',7807.00),('4634',2018,'TERM 1','FORM 4',20268.00),('4634',2018,'TERM 2','FORM 4',12460.00),('4634',2018,'TERM 3','FORM 4',7807.00),('4635',2018,'TERM 1','FORM 1',20268.00),('4635',2018,'TERM 2','FORM 1',12460.00),('4635',2018,'TERM 3','FORM 1',7807.00),('4636',2018,'TERM 1','FORM 1',20268.00),('4636',2018,'TERM 2','FORM 1',12460.00),('4636',2018,'TERM 3','FORM 1',7807.00),('4637',2018,'TERM 1','FORM 1',20268.00),('4637',2018,'TERM 2','FORM 1',12460.00),('4637',2018,'TERM 3','FORM 1',7807.00),('4638',2018,'TERM 1','FORM 1',20268.00),('4638',2018,'TERM 2','FORM 1',12460.00),('4638',2018,'TERM 3','FORM 1',7807.00),('4639',2018,'TERM 1','FORM 1',20268.00),('4639',2018,'TERM 2','FORM 1',12460.00),('4639',2018,'TERM 3','FORM 1',7807.00),('4641',2018,'TERM 1','FORM 1',20268.00),('4641',2018,'TERM 2','FORM 1',12460.00),('4641',2018,'TERM 3','FORM 1',7807.00),('4642',2018,'TERM 1','FORM 1',20268.00),('4642',2018,'TERM 2','FORM 1',12460.00),('4642',2018,'TERM 3','FORM 1',7807.00),('4643',2018,'TERM 1','FORM 1',20268.00),('4643',2018,'TERM 2','FORM 1',12460.00),('4643',2018,'TERM 3','FORM 1',7807.00),('4644',2018,'TERM 1','FORM 1',20268.00),('4644',2018,'TERM 2','FORM 1',12460.00),('4644',2018,'TERM 3','FORM 1',7807.00),('4645',2018,'TERM 1','FORM 1',20268.00),('4645',2018,'TERM 2','FORM 1',12460.00),('4645',2018,'TERM 3','FORM 1',7807.00),('4648',2018,'TERM 1','FORM 1',20268.00),('4648',2018,'TERM 2','FORM 1',12460.00),('4648',2018,'TERM 3','FORM 1',7807.00),('4649',2018,'TERM 1','FORM 2',20268.00),('4649',2018,'TERM 2','FORM 2',12460.00),('4649',2018,'TERM 3','FORM 2',7807.00);
UNLOCK TABLES;
/*!40000 ALTER TABLE `finance_student_invoices` ENABLE KEYS */;

--
-- Table structure for table `finance_tuitionvoteheads`
--

DROP TABLE IF EXISTS `finance_tuitionvoteheads`;
CREATE TABLE `finance_tuitionvoteheads` (
  `fiscal_year` int(4) NOT NULL default '0',
  `term` varchar(100) NOT NULL default '',
  `votehead` varchar(100) NOT NULL default '',
  `code` varchar(100) NOT NULL default '',
  PRIMARY KEY  (`fiscal_year`,`term`,`votehead`,`code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `finance_tuitionvoteheads`
--


/*!40000 ALTER TABLE `finance_tuitionvoteheads` DISABLE KEYS */;
LOCK TABLES `finance_tuitionvoteheads` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `finance_tuitionvoteheads` ENABLE KEYS */;

--
-- Table structure for table `finance_voteheads`
--

DROP TABLE IF EXISTS `finance_voteheads`;
CREATE TABLE `finance_voteheads` (
  `fiscal_year` int(4) NOT NULL,
  `term` varchar(100) NOT NULL,
  `votehead` varchar(100) NOT NULL,
  `code` varchar(100) NOT NULL,
  PRIMARY KEY  (`fiscal_year`,`term`,`votehead`,`code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `finance_voteheads`
--


/*!40000 ALTER TABLE `finance_voteheads` DISABLE KEYS */;
LOCK TABLES `finance_voteheads` WRITE;
INSERT INTO `finance_voteheads` VALUES (2018,'TERM 1','ACTIVITY','6'),(2018,'TERM 1','ADMIN_COST','4'),(2018,'TERM 1','BES','1'),(2018,'TERM 1','CAUTION','8'),(2018,'TERM 1','EWC','5'),(2018,'TERM 1','LT&T','3'),(2018,'TERM 1','PE','7'),(2018,'TERM 1','RMI','2'),(2018,'TERM 2','ACTIVITY','6'),(2018,'TERM 2','ADMIN_COST','4'),(2018,'TERM 2','BES','1'),(2018,'TERM 2','EWC','5'),(2018,'TERM 2','LT&T','3'),(2018,'TERM 2','PE','7'),(2018,'TERM 2','RMI','2'),(2018,'TERM 3','ACTIVITY','6'),(2018,'TERM 3','ADMIN_COST','4'),(2018,'TERM 3','BES','1'),(2018,'TERM 3','EWC','5'),(2018,'TERM 3','LT&T','3'),(2018,'TERM 3','PE','7'),(2018,'TERM 3','RMI','2');
UNLOCK TABLES;
/*!40000 ALTER TABLE `finance_voteheads` ENABLE KEYS */;

--
-- Table structure for table `img`
--

DROP TABLE IF EXISTS `img`;
CREATE TABLE `img` (
  `id` int(10) NOT NULL,
  `image` varchar(100) NOT NULL,
  `pass` varchar(10) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `img`
--


/*!40000 ALTER TABLE `img` DISABLE KEYS */;
LOCK TABLES `img` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `img` ENABLE KEYS */;

--
-- Table structure for table `initials`
--

DROP TABLE IF EXISTS `initials`;
CREATE TABLE `initials` (
  `fullname` varchar(100) NOT NULL,
  `form` varchar(100) NOT NULL,
  `stream` varchar(100) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `initials` varchar(100) NOT NULL,
  PRIMARY KEY  (`fullname`,`form`,`stream`,`subject`,`initials`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `initials`
--


/*!40000 ALTER TABLE `initials` DISABLE KEYS */;
LOCK TABLES `initials` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `initials` ENABLE KEYS */;

--
-- Table structure for table `issued_books`
--

DROP TABLE IF EXISTS `issued_books`;
CREATE TABLE `issued_books` (
  `bookid` int(100) NOT NULL,
  `bookno` varchar(100) NOT NULL,
  `userid` varchar(100) NOT NULL,
  `dateissued` varchar(100) NOT NULL,
  `datedue` varchar(100) NOT NULL,
  `issuer` varchar(100) NOT NULL,
  `comments` text NOT NULL,
  PRIMARY KEY  (`bookid`,`bookno`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `issued_books`
--


/*!40000 ALTER TABLE `issued_books` DISABLE KEYS */;
LOCK TABLES `issued_books` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `issued_books` ENABLE KEYS */;

--
-- Table structure for table `kcse_final_analysis`
--

DROP TABLE IF EXISTS `kcse_final_analysis`;
CREATE TABLE `kcse_final_analysis` (
  `adm` int(10) NOT NULL,
  `indexnumber` int(10) NOT NULL,
  `names` varchar(40) NOT NULL,
  `english` varchar(10) NOT NULL,
  `kiswahili` varchar(10) NOT NULL,
  `mathematics` varchar(10) NOT NULL,
  `biology` varchar(10) NOT NULL,
  `chemistry` varchar(10) NOT NULL,
  `physics` varchar(10) NOT NULL,
  `history` varchar(10) NOT NULL,
  `geography` varchar(10) NOT NULL,
  `cre` varchar(10) NOT NULL,
  `agriculture` varchar(10) NOT NULL,
  `businesStudies` varchar(10) NOT NULL,
  `points` varchar(10) NOT NULL,
  `tgrade` varchar(10) NOT NULL,
  `averagepoints` double NOT NULL,
  `year_finished` int(100) NOT NULL,
  PRIMARY KEY  (`adm`,`year_finished`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kcse_final_analysis`
--


/*!40000 ALTER TABLE `kcse_final_analysis` DISABLE KEYS */;
LOCK TABLES `kcse_final_analysis` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `kcse_final_analysis` ENABLE KEYS */;

--
-- Table structure for table `kcseanalysis`
--

DROP TABLE IF EXISTS `kcseanalysis`;
CREATE TABLE `kcseanalysis` (
  `admno` int(100) NOT NULL,
  `index_numbers` int(100) NOT NULL,
  `year_finished` int(100) NOT NULL,
  PRIMARY KEY  (`admno`,`index_numbers`,`year_finished`),
  KEY `admon` (`admno`,`year_finished`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kcseanalysis`
--


/*!40000 ALTER TABLE `kcseanalysis` DISABLE KEYS */;
LOCK TABLES `kcseanalysis` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `kcseanalysis` ENABLE KEYS */;

--
-- Table structure for table `kcsemarks`
--

DROP TABLE IF EXISTS `kcsemarks`;
CREATE TABLE `kcsemarks` (
  `index_numbers` int(10) NOT NULL,
  `english` varchar(100) NOT NULL,
  `kiswahili` varchar(100) NOT NULL,
  `math` varchar(100) NOT NULL,
  `biology` varchar(100) NOT NULL,
  `chemistry` varchar(100) NOT NULL,
  `physics` varchar(100) NOT NULL,
  `history` varchar(100) NOT NULL,
  `geography` varchar(100) NOT NULL,
  `cre` varchar(100) NOT NULL,
  `agriculture` varchar(100) NOT NULL,
  `bstudies` varchar(100) NOT NULL,
  `total_points` int(100) NOT NULL,
  `mean_grade` varchar(100) NOT NULL,
  `year_finished` int(5) NOT NULL,
  PRIMARY KEY  (`index_numbers`,`year_finished`),
  KEY `admon` (`year_finished`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kcsemarks`
--


/*!40000 ALTER TABLE `kcsemarks` DISABLE KEYS */;
LOCK TABLES `kcsemarks` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `kcsemarks` ENABLE KEYS */;

--
-- Table structure for table `lib_lost_books`
--

DROP TABLE IF EXISTS `lib_lost_books`;
CREATE TABLE `lib_lost_books` (
  `bookid` int(100) NOT NULL,
  `bookno` varchar(100) NOT NULL,
  `userid` varchar(100) NOT NULL,
  `date_ref` varchar(100) NOT NULL,
  `issuer_ref` varchar(100) NOT NULL,
  `comments` text NOT NULL,
  PRIMARY KEY  (`bookid`,`bookno`,`userid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lib_lost_books`
--


/*!40000 ALTER TABLE `lib_lost_books` DISABLE KEYS */;
LOCK TABLES `lib_lost_books` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `lib_lost_books` ENABLE KEYS */;

--
-- Table structure for table `markscats`
--

DROP TABLE IF EXISTS `markscats`;
CREATE TABLE `markscats` (
  `admno` int(10) NOT NULL,
  `english` int(10) NOT NULL,
  `kiswahili` int(10) NOT NULL,
  `math` int(10) NOT NULL,
  `biology` int(10) NOT NULL,
  `chemistry` int(10) NOT NULL,
  `physics` int(10) NOT NULL,
  `history` int(10) NOT NULL,
  `geography` int(10) NOT NULL,
  `cre` int(10) NOT NULL,
  `agriculture` int(10) NOT NULL,
  `bstudies` int(10) NOT NULL,
  `french` int(10) NOT NULL,
  `computer` int(10) NOT NULL,
  `home` int(10) NOT NULL,
  `year` int(5) NOT NULL,
  `term` int(5) NOT NULL,
  `form` int(5) NOT NULL,
  `cat` int(5) NOT NULL,
  PRIMARY KEY  (`admno`,`year`,`term`,`form`,`cat`),
  KEY `admon` (`admno`,`year`,`term`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `markscats`
--


/*!40000 ALTER TABLE `markscats` DISABLE KEYS */;
LOCK TABLES `markscats` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `markscats` ENABLE KEYS */;

--
-- Table structure for table `marksemams`
--

DROP TABLE IF EXISTS `marksemams`;
CREATE TABLE `marksemams` (
  `admno` int(10) NOT NULL,
  `english` int(10) NOT NULL,
  `kiswahili` int(10) NOT NULL,
  `math` int(10) NOT NULL,
  `biology` int(10) NOT NULL,
  `chemistry` int(10) NOT NULL,
  `physics` int(10) NOT NULL,
  `history` int(10) NOT NULL,
  `geography` int(10) NOT NULL,
  `cre` int(10) NOT NULL,
  `agriculture` int(10) NOT NULL,
  `bstudies` int(10) NOT NULL,
  `french` int(10) NOT NULL,
  `computer` int(10) NOT NULL,
  `home` int(10) NOT NULL,
  `year` int(5) NOT NULL,
  `term` int(3) NOT NULL,
  `form` int(2) NOT NULL,
  PRIMARY KEY  (`admno`,`year`,`term`,`form`),
  KEY `admon` (`admno`,`year`,`term`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `marksemams`
--


/*!40000 ALTER TABLE `marksemams` DISABLE KEYS */;
LOCK TABLES `marksemams` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `marksemams` ENABLE KEYS */;

--
-- Table structure for table `messages_settings`
--

DROP TABLE IF EXISTS `messages_settings`;
CREATE TABLE `messages_settings` (
  `api_url` varchar(255) NOT NULL,
  `ekey` varchar(255) NOT NULL,
  `senderid` varchar(255) NOT NULL,
  `passwrd` varchar(255) NOT NULL,
  `notify1` int(15) default NULL,
  `notify2` int(15) default NULL,
  PRIMARY KEY  (`api_url`,`ekey`,`senderid`,`passwrd`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `messages_settings`
--


/*!40000 ALTER TABLE `messages_settings` DISABLE KEYS */;
LOCK TABLES `messages_settings` WRITE;
INSERT INTO `messages_settings` VALUES ('http://api.sms.bambika.co.ke:8555/?','-','-','-',0,0);
UNLOCK TABLES;
/*!40000 ALTER TABLE `messages_settings` ENABLE KEYS */;

--
-- Table structure for table `mockexams`
--

DROP TABLE IF EXISTS `mockexams`;
CREATE TABLE `mockexams` (
  `admno` int(10) NOT NULL,
  `english1` int(10) NOT NULL,
  `english2` int(10) NOT NULL,
  `english3` int(10) NOT NULL,
  `kiswahili1` int(10) NOT NULL,
  `kiswahili2` int(10) NOT NULL,
  `kiswahili3` int(10) NOT NULL,
  `math1` int(10) NOT NULL,
  `math2` int(10) NOT NULL,
  `math3` int(10) NOT NULL,
  `biology1` int(10) NOT NULL,
  `biology2` int(10) NOT NULL,
  `biology3` int(10) NOT NULL,
  `chemistry1` int(10) NOT NULL,
  `chemistry2` int(10) NOT NULL,
  `chemistry3` int(10) NOT NULL,
  `physics1` int(10) NOT NULL,
  `physics2` int(10) NOT NULL,
  `physics3` int(10) NOT NULL,
  `history1` int(10) NOT NULL,
  `history2` int(10) NOT NULL,
  `history3` int(10) NOT NULL,
  `geography1` int(10) NOT NULL,
  `geography2` int(10) NOT NULL,
  `geography3` int(10) NOT NULL,
  `cre1` int(10) NOT NULL,
  `cre2` int(10) NOT NULL,
  `cre3` int(10) NOT NULL,
  `agriculture1` int(10) NOT NULL,
  `agriculture2` int(10) NOT NULL,
  `agriculture3` int(10) NOT NULL,
  `bstudies1` int(10) NOT NULL,
  `bstudies2` int(10) NOT NULL,
  `bstudies3` int(10) NOT NULL,
  `french1` int(10) NOT NULL,
  `french2` int(10) NOT NULL,
  `french3` int(10) NOT NULL,
  `computer1` int(10) NOT NULL,
  `computer2` int(10) NOT NULL,
  `computer3` int(10) NOT NULL,
  `home1` int(10) NOT NULL,
  `home2` int(10) NOT NULL,
  `home3` int(10) NOT NULL,
  `year` int(5) NOT NULL,
  `term` int(3) NOT NULL,
  `form` int(2) NOT NULL,
  `stream` varchar(100) NOT NULL,
  PRIMARY KEY  (`admno`,`year`,`term`,`form`),
  KEY `admon` (`admno`,`year`,`term`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mockexams`
--


/*!40000 ALTER TABLE `mockexams` DISABLE KEYS */;
LOCK TABLES `mockexams` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `mockexams` ENABLE KEYS */;

--
-- Table structure for table `mockpositions`
--

DROP TABLE IF EXISTS `mockpositions`;
CREATE TABLE `mockpositions` (
  `admno` int(10) NOT NULL,
  `english` int(10) NOT NULL,
  `kiswahili` int(10) NOT NULL,
  `math` int(10) NOT NULL,
  `biology` int(10) NOT NULL,
  `chemistry` int(10) NOT NULL,
  `physics` int(10) NOT NULL,
  `history` int(10) NOT NULL,
  `geography` int(10) NOT NULL,
  `cre` int(10) NOT NULL,
  `agriculture` int(10) NOT NULL,
  `bstudies` int(10) NOT NULL,
  `french` int(10) NOT NULL,
  `computer` int(10) NOT NULL,
  `home` int(10) NOT NULL,
  `year` int(5) NOT NULL,
  `term` int(3) NOT NULL,
  `form` int(2) NOT NULL,
  `position` int(10) NOT NULL,
  `kcpe` int(10) NOT NULL,
  `positionclass` int(10) NOT NULL,
  `stream` varchar(10) NOT NULL,
  PRIMARY KEY  (`admno`,`year`,`term`,`form`),
  KEY `admon` (`admno`,`year`,`term`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mockpositions`
--


/*!40000 ALTER TABLE `mockpositions` DISABLE KEYS */;
LOCK TABLES `mockpositions` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `mockpositions` ENABLE KEYS */;

--
-- Table structure for table `mocks`
--

DROP TABLE IF EXISTS `mocks`;
CREATE TABLE `mocks` (
  `subject` varchar(100) NOT NULL,
  `p1` int(20) NOT NULL,
  `p2` int(20) NOT NULL,
  `p3` int(20) NOT NULL,
  `total` int(20) NOT NULL,
  `form` int(3) NOT NULL,
  `term` int(3) NOT NULL,
  `year` int(10) NOT NULL,
  `states` varchar(100) NOT NULL,
  PRIMARY KEY  (`subject`,`form`,`term`,`year`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mocks`
--


/*!40000 ALTER TABLE `mocks` DISABLE KEYS */;
LOCK TABLES `mocks` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `mocks` ENABLE KEYS */;

--
-- Table structure for table `numbers`
--

DROP TABLE IF EXISTS `numbers`;
CREATE TABLE `numbers` (
  `parentname` varchar(100) NOT NULL default '',
  `id` varchar(100) NOT NULL default '',
  `tele` int(15) NOT NULL,
  `admno` int(10) NOT NULL,
  PRIMARY KEY  (`admno`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `numbers`
--


/*!40000 ALTER TABLE `numbers` DISABLE KEYS */;
LOCK TABLES `numbers` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `numbers` ENABLE KEYS */;

--
-- Table structure for table `othercashexpenses`
--

DROP TABLE IF EXISTS `othercashexpenses`;
CREATE TABLE `othercashexpenses` (
  `no` int(100) NOT NULL,
  `payof` varchar(100) NOT NULL,
  `dateofpay` varchar(20) NOT NULL,
  `amount` double NOT NULL,
  `votehead` varchar(100) NOT NULL,
  `year` varchar(100) NOT NULL,
  `payee` varchar(100) NOT NULL,
  PRIMARY KEY  (`no`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `othercashexpenses`
--


/*!40000 ALTER TABLE `othercashexpenses` DISABLE KEYS */;
LOCK TABLES `othercashexpenses` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `othercashexpenses` ENABLE KEYS */;

--
-- Table structure for table `parentdetails`
--

DROP TABLE IF EXISTS `parentdetails`;
CREATE TABLE `parentdetails` (
  `no` int(100) NOT NULL auto_increment,
  `admno` int(100) NOT NULL,
  `fname` varchar(20) NOT NULL,
  `lname` varchar(20) NOT NULL,
  `sname` varchar(20) NOT NULL,
  `idpass` varchar(20) NOT NULL,
  `address` varchar(20) NOT NULL,
  `telephone` int(100) NOT NULL,
  PRIMARY KEY  (`no`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `parentdetails`
--


/*!40000 ALTER TABLE `parentdetails` DISABLE KEYS */;
LOCK TABLES `parentdetails` WRITE;
INSERT INTO `parentdetails` VALUES (1,4509,'','','','','',0),(2,4512,'','','','','',0),(3,4514,'','','','','',0),(4,4517,'','','','','',0),(5,4519,'','','','','',0),(6,4521,'','','','','',0),(7,4526,'','','','','',0),(8,4532,'','','','','',0),(9,4535,'','','','','',0),(10,4538,'','','','','',0),(11,4546,'','','','','',0),(12,4547,'','','','','',0),(13,4552,'','','','','',0),(14,4553,'','','','','',0),(15,4555,'','','','','',0),(16,4557,'','','','','',0),(17,4558,'','','','','',0),(18,4561,'','','','','',0),(19,4564,'','','','','',0),(20,4567,'','','','','',0),(21,4572,'','','','','',0),(22,4573,'','','','','',0),(23,4574,'','','','','',0),(24,4577,'','','','','',0),(25,4581,'','','','','',0),(26,4583,'','','','','',0),(27,4584,'','','','','',0),(28,4593,'','','','','',0),(29,4594,'','','','','',0),(30,4596,'','','','','',0),(31,4599,'','','','','',0),(32,4600,'','','','','',0),(33,4606,'','','','','',0),(34,4609,'','','','','',0),(35,4611,'','','','','',0),(36,4615,'','','','','',0),(37,4617,'','','','','',0),(38,4619,'','','','','',0),(39,4621,'','','','','',0),(40,4635,'','','','','',0),(41,4641,'','','','','',0),(42,4642,'','','','','',0),(43,4645,'','','','','',0),(44,4648,'','','','','',0),(45,4510,'','','','','',0),(46,4515,'','','','','',0),(47,4518,'','','','','',0),(48,4522,'','','','','',0),(49,4523,'','','','','',0),(50,4524,'','','','','',0),(51,4527,'','','','','',0),(52,4529,'','','','','',0),(53,4530,'','','','','',0),(54,4534,'','','','','',0),(55,4536,'','','','','',0),(56,4539,'','','','','',0),(57,4542,'','','','','',0),(58,4544,'','','','','',0),(59,4548,'','','','','',0),(60,4550,'','','','','',0),(61,4556,'','','','','',0),(62,4559,'','','','','',0),(63,4562,'','','','','',0),(64,4565,'','','','','',0),(65,4568,'','','','','',0),(66,4569,'','','','','',0),(67,4575,'','','','','',0),(68,4578,'','','','','',0),(69,4580,'','','','','',0),(70,4585,'','','','','',0),(71,4586,'','','','','',0),(72,4588,'','','','','',0),(73,4589,'','','','','',0),(74,4591,'','','','','',0),(75,4597,'','','','','',0),(76,4602,'','','','','',0),(77,4604,'','','','','',0),(78,4607,'','','','','',0),(79,4610,'','','','','',0),(80,4614,'','','','','',0),(81,4618,'','','','','',0),(82,4620,'','','','','',0),(83,4623,'','','','','',0),(84,4624,'','','','','',0),(85,4626,'','','','','',0),(86,4628,'','','','','',0),(87,4631,'','','','','',0),(88,4633,'','','','','',0),(89,4637,'','','','','',0),(90,4511,'','','','','',0),(91,4513,'','','','','',0),(92,4516,'','','','','',0),(93,4520,'','','','','',0),(94,4525,'','','','','',0),(95,4528,'','','','','',0),(96,4531,'','','','','',0),(97,4533,'','','','','',0),(98,4537,'','','','','',0),(99,4540,'','','','','',0),(100,4541,'','','','','',0),(101,4543,'','','','','',0),(102,4545,'','','','','',0),(103,4549,'','','','','',0),(104,4551,'','','','','',0),(105,4554,'','','','','',0),(106,4560,'','','','','',0),(107,4563,'','','','','',0),(108,4566,'','','','','',0),(109,4570,'','','','','',0),(110,4571,'','','','','',0),(111,4576,'','','','','',0),(112,4579,'','','','','',0),(113,4582,'','','','','',0),(114,4587,'','','','','',0),(115,4590,'','','','','',0),(116,4592,'','','','','',0),(117,4595,'','','','','',0),(118,4598,'','','','','',0),(119,4601,'','','','','',0),(120,4603,'','','','','',0),(121,4605,'','','','','',0),(122,4608,'','','','','',0),(123,4612,'','','','','',0),(124,4613,'','','','','',0),(125,4616,'','','','','',0),(126,4625,'','','','','',0),(127,4627,'','','','','',0),(128,4630,'','','','','',0),(129,4632,'','','','','',0),(130,4636,'','','','','',0),(131,4638,'','','','','',0),(132,4639,'','','','','',0),(133,4643,'','','','','',0),(134,4644,'','','','','',0),(135,4378,'','','','','',0),(136,4382,'','','','','',0),(137,4383,'','','','','',0),(138,4385,'','','','','',0),(139,4386,'','','','','',0),(140,4388,'','','','','',0),(141,4389,'','','','','',0),(142,4390,'','','','','',0),(143,4392,'','','','','',0),(144,4394,'','','','','',0),(145,4395,'','','','','',0),(146,4397,'','','','','',0),(147,4399,'','','','','',0),(148,4401,'','','','','',0),(149,4405,'','','','','',0),(150,4407,'','','','','',0),(151,4409,'','','','','',0),(152,4411,'','','','','',0),(153,4415,'','','','','',0),(154,4416,'','','','','',0),(155,4425,'','','','','',0),(156,4427,'','','','','',0),(157,4428,'','','','','',0),(158,4431,'','','','','',0),(159,4433,'','','','','',0),(160,4436,'','','','','',0),(161,4439,'','','','','',0),(162,4440,'','','','','',0),(163,4442,'','','','','',0),(164,4448,'','','','','',0),(165,4451,'','','','','',0),(166,4452,'','','','','',0),(167,4454,'','','','','',0),(168,4456,'','','','','',0),(169,4458,'','','','','',0),(170,4459,'','','','','',0),(171,4463,'','','','','',0),(172,4469,'','','','','',0),(173,4471,'','','','','',0),(174,4472,'','','','','',0),(175,4475,'','','','','',0),(176,4380,'','','','','',0),(177,4381,'','','','','',0),(178,4384,'','','','','',0),(179,4387,'','','','','',0),(180,4400,'','','','','',0),(181,4402,'','','','','',0),(182,4403,'','','','','',0),(183,4404,'','','','','',0),(184,4410,'','','','','',0),(185,4412,'','','','','',0),(186,4413,'','','','','',0),(187,4414,'','','','','',0),(188,4417,'','','','','',0),(189,4421,'','','','','',0),(190,4426,'','','','','',0),(191,4429,'','','','','',0),(192,4430,'','','','','',0),(193,4434,'','','','','',0),(194,4435,'','','','','',0),(195,4438,'','','','','',0),(196,4443,'','','','','',0),(197,4444,'','','','','',0),(198,4447,'','','','','',0),(199,4449,'','','','','',0),(200,4450,'','','','','',0),(201,4455,'','','','','',0),(202,4457,'','','','','',0),(203,4461,'','','','','',0),(204,4464,'','','','','',0),(205,4468,'','','','','',0),(206,4473,'','','','','',0),(207,4476,'','','','','',0),(208,4477,'','','','','',0),(209,4478,'','','','','',0),(210,4479,'','','','','',0),(211,4480,'','','','','',0),(212,4482,'','','','','',0),(213,4483,'','','','','',0),(214,4484,'','','','','',0),(215,4485,'','','','','',0),(216,4379,'','','','','',0),(217,4391,'','','','','',0),(218,4396,'','','','','',0),(219,4398,'','','','','',0),(220,4406,'','','','','',0),(221,4408,'','','','','',0),(222,4418,'','','','','',0),(223,4420,'','','','','',0),(224,4422,'','','','','',0),(225,4423,'','','','','',0),(226,4424,'','','','','',0),(227,4441,'','','','','',0),(228,4446,'','','','','',0),(229,4453,'','','','','',0),(230,4460,'','','','','',0),(231,4465,'','','','','',0),(232,4466,'','','','','',0),(233,4467,'','','','','',0),(234,4470,'','','','','',0),(235,4486,'','','','','',0),(236,4487,'','','','','',0),(237,4488,'','','','','',0),(238,4489,'','','','','',0),(239,4490,'','','','','',0),(240,4491,'','','','','',0),(241,4492,'','','','','',0),(242,4493,'','','','','',0),(243,4494,'','','','','',0),(244,4495,'','','','','',0),(245,4497,'','','','','',0),(246,4498,'','','','','',0),(247,4499,'','','','','',0),(248,4500,'','','','','',0),(249,4501,'','','','','',0),(250,4503,'','','','','',0),(251,4504,'','','','','',0),(252,4505,'','','','','',0),(253,4506,'','','','','',0),(254,4508,'','','','','',0),(255,4649,'','','','','',0),(256,4264,'','','','','',0),(257,4269,'','','','','',0),(258,4271,'','','','','',0),(260,4278,'','','','','',0),(261,4280,'','','','','',0),(262,4284,'','','','','',0),(263,4285,'','','','','',0),(264,4287,'','','','','',0),(265,4292,'','','','','',0),(266,4293,'','','','','',0),(267,4294,'','','','','',0),(268,4295,'','','','','',0),(269,4296,'','','','','',0),(270,4297,'','','','','',0),(271,4298,'','','','','',0),(272,4304,'','','','','',0),(273,4309,'','','','','',0),(274,4311,'','','','','',0),(275,4315,'','','','','',0),(276,4317,'','','','','',0),(277,4321,'','','','','',0),(278,4322,'','','','','',0),(279,4323,'','','','','',0),(280,4326,'','','','','',0),(281,4328,'','','','','',0),(282,4329,'','','','','',0),(283,4332,'','','','','',0),(284,4333,'','','','','',0),(285,4334,'','','','','',0),(286,4337,'','','','','',0),(287,4338,'','','','','',0),(288,4342,'','','','','',0),(289,4343,'','','','','',0),(290,4345,'','','','','',0),(291,4347,'','','','','',0),(292,4351,'','','','','',0),(293,4353,'','','','','',0),(294,4359,'','','','','',0),(295,4362,'','','','','',0),(296,4363,'','','','','',0),(297,4368,'','','','','',0),(298,4375,'','','','','',0),(299,4377,'','','','','',0),(300,4622,'','','','','',0),(302,4267,'','','','','',0),(303,4272,'','','','','',0),(304,4274,'','','','','',0),(305,4275,'','','','','',0),(306,4276,'','','','','',0),(307,4277,'','','','','',0),(308,4281,'','','','','',0),(309,4282,'','','','','',0),(310,4283,'','','','','',0),(311,4286,'','','','','',0),(312,4288,'','','','','',0),(313,4289,'','','','','',0),(314,4290,'','','','','',0),(315,4299,'','','','','',0),(316,4300,'','','','','',0),(317,4301,'','','','','',0),(318,4302,'','','','','',0),(319,4303,'','','','','',0),(320,4306,'','','','','',0),(321,4312,'','','','','',0),(322,4313,'','','','','',0),(323,4314,'','','','','',0),(324,4318,'','','','','',0),(325,4319,'','','','','',0),(326,4320,'','','','','',0),(327,4324,'','','','','',0),(328,4327,'','','','','',0),(329,4330,'','','','','',0),(330,4335,'','','','','',0),(331,4336,'','','','','',0),(332,4339,'','','','','',0),(333,4340,'','','','','',0),(334,4341,'','','','','',0),(335,4346,'','','','','',0),(336,4348,'','','','','',0),(337,4352,'','','','','',0),(338,4356,'','','','','',0),(339,4358,'','','','','',0),(340,4360,'','','','','',0),(341,4361,'','','','','',0),(342,4365,'','','','','',0),(343,4366,'','','','','',0),(344,4370,'','','','','',0),(345,4374,'','','','','',0),(346,4141,'','','','','',0),(347,4142,'','','','','',0),(348,4143,'','','','','',0),(349,4144,'','','','','',0),(350,4146,'','','','','',0),(351,4148,'','','','','',0),(352,4154,'','','','','',0),(353,4158,'','','','','',0),(354,4160,'','','','','',0),(355,4162,'','','','','',0),(356,4164,'','','','','',0),(357,4167,'','','','','',0),(358,4171,'','','','','',0),(359,4173,'','','','','',0),(360,4179,'','','','','',0),(361,4182,'','','','','',0),(362,4187,'','','','','',0),(363,4188,'','','','','',0),(364,4193,'','','','','',0),(365,4195,'','','','','',0),(366,4203,'','','','','',0),(368,4208,'','','','','',0),(369,4209,'','','','','',0),(370,4212,'','','','','',0),(371,4216,'','','','','',0),(372,4228,'','','','','',0),(373,4229,'','','','','',0),(374,4231,'','','','','',0),(375,4237,'','','','','',0),(376,4241,'','','','','',0),(377,4252,'','','','','',0),(378,4255,'','','','','',0),(379,4258,'','','','','',0),(380,4259,'','','','','',0),(381,4262,'','','','','',0),(382,4372,'','','','','',0),(383,4371,'','','','','',0),(384,4634,'','','','','',0),(386,4134,'','','','','',0),(387,4139,'','','','','',0),(388,4140,'','','','','',0),(389,4149,'','','','','',0),(390,4152,'','','','','',0),(391,4155,'','','','','',0),(392,4157,'','','','','',0),(393,4159,'','','','','',0),(394,4172,'','','','','',0),(395,4175,'','','','','',0),(396,4176,'','','','','',0),(397,4180,'','','','','',0),(398,4183,'','','','','',0),(399,4186,'','','','','',0),(400,4190,'','','','','',0),(401,4194,'','','','','',0),(402,4199,'','','','','',0),(403,4200,'','','','','',0),(404,4202,'','','','','',0),(405,4204,'','','','','',0),(406,4207,'','','','','',0),(407,4210,'','','','','',0),(408,4213,'','','','','',0),(409,4218,'','','','','',0),(410,4221,'','','','','',0),(411,4223,'','','','','',0),(412,4224,'','','','','',0),(413,4226,'','','','','',0),(464,4230,'','','','','',0),(415,4232,'','','','','',0),(416,4233,'','','','','',0),(417,4234,'','','','','',0),(418,4235,'','','','','',0),(419,4236,'','','','','',0),(420,4238,'','','','','',0),(421,4247,'','','','','',0),(422,4249,'','','','','',0),(423,4253,'','','','','',0),(424,4629,'','','','','',0),(425,4136,'','','','','',0),(426,4137,'','','','','',0),(427,4145,'','','','','',0),(428,4150,'','','','','',0),(429,4151,'','','','','',0),(430,4153,'','','','','',0),(431,4161,'','','','','',0),(432,4163,'','','','','',0),(433,4165,'','','','','',0),(434,4166,'','','','','',0),(435,4168,'','','','','',0),(436,4170,'','','','','',0),(437,4174,'','','','','',0),(438,4177,'','','','','',0),(439,4181,'','','','','',0),(440,4184,'','','','','',0),(441,4189,'','','','','',0),(442,4191,'','','','','',0),(443,4196,'','','','','',0),(444,4197,'','','','','',0),(445,4198,'','','','','',0),(446,4206,'','','','','',0),(447,4211,'','','','','',0),(448,4214,'','','','','',0),(449,4215,'','','','','',0),(450,4220,'','','','','',0),(451,4222,'','','','','',0),(452,4225,'','','','','',0),(463,4373,'','','','','',0),(454,4240,'','','','','',0),(455,4245,'','','','','',0),(456,4248,'','','','','',0),(457,4251,'','','','','',0),(458,4256,'','','','','',0),(459,4261,'','','','','',0),(462,4205,'','','','','',0),(461,4507,'','','','','',0);
UNLOCK TABLES;
/*!40000 ALTER TABLE `parentdetails` ENABLE KEYS */;

--
-- Table structure for table `pocket_money`
--

DROP TABLE IF EXISTS `pocket_money`;
CREATE TABLE `pocket_money` (
  `admno` varchar(100) NOT NULL,
  `bal` float(18,2) default '0.00',
  PRIMARY KEY  (`admno`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pocket_money`
--


/*!40000 ALTER TABLE `pocket_money` DISABLE KEYS */;
LOCK TABLES `pocket_money` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `pocket_money` ENABLE KEYS */;

--
-- Table structure for table `pocket_money_transactions`
--

DROP TABLE IF EXISTS `pocket_money_transactions`;
CREATE TABLE `pocket_money_transactions` (
  `ref` int(100) NOT NULL auto_increment,
  `admno` varchar(100) NOT NULL,
  `transaction` varchar(100) NOT NULL,
  `t_date` varchar(100) NOT NULL,
  `deposit_amount` float(18,2) NOT NULL,
  `withdraw_amount` float(18,2) NOT NULL,
  PRIMARY KEY  (`ref`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pocket_money_transactions`
--


/*!40000 ALTER TABLE `pocket_money_transactions` DISABLE KEYS */;
LOCK TABLES `pocket_money_transactions` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `pocket_money_transactions` ENABLE KEYS */;

--
-- Table structure for table `positionby`
--

DROP TABLE IF EXISTS `positionby`;
CREATE TABLE `positionby` (
  `marks` int(1) NOT NULL,
  `point` int(1) NOT NULL,
  PRIMARY KEY  (`marks`,`point`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `positionby`
--


/*!40000 ALTER TABLE `positionby` DISABLE KEYS */;
LOCK TABLES `positionby` WRITE;
INSERT INTO `positionby` VALUES (1,0);
UNLOCK TABLES;
/*!40000 ALTER TABLE `positionby` ENABLE KEYS */;

--
-- Table structure for table `positions`
--

DROP TABLE IF EXISTS `positions`;
CREATE TABLE `positions` (
  `admno` int(10) NOT NULL,
  `english` int(10) NOT NULL,
  `kiswahili` int(10) NOT NULL,
  `math` int(10) NOT NULL,
  `biology` int(10) NOT NULL,
  `chemistry` int(10) NOT NULL,
  `physics` int(10) NOT NULL,
  `history` int(10) NOT NULL,
  `geography` int(10) NOT NULL,
  `cre` int(10) NOT NULL,
  `agriculture` int(10) NOT NULL,
  `bstudies` int(10) NOT NULL,
  `french` int(10) NOT NULL,
  `computer` int(10) NOT NULL,
  `home` int(10) NOT NULL,
  `year` int(5) NOT NULL,
  `term` int(3) NOT NULL,
  `form` int(2) NOT NULL,
  `position` int(10) NOT NULL,
  `kcpe` int(10) NOT NULL,
  `stream` varchar(10) NOT NULL,
  `positionclass` int(10) NOT NULL,
  PRIMARY KEY  (`admno`,`year`,`term`,`form`),
  KEY `admon` (`admno`,`year`,`term`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `positions`
--


/*!40000 ALTER TABLE `positions` DISABLE KEYS */;
LOCK TABLES `positions` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `positions` ENABLE KEYS */;

--
-- Table structure for table `printedestimate`
--

DROP TABLE IF EXISTS `printedestimate`;
CREATE TABLE `printedestimate` (
  `yr` int(20) NOT NULL,
  `bes` double NOT NULL,
  `ses` double NOT NULL,
  `pe` double NOT NULL,
  `act` double NOT NULL,
  `med` double NOT NULL,
  `ewc` double NOT NULL,
  `rmi` double NOT NULL,
  `ltt` double NOT NULL,
  `con` double NOT NULL,
  `dev` double NOT NULL,
  `cau` double NOT NULL,
  `pocket` double NOT NULL,
  `mock` double NOT NULL,
  `uni` double NOT NULL,
  `lunch` double NOT NULL,
  PRIMARY KEY  (`yr`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `printedestimate`
--


/*!40000 ALTER TABLE `printedestimate` DISABLE KEYS */;
LOCK TABLES `printedestimate` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `printedestimate` ENABLE KEYS */;

--
-- Table structure for table `purchase_orderitems`
--

DROP TABLE IF EXISTS `purchase_orderitems`;
CREATE TABLE `purchase_orderitems` (
  `po_number` varchar(100) NOT NULL,
  `item` varchar(255) NOT NULL,
  `qty` int(100) NOT NULL,
  PRIMARY KEY  (`po_number`,`item`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchase_orderitems`
--


/*!40000 ALTER TABLE `purchase_orderitems` DISABLE KEYS */;
LOCK TABLES `purchase_orderitems` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `purchase_orderitems` ENABLE KEYS */;

--
-- Table structure for table `purchase_orderitems_received`
--

DROP TABLE IF EXISTS `purchase_orderitems_received`;
CREATE TABLE `purchase_orderitems_received` (
  `id` int(100) NOT NULL auto_increment,
  `po_number` varchar(100) NOT NULL,
  `item` varchar(255) NOT NULL,
  `qty` int(100) NOT NULL,
  `unit_price` decimal(18,2) NOT NULL default '0.00',
  `total_price` decimal(18,2) NOT NULL default '0.00',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchase_orderitems_received`
--


/*!40000 ALTER TABLE `purchase_orderitems_received` DISABLE KEYS */;
LOCK TABLES `purchase_orderitems_received` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `purchase_orderitems_received` ENABLE KEYS */;

--
-- Table structure for table `purchase_orders`
--

DROP TABLE IF EXISTS `purchase_orders`;
CREATE TABLE `purchase_orders` (
  `po_number` varchar(100) NOT NULL,
  `po_date` varchar(100) NOT NULL,
  `d_date` varchar(100) NOT NULL,
  `supplier` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `telephone` int(20) NOT NULL,
  `po_notes` text NOT NULL,
  `authorized_by` varchar(250) NOT NULL,
  `po_status` varchar(20) NOT NULL default 'OPEN',
  PRIMARY KEY  (`po_number`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchase_orders`
--


/*!40000 ALTER TABLE `purchase_orders` DISABLE KEYS */;
LOCK TABLES `purchase_orders` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `purchase_orders` ENABLE KEYS */;

--
-- Table structure for table `purchase_orders_received`
--

DROP TABLE IF EXISTS `purchase_orders_received`;
CREATE TABLE `purchase_orders_received` (
  `po_number` varchar(100) NOT NULL,
  `delivery` varchar(100) NOT NULL,
  `d_date` varchar(100) NOT NULL,
  `d_notes` text NOT NULL,
  `received_by` varchar(100) NOT NULL,
  PRIMARY KEY  (`po_number`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchase_orders_received`
--


/*!40000 ALTER TABLE `purchase_orders_received` DISABLE KEYS */;
LOCK TABLES `purchase_orders_received` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `purchase_orders_received` ENABLE KEYS */;

--
-- Table structure for table `received_invoice_items`
--

DROP TABLE IF EXISTS `received_invoice_items`;
CREATE TABLE `received_invoice_items` (
  `invoice_ref` varchar(100) NOT NULL,
  `qty` int(100) NOT NULL,
  `item_ref` varchar(255) NOT NULL,
  `price` float(18,2) NOT NULL,
  PRIMARY KEY  (`invoice_ref`,`item_ref`,`price`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `received_invoice_items`
--


/*!40000 ALTER TABLE `received_invoice_items` DISABLE KEYS */;
LOCK TABLES `received_invoice_items` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `received_invoice_items` ENABLE KEYS */;

--
-- Table structure for table `received_invoices`
--

DROP TABLE IF EXISTS `received_invoices`;
CREATE TABLE `received_invoices` (
  `invoice_ref` varchar(100) NOT NULL,
  `received_date` varchar(100) NOT NULL default '',
  `supplier` varchar(255) NOT NULL default '',
  `supplier_pin` varchar(255) NOT NULL default '',
  `address` varchar(255) NOT NULL default '',
  `telephone` int(20) NOT NULL,
  `email` varchar(100) NOT NULL default '',
  `received_by` varchar(250) NOT NULL default '',
  `invoice_payment_status` varchar(20) NOT NULL default 'OPEN',
  `item_totals` float(18,2) NOT NULL default '0.00',
  `items_total_tax` float(18,2) NOT NULL default '0.00',
  PRIMARY KEY  (`invoice_ref`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `received_invoices`
--


/*!40000 ALTER TABLE `received_invoices` DISABLE KEYS */;
LOCK TABLES `received_invoices` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `received_invoices` ENABLE KEYS */;

--
-- Table structure for table `returned_books`
--

DROP TABLE IF EXISTS `returned_books`;
CREATE TABLE `returned_books` (
  `bookid` varchar(100) NOT NULL default '',
  `userid` varchar(100) NOT NULL default '',
  `datereturned` varchar(100) NOT NULL default '',
  `receivedby` varchar(100) NOT NULL default '',
  `comments` text NOT NULL,
  PRIMARY KEY  (`bookid`,`userid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `returned_books`
--


/*!40000 ALTER TABLE `returned_books` DISABLE KEYS */;
LOCK TABLES `returned_books` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `returned_books` ENABLE KEYS */;

--
-- Table structure for table `schoolname`
--

DROP TABLE IF EXISTS `schoolname`;
CREATE TABLE `schoolname` (
  `schname` varchar(100) NOT NULL,
  `box` varchar(100) NOT NULL,
  `place` varchar(100) NOT NULL,
  `telphone` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `website` varchar(100) NOT NULL,
  PRIMARY KEY  (`schname`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `schoolname`
--


/*!40000 ALTER TABLE `schoolname` DISABLE KEYS */;
LOCK TABLES `schoolname` WRITE;
INSERT INTO `schoolname` VALUES ('OUR LADY OF FATIMA KIRIKO GIRLS SECONDARY SCHOOL','38 â€“ 01003 GITUAMBA VIA THIKA','','0796 736 479','olfkirikog@gmail.com','-');
UNLOCK TABLES;
/*!40000 ALTER TABLE `schoolname` ENABLE KEYS */;

--
-- Table structure for table `sent_messages`
--

DROP TABLE IF EXISTS `sent_messages`;
CREATE TABLE `sent_messages` (
  `id` int(100) NOT NULL auto_increment,
  `msg_to` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `date_sent` varchar(100) NOT NULL,
  `sender` varchar(100) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sent_messages`
--


/*!40000 ALTER TABLE `sent_messages` DISABLE KEYS */;
LOCK TABLES `sent_messages` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `sent_messages` ENABLE KEYS */;

--
-- Table structure for table `staff`
--

DROP TABLE IF EXISTS `staff`;
CREATE TABLE `staff` (
  `fname` varchar(100) NOT NULL,
  `mname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `idpass` varchar(100) NOT NULL,
  `telephone` varchar(100) NOT NULL,
  `category` varchar(100) NOT NULL,
  `staffno` varchar(100) NOT NULL,
  `employement_type` varchar(100) NOT NULL,
  `kra_pin` varchar(100) NOT NULL,
  `nssf` varchar(100) default NULL,
  `nhif` varchar(100) default NULL,
  `salary` decimal(18,2) default '0.00',
  `qualification` varchar(100) NOT NULL,
  `cv` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `imgref` varchar(100) NOT NULL,
  `passwrd` varchar(100) NOT NULL,
  `dateJoined` varchar(100) NOT NULL,
  `dateLeft` varchar(100) NOT NULL,
  PRIMARY KEY  (`idpass`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `staff`
--


/*!40000 ALTER TABLE `staff` DISABLE KEYS */;
LOCK TABLES `staff` WRITE;
INSERT INTO `staff` VALUES ('DANIEL','KURIA','NGUGI','10932104','0723286601','Accountant','-','Full-Time','-',NULL,NULL,'0.00','ACCOUNTANT','','38 GITUAMBA','blur.PNG','10932104','2017-11-22','_'),('REGINA','NJOKI','WAINOGA','11054704','0723772699','Secretary','-','Full-Time','A0025405261',NULL,NULL,'0.00','-','','38 GITUAMBA THIKA','blur.PNG','11054704','2017-11-10','_'),('DEFAULT','SYSTEM','ADMINISTRATOR','admin','715694916','Administrator','admin','-','-',NULL,NULL,'0.00','-','-','-    ','blur.PNG','admin','-','-');
UNLOCK TABLES;
/*!40000 ALTER TABLE `staff` ENABLE KEYS */;

--
-- Table structure for table `standards`
--

DROP TABLE IF EXISTS `standards`;
CREATE TABLE `standards` (
  `cat1` int(100) NOT NULL,
  `cat2` int(100) NOT NULL,
  `exam` int(100) NOT NULL,
  `cat1percent` decimal(18,2) NOT NULL,
  `cat2percent` decimal(18,2) NOT NULL,
  `exampercent` decimal(18,2) NOT NULL,
  `year` int(4) NOT NULL,
  `term` int(1) NOT NULL,
  `form` int(1) NOT NULL,
  PRIMARY KEY  (`year`,`term`,`form`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `standards`
--


/*!40000 ALTER TABLE `standards` DISABLE KEYS */;
LOCK TABLES `standards` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `standards` ENABLE KEYS */;

--
-- Table structure for table `streams`
--

DROP TABLE IF EXISTS `streams`;
CREATE TABLE `streams` (
  `form` varchar(100) NOT NULL,
  `stream` varchar(100) NOT NULL,
  `students` int(100) NOT NULL,
  `classteacher` varchar(100) NOT NULL,
  PRIMARY KEY  (`form`,`stream`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `streams`
--


/*!40000 ALTER TABLE `streams` DISABLE KEYS */;
LOCK TABLES `streams` WRITE;
INSERT INTO `streams` VALUES ('FORM 1','EAST',0,''),('FORM 1','WEST',0,''),('FORM 1','NORTH',0,''),('FORM 2','EAST',0,''),('FORM 2','NORTH',0,''),('FORM 2','WEST',0,''),('FORM 3','EAST',0,''),('FORM 3','WEST',0,''),('FORM 4','EAST',0,''),('FORM 4','WEST',0,'');
UNLOCK TABLES;
/*!40000 ALTER TABLE `streams` ENABLE KEYS */;

--
-- Table structure for table `studentdetails`
--

DROP TABLE IF EXISTS `studentdetails`;
CREATE TABLE `studentdetails` (
  `admno` int(10) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `sname` varchar(255) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `dob` varchar(20) NOT NULL,
  `age` varchar(20) NOT NULL,
  `religion` varchar(255) NOT NULL,
  `previouschool` varchar(255) NOT NULL,
  `marks` int(11) NOT NULL,
  `picture` varchar(100) NOT NULL,
  `yrofadmn` int(11) NOT NULL,
  `form` varchar(10) NOT NULL,
  `forminto` varchar(100) NOT NULL default '',
  `category` varchar(100) NOT NULL default '',
  `house` varchar(100) NOT NULL default '',
  `grade` varchar(100) NOT NULL default '',
  `class` varchar(100) NOT NULL default '',
  `year_finished` int(4) NOT NULL,
  PRIMARY KEY  (`admno`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `studentdetails`
--


/*!40000 ALTER TABLE `studentdetails` DISABLE KEYS */;
LOCK TABLES `studentdetails` WRITE;
INSERT INTO `studentdetails` VALUES (4509,'MARY','NJERI','NJOROGE','Female','','','','',0,'',2017,'FORM 1','FORM 1','','','','EAST',0),(4512,'MORINE','WARUINU','MAINA','Female','','','','',0,'',2017,'FORM 1','FORM 1','','','','EAST',0),(4514,'AGNES','NJERI','KIRUNGE','Female','','','','',0,'',2017,'FORM 1','FORM 1','','','','EAST',0),(4517,'TABITHA','RUGURU','MUHIA','Female','','','','',0,'',2017,'FORM 1','FORM 1','','','','EAST',0),(4519,'VERONICA','MWIKALI','KAMAU','Female','','','','',0,'',2017,'FORM 1','FORM 1','','','','EAST',0),(4521,'HILDA','GATHONI','WANJIKU','Female','','','','',0,'',2017,'FORM 1','FORM 1','','','','EAST',0),(4526,'TERESIA','WANJIRU','MWANGI','Female','','','','',0,'',2017,'FORM 1','FORM 1','','','','EAST',0),(4532,'EUNIE','WAIRIMU','GATEGWA','Female','','','','',0,'',2017,'FORM 1','FORM 1','','','','EAST',0),(4535,'KATRINAH','NDUTA','MURIU','Female','','','','',0,'',2017,'FORM 1','FORM 1','','','','EAST',0),(4538,'TERESIA','NJERI','KIGURU','Female','','','','',0,'',2017,'FORM 1','FORM 1','','','','EAST',0),(4546,'HILDA','WANJA','WANJIKU','Female','','','','',0,'',2017,'FORM 1','FORM 1','','','','EAST',0),(4547,'ROSE','MWIKALI','MUNYAO','Female','','','','',0,'',2017,'FORM 1','FORM 1','','','','EAST',0),(4552,'ANN','WANJIRU','NDEGWA','Female','','','','',0,'',2017,'FORM 1','FORM 1','','','','EAST',0),(4553,'WILKISTER','AKUMU','ODWOLI','Female','','','','',0,'',2017,'FORM 1','FORM 1','','','','EAST',0),(4555,'ALICE','WAMBUI','MUNGAI','Female','','','','',0,'',2017,'FORM 1','FORM 1','','','','EAST',0),(4557,'ELIZABETH','ALEYO','ISAIAH','Female','','','','',0,'',2017,'FORM 1','FORM 1','','','','EAST',0),(4558,'MIRIAM','GATHONI','MUNGAI','Female','','','','',0,'',2017,'FORM 1','FORM 1','','','','EAST',0),(4561,'LUCY','WAITHIRA','NGUBIA','Female','','','','',0,'',2017,'FORM 1','FORM 1','','','','EAST',0),(4564,'MARY','NJOKI','GITU','Female','','','','',0,'',2017,'FORM 1','FORM 1','','','','EAST',0),(4567,'JANE','WAIRIMU','GITHINJI','Female','','','','',0,'',2017,'FORM 1','FORM 1','','','','EAST',0),(4572,'ESTHER','WAIRIMU','KARANI','Female','','','','',0,'',2017,'FORM 1','FORM 1','','','','EAST',0),(4573,'CAROLINE','NYARUAI','NJENGA','Female','','','','',0,'',2017,'FORM 1','FORM 1','','','','EAST',0),(4574,'RUTH','NJOKI','NGOTHO','Female','','','','',0,'',2017,'FORM 1','FORM 1','','','','EAST',0),(4577,'JACKLINE','WANJIRA','GICHIA','Female','','','','',0,'',2017,'FORM 1','FORM 1','','','','EAST',0),(4581,'SUSAN','WANJIRU','KAMAU','Female','','','','',0,'',2017,'FORM 1','FORM 1','','','','EAST',0),(4583,'SHALYNE','NGWIRI','','Female','','','','',0,'',2017,'FORM 1','FORM 1','','','','EAST',0),(4584,'JACINTA','WANJIRU','WAMATU','Female','','','','',0,'',2017,'FORM 1','FORM 1','','','','EAST',0),(4593,'LEANNE','WANGECI','MWANGI','Female','','','','',0,'',2017,'FORM 1','FORM 1','','','','EAST',0),(4594,'LAMYA','WANJIRU','WANGU','Female','','','','',0,'',2017,'FORM 1','FORM 1','','','','EAST',0),(4596,'TERESIA','WANGUI','KARIUKI','Female','','','','',0,'',2017,'FORM 1','FORM 1','','','','EAST',0),(4599,'PAULINE','WAMAITHA','MUNDIA','Female','','','','',0,'',2017,'FORM 1','FORM 1','','','','EAST',0),(4600,'JOY','WAMBUI','GITAU','Female','','','','',0,'',2017,'FORM 1','FORM 1','','','','EAST',0),(4606,'DEBORAH','NYOKABI','NJUGUNA','Female','','','','',0,'',2017,'FORM 1','FORM 1','','','','EAST',0),(4609,'HANNAH','WANJIRU','','Female','','','','',0,'',2017,'FORM 1','FORM 1','','','','EAST',0),(4611,'EDEL','WANJIKU','GACHARA','Female','','','','',0,'',2017,'FORM 1','FORM 1','','','','EAST',0),(4615,'HELLEN','WANJIRU','MUTUKU','Female','','','','',0,'',2017,'FORM 1','FORM 1','','','','EAST',0),(4617,'CAROLINE','WANJIRU','GACHAU','Female','','','','',0,'',2017,'FORM 1','FORM 1','','','','EAST',0),(4619,'DIANA','VUGUSA','','Female','','','','',0,'',2017,'FORM 1','FORM 1','','','','EAST',0),(4621,'PAULINE','CHEBET','BARASA','Female','','','','',0,'',2017,'FORM 1','FORM 1','','','','EAST',0),(4635,'PAULINE','WANGARI','WANJIRU','Female','','','','',0,'',2017,'FORM 1','FORM 1','','','','EAST',0),(4641,'ESTHER','ETEMESI','OMBOYA','Female','','','','',0,'',2017,'FORM 1','FORM 1','','','','EAST',0),(4642,'BREDA','NJOKI','NJOROGE','Female','','','','',0,'',2017,'FORM 1','FORM 1','','','','EAST',0),(4645,'CECILIA','WAMBUI','KAMOTHO','Female','','','','',0,'',2017,'FORM 1','FORM 1','','','','EAST',0),(4648,'MARGARET','WAIRIMU','NJOGO','Female','','','','',0,'',2017,'FORM 1','FORM 1','','','','EAST',0),(4626,'GLADYS','NJERI','KIORE','Female','','','','',0,'',2017,'FORM 1','FORM 1','','','','WEST',0),(4624,'ATIENO','MELVINE','','Female','','','','',0,'',2017,'FORM 1','FORM 1','','','','WEST',0),(4623,'MONICAH','WAMBUI','GIKARU','Female','','','','',0,'',2017,'FORM 1','FORM 1','','','','WEST',0),(4620,'LILIAN','CHEROP','BARASA','Female','','','','',0,'',2017,'FORM 1','FORM 1','','','','WEST',0),(4618,'FRIDAH','WANJIRU','NJOROGE','Female','','','','',0,'',2017,'FORM 1','FORM 1','','','','WEST',0),(4614,'PAULINE','MWENYWA','ASENA','Female','','','','',0,'',2017,'FORM 1','FORM 1','','','','WEST',0),(4610,'FIDELIS','WANJIKU','MBUGUA','Female','','','','',0,'',2017,'FORM 1','FORM 1','','','','WEST',0),(4607,'LAVINNIA','JOY','MUSONYE','Female','','','','',0,'',2017,'FORM 1','FORM 1','','','','WEST',0),(4604,'SHARON','WAGENI','GITAU','Female','','','','',0,'',2017,'FORM 1','FORM 1','','','','WEST',0),(4602,'EMILY','WANJIKU','MWANGI','Female','','','','',0,'',2017,'FORM 1','FORM 1','','','','WEST',0),(4597,'CHARITY','WAIRIMU','WANJIKU','Female','','','','',0,'',2017,'FORM 1','FORM 1','','','','WEST',0),(4591,'','MARY','WAMBUI KARANJA','Female','','','','',0,'',2017,'FORM 1','FORM 1','','','','WEST',0),(4589,'DARCEL','WATIRI','WAITHIRA','Female','','','','',0,'',2017,'FORM 1','FORM 1','','','','WEST',0),(4588,'ABIGAEL','MUTHONI','MWANGI','Female','','','','',0,'',2017,'FORM 1','FORM 1','','','','WEST',0),(4586,'GRACE','WAMBUI','KIHARA','Female','','','','',0,'',2017,'FORM 1','FORM 1','','','','WEST',0),(4585,'MRGARET','NJERI','MWAURA','Female','','','','',0,'',2017,'FORM 1','FORM 1','','','','WEST',0),(4580,'LUCY','WANJA','NJUGUNA','Female','','','','',0,'',2017,'FORM 1','FORM 1','','','','WEST',0),(4578,'IMMACULATE','NJERI','KINYANJUI','Female','','','','',0,'',2017,'FORM 1','FORM 1','','','','WEST',0),(4575,'JANET','WAIRIMU','MUTHONI','Female','','','','',0,'',2017,'FORM 1','FORM 1','','','','WEST',0),(4569,'ELIZABETH','WAMBUI','KIBURI','Female','','','','',0,'',2017,'FORM 1','FORM 1','','','','WEST',0),(4568,'MARY','NYAMBURA','KAMAU','Female','','','','',0,'',2017,'FORM 1','FORM 1','','','','WEST',0),(4565,'EMMAH','NJERI','MUHUHUKO','Female','','','','',0,'',2017,'FORM 1','FORM 1','','','','WEST',0),(4562,'SILVIA','MUTHONI','KAGURI','Female','','','','',0,'',2017,'FORM 1','FORM 1','','','','WEST',0),(4559,'RUTH','WANJIRU','MUCHERU','Female','','','','',0,'',2017,'FORM 1','FORM 1','','','','WEST',0),(4556,'SARAH','MUTHONI','NJAMBI','Female','','','','',0,'',2017,'FORM 1','FORM 1','','','','WEST',0),(4550,'ABIGAEL','NYONGESA','MUTHONI','Female','','','','',0,'',2017,'FORM 1','FORM 1','','','','WEST',0),(4548,'TERESIA','WANGUI','WAWERU','Female','','','','',0,'',2017,'FORM 1','FORM 1','','','','WEST',0),(4544,'MARY','NUNGARI','MUGENDA','Female','','','','',0,'',2017,'FORM 1','FORM 1','','','','WEST',0),(4542,'LYDIA','NGINA','MUCHINA','Female','','','','',0,'',2017,'FORM 1','FORM 1','','','','WEST',0),(4539,'GLADYS','WANJIKU','NJOROGE','Female','','','','',0,'',2017,'FORM 1','FORM 1','','','','WEST',0),(4536,'ROSALINE','NJERI','NJUGUNA','Female','','','','',0,'',2017,'FORM 1','FORM 1','','','','WEST',0),(4534,'CAROLINE','WANJIRU','WANJIRU','Female','','','','',0,'',2017,'FORM 1','FORM 1','','','','WEST',0),(4530,'LINET','JUDY','NJERI WANJIRU','Female','','','','',0,'',2017,'FORM 1','FORM 1','','','','WEST',0),(4529,'SHEILA','NYAMBURA','KIRUGU','Female','','','','',0,'',2017,'FORM 1','FORM 1','','','','WEST',0),(4527,'DAMARIS','MUTHONI','','Female','','','','',0,'',2017,'FORM 1','FORM 1','','','','WEST',0),(4524,'CLEMENTINA','OBADO','MANGENI','Female','','','','',0,'',2017,'FORM 1','FORM 1','','','','WEST',0),(4523,'EUNICE','MWIHAKI','GATUA','Female','','','','',0,'',2017,'FORM 1','FORM 1','','','','WEST',0),(4522,'SABINA','NYAMBURA','NJOROGE','Female','','','','',0,'',2017,'FORM 1','FORM 1','','','','WEST',0),(4518,'FIDELIS','GATHONI','KIOI','Female','','','','',0,'',2017,'FORM 1','FORM 1','','','','WEST',0),(4515,'MARY','NYARUA','KOMO','Female','','','','',0,'',2017,'FORM 1','FORM 1','','','','WEST',0),(4510,'PHOEBE','AOKO','OTIENO','Female','','','','',0,'',2017,'FORM 1','FORM 1','','','','WEST',0),(4628,'GLADYS','NJERI','KINYANJUI','Female','','','','',0,'',2017,'FORM 1','FORM 1','','','','WEST',0),(4631,'SUSAN','MUNGARE','MATWETWE','Female','','','','',0,'',2017,'FORM 1','FORM 1','','','','WEST',0),(4633,'STANCY','WANGUI','KIHARA','Female','','','','',0,'',2017,'FORM 1','FORM 1','','','','WEST',0),(4637,'CAROLINE','WAMBUI','MWAGO','Female','','','','',0,'',2017,'FORM 1','FORM 1','','','','WEST',0),(4511,'ESTHER','WAIRIMU','WANJIRU','Female','','','','',0,'',2017,'FORM 1','FORM 1','','','','NORTH',0),(4513,'GLORIA','WANJIRU','HUNJA','Female','','','','',0,'',2017,'FORM 1','FORM 1','','','','NORTH',0),(4516,'LENAH','WANJIRU','NJERU','Female','','','','',0,'',2017,'FORM 1','FORM 1','','','','NORTH',0),(4520,'JECINTA','WANJIKU','','Female','','','','',0,'',2017,'FORM 1','FORM 1','','','','NORTH',0),(4525,'JACINTA','WAMBUI','KIMANI','Female','','','','',0,'',2017,'FORM 1','FORM 1','','','','NORTH',0),(4528,'VERONICAH','MURUGI','WARIARA','Female','','','','',0,'',2017,'FORM 1','FORM 1','','','','NORTH',0),(4531,'ESTHER','WARINGA','','Female','','','','',0,'',2017,'FORM 1','FORM 1','','','','NORTH',0),(4533,'ANN','NJOKI','WANJERI','Female','','','','',0,'',2017,'FORM 1','FORM 1','','','','NORTH',0),(4537,'SUSAN','NJERI','NJONGE','Female','','','','',0,'',2017,'FORM 1','FORM 1','','','','NORTH',0),(4540,'NANCY','WANJIRU','GICHUKI','Female','','','','',0,'',2017,'FORM 1','FORM 1','','','','NORTH',0),(4541,'MIRIAM','WANJIKU','WAIRA','Female','','','','',0,'',2017,'FORM 1','FORM 1','','','','NORTH',0),(4543,'LUCY','NJERI','NJOROGE','Female','','','','',0,'',2017,'FORM 1','FORM 1','','','','NORTH',0),(4545,'MARY','WANGUI','NGIGI','Female','','','','',0,'',2017,'FORM 1','FORM 1','','','','NORTH',0),(4549,'FAITH','NJOKI','MUIGAI','Female','','','','',0,'',2017,'FORM 1','FORM 1','','','','NORTH',0),(4551,'JOYCE','NJERI','MWANGI','Female','','','','',0,'',2017,'FORM 1','FORM 1','','','','NORTH',0),(4554,'GRACE','WAMBUI','GICHURU','Female','','','','',0,'',2017,'FORM 1','FORM 1','','','','NORTH',0),(4560,'CHRISTINE','WAMBUI','KIGO','Female','','','','',0,'',2017,'FORM 1','FORM 1','','','','NORTH',0),(4563,'HANNAH','WAMBUI','KIMANI','Female','','','','',0,'',2017,'FORM 1','FORM 1','','','','NORTH',0),(4566,'MARY','WANJA','KAMAU','Female','','','','',0,'',2017,'FORM 1','FORM 1','','','','NORTH',0),(4570,'IRENE','WANJIRU','MUTUNGA','Female','','','','',0,'',2017,'FORM 1','FORM 1','','','','NORTH',0),(4571,'GRACE','WANGARI','MBUGUA','Female','','','','',0,'',2017,'FORM 1','FORM 1','','','','NORTH',0),(4576,'BRIDGET','WANGARI','KIMATA','Female','','','','',0,'',2017,'FORM 1','FORM 1','','','','NORTH',0),(4579,'CAROLINE','NJERI','NGUGI','Female','','','','',0,'',2017,'FORM 1','FORM 1','','','','NORTH',0),(4582,'MARYANN','NDUHI','NJUGUNA','Female','','','','',0,'',2017,'FORM 1','FORM 1','','','','NORTH',0),(4587,'MARGARET','WANJIRU','KIHARA','Female','','','','',0,'',2017,'FORM 1','FORM 1','','','','NORTH',0),(4590,'PENINA','WANJIRU','NDUNGU','Female','','','','',0,'',2017,'FORM 1','FORM 1','','','','NORTH',0),(4592,'RACHEAL','WANJIKU','MUIRURI','Female','','','','',0,'',2017,'FORM 1','FORM 1','','','','NORTH',0),(4595,'AGNES','WANGARI','KAMAU','Female','','','','',0,'',2017,'FORM 1','FORM 1','','','','NORTH',0),(4598,'ESTHER','NJOKI','KURIA','Female','','','','',0,'',2017,'FORM 1','FORM 1','','','','NORTH',0),(4601,'TERESIA','WAIRIMU','NYAMBURA','Female','','','','',0,'',2017,'FORM 1','FORM 1','','','','NORTH',0),(4603,'EUNICE','WANGUI','IRUNGU','Female','','','','',0,'',2017,'FORM 1','FORM 1','','','','NORTH',0),(4605,'LEAH','WANJIRU','WACUKA','Female','','','','',0,'',2017,'FORM 1','FORM 1','','','','NORTH',0),(4608,'LINET','NYAMBURA','WANJIKU','Female','','','','',0,'',2017,'FORM 1','FORM 1','','','','NORTH',0),(4612,'PURITY','WAMBUI','GICHIA','Female','','','','',0,'',2017,'FORM 1','FORM 1','','','','NORTH',0),(4613,'TERESIA','WANJIKU','KINUTHIA','Female','','','','',0,'',2017,'FORM 1','FORM 1','','','','NORTH',0),(4616,'LUCY','WAKONYO','NGIGI','Female','','','','',0,'',2017,'FORM 1','FORM 1','','','','NORTH',0),(4625,'VIRGINIA','WANJIKU','FUNDI','Female','','','','',0,'',2017,'FORM 1','FORM 1','','','','NORTH',0),(4627,'EUNICE','WAMBUI','GITAU','Female','','','','',0,'',2017,'FORM 1','FORM 1','','','','NORTH',0),(4630,'PERPETUA','NYAMBURA','NJOKI','Female','','','','',0,'',2017,'FORM 1','FORM 1','','','','NORTH',0),(4632,'MARY','WAMBUI','MUKURIA','Female','','','','',0,'',2017,'FORM 1','FORM 1','','','','NORTH',0),(4636,'MARYLINN','WANGUI','MUNGAI','Female','','','','',0,'',2017,'FORM 1','FORM 1','','','','NORTH',0),(4638,'JULIA','WANJIKU','NJERI','Female','','','','',0,'',2017,'FORM 1','FORM 1','','','','NORTH',0),(4639,'CAROLINE','D','WAIRIMU NGUGI','Female','','','','',0,'',2017,'FORM 1','FORM 1','','','','NORTH',0),(4643,'CHRISTINE','WAMBUI','THUKU','Female','','','','',0,'',2017,'FORM 1','FORM 1','','','','NORTH',0),(4644,'FRIDA','MUTHONI','MERIA','Female','','','','',0,'',2017,'FORM 1','FORM 1','','','','NORTH',0),(4378,'JOAN','WAITHIRA','WANJIRU','Female','','','','',0,'',2016,'FORM 2','FORM 1','','','','EAST',0),(4382,'JOYCE','NYAMBURA','MAREMA','Female','','','','',0,'',2016,'FORM 2','FORM 1','','','','EAST',0),(4383,'LUCY','WAMBUI','MUIRURI','Female','','','','',0,'',2016,'FORM 2','FORM 1','','','','EAST',0),(4385,'ANN','WANJUGU','MWANGI','Female','','','','',0,'',2016,'FORM 2','FORM 1','','','','EAST',0),(4386,'LEAH','NJERI','MBUGUA','Female','','','','',0,'',2016,'FORM 2','FORM 1','','','','EAST',0),(4388,'ELIZABETH','NJOKI','NJENGA','Female','','','','',0,'',2016,'FORM 2','FORM 1','','','','EAST',0),(4389,'MERCY','NJOKI','MUKORA','Female','','','','',0,'',2016,'FORM 2','FORM 1','','','','EAST',0),(4390,'EVALYNE','NYAMBURA','WAMUNYU','Female','','','','',0,'',2016,'FORM 2','FORM 1','','','','EAST',0),(4392,'KEZIAH','NJERI','NGARARI','Female','','','','',0,'',2016,'FORM 2','FORM 1','','','','EAST',0),(4394,'LISPER','WANJA','GITAU','Female','','','','',0,'',2016,'FORM 2','FORM 1','','','','EAST',0),(4395,'BEATRICE','WANJIKU','NJERI','Female','','','','',0,'',2016,'FORM 2','FORM 1','','','','EAST',0),(4397,'JEDIDA','WANJIRU','WAWERU','Female','','','','',0,'',2016,'FORM 2','FORM 1','','','','EAST',0),(4399,'CYNTHIA','WAGIO','ITUGI','Female','','','','',0,'',2016,'FORM 2','FORM 1','','','','EAST',0),(4401,'JANET','WAITHIRA','WANYORO','Female','','','','',0,'',2016,'FORM 2','FORM 1','','','','EAST',0),(4405,'JULIANA','NDANGA','KANJA','Female','','','','',0,'',2016,'FORM 2','FORM 1','','','','EAST',0),(4407,'CATHERINE','MUTHONI','WAITHIRA','Female','','','','',0,'',2016,'FORM 2','FORM 1','','','','EAST',0),(4409,'BERNICE','NJERI','MWERU','Female','','','','',0,'',2016,'FORM 2','FORM 1','','','','EAST',0),(4411,'AGNES','WANJIRU','MWANGI','Female','','','','',0,'',2016,'FORM 2','FORM 1','','','','EAST',0),(4415,'MARY','WANJIKU','MAINA','Female','','','','',0,'',2016,'FORM 2','FORM 1','','','','EAST',0),(4416,'HANNAH','WANJIKU','KURIA','Female','','','','',0,'',2016,'FORM 2','FORM 1','','','','EAST',0),(4425,'FIDDIES','WAMBUI','KAMAU','Female','','','','',0,'',2016,'FORM 2','FORM 1','','','','EAST',0),(4427,'HILDA','WAMBUI','MUMBURA','Female','','','','',0,'',2016,'FORM 2','FORM 1','','','','EAST',0),(4428,'MARY','WANJIKU','MAINA','Female','','','','',0,'',2016,'FORM 2','FORM 1','','','','EAST',0),(4431,'ESTHER','WAMBUI','WANGARI','Female','','','','',0,'',2016,'FORM 2','FORM 1','','','','EAST',0),(4433,'MARY','NYAMBURA','NGUGI','Female','','','','',0,'',2016,'FORM 2','FORM 1','','','','EAST',0),(4436,'MARGARET','WANGARI','MIGWI','Female','','','','',0,'',2016,'FORM 2','FORM 1','','','','EAST',0),(4439,'JOAN','NYAMBURA','MBUTHIA','Female','','','','',0,'',2016,'FORM 2','FORM 1','','','','EAST',0),(4440,'LUCY','WANJIKU','KURIA','Female','','','','',0,'',2016,'FORM 2','FORM 1','','','','EAST',0),(4442,'ANGELA','WANJIRU','KAHENYA','Female','','','','',0,'',2016,'FORM 2','FORM 1','','','','EAST',0),(4448,'ESTHER','WANJIKU','IRUNGU','Female','','','','',0,'',2016,'FORM 2','FORM 1','','','','EAST',0),(4451,'LORINE','NGUHI','NJERI','Female','','','','',0,'',2016,'FORM 2','FORM 1','','','','EAST',0),(4452,'ESTHER','WARIGIA','KIRUGO','Female','','','','',0,'',2016,'FORM 2','FORM 1','','','','EAST',0),(4454,'JOAN','WANJIRU','KIMANI','Female','','','','',0,'',2016,'FORM 2','FORM 1','','','','EAST',0),(4456,'LOREEN','WAIRIMU','KARANU','Female','','','','',0,'',2016,'FORM 2','FORM 1','','','','EAST',0),(4458,'MARY','WANJIKU','MACHARIA','Female','','','','',0,'',2016,'FORM 2','FORM 1','','','','EAST',0),(4459,'JACINTA','WANJIRU','KAMOTHO','Female','','','','',0,'',2016,'FORM 2','FORM 1','','','','EAST',0),(4463,'JANE','NYAGUTHII','WANJERI','Female','','','','',0,'',2016,'FORM 2','FORM 1','','','','EAST',0),(4469,'JANE','MUMBI','WANGUI','Female','','','','',0,'',2016,'FORM 2','FORM 1','','','','EAST',0),(4471,'MONICAH','WANGARI','MBURU','Female','','','','',0,'',2016,'FORM 2','FORM 1','','','','EAST',0),(4472,'MARY','WAIRIMU','WANJIRU','Female','','','','',0,'',2016,'FORM 2','FORM 1','','','','EAST',0),(4475,'JULIANA','WANJIRU','KARUGI','Female','','','','',0,'',2016,'FORM 2','FORM 1','','','','EAST',0),(4380,'DORCAS','NJERI','NJOROGE','Female','','','','',0,'',2016,'FORM 2','FORM 1','','','','WEST',0),(4381,'SHARLEEN','WANJIKU','REGINA','Female','','','','',0,'',2016,'FORM 2','FORM 1','','','','WEST',0),(4384,'MONICAH','NYAMBURA','MUTURI','Female','','','','',0,'',2016,'FORM 2','FORM 1','','','','WEST',0),(4387,'HANNAH','MENDI','GICHICHIO','Female','','','','',0,'',2016,'FORM 2','FORM 1','','','','WEST',0),(4400,'MERCY','NYAMBURA','NGETHE','Female','','','','',0,'',2016,'FORM 2','FORM 1','','','','WEST',0),(4402,'REBECCA','KUYA','KIMANI','Female','','','','',0,'',2016,'FORM 2','FORM 1','','','','WEST',0),(4403,'MAUREEN','WAITHIRA','MWANGI','Female','','','','',0,'',2016,'FORM 2','FORM 1','','','','WEST',0),(4404,'CHRISTINE','NYAMBURA','MWAURA','Female','','','','',0,'',2016,'FORM 2','FORM 1','','','','WEST',0),(4410,'ANN','WANJIRU','THUITA','Female','','','','',0,'',2016,'FORM 2','FORM 1','','','','WEST',0),(4412,'MARY','MUTHONI','MUKWANA','Female','','','','',0,'',2016,'FORM 2','FORM 1','','','','WEST',0),(4413,'REBECCA','WANJIKU','MUNGAI','Female','','','','',0,'',2016,'FORM 2','FORM 1','','','','WEST',0),(4414,'CELINE','NJERI','MUTHONI','Female','','','','',0,'',2016,'FORM 2','FORM 1','','','','WEST',0),(4417,'PHYLLIS','NJERI','MUKURURI','Female','','','','',0,'',2016,'FORM 2','FORM 1','','','','WEST',0),(4421,'NANCY','MUMBI','MURIITHI','Female','','','','',0,'',2016,'FORM 2','FORM 1','','','','WEST',0),(4426,'ALICE','WAMBU','MAINA','Female','','','','',0,'',2016,'FORM 2','FORM 1','','','','WEST',0),(4429,'EVALYNE','NJERI','KAHORO','Female','','','','',0,'',2016,'FORM 2','FORM 1','','','','WEST',0),(4430,'BENADITA','WANJIKU','WAITARA','Female','','','','',0,'',2016,'FORM 2','FORM 1','','','','WEST',0),(4434,'EUNICE','WACERA','IRUNGU','Female','','','','',0,'',2016,'FORM 2','FORM 1','','','','WEST',0),(4435,'SARAH','WAIRIMU','MUMBI','Female','','','','',0,'',2016,'FORM 2','FORM 1','','','','WEST',0),(4438,'SARAH','NJERI','NYAMBURA','Female','','','','',0,'',2016,'FORM 2','FORM 1','','','','WEST',0),(4443,'IRENE','NJERI','WAHITI','Female','','','','',0,'',2016,'FORM 2','FORM 1','','','','WEST',0),(4444,'JECINTA','NYAGITITU','','Female','','','','',0,'',2016,'FORM 2','FORM 1','','','','WEST',0),(4447,'JOSPHINE','WANGECI','MAINA','Female','','','','',0,'',2016,'FORM 2','FORM 1','','','','WEST',0),(4449,'MARGARET','NYAKIO','KIMANI','Female','','','','',0,'',2016,'FORM 2','FORM 1','','','','WEST',0),(4450,'LUCY','NJERI','NGANGA','Female','','','','',0,'',2016,'FORM 2','FORM 1','','','','WEST',0),(4455,'DORCAS','WANJIKU','KIMAMA','Female','','','','',0,'',2016,'FORM 2','FORM 1','','','','WEST',0),(4457,'LUCY','WANJIRU','MBUGUA','Female','','','','',0,'',2016,'FORM 2','FORM 1','','','','WEST',0),(4461,'HOPE','WAIRIMU','MUTURI','Female','','','','',0,'',2016,'FORM 2','FORM 1','','','','WEST',0),(4464,'ANN','MWIKALI','MWEU','Female','','','','',0,'',2016,'FORM 2','FORM 1','','','','WEST',0),(4468,'MARYANN','GITHAE','','Female','','','','',0,'',2016,'FORM 2','FORM 1','','','','WEST',0),(4473,'FAITH','WAITHIRA','KIOKO','Female','','','','',0,'',2016,'FORM 2','FORM 1','','','','WEST',0),(4476,'CATHERINE','WAITHIRA','MUHIA','Female','','','','',0,'',2016,'FORM 2','FORM 1','','','','WEST',0),(4477,'MERCY','WAITHIRA','GITU','Female','','','','',0,'',2016,'FORM 2','FORM 1','','','','WEST',0),(4478,'LYDIA','NYAMBURA','KARIUKI','Female','','','','',0,'',2016,'FORM 2','FORM 1','','','','WEST',0),(4479,'FAITH','WANJIKU','MIRINGU','Female','','','','',0,'',2016,'FORM 2','FORM 1','','','','WEST',0),(4480,'MONICAH','WANJA','KIARIE','Female','','','','',0,'',2016,'FORM 2','FORM 1','','','','WEST',0),(4482,'FAITH','NGINA','NJOROGE','Female','','','','',0,'',2016,'FORM 2','FORM 1','','','','WEST',0),(4483,'PURITY','NJERI','WANJIRU','Female','','','','',0,'',2016,'FORM 2','FORM 1','','','','WEST',0),(4484,'AGNES','WANJIRU','MWANGI','Female','','','','',0,'',2016,'FORM 2','FORM 1','','','','WEST',0),(4485,'ESTHER','WAIRIMU','KABUGA','Female','','','','',0,'',2016,'FORM 2','FORM 1','','','','WEST',0),(4379,'SIPHIRA','WANGECHI','WARUI','Female','','','','',0,'',2016,'FORM 2','FORM1','','','','NORTH',0),(4391,'TERESIA','WANJIRU','KAMAU','Female','','','','',0,'',2016,'FORM 2','FORM1','','','','NORTH',0),(4396,'PAULINE','WAIRIMU','MBUTHIA','Female','','','','',0,'',2016,'FORM 2','FORM1','','','','NORTH',0),(4398,'RACHEAL','WANJIRU','NDUNG’U','Female','','','','',0,'',2016,'FORM 2','FORM1','','','','NORTH',0),(4406,'YVONNE','NJERI','MUIRURI','Female','','','','',0,'',2016,'FORM 2','FORM1','','','','NORTH',0),(4408,'TERESIA','WAMBUI','NJOROGE','Female','','','','',0,'',2016,'FORM 2','FORM1','','','','NORTH',0),(4418,'RUTH','WANJIRU','KANGU','Female','','','','',0,'',2016,'FORM 2','FORM1','','','','NORTH',0),(4420,'SHARON','WANJIKU','NJAU','Female','','','','',0,'',2016,'FORM 2','FORM1','','','','NORTH',0),(4422,'SILVIAH','WANJIRU','KABUGU','Female','','','','',0,'',2016,'FORM 2','FORM1','','','','NORTH',0),(4423,'TERESIA','WANGUI','KARIUKI','Female','','','','',0,'',2016,'FORM 2','FORM1','','','','NORTH',0),(4424,'ROXANA','GLORIANA','MUKAMI','Female','','','','',0,'',2016,'FORM 2','FORM1','','','','NORTH',0),(4441,'TRECY','WAMBUI','MAINA','Female','','','','',0,'',2016,'FORM 2','FORM1','','','','NORTH',0),(4446,'PENINAH','WAMBUI','NGANGA','Female','','','','',0,'',2016,'FORM 2','FORM1','','','','NORTH',0),(4453,'WAMAITHA','MWATHA','','Female','','','','',0,'',2016,'FORM 2','FORM1','','','','NORTH',0),(4460,'STELLA','WANJIKU','','Female','','','','',0,'',2016,'FORM 2','FORM1','','','','NORTH',0),(4465,'ROSE','NJERI','MWANGI','Female','','','','',0,'',2016,'FORM 2','FORM1','','','','NORTH',0),(4466,'TERESIA','NJAHIRA','KIMANI','Female','','','','',0,'',2016,'FORM 2','FORM1','','','','NORTH',0),(4467,'PATIENCE','NJOKI','NJAU','Female','','','','',0,'',2016,'FORM 2','FORM1','','','','NORTH',0),(4470,'VIRGINIA','WANJIKU','NYAMBURA','Female','','','','',0,'',2016,'FORM 2','FORM1','','','','NORTH',0),(4486,'MARY','WANGUI','MWANGI','Female','','','','',0,'',2016,'FORM 2','FORM1','','','','NORTH',0),(4487,'LUCY','NJERI','WANJIRU','Female','','','','',0,'',2016,'FORM 2','FORM1','','','','NORTH',0),(4488,'ISABEL','WAMBUI','CHEGE','Female','','','','',0,'',2016,'FORM 2','FORM1','','','','NORTH',0),(4489,'MARGARET','WAMBUI','WAWERU','Female','','','','',0,'',2016,'FORM 2','FORM1','','','','NORTH',0),(4490,'BRENDA','NJERI','GATHONI','Female','','','','',0,'',2016,'FORM 2','FORM1','','','','NORTH',0),(4491,'SALOME','WANJIKU','WANGARI','Female','','','','',0,'',2016,'FORM 2','FORM1','','','','NORTH',0),(4492,'FARIDA','MUKAMI','NJOKI','Female','','','','',0,'',2016,'FORM 2','FORM1','','','','NORTH',0),(4493,'TERESIA','WANJIRU','MUTHONI','Female','','','','',0,'',2016,'FORM 2','FORM1','','','','NORTH',0),(4494,'MARION','NJERI','LUMWAJI','Female','','','','',0,'',2016,'FORM 2','FORM1','','','','NORTH',0),(4495,'RACHEAL','MUMBI','WANDERI','Female','','','','',0,'',2016,'FORM 2','FORM1','','','','NORTH',0),(4497,'ROSALID','NYAMBURA','NGARI','Female','','','','',0,'',2016,'FORM 2','FORM1','','','','NORTH',0),(4498,'ROSEMARY','NJOKI','ICHUGU','Female','','','','',0,'',2016,'FORM 2','FORM1','','','','NORTH',0),(4499,'SYNTHIA','MUKAMI','MWAURA','Female','','','','',0,'',2016,'FORM 2','FORM1','','','','NORTH',0),(4500,'JACINTA','WANJIKU','WATARI','Female','','','','',0,'',2016,'FORM 2','FORM1','','','','NORTH',0),(4501,'EVA','NYAMBURA','WAIRIMA','Female','','','','',0,'',2016,'FORM 2','FORM1','','','','NORTH',0),(4503,'HANNAH','WATIRI','GATHIMBU','Female','','','','',0,'',2016,'FORM 2','FORM1','','','','NORTH',0),(4504,'HANNAH','WANGARI','NDERITU','Female','','','','',0,'',2016,'FORM 2','FORM1','','','','NORTH',0),(4505,'LINET','WAKONJE','MBARIA','Female','','','','',0,'',2016,'FORM 2','FORM1','','','','NORTH',0),(4506,'CECILIA','WANJIKU','NJOROGE','Female','','','','',0,'',2016,'FORM 2','FORM1','','','','NORTH',0),(4508,'MARY','WAIRIMU','NJERI','Female','','','','',0,'',2016,'FORM 2','FORM1','','','','NORTH',0),(4649,'VEDRO','WAITHIRA','WANJIRU','Female','','','','',0,'',2016,'FORM 2','FORM1','','','','NORTH',0),(4264,'JOAN','WAMBUI','NJIRI','Female','','','','',0,'',2015,'FORM 3','FORM1','','','','WEST',0),(4269,'ELIZABETH','WANGUI','NDUNGU','Female','','','','',0,'',2015,'FORM 3','FORM1','','','','WEST',0),(4271,'MARYANN','NJOKI','NJAGI','Female','','','','',0,'',2015,'FORM 3','FORM1','','','','WEST',0),(4373,'CATHERINE','NYATHIRA','KUNGU','Female','','','','',0,'',2015,'FORM 3','FORM1','','','','WEST',0),(4278,'PURITY','WAIRIMU','MWANGI','Female','','','','',0,'',2015,'FORM 3','FORM1','','','','WEST',0),(4280,'JOSPHINE','WAIRIMU','GITHINJI','Female','','','','',0,'',2015,'FORM 3','FORM1','','','','WEST',0),(4284,'RACHEAL','NJERI','MUKUHA','Female','','','','',0,'',2015,'FORM 3','FORM1','','','','WEST',0),(4285,'PURITY','WACEKE','GITAU','Female','','','','',0,'',2015,'FORM 3','FORM1','','','','WEST',0),(4287,'FAITH','WANJA','MWANGI','Female','','','','',0,'',2015,'FORM 3','FORM1','','','','WEST',0),(4292,'ESTHER','WANJIKU','NDIRANGU','Female','','','','',0,'',2015,'FORM 3','FORM1','','','','WEST',0),(4293,'CATHERINE','MUTHONI','MAINA','Female','','','','',0,'',2015,'FORM 3','FORM1','','','','WEST',0),(4294,'TERESIA','MUKUHI','KARANJA','Female','','','','',0,'',2015,'FORM 3','FORM1','','','','WEST',0),(4295,'MAUREEN','NJERI','MWANGI','Female','','','','',0,'',2015,'FORM 3','FORM1','','','','WEST',0),(4296,'MILLICENT','WANJIRA','KAMAU','Female','','','','',0,'',2015,'FORM 3','FORM1','','','','WEST',0),(4297,'FAITH','WANJIKU','NDUNGU','Female','','','','',0,'',2015,'FORM 3','FORM1','','','','WEST',0),(4298,'HANNAH','WANJA','THUNGU','Female','','','','',0,'',2015,'FORM 3','FORM1','','','','WEST',0),(4304,'JACINTA','NYAMBURA','TITI','Female','','','','',0,'',2015,'FORM 3','FORM1','','','','WEST',0),(4309,'PHYLLIS','WAMBUI','NJOROGE','Female','','','','',0,'',2015,'FORM 3','FORM1','','','','WEST',0),(4311,'VERONICA','WAMBUI','WANJIKU','Female','','','','',0,'',2015,'FORM 3','FORM1','','','','WEST',0),(4315,'EVALYNE','WANJIRA','KIMANI','Female','','','','',0,'',2015,'FORM 3','FORM1','','','','WEST',0),(4317,'ANN','WANJIRU','MBUTHIA','Female','','','','',0,'',2015,'FORM 3','FORM1','','','','WEST',0),(4321,'OLIVE','MUTETE','GITHAIGA','Female','','','','',0,'',2015,'FORM 3','FORM1','','','','WEST',0),(4322,'RUTH','WANJIKU','KAMAU','Female','','','','',0,'',2015,'FORM 3','FORM1','','','','WEST',0),(4323,'PURITY','WANJIKU','NJOROGE','Female','','','','',0,'',2015,'FORM 3','FORM1','','','','WEST',0),(4326,'GLADYS','NYOKABI','GITAU','Female','','','','',0,'',2015,'FORM 3','FORM1','','','','WEST',0),(4328,'MERCY','WANJIRU','KAMAU','Female','','','','',0,'',2015,'FORM 3','FORM1','','','','WEST',0),(4329,'MONICA','WANJIRU','MUGO','Female','','','','',0,'',2015,'FORM 3','FORM1','','','','WEST',0),(4332,'EVALYNE','WACERA','MUNIU','Female','','','','',0,'',2015,'FORM 3','FORM1','','','','WEST',0),(4333,'TABITHA','NJOKI','MAINA','Female','','','','',0,'',2015,'FORM 3','FORM1','','','','WEST',0),(4334,'MONICA','WANYORA','KIMANI','Female','','','','',0,'',2015,'FORM 3','FORM1','','','','WEST',0),(4337,'HANNAH','NJOKI','GITHIU','Female','','','','',0,'',2015,'FORM 3','FORM1','','','','WEST',0),(4338,'MONICAH','MUTHONI','MUNYUA','Female','','','','',0,'',2015,'FORM 3','FORM1','','','','WEST',0),(4342,'ANN','WAIRIMU','NDUNGU','Female','','','','',0,'',2015,'FORM 3','FORM1','','','','WEST',0),(4343,'EURNAH','NJERI','SOPHIA','Female','','','','',0,'',2015,'FORM 3','FORM1','','','','WEST',0),(4345,'BEATRICE','WAMBUI','NGANGA','Female','','','','',0,'',2015,'FORM 3','FORM1','','','','WEST',0),(4347,'MERCY','WANJA','MUCHUGA','Female','','','','',0,'',2015,'FORM 3','FORM1','','','','WEST',0),(4351,'HANNAH','NJOKI','THOTHO','Female','','','','',0,'',2015,'FORM 3','FORM1','','','','WEST',0),(4353,'MARGARET','NYAMBURA','MUMBI','Female','','','','',0,'',2015,'FORM 3','FORM1','','','','WEST',0),(4359,'BRIDGET','WAITHIRA','GITAU','Female','','','','',0,'',2015,'FORM 3','FORM1','','','','WEST',0),(4362,'ELIZABETH','WANJA','NUGI','Female','','','','',0,'',2015,'FORM 3','FORM1','','','','WEST',0),(4363,'MARYANN','NJERI','KABATI','Female','','','','',0,'',2015,'FORM 3','FORM1','','','','WEST',0),(4368,'ANGELA','WAIHIGA','GITHAE','Female','','','','',0,'',2015,'FORM 3','FORM1','','','','WEST',0),(4375,'MAUREEN','WANJIKU','NGUGI','Female','','','','',0,'',2015,'FORM 3','FORM1','','','','WEST',0),(4377,'CATHERINE','NJERI','KARIUKI','Female','','','','',0,'',2015,'FORM 3','FORM1','','','','WEST',0),(4622,'MERCY','NJERI','NDUTA','Female','','','','',0,'',2015,'FORM 3','FORM1','','','','WEST',0),(4205,'IMMACULATE','NJERI','NGUYAI','Female','','','','',0,'',2015,'FORM 3','FORM1','','','','EAST',0),(4267,'PURITY','WAITUHA','CHEGE','Female','','','','',0,'',2015,'FORM 3','FORM1','','','','EAST',0),(4272,'JOYCE','NJERI','KARIUKI','Female','','','','',0,'',2015,'FORM 3','FORM1','','','','EAST',0),(4274,'FIDELIA','ACHIENG','ONYANGO','Female','','','','',0,'',2015,'FORM 3','FORM1','','','','EAST',0),(4275,'LILIAN','NJERI','KARIUKI','Female','','','','',0,'',2015,'FORM 3','FORM1','','','','EAST',0),(4276,'TERESIA','NJERI','MUTURI','Female','','','','',0,'',2015,'FORM 3','FORM1','','','','EAST',0),(4277,'MOUREEN','WANGU','NJERI','Female','','','','',0,'',2015,'FORM 3','FORM1','','','','EAST',0),(4281,'LISA','NYAWIRA','WACERA','Female','','','','',0,'',2015,'FORM 3','FORM1','','','','EAST',0),(4282,'ESTHER','WANGECHI','NGECHU','Female','','','','',0,'',2015,'FORM 3','FORM1','','','','EAST',0),(4283,'ANN','NJERI','WAIRIMU','Female','','','','',0,'',2015,'FORM 3','FORM1','','','','EAST',0),(4286,'PURITY','WAMBUI','NDUNGU','Female','','','','',0,'',2015,'FORM 3','FORM1','','','','EAST',0),(4288,'FLORENCE','NJERI','IRUNGU','Female','','','','',0,'',2015,'FORM 3','FORM1','','','','EAST',0),(4289,'JACKLINE','WAMBUI','KAGURU','Female','','','','',0,'',2015,'FORM 3','FORM1','','','','EAST',0),(4290,'AGNES','WACEKE','KIOMOH','Female','','','','',0,'',2015,'FORM 3','FORM1','','','','EAST',0),(4299,'BETH','WAMBUI','KIMANI','Female','','','','',0,'',2015,'FORM 3','FORM1','','','','EAST',0),(4300,'RUTH','WANJERI','MWAI','Female','','','','',0,'',2015,'FORM 3','FORM1','','','','EAST',0),(4301,'ANGELA','WAMBUI','KUNGU','Female','','','','',0,'',2015,'FORM 3','FORM1','','','','EAST',0),(4302,'JOAN','NYAMBURA','MUNYUA','Female','','','','',0,'',2015,'FORM 3','FORM1','','','','EAST',0),(4303,'LUCY','NJERI','THIGA','Female','','','','',0,'',2015,'FORM 3','FORM1','','','','EAST',0),(4306,'ROSE','NDUTA','WAWERU','Female','','','','',0,'',2015,'FORM 3','FORM1','','','','EAST',0),(4312,'GRACE','NYOKABI','WANJIKU','Female','','','','',0,'',2015,'FORM 3','FORM1','','','','EAST',0),(4313,'IRENE','NUNGARI','GICHARU','Female','','','','',0,'',2015,'FORM 3','FORM1','','','','EAST',0),(4314,'JOAN','WANGARI','KARIUKI','Female','','','','',0,'',2015,'FORM 3','FORM1','','','','EAST',0),(4318,'ESTHER','NJERI','WAMBUI','Female','','','','',0,'',2015,'FORM 3','FORM1','','','','EAST',0),(4319,'TABITHA','NJOKI','MWIGANI','Female','','','','',0,'',2015,'FORM 3','FORM1','','','','EAST',0),(4320,'CATHERINE','NJAMBI','NDUNGU','Female','','','','',0,'',2015,'FORM 3','FORM1','','','','EAST',0),(4324,'LENNAH','NYAKIO','KANGANGI','Female','','','','',0,'',2015,'FORM 3','FORM1','','','','EAST',0),(4327,'ANN','NJERI','KARITA','Female','','','','',0,'',2015,'FORM 3','FORM1','','','','EAST',0),(4330,'ESTHER','MUTHONI','MUGO','Female','','','','',0,'',2015,'FORM 3','FORM1','','','','EAST',0),(4335,'ROSEMARY','WANJIKU','MUIRURI','Female','','','','',0,'',2015,'FORM 3','FORM1','','','','EAST',0),(4336,'STELLA','NJERI','GICHICHIO','Female','','','','',0,'',2015,'FORM 3','FORM1','','','','EAST',0),(4339,'MARGARET','WANGARI','KIGIO','Female','','','','',0,'',2015,'FORM 3','FORM1','','','','EAST',0),(4340,'SILVIA','SALLY','MUTHONI','Female','','','','',0,'',2015,'FORM 3','FORM1','','','','EAST',0),(4341,'FERISTAS','NDUTA','NJOROGE','Female','','','','',0,'',2015,'FORM 3','FORM1','','','','EAST',0),(4346,'CAROL','NJOKI','NJOROGE','Female','','','','',0,'',2015,'FORM 3','FORM1','','','','EAST',0),(4348,'CATHERINE','WANGUI','KAGOMBE','Female','','','','',0,'',2015,'FORM 3','FORM1','','','','EAST',0),(4352,'IVY','WATHIRA','MIRONGA','Female','','','','',0,'',2015,'FORM 3','FORM1','','','','EAST',0),(4356,'SUSAN','NYAMBURA','KARIUKI','Female','','','','',0,'',2015,'FORM 3','FORM1','','','','EAST',0),(4358,'JOAN','WANJIRU','WANJIKU','Female','','','','',0,'',2015,'FORM 3','FORM1','','','','EAST',0),(4360,'IRENE','CHEPKIRUI','KIPKOECH','Female','','','','',0,'',2015,'FORM 3','FORM1','','','','EAST',0),(4361,'SARAH','MUANA','MUSYA','Female','','','','',0,'',2015,'FORM 3','FORM1','','','','EAST',0),(4365,'VIRGINIA','WANJIRU','KINYANJUI','Female','','','','',0,'',2015,'FORM 3','FORM1','','','','EAST',0),(4366,'LILIAN','MUTHONI','WANGOME','Female','','','','',0,'',2015,'FORM 3','FORM1','','','','EAST',0),(4370,'RUTH','NYAMBURA','KAMAU','Female','','','','',0,'',2015,'FORM 3','FORM1','','','','EAST',0),(4374,'LEAH','WANJIKU','KINGORI','Female','','','','',0,'',2015,'FORM 3','FORM1','','','','EAST',0),(4141,'ELIZABETH','NJERI','MAINA','Female','','','','',0,'',2014,'FORM 4','FORM1','','','','WEST',0),(4142,'LUCY','WAHU','KAHIA','Female','','','','',0,'',2014,'FORM 4','FORM1','','','','WEST',0),(4143,'MARGARET','MUGURE','KARA','Female','','','','',0,'',2014,'FORM 4','FORM1','','','','WEST',0),(4144,'ESTHER','MUTHONI','KAARA','Female','','','','',0,'',2014,'FORM 4','FORM1','','','','WEST',0),(4146,'PRISCILLAH','NYAMBURA','GICHUI','Female','','','','',0,'',2014,'FORM 4','FORM1','','','','WEST',0),(4148,'SARAH','NJERI','MUTURI','Female','','','','',0,'',2014,'FORM 4','FORM1','','','','WEST',0),(4154,'NANCY','WANJIRU','NJOKI','Female','','','','',0,'',2014,'FORM 4','FORM1','','','','WEST',0),(4158,'MARY','WAITHIRA','KAMAU','Female','','','','',0,'',2014,'FORM 4','FORM1','','','','WEST',0),(4160,'TERESIA','MUTHONI','GACHERU','Female','','','','',0,'',2014,'FORM 4','FORM1','','','','WEST',0),(4162,'CATHERINE','WAMUTHITHI','NGANGA','Female','','','','',0,'',2014,'FORM 4','FORM1','','','','WEST',0),(4164,'NELIAS','WANJA','KAMAU','Female','','','','',0,'',2014,'FORM 4','FORM1','','','','WEST',0),(4167,'FAITH','NJERI','MURAGURI','Female','','','','',0,'',2014,'FORM 4','FORM1','','','','WEST',0),(4171,'MARY','WANJIKU','KANYO','Female','','','','',0,'',2014,'FORM 4','FORM1','','','','WEST',0),(4173,'MERCY','NJERI','KURIA','Female','','','','',0,'',2014,'FORM 4','FORM1','','','','WEST',0),(4179,'REGINA','WAMAITHA','MATU','Female','','','','',0,'',2014,'FORM 4','FORM1','','','','WEST',0),(4182,'ESTHER','WANJIKU','WAIHIGA','Female','','','','',0,'',2014,'FORM 4','FORM1','','','','WEST',0),(4187,'MARY','WAMBUI','MUROGO','Female','','','','',0,'',2014,'FORM 4','FORM1','','','','WEST',0),(4188,'EVELYNE','NJUHI','KAMAU','Female','','','','',0,'',2014,'FORM 4','FORM1','','','','WEST',0),(4193,'EUNICE','NJOKI','GIKONYO','Female','','','','',0,'',2014,'FORM 4','FORM1','','','','WEST',0),(4195,'LEAH','WANJIKU','KIMANI','Female','','','','',0,'',2014,'FORM 4','FORM1','','','','WEST',0),(4203,'DIANAH','WANJIRU','KUNGU','Female','','','','',0,'',2014,'FORM 4','FORM1','','','','WEST',0),(4208,'IRENE','WANJIRU','KIBUI','Female','','','','',0,'',2014,'FORM 4','FORM1','','','','WEST',0),(4209,'EDEL','QUIN','NYAKIO NGURE','Female','','','','',0,'',2014,'FORM 4','FORM1','','','','WEST',0),(4212,'AGNES','WANGARI','NDABI','Female','','','','',0,'',2014,'FORM 4','FORM1','','','','WEST',0),(4216,'ANN','WAIRIMU','MURIGI','Female','','','','',0,'',2014,'FORM 4','FORM1','','','','WEST',0),(4228,'JOYCE','WARINGA','GICHERU','Female','','','','',0,'',2014,'FORM 4','FORM1','','','','WEST',0),(4229,'GLADYS','WANGUI','NJERI','Female','','','','',0,'',2014,'FORM 4','FORM1','','','','WEST',0),(4231,'MARGARET','WANJIRU','NJUGUNA','Female','','','','',0,'',2014,'FORM 4','FORM1','','','','WEST',0),(4237,'SUSAN','WANJIRU','NJOROGE','Female','','','','',0,'',2014,'FORM 4','FORM1','','','','WEST',0),(4241,'LUCY','WAMBUI','KIRANGI','Female','','','','',0,'',2014,'FORM 4','FORM1','','','','WEST',0),(4252,'LUCY','WAITHIRA','WANJIKU','Female','','','','',0,'',2014,'FORM 4','FORM1','','','','WEST',0),(4255,'GRACE','NJOKI','WAMBUI','Female','','','','',0,'',2014,'FORM 4','FORM1','','','','WEST',0),(4258,'HOTTENSIA','WANJIKU','KURIA','Female','','','','',0,'',2014,'FORM 4','FORM1','','','','WEST',0),(4259,'JANE','NJERI','NJAU','Female','','','','',0,'',2014,'FORM 4','FORM1','','','','WEST',0),(4262,'PURITY','WAIRIMU','MUIRURI','Female','','','','',0,'',2014,'FORM 4','FORM1','','','','WEST',0),(4372,'PHILOMENA','NJERI','KAMAU','Female','','','','',0,'',2014,'FORM 4','FORM1','','','','WEST',0),(4371,'JOAN','NJOKI','GATHUITA','Female','','','','',0,'',2014,'FORM 4','FORM1','','','','WEST',0),(4634,'VIRGINIA','NJERI','NGUGI','Female','','','','',0,'',2014,'FORM 4','FORM1','','','','WEST',0),(4221,'ANGELA','MUGURE','NGUGI','Female','','','','',0,'',2014,'FORM 4','FORM1','','','','EAST',0),(4218,'FAIZA','WAMBUI','NJERI','Female','','','','',0,'',2014,'FORM 4','FORM1','','','','EAST',0),(4213,'PAULINE','WAIRIMU','NJOROGE','Female','','','','',0,'',2014,'FORM 4','FORM1','','','','EAST',0),(4210,'MAUREEN','WANJIRU','KURIA','Female','','','','',0,'',2014,'FORM 4','FORM1','','','','EAST',0),(4207,'JANE','WAMBUI','NJIHIA','Female','','','','',0,'',2014,'FORM 4','FORM1','','','','EAST',0),(4204,'RUTH','NYAMBURA','GITAU','Female','','','','',0,'',2014,'FORM 4','FORM1','','','','EAST',0),(4202,'WINFRED','NJOKI','KANGETHE','Female','','','','',0,'',2014,'FORM 4','FORM1','','','','EAST',0),(4200,'JESSICA','MUTHONI','MUGURU','Female','','','','',0,'',2014,'FORM 4','FORM1','','','','EAST',0),(4199,'PAULINE','NDUTA','MUIGAI','Female','','','','',0,'',2014,'FORM 4','FORM1','','','','EAST',0),(4194,'CATHERINE','WANJIRU','MBURU','Female','','','','',0,'',2014,'FORM 4','FORM1','','','','EAST',0),(4190,'NAOMI','NJERI','KIRAGU','Female','','','','',0,'',2014,'FORM 4','FORM1','','','','EAST',0),(4186,'SHARON','MRIGU','NYAGA','Female','','','','',0,'',2014,'FORM 4','FORM1','','','','EAST',0),(4183,'FELISTAS','WAITHIRA','NJUGUNA','Female','','','','',0,'',2014,'FORM 4','FORM1','','','','EAST',0),(4180,'ROSELYN','NJOKI','KIHUGU','Female','','','','',0,'',2014,'FORM 4','FORM1','','','','EAST',0),(4176,'BETH','WANJIRU','MWANGI','Female','','','','',0,'',2014,'FORM 4','FORM1','','','','EAST',0),(4175,'MERCY','MUTHONI','NDUNGU','Female','','','','',0,'',2014,'FORM 4','FORM1','','','','EAST',0),(4172,'PURITY','MUTHONI','KIBUNJA','Female','','','','',0,'',2014,'FORM 4','FORM1','','','','EAST',0),(4159,'CAROLINE','NJOKI','MUIRURI','Female','','','','',0,'',2014,'FORM 4','FORM1','','','','EAST',0),(4157,'MARY','WANJIRU','WAINAINA','Female','','','','',0,'',2014,'FORM 4','FORM1','','','','EAST',0),(4155,'MARGARET','WANGUI','RUTHI','Female','','','','',0,'',2014,'FORM 4','FORM1','','','','EAST',0),(4152,'MERCY','WANGARI','WANJIRU','Female','','','','',0,'',2014,'FORM 4','FORM1','','','','EAST',0),(4149,'MAUREEN','NYAMBURA','MUGO','Female','','','','',0,'',2014,'FORM 4','FORM1','','','','EAST',0),(4140,'ANNET','MUTHONI','NGUGI','Female','','','','',0,'',2014,'FORM 4','FORM1','','','','EAST',0),(4139,'PRISCILLAH','NYAMBURA','MWANGI','Female','','','','',0,'',2014,'FORM 4','FORM1','','','','EAST',0),(4134,'TERESIAH','NJERE','KAMAU','Female','','','','',0,'',2014,'FORM 4','FORM1','','','','EAST',0),(4223,'EMMAH','MWIHAKI','MEMIA','Female','','','','',0,'',2014,'FORM 4','FORM1','','','','EAST',0),(4224,'IMMACULATE','NYAMBURA','MAINA','Female','','','','',0,'',2014,'FORM 4','FORM1','','','','EAST',0),(4226,'APOLINE','MUGURE','GITUYU','Female','','','','',0,'',2014,'FORM 4','FORM1','','','','EAST',0),(4230,'SALOME','WAMBUI','GITAU','Female','','','','',0,'',2014,'FORM 4','FORM1','','','','EAST',0),(4232,'MERCY','NERI','WAMWEA','Female','','','','',0,'',2014,'FORM 4','FORM1','','','','EAST',0),(4233,'PAULET','WANJIKU','KINYANJUI','Female','','','','',0,'',2014,'FORM 4','FORM1','','','','EAST',0),(4234,'GLADYS','NDUTA','MUYA','Female','','','','',0,'',2014,'FORM 4','FORM1','','','','EAST',0),(4235,'VERONICA','NJERI','WANJIRU','Female','','','','',0,'',2014,'FORM 4','FORM1','','','','EAST',0),(4236,'JACKLINE','WANJIRU','GICHIA','Female','','','','',0,'',2014,'FORM 4','FORM1','','','','EAST',0),(4238,'MARGARET','RUGURU','MIRINGU','Female','','','','',0,'',2014,'FORM 4','FORM1','','','','EAST',0),(4247,'WINNIE','MUTHONI','IRUNGU','Female','','','','',0,'',2014,'FORM 4','FORM1','','','','EAST',0),(4249,'ESTHER','WANJA','GACHUNGA','Female','','','','',0,'',2014,'FORM 4','FORM1','','','','EAST',0),(4253,'MARGARET','NYOKABI','BORO','Female','','','','',0,'',2014,'FORM 4','FORM1','','','','EAST',0),(4629,'ESTHER','WANJIKU','WAMBUI','Female','','','','',0,'',2014,'FORM 4','FORM1','','','','EAST',0),(4136,'CHRISTINE','MUMBI','NGANGA','Female','','','','',0,'',2014,'FORM 4','FORM1','','','','NORTH',0),(4137,'MARY','WANJIRU','NGUGI','Female','','','','',0,'',2014,'FORM 4','FORM1','','','','NORTH',0),(4145,'JANE','WANJIKU','KAMAU','Female','','','','',0,'',2014,'FORM 4','FORM1','','','','NORTH',0),(4150,'HELLEN','WAITHIRA','MUNGAI','Female','','','','',0,'',2014,'FORM 4','FORM1','','','','NORTH',0),(4151,'NAOMI','WANGARI','KAMAU','Female','','','','',0,'',2014,'FORM 4','FORM1','','','','NORTH',0),(4153,'JULIA','WANJIRU','MBORO','Female','','','','',0,'',2014,'FORM 4','FORM1','','','','NORTH',0),(4161,'MARY','NJOKI','NGANGA','Female','','','','',0,'',2014,'FORM 4','FORM1','','','','NORTH',0),(4163,'SERAH','NJERI','MUTHONI','Female','','','','',0,'',2014,'FORM 4','FORM1','','','','NORTH',0),(4165,'JENNIFFER','WANJIRU','MANG’EERE','Female','','','','',0,'',2014,'FORM 4','FORM1','','','','NORTH',0),(4166,'LINET','ADHIAMBO','OCHIENG','Female','','','','',0,'',2014,'FORM 4','FORM1','','','','NORTH',0),(4168,'JANE','MUGURE','WAMBUI','Female','','','','',0,'',2014,'FORM 4','FORM1','','','','NORTH',0),(4170,'MARY','WAMBUI','KARANJA','Female','','','','',0,'',2014,'FORM 4','FORM1','','','','NORTH',0),(4174,'STELLAH','WANJIKU','KAMAU','Female','','','','',0,'',2014,'FORM 4','FORM1','','','','NORTH',0),(4177,'LYDIA','WANGARI','KAMAU','Female','','','','',0,'',2014,'FORM 4','FORM1','','','','NORTH',0),(4181,'JANET','NJOKI','KARIUKI','Female','','','','',0,'',2014,'FORM 4','FORM1','','','','NORTH',0),(4184,'MARYANN','MWIHAKI','NJERI','Female','','','','',0,'',2014,'FORM 4','FORM1','','','','NORTH',0),(4189,'MAUREEN','MUTHONI','WANJIRU','Female','','','','',0,'',2014,'FORM 4','FORM1','','','','NORTH',0),(4191,'ANASTACIA','WAMORO','NJOROGE','Female','','','','',0,'',2014,'FORM 4','FORM1','','','','NORTH',0),(4196,'TERESIA','WANJIRU','WAIRIMU','Female','','','','',0,'',2014,'FORM 4','FORM1','','','','NORTH',0),(4197,'DIANA','WANJIRA','KABOGO','Female','','','','',0,'',2014,'FORM 4','FORM1','','','','NORTH',0),(4198,'MARGARET','WANJIKU','CHEGE','Female','','','','',0,'',2014,'FORM 4','FORM1','','','','NORTH',0),(4206,'MARY','WANJIKU','KIMANI','Female','','','','',0,'',2014,'FORM 4','FORM1','','','','NORTH',0),(4211,'JULIA','WAMBUI','NJOROGE','Female','','','','',0,'',2014,'FORM 4','FORM1','','','','NORTH',0),(4214,'ELIZABETH','NJAMBI','WAINAINA','Female','','','','',0,'',2014,'FORM 4','FORM1','','','','NORTH',0),(4215,'RACHEAL','GATHONI','MWANGI','Female','','','','',0,'',2014,'FORM 4','FORM1','','','','NORTH',0),(4220,'MARY','WAIRIMU','THUKU','Female','','','','',0,'',2014,'FORM 4','FORM1','','','','NORTH',0),(4222,'HILDER','NJERI','WAIRIMU','Female','','','','',0,'',2014,'FORM 4','FORM1','','','','NORTH',0),(4225,'MAGDALINE','WANGARI','MBUTHIA','Female','','','','',0,'',2014,'FORM 4','FORM1','','','','NORTH',0),(4240,'ROSEMARY','WANJIRU','WANJIKU','Female','','','','',0,'',2014,'FORM 4','FORM1','','','','NORTH',0),(4245,'PAULINE','KAGENDO','MUREITHI','Female','','','','',0,'',2014,'FORM 4','FORM1','','','','NORTH',0),(4248,'LYDIA','SHIYAYO','MUHIA','Female','','','','',0,'',2014,'FORM 4','FORM1','','','','NORTH',0),(4251,'MARY','WANJIRU','KAHIA','Female','','','','',0,'',2014,'FORM 4','FORM1','','','','NORTH',0),(4256,'MARION','MUTHINI','MUMO','Female','','','','',0,'',2014,'FORM 4','FORM1','','','','NORTH',0),(4261,'CATHERINE','WAIRIMU','GIKANG&A','Female','','','','',0,'',2014,'FORM 4','FORM1','','','','NORTH',0),(4507,'SERAH','NJERI','MWANIKI','Female','','','','',0,'',2014,'FORM 4','FORM1','','','','NORTH',0);
UNLOCK TABLES;
/*!40000 ALTER TABLE `studentdetails` ENABLE KEYS */;

--
-- Table structure for table `students_log`
--

DROP TABLE IF EXISTS `students_log`;
CREATE TABLE `students_log` (
  `admno` varchar(200) NOT NULL default '',
  `year` int(4) NOT NULL default '0',
  `form` varchar(100) NOT NULL default '',
  PRIMARY KEY  (`admno`,`year`,`form`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `students_log`
--


/*!40000 ALTER TABLE `students_log` DISABLE KEYS */;
LOCK TABLES `students_log` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `students_log` ENABLE KEYS */;

--
-- Table structure for table `subjects`
--

DROP TABLE IF EXISTS `subjects`;
CREATE TABLE `subjects` (
  `subject` varchar(100) NOT NULL,
  PRIMARY KEY  (`subject`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subjects`
--


/*!40000 ALTER TABLE `subjects` DISABLE KEYS */;
LOCK TABLES `subjects` WRITE;
INSERT INTO `subjects` VALUES ('kiswahili');
UNLOCK TABLES;
/*!40000 ALTER TABLE `subjects` ENABLE KEYS */;

--
-- Table structure for table `subjectsforstudent`
--

DROP TABLE IF EXISTS `subjectsforstudent`;
CREATE TABLE `subjectsforstudent` (
  `admno` varchar(100) NOT NULL,
  `subjects` int(10) NOT NULL,
  `Form` varchar(100) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `mname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `religion` varchar(100) NOT NULL,
  `year` int(100) NOT NULL,
  `term` int(100) NOT NULL,
  PRIMARY KEY  (`admno`,`Form`,`year`,`term`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subjectsforstudent`
--


/*!40000 ALTER TABLE `subjectsforstudent` DISABLE KEYS */;
LOCK TABLES `subjectsforstudent` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `subjectsforstudent` ENABLE KEYS */;

--
-- Table structure for table `suppliers`
--

DROP TABLE IF EXISTS `suppliers`;
CREATE TABLE `suppliers` (
  `supplier` varchar(100) NOT NULL default '',
  `pin` varchar(100) NOT NULL default '',
  `address` text NOT NULL,
  `telephone` int(15) NOT NULL,
  `email` varchar(100) NOT NULL default '',
  PRIMARY KEY  (`supplier`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `suppliers`
--


/*!40000 ALTER TABLE `suppliers` DISABLE KEYS */;
LOCK TABLES `suppliers` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `suppliers` ENABLE KEYS */;

--
-- Table structure for table `tbl_hr_krapaye`
--

DROP TABLE IF EXISTS `tbl_hr_krapaye`;
CREATE TABLE `tbl_hr_krapaye` (
  `minv` decimal(18,2) NOT NULL default '0.00',
  `maxv` decimal(18,2) NOT NULL default '0.00',
  `tax` decimal(18,2) default '0.00',
  PRIMARY KEY  (`minv`,`maxv`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_hr_krapaye`
--


/*!40000 ALTER TABLE `tbl_hr_krapaye` DISABLE KEYS */;
LOCK TABLES `tbl_hr_krapaye` WRITE;
INSERT INTO `tbl_hr_krapaye` VALUES ('0.00','10164.00','10.00'),('10165.00','19740.00','15.00'),('19741.00','29316.00','20.00'),('29317.00','38892.00','25.00'),('38892.00','100000000.00','30.00');
UNLOCK TABLES;
/*!40000 ALTER TABLE `tbl_hr_krapaye` ENABLE KEYS */;

--
-- Table structure for table `tbl_hr_loans`
--

DROP TABLE IF EXISTS `tbl_hr_loans`;
CREATE TABLE `tbl_hr_loans` (
  `name` varchar(100) NOT NULL,
  `deduction_amount` decimal(18,2) default '0.00',
  `applies_to` varchar(100) NOT NULL default '',
  PRIMARY KEY  (`name`,`applies_to`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_hr_loans`
--


/*!40000 ALTER TABLE `tbl_hr_loans` DISABLE KEYS */;
LOCK TABLES `tbl_hr_loans` WRITE;
INSERT INTO `tbl_hr_loans` VALUES ('SACCO','0.00','11054704');
UNLOCK TABLES;
/*!40000 ALTER TABLE `tbl_hr_loans` ENABLE KEYS */;

--
-- Table structure for table `tbl_hr_nhif`
--

DROP TABLE IF EXISTS `tbl_hr_nhif`;
CREATE TABLE `tbl_hr_nhif` (
  `minv` decimal(18,2) NOT NULL default '0.00',
  `maxv` decimal(18,2) NOT NULL default '0.00',
  `amount` decimal(18,2) default '0.00',
  `percent` decimal(18,2) default '0.00',
  PRIMARY KEY  (`minv`,`maxv`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_hr_nhif`
--


/*!40000 ALTER TABLE `tbl_hr_nhif` DISABLE KEYS */;
LOCK TABLES `tbl_hr_nhif` WRITE;
INSERT INTO `tbl_hr_nhif` VALUES ('0.00','5999.00','150.00','0.00'),('6000.00','7999.00','300.00','0.00'),('8000.00','11999.00','400.00','0.00'),('12000.00','14999.00','500.00','0.00'),('15000.00','19999.00','600.00','0.00'),('20000.00','24999.00','750.00','0.00'),('25000.00','29999.00','850.00','0.00'),('30000.00','34999.00','900.00','0.00'),('35000.00','39999.00','950.00','0.00'),('40000.00','44999.00','1000.00','0.00'),('45000.00','49999.00','1100.00','0.00'),('50000.00','59999.00','1200.00','0.00'),('60000.00','69999.00','1300.00','0.00'),('70000.00','79999.00','1400.00','0.00'),('80000.00','89999.00','1500.00','0.00'),('90000.00','99999.00','1600.00','0.00'),('100000.00','1000000.00','1700.00','0.00');
UNLOCK TABLES;
/*!40000 ALTER TABLE `tbl_hr_nhif` ENABLE KEYS */;

--
-- Table structure for table `tbl_hr_nhif_old`
--

DROP TABLE IF EXISTS `tbl_hr_nhif_old`;
CREATE TABLE `tbl_hr_nhif_old` (
  `minv` decimal(18,2) NOT NULL default '0.00',
  `maxv` decimal(18,2) NOT NULL default '0.00',
  `amount` decimal(18,2) default '0.00',
  `percent` decimal(18,2) default '0.00',
  PRIMARY KEY  (`minv`,`maxv`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_hr_nhif_old`
--


/*!40000 ALTER TABLE `tbl_hr_nhif_old` DISABLE KEYS */;
LOCK TABLES `tbl_hr_nhif_old` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `tbl_hr_nhif_old` ENABLE KEYS */;

--
-- Table structure for table `tbl_hr_nssf`
--

DROP TABLE IF EXISTS `tbl_hr_nssf`;
CREATE TABLE `tbl_hr_nssf` (
  `minv` decimal(18,2) NOT NULL default '0.00',
  `maxv` decimal(18,2) NOT NULL default '0.00',
  `amount` decimal(18,2) default '0.00',
  `percent` decimal(18,2) default '0.00',
  PRIMARY KEY  (`minv`,`maxv`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_hr_nssf`
--


/*!40000 ALTER TABLE `tbl_hr_nssf` DISABLE KEYS */;
LOCK TABLES `tbl_hr_nssf` WRITE;
INSERT INTO `tbl_hr_nssf` VALUES ('0.00','6000.00','0.00','6.00'),('6001.00','18000.00','0.00','6.00'),('18001.00','1000000.00','18000.00','6.00');
UNLOCK TABLES;
/*!40000 ALTER TABLE `tbl_hr_nssf` ENABLE KEYS */;

--
-- Table structure for table `tbl_hr_nssf_old`
--

DROP TABLE IF EXISTS `tbl_hr_nssf_old`;
CREATE TABLE `tbl_hr_nssf_old` (
  `minv` decimal(18,2) NOT NULL default '0.00',
  `maxv` decimal(18,2) NOT NULL default '0.00',
  `amount` decimal(18,2) default '0.00',
  `percent` decimal(18,2) default '0.00',
  PRIMARY KEY  (`minv`,`maxv`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_hr_nssf_old`
--


/*!40000 ALTER TABLE `tbl_hr_nssf_old` DISABLE KEYS */;
LOCK TABLES `tbl_hr_nssf_old` WRITE;
INSERT INTO `tbl_hr_nssf_old` VALUES ('1000.00','1000000.00','200.00','0.00');
UNLOCK TABLES;
/*!40000 ALTER TABLE `tbl_hr_nssf_old` ENABLE KEYS */;

--
-- Table structure for table `tbl_hr_payslips`
--

DROP TABLE IF EXISTS `tbl_hr_payslips`;
CREATE TABLE `tbl_hr_payslips` (
  `staff_ref` varchar(100) NOT NULL,
  `basic` decimal(18,2) default '0.00',
  `nhif` decimal(18,2) default '0.00',
  `nssf` decimal(18,2) default '0.00',
  `paye` decimal(18,2) default '0.00',
  `netpay` decimal(18,2) default '0.00',
  `date_ref` varchar(100) default NULL,
  `month_ref` varchar(100) NOT NULL,
  `payrollref` varchar(100) NOT NULL,
  PRIMARY KEY  (`staff_ref`,`month_ref`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_hr_payslips`
--


/*!40000 ALTER TABLE `tbl_hr_payslips` DISABLE KEYS */;
LOCK TABLES `tbl_hr_payslips` WRITE;
INSERT INTO `tbl_hr_payslips` VALUES ('11054704','30000.00','900.00','1080.00','2859.30','20160.70','2017-11-22','November 2017','20171122110634');
UNLOCK TABLES;
/*!40000 ALTER TABLE `tbl_hr_payslips` ENABLE KEYS */;

--
-- Table structure for table `tbl_hr_payslips_all`
--

DROP TABLE IF EXISTS `tbl_hr_payslips_all`;
CREATE TABLE `tbl_hr_payslips_all` (
  `staff_ref` varchar(100) NOT NULL,
  `allowance_name` varchar(100) NOT NULL,
  `allowance` decimal(18,2) default '0.00',
  `month_ref` varchar(100) NOT NULL,
  `payrollref` varchar(100) NOT NULL,
  PRIMARY KEY  (`staff_ref`,`allowance_name`,`month_ref`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_hr_payslips_all`
--


/*!40000 ALTER TABLE `tbl_hr_payslips_all` DISABLE KEYS */;
LOCK TABLES `tbl_hr_payslips_all` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `tbl_hr_payslips_all` ENABLE KEYS */;

--
-- Table structure for table `tbl_hr_payslips_ded`
--

DROP TABLE IF EXISTS `tbl_hr_payslips_ded`;
CREATE TABLE `tbl_hr_payslips_ded` (
  `staff_ref` varchar(100) NOT NULL,
  `deduction_name` varchar(100) NOT NULL,
  `deduction` decimal(18,2) default '0.00',
  `month_ref` varchar(100) NOT NULL,
  `payrollref` varchar(100) NOT NULL,
  PRIMARY KEY  (`staff_ref`,`deduction_name`,`month_ref`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_hr_payslips_ded`
--


/*!40000 ALTER TABLE `tbl_hr_payslips_ded` DISABLE KEYS */;
LOCK TABLES `tbl_hr_payslips_ded` WRITE;
INSERT INTO `tbl_hr_payslips_ded` VALUES ('11054704','SACCO','5000.00','2017-11-22','20171122110634');
UNLOCK TABLES;
/*!40000 ALTER TABLE `tbl_hr_payslips_ded` ENABLE KEYS */;

--
-- Table structure for table `tbl_hr_payslips_reliefs`
--

DROP TABLE IF EXISTS `tbl_hr_payslips_reliefs`;
CREATE TABLE `tbl_hr_payslips_reliefs` (
  `staff_ref` varchar(100) NOT NULL default '',
  `relief_name` varchar(100) NOT NULL default '',
  `relief` decimal(18,2) default '0.00',
  `month_ref` varchar(100) NOT NULL default '',
  `payrollref` varchar(100) default NULL,
  PRIMARY KEY  (`staff_ref`,`relief_name`,`month_ref`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_hr_payslips_reliefs`
--


/*!40000 ALTER TABLE `tbl_hr_payslips_reliefs` DISABLE KEYS */;
LOCK TABLES `tbl_hr_payslips_reliefs` WRITE;
INSERT INTO `tbl_hr_payslips_reliefs` VALUES ('11054704','Personal Tax Relief','1280.00','2017-11-22','20171122110634');
UNLOCK TABLES;
/*!40000 ALTER TABLE `tbl_hr_payslips_reliefs` ENABLE KEYS */;

--
-- Table structure for table `tbl_hr_reliefs`
--

DROP TABLE IF EXISTS `tbl_hr_reliefs`;
CREATE TABLE `tbl_hr_reliefs` (
  `name` varchar(100) NOT NULL,
  `amount` decimal(18,2) default '0.00',
  `percent` decimal(18,2) default '0.00',
  `type` varchar(100) NOT NULL default '',
  PRIMARY KEY  (`name`,`type`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_hr_reliefs`
--


/*!40000 ALTER TABLE `tbl_hr_reliefs` DISABLE KEYS */;
LOCK TABLES `tbl_hr_reliefs` WRITE;
INSERT INTO `tbl_hr_reliefs` VALUES ('Income-Tax-Personal-Relief','1162.00','0.00','');
UNLOCK TABLES;
/*!40000 ALTER TABLE `tbl_hr_reliefs` ENABLE KEYS */;

--
-- Table structure for table `tbl_hrallowances`
--

DROP TABLE IF EXISTS `tbl_hrallowances`;
CREATE TABLE `tbl_hrallowances` (
  `name` varchar(100) NOT NULL,
  `rate` decimal(18,2) default '0.00',
  `applies_to` varchar(100) NOT NULL default '',
  PRIMARY KEY  (`name`,`applies_to`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_hrallowances`
--


/*!40000 ALTER TABLE `tbl_hrallowances` DISABLE KEYS */;
LOCK TABLES `tbl_hrallowances` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `tbl_hrallowances` ENABLE KEYS */;

--
-- Table structure for table `tbl_hrdeductions`
--

DROP TABLE IF EXISTS `tbl_hrdeductions`;
CREATE TABLE `tbl_hrdeductions` (
  `name` varchar(100) NOT NULL,
  `rate` decimal(18,2) default '0.00',
  PRIMARY KEY  (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_hrdeductions`
--


/*!40000 ALTER TABLE `tbl_hrdeductions` DISABLE KEYS */;
LOCK TABLES `tbl_hrdeductions` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `tbl_hrdeductions` ENABLE KEYS */;

--
-- Table structure for table `tbl_invoices`
--

DROP TABLE IF EXISTS `tbl_invoices`;
CREATE TABLE `tbl_invoices` (
  `invoice_no` varchar(100) NOT NULL default '1',
  `payee_ref` varchar(255) NOT NULL,
  `amount_due` decimal(18,2) NOT NULL default '0.00',
  `acc_payable` varchar(100) NOT NULL,
  `i_status` int(1) NOT NULL default '0' COMMENT '0=unpaid, 1=paid',
  PRIMARY KEY  (`invoice_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_invoices`
--


/*!40000 ALTER TABLE `tbl_invoices` DISABLE KEYS */;
LOCK TABLES `tbl_invoices` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `tbl_invoices` ENABLE KEYS */;

--
-- Table structure for table `tbl_studentsubjects`
--

DROP TABLE IF EXISTS `tbl_studentsubjects`;
CREATE TABLE `tbl_studentsubjects` (
  `admno` varchar(100) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `form` varchar(100) NOT NULL,
  `year` int(4) NOT NULL,
  `term` int(1) NOT NULL,
  `stream` varchar(100) NOT NULL,
  PRIMARY KEY  (`admno`,`subject`,`form`,`year`,`term`,`stream`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_studentsubjects`
--


/*!40000 ALTER TABLE `tbl_studentsubjects` DISABLE KEYS */;
LOCK TABLES `tbl_studentsubjects` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `tbl_studentsubjects` ENABLE KEYS */;

--
-- Table structure for table `tbl_terms`
--

DROP TABLE IF EXISTS `tbl_terms`;
CREATE TABLE `tbl_terms` (
  `term` int(1) NOT NULL,
  `year` int(4) NOT NULL,
  `begins` varchar(100) NOT NULL,
  `ends` varchar(100) NOT NULL,
  PRIMARY KEY  (`term`,`year`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_terms`
--


/*!40000 ALTER TABLE `tbl_terms` DISABLE KEYS */;
LOCK TABLES `tbl_terms` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `tbl_terms` ENABLE KEYS */;

--
-- Table structure for table `tbl_themes`
--

DROP TABLE IF EXISTS `tbl_themes`;
CREATE TABLE `tbl_themes` (
  `theme_name` varchar(100) NOT NULL,
  `theme_status` int(1) NOT NULL default '0',
  `css_name` varchar(255) NOT NULL,
  `css_m` varbinary(255) NOT NULL,
  PRIMARY KEY  (`theme_name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_themes`
--


/*!40000 ALTER TABLE `tbl_themes` DISABLE KEYS */;
LOCK TABLES `tbl_themes` WRITE;
INSERT INTO `tbl_themes` VALUES ('Blue',1,'style_blue','styleblue'),('Green',0,'style_green','stylegreen'),('Maroon',0,'style_maroon','stylemaroon'),('Red',0,'style_red','stylered');
UNLOCK TABLES;
/*!40000 ALTER TABLE `tbl_themes` ENABLE KEYS */;

--
-- Table structure for table `tblaudittrail`
--

DROP TABLE IF EXISTS `tblaudittrail`;
CREATE TABLE `tblaudittrail` (
  `id` int(11) NOT NULL auto_increment,
  `auditDate` datetime NOT NULL,
  `activity` varchar(200) NOT NULL,
  `uname` varchar(30) NOT NULL,
  `ipaddress` varchar(16) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblaudittrail`
--


/*!40000 ALTER TABLE `tblaudittrail` DISABLE KEYS */;
LOCK TABLES `tblaudittrail` WRITE;
INSERT INTO `tblaudittrail` VALUES (1,'2017-11-10 11:30:32','Successful Login','admin','192.168.1.235'),(2,'2017-11-10 11:30:37','View Administrator*s Dashboard','admin','192.168.1.235'),(3,'2017-11-10 11:30:39','View Administrator*s Dashboard','admin','192.168.1.235'),(4,'2017-11-10 11:30:40','View School Setting Page','admin','192.168.1.235'),(5,'2017-11-10 11:32:05','View School Setting Page','admin','192.168.1.235'),(6,'2017-11-10 11:32:13','View Administrator*s Dashboard','admin','192.168.1.235'),(7,'2017-11-10 11:33:36','Viewed student list','admin','192.168.1.235'),(8,'2017-11-10 11:33:36','Viewed student list','admin','192.168.1.235'),(9,'2017-11-10 11:33:39','Viewed Deans Exams Settings page','admin','192.168.1.235'),(10,'2017-11-10 11:33:43','View HR Dashboard','admin','192.168.1.235'),(11,'2017-11-10 11:33:46','Viewed HR Create Payslip page','admin','192.168.1.235'),(12,'2017-11-10 11:34:02','View Finance Dashboard','admin','192.168.1.235'),(13,'2017-11-10 11:34:05','Viewed Finance Record Balances page','admin','192.168.1.235'),(14,'2017-11-10 11:34:06','Viewed Finance Voteheads Setting page','admin','192.168.1.235'),(15,'2017-11-10 11:34:14','Viewed Finance Voteheads Setting page','admin','192.168.1.235'),(16,'2017-11-10 11:45:50','Viewed student list','admin','192.168.1.235'),(17,'2017-11-10 11:45:50','Viewed student list','admin','192.168.1.235'),(18,'2017-11-10 11:46:39','Viewed student list','admin','192.168.1.235'),(19,'2017-11-10 11:46:40','Viewed student list','admin','192.168.1.235'),(20,'2017-11-10 11:47:18','Viewed Class list','admin','192.168.1.235'),(21,'2017-11-10 11:47:24','View Administrator*s Dashboard','admin','192.168.1.235'),(22,'2017-11-10 11:47:27','Viewed Settings streams page','admin','192.168.1.235'),(23,'2017-11-10 11:47:33','Viewed Settings streams page','admin','192.168.1.235'),(24,'2017-11-10 11:47:35','Viewed Settings streams page','admin','192.168.1.235'),(25,'2017-11-10 11:47:45','Viewed Settings streams page','admin','192.168.1.235'),(26,'2017-11-10 11:47:46','Viewed Settings streams page','admin','192.168.1.235'),(27,'2017-11-10 11:47:51','Viewed Settings streams page','admin','192.168.1.235'),(28,'2017-11-10 11:47:52','Viewed Settings streams page','admin','192.168.1.235'),(29,'2017-11-10 11:48:02','Viewed Settings streams page','admin','192.168.1.235'),(30,'2017-11-10 11:48:03','Viewed Settings streams page','admin','192.168.1.235'),(31,'2017-11-10 11:48:07','Viewed Settings streams page','admin','192.168.1.235'),(32,'2017-11-10 11:48:08','Viewed Settings streams page','admin','192.168.1.235'),(33,'2017-11-10 11:48:11','Viewed Settings streams page','admin','192.168.1.235'),(34,'2017-11-10 11:48:12','Viewed Settings streams page','admin','192.168.1.235'),(35,'2017-11-10 11:48:23','Viewed Settings streams page','admin','192.168.1.235'),(36,'2017-11-10 11:48:24','Viewed Settings streams page','admin','192.168.1.235'),(37,'2017-11-10 11:48:29','Viewed Settings streams page','admin','192.168.1.235'),(38,'2017-11-10 11:48:30','Viewed Settings streams page','admin','192.168.1.235'),(39,'2017-11-10 11:48:51','Viewed Settings streams page','admin','192.168.1.235'),(40,'2017-11-10 11:48:52','Viewed Settings streams page','admin','192.168.1.235'),(41,'2017-11-10 11:49:01','Viewed Settings streams page','admin','192.168.1.235'),(42,'2017-11-10 11:49:02','Viewed Settings streams page','admin','192.168.1.235'),(43,'2017-11-10 11:49:21','Viewed student list','admin','192.168.1.235'),(44,'2017-11-10 11:49:21','Viewed student list','admin','192.168.1.235'),(45,'2017-11-10 11:49:23','Viewed Class list','admin','192.168.1.235'),(46,'2017-11-10 11:49:26','Viewed Class list','admin','192.168.1.235'),(47,'2017-11-10 11:50:10','Viewed Class list','admin','192.168.1.235'),(48,'2017-11-10 11:50:12','Viewed student list','admin','192.168.1.235'),(49,'2017-11-10 11:50:12','Viewed student list','admin','192.168.1.235'),(50,'2017-11-10 11:50:15','Viewed student list','admin','192.168.1.235'),(51,'2017-11-10 11:50:15','Viewed student list','admin','192.168.1.235'),(52,'2017-11-10 11:52:02','Viewed student list','admin','192.168.1.235'),(53,'2017-11-10 11:52:02','Viewed student list','admin','192.168.1.235'),(54,'2017-11-10 11:52:04','Viewed student list','admin','192.168.1.235'),(55,'2017-11-10 11:52:04','Viewed student list','admin','192.168.1.235'),(56,'2017-11-10 11:54:02','Viewed student list','admin','192.168.1.235'),(57,'2017-11-10 11:54:02','Viewed student list','admin','192.168.1.235'),(58,'2017-11-10 11:54:41','Viewed student list','admin','192.168.1.235'),(59,'2017-11-10 11:54:41','Viewed student list','admin','192.168.1.235'),(60,'2017-11-10 11:55:12','Viewed student list','admin','192.168.1.235'),(61,'2017-11-10 11:55:12','Viewed student list','admin','192.168.1.235'),(62,'2017-11-10 11:59:21','Viewed student list','admin','192.168.1.235'),(63,'2017-11-10 11:59:21','Viewed student list','admin','192.168.1.235'),(64,'2017-11-10 12:01:23','Viewed student list','admin','192.168.1.235'),(65,'2017-11-10 12:01:23','Viewed student list','admin','192.168.1.235'),(66,'2017-11-10 12:01:37','Viewed student list','admin','192.168.1.235'),(67,'2017-11-10 12:01:37','Viewed student list','admin','192.168.1.235'),(68,'2017-11-10 12:01:47','Viewed student list','admin','192.168.1.235'),(69,'2017-11-10 12:01:47','Viewed student list','admin','192.168.1.235'),(70,'2017-11-10 12:02:25','Viewed student list','admin','192.168.1.235'),(71,'2017-11-10 12:02:25','Viewed student list','admin','192.168.1.235'),(72,'2017-11-10 12:06:05','Viewed student list','admin','192.168.1.235'),(73,'2017-11-10 12:06:05','Viewed student list','admin','192.168.1.235'),(74,'2017-11-10 12:06:40','Viewed Class list','admin','192.168.1.235'),(75,'2017-11-10 12:06:42','Viewed Class list','admin','192.168.1.235'),(76,'2017-11-10 12:06:51','Viewed Class list','admin','192.168.1.235'),(77,'2017-11-10 12:06:59','Viewed student list','admin','192.168.1.235'),(78,'2017-11-10 12:06:59','Viewed student list','admin','192.168.1.235'),(79,'2017-11-10 12:07:46','Viewed Class list','admin','192.168.1.235'),(80,'2017-11-10 12:07:50','Viewed Class list','admin','192.168.1.235'),(81,'2017-11-10 12:11:26','Viewed Class list','admin','192.168.1.235'),(82,'2017-11-10 12:11:29','Viewed Class list','admin','192.168.1.235'),(83,'2017-11-10 12:13:51','Viewed student list','admin','192.168.1.235'),(84,'2017-11-10 12:13:51','Viewed student list','admin','192.168.1.235'),(85,'2017-11-10 12:21:57','Viewed student list','admin','192.168.1.235'),(86,'2017-11-10 12:21:58','Viewed student list','admin','192.168.1.235'),(87,'2017-11-10 12:26:48','Viewed student list','admin','192.168.1.235'),(88,'2017-11-10 12:26:48','Viewed student list','admin','192.168.1.235'),(89,'2017-11-10 12:27:13','Viewed student list','admin','192.168.1.235'),(90,'2017-11-10 12:27:13','Viewed student list','admin','192.168.1.235'),(91,'2017-11-10 12:27:40','Viewed Class list','admin','192.168.1.235'),(92,'2017-11-10 12:27:42','Viewed Class list','admin','192.168.1.235'),(93,'2017-11-10 12:29:39','Viewed Class list','admin','192.168.1.235'),(94,'2017-11-10 12:29:59','Set Subjects Allocation for  ENGLISH FORM 1 EAST  2017 3','admin','192.168.1.235'),(95,'2017-11-10 12:30:04','Viewed Class list','admin','192.168.1.235'),(96,'2017-11-10 12:30:06','Viewed Class list','admin','192.168.1.235'),(97,'2017-11-10 12:46:48','Successful Login','admin','192.168.1.235'),(98,'2017-11-10 12:46:53','View Administrator*s Dashboard','admin','192.168.1.235'),(99,'2017-11-10 12:47:10','View Administrator*s Dashboard','admin','192.168.1.235'),(100,'2017-11-10 12:47:33','View Finance Dashboard','admin','192.168.1.235'),(101,'2017-11-10 12:47:33','View Finance Dashboard','admin','192.168.1.235'),(102,'2017-11-10 12:48:01','Viewed Votehead Balances page','admin','192.168.1.235'),(103,'2017-11-10 12:48:16','Viewed fees balances','admin','192.168.1.235'),(104,'2017-11-10 12:48:20','Viewed Finance Printed Estimates Setting page','admin','192.168.1.235'),(105,'2017-11-10 12:48:20','Viewed Votehead Balances page','admin','192.168.1.235'),(106,'2017-11-10 12:48:38','Viewed Finance Fiscal Yr Setting page','admin','192.168.1.235'),(107,'2017-11-10 12:48:52','Viewed Finance Fiscal Yr Setting page','admin','192.168.1.235'),(108,'2017-11-10 12:48:54','Viewed Finance Voteheads Setting page','admin','192.168.1.235'),(109,'2017-11-10 12:49:32','View Administrator*s Dashboard','admin','192.168.1.235'),(110,'2017-11-10 12:50:26','View HR Dashboard','admin','192.168.1.235'),(111,'2017-11-10 12:50:56','View HR Dashboard','admin','192.168.1.235'),(112,'2017-11-10 12:50:59','View Administrator*s Dashboard','admin','192.168.1.235'),(113,'2017-11-10 12:51:08','Viewed student list','admin','192.168.1.235'),(114,'2017-11-10 12:51:08','Viewed student list','admin','192.168.1.235'),(115,'2017-11-10 12:52:15','Viewed Class list','admin','192.168.1.235'),(116,'2017-11-10 12:52:20','Viewed Class list','admin','192.168.1.235'),(117,'2017-11-10 12:53:13','Viewed Class list','admin','192.168.1.235'),(118,'2017-11-10 12:53:15','Viewed student list','admin','192.168.1.235'),(119,'2017-11-10 12:53:15','Viewed student list','admin','192.168.1.235'),(120,'2017-11-10 12:53:23','View Administrator*s Dashboard','admin','192.168.1.235'),(121,'2017-11-10 12:55:07','Successful Login','admin','192.168.1.235'),(122,'2017-11-10 12:55:12','View Administrator*s Dashboard','admin','192.168.1.235'),(123,'2017-11-10 12:55:31','View Administrator*s Dashboard','admin','192.168.1.235'),(124,'2017-11-10 12:55:37','View School Setting Page','admin','192.168.1.235'),(125,'2017-11-10 12:55:43','View Administrator*s Dashboard','admin','192.168.1.235'),(126,'2017-11-10 12:55:51','View Administrator*s Dashboard','admin','192.168.1.235'),(127,'2017-11-10 12:56:03','View Administrator*s Dashboard','admin','192.168.1.235'),(128,'2017-11-10 12:56:14','View Administrator*s Dashboard','admin','192.168.1.235'),(129,'2017-11-10 12:56:14','View Administrator*s Dashboard','admin','192.168.1.235'),(130,'2017-11-10 12:56:24','Viewed Deans Exams Settings page','admin','192.168.1.235'),(131,'2017-11-10 12:56:25','Viewed Deans Exams Settings page','admin','192.168.1.235'),(132,'2017-11-10 12:56:57','Viewed Deans Exams Settings page','admin','192.168.1.235'),(133,'2017-11-10 12:56:58','Viewed Terms Settings page','admin','192.168.1.235'),(134,'2017-11-10 12:57:26','Viewed Terms Settings page','admin','192.168.1.235'),(135,'2017-11-10 12:57:29','Viewed Exam Status Page','admin','192.168.1.235'),(136,'2017-11-10 12:57:49','Viewed Exam Status Page','admin','192.168.1.235'),(137,'2017-11-10 12:57:56','Viewed Exam Status Page','admin','192.168.1.235'),(138,'2017-11-10 12:58:01','Viewed Terms Settings page','admin','192.168.1.235'),(139,'2017-11-10 12:58:13','Viewed Deans Exams Settings page','admin','192.168.1.235'),(140,'2017-11-10 12:58:37','View Finance Dashboard','admin','192.168.1.235'),(141,'2017-11-10 12:58:37','View Finance Dashboard','admin','192.168.1.235'),(142,'2017-11-10 12:58:44','Viewed Deans Exams Settings page','admin','192.168.1.235'),(143,'2017-11-10 13:07:50','Successful Login','admin','192.168.1.235'),(144,'2017-11-10 13:07:52','View Finance Dashboard','admin','192.168.1.235'),(145,'2017-11-10 13:07:54','Viewed Finance Fiscal Yr Setting page','admin','192.168.1.235'),(146,'2017-11-10 13:07:58','Viewed Finance Voteheads Setting page','admin','192.168.1.235'),(147,'2017-11-10 13:08:04','Viewed Parents Cashbook Finance Voteheads Setting page','admin','192.168.1.235'),(148,'2017-11-10 13:08:48','Viewed Parents Cashbook Finance Voteheads Setting page','admin','192.168.1.235'),(149,'2017-11-10 13:08:48','New Votehead Boarding','admin','192.168.1.235'),(150,'2017-11-10 13:08:49','Viewed Parents Cashbook Finance Voteheads Setting page','admin','192.168.1.235'),(151,'2017-11-10 13:09:01','Viewed Parents Cashbook Finance Voteheads Setting page','admin','192.168.1.235'),(152,'2017-11-10 13:09:01','New Votehead PE','admin','192.168.1.235'),(153,'2017-11-10 13:09:02','Viewed Parents Cashbook Finance Voteheads Setting page','admin','192.168.1.235'),(154,'2017-11-10 13:09:10','Viewed Parents Cashbook Finance Voteheads Setting page','admin','192.168.1.235'),(155,'2017-11-10 13:09:11','New Votehead Repair','admin','192.168.1.235'),(156,'2017-11-10 13:09:11','Viewed Parents Cashbook Finance Voteheads Setting page','admin','192.168.1.235'),(157,'2017-11-10 13:09:20','Viewed Parents Cashbook Finance Voteheads Setting page','admin','192.168.1.235'),(158,'2017-11-10 13:09:20','New Votehead EWC','admin','192.168.1.235'),(159,'2017-11-10 13:09:21','Viewed Parents Cashbook Finance Voteheads Setting page','admin','192.168.1.235'),(160,'2017-11-10 13:09:39','Viewed Parents Cashbook Finance Voteheads Setting page','admin','192.168.1.235'),(161,'2017-11-10 13:09:39','New Votehead LTT','admin','192.168.1.235'),(162,'2017-11-10 13:09:40','Viewed Parents Cashbook Finance Voteheads Setting page','admin','192.168.1.235'),(163,'2017-11-10 13:09:54','Viewed Parents Cashbook Finance Voteheads Setting page','admin','192.168.1.235'),(164,'2017-11-10 13:09:54','New Votehead ADMIN','admin','192.168.1.235'),(165,'2017-11-10 13:09:56','Viewed Parents Cashbook Finance Voteheads Setting page','admin','192.168.1.235'),(166,'2017-11-10 13:10:12','Viewed Parents Cashbook Finance Voteheads Setting page','admin','192.168.1.235'),(167,'2017-11-10 13:10:12','New Votehead MEDICAL','admin','192.168.1.235'),(168,'2017-11-10 13:10:13','Viewed Parents Cashbook Finance Voteheads Setting page','admin','192.168.1.235'),(169,'2017-11-10 13:10:27','Viewed Parents Cashbook Finance Voteheads Setting page','admin','192.168.1.235'),(170,'2017-11-10 13:10:27','New Votehead INSURANCE','admin','192.168.1.235'),(171,'2017-11-10 13:10:28','Viewed Parents Cashbook Finance Voteheads Setting page','admin','192.168.1.235'),(172,'2017-11-10 13:10:43','Viewed Parents Cashbook Finance Voteheads Setting page','admin','192.168.1.235'),(173,'2017-11-10 13:10:43','New Votehead ACTIVITIES','admin','192.168.1.235'),(174,'2017-11-10 13:10:44','Viewed Parents Cashbook Finance Voteheads Setting page','admin','192.168.1.235'),(175,'2017-11-10 13:10:53','Viewed Parents Cashbook Finance Voteheads Setting page','admin','192.168.1.235'),(176,'2017-11-10 13:10:55','Viewed Finance Printed Estimates Setting page','admin','192.168.1.235'),(177,'2017-11-10 13:12:41','Viewed Finance Printed Estimates Setting page','admin','192.168.1.235'),(178,'2017-11-10 13:14:03','Viewed Finance Printed Estimates Setting page','admin','192.168.1.235'),(179,'2017-11-10 13:15:21','Viewed Finance Printed Estimates Setting page','admin','192.168.1.235'),(180,'2017-11-10 13:15:23','Viewed Finance Printed Estimates Setting page','admin','192.168.1.235'),(181,'2017-11-10 13:15:23','Viewed Printed Estimates page','admin','192.168.1.235'),(182,'2017-11-10 13:15:29','Viewed Printed Estimates page','admin','192.168.1.235'),(183,'2017-11-10 13:16:44','Viewed Finance Voteheads Setting page','admin','192.168.1.235'),(184,'2017-11-10 13:16:54','Viewed Finance Voteheads Setting page','admin','192.168.1.235'),(185,'2017-11-10 13:17:53','Viewed Parents Cashbook Finance Voteheads Setting page','admin','192.168.1.235'),(186,'2017-11-10 13:17:54','Viewed Finance Printed Estimates Setting page','admin','192.168.1.235'),(187,'2017-11-10 13:17:56','Viewed Finance Printed Estimates Setting page','admin','192.168.1.235'),(188,'2017-11-10 13:17:56','Viewed Printed Estimates page','admin','192.168.1.235'),(189,'2017-11-10 13:18:03','Viewed Printed Estimates page','admin','192.168.1.235'),(190,'2017-11-10 13:18:39','Viewed Finance Voteheads Setting page','admin','192.168.1.235'),(191,'2017-11-10 13:18:40','Viewed Finance Voteheads Setting page','admin','192.168.1.235'),(192,'2017-11-10 13:18:51','Viewed Finance Voteheads Setting page','admin','192.168.1.235'),(193,'2017-11-10 13:20:43','Viewed Parents Cashbook Finance Voteheads Setting page','admin','192.168.1.235'),(194,'2017-11-10 13:20:45','Viewed Parents Cashbook Finance Voteheads Setting page','admin','192.168.1.235'),(195,'2017-11-10 13:21:20','Viewed Finance Printed Estimates Setting page','admin','192.168.1.235'),(196,'2017-11-10 13:23:52','Viewed Finance Voteheads Setting page','admin','192.168.1.235'),(197,'2017-11-10 13:24:08','Viewed Finance Voteheads Setting page','admin','192.168.1.235'),(198,'2017-11-10 13:25:23','Viewed Finance Voteheads Setting page','admin','192.168.1.235'),(199,'2017-11-10 13:25:28','Viewed Finance Voteheads Setting page','admin','192.168.1.235'),(200,'2017-11-10 13:26:30','View Administrator*s Dashboard','admin','192.168.1.235'),(201,'2017-11-10 13:26:56','Successful Login','admin','127.0.0.1'),(202,'2017-11-10 13:26:56','View Administrator*s Dashboard','admin','127.0.0.1'),(203,'2017-11-10 13:30:30','Successful Login','admin','192.168.1.233'),(204,'2017-11-10 13:30:30','View Administrator*s Dashboard','admin','192.168.1.233'),(205,'2017-11-10 13:30:32','View HR Dashboard','admin','192.168.1.233'),(206,'2017-11-10 13:32:38','Added new Staff 11054704','admin','192.168.1.233'),(207,'2017-11-10 13:32:40','Successful Logout','admin','192.168.1.233'),(208,'2017-11-13 08:08:45','View Administrator*s Dashboard','admin','127.0.0.1'),(209,'2017-11-13 08:58:19','Successful Login','admin','127.0.0.1'),(210,'2017-11-13 08:58:19','View Administrator*s Dashboard','admin','127.0.0.1'),(211,'2017-11-13 08:59:04','View Administrator*s Dashboard','admin','127.0.0.1'),(212,'2017-11-13 08:59:12','View Administrator*s Dashboard','admin','127.0.0.1'),(213,'2017-11-13 08:59:16','View School Setting Page','admin','127.0.0.1'),(214,'2017-11-13 08:59:33','Viewed Settings streams page','admin','127.0.0.1'),(215,'2017-11-13 08:59:55','Viewed Settings streams page','admin','127.0.0.1'),(216,'2017-11-13 08:59:58','View school enrollment page','admin','127.0.0.1'),(217,'2017-11-13 09:00:45','Backed up Database','admin','127.0.0.1'),(218,'2017-11-13 09:09:40','View Administrator*s Dashboard','admin','127.0.0.1'),(219,'2017-11-13 09:10:41','View HR Dashboard','admin','127.0.0.1'),(220,'2017-11-14 14:00:06','Successful Login','admin','127.0.0.1'),(221,'2017-11-14 14:00:06','View Administrator*s Dashboard','admin','127.0.0.1'),(222,'2017-11-14 14:00:10','View HR Dashboard','admin','127.0.0.1'),(223,'2017-11-14 14:01:23','Viewed HR Create Payslip page','admin','127.0.0.1'),(224,'2017-11-14 14:01:33','Viewed HR PAYE page','admin','127.0.0.1'),(225,'2017-11-14 14:01:40','Viewed HR Allowances page','admin','127.0.0.1'),(226,'2017-11-14 14:01:45','Viewed Customer Bills report page','admin','127.0.0.1'),(227,'2017-11-14 14:01:45','Viewed HR Master Payslip page','admin','127.0.0.1'),(228,'2017-11-14 14:01:59','Viewed Customer Bills report page','admin','127.0.0.1'),(229,'2017-11-14 14:02:00','Viewed HR Master Payslip page','admin','127.0.0.1'),(230,'2017-11-14 14:02:46','View Administrator*s Dashboard','admin','127.0.0.1'),(231,'2017-11-14 14:03:41','Viewed student list','admin','127.0.0.1'),(232,'2017-11-14 14:03:41','Viewed student list','admin','127.0.0.1'),(233,'2017-11-14 14:04:10','View Administrator*s Dashboard','admin','127.0.0.1'),(234,'2017-11-22 13:41:59','Successful Login','admin','127.0.0.1'),(235,'2017-11-22 13:42:00','View Administrator*s Dashboard','admin','127.0.0.1'),(236,'2017-11-22 13:42:02','View Finance Dashboard','admin','127.0.0.1'),(237,'2017-11-22 13:42:07','Viewed Finance pocket money page','admin','127.0.0.1'),(238,'2017-11-22 13:42:21','Viewed Finance Fiscal Yr Setting page','admin','127.0.0.1'),(239,'2017-11-22 13:42:23','Viewed Parents Cashbook Finance Voteheads Setting page','admin','127.0.0.1'),(240,'2017-11-22 13:53:36','Successful Login','admin','192.168.1.21'),(241,'2017-11-22 13:53:36','View Administrator*s Dashboard','admin','192.168.1.21'),(242,'2017-11-22 13:53:40','View HR Dashboard','admin','192.168.1.21'),(243,'2017-11-22 13:58:54','Added new Staff 10932104','admin','192.168.1.21'),(244,'2017-11-22 13:58:57','Successful Logout','admin','192.168.1.21'),(245,'2017-11-22 13:59:20','Successful Login','10932104','192.168.1.21'),(246,'2017-11-22 13:59:20','View Accountant*s Dashboard','10932104','192.168.1.21'),(247,'2017-11-22 14:00:15','Backed up Database','10932104','192.168.1.21'),(248,'2017-11-22 14:00:19','Backed up Database','10932104','192.168.1.21'),(249,'2017-11-22 14:01:20','Backed up Database','10932104','192.168.1.21'),(250,'2017-11-22 14:01:59','View HR Dashboard','10932104','192.168.1.21'),(251,'2017-11-22 14:02:11','Viewed HR Create Payslip page','10932104','192.168.1.21'),(252,'2017-11-22 14:04:41','Viewed HR PAYE page','10932104','192.168.1.21'),(253,'2017-11-22 14:04:47','Viewed HR Loans  page','10932104','192.168.1.21'),(254,'2017-11-22 14:05:13','Viewed HR Loans  page','10932104','192.168.1.21'),(255,'2017-11-22 14:05:13','Added HR Deductions SACCO','10932104','192.168.1.21'),(256,'2017-11-22 14:05:15','Viewed HR Loans  page','10932104','192.168.1.21'),(257,'2017-11-22 14:05:16','Viewed HR Create Payslip page','10932104','192.168.1.21'),(258,'2017-11-22 14:06:49','Viewed Customer Bills report page','10932104','192.168.1.21'),(259,'2017-11-22 14:06:50','Viewed HR Master Payslip page','10932104','192.168.1.21'),(260,'2017-11-22 14:07:39','View Finance Dashboard','10932104','192.168.1.21'),(261,'2017-11-22 14:07:43','Viewed Finance Voteheads Setting page','10932104','192.168.1.21'),(262,'2017-11-22 14:08:47','View HR Dashboard','10932104','192.168.1.21'),(263,'2017-11-22 14:08:49','Viewed Customer Bills report page','10932104','192.168.1.21'),(264,'2017-11-22 14:08:49','Viewed HR Master Payslip page','10932104','192.168.1.21'),(265,'2017-11-22 14:09:11','Viewed HR Master Payslip page','10932104','192.168.1.21'),(266,'2017-11-22 14:09:27','Viewed Customer Bills report page','10932104','192.168.1.21'),(267,'2017-11-22 14:09:27','Viewed HR Master Payslip page','10932104','192.168.1.21'),(268,'2017-11-22 14:09:55','Viewed HR PAYE page','10932104','192.168.1.21'),(269,'2017-11-22 14:10:00','Viewed HR NHIF page','10932104','192.168.1.21'),(270,'2017-11-22 14:10:02','Viewed HR NSSF page','10932104','192.168.1.21'),(271,'2017-11-22 14:10:08','Viewed HR Loans  page','10932104','192.168.1.21'),(272,'2017-11-22 14:10:17','Viewed HR Create Payslip page','10932104','192.168.1.21'),(273,'2017-11-22 14:10:28','Viewed HR Create Payslip page','10932104','192.168.1.21'),(274,'2017-11-22 14:10:34','View Finance Dashboard','10932104','192.168.1.21'),(275,'2017-11-22 14:11:39','View Accountant*s Dashboard','10932104','192.168.1.21'),(276,'2017-11-22 14:12:33','View Finance Dashboard','10932104','192.168.1.21'),(277,'2017-11-22 14:13:58','View HR Dashboard','admin','127.0.0.1'),(278,'2017-11-22 14:14:00','Viewed HR Create Payslip page','admin','127.0.0.1'),(279,'2017-11-22 14:14:05','View HR Dashboard','admin','127.0.0.1'),(280,'2017-11-22 14:14:06','View Finance Dashboard','admin','127.0.0.1'),(281,'2017-11-22 14:22:58','Viewed Finance Fiscal Yr Setting page','10932104','192.168.1.21'),(282,'2017-11-22 14:23:07','Viewed Finance Voteheads Setting page','10932104','192.168.1.21'),(283,'2017-11-22 14:25:22','Viewed Finance Voteheads Setting page','10932104','192.168.1.21'),(284,'2017-11-22 14:25:22','Added a new Bank Account BARCLAYS BANK','10932104','192.168.1.21'),(285,'2017-11-22 14:25:23','Viewed Finance Voteheads Setting page','10932104','192.168.1.21'),(286,'2017-11-22 14:27:15','Viewed Finance Voteheads Setting page','10932104','192.168.1.21'),(287,'2017-11-22 14:27:15','Added a new Bank Account LIPA KARO NA MPESA','10932104','192.168.1.21'),(288,'2017-11-22 14:27:16','Viewed Finance Voteheads Setting page','10932104','192.168.1.21'),(289,'2017-11-22 14:29:41','Viewed Finance Voteheads Setting page','10932104','192.168.1.21'),(290,'2017-11-22 14:29:41','Added a new Bank Account KCB DEVELOPMENT ACC','10932104','192.168.1.21'),(291,'2017-11-22 14:29:43','Viewed Finance Voteheads Setting page','10932104','192.168.1.21'),(292,'2017-11-22 14:31:02','Viewed Finance Voteheads Setting page','10932104','192.168.1.21'),(293,'2017-11-22 14:31:02','Added a new Bank Account KCB TUTION ACC','10932104','192.168.1.21'),(294,'2017-11-22 14:31:03','Viewed Finance Voteheads Setting page','10932104','192.168.1.21'),(295,'2017-11-22 14:33:55','View Finance Dashboard','admin','127.0.0.1'),(296,'2017-11-22 14:33:59','Viewed Finance Fiscal Yr Setting page','admin','127.0.0.1'),(297,'2017-11-22 14:34:01','Viewed Finance Voteheads Setting page','admin','127.0.0.1'),(298,'2017-11-22 14:35:57','Viewed Finance Voteheads Setting page','admin','127.0.0.1'),(299,'2017-11-22 14:37:03','Viewed Finance Voteheads Setting page','admin','127.0.0.1'),(300,'2017-11-22 14:37:03','Added a new Bank Account KCB TUITION ACC','admin','127.0.0.1'),(301,'2017-11-22 14:37:05','Viewed Finance Voteheads Setting page','admin','127.0.0.1'),(302,'2017-11-22 14:37:29','Viewed Finance Voteheads Setting page','admin','127.0.0.1'),(303,'2017-11-22 14:38:10','Viewed Parents Cashbook Finance Voteheads Setting page','10932104','192.168.1.21'),(304,'2017-11-22 14:38:34','Deleted  Vote head','10932104','192.168.1.21'),(305,'2017-11-22 14:38:37','Viewed Finance Fiscal Yr Setting page','admin','127.0.0.1'),(306,'2017-11-22 14:38:37','Deleted  Vote head','10932104','192.168.1.21'),(307,'2017-11-22 14:38:39','Viewed Parents Cashbook Finance Voteheads Setting page','admin','127.0.0.1'),(308,'2017-11-22 14:38:40','Deleted  Vote head','10932104','192.168.1.21'),(309,'2017-11-22 14:38:42','Viewed Finance Printed Estimates Setting page','admin','127.0.0.1'),(310,'2017-11-22 14:38:43','Deleted  Vote head','10932104','192.168.1.21'),(311,'2017-11-22 14:38:44','Viewed Finance Printed Estimates Setting page','admin','127.0.0.1'),(312,'2017-11-22 14:38:45','Backed up Database','admin','127.0.0.1'),(313,'2017-11-22 14:38:45','Viewed Parents Cashbook Finance Voteheads Setting page','10932104','192.168.1.21'),(314,'2017-11-22 14:38:48','Viewed Parents Cashbook Finance Voteheads Setting page','admin','127.0.0.1'),(315,'2017-11-22 14:38:56','Viewed Finance Record Balances page','10932104','192.168.1.21'),(316,'2017-11-22 14:40:45','Viewed Finance Fiscal Yr Setting page','10932104','192.168.1.21'),(317,'2017-11-22 14:40:47','Viewed Parents Cashbook Finance Voteheads Setting page','10932104','192.168.1.21'),(318,'2017-11-22 14:40:49','Viewed Parents Cashbook Finance Voteheads Setting page','10932104','192.168.1.21'),(319,'2017-11-22 14:41:24','Viewed Parents Cashbook Finance Voteheads Setting page','10932104','192.168.1.21'),(320,'2017-11-22 14:41:24','New Votehead BES','10932104','192.168.1.21'),(321,'2017-11-22 14:41:25','Viewed Parents Cashbook Finance Voteheads Setting page','10932104','192.168.1.21'),(322,'2017-11-22 14:41:37','Viewed Parents Cashbook Finance Voteheads Setting page','10932104','192.168.1.21'),(323,'2017-11-22 14:41:37','New Votehead RMI','10932104','192.168.1.21'),(324,'2017-11-22 14:41:39','Viewed Parents Cashbook Finance Voteheads Setting page','10932104','192.168.1.21'),(325,'2017-11-22 14:41:56','Viewed Parents Cashbook Finance Voteheads Setting page','10932104','192.168.1.21'),(326,'2017-11-22 14:41:56','New Votehead LT&T','10932104','192.168.1.21'),(327,'2017-11-22 14:41:57','Viewed Parents Cashbook Finance Voteheads Setting page','10932104','192.168.1.21'),(328,'2017-11-22 14:42:14','Viewed Parents Cashbook Finance Voteheads Setting page','10932104','192.168.1.21'),(329,'2017-11-22 14:42:14','New Votehead ADMIN_COST','10932104','192.168.1.21'),(330,'2017-11-22 14:42:16','Viewed Parents Cashbook Finance Voteheads Setting page','10932104','192.168.1.21'),(331,'2017-11-22 14:42:28','Viewed Parents Cashbook Finance Voteheads Setting page','10932104','192.168.1.21'),(332,'2017-11-22 14:42:28','New Votehead EWC','10932104','192.168.1.21'),(333,'2017-11-22 14:42:30','Viewed Parents Cashbook Finance Voteheads Setting page','10932104','192.168.1.21'),(334,'2017-11-22 14:42:44','Viewed Parents Cashbook Finance Voteheads Setting page','10932104','192.168.1.21'),(335,'2017-11-22 14:42:44','New Votehead ACTIVITY','10932104','192.168.1.21'),(336,'2017-11-22 14:42:45','Viewed Parents Cashbook Finance Voteheads Setting page','10932104','192.168.1.21'),(337,'2017-11-22 14:42:55','Viewed Parents Cashbook Finance Voteheads Setting page','10932104','192.168.1.21'),(338,'2017-11-22 14:42:55','New Votehead PE','10932104','192.168.1.21'),(339,'2017-11-22 14:42:56','Viewed Parents Cashbook Finance Voteheads Setting page','10932104','192.168.1.21'),(340,'2017-11-22 14:43:22','Viewed Parents Cashbook Finance Voteheads Setting page','10932104','192.168.1.21'),(341,'2017-11-22 14:44:04','Viewed Parents Cashbook Finance Voteheads Setting page','10932104','192.168.1.21'),(342,'2017-11-22 14:44:24','Viewed Parents Cashbook Finance Voteheads Setting page','10932104','192.168.1.21'),(343,'2017-11-22 14:44:24','New Votehead BES','10932104','192.168.1.21'),(344,'2017-11-22 14:44:25','Viewed Parents Cashbook Finance Voteheads Setting page','10932104','192.168.1.21'),(345,'2017-11-22 14:44:37','Viewed Parents Cashbook Finance Voteheads Setting page','10932104','192.168.1.21'),(346,'2017-11-22 14:44:37','New Votehead RMI','10932104','192.168.1.21'),(347,'2017-11-22 14:44:38','Viewed Parents Cashbook Finance Voteheads Setting page','10932104','192.168.1.21'),(348,'2017-11-22 14:44:57','Viewed Parents Cashbook Finance Voteheads Setting page','10932104','192.168.1.21'),(349,'2017-11-22 14:44:57','New Votehead LT&T','10932104','192.168.1.21'),(350,'2017-11-22 14:44:58','Viewed Parents Cashbook Finance Voteheads Setting page','10932104','192.168.1.21'),(351,'2017-11-22 14:45:15','Viewed Parents Cashbook Finance Voteheads Setting page','10932104','192.168.1.21'),(352,'2017-11-22 14:45:15','New Votehead ADMIN_COST','10932104','192.168.1.21'),(353,'2017-11-22 14:45:16','Viewed Parents Cashbook Finance Voteheads Setting page','10932104','192.168.1.21'),(354,'2017-11-22 14:45:27','Viewed Parents Cashbook Finance Voteheads Setting page','10932104','192.168.1.21'),(355,'2017-11-22 14:45:27','New Votehead EWC','10932104','192.168.1.21'),(356,'2017-11-22 14:45:28','Viewed Parents Cashbook Finance Voteheads Setting page','10932104','192.168.1.21'),(357,'2017-11-22 14:45:40','Viewed Parents Cashbook Finance Voteheads Setting page','10932104','192.168.1.21'),(358,'2017-11-22 14:45:40','New Votehead ACTIVITY','10932104','192.168.1.21'),(359,'2017-11-22 14:45:41','Viewed Parents Cashbook Finance Voteheads Setting page','10932104','192.168.1.21'),(360,'2017-11-22 14:45:51','Viewed Parents Cashbook Finance Voteheads Setting page','10932104','192.168.1.21'),(361,'2017-11-22 14:45:51','New Votehead PE','10932104','192.168.1.21'),(362,'2017-11-22 14:45:53','Viewed Parents Cashbook Finance Voteheads Setting page','10932104','192.168.1.21'),(363,'2017-11-22 14:46:07','Viewed Parents Cashbook Finance Voteheads Setting page','10932104','192.168.1.21'),(364,'2017-11-22 14:46:07','New Votehead BES','10932104','192.168.1.21'),(365,'2017-11-22 14:46:08','Viewed Parents Cashbook Finance Voteheads Setting page','10932104','192.168.1.21'),(366,'2017-11-22 14:46:18','Viewed Parents Cashbook Finance Voteheads Setting page','10932104','192.168.1.21'),(367,'2017-11-22 14:46:18','New Votehead RMI','10932104','192.168.1.21'),(368,'2017-11-22 14:46:19','Viewed Parents Cashbook Finance Voteheads Setting page','10932104','192.168.1.21'),(369,'2017-11-22 14:46:31','Viewed Parents Cashbook Finance Voteheads Setting page','10932104','192.168.1.21'),(370,'2017-11-22 14:46:31','New Votehead LT&T','10932104','192.168.1.21'),(371,'2017-11-22 14:46:32','Viewed Parents Cashbook Finance Voteheads Setting page','10932104','192.168.1.21'),(372,'2017-11-22 14:46:42','Viewed Parents Cashbook Finance Voteheads Setting page','10932104','192.168.1.21'),(373,'2017-11-22 14:46:42','New Votehead ADMIN_COST','10932104','192.168.1.21'),(374,'2017-11-22 14:46:43','Viewed Parents Cashbook Finance Voteheads Setting page','10932104','192.168.1.21'),(375,'2017-11-22 14:46:57','Viewed Parents Cashbook Finance Voteheads Setting page','10932104','192.168.1.21'),(376,'2017-11-22 14:46:57','New Votehead EWC','10932104','192.168.1.21'),(377,'2017-11-22 14:46:58','Viewed Parents Cashbook Finance Voteheads Setting page','10932104','192.168.1.21'),(378,'2017-11-22 14:47:07','Viewed Parents Cashbook Finance Voteheads Setting page','10932104','192.168.1.21'),(379,'2017-11-22 14:47:07','New Votehead ACTIVITY','10932104','192.168.1.21'),(380,'2017-11-22 14:47:09','Viewed Parents Cashbook Finance Voteheads Setting page','10932104','192.168.1.21'),(381,'2017-11-22 14:47:20','Viewed Parents Cashbook Finance Voteheads Setting page','10932104','192.168.1.21'),(382,'2017-11-22 14:47:20','New Votehead PE','10932104','192.168.1.21'),(383,'2017-11-22 14:47:21','Viewed Parents Cashbook Finance Voteheads Setting page','10932104','192.168.1.21'),(384,'2017-11-22 14:47:43','Viewed Parents Cashbook Finance Voteheads Setting page','10932104','192.168.1.21'),(385,'2017-11-22 14:47:45','Viewed Parents Cashbook Finance Voteheads Setting page','10932104','192.168.1.21'),(386,'2017-11-22 14:48:34','Viewed Finance Fiscal Yr Setting page','10932104','192.168.1.21'),(387,'2017-11-22 14:48:35','Viewed Finance Voteheads Setting page','10932104','192.168.1.21'),(388,'2017-11-22 14:52:04','Viewed Parents Cashbook Finance Voteheads Setting page','10932104','192.168.1.21'),(389,'2017-11-22 14:52:07','Viewed Parents Cashbook Finance Voteheads Setting page','10932104','192.168.1.21'),(390,'2017-11-22 14:52:10','Viewed Parents Cashbook Finance Voteheads Setting page','10932104','192.168.1.21'),(391,'2017-11-22 14:52:12','Viewed Parents Cashbook Finance Voteheads Setting page','10932104','192.168.1.21'),(392,'2017-11-22 14:52:15','Viewed Parents Cashbook Finance Voteheads Setting page','10932104','192.168.1.21'),(393,'2017-11-22 14:52:17','Viewed Parents Cashbook Finance Voteheads Setting page','10932104','192.168.1.21'),(394,'2017-11-22 14:52:36','Viewed Parents Cashbook Finance Voteheads Setting page','10932104','192.168.1.21'),(395,'2017-11-22 14:52:42','Viewed Finance Printed Estimates Setting page','10932104','192.168.1.21'),(396,'2017-11-22 14:53:07','Viewed Finance Printed Estimates Setting page','10932104','192.168.1.21'),(397,'2017-11-22 14:53:53','Viewed Parents Cashbook Finance Voteheads Setting page','admin','127.0.0.1'),(398,'2017-11-22 14:54:10','Viewed Parents Cashbook Finance Voteheads Setting page','admin','127.0.0.1'),(399,'2017-11-22 14:55:48','Viewed Finance Printed Estimates Setting page','10932104','192.168.1.21'),(400,'2017-11-22 14:55:50','Viewed Finance Printed Estimates Setting page','10932104','192.168.1.21'),(401,'2017-11-22 14:55:50','Viewed Printed Estimates page','10932104','192.168.1.21'),(402,'2017-11-22 14:55:55','Viewed Printed Estimates page','10932104','192.168.1.21'),(403,'2017-11-22 14:56:05','Viewed Parents Cashbook Finance Voteheads Setting page','admin','127.0.0.1'),(404,'2017-11-22 14:56:06','Viewed Parents Cashbook Finance Voteheads Setting page','admin','127.0.0.1'),(405,'2017-11-22 14:56:16','Viewed Parents Cashbook Finance Voteheads Setting page','admin','127.0.0.1'),(406,'2017-11-22 14:56:19','Viewed Parents Cashbook Finance Voteheads Setting page','admin','127.0.0.1'),(407,'2017-11-22 14:56:22','Viewed Parents Cashbook Finance Voteheads Setting page','admin','127.0.0.1'),(408,'2017-11-22 14:56:36','Viewed Finance Printed Estimates Setting page','10932104','192.168.1.21'),(409,'2017-11-22 14:57:26','Viewed Finance Printed Estimates Setting page','10932104','192.168.1.21'),(410,'2017-11-22 14:58:20','Viewed Finance Printed Estimates Setting page','10932104','192.168.1.21'),(411,'2017-11-22 14:58:45','Viewed Parents Cashbook Finance Voteheads Setting page','10932104','192.168.1.21'),(412,'2017-11-22 14:58:54','Viewed Finance Printed Estimates Setting page','10932104','192.168.1.21'),(413,'2017-11-22 14:58:56','Viewed Finance Printed Estimates Setting page','10932104','192.168.1.21'),(414,'2017-11-22 14:58:56','Viewed Printed Estimates page','10932104','192.168.1.21'),(415,'2017-11-22 14:59:05','Viewed Printed Estimates page','10932104','192.168.1.21'),(416,'2017-11-22 15:00:05','Viewed Finance Fiscal Yr Setting page','10932104','192.168.1.21'),(417,'2017-11-22 15:00:20','Viewed Parents Cashbook Finance Voteheads Setting page','10932104','192.168.1.21'),(418,'2017-11-22 15:00:33','Viewed Parents Cashbook Finance Voteheads Setting page','admin','127.0.0.1'),(419,'2017-11-22 15:00:35','Viewed Parents Cashbook Finance Voteheads Setting page','admin','127.0.0.1'),(420,'2017-11-22 15:00:36','Viewed Finance Printed Estimates Setting page','10932104','192.168.1.21'),(421,'2017-11-22 15:00:37','Viewed Parents Cashbook Finance Voteheads Setting page','admin','127.0.0.1'),(422,'2017-11-22 15:00:38','Viewed Parents Cashbook Finance Voteheads Setting page','admin','127.0.0.1'),(423,'2017-11-22 15:00:41','Viewed Finance Fiscal Yr Setting page','admin','127.0.0.1'),(424,'2017-11-22 15:00:43','Viewed Finance Voteheads Setting page','admin','127.0.0.1'),(425,'2017-11-22 15:00:45','Viewed Parents Cashbook Finance Voteheads Setting page','admin','127.0.0.1'),(426,'2017-11-22 15:00:48','Viewed Finance Printed Estimates Setting page','10932104','192.168.1.21'),(427,'2017-11-22 15:01:17','Viewed Parents Cashbook Finance Voteheads Setting page','admin','127.0.0.1'),(428,'2017-11-22 15:01:18','Viewed Parents Cashbook Finance Voteheads Setting page','admin','127.0.0.1'),(429,'2017-11-22 15:01:21','Viewed Finance Record Balances page','10932104','192.168.1.21'),(430,'2017-11-22 15:01:21','View Administrator*s Dashboard','admin','127.0.0.1'),(431,'2017-11-22 15:01:22','Viewed Finance Voteheads Setting page','10932104','192.168.1.21'),(432,'2017-11-22 15:01:35','Viewed Finance Printed Estimates Setting page','10932104','192.168.1.21'),(433,'2017-11-22 15:01:39','Viewed Finance Printed Estimates Setting page','10932104','192.168.1.21'),(434,'2017-11-22 15:01:43','Viewed Finance Printed Estimates Setting page','10932104','192.168.1.21'),(435,'2017-11-22 15:02:07','Viewed Finance Fiscal Yr Setting page','10932104','192.168.1.21'),(436,'2017-11-22 15:02:11','Viewed Parents Cashbook Finance Voteheads Setting page','10932104','192.168.1.21'),(437,'2017-11-22 15:02:32','Viewed Parents Cashbook Finance Voteheads Setting page','10932104','192.168.1.21'),(438,'2017-11-22 15:02:32','New Votehead CAUTION','10932104','192.168.1.21'),(439,'2017-11-22 15:02:33','Viewed Parents Cashbook Finance Voteheads Setting page','10932104','192.168.1.21'),(440,'2017-11-22 15:02:36','Viewed Finance Printed Estimates Setting page','10932104','192.168.1.21'),(441,'2017-11-22 15:02:44','Viewed Finance Printed Estimates Setting page','10932104','192.168.1.21'),(442,'2017-11-22 15:02:44','Viewed Printed Estimates page','10932104','192.168.1.21'),(443,'2017-11-22 15:02:49','Viewed Printed Estimates page','10932104','192.168.1.21'),(444,'2017-11-22 15:03:09','New Votehead Fees CAUTION','10932104','192.168.1.21'),(445,'2017-11-22 15:03:10','Viewed Printed Estimates page','10932104','192.168.1.21'),(446,'2017-11-22 15:03:20','Viewed Finance Printed Estimates Setting page','10932104','192.168.1.21'),(447,'2017-11-22 15:03:45','Viewed student list','admin','127.0.0.1'),(448,'2017-11-22 15:03:45','Viewed student list','admin','127.0.0.1'),(449,'2017-11-22 15:03:56','View Administrator*s Dashboard','admin','127.0.0.1'),(450,'2017-11-22 15:06:46','Viewed Finance Printed Estimates Setting page','10932104','192.168.1.21'),(451,'2017-11-22 15:07:14','View Administrator*s Dashboard','admin','127.0.0.1'),(452,'2017-11-22 15:07:16','Viewed student list','admin','127.0.0.1'),(453,'2017-11-22 15:07:17','Viewed student list','admin','127.0.0.1'),(454,'2017-11-22 15:07:22','Viewed Finance Printed Estimates Setting page','10932104','192.168.1.21'),(455,'2017-11-22 15:07:52','Viewed Finance Printed Estimates Setting page','10932104','192.168.1.21'),(456,'2017-11-22 15:07:58','Viewed Finance Fiscal Yr Setting page','10932104','192.168.1.21'),(457,'2017-11-22 15:07:58','Viewed Finance Fiscal Yr Setting page','10932104','192.168.1.21'),(458,'2017-11-22 15:08:03','View Administrator*s Dashboard','admin','127.0.0.1'),(459,'2017-11-22 15:08:07','Viewed Finance Printed Estimates Setting page','10932104','192.168.1.21'),(460,'2017-11-22 15:09:29','Successful Login','admin','127.0.0.1'),(461,'2017-11-22 15:09:30','View Administrator*s Dashboard','admin','127.0.0.1'),(462,'2017-11-22 15:09:38','Un-Successful Login','10932104','192.168.1.21'),(463,'2017-11-22 15:09:47','Successful Login','10932104','192.168.1.21'),(464,'2017-11-22 15:09:48','View Accountant*s Dashboard','10932104','192.168.1.21'),(465,'2017-11-22 15:09:50','View Finance Dashboard','10932104','192.168.1.21'),(466,'2017-11-22 15:09:52','Viewed Finance Printed Estimates Setting page','10932104','192.168.1.21'),(467,'2017-11-22 15:10:15','View Finance Dashboard','admin','127.0.0.1'),(468,'2017-11-22 15:10:23','Viewed Finance Printed Estimates Setting page','admin','127.0.0.1'),(469,'2017-11-22 15:10:27','Viewed Finance Printed Estimates Setting page','admin','127.0.0.1'),(470,'2017-11-22 15:10:28','Viewed Finance Printed Estimates Setting page','10932104','192.168.1.21'),(471,'2017-11-22 15:11:00','Viewed Finance Record Balances page','10932104','192.168.1.21'),(472,'2017-11-22 15:11:01','Viewed Finance Voteheads Setting page','10932104','192.168.1.21'),(473,'2017-11-22 15:11:16','Viewed Finance Voteheads Setting page','10932104','192.168.1.21'),(474,'2017-11-22 15:11:39','Viewed Finance Printed Estimates Setting page','10932104','192.168.1.21'),(475,'2017-11-22 15:11:43','Viewed Finance Printed Estimates Setting page','10932104','192.168.1.21'),(476,'2017-11-22 15:11:46','Viewed Finance Printed Estimates Setting page','admin','127.0.0.1'),(477,'2017-11-22 15:11:46','Viewed Finance Voteheads Setting page','10932104','192.168.1.21'),(478,'2017-11-22 15:11:47','Viewed Finance Printed Estimates Setting page','10932104','192.168.1.21'),(479,'2017-11-22 15:11:51','Viewed Finance Printed Estimates Setting page','admin','127.0.0.1'),(480,'2017-11-22 15:11:52','Viewed Finance Printed Estimates Setting page','admin','127.0.0.1'),(481,'2017-11-22 15:13:28','Viewed Finance Printed Estimates Setting page','admin','127.0.0.1'),(482,'2017-11-22 15:13:29','Viewed Finance Voteheads Setting page','10932104','192.168.1.21'),(483,'2017-11-22 15:13:38','Viewed Finance Printed Estimates Setting page','admin','127.0.0.1'),(484,'2017-11-22 15:13:41','Viewed Finance Voteheads Setting page','10932104','192.168.1.21'),(485,'2017-11-22 15:13:53','Viewed Finance Printed Estimates Setting page','admin','127.0.0.1'),(486,'2017-11-22 15:13:55','Viewed Finance Printed Estimates Setting page','admin','127.0.0.1'),(487,'2017-11-22 15:13:56','Viewed Finance Printed Estimates Setting page','admin','127.0.0.1'),(488,'2017-11-22 15:14:41','Viewed Finance Printed Estimates Setting page','admin','127.0.0.1'),(489,'2017-11-22 15:14:56','Viewed Finance Printed Estimates Setting page','admin','127.0.0.1'),(490,'2017-11-22 15:14:58','Viewed Finance Printed Estimates Setting page','admin','127.0.0.1'),(491,'2017-11-22 15:15:51','Viewed Finance Voteheads Setting page','10932104','192.168.1.21'),(492,'2017-11-22 15:17:27','Viewed Votehead Balances page','10932104','192.168.1.21'),(493,'2017-11-22 15:17:29','Viewed Votehead Balances page','10932104','192.168.1.21'),(494,'2017-11-22 15:17:31','Viewed Votehead Balances page','10932104','192.168.1.21'),(495,'2017-11-22 15:17:33','Viewed Receipt Copy 1','10932104','192.168.1.21'),(496,'2017-11-22 15:37:34','Viewed Votehead Balances page','admin','127.0.0.1'),(497,'2017-11-22 15:37:37','Viewed Votehead Balances page','admin','127.0.0.1'),(498,'2017-11-22 15:37:38','Viewed Votehead Balances page','admin','127.0.0.1'),(499,'2017-11-22 15:37:40','Viewed Receipt Copy 1','admin','127.0.0.1'),(500,'2017-11-22 15:39:30','Viewed Finance Voteheads Setting page','10932104','192.168.1.21'),(501,'2017-11-22 15:39:50','Viewed Votehead Balances page','10932104','192.168.1.21'),(502,'2017-11-22 15:40:00','Viewed Votehead Balances page','10932104','192.168.1.21'),(503,'2017-11-22 15:40:17','Viewed Votehead Balances page','10932104','192.168.1.21'),(504,'2017-11-22 15:41:10','Viewed Finance pocket money page','10932104','192.168.1.21'),(505,'2017-11-22 15:41:24','Viewed Finance Voteheads Setting page','10932104','192.168.1.21'),(506,'2017-11-22 15:41:38','Viewed Votehead Balances page','10932104','192.168.1.21'),(507,'2017-11-22 15:42:06','Viewed Votehead Balances page','10932104','192.168.1.21'),(508,'2017-11-22 15:42:11','Viewed Votehead Balances page','10932104','192.168.1.21'),(509,'2017-11-22 15:42:27','Viewed Receipt Copy 1','10932104','192.168.1.21'),(510,'2017-11-22 15:45:10','Viewed Votehead Balances page','admin','127.0.0.1'),(511,'2017-11-22 15:45:12','Viewed fees balances','admin','127.0.0.1'),(512,'2017-11-22 15:45:13','Viewed Finance Printed Estimates Setting page','admin','127.0.0.1'),(513,'2017-11-22 15:45:14','Viewed Votehead Balances page','admin','127.0.0.1'),(514,'2017-11-22 15:45:15','Viewed fees register','admin','127.0.0.1'),(515,'2017-11-22 15:45:17','Viewed fees register','admin','127.0.0.1'),(516,'2017-11-22 15:45:20','Viewed Votehead Balances page','admin','127.0.0.1'),(517,'2017-11-22 15:45:25','Viewed Votehead Balances page','admin','127.0.0.1'),(518,'2017-11-22 15:45:28','Viewed Votehead Balances page','admin','127.0.0.1'),(519,'2017-11-22 15:45:38','Viewed Finance Voteheads Setting page','10932104','192.168.1.21'),(520,'2017-11-22 15:45:42','Viewed Finance Voteheads Setting page','10932104','192.168.1.21'),(521,'2017-11-22 15:45:52','Viewed Votehead Balances page','10932104','192.168.1.21'),(522,'2017-11-22 15:45:55','Viewed Votehead Balances page','10932104','192.168.1.21'),(523,'2017-11-22 15:46:01','Viewed Votehead Balances page','10932104','192.168.1.21'),(524,'2017-11-22 15:46:09','Viewed Receipt Copy 1','10932104','192.168.1.21'),(525,'2017-11-22 15:46:29','View Administrator*s Dashboard','admin','127.0.0.1'),(526,'2017-11-22 15:47:01','Viewed fees register','10932104','192.168.1.21'),(527,'2017-11-22 15:47:08','Viewed fees register','10932104','192.168.1.21'),(528,'2017-11-22 15:47:24','Viewed Votehead Balances page','10932104','192.168.1.21'),(529,'2017-11-22 15:47:28','Viewed Votehead Balances page','10932104','192.168.1.21'),(530,'2017-11-22 15:47:54','Viewed fees register','10932104','192.168.1.21'),(531,'2017-11-22 15:48:02','Viewed fees register','10932104','192.168.1.21'),(532,'2017-11-22 15:48:38','Viewed Votehead Balances page','10932104','192.168.1.21'),(533,'2017-11-22 15:48:39','Viewed Votehead Balances page','10932104','192.168.1.21'),(534,'2017-11-22 15:48:41','Viewed Votehead Balances page','10932104','192.168.1.21'),(535,'2017-11-22 15:49:02','Viewed fees register','10932104','192.168.1.21'),(536,'2017-11-22 15:49:14','Viewed fees register','10932104','192.168.1.21'),(537,'2017-11-22 15:49:26','View Administrator*s Dashboard','admin','127.0.0.1'),(538,'2017-11-22 15:49:29','Viewed fees register','10932104','192.168.1.21'),(539,'2017-11-22 15:49:48','View Administrator*s Dashboard','admin','127.0.0.1'),(540,'2017-11-22 15:49:57','Viewed fees register','10932104','192.168.1.21'),(541,'2017-11-22 15:50:09','Viewed fees register','10932104','192.168.1.21'),(542,'2017-11-22 15:50:42','View Administrator*s Dashboard','admin','127.0.0.1'),(543,'2017-11-22 15:51:51','Viewed Finance Printed Estimates Setting page','10932104','192.168.1.21'),(544,'2017-11-22 15:51:51','Viewed Votehead Balances page','10932104','192.168.1.21'),(545,'2017-11-22 15:51:56','Viewed Votehead Balances page','10932104','192.168.1.21'),(546,'2017-11-22 15:52:09','Viewed Finance Voteheads Setting page','10932104','192.168.1.21'),(547,'2017-11-22 15:52:40','Viewed Finance Fiscal Yr Setting page','10932104','192.168.1.21'),(548,'2017-11-22 15:52:42','Viewed Finance Voteheads Setting page','10932104','192.168.1.21'),(549,'2017-11-22 15:53:17','Viewed Finance Voteheads Setting page','10932104','192.168.1.21'),(550,'2017-11-22 15:53:18','Added a new Bank Account PETTY CASH','10932104','192.168.1.21'),(551,'2017-11-22 15:53:19','Viewed Finance Voteheads Setting page','10932104','192.168.1.21'),(552,'2017-11-22 15:53:23','Viewed Finance Voteheads Setting page','10932104','192.168.1.21'),(553,'2017-11-22 15:53:54','Viewed Finance Voteheads Setting page','10932104','192.168.1.21'),(554,'2017-11-22 15:53:54','made an expese on LT&T on TYRE CHANGE for  200','10932104','192.168.1.21'),(555,'2017-11-22 15:53:55','Viewed Finance Voteheads Setting page','10932104','192.168.1.21'),(556,'2017-11-22 15:55:42','Viewed Finance Fiscal Yr Setting page','10932104','192.168.1.21'),(557,'2017-11-22 15:55:45','Viewed Finance Voteheads Setting page','10932104','192.168.1.21'),(558,'2017-11-22 15:55:49','Viewed Parents Cashbook Finance Voteheads Setting page','10932104','192.168.1.21'),(559,'2017-11-22 15:55:54','View Administrator*s Dashboard','admin','127.0.0.1'),(560,'2017-11-22 15:55:59','Viewed Finance Printed Estimates Setting page','10932104','192.168.1.21'),(561,'2017-11-22 15:56:40','Viewed Finance Printed Estimates Setting page','10932104','192.168.1.21'),(562,'2017-11-22 15:57:01','View Administrator*s Dashboard','admin','127.0.0.1'),(563,'2017-11-22 15:57:03','View Administrator*s Dashboard','admin','127.0.0.1'),(564,'2017-11-22 15:58:05','View school enrollment page','admin','127.0.0.1'),(565,'2017-11-22 15:58:37','View Administrator*s Dashboard','admin','127.0.0.1'),(566,'2017-11-22 15:58:55','Viewed Finance Printed Estimates Setting page','10932104','192.168.1.21'),(567,'2017-11-22 16:00:48','Viewed Finance Printed Estimates Setting page','10932104','192.168.1.21'),(568,'2017-11-22 16:01:56','Viewed Finance Printed Estimates Setting page','10932104','192.168.1.21'),(569,'2017-11-22 16:02:53','Successful Logout','10932104','192.168.1.21'),(570,'2017-11-22 16:03:32','View Administrator*s Dashboard','admin','127.0.0.1'),(571,'2017-11-22 16:04:00','View Administrator*s Dashboard','admin','127.0.0.1'),(572,'2017-11-22 16:04:11','Successful Login','10932104','192.168.1.21'),(573,'2017-11-22 16:04:11','View Accountant*s Dashboard','10932104','192.168.1.21'),(574,'2017-11-22 16:04:42','View Finance Dashboard','10932104','192.168.1.21'),(575,'2017-11-22 16:04:51','View School Setting Page','admin','127.0.0.1'),(576,'2017-11-22 16:04:53','Viewed Settings streams page','admin','127.0.0.1'),(577,'2017-11-22 16:04:54','Viewed Finance Printed Estimates Setting page','10932104','192.168.1.21'),(578,'2017-11-22 16:04:55','View school enrollment page','admin','127.0.0.1'),(579,'2017-11-22 16:04:56','Backed up Database','admin','127.0.0.1'),(580,'2017-11-22 16:05:03','View Administrator*s Dashboard','admin','127.0.0.1'),(581,'2017-11-22 16:05:03','Viewed Finance Voteheads Setting page','10932104','192.168.1.21'),(582,'2017-11-22 16:05:12','Viewed student list','admin','127.0.0.1'),(583,'2017-11-22 16:05:13','Viewed student list','admin','127.0.0.1'),(584,'2017-11-22 16:05:21','Viewed Finance Voteheads Setting page','10932104','192.168.1.21'),(585,'2017-11-22 16:05:21','Viewed Finance Voteheads Setting page','10932104','192.168.1.21'),(586,'2017-11-22 16:05:24','View Administrator*s Dashboard','admin','127.0.0.1'),(587,'2017-11-22 16:05:29','Viewed student list','admin','127.0.0.1'),(588,'2017-11-22 16:05:29','Viewed student list','admin','127.0.0.1'),(589,'2017-11-22 16:05:40','Viewed Finance Voteheads Setting page','10932104','192.168.1.21'),(590,'2017-11-22 16:06:06','Viewed Finance Voteheads Setting page','10932104','192.168.1.21'),(591,'2017-11-22 16:06:18','Viewed Class list','admin','127.0.0.1'),(592,'2017-11-22 16:06:25','Viewed Class list','admin','127.0.0.1'),(593,'2017-11-22 16:07:20','Viewed Finance Voteheads Setting page','10932104','192.168.1.21'),(594,'2017-11-22 16:07:49','View Administrator*s Dashboard','admin','127.0.0.1'),(595,'2017-11-22 16:07:54','View Administrator*s Dashboard','admin','127.0.0.1'),(596,'2017-11-22 16:07:56','View School Setting Page','admin','127.0.0.1'),(597,'2017-11-22 16:07:58','Viewed Settings streams page','admin','127.0.0.1'),(598,'2017-11-22 16:07:59','View school enrollment page','admin','127.0.0.1'),(599,'2017-11-22 16:08:43','View Administrator*s Dashboard','admin','127.0.0.1'),(600,'2017-11-22 16:12:39','Backed up Database','admin','127.0.0.1'),(601,'2017-11-22 16:12:41','Backed up Database','admin','127.0.0.1'),(602,'2017-11-23 08:12:57','Successful Login','admin','192.168.1.235'),(603,'2017-11-23 08:12:58','View Administrator*s Dashboard','admin','192.168.1.235'),(604,'2017-11-23 08:13:05','View HR Dashboard','admin','192.168.1.235'),(605,'2017-11-23 08:43:45','Un-Successful Login','daniel','192.168.1.21'),(606,'2017-11-23 08:44:22','Successful Login','10932104','192.168.1.21'),(607,'2017-11-23 08:44:22','View Accountant*s Dashboard','10932104','192.168.1.21'),(608,'2017-11-23 08:45:31','View Finance Dashboard','10932104','192.168.1.21'),(609,'2017-11-23 08:45:47','Viewed Finance Voteheads Setting page','10932104','192.168.1.21'),(610,'2017-11-23 09:10:48','Un-Successful Login','10210932104','192.168.1.21'),(611,'2017-11-23 09:11:14','Successful Login','10932104','192.168.1.21'),(612,'2017-11-23 09:11:15','View Accountant*s Dashboard','10932104','192.168.1.21'),(613,'2017-11-23 09:11:33','View Finance Dashboard','10932104','192.168.1.21'),(614,'2017-11-23 09:11:52','Viewed Finance Printed Estimates Setting page','10932104','192.168.1.21'),(615,'2017-11-23 09:33:44','Viewed Finance Printed Estimates Setting page','10932104','192.168.1.21'),(616,'2017-11-23 09:36:25','Viewed Finance Printed Estimates Setting page','10932104','192.168.1.21'),(617,'2017-11-23 09:38:10','Viewed Finance Printed Estimates Setting page','10932104','192.168.1.21'),(618,'2017-11-23 09:40:31','Viewed Finance Printed Estimates Setting page','10932104','192.168.1.21'),(619,'2017-11-23 09:40:46','Viewed Finance Printed Estimates Setting page','10932104','192.168.1.21'),(620,'2017-11-23 09:43:31','Viewed Finance Printed Estimates Setting page','10932104','192.168.1.21'),(621,'2017-11-23 09:46:52','Viewed Finance Printed Estimates Setting page','10932104','192.168.1.21'),(622,'2017-11-23 09:53:29','Viewed Finance Printed Estimates Setting page','10932104','192.168.1.21'),(623,'2017-11-23 09:53:57','Viewed Finance Printed Estimates Setting page','10932104','192.168.1.21'),(624,'2017-11-23 09:54:06','Viewed Finance Printed Estimates Setting page','10932104','192.168.1.21'),(625,'2017-11-23 09:54:06','Viewed Printed Estimates page','10932104','192.168.1.21'),(626,'2017-11-23 09:54:29','Viewed Finance Record Balances page','10932104','192.168.1.21'),(627,'2017-11-23 09:54:32','Viewed Finance Record Balances page','10932104','192.168.1.21'),(628,'2017-11-23 09:54:33','Viewed Finance Record Balances page','10932104','192.168.1.21'),(629,'2017-11-23 09:54:33','Viewed Finance Record Balances page','10932104','192.168.1.21'),(630,'2017-11-23 11:11:00','Successful Login','admin','192.168.1.235'),(631,'2017-11-23 11:11:00','View Administrator*s Dashboard','admin','192.168.1.235'),(632,'2017-11-23 11:11:06','View Finance Dashboard','admin','192.168.1.235'),(633,'2017-11-23 11:11:14','Viewed Parents Cashbook Finance Voteheads Setting page','admin','192.168.1.235'),(634,'2017-11-23 11:11:32','Viewed Finance Printed Estimates Setting page','admin','192.168.1.235'),(635,'2017-11-23 11:11:36','Viewed Finance Printed Estimates Setting page','admin','192.168.1.235'),(636,'2017-11-23 11:11:44','Backed up Database','admin','192.168.1.235');
UNLOCK TABLES;
/*!40000 ALTER TABLE `tblaudittrail` ENABLE KEYS */;

--
-- Table structure for table `tbldispline`
--

DROP TABLE IF EXISTS `tbldispline`;
CREATE TABLE `tbldispline` (
  `id` int(11) NOT NULL auto_increment,
  `admno` varchar(100) NOT NULL,
  `comments` text NOT NULL,
  `comment_by` varchar(100) NOT NULL,
  `date_added` varchar(100) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbldispline`
--


/*!40000 ALTER TABLE `tbldispline` DISABLE KEYS */;
LOCK TABLES `tbldispline` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `tbldispline` ENABLE KEYS */;

--
-- Table structure for table `tbleperformancetrack`
--

DROP TABLE IF EXISTS `tbleperformancetrack`;
CREATE TABLE `tbleperformancetrack` (
  `admno` varchar(100) NOT NULL,
  `form` varchar(100) NOT NULL,
  `year` int(4) NOT NULL,
  `term` int(5) NOT NULL,
  `stream` varchar(100) NOT NULL,
  `s_status` int(1) NOT NULL default '0',
  PRIMARY KEY  (`admno`,`form`,`year`,`term`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbleperformancetrack`
--


/*!40000 ALTER TABLE `tbleperformancetrack` DISABLE KEYS */;
LOCK TABLES `tbleperformancetrack` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `tbleperformancetrack` ENABLE KEYS */;

--
-- Table structure for table `tbleperformancetrackmock`
--

DROP TABLE IF EXISTS `tbleperformancetrackmock`;
CREATE TABLE `tbleperformancetrackmock` (
  `admno` varchar(100) NOT NULL,
  `form` varchar(100) NOT NULL,
  `year` int(4) NOT NULL,
  `term` int(5) NOT NULL,
  `stream` varchar(100) NOT NULL,
  `s_status` int(1) NOT NULL default '0',
  PRIMARY KEY  (`admno`,`form`,`year`,`term`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbleperformancetrackmock`
--


/*!40000 ALTER TABLE `tbleperformancetrackmock` DISABLE KEYS */;
LOCK TABLES `tbleperformancetrackmock` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `tbleperformancetrackmock` ENABLE KEYS */;

--
-- Table structure for table `tblgrades`
--

DROP TABLE IF EXISTS `tblgrades`;
CREATE TABLE `tblgrades` (
  `subject` varchar(100) NOT NULL,
  `minv` decimal(18,2) NOT NULL,
  `maxv` decimal(18,2) NOT NULL,
  `grade` varchar(2) NOT NULL,
  `remarks` text NOT NULL,
  `points` int(2) NOT NULL,
  `form` varchar(3) NOT NULL,
  PRIMARY KEY  (`subject`,`minv`,`maxv`,`grade`,`form`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblgrades`
--


/*!40000 ALTER TABLE `tblgrades` DISABLE KEYS */;
LOCK TABLES `tblgrades` WRITE;
INSERT INTO `tblgrades` VALUES ('ENGLISH','0.00','29.00','E','Work Harder',1,'1-2'),('ENGLISH','30.00','34.00','D-','Work Harder',2,'1-2'),('ENGLISH','35.00','39.00','D','Improve',3,'1-2'),('ENGLISH','40.00','44.00','D+','Can do better',4,'1-2'),('ENGLISH','45.00','49.00','C-','Fair',5,'1-2'),('ENGLISH','50.00','54.00','C','Fair',6,'1-2'),('ENGLISH','55.00','59.00','C+','Fair',7,'1-2'),('ENGLISH','60.00','64.00','B-','Good',8,'1-2'),('ENGLISH','65.00','69.00','B','Good',9,'1-2'),('ENGLISH','70.00','74.00','B+','Good',10,'1-2'),('ENGLISH','75.00','79.00','A-','Very Good',11,'1-2'),('ENGLISH','80.00','100.00','A','Excellent',12,'1-2'),('KISWAHILI','0.00','29.00','E','Sharti Usome',1,'1-2'),('KISWAHILI','30.00','34.00','D-','Tia bidii',2,'1-2'),('KISWAHILI','35.00','39.00','D','Tia bidii',3,'1-2'),('KISWAHILI','40.00','44.00','D+','Tia bidii',4,'1-2'),('KISWAHILI','45.00','49.00','C-','Jitahidi',5,'1-2'),('KISWAHILI','50.00','54.00','C','Jitahidi',6,'1-2'),('KISWAHILI','55.00','59.00','C+','Jaribio Zuri',7,'1-2'),('KISWAHILI','60.00','64.00','B-','Jaribio Zuri',8,'1-2'),('KISWAHILI','65.00','69.00','B','Njema',9,'1-2'),('KISWAHILI','70.00','74.00','B+','Njema',10,'1-2'),('KISWAHILI','75.00','79.00','A-','Hongera',11,'1-2'),('KISWAHILI','80.00','100.00','A','Hongera',12,'1-2'),('HISTORY','0.00','29.00','E','Work Harder',1,'1-2'),('HISTORY','30.00','34.00','D-','Work Hard',2,'1-2'),('HISTORY','35.00','39.00','D','Improve',3,'1-2'),('HISTORY','40.00','44.00','D+','Can do better',4,'1-2'),('HISTORY','45.00','49.00','C-','Fair',5,'1-2'),('HISTORY','50.00','54.00','C','Fair',6,'1-2'),('HISTORY','55.00','59.00','C+','Fair',7,'1-2'),('HISTORY','60.00','64.00','B-','Good',8,'1-2'),('HISTORY','65.00','69.00','B','Good',9,'1-2'),('HISTORY','70.00','74.00','B+','Good',10,'1-2'),('HISTORY','75.00','79.00','A-','Very Good',11,'1-2'),('HISTORY','80.00','100.00','A','Excellent',12,'1-2'),('HISTORY','40.00','44.00','D+','Can do better',4,'3-4'),('HISTORY','35.00','39.00','D','Improve',3,'3-4'),('HISTORY','30.00','34.00','D-','Work Hard',2,'3-4'),('HISTORY','0.00','29.00','E','Work Harder',1,'3-4'),('CRE','80.00','100.00','A','Excellent',12,'3-4'),('CRE','75.00','79.00','A-','Very Good',11,'3-4'),('CRE','70.00','74.00','B+','Good',10,'3-4'),('CRE','65.00','69.00','B','Good',9,'3-4'),('CRE','60.00','64.00','B-','Good',8,'3-4'),('CRE','55.00','59.00','C+','Fair',7,'3-4'),('CRE','50.00','54.00','C','Fair',6,'3-4'),('CRE','35.00','39.00','D','Improve',3,'3-4'),('CRE','30.00','34.00','D-','Work Hard',2,'3-4'),('CRE','0.00','29.00','E','Work Harder',1,'3-4'),('CRE','80.00','100.00','A','Excellent',12,'1-2'),('CRE','0.00','29.00','E','Work Harder',1,'1-2'),('GEOGRAPHY','75.00','79.00','A-','Very Good',11,'1-2'),('GEOGRAPHY','65.00','69.00','B','Good',9,'1-2'),('GEOGRAPHY','50.00','54.00','C','Fair',6,'1-2'),('GEOGRAPHY','45.00','49.00','C-','Fair',5,'1-2'),('B/STUDIES','80.00','100.00','A','Excellent',12,'1-2'),('B/STUDIES','70.00','74.00','B+','Good',10,'1-2'),('B/STUDIES','60.00','64.00','B-','Good',8,'1-2'),('B/STUDIES','50.00','54.00','C','Fair',6,'1-2'),('B/STUDIES','30.00','34.00','D-','Work Hard',2,'1-2'),('AGRICULTURE','69.50','74.49','B+','Good',10,'1-2'),('AGRICULTURE','60.00','64.00','B-','Good',8,'1-2'),('AGRICULTURE','50.00','54.00','C','Fair',6,'1-2'),('AGRICULTURE','35.00','39.00','D','Improve',3,'1-2'),('AGRICULTURE','30.00','34.00','D-','Work Hard',2,'1-2'),('AGRICULTURE','80.00','100.00','A','Excellent',12,'3-4'),('AGRICULTURE','65.00','69.00','B','Good',9,'3-4'),('AGRICULTURE','60.00','64.00','B-','Good',8,'3-4'),('AGRICULTURE','55.00','59.00','C+','Fair',7,'3-4'),('AGRICULTURE','35.00','39.00','D','Improve',3,'3-4'),('AGRICULTURE','30.00','34.00','D-','Work Hard',2,'3-4'),('MATHS','0.00','25.00','E','Work Harder',1,'3-4'),('MATHS','26.00','34.00','D-','Work Harder',2,'3-4'),('MATHS','35.00','39.00','D','Improve',3,'3-4'),('MATHS','40.00','44.00','D+','Can do better',4,'3-4'),('MATHS','45.00','49.00','C-','Fair',5,'3-4'),('MATHS','50.00','54.00','C','Fair',6,'3-4'),('MATHS','55.00','59.00','C+','Fair',7,'3-4'),('MATHS','60.00','64.00','B-','Good',8,'3-4'),('MATHS','65.00','69.00','B','Good',9,'3-4'),('MATHS','70.00','74.00','B+','Good',10,'3-4'),('MATHS','75.00','79.00','A-','Very Good',11,'3-4'),('MATHS','80.00','100.00','A','Excellent',12,'3-4'),('BIOLOGY','0.00','25.00','E','Work Harder',1,'3-4'),('BIOLOGY','26.00','34.00','D-','Work Harder',2,'3-4'),('BIOLOGY','35.00','39.00','D','Improve',3,'3-4'),('BIOLOGY','40.00','44.00','D+','Can do better',4,'3-4'),('BIOLOGY','45.00','49.00','C-','Fair',5,'3-4'),('BIOLOGY','50.00','54.00','C','Fair',6,'3-4'),('BIOLOGY','55.00','59.00','C+','Fair',7,'3-4'),('BIOLOGY','60.00','64.00','B-','Good',8,'3-4'),('BIOLOGY','65.00','69.00','B','Good',9,'3-4'),('BIOLOGY','70.00','74.00','B+','Good',10,'3-4'),('BIOLOGY','75.00','79.00','A-','Very Good',11,'3-4'),('BIOLOGY','80.00','100.00','A','Excellent',12,'3-4'),('PHYSICS','0.00','25.00','E','Work Harder',1,'3-4'),('PHYSICS','26.00','34.00','D-','Work Harder',2,'3-4'),('PHYSICS','35.00','39.00','D','Improve',3,'3-4'),('PHYSICS','40.00','44.00','D+','Can do better',4,'3-4'),('PHYSICS','45.00','49.00','C-','Fair',5,'3-4'),('PHYSICS','50.00','54.00','C','Fair',6,'3-4'),('PHYSICS','55.00','59.00','C+','Fair',7,'3-4'),('PHYSICS','60.00','64.00','B-','Good',8,'3-4'),('PHYSICS','65.00','69.00','B','Good',9,'3-4'),('PHYSICS','70.00','74.00','B+','Good',10,'3-4'),('PHYSICS','75.00','79.00','A-','Very Good',11,'3-4'),('PHYSICS','80.00','100.00','A','Excellent',12,'3-4'),('CHEMISTRY','0.00','25.00','E','Work Harder',1,'3-4'),('CHEMISTRY','26.00','34.00','D-','Work Harder',2,'3-4'),('CHEMISTRY','35.00','39.00','D','Improve',3,'3-4'),('CHEMISTRY','40.00','44.00','D+','Can do better',4,'3-4'),('CHEMISTRY','45.00','49.00','C-','Fair',5,'3-4'),('CHEMISTRY','50.00','54.00','C','Fair',6,'3-4'),('CHEMISTRY','55.00','59.00','C+','Fair',7,'3-4'),('CHEMISTRY','60.00','64.00','B-','Good',8,'3-4'),('CHEMISTRY','65.00','69.00','B','Good',9,'3-4'),('CHEMISTRY','70.00','74.00','B+','Good',10,'3-4'),('CHEMISTRY','75.00','79.00','A-','Very Good',11,'3-4'),('CHEMISTRY','80.00','100.00','A','Excellent',12,'3-4'),('MATHS','0.00','25.00','E','Work Harder',1,'1-2'),('MATHS','26.00','34.00','D-','Work Harder',2,'1-2'),('MATHS','35.00','39.00','D','Improve',3,'1-2'),('MATHS','40.00','44.00','D+','Can do better',4,'1-2'),('MATHS','45.00','49.00','C-','Fair',5,'1-2'),('MATHS','50.00','54.00','C','Fair',6,'1-2'),('MATHS','55.00','59.00','C+','Fair',7,'1-2'),('MATHS','60.00','64.00','B-','Good',8,'1-2'),('MATHS','65.00','69.00','B','Good',9,'1-2'),('MATHS','70.00','74.00','B+','Good',10,'1-2'),('MATHS','75.00','79.00','A-','Very Good',11,'1-2'),('MATHS','80.00','100.00','A','Excellent',12,'1-2'),('BIOLOGY','0.00','25.00','E','Work Harder',1,'1-2'),('BIOLOGY','26.00','34.00','D-','Work Harder',2,'1-2'),('BIOLOGY','35.00','39.00','D','Improve',3,'1-2'),('BIOLOGY','40.00','44.00','D+','Can do better',4,'1-2'),('BIOLOGY','45.00','49.00','C-','Fair',5,'1-2'),('BIOLOGY','50.00','54.00','C','Fair',6,'1-2'),('BIOLOGY','55.00','59.00','C+','Fair',7,'1-2'),('BIOLOGY','60.00','64.00','B-','Good',8,'1-2'),('BIOLOGY','65.00','69.00','B','Good',9,'1-2'),('BIOLOGY','70.00','74.00','B+','Good',10,'1-2'),('BIOLOGY','75.00','79.00','A-','Very Good',11,'1-2'),('BIOLOGY','80.00','100.00','A','Excellent',12,'1-2'),('PHYSICS','0.00','25.00','E','Work Harder',1,'1-2'),('PHYSICS','26.00','34.00','D-','Work Harder',2,'1-2'),('PHYSICS','35.00','39.00','D','Improve',3,'1-2'),('PHYSICS','40.00','44.00','D+','Can do better',4,'1-2'),('PHYSICS','45.00','49.00','C-','Fair',5,'1-2'),('PHYSICS','50.00','54.00','C','Fair',6,'1-2'),('PHYSICS','55.00','59.00','C+','Fair',7,'1-2'),('PHYSICS','60.00','64.00','B-','Good',8,'1-2'),('PHYSICS','65.00','69.00','B','Good',9,'1-2'),('PHYSICS','70.00','74.00','B+','Good',10,'1-2'),('PHYSICS','75.00','79.00','A-','Very Good',11,'1-2'),('PHYSICS','80.00','100.00','A','Excellent',12,'1-2'),('CHEMISTRY','0.00','25.00','E','Work Harder',1,'1-2'),('CHEMISTRY','26.00','34.00','D-','Work Harder',2,'1-2'),('CHEMISTRY','35.00','39.00','D','Improve',3,'1-2'),('CHEMISTRY','40.00','44.00','D+','Can do better',4,'1-2'),('CHEMISTRY','45.00','49.00','C-','Fair',5,'1-2'),('CHEMISTRY','50.00','54.00','C','Fair',6,'1-2'),('CHEMISTRY','55.00','59.00','C+','Fair',7,'1-2'),('CHEMISTRY','60.00','64.00','B-','Good',8,'1-2'),('CHEMISTRY','65.00','69.00','B','Good',9,'1-2'),('CHEMISTRY','70.00','74.00','B+','Good',10,'1-2'),('CHEMISTRY','75.00','79.00','A-','Very Good',11,'1-2'),('CHEMISTRY','80.00','100.00','A','Excellent',12,'1-2'),('ENGLISH','0.00','29.00','E','Work Harder',1,'3-4'),('ENGLISH','30.00','34.00','D-','Work Harder',2,'3-4'),('ENGLISH','34.00','39.00','D','Improve',3,'3-4'),('ENGLISH','40.00','44.00','D+','Can do better',4,'3-4'),('ENGLISH','45.00','49.00','C-','Fair',5,'3-4'),('ENGLISH','50.00','54.00','C','Fair',6,'3-4'),('ENGLISH','55.00','59.00','C+','Fair',7,'3-4'),('ENGLISH','60.00','64.00','B-','Good',8,'3-4'),('ENGLISH','65.00','69.00','B','Good',9,'3-4'),('ENGLISH','70.00','74.00','B+','Good',10,'3-4'),('ENGLISH','75.00','79.00','A-','Very Good',11,'3-4'),('ENGLISH','80.00','100.00','A','Excellent',12,'3-4'),('KISWAHILI','0.00','29.00','E','Sharti Usome',1,'3-4'),('KISWAHILI','30.00','34.00','D-','Tia bidii',2,'3-4'),('KISWAHILI','35.00','39.00','D','Tia bidii',3,'3-4'),('KISWAHILI','40.00','44.00','D+','Tia bidii',4,'3-4'),('KISWAHILI','45.00','49.00','C-','Jitahidi',5,'3-4'),('KISWAHILI','50.00','54.00','C','Jitahidi',6,'3-4'),('KISWAHILI','55.00','59.00','C+','Jaribio Zuri',7,'3-4'),('KISWAHILI','60.00','64.00','B-','Jaribio Zuri',8,'3-4'),('KISWAHILI','65.00','69.00','B','Njema',9,'3-4'),('KISWAHILI','70.00','74.00','B+','Njema',10,'3-4'),('KISWAHILI','75.00','79.00','A-','Hongera',11,'3-4'),('KISWAHILI','80.00','100.00','A','Hongera',12,'3-4'),('CRE','30.00','34.00','D-','Work Hard',2,'1-2'),('CRE','35.00','39.00','D','Improve',3,'1-2'),('CRE','40.00','44.00','D+','Can do better',4,'1-2'),('CRE','45.00','49.00','C-','Fair',5,'1-2'),('CRE','50.00','54.00','C','Fair',6,'1-2'),('CRE','55.00','59.00','C+','Fair',7,'1-2'),('CRE','60.00','64.00','B-','Good',8,'1-2'),('CRE','65.00','69.00','B','Good',9,'1-2'),('CRE','70.00','74.00','B+','Good',10,'1-2'),('CRE','75.00','79.00','A-','Very Good',11,'1-2'),('GEOGRAPHY','70.00','74.00','B+','Good',10,'1-2'),('GEOGRAPHY','60.00','64.00','B-','Good',8,'1-2'),('GEOGRAPHY','55.00','59.00','C+','Fair',7,'1-2'),('GEOGRAPHY','40.00','44.00','D+','Can do better',4,'1-2'),('GEOGRAPHY','35.00','39.00','D','Improve',3,'1-2'),('GEOGRAPHY','30.00','34.00','D-','Work Hard',2,'1-2'),('B/STUDIES','55.00','59.00','C+','Fair',7,'3-4'),('B/STUDIES','60.00','64.00','B-','Good',8,'3-4'),('B/STUDIES','65.00','69.00','B','Good',9,'3-4'),('B/STUDIES','70.00','74.00','B+','Good',10,'3-4'),('B/STUDIES','75.00','79.00','A-','Very Good',11,'3-4'),('B/STUDIES','80.00','100.00','A','Excellent',12,'3-4'),('GEOGRAPHY','0.00','29.00','E','Work Harder',1,'3-4'),('GEOGRAPHY','30.00','34.00','D-','Work Hard',2,'3-4'),('GEOGRAPHY','35.00','39.00','D','Improve',3,'3-4'),('B/STUDIES','75.00','79.00','A-','Very Good',11,'1-2'),('B/STUDIES','65.00','69.00','B','Good',9,'1-2'),('B/STUDIES','55.00','59.00','C+','Fair',7,'1-2'),('B/STUDIES','45.00','49.00','C-','Fair',5,'1-2'),('B/STUDIES','40.00','44.00','D+','Can do better',4,'1-2'),('B/STUDIES','35.00','39.00','D','Improve',3,'1-2'),('B/STUDIES','0.00','29.00','E','Work Harder',1,'1-2'),('AGRICULTURE','80.00','100.00','A','Excellent',12,'1-2'),('AGRICULTURE','75.00','79.00','A-','Very Good',11,'1-2'),('AGRICULTURE','65.00','69.00','B','Good',9,'1-2'),('AGRICULTURE','55.00','59.00','C+','Fair',7,'1-2'),('AGRICULTURE','45.00','49.00','C-','Fair',5,'1-2'),('AGRICULTURE','40.00','44.00','D+','Can do better',4,'1-2'),('AGRICULTURE','0.00','29.00','E','Work Harder',1,'1-2'),('AGRICULTURE','75.00','79.00','A-','Very Good',11,'3-4'),('AGRICULTURE','70.00','74.00','B+','Good',10,'3-4'),('AGRICULTURE','50.00','54.00','C','Fair',6,'3-4'),('AGRICULTURE','45.00','49.00','C-','Fair',5,'3-4'),('AGRICULTURE','40.00','44.00','D+','Can do better',4,'3-4'),('AGRICULTURE','0.00','29.00','E','Work Harder',1,'3-4'),('CRE','45.00','49.00','D+','Can do better',4,'3-4'),('CRE','50.00','54.00','C-','Fair',5,'3-4'),('GEOGRAPHY','80.00','100.00','A','Excellent',12,'1-2'),('GEOGRAPHY','40.00','44.00','D+','Can do better',4,'3-4'),('GEOGRAPHY','45.00','49.00','C-','Fair',5,'3-4'),('GEOGRAPHY','50.00','54.00','C','Fair',6,'3-4'),('GEOGRAPHY','55.00','59.00','C+','Fair',7,'3-4'),('GEOGRAPHY','60.00','64.00','B-','Good',8,'3-4'),('GEOGRAPHY','65.00','69.00','B','Good',9,'3-4'),('GEOGRAPHY','70.00','74.00','B+','Good',10,'3-4'),('GEOGRAPHY','75.00','79.00','A-','Very Good',11,'3-4'),('GEOGRAPHY','80.00','100.00','A','Excellent',12,'3-4'),('GEOGRAPHY','0.00','29.00','E','Work Harder',1,'1-2'),('B/STUDIES','0.00','29.00','E','Work Harder',1,'3-4'),('B/STUDIES','30.00','34.00','D-','Work Hard',2,'3-4'),('B/STUDIES','35.00','39.00','D','Improve',3,'3-4'),('B/STUDIES','40.00','44.00','D+','Can do better',4,'3-4'),('B/STUDIES','45.00','49.00','C-','Fair',5,'3-4'),('B/STUDIES','50.00','54.00','C','Fair',6,'3-4'),('HISTORY','45.00','49.00','C-','Fair',5,'3-4'),('HISTORY','50.00','54.00','C','Fair',6,'3-4'),('HISTORY','55.00','59.00','C+','Fair',7,'3-4'),('HISTORY','60.00','64.00','B-','Good',8,'3-4'),('HISTORY','65.00','69.00','B','Good',9,'3-4'),('HISTORY','70.00','74.00','B+','Good',10,'3-4'),('HISTORY','75.00','79.00','A-','Very Good',11,'3-4'),('HISTORY','80.00','100.00','A','Excellent',12,'3-4');
UNLOCK TABLES;
/*!40000 ALTER TABLE `tblgrades` ENABLE KEYS */;

--
-- Table structure for table `test`
--

DROP TABLE IF EXISTS `test`;
CREATE TABLE `test` (
  `id` int(110) NOT NULL auto_increment,
  `valuesp` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `test`
--


/*!40000 ALTER TABLE `test` DISABLE KEYS */;
LOCK TABLES `test` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `test` ENABLE KEYS */;

--
-- Table structure for table `totalmockperformanceindex`
--

DROP TABLE IF EXISTS `totalmockperformanceindex`;
CREATE TABLE `totalmockperformanceindex` (
  `adm` varchar(100) NOT NULL,
  `names` varchar(100) NOT NULL,
  `kcpemean` decimal(18,2) default '0.00',
  `previous` decimal(18,2) default '0.00',
  `current` decimal(18,2) default '0.00',
  `pindex` decimal(18,2) default '0.00',
  `vap` decimal(18,2) default '0.00',
  `term` int(100) NOT NULL,
  `year` int(100) NOT NULL,
  `form` int(100) NOT NULL,
  `classin` varchar(100) NOT NULL,
  PRIMARY KEY  (`adm`,`year`,`term`,`form`,`classin`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `totalmockperformanceindex`
--


/*!40000 ALTER TABLE `totalmockperformanceindex` DISABLE KEYS */;
LOCK TABLES `totalmockperformanceindex` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `totalmockperformanceindex` ENABLE KEYS */;

--
-- Table structure for table `totalperformanceindex`
--

DROP TABLE IF EXISTS `totalperformanceindex`;
CREATE TABLE `totalperformanceindex` (
  `adm` varchar(100) NOT NULL,
  `names` varchar(100) NOT NULL,
  `kcpemean` decimal(18,2) default '0.00',
  `previous` decimal(18,2) default '0.00',
  `current` decimal(18,2) default '0.00',
  `pindex` decimal(18,2) default '0.00',
  `vap` decimal(18,2) default '0.00',
  `term` int(100) NOT NULL,
  `year` int(100) NOT NULL,
  `form` int(100) NOT NULL,
  `classin` varchar(100) NOT NULL,
  `exam` varchar(10) NOT NULL,
  PRIMARY KEY  (`adm`,`term`,`year`,`form`,`classin`,`exam`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `totalperformanceindex`
--


/*!40000 ALTER TABLE `totalperformanceindex` DISABLE KEYS */;
LOCK TABLES `totalperformanceindex` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `totalperformanceindex` ENABLE KEYS */;

--
-- Table structure for table `totalygradedcatsubjectsanalysis`
--

DROP TABLE IF EXISTS `totalygradedcatsubjectsanalysis`;
CREATE TABLE `totalygradedcatsubjectsanalysis` (
  `subject` varchar(100) NOT NULL,
  `form` int(1) NOT NULL,
  `stream` varchar(100) NOT NULL,
  `term` int(1) NOT NULL,
  `year` varchar(4) NOT NULL,
  `meanscore` float(18,2) NOT NULL,
  `A` int(4) NOT NULL,
  `A_m` int(4) NOT NULL,
  `B_p` int(4) NOT NULL,
  `B` int(4) NOT NULL,
  `B_m` int(4) NOT NULL,
  `C_p` int(4) NOT NULL,
  `C` int(4) NOT NULL,
  `C_m` int(4) NOT NULL,
  `D_p` int(4) NOT NULL,
  `D` int(4) NOT NULL,
  `D_m` int(4) NOT NULL,
  `E` int(4) NOT NULL,
  `points` decimal(18,2) NOT NULL,
  `students` int(100) NOT NULL,
  `grade` varchar(10) NOT NULL,
  PRIMARY KEY  (`subject`,`form`,`stream`,`term`,`year`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `totalygradedcatsubjectsanalysis`
--


/*!40000 ALTER TABLE `totalygradedcatsubjectsanalysis` DISABLE KEYS */;
LOCK TABLES `totalygradedcatsubjectsanalysis` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `totalygradedcatsubjectsanalysis` ENABLE KEYS */;

--
-- Table structure for table `totalygradedexamanalysis`
--

DROP TABLE IF EXISTS `totalygradedexamanalysis`;
CREATE TABLE `totalygradedexamanalysis` (
  `adm` int(10) NOT NULL,
  `names` varchar(40) NOT NULL,
  `eng1` int(10) NOT NULL,
  `eng1grade` varchar(5) NOT NULL,
  `kis1` int(10) NOT NULL,
  `kis1grade` varchar(5) NOT NULL,
  `math1` int(10) NOT NULL,
  `math1grade` varchar(5) NOT NULL,
  `bio1` int(10) NOT NULL,
  `bio1grade` varchar(5) NOT NULL,
  `chem1` int(10) NOT NULL,
  `chem1grade` varchar(5) NOT NULL,
  `phy1` int(10) NOT NULL,
  `phy1grade` varchar(100) NOT NULL,
  `his1` int(5) NOT NULL,
  `his1grade` varchar(10) NOT NULL,
  `geo1` int(10) NOT NULL,
  `geo1grade` varchar(5) NOT NULL,
  `cre1` int(10) NOT NULL,
  `cre1grade` varchar(5) NOT NULL,
  `agr1` int(10) NOT NULL,
  `agr1grade` varchar(5) NOT NULL,
  `bst1` int(10) NOT NULL,
  `bst1grade` varchar(5) NOT NULL,
  `fre1` int(10) NOT NULL,
  `fre1grade` varchar(100) NOT NULL,
  `comp1` int(10) NOT NULL,
  `comp1grade` varchar(100) NOT NULL,
  `home1` int(10) NOT NULL,
  `home1grade` varchar(100) NOT NULL,
  `wat1totals` int(10) NOT NULL,
  `totalmarks` int(10) NOT NULL,
  `totalpoints1` int(10) NOT NULL,
  `averagepoints` decimal(18,3) NOT NULL default '0.000',
  `average` decimal(18,2) NOT NULL default '0.00',
  `fgrade` varchar(3) NOT NULL,
  `term` int(100) NOT NULL,
  `year` int(100) NOT NULL,
  `form` int(100) NOT NULL,
  `stream` varchar(100) NOT NULL,
  PRIMARY KEY  (`adm`,`term`,`year`,`form`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `totalygradedexamanalysis`
--


/*!40000 ALTER TABLE `totalygradedexamanalysis` DISABLE KEYS */;
LOCK TABLES `totalygradedexamanalysis` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `totalygradedexamanalysis` ENABLE KEYS */;

--
-- Table structure for table `totalygradedmarks`
--

DROP TABLE IF EXISTS `totalygradedmarks`;
CREATE TABLE `totalygradedmarks` (
  `marks` int(10) NOT NULL,
  `grade` varchar(10) NOT NULL,
  `adm` int(10) NOT NULL,
  `names` varchar(40) NOT NULL,
  `english` int(10) NOT NULL,
  `englishgrade` varchar(10) NOT NULL,
  `engremarks` varchar(100) NOT NULL,
  `kiswahili` int(10) NOT NULL,
  `kiswahiligrade` varchar(10) NOT NULL,
  `kisremarks` varchar(100) NOT NULL,
  `mathematics` int(10) NOT NULL,
  `mathimaticsgrade` varchar(10) NOT NULL,
  `mathremarks` varchar(100) NOT NULL,
  `biology` int(10) NOT NULL,
  `biologygrade` varchar(10) NOT NULL,
  `bioremarks` varchar(100) NOT NULL,
  `chemistry` int(10) NOT NULL,
  `chemistrygrade` varchar(10) NOT NULL,
  `chemremarks` varchar(100) NOT NULL,
  `physics` int(10) NOT NULL,
  `physicsgrade` varchar(100) NOT NULL,
  `phyremarks` varchar(100) NOT NULL,
  `history` int(10) NOT NULL,
  `historygrade` varchar(10) NOT NULL,
  `hisremarks` varchar(10) NOT NULL,
  `geography` int(10) NOT NULL,
  `geographygrade` varchar(10) NOT NULL,
  `georemarks` varchar(100) NOT NULL,
  `cre` int(10) NOT NULL,
  `cregrade` varchar(10) NOT NULL,
  `creremarks` varchar(100) NOT NULL,
  `agriculture` int(10) NOT NULL,
  `agriculturegrade` varchar(10) NOT NULL,
  `agrremarks` varchar(100) NOT NULL,
  `businesStudies` int(10) NOT NULL,
  `businesStudiesgrade` varchar(10) NOT NULL,
  `bstremarks` varchar(100) NOT NULL,
  `french` int(10) NOT NULL,
  `frenchgrade` varchar(100) NOT NULL,
  `frenchremarks` varchar(100) NOT NULL,
  `computer` int(10) NOT NULL,
  `computergrade` varchar(100) NOT NULL,
  `computerremarks` varchar(100) NOT NULL,
  `home` int(10) NOT NULL,
  `homegrade` varchar(100) NOT NULL,
  `homeremarks` varchar(100) NOT NULL,
  `points` varchar(10) NOT NULL,
  `tgrade` varchar(10) NOT NULL,
  `totalmarks` int(10) NOT NULL,
  `average` double NOT NULL,
  `averagepoints` double NOT NULL,
  `term` int(100) NOT NULL,
  `year` int(100) NOT NULL,
  `form` int(100) NOT NULL,
  `classin` varchar(100) NOT NULL,
  `htremarks` varchar(100) NOT NULL,
  PRIMARY KEY  (`adm`,`term`,`year`,`form`,`classin`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `totalygradedmarks`
--


/*!40000 ALTER TABLE `totalygradedmarks` DISABLE KEYS */;
LOCK TABLES `totalygradedmarks` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `totalygradedmarks` ENABLE KEYS */;

--
-- Table structure for table `totalygradedmidterm`
--

DROP TABLE IF EXISTS `totalygradedmidterm`;
CREATE TABLE `totalygradedmidterm` (
  `adm` int(10) NOT NULL,
  `names` varchar(40) NOT NULL,
  `eng1` int(10) NOT NULL,
  `eng1grade` varchar(5) NOT NULL,
  `kis1` int(10) NOT NULL,
  `kis1grade` varchar(5) NOT NULL,
  `math1` int(10) NOT NULL,
  `math1grade` varchar(5) NOT NULL,
  `bio1` int(10) NOT NULL,
  `bio1grade` varchar(5) NOT NULL,
  `chem1` int(10) NOT NULL,
  `chem1grade` varchar(5) NOT NULL,
  `phy1` int(10) NOT NULL,
  `phy1grade` varchar(100) NOT NULL,
  `his1` int(5) NOT NULL,
  `his1grade` varchar(10) NOT NULL,
  `geo1` int(10) NOT NULL,
  `geo1grade` varchar(5) NOT NULL,
  `cre1` int(10) NOT NULL,
  `cre1grade` varchar(5) NOT NULL,
  `agr1` int(10) NOT NULL,
  `agr1grade` varchar(5) NOT NULL,
  `bst1` int(10) NOT NULL,
  `bst1grade` varchar(5) NOT NULL,
  `fre1` int(10) NOT NULL,
  `fre1grade` varchar(100) NOT NULL,
  `comp1` int(10) NOT NULL,
  `comp1grade` varchar(100) NOT NULL,
  `home1` int(10) NOT NULL,
  `home1grade` varchar(100) NOT NULL,
  `wat1totals` int(10) NOT NULL,
  `totalmarks` int(10) NOT NULL,
  `totalpoints1` int(10) NOT NULL,
  `averagepoints` decimal(18,3) NOT NULL default '0.000',
  `average` decimal(18,2) NOT NULL default '0.00',
  `fgrade` varchar(3) NOT NULL,
  `term` int(100) NOT NULL,
  `year` int(100) NOT NULL,
  `form` int(100) NOT NULL,
  `stream` varchar(100) NOT NULL,
  PRIMARY KEY  (`adm`,`term`,`year`,`form`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `totalygradedmidterm`
--


/*!40000 ALTER TABLE `totalygradedmidterm` DISABLE KEYS */;
LOCK TABLES `totalygradedmidterm` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `totalygradedmidterm` ENABLE KEYS */;

--
-- Table structure for table `totalygradedmockmarks`
--

DROP TABLE IF EXISTS `totalygradedmockmarks`;
CREATE TABLE `totalygradedmockmarks` (
  `marks` int(100) NOT NULL,
  `grade` varchar(100) NOT NULL,
  `adm` int(100) NOT NULL,
  `names` varchar(100) NOT NULL,
  `english` int(100) NOT NULL,
  `englishgrade` varchar(100) NOT NULL,
  `engremarks` varchar(100) NOT NULL,
  `kiswahili` int(100) NOT NULL,
  `kiswahiligrade` varchar(100) NOT NULL,
  `kisremarks` varchar(100) NOT NULL,
  `mathematics` int(100) NOT NULL,
  `mathimaticsgrade` varchar(100) NOT NULL,
  `mathremarks` varchar(100) NOT NULL,
  `biology` int(100) NOT NULL,
  `biologygrade` varchar(100) NOT NULL,
  `bioremarks` varchar(100) NOT NULL,
  `chemistry` int(100) NOT NULL,
  `chemistrygrade` varchar(100) NOT NULL,
  `chemremarks` varchar(100) NOT NULL,
  `physics` int(100) NOT NULL,
  `physicsgrade` varchar(100) NOT NULL,
  `phyremarks` varchar(100) NOT NULL,
  `history` int(100) NOT NULL,
  `historygrade` varchar(100) NOT NULL,
  `hisremarks` varchar(100) NOT NULL,
  `geography` int(100) NOT NULL,
  `geographygrade` varchar(100) NOT NULL,
  `georemarks` varchar(100) NOT NULL,
  `cre` int(100) NOT NULL,
  `cregrade` varchar(100) NOT NULL,
  `creremarks` varchar(100) NOT NULL,
  `agriculture` int(100) NOT NULL,
  `agriculturegrade` varchar(100) NOT NULL,
  `agrremarks` varchar(100) NOT NULL,
  `businesStudies` int(100) NOT NULL,
  `businesStudiesgrade` varchar(100) NOT NULL,
  `bstremarks` varchar(100) NOT NULL,
  `french` int(100) NOT NULL,
  `frenchgrade` varchar(100) NOT NULL,
  `frenchremarks` varchar(100) NOT NULL,
  `computer` int(100) NOT NULL,
  `computergrade` varchar(100) NOT NULL,
  `computerremarks` varchar(100) NOT NULL,
  `home` int(10) NOT NULL,
  `homegrade` varchar(100) NOT NULL,
  `homeremarks` varchar(100) NOT NULL,
  `points` varchar(100) NOT NULL,
  `tgrade` varchar(100) NOT NULL,
  `totalmarks` int(100) NOT NULL,
  `average` double NOT NULL,
  `averagepoints` double NOT NULL,
  `term` int(100) NOT NULL,
  `year` int(100) NOT NULL,
  `form` int(100) NOT NULL,
  `classin` varchar(100) NOT NULL,
  `htremarks` varchar(100) NOT NULL,
  PRIMARY KEY  (`adm`,`term`,`year`,`form`,`classin`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `totalygradedmockmarks`
--


/*!40000 ALTER TABLE `totalygradedmockmarks` DISABLE KEYS */;
LOCK TABLES `totalygradedmockmarks` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `totalygradedmockmarks` ENABLE KEYS */;

--
-- Table structure for table `totalygradedsubjectsanalysis`
--

DROP TABLE IF EXISTS `totalygradedsubjectsanalysis`;
CREATE TABLE `totalygradedsubjectsanalysis` (
  `subject` varchar(100) NOT NULL,
  `form` int(1) NOT NULL,
  `stream` varchar(100) NOT NULL,
  `term` int(1) NOT NULL,
  `year` varchar(4) NOT NULL,
  `meanscore` float(18,2) NOT NULL,
  `A` int(4) NOT NULL,
  `A_m` int(4) NOT NULL,
  `B_p` int(4) NOT NULL,
  `B` int(4) NOT NULL,
  `B_m` int(4) NOT NULL,
  `C_p` int(4) NOT NULL,
  `C` int(4) NOT NULL,
  `C_m` int(4) NOT NULL,
  `D_p` int(4) NOT NULL,
  `D` int(4) NOT NULL,
  `D_m` int(4) NOT NULL,
  `E` int(4) NOT NULL,
  `points` decimal(18,2) NOT NULL,
  `students` int(100) NOT NULL,
  `grade` varchar(10) NOT NULL,
  PRIMARY KEY  (`subject`,`form`,`stream`,`term`,`year`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `totalygradedsubjectsanalysis`
--


/*!40000 ALTER TABLE `totalygradedsubjectsanalysis` DISABLE KEYS */;
LOCK TABLES `totalygradedsubjectsanalysis` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `totalygradedsubjectsanalysis` ENABLE KEYS */;

--
-- Table structure for table `totalygradedsubjectsanalysismock`
--

DROP TABLE IF EXISTS `totalygradedsubjectsanalysismock`;
CREATE TABLE `totalygradedsubjectsanalysismock` (
  `subject` varchar(100) NOT NULL,
  `form` int(1) NOT NULL,
  `stream` varchar(100) NOT NULL,
  `term` int(1) NOT NULL,
  `year` varchar(4) NOT NULL,
  `meanscore` float(18,2) NOT NULL,
  `A` int(4) NOT NULL,
  `A_m` int(4) NOT NULL,
  `B_p` int(4) NOT NULL,
  `B` int(4) NOT NULL,
  `B_m` int(4) NOT NULL,
  `C_p` int(4) NOT NULL,
  `C` int(4) NOT NULL,
  `C_m` int(4) NOT NULL,
  `D_p` int(4) NOT NULL,
  `D` int(4) NOT NULL,
  `D_m` int(4) NOT NULL,
  `E` int(4) NOT NULL,
  `points` decimal(18,2) NOT NULL,
  `students` int(100) NOT NULL,
  `grade` varchar(10) NOT NULL,
  PRIMARY KEY  (`subject`,`form`,`stream`,`term`,`year`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `totalygradedsubjectsanalysismock`
--


/*!40000 ALTER TABLE `totalygradedsubjectsanalysismock` DISABLE KEYS */;
LOCK TABLES `totalygradedsubjectsanalysismock` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `totalygradedsubjectsanalysismock` ENABLE KEYS */;

--
-- Table structure for table `transfers`
--

DROP TABLE IF EXISTS `transfers`;
CREATE TABLE `transfers` (
  `admno` varchar(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `gender` varchar(100) NOT NULL,
  `form` varchar(100) NOT NULL,
  `deleted` varchar(100) NOT NULL,
  `yr` varchar(100) NOT NULL,
  PRIMARY KEY  (`admno`,`form`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transfers`
--


/*!40000 ALTER TABLE `transfers` DISABLE KEYS */;
LOCK TABLES `transfers` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `transfers` ENABLE KEYS */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

