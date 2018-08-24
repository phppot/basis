-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 27, 2018 at 02:10 PM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `basis`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_activity`
--

CREATE TABLE IF NOT EXISTS `tbl_activity` (
`id` int(11) NOT NULL,
  `member_type` varchar(100) NOT NULL,
  `member_id` int(11) NOT NULL,
  `activity` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `referer` varchar(255) NOT NULL,
  `host` varchar(255) NOT NULL,
  `user_agent` varchar(255) NOT NULL,
  `session_id` varchar(255) NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=5679 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_app_property`
--

CREATE TABLE IF NOT EXISTS `tbl_app_property` (
`id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `is_fb_login` int(11) NOT NULL,
  `is_welcome_email` int(11) NOT NULL,
  `is_recaptcha` int(11) NOT NULL,
  `is_activity_log` int(11) NOT NULL,
  `default_role` int(11) NOT NULL,
  `disable_signup` int(11) NOT NULL,
  `reset_token_life` int(11) NOT NULL,
  `notify_admin_signup` int(11) NOT NULL,
  `logo_url` varchar(255) NOT NULL,
  `smtp_email_username` varchar(255) NOT NULL,
  `smtp_email_password` varchar(255) NOT NULL,
  `smtp_host` varchar(255) NOT NULL,
  `smtp_port` varchar(255) NOT NULL,
  `mailer` varchar(255) NOT NULL,
  `smtp_secure` varchar(255) NOT NULL,
  `sender_name` varchar(255) NOT NULL,
  `sender_email` varchar(255) NOT NULL,
  `recipient_email` varchar(255) NOT NULL,
  `app_id` bigint(20) NOT NULL,
  `app_secret` varchar(255) NOT NULL,
  `site_key` varchar(255) NOT NULL,
  `secret_key` varchar(255) NOT NULL,
  `limit_per_page` varchar(255) NOT NULL,
  `support_email` varchar(255) NOT NULL,
  `admin_email` varchar(255) NOT NULL,
  `smtp_auth` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=112 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_member`
--

CREATE TABLE IF NOT EXISTS `tbl_member` (
`id` int(8) NOT NULL,
  `facebook_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(200) CHARACTER SET latin1 NOT NULL,
  `role` int(8) NOT NULL,
  `member_name` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `zip` varchar(20) NOT NULL,
  `phone` varchar(255) CHARACTER SET latin1 NOT NULL,
  `city` varchar(100) NOT NULL,
  `state` varchar(100) NOT NULL,
  `country` varchar(255) NOT NULL,
  `email` varchar(255) CHARACTER SET latin1 NOT NULL,
  `member_slug` varchar(155) NOT NULL,
  `signup_type` varchar(100) NOT NULL,
  `create_at` timestamp NULL DEFAULT NULL,
  `edit_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=197 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_member_validate`
--

CREATE TABLE IF NOT EXISTS `tbl_member_validate` (
`id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `reset_token` varchar(255) NOT NULL,
  `is_valid` int(11) NOT NULL,
  `create_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_role`
--

CREATE TABLE IF NOT EXISTS `tbl_role` (
`id` int(11) NOT NULL,
  `role` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_role_privilege`
--

CREATE TABLE IF NOT EXISTS `tbl_role_privilege` (
`id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `menu_id` int(8) NOT NULL,
  `privileges` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=278 DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_activity`
--
ALTER TABLE `tbl_activity`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_app_property`
--
ALTER TABLE `tbl_app_property`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_member`
--
ALTER TABLE `tbl_member`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `username_uni` (`username`), ADD UNIQUE KEY `member_slug_uni` (`member_slug`), ADD KEY `tbl_member_role` (`role`);

--
-- Indexes for table `tbl_member_validate`
--
ALTER TABLE `tbl_member_validate`
 ADD PRIMARY KEY (`id`), ADD KEY `membe_forgot_rel` (`member_id`);

--
-- Indexes for table `tbl_role`
--
ALTER TABLE `tbl_role`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_role_privilege`
--
ALTER TABLE `tbl_role_privilege`
 ADD PRIMARY KEY (`id`), ADD KEY `role_task_rel` (`role_id`) COMMENT 'INDEX';

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_activity`
--
ALTER TABLE `tbl_activity`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5679;
--
-- AUTO_INCREMENT for table `tbl_app_property`
--
ALTER TABLE `tbl_app_property`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=112;
--
-- AUTO_INCREMENT for table `tbl_member`
--
ALTER TABLE `tbl_member`
MODIFY `id` int(8) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=197;
--
-- AUTO_INCREMENT for table `tbl_member_validate`
--
ALTER TABLE `tbl_member_validate`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `tbl_role`
--
ALTER TABLE `tbl_role`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `tbl_role_privilege`
--
ALTER TABLE `tbl_role_privilege`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=278;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_member`
--
ALTER TABLE `tbl_member`
ADD CONSTRAINT `tbl_member_role` FOREIGN KEY (`role`) REFERENCES `tbl_role` (`id`);

--
-- Constraints for table `tbl_member_validate`
--
ALTER TABLE `tbl_member_validate`
ADD CONSTRAINT `tbl_member_validate_ibfk_1` FOREIGN KEY (`member_id`) REFERENCES `tbl_member` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_role_privilege`
--
ALTER TABLE `tbl_role_privilege`
ADD CONSTRAINT `role_task_rel` FOREIGN KEY (`role_id`) REFERENCES `tbl_role` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
