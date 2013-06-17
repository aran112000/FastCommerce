-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 18, 2013 at 02:37 AM
-- Server version: 5.1.62-community
-- PHP Version: 5.3.21

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `ecom`
--
CREATE DATABASE IF NOT EXISTS `ecom` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `ecom`;

-- --------------------------------------------------------

--
-- Table structure for table `cat`
--

DROP TABLE IF EXISTS `cat`;
CREATE TABLE IF NOT EXISTS `cat` (
  `cid` int(5) NOT NULL AUTO_INCREMENT,
  `parent_cid` int(5) NOT NULL DEFAULT '0',
  `live` tinyint(1) NOT NULL,
  `deleted` tinyint(1) NOT NULL,
  `created` datetime NOT NULL,
  `ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `title` varchar(200) NOT NULL,
  `fn` varchar(200) NOT NULL,
  `body` text NOT NULL,
  PRIMARY KEY (`cid`),
  KEY `live` (`live`,`deleted`),
  KEY `parent_cid` (`parent_cid`),
  KEY `deleted` (`deleted`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `cat`
--

INSERT INTO `cat` (`cid`, `parent_cid`, `live`, `deleted`, `created`, `ts`, `title`, `fn`, `body`) VALUES
(1, 0, 1, 0, '0000-00-00 00:00:00', '2013-06-08 23:01:05', 'Test Category 1', 'test-category-1', ''),
(2, 0, 1, 0, '0000-00-00 00:00:00', '2013-06-08 23:04:48', 'Test Category 2', 'test-category-2', ''),
(3, 0, 1, 0, '0000-00-00 00:00:00', '2013-06-08 23:04:51', 'Test Category 3', 'test-category-3', ''),
(4, 0, 1, 0, '0000-00-00 00:00:00', '2013-06-08 23:04:53', 'Test Category 4', 'test-category-4', ''),
(5, 0, 1, 0, '0000-00-00 00:00:00', '2013-06-08 23:05:00', 'Test Category 5', 'test-category-5', ''),
(6, 0, 1, 0, '0000-00-00 00:00:00', '2013-06-08 23:05:03', 'Test Category 6', 'test-category-6', ''),
(7, 1, 1, 0, '0000-00-00 00:00:00', '2013-06-08 23:08:27', 'Test Category 7', 'test-category-7', '');

-- --------------------------------------------------------

--
-- Table structure for table `cms_module`
--

DROP TABLE IF EXISTS `cms_module`;
CREATE TABLE IF NOT EXISTS `cms_module` (
  `mid` int(3) NOT NULL AUTO_INCREMENT,
  `mgid` int(3) NOT NULL,
  `live` tinyint(1) NOT NULL DEFAULT '1',
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  `title` varchar(100) NOT NULL,
  `table_name` varchar(100) NOT NULL,
  `primary_key` varchar(15) NOT NULL,
  PRIMARY KEY (`mid`),
  KEY `mgid` (`mgid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `cms_module`
--

INSERT INTO `cms_module` (`mid`, `mgid`, `live`, `deleted`, `title`, `table_name`, `primary_key`) VALUES
(1, 1, 1, 0, 'Pages', 'page', 'pid'),
(2, 2, 1, 0, 'Products', 'prod', 'pid'),
(3, 2, 1, 0, 'Categories', 'cat', 'cid');

-- --------------------------------------------------------

--
-- Table structure for table `cms_module_group`
--

DROP TABLE IF EXISTS `cms_module_group`;
CREATE TABLE IF NOT EXISTS `cms_module_group` (
  `mgid` int(3) NOT NULL AUTO_INCREMENT,
  `parent_mgid` int(3) NOT NULL,
  `live` tinyint(1) NOT NULL DEFAULT '1',
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  `title` varchar(100) NOT NULL,
  PRIMARY KEY (`mgid`),
  KEY `parent_mgid` (`parent_mgid`,`live`,`deleted`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `cms_module_group`
--

INSERT INTO `cms_module_group` (`mgid`, `parent_mgid`, `live`, `deleted`, `title`) VALUES
(1, 0, 1, 0, 'Page Management'),
(2, 0, 1, 0, 'eCommerce');

-- --------------------------------------------------------

--
-- Table structure for table `page`
--

DROP TABLE IF EXISTS `page`;
CREATE TABLE IF NOT EXISTS `page` (
  `pid` int(5) NOT NULL AUTO_INCREMENT,
  `parent_pid` int(5) NOT NULL DEFAULT '0',
  `live` tinyint(1) NOT NULL DEFAULT '1',
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  `title` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `fn` varchar(255) NOT NULL,
  `nav` tinyint(1) NOT NULL DEFAULT '0',
  `nav_title` varchar(100) NOT NULL,
  `direct_link` varchar(80) NOT NULL,
  PRIMARY KEY (`pid`),
  KEY `parent_pid` (`parent_pid`,`live`,`deleted`),
  KEY `nav` (`nav`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `page`
--

INSERT INTO `page` (`pid`, `parent_pid`, `live`, `deleted`, `title`, `body`, `fn`, `nav`, `nav_title`, `direct_link`) VALUES
(1, 0, 1, 0, 'Welcome to Ecommerce Site', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas scelerisque mattis est, a consectetur dolor suscipit quis. Vestibulum mi nulla, vestibulum ac vestibulum eget, sollicitudin nec erat. Nunc nec turpis vel turpis dapibus blandit a et nisi. Proin non posuere ligula. Morbi vitae erat eu tellus feugiat dictum non vel dui.\r\nQuisque fringilla molestie justo eget placerat. Etiam tristique, leo in bibendum consequat, nunc arcu lobortis dui, vitae adipiscing justo ipsum ac velit. Etiam non ipsum ipsum, ut varius eros. Duis porta leo vitae eros iaculis condimentum. Integer ut dui id nisi malesuada dignissim.\r\nClass aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Ut eu sollicitudin nisi. Nulla tortor ipsum, ornare id lobortis sed, vehicula egestas ligula. Vivamus dignissim augue ac ipsum commodo vestibulum. Fusce iaculis risus ut quam adipiscing lobortis. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec consectetur, orci quis consequat volutpat, ante nisl hendrerit purus, at hendrerit mi ipsum ut nibh. In pulvinar ullamcorper ligula, non fringilla nulla venenatis eu. Suspendisse mauris ligula, ultrices nec rhoncus sed, commodo ut justo.\r\nDonec tincidunt ornare diam quis vestibulum. Sed sodales volutpat massa, sed ullamcorper est feugiat feugiat. Sed convallis, nisl eget adipiscing iaculis, mauris mi laoreet eros, sed imperdiet sapien felis ut odio. Etiam in tincidunt lectus. Aliquam facilisis interdum tortor, et dictum lacus vestibulum in. Pellentesque rhoncus, justo ac consequat rhoncus, magna tortor hendrerit erat, sed fringilla mi diam ut neque. Donec ultrices sapien in turpis vehicula non fermentum ante adipiscing. Nullam aliquet justo in enim dapibus cursus. Ut arcu metus, varius ac interdum in, adipiscing vel urna. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec eu mollis urna.\r\nPellentesque lobortis, enim eu adipiscing pulvinar, odio risus lacinia nisi, mollis lacinia metus turpis in arcu. Sed rhoncus venenatis massa. Cras rhoncus justo a libero porttitor quis tincidunt lorem accumsan. Suspendisse quis risus arcu. Proin sagittis dignissim fermentum. Quisque sit amet orci sit amet nisl lobortis varius eu ut nisi. Maecenas ullamcorper libero vitae ante bibendum sit amet scelerisque orci malesuada. Praesent ultrices vulputate leo, at egestas purus vulputate in. ', '', 1, 'Home', ''),
(2, 0, 1, 0, 'About Us', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas scelerisque mattis est, a consectetur dolor suscipit quis. Vestibulum mi nulla, vestibulum ac vestibulum eget, sollicitudin nec erat. Nunc nec turpis vel turpis dapibus blandit a et nisi. Proin non posuere ligula. Morbi vitae erat eu tellus feugiat dictum non vel dui.\r\nQuisque fringilla molestie justo eget placerat. Etiam tristique, leo in bibendum consequat, nunc arcu lobortis dui, vitae adipiscing justo ipsum ac velit. Etiam non ipsum ipsum, ut varius eros. Duis porta leo vitae eros iaculis condimentum. Integer ut dui id nisi malesuada dignissim.', 'about', 1, 'About', ''),
(3, 0, 1, 0, 'Categories', '', 'cat', 1, 'Shop', '/cat'),
(4, 0, 1, 0, 'Contact Us', '<p>Want to get in contact with us, then please send an email to <a href="mailto:cdtreeks@gmail.com" target="_blank">cdtreeks@gmail.com</a></p>\n<p>Aran Reeks<br />\nCTO FastCommerce</p>', 'contact-us', 1, 'Contact', '');

-- --------------------------------------------------------

--
-- Table structure for table `prod`
--

DROP TABLE IF EXISTS `prod`;
CREATE TABLE IF NOT EXISTS `prod` (
  `pid` int(5) NOT NULL AUTO_INCREMENT,
  `live` tinyint(1) NOT NULL,
  `deleted` tinyint(1) NOT NULL,
  `created` datetime NOT NULL,
  `ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `title` varchar(200) NOT NULL,
  `fn` varchar(200) NOT NULL,
  `price` decimal(10,4) NOT NULL,
  `body` text NOT NULL,
  `stock` int(5) NOT NULL,
  `vimeo_url` varchar(255) NOT NULL,
  PRIMARY KEY (`pid`),
  KEY `live` (`live`,`deleted`),
  KEY `fn` (`fn`),
  KEY `deleted` (`deleted`),
  KEY `stock` (`stock`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `prod`
--

INSERT INTO `prod` (`pid`, `live`, `deleted`, `created`, `ts`, `title`, `fn`, `price`, `body`, `stock`, `vimeo_url`) VALUES
(1, 1, 0, '2013-06-08 00:00:00', '2013-06-09 15:01:40', 'Example Product 1', 'example-product-1', '19.9900', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas scelerisque mattis est, a consectetur dolor suscipit quis. Vestibulum mi nulla, vestibulum ac vestibulum eget, sollicitudin nec erat. Nunc nec turpis vel turpis dapibus blandit a et nisi. Proin non posuere ligula. Morbi vitae erat eu tellus feugiat dictum non vel dui.\r\nQuisque fringilla molestie justo eget placerat. Etiam tristique, leo in bibendum consequat, nunc arcu lobortis dui, vitae adipiscing justo ipsum ac velit. Etiam non ipsum ipsum, ut varius eros. Duis porta leo vitae eros iaculis condimentum. Integer ut dui id nisi malesuada dignissim.\r\nClass aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Ut eu sollicitudin nisi. Nulla tortor ipsum, ornare id lobortis sed, vehicula egestas ligula. Vivamus dignissim augue ac ipsum commodo vestibulum. Fusce iaculis risus ut quam adipiscing lobortis. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec consectetur, orci quis consequat volutpat, ante nisl hendrerit purus, at hendrerit mi ipsum ut nibh. In pulvinar ullamcorper ligula, non fringilla nulla venenatis eu. Suspendisse mauris ligula, ultrices nec rhoncus sed, commodo ut justo.\r\nDonec tincidunt ornare diam quis vestibulum. Sed sodales volutpat massa, sed ullamcorper est feugiat feugiat. Sed convallis, nisl eget adipiscing iaculis, mauris mi laoreet eros, sed imperdiet sapien felis ut odio. Etiam in tincidunt lectus. Aliquam facilisis interdum tortor, et dictum lacus vestibulum in. Pellentesque rhoncus, justo ac consequat rhoncus, magna tortor hendrerit erat, sed fringilla mi diam ut neque. Donec ultrices sapien in turpis vehicula non fermentum ante adipiscing. Nullam aliquet justo in enim dapibus cursus. Ut arcu metus, varius ac interdum in, adipiscing vel urna. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec eu mollis urna.\r\nPellentesque lobortis, enim eu adipiscing pulvinar, odio risus lacinia nisi, mollis lacinia metus turpis in arcu. Sed rhoncus venenatis massa. Cras rhoncus justo a libero porttitor quis tincidunt lorem accumsan. Suspendisse quis risus arcu. Proin sagittis dignissim fermentum. Quisque sit amet orci sit amet nisl lobortis varius eu ut nisi. Maecenas ullamcorper libero vitae ante bibendum sit amet scelerisque orci malesuada. Praesent ultrices vulputate leo, at egestas purus vulputate in. ', 5, ''),
(2, 1, 0, '2013-06-09 00:00:00', '2013-06-09 15:01:43', 'Example Product 2', 'example-product-2', '55.9500', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas scelerisque mattis est, a consectetur dolor suscipit quis. Vestibulum mi nulla, vestibulum ac vestibulum eget, sollicitudin nec erat. Nunc nec turpis vel turpis dapibus blandit a et nisi. Proin non posuere ligula. Morbi vitae erat eu tellus feugiat dictum non vel dui.\r\nQuisque fringilla molestie justo eget placerat. Etiam tristique, leo in bibendum consequat, nunc arcu lobortis dui, vitae adipiscing justo ipsum ac velit. Etiam non ipsum ipsum, ut varius eros. Duis porta leo vitae eros iaculis condimentum. Integer ut dui id nisi malesuada dignissim.', 0, 'http://player.vimeo.com/video/22439234');

-- --------------------------------------------------------

--
-- Table structure for table `prod_link_cat`
--

DROP TABLE IF EXISTS `prod_link_cat`;
CREATE TABLE IF NOT EXISTS `prod_link_cat` (
  `link_id` int(5) NOT NULL AUTO_INCREMENT,
  `pid` int(5) NOT NULL,
  `link_cid` int(5) NOT NULL,
  `position` int(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`link_id`),
  KEY `pid` (`pid`,`link_cid`),
  KEY `link_cid` (`link_cid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `prod_link_cat`
--

INSERT INTO `prod_link_cat` (`link_id`, `pid`, `link_cid`, `position`) VALUES
(1, 1, 7, 1),
(2, 2, 7, 2);

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

DROP TABLE IF EXISTS `setting`;
CREATE TABLE IF NOT EXISTS `setting` (
  `key` varchar(30) NOT NULL,
  `value` varchar(255) NOT NULL,
  UNIQUE KEY `key` (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`key`, `value`) VALUES
('site_email', 'cdtreeks@gmail.com'),
('site_name', 'Ecommerce Site'),
('theme', 'buyshop');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cms_module`
--
ALTER TABLE `cms_module`
ADD CONSTRAINT `cms_module_ibfk_1` FOREIGN KEY (`mgid`) REFERENCES `cms_module_group` (`mgid`) ON UPDATE NO ACTION;

--
-- Constraints for table `prod_link_cat`
--
ALTER TABLE `prod_link_cat`
ADD CONSTRAINT `prod_link_cat_ibfk_1` FOREIGN KEY (`pid`) REFERENCES `prod` (`pid`) ON DELETE CASCADE ON UPDATE NO ACTION,
ADD CONSTRAINT `prod_link_cat_ibfk_2` FOREIGN KEY (`link_cid`) REFERENCES `cat` (`cid`) ON DELETE CASCADE ON UPDATE NO ACTION;
SET FOREIGN_KEY_CHECKS=1;
