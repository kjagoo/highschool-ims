/* 
SQLyog v3.11
Host - localhost : Database - gathanji
**************************************************************
Server version 5.0.51b-community-nt
*/

create database if not exists `gathanji`;

use `gathanji`;

/*
Table struture for balances
*/

drop table if exists `balances`;
CREATE TABLE `balances` (
  `admno` varchar(100) NOT NULL,
  `balance` double NOT NULL,
  `term` varchar(100) NOT NULL,
  `year` varchar(100) NOT NULL,
  `form` varchar(100) NOT NULL,
  PRIMARY KEY  (`admno`,`term`,`year`,`form`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*
Table struture for bank_accounts
*/

drop table if exists `bank_accounts`;
CREATE TABLE `bank_accounts` (
  `account_number` varchar(255) NOT NULL default '',
  `bank_name` varchar(255) NOT NULL default '',
  `branch` varchar(255) NOT NULL default '',
  `account_name` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`account_number`,`bank_name`,`branch`,`account_name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*
Table struture for books_invemtory
*/

drop table if exists `books_invemtory`;
CREATE TABLE `books_invemtory` (
  `bookid` int(100) NOT NULL auto_increment,
  `title` varchar(255) NOT NULL default '',
  `author` varchar(100) NOT NULL default '',
  `publisher` varchar(100) NOT NULL default '',
  `sn` varchar(100) NOT NULL default '',
  `category` varchar(100) NOT NULL default '',
  `form` varchar(100) NOT NULL default '',
  `yrofedition` int(4) NOT NULL,
  `noofpcs` int(10) NOT NULL,
  `btype` varchar(100) NOT NULL default '',
  `bookstatus` varchar(100) NOT NULL default 'Available',
  `comments` text NOT NULL,
  PRIMARY KEY  (`bookid`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*
Table data for gathanji.books_invemtory
*/

INSERT INTO `books_invemtory` VALUES (1,'EXCELLING IN ENGLISH','KLB','KLB','-','ENGLISH-','1',2005,20,'Hard_Copy','Available','') , (3,'KISWAHILI FASAHA','KLB','KLB','-','KISWAHILI','1',2015,146,'Hard_Copy','Available','') ;

/*
Table struture for bursaries
*/

drop table if exists `bursaries`;
CREATE TABLE `bursaries` (
  `cheque_no` varchar(200) NOT NULL default '',
  `cheque_from` varchar(100) NOT NULL default '',
  `amount` float(18,2) NOT NULL,
  `account_no` varchar(100) NOT NULL default '',
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
  `cheque_no` varchar(100) NOT NULL default '',
  `admno` varchar(100) NOT NULL default '',
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `group_name` varchar(100) NOT NULL default '',
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
Table data for gathanji.d_locks
*/

INSERT INTO `d_locks` VALUES ('open') ;

/*
Table struture for days
*/

drop table if exists `days`;
CREATE TABLE `days` (
  `admno` varchar(10) NOT NULL,
  `form` varchar(100) NOT NULL,
  `term` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `days` int(11) NOT NULL,
  `stream` varchar(5) NOT NULL,
  PRIMARY KEY  (`admno`,`form`,`term`,`year`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `status` varchar(100) NOT NULL,
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
Table data for gathanji.expenses
*/

INSERT INTO `expenses` VALUES (2010,1,'2016-01-08','Cash','-','-',1500,'one thosand five hundred','select','computer repair','joshua','27133348') ;

/*
Table struture for feeregisterreport_2016_term_1
*/

drop table if exists `feeregisterreport_2016_term_1`;
CREATE TABLE `feeregisterreport_2016_term_1` (
  `admno` varchar(100) NOT NULL default '',
  `receipt_no` varchar(100) NOT NULL default '',
  `Activity` decimal(18,2) NOT NULL,
  `Administration_Cost` decimal(18,2) NOT NULL,
  `BES` decimal(18,2) NOT NULL,
  `Caution_Money` decimal(18,2) NOT NULL,
  `Cluster_Exam` decimal(18,2) NOT NULL,
  `Development_PTA` decimal(18,2) NOT NULL,
  `EWC` decimal(18,2) NOT NULL,
  `ID_cards` decimal(18,2) NOT NULL,
  `Insurance` decimal(18,2) NOT NULL,
  `LTT` decimal(18,2) NOT NULL,
  `Medical` decimal(18,2) NOT NULL,
  `PE_Salary` decimal(18,2) NOT NULL,
  `RMI` decimal(18,2) NOT NULL,
  `Uniform` decimal(18,2) NOT NULL,
  `term` varchar(100) NOT NULL default '',
  `year` varchar(100) NOT NULL default '',
  PRIMARY KEY  (`admno`,`receipt_no`,`term`,`year`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `term` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `modeofpay` varchar(10) NOT NULL default '',
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
  `bank` double NOT NULL,
  `installment` int(10) NOT NULL,
  PRIMARY KEY  (`serialno`,`admno`,`term`,`year`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*
Table struture for finance_added_fees
*/

drop table if exists `finance_added_fees`;
CREATE TABLE `finance_added_fees` (
  `admno` varchar(100) NOT NULL default '',
  `fiscal_year` int(4) NOT NULL,
  `term` varchar(10) NOT NULL default '',
  `votehead` varchar(100) NOT NULL default '',
  `amount` decimal(18,2) NOT NULL,
  PRIMARY KEY  (`admno`,`fiscal_year`,`term`,`votehead`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*
Table struture for finance_balances
*/

drop table if exists `finance_balances`;
CREATE TABLE `finance_balances` (
  `admno` varchar(100) NOT NULL default '',
  `form` varchar(10) NOT NULL default '',
  `term` varchar(10) NOT NULL default '',
  `year` int(4) NOT NULL,
  `balance` float(18,2) default NULL,
  `updated` int(4) NOT NULL,
  PRIMARY KEY  (`admno`,`term`,`year`,`updated`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*
Table struture for finance_estimates
*/

drop table if exists `finance_estimates`;
CREATE TABLE `finance_estimates` (
  `fiscal_yr` int(20) NOT NULL,
  `votehead` varchar(255) NOT NULL default '',
  `amount` decimal(18,2) default '0.00',
  PRIMARY KEY  (`fiscal_yr`,`votehead`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*
Table struture for finance_fees
*/

drop table if exists `finance_fees`;
CREATE TABLE `finance_fees` (
  `fiscal_yr` int(20) NOT NULL,
  `term` varchar(255) NOT NULL default '',
  `form` varchar(255) NOT NULL default '',
  `votehead` varchar(255) NOT NULL default '',
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
  `dateofpay` varchar(100) NOT NULL default '',
  `modeofpay` varchar(100) NOT NULL default '',
  `votehead` varchar(100) NOT NULL default '',
  `votehead_amt` decimal(18,2) NOT NULL default '0.00',
  `term` varchar(100) NOT NULL default '',
  `year` int(100) NOT NULL,
  `statusis` varchar(100) NOT NULL default '',
  `servedby` varchar(100) NOT NULL default '',
  `total_amount` decimal(18,2) NOT NULL default '0.00',
  `words` text NOT NULL,
  `bank_account` varchar(100) NOT NULL default '',
  `balance` decimal(18,2) NOT NULL default '0.00',
  `payment_for` varchar(100) NOT NULL default 'School',
  `bankreceipt` varchar(1000) NOT NULL default '',
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
  `fiscal_year` int(4) NOT NULL,
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
  `fiscal_year` int(4) NOT NULL,
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
  `term` varchar(100) NOT NULL default '',
  `votehead` varchar(100) NOT NULL default '',
  `code` varchar(100) NOT NULL default '',
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
Table struture for income
*/

drop table if exists `income`;
CREATE TABLE `income` (
  `no` int(100) NOT NULL auto_increment,
  `year` int(100) NOT NULL,
  `term` int(100) NOT NULL,
  `dateofIncome` varchar(100) NOT NULL,
  `mode` varchar(100) NOT NULL,
  `bank` varchar(100) NOT NULL,
  `chequeno` varchar(100) NOT NULL,
  `amount` double NOT NULL,
  `account` varchar(100) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY  (`no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
Table data for gathanji.initials
*/

INSERT INTO `initials` VALUES ('ANDREW JUMA WAFULA','FORM 1','N','History','JUMA') , ('ANDREW JUMA WAFULA','FORM 1','S','History','JUMA') , ('DOMINIC ONDIEKI NYABERA','FORM 1','N','Math','nyabera') , ('DOMINIC ONDIEKI NYABERA','FORM 1','N','Math','Nyabera D') , ('DOMINIC ONDIEKI NYABERA','FORM 1','N','Physics','nyabera') , ('DOMINIC ONDIEKI NYABERA','FORM 1','N','Physics','Nyabera D') , ('DOMINIC ONDIEKI NYABERA','FORM 1','W','Math','nyabera') , ('DOMINIC ONDIEKI NYABERA','FORM 1','W','Math','Nyabera D') , ('DOMINIC ONDIEKI NYABERA','FORM 1','W','Physics','nyabera') , ('DOMINIC ONDIEKI NYABERA','FORM 1','W','Physics','Nyabera D') , ('DOMINIC ONDIEKI NYABERA','FORM 2','S','Physics','nyabera') , ('DOROTHY M M','FORM 1','N','History','dorothy') , ('DOROTHY M M','FORM 2','N','History','D.M.M') , ('DOROTHY M M','FORM 2','N','History','dorothy') , ('DOROTHY M M','FORM 3','N','CRE','DOTOTHY M.M') , ('DOROTHY M M','FORM 3','W','History','M.M.DOROTHY') , ('DOROTHY M M','FORM 4','N','History','DOTOTHY M.M') , ('DOROTHY M M','FORM 4','W','CRE','DOTOTHY M.M') , ('EPHANTUS WERU MAINA','FORM 3','N','History','E.W MAINA') , ('EPHANTUS WERU MAINA','FORM 3','N','History','E.W. MAINA') , ('EPHANTUS WERU MAINA','FORM 3','N','History','E.W.MAINA') , ('EPHANTUS WERU MAINA','FORM 4','S','History','E.W.MAINA') , ('FELISTER NKIROTE KITHINJI','FORM 1','W','English','kithinji') , ('FELISTER NKIROTE KITHINJI','FORM 2','S','English','MS. KITHINJI') , ('GATHINJI J KAMAU','FORM 2','S','English','K.J.G') , ('GATHINJI J KAMAU','FORM 2','W','English','J.G.KAMAU') , ('GATHINJI J KAMAU','FORM 2','W','English','KAMAU J.G') , ('GATHINJI J KAMAU','FORM 3','S','English','J.G.KAMAU') , ('GATHINJI J KAMAU','FORM 3','S','English','KAMAU J') , ('GATHINJI J KAMAU','FORM 3','W','English','J.G.KAMAU') , ('GATHINJI J KAMAU','FORM 4','W','English','J.G.KAMAU') , ('JAMES GITAKA KIIRI','FORM 2','N','Biology','J.G.K') , ('JAMES GITAKA KIIRI','FORM 3','N','Agriculture','J.G.K') , ('JAMES GITAKA KIIRI','FORM 3','N','Agriculture','J.K.GITAKA') , ('JAMES GITAKA KIIRI','FORM 3','N','Biology','J.K.GITAKA') , ('JAMES GITAKA KIIRI','FORM 4','N','Agriculture','J.K.GITAKA') , ('JAMES GITAKA KIIRI','FORM 4','N','Biology','J.K.GITAKA') , ('JAMES NJOROGE W.','FORM 2','S','CRE','J.N.W') , ('JAMES NJOROGE W.','FORM 2','S','Kiswahili','J.N.W') , ('JAMES NJOROGE W.','FORM 2','S','Kiswahili','MR. NJOROGE') , ('JAMES NJOROGE W.','FORM 3','N','Kiswahili','J.W.NJOROGE') , ('JAMES NJOROGE W.','FORM 4','N','Kiswahili','J.W.NJOROGE') , ('JONN KARIUKI MUGO','FORM 1','N','Physics','kariuki') , ('JONN KARIUKI MUGO','FORM 1','N','Physics','NYABERA') , ('JONN KARIUKI MUGO','FORM 1','S','Physics','kariuki') , ('JONN KARIUKI MUGO','FORM 1','W','Math','kariuki') , ('JONN KARIUKI MUGO','FORM 1','W','Math','NYABERA') , ('JONN KARIUKI MUGO','FORM 2','S','Physics','J.K.M') , ('JONN KARIUKI MUGO','FORM 2','S','Physics','MR.KARIUKI') , ('JOSEPH MUTUGI N','FORM 1','N','English','J.N.MUTUGI') , ('JOSEPH MUTUGI N','FORM 1','N','English','mutugi') , ('JOSEPH MUTUGI N','FORM 1','S','English','J.M.N') , ('JOSEPH MUTUGI N','FORM 1','S','English','mutugi') , ('JOSEPH MUTUGI N','FORM 2','N','English','J.M.N') , ('JOSEPH MUTUGI N','FORM 2','N','English','MR. MUTUGI') , ('JOSEPH MUTUGI N','FORM 2','N','English','mutugi') , ('JOSEPH MUTUGI N','FORM 2','S','English','J.N.MUTUGI') , ('JOSEPH MUTUGI N','FORM 2','S','English','MUTUGI') , ('JOSEPH MUTUGI N','FORM 3','N','English','J.N.MUTUGI') , ('JOSEPH MUTUGI N','FORM 3','N','English','MUTUGI J.N') , ('JOSEPH MUTUGI N','FORM 3','S','English','J.M.N') , ('JOSEPH MUTUGI N','FORM 3','S','English','J.N.MUTUGI') , ('JOSEPH MUTUGI N','FORM 3','S','English','KAMAU J') , ('KAMAU BONIFACE NGIGI','FORM 1','W','Kiswahili','B.N.KAMAU') , ('KAMAU BONIFACE NGIGI','FORM 1','W','Kiswahili','KAMAU B.') , ('KAMAU BONIFACE NGIGI','FORM 1','W','Kiswahili','kamau.B') , ('KAMAU BONIFACE NGIGI','FORM 2','N','Kiswahili','B.N.KAMAU') , ('KAMAU BONIFACE NGIGI','FORM 2','N','Kiswahili','KAMAU') , ('KAMAU BONIFACE NGIGI','FORM 2','W','Kiswahili','K.B.N') , ('KAMAU BONIFACE NGIGI','FORM 2','W','Kiswahili','MR. KAMAU B.N') , ('KAMAU BONIFACE NGIGI','FORM 3','W','Kiswahili','B.N.KAMAU') , ('KAMAU BONIFACE NGIGI','FORM 3','W','Kiswahili','KAMAU B.') , ('KAMAU BONIFACE NGIGI','FORM 3','W','Kiswahili','KAMAU B.N') , ('KAMAU BONIFACE NGIGI','FORM 4','N','Kiswahili','B.N.KAMAU') , ('KAMAU BONIFACE NGIGI','FORM 4','W','Kiswahili','B.N.KAMAU') , ('KIARIE JOHN BENSON','FORM 1','N','Geography','j.b kiarie') , ('KIARIE JOHN BENSON','FORM 1','S','Geography','j.b kiarie') , ('KIARIE JOHN BENSON','FORM 1','W','CRE','j.b kiarie') , ('KIARIE JOHN BENSON','FORM 1','W','History','j.b kiarie') , ('KIARIE JOHN BENSON','FORM 1','W','History','J.B.KIARIE') , ('KIARIE JOHN BENSON','FORM 2','N','Geography','j.b kiarie') , ('KIARIE JOHN BENSON','FORM 2','N','Geography','J.B.K') , ('KIARIE JOHN BENSON','FORM 2','N','Geography','kiarie') , ('KIARIE JOHN BENSON','FORM 2','N','History','KIARIE') , ('KIARIE JOHN BENSON','FORM 2','S','Geography','j.b kiarie') , ('KIARIE JOHN BENSON','FORM 2','S','Geography','KEARIE') , ('KIARIE JOHN BENSON','FORM 2','W','Geography','J.B.K') , ('KIARIE JOHN BENSON','FORM 2','W','Geography','KIARIE J B') , ('KIARIE JOHN BENSON','FORM 2','W','Geography','MR. KIARIE') , ('KIARIE JOHN BENSON','FORM 2','W','History','KIARIE J B') , ('KIARIE JOHN BENSON','FORM 2','W','History','KIARIE JB') , ('KIARIE JOHN BENSON','FORM 3','N','Geography','J.B.KIARIE') , ('KIARIE JOHN BENSON','FORM 3','N','Geography','KIARIE JB') , ('KIARIE JOHN BENSON','FORM 3','N','History','E.W. MAINA') , ('KIARIE JOHN BENSON','FORM 3','N','History','J.B.KIARIE') , ('KIARIE JOHN BENSON','FORM 3','S','Geography','J.B.KIARIE') , ('KIARIE JOHN BENSON','FORM 3','W','Geography','KIARIE JB') , ('KIARIE JOHN BENSON','FORM 4','N','History','J.B.KIARIE') , ('KIARIE JOHN BENSON','FORM 4','W','History','J.B.KIARIE') , ('MARGARET NYAMBURA NGARI','FORM 1','S','Biology','ngari') , ('MARGARET NYAMBURA NGARI','FORM 2','N','Biology','M.N.N') , ('MARGARET NYAMBURA NGARI','FORM 2','N','Biology','NGARI') , ('MARGARET NYAMBURA NGARI','FORM 2','S','Biology','M.N.N') , ('MARGARET NYAMBURA NGARI','FORM 2','S','Biology','MS. NGARI') , ('MARGARET NYAMBURA NGARI','FORM 2','S','Biology','ngari M N') , ('MARGARET NYAMBURA NGARI','FORM 2','S','Biology','NYAMBURA') , ('MARGARET NYAMBURA NGARI','FORM 3','S','Biology','M.N.NGARI') , ('MARGARET NYAMBURA NGARI','FORM 3','S','Biology','NGARI N') , ('MARGARET NYAMBURA NGARI','FORM 4','N','Biology','M.N.NGARI') , ('MARGARET NYAMBURA NGARI','FORM 4','W','Biology','M.N.NGARI') , ('MARGARET�NYAMBURA�NGARI','FORM 1','1-N','English','') , ('MAUREEN LAGAT C.','FORM 1','W','Kiswahili','KAMAU B') , ('MAUREEN LAGAT C.','FORM 1','W','Kiswahili','lagat') , ('MAUREEN LAGAT C.','FORM 2','S','CRE','MS.LAGAT') , ('MICHAEL','FORM 1','N','Chemistry','gathoni') , ('MICHAEL','FORM 1','N','Chemistry','MBUGUA C') , ('MICHAEL','FORM 2','N','Chemistry','M C M') , ('MICHAEL','FORM 2','N','Chemistry','MBUGUA') , ('MICHAEL','FORM 2','N','Chemistry','MBUGUA C') , ('MICHAEL','FORM 2','W','Chemistry','M,C.M') , ('MICHAEL','FORM 3','S','Chemistry','MBUGUA C') , ('MICHAEL','FORM 3','W','Chemistry','M.C.GATHONI') , ('MICHAEL','FORM 3','W','Chemistry','MBUGUA C') , ('MICHAEL','FORM 4','N','Chemistry','M.C.GATHONI') , ('MICHAEL','FORM 4','W','Chemistry','MBUGUA C') , ('Moses Gatobu Gituma','FORM 2','N','bstudies','GATOBU') , ('Moses Gatobu Gituma','FORM 2','S','bstudies','GATOBU') , ('MUIGA ROBERT -','FORM 1','N','Biology','muiga') , ('MUIGA ROBERT -','FORM 1','S','Chemistry','muiga') , ('MUIGA ROBERT -','FORM 1','W','Biology','muiga') , ('MUIGA ROBERT -','FORM 2','S','Chemistry','MR. MUIGA') , ('MUIGA ROBERT -','FORM 2','S','Chemistry','MUIGA') , ('MUIGA ROBERT -','FORM 2','S','Chemistry','R.M') , ('MUIGA ROBERT -','FORM 2','W','Biology','MUIGA') , ('MUIGA ROBERT -','FORM 2','W','Biology','MUIGA R B') , ('MUIGA ROBERT -','FORM 2','W','Chemistry','MR. MUIGA') , ('MUIGA ROBERT -','FORM 3','W','Biology','R.B.MUIGA') , ('MUIGA ROBERT -','FORM 4','S','Biology','R.B.MUIGA') , ('MUIGA ROBERT -','FORM 4','W','Biology','R.B.MUIGA') , ('MUIGA�ROBERT�-','FORM 1','1-N','English','') , ('MUNENE LUCY WAIRIMU','FORM 1','N','CRE','munene') , ('MUNENE LUCY WAIRIMU','FORM 1','N','History','munene') , ('MUNENE LUCY WAIRIMU','FORM 1','S','History','munene') , ('MUNENE LUCY WAIRIMU','FORM 2','N','bstudies','nganga.f') , ('MUNENE LUCY WAIRIMU','FORM 2','S','History','L.W.M') , ('MUNENE LUCY WAIRIMU','FORM 2','S','History','MS. MUNENE') , ('MUNENE LUCY WAIRIMU','FORM 2','S','History','MUNENE') , ('MUNENE LUCY WAIRIMU','FORM 2','W','CRE','MUNENE') , ('MUNENE LUCY WAIRIMU','FORM 2','W','CRE','MUNENE L.') , ('MUNENE LUCY WAIRIMU','FORM 3','S','CRE','L.W.MUNENE') , ('MUNENE LUCY WAIRIMU','FORM 3','S','History','L.W.MUNENE') , ('MUNENE LUCY WAIRIMU','FORM 3','S','History','MUNENE L.') , ('MUNENE LUCY WAIRIMU','FORM 3','W','CRE','L.W.MUNENE') , ('MUNENE LUCY WAIRIMU','FORM 3','W','History','MUNENE L.') , ('MUNENE LUCY WAIRIMU','FORM 4','N','CRE','L.W.MUNENE') , ('MUNENE LUCY WAIRIMU','FORM 4','W','CRE','L.W.MUNENE') , ('MWANGI HANNAH WANJIRU','FORM 1','N','Math','H.W.M') , ('MWANGI HANNAH WANJIRU','FORM 1','N','Math','mugecha') , ('MWANGI HANNAH WANJIRU','FORM 2','N','Math','H.W.M') , ('MWANGI HANNAH WANJIRU','FORM 2','N','Math','HANNAH') , ('MWANGI HANNAH WANJIRU','FORM 2','N','Math','mugecha') , ('MWANGI HANNAH WANJIRU','FORM 3','N','Math','H.W.MUGECHA') , ('MWANGI HANNAH WANJIRU','FORM 4','N','Math','H.W.MUGECHA') , ('MWAURA SUSAN','FORM 1','N','Agriculture','mwaura') , ('MWAURA SUSAN','FORM 1','N','Agriculture','s. mwaura') , ('MWAURA SUSAN','FORM 1','S','Agriculture','s. mwaura') , ('MWAURA SUSAN','FORM 1','W','Agriculture','s. mwaura') , ('MWAURA SUSAN','FORM 2','N','Agriculture','gathoni') , ('MWAURA SUSAN','FORM 2','N','Agriculture','mwaura') , ('MWAURA SUSAN','FORM 2','N','Agriculture','mwaura s') , ('MWAURA SUSAN','FORM 2','N','Agriculture','s. mwaura') , ('MWAURA SUSAN','FORM 2','N','Agriculture','S.G.W') , ('MWAURA SUSAN','FORM 2','S','Agriculture','MS. MWAURA') , ('MWAURA SUSAN','FORM 2','S','Agriculture','mwaura s') , ('MWAURA SUSAN','FORM 2','S','Agriculture','s. mwaura') , ('MWAURA SUSAN','FORM 2','S','Agriculture','S.G.W') , ('MWAURA SUSAN','FORM 2','W','Agriculture','MS. MWAURA') , ('MWAURA SUSAN','FORM 2','W','Agriculture','mwaura s') , ('MWAURA SUSAN','FORM 2','W','Agriculture','S.G.W') , ('MWAURA SUSAN','FORM 3','N','Agriculture','MWAURA S.G') , ('MWAURA SUSAN','FORM 3','W','Agriculture','S.G.MWAURA') , ('MWAURA SUSAN','FORM 4','W','Agriculture','S.G.MWAURA') , ('NGANGA DAVID KAMAU','FORM 1','S','Physics','nganga. D') , ('NGANGA DAVID KAMAU','FORM 1','W','Physics','nganga D') , ('NGANGA DAVID KAMAU','FORM 2','N','Physics','N.D.K') , ('NGANGA DAVID KAMAU','FORM 2','N','Physics','nganga D') , ('NGANGA DAVID KAMAU','FORM 2','N','Physics','nganga. D') , ('NGANGA DAVID KAMAU','FORM 2','S','bstudies','nganga.f') , ('NGANGA DAVID KAMAU','FORM 2','W','Physics','N.D.K') , ('NGANGA DAVID KAMAU','FORM 3','N','Physics','NGANGA D.') , ('NGANGA DAVID KAMAU','FORM 3','S','Physics','NGANGA D.') , ('NGANGA DAVID KAMAU','FORM 3','W','Physics','NGANGA D.') , ('NGANGA DAVID KAMAU','FORM 4','N','Biology','NGANGA D.') , ('NGANGA DAVID KAMAU','FORM 4','S','Physics','NGANGA D.') , ('NGANGA DAVID KAMAU','FORM 4','W','Physics','NGANGA D.') , ('NYERERE FRANCIS NGANGA','FORM 1','N','bstudies','nganga.f') , ('NYERERE FRANCIS NGANGA','FORM 1','S','bstudies','nganga F') , ('NYERERE FRANCIS NGANGA','FORM 1','S','bstudies','nganga.f') , ('NYERERE FRANCIS NGANGA','FORM 1','W','bstudies','nganga F') , ('NYERERE FRANCIS NGANGA','FORM 1','W','bstudies','nganga.f') , ('NYERERE FRANCIS NGANGA','FORM 2','N','bstudies','N.F.N') , ('NYERERE FRANCIS NGANGA','FORM 2','N','bstudies','nganga F') , ('NYERERE FRANCIS NGANGA','FORM 2','S','bstudies','N.F.N') , ('NYERERE FRANCIS NGANGA','FORM 2','W','bstudies','N.F.N') , ('NYERERE FRANCIS NGANGA','FORM 3','S','bstudies','NGANGA F.') , ('NYERERE FRANCIS NGANGA','FORM 4','S','bstudies','NGANGA F.') , ('PHANUEL MWITI KARIUKI','FORM 2','W','Math','MR. MWITI') , ('PHANUEL MWITI KARIUKI','FORM 2','W','Math','MWITI') , ('PHANUEL MWITI KARIUKI','FORM 2','W','Math','P.M.K') , ('PHANUEL MWITI KARIUKI','FORM 3','N','bstudies','P.K.MWITI') , ('PHANUEL MWITI KARIUKI','FORM 3','N','bstudies','P.M.K') , ('PHANUEL MWITI KARIUKI','FORM 3','S','bstudies','P.K.MWITI') , ('PHANUEL MWITI KARIUKI','FORM 3','W','bstudies','P.K.MWITI') , ('PHANUEL MWITI KARIUKI','FORM 3','W','Math','Mwiti P K') , ('PHANUEL MWITI KARIUKI','FORM 3','W','Math','P.K.MWITI') , ('PHANUEL MWITI KARIUKI','FORM 3','W','Math','P.M') , ('PHANUEL MWITI KARIUKI','FORM 3','W','Math','P.W.K') , ('PHANUEL MWITI KARIUKI','FORM 4','N','bstudies','P.K.MWITI') , ('PHANUEL MWITI KARIUKI','FORM 4','W','Math','P.K.MWITI') , ('PHYLIS JELAGAT','FORM 1','N','bstudies','nganga F') , ('PHYLIS JELAGAT','FORM 1','S','Chemistry','chebii') , ('PHYLIS JELAGAT','FORM 1','W','Chemistry','chebii') , ('PHYLIS JELAGAT','FORM 1','W','CRE','chebii') , ('PHYLIS JELAGAT','FORM 2','N','Chemistry','chebii') , ('PHYLIS JELAGAT','FORM 2','N','Chemistry','P.J.C') , ('PHYLIS JELAGAT','FORM 2','S','Biology','MS. CHEBII') , ('PHYLIS JELAGAT','FORM 2','W','Biology','P.J.C') , ('PHYLIS JELAGAT','FORM 2','W','Chemistry','CHEBII') , ('PHYLIS JELAGAT','FORM 3','N','Chemistry','P.J.CHEBII') , ('PHYLIS JELAGAT','FORM 4','N','Chemistry','P.J.CHEBII') , ('PHYLIS JELAGAT','FORM 4','S','Chemistry','CBEBII') , ('PHYLIS JELAGAT','FORM 4','S','Chemistry','CHEBII') , ('PHYLIS JELAGAT','FORM 4','W','Chemistry','P.J.CHEBII') , ('PRISCILLAH NJERI GICHARU','FORM 1','S','CRE','gicharu') , ('PRISCILLAH NJERI GICHARU','FORM 1','W','CRE','gicharu') , ('PRISCILLAH NJERI GICHARU','FORM 1','W','History','gicharu') , ('PRISCILLAH NJERI GICHARU','FORM 2','N','CRE','gicharu') , ('PRISCILLAH NJERI GICHARU','FORM 2','N','CRE','NJERI') , ('PRISCILLAH NJERI GICHARU','FORM 2','N','CRE','P.N.G') , ('PRISCILLAH NJERI GICHARU','FORM 2','S','Chemistry','gicharu') , ('PRISCILLAH NJERI GICHARU','FORM 2','S','CRE','gicharu') , ('PRISCILLAH NJERI GICHARU','FORM 2','W','History','MRS. GICHARU') , ('PRISCILLAH NJERI GICHARU','FORM 2','W','History','P.N.G') , ('PRISCILLAH NJERI GICHARU','FORM 3','N','CRE','GICHARU P.N') , ('PRISCILLAH NJERI GICHARU','FORM 3','N','CRE','P.N.GICHARU') , ('PRISCILLAH NJERI GICHARU','FORM 3','S','CRE','P.N.G') , ('PRISCILLAH NJERI GICHARU','FORM 3','S','CRE','P.N.GICHARU') , ('PRISCILLAH NJERI GICHARU','FORM 3','S','History','P.N.GICHARU') , ('PRISCILLAH NJERI GICHARU','FORM 3','W','History','GICHARU P.N') , ('PRISCILLAH NJERI GICHARU','FORM 4','S','CRE','P.N.GICHARU') , ('SHIRLEY LIAVULI N.','FORM 1','N','Kiswahili','liavuli') , ('SHIRLEY LIAVULI N.','FORM 1','S','Geography','liavuli') , ('SHIRLEY LIAVULI N.','FORM 1','W','Geography','liavuli') , ('SHIRLEY LIAVULI N.','FORM 2','N','Geography','liavuli') , ('SHIRLEY LIAVULI N.','FORM 2','S','Geography','MS. LIAVULI') , ('SHIRLEY LIAVULI N.','FORM 2','S','Geography','S.L.N') , ('SHIRLEY LIAVULI N.','FORM 2','W','Geography','MS. LIAVULI') , ('SHIRLEY LIAVULI N.','FORM 2','W','Kiswahili','LIAVULI') , ('SHIRLEY LIAVULI N.','FORM 3','N','Kiswahili','liavuli') , ('SHIRLEY LIAVULI N.','FORM 3','N','Kiswahili','LIAVULI S.') , ('SHIRLEY LIAVULI N.','FORM 3','W','Kiswahili','LIAVULI') , ('STEPHEN MIYENDE OIGO','FORM 1','N','Agriculture','oigo') , ('STEPHEN MIYENDE OIGO','FORM 1','N','Biology','oigo') , ('STEPHEN MIYENDE OIGO','FORM 1','S','Agriculture','oigo') , ('STEPHEN MIYENDE OIGO','FORM 1','W','Biology','oigo') , ('STEPHEN MIYENDE OIGO','FORM 3','N','Agriculture','OIGO S. M') , ('STEPHEN MIYENDE OIGO','FORM 3','N','Biology','OIGO S. M') , ('STEPHEN MIYENDE OIGO','FORM 3','S','Agriculture','OIGO S. M') , ('STEPHEN MIYENDE OIGO','FORM 3','S','Biology','OIGO S. M') , ('STEPHEN MIYENDE OIGO','FORM 4','N','Agriculture','OIGO S. M') , ('TABBY WANGUI WAINAINA','FORM 2','N','Kiswahili','macharia') , ('TABBY WANGUI WAINAINA','FORM 2','N','Kiswahili','T.W.W') , ('THERESA AKINYI O','FORM 1','S','Kiswahili','theresa') , ('THERESA AKINYI O','FORM 2','S','Kiswahili','TRIZA') , ('THERESA AKINYI O','FORM 2','W','CRE','MS. TERESA') , ('THERESA AKINYI O','FORM 2','W','CRE','T.A.0') , ('THERESA AKINYI O','FORM 3','','Kiswahili','A. THERESA') , ('THERESA AKINYI O','FORM 3','S','Kiswahili','A. THERESA') , ('THERESA AKINYI O','FORM 3','S','Kiswahili','A.THERESA') , ('THERESA AKINYI O','FORM 3','W','CRE','T.A.O') , ('THERESA AKINYI O','FORM 3','W','Kiswahili','KAMAU B.') , ('THERESA AKINYI O','FORM 3','W','Kiswahili','T.A.O') , ('THERESA AKINYI O','FORM 4','N','CRE','A. THERESA') , ('THERESA AKINYI O','FORM 4','S','Kiswahili','A. THERESA') , ('THIONGO JANE WAMBUI','FORM 1','S','Math','irungu') , ('THIONGO JANE WAMBUI','FORM 2','S','Math','J.W.T') , ('THIONGO JANE WAMBUI','FORM 2','S','Math','JANE') , ('THIONGO JANE WAMBUI','FORM 2','S','Math','JANE T W') , ('THIONGO JANE WAMBUI','FORM 2','W','Math','MS. IRUNGU') , ('THIONGO JANE WAMBUI','FORM 3','S','Math','J. IRUNGU') , ('THIONGO JANE WAMBUI','FORM 4','S','Math','J. IRUNGU') , ('WAINAINA MARY WAMBUI','FORM 1','N','English','wainaina') , ('WAINAINA MARY WAMBUI','FORM 1','W','English','M.W.WAINAINA') , ('WAINAINA MARY WAMBUI','FORM 1','W','English','wainaina') , ('WAINAINA MARY WAMBUI','FORM 2','N','English','M.W.WAINAINA') , ('WAINAINA MARY WAMBUI','FORM 2','N','English','WAINAINA') , ('WAINAINA MARY WAMBUI','FORM 3','N','English','M.W.WAINAINA') , ('WAINAINA MARY WAMBUI','FORM 3','N','English','MUTUGI J.N') , ('WAINAINA MARY WAMBUI','FORM 4','N','English','M.W.WAINAINA') , ('WAWERU LYDIA NJERI','FORM 1','S','English','kiongi') , ('WAWERU LYDIA NJERI','FORM 2','W','English','L.N.W') , ('WAWERU LYDIA NJERI','FORM 2','W','English','MRS. KIONGI') , ('WAWERU LYDIA NJERI','FORM 3','W','English','KIONGI L.W') , ('WAWERU LYDIA NJERI','FORM 4','S','English','L.N.KIONGI') , ('WAWERU LYDIA NJERI','FORM 4','S','English','L.N.W') ;

/*
Table struture for issued_books
*/

drop table if exists `issued_books`;
CREATE TABLE `issued_books` (
  `bookid` int(100) NOT NULL,
  `bookno` varchar(100) NOT NULL default '',
  `userid` varchar(100) NOT NULL default '',
  `dateissued` varchar(100) NOT NULL default '',
  `datedue` varchar(100) NOT NULL default '',
  `issuer` varchar(100) NOT NULL default '',
  `comments` text NOT NULL,
  PRIMARY KEY  (`bookid`,`bookno`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*
Table struture for kcse_final_analysis
*/

drop table if exists `kcse_final_analysis`;
CREATE TABLE `kcse_final_analysis` (
  `adm` varchar(100) NOT NULL default '',
  `indexnumber` varchar(100) NOT NULL default '',
  `names` varchar(100) NOT NULL default '',
  `english` varchar(100) NOT NULL default '',
  `kiswahili` varchar(100) NOT NULL default '',
  `mathematics` varchar(100) NOT NULL default '',
  `biology` varchar(100) NOT NULL default '',
  `chemistry` varchar(100) NOT NULL default '',
  `physics` varchar(100) NOT NULL default '',
  `history` varchar(100) NOT NULL default '',
  `geography` varchar(100) NOT NULL default '',
  `cre` varchar(100) NOT NULL default '',
  `agriculture` varchar(100) NOT NULL default '',
  `businesStudies` varchar(100) NOT NULL default '',
  `french` varchar(100) NOT NULL default '',
  `home` varchar(100) NOT NULL default '',
  `computer` varchar(100) NOT NULL default '',
  `points` varchar(100) NOT NULL default '',
  `tgrade` varchar(100) NOT NULL default '',
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
  `index_numbers` varchar(100) NOT NULL default '',
  `year_finished` int(100) NOT NULL,
  PRIMARY KEY  (`admno`,`index_numbers`,`year_finished`),
  KEY `admon` (`admno`,`year_finished`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*
Table struture for kcsemarks
*/

drop table if exists `kcsemarks`;
CREATE TABLE `kcsemarks` (
  `index_numbers` varchar(100) NOT NULL default '',
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
  `french` varchar(100) NOT NULL default '',
  `home` varchar(100) NOT NULL default '',
  `computer` varchar(100) NOT NULL default '',
  `total_points` int(100) NOT NULL,
  `mean_grade` varchar(100) NOT NULL default '',
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
  `bookno` varchar(100) NOT NULL default '',
  `userid` varchar(100) NOT NULL default '',
  `date_ref` varchar(100) NOT NULL default '',
  `issuer_ref` varchar(100) NOT NULL default '',
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
  `api_url` varchar(255) NOT NULL default '',
  `ekey` varchar(255) NOT NULL default '',
  `senderid` varchar(255) NOT NULL default '',
  `passwrd` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`api_url`,`ekey`,`senderid`,`passwrd`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*
Table data for gathanji.messages_settings
*/

INSERT INTO `messages_settings` VALUES ('http://api.sms.bambika.co.ke:8555?','MuSJtApzrKzm','-','-') ;

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
  `stream` varchar(100) NOT NULL default '',
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
  `stream` varchar(10) NOT NULL default '',
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
  `fname` varchar(20) NOT NULL default '-',
  `lname` varchar(20) NOT NULL default '-',
  `sname` varchar(20) NOT NULL default '-',
  `idpass` varchar(20) NOT NULL default '-',
  `address` varchar(20) NOT NULL default '-',
  `telephone` int(100) NOT NULL default '0',
  PRIMARY KEY  (`no`)
) ENGINE=InnoDB AUTO_INCREMENT=274 DEFAULT CHARSET=latin1;

/*
Table data for gathanji.parentdetails
*/

INSERT INTO `parentdetails` VALUES (1,1188,'-','-','-','-','-',0) , (2,1197,'-','-','-','-','-',0) , (3,1227,'-','-','-','-','-',0) , (4,1231,'-','-','-','-','-',0) , (5,1232,'-','-','-','-','-',0) , (6,1233,'-','-','-','-','-',0) , (7,1234,'-','-','-','-','-',0) , (8,1235,'-','-','-','-','-',0) , (9,1236,'-','-','-','-','-',0) , (10,1237,'-','-','-','-','-',0) , (11,1238,'-','-','-','-','-',0) , (12,1239,'-','-','-','-','-',0) , (13,1240,'-','-','-','-','-',0) , (14,1241,'-','-','-','-','-',0) , (15,1242,'-','-','-','-','-',0) , (16,1243,'-','-','-','-','-',0) , (17,1244,'-','-','-','-','-',0) , (18,1245,'-','-','-','-','-',0) , (19,1246,'-','-','-','-','-',0) , (20,1248,'-','-','-','-','-',0) , (21,1249,'-','-','-','-','-',0) , (22,1250,'-','-','-','-','-',0) , (23,1251,'-','-','-','-','-',0) , (24,1252,'-','-','-','-','-',0) , (25,1253,'-','-','-','-','-',0) , (26,1254,'-','-','-','-','-',0) , (27,1255,'-','-','-','-','-',0) , (28,1257,'-','-','-','-','-',0) , (29,1258,'-','-','-','-','-',0) , (30,1260,'-','-','-','-','-',0) , (31,1261,'-','-','-','-','-',0) , (32,1262,'-','-','-','-','-',0) , (33,1265,'-','-','-','-','-',0) , (34,1266,'-','-','-','-','-',0) , (35,1267,'-','-','-','-','-',0) , (36,1271,'-','-','-','-','-',0) , (37,1272,'-','-','-','-','-',0) , (38,1273,'-','-','-','-','-',0) , (39,1274,'-','-','-','-','-',0) , (40,1276,'-','-','-','-','-',0) , (41,1277,'-','-','-','-','-',0) , (42,1278,'-','-','-','-','-',0) , (43,1279,'-','-','-','-','-',0) , (44,1280,'-','-','-','-','-',0) , (45,1281,'-','-','-','-','-',0) , (46,1282,'-','-','-','-','-',0) , (47,1283,'-','-','-','-','-',0) , (48,1284,'-','-','-','-','-',0) , (49,1285,'-','-','-','-','-',0) , (50,1286,'-','-','-','-','-',0) , (51,1287,'-','-','-','-','-',0) , (52,1288,'-','-','-','-','-',0) , (53,1289,'-','-','-','-','-',0) , (54,1292,'-','-','-','-','-',0) , (55,1294,'-','-','-','-','-',0) , (56,1295,'-','-','-','-','-',0) , (57,1296,'-','-','-','-','-',0) , (58,1298,'-','-','-','-','-',0) , (59,1299,'-','-','-','-','-',0) , (60,1300,'-','-','-','-','-',0) , (61,1301,'-','-','-','-','-',0) , (62,1302,'-','-','-','-','-',0) , (63,1303,'-','-','-','-','-',0) , (64,1304,'-','-','-','-','-',0) , (65,1305,'-','-','-','-','-',0) , (66,1306,'-','-','-','-','-',0) , (67,1308,'-','-','-','-','-',0) , (68,1309,'-','-','-','-','-',0) , (69,1312,'-','-','-','-','-',0) , (70,1313,'-','-','-','-','-',0) , (71,1318,'-','-','-','-','-',0) , (72,1321,'-','-','-','-','-',0) , (73,1325,'-','-','-','-','-',0) , (74,1327,'-','-','-','-','-',0) , (75,1328,'-','-','-','-','-',0) , (76,1330,'-','-','-','-','-',0) , (77,1332,'-','-','-','-','-',0) , (78,1333,'-','-','-','-','-',0) , (79,1334,'-','-','-','-','-',0) , (80,1335,'-','-','-','-','-',0) , (81,1336,'-','-','-','-','-',0) , (82,1337,'-','-','-','-','-',0) , (83,1338,'-','-','-','-','-',0) , (84,1339,'-','-','-','-','-',0) , (85,1340,'-','-','-','-','-',0) , (86,1341,'-','-','-','-','-',0) , (87,1342,'-','-','-','-','-',0) , (88,1343,'-','-','-','-','-',0) , (89,1344,'-','-','-','-','-',0) , (90,1345,'-','-','-','-','-',0) , (91,1346,'-','-','-','-','-',0) , (92,1347,'-','-','-','-','-',0) , (93,1348,'-','-','-','-','-',0) , (94,1349,'-','-','-','-','-',0) , (95,1350,'-','-','-','-','-',0) , (96,1351,'-','-','-','-','-',0) , (97,1352,'-','-','-','-','-',0) , (98,1353,'-','-','-','-','-',0) , (99,1354,'-','-','-','-','-',0) , (100,1355,'-','-','-','-','-',0) , (101,1356,'-','-','-','-','-',0) , (102,1357,'-','-','-','-','-',0) , (103,1358,'-','-','-','-','-',0) , (104,1359,'-','-','-','-','-',0) , (105,1360,'-','-','-','-','-',0) , (106,1361,'-','-','-','-','-',0) , (107,1362,'-','-','-','-','-',0) , (108,1363,'-','-','-','-','-',0) , (109,1364,'-','-','-','-','-',0) , (110,1365,'-','-','-','-','-',0) , (111,1366,'-','-','-','-','-',0) , (112,1367,'-','-','-','-','-',0) , (113,1368,'-','-','-','-','-',0) , (114,1369,'-','-','-','-','-',0) , (115,1370,'-','-','-','-','-',0) , (116,1371,'-','-','-','-','-',0) , (117,1372,'-','-','-','-','-',0) , (118,1373,'-','-','-','-','-',0) , (119,1374,'-','-','-','-','-',0) , (120,1375,'-','-','-','-','-',0) , (121,1376,'-','-','-','-','-',0) , (122,1377,'-','-','-','-','-',0) , (123,1378,'-','-','-','-','-',0) , (124,1379,'-','-','-','-','-',0) , (125,1380,'-','-','-','-','-',0) , (126,1381,'-','-','-','-','-',0) , (127,1382,'-','-','-','-','-',0) , (128,1383,'-','-','-','-','-',0) , (129,1384,'-','-','-','-','-',0) , (130,1386,'-','-','-','-','-',0) , (131,1387,'-','-','-','-','-',0) , (132,1388,'-','-','-','-','-',0) , (133,1389,'-','-','-','-','-',0) , (134,1390,'-','-','-','-','-',0) , (135,1392,'-','-','-','-','-',0) , (136,1395,'-','-','-','-','-',0) , (137,1396,'-','-','-','-','-',0) , (138,1397,'-','-','-','-','-',0) , (139,1398,'-','-','-','-','-',0) , (140,1399,'-','-','-','-','-',0) , (141,1400,'-','-','-','-','-',0) , (142,1401,'-','-','-','-','-',0) , (143,1402,'-','-','-','-','-',0) , (144,1403,'-','-','-','-','-',0) , (145,1404,'-','-','-','-','-',0) , (146,1405,'-','-','-','-','-',0) , (147,1406,'-','-','-','-','-',0) , (148,1407,'-','-','-','-','-',0) , (149,1408,'-','-','-','-','-',0) , (150,1409,'-','-','-','-','-',0) , (151,1410,'-','-','-','-','-',0) , (152,1411,'-','-','-','-','-',0) , (153,1412,'-','-','-','-','-',0) , (154,1413,'-','-','-','-','-',0) , (155,1414,'-','-','-','-','-',0) , (156,1415,'-','-','-','-','-',0) , (157,1416,'-','-','-','-','-',0) , (158,1417,'-','-','-','-','-',0) , (159,1418,'-','-','-','-','-',0) , (160,1419,'-','-','-','-','-',0) , (161,1420,'-','-','-','-','-',0) , (162,1421,'-','-','-','-','-',0) , (163,1423,'-','-','-','-','-',0) , (164,1424,'-','-','-','-','-',0) , (165,1425,'-','-','-','-','-',0) , (166,1426,'-','-','-','-','-',0) , (167,1427,'-','-','-','-','-',0) , (168,1428,'-','-','-','-','-',0) , (169,1429,'-','-','-','-','-',0) , (170,1430,'-','-','-','-','-',0) , (171,1431,'-','-','-','-','-',0) , (172,1432,'-','-','-','-','-',0) , (173,1434,'-','-','-','-','-',0) , (174,1435,'-','-','-','-','-',0) , (175,1436,'-','-','-','-','-',0) , (176,1437,'-','-','-','-','-',0) , (177,1438,'-','-','-','-','-',0) , (178,1439,'-','-','-','-','-',0) , (179,1440,'-','-','-','-','-',0) , (180,1441,'-','-','-','-','-',0) , (181,1442,'-','-','-','-','-',0) , (182,1443,'-','-','-','-','-',0) , (183,1444,'-','-','-','-','-',0) , (184,1445,'-','-','-','-','-',0) , (185,1446,'-','-','-','-','-',0) , (186,1447,'-','-','-','-','-',0) , (187,1448,'-','-','-','-','-',0) , (188,1449,'-','-','-','-','-',0) , (189,1450,'-','-','-','-','-',0) , (190,1451,'-','-','-','-','-',0) , (191,1452,'-','-','-','-','-',0) , (192,1453,'-','-','-','-','-',0) , (193,1454,'-','-','-','-','-',0) , (194,1455,'-','-','-','-','-',0) , (195,1456,'-','-','-','-','-',0) , (196,1457,'-','-','-','-','-',0) , (197,1458,'-','-','-','-','-',0) , (198,1459,'-','-','-','-','-',0) , (199,1460,'-','-','-','-','-',0) , (200,1461,'-','-','-','-','-',0) , (201,1462,'-','-','-','-','-',0) , (202,1463,'-','-','-','-','-',0) , (203,1464,'-','-','-','-','-',0) , (204,1465,'-','-','-','-','-',0) , (205,1466,'-','-','-','-','-',0) , (206,1467,'-','-','-','-','-',0) , (207,1468,'-','-','-','-','-',0) , (208,1469,'-','-','-','-','-',0) , (209,1470,'-','-','-','-','-',0) , (210,1471,'-','-','-','-','-',0) , (211,1472,'-','-','-','-','-',0) , (212,1473,'-','-','-','-','-',0) , (213,1474,'-','-','-','-','-',0) , (214,1475,'-','-','-','-','-',0) , (215,1476,'-','-','-','-','-',0) , (216,1477,'-','-','-','-','-',0) , (217,1478,'-','-','-','-','-',0) , (218,1479,'-','-','-','-','-',0) , (219,1480,'-','-','-','-','-',0) , (220,1481,'-','-','-','-','-',0) , (221,1482,'-','-','-','-','-',0) , (222,1483,'-','-','-','-','-',0) , (223,1484,'-','-','-','-','-',0) , (224,1485,'-','-','-','-','-',0) , (225,1486,'-','-','-','-','-',0) , (226,1487,'-','-','-','-','-',0) , (227,1488,'-','-','-','-','-',0) , (228,1489,'-','-','-','-','-',0) , (229,1490,'-','-','-','-','-',0) , (230,1491,'-','-','-','-','-',0) , (231,1492,'-','-','-','-','-',0) , (232,1493,'-','-','-','-','-',0) , (233,1494,'-','-','-','-','-',0) , (234,1495,'-','-','-','-','-',0) , (235,1496,'-','-','-','-','-',0) , (236,1497,'-','-','-','-','-',0) , (237,1498,'-','-','-','-','-',0) , (238,1499,'-','-','-','-','-',0) , (239,1500,'-','-','-','-','-',0) , (240,1501,'-','-','-','-','-',0) , (241,1502,'-','-','-','-','-',0) , (242,1503,'-','-','-','-','-',0) , (243,1504,'-','-','-','-','-',0) , (244,1505,'-','-','-','-','-',0) , (245,1506,'-','-','-','-','-',0) , (246,1507,'-','-','-','-','-',0) , (247,1508,'-','-','-','-','-',0) , (248,1509,'-','-','-','-','-',0) , (249,1510,'-','-','-','-','-',0) , (250,1511,'-','-','-','-','-',0) , (251,1512,'-','-','-','-','-',0) , (252,1513,'-','-','-','-','-',0) , (253,1514,'-','-','-','-','-',0) , (254,1515,'-','-','-','-','-',0) , (255,1516,'-','-','-','-','-',0) , (256,1517,'-','-','-','-','-',0) , (257,1518,'-','-','-','-','-',0) , (258,1519,'-','-','-','-','-',0) , (259,1520,'-','-','-','-','-',0) , (260,1521,'-','-','-','-','-',0) , (261,1522,'-','-','-','-','-',0) , (262,1523,'-','-','-','-','-',0) , (263,1524,'-','-','-','-','-',0) , (264,1525,'-','-','-','-','-',0) , (265,1526,'-','-','-','-','-',0) , (266,1527,'-','-','-','-','-',0) , (267,1528,'-','-','-','-','-',0) , (268,1529,'-','-','-','-','-',0) , (269,1530,'-','-','-','-','-',0) , (270,1531,'-','-','-','-','-',0) , (271,1532,'-','-','-','-','-',0) , (272,1533,'-','-','-','-','-',0) , (273,1534,'-','-','-','-','-',0) ;

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
Table data for gathanji.positionby
*/

INSERT INTO `positionby` VALUES (0,1) ;

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
  `stream` varchar(10) NOT NULL default '',
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
  `po_number` varchar(100) NOT NULL default '',
  `item` varchar(255) NOT NULL default '',
  `qty` int(100) NOT NULL,
  PRIMARY KEY  (`po_number`,`item`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*
Table struture for purchase_orderitems_received
*/

drop table if exists `purchase_orderitems_received`;
CREATE TABLE `purchase_orderitems_received` (
  `id` int(100) NOT NULL auto_increment,
  `po_number` varchar(100) NOT NULL default '',
  `item` varchar(255) NOT NULL default '',
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
  `po_number` varchar(100) NOT NULL default '',
  `po_date` varchar(100) NOT NULL default '',
  `d_date` varchar(100) NOT NULL default '',
  `supplier` varchar(255) NOT NULL default '',
  `address` varchar(255) NOT NULL default '',
  `email` varchar(100) NOT NULL default '',
  `telephone` int(20) NOT NULL,
  `po_notes` text NOT NULL,
  `authorized_by` varchar(250) NOT NULL default '',
  `po_status` varchar(20) NOT NULL default 'OPEN',
  PRIMARY KEY  (`po_number`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*
Table struture for purchase_orders_received
*/

drop table if exists `purchase_orders_received`;
CREATE TABLE `purchase_orders_received` (
  `po_number` varchar(100) NOT NULL default '',
  `delivery` varchar(100) NOT NULL default '',
  `d_date` varchar(100) NOT NULL default '',
  `d_notes` text NOT NULL,
  `received_by` varchar(100) NOT NULL default '',
  PRIMARY KEY  (`po_number`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*
Table struture for schoolname
*/

drop table if exists `schoolname`;
CREATE TABLE `schoolname` (
  `schname` varchar(100) NOT NULL,
  `box` varchar(100) NOT NULL,
  `place` varchar(100) NOT NULL,
  `telphone` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL default '',
  `website` varchar(100) NOT NULL default '',
  PRIMARY KEY  (`schname`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*
Table data for gathanji.schoolname
*/

INSERT INTO `schoolname` VALUES ('Gathanji Secondary School','68 -00216','Githunguri','-','','') ;

/*
Table struture for schools
*/

drop table if exists `schools`;
CREATE TABLE `schools` (
  `nos` int(100) NOT NULL auto_increment,
  `telephone` int(100) NOT NULL,
  `category` varchar(100) NOT NULL,
  `t_gender` varchar(100) NOT NULL,
  PRIMARY KEY  (`nos`,`telephone`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*
Table struture for sent_messages
*/

drop table if exists `sent_messages`;
CREATE TABLE `sent_messages` (
  `id` int(100) NOT NULL auto_increment,
  `msg_to` varchar(100) NOT NULL default '',
  `message` text NOT NULL,
  `date_sent` varchar(100) NOT NULL default '',
  `sender` varchar(100) NOT NULL default '',
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
  `employement_type` varchar(100) NOT NULL default '',
  `kra_pin` varchar(100) NOT NULL default '',
  `salary` decimal(18,2) default '0.00',
  `qualification` varchar(100) NOT NULL default '',
  `cv` varchar(100) NOT NULL default '',
  `address` varchar(100) NOT NULL default '',
  `imgref` varchar(100) NOT NULL default '',
  `passwrd` varchar(100) NOT NULL default '',
  `dateJoined` varchar(100) NOT NULL default '',
  `dateLeft` varchar(100) NOT NULL default '',
  PRIMARY KEY  (`idpass`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*
Table data for gathanji.staff
*/

INSERT INTO `staff` VALUES ('LEAH','MWEREINI','MBUGUA','27380844','0710432567','Secretary','0','Full-Time','0','0.00','0','','','blur.PNG','27380844','2018-05-30','_') , ('-','-','admin','admin','-','Administrator','-','Full-Time','-','0.00','-','',' ','','admin','2014-06-30','_') ;

/*
Table struture for standards
*/

drop table if exists `standards`;
CREATE TABLE `standards` (
  `cat1` int(100) NOT NULL,
  `cat2` int(100) NOT NULL,
  `exam` int(100) NOT NULL,
  `cat1percent` int(100) NOT NULL,
  `cat2percent` int(100) NOT NULL,
  `exampercent` int(100) NOT NULL,
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
  `students` int(100) NOT NULL default '0',
  `classteacher` varchar(100) NOT NULL default '-',
  PRIMARY KEY  (`form`,`stream`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*
Table data for gathanji.streams
*/

INSERT INTO `streams` VALUES ('Form 1','1N',0,'-') , ('Form 1','1S',0,'-') , ('Form 2','2N',0,'-') , ('Form 2','2S',0,'-') , ('Form 3','3N',0,'-') , ('Form 3','3S',0,'-') , ('Form 4','4N',0,'-') , ('Form 4','4S',0,'-') ;

/*
Table struture for studentdetails
*/

drop table if exists `studentdetails`;
CREATE TABLE `studentdetails` (
  `admno` int(10) NOT NULL,
  `fname` varchar(200) NOT NULL,
  `lname` varchar(20) NOT NULL default '-',
  `sname` varchar(20) NOT NULL default '-',
  `gender` varchar(10) NOT NULL default '-',
  `dob` varchar(20) NOT NULL default '-',
  `age` varchar(20) NOT NULL default '-',
  `religion` varchar(20) NOT NULL default '-',
  `previouschool` varchar(20) NOT NULL default '-',
  `marks` int(11) NOT NULL default '0',
  `picture` varchar(100) NOT NULL default '-',
  `yrofadmn` int(11) NOT NULL default '0',
  `form` varchar(10) NOT NULL default '-',
  `forminto` varchar(10) NOT NULL default '-',
  `category` varchar(100) NOT NULL default '-',
  `house` varchar(100) NOT NULL default '-',
  `grade` varchar(100) NOT NULL default '-',
  `class` varchar(100) NOT NULL default '-',
  `year_finished` varchar(100) NOT NULL default '-',
  PRIMARY KEY  (`admno`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*
Table data for gathanji.studentdetails
*/

INSERT INTO `studentdetails` VALUES (1188,'PETER','NGIGI','MUNYUA','Male','-','-','CHRISTIAN','-',0,'-',0,'Form 4','-','DAY','-','-','4N','-') , (1197,'SAMUEL KAHORA MUNGAI','-','-','-','-','-','-','-',0,'-',0,'Form 4','-','-','-','-','4N','-') , (1227,'RACHAEL GATHONI MUROKI','-','-','-','-','-','-','-',0,'-',0,'Form 4','-','-','-','-','4S','-') , (1231,'MARTHA NJERI KIBIRU','-','-','-','-','-','-','-',0,'-',0,'Form 4','-','-','-','-','4S','-') , (1232,'JENNIFER NJAMBI MWAURA','-','-','-','-','-','-','-',0,'-',0,'Form 4','-','-','-','-','4S','-') , (1233,'HANNAH MBAIRE KAMAU','-','-','-','-','-','-','-',0,'-',0,'Form 4','-','-','-','-','4S','-') , (1234,'MARGARET NYAMBURA KARUGU','-','-','-','-','-','-','-',0,'-',0,'Form 4','-','-','-','-','4N','-') , (1235,'ELIJAH  NJUGUNA KAMAU','-','-','-','-','-','-','-',0,'-',0,'Form 4','-','-','-','-','4S','-') , (1236,'WILLIAM GITAU WANJIKU','-','-','-','-','-','-','-',0,'-',0,'Form 4','-','-','-','-','4N','-') , (1237,'JAMES WAITHAKA MAKENA','-','-','-','-','-','-','-',0,'-',0,'Form 4','-','-','-','-','4S','-') , (1238,'MARGARET WANJA WAWERU','-','-','-','-','-','-','-',0,'-',0,'Form 4','-','-','-','-','4N','-') , (1239,'DANIEL KINYANJUI NGANGA','-','-','-','-','-','-','-',0,'-',0,'Form 4','-','-','-','-','4N','-') , (1240,'FRANCIS NGANGA NJUGUNA','-','-','-','-','-','-','-',0,'-',0,'Form 4','-','-','-','-','4S','-') , (1241,'NANCY NJOKI NYUMU','-','-','-','-','-','-','-',0,'-',0,'Form 4','-','-','-','-','4N','-') , (1242,'RACHEAL WAIRIMU GITAU','-','-','-','-','-','-','-',0,'-',0,'Form 4','-','-','-','-','4N','-') , (1243,'NANCY WANJIRU WAWERU','-','-','-','-','-','-','-',0,'-',0,'Form 4','-','-','-','-','4S','-') , (1244,'GLADYS WANJIRU NJOROGE','-','-','-','-','-','-','-',0,'-',0,'Form 4','-','-','-','-','4N','-') , (1245,'JANET MUKAMI KARIUKI','-','-','-','-','-','-','-',0,'-',0,'Form 4','-','-','-','-','4N','-') , (1246,'SAMUEL KURIA NDICHU','-','-','-','-','-','-','-',0,'-',0,'Form 4','-','-','-','-','4N','-') , (1248,'CAROLINE NJERI WATHITHI','-','-','-','-','-','-','-',0,'-',0,'Form 4','-','-','-','-','4S','-') , (1249,'JECINTA WAMBUI KAMAU','-','-','-','-','-','-','-',0,'-',0,'Form 4','-','-','-','-','4S','-') , (1250,'FRANCIS NJOROGE WANJIKU','-','-','-','-','-','-','-',0,'-',0,'Form 4','-','-','-','-','4N','-') , (1251,'ALICE MUMBI NJERI','-','-','-','-','-','-','-',0,'-',0,'Form 4','-','-','-','-','4N','-') , (1252,'JOHN CHEGE NJENGA','-','-','-','-','-','-','-',0,'-',0,'Form 4','-','-','-','-','4N','-') , (1253,'STANSLAUS NGIGI KURIA','-','-','-','-','-','-','-',0,'-',0,'Form 4','-','-','-','-','4S','-') , (1254,'PETER MUNENE KARANJA','-','-','-','-','-','-','-',0,'-',0,'Form 4','-','-','-','-','4S','-') , (1255,'MOSES THUO','-','-','-','-','-','-','-',0,'-',0,'Form 4','-','-','-','-','4N','-') , (1257,'GLADYS WANJIRU MWANGI','-','-','-','-','-','-','-',0,'-',0,'Form 4','-','-','-','-','4S','-') , (1258,'FAITH NJERI WAIRIMU','-','-','-','-','-','-','-',0,'-',0,'Form 4','-','-','-','-','4N','-') , (1260,'JANE WANJIKU NJOROGE','-','-','-','-','-','-','-',0,'-',0,'Form 4','-','-','-','-','4S','-') , (1261,'NAOMI WAIRIMU WANJIKU','-','-','-','-','-','-','-',0,'-',0,'Form 4','-','-','-','-','4S','-') , (1262,'ANN WANGUI MWAURA','-','-','-','-','-','-','-',0,'-',0,'Form 4','-','-','-','-','4N','-') , (1265,'PHILIP MUTURI NJUGUNA','-','-','-','-','-','-','-',0,'-',0,'Form 4','-','-','-','-','4S','-') , (1266,'VERONICAH WAMBUI RUHOHI','-','-','-','-','-','-','-',0,'-',0,'Form 4','-','-','-','-','4S','-') , (1267,'PURITY WANGUI NJUGUNA','-','-','-','-','-','-','-',0,'-',0,'Form 4','-','-','-','-','4S','-') , (1271,'HARUN NJUGUNA','-','-','-','-','-','-','-',0,'-',0,'Form 4','-','-','-','-','4N','-') , (1272,'KELVIN MWAURA KIMANI','-','-','-','-','-','-','-',0,'-',0,'Form 4','-','-','-','-','4S','-') , (1273,'MARGARET WANGECHI KIRURI','-','-','-','-','-','-','-',0,'-',0,'Form 4','-','-','-','-','4S','-') , (1274,'MONICAH WAITHERA MWAURA','-','-','-','-','-','-','-',0,'-',0,'Form 4','-','-','-','-','4N','-') , (1276,'FELISTERS WANJIRU NGIGE','-','-','-','-','-','-','-',0,'-',0,'Form 4','-','-','-','-','4S','-') , (1277,'HARUN KIARIE KIMANI','-','-','-','-','-','-','-',0,'-',0,'Form 4','-','-','-','-','4N','-') , (1278,'MARY WANJIRU KAMAU','-','-','-','-','-','-','-',0,'-',0,'Form 4','-','-','-','-','4S','-') , (1279,'ELIZABETH WANJIRU GITHIRI','-','-','-','-','-','-','-',0,'-',0,'Form 4','-','-','-','-','4N','-') , (1280,'MARY WAMBUI MUKURU','-','-','-','-','-','-','-',0,'-',0,'Form 4','-','-','-','-','4S','-') , (1281,'MARY WANJIRU NJAU','-','-','-','-','-','-','-',0,'-',0,'Form 4','-','-','-','-','4S','-') , (1282,'PETER MBURU KIHARA','-','-','-','-','-','-','-',0,'-',0,'Form 4','-','-','-','-','4S','-') , (1283,'BRIAN GITHUA MBURU','-','-','-','-','-','-','-',0,'-',0,'Form 4','-','-','-','-','4N','-') , (1284,'SAMUEL NJERU KINYANJUI','-','-','-','-','-','-','-',0,'-',0,'Form 4','-','-','-','-','4S','-') , (1285,'MARY WANGUI GITAU','-','-','-','-','-','-','-',0,'-',0,'Form 4','-','-','-','-','4N','-') , (1286,'PETER GITHINJI MWIHAKI','-','-','-','-','-','-','-',0,'-',0,'Form 4','-','-','-','-','4S','-') , (1287,'DAVID NDUNGU MBUGUA','-','-','-','-','-','-','-',0,'-',0,'Form 4','-','-','-','-','4N','-') , (1288,'BENSON KARUGU MWANGI','-','-','-','-','-','-','-',0,'-',0,'Form 4','-','-','-','-','4N','-') , (1289,'PURITY NJOKI GICHUHI','-','-','-','-','-','-','-',0,'-',0,'Form 4','-','-','-','-','4S','-') , (1292,'JEFF NGANGA','-','-','-','-','-','-','-',0,'-',0,'Form 4','-','-','-','-','4N','-') , (1294,'JAMES NJUGUNA MUREITHI','-','-','-','-','-','-','-',0,'-',0,'Form 4','-','-','-','-','4N','-') , (1295,'VERGINIA MWIHAKI KINUTHIA','-','-','-','-','-','-','-',0,'-',0,'Form 4','-','-','-','-','4S','-') , (1296,'GLADYS WANJIRU NJERI','-','-','-','-','-','-','-',0,'-',0,'Form 4','-','-','-','-','4N','-') , (1298,'KELVIN KAMAU NGUGI','-','-','-','-','-','-','-',0,'-',0,'Form 4','-','-','-','-','4N','-') , (1299,'TABITHA WANJIRU MBUGUA','-','-','-','-','-','-','-',0,'-',0,'Form 4','-','-','-','-','4N','-') , (1300,'JOYCE WANGUI THIONGO','-','-','-','-','-','-','-',0,'-',0,'Form 4','-','-','-','-','4S','-') , (1301,'STEPHEN NGANJU GICHERU','-','-','-','-','-','-','-',0,'-',0,'Form 4','-','-','-','-','4N','-') , (1302,'BEATRICE NYAMURWA .W','-','-','-','-','-','-','-',0,'-',0,'Form 4','-','-','-','-','4S','-') , (1303,'ISAAC MWANGI KAMAU','-','-','-','-','-','-','-',0,'-',0,'Form 4','-','-','-','-','4S','-') , (1304,'VERONICA NGINA NGIGI','-','-','-','-','-','-','-',0,'-',0,'Form 4','-','-','-','-','4N','-') , (1305,'VINCENT NGANGA WANJIKU','-','-','-','-','-','-','-',0,'-',0,'Form 4','-','-','-','-','4N','-') , (1306,'JACINTA NYIHA MWAURA','-','-','-','-','-','-','-',0,'-',0,'Form 4','-','-','-','-','4S','-') , (1308,'AMOS NJUGUNA WANGUI','-','-','-','-','-','-','-',0,'-',0,'Form 4','-','-','-','-','4N','-') , (1309,'MAUREEN WANGARI NJERI','-','-','-','-','-','-','-',0,'-',0,'Form 4','-','-','-','-','4N','-') , (1312,'BONFACE KAMAU KINYANJUI','-','-','-','-','-','-','-',0,'-',0,'Form 4','-','-','-','-','4N','-') , (1313,'MARY WAIRIMU NJUGUNA','-','-','-','-','-','-','-',0,'-',0,'Form 4','-','-','-','-','4S','-') , (1318,'LYDIAH RINDI KINYUA','-','-','-','-','-','-','-',0,'-',0,'Form 4','-','-','-','-','4S','-') , (1321,'KENNEDY KAHUHA KANINA','-','-','-','-','-','-','-',0,'-',0,'Form 4','-','-','-','-','4S','-') , (1325,'SUSAN GATHONI WACHIRA','-','-','-','-','-','-','-',0,'-',0,'Form 4','-','-','-','-','4N','-') , (1327,'ERICK KAMAU IRUNGU','-','-','-','-','-','-','-',0,'-',0,'Form 4','-','-','-','-','4N','-') , (1328,'CHRISTOPHER NJUGUNA MUGURE','-','-','-','-','-','-','-',0,'-',0,'Form 4','-','-','-','-','4S','-') , (1330,'PHILIP WANJOHI','-','-','-','-','-','-','-',0,'-',0,'Form 3','-','-','-','-','3S','-') , (1332,'JOHN CHEGE','-','-','-','-','-','-','-',0,'-',0,'Form 3','-','-','-','-','3N','-') , (1333,'TERESIA GATHONI','-','-','-','-','-','-','-',0,'-',0,'Form 3','-','-','-','-','3S','-') , (1334,'HANNAH NJOKI GACHANGI','-','-','-','-','-','-','-',0,'-',0,'Form 3','-','-','-','-','3S','-') , (1335,'MARY NJERI','-','-','-','-','-','-','-',0,'-',0,'Form 3','-','-','-','-','3S','-') , (1336,'RAHAB NJUGUNA','-','-','-','-','-','-','-',0,'-',0,'Form 3','-','-','-','-','3S','-') , (1337,'JOHN BORO','-','-','-','-','-','-','-',0,'-',0,'Form 3','-','-','-','-','3N','-') , (1338,'PETER MBUGUA','-','-','-','-','-','-','-',0,'-',0,'Form 3','-','-','-','-','3N','-') , (1339,'ALICE WANJIRU','-','-','-','-','-','-','-',0,'-',0,'Form 3','-','-','-','-','3N','-') , (1340,'HARUN KIARIE','-','-','-','-','-','-','-',0,'-',0,'Form 3','-','-','-','-','3S','-') , (1341,'MARYANNE WANJIKU','-','-','-','-','-','-','-',0,'-',0,'Form 3','-','-','-','-','3N','-') , (1342,'LUCY NJERI','-','-','-','-','-','-','-',0,'-',0,'Form 3','-','-','-','-','3S','-') , (1343,'JOEL NDUNGU','-','-','-','-','-','-','-',0,'-',0,'Form 3','-','-','-','-','3N','-') , (1344,'ANNE WANJIRU','-','-','-','-','-','-','-',0,'-',0,'Form 3','-','-','-','-','3N','-') , (1345,'TERESIA WANGARI','-','-','-','-','-','-','-',0,'-',0,'Form 3','-','-','-','-','3S','-') , (1346,'CICILIA WAITHERA','-','-','-','-','-','-','-',0,'-',0,'Form 3','-','-','-','-','3S','-') , (1347,'JOSEPHINE WANGUI','-','-','-','-','-','-','-',0,'-',0,'Form 3','-','-','-','-','3N','-') , (1348,'JOHN NGARUIYA','-','-','-','-','-','-','-',0,'-',0,'Form 3','-','-','-','-','3N','-') , (1349,'MIRRIAM NJAMBI','-','-','-','-','-','-','-',0,'-',0,'Form 3','-','-','-','-','3S','-') , (1350,'PETER CHEGE','-','-','-','-','-','-','-',0,'-',0,'Form 3','-','-','-','-','3S','-') , (1351,'IRENE MUTHONI','-','-','-','-','-','-','-',0,'-',0,'Form 3','-','-','-','-','3N','-') , (1352,'RUTH WANJIRU GITHINJI','-','-','-','-','-','-','-',0,'-',0,'Form 3','-','-','-','-','3N','-') , (1353,'WILLIAM THUITA','-','-','-','-','-','-','-',0,'-',0,'Form 3','-','-','-','-','3S','-') , (1354,'MORISON MWAURA','-','-','-','-','-','-','-',0,'-',0,'Form 3','-','-','-','-','3S','-') , (1355,'GRACE WANGARI','-','-','-','-','-','-','-',0,'-',0,'Form 3','-','-','-','-','3S','-') , (1356,'KENNEDY MUTURI','-','-','-','-','-','-','-',0,'-',0,'Form 3','-','-','-','-','3S','-') , (1357,'JOYCE WANJIRU','-','-','-','-','-','-','-',0,'-',0,'Form 3','-','-','-','-','3N','-') , (1358,'GEORGE GIKANGA','-','-','-','-','-','-','-',0,'-',0,'Form 3','-','-','-','-','3S','-') , (1359,'MICHAEL MWAURA','-','-','-','-','-','-','-',0,'-',0,'Form 3','-','-','-','-','3N','-') , (1360,'ANTHONY MUTHEE','-','-','-','-','-','-','-',0,'-',0,'Form 3','-','-','-','-','3S','-') , (1361,'RICHARD KAMAU','-','-','-','-','-','-','-',0,'-',0,'Form 3','-','-','-','-','3S','-') , (1362,'BEATRICE WAMBUI','-','-','-','-','-','-','-',0,'-',0,'Form 3','-','-','-','-','3N','-') , (1363,'BRIAN MUNIU','-','-','-','-','-','-','-',0,'-',0,'Form 3','-','-','-','-','3N','-') , (1364,'MARFIN MUYA','-','-','-','-','-','-','-',0,'-',0,'Form 3','-','-','-','-','3S','-') , (1365,'PAUL KIBUTI','-','-','-','-','-','-','-',0,'-',0,'Form 3','-','-','-','-','3N','-') , (1366,'BRIAN KARANJA','-','-','-','-','-','-','-',0,'-',0,'Form 3','-','-','-','-','3N','-') , (1367,'MONICAH NDUTA','-','-','-','-','-','-','-',0,'-',0,'Form 3','-','-','-','-','3N','-') , (1368,'SERAH WANJA','-','-','-','-','-','-','-',0,'-',0,'Form 3','-','-','-','-','3N','-') , (1369,'HANNAH NYAMBURA','-','-','-','-','-','-','-',0,'-',0,'Form 3','-','-','-','-','3S','-') , (1370,'SIMON NDIRANGU','-','-','-','-','-','-','-',0,'-',0,'Form 3','-','-','-','-','3N','-') , (1371,'ANN NJERI','-','-','-','-','-','-','-',0,'-',0,'Form 3','-','-','-','-','3N','-') , (1372,'WINROSE NJOKI','-','-','-','-','-','-','-',0,'-',0,'Form 3','-','-','-','-','3N','-') , (1373,'JOHN MACHARIA','-','-','-','-','-','-','-',0,'-',0,'Form 3','-','-','-','-','3N','-') , (1374,'GEORGE KAMAU','-','-','-','-','-','-','-',0,'-',0,'Form 3','-','-','-','-','3N','-') , (1375,'JAMES MWANGI','-','-','-','-','-','-','-',0,'-',0,'Form 3','-','-','-','-','3S','-') , (1376,'JAMES NGANGA','-','-','-','-','-','-','-',0,'-',0,'Form 3','-','-','-','-','3S','-') , (1377,'JOHN MACHARIA','-','-','-','-','-','-','-',0,'-',0,'Form 3','-','-','-','-','3N','-') , (1378,'JAMES MACHARIA','-','-','-','-','-','-','-',0,'-',0,'Form 3','-','-','-','-','3S','-') , (1379,'PETER MBUGUA','-','-','-','-','-','-','-',0,'-',0,'Form 3','-','-','-','-','3S','-') , (1380,'JANE WANJIRU','-','-','-','-','-','-','-',0,'-',0,'Form 3','-','-','-','-','3S','-') , (1381,'REGINA WANJIKU','-','-','-','-','-','-','-',0,'-',0,'Form 3','-','-','-','-','3N','-') , (1382,'JOHN NJENGA','-','-','-','-','-','-','-',0,'-',0,'Form 3','-','-','-','-','3S','-') , (1383,'PETER KIHORO','-','-','-','-','-','-','-',0,'-',0,'Form 3','-','-','-','-','3N','-') , (1384,'GEORGE MAGOTHE','-','-','-','-','-','-','-',0,'-',0,'Form 3','-','-','-','-','3N','-') , (1386,'HANNAH WAIRIMU','-','-','-','-','-','-','-',0,'-',0,'Form 3','-','-','-','-','3S','-') , (1387,'ANN WANJIRU','-','-','-','-','-','-','-',0,'-',0,'Form 3','-','-','-','-','3N','-') , (1388,'MERCY NJERI','-','-','-','-','-','-','-',0,'-',0,'Form 3','-','-','-','-','3N','-') , (1389,'IAN NJUGUNA','-','-','-','-','-','-','-',0,'-',0,'Form 3','-','-','-','-','3S','-') , (1390,'DENNIS NGANGA KIMANI','-','-','-','-','-','-','-',0,'-',0,'Form 3','-','-','-','-','3S','-') , (1392,'JULIET WANJIKU MBURU','-','-','-','-','-','-','-',0,'-',0,'Form 3','-','-','-','-','3S','-') , (1395,'LUCY NJERI MWAURA','-','-','-','-','-','-','-',0,'-',0,'Form 2','-','-','-','-','2N','-') , (1396,'JOHN KAHUHA','-','-','-','-','-','-','-',0,'-',0,'Form 2','-','-','-','-','2N','-') , (1397,'JOSEPH NGANGA MUROKI','-','-','-','-','-','-','-',0,'-',0,'Form 2','-','-','-','-','2N','-') , (1398,'DAMARIS WAIRIMU','-','-','-','-','-','-','-',0,'-',0,'Form 2','-','-','-','-','2N','-') , (1399,'VERONICAH WANGARI .W.','-','-','-','-','-','-','-',0,'-',0,'Form 2','-','-','-','-','2N','-') , (1400,'JACINTA WANGUI MWANGI','-','-','-','-','-','-','-',0,'-',0,'Form 2','-','-','-','-','2N','-') , (1401,'VIRGINIA WANJIRU','-','-','-','-','-','-','-',0,'-',0,'Form 2','-','-','-','-','2N','-') , (1402,'GEORGE KIHARA','-','-','-','-','-','-','-',0,'-',0,'Form 2','-','-','-','-','2N','-') , (1403,'DUNCAN MBATHA HIUHU','-','-','-','-','-','-','-',0,'-',0,'Form 2','-','-','-','-','2N','-') , (1404,'ANN NJERI NGANGA','-','-','-','-','-','-','-',0,'-',0,'Form 3','-','-','-','-','3N','-') , (1405,'RICHARD KINUTHIA','-','-','-','-','-','-','-',0,'-',0,'Form 2','-','-','-','-','2N','-') , (1406,'NANCY WACEKE','-','-','-','-','-','-','-',0,'-',0,'Form 2','-','-','-','-','2N','-') , (1407,'BONIFACE NDIBA NYUMU','-','-','-','-','-','-','-',0,'-',0,'Form 2','-','-','-','-','2N','-') , (1408,'RUTH WANJIKU MUCHAI','-','-','-','-','-','-','-',0,'-',0,'Form 2','-','-','-','-','2N','-') , (1409,'MARY WANJA WARUGA','-','-','-','-','-','-','-',0,'-',0,'Form 2','-','-','-','-','2N','-') , (1410,'WILLIAM MAINA','-','-','-','-','-','-','-',0,'-',0,'Form 3','-','-','-','-','3N','-') , (1411,'DANIEL MUREITHI NDICHU','-','-','-','-','-','-','-',0,'-',0,'Form 2','-','-','-','-','2N','-') , (1412,'ESTHER WANINI NGANGA','-','-','-','-','-','-','-',0,'-',0,'Form 2','-','-','-','-','2N','-') , (1413,'JANE DORCAS WANGUI','-','-','-','-','-','-','-',0,'-',0,'Form 2','-','-','-','-','2N','-') , (1414,'PERIS GATHONI NJIHIA','-','-','-','-','-','-','-',0,'-',0,'Form 2','-','-','-','-','2N','-') , (1415,'MARY JIKASA MWAJUMA','-','-','-','-','-','-','-',0,'-',0,'Form 2','-','-','-','-','2N','-') , (1416,'HANNAH NYAMBURA MUTHIGA','-','-','-','-','-','-','-',0,'-',0,'Form 2','-','-','-','-','2N','-') , (1417,'BONIFACE NDIBA KIRURI','-','-','-','-','-','-','-',0,'-',0,'Form 2','-','-','-','-','2N','-') , (1418,'MARY MWERU KARIUKI','-','-','-','-','-','-','-',0,'-',0,'Form 2','-','-','-','-','2N','-') , (1419,'MARY WAMBUI K.','-','-','-','-','-','-','-',0,'-',0,'Form 2','-','-','-','-','2N','-') , (1420,'EDWIN GITHINJI GITHIRI','-','-','-','-','-','-','-',0,'-',0,'Form 2','-','-','-','-','2N','-') , (1421,'MARY WAMBUI','-','-','-','-','-','-','-',0,'-',0,'Form 4','-','-','-','-','4S','-') , (1423,'ANN WANGUI MAINA','-','-','-','-','-','-','-',0,'-',0,'Form 2','-','-','-','-','2N','-') , (1424,'DENNIS GITHINJI W','-','-','-','-','-','-','-',0,'-',0,'Form 2','-','-','-','-','2N','-') , (1425,'MICHAEL NJENGA MUCHAI','-','-','-','-','-','-','-',0,'-',0,'Form 2','-','-','-','-','2N','-') , (1426,'LEONARD WAKANYA  MUCHAI','-','-','-','-','-','-','-',0,'-',0,'Form 2','-','-','-','-','2N','-') , (1427,'RUTH NYAMBURA','-','-','-','-','-','-','-',0,'-',0,'Form 2','-','-','-','-','2N','-') , (1428,'MICHAEL NJENGA GITHIRI','-','-','-','-','-','-','-',0,'-',0,'Form 2','-','-','-','-','2N','-') , (1429,'EDWARD KAMAU','-','-','-','-','-','-','-',0,'-',0,'Form 2','-','-','-','-','2N','-') , (1430,'JOHN NGARUIYA','-','-','-','-','-','-','-',0,'-',0,'Form 2','-','-','-','-','2N','-') , (1431,'WILLIAM MBUGUA  K','-','-','-','-','-','-','-',0,'-',0,'Form 2','-','-','-','-','2N','-') , (1432,'MARY WAMBUI','-','-','-','-','-','-','-',0,'-',0,'Form 2','-','-','-','-','2N','-') , (1434,'TIMOTHY THIONGO','-','-','-','-','-','-','-',0,'-',0,'Form 2','-','-','-','-','2N','-') , (1435,'JOYCE WANJIRU','-','-','-','-','-','-','-',0,'-',0,'Form 2','-','-','-','-','2N','-') , (1436,'REGINA WANJIRU','-','-','-','-','-','-','-',0,'-',0,'Form 2','-','-','-','-','2N','-') , (1437,'ISAAC NJOROGE','-','-','-','-','-','-','-',0,'-',0,'Form 2','-','-','-','-','2N','-') , (1438,'PETER KARIUKI WATHONI','-','-','-','-','-','-','-',0,'-',0,'Form 2','-','-','-','-','2N','-') , (1439,'JOHN MURIU MWANGI','-','-','-','-','-','-','-',0,'-',0,'Form 2','-','-','-','-','2N','-') , (1440,'GRACE NGENDO NGANGA','-','-','-','-','-','-','-',0,'-',0,'Form 2','-','-','-','-','2N','-') , (1441,'MARY WAITHERERO KAMAU','-','-','-','-','-','-','-',0,'-',0,'Form 4','-','-','-','-','4S','-') , (1442,'DAVID NDUATI MUBAIYA','-','-','-','-','-','-','-',0,'-',0,'Form 2','-','-','-','-','2N','-') , (1443,'DAVID KAMAU KAMATU','-','-','-','-','-','-','-',0,'-',0,'Form 2','-','-','-','-','2N','-') , (1444,'HANNAH WAMBUI KARANJA','-','-','-','-','-','-','-',0,'-',0,'Form 4','-','-','-','-','4S','-') , (1445,'PETER WAWERU NGENDO','-','-','-','-','-','-','-',0,'-',0,'Form 2','-','-','-','-','2N','-') , (1446,'LUCY WANGARI WAITHIRA','-','-','-','-','-','-','-',0,'-',0,'Form 4','-','-','-','-','4S','-') , (1447,'JOSEPH THUO','-','-','-','-','-','-','-',0,'-',0,'Form 2','-','-','-','-','2N','-') , (1448,'SOPHIA WANJIRU MAINA','-','-','-','-','-','-','-',0,'-',0,'Form 2','-','-','-','-','2N','-') , (1449,'KAMANDE JOHN MWANGI','-','-','-','-','-','-','-',0,'-',0,'Form 2','-','-','-','-','2N','-') , (1450,'SAMUEL NGIGE','-','-','-','-','-','-','-',0,'-',0,'Form 3','-','-','-','-','3N','-') , (1451,'BRIAN NZELU JANET','-','-','-','-','-','-','-',0,'-',0,'Form 2','-','-','-','-','2N','-') , (1452,'JOHN NJUGUNA MURIITHI','-','-','-','-','-','-','-',0,'-',0,'Form 3','-','-','-','-','3S','-') , (1453,'PHARES KARURU MURAGURI','-','-','-','-','-','-','-',0,'-',0,'Form 2','-','-','-','-','2N','-') , (1454,'HARRIS KAMITI GATHOGA','-','-','-','-','-','-','-',0,'-',0,'Form 3','-','-','-','-','3S','-') , (1455,'KEVIN KIHARA','-','-','-','-','-','-','-',0,'-',0,'Form 4','-','-','-','-','4S','-') , (1456,'BRIAN','NJOROGE','GITHINJI','Male','-','-','CHRISTIAN','-',0,'-',0,'Form 1','-','DAY','-','-','1N','-') , (1457,'FLORENCE WAMBUI','-','-','-','-','-','-','-',0,'-',0,'Form 3','-','-','-','-','3S','-') , (1458,'VIRGINIA NJOKI','-','-','-','-','-','-','-',0,'-',0,'Form 3','-','-','-','-','3S','-') , (1459,'VIRGINIA GAKENIA MUTHONI','-','-','-','-','-','-','-',0,'-',0,'Form 1','-','-','-','-','1N','-') , (1460,'TERESIA WATIRI BORO','-','-','-','-','-','-','-',0,'-',0,'Form 2','-','-','-','-','2N','-') , (1461,'GABRIEL NGARUIYA','-','-','-','-','-','-','-',0,'-',0,'Form 1','-','-','-','-','1N','-') , (1462,'JULIUS KINYUA','-','-','-','-','-','-','-',0,'-',0,'Form 1','-','-','-','-','1N','-') , (1463,'STEPHEN MBUGUA MWAURA','-','-','-','-','-','-','-',0,'-',0,'Form 1','-','-','-','-','1N','-') , (1464,'TERESIA NJERI NGANGA','-','-','-','-','-','-','-',0,'-',0,'Form 1','-','-','-','-','1N','-') , (1465,'FRANCIS NDIRANGU KIARIE','-','-','-','-','-','-','-',0,'-',0,'Form 4','-','-','-','-','4N','-') , (1466,'JOSEPH GATUMBA NDUNGU','-','-','-','-','-','-','-',0,'-',0,'Form 1','-','-','-','-','1N','-') , (1467,'GEORGE KIHARA WAIGANJO','-','-','-','-','-','-','-',0,'-',0,'Form 1','-','-','-','-','1N','-') , (1468,'JOHN MUCHAI KARIUKI','-','-','-','-','-','-','-',0,'-',0,'Form 1','-','-','-','-','1N','-') , (1469,'PAULINE WAIRIMU','-','-','-','-','-','-','-',0,'-',0,'Form 1','-','-','-','-','1N','-') , (1470,'GEOFFREY GATHU','-','-','-','-','-','-','-',0,'-',0,'Form 1','-','-','-','-','1N','-') , (1471,'JANE WANGARI MACHARIA','-','-','-','-','-','-','-',0,'-',0,'Form 1','-','-','-','-','1N','-') , (1472,'JANE WAMBUI WANGUI','-','-','-','-','-','-','-',0,'-',0,'Form 1','-','-','-','-','1N','-') , (1473,'SHARON KARIMI','-','-','-','-','-','-','-',0,'-',0,'Form 1','-','-','-','-','1N','-') , (1474,'DANIEL KARIUKI','-','-','-','-','-','-','-',0,'-',0,'Form 1','-','-','-','-','1N','-') , (1475,'JOSEPH MUTHAMA NGUKU','-','-','-','-','-','-','-',0,'-',0,'Form 1','-','-','-','-','1N','-') , (1476,'JANE GATHONI','-','-','-','-','-','-','-',0,'-',0,'Form 1','-','-','-','-','1N','-') , (1477,'JAMES THUO MUNORU','-','-','-','-','-','-','-',0,'-',0,'Form 1','-','-','-','-','1N','-') , (1478,'KELVIN KIRURI NDUNGU','-','-','-','-','-','-','-',0,'-',0,'Form 1','-','-','-','-','1N','-') , (1479,'ELIZABETH MUTHONI GITHIRI','-','-','-','-','-','-','-',0,'-',0,'Form 1','-','-','-','-','1N','-') , (1480,'VERONICAH NJOKI','-','-','-','-','-','-','-',0,'-',0,'Form 1','-','-','-','-','1N','-') , (1481,'LILIAN WANJIKU NYAMBURA','-','-','-','-','-','-','-',0,'-',0,'Form 1','-','-','-','-','1N','-') , (1482,'MARYANN WAIRIMU','-','-','-','-','-','-','-',0,'-',0,'Form 1','-','-','-','-','1N','-') , (1483,'MARY NJERI NJUGUNA','-','-','-','-','-','-','-',0,'-',0,'Form 2','-','-','-','-','2N','-') , (1484,'SIMON KINUTHIA','-','-','-','-','-','-','-',0,'-',0,'Form 3','-','-','-','-','3N','-') , (1485,'RAPHAEL NYUMU MUKURA','-','-','-','-','-','-','-',0,'-',0,'Form 1','-','-','-','-','1N','-') , (1486,'MARY WAIRIMU','-','-','-','-','-','-','-',0,'-',0,'Form 1','-','-','-','-','1N','-') , (1487,'FRIDAH NYAMWATHI','-','-','-','-','-','-','-',0,'-',0,'Form 1','-','-','-','-','1N','-') , (1488,'ROSEMARY WAITHIRA MAIYATU','-','-','-','-','-','-','-',0,'-',0,'Form 1','-','-','-','-','1N','-') , (1489,'ESTHER WARUGURU','-','-','-','-','-','-','-',0,'-',0,'Form 1','-','-','-','-','1N','-') , (1490,'FAITH WANJIRU','-','-','-','-','-','-','-',0,'-',0,'Form 1','-','-','-','-','1N','-') , (1491,'STEPHEN WAIHARO KARUGA','-','-','-','-','-','-','-',0,'-',0,'Form 1','-','-','-','-','1N','-') , (1492,'JACINTA NJERI MWANGI','-','-','-','-','-','-','-',0,'-',0,'Form 1','-','-','-','-','1N','-') , (1493,'PHYLLIS MUKAMI','-','-','-','-','-','-','-',0,'-',0,'Form 4','-','-','-','-','4N','-') , (1494,'PURITY WANJIKU','-','-','-','-','-','-','-',0,'-',0,'Form 1','-','-','-','-','1N','-') , (1495,'JOHN MWANGI MWAURA','-','-','-','-','-','-','-',0,'-',0,'Form 4','-','-','-','-','4S','-') , (1496,'GEORGE KINUTHIA MWANGI','-','-','-','-','-','-','-',0,'-',0,'Form 2','-','-','-','-','2N','-') , (1497,'TIMOTHY CHUCHU MUTHONI','-','-','-','-','-','-','-',0,'-',0,'Form 1','-','-','-','-','1N','-') , (1498,'MARY NJERI MWANGI','-','-','-','-','-','-','-',0,'-',0,'Form 1','-','-','-','-','1N','-') , (1499,'CAROLINE WAMBUI','-','-','-','-','-','-','-',0,'-',0,'Form 2','-','-','-','-','2N','-') , (1500,'PRISCA Z WANJIRU MURIITHI','-','-','-','-','-','-','-',0,'-',0,'Form 1','-','-','-','-','1N','-') , (1501,'JOHN MUHU MUKORA','-','-','-','-','-','-','-',0,'-',0,'Form 1','-','-','-','-','1N','-') , (1502,'SERAH MUMBI','-','-','-','-','-','-','-',0,'-',0,'Form 1','-','-','-','-','1N','-') , (1503,'JACKLINE WANJIRU','-','-','-','-','-','-','-',0,'-',0,'Form 1','-','-','-','-','1N','-') , (1504,'LUCY WAMBUI','-','-','-','-','-','-','-',0,'-',0,'Form 1','-','-','-','-','1N','-') , (1505,'JANE MUKAMI KARIUKI','-','-','-','-','-','-','-',0,'-',0,'Form 1','-','-','-','-','1N','-') , (1506,'STEPHEN KAMAU HIUHU','-','-','-','-','-','-','-',0,'-',0,'Form 1','-','-','-','-','1N','-') , (1507,'SARAH WAMAITHA','-','-','-','-','-','-','-',0,'-',0,'Form 1','-','-','-','-','1N','-') , (1508,'STANLEY KIRUKU MUNENE','-','-','-','-','-','-','-',0,'-',0,'Form 1','-','-','-','-','1N','-') , (1509,'HELLEN NJOKI G','-','-','-','-','-','-','-',0,'-',0,'Form 1','-','-','-','-','1N','-') , (1510,'STEPHEN MURIMI M','-','-','-','-','-','-','-',0,'-',0,'Form 1','-','-','-','-','1N','-') , (1511,'HANNAH NJAMBI','-','-','-','-','-','-','-',0,'-',0,'Form 1','-','-','-','-','1N','-') , (1512,'FAITH WAMBUI N','-','-','-','-','-','-','-',0,'-',0,'Form 1','-','-','-','-','1N','-') , (1513,'MOSES MAINA MWAE','-','-','-','-','-','-','-',0,'-',0,'Form 1','-','-','-','-','1N','-') , (1514,'JOSEPH NDICHU KAMIRU','-','-','-','-','-','-','-',0,'-',0,'Form 3','-','-','-','-','3N','-') , (1515,'NICHOLUS MUTWIRI GACHERI','-','-','-','-','-','-','-',0,'-',0,'Form 2','-','-','-','-','2N','-') , (1516,'JOHN MUNENE','-','-','-','-','-','-','-',0,'-',0,'Form 1','-','-','-','-','1N','-') , (1517,'SAMUEL NDIBA MBUGUA','-','-','-','-','-','-','-',0,'-',0,'Form 4','-','-','-','-','4S','-') , (1518,'NELSON KIMANI NJOROGE','-','-','-','-','-','-','-',0,'-',0,'Form 3','-','-','-','-','3S','-') , (1519,'MARTHA NJAMBI KIBUNJA','-','-','-','-','-','-','-',0,'-',0,'Form 2','-','-','-','-','2N','-') , (1520,'JOSEPH KARARI WAHINYA','-','-','-','-','-','-','-',0,'-',0,'Form 1','-','-','-','-','1N','-') , (1521,'SARAFINA WANJIKU WAMBUI','-','-','-','-','-','-','-',0,'-',0,'Form 1','-','-','-','-','1N','-') , (1522,'DANIEL NJUGUNA GICHIRI','-','-','-','-','-','-','-',0,'-',0,'Form 1','-','-','-','-','1N','-') , (1523,'JOHN MUNYAKA NJERI','-','-','-','-','-','-','-',0,'-',0,'Form 1','-','-','-','-','1N','-') , (1524,'TIMOTHY WAWERU MAINA','-','-','-','-','-','-','-',0,'-',0,'Form 2','-','-','-','-','2N','-') , (1525,'VIRGINIA WAMBUI KIMANI','-','-','-','-','-','-','-',0,'-',0,'Form 1','-','-','-','-','1N','-') , (1526,'ELIZABETH NYAMBURA','-','-','-','-','-','-','-',0,'-',0,'Form 2','-','-','-','-','2N','-') , (1527,'JOHN GITHUA KURIA','-','-','-','-','-','-','-',0,'-',0,'Form 1','-','-','-','-','1N','-') , (1528,'DORCUS WANJIRU WANGUI','-','-','-','-','-','-','-',0,'-',0,'Form 1','-','-','-','-','1N','-') , (1529,'AUTHER KARANJA MUNENE','-','-','-','-','-','-','-',0,'-',0,'Form 3','-','-','-','-','3S','-') , (1530,'DOMINIC NKOORO','-','-','-','-','-','-','-',0,'-',0,'Form 3','-','-','-','-','3S','-') , (1531,'JANE MUTHONI WAMBUI','-','-','-','-','-','-','-',0,'-',0,'Form 2','-','-','-','-','2N','-') , (1532,'SAMUEL NJOROGE NGENDO','-','-','-','-','-','-','-',0,'-',0,'Form 2','-','-','-','-','2N','-') , (1533,'MAUREEN NJERI KIHARA','-','-','-','-','-','-','-',0,'-',0,'Form 3','-','-','-','-','3S','-') , (1534,'JAMES NGENE MAINA','-','-','-','-','-','-','-',0,'-',0,'Form 2','-','-','-','-','2N','-') ;

/*
Table struture for subjects
*/

drop table if exists `subjects`;
CREATE TABLE `subjects` (
  `subject` varchar(100) NOT NULL default '',
  PRIMARY KEY  (`subject`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*
Table data for gathanji.subjects
*/

INSERT INTO `subjects` VALUES ('COMPUTER-STUDIES') , ('ENGLISH-') , ('KISWAHILI') ;

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
  `name` varchar(100) NOT NULL default '',
  `deduction_amount` decimal(18,2) default '0.00',
  `percent` decimal(18,2) default '0.00',
  PRIMARY KEY  (`name`)
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
Table struture for tbl_hr_payslips
*/

drop table if exists `tbl_hr_payslips`;
CREATE TABLE `tbl_hr_payslips` (
  `staff_ref` varchar(100) NOT NULL default '',
  `basic` decimal(18,2) default '0.00',
  `nhif` decimal(18,2) default '0.00',
  `nssf` decimal(18,2) default '0.00',
  `paye` decimal(18,2) default '0.00',
  `netpay` decimal(18,2) default '0.00',
  `date_ref` varchar(100) NOT NULL default '',
  `month_ref` varchar(100) NOT NULL default '',
  `payrollref` varchar(100) NOT NULL default '',
  PRIMARY KEY  (`staff_ref`,`month_ref`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*
Table data for gathanji.tbl_hr_payslips
*/

INSERT INTO `tbl_hr_payslips` VALUES ('25211427','20000.00','0.00','0.00','175.80','19824.20','2016-06-06','June 2016','20160606233759') , ('8619060','20000.00','0.00','0.00','175.80','19824.20','2016-06-02','June 2016','20160606233622') ;

/*
Table struture for tbl_hr_payslips_all
*/

drop table if exists `tbl_hr_payslips_all`;
CREATE TABLE `tbl_hr_payslips_all` (
  `staff_ref` varchar(100) NOT NULL default '',
  `allowance_name` varchar(100) NOT NULL default '',
  `allowance` decimal(18,2) default '0.00',
  `month_ref` varchar(100) NOT NULL default '',
  `payrollref` varchar(100) NOT NULL default '',
  PRIMARY KEY  (`staff_ref`,`allowance_name`,`month_ref`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*
Table struture for tbl_hr_payslips_ded
*/

drop table if exists `tbl_hr_payslips_ded`;
CREATE TABLE `tbl_hr_payslips_ded` (
  `staff_ref` varchar(100) NOT NULL default '',
  `deduction_name` varchar(100) NOT NULL default '',
  `deduction` decimal(18,2) default '0.00',
  `month_ref` varchar(100) NOT NULL default '',
  `payrollref` varchar(100) NOT NULL default '',
  PRIMARY KEY  (`staff_ref`,`deduction_name`,`month_ref`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*
Table struture for tbl_hr_reliefs
*/

drop table if exists `tbl_hr_reliefs`;
CREATE TABLE `tbl_hr_reliefs` (
  `name` varchar(100) NOT NULL default '',
  `amount` decimal(18,2) default '0.00',
  `percent` decimal(18,2) default '0.00',
  PRIMARY KEY  (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*
Table struture for tbl_hrallowances
*/

drop table if exists `tbl_hrallowances`;
CREATE TABLE `tbl_hrallowances` (
  `name` varchar(100) NOT NULL default '',
  `rate` decimal(18,2) default '0.00',
  PRIMARY KEY  (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*
Table struture for tbl_hrdeductions
*/

drop table if exists `tbl_hrdeductions`;
CREATE TABLE `tbl_hrdeductions` (
  `name` varchar(100) NOT NULL default '',
  `rate` decimal(18,2) default '0.00',
  PRIMARY KEY  (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*
Table struture for tbl_invoices
*/

drop table if exists `tbl_invoices`;
CREATE TABLE `tbl_invoices` (
  `invoice_no` varchar(100) NOT NULL default '1',
  `payee_ref` varchar(255) NOT NULL default '',
  `amount_due` decimal(18,2) NOT NULL default '0.00',
  `acc_payable` varchar(100) NOT NULL default '',
  `i_status` int(1) NOT NULL default '0' COMMENT '0=unpaid, 1=paid',
  PRIMARY KEY  (`invoice_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*
Table struture for tbl_terms
*/

drop table if exists `tbl_terms`;
CREATE TABLE `tbl_terms` (
  `term` int(1) NOT NULL,
  `year` int(4) NOT NULL,
  `begins` varchar(100) NOT NULL default '',
  `ends` varchar(100) NOT NULL default '',
  PRIMARY KEY  (`term`,`year`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*
Table data for gathanji.tbl_terms
*/

INSERT INTO `tbl_terms` VALUES (1,2017,'2017-01-05','') , (1,2018,'2018-01-04','') , (3,2017,'2017-08-30','') ;

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
Table data for gathanji.tbl_themes
*/

INSERT INTO `tbl_themes` VALUES ('Blue',0,'style_blue','styleblue') , ('Green',1,'style_green','stylegreen') , ('Maroon',0,'style_maroon','stylemaroon') , ('Red',0,'style_red','stylered') ;

/*
Table struture for tblaudittrail
*/

drop table if exists `tblaudittrail`;
CREATE TABLE `tblaudittrail` (
  `id` int(11) NOT NULL auto_increment,
  `auditDate` datetime NOT NULL,
  `activity` varchar(200) NOT NULL default '',
  `uname` varchar(30) NOT NULL default '',
  `ipaddress` varchar(16) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=158 DEFAULT CHARSET=latin1;

/*
Table data for gathanji.tblaudittrail
*/

INSERT INTO `tblaudittrail` VALUES (1,'2018-05-30 10:48:05','Un-Successful Login','admin','192.168.0.3') , (2,'2018-05-30 10:51:12','Successful Login','admin','192.168.0.3') , (3,'2018-05-30 10:51:13','View Administrator*s Dashboard','admin','192.168.0.3') , (4,'2018-05-30 10:55:27','View Administrator*s Dashboard','admin','192.168.0.3') , (5,'2018-05-30 10:55:29','Viewed student list','admin','192.168.0.3') , (6,'2018-05-30 10:55:29','Viewed student list','admin','192.168.0.3') , (7,'2018-05-30 11:08:44','Successful Login','admin','127.0.0.1') , (8,'2018-05-30 11:08:45','View Administrator*s Dashboard','admin','127.0.0.1') , (9,'2018-05-30 11:08:48','Viewed student list','admin','127.0.0.1') , (10,'2018-05-30 11:08:48','Viewed student list','admin','127.0.0.1') , (11,'2018-05-30 11:08:51','Viewed student list','admin','127.0.0.1') , (12,'2018-05-30 11:08:51','Viewed student list','admin','127.0.0.1') , (13,'2018-05-30 11:37:03','Successful Login','admin','127.0.0.1') , (14,'2018-05-30 11:37:04','View Administrator*s Dashboard','admin','127.0.0.1') , (15,'2018-05-30 11:37:27','Successful Login','admin','192.168.0.100') , (16,'2018-05-30 11:37:27','View Administrator*s Dashboard','admin','192.168.0.100') , (17,'2018-05-30 11:37:34','Viewed student list','admin','127.0.0.1') , (18,'2018-05-30 11:37:34','Viewed student list','admin','127.0.0.1') , (19,'2018-05-30 11:38:38','View HR Dashboard','admin','192.168.0.100') , (20,'2018-05-30 11:38:49','View Administrator*s Dashboard','admin','192.168.0.100') , (21,'2018-05-30 11:38:53','Viewed student list','admin','192.168.0.100') , (22,'2018-05-30 11:38:54','Viewed student list','admin','192.168.0.100') , (23,'2018-05-30 11:39:06','View Administrator*s Dashboard','admin','192.168.0.100') , (24,'2018-05-30 11:40:26','View Administrator*s Dashboard','admin','127.0.0.1') , (25,'2018-05-30 11:40:28','Viewed student list','admin','127.0.0.1') , (26,'2018-05-30 11:40:29','Viewed student list','admin','127.0.0.1') , (27,'2018-05-30 11:45:43','Un-Successful Login','admin','192.168.0.100') , (28,'2018-05-30 11:45:58','Successful Login','admin','192.168.0.100') , (29,'2018-05-30 11:45:58','View Administrator*s Dashboard','admin','192.168.0.100') , (30,'2018-05-30 12:07:15','View Administrator*s Dashboard','admin','127.0.0.1') , (31,'2018-05-30 12:07:16','Viewed student list','admin','127.0.0.1') , (32,'2018-05-30 12:07:17','Viewed student list','admin','127.0.0.1') , (33,'2018-05-30 12:07:24','Viewed Class list','admin','127.0.0.1') , (34,'2018-05-30 12:07:29','View HR Dashboard','admin','127.0.0.1') , (35,'2018-05-30 12:07:33','View Administrator*s Dashboard','admin','127.0.0.1') , (36,'2018-05-30 12:07:35','View School Setting Page','admin','127.0.0.1') , (37,'2018-05-30 12:07:37','Viewed Settings streams page','admin','127.0.0.1') , (38,'2018-05-30 12:07:53','Viewed Settings streams page','admin','127.0.0.1') , (39,'2018-05-30 12:08:56','Viewed Settings streams page','admin','127.0.0.1') , (40,'2018-05-30 12:08:58','Viewed Settings streams page','admin','127.0.0.1') , (41,'2018-05-30 12:09:13','Viewed Settings streams page','admin','127.0.0.1') , (42,'2018-05-30 12:09:15','Viewed Settings streams page','admin','127.0.0.1') , (43,'2018-05-30 12:09:29','Deleted Stream Form 1','admin','127.0.0.1') , (44,'2018-05-30 12:09:35','Viewed Settings streams page','admin','127.0.0.1') , (45,'2018-05-30 12:09:37','Viewed Settings streams page','admin','127.0.0.1') , (46,'2018-05-30 12:09:45','Viewed Settings streams page','admin','127.0.0.1') , (47,'2018-05-30 12:09:47','Viewed Settings streams page','admin','127.0.0.1') , (48,'2018-05-30 12:09:56','Viewed Settings streams page','admin','127.0.0.1') , (49,'2018-05-30 12:09:57','Viewed Settings streams page','admin','127.0.0.1') , (50,'2018-05-30 12:10:08','Viewed Settings streams page','admin','127.0.0.1') , (51,'2018-05-30 12:10:10','Viewed Settings streams page','admin','127.0.0.1') , (52,'2018-05-30 12:10:19','Viewed Settings streams page','admin','127.0.0.1') , (53,'2018-05-30 12:10:21','Viewed Settings streams page','admin','127.0.0.1') , (54,'2018-05-30 12:10:29','Viewed Settings streams page','admin','127.0.0.1') , (55,'2018-05-30 12:10:31','Viewed Settings streams page','admin','127.0.0.1') , (56,'2018-05-30 12:10:38','Viewed Settings streams page','admin','127.0.0.1') , (57,'2018-05-30 12:10:40','Viewed Settings streams page','admin','127.0.0.1') , (58,'2018-05-30 12:10:46','View school enrollment page','admin','127.0.0.1') , (59,'2018-05-30 12:10:51','Backed up Database','admin','127.0.0.1') , (60,'2018-05-30 12:10:55','Viewed student list','admin','127.0.0.1') , (61,'2018-05-30 12:10:55','Viewed student list','admin','127.0.0.1') , (62,'2018-05-30 12:14:21','View Administrator*s Dashboard','admin','127.0.0.1') , (63,'2018-05-30 12:14:23','Viewed student list','admin','127.0.0.1') , (64,'2018-05-30 12:14:23','Viewed student list','admin','127.0.0.1') , (65,'2018-05-30 12:16:09','Successful Login','admin','192.168.0.100') , (66,'2018-05-30 12:16:09','View Administrator*s Dashboard','admin','192.168.0.100') , (67,'2018-05-30 12:16:15','Viewed student list','admin','192.168.0.100') , (68,'2018-05-30 12:16:15','Viewed student list','admin','192.168.0.100') , (69,'2018-05-30 12:16:19','View Administrator*s Dashboard','admin','192.168.0.100') , (70,'2018-05-30 12:16:46','View Finance Dashboard','admin','192.168.0.100') , (71,'2018-05-30 12:16:51','View HR Dashboard','admin','192.168.0.100') , (72,'2018-05-30 12:17:06','View Finance Dashboard','admin','192.168.0.100') , (73,'2018-05-30 12:17:11','View Administrator*s Dashboard','admin','192.168.0.100') , (74,'2018-05-30 12:17:16','Viewed student list','admin','192.168.0.100') , (75,'2018-05-30 12:17:16','Viewed student list','admin','192.168.0.100') , (76,'2018-05-30 12:17:20','View Administrator*s Dashboard','admin','192.168.0.100') , (77,'2018-05-30 12:17:25','Viewed student list','admin','192.168.0.100') , (78,'2018-05-30 12:17:26','Viewed student list','admin','192.168.0.100') , (79,'2018-05-30 12:17:29','View Administrator*s Dashboard','admin','192.168.0.100') , (80,'2018-05-30 12:17:52','View Administrator*s Dashboard','admin','127.0.0.1') , (81,'2018-05-30 12:17:54','Viewed student list','admin','127.0.0.1') , (82,'2018-05-30 12:17:54','Viewed student list','admin','127.0.0.1') , (83,'2018-05-30 12:18:40','Successful Login','admin','192.168.0.100') , (84,'2018-05-30 12:18:40','View Administrator*s Dashboard','admin','192.168.0.100') , (85,'2018-05-30 12:19:16','Viewed student list','admin','192.168.0.100') , (86,'2018-05-30 12:19:16','Viewed student list','admin','192.168.0.100') , (87,'2018-05-30 12:20:09','View Administrator*s Dashboard','admin','192.168.0.100') , (88,'2018-05-30 12:20:12','Viewed student list','admin','192.168.0.100') , (89,'2018-05-30 12:20:12','Viewed student list','admin','192.168.0.100') , (90,'2018-05-30 12:21:43','View Administrator*s Dashboard','admin','127.0.0.1') , (91,'2018-05-30 12:21:50','View Administrator*s Dashboard','admin','127.0.0.1') , (92,'2018-05-30 12:22:00','View Administrator*s Dashboard','admin','127.0.0.1') , (93,'2018-05-30 12:22:11','Viewed student list','admin','127.0.0.1') , (94,'2018-05-30 12:22:11','Viewed student list','admin','127.0.0.1') , (95,'2018-05-30 12:23:40','Edited 1456 Details','admin','127.0.0.1') , (96,'2018-05-30 12:23:42','Viewed student list','admin','127.0.0.1') , (97,'2018-05-30 12:24:18','View HR Dashboard','admin','127.0.0.1') , (98,'2018-05-30 12:26:36','Successful Logout','admin','192.168.0.100') , (99,'2018-05-30 12:27:09','Added new Staff 27380844','admin','127.0.0.1') , (100,'2018-05-30 12:27:30','Un-Successful Login','27380844','192.168.0.100') , (101,'2018-05-30 12:28:00','Un-Successful Login','27380844','192.168.0.100') , (102,'2018-05-30 12:28:32','View HR Dashboard','admin','127.0.0.1') , (103,'2018-05-30 12:28:43','Successful Login','27380844','192.168.0.100') , (104,'2018-05-30 12:28:43','View Secretary*s Dashboard','27380844','192.168.0.100') , (105,'2018-05-30 12:30:11','Viewed student list','admin','127.0.0.1') , (106,'2018-05-30 12:30:11','Viewed student list','admin','127.0.0.1') , (107,'2018-05-30 12:31:15','Edited 1188 Details','admin','127.0.0.1') , (108,'2018-05-30 12:31:21','View Secretary*s Dashboard','27380844','192.168.0.100') , (109,'2018-05-30 12:31:41','Viewed student list','admin','127.0.0.1') , (110,'2018-05-30 12:32:26','View Administrator*s Dashboard','admin','127.0.0.1') , (111,'2018-05-30 12:33:16','View HR Dashboard','admin','127.0.0.1') , (112,'2018-05-30 12:34:28','Viewed student list','admin','127.0.0.1') , (113,'2018-05-30 12:34:28','Viewed student list','admin','127.0.0.1') , (114,'2018-05-30 12:34:36','View HR Dashboard','admin','127.0.0.1') , (115,'2018-05-30 12:34:48','Viewed student list','admin','127.0.0.1') , (116,'2018-05-30 12:34:48','Viewed student list','admin','127.0.0.1') , (117,'2018-05-30 12:36:09','Viewed Settings streams page','admin','127.0.0.1') , (118,'2018-05-30 12:36:24','Viewed Settings streams page','admin','127.0.0.1') , (119,'2018-05-30 12:36:26','Viewed Settings streams page','admin','127.0.0.1') , (120,'2018-05-30 12:36:28','Viewed books inventory','admin','127.0.0.1') , (121,'2018-05-30 12:38:12','Added book: KISWAHILI FASAHA','admin','127.0.0.1') , (122,'2018-05-30 12:38:14','Viewed books inventory','admin','127.0.0.1') , (123,'2018-05-30 12:38:15','Viewed books inventory','admin','127.0.0.1') , (124,'2018-05-30 12:40:01','Viewed books inventory','admin','127.0.0.1') , (125,'2018-05-30 12:40:04','Viewed books inventory','admin','127.0.0.1') , (126,'2018-05-30 12:40:12','Viewed books inventory','admin','127.0.0.1') , (127,'2018-05-30 12:40:15','Viewed books inventory','admin','127.0.0.1') , (128,'2018-05-30 12:40:19','Deleted book s/n 2','admin','127.0.0.1') , (129,'2018-05-30 12:40:21','Viewed Settings streams page','admin','127.0.0.1') , (130,'2018-05-30 12:40:23','Viewed books inventory','admin','127.0.0.1') , (131,'2018-05-30 12:40:47','Added book: KISWAHILI FASAHA','admin','127.0.0.1') , (132,'2018-05-30 12:40:49','Viewed books inventory','admin','127.0.0.1') , (133,'2018-05-30 12:40:50','Viewed books inventory','admin','127.0.0.1') , (134,'2018-05-30 12:44:09','Viewed Issued books page','admin','127.0.0.1') , (135,'2018-05-30 12:44:16','Viewed Lost books list','admin','127.0.0.1') , (136,'2018-05-30 12:45:29','Viewed Message Settings page','27380844','192.168.0.100') , (137,'2018-05-30 12:45:42','Viewed Message Settings page','admin','127.0.0.1') , (138,'2018-05-30 12:45:51','Viewed Message Settings page','admin','127.0.0.1') , (139,'2018-05-30 12:45:52','Viewed Message Settings page','admin','127.0.0.1') , (140,'2018-05-30 12:46:00','Viewed Message Settings page','27380844','192.168.0.100') , (141,'2018-05-30 12:48:36','Viewed student list','admin','127.0.0.1') , (142,'2018-05-30 12:48:36','Viewed student list','admin','127.0.0.1') , (143,'2018-05-30 12:49:38','Viewed student list','admin','127.0.0.1') , (144,'2018-05-30 12:49:39','Viewed student list','admin','127.0.0.1') , (145,'2018-05-30 12:53:51','Successful Logout','27380844','192.168.0.100') , (146,'2018-05-30 12:59:31','Viewed student list','admin','127.0.0.1') , (147,'2018-05-30 12:59:31','Viewed student list','admin','127.0.0.1') , (148,'2018-05-30 13:05:07','Viewed student list','admin','127.0.0.1') , (149,'2018-05-30 13:05:07','Viewed student list','admin','127.0.0.1') , (150,'2018-05-30 13:08:10','View Administrator*s Dashboard','admin','127.0.0.1') , (151,'2018-05-30 13:08:16','View Administrator*s Dashboard','admin','127.0.0.1') , (152,'2018-05-30 13:08:22','View Administrator*s Dashboard','admin','127.0.0.1') , (153,'2018-05-30 13:11:21','View Administrator*s Dashboard','admin','127.0.0.1') , (154,'2018-05-30 13:11:26','View Administrator*s Dashboard','admin','127.0.0.1') , (155,'2018-05-30 13:11:30','View Administrator*s Dashboard','admin','127.0.0.1') , (156,'2018-05-30 13:11:34','View Administrator*s Dashboard','admin','127.0.0.1') , (157,'2018-05-30 13:15:22','View Administrator*s Dashboard','admin','127.0.0.1') ;

/*
Table struture for tbldispline
*/

drop table if exists `tbldispline`;
CREATE TABLE `tbldispline` (
  `id` int(11) NOT NULL auto_increment,
  `admno` varchar(100) NOT NULL default '',
  `comments` text NOT NULL,
  `comment_by` varchar(100) NOT NULL default '',
  `date_added` varchar(100) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*
Table struture for tbleperformancetrack
*/

drop table if exists `tbleperformancetrack`;
CREATE TABLE `tbleperformancetrack` (
  `admno` varchar(100) NOT NULL default '',
  `form` varchar(100) NOT NULL default '',
  `year` int(4) NOT NULL,
  `term` int(5) NOT NULL,
  `stream` varchar(100) NOT NULL default '',
  `s_status` int(1) NOT NULL default '0',
  PRIMARY KEY  (`admno`,`form`,`year`,`term`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*
Table struture for tbleperformancetrackmock
*/

drop table if exists `tbleperformancetrackmock`;
CREATE TABLE `tbleperformancetrackmock` (
  `admno` varchar(100) NOT NULL default '',
  `form` varchar(100) NOT NULL default '',
  `year` int(4) NOT NULL,
  `term` int(5) NOT NULL,
  `stream` varchar(100) NOT NULL default '',
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
Table data for gathanji.tblgrades
*/

INSERT INTO `tblgrades` VALUES ('ENGLISH','0.00','29.00','E','Work Harder',1,'1-2') , ('ENGLISH','30.00','34.00','D-','Work Harder',2,'1-2') , ('ENGLISH','35.00','39.00','D','Improve',3,'1-2') , ('ENGLISH','40.00','44.00','D+','Can do better',4,'1-2') , ('ENGLISH','45.00','49.00','C-','Fair',5,'1-2') , ('ENGLISH','50.00','54.00','C','Fair',6,'1-2') , ('ENGLISH','55.00','59.00','C+','Fair',7,'1-2') , ('ENGLISH','60.00','64.00','B-','Good',8,'1-2') , ('ENGLISH','65.00','69.00','B','Good',9,'1-2') , ('ENGLISH','70.00','74.00','B+','Good',10,'1-2') , ('ENGLISH','75.00','79.00','A-','Very Good',11,'1-2') , ('ENGLISH','80.00','100.00','A','Excellent',12,'1-2') , ('KISWAHILI','0.00','29.00','E','Sharti Usome',1,'1-2') , ('KISWAHILI','30.00','34.00','D-','Tia bidii',2,'1-2') , ('KISWAHILI','35.00','39.00','D','Tia bidii',3,'1-2') , ('KISWAHILI','40.00','44.00','D+','Tia bidii',4,'1-2') , ('KISWAHILI','45.00','49.00','C-','Jitahidi',5,'1-2') , ('KISWAHILI','50.00','54.00','C','Jitahidi',6,'1-2') , ('KISWAHILI','55.00','59.00','C+','Jaribio Zuri',7,'1-2') , ('KISWAHILI','60.00','64.00','B-','Jaribio Zuri',8,'1-2') , ('KISWAHILI','65.00','69.00','B','Njema',9,'1-2') , ('KISWAHILI','70.00','74.00','B+','Njema',10,'1-2') , ('KISWAHILI','75.00','79.00','A-','Hongera',11,'1-2') , ('KISWAHILI','80.00','100.00','A','Hongera',12,'1-2') , ('HISTORY','0.00','29.00','E','Work Harder',1,'1-2') , ('HISTORY','30.00','34.00','D-','Work Hard',2,'1-2') , ('HISTORY','35.00','39.00','D','Improve',3,'1-2') , ('HISTORY','40.00','44.00','D+','Can do better',4,'1-2') , ('HISTORY','45.00','49.00','C-','Fair',5,'1-2') , ('HISTORY','50.00','54.00','C','Fair',6,'1-2') , ('HISTORY','55.00','59.00','C+','Fair',7,'1-2') , ('HISTORY','60.00','64.00','B-','Good',8,'1-2') , ('HISTORY','65.00','69.00','B','Good',9,'1-2') , ('HISTORY','70.00','74.00','B+','Good',10,'1-2') , ('HISTORY','75.00','79.00','A-','Very Good',11,'1-2') , ('HISTORY','80.00','100.00','A','Excellent',12,'1-2') , ('HISTORY','40.00','44.00','D+','Can do better',4,'3-4') , ('HISTORY','35.00','39.00','D','Improve',3,'3-4') , ('HISTORY','30.00','34.00','D-','Work Hard',2,'3-4') , ('HISTORY','0.00','29.00','E','Work Harder',1,'3-4') , ('CRE','80.00','100.00','A','Excellent',12,'3-4') , ('CRE','74.00','79.00','A-','Very Good',11,'3-4') , ('CRE','70.00','74.00','B+','Good',10,'3-4') , ('CRE','65.00','69.00','B','Good',9,'3-4') , ('CRE','60.00','64.00','B-','Good',8,'3-4') , ('CRE','55.00','59.00','C+','Fair',7,'3-4') , ('CRE','50.00','54.00','C','Fair',6,'3-4') , ('CRE','35.00','39.00','D','Improve',3,'3-4') , ('CRE','30.00','34.00','D-','Work Hard',2,'3-4') , ('CRE','0.00','29.00','E','Work Harder',1,'3-4') , ('CRE','80.00','100.00','A','Excellent',12,'1-2') , ('CRE','0.00','29.00','E','Work Harder',1,'1-2') , ('GEOGRAPHY','75.00','79.00','A-','Very Good',11,'1-2') , ('GEOGRAPHY','64.00','69.00','B','Good',9,'1-2') , ('GEOGRAPHY','50.00','54.00','C','Fair',6,'1-2') , ('GEOGRAPHY','45.00','49.00','C-','Fair',5,'1-2') , ('B/STUDIES','80.00','100.00','A','Excellent',12,'1-2') , ('B/STUDIES','70.00','74.00','B+','Good',10,'1-2') , ('B/STUDIES','60.00','64.00','B-','Good',8,'1-2') , ('B/STUDIES','50.00','54.00','C','Fair',6,'1-2') , ('B/STUDIES','30.00','34.00','D-','Work Hard',2,'1-2') , ('AGRICULTURE','70.00','74.00','B+','Good',10,'1-2') , ('AGRICULTURE','60.00','64.00','B-','Good',8,'1-2') , ('AGRICULTURE','50.00','54.00','C','Fair',6,'1-2') , ('AGRICULTURE','35.00','39.00','D','Improve',3,'1-2') , ('AGRICULTURE','30.00','34.00','D-','Work Hard',2,'1-2') , ('AGRICULTURE','80.00','100.00','A','Excellent',12,'3-4') , ('AGRICULTURE','65.00','69.00','B','Good',9,'3-4') , ('AGRICULTURE','60.00','64.00','B-','Good',8,'3-4') , ('AGRICULTURE','55.00','59.00','C+','Fair',7,'3-4') , ('AGRICULTURE','35.00','39.00','D','Improve',3,'3-4') , ('AGRICULTURE','30.00','34.00','D-','Work Hard',2,'3-4') , ('MATHS','0.00','24.00','E','Work Harder',1,'3-4') , ('MATHS','25.00','29.00','D-','Work Harder',2,'3-4') , ('MATHS','30.00','34.00','D','Improve',3,'3-4') , ('MATHS','35.00','39.00','D+','Can do better',4,'3-4') , ('MATHS','40.00','44.00','C-','Fair',5,'3-4') , ('MATHS','45.00','49.00','C','Fair',6,'3-4') , ('MATHS','50.00','54.00','C+','Fair',7,'3-4') , ('MATHS','55.00','59.00','B-','Good',8,'3-4') , ('MATHS','60.00','64.00','B','Good',9,'3-4') , ('MATHS','65.00','69.00','B+','Good',10,'3-4') , ('MATHS','70.00','74.00','A-','Very Good',11,'3-4') , ('MATHS','75.00','100.00','A','Excellent',12,'3-4') , ('BIOLOGY','0.00','24.00','E','Work Harder',1,'3-4') , ('BIOLOGY','25.00','29.00','D-','Work Harder',2,'3-4') , ('BIOLOGY','30.00','34.00','D','Improve',3,'3-4') , ('BIOLOGY','35.00','39.00','D+','Can do better',4,'3-4') , ('BIOLOGY','40.00','44.00','C-','Fair',5,'3-4') , ('BIOLOGY','45.00','49.00','C','Fair',6,'3-4') , ('BIOLOGY','50.00','54.00','C+','Fair',7,'3-4') , ('BIOLOGY','55.00','59.00','B-','Good',8,'3-4') , ('BIOLOGY','60.00','64.00','B','Good',9,'3-4') , ('BIOLOGY','65.00','69.00','B+','Good',10,'3-4') , ('BIOLOGY','70.00','74.00','A-','Very Good',11,'3-4') , ('BIOLOGY','75.00','100.00','A','Excellent',12,'3-4') , ('PHYSICS','0.00','24.00','E','Work Harder',1,'3-4') , ('PHYSICS','25.00','29.00','D-','Work Harder',2,'3-4') , ('PHYSICS','30.00','34.00','D','Improve',3,'3-4') , ('PHYSICS','35.00','39.00','D+','Can do better',4,'3-4') , ('PHYSICS','40.00','44.00','C-','Fair',5,'3-4') , ('PHYSICS','45.00','49.00','C','Fair',6,'3-4') , ('PHYSICS','50.00','54.00','C+','Fair',7,'3-4') , ('PHYSICS','55.00','59.00','B-','Good',8,'3-4') , ('PHYSICS','60.00','64.00','B','Good',9,'3-4') , ('PHYSICS','65.00','69.00','B+','Good',10,'3-4') , ('PHYSICS','70.00','74.00','A-','Very Good',11,'3-4') , ('PHYSICS','75.00','100.00','A','Excellent',12,'3-4') , ('CHEMISTRY','0.00','24.00','E','Work Harder',1,'3-4') , ('CHEMISTRY','25.00','29.00','D-','Work Harder',2,'3-4') , ('CHEMISTRY','30.00','34.00','D','Improve',3,'3-4') , ('CHEMISTRY','35.00','39.00','D+','Can do better',4,'3-4') , ('CHEMISTRY','40.00','44.00','C-','Fair',5,'3-4') , ('CHEMISTRY','45.00','49.00','C','Fair',6,'3-4') , ('CHEMISTRY','50.00','54.00','C+','Fair',7,'3-4') , ('CHEMISTRY','55.00','59.00','B-','Good',8,'3-4') , ('CHEMISTRY','60.00','64.00','B','Good',9,'3-4') , ('CHEMISTRY','65.00','69.00','B+','Good',10,'3-4') , ('CHEMISTRY','70.00','74.00','A-','Very Good',11,'3-4') , ('CHEMISTRY','75.00','100.00','A','Excellent',12,'3-4') , ('MATHS','0.00','24.00','E','Work Harder',1,'1-2') , ('MATHS','25.00','29.00','D-','Work Harder',2,'1-2') , ('MATHS','30.00','34.00','D','Improve',3,'1-2') , ('MATHS','35.00','39.00','D+','Can do better',4,'1-2') , ('MATHS','40.00','44.00','C-','Fair',5,'1-2') , ('MATHS','45.00','49.00','C','Fair',6,'1-2') , ('MATHS','50.00','54.00','C+','Fair',7,'1-2') , ('MATHS','55.00','59.00','B-','Good',8,'1-2') , ('MATHS','60.00','64.00','B','Good',9,'1-2') , ('MATHS','65.00','69.00','B+','Good',10,'1-2') , ('MATHS','70.00','74.00','A-','Very Good',11,'1-2') , ('MATHS','75.00','100.00','A','Excellent',12,'1-2') , ('BIOLOGY','0.00','24.00','E','Work Harder',1,'1-2') , ('BIOLOGY','25.00','29.00','D-','Work Harder',2,'1-2') , ('BIOLOGY','30.00','34.00','D','Improve',3,'1-2') , ('BIOLOGY','35.00','39.00','D+','Can do better',4,'1-2') , ('BIOLOGY','40.00','44.00','C-','Fair',5,'1-2') , ('BIOLOGY','45.00','49.00','C','Fair',6,'1-2') , ('BIOLOGY','50.00','54.00','C+','Fair',7,'1-2') , ('BIOLOGY','55.00','59.00','B-','Good',8,'1-2') , ('BIOLOGY','60.00','64.00','B','Good',9,'1-2') , ('BIOLOGY','65.00','69.00','B+','Good',10,'1-2') , ('BIOLOGY','70.00','74.00','A-','Very Good',11,'1-2') , ('BIOLOGY','75.00','100.00','A','Excellent',12,'1-2') , ('PHYSICS','0.00','24.00','E','Work Harder',1,'1-2') , ('PHYSICS','25.00','29.00','D-','Work Harder',2,'1-2') , ('PHYSICS','30.00','34.00','D','Improve',3,'1-2') , ('PHYSICS','35.00','39.00','D+','Can do better',4,'1-2') , ('PHYSICS','40.00','44.00','C-','Fair',5,'1-2') , ('PHYSICS','45.00','49.00','C','Fair',6,'1-2') , ('PHYSICS','50.00','54.00','C+','Fair',7,'1-2') , ('PHYSICS','55.00','59.00','B-','Good',8,'1-2') , ('PHYSICS','60.00','64.00','B','Good',9,'1-2') , ('PHYSICS','65.00','69.00','B+','Good',10,'1-2') , ('PHYSICS','70.00','74.00','A-','Very Good',11,'1-2') , ('PHYSICS','75.00','100.00','A','Excellent',12,'1-2') , ('CHEMISTRY','0.00','24.00','E','Work Harder',1,'1-2') , ('CHEMISTRY','25.00','29.00','D-','Work Harder',2,'1-2') , ('CHEMISTRY','30.00','34.00','D','Improve',3,'1-2') , ('CHEMISTRY','35.00','39.00','D+','Can do better',4,'1-2') , ('CHEMISTRY','40.00','44.00','C-','Fair',5,'1-2') , ('CHEMISTRY','45.00','49.00','C','Fair',6,'1-2') , ('CHEMISTRY','50.00','54.00','C+','Fair',7,'1-2') , ('CHEMISTRY','55.00','59.00','B-','Good',8,'1-2') , ('CHEMISTRY','60.00','64.00','B','Good',9,'1-2') , ('CHEMISTRY','65.00','69.00','B+','Good',10,'1-2') , ('CHEMISTRY','70.00','74.00','A-','Very Good',11,'1-2') , ('CHEMISTRY','75.00','100.00','A','Excellent',12,'1-2') , ('ENGLISH','0.00','29.00','E','Work Harder',1,'3-4') , ('ENGLISH','30.00','34.00','D-','Work Harder',2,'3-4') , ('ENGLISH','35.00','39.00','D','Improve',3,'3-4') , ('ENGLISH','40.00','44.00','D+','Can do better',4,'3-4') , ('ENGLISH','45.00','49.00','C-','Fair',5,'3-4') , ('ENGLISH','50.00','54.00','C','Fair',6,'3-4') , ('ENGLISH','55.00','59.00','C+','Fair',7,'3-4') , ('ENGLISH','60.00','64.00','B-','Good',8,'3-4') , ('ENGLISH','65.00','69.00','B','Good',9,'3-4') , ('ENGLISH','70.00','74.00','B+','Good',10,'3-4') , ('ENGLISH','75.00','79.00','A-','Very Good',11,'3-4') , ('ENGLISH','80.00','100.00','A','Excellent',12,'3-4') , ('KISWAHILI','0.00','29.00','E','Sharti Usome',1,'3-4') , ('KISWAHILI','30.00','34.00','D-','Tia bidii',2,'3-4') , ('KISWAHILI','35.00','39.00','D','Tia bidii',3,'3-4') , ('KISWAHILI','40.00','44.00','D+','Tia bidii',4,'3-4') , ('KISWAHILI','45.00','49.00','C-','Jitahidi',5,'3-4') , ('KISWAHILI','50.00','54.00','C','Jitahidi',6,'3-4') , ('KISWAHILI','55.00','59.00','C+','Jaribio Zuri',7,'3-4') , ('KISWAHILI','60.00','64.00','B-','Jaribio Zuri',8,'3-4') , ('KISWAHILI','65.00','69.00','B','Njema',9,'3-4') , ('KISWAHILI','70.00','74.00','B+','Njema',10,'3-4') , ('KISWAHILI','75.00','79.00','A-','Hongera',11,'3-4') , ('KISWAHILI','80.00','100.00','A','Hongera',12,'3-4') , ('CRE','30.00','34.00','D-','Work Hard',2,'1-2') , ('CRE','35.00','39.00','D','Improve',3,'1-2') , ('CRE','40.00','44.00','D+','Can do better',4,'1-2') , ('CRE','45.00','49.00','C-','Fair',5,'1-2') , ('CRE','50.00','54.00','C','Fair',6,'1-2') , ('CRE','54.00','59.00','C+','Fair',7,'1-2') , ('CRE','60.00','64.00','B-','Good',8,'1-2') , ('CRE','65.00','69.00','B','Good',9,'1-2') , ('CRE','70.00','74.00','B+','Good',10,'1-2') , ('CRE','74.00','79.00','A-','Very Good',11,'1-2') , ('GEOGRAPHY','70.00','74.00','B+','Good',10,'1-2') , ('GEOGRAPHY','60.00','64.00','B-','Good',8,'1-2') , ('GEOGRAPHY','55.00','59.00','C+','Fair',7,'1-2') , ('GEOGRAPHY','40.00','44.00','D+','Can do better',4,'1-2') , ('GEOGRAPHY','35.00','39.00','D','Improve',3,'1-2') , ('GEOGRAPHY','30.00','34.00','D-','Work Hard',2,'1-2') , ('B/STUDIES','55.00','59.00','C+','Fair',7,'3-4') , ('B/STUDIES','60.00','64.00','B-','Good',8,'3-4') , ('B/STUDIES','65.00','69.00','B','Good',9,'3-4') , ('B/STUDIES','70.00','74.00','B+','Good',10,'3-4') , ('B/STUDIES','75.00','79.00','A-','Very Good',11,'3-4') , ('B/STUDIES','80.00','100.00','A','Excellent',12,'3-4') , ('GEOGRAPHY','0.00','29.00','E','Work Harder',1,'3-4') , ('GEOGRAPHY','30.00','34.00','D-','Work Hard',2,'3-4') , ('GEOGRAPHY','35.00','39.00','D','Improve',3,'3-4') , ('B/STUDIES','75.00','79.00','A-','Very Good',11,'1-2') , ('B/STUDIES','65.00','69.00','B','Good',9,'1-2') , ('B/STUDIES','55.00','59.00','C+','Fair',7,'1-2') , ('B/STUDIES','45.00','49.00','C-','Fair',5,'1-2') , ('B/STUDIES','40.00','44.00','D+','Can do better',4,'1-2') , ('B/STUDIES','35.00','39.00','D','Improve',3,'1-2') , ('B/STUDIES','0.00','29.00','E','Work Harder',1,'1-2') , ('AGRICULTURE','80.00','100.00','A','Excellent',12,'1-2') , ('AGRICULTURE','75.00','79.00','A-','Very Good',11,'1-2') , ('AGRICULTURE','65.00','69.00','B','Good',9,'1-2') , ('AGRICULTURE','55.00','59.00','C+','Fair',7,'1-2') , ('AGRICULTURE','45.00','49.00','C-','Fair',5,'1-2') , ('AGRICULTURE','40.00','44.00','D+','Can do better',4,'1-2') , ('AGRICULTURE','0.00','29.00','E','Work Harder',1,'1-2') , ('AGRICULTURE','75.00','79.00','A-','Very Good',11,'3-4') , ('AGRICULTURE','70.00','74.00','B+','Good',10,'3-4') , ('AGRICULTURE','50.00','54.00','C','Fair',6,'3-4') , ('AGRICULTURE','45.00','49.00','C-','Fair',5,'3-4') , ('AGRICULTURE','40.00','44.00','D+','Can do better',4,'3-4') , ('AGRICULTURE','0.00','29.00','E','Work Harder',1,'3-4') , ('CRE','45.00','49.00','C-','Can do better',4,'3-4') , ('GEOGRAPHY','80.00','100.00','A','Excellent',12,'1-2') , ('GEOGRAPHY','40.00','44.00','D+','Can do better',4,'3-4') , ('GEOGRAPHY','45.00','49.00','C-','Fair',5,'3-4') , ('GEOGRAPHY','50.00','54.00','C','Fair',6,'3-4') , ('GEOGRAPHY','55.00','59.00','C+','Fair',7,'3-4') , ('GEOGRAPHY','60.00','64.00','B-','Good',8,'3-4') , ('GEOGRAPHY','65.00','69.00','B','Good',9,'3-4') , ('GEOGRAPHY','70.00','74.00','B+','Good',10,'3-4') , ('GEOGRAPHY','75.00','79.00','A-','Very Good',11,'3-4') , ('GEOGRAPHY','80.00','100.00','A','Excellent',12,'3-4') , ('GEOGRAPHY','0.00','29.00','E','Work Harder',1,'1-2') , ('B/STUDIES','0.00','29.00','E','Work Harder',1,'3-4') , ('B/STUDIES','30.00','34.00','D-','Work Hard',2,'3-4') , ('B/STUDIES','35.00','39.00','D','Improve',3,'3-4') , ('B/STUDIES','40.00','44.00','D+','Can do better',4,'3-4') , ('B/STUDIES','45.00','49.00','C-','Fair',5,'3-4') , ('B/STUDIES','50.00','54.00','C','Fair',6,'3-4') , ('HISTORY','45.00','49.00','C-','Fair',5,'3-4') , ('HISTORY','50.00','54.00','C','Fair',6,'3-4') , ('HISTORY','55.00','59.00','C+','Fair',7,'3-4') , ('HISTORY','60.00','64.00','B-','Good',8,'3-4') , ('HISTORY','65.00','69.00','B','Good',9,'3-4') , ('HISTORY','70.00','74.00','B+','Good',10,'3-4') , ('HISTORY','75.00','79.00','A-','Very Good',11,'3-4') , ('HISTORY','80.00','100.00','A','Excellent',12,'3-4') , ('CRE','40.00','44.00','D+','Can do better',4,'3-4') , ('COMPUTER','0.00','29.00','E','',1,'3-4') , ('COMPUTER','0.00','29.00','E','Work Harder',1,'1-2') , ('COMPUTER','30.00','34.00','D-','Work Harder',2,'1-2') , ('COMPUTER','35.00','39.00','D','Improve',3,'1-2') , ('COMPUTER','40.00','44.00','D+','Can do better',4,'1-2') , ('COMPUTER','45.00','49.00','C-','Fair',5,'1-2') , ('COMPUTER','50.00','54.00','C','Fair',6,'1-2') , ('COMPUTER','55.00','59.00','C+','Fair',7,'1-2') , ('COMPUTER','60.00','64.00','B-','Good',8,'1-2') , ('COMPUTER','65.00','69.00','B','Good',9,'1-2') , ('COMPUTER','70.00','74.00','B+','Good',10,'1-2') , ('COMPUTER','75.00','79.00','A-','Very Good',11,'1-2') , ('COMPUTER','80.00','100.00','A','Excellent',12,'1-2') , ('COMPUTER','30.00','34.00','D-','',2,'3-4') , ('COMPUTER','35.00','39.00','D','',3,'3-4') , ('COMPUTER','40.00','44.00','D+','',4,'3-4') , ('COMPUTER','45.00','49.00','C-','',5,'3-4') , ('COMPUTER','50.00','54.00','C','',6,'3-4') , ('COMPUTER','55.00','59.00','C+','',7,'3-4') , ('COMPUTER','60.00','64.00','B-','',8,'3-4') , ('COMPUTER','65.00','69.00','B','',9,'3-4') , ('COMPUTER','70.00','74.00','B+','',10,'3-4') , ('COMPUTER','75.00','79.00','A-','',11,'3-4') , ('COMPUTER','80.00','100.00','A','',12,'3-4') ;

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
  `adm` varchar(100) NOT NULL default '',
  `names` varchar(100) NOT NULL default '',
  `kcpemean` decimal(18,2) default '0.00',
  `previous` decimal(18,2) default '0.00',
  `current` decimal(18,2) default '0.00',
  `pindex` decimal(18,2) default '0.00',
  `vap` decimal(18,2) default '0.00',
  `term` int(100) NOT NULL,
  `year` int(100) NOT NULL,
  `form` int(100) NOT NULL,
  `classin` varchar(100) NOT NULL default '',
  PRIMARY KEY  (`adm`,`year`,`term`,`form`,`classin`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*
Table struture for totalperformanceindex
*/

drop table if exists `totalperformanceindex`;
CREATE TABLE `totalperformanceindex` (
  `adm` varchar(100) NOT NULL default '',
  `names` varchar(100) NOT NULL default '',
  `kcpemean` decimal(18,2) default '0.00',
  `previous` decimal(18,2) default '0.00',
  `current` decimal(18,2) default '0.00',
  `pindex` decimal(18,2) default '0.00',
  `vap` decimal(18,2) default '0.00',
  `term` int(100) NOT NULL,
  `year` int(100) NOT NULL,
  `form` int(100) NOT NULL,
  `classin` varchar(100) NOT NULL default '',
  `exam` varchar(10) NOT NULL default '',
  PRIMARY KEY  (`adm`,`term`,`year`,`form`,`classin`,`exam`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*
Table struture for totalygradedexamanalysis
*/

drop table if exists `totalygradedexamanalysis`;
CREATE TABLE `totalygradedexamanalysis` (
  `adm` int(10) NOT NULL,
  `names` varchar(40) NOT NULL default '',
  `eng1` int(10) NOT NULL,
  `eng1grade` varchar(5) NOT NULL default '',
  `kis1` int(10) NOT NULL,
  `kis1grade` varchar(5) NOT NULL default '',
  `math1` int(10) NOT NULL,
  `math1grade` varchar(5) NOT NULL default '',
  `bio1` int(10) NOT NULL,
  `bio1grade` varchar(5) NOT NULL default '',
  `chem1` int(10) NOT NULL,
  `chem1grade` varchar(5) NOT NULL default '',
  `phy1` int(10) NOT NULL,
  `phy1grade` varchar(100) NOT NULL default '',
  `his1` int(5) NOT NULL,
  `his1grade` varchar(10) NOT NULL default '',
  `geo1` int(10) NOT NULL,
  `geo1grade` varchar(5) NOT NULL default '',
  `cre1` int(10) NOT NULL,
  `cre1grade` varchar(5) NOT NULL default '',
  `agr1` int(10) NOT NULL,
  `agr1grade` varchar(5) NOT NULL default '',
  `bst1` int(10) NOT NULL,
  `bst1grade` varchar(5) NOT NULL default '',
  `fre1` int(10) NOT NULL,
  `fre1grade` varchar(100) NOT NULL default '',
  `comp1` int(10) NOT NULL,
  `comp1grade` varchar(100) NOT NULL default '',
  `home1` int(10) NOT NULL,
  `home1grade` varchar(100) NOT NULL default '',
  `wat1totals` int(10) NOT NULL,
  `totalmarks` int(10) NOT NULL,
  `totalpoints1` int(10) NOT NULL,
  `averagepoints` decimal(18,3) NOT NULL default '0.000',
  `average` decimal(18,2) NOT NULL default '0.00',
  `fgrade` varchar(3) NOT NULL default '',
  `term` int(100) NOT NULL,
  `year` int(100) NOT NULL,
  `form` int(100) NOT NULL,
  `stream` varchar(100) NOT NULL default '',
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
  `frenchgrade` varchar(100) NOT NULL default '',
  `frenchremarks` varchar(100) NOT NULL default '',
  `computer` int(10) NOT NULL,
  `computergrade` varchar(100) NOT NULL default '',
  `computerremarks` varchar(100) NOT NULL default '',
  `home` int(10) NOT NULL,
  `homegrade` varchar(100) NOT NULL default '',
  `homeremarks` varchar(100) NOT NULL default '',
  `points` varchar(10) NOT NULL default '',
  `tgrade` varchar(10) NOT NULL default '',
  `totalmarks` int(10) NOT NULL,
  `average` double NOT NULL,
  `averagepoints` double NOT NULL,
  `term` int(100) NOT NULL,
  `year` int(100) NOT NULL,
  `form` int(100) NOT NULL,
  `classin` varchar(100) NOT NULL default '',
  `htremarks` varchar(100) NOT NULL default '',
  PRIMARY KEY  (`adm`,`term`,`year`,`form`,`classin`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*
Table struture for totalygradedmidterm
*/

drop table if exists `totalygradedmidterm`;
CREATE TABLE `totalygradedmidterm` (
  `adm` int(10) NOT NULL,
  `names` varchar(40) NOT NULL,
  `eng1` int(10) NOT NULL,
  `eng1grade` varchar(5) NOT NULL default '',
  `kis1` int(10) NOT NULL,
  `kis1grade` varchar(5) NOT NULL default '',
  `math1` int(10) NOT NULL,
  `math1grade` varchar(5) NOT NULL default '',
  `bio1` int(10) NOT NULL,
  `bio1grade` varchar(5) NOT NULL default '',
  `chem1` int(10) NOT NULL,
  `chem1grade` varchar(5) NOT NULL default '',
  `phy1` int(10) NOT NULL,
  `phy1grade` varchar(100) NOT NULL default '',
  `his1` int(5) NOT NULL,
  `his1grade` varchar(10) NOT NULL default '',
  `geo1` int(10) NOT NULL,
  `geo1grade` varchar(5) NOT NULL default '',
  `cre1` int(10) NOT NULL,
  `cre1grade` varchar(5) NOT NULL default '',
  `agr1` int(10) NOT NULL,
  `agr1grade` varchar(5) NOT NULL default '',
  `bst1` int(10) NOT NULL,
  `bst1grade` varchar(5) NOT NULL default '',
  `fre1` int(10) NOT NULL,
  `fre1grade` varchar(100) NOT NULL default '',
  `comp1` int(10) NOT NULL,
  `comp1grade` varchar(100) NOT NULL default '',
  `home1` int(10) NOT NULL,
  `home1grade` varchar(100) NOT NULL default '',
  `wat1totals` int(10) NOT NULL,
  `totalmarks` int(10) NOT NULL,
  `totalpoints1` int(10) NOT NULL,
  `averagepoints` decimal(18,3) NOT NULL default '0.000',
  `average` decimal(18,2) NOT NULL default '0.00',
  `fgrade` varchar(3) NOT NULL default '',
  `term` int(100) NOT NULL,
  `year` int(100) NOT NULL,
  `form` int(100) NOT NULL,
  `stream` varchar(100) NOT NULL default '',
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
  `frenchgrade` varchar(100) NOT NULL default '',
  `frenchremarks` varchar(100) NOT NULL default '',
  `computer` int(100) NOT NULL,
  `computergrade` varchar(100) NOT NULL default '',
  `computerremarks` varchar(100) NOT NULL default '',
  `home` int(10) NOT NULL,
  `homegrade` varchar(100) NOT NULL default '',
  `homeremarks` varchar(100) NOT NULL default '',
  `points` varchar(100) NOT NULL default '',
  `tgrade` varchar(100) NOT NULL default '',
  `totalmarks` int(100) NOT NULL,
  `average` double NOT NULL,
  `averagepoints` double NOT NULL,
  `term` int(100) NOT NULL,
  `year` int(100) NOT NULL,
  `form` int(100) NOT NULL,
  `classin` varchar(100) NOT NULL default '',
  `htremarks` varchar(100) NOT NULL default '',
  PRIMARY KEY  (`adm`,`term`,`year`,`form`,`classin`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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

/*
Table struture for voteheads
*/

drop table if exists `voteheads`;
CREATE TABLE `voteheads` (
  `votehead` varchar(100) NOT NULL,
  `initial` varchar(100) NOT NULL,
  `year` int(100) NOT NULL,
  PRIMARY KEY  (`votehead`,`year`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

