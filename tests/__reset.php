<?php
// Create connection
$GLOBALS["mysql"] = new \SqlManager\Mysql([
	"server_name"	=> "localhost",
	"db_user"		=> "root",
	"db_pass"		=> "",
	"db_name"		=> "test"
]);


$msg = $GLOBALS["mysql"]->multi_query("
	-- Adminer 4.6.2 MySQL dump

	SET NAMES utf8;
	SET time_zone = '+00:00';
	SET foreign_key_checks = 0;
	SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

	DROP TABLE IF EXISTS `man`;
	CREATE TABLE `man` (
	  `id` int(11) NOT NULL AUTO_INCREMENT,
	  `name` varchar(150) COLLATE utf8_czech_ci NOT NULL,
	  `age` int(11) NOT NULL,
	  PRIMARY KEY (`id`)
	) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

	INSERT INTO `man` (`id`, `name`, `age`) VALUES
	(1,	'Jeroným',	28),
	(2,	'Ráchel',	17),
	(3,	'Benjamin',	13),
	(4,	'Ludmila',	48),
	(5,	'Josef',	52);

	-- 2020-04-16 07:06:49
");
