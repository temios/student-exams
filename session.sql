-- phpMyAdmin SQL Dump
-- version 4.0.10.10
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июн 03 2016 г., 06:53
-- Версия сервера: 5.5.45
-- Версия PHP: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `session`
--
CREATE DATABASE IF NOT EXISTS `session` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `session`;

-- --------------------------------------------------------

--
-- Структура таблицы `control`
--

CREATE TABLE IF NOT EXISTS `control` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `control_name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `control`
--

INSERT INTO `control` (`id`, `control_name`) VALUES
(1, 'зачет'),
(2, 'экзамен');

-- --------------------------------------------------------

--
-- Структура таблицы `group`
--

CREATE TABLE IF NOT EXISTS `group` (
  `group` int(11) NOT NULL,
  `department` varchar(50) NOT NULL,
  PRIMARY KEY (`group`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `group`
--

INSERT INTO `group` (`group`, `department`) VALUES
(4392, 'итиу');

-- --------------------------------------------------------

--
-- Структура таблицы `mark`
--

CREATE TABLE IF NOT EXISTS `mark` (
  `register_id` int(11) NOT NULL,
  `record_book_id` int(11) NOT NULL,
  `mark` varchar(50) NOT NULL,
  PRIMARY KEY (`register_id`,`record_book_id`),
  KEY `record_book_id` (`record_book_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `mark`
--

INSERT INTO `mark` (`register_id`, `record_book_id`, `mark`) VALUES
(123, 12345, 'отлично');

-- --------------------------------------------------------

--
-- Структура таблицы `professor`
--

CREATE TABLE IF NOT EXISTS `professor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(20) NOT NULL,
  `second_name` varchar(20) NOT NULL,
  `patronymic` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `professor`
--

INSERT INTO `professor` (`id`, `first_name`, `second_name`, `patronymic`) VALUES
(1, 'андрей', 'полосин', 'николаевич');

-- --------------------------------------------------------

--
-- Структура таблицы `register`
--

CREATE TABLE IF NOT EXISTS `register` (
  `register_number` int(11) NOT NULL,
  `control_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `professor_id` int(11) NOT NULL,
  `document_name` varchar(100) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`register_number`),
  KEY `control_id` (`control_id`),
  KEY `subject_id` (`subject_id`),
  KEY `professor_id` (`professor_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `register`
--

INSERT INTO `register` (`register_number`, `control_id`, `subject_id`, `professor_id`, `document_name`, `date`) VALUES
(123, 1, 1, 1, 'экзаменнационная ведомость', '2016-06-01 20:25:30');

-- --------------------------------------------------------

--
-- Структура таблицы `student`
--

CREATE TABLE IF NOT EXISTS `student` (
  `record_book` int(11) NOT NULL,
  `group` int(11) NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `second_name` varchar(20) NOT NULL,
  `patronymic` varchar(20) NOT NULL,
  PRIMARY KEY (`record_book`),
  KEY `group` (`group`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `student`
--

INSERT INTO `student` (`record_book`, `group`, `first_name`, `second_name`, `patronymic`) VALUES
(12345, 4392, 'иван', 'иванов', 'иванович'),
(34567, 4392, 'петр', 'сидоров', 'владимирович');

-- --------------------------------------------------------

--
-- Структура таблицы `subject`
--

CREATE TABLE IF NOT EXISTS `subject` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `subject`
--

INSERT INTO `subject` (`id`, `name`) VALUES
(1, 'информационные технологии'),
(2, 'информационная безопасность');

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `login` varchar(30) NOT NULL,
  `password` varchar(1000) NOT NULL,
  `salt` varchar(100) NOT NULL,
  `iterations` int(11) NOT NULL,
  `rights` int(11) NOT NULL,
  PRIMARY KEY (`login`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`login`, `password`, `salt`, `iterations`, `rights`) VALUES
('professor', 'ecd95bb42b4d329847adf09b0e834ec66cfd7399', 'MzlhNmM2OTI5NzAwOGI5ZmI4ZTliNjU4ZjFiZjI4OGI', 100, 2),
('root', 'e25bf5c041f67af68cd087b03631ff4e81b3724f', 'NDQyZGUzOTcyZDVkZDAzMjE0NmM4YTJkYmI1ZGI4ZTY', 100, 1),
('user', '0e2cbe8a3da06d00d8fcf8cde0b698ec1b677bd3', 'MzlhNmM2OTI5NzAwOGI5ZmI4ZTliNjU4ZjFiZjI4OGI', 100, 3);

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `mark`
--
ALTER TABLE `mark`
  ADD CONSTRAINT `mark_ibfk_1` FOREIGN KEY (`register_id`) REFERENCES `register` (`register_number`),
  ADD CONSTRAINT `mark_ibfk_2` FOREIGN KEY (`record_book_id`) REFERENCES `student` (`record_book`);

--
-- Ограничения внешнего ключа таблицы `register`
--
ALTER TABLE `register`
  ADD CONSTRAINT `register_ibfk_1` FOREIGN KEY (`control_id`) REFERENCES `control` (`id`),
  ADD CONSTRAINT `register_ibfk_2` FOREIGN KEY (`subject_id`) REFERENCES `subject` (`id`),
  ADD CONSTRAINT `register_ibfk_3` FOREIGN KEY (`professor_id`) REFERENCES `professor` (`id`);

--
-- Ограничения внешнего ключа таблицы `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `student_ibfk_1` FOREIGN KEY (`group`) REFERENCES `group` (`group`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
