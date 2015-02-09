-- phpMyAdmin SQL Dump
-- version 2.6.1
-- http://www.phpmyadmin.net
-- 
-- Хост: localhost
-- Время создания: Мар 15 2011 г., 09:13
-- Версия сервера: 5.0.45
-- Версия PHP: 5.2.4
-- 
-- БД: `inz`
-- 

-- --------------------------------------------------------

-- 
-- Структура таблицы `inz_users_wall_sm_stat`
-- 

CREATE TABLE `inz_users_wall_sm_stat` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `mid` int(11) default NULL,
  `suid` bigint(20) default NULL,
  `s_name` varchar(50) default NULL,
  `pdate` datetime default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251 AUTO_INCREMENT=1 ;

-- 
-- Дамп данных таблицы `inz_users_wall_sm_stat`
-- 
