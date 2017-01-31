-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Gegenereerd op: 27 jan 2017 om 20:04
-- Serverversie: 10.1.16-MariaDB
-- PHP-versie: 7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `secure_programming`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `sw_chat`
--

CREATE TABLE `sw_chat` (
  `chat_id` int(11) NOT NULL,
  `chat_message` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL DEFAULT '0',
  `timemessage` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `sw_chat`
--

INSERT INTO `sw_chat` (`chat_id`, `chat_message`, `user_id`, `group_id`, `timemessage`) VALUES
(41, 'VGVzdA==', 6, 54661, '2017-01-27 19:54:58');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `sw_group`
--

CREATE TABLE `sw_group` (
  `group_id` int(11) NOT NULL,
  `group_name` varchar(45) NOT NULL,
  `group_description` text NOT NULL,
  `group_password` varchar(255) NOT NULL,
  `created_by` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `sw_group`
--

INSERT INTO `sw_group` (`group_id`, `group_name`, `group_description`, `group_password`, `created_by`) VALUES
(54660, 'YouTube', 'Share here your favorite YouTube videos. Password: 1234', '$6$rounds=7000$5880eff202051$b0DzntrlTU7ZGBD7oQCJGnfFIv8eLmODdSjXHRWTzvDHaArlbI0xYPMUzsPbeFRpk/8F2/sA7zz6dEAYe08O5/', 'Slmii92'),
(54661, 'Stenden University', 'Talk with your other colleges or students', '', 'Jack'),
(54662, 'TestGroep', 'Ok cool', '$6$rounds=7000$58812856e9dd1$EG020mC./L/sNha255.rbkZHM1/35oliv/c.tYh3W5XQCZvKom9XcyXO.XILwoS6I6nIYqaiIQaczjXTXZWm21', 'Kevin');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `sw_single_chat`
--

CREATE TABLE `sw_single_chat` (
  `chat_id` int(11) NOT NULL,
  `chat_message` text NOT NULL,
  `user_one_id` int(11) NOT NULL,
  `user_two_id` int(11) NOT NULL,
  `timemessage` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `visited` bit(1) NOT NULL DEFAULT b'0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `sw_single_chat`
--

INSERT INTO `sw_single_chat` (`chat_id`, `chat_message`, `user_one_id`, `user_two_id`, `timemessage`, `visited`) VALUES
(45, 'eW8gZ2Fw', 6, 3, '2017-01-27 20:03:14', b'0');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `sw_user`
--

CREATE TABLE `sw_user` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(45) NOT NULL,
  `user_firstname` varchar(45) NOT NULL,
  `user_lastname` varchar(45) NOT NULL,
  `user_email` varchar(45) NOT NULL,
  `user_password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `sw_user`
--

INSERT INTO `sw_user` (`user_id`, `user_name`, `user_firstname`, `user_lastname`, `user_email`, `user_password`) VALUES
(3, 'Slmii92', 'Selami', 'Cetinguney', 'selami.cetinguney@student.stenden.com', '$6$rounds=7000$573c197f1545f$2vJXQ4H8qYjPuPY09N5at1v07MxssJtksHv1yBxkpsueqYpXJ11NUnBO9CMQrQ.jnNt2.Vv5eEqZYrBoX9VGb0'),
(6, 'Kevin', 'Kevin', 'Vording', 'kevin.mike.vording@hotmail.com', '$6$rounds=7000$573c197f1545f$2vJXQ4H8qYjPuPY09N5at1v07MxssJtksHv1yBxkpsueqYpXJ11NUnBO9CMQrQ.jnNt2.Vv5eEqZYrBoX9VGb0'),
(14, 'Jack', 'Jack', 'Sparrow', 'jacksparrow@mail.com', '$6$rounds=7000$573c197f1545f$2vJXQ4H8qYjPuPY09N5at1v07MxssJtksHv1yBxkpsueqYpXJ11NUnBO9CMQrQ.jnNt2.Vv5eEqZYrBoX9VGb0'),
(15, 'test1', 'test1', 'test1achternaam', 'test1@mail.com', '$6$rounds=7000$5880f3de56313$EEYcyyrgO9/jWHKIiLk9buGGa3/aGuquAdy1WEkAH/sQePDslh.DfDZify6JvcaSgKi3lW0r9rTGmM4DMvW6C1'),
(16, 'test2', 'test2', 'test2achternaam', 'test2@mail.com', '$6$rounds=7000$5880f3de56313$EEYcyyrgO9/jWHKIiLk9buGGa3/aGuquAdy1WEkAH/sQePDslh.DfDZify6JvcaSgKi3lW0r9rTGmM4DMvW6C1'),
(17, 'test3', 'test3', 'test3achternaam', 'test3@mail.com', '$6$rounds=7000$5880f3de56313$EEYcyyrgO9/jWHKIiLk9buGGa3/aGuquAdy1WEkAH/sQePDslh.DfDZify6JvcaSgKi3lW0r9rTGmM4DMvW6C1'),
(18, 'test4', 'test4', 'test4achternaam', 'test4@mail.com', '$6$rounds=7000$5880f3de56313$EEYcyyrgO9/jWHKIiLk9buGGa3/aGuquAdy1WEkAH/sQePDslh.DfDZify6JvcaSgKi3lW0r9rTGmM4DMvW6C1'),
(19, 'test5', 'test5', 'test5achternaam', 'test5@mail.com', '$6$rounds=7000$5880f3de56313$EEYcyyrgO9/jWHKIiLk9buGGa3/aGuquAdy1WEkAH/sQePDslh.DfDZify6JvcaSgKi3lW0r9rTGmM4DMvW6C1'),
(20, 'test6', 'test6', 'test6achternaam', 'test6@mail.com', '$6$rounds=7000$5880f3de56313$EEYcyyrgO9/jWHKIiLk9buGGa3/aGuquAdy1WEkAH/sQePDslh.DfDZify6JvcaSgKi3lW0r9rTGmM4DMvW6C1'),
(21, 'test7', 'test7', 'test7achternaam', 'test7@mail.com', '$6$rounds=7000$5880f3de56313$EEYcyyrgO9/jWHKIiLk9buGGa3/aGuquAdy1WEkAH/sQePDslh.DfDZify6JvcaSgKi3lW0r9rTGmM4DMvW6C1');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `sw_user_group`
--

CREATE TABLE `sw_user_group` (
  `user_group_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_group_rights` int(11) NOT NULL DEFAULT '4'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `sw_user_group`
--

INSERT INTO `sw_user_group` (`user_group_id`, `group_id`, `user_id`, `user_group_rights`) VALUES
(66, 54660, 3, 1),
(67, 54661, 14, 1),
(77, 54660, 15, 2),
(78, 54660, 16, 2),
(79, 54660, 17, 2),
(80, 54660, 18, 2),
(81, 54660, 19, 2),
(82, 54660, 20, 2),
(83, 54660, 21, 2),
(84, 54661, 6, 2),
(85, 54662, 6, 1),
(86, 54662, 3, 4);

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `sw_chat`
--
ALTER TABLE `sw_chat`
  ADD PRIMARY KEY (`chat_id`);

--
-- Indexen voor tabel `sw_group`
--
ALTER TABLE `sw_group`
  ADD PRIMARY KEY (`group_id`);

--
-- Indexen voor tabel `sw_single_chat`
--
ALTER TABLE `sw_single_chat`
  ADD PRIMARY KEY (`chat_id`);

--
-- Indexen voor tabel `sw_user`
--
ALTER TABLE `sw_user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexen voor tabel `sw_user_group`
--
ALTER TABLE `sw_user_group`
  ADD PRIMARY KEY (`user_group_id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `sw_chat`
--
ALTER TABLE `sw_chat`
  MODIFY `chat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
--
-- AUTO_INCREMENT voor een tabel `sw_group`
--
ALTER TABLE `sw_group`
  MODIFY `group_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54663;
--
-- AUTO_INCREMENT voor een tabel `sw_single_chat`
--
ALTER TABLE `sw_single_chat`
  MODIFY `chat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
--
-- AUTO_INCREMENT voor een tabel `sw_user`
--
ALTER TABLE `sw_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT voor een tabel `sw_user_group`
--
ALTER TABLE `sw_user_group`
  MODIFY `user_group_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
