-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Май 03 2017 г., 11:27
-- Версия сервера: 5.7.17-11-log
-- Версия PHP: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `host1582112`
--

-- --------------------------------------------------------

--
-- Структура таблицы `change_email`
--

CREATE TABLE `change_email` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `pass` text NOT NULL,
  `new_email` varchar(255) NOT NULL,
  `time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=cp1251;

-- --------------------------------------------------------

--
-- Структура таблицы `config_test`
--

CREATE TABLE `config_test` (
  `id` int(11) NOT NULL,
  `id_name` int(11) NOT NULL,
  `id_direct` int(11) NOT NULL,
  `id_sub` int(11) NOT NULL,
  `kolvo_quest` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=cp1251;

-- --------------------------------------------------------

--
-- Структура таблицы `directions`
--

CREATE TABLE `directions` (
  `id` int(11) NOT NULL,
  `name` text CHARACTER SET cp1251 COLLATE cp1251_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=cp1251;

--
-- Дамп данных таблицы `directions`
--

INSERT INTO `directions` (`id`, `name`) VALUES
(40, 'Экономика'),
(43, 'Микроэкономика'),
(44, 'Макроэкономика'),
(45, 'История экономических учений');

-- --------------------------------------------------------

--
-- Структура таблицы `list_students`
--

CREATE TABLE `list_students` (
  `id` int(11) NOT NULL,
  `id_group` int(11) NOT NULL,
  `surname` varchar(255) CHARACTER SET cp1251 COLLATE cp1251_bin NOT NULL,
  `name` varchar(255) CHARACTER SET cp1251 COLLATE cp1251_bin NOT NULL,
  `thirdName` varchar(255) CHARACTER SET cp1251 COLLATE cp1251_bin NOT NULL,
  `login` varchar(255) CHARACTER SET cp1251 COLLATE cp1251_bin NOT NULL,
  `password` varchar(255) CHARACTER SET cp1251 COLLATE cp1251_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=cp1251;

-- --------------------------------------------------------

--
-- Структура таблицы `name_test`
--

CREATE TABLE `name_test` (
  `id` int(11) NOT NULL,
  `id_group` int(11) NOT NULL,
  `name` text CHARACTER SET cp1251 COLLATE cp1251_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=cp1251;

-- --------------------------------------------------------

--
-- Структура таблицы `question`
--

CREATE TABLE `question` (
  `id` int(11) NOT NULL,
  `id_sub` int(11) NOT NULL,
  `name` text CHARACTER SET cp1251 COLLATE cp1251_bin NOT NULL,
  `var1` text CHARACTER SET cp1251 COLLATE cp1251_bin NOT NULL,
  `var2` text CHARACTER SET cp1251 COLLATE cp1251_bin NOT NULL,
  `var3` text CHARACTER SET cp1251 COLLATE cp1251_bin NOT NULL,
  `var4` text CHARACTER SET cp1251 COLLATE cp1251_bin NOT NULL,
  `var5` text CHARACTER SET cp1251 COLLATE cp1251_bin NOT NULL,
  `var6` text CHARACTER SET cp1251 COLLATE cp1251_bin NOT NULL,
  `ans1` varchar(255) CHARACTER SET cp1251 COLLATE cp1251_bin NOT NULL,
  `ans2` varchar(255) CHARACTER SET cp1251 COLLATE cp1251_bin NOT NULL,
  `ans3` varchar(255) CHARACTER SET cp1251 COLLATE cp1251_bin NOT NULL,
  `ans4` varchar(255) CHARACTER SET cp1251 COLLATE cp1251_bin NOT NULL,
  `ans5` varchar(255) CHARACTER SET cp1251 COLLATE cp1251_bin NOT NULL,
  `ans6` varchar(255) CHARACTER SET cp1251 COLLATE cp1251_bin NOT NULL,
  `image` text NOT NULL,
  `extension` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=cp1251;

-- --------------------------------------------------------

--
-- Структура таблицы `result_test`
--

CREATE TABLE `result_test` (
  `id` int(11) NOT NULL,
  `id_group` int(11) NOT NULL,
  `id_name` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `mark` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=cp1251;

-- --------------------------------------------------------

--
-- Структура таблицы `save_question`
--

CREATE TABLE `save_question` (
  `id` int(11) NOT NULL,
  `id_start` int(11) NOT NULL,
  `id_question` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=cp1251;

-- --------------------------------------------------------

--
-- Структура таблицы `starttest`
--

CREATE TABLE `starttest` (
  `id` int(11) NOT NULL,
  `id_name` int(11) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=cp1251;

-- --------------------------------------------------------

--
-- Структура таблицы `student_group`
--

CREATE TABLE `student_group` (
  `id` int(11) NOT NULL,
  `name` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=cp1251;

-- --------------------------------------------------------

--
-- Структура таблицы `sub_themes`
--

CREATE TABLE `sub_themes` (
  `id` int(11) NOT NULL,
  `id_direct` int(11) NOT NULL,
  `name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=cp1251;

