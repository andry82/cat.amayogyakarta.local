DROP TABLE IF EXISTS `kategori_soal`;
CREATE TABLE `kategori_soal` (
  `id` SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `kategori` VARCHAR (100),
  `status` TINYINT (1) DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE = INNODB CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

