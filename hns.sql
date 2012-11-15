-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Računalo: localhost
-- Vrijeme generiranja: Stu 15, 2012 u 01:58 PM
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
  ADD CONSTRAINT `hns_pageI18n_ibfk_2` FOREIGN KEY (`languageId`) REFERENCES `hns_language` (`languageId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `hns_pageI18n_ibfk_1` FOREIGN KEY (`pageId`) REFERENCES `hns_page` (`pageId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograničenja za tablicu `hns_userHasUserRole`
--
ALTER TABLE `hns_userHasUserRole`
  ADD CONSTRAINT `hns_userHasUserRole_ibfk_2` FOREIGN KEY (`userRoleId`) REFERENCES `hns_userrole` (`userRoleId`) ON DELETE CASCADE ON UPDATE CASCADE,
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
