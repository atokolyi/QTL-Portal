CREATE DATABASE `interval`;
use `interval`;
CREATE TABLE `projects` (`code_name` varchar(50) NOT NULL,`nice_name` varchar(50) NOT NULL,PRIMARY KEY (`code_name`),UNIQUE KEY `code_name` (`code_name`)) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
