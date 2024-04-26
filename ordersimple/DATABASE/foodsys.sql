-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Апр 26 2024 г., 10:49
-- Версия сервера: 10.4.32-MariaDB
-- Версия PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `foodsys`
--

DROP DATABASE IF EXISTS foodsys;
CREATE DATABASE foodsys;
USE foodsys;

-- --------------------------------------------------------

--
-- Структура таблицы `category`
--

CREATE TABLE `category` (
  `categoryid` int(11) NOT NULL,
  `catname` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `category`
--

INSERT INTO `category` (`categoryid`, `catname`) VALUES
(1, 'ПИЦЦА'),
(2, 'СОУСЫ'),
(11, 'ЧИЧА'),
(12, 'ЧИЧА2');

-- --------------------------------------------------------

--
-- Структура таблицы `ingridients`
--

CREATE TABLE `ingridients` (
  `ingridient_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `category_id` int(11) NOT NULL,
  `price` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `product`
--

CREATE TABLE `product` (
  `productid` int(11) NOT NULL,
  `categoryid` int(1) NOT NULL,
  `productname` varchar(30) NOT NULL,
  `price` double NOT NULL,
  `photo` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `product`
--

INSERT INTO `product` (`productid`, `categoryid`, `productname`, `price`, `photo`) VALUES
(1, 1, 'ПИЦЦА ЧИКАГО', 535, 'upload/1-1.jpg'),
(2, 1, 'ПИЦЦА КОЛЬЯРИ', 580, 'upload/2.jpg'),
(3, 1, 'ПИЦЦА ПЕППЕРОНИ', 600, 'upload/3.jpg'),
(4, 1, 'ПИЦЦА ЭЛЕОНОРА', 580, 'upload/4.jpg'),
(223, 11, 'ЧИЧА', 1111, '');

-- --------------------------------------------------------

--
-- Структура таблицы `purchase`
--

CREATE TABLE `purchase` (
  `purchaseid` int(11) NOT NULL,
  `customer` varchar(50) NOT NULL,
  `total` double NOT NULL,
  `date_purchase` datetime NOT NULL,
  `comment` varchar(150) DEFAULT NULL,
  `address` varchar(50) NOT NULL,
  `status_id` int(11) DEFAULT 0,
  `how_fast` varchar(10)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `purchase`
--

INSERT INTO `purchase` (`purchaseid`, `customer`, `total`, `date_purchase`, `comment`, `address`, `status_id`, `how_fast`) VALUES
(21, 'Дмитрий', 2226, '2024-04-26 10:14:28', 'мне по-кафу сделайсе)', 'ул. Пушкино, д.33', 0, NULL),
(24, 'sadfdsfsdfsdfsdfsdfsfs', 1715, '2024-04-26 11:16:47', '', 'ул. Пушкино, д.12', 4, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `purchase_detail`
--

CREATE TABLE `purchase_detail` (
  `pdid` int(11) NOT NULL,
  `purchaseid` int(11) NOT NULL,
  `productid` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `purchase_detail`
--

INSERT INTO `purchase_detail` (`pdid`, `purchaseid`, `productid`, `quantity`) VALUES
(19, 11, 2, 2),
(20, 12, 2, 3),
(21, 13, 2, 2),
(22, 14, 2, 1),
(23, 14, 3, 1),
(24, 15, 2, 2),
(25, 16, 3, 1),
(26, 16, 1, 1),
(27, 16, 4, 1),
(28, 17, 3, 1),
(29, 18, 223, 1),
(30, 19, 2, 1),
(31, 20, 2, 1),
(32, 20, 3, 1),
(33, 21, 2, 1),
(34, 21, 1, 1),
(35, 21, 223, 1),
(36, 22, 2, 1),
(37, 23, 2, 1),
(38, 24, 2, 1),
(39, 24, 3, 1),
(40, 24, 1, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `purchase_status`
--

CREATE TABLE `purchase_status` (
  `status_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `purchase_status`
--

INSERT INTO `purchase_status` (`status_id`, `name`) VALUES
(0, 'В обработке'),
(1, 'Принят'),
(2, 'На кухне'),
(3, 'В пути'),
(4, 'Доставлен'),
(5, 'Ожидает курьера');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `phone_number` varchar(11) NOT NULL,
  `password` varchar(30) NOT NULL,
  `email` varchar(100) NOT NULL,
  `role` varchar(30) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `first_name`, `phone_number`, `password`, `email`, `role`) VALUES
(0, 'Дмитрий', '79821860800', '123123', 'sdsadsda@mail.ru', 'cook'),
(1, 'asdasdasdada', '123123123', '123123', 'dkponich@gmail.com', 'manager'),
(23, 'sadfdsfsdfsdfsdfsdfsfs', '12312312312', '123123', 'adsfdfsdfsdfdsf@mail.ru', 'user'),
(24, 'Курьер', '123', '123123', 'privet@mail.ru', 'courier');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`categoryid`);

--
-- Индексы таблицы `ingridients`
--
ALTER TABLE `ingridients`
  ADD PRIMARY KEY (`ingridient_id`);

--
-- Индексы таблицы `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`productid`);

--
-- Индексы таблицы `purchase`
--
ALTER TABLE `purchase`
  ADD PRIMARY KEY (`purchaseid`);

--
-- Индексы таблицы `purchase_detail`
--
ALTER TABLE `purchase_detail`
  ADD PRIMARY KEY (`pdid`);

--
-- Индексы таблицы `purchase_status`
--
ALTER TABLE `purchase_status`
  ADD PRIMARY KEY (`status_id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `phone_number` (`phone_number`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `category`
--
ALTER TABLE `category`
  MODIFY `categoryid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT для таблицы `product`
--
ALTER TABLE `product`
  MODIFY `productid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=224;

--
-- AUTO_INCREMENT для таблицы `purchase_detail`
--
ALTER TABLE `purchase_detail`
  MODIFY `pdid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
