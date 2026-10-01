DROP TABLE IF EXISTS `bank_soal`;
CREATE TABLE `bank_soal` (
  `id` SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `nama` VARCHAR (100),
  `is_default` TINYINT (1) DEFAULT 0,
  `status` TINYINT (1) DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE = INNODB CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;