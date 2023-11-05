<?php
require '../init.php';

$DB->query('SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";');
$DB->query('START TRANSACTION;');
$DB->query('SET time_zone = "+00:00";');
$DB->query('CREATE TABLE `users` (
                         `id` int NOT NULL,
                         `login` varchar(22) NOT NULL,
                         `pass` varchar(60) NOT NULL,
                         `email` varchar(55) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;');
$DB->query('ALTER TABLE `users`
    ADD UNIQUE KEY `id` (`id`);');
$DB->query('ALTER TABLE `users`
    MODIFY `id` int NOT NULL AUTO_INCREMENT;');
//$DB->query('');
//$DB->query('');
//$DB->query('');


