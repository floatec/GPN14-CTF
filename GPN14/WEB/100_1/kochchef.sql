DROP DATABASE IF EXISTS `kochchef`;
CREATE DATABASE `kochchef`;
USE `kochchef`;
/*
 Navicat Premium Data Transfer

 Source Server         : mysql horst
 Source Server Type    : MySQL
 Source Server Version : 50617
 Source Host           : localhost
 Source Database       : kochchef

 Target Server Type    : MySQL
 Target Server Version : 50617
 File Encoding         : utf-8

 Date: 06/12/2014 21:59:18 PM
*/

SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `members`
-- ----------------------------
DROP TABLE IF EXISTS `members`;
CREATE TABLE `members` (
  `memberID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `active` varchar(255) DEFAULT NULL,
  `resetToken` varchar(255) DEFAULT NULL,
  `resetComplete` varchar(3) DEFAULT 'No',
  PRIMARY KEY (`memberID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `members`
-- ----------------------------
BEGIN;
INSERT INTO `members` VALUES ('1', 'test2', '$2y$12$W3OPypBCBwET1CKeqKIgJuHaqE3EnwkmLSGkKyUUC3ugko/0sjhQi', 'test@test.de', 'abb6ede8091ebb2c86948ea9a617f5c9', null, 'No'), ('2', 'test', '$2y$12$T8vm/wKGAtjWx4jhK2Nd3OsQ6CTMV0ZEN548DwYrPqU/4JJl0/mJS', 'test2@test.de', 'Yes', null, 'No');
COMMIT;

-- ----------------------------
--  Table structure for `rezepte`
-- ----------------------------
DROP TABLE IF EXISTS `rezepte`;
CREATE TABLE `rezepte` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `sichtbar` bit(1) DEFAULT NULL,
  `beschreibung` text,
  `zutaten` text,
  PRIMARY KEY (`id`),
  KEY `user` (`user`),
  KEY `user_idx` (`user`),
  KEY `user_2` (`user`),
  KEY `user_3` (`user`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `rezepte`
-- ----------------------------
BEGIN;
INSERT INTO `rezepte` VALUES ('1', 'test', 'test', b'0', 'test', 'test'), ('2', null, 'test', null, 'test', 'test'), ('3', 'Eva Entropa', 'Gulasch Bytes', null, 'Da es mittlerweile unzÃ¤hlige \"originale\" und \"echte\" Rezepte fÃ¼r ungarischen Gulasch gibt, mÃ¶chte ich meins, was wohl dass gÃ¤ngigste in Lokalen am Balaton und allgemein in Ungarn ist, fÃ¼r alle freigeben die auf der Suche nach dem leckeren Gulasch, bzw. PÃ¶rkÃ¶lt wie aus dem Urlaub sind.\r\n\r\nDie Zwiebeln und den Knoblauch klein hacken und in eine Pfanne geben.\r\nDen Gulasch in mundgerechte StÃ¼cke schneiden (besser zu klein als zu groÃŸ) und mit in die Pfanne geben. Den Gulasch salzen. Jetzt mit den Zwiebeln und Knoblauch vermischen, mit ein paar Tropfen Zitronensaftkonzentrat betrÃ¤ufeln, Deckel drauf und ca. 60 Minuten ziehen lassen.\r\n\r\nNach 60 Minuten:\r\nEinen guten Schuss SonnenblumenÃ¶l (wichtig: kein OlivenÃ¶l oder Ã¤hnliches verwenden, wegen dem starken Eigengeschmack) in die Pfanne geben und den Gulasch ca. 10 Minuten bei hÃ¶chster Hitze anbraten. \r\nDanach bei nierdrigerer Hitze (Stufe 4, bzw. 2/3 der vollen Leistung eines Herdes) ca. 15 Minuten weiterbraten.\r\n\r\nJetzt 500 ml Wasser in die Pfanne geben, eine Prise KÃ¼mmel und einen guten TeelÃ¶ffel BrÃ¼he zugeben, alles gut verrÃ¼hren und bei gleichbleibender Hitze unter gelegentlichem umrÃ¼hren ca. 40 Minuten ohne Deckel kÃ¶cheln lassen (bis das Wasser vollkommen verkocht ist).\r\nNun 500 ml Wasser in einem Messbecher mit ca. 100 g Tomatenmark, 1 guten TeelÃ¶ffel Paprika edelsÃ¼ÃŸ, einer Prise Paprika rosenscharf, Majoran, Pfeffer und noch etwas KÃ¼mmel wÃ¼rzen und in die Pfanne geben.\r\nDas Ganze bei niedrigerer Hitze (Stufe 2, bzw. 1/3 der vollen Leistung des Herdes) jetzt nochmal ca. 30 Minuten mit Deckel bei gelegentlichem umrÃ¼hren kÃ¶cheln lassen.\r\nFertig.\r\n\r\nAls Beilage nimmt man idealerweise Nockerln aber auch kleine Frischei - Spiralnudeln eignen sich sehr gut und sehen den Nockerln ja fast Ã¤hnlich.\r\n\r\nViel SpaÃŸ beim Nachkochen und Guten Appetit, bzw. jÃ³ Ã©tvÃ¡gy.', 'Fleisch, SoÃŸe und eine Extra portion $sqrts{771aa6aa3915fdecf36e220357d6a458}'), ('4', 'Maria', 'PÃ¶rkÃ¶lt - Ungarisches Gulasch', b'1', 'Fleisch in ca. 2 cm WÃ¼rfel schneiden und mit Salz und Pfeffer wÃ¼rzen. Zwiebel grob hacken und die Paprikaschoten in Streifen schneiden.\r\n\r\nIn einem mÃ¶glichst groÃŸen Topf das Fett erhitzen und das Fleisch (und den Speck) nach und nach scharf anbraten. Die Zwiebeln und den Knoblauch dazu und weiter schmoren lassen, bis diese glasig werden. Jetzt die Paprikaschoten dazu und bei geschlossenem Deckel nochmal ca. 5 Min. weiterschmoren lassen. \r\n\r\nLorbeerblatt und KÃ¼mmel und Tomatenmark dazu und mit dem Wasser aufgieÃŸen. (Sollte ca. 1 cm bedeckt sein). Aufkochen und sehr krÃ¤ftig mit Paprikapulver und evtl. Chilipulver abschmecken. Jetzt bei kleiner Hitze etwa 60 - 90 Minuten kÃ¶cheln lassen (hin und wieder umrÃ¼hren, damit am Boden nichts anbrennt). Nochmals krÃ¤ftig abschmecken. Bindung mit Mehl oder StÃ¤rke ist nicht nÃ¶tig.\r\n\r\nVom Herd nehmen, die CrÃ¨me fraiche unterrÃ¼hren und mit der Petersilie bestreut servieren. Dazu kÃ¶rniger Reis oder Nudeln (Fusilli, Farfalle, Rigatoni) oder auch Stampfkartoffeln.\r\n\r\nDas Ganze lÃ¤sst sich portionsweise problemlos einfrieren. Ich bin Single, aber kleinere Portionen lassen sich leider nicht zubereiten.', '\r\n500 g	 Rindfleisch\r\n100 g	 Schweinefleisch\r\n3 groÃŸe	 Zwiebel(n), ca. 700 - 1000 g\r\n2 	 Paprikaschote(n), rote\r\n50 g	 Speck, durchwachsen, klein gewÃ¼rfelt\r\n1 	 Knoblauchzehe(n), fein gewÃ¼rfelt\r\n1/2 TL	 KÃ¼mmel\r\n 	 Salz und Pfeffer\r\n 	 Paprikapulver, rosenscharf\r\n3 EL	 Schweineschmalz oder Ã–l\r\n200 g	 CrÃ¨me fraÃ®che oder Schmand\r\n1 Bund	 Petersilie, fein gehackt\r\n1/2 Liter	 Wasser, heiÃŸes oder BrÃ¼he\r\n1 	 Lorbeerblatt\r\n2 EL	 Tomatenmark\r\n1 TL	 Chilipulver, evtl.'), ('5', 'Josef', 'Feiner Jagdgulasch', b'1', 'Einen entsprechenden Topf in der KÃ¼che suchen. Das Ã–l darinnen erhitzen und den ordentlich klein gewÃ¼rfelten Speck auch darinnen anschwitzen - glasig, mehr nicht. Das Wildfleisch in nicht zu groÃŸe, aber mundgerechte StÃ¼cke schneiden. Die unter TrÃ¤nen geschÃ¤lten Zwiebeln anschlieÃŸend recht fein zurechtwÃ¼rfeln. Das SuppengemÃ¼se sauber hinkriegen und ebenfalls zurechtwÃ¼rfeln. Das Gulaschfleisch zum angeschwitzten Speck geben, ordentlich Farbe nehmen lassen. ZwiebelwÃ¼rfelchen hinterher, kurz mitschwitzen. GewÃ¼rfeltes SuppengemÃ¼se dazu, anrÃ¶sten und die MehlbestÃ¤ubung mittels LÃ¶ffel durchfÃ¼hren. Dem Mehl etwas Farbe gÃ¶nnen. Mit dem roten Rotwein ablÃ¶schen, mit heiÃŸer FleischbrÃ¼he nachfÃ¼llen und die gebundene BratensoÃŸe einfach ungebunden dazugeben. Den frischen Thymian verlesen, auswaschen, sehr fein zurechthacken und zum Wildgulasch geben. Mit Salz und Pfeffer wÃ¼rzen. Die PreiselbeerkonfitÃ¼re und den scharfen Senf unterrÃ¼hren. Alles so 50 Minuten lang bei mittlerer Gulaschkochhitze kÃ¶cheln lassen. Dann die halbsteif geschlagene Sahne unter das Wildgulasch ziehen. Dabei mit dem KÃ¶cheln aufhÃ¶ren. \r\nDazu reicht man duftende Kartoffelkroketten, die als Fertigprodukt auf dem Backblech nach Vorschrift bereitet werden, und einen frisch zubereiteten Salatgurken-Salat mit Senf und frisch gerÃ¶steten WeiÃŸbrotwÃ¼rfelchen. Und der Ã¼brig gebliebene trockene Rotwein rundet dieses Mahl hervorragend ab. ', '\r\n2 EL	 Ã–l\r\n50 g	 Speck, durchwachsener\r\n600 g	 Wildfleisch - Reh, Hirsch oder anderes fÃ¼r Gulasch\r\n2 	 Zwiebel(n)\r\n1 Bund	 SuppengemÃ¼se\r\n2 EL	 Mehl\r\n1 Tasse/n	 Wein, rot\r\n1/4 Liter	 FleischbrÃ¼he, auch Instant\r\n1/4 Liter	 Bratensaft, gebunden - auch fertige SoÃŸe\r\n1 Bund	 Thymian\r\n 	 Salz\r\n 	 Pfeffer, aus der MÃ¼hle\r\n2 EL	 KonfitÃ¼re (PreiselbeerkonfitÃ¼re)\r\n2 EL	 Senf, scharfer\r\n1 Becher	 sÃ¼ÃŸe Sahne\r\n wenig	 SpeisestÃ¤rke'), ('6', null, 'test', null, 'tets', 'teeststsstt');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;



GRANT USAGE ON *.* TO 'chef'@'127.0.0.1' IDENTIFIED BY 'kochkoch'
WITH MAX_QUERIES_PER_HOUR 0
MAX_UPDATES_PER_HOUR 0
MAX_CONNECTIONS_PER_HOUR 0;

GRANT Insert, Select, Index, Update ON `kochchef`.* TO `chef`@`127.0.0.1`;


GRANT USAGE ON *.* TO 'dummy'@'127.0.0.1' IDENTIFIED BY 'dumdumdum'
WITH MAX_QUERIES_PER_HOUR 0
MAX_UPDATES_PER_HOUR 0
MAX_CONNECTIONS_PER_HOUR 0;

GRANT Select ON TABLE `kochchef`.`rezepte` TO `dummy`@`127.0.0.1`;
