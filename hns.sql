-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Računalo: localhost
-- Vrijeme generiranja: Stu 14, 2012 u 03:10 PM
-- Verzija poslužitelja: 5.5.24-log
-- PHP verzija: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Baza podataka: `hns`
--

-- --------------------------------------------------------

--
-- Tablična struktura za tablicu `hns_actuality`
--

CREATE TABLE IF NOT EXISTS `hns_actuality` (
  `actualityId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `languageId` char(3) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lead` text COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `isPublished` tinyint(1) DEFAULT NULL,
  `publishDate` date NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`actualityId`),
  UNIQUE KEY `title` (`title`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tablična struktura za tablicu `hns_banner`
--

CREATE TABLE IF NOT EXISTS `hns_banner` (
  `bannerId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `position` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `link` text COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`bannerId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tablična struktura za tablicu `hns_bannerImage`
--

CREATE TABLE IF NOT EXISTS `hns_bannerImage` (
  `bannerId` int(10) unsigned NOT NULL,
  `filename` char(36) COLLATE utf8_unicode_ci NOT NULL,
  `width` smallint(5) unsigned NOT NULL,
  `height` smallint(5) unsigned NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`bannerId`),
  UNIQUE KEY `filename` (`filename`),
  KEY `hns_FK_bannerImageHasBanner` (`bannerId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Tablična struktura za tablicu `hns_gallery`
--

CREATE TABLE IF NOT EXISTS `hns_gallery` (
  `galleryId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`galleryId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tablična struktura za tablicu `hns_galleryI18n`
--

CREATE TABLE IF NOT EXISTS `hns_galleryI18n` (
  `galleryId` int(10) unsigned NOT NULL,
  `languageId` char(3) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `category` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`galleryId`,`languageId`),
  KEY `hns_FK_galleryI18nHasGallery` (`galleryId`),
  KEY `hns_FK_galleryI18nHasLanguage` (`languageId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Tablična struktura za tablicu `hns_galleryImage`
--

CREATE TABLE IF NOT EXISTS `hns_galleryImage` (
  `imageId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `galleryId` int(10) unsigned NOT NULL,
  `position` int(10) unsigned NOT NULL,
  `filename` char(36) COLLATE utf8_unicode_ci NOT NULL,
  `width` smallint(5) unsigned NOT NULL,
  `height` smallint(5) unsigned NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`imageId`),
  UNIQUE KEY `filename` (`filename`),
  UNIQUE KEY `galleryImage` (`galleryId`,`imageId`),
  KEY `hns_FK_galleryImageHasGallery` (`galleryId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tablična struktura za tablicu `hns_language`
--

CREATE TABLE IF NOT EXISTS `hns_language` (
  `languageId` char(3) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `code2` char(2) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`languageId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Izbacivanje podataka za tablicu `hns_language`
--

INSERT INTO `hns_language` (`languageId`, `name`, `code2`) VALUES
('deu', 'Deutsch', 'de'),
('eng', 'English', 'en'),
('hrv', 'Hrvatski', 'hr');

-- --------------------------------------------------------

--
-- Tablična struktura za tablicu `hns_newsItem`
--

CREATE TABLE IF NOT EXISTS `hns_newsItem` (
  `newsItemId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `languageId` char(3) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lead` text COLLATE utf8_unicode_ci,
  `content` text COLLATE utf8_unicode_ci,
  `isPublished` tinyint(1) DEFAULT NULL,
  `publishDate` date NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`newsItemId`),
  UNIQUE KEY `title` (`title`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tablična struktura za tablicu `hns_page`
--

CREATE TABLE IF NOT EXISTS `hns_page` (
  `pageId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `lft` int(10) unsigned NOT NULL,
  `rgt` int(10) unsigned NOT NULL,
  `parentId` int(10) unsigned DEFAULT NULL,
  `isException` tinyint(1) DEFAULT NULL,
  `isVisible` tinyint(1) DEFAULT NULL,
  `isEditable` tinyint(1) DEFAULT NULL,
  `isPublished` tinyint(1) DEFAULT NULL,
  `canAddChildren` tinyint(1) DEFAULT NULL,
  `canBeDeleted` tinyint(1) DEFAULT NULL,
  `class` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`pageId`),
  KEY `hns_FK_pageHasPage` (`parentId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=32 ;

--
-- Izbacivanje podataka za tablicu `hns_page`
--

INSERT INTO `hns_page` (`pageId`, `lft`, `rgt`, `parentId`, `isException`, `isVisible`, `isEditable`, `isPublished`, `canAddChildren`, `canBeDeleted`, `class`, `created`, `modified`) VALUES
(1, 1, 60, NULL, 1, 0, 0, 1, 1, 0, NULL, '2012-11-14 14:47:33', NULL),
(2, 2, 17, 1, 1, 1, 1, 1, 1, 0, 'hns', '2012-11-14 15:08:19', '2012-11-14 15:08:19'),
(3, 18, 29, 1, 1, 1, 1, 1, 1, 0, 'selection', '2012-11-14 15:10:07', '2012-11-14 15:10:07'),
(4, 30, 43, 1, 1, 1, 1, 1, 1, 0, 'competitions', '2012-11-14 15:11:09', '2012-11-14 15:26:41'),
(5, 44, 57, 1, 1, 1, 0, 1, 1, 0, 'infocenter', '2012-11-14 15:12:12', '2012-11-14 15:12:12'),
(6, 58, 59, 1, 1, 1, 0, 1, 1, 0, 'press', '2012-11-14 15:13:00', '2012-11-14 15:13:00'),
(7, 3, 4, 2, 0, 1, 1, 1, 0, 1, NULL, '2012-11-14 15:14:49', '2012-11-14 16:07:43'),
(8, 5, 6, 2, 0, 1, 1, 1, 1, 1, NULL, '2012-11-14 15:16:12', '2012-11-14 15:16:12'),
(9, 7, 8, 2, 0, 1, 1, 1, 1, 1, NULL, '2012-11-14 15:17:24', '2012-11-14 15:17:24'),
(10, 9, 10, 2, 0, 1, 1, 1, 1, 1, NULL, '2012-11-14 15:18:25', '2012-11-14 15:18:25'),
(11, 11, 12, 2, 0, 1, 1, 1, 1, 1, NULL, '2012-11-14 15:19:45', '2012-11-14 15:19:45'),
(12, 13, 14, 2, 0, 1, 1, 1, 1, 1, NULL, '2012-11-14 15:20:41', '2012-11-14 15:20:41'),
(13, 15, 16, 2, 1, 1, 1, 1, 1, 0, 'contact', '2012-11-14 15:21:23', '2012-11-14 15:21:23'),
(14, 19, 20, 3, 0, 1, 1, 1, 1, 1, NULL, '2012-11-14 15:22:36', '2012-11-14 15:22:36'),
(15, 21, 22, 3, 0, 1, 1, 1, 1, 1, NULL, '2012-11-14 15:23:11', '2012-11-14 15:23:11'),
(16, 23, 24, 3, 0, 1, 1, 1, 1, 1, NULL, '2012-11-14 15:23:55', '2012-11-14 15:23:55'),
(17, 25, 26, 3, 0, 1, 1, 1, 1, 1, NULL, '2012-11-14 15:24:56', '2012-11-14 15:24:56'),
(18, 27, 28, 3, 0, 1, 1, 1, 1, 1, NULL, '2012-11-14 15:26:00', '2012-11-14 15:26:00'),
(19, 31, 32, 4, 0, 1, 1, 1, 1, 1, NULL, '2012-11-14 15:27:59', '2012-11-14 15:28:23'),
(21, 33, 34, 4, 0, 1, 1, 1, 1, 1, NULL, '2012-11-14 15:32:26', '2012-11-14 15:32:26'),
(22, 35, 36, 4, 0, 1, 1, 1, 1, 1, NULL, '2012-11-14 15:33:49', '2012-11-14 15:33:49'),
(23, 37, 38, 4, 0, 1, 1, 1, 1, 1, NULL, '2012-11-14 15:37:18', '2012-11-14 15:37:18'),
(24, 39, 40, 4, 0, 1, 1, 1, 1, 1, NULL, '2012-11-14 15:38:58', '2012-11-14 15:38:58'),
(25, 41, 42, 4, 0, 1, 1, 1, 1, 1, NULL, '2012-11-14 15:39:30', '2012-11-14 15:39:30'),
(26, 45, 46, 5, 1, 1, 0, 1, 0, 0, 'news', '2012-11-14 15:41:00', '2012-11-14 15:41:00'),
(27, 47, 48, 5, 1, 1, 0, 1, 0, 0, 'actualities', '2012-11-14 15:41:43', '2012-11-14 15:41:43'),
(28, 49, 50, 5, 1, 1, 0, 1, 0, 0, 'tv', '2012-11-14 15:42:30', '2012-11-14 15:42:30'),
(29, 51, 52, 5, 1, 0, 1, 1, 0, 0, 'gallery', '2012-11-14 15:43:01', '2012-11-14 15:43:01'),
(30, 53, 54, 5, 1, 1, 0, 1, 0, 0, 'blog', '2012-11-14 15:43:43', '2012-11-14 15:43:43'),
(31, 55, 56, 5, 1, 0, 1, 1, 0, 0, 'magazine', '2012-11-14 15:44:23', '2012-11-14 15:44:23');

-- --------------------------------------------------------

--
-- Tablična struktura za tablicu `hns_pageI18n`
--

CREATE TABLE IF NOT EXISTS `hns_pageI18n` (
  `pageId` int(10) unsigned NOT NULL,
  `languageId` char(3) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `navigationName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci,
  `lead` text COLLATE utf8_unicode_ci,
  `metaTitle` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `metaDescription` text COLLATE utf8_unicode_ci,
  `metaKeywords` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `navigationDescription` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`pageId`,`languageId`),
  UNIQUE KEY `navigationName` (`navigationName`,`languageId`),
  KEY `hns_FK_pageI18nHasPage` (`pageId`),
  KEY `hns_FK_pageI18nHasLanguage` (`languageId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Izbacivanje podataka za tablicu `hns_pageI18n`
--

INSERT INTO `hns_pageI18n` (`pageId`, `languageId`, `title`, `navigationName`, `slug`, `content`, `lead`, `metaTitle`, `metaDescription`, `metaKeywords`, `navigationDescription`, `created`, `modified`) VALUES
(1, 'eng', 'Home', 'Home', '', NULL, NULL, NULL, NULL, NULL, NULL, '2012-11-14 14:48:24', '2012-11-14 14:48:24'),
(1, 'hrv', 'Naslovnica', 'Naslovnica', '', NULL, NULL, NULL, NULL, NULL, NULL, '2012-11-14 14:48:24', '2012-11-14 14:48:24'),
(2, 'eng', 'HNS', 'HNS', 'hns', NULL, NULL, NULL, NULL, NULL, NULL, '2012-11-14 15:08:19', '2012-11-14 15:08:19'),
(2, 'hrv', 'HNS', 'HNS', 'hns', NULL, NULL, NULL, NULL, NULL, NULL, '2012-11-14 15:08:19', '2012-11-14 15:08:19'),
(3, 'eng', 'Selections', 'Selections', 'selections', NULL, NULL, NULL, NULL, NULL, NULL, '2012-11-14 15:10:07', '2012-11-14 15:10:07'),
(3, 'hrv', 'Selekcije', 'Selekcije', 'selekcije', NULL, NULL, NULL, NULL, NULL, NULL, '2012-11-14 15:10:07', '2012-11-14 15:10:07'),
(4, 'eng', 'Competitions', 'Competitions', 'competitions', NULL, NULL, NULL, NULL, NULL, NULL, '2012-11-14 15:11:09', '2012-11-14 15:26:41'),
(4, 'hrv', 'Natjecanja', 'Natjecanja', 'natjecanja', NULL, NULL, NULL, NULL, NULL, NULL, '2012-11-14 15:11:09', '2012-11-14 15:26:41'),
(5, 'eng', 'Info Center', 'Info Center', 'info-center', NULL, NULL, NULL, NULL, NULL, NULL, '2012-11-14 15:12:12', '2012-11-14 15:12:12'),
(5, 'hrv', 'Info centar', 'Info centar', 'info-centar', NULL, NULL, NULL, NULL, NULL, NULL, '2012-11-14 15:12:12', '2012-11-14 15:12:12'),
(6, 'eng', 'Press', 'Press', 'press', NULL, NULL, NULL, NULL, NULL, NULL, '2012-11-14 15:13:00', '2012-11-14 15:13:00'),
(6, 'hrv', 'Press', 'Press', 'press', NULL, NULL, NULL, NULL, NULL, NULL, '2012-11-14 15:13:00', '2012-11-14 15:13:00'),
(7, 'eng', 'About us', 'About us', 'about-us', NULL, NULL, NULL, NULL, NULL, 'Lorem ipsum dolor', '2012-11-14 15:14:49', '2012-11-14 16:07:43'),
(7, 'hrv', 'O nama', 'O nama', 'o-nama', '<p>SadrÅ¾aj ovdje...</p>', '<p>Uvodni tekst ovdje...</p>', NULL, NULL, NULL, 'Lorem ipsum dolor', '2012-11-14 15:14:49', '2012-11-14 16:07:43'),
(8, 'eng', 'Statistics', 'Statistics', 'statistics', NULL, NULL, NULL, NULL, NULL, 'Lorem <strong>ipsum</strong> dolor', '2012-11-14 15:16:12', '2012-11-14 15:16:12'),
(8, 'hrv', 'Statistike', 'Statistike', 'statistike', NULL, NULL, NULL, NULL, NULL, 'Lorem <strong>ipsum</strong> dolor', '2012-11-14 15:16:12', '2012-11-14 15:16:12'),
(9, 'eng', 'Football Academy', 'Football Academy', 'football-academy', NULL, NULL, NULL, NULL, NULL, 'Lorem ipsum dolor', '2012-11-14 15:17:24', '2012-11-14 15:17:24'),
(9, 'hrv', 'Nogometna akademija', 'Nogometna akademija', 'nogometna-akademija', NULL, NULL, NULL, NULL, NULL, 'Lorem ipsum dolor', '2012-11-14 15:17:24', '2012-11-14 15:17:24'),
(10, 'eng', 'Grassroots', 'Grassroots', 'grassroots', NULL, NULL, NULL, NULL, NULL, 'Lorem ipsum dolor', '2012-11-14 15:18:25', '2012-11-14 15:18:25'),
(10, 'hrv', 'Grassroots', 'Grassroots', 'grassroots', NULL, NULL, NULL, NULL, NULL, 'Lorem ipsum dolor', '2012-11-14 15:18:25', '2012-11-14 15:18:25'),
(11, 'eng', 'Acknowledgements', 'Acknowledgements', 'acknowledgements', NULL, NULL, NULL, NULL, NULL, 'Lorem ipsum dolor', '2012-11-14 15:19:45', '2012-11-14 15:19:45'),
(11, 'hrv', 'Priznanja', 'Priznanja', 'priznanja', NULL, NULL, NULL, NULL, NULL, 'Lorem ipsum dolor', '2012-11-14 15:19:45', '2012-11-14 15:19:45'),
(12, 'eng', 'HNS headquarters', 'HNS headquarters', 'hns-headquarters', NULL, NULL, NULL, NULL, NULL, 'Lorem ipsum dolor', '2012-11-14 15:20:41', '2012-11-14 15:20:41'),
(12, 'hrv', 'HNS srediÅ¡ta', 'HNS srediÅ¡ta', 'hns-sredista', NULL, NULL, NULL, NULL, NULL, 'Lorem ipsum dolor', '2012-11-14 15:20:41', '2012-11-14 15:20:41'),
(13, 'eng', 'Contact', 'Contact', 'contact', NULL, NULL, NULL, NULL, NULL, 'Lorem ipsum dolor', '2012-11-14 15:21:23', '2012-11-14 15:21:23'),
(13, 'hrv', 'Kontakti', 'Kontakti', 'kontakti', NULL, NULL, NULL, NULL, NULL, 'Lorem ipsum dolor', '2012-11-14 15:21:23', '2012-11-14 15:21:23'),
(14, 'eng', 'A representation', 'A representation', 'a-representation', NULL, NULL, NULL, NULL, NULL, 'Lorem ipsum dolor', '2012-11-14 15:22:36', '2012-11-14 15:22:36'),
(14, 'hrv', 'A reprezentacija', 'A reprezentacija', 'a-reprezentacija', NULL, NULL, NULL, NULL, NULL, 'Lorem ipsum dolor', '2012-11-14 15:22:36', '2012-11-14 15:22:36'),
(15, 'eng', 'U-21', 'U-21', 'u21', NULL, NULL, NULL, NULL, NULL, 'Lorem ipsum dolor', '2012-11-14 15:23:11', '2012-11-14 15:23:11'),
(15, 'hrv', 'U-21', 'U-21', 'u21', NULL, NULL, NULL, NULL, NULL, 'Lorem ipsum dolor', '2012-11-14 15:23:11', '2012-11-14 15:23:11'),
(16, 'eng', 'Football for youth', 'Footbal for youth', 'footbal-for-youth', NULL, NULL, NULL, NULL, NULL, 'Lorem ipsum dolor', '2012-11-14 15:23:55', '2012-11-14 15:23:55'),
(16, 'hrv', 'Nogomet za mladeÅ¾', 'Nogomet za mladeÅ¾', 'nogomet-za-mladez', NULL, NULL, NULL, NULL, NULL, 'Lorem ipsum dolor', '2012-11-14 15:23:55', '2012-11-14 15:23:55'),
(17, 'eng', 'Women Football', 'Women Football', 'women-football', NULL, NULL, NULL, NULL, NULL, 'Lorem ipsum dolor', '2012-11-14 15:24:56', '2012-11-14 15:24:56'),
(17, 'hrv', 'Å½enski nogomet', 'Å½enski nogomet', 'zenski-nogomet', NULL, NULL, NULL, NULL, NULL, 'Lorem ipsum dolor', '2012-11-14 15:24:56', '2012-11-14 15:24:56'),
(18, 'eng', 'Indoors Football', 'Indoors Football', 'indoors-football', NULL, NULL, NULL, NULL, NULL, 'Lorem ipsum dolor', '2012-11-14 15:26:00', '2012-11-14 15:26:00'),
(18, 'hrv', 'Mali nogomet', 'Mali nogomet', 'mali-nogomet', NULL, NULL, NULL, NULL, NULL, 'Lorem ipsum dolor', '2012-11-14 15:26:00', '2012-11-14 15:26:00'),
(19, 'eng', '1st CFL', '1st CFL', '1st-cfl', NULL, NULL, NULL, NULL, NULL, 'Lorem ipsum dolor', '2012-11-14 15:27:59', '2012-11-14 15:28:23'),
(19, 'hrv', '1. HNL', '1. HNL', '1-hnl', NULL, NULL, NULL, NULL, NULL, 'Lorem ipsum dolor', '2012-11-14 15:27:59', '2012-11-14 15:28:23'),
(21, 'eng', '2nd CFL', '2nd CFL', '2nd-cfl', NULL, NULL, NULL, NULL, NULL, 'Lorem ipsum dolor', '2012-11-14 15:32:26', '2012-11-14 15:32:26'),
(21, 'hrv', '2. HNL', '2. HNL', '2-hnl', NULL, NULL, NULL, NULL, NULL, 'Lorem ipsum dolor', '2012-11-14 15:32:26', '2012-11-14 15:32:26'),
(22, 'eng', 'Regional Alliances', 'Regional Alliances', 'regional-alliances', NULL, NULL, NULL, NULL, NULL, 'Lorem ipsum dolor', '2012-11-14 15:33:49', '2012-11-14 15:33:49'),
(22, 'hrv', 'Å½upanijski savezi', 'Å½upanijski savezi', 'zupanijski-savezi', NULL, NULL, NULL, NULL, NULL, 'Lorem ipsum dolor', '2012-11-14 15:33:49', '2012-11-14 15:33:49'),
(23, 'eng', 'Club Licencing', 'Club Licencing', 'club-licencing', NULL, NULL, NULL, NULL, NULL, 'Lorem ipsum dolor', '2012-11-14 15:37:18', '2012-11-14 15:37:18'),
(23, 'hrv', 'Licenciranje klubova', 'Licenciranje klubova', 'licenciranje-klubova', NULL, NULL, NULL, NULL, NULL, 'Lorem ipsum dolor', '2012-11-14 15:37:18', '2012-11-14 15:37:18'),
(24, 'eng', 'Player Licencing', 'Player Licencing', 'player-licencing', NULL, NULL, NULL, NULL, NULL, 'Lorem ipsum dolor', '2012-11-14 15:38:58', '2012-11-14 15:38:58'),
(24, 'hrv', 'Licenciranje igraÄa', 'Licenciranje igraÄa', 'licenciranje-igraca', NULL, NULL, NULL, NULL, NULL, 'Lorem ipsum dolor', '2012-11-14 15:38:58', '2012-11-14 15:38:58'),
(25, 'eng', 'Regulations', 'Regulations', 'regulations', NULL, NULL, NULL, NULL, NULL, 'Lorem ipsum dolor', '2012-11-14 15:39:30', '2012-11-14 15:39:30'),
(25, 'hrv', 'Propisi', 'Propisi', 'propisi', NULL, NULL, NULL, NULL, NULL, 'Lorem ipsum dolor', '2012-11-14 15:39:30', '2012-11-14 15:39:30'),
(26, 'eng', 'News', 'News', 'news', NULL, NULL, NULL, NULL, NULL, 'Lorem ipsum dolor', '2012-11-14 15:41:00', '2012-11-14 15:41:00'),
(26, 'hrv', 'Novosti', 'Novosti', 'novosti', NULL, NULL, NULL, NULL, NULL, 'Lorem ipsum dolor', '2012-11-14 15:41:00', '2012-11-14 15:41:00'),
(27, 'eng', 'Actualities', 'Actualities', 'actualities', NULL, NULL, NULL, NULL, NULL, 'Lorem ipsum dolor', '2012-11-14 15:41:43', '2012-11-14 15:41:43'),
(27, 'hrv', 'Aktualnosti', 'Aktualnosti', 'aktualnosti', NULL, NULL, NULL, NULL, NULL, 'Lorem ipsum dolor', '2012-11-14 15:41:43', '2012-11-14 15:41:43'),
(28, 'eng', 'CFF TV', 'CFF TV', 'cff-tv', NULL, NULL, NULL, NULL, NULL, 'Lorem ipsum dolor', '2012-11-14 15:42:30', '2012-11-14 15:42:30'),
(28, 'hrv', 'HNS TV', 'HNS TV', 'hns-tv', NULL, NULL, NULL, NULL, NULL, 'Lorem ipsum dolor', '2012-11-14 15:42:30', '2012-11-14 15:42:30'),
(29, 'eng', 'Gallery', 'Gallery', 'gallery', NULL, NULL, NULL, NULL, NULL, 'Lorem ipsum dolor', '2012-11-14 15:43:01', '2012-11-14 15:43:01'),
(29, 'hrv', 'Galerija', 'Galerija', 'galerija', NULL, NULL, NULL, NULL, NULL, 'Lorem ipsum dolor', '2012-11-14 15:43:01', '2012-11-14 15:43:01'),
(30, 'eng', 'Blog', 'Blog', 'blog', NULL, NULL, NULL, NULL, NULL, 'Lorem ipsum dolor', '2012-11-14 15:43:43', '2012-11-14 15:43:43'),
(30, 'hrv', 'Blog', 'Blog', 'blog', NULL, NULL, NULL, NULL, NULL, 'Lorem ipsum dolor', '2012-11-14 15:43:43', '2012-11-14 15:43:43'),
(31, 'eng', 'CFF Magazine', 'CFF Magazine', 'cff-magazine', NULL, NULL, NULL, NULL, NULL, 'Lorem ipsum dolor', '2012-11-14 15:44:23', '2012-11-14 15:44:23'),
(31, 'hrv', 'HNS ÄŒasopis', 'HNS ÄŒasopis', 'hns-casopis', NULL, NULL, NULL, NULL, NULL, 'Lorem ipsum dolor', '2012-11-14 15:44:23', '2012-11-14 15:44:23');

-- --------------------------------------------------------

--
-- Tablična struktura za tablicu `hns_user`
--

CREATE TABLE IF NOT EXISTS `hns_user` (
  `userId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` char(32) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`userId`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Izbacivanje podataka za tablicu `hns_user`
--

INSERT INTO `hns_user` (`userId`, `username`, `slug`, `password`, `created`, `modified`) VALUES
(1, 'fiktiv', '', '5cff90e3fd8e26e008af629b5a081493', '2012-11-14 14:38:47', NULL);

-- --------------------------------------------------------

--
-- Tablična struktura za tablicu `hns_userHasUserRole`
--

CREATE TABLE IF NOT EXISTS `hns_userHasUserRole` (
  `userId` int(10) unsigned NOT NULL,
  `userRoleId` int(10) unsigned NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`userId`,`userRoleId`),
  KEY `hns_FK_userHasUserRoleHasUser` (`userId`),
  KEY `hns_FK_userHasUserRoleHasUserRole` (`userRoleId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Izbacivanje podataka za tablicu `hns_userHasUserRole`
--

INSERT INTO `hns_userHasUserRole` (`userId`, `userRoleId`, `created`) VALUES
(1, 1, '2012-11-14 14:38:47');

-- --------------------------------------------------------

--
-- Tablična struktura za tablicu `hns_userRole`
--

CREATE TABLE IF NOT EXISTS `hns_userRole` (
  `userRoleId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`userRoleId`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Izbacivanje podataka za tablicu `hns_userRole`
--

INSERT INTO `hns_userRole` (`userRoleId`, `name`, `slug`, `created`, `modified`) VALUES
(1, 'admin', '', '2012-11-14 14:38:47', NULL),
(2, 'user', '', '2012-11-14 14:38:47', NULL);

-- --------------------------------------------------------

--
-- Tablična struktura za tablicu `hns_video`
--

CREATE TABLE IF NOT EXISTS `hns_video` (
  `videoId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `youtubeUrl` text COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`videoId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tablična struktura za tablicu `hns_videoI18n`
--

CREATE TABLE IF NOT EXISTS `hns_videoI18n` (
  `videoId` int(10) unsigned NOT NULL,
  `languageId` char(3) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `category` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`videoId`,`languageId`),
  KEY `hns_FK_videoI18nHasVideo` (`videoId`),
  KEY `hns_FK_videoI18nHasLanguage` (`languageId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Unutarnja struktura za pregledavanje `hns_vw_gallery`
--
CREATE TABLE IF NOT EXISTS `hns_vw_gallery` (
`galleryId` int(10) unsigned
,`languageId` char(3)
,`title` varchar(255)
,`slug` varchar(255)
,`category` varchar(100)
,`created` datetime
,`modified` datetime
);
-- --------------------------------------------------------

--
-- Unutarnja struktura za pregledavanje `hns_vw_pagetree`
--
CREATE TABLE IF NOT EXISTS `hns_vw_pagetree` (
`pageId` int(10) unsigned
,`lft` int(10) unsigned
,`rgt` int(10) unsigned
,`parentId` int(10) unsigned
,`languageId` char(3)
,`depth` bigint(22)
,`fullUri` text
,`title` varchar(255)
,`navigationName` varchar(255)
,`slug` varchar(255)
,`content` text
,`lead` text
,`metaTitle` varchar(255)
,`metaDescription` text
,`metaKeywords` varchar(255)
,`isException` tinyint(1)
,`isVisible` tinyint(1)
,`isEditable` tinyint(1)
,`isPublished` tinyint(1)
,`canAddChildren` tinyint(1)
,`canBeDeleted` tinyint(1)
,`class` varchar(255)
,`navigationDescription` varchar(100)
,`created` datetime
,`modified` datetime
);
-- --------------------------------------------------------

--
-- Unutarnja struktura za pregledavanje `hns_vw_video`
--
CREATE TABLE IF NOT EXISTS `hns_vw_video` (
`videoId` int(10) unsigned
,`languageId` char(3)
,`title` varchar(255)
,`slug` varchar(255)
,`category` varchar(100)
,`youtubeUrl` text
,`created` datetime
,`modified` datetime
);
-- --------------------------------------------------------

--
-- Struktura za pregledavanje `hns_vw_gallery`
--
DROP TABLE IF EXISTS `hns_vw_gallery`;

CREATE VIEW `hns_vw_gallery` AS select `gallery`.`galleryId` AS `galleryId`,`galleryi18n`.`languageId` AS `languageId`,`galleryi18n`.`title` AS `title`,`galleryi18n`.`slug` AS `slug`,`galleryi18n`.`category` AS `category`,`gallery`.`created` AS `created`,`gallery`.`modified` AS `modified` from (`hns_gallery` `gallery` join `hns_galleryI18n` `galleryi18n` on((`gallery`.`galleryId` = `galleryi18n`.`galleryId`)));

-- --------------------------------------------------------

--
-- Struktura za pregledavanje `hns_vw_pagetree`
--
DROP TABLE IF EXISTS `hns_vw_pagetree`;

CREATE VIEW `hns_vw_pagetree` AS select `page`.`pageId` AS `pageId`,`page`.`lft` AS `lft`,`page`.`rgt` AS `rgt`,`page`.`parentId` AS `parentId`,`pagei18n`.`languageId` AS `languageId`,(count(distinct `parent`.`pageId`) - 1) AS `depth`,group_concat(distinct `parenti18n`.`slug` separator '/') AS `fullUri`,`pagei18n`.`title` AS `title`,`pagei18n`.`navigationName` AS `navigationName`,`pagei18n`.`slug` AS `slug`,`pagei18n`.`content` AS `content`,`pagei18n`.`lead` AS `lead`,`pagei18n`.`metaTitle` AS `metaTitle`,`pagei18n`.`metaDescription` AS `metaDescription`,`pagei18n`.`metaKeywords` AS `metaKeywords`,`page`.`isException` AS `isException`,`page`.`isVisible` AS `isVisible`,`page`.`isEditable` AS `isEditable`,`page`.`isPublished` AS `isPublished`,`page`.`canAddChildren` AS `canAddChildren`,`page`.`canBeDeleted` AS `canBeDeleted`,`page`.`class` AS `class`,`pagei18n`.`navigationDescription` AS `navigationDescription`,`page`.`created` AS `created`,`page`.`modified` AS `modified` from ((((((`hns_page` `page` left join `hns_pageI18n` `pagei18n` on((`page`.`pageId` = `pagei18n`.`pageId`))) join `hns_language` `language` on((`pagei18n`.`languageId` = `language`.`languageId`))) left join `hns_page` `parentpage` on((`parentpage`.`pageId` = `page`.`parentId`))) join `hns_page` `parent`) left join `hns_pageI18n` `parenti18n` on(((`parent`.`pageId` = `parenti18n`.`pageId`) and (`parenti18n`.`languageId` = `pagei18n`.`languageId`)))) left join `hns_pageI18n` `parentpagei18n` on(((`page`.`parentId` = `parentpagei18n`.`pageId`) and (`parentpagei18n`.`languageId` = `pagei18n`.`languageId`)))) where (`page`.`lft` between `parent`.`lft` and `parent`.`rgt`) group by `page`.`pageId`,`language`.`languageId` order by `page`.`lft`;

-- --------------------------------------------------------

--
-- Struktura za pregledavanje `hns_vw_video`
--
DROP TABLE IF EXISTS `hns_vw_video`;

CREATE VIEW `hns_vw_video` AS select `video`.`videoId` AS `videoId`,`videoi18n`.`languageId` AS `languageId`,`videoi18n`.`title` AS `title`,`videoi18n`.`slug` AS `slug`,`videoi18n`.`category` AS `category`,`video`.`youtubeUrl` AS `youtubeUrl`,`video`.`created` AS `created`,`video`.`modified` AS `modified` from (`hns_video` `video` join `hns_videoI18n` `videoi18n` on((`video`.`videoId` = `videoi18n`.`videoId`)));

--
-- Ograničenja za izbačene tablice
--

--
-- Ograničenja za tablicu `hns_bannerImage`
--
ALTER TABLE `hns_bannerImage`
  ADD CONSTRAINT `hns_bannerImage_ibfk_1` FOREIGN KEY (`bannerId`) REFERENCES `hns_banner` (`bannerId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograničenja za tablicu `hns_galleryI18n`
--
ALTER TABLE `hns_galleryI18n`
  ADD CONSTRAINT `hns_galleryI18n_ibfk_2` FOREIGN KEY (`languageId`) REFERENCES `hns_language` (`languageId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `hns_galleryI18n_ibfk_1` FOREIGN KEY (`galleryId`) REFERENCES `hns_gallery` (`galleryId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograničenja za tablicu `hns_galleryImage`
--
ALTER TABLE `hns_galleryImage`
  ADD CONSTRAINT `hns_galleryImage_ibfk_1` FOREIGN KEY (`galleryId`) REFERENCES `hns_gallery` (`galleryId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograničenja za tablicu `hns_page`
--
ALTER TABLE `hns_page`
  ADD CONSTRAINT `hns_page_ibfk_1` FOREIGN KEY (`parentId`) REFERENCES `hns_page` (`pageId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograničenja za tablicu `hns_pageI18n`
--
ALTER TABLE `hns_pageI18n`
  ADD CONSTRAINT `hns_pageI18n_ibfk_2` FOREIGN KEY (`languageId`) REFERENCES `hns_language` (`languageId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `hns_pageI18n_ibfk_1` FOREIGN KEY (`pageId`) REFERENCES `hns_page` (`pageId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograničenja za tablicu `hns_userHasUserRole`
--
ALTER TABLE `hns_userHasUserRole`
  ADD CONSTRAINT `hns_userHasUserRole_ibfk_2` FOREIGN KEY (`userRoleId`) REFERENCES `hns_userRole` (`userRoleId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `hns_userHasUserRole_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `hns_user` (`userId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograničenja za tablicu `hns_videoI18n`
--
ALTER TABLE `hns_videoI18n`
  ADD CONSTRAINT `hns_videoI18n_ibfk_2` FOREIGN KEY (`languageId`) REFERENCES `hns_language` (`languageId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `hns_videoI18n_ibfk_1` FOREIGN KEY (`videoId`) REFERENCES `hns_video` (`videoId`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
