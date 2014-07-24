-- phpMyAdmin SQL Dump
-- version 4.0.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 24, 2014 at 08:54 AM
-- Server version: 5.0.96-community
-- PHP Version: 5.3.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `hconsult_cms`
--

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT='Users' AUTO_INCREMENT=11 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
         