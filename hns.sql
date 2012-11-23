-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Računalo: localhost
-- Vrijeme generiranja: Stu 23, 2012 u 02:41 PM
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Izbacivanje podataka za tablicu `hns_actuality`
--

INSERT INTO `hns_actuality` (`actualityId`, `languageId`, `title`, `slug`, `lead`, `content`, `isPublished`, `publishDate`, `created`, `modified`) VALUES
(1, 'hrv', 'Kako su igrali reprezentativci?', 'kako-su-igrali-reprezentativci', '<p>Tjedan pred reprezentativno okupljanje najvaÅ¾niji je svakom izborniku jer se tada najbolje vidi forma s kojom mu igraÄi dolaze te na koga moÅ¾e raÄunati.</p>', '<p>ProÅ¡log tjedna naÅ¡i su igraÄi bili veoma dobri te s puno optimizma moÅ¾emo gledati prema Makedoniji i Walesu. Krenimo redom.</p>\r\n<h4>\r\n	Stipe Pletikosa (Rostov)</h4>\r\n<p>Odigrao cijeli susret u gostujuÄ‡em porazu Rostova od Tereka Groznog rezultatom 2:1.</p>\r\n<h4>\r\n	Danijel SubaÅ¡iÄ‡ (Monaco)</h4>\r\n<p>Svoj prvenstveni susret protiv ChÃ¢teaurouxa Monaco igra tek danas.</p>\r\n<h4>\r\n	Dario KreÅ¡iÄ‡ (Lokomotiv Moskva)</h4>\r\n<p>Odigrao cijelu utakmicu protiv Kubana koja je zavrÅ¡ila porazom Lokomotiva od 1:0.</p>\r\n<h4>\r\n	Darijo Srna (Å ahtar)</h4>\r\n<p>Odigrao cijelu utakmicu protiv Juventusa u Ligi prvaka. ZavrÅ¡ilo je 1:1. U prvenstvenom dvoboju protiv Metalista takoÄ‘er odigrao svih 90 minuta. Shakhtar je u gostima slavio s 2:0.</p>\r\n<h4>\r\n	Vedran Ä†orluka (Lokomotiv Moskva)</h4>\r\n<p>OdraÄ‘ivao kaznu zbog nakupljenih Å¾utih kartona pa nije bio niti na klupi u utakmici protiv Kubana. Lokomotiv je na domaÄ‡em terenu poraÅ¾en s 1:0.</p>\r\n<h4>\r\n	Ivan StriniÄ‡ (Dnipro)</h4>\r\n<p>Odigrao svih 90 minuta protiv AIK-a u Europa ligi. Asistirao za drugi pogodak u susretu koji je zavrÅ¡io pobjedom Dnipra s 3:2. U prvenstvenoj pobjedi protiv Dynama rezultatom 2:1 odigrao cijeli susret.</p>\r\n<h4>\r\n	Josip Å imuniÄ‡ (Dinamo Zagreb)</h4>\r\n<p>Odigrao svih 90 minuta u porazu od kijevskog Dinama rezultatom 2:0. U prvenstvenoj pobjedi protiv Slaven Belupa od 4:1, takoÄ‘er igrao cijeli susret.</p>\r\n<h4>\r\n	Domagoj Vida (Dinamo Zagreb)</h4>\r\n<p>Odigrao cijelu utakmicu protiv Dynama u Ligi prvaka. Protiv Slaven Belupa nije bio niti na klupi za priÄuve.</p>\r\n<h4>\r\n	Gordon Schildenfeld (Dinamo Moskva)</h4>\r\n<p>Zaradio crveni karton u 52. minuti u domaÄ‡em porazu od AnÅ¾ija od 2:0.</p>\r\n<h4>\r\n	Dejan Lovren (Lyon)</h4>\r\n<p>Odigrao svih 90 minuta u utakmici Europa lige protiv Ironi Kiryata koja je zavrÅ¡ila pobjedom francuskog kluba rezultatom 4:3. TakoÄ‘er, cijeli susret odigrao je i u prvenstvu protiv Lorienta. ZavrÅ¡ilo je 1:1.</p>\r\n<h4>\r\n	Manuel PamiÄ‡ (Sparta Prag)</h4>\r\n<p>Odigrao svih 90 minuta protiv Athletic Bilbaa u Europa ligi. Sparta je upisala vrijednu pobjedu od 3:1. Prvenstveni dvoboj protiv Banika iz Ostrave igra se tek danas.</p>\r\n<h4>\r\n	Luka ModriÄ‡ (Real Madrid)</h4>\r\n<p>Utakmicu Lige prvaka protiv Ajaxa odgledao s klupe, jednako kao i nedjeljni El clasico protiv Barcelone.</p>\r\n<h4>\r\n	Niko KranjÄar (Dynamo Kijev)</h4>\r\n<p>Igrao prvo poluvrijeme utakmice Lige prvaka protiv Dinama. ZavrÅ¡ilo je 2:0 za domaÄ‡ina. U prvenstvenom dvoboju protiv Dnipra nije ulazio u igru.</p>\r\n<h4>\r\n	Ognjen VukojeviÄ‡ (Dynamo Kijev)</h4>\r\n<p>Odigrao svih 90 minuta protiv zagrebaÄkog Dinama u Ligi prvaka. Asistirao za prvi pogodak i zaradio Å¾uti karton u drugom poluvremenu. ZavrÅ¡ilo je 2:0 za kijevski klub. U prvenstvenom porazu od Dnipra rezultatom 2:1 ostao na klupi za priÄuve.</p>\r\n<h4>\r\n	Ivan PeriÅ¡iÄ‡ (Borussia Dortmund)</h4>\r\n<p>Utakmicu protiv Manchester Cityja odgledao s klupe. ZavrÅ¡ilo je 1:1. U prvenstvenom dvoboju protiv Hannovera takoÄ‘er nije ulazio u igru.</p>\r\n<h4>\r\n	Ivan RakitiÄ‡ (Sevilla)</h4>\r\n<p>U porazu od Celte Vigo rezultatom 2:0 nije bio niti na klupi za priÄuve.</p>\r\n<h4>\r\n	Milan Badelj (HSV)</h4>\r\n<p>Odigrao svih 90 minuta u pobjedi HSV-a protiv Greuther Furtha rezultatom 1:0. Badelj je sluÅ¾beno proglaÅ¡en najboljim igraÄem utakmice.</p>\r\n<h4>\r\n	Ivo IliÄeviÄ‡ (HSV)</h4>\r\n<p>Zbog ozljede nije konkurirao za ovotjedni prvenstveni dvoboj protiv Greuther Furtha.</p>\r\n<h4>\r\n	Josip RadoÅ¡eviÄ‡ (Hajduk)</h4>\r\n<p>Odigrao svih 90 minuta protiv Cibalije u pobjedi Hajduka od 4:0. Zaradio Å¾uti karton pred kraj prvog poluvremena.</p>\r\n<h4>\r\n	Jorge Sammir (Dinamo Zagreb)</h4>\r\n<p>Igrao do 80. minute protiv Dynama u Ligi prvaka. Protiv Slaven Belupa nije ulazio u igru.</p>\r\n<h4>\r\n	Mario MandÅ¾ukiÄ‡ (Bayern)</h4>\r\n<p>Igrao do 75. minute u gostujuÄ‡em porazu Bayerna od BATE Borisova rezultatom 3:1. U 2:0 pobjedi protiv Hoffenheima odigrao svih 90 minuta.</p>\r\n<h4>\r\n	Ivica OliÄ‡ (Wolfsburg)</h4>\r\n<p>UÅ¡ao u igru u 52. minuti u porazu Wolfsburga od Schalkea rezultatom 3:0</p>\r\n<h4>\r\n	Nikica JelaviÄ‡ (Everton)</h4>\r\n<p>Odigrao cijeli susret protiv Wigana te zabio prvi gol na utakmici veÄ‡ u 11. minuti. U drugom dijelu zaradio Å¾uti karton.</p>\r\n<h4>\r\n	Eduardo da Silva (Å ahtar)</h4>\r\n<p>U utakmici Lige prvaka protiv Juventusa nije ulazio s klupe za priÄuve. Protiv Metalista, u prvenstvu, uÅ¡ao u 65. minuti u utakmici koja je zavrÅ¡ila pobjedom Å ahtara od 2:0.</p>\r\n<h4>\r\n	Nikola KaliniÄ‡ (Dnipro)</h4>\r\n<p>Odigrao cijelu utakmicu protiv AIK-a u Europa ligi. Postigao prvi pogodak na utakmici i vodio svoju momÄad do pobjede rezultatom 3:2. U utakmici protiv Dynama ostao na klupi za priÄuve.</p>\r\n<h4>\r\n	Ante VukuÅ¡iÄ‡ (Pescara)</h4>\r\n<p>Igrao do 66. minute utakmice protiv Lazija. Pescara je poraÅ¾ena s visokih 3:0.</p>\r\n<h4>\r\n	IgraÄ tjedna: Nikica JelaviÄ‡</h4>\r\n<p>Nikica JelaviÄ‡ nakon povratka od ozljede igra sjajno. Nakon Å¡to je u proÅ¡lom kolu Premiershipa zabio dva pogotka, u ovom je dodao joÅ¡ jedan te definitivno &#39;zacementirao&#39; svoju poziciju u vrhu napada protiv Makedonije. Tamo Ä‡e mu se sigurno pridruÅ¾iti i Mario MandÅ¾ukiÄ‡ koji, iako ovaj tjedan nije zabio, igra u odliÄnoj formi â€“ veoma aktivno i rastrÄano. Å to se tiÄe obrane, posebno nam je drago vidjeti da se Å imuniÄ‡ vraÄ‡a u najbolju formu, kao i da Dejan Lovren redovito nastupa za Lyon.</p>', 1, '2012-11-17', '2012-11-16 11:57:45', '2012-11-16 12:49:15');

