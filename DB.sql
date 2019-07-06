-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 20, 2013 at 01:25 PM
-- Server version: 5.1.36-community-log
-- PHP Version: 5.3.0

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `md5_login`
--

-- --------------------------------------------------------

--
-- Table structure for table `user`
--
create database nims_store;
use nims_store;

CREATE TABLE IF NOT EXISTS `user_tbl` (
	
  `user_id` int(15) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(100) NOT NULL,
  `user_password` varchar(200) NOT NULL,
  `role` int(2) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=INNODB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=0 ;


CREATE TABLE IF NOT EXISTS `item_tbl` (
 
   `item_id` int(15) NOT NULL AUTO_INCREMENT,
   `item_name` varchar(200) NOT NULL,
 
  PRIMARY KEY (`item_id`)
) ENGINE=INNODB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=0 ;

CREATE TABLE IF NOT EXISTS `supplier_tbl` (
  
  `supplier_id` int(15) NOT NULL AUTO_INCREMENT,
  `supplier_name` varchar(200) NOT NULL,
`supplier_address` varchar(500) NOT NULL,
`supplier_mobile` int(15) NOT NULL,

  PRIMARY KEY (`supplier_id`)
) ENGINE=INNODB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=0 ;

CREATE TABLE IF NOT EXISTS `unit_tbl` (
  
    `unit_id` int(15) NOT NULL AUTO_INCREMENT,
  `unit_name` varchar(200) NOT NULL,
  `quantity` int(15) NOT NULL,
   PRIMARY KEY (`unit_id`)
) ENGINE=INNODB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=0 ;

CREATE TABLE IF NOT EXISTS `dept_tbl` (
  
  `dept_id` int(15) NOT NULL AUTO_INCREMENT,
  `block_name` varchar(200) NOT NULL,
`dept_name` varchar(200) NOT NULL,
`room_name` varchar(200) NOT NULL,
`room_no` int(15) NOT NULL,
  PRIMARY KEY (`dept_id`)
) ENGINE=INNODB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=0 ;

CREATE TABLE IF NOT EXISTS `issue_tbl` (
  `sno` int(15) NOT NULL AUTO_INCREMENT,
  `dept_id` int(15) NOT NULL,
`item_id` int(15) NOT NULL,
`unit_id` int(15) NOT NULL,
`unitsissued` int(15) NOT NULL,
`noofitems` int(15) NOT NULL,
`indentno` varchar(200) NOT NULL,
`voucherno` varchar(200) NOT NULL,
 `issueddate` date NOT NULL,

  PRIMARY KEY (`sno`),FOREIGN KEY (dept_id) REFERENCES dept_tbl(dept_id),FOREIGN KEY (item_id) REFERENCES item_tbl(item_id),
	FOREIGN KEY (unit_id) REFERENCES unit_tbl(unit_id) 
) ENGINE=INNODB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=0 ;


CREATE TABLE IF NOT EXISTS `purchase_tbl` (
  `sno` int(15) NOT NULL AUTO_INCREMENT,
  `supplier_id` int(15) NOT NULL,
`item_id` int(15) NOT NULL,
`unit_id` int(15) NOT NULL,
`unitsreceived` int(15) NOT NULL,
`noofitems` int(15) NOT NULL,
`billno` varchar(200) NOT NULL,
`billdate` varchar(25) NOT NULL,
`rcvcno` varchar(200) NOT NULL,
 `rcdate` varchar(25) NOT NULL,

  PRIMARY KEY (`sno`),FOREIGN KEY (supplier_id) REFERENCES supplier_tbl(supplier_id),FOREIGN KEY (item_id) REFERENCES item_tbl(item_id),
	FOREIGN KEY (unit_id) REFERENCES unit_tbl(unit_id) 
) ENGINE=INNODB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=0 ;

CREATE TABLE IF NOT EXISTS `stocks_tbl` (
 `sno` int(15) NOT NULL AUTO_INCREMENT,
 `item_id` int(15) NOT NULL ,
 `unit_id` int(15) NOT NULL,
  `unitsissued` int(5) NOT NULL,
  `quantity` int(5) NOT NULL,
 
  PRIMARY KEY (`sno`),FOREIGN KEY (item_id) REFERENCES item_tbl(item_id),
	FOREIGN KEY (unit_id) REFERENCES unit_tbl(unit_id) 
) ENGINE=INNODB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=0 ;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
