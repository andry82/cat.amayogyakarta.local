DROP TABLE IF EXISTS `desa`;
CREATE TABLE `desa` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `kode_test` VARCHAR (20),
  `nama_desa` VARCHAR (100),
  PRIMARY KEY (`id`)
) ENGINE = INNODB CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;