-- phpMyAdmin SQL Dump
-- version 2.6.2-pl1
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generation Time: Sep 28, 2005 at 09:03 AM
-- Server version: 4.0.24
-- PHP Version: 4.3.10-15
-- 
-- Database: `BugFree10`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `BugFile`
-- 

CREATE TABLE `BugFile` (
  `FileID` int(10) unsigned NOT NULL auto_increment,
  `BugID` mediumint(7) unsigned zerofill NOT NULL default '0000000',
  `FileTitle` varchar(100) NOT NULL default '',
  `FileName` varchar(50) NOT NULL default '',
  `FileType` varchar(10) NOT NULL default '',
  `FileSize` varchar(20) NOT NULL default '',
  `AddUser` varchar(30) NOT NULL default '',
  `AddDate` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`FileID`),
  KEY `BugID` (`BugID`)
) TYPE=MyISAM;

-- 
-- Dumping data for table `BugFile`
-- 

INSERT INTO `BugFile` VALUES (1, 0000001, 'Bug演示', '20040922115157_4895.txt', 'txt', '1.02KB', 'guest', '2004-09-22 11:51:57');

-- --------------------------------------------------------

-- 
-- Table structure for table `BugGroup`
-- 

CREATE TABLE `BugGroup` (
  `GroupID` smallint(5) unsigned NOT NULL auto_increment,
  `GroupName` varchar(60) NOT NULL default '',
  `GroupUser` text NOT NULL,
  `GroupACL` text NOT NULL,
  `LastDate` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`GroupID`)
) TYPE=MyISAM;

-- 
-- Dumping data for table `BugGroup`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `BugHistory`
-- 

CREATE TABLE `BugHistory` (
  `HistoryID` int(10) unsigned NOT NULL auto_increment,
  `BugID` mediumint(8) unsigned zerofill NOT NULL default '00000000',
  `UserName` varchar(30) NOT NULL default '',
  `Action` varchar(100) NOT NULL default '',
  `FullInfo` text NOT NULL,
  `ActionDate` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`HistoryID`)
) TYPE=MyISAM;

-- 
-- Dumping data for table `BugHistory`
-- 

INSERT INTO `BugHistory` VALUES (1, 00000001, 'guest', 'Opened', '[步骤]\r\n1.第一步...\r\n2.第二步...\r\n3.第三步...\r\n\r\n[结果]\r\n此处说明当前结果...\r\n\r\n[期望]\r\n此处说明正确的情况...\r\n\r\n[备注]\r\n', '2004-09-22 11:51:57');

-- --------------------------------------------------------

-- 
-- Table structure for table `BugInfo`
-- 

CREATE TABLE `BugInfo` (
  `BugID` mediumint(7) unsigned zerofill NOT NULL auto_increment,
  `ProjectID` int(10) unsigned NOT NULL default '0',
  `ProjectName` varchar(100) NOT NULL default '',
  `ModuleID` int(10) unsigned NOT NULL default '0',
  `ModulePath` varchar(240) NOT NULL default '',
  `BugTitle` varchar(100) NOT NULL default '',
  `BugSeverity` tinyint(4) NOT NULL default '0',
  `BugType` varchar(20) NOT NULL default '',
  `BugOS` varchar(50) NOT NULL default '',
  `BugStatus` varchar(20) NOT NULL default '',
  `LinkID` varchar(240) NOT NULL default '',
  `MailTo` varchar(255) NOT NULL default '',
  `OpenedBy` varchar(30) NOT NULL default '',
  `OpenedDate` datetime NOT NULL default '0000-00-00 00:00:00',
  `OpenedBuild` varchar(100) NOT NULL default '',
  `AssignedTo` varchar(30) NOT NULL default '',
  `AssignedDate` datetime NOT NULL default '0000-00-00 00:00:00',
  `ResolvedBy` varchar(30) NOT NULL default '',
  `Resolution` varchar(20) NOT NULL default '',
  `ResolvedBuild` varchar(100) NOT NULL default '',
  `ResolvedDate` datetime NOT NULL default '0000-00-00 00:00:00',
  `ClosedBy` varchar(30) NOT NULL default '',
  `ClosedDate` datetime NOT NULL default '0000-00-00 00:00:00',
  `LastEditedBy` varchar(30) NOT NULL default '',
  `LastEditedDate` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`BugID`),
  KEY `ModuleID` (`ModuleID`),
  KEY `BugTitle` (`BugTitle`),
  KEY `BugSeverity` (`BugSeverity`),
  KEY `BugType` (`BugType`),
  KEY `BugStatus` (`BugStatus`),
  KEY `OpenedBy` (`OpenedBy`),
  KEY `AssignedTo` (`AssignedTo`),
  KEY `ResolvedBy` (`ResolvedBy`),
  KEY `Resolution` (`Resolution`),
  KEY `ClosedBy` (`ClosedBy`),
  KEY `LastEditedBy` (`LastEditedBy`)
) TYPE=MyISAM;

