-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Июн 20 2023 г., 08:58
-- Версия сервера: 10.4.28-MariaDB
-- Версия PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `apartamente`
--

-- --------------------------------------------------------

--
-- Структура таблицы `agent`
--

CREATE TABLE `agent` (
  `CodAgent` int(11) NOT NULL,
  `nume` varchar(30) NOT NULL,
  `prenume` varchar(30) NOT NULL,
  `virsta` int(11) NOT NULL,
  `telefon` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `agent`
--

INSERT INTO `agent` (`CodAgent`, `nume`, `prenume`, `virsta`, `telefon`) VALUES
(1, 'Smith', 'John', 28, '+37365412261'),
(2, 'Johnson', 'Michael', 32, '+37365412262'),
(3, 'Williams', 'Robert', 24, '+37365412263'),
(4, 'Brown', 'David', 29, '+37365412264'),
(5, 'Jones', 'James', 26, '+37365412265'),
(6, 'Miller', 'William', 31, '+37365412266'),
(7, 'Davis', 'Charles', 27, '+37365412267'),
(8, 'Wilson', 'Daniel', 30, '+37365412268'),
(9, 'Taylor', 'Christopher', 25, '+37365412269');

-- --------------------------------------------------------

--
-- Структура таблицы `apartament`
--

CREATE TABLE `apartament` (
  `CodApartament` int(11) NOT NULL,
  `etaj` int(11) NOT NULL,
  `nrCamere` int(11) NOT NULL,
  `Pret` float NOT NULL,
  `metriPatrati` int(11) NOT NULL,
  `CodAgent` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `apartament`
--

INSERT INTO `apartament` (`CodApartament`, `etaj`, `nrCamere`, `Pret`, `metriPatrati`, `CodAgent`) VALUES
(1, 2, 4, 200000, 100, 1),
(2, 3, 4, 210000, 110, 2),
(3, 2, 4, 220000, 120, 3),
(4, 3, 4, 230000, 130, 4),
(5, 2, 4, 240000, 140, 5),
(6, 3, 4, 250000, 150, 6),
(7, 2, 4, 260000, 160, 7),
(8, 3, 4, 270000, 170, 8),
(9, 2, 4, 280012, 180, 9);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `agent`
--
ALTER TABLE `agent`
  ADD PRIMARY KEY (`CodAgent`);

--
-- Индексы таблицы `apartament`
--
ALTER TABLE `apartament`
  ADD PRIMARY KEY (`CodApartament`),
  ADD KEY `CodAgent` (`CodAgent`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `agent`
--
ALTER TABLE `agent`
  MODIFY `CodAgent` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT для таблицы `apartament`
--
ALTER TABLE `apartament`
  MODIFY `CodApartament` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `apartament`
--
ALTER TABLE `apartament`
  ADD CONSTRAINT `apartament_ibfk_1` FOREIGN KEY (`CodAgent`) REFERENCES `agent` (`CodAgent`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
