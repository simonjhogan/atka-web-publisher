-- phpMyAdmin SQL Dump
-- version 4.0.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 24, 2014 at 07:13 PM
-- Server version: 5.0.96-community
-- PHP Version: 5.3.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `hconsult_cms`
--
CREATE DATABASE IF NOT EXISTS `hconsult_cms` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `hconsult_cms`;

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE IF NOT EXISTS `files` (
  `id` int(11) NOT NULL auto_increment,
  `ref` varchar(255) NOT NULL,
  `path` varchar(255) NOT NULL,
  `filetype` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `category` varchar(255) NOT NULL,
  `size` bigint(20) NOT NULL,
  `metadata` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `reference` (`ref`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=53 ;

--
-- Dumping data for table `files`
--

INSERT INTO `files` (`id`, `ref`, `path`, `filetype`, `title`, `description`, `category`, `size`, `metadata`, `created`, `modified`) VALUES
(50, '/images/jacob/IMG_1211.JPG', '/images/jacob', 'image/jpeg', 'Jacob', '', '', 651542, 'width:1600,height:1200', '2012-07-09 03:07:30', '2012-07-09 03:07:30'),
(51, '/images/cms/CMS-RibbonBar.png', '/images/cms', 'image/png', 'h3CMS Ribbon Bar', '', '', 10869, 'width:300,height:54', '2012-07-13 05:38:55', '2012-07-13 05:38:55'),
(52, '/images/simon.png', '/images', 'image/png', 'Simon J. Hogan', '', '', 31612, 'width:180,height:223', '2012-07-28 21:12:23', '2012-07-28 21:12:23');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE IF NOT EXISTS `pages` (
  `id` int(11) NOT NULL auto_increment,
  `ref` varchar(255) NOT NULL,
  `path` varchar(255) NOT NULL,
  `template` varchar(255) NOT NULL,
  `restrict` tinyint(1) NOT NULL,
  `default` tinyint(1) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `keywords` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `welcomeFeature` text NOT NULL,
  `newsFeature` text NOT NULL,
  `content` text NOT NULL,
  `contentFeature` text NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `reference` (`ref`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT='CMS Pages' AUTO_INCREMENT=29 ;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `ref`, `path`, `template`, `restrict`, `default`, `title`, `description`, `keywords`, `author`, `created`, `modified`, `welcomeFeature`, `newsFeature`, `content`, `contentFeature`) VALUES
(1, '/home', '/', 'home', 0, 1, 'h3consulting', '', '', '', '2012-05-04 14:00:00', '2012-08-21 22:54:06', '<p>h3consulting is a Canberra based business with over 20 years of expertise in \r\nthe Information Technology and Events Management industries.</p>\r\n<p>We provide a range of specialisedÃ‚Â servicesÃ‚Â including:</p><p></p><ul><li>web site & application development<br></li><li>mobile web applications<br></li><li>mapping solutions</li><li>online surveys, and<br></li><li>large and small events management.<br></li></ul><p></p>\r\n\r\n', '<h3>Atka Web Publisher beta preview</h3><p><img alt="h3CMS Ribbon Interface" src="/assets/images/cms/CMS-RibbonBar.png" width="90%"></p><p>h3consulting have a released a preview of the beta <b>HTML5/jQuery Web Content Management System - ATKA</b>.</p><p style="text-align: right;"><a href="/index.php/atka/information">Find out more\r\n</a></p><p class="rss-update">Released: Sun, 29 Jul 2012 10:00:01 GMT</p>', '<h2>This site isÃ‚Â currentlyÃ‚Â under construction please come back soon ....</h2>', '<p><br></p>');

-- --------------------------------------------------------

--
-- Table structure for table `revisions`
--

CREATE TABLE IF NOT EXISTS `revisions` (
  `id` int(11) NOT NULL,
  `ref` varchar(255) NOT NULL,
  `path` varchar(255) NOT NULL,
  `template` varchar(255) NOT NULL,
  `restrict` tinyint(1) NOT NULL,
  `default` tinyint(1) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `keywords` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `welcomeFeature` text NOT NULL,
  `newsFeature` text NOT NULL,
  `content` text NOT NULL,
  `contentFeature` text NOT NULL,
  KEY `reference` (`ref`),
  KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT='CMS Revisions';

-- --------------------------------------------------------

--
-- Table structure for table `templates`
--

CREATE TABLE IF NOT EXISTS `templates` (
  `id` int(11) NOT NULL auto_increment,
  `title` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `templates`
--

INSERT INTO `templates` (`id`, `title`, `name`) VALUES
(1, 'Homepage', 'home'),
(2, 'Article Page', 'article');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL auto_increment,
  `key` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `key` (`key`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT='Users' AUTO_INCREMENT=12 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `key`, `username`, `password`, `salt`, `firstname`, `lastname`, `fullname`, `email`, `role`, `created`, `modified`) VALUES
(11, '00b391a5d408f7bfb846208d49ad29a554ef0a50d64112add6d5230758e8ee9d', 'admin', '$6$rounds=5000$4d07dac90cc52498$B0snCLFYbnoXi6b4fobhir8c8hS0Y9A3Voa5yQi4HoilhMA8B.e.EYdYM2WROoStPlNTpNcdvXfAEzU32flAP.', '4d07dac90cc52498c771215ec75ce71f952a31a7767165f0e02c424ba08f0199', 'Default', 'Administrator', 'Administrator', 'admin@local.com', 'admin', '2014-07-24 19:10:39', '2014-07-24 19:10:39');
