DROP DATABASE IF EXISTS `validator`;
CREATE DATABASE `validator`;

GRANT SELECT, INSERT, UPDATE, DELETE ON validator.* TO 'validator'@'localhost' IDENTIFIED BY 'NhvCYdf3hhyMBMP3';

FLUSH PRIVILEGES;

USE `validator`;

CREATE TABLE IF NOT EXISTS `urls` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` text NOT NULL,
  `visited` int(1) NOT NULL,
   key(id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
