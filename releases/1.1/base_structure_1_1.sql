-- phpMyAdmin SQL Dump
-- version 3.5.8.1
-- http://www.phpmyadmin.net
--
-- Host: ibiteria.com.mysql:3306
-- Generation Time: Oct 07, 2015 at 08:38 PM
-- Server version: 5.5.45-MariaDB-1~wheezy
-- PHP Version: 5.3.3-7+squeeze15

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `ibiteria_com`
--
CREATE DATABASE `ibiteria_com` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `ibiteria_com`;

-- --------------------------------------------------------

--
-- Table structure for table `bn2_bn2_data`
--

DROP TABLE IF EXISTS `bn2_bn2_data`;
CREATE TABLE IF NOT EXISTS `bn2_bn2_data` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `filename_id` bigint(20) NOT NULL,
  `hashset_filename` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `filename` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content_file` blob NOT NULL,
  `isHashed` tinyint(1) NOT NULL,
  `isClear` tinyint(1) NOT NULL,
  `isCrypted` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `mime` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `isDirectory` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `bn2_bn2_password_resets`
--

DROP TABLE IF EXISTS `bn2_bn2_password_resets`;
CREATE TABLE IF NOT EXISTS `bn2_bn2_password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  KEY `bn2_password_resets_email_index` (`email`),
  KEY `bn2_password_resets_token_index` (`token`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bn2_bn2_users`
--

DROP TABLE IF EXISTS `bn2_bn2_users`;
CREATE TABLE IF NOT EXISTS `bn2_bn2_users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `bn2_users_email_unique` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `bn2_data`
--

DROP TABLE IF EXISTS `bn2_data`;
CREATE TABLE IF NOT EXISTS `bn2_data` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `filename_id` bigint(20) NOT NULL,
  `hashset_filename` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `filename` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content_file` blob NOT NULL,
  `isHashed` tinyint(1) NOT NULL,
  `isClear` tinyint(1) NOT NULL,
  `isCrypted` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `mime` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `isDirectory` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `bn2_filesdata`
--

DROP TABLE IF EXISTS `bn2_filesdata`;
CREATE TABLE IF NOT EXISTS `bn2_filesdata` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `filename_id` int(11) DEFAULT NULL,
  `hachset_filename` varchar(1024) DEFAULT NULL,
  `hash_key` varchar(2048) DEFAULT NULL,
  `filename` varchar(1024) DEFAULT NULL,
  `folder_id` int(11) DEFAULT NULL,
  `content_file` longblob,
  `isHach` tinyint(1) DEFAULT '1',
  `isClear` tinyint(1) DEFAULT '1',
  `isCrypted` tinyint(1) DEFAULT '0',
  `username` varchar(1024) NOT NULL,
  `mime` varchar(1024) NOT NULL,
  `isDirectory` int(11) NOT NULL DEFAULT '0',
  `quand` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `quandNouveau` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `isRoot` tinyint(1) NOT NULL,
  `isDeleted` int(11) NOT NULL DEFAULT '0',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=388 ;

--
-- Triggers `bn2_filesdata`
--
DROP TRIGGER IF EXISTS `creation_date_data_table`;
DELIMITER //
CREATE TRIGGER `creation_date_data_table` BEFORE INSERT ON `bn2_filesdata`
 FOR EACH ROW SET NEW.quand = now()
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `bn2_lien`
--

DROP TABLE IF EXISTS `bn2_lien`;
CREATE TABLE IF NOT EXISTS `bn2_lien` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `note_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `linked_note_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `lien_user_id_foreign` (`user_id`),
  KEY `lien_note_id_foreign` (`note_id`),
  KEY `linked_note_id` (`linked_note_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=9 ;

-- --------------------------------------------------------

--
-- Table structure for table `bn2_migrations`
--

DROP TABLE IF EXISTS `bn2_migrations`;
CREATE TABLE IF NOT EXISTS `bn2_migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bn2_password_resets`
--

DROP TABLE IF EXISTS `bn2_password_resets`;
CREATE TABLE IF NOT EXISTS `bn2_password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  KEY `bn2_password_resets_email_index` (`email`),
  KEY `bn2_password_resets_token_index` (`token`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bn2_share`
--

DROP TABLE IF EXISTS `bn2_share`;
CREATE TABLE IF NOT EXISTS `bn2_share` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `note_id` int(11) NOT NULL,
  `username` varchar(500) NOT NULL,
  `public` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `note_id` (`note_id`,`username`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `bn2_users`
--

DROP TABLE IF EXISTS `bn2_users`;
CREATE TABLE IF NOT EXISTS `bn2_users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `bn2_users_email_unique` (`email`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;
