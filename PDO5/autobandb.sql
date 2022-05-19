-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Май 18 2022 г., 14:49
-- Версия сервера: 8.0.24
-- Версия PHP: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `autobandb`
--

-- --------------------------------------------------------

--
-- Структура таблицы `all_visits`
--

CREATE TABLE `all_visits` (
  `id` smallint NOT NULL,
  `ip` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `date` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `all_visits`
--

INSERT INTO `all_visits` (`id`, `ip`, `date`) VALUES
(49, '127.0.0.1', 1652871808),
(50, '127.0.0.1', 1652871809),
(51, '127.0.0.1', 1652871817),
(52, '127.0.0.1', 1652871818),
(53, '127.0.0.1', 1652871818),
(54, '127.0.0.1', 1652871963),
(55, '127.0.0.1', 1652871964),
(56, '127.0.0.1', 1652871965),
(57, '127.0.0.1', 1652871965),
(58, '127.0.0.1', 1652872089),
(59, '127.0.0.1', 1652872091),
(60, '127.0.0.1', 1652872091),
(61, '127.0.0.1', 1652872092),
(62, '127.0.0.1', 1652874562),
(63, '127.0.0.1', 1652874564),
(64, '127.0.0.1', 1652874565),
(65, '127.0.0.1', 1652874565);

-- --------------------------------------------------------

--
-- Структура таблицы `black_list_ip`
--

CREATE TABLE `black_list_ip` (
  `id` smallint NOT NULL,
  `ip` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `black_list_ip`
--

INSERT INTO `black_list_ip` (`id`, `ip`, `date`) VALUES
(1, '127.0.0.1', '2022-05-18');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `all_visits`
--
ALTER TABLE `all_visits`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `black_list_ip`
--
ALTER TABLE `black_list_ip`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `all_visits`
--
ALTER TABLE `all_visits`
  MODIFY `id` smallint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT для таблицы `black_list_ip`
--
ALTER TABLE `black_list_ip`
  MODIFY `id` smallint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