--
-- Дамп данных таблицы `sub_themes`
--

INSERT INTO `sub_themes` (`id`, `id_direct`, `name`) VALUES
(55, 40, 'Производственные возможности общества'),
(59, 40, 'Введение в экономику'),
(60, 40, 'Функционирование рынка');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nickname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `hash_pass` varchar(255) NOT NULL,
  `remote_addr` text NOT NULL,
  `user_agent` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `secondname` varchar(255) NOT NULL,
  `thirdname` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `registration` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=cp1251;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `nickname`, `email`, `password`, `hash_pass`, `remote_addr`, `user_agent`, `name`, `secondname`, `thirdname`, `role`, `registration`) VALUES
(22, 'albina', 'nektomor@yandex.ru', '23fa6920dcd52ac055b0623ce215afe249dfd5f5', '479819f29fd89ca1cfc04b1ecc07e1fc60170a3e', '178.208.255.130', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/56.0.2924.87 YaBrowser/17.3.1.840 Yowser/2.5 Safari/537.36', 'Альбина', 'Ишниязова', 'Радиковна', 'moderator', '2015-08-25 12:23:26');

-- --------------------------------------------------------

--
-- Структура таблицы `view_quest_result`
--

CREATE TABLE `view_quest_result` (
  `id` int(11) NOT NULL,
  `id_result` int(11) NOT NULL,
  `name_quest` text NOT NULL,
  `var1` text NOT NULL,
  `var2` text NOT NULL,
  `var3` text NOT NULL,
  `var4` text NOT NULL,
  `var5` text NOT NULL,
  `var6` text NOT NULL,
  `ans1` text NOT NULL,
  `ans2` text NOT NULL,
  `ans3` text NOT NULL,
  `ans4` text NOT NULL,
  `ans5` text NOT NULL,
  `ans6` text NOT NULL,
  `ans` int(11) NOT NULL,
  `image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=cp1251;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `change_email`
--
ALTER TABLE `change_email`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `config_test`
--
ALTER TABLE `config_test`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `directions`
--
ALTER TABLE `directions`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `list_students`
--
ALTER TABLE `list_students`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `name_test`
--
ALTER TABLE `name_test`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `question`
--
ALTER TABLE `question`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `result_test`
--
ALTER TABLE `result_test`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `save_question`
--
ALTER TABLE `save_question`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `starttest`
--
ALTER TABLE `starttest`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `student_group`
--
ALTER TABLE `student_group`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `sub_themes`
--
ALTER TABLE `sub_themes`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `view_quest_result`
--
ALTER TABLE `view_quest_result`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `change_email`
--
ALTER TABLE `change_email`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `config_test`
--
ALTER TABLE `config_test`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `directions`
--
ALTER TABLE `directions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
--
-- AUTO_INCREMENT для таблицы `list_students`
--
ALTER TABLE `list_students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `name_test`
--
ALTER TABLE `name_test`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `question`
--
ALTER TABLE `question`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `result_test`
--
ALTER TABLE `result_test`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `save_question`
--
ALTER TABLE `save_question`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `starttest`
--
ALTER TABLE `starttest`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `student_group`
--
ALTER TABLE `student_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT для таблицы `sub_themes`
--
ALTER TABLE `sub_themes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;
--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=639;
--
-- AUTO_INCREMENT для таблицы `view_quest_result`
--
ALTER TABLE `view_quest_result`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
DELIMITER $$
--
-- События
--
CREATE DEFINER=`host1582112`@`localhost` EVENT `newEvent` ON SCHEDULE EVERY 2 MINUTE STARTS '2017-04-30 06:00:28' ON COMPLETION NOT PRESERVE ENABLE DO DELETE FROM change_email$$

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