-- --------------------------------------------------------

--
-- Tablična struktura za tablicu `hns_actualityCoverImage`
--

CREATE TABLE IF NOT EXISTS `hns_actualityCoverImage` (
  `actualityId` int(10) unsigned NOT NULL,
  `filename` char(36) COLLATE utf8_unicode_ci NOT NULL,
  `width` smallint(5) unsigned NOT NULL,
  `height` smallint(5) unsigned NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`actualityId`),
  UNIQUE KEY `filename` (`filename`),
  KEY `hns_FK_actualityCoverImageHasActuality` (`actualityId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Tablična struktura za tablicu `hns_actualityHasCustomModule`
--

CREATE TABLE IF NOT EXISTS `hns_actualityHasCustomModule` (
  `actualityId` int(10) unsigned NOT NULL,
  `customModuleId` int(10) unsigned NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`actualityId`,`customModuleId`),
  KEY `hns_FK_actualityHasCustomModuleHasActuality` (`actualityId`),
  KEY `hns_FK_actualityHasCustomModuleHasCustomModule` (`customModuleId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
-- Tablična struktura za tablicu `hns_customModule`
--

CREATE TABLE IF NOT EXISTS `hns_customModule` (
  `customModuleId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `class` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`customModuleId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=46 ;

--
-- Izbacivanje podataka za tablicu `hns_customModule`
--

INSERT INTO `hns_customModule` (`customModuleId`, `class`, `created`, `modified`) VALUES
(42, NULL, '2012-11-20 13:26:53', '2012-11-20 13:26:53'),
(43, NULL, '2012-11-20 13:36:25', '2012-11-20 13:36:25'),
(44, NULL, '2012-11-20 14:23:02', '2012-11-20 14:23:02'),
(45, NULL, '2012-11-20 14:24:19', '2012-11-20 14:24:19');

-- --------------------------------------------------------

--
-- Tablična struktura za tablicu `hns_customModuleHasNewsItem`
--

CREATE TABLE IF NOT EXISTS `hns_customModuleHasNewsItem` (
  `customModuleId` int(10) unsigned NOT NULL,
  `newsItemId` int(10) unsigned NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`customModuleId`,`newsItemId`),
  KEY `hns_FK_customModuleHasNewsItemHasCustomModule` (`customModuleId`),
  KEY `hns_FK_customModuleHasNewsItemHasNewsItem` (`newsItemId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Tablična struktura za tablicu `hns_customModuleHasPage`
--

CREATE TABLE IF NOT EXISTS `hns_customModuleHasPage` (
  `customModuleId` int(10) unsigned NOT NULL,
  `pageId` int(10) unsigned NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`customModuleId`,`pageId`),
  KEY `hns_FK_customModuleHasPageHasCustomModule` (`customModuleId`),
  KEY `hns_FK_customModuleHasPageHasPage` (`pageId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Izbacivanje podataka za tablicu `hns_customModuleHasPage`
--

INSERT INTO `hns_customModuleHasPage` (`customModuleId`, `pageId`, `created`) VALUES
(44, 36, '0000-00-00 00:00:00'),
(45, 36, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Tablična struktura za tablicu `hns_customModuleImage`
--

CREATE TABLE IF NOT EXISTS `hns_customModuleImage` (
  `customModuleImageId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `customModuleItemId` int(10) unsigned NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`customModuleImageId`),
  KEY `customMouleItemId` (`customModuleItemId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=47 ;

--
-- Izbacivanje podataka za tablicu `hns_customModuleImage`
--

INSERT INTO `hns_customModuleImage` (`customModuleImageId`, `customModuleItemId`, `title`, `created`, `modified`) VALUES
(40, 49, NULL, '2012-11-20 13:26:58', '2012-11-20 13:26:58'),
(41, 50, NULL, '2012-11-20 13:27:07', '2012-11-20 13:27:07'),
(42, 52, NULL, '2012-11-20 13:36:31', '2012-11-20 13:36:31'),
(43, 53, NULL, '2012-11-20 13:36:41', '2012-11-20 13:36:41'),
(44, 55, NULL, '2012-11-20 14:23:13', '2012-11-20 14:23:13'),
(45, 56, NULL, '2012-11-20 14:23:28', '2012-11-20 14:23:28'),
(46, 58, NULL, '2012-11-20 14:24:24', '2012-11-20 14:24:24');

-- --------------------------------------------------------

--
-- Tablična struktura za tablicu `hns_customModuleImageImage`
--

CREATE TABLE IF NOT EXISTS `hns_customModuleImageImage` (
  `customModuleImageId` int(10) unsigned NOT NULL,
  `filename` char(36) COLLATE utf8_unicode_ci NOT NULL,
  `width` smallint(5) unsigned NOT NULL,
  `height` smallint(5) unsigned NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`customModuleImageId`),
  UNIQUE KEY `filename` (`filename`),
  KEY `hns_FK_customModuleImageImageHasCustomModuleImage` (`customModuleImageId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Izbacivanje podataka za tablicu `hns_customModuleImageImage`
--

INSERT INTO `hns_customModuleImageImage` (`customModuleImageId`, `filename`, `width`, `height`, `created`, `modified`) VALUES
(40, 'gz89zc1oukebhqn1vff5hryg0czdp8qq.jpg', 640, 427, '2012-11-20 13:26:59', '0000-00-00 00:00:00'),
(41, 'dwwq6zi7v1byz5lxgw2esfv0xbttcm4x.jpg', 640, 427, '2012-11-20 13:27:08', '0000-00-00 00:00:00'),
(42, 'zdfvrl7wc63n870xa8i55e23mai3a181.jpg', 640, 427, '2012-11-20 13:36:31', '0000-00-00 00:00:00'),
(43, '36u9gslkei8dcgwgb6d7rrvfmu4heha9.jpg', 640, 427, '2012-11-20 13:36:42', '0000-00-00 00:00:00'),
(44, '2a5z1cvmb98ge4ec8h4m0il6hrj0db8t.jpg', 640, 427, '2012-11-20 14:23:14', '0000-00-00 00:00:00'),
(45, 'vsa5g0225c4xb5rmz7pgnm7092vf8j2r.jpg', 640, 427, '2012-11-20 14:23:29', '0000-00-00 00:00:00'),
(46, '4rm8s7g2e4zfujs6fxzc106sw1dp15ar.jpg', 640, 427, '2012-11-20 14:24:24', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Tablična struktura za tablicu `hns_customModuleItem`
--

CREATE TABLE IF NOT EXISTS `hns_customModuleItem` (
  `customModuleItemId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `customModuleItemSizeId` int(10) unsigned NOT NULL,
  `customModuleId` int(10) unsigned NOT NULL,
  `position` int(10) unsigned NOT NULL,
  `class` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`customModuleItemId`),
  KEY `hns_FK_customModuleItemHasCustomModuleItemSize` (`customModuleItemSizeId`),
  KEY `hns_FK_customModuleItemHasCustomModule` (`customModuleId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=59 ;

--
-- Izbacivanje podataka za tablicu `hns_customModuleItem`
--

INSERT INTO `hns_customModuleItem` (`customModuleItemId`, `customModuleItemSizeId`, `customModuleId`, `position`, `class`, `created`, `modified`) VALUES
(49, 2, 42, 1, NULL, '2012-11-20 13:26:58', '2012-11-20 13:27:36'),
(50, 1, 42, 2, NULL, '2012-11-20 13:27:07', '2012-11-20 13:27:36'),
(51, 1, 42, 3, NULL, '2012-11-20 13:27:36', '2012-11-20 13:27:36'),
(52, 2, 43, 1, NULL, '2012-11-20 13:36:31', '2012-11-20 13:36:56'),
(53, 1, 43, 2, NULL, '2012-11-20 13:36:41', '2012-11-20 13:36:56'),
(54, 1, 43, 3, NULL, '2012-11-20 13:36:56', '2012-11-20 13:36:56'),
(55, 2, 44, 1, NULL, '2012-11-20 14:23:13', '2012-11-20 14:23:58'),
(56, 1, 44, 2, NULL, '2012-11-20 14:23:28', '2012-11-20 14:23:58'),
(57, 1, 44, 3, NULL, '2012-11-20 14:23:58', '2012-11-20 14:23:58'),
(58, 2, 45, 1, NULL, '2012-11-20 14:24:24', '2012-11-20 14:24:40');

-- --------------------------------------------------------

--
-- Tablična struktura za tablicu `hns_customModuleItemSize`
--

CREATE TABLE IF NOT EXISTS `hns_customModuleItemSize` (
  `customModuleItemSizeId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `key` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`customModuleItemSizeId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Izbacivanje podataka za tablicu `hns_customModuleItemSize`
--

INSERT INTO `hns_customModuleItemSize` (`customModuleItemSizeId`, `name`, `key`, `created`, `modified`) VALUES
(1, 'Usko', 'small', '2012-11-19 14:10:53', NULL),
(2, 'Široko', 'wide', '2012-11-19 14:10:53', NULL);

-- --------------------------------------------------------

--
-- Tablična struktura za tablicu `hns_customModuleText`
--

CREATE TABLE IF NOT EXISTS `hns_customModuleText` (
  `customModuleTextId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `customModuleItemId` int(10) unsigned NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `footnote` text COLLATE utf8_unicode_ci,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`customModuleTextId`),
  KEY `customModuleItemId` (`customModuleItemId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=10 ;

--
-- Izbacivanje podataka za tablicu `hns_customModuleText`
--

INSERT INTO `hns_customModuleText` (`customModuleTextId`, `customModuleItemId`, `content`, `footnote`, `created`, `modified`) VALUES
(7, 51, 'Neki tekst u modulu, vezano za slike.', 'Fusnota, na slici gore Å timac, lijevo JelaviÄ‡.', '2012-11-20 13:27:36', '2012-11-20 13:27:36'),
(8, 54, 'I am so happy, my dear friend, so absorbed in the exquisite sense of mere tranquil existence, that I neglect my talents. I should be incapable of drawing a single.', 'NA SLICI\r\nAutor fotogracije (ako ima)', '2012-11-20 13:36:56', '2012-11-20 13:36:56'),
(9, 57, 'I am so happy, my dear friend, so absorbed in the exquisite sense of mere tranquil existence, that I neglect my talents. I should be incapable of drawing a single.', 'NA SLICI\nAutor fotogracije (ako ima)', '2012-11-20 14:23:58', '2012-11-20 14:23:58');

-- --------------------------------------------------------

--
-- Tablična struktura za tablicu `hns_gallery`
--

CREATE TABLE IF NOT EXISTS `hns_gallery` (
  `galleryId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`galleryId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Izbacivanje podataka za tablicu `hns_gallery`
--

INSERT INTO `hns_gallery` (`galleryId`, `created`, `modified`) VALUES
(1, '2012-11-16 14:41:14', '2012-11-16 14:41:14'),
(2, '2012-11-16 14:41:58', '2012-11-16 14:41:58');

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

--
-- Izbacivanje podataka za tablicu `hns_galleryI18n`
--

INSERT INTO `hns_galleryI18n` (`galleryId`, `languageId`, `title`, `slug`, `category`, `created`, `modified`) VALUES
(1, 'eng', 'Test gallery', 'test-gallery', 'Category 1', '2012-11-16 14:41:14', '2012-11-16 14:41:14'),
(1, 'hrv', 'Testna galerija 1', 'testna-galerija-1', 'Kategorija 1', '2012-11-16 14:41:14', '2012-11-16 14:41:14'),
(2, 'eng', 'Gallery 2', 'gallery-2', 'Category 2', '2012-11-16 14:41:58', '2012-11-16 14:41:58'),
(2, 'hrv', 'Galerija 2', 'galerija-2', 'Kategorija 2', '2012-11-16 14:41:58', '2012-11-16 14:41:58');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8 ;

--
-- Izbacivanje podataka za tablicu `hns_galleryImage`
--

INSERT INTO `hns_galleryImage` (`imageId`, `galleryId`, `position`, `filename`, `width`, `height`, `created`, `modified`) VALUES
(1, 1, 1, 'm2e8qyzq4rflb639herm77v9ip814q5g.jpg', 719, 429, '2012-11-16 14:41:29', '2012-11-16 14:41:29'),
(2, 1, 2, 'yhhjqmlojecwxj2n10jwea756tt0vkst.jpg', 719, 429, '2012-11-16 14:41:29', '2012-11-16 14:41:29'),
(3, 1, 3, 'osxq57micxn4wteyx1o2y0vv6std20t2.jpg', 719, 429, '2012-11-16 14:41:30', '2012-11-16 14:41:30'),
(4, 1, 4, 'ryrtwlz8jcb60y548n83w5xiim7dlu96.jpg', 719, 429, '2012-11-16 14:41:30', '2012-11-16 14:41:30'),
(5, 2, 5, '92zs2vqr4md3zy86u64y9ud10cw9ia15.jpg', 719, 429, '2012-11-16 14:42:05', '2012-11-16 14:42:05'),
(6, 2, 6, '3ykmj2v81ssv4uo3vidqxg8edx1zsm7y.jpg', 719, 429, '2012-11-16 14:42:06', '2012-11-16 14:42:06'),
(7, 2, 7, 'asibf4djbtljkmiu0r1e1yenveilgupo.jpg', 719, 429, '2012-11-16 14:42:06', '2012-11-16 14:42:06');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Izbacivanje podataka za tablicu `hns_newsItem`
--

INSERT INTO `hns_newsItem` (`newsItemId`, `languageId`, `title`, `slug`, `lead`, `content`, `isPublished`, `publishDate`, `created`, `modified`) VALUES
(1, 'hrv', 'Å timac: Å½elimo tri boda', 'stimac-zelimo-tri-boda', '<p>Izbornik Å timac poÄeo je okupljati reprezentativce za kvalifikacijske susrete protiv Makedonije i Walesa.</p>', '<p>Na danaÅ¡njoj konferenciji za novinare izbornik Igor Å timac pokazao je veliki optimizam pred odlazak u Skoplje. TrenutaÄno ga Wales ne zanima; cilj je iz Makedonije se vratiti s tri boda.</p>\r\n<p>"Za onaj prvi ciklus imali smo dosta problema, neki igraÄi su bili preoptereÄ‡eni sa po desetak utakmica u mjesec dana, drugi nisu imali niti 90 minuta u nogama. Sada je situacija, sreÄ‡om, puno drugaÄija. VeÄ‡ina je igraÄa u formi, s ozljedama nemamo problema. Idemo ostvariti cilj i pokuÅ¡ati izboriti tri boda", rekao je izbornik, a zatim nastavio s planom igre za Makedoniju.</p>\r\n<p>"NaÅ¡a Ä‡e se igra bazirati na napadaÄkim akcijama, na kreaciji. Prodornost, okomite lopte, brzina kretanja...Na tome Ä‡emo inzistirati, a ne na spreÄavanju igre suparnika. U tom nas smislu ne zanima njihov broj jedan Pandev. On jeste veliki igraÄ, evo, zabio je joÅ¡ jedan pogodak, sada je u zreloj igraÄkoj dobi. Nisam siguran da Ä‡emo ga markirati striktno ili Ä‡emo ga kombinirano pokrivati. Vidjet Ä‡emo, to zavisi od naÅ¡e momÄadi koja Ä‡e istrÄati na teren", smatra Å timac kojeg ne brine Å¡to Luka ModriÄ‡ nije odigrao niti minute u El clasicu.</p>\r\n<p>"PriÄao sam s trenerom Mourinhom nakon utakmice. Uvjerio me je da je Luka u najboljoj formi. Nebitno je Å¡to nije igrao, on nam dolazi kao najveÄ‡i naÅ¡ adut za pobjedu u Skopju", zakljuÄio je.</p>\r\n<p>Osim Å timca, pred novinare su izaÅ¡li i Ivan RakitiÄ‡ te Milan Badelj koji se odliÄno adaptirao u NjemaÄkoj.</p>\r\n<p>"Dobro sam se adaptirao u NjemaÄkoj. Cilj nam je tri boda. Makedonija nije iz prve dvije jakosne skupine euro nogometa, no pokazali su i u Maksimiru koliko mogu biti neugodni. TakoÄ‘er, znam da Ä‡e atmosfera u Skoplju biti prava nogometna", smatra Badelj.</p>', 1, '2012-11-22', '2012-11-15 13:03:20', '2012-11-15 14:53:06'),
(2, 'hrv', 'Demanti teksta u Jutarnjem listu, 06.10.2012.', 'demanti-teksta-u-jutarnjem-listu-06102012', '<p>RijeÄ je o Älanku pod naslovom â€žSluÄaj Å uker, HNS veÄ‡ izgubio milijun kuna. Platio je 275.000 kuna za dresove sa svojim imenomâ€œ.</p>', '<p>Subotnji tekst u kojem se blati predsjednik Hrvatskog nogometnog saveza Davor Å uker i krovno tijelo hrvatskog nogometa, kojim proslavljeni hrvatski nogometaÅ¡ predsjedava, dno je novinarstva u Hrvata. Senzacionalizam, Å¾utilo i priÄe koje nisu dostojne ozbiljnih tiskovina nivo su koji je ispod vrijednosti bilo kakvog ozbiljnog demantija. I ovaj smo put sami sebi postavili pitanje demantirati ili ne? Do sada smo bili protiv toga jer nismo htjeli produbljivati priÄu i spuÅ¡tati se na razinu traÄeva kojima nas zasipaju. No, sada je dosta! Zatrpani smo laÅ¾ima od samoga poÄetka. Gotovo svakoga tjedna, nekoliko posljednjih mjeseci, Jutarnji list prijeti novom â€žaferomâ€œ. Zato Ä‡emo laÅ¾i koje su napisane u tekstu, kojega bi se posramili Äak i najgori engleski tabloidi, ipak morati demantirati.</p>\r\n<p>U Jutarnjem se maÅ¡e otkazima, te novinari, pod pritiskom uprave obavljaju â€žposebne zadatkeâ€œ kako bi zadrÅ¾ali posao i spasili se od, na Å¾alost, neminovne propasti. U takvoj situaciji nikome nije lako i Å¾ao nam je ljudi koji su prisiljeni obavljati ovakve prljave poslove. Umjesto packi novinarima, izraÅ¾avamo Å¾aljenje. S druge strane, HNS je u posljednjih mjesec dana, u ova krizna vremena, zaposlio nove ljude. Otvaraju se nove moguÄ‡nosti i kao Å¡to kaÅ¾e Romana Eibl u svom tekstu, Å¡tedimo tamo gdje moÅ¾emo. To je, apsolutno toÄno, i tu je u pravu, no sve ostalo je laÅ¾!</p>\r\n<p>Kako Äitatelji ne bi ostali uskraÄ‡eni, evo i Äinjenica u svezi teksta koji je u subotu objavljen.</p>\r\n<p>Å ukerov dres HNS ne stoji gotovo niÅ¡ta jer se radi o sponzorskom ugovoru s dobavljaÄem, koji je poslovna tajna. Kada ga je dobio, Blatter je rekao da se osjeÄ‡a privilegiranim Å¡to ga ima i ponosimo se Äinjenicom da moÅ¾emo darivati takve poklone, koji impresioniraju Äak i predsjednika FIFA-e. Na Å¾alost, neki hrvatski novinari veÄ‡ su od velikih sportaÅ¡a pokuÅ¡ali napraviti tragiÄne likove (KosteliÄ‡i, IvaniÅ¡eviÄ‡, VlaÅ¡iÄ‡...), a sada se i Davora Å ukera prikazuje kao narcisoidnog nesposobnjakoviÄ‡a. Stvar bi bila smijeÅ¡na da nije tragiÄna, jer radi se o ozbiljnim optuÅ¾bama u kojima se, izmeÄ‘u ostalog, iznosi da je Davor Å uker osiromaÅ¡io HNS za milijun kuna.</p>\r\n<p>No, nastavimo redom. Davor Å uker nije vlasnik prostora u koje se jednim dijelom preselio HNS. ToÄnije, tamo joÅ¡ uvijek nije niti bio. Ukoliko to bude bilo potrebno predoÄiti Ä‡emo ugovor o najmu. Danas (06.10.) u 11.00h upriliÄen je sluÅ¾beni posjet novim prostorijama. GospoÄ‘ica Eibl bi sigurno dodala da je to napravljeno kako bi se Å uker uvjerio u svoj sjajan poslovni potez, odnosno da posjeti prostor kojega je uspio â€žuvalitiâ€œ.</p>\r\n<p>Å to se tiÄe igre â€žFIFA 2013.â€œ umjesto spomenute, u kojoj zaista nema hrvatske reprezentacije, moÅ¾ete igrati â€žPro Evolution Soccer 2013.â€œ, u kojem imate hrvatsku reprezentaciju. Ne Å¾elimo nikoga diskreditirati, ali svi ozbiljni â€žgameriâ€œ kaÅ¾u kako je PES daleko kvalitetniji od â€žFIFA-e 2013.â€œ Naime, HNS ima ugovor s tvrtkom Konami, koji je neusporedivo izdaÅ¡niji od onoga kojega je ponudila konkurentska tvrtka zabavnog softwarea, koja proizvodi igru FIFA. Na kraju, niÅ¡ta manje bitna je i Äinjenica da je ovaj ugovor potpisan prije viÅ¡e od dvije godine, kada Davor Å uker nije bio predsjednik HNS-a. No, vjerojatno je i za to upravo on kriv.</p>\r\n<p>I to je sve! Na Å¾alost po Jutarnji list i gospoÄ‘icu Eibl, nema nikakvih intriga, izgubljenih novaca, afera... Hrvatski nogometni savez i njegovi djelatnici rade svoj posao najbolje Å¡to znaju. Kao i svi, i mi grijeÅ¡imo i spremni smo, sportski i ljudski, podnijeti kritiku. Na Å¾alost, ovdje to nije bio sluÄaj. Tekst kojega demantiramo nije bio konstruktivna (ili nekonstruktivna) kritika, veÄ‡ najgore podmetanje u svom najniÅ¾em obliku. Pred nama su nove dvije vaÅ¾ne kvalifikacijske utakmice i svjesni smo da slijede novi klipovi u kola koja se, na Å¾alost nekih, sigurno kreÄ‡u prema Brazilu.</p>\r\n<p>Na kraju isprika Äitateljima zbog Äinjenice da i ovaj demanti morate Äitati na stranicama Jutarnjeg lista, ali ovaj je tekst jedan od preduvjeta za tuÅ¾bu, koja Ä‡e uskoro uslijediti. Dugo nismo reagirali, ali ovo je bila kap koja je prelila ÄaÅ¡u.</p>\r\n<p><strong>Neven CvijanoviÄ‡, glasnogovornik HNS</strong></p>', 1, '2012-11-22', '2012-11-15 13:20:41', '2012-11-15 13:20:41'),
(3, 'hrv', 'Ulaznice / Makedonija - Hrvatska, Hrvatska - Wales', 'ulaznice-makedonija-hrvatska-hrvatska-wales', '<p>Od 1. X. su u prodaji ulaznice za kvalifikacijske utakmice za FIFA Svjetsko prvenstvo Brazil 2014â„¢ protiv Makedonije u Skoplju 12. listopada i Walesa u Osijeku, 16. listopada. <strong>Nove pogodnosti za kupce ulaznica putem interneta su odabir reda i sjedala te smanjena cijena dostave.</strong></p>', '<p>Kvalifikacijska utakmica za FIFA Svjetsko prvenstvo Brazil 2014â„¢ <strong>MAKEDONIJA - HRVATSKA,</strong> Skoplje, Arena Filipa II Makedonskog, 12. listopada 2012. 20:30h</p>\r\n<p><strong>ZAVRÅ ENA JE PRODAJA!</strong></p>\r\n<p><strong>POÄŒETAK PRODAJE:</strong><br />\r\n1. listopada 2012.</p>\r\n<p><strong>CIJENA ULAZNICE:</strong><br />\r\n25,00 kn</p>\r\n<h3>\r\n	INTERNET PREDBILJEÅ½BE</h3>\r\n<p>Prodaju vouchera Internetom na web stranicama www.ulaznice.hr organizira DEKOD telekom d.o.o., HorvaÄ‡anska 17a, Zagreb u ime Hrvatskog nogometnog saveza.</p>\r\n<p>Jedan kupac moÅ¾e kupiti najviÅ¡e trideset (30) ulaznica, te za sebe i za sve ostale osobe unosi traÅ¾ene osobne podatke (ime i prezime, broj putovnice i adresa kupca) na Internet stranicama www.ulaznice.hr, www.ulaznice.com.hr i www.hns-cff.hr.</p>\r\n<p><strong>Rok za kupnju ulaznica putem interneta je:</strong><br />\r\n1. - 8. listopada do 12:00 sati</p>\r\n<p>Kupac vouchera/ulaznica moÅ¾e biti iskljuÄivo drÅ¾avljanin/ka Republike Hrvatske, dok ostale osobe za koje kupac kupuje ulaznice ne moraju nuÅ¾no biti drÅ¾avljani Republike Hrvatske.</p>\r\n<p>Kupnja ulaznica organizirana sustavom vouchera. Kupac Ä‡e za sve osobe za koje kupuje ulaznice dobiti posebni voucher na kojemu Ä‡e biti ispisano ime, prezime i broj putovnice vlasnika vouchera, a za originalne ulaznice besplatno Ä‡e moÄ‡i razmijeniti na dan utakmice u Skoplju u krugu Arene Filipa II Makedonskog <strong>iskljuÄivo osobno i pojedinaÄno svatko na koga glasi voucher uz predoÄenje putovnice</strong> uneÅ¡ene kod kupnje ulaznica. Mjesto i vrijeme preuzimanja Ä‡e svi kupci Ä‡e dobiti u voucheru.<br />\r\n<br />\r\n<strong>Ukoliko se prilikom preuzimanja ulaznice ustanovi da broj putovnice koji je unesen kod kupnje ne pripada osobi koja je navedena uz nju, ili je uneÅ¡en izmiÅ¡ljeni ili nepostojeÄ‡i broj putovnice, ulaznica neÄ‡e biti izdana, a kupac neÄ‡e moÄ‡i ostvariti povrat novca.</strong></p>\r\n<p>Obavijesti o statusu kupovine kupci Ä‡e moÄ‡i pratiti na gore navedenim Internet stranicama uz unos korisniÄkog imena i lozinke koje dobivaju prilikom kupovine na svoju e-mail adresu. Ukoliko kupac ne primi e-mail molimo da se obavezno javi na podrska@ulaznice.com.hr.</p>\r\n<p>Ukoliko u bilo kojoj fazi kupovine (od uplate do isporuke) doÄ‘e do bilo kakvih problema, molimo kupce da se jave sluÅ¾bi za korisnike (od ponedjeljka do petka 8 â€“ 20h):</p>\r\n<ul>\r\n	<li>\r\n		e-mail: podrska@ulaznice.com.hr</li>\r\n	<li>\r\n		telefon: 060 53 53 56 (unutar Hrvatske, cijena poziva po minuti: 3,43 kn fiksne mreÅ¾e / 4,70 kn mobilne mreÅ¾e), 00385 1 6418 474 (izvan Hrvatske)</li>\r\n</ul>\r\n<p><strong>Napominjemo da se ulaznice za hrvatski sektor ne mogu kupiti na blagajnama u Skoplju, te je kupnja vouchera jedini naÄin za pristup naÅ¡em sektoru. Zamjena vouchera za ulaznice obavljat Ä‡e se u zoni stadiona, na lokaciji navedenoj u voucheru na dan utakmice uz predoÄenje dokumenta koji je unijet prilikom kupnje vouchera.</strong></p>\r\n\r\n<p>Kvalifikacijska utakmica za FIFA Svjetsko prvenstvo Brazil 2014â„¢<br />\r\n<strong>HRVATSKA - WALES</strong>, Osijek, Stadion Gradski vrt, 16. listopada 2012. 20:00h</p>\r\n<p><strong>POÄŒETAK PRODAJE:</strong><br />\r\n1. listopada 2012.</p>\r\n<p><strong>CIJENE PO SEKTORIMA:</strong><br />\r\nTribina zapad - 80,00 kn<br />\r\nTribina istok - 40,00 kn<br />\r\nTribina jug - 40,00 kn<br />\r\nTribina sjever je rezervirana za velÅ¡ke navijaÄe</p>\r\n<p>Prodaja u TISAKmedia centrima u cijeloj Hrvatskoj poÄinje 2. listopada 2012.</p>\r\n<h3>\r\n	INTERNET PRODAJA</h3>\r\n<p>Prodaju ulaznica Internetom s ukljuÄenom dostavom na adresu i naplatom organizira DEKOD telekom d.o.o., HorvaÄ‡anska 17a, Zagreb.</p>\r\n<p><em><strong>Mjesta unutar odabranog sektora tj. red i sjedalo moguÄ‡e je odabrati samo kod kupnje na Internetu.</strong></em></p>\r\n<p>Pravo na kupovinu Internetom imaju iskljuÄivo drÅ¾avljani Republike Hrvatske uz popunu osobnih podataka (ime i prezime, OIB i adresa kupca) na Internet stranicama www.ulaznice.hr, www.ulaznice.com.hr i www.hns-cff.hr.</p>\r\n<p>Jedna (1) osoba moÅ¾e kupiti najviÅ¡e Äetiri (4) ulaznica.</p>\r\n<p>Rok za kupnju ulaznica putem Interneta je:<br />\r\n16. listopada - 12:00 sati</p>\r\n<p>Ulaznice kupljene putem Interneta moguÄ‡e je platiti:</p>\r\n<ul>\r\n	<li>\r\n		uplatom opÄ‡om uplatnicom u banci (preporuka u Erste & SteiermÃ¤rkische Bank d.d. radi brÅ¾e obrade uplate) na Å¾iro raÄun DEKOD telekom d.o.o. broj 2402006-1100439341 u Erste & Steiermaerkische banci iskljuÄivo s toÄno upisanim pozivom na broj ponude dobiven prilikom kupovine (do deset dana prije poÄetka dogaÄ‘aja)</li>\r\n	<li>\r\n		uplatom preko Erste NetPay servisa (do sedam dana prije poÄetka dogaÄ‘aja)</li>\r\n	<li>\r\n		DINERS, MasterCard ili VISA kreditnom karticom te Maestro debitnom karticom do zavrÅ¡etka prodaje (Maestro kartice izdane od strane banaka koje podrÅ¾avaju Maestro Internet transakcije, za viÅ¡e informacija obratite se banci koja je izdala karticu)</li>\r\n</ul>\r\n<p>Obavijesti o statusu kupovine i dostave kupci Ä‡e moÄ‡i pratiti na gore navedenim Internet stranicama uz unos e-maila i lozinke koju dobivaju prilikom kupovine na svoju e-mail adresu.</p>\r\n<p>Molimo kupce da osiguraju preuzimanje poÅ¡iljke na navedenoj adresi radnim danom od 08:00 do 17:00 sati.</p>\r\n<p>Ukoliko u bilo kojoj fazi kupovine (od uplate do isporuke) doÄ‘e do bilo kakvih problema, molimo kupce da se jave sluÅ¾bi za korisnike (od ponedjeljka do petka 8 â€“ 20h):</p>\r\n<ul>\r\n	<li>\r\n		e-mail: podrskaulaznice.com.hr</li>\r\n	<li>\r\n		telefon: 060 53 53 56 (unutar Hrvatske, cijena poziva po minuti: 3,43 kn fiksne mreÅ¾e / 4,70 kn mobilne mreÅ¾e), 00385 1 6418 474 (izvan Hrvatske)</li>\r\n</ul>\r\n<p>U sve cijene PDV je uraÄunat prema zakonu.</p>\r\n<h4>\r\n	DOSTAVA ULAZNICA</h4>\r\n<p>Cijena dostave (bez obzira na broj ulaznica) je 38 kn za tuzemne dostave, 240kn za inozemne dostave te 10kn osobno preuzimanje na blagajni stadiona Gradski vrt u Osijeku.<br />\r\nÄŒlanovima kluba navijaÄa hrvatske nogometne reprezentacije "Uvijek vjerni" koji su na vrijeme naruÄili ulaznice Hrvatski nogometni savez je osigurao besplatnu dostavu na podruÄju Republike Hrvatske koju organizira CityEX.</p>\r\n<h4>\r\n	OSOBE U INVALIDSKIM KOLICIMA</h4>\r\n<p>Svi gledatelji koji se za kretanje sluÅ¾e invalidskim kolicima zainteresirani za ulaznice za utakmicu molimo da svoj zahtjev, koji ukljuÄuje osobne podatke za njega i osobu u pratnji, poÅ¡alju na e-mail: ulaznice@hns-cff.hr.</p>', 1, '2012-11-15', '2012-11-15 13:30:32', '2012-11-15 13:30:32'),
(4, 'hrv', 'Moyes mnogo oÄekuje od JelaviÄ‡a', 'moyes-mnogo-ocekuje-od-jelavica', '<p>Trener Evertona David Moyes moÅ¾e itekako biti zadovoljan nastupima svojih igraÄa u ovoj sezoni.</p>', '<p>Naime, Everton je odliÄno startao u ligi; s tri boda manje od Chelseaa trenutaÄno su drugi klub engleske lige. U tome je veliku zaslugu imao i naÅ¡ <strong>Nikica JelaviÄ‡</strong> koji je zabio tri pogotka.</p>\r\n<p>"JelaviÄ‡ je jedan od nogometaÅ¡a kojem trebaju treninzi i utakmice. Å to viÅ¡e i jaÄe bude trenirao, Å¡to bude viÅ¡e igrao utakmica, tako Ä‡e rasti u formi. Uvjeren sam da Ä‡emo dobiti joÅ¡ viÅ¡e od JelaviÄ‡a u usporedbi s proÅ¡lom sezonom ili poÄetkom ove", rekao je <strong>Moyes </strong>za naÅ¡eg napadaÄa.</p>\r\n<p>"FiziÄki joÅ¡ nije spreman svih 90 minuta odigrati maksimalno. Imao je lakÅ¡u ozljedu iza sebe. Ali, oÄekujem to uskoro od njega. Borac je i veliki radnik", zakljuÄio je trener.</p>', 1, '2012-11-15', '2012-11-15 13:32:11', '2012-11-15 14:54:38');

-- --------------------------------------------------------

--
-- Tablična struktura za tablicu `hns_newsItemCoverImage`
--

CREATE TABLE IF NOT EXISTS `hns_newsItemCoverImage` (
  `newsItemId` int(10) unsigned NOT NULL,
  `filename` char(36) COLLATE utf8_unicode_ci NOT NULL,
  `width` smallint(5) unsigned NOT NULL,
  `height` smallint(5) unsigned NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`newsItemId`),
  UNIQUE KEY `filename` (`filename`),
  KEY `hns_FK_newsItemCoverImageHasNewsItem` (`newsItemId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Izbacivanje podataka za tablicu `hns_newsItemCoverImage`
--

INSERT INTO `hns_newsItemCoverImage` (`newsItemId`, `filename`, `width`, `height`, `created`, `modified`) VALUES
(1, 'g6365lfx7ox83itvspt9rc66z1izxt6j.jpg', 729, 429, '2012-11-15 14:53:06', '0000-00-00 00:00:00'),
(4, 'kbs7dolr0fclro9ju2yyxlro1yd2k71w.jpg', 729, 429, '2012-11-15 14:54:38', '0000-00-00 00:00:00');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=37 ;

--
-- Izbacivanje podataka za tablicu `hns_page`
--

INSERT INTO `hns_page` (`pageId`, `lft`, `rgt`, `parentId`, `isException`, `isVisible`, `isEditable`, `isPublished`, `canAddChildren`, `canBeDeleted`, `class`, `created`, `modified`) VALUES
(1, 1, 64, NULL, 1, 0, 0, 1, 0, 0, NULL, '2012-11-14 14:47:33', '2012-11-16 10:44:25'),
(2, 2, 21, 1, 1, 1, 0, 1, 1, 0, 'hns', '2012-11-14 15:08:19', '2012-11-16 10:08:42'),
(3, 22, 33, 1, 1, 1, 1, 1, 1, 0, 'selection', '2012-11-14 15:10:07', '2012-11-14 15:10:07'),
(4, 34, 47, 1, 1, 1, 1, 1, 1, 0, 'competitions', '2012-11-14 15:11:09', '2012-11-14 15:26:41'),
(5, 48, 61, 1, 1, 1, 0, 1, 1, 0, 'infocenter', '2012-11-14 15:12:12', '2012-11-14 15:12:12'),
(6, 62, 63, 1, 1, 1, 0, 1, 1, 0, 'press', '2012-11-14 15:13:00', '2012-11-14 15:13:00'),
(7, 3, 8, 2, 0, 1, 1, 1, 1, 1, NULL, '2012-11-14 15:14:49', '2012-11-14 16:07:43'),
(8, 9, 10, 2, 0, 1, 1, 1, 1, 1, NULL, '2012-11-14 15:16:12', '2012-11-14 15:16:12'),
(9, 11, 12, 2, 0, 1, 1, 1, 1, 1, NULL, '2012-11-14 15:17:24', '2012-11-14 15:17:24'),
(10, 13, 14, 2, 0, 1, 1, 1, 1, 1, NULL, '2012-11-14 15:18:25', '2012-11-14 15:18:25'),
(11, 15, 16, 2, 0, 1, 1, 1, 1, 1, NULL, '2012-11-14 15:19:45', '2012-11-14 15:19:45'),
(12, 17, 18, 2, 0, 1, 1, 1, 1, 1, NULL, '2012-11-14 15:20:41', '2012-11-14 15:20:41'),
(13, 19, 20, 2, 1, 1, 1, 1, 1, 0, 'contact', '2012-11-14 15:21:23', '2012-11-14 15:21:23'),
(14, 23, 24, 3, 0, 1, 1, 1, 1, 1, NULL, '2012-11-14 15:22:36', '2012-11-14 15:22:36'),
(15, 25, 26, 3, 0, 1, 1, 1, 1, 1, NULL, '2012-11-14 15:23:11', '2012-11-14 15:23:11'),
(16, 27, 28, 3, 0, 1, 1, 1, 1, 1, NULL, '2012-11-14 15:23:55', '2012-11-14 15:23:55'),
(17, 29, 30, 3, 0, 1, 1, 1, 1, 1, NULL, '2012-11-14 15:24:56', '2012-11-14 15:24:56'),
(18, 31, 32, 3, 0, 1, 1, 1, 1, 1, NULL, '2012-11-14 15:26:00', '2012-11-14 15:26:00'),
(19, 35, 36, 4, 0, 1, 1, 1, 1, 1, NULL, '2012-11-14 15:27:59', '2012-11-14 15:28:23'),
(21, 37, 38, 4, 0, 1, 1, 1, 1, 1, NULL, '2012-11-14 15:32:26', '2012-11-14 15:32:26'),
(22, 39, 40, 4, 0, 1, 1, 1, 1, 1, NULL, '2012-11-14 15:33:49', '2012-11-14 15:33:49'),
(23, 41, 42, 4, 0, 1, 1, 1, 1, 1, NULL, '2012-11-14 15:37:18', '2012-11-14 15:37:18'),
(24, 43, 44, 4, 0, 1, 1, 1, 1, 1, NULL, '2012-11-14 15:38:58', '2012-11-14 15:38:58'),
(25, 45, 46, 4, 0, 1, 1, 1, 1, 1, NULL, '2012-11-14 15:39:30', '2012-11-14 15:39:30'),
(26, 49, 50, 5, 1, 1, 0, 1, 0, 0, 'news', '2012-11-14 15:41:00', '2012-11-16 10:43:11'),
(27, 51, 52, 5, 1, 1, 0, 1, 0, 0, 'actualities', '2012-11-14 15:41:43', '2012-11-16 10:42:57'),
(28, 53, 54, 5, 1, 1, 0, 1, 0, 0, 'tv', '2012-11-14 15:42:30', '2012-11-16 10:42:44'),
(29, 55, 56, 5, 1, 1, 0, 1, 0, 0, 'gallery', '2012-11-14 15:43:01', '2012-11-16 10:41:27'),
(30, 57, 58, 5, 1, 1, 0, 1, 0, 0, 'blog', '2012-11-14 15:43:43', '2012-11-16 10:42:09'),
(31, 59, 60, 5, 1, 1, 0, 1, 0, 0, 'magazine', '2012-11-14 15:44:23', '2012-11-16 10:41:55'),
(36, 4, 5, 7, 0, 1, 1, 1, 1, 1, NULL, '2012-11-20 14:26:59', '2012-11-20 14:29:36');

-- --------------------------------------------------------

--
-- Tablična struktura za tablicu `hns_pageCoverImage`
--

CREATE TABLE IF NOT EXISTS `hns_pageCoverImage` (
  `pageId` int(10) unsigned NOT NULL,
  `filename` char(36) COLLATE utf8_unicode_ci NOT NULL,
  `width` smallint(5) unsigned NOT NULL,
  `height` smallint(5) unsigned NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`pageId`),
  UNIQUE KEY `filename` (`filename`),
  KEY `hns_FK_pageCoverImageHasPage` (`pageId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
(1, 'eng', 'Home', 'Home', '', NULL, NULL, NULL, NULL, NULL, NULL, '2012-11-14 14:48:24', '2012-11-16 10:44:25'),
(1, 'hrv', 'Naslovnica', 'Naslovnica', '', NULL, NULL, NULL, NULL, NULL, NULL, '2012-11-14 14:48:24', '2012-11-16 10:44:25'),
(2, 'eng', 'HNS', 'HNS', 'hns', NULL, NULL, NULL, NULL, NULL, NULL, '2012-11-14 15:08:19', '2012-11-16 10:08:42'),
(2, 'hrv', 'HNS', 'HNS', 'hns', NULL, NULL, 'HNS', 'O HNS-u', 'HNS, nogomet, Hrvatska', NULL, '2012-11-14 15:08:19', '2012-11-16 10:08:42'),
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
(26, 'eng', 'News', 'News', 'news', NULL, NULL, NULL, NULL, NULL, 'Lorem ipsum dolor', '2012-11-14 15:41:00', '2012-11-16 10:43:11'),
(26, 'hrv', 'Novosti', 'Novosti', 'novosti', NULL, NULL, NULL, NULL, NULL, 'Lorem ipsum dolor', '2012-11-14 15:41:00', '2012-11-16 10:43:11'),
(27, 'eng', 'Actualities', 'Actualities', 'actualities', NULL, NULL, NULL, NULL, NULL, 'Lorem ipsum dolor', '2012-11-14 15:41:43', '2012-11-16 10:42:57'),
(27, 'hrv', 'Aktualnosti', 'Aktualnosti', 'aktualnosti', NULL, NULL, NULL, NULL, NULL, 'Lorem ipsum dolor', '2012-11-14 15:41:43', '2012-11-16 10:42:57'),
(28, 'eng', 'CFF TV', 'CFF TV', 'cff-tv', NULL, NULL, NULL, NULL, NULL, 'Lorem ipsum dolor', '2012-11-14 15:42:30', '2012-11-16 10:42:44'),
(28, 'hrv', 'HNS TV', 'HNS TV', 'hns-tv', NULL, NULL, NULL, NULL, NULL, 'Lorem ipsum dolor', '2012-11-14 15:42:30', '2012-11-16 10:42:44'),
(29, 'eng', 'Gallery', 'Gallery', 'gallery', NULL, NULL, NULL, NULL, NULL, 'Lorem ipsum dolor', '2012-11-14 15:43:01', '2012-11-16 10:41:27'),
(29, 'hrv', 'Galerija', 'Galerija', 'galerija', NULL, NULL, NULL, NULL, NULL, 'Lorem ipsum dolor', '2012-11-14 15:43:01', '2012-11-16 10:41:27'),
(30, 'eng', 'Blog', 'Blog', 'blog', NULL, NULL, NULL, NULL, NULL, 'Lorem ipsum dolor', '2012-11-14 15:43:43', '2012-11-16 10:42:09'),
(30, 'hrv', 'Blog', 'Blog', 'blog', NULL, NULL, NULL, NULL, NULL, 'Lorem ipsum dolor', '2012-11-14 15:43:43', '2012-11-16 10:42:09'),
(31, 'eng', 'CFF Magazine', 'CFF Magazine', 'cff-magazine', NULL, NULL, NULL, NULL, NULL, 'Lorem ipsum dolor', '2012-11-14 15:44:23', '2012-11-16 10:41:55'),
(31, 'hrv', 'HNS ÄŒasopis', 'HNS ÄŒasopis', 'hns-casopis', NULL, NULL, NULL, NULL, NULL, 'Lorem ipsum dolor', '2012-11-14 15:44:23', '2012-11-16 10:41:55'),
(36, 'hrv', 'Test', 'Test', 'test', '<p>When, while the lovely valley teems with vapour around me, and the meridian sun strikes the upper surface of the impenetrable foliage of my trees, and but a few stray gleams steal into the inner sanctuary, I throw myself down among the tall grass by the trickling stream; and, as I lie close to the earth, a thousand unknown plants are noticed by me: when I hear the buzz of the little world among the stalks, and grow familiar with the countless indescribable forms of the insects and flies, then I feel the presence of the Almighty, who formed us in his own image, and the breath of that universal love which bears and sustains us, as it floats around us in an eternity of bliss; and then, my friend, when darkness overspreads my eyes, and heaven and earth seem to dwell in my soul and absorb its power, like the form of a beloved mistress, then I often think with longing, Oh, would I could describe these conceptions, could impress upon paper all that is living so full and warm within me, that it might be the mirror of my soul, as my soul is the mirror of the infinite God!</p>\r\n<p>O my friend -- but it is too much for my strength -- I sink under the weight of the splendour of these visions! A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart. {{module44}} I am alone, and feel the charm of existence in this spot, which was created for the bliss of souls like mine. I am so happy, my dear friend, so absorbed in the exquisite sense of mere tranquil existence, that I neglect my talents. I should be incapable of drawing a single.</p>\r\n<p>I throw myself down among the tall grass by the trickling stream; and, as I lie close to the earth, a thousand unknown plants are noticed by me: when I hear the buzz of the little world among the stalks, and grow familiar with the countless indescribable forms of the insects and flies, then I feel the presence of the Almighty, who formed us in his own image, and the breath of that universal love which bears and sustains us, as it floats around us in an eternity of bliss; and then, my friend, when darkness overspreads my eyes, and heaven and earth seem to dwell in my soul and absorb its power, like the form of a beloved mistress, then I often think with longing.</p>\r\n<p>I sink under the weight of the splendour of these visions! A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart. I am alone, and feel the charm of existence in this spot, which was created for the bliss of souls like mine. I am so happy, my dear friend, so absorbed in the exquisite sense of mere tranquil existence, that I neglect my talents. I should be incapable of drawing a single.</p>\r\n<p>{{module45}}</p>\r\n<p>Player, who formed us in his own image, and the breath of that universal love which bears and sustains us, as it floats around us in an eternity of bliss; and then, my friend, when darkness overspreads my eyes, and heaven and earth seem to dwell in my soul and absorb its power, like the form of a beloved mistress, then I often think with longing.</p>', '<p>A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart. I am alone, and feel the charm of existence in this spot, which was created for the bliss of souls like mine.</p>', NULL, NULL, NULL, 'Test', '2012-11-20 14:26:59', '2012-11-20 14:29:36');

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

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `hns_vw_gallery` AS select `gallery`.`galleryId` AS `galleryId`,`galleryi18n`.`languageId` AS `languageId`,`galleryi18n`.`title` AS `title`,`galleryi18n`.`slug` AS `slug`,`galleryi18n`.`category` AS `category`,`gallery`.`created` AS `created`,`gallery`.`modified` AS `modified` from (`hns_gallery` `gallery` join `hns_galleryI18n` `galleryi18n` on((`gallery`.`galleryId` = `galleryi18n`.`galleryId`)));

-- --------------------------------------------------------

--
-- Struktura za pregledavanje `hns_vw_pagetree`
--
DROP TABLE IF EXISTS `hns_vw_pagetree`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `hns_vw_pagetree` AS select `page`.`pageId` AS `pageId`,`page`.`lft` AS `lft`,`page`.`rgt` AS `rgt`,`page`.`parentId` AS `parentId`,`pagei18n`.`languageId` AS `languageId`,(count(distinct `parent`.`pageId`) - 1) AS `depth`,group_concat(distinct `parenti18n`.`slug` separator '/') AS `fullUri`,`pagei18n`.`title` AS `title`,`pagei18n`.`navigationName` AS `navigationName`,`pagei18n`.`slug` AS `slug`,`pagei18n`.`content` AS `content`,`pagei18n`.`lead` AS `lead`,`pagei18n`.`metaTitle` AS `metaTitle`,`pagei18n`.`metaDescription` AS `metaDescription`,`pagei18n`.`metaKeywords` AS `metaKeywords`,`page`.`isException` AS `isException`,`page`.`isVisible` AS `isVisible`,`page`.`isEditable` AS `isEditable`,`page`.`isPublished` AS `isPublished`,`page`.`canAddChildren` AS `canAddChildren`,`page`.`canBeDeleted` AS `canBeDeleted`,`page`.`class` AS `class`,`pagei18n`.`navigationDescription` AS `navigationDescription`,`page`.`created` AS `created`,`page`.`modified` AS `modified` from ((((((`hns_page` `page` left join `hns_pageI18n` `pagei18n` on((`page`.`pageId` = `pagei18n`.`pageId`))) join `hns_language` `language` on((`pagei18n`.`languageId` = `language`.`languageId`))) left join `hns_page` `parentpage` on((`parentpage`.`pageId` = `page`.`parentId`))) join `hns_page` `parent`) left join `hns_pageI18n` `parenti18n` on(((`parent`.`pageId` = `parenti18n`.`pageId`) and (`parenti18n`.`languageId` = `pagei18n`.`languageId`)))) left join `hns_pageI18n` `parentpagei18n` on(((`page`.`parentId` = `parentpagei18n`.`pageId`) and (`parentpagei18n`.`languageId` = `pagei18n`.`languageId`)))) where (`page`.`lft` between `parent`.`lft` and `parent`.`rgt`) group by `page`.`pageId`,`language`.`languageId` order by `page`.`lft`;

-- --------------------------------------------------------

--
-- Struktura za pregledavanje `hns_vw_video`
--
DROP TABLE IF EXISTS `hns_vw_video`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `hns_vw_video` AS select `video`.`videoId` AS `videoId`,`videoi18n`.`languageId` AS `languageId`,`videoi18n`.`title` AS `title`,`videoi18n`.`slug` AS `slug`,`videoi18n`.`category` AS `category`,`video`.`youtubeUrl` AS `youtubeUrl`,`video`.`created` AS `created`,`video`.`modified` AS `modified` from (`hns_video` `video` join `hns_videoI18n` `videoi18n` on((`video`.`videoId` = `videoi18n`.`videoId`)));

--
-- Ograničenja za izbačene tablice
--

--
-- Ograničenja za tablicu `hns_actualityCoverImage`
--
ALTER TABLE `hns_actualityCoverImage`
  ADD CONSTRAINT `hns_actualitycoverimage_ibfk_1` FOREIGN KEY (`actualityId`) REFERENCES `hns_actuality` (`actualityId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograničenja za tablicu `hns_actualityHasCustomModule`
--
ALTER TABLE `hns_actualityHasCustomModule`
  ADD CONSTRAINT `hns_actualityhascustommodule_ibfk_1` FOREIGN KEY (`actualityId`) REFERENCES `hns_actuality` (`actualityId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `hns_actualityhascustommodule_ibfk_2` FOREIGN KEY (`customModuleId`) REFERENCES `hns_custommodule` (`customModuleId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograničenja za tablicu `hns_bannerImage`
--
ALTER TABLE `hns_bannerImage`
  ADD CONSTRAINT `hns_bannerImage_ibfk_1` FOREIGN KEY (`bannerId`) REFERENCES `hns_banner` (`bannerId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograničenja za tablicu `hns_customModuleHasNewsItem`
--
ALTER TABLE `hns_customModuleHasNewsItem`
  ADD CONSTRAINT `hns_custommodulehasnewsitem_ibfk_1` FOREIGN KEY (`customModuleId`) REFERENCES `hns_custommodule` (`customModuleId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `hns_custommodulehasnewsitem_ibfk_2` FOREIGN KEY (`newsItemId`) REFERENCES `hns_newsitem` (`newsItemId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograničenja za tablicu `hns_customModuleHasPage`
--
ALTER TABLE `hns_customModuleHasPage`
  ADD CONSTRAINT `hns_custommodulehaspage_ibfk_1` FOREIGN KEY (`customModuleId`) REFERENCES `hns_custommodule` (`customModuleId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `hns_custommodulehaspage_ibfk_2` FOREIGN KEY (`pageId`) REFERENCES `hns_page` (`pageId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograničenja za tablicu `hns_customModuleImage`
--
ALTER TABLE `hns_customModuleImage`
  ADD CONSTRAINT `hns_custommoduleimage_ibfk_1` FOREIGN KEY (`customModuleItemId`) REFERENCES `hns_custommoduleitem` (`customModuleItemId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograničenja za tablicu `hns_customModuleImageImage`
--
ALTER TABLE `hns_customModuleImageImage`
  ADD CONSTRAINT `hns_custommoduleimageimage_ibfk_1` FOREIGN KEY (`customModuleImageId`) REFERENCES `hns_custommoduleimage` (`customModuleImageId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograničenja za tablicu `hns_customModuleItem`
--
ALTER TABLE `hns_customModuleItem`
  ADD CONSTRAINT `hns_custommoduleitem_ibfk_1` FOREIGN KEY (`customModuleItemSizeId`) REFERENCES `hns_custommoduleitemsize` (`customModuleItemSizeId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `hns_custommoduleitem_ibfk_2` FOREIGN KEY (`customModuleId`) REFERENCES `hns_custommodule` (`customModuleId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograničenja za tablicu `hns_customModuleText`
--
ALTER TABLE `hns_customModuleText`
  ADD CONSTRAINT `hns_custommoduletext_ibfk_1` FOREIGN KEY (`customModuleItemId`) REFERENCES `hns_custommoduleitem` (`customModuleItemId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograničenja za tablicu `hns_galleryI18n`
--
ALTER TABLE `hns_galleryI18n`
  ADD CONSTRAINT `hns_galleryI18n_ibfk_1` FOREIGN KEY (`galleryId`) REFERENCES `hns_gallery` (`galleryId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `hns_galleryI18n_ibfk_2` FOREIGN KEY (`languageId`) REFERENCES `hns_language` (`languageId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograničenja za tablicu `hns_galleryImage`
--
ALTER TABLE `hns_galleryImage`
  ADD CONSTRAINT `hns_galleryImage_ibfk_1` FOREIGN KEY (`galleryId`) REFERENCES `hns_gallery` (`galleryId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograničenja za tablicu `hns_newsItemCoverImage`
--
ALTER TABLE `hns_newsItemCoverImage`
  ADD CONSTRAINT `hns_newsitemcoverimage_ibfk_1` FOREIGN KEY (`newsItemId`) REFERENCES `hns_newsitem` (`newsItemId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograničenja za tablicu `hns_page`
--
ALTER TABLE `hns_page`
  ADD CONSTRAINT `hns_page_ibfk_1` FOREIGN KEY (`parentId`) REFERENCES `hns_page` (`pageId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograničenja za tablicu `hns_pageCoverImage`
--
ALTER TABLE `hns_pageCoverImage`
  ADD CONSTRAINT `hns_pagecoverimage_ibfk_1` FOREIGN KEY (`pageId`) REFERENCES `hns_page` (`pageId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograničenja za tablicu `hns_pageI18n`
--
ALTER TABLE `hns_pageI18n`
  ADD CONSTRAINT `hns_pageI18n_ibfk_1` FOREIGN KEY (`pageId`) REFERENCES `hns_page` (`pageId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `hns_pageI18n_ibfk_2` FOREIGN KEY (`languageId`) REFERENCES `hns_language` (`languageId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograničenja za tablicu `hns_userHasUserRole`
--
ALTER TABLE `hns_userHasUserRole`
  ADD CONSTRAINT `hns_userHasUserRole_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `hns_user` (`userId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `hns_userHasUserRole_ibfk_2` FOREIGN KEY (`userRoleId`) REFERENCES `hns_userrole` (`userRoleId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograničenja za tablicu `hns_videoI18n`
--
ALTER TABLE `hns_videoI18n`
  ADD CONSTRAINT `hns_videoI18n_ibfk_1` FOREIGN KEY (`videoId`) REFERENCES `hns_video` (`videoId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `hns_videoI18n_ibfk_2` FOREIGN KEY (`languageId`) REFERENCES `hns_language` (`languageId`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
