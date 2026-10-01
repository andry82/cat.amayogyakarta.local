DROP TABLE IF EXISTS `interviewer`;
CREATE TABLE `interviewer` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `kode_test` VARCHAR (20),
  `user_id` INT,
  PRIMARY KEY (`id`)
) ENGINE = INNODB CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;