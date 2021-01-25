-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 16 dec 2020 om 13:36
-- Serverversie: 10.3.15-MariaDB
-- PHP-versie: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `stemwijzer`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `political_parties`
--

CREATE TABLE `political_parties` (
  `party_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `x_position` tinyint(5) NOT NULL,
  `y_position` tinyint(5) NOT NULL,
  `ammount_chosen` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `political_parties`
--

INSERT INTO `political_parties` (`party_id`, `name`, `x_position`, `y_position`, `ammount_chosen`) VALUES
(1, 'VVD', 4, -1, 0),
(2, 'GroenLinks', -2, 4, 0),
(3, 'PVV', 0, -2, 0),
(4, 'SGP', 2, -4, 0),
(5, 'D66', 2, 4, 0);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `questions`
--

CREATE TABLE `questions` (
  `question_id` int(11) NOT NULL,
  `question` varchar(255) NOT NULL,
  `axis` varchar(1) NOT NULL,
  `value` tinyint(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `questions`
--

INSERT INTO `questions` (`question_id`, `question`, `axis`, `value`) VALUES
(1, 'Rijkere mensen moeten meer belasting betalen dan armere mensen. ', 'x', -1),
(2, 'Er moet een belasting op de handel in aandelen komen. ', 'x', -1),
(3, 'De EU moet zich ervoor inzetten dat elke lidstaat een minimumloon invoert. ', 'x', -1),
(4, 'De EU moet minder geld uitgeven aan de ontwikkeling van arme gebieden binnen de EU? ', 'x', 1),
(5, 'Het moet mogelijk worden om in alle EU-landen gelijktijdig een referendum te houden over Europese besluiten. ', 'x', 1),
(6, 'De EU moet het verbouwen van genetisch gemodificeerde gewassen toestaan. ', 'x', 1),
(7, 'De belastingkorting voor huizenbezitters zonder hypotheekschuld moet worden afgebouwd. ', 'x', 1),
(8, 'Europa kiezen voor een permanente wintertijd. ', 'y', -1),
(9, 'Asielzoekers moeten evenredig over de EU-lidstaten worden verdeeld. ', 'y', -1),
(10, 'Nederland moet uit de euro stappen en weer een eigen munt invoeren. ', 'y', -1),
(11, 'De EU moet asielzoekers die proberen de Middellandse Zee over te steken, altijd terugsturen naar hun land van herkomst. ', 'y', -1),
(12, 'Er moet meer geld naar hulp aan arme landen buiten de EU. ', 'y', -1),
(13, 'Een deel van de Europese leningen aan Griekenland moet worden kwijtgescholden. ', 'y', 1),
(14, 'Het moet moeilijker worden voor EU-burgers om in een ander land een uitkering te ontvangen. ', 'y', 1),
(15, 'De EU moet lidstaten aanmoedigen om huwelijken tussen personen van hetzelfde geslacht te erkennen. ', 'y', 1),
(16, 'Er moet meer geld naar hulp aan arme landen buiten de EU. ', 'y', 1),
(17, 'De Europese afspraak om vingerafdrukken op te nemen in paspoorten moet worden geschrapt. ', 'y', 1);

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `political_parties`
--
ALTER TABLE `political_parties`
  ADD PRIMARY KEY (`party_id`);

--
-- Indexen voor tabel `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`question_id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `political_parties`
--
ALTER TABLE `political_parties`
  MODIFY `party_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT voor een tabel `questions`
--
ALTER TABLE `questions`
  MODIFY `question_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
