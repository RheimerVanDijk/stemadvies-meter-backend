# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.7.26)
# Database: stemwijzer
# Generation Time: 2021-01-26 16:05:26 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table political_parties
# ------------------------------------------------------------

DROP TABLE IF EXISTS `political_parties`;

CREATE TABLE `political_parties` (
  `party_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `x_position` tinyint(5) NOT NULL,
  `y_position` tinyint(5) NOT NULL,
  `amount_chosen` int(11) NOT NULL,
  `image` varchar(255) NOT NULL DEFAULT '../src/img/unknown.png',
  PRIMARY KEY (`party_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `political_parties` WRITE;
/*!40000 ALTER TABLE `political_parties` DISABLE KEYS */;

INSERT INTO `political_parties` (`party_id`, `name`, `x_position`, `y_position`, `amount_chosen`, `image`)
VALUES
	(1,'VVD',4,-1,0,'../src/img/vvd.png'),
	(2,'GroenLinks',-2,4,0,'../src/img/groenlinks.png'),
	(3,'PVV',0,-2,0,'../src/img/pvv.png'),
	(4,'SGP',2,-4,0,'../src/img/sgp.png'),
	(5,'D66',2,4,0,'../src/img/d66.png'),
	(6,'FVD',4,-1,0,'../src/img/fvd.png');

/*!40000 ALTER TABLE `political_parties` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table questions
# ------------------------------------------------------------

DROP TABLE IF EXISTS `questions`;

CREATE TABLE `questions` (
  `question_id` int(11) NOT NULL AUTO_INCREMENT,
  `question` varchar(255) NOT NULL,
  `axis` varchar(1) NOT NULL,
  `value` tinyint(5) NOT NULL,
  PRIMARY KEY (`question_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `questions` WRITE;
/*!40000 ALTER TABLE `questions` DISABLE KEYS */;

INSERT INTO `questions` (`question_id`, `question`, `axis`, `value`)
VALUES
	(1,'Rijkere mensen moeten meer belasting betalen dan armere mensen. ','x',-1),
	(2,'Er moet een belasting op de handel in aandelen komen. ','x',-1),
	(3,'De EU moet zich ervoor inzetten dat elke lidstaat een minimumloon invoert. ','x',-1),
	(4,'De EU moet minder geld uitgeven aan de ontwikkeling van arme gebieden binnen de EU? ','x',1),
	(5,'Het moet mogelijk worden om in alle EU-landen gelijktijdig een referendum te houden over Europese besluiten. ','x',1),
	(6,'De EU moet het verbouwen van genetisch gemodificeerde gewassen toestaan. ','x',1),
	(7,'De belastingkorting voor huizenbezitters zonder hypotheekschuld moet worden afgebouwd. ','x',1),
	(8,'Europa kiezen voor een permanente wintertijd. ','y',-1),
	(9,'Asielzoekers moeten evenredig over de EU-lidstaten worden verdeeld. ','y',-1),
	(10,'Nederland moet uit de euro stappen en weer een eigen munt invoeren. ','y',-1),
	(11,'De EU moet asielzoekers die proberen de Middellandse Zee over te steken, altijd terugsturen naar hun land van herkomst. ','y',-1),
	(12,'Er moet meer geld naar hulp aan arme landen buiten de EU. ','y',-1),
	(13,'Een deel van de Europese leningen aan Griekenland moet worden kwijtgescholden. ','y',1),
	(14,'Het moet moeilijker worden voor EU-burgers om in een ander land een uitkering te ontvangen. ','y',1),
	(15,'De EU moet lidstaten aanmoedigen om huwelijken tussen personen van hetzelfde geslacht te erkennen. ','y',1),
	(16,'Er moet meer geld naar hulp aan arme landen buiten de EU. ','y',1),
	(17,'De Europese afspraak om vingerafdrukken op te nemen in paspoorten moet worden geschrapt. ','y',1);

/*!40000 ALTER TABLE `questions` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