-- 
-- Dumping data for table `BugInfo`
-- 

INSERT INTO `BugInfo` VALUES (0000001, 1, 'BugFree项目', 1, '/BugFree', '第一个测试BUG', 3, 'CodeError', 'All', 'Active', '', '', 'guest', '2004-09-22 11:51:57', '1.0.20040922', 'guest', '0000-00-00 00:00:00', '', '', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', 'guest', '2004-09-22 11:51:57');

-- --------------------------------------------------------

-- 
-- Table structure for table `BugModule`
-- 

CREATE TABLE `BugModule` (
  `ModuleID` int(10) unsigned NOT NULL auto_increment,
  `ProjectID` int(10) unsigned NOT NULL default '0',
  `ModuleName` varchar(100) NOT NULL default '',
  `ModuleGrade` tinyint(4) NOT NULL default '0',
  `ParentID` int(10) unsigned NOT NULL default '0',
  `AddDate` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`ModuleID`),
  KEY `ProjectID` (`ProjectID`),
  KEY `ModuleName` (`ModuleName`),
  KEY `ModuleGrade` (`ModuleGrade`),
  KEY `ParentID` (`ParentID`)
) TYPE=MyISAM;

-- 
-- Dumping data for table `BugModule`
-- 

INSERT INTO `BugModule` VALUES (1, 1, '首页', 1, 0, '2004-10-26 11:39:38');
INSERT INTO `BugModule` VALUES (2, 1, '左栏部分', 1, 0, '2004-10-26 11:39:38');
INSERT INTO `BugModule` VALUES (3, 1, '查询', 1, 0, '2004-10-26 11:39:38');
INSERT INTO `BugModule` VALUES (4, 1, 'Bug列表', 1, 0, '2004-10-26 11:39:38');
INSERT INTO `BugModule` VALUES (5, 1, 'Bug信息', 1, 0, '2004-10-26 11:39:38');
INSERT INTO `BugModule` VALUES (6, 1, 'Bug的一生：新建', 1, 0, '2004-10-26 11:39:38');
INSERT INTO `BugModule` VALUES (7, 1, 'Bug的一生：编辑', 1, 0, '2004-10-26 11:39:38');
INSERT INTO `BugModule` VALUES (8, 1, 'Bug的一生：解决', 1, 0, '2004-10-26 11:39:38');
INSERT INTO `BugModule` VALUES (9, 1, 'Bug的一生：关闭', 1, 0, '2004-10-26 11:39:38');
INSERT INTO `BugModule` VALUES (10, 1, 'Bug的一生：激活', 1, 0, '2004-10-26 11:39:38');
INSERT INTO `BugModule` VALUES (11, 1, '其他', 1, 0, '2004-10-26 11:39:38');

-- --------------------------------------------------------

-- 
-- Table structure for table `BugProject`
-- 

CREATE TABLE `BugProject` (
  `ProjectID` int(10) unsigned NOT NULL auto_increment,
  `ProjectName` varchar(100) NOT NULL default '',
  `ProjectDoc` varchar(255) NOT NULL default '',
  `ProjectPlan` varchar(255) NOT NULL default '',
  `AddDate` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`ProjectID`),
  KEY `ProjectName` (`ProjectName`)
) TYPE=MyISAM;

-- 
-- Dumping data for table `BugProject`
-- 

INSERT INTO `BugProject` VALUES (1, 'BugFree项目', '', '', '2004-09-22 11:39:30');

-- --------------------------------------------------------

-- 
-- Table structure for table `BugQuery`
-- 

CREATE TABLE `BugQuery` (
  `QueryID` int(10) unsigned NOT NULL auto_increment,
  `UserName` varchar(30) NOT NULL default '',
  `QueryTitle` varchar(100) NOT NULL default '',
  `QueryString` text NOT NULL,
  `AddDate` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`QueryID`),
  KEY `UserName` (`UserName`),
  KEY `QueryTitle` (`QueryTitle`)
) TYPE=MyISAM;

-- 
-- Dumping data for table `BugQuery`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `BugUser`
-- 

CREATE TABLE `BugUser` (
  `UserID` smallint(4) NOT NULL auto_increment,
  `UserName` varchar(20) NOT NULL default '',
  `UserPassword` varchar(40) NOT NULL default '',
  `RealName` varchar(20) NOT NULL default '',
  `Email` varchar(50) NOT NULL default '',
  PRIMARY KEY  (`UserID`)
) TYPE=MyISAM;

-- 
-- Dumping data for table `BugUser`
-- 

INSERT INTO `BugUser` VALUES (1, 'admin', 'e10adc3949ba59abbe56e057f20f883e', '管理员', 'admin@xxx.com');