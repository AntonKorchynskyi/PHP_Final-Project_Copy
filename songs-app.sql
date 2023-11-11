-- drop database comp_1006_200524341;
CREATE DATABASE IF NOT EXISTS comp_1006_200524341;
USE comp_1006_200524341;

CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `name` varchar(50) NOT NULL,
  `email` varchar(200) NOT NULL UNIQUE KEY,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE `playlists` (
`id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
`name` varchar(30) NOT NULL,
`user_id` int NOT NULL,
UNIQUE (`name`, `user_id`),
foreign key (`user_id`) REFERENCES users(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE `songs` (
`id` int NOT NULL AUTO_INCREMENT Primary key,
`name` varchar(30) NOT NULL,
`singer` varchar(30) NOT NULL,
`release_date` date NOT NULL,
`genre` varchar(30) NOT NULL,
`playlist_id` int NOT NULL,
`user_id` int NOT NULL,
foreign key (`user_id`) REFERENCES users(`id`),
foreign key (`playlist_id`) REFERENCES playlists (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE `contact_form` (
`id` int NOT NULL AUTO_INCREMENT Primary key,
`message` varchar (255) NOT NULL,
`user_id` int NOT NULL,
foreign key (`user_id`) REFERENCES users(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;