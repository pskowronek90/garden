-- phpMyAdmin SQL Dump
-- version 4.7.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Czas generowania: 11 Maj 2018, 20:25
-- Wersja serwera: 5.7.18
-- Wersja PHP: 7.0.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `floracare`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Zrzut danych tabeli `category`
--

INSERT INTO `category` (`id`, `type`) VALUES
(1, 'Development'),
(2, 'Design'),
(3, 'Update'),
(4, 'Other');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `comment`
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `content` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `task_id` int(11) DEFAULT NULL,
  `timestamp` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Zrzut danych tabeli `comment`
--

INSERT INTO `comment` (`id`, `content`, `task_id`, `timestamp`) VALUES
(1, 'Kupiłem narzędzia', 8, '2018-05-11 19:26:16'),
(2, 'Some', 9, '2018-05-11 19:26:16'),
(3, 'Zacząłem się brać za robotę', 8, '2018-05-11 19:26:16'),
(4, 'Browca Wypiłem', 8, '2018-05-11 19:26:16'),
(5, 'Zadanie skończyłem', 8, '2018-05-11 19:26:16'),
(6, 'Poprawki zrobiłem', 8, '2018-05-11 19:26:16'),
(7, 'Poszedłem do sklepu', 10, '2018-05-11 20:15:39');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `plant`
--

CREATE TABLE `plant` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `photo` longtext COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Zrzut danych tabeli `plant`
--

INSERT INTO `plant` (`id`, `name`, `description`, `photo`, `user_id`) VALUES
(3, 'Begonie', 'Moje', '0dacba337019ed28e42c5bb2931c3e2d..jpeg', 4),
(5, 'Tulipany', 'dsds', 'fefa86ea36b3c60fdf2fe2350a3d15b8..jpeg', 4),
(6, 'Drzewka', 'dsd', 'a74d8d001c43ac5d1c0d6ed53dcf0b3b..jpeg', 1),
(7, 'Irys', 'Irys', '3fa89c649d22469dec97fa0f4c100101..jpeg', 4),
(8, 'Pink Flower', 'Pink', 'f0c09ddeef5a638c06c006524ad2b4d0..jpeg', 4),
(11, 'Kwiotuszek', 'dsd', '827b5065f403ca398c7d59587ff00ec1..jpeg', 5);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `post`
--

CREATE TABLE `post` (
  `id` int(11) NOT NULL,
  `subject` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `category` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `short` longtext COLLATE utf8_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8_unicode_ci NOT NULL,
  `date` datetime NOT NULL,
  `photo` longtext COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Zrzut danych tabeli `post`
--

INSERT INTO `post` (`id`, `subject`, `category`, `short`, `content`, `date`, `photo`) VALUES
(8, 'Some Stuff', 'Development', 'Some test post', 'Some text', '2018-04-07 22:05:54', 'blog1.jpg'),
(9, 'Update 11/12/2018', 'Update', 'New Stuff', 'I wanna test list\r\n\r\n- New element 1\r\n- New Element 2\r\n\r\n#Fixed1\r\n#Fixed3', '2018-04-07 22:06:39', 'blog2.jpeg'),
(10, 'Lorem Ipsum', 'Other', 'Wierd', 'rwestdyfuil\r\n\r\n- dsfsd', '2018-04-07 22:06:58', 'blog2.jpeg'),
(12, 'Sesame snaps', 'Other', 'Halvah jelly beans biscuit toffee carrot cake apple', '<ul>\r\n<li>kgkgh</li>\r\n<li>kgjgjh</li>\r\n</ul>', '2018-04-07 22:32:28', 'blog1.jpg'),
(13, 'Sesame snaps', 'Design', 'dsfg', '<h1>Dupa</h1>\r\n<p>sfsfsfsfs<p>\r\n<ul>\r\n<li>sgdfgdfgdfg</li>\r\n</ul>', '2018-04-07 22:42:05', 'blog1.jpg'),
(14, 'Working Demo!', 'Development', 'Final Release', 'Working demo!', '2018-05-06 16:36:56', 'snap2.png');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `task`
--

CREATE TABLE `task` (
  `id` int(11) NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `plant_id` int(11) DEFAULT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Zrzut danych tabeli `task`
--

INSERT INTO `task` (`id`, `description`, `date`, `plant_id`, `status`, `user_id`) VALUES
(8, 'Wypielić ogródek', '2018-05-14', 5, '1', 4),
(9, 'Podlać kwiaty', '2018-05-21', 3, '1', 4),
(10, 'Kupić nawóz', '2018-05-14', 3, '1', 4),
(11, 'Przenieść kwiatek', '2018-05-28', 3, '0', 4),
(12, 'Kupić nawóz', '2018-05-28', 6, '0', 5),
(13, 'dsdsd', '2018-05-07', 3, '1', 5),
(14, 'dsd', '2018-05-07', 7, '1', 5),
(15, 'Kopanie rowów', '2018-05-07', 5, '1', 4),
(16, 'Odpoczynek', '2018-05-07', 5, '1', 4),
(17, 'Dupa Dupa', '2018-05-14', 11, '1', 5),
(18, 'Coś tam', '2018-05-21', 8, '1', 4);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Zrzut danych tabeli `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `password`) VALUES
(1, 'dsd', 'zbychu@wp.pl', '$2y$10$qs5XWsyfVkmPcaXXuEEJHuU1wbKPBsK/g1PsyOkPkv0pGIWkNL18O'),
(4, 'testing', 'test2@test.pl', '$2y$10$tPeJIppNEcmJxed.DhWKDeNFJzHi3FntndHbC7qdAVMAEUg52C9Y.'),
(5, 'dupa', 'dupa@aaa.pl', '$2y$10$HXGQr0KvC3esxo1XGWApcOQWOjrpOY9c9p.8aQ0capwzf6NhLtLXW');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_9474526C8DB60186` (`task_id`);

--
-- Indexes for table `plant`
--
ALTER TABLE `plant`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_AB030D72A76ED395` (`user_id`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_527EDB251D935652` (`plant_id`),
  ADD KEY `IDX_527EDB25A76ED395` (`user_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT dla tabeli `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT dla tabeli `plant`
--
ALTER TABLE `plant`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT dla tabeli `post`
--
ALTER TABLE `post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT dla tabeli `task`
--
ALTER TABLE `task`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT dla tabeli `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `FK_9474526C8DB60186` FOREIGN KEY (`task_id`) REFERENCES `task` (`id`);

--
-- Ograniczenia dla tabeli `plant`
--
ALTER TABLE `plant`
  ADD CONSTRAINT `FK_AB030D72A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Ograniczenia dla tabeli `task`
--
ALTER TABLE `task`
  ADD CONSTRAINT `FK_527EDB251D935652` FOREIGN KEY (`plant_id`) REFERENCES `plant` (`id`),
  ADD CONSTRAINT `FK_527EDB25A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
