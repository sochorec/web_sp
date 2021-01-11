-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Počítač: 127.0.0.1
-- Vytvořeno: Pon 11. led 2021, 06:30
-- Verze serveru: 5.7.17
-- Verze PHP: 7.1.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáze: `music_db`
--

-- --------------------------------------------------------

--
-- Struktura tabulky `permission`
--

CREATE TABLE `permission` (
  `id_permission` int(11) NOT NULL,
  `name` varchar(20) COLLATE utf8_czech_ci NOT NULL,
  `weight` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Vypisuji data pro tabulku `permission`
--

INSERT INTO `permission` (`id_permission`, `name`, `weight`) VALUES
(1, 'admin', 3),
(2, 'moderator', 2),
(3, 'registered', 1);

-- --------------------------------------------------------

--
-- Struktura tabulky `review`
--

CREATE TABLE `review` (
  `rating` int(11) NOT NULL,
  `review_text` varchar(500) COLLATE utf8_czech_ci NOT NULL,
  `hidden` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_song` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Vypisuji data pro tabulku `review`
--

INSERT INTO `review` (`rating`, `review_text`, `hidden`, `id_user`, `id_song`) VALUES
(9, 'LOREM IPSUM GENERATOR\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam', 0, 3, 2),
(7, 'LOREM IPSUM GENERATOR\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam', 0, 3, 11),
(4, ':)', 0, 3, 12),
(7, 'dobrý večer', 0, 6, 3),
(10, 'nice', 0, 6, 10),
(4, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', 0, 10, 2),
(6, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', 0, 10, 4),
(10, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', 0, 10, 9),
(9, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', 0, 10, 10),
(2, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', 0, 10, 11);

-- --------------------------------------------------------

--
-- Struktura tabulky `song`
--

CREATE TABLE `song` (
  `id_song` int(11) NOT NULL,
  `name` varchar(45) COLLATE utf8_czech_ci NOT NULL,
  `interpret` varchar(45) COLLATE utf8_czech_ci NOT NULL,
  `lenght` int(11) NOT NULL,
  `year` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Vypisuji data pro tabulku `song`
--

INSERT INTO `song` (`id_song`, `name`, `interpret`, `lenght`, `year`) VALUES
(2, 'Echoes', 'Pink Floyd', 1414, 1970),
(3, 'Roundabout', 'Yes', 509, 1971),
(4, 'Soft and Wet', 'Prince', 181, 1977),
(8, 'One More Time', 'Daft Punk', 320, 2000),
(9, 'Dani California', 'Red Hot Chilli Peppers', 288, 2006),
(10, 'Stairway to heaven', 'Led Zeppelin', 658, 1970),
(11, 'Feel Good Inc.', 'Gorillaz', 254, 2005),
(12, 'American Idiot', 'Green Day', 175, 2004);

-- --------------------------------------------------------

--
-- Struktura tabulky `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `id_permission` int(11) NOT NULL,
  `login` varchar(64) COLLATE utf8_czech_ci NOT NULL,
  `password` varchar(64) COLLATE utf8_czech_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Vypisuji data pro tabulku `user`
--

INSERT INTO `user` (`id_user`, `id_permission`, `login`, `password`) VALUES
(3, 1, 'admin', '$2y$10$i5HjIQ7BBFE.wG1UehScqeF/2gkaim9cGHHiHvNl7MDHmVmBtyo76'),
(6, 2, 'mod', '$2y$10$mQ277cpUpjJ0r2ZDpNgbl.JP8eHvvpaYpCQmgyoAMZWl1Fzm6hSbG'),
(8, 3, 'registered', '$2y$10$Nb9zSQUnxfVZRdnLFDgV8.F05ib35N90QyiLB8ntX7mR/MQdRGFPi'),
(10, 3, 'Thomas Jefferson', '$2y$10$CkLtYYqY8W3CsoMu2NS.3eydViQBRulGLI8Dc9B0H1dDhtddPdUcO');

--
-- Klíče pro exportované tabulky
--

--
-- Klíče pro tabulku `permission`
--
ALTER TABLE `permission`
  ADD PRIMARY KEY (`id_permission`);

--
-- Klíče pro tabulku `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`id_user`,`id_song`),
  ADD KEY `fk_reviews_user1_idx` (`id_user`),
  ADD KEY `fk_review_song1_idx` (`id_song`);

--
-- Klíče pro tabulku `song`
--
ALTER TABLE `song`
  ADD PRIMARY KEY (`id_song`);

--
-- Klíče pro tabulku `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `fk_user_permission_id_permission_idx` (`id_permission`);

--
-- AUTO_INCREMENT pro tabulky
--

--
-- AUTO_INCREMENT pro tabulku `permission`
--
ALTER TABLE `permission`
  MODIFY `id_permission` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pro tabulku `song`
--
ALTER TABLE `song`
  MODIFY `id_song` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT pro tabulku `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- Omezení pro exportované tabulky
--

--
-- Omezení pro tabulku `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `fk_review_song1` FOREIGN KEY (`id_song`) REFERENCES `song` (`id_song`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_reviews_user1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Omezení pro tabulku `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `fk_user_permission_id_permission` FOREIGN KEY (`id_permission`) REFERENCES `permission` (`id_permission`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
