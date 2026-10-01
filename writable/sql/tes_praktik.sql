DROP TABLE IF EXISTS `tes_praktik`;
CREATE TABLE `tes_praktik` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `no_registrasi` VARCHAR (20),
  `tipe` VARCHAR (5),
  `filename` VARCHAR (200),
  `waktu_unggah` DATETIME,
  PRIMARY KEY (`id`)
) ENGINE = INNODB CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;