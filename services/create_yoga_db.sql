SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
                         `id` int NOT NULL,
                         `login` varchar(22) NOT NULL,
                         `pass` varchar(60) NOT NULL,
                         `email` varchar(55) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
ALTER TABLE `users`
    ADD UNIQUE KEY `id` (`id`);
ALTER TABLE `users`
    MODIFY `id` int NOT NULL AUTO_INCREMENT;
COMMIT;

