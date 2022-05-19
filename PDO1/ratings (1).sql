-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Май 16 2022 г., 17:41
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
-- База данных: `pdo_1db`
--

-- --------------------------------------------------------

--
-- Структура таблицы `ratings`
--

CREATE TABLE `ratings` (
  `id` varchar(11) NOT NULL,
  `total_votes` int NOT NULL DEFAULT '0',
  `total_value` int NOT NULL DEFAULT '0',
  `used_ips` longtext
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `ratings`
--

INSERT INTO `ratings` (`id`, `total_votes`, `total_value`, `used_ips`) VALUES
('id21', 1, 6, 'a:1:{i:0;s:9:\"127.0.0.1\";}'),
('id22', 1, 5, 'a:1:{i:0;s:9:\"127.0.0.1\";}'),
('id111', 1, 4, 'a:1:{i:0;s:9:\"127.0.0.1\";}'),
('id1', 1, 5, 'a:1:{i:0;s:9:\"127.0.0.1\";}'),
('2id', 1, 4, 'a:1:{i:0;s:9:\"127.0.0.1\";}'),
('3xx', 1, 4, 'a:1:{i:0;s:9:\"127.0.0.1\";}'),
('4test', 1, 5, 'a:1:{i:0;s:9:\"127.0.0.1\";}'),
('5560', 1, 5, 'a:1:{i:0;s:9:\"127.0.0.1\";}'),
('66234', 1, 7, 'a:1:{i:0;s:9:\"127.0.0.1\";}'),
('66334', 1, 7, 'a:1:{i:0;s:9:\"127.0.0.1\";}'),
('63334', 1, 7, 'a:1:{i:0;s:9:\"127.0.0.1\";}');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
