/* 
SQLyog v3.11
Host - localhost : Database - moigirls
**************************************************************
Server version 5.0.7-beta-nt
*/

create database if not exists `moigirls`;

use `moigirls`;

/*
Table struture for balances
*/

drop table if exists `balances`;
CREATE TABLE `balances` (
  `admno` varchar(100) NOT NULL default '',
  `balance` double default NULL,
  `term` varchar(100) NOT NULL default '',
  `year` varchar(100) NOT NULL default '',
  `form` varchar(100) NOT NULL default '',
  PRIMARY KEY  (`admno`,`term`,`year`,`form`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*
Table struture for bank_accounts
*/

drop table if exists `bank_accounts`;
CREATE TABLE `bank_accounts` (
  `account_number` varchar(255) NOT NULL,
  `bank_name` varchar(255) NOT NULL,
  `branch` varchar(255) NOT NULL,
  `account_name` varchar(255) NOT NULL,
  PRIMARY KEY  (`account_number`,`bank_name`,`branch`,`account_name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*
Table struture for books_invemtory
*/

drop table if exists `books_invemtory`;
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

/*
Table struture for bursaries
*/

drop table if exists `bursaries`;
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

/*
Table struture for bursaries_allocations
*/

drop table if exists `bursaries_allocations`;
CREATE TABLE `bursaries_allocations` (
  `id` int(100) NOT NULL auto_increment,
  `cheque_no` varchar(100) NOT NULL,
  `admno` varchar(100) NOT NULL,
  `amount` float(18,2) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*
Table struture for catoutof
*/

drop table if exists `catoutof`;
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

/*
Table struture for chequeexpenses
*/

drop table if exists `chequeexpenses`;
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

/*
Table struture for contacts_groups
*/

drop table if exists `contacts_groups`;
CREATE TABLE `contacts_groups` (
  `group_id` int(100) NOT NULL auto_increment,
  `group_name` varchar(100) NOT NULL,
  `telephones` int(100) NOT NULL,
  PRIMARY KEY  (`group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*
Table struture for current_op
*/

drop table if exists `current_op`;
CREATE TABLE `current_op` (
  `code` int(1) NOT NULL default '1',
  `term` int(1) default NULL,
  `year` int(4) default NULL,
  PRIMARY KEY  (`code`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*
Table struture for d_locks
*/

drop table if exists `d_locks`;
CREATE TABLE `d_locks` (
  `d_lock` varchar(100) NOT NULL,
  PRIMARY KEY  (`d_lock`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*
Table struture for department
*/

drop table if exists `department`;
CREATE TABLE `department` (
  `dname` varchar(100) NOT NULL,
  `did` varchar(100) NOT NULL,
  `hodname` varchar(100) NOT NULL,
  PRIMARY KEY  (`dname`,`did`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*
Table struture for examoutof
*/

drop table if exists `examoutof`;
CREATE TABLE `examoutof` (
  `subject` varchar(20) NOT NULL,
  `form` int(5) NOT NULL,
  `outof` int(5) NOT NULL,
  `years` int(5) NOT NULL,
  `states` varchar(100) NOT NULL,
  PRIMARY KEY  (`subject`,`form`,`years`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*
Table struture for examstatus
*/

drop table if exists `examstatus`;
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

/*
Table struture for expenses
*/

drop table if exists `expenses`;
CREATE TABLE `expenses` (
  `year` int(100) default NULL,
  `term` int(100) default NULL,
  `dateofExpense` varchar(100) NOT NULL,
  `mode` varchar(100) default NULL,
  `bank` varchar(100) default NULL,
  `chequeno` varchar(100) default NULL,
  `amount` double default NULL,
  `words` text,
  `account` varchar(100) default NULL,
  `description` text,
  `rname` varchar(100) default NULL,
  `rid` varchar(100) NOT NULL,
  PRIMARY KEY  (`dateofExpense`,`rid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*
Table struture for fees
*/

drop table if exists `fees`;
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

/*
Table struture for feestructures
*/

drop table if exists `feestructures`;
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

/*
Table struture for finance_added_fees
*/

drop table if exists `finance_added_fees`;
CREATE TABLE `finance_added_fees` (
  `admno` varchar(100) NOT NULL,
  `fiscal_year` int(4) NOT NULL,
  `term` varchar(10) NOT NULL,
  `votehead` varchar(100) NOT NULL,
  `amount` decimal(18,2) NOT NULL,
  PRIMARY KEY  (`admno`,`fiscal_year`,`term`,`votehead`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*
Table struture for finance_balances
*/

drop table if exists `finance_balances`;
CREATE TABLE `finance_balances` (
  `admno` varchar(100) NOT NULL,
  `form` varchar(10) NOT NULL default '',
  `term` varchar(10) NOT NULL default '',
  `year` int(4) NOT NULL,
  `balance` float(18,2) NOT NULL,
  `updated` int(4) NOT NULL,
  PRIMARY KEY  (`admno`,`form`,`term`,`year`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*
Table struture for finance_estimates
*/

drop table if exists `finance_estimates`;
CREATE TABLE `finance_estimates` (
  `fiscal_yr` int(20) NOT NULL,
  `votehead` varchar(255) NOT NULL,
  `amount` decimal(18,2) default '0.00',
  PRIMARY KEY  (`fiscal_yr`,`votehead`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*
Table struture for finance_fees
*/

drop table if exists `finance_fees`;
CREATE TABLE `finance_fees` (
  `fiscal_yr` int(20) NOT NULL,
  `term` varchar(255) NOT NULL,
  `form` varchar(255) NOT NULL,
  `votehead` varchar(255) NOT NULL,
  `amount` decimal(18,2) default '0.00',
  PRIMARY KEY  (`fiscal_yr`,`votehead`,`term`,`form`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*
Table struture for finance_feestructures
*/

drop table if exists `finance_feestructures`;
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

/*
Table struture for finance_fiscalyr
*/

drop table if exists `finance_fiscalyr`;
CREATE TABLE `finance_fiscalyr` (
  `fiscal_year` int(4) NOT NULL,
  `status` varchar(100) default 'OPEN',
  PRIMARY KEY  (`fiscal_year`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*
Table struture for finance_operationalvoteheads
*/

drop table if exists `finance_operationalvoteheads`;
CREATE TABLE `finance_operationalvoteheads` (
  `fiscal_year` int(4) NOT NULL default '0',
  `term` varchar(100) NOT NULL default '',
  `votehead` varchar(100) NOT NULL default '',
  `code` varchar(100) NOT NULL default '',
  PRIMARY KEY  (`fiscal_year`,`term`,`votehead`,`code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*
Table struture for finance_tuitionvoteheads
*/

drop table if exists `finance_tuitionvoteheads`;
CREATE TABLE `finance_tuitionvoteheads` (
  `fiscal_year` int(4) NOT NULL default '0',
  `term` varchar(100) NOT NULL default '',
  `votehead` varchar(100) NOT NULL default '',
  `code` varchar(100) NOT NULL default '',
  PRIMARY KEY  (`fiscal_year`,`term`,`votehead`,`code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*
Table struture for finance_voteheads
*/

drop table if exists `finance_voteheads`;
CREATE TABLE `finance_voteheads` (
  `fiscal_year` int(4) NOT NULL,
  `term` varchar(100) NOT NULL,
  `votehead` varchar(100) NOT NULL,
  `code` varchar(100) NOT NULL,
  PRIMARY KEY  (`fiscal_year`,`term`,`votehead`,`code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*
Table struture for img
*/

drop table if exists `img`;
CREATE TABLE `img` (
  `id` int(10) NOT NULL,
  `image` varchar(100) NOT NULL,
  `pass` varchar(10) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*
Table struture for initials
*/

drop table if exists `initials`;
CREATE TABLE `initials` (
  `fullname` varchar(100) NOT NULL,
  `form` varchar(100) NOT NULL,
  `stream` varchar(100) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `initials` varchar(100) NOT NULL,
  PRIMARY KEY  (`fullname`,`form`,`stream`,`subject`,`initials`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*
Table struture for issued_books
*/

drop table if exists `issued_books`;
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

/*
Table struture for kcse_final_analysis
*/

drop table if exists `kcse_final_analysis`;
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

/*
Table struture for kcseanalysis
*/

drop table if exists `kcseanalysis`;
CREATE TABLE `kcseanalysis` (
  `admno` int(100) NOT NULL,
  `index_numbers` int(100) NOT NULL,
  `year_finished` int(100) NOT NULL,
  PRIMARY KEY  (`admno`,`index_numbers`,`year_finished`),
  KEY `admon` (`admno`,`year_finished`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*
Table struture for kcsemarks
*/

drop table if exists `kcsemarks`;
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

/*
Table struture for lib_lost_books
*/

drop table if exists `lib_lost_books`;
CREATE TABLE `lib_lost_books` (
  `bookid` int(100) NOT NULL,
  `bookno` varchar(100) NOT NULL,
  `userid` varchar(100) NOT NULL,
  `date_ref` varchar(100) NOT NULL,
  `issuer_ref` varchar(100) NOT NULL,
  `comments` text NOT NULL,
  PRIMARY KEY  (`bookid`,`bookno`,`userid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*
Table struture for markscats
*/

drop table if exists `markscats`;
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

/*
Table struture for marksemams
*/

drop table if exists `marksemams`;
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

/*
Table struture for messages_settings
*/

drop table if exists `messages_settings`;
CREATE TABLE `messages_settings` (
  `api_url` varchar(255) NOT NULL,
  `ekey` varchar(255) NOT NULL,
  `senderid` varchar(255) NOT NULL,
  `passwrd` varchar(255) NOT NULL,
  `notify1` int(15) default NULL,
  `notify2` int(15) default NULL,
  PRIMARY KEY  (`api_url`,`ekey`,`senderid`,`passwrd`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*
Table struture for mockexams
*/

drop table if exists `mockexams`;
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

/*
Table struture for mockpositions
*/

drop table if exists `mockpositions`;
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

/*
Table struture for mocks
*/

drop table if exists `mocks`;
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

/*
Table struture for numbers
*/

drop table if exists `numbers`;
CREATE TABLE `numbers` (
  `parentname` varchar(100) NOT NULL default '',
  `id` varchar(100) NOT NULL default '',
  `tele` int(15) NOT NULL,
  `admno` int(10) NOT NULL,
  PRIMARY KEY  (`admno`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*
Table struture for othercashexpenses
*/

drop table if exists `othercashexpenses`;
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

/*
Table struture for parentdetails
*/

drop table if exists `parentdetails`;
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

/*
Table struture for positionby
*/

drop table if exists `positionby`;
CREATE TABLE `positionby` (
  `marks` int(1) NOT NULL,
  `point` int(1) NOT NULL,
  PRIMARY KEY  (`marks`,`point`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*
Table struture for positions
*/

drop table if exists `positions`;
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

/*
Table struture for printedestimate
*/

drop table if exists `printedestimate`;
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

/*
Table struture for purchase_orderitems
*/

drop table if exists `purchase_orderitems`;
CREATE TABLE `purchase_orderitems` (
  `po_number` varchar(100) NOT NULL,
  `item` varchar(255) NOT NULL,
  `qty` int(100) NOT NULL,
  PRIMARY KEY  (`po_number`,`item`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*
Table struture for purchase_orderitems_received
*/

drop table if exists `purchase_orderitems_received`;
CREATE TABLE `purchase_orderitems_received` (
  `id` int(100) NOT NULL auto_increment,
  `po_number` varchar(100) NOT NULL,
  `item` varchar(255) NOT NULL,
  `qty` int(100) NOT NULL,
  `unit_price` decimal(18,2) NOT NULL default '0.00',
  `total_price` decimal(18,2) NOT NULL default '0.00',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*
Table struture for purchase_orders
*/

drop table if exists `purchase_orders`;
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

/*
Table struture for purchase_orders_received
*/

drop table if exists `purchase_orders_received`;
CREATE TABLE `purchase_orders_received` (
  `po_number` varchar(100) NOT NULL,
  `delivery` varchar(100) NOT NULL,
  `d_date` varchar(100) NOT NULL,
  `d_notes` text NOT NULL,
  `received_by` varchar(100) NOT NULL,
  PRIMARY KEY  (`po_number`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*
Table struture for returned_books
*/

drop table if exists `returned_books`;
CREATE TABLE `returned_books` (
  `bookid` varchar(100) NOT NULL default '',
  `userid` varchar(100) NOT NULL default '',
  `datereturned` varchar(100) NOT NULL default '',
  `receivedby` varchar(100) NOT NULL default '',
  `comments` text NOT NULL,
  PRIMARY KEY  (`bookid`,`userid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*
Table struture for schoolname
*/

drop table if exists `schoolname`;
CREATE TABLE `schoolname` (
  `schname` varchar(100) NOT NULL,
  `box` varchar(100) NOT NULL,
  `place` varchar(100) NOT NULL,
  `telphone` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `website` varchar(100) NOT NULL,
  PRIMARY KEY  (`schname`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*
Table struture for sent_messages
*/

drop table if exists `sent_messages`;
CREATE TABLE `sent_messages` (
  `id` int(100) NOT NULL auto_increment,
  `msg_to` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `date_sent` varchar(100) NOT NULL,
  `sender` varchar(100) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*
Table struture for staff
*/

drop table if exists `staff`;
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

/*
Table struture for standards
*/

drop table if exists `standards`;
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

/*
Table struture for streams
*/

drop table if exists `streams`;
CREATE TABLE `streams` (
  `form` varchar(100) NOT NULL,
  `stream` varchar(100) NOT NULL,
  `students` int(100) NOT NULL,
  `classteacher` varchar(100) NOT NULL,
  PRIMARY KEY  (`form`,`stream`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*
Table struture for studentdetails
*/

drop table if exists `studentdetails`;
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

/*
Table struture for students_log
*/

drop table if exists `students_log`;
CREATE TABLE `students_log` (
  `admno` varchar(200) NOT NULL default '',
  `year` int(4) NOT NULL default '0',
  `form` varchar(100) NOT NULL default '',
  PRIMARY KEY  (`admno`,`year`,`form`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*
Table struture for subjects
*/

drop table if exists `subjects`;
CREATE TABLE `subjects` (
  `subject` varchar(100) NOT NULL,
  PRIMARY KEY  (`subject`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*
Table struture for subjectsforstudent
*/

drop table if exists `subjectsforstudent`;
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

/*
Table struture for tbl_hr_krapaye
*/

drop table if exists `tbl_hr_krapaye`;
CREATE TABLE `tbl_hr_krapaye` (
  `minv` decimal(18,2) NOT NULL default '0.00',
  `maxv` decimal(18,2) NOT NULL default '0.00',
  `tax` decimal(18,2) default '0.00',
  PRIMARY KEY  (`minv`,`maxv`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*
Table struture for tbl_hr_loans
*/

drop table if exists `tbl_hr_loans`;
CREATE TABLE `tbl_hr_loans` (
  `name` varchar(100) NOT NULL,
  `deduction_amount` decimal(18,2) default '0.00',
  `applies_to` varchar(100) NOT NULL default '',
  PRIMARY KEY  (`name`,`applies_to`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*
Table struture for tbl_hr_nhif
*/

drop table if exists `tbl_hr_nhif`;
CREATE TABLE `tbl_hr_nhif` (
  `minv` decimal(18,2) NOT NULL default '0.00',
  `maxv` decimal(18,2) NOT NULL default '0.00',
  `amount` decimal(18,2) default '0.00',
  `percent` decimal(18,2) default '0.00',
  PRIMARY KEY  (`minv`,`maxv`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*
Table struture for tbl_hr_nhif_old
*/

drop table if exists `tbl_hr_nhif_old`;
CREATE TABLE `tbl_hr_nhif_old` (
  `minv` decimal(18,2) NOT NULL default '0.00',
  `maxv` decimal(18,2) NOT NULL default '0.00',
  `amount` decimal(18,2) default '0.00',
  `percent` decimal(18,2) default '0.00',
  PRIMARY KEY  (`minv`,`maxv`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*
Table struture for tbl_hr_nssf
*/

drop table if exists `tbl_hr_nssf`;
CREATE TABLE `tbl_hr_nssf` (
  `minv` decimal(18,2) NOT NULL default '0.00',
  `maxv` decimal(18,2) NOT NULL default '0.00',
  `amount` decimal(18,2) default '0.00',
  `percent` decimal(18,2) default '0.00',
  PRIMARY KEY  (`minv`,`maxv`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*
Table struture for tbl_hr_nssf_old
*/

drop table if exists `tbl_hr_nssf_old`;
CREATE TABLE `tbl_hr_nssf_old` (
  `minv` decimal(18,2) NOT NULL default '0.00',
  `maxv` decimal(18,2) NOT NULL default '0.00',
  `amount` decimal(18,2) default '0.00',
  `percent` decimal(18,2) default '0.00',
  PRIMARY KEY  (`minv`,`maxv`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*
Table struture for tbl_hr_payslips
*/

drop table if exists `tbl_hr_payslips`;
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

/*
Table struture for tbl_hr_payslips_all
*/

drop table if exists `tbl_hr_payslips_all`;
CREATE TABLE `tbl_hr_payslips_all` (
  `staff_ref` varchar(100) NOT NULL,
  `allowance_name` varchar(100) NOT NULL,
  `allowance` decimal(18,2) default '0.00',
  `month_ref` varchar(100) NOT NULL,
  `payrollref` varchar(100) NOT NULL,
  PRIMARY KEY  (`staff_ref`,`allowance_name`,`month_ref`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*
Table struture for tbl_hr_payslips_ded
*/

drop table if exists `tbl_hr_payslips_ded`;
CREATE TABLE `tbl_hr_payslips_ded` (
  `staff_ref` varchar(100) NOT NULL,
  `deduction_name` varchar(100) NOT NULL,
  `deduction` decimal(18,2) default '0.00',
  `month_ref` varchar(100) NOT NULL,
  `payrollref` varchar(100) NOT NULL,
  PRIMARY KEY  (`staff_ref`,`deduction_name`,`month_ref`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*
Table struture for tbl_hr_payslips_reliefs
*/

drop table if exists `tbl_hr_payslips_reliefs`;
CREATE TABLE `tbl_hr_payslips_reliefs` (
  `staff_ref` varchar(100) NOT NULL default '',
  `relief_name` varchar(100) NOT NULL default '',
  `relief` decimal(18,2) default '0.00',
  `month_ref` varchar(100) NOT NULL default '',
  `payrollref` varchar(100) default NULL,
  PRIMARY KEY  (`staff_ref`,`relief_name`,`month_ref`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*
Table struture for tbl_hr_reliefs
*/

drop table if exists `tbl_hr_reliefs`;
CREATE TABLE `tbl_hr_reliefs` (
  `name` varchar(100) NOT NULL,
  `amount` decimal(18,2) default '0.00',
  `percent` decimal(18,2) default '0.00',
  `type` varchar(100) NOT NULL default '',
  PRIMARY KEY  (`name`,`type`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*
Table struture for tbl_hrallowances
*/

drop table if exists `tbl_hrallowances`;
CREATE TABLE `tbl_hrallowances` (
  `name` varchar(100) NOT NULL,
  `rate` decimal(18,2) default '0.00',
  `applies_to` varchar(100) NOT NULL default '',
  PRIMARY KEY  (`name`,`applies_to`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*
Table struture for tbl_hrdeductions
*/

drop table if exists `tbl_hrdeductions`;
CREATE TABLE `tbl_hrdeductions` (
  `name` varchar(100) NOT NULL,
  `rate` decimal(18,2) default '0.00',
  PRIMARY KEY  (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*
Table struture for tbl_invoices
*/

drop table if exists `tbl_invoices`;
CREATE TABLE `tbl_invoices` (
  `invoice_no` varchar(100) NOT NULL default '1',
  `payee_ref` varchar(255) NOT NULL,
  `amount_due` decimal(18,2) NOT NULL default '0.00',
  `acc_payable` varchar(100) NOT NULL,
  `i_status` int(1) NOT NULL default '0' COMMENT '0=unpaid, 1=paid',
  PRIMARY KEY  (`invoice_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*
Table struture for tbl_studentsubjects
*/

drop table if exists `tbl_studentsubjects`;
CREATE TABLE `tbl_studentsubjects` (
  `admno` varchar(100) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `form` varchar(100) NOT NULL,
  `year` int(4) NOT NULL,
  `term` int(1) NOT NULL,
  `stream` varchar(100) NOT NULL,
  PRIMARY KEY  (`admno`,`subject`,`form`,`year`,`term`,`stream`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*
Table struture for tbl_terms
*/

drop table if exists `tbl_terms`;
CREATE TABLE `tbl_terms` (
  `term` int(1) NOT NULL,
  `year` int(4) NOT NULL,
  `begins` varchar(100) NOT NULL,
  `ends` varchar(100) NOT NULL,
  PRIMARY KEY  (`term`,`year`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*
Table struture for tbl_themes
*/

drop table if exists `tbl_themes`;
CREATE TABLE `tbl_themes` (
  `theme_name` varchar(100) NOT NULL,
  `theme_status` int(1) NOT NULL default '0',
  `css_name` varchar(255) NOT NULL,
  `css_m` varbinary(255) NOT NULL,
  PRIMARY KEY  (`theme_name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*
Table struture for tblaudittrail
*/

drop table if exists `tblaudittrail`;
CREATE TABLE `tblaudittrail` (
  `id` int(11) NOT NULL auto_increment,
  `auditDate` datetime NOT NULL,
  `activity` varchar(200) NOT NULL,
  `uname` varchar(30) NOT NULL,
  `ipaddress` varchar(16) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*
Table struture for tbldispline
*/

drop table if exists `tbldispline`;
CREATE TABLE `tbldispline` (
  `id` int(11) NOT NULL auto_increment,
  `admno` varchar(100) NOT NULL,
  `comments` text NOT NULL,
  `comment_by` varchar(100) NOT NULL,
  `date_added` varchar(100) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*
Table struture for tbleperformancetrack
*/

drop table if exists `tbleperformancetrack`;
CREATE TABLE `tbleperformancetrack` (
  `admno` varchar(100) NOT NULL,
  `form` varchar(100) NOT NULL,
  `year` int(4) NOT NULL,
  `term` int(5) NOT NULL,
  `stream` varchar(100) NOT NULL,
  `s_status` int(1) NOT NULL default '0',
  PRIMARY KEY  (`admno`,`form`,`year`,`term`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*
Table struture for tbleperformancetrackmock
*/

drop table if exists `tbleperformancetrackmock`;
CREATE TABLE `tbleperformancetrackmock` (
  `admno` varchar(100) NOT NULL,
  `form` varchar(100) NOT NULL,
  `year` int(4) NOT NULL,
  `term` int(5) NOT NULL,
  `stream` varchar(100) NOT NULL,
  `s_status` int(1) NOT NULL default '0',
  PRIMARY KEY  (`admno`,`form`,`year`,`term`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*
Table struture for tblgrades
*/

drop table if exists `tblgrades`;
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

/*
Table struture for test
*/

drop table if exists `test`;
CREATE TABLE `test` (
  `id` int(110) NOT NULL auto_increment,
  `valuesp` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*
Table struture for totalmockperformanceindex
*/

drop table if exists `totalmockperformanceindex`;
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

/*
Table struture for totalperformanceindex
*/

drop table if exists `totalperformanceindex`;
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

/*
Table struture for totalygradedcatsubjectsanalysis
*/

drop table if exists `totalygradedcatsubjectsanalysis`;
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

/*
Table struture for totalygradedexamanalysis
*/

drop table if exists `totalygradedexamanalysis`;
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

/*
Table struture for totalygradedmarks
*/

drop table if exists `totalygradedmarks`;
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

/*
Table struture for totalygradedmidterm
*/

drop table if exists `totalygradedmidterm`;
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

/*
Table struture for totalygradedmockmarks
*/

drop table if exists `totalygradedmockmarks`;
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

/*
Table struture for totalygradedsubjectsanalysis
*/

drop table if exists `totalygradedsubjectsanalysis`;
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

/*
Table struture for totalygradedsubjectsanalysismock
*/

drop table if exists `totalygradedsubjectsanalysismock`;
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

/*
Table struture for transfers
*/

drop table if exists `transfers`;
CREATE TABLE `transfers` (
  `admno` varchar(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `gender` varchar(100) NOT NULL,
  `form` varchar(100) NOT NULL,
  `deleted` varchar(100) NOT NULL,
  `yr` varchar(100) NOT NULL,
  PRIMARY KEY  (`admno`,`form`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

