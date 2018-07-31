/* 
SQLyog v3.11
Host - localhost : Database - primary_sch
**************************************************************
Server version 5.0.7-beta-nt
*/

create database if not exists `primary_sch`;

use `primary_sch`;

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
Table data for primary_sch.tbl_hr_nssf
*/

INSERT INTO `tbl_hr_nssf` VALUES ('0.00','6000.00','0.00','6.00') , ('6001.00','18000.00','0.00','6.00') , ('18001.00','1000000.00','18000.00','6.00') ;

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
Table data for primary_sch.tbl_hr_nssf_old
*/

INSERT INTO `tbl_hr_nssf_old` VALUES ('1000.00','1000000.00','200.00','0.00') ;

