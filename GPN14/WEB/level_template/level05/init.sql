DROP DATABASE IF EXISTS `web_level05`;
CREATE DATABASE `web_level05`;

GRANT SELECT, INSERT, DELETE ON web_level05.* TO 'web_level05'@'localhost' IDENTIFIED BY 'NhvCYdf3hhyMBMP3';

FLUSH PRIVILEGES;

USE `web_level05`;

CREATE TABLE IF NOT EXISTS `challenge` (
  `id` varchar(32) NOT NULL,
  `phone` int(10) NOT NULL,
  `lv` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
