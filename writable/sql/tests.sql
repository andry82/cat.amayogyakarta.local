DROP TABLE IF EXISTS `tests`;
CREATE TABLE `tests` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `nama_test` VARCHAR (200),
  `kode_test` VARCHAR (20),
  `tanggal_test` DATETIME,
  `bank_soal` SMALLINT UNSIGNED,
  `timer_tes_tertulis` TINYINT (2) NULL,
  `timer_tes_praktik` TINYINT (2) NULL,
  `jumlah_soal_tertulis` TINYINT (3) NULL,
  `poin_tes_tertulis` TINYINT (1) NULL,
  `prosentase_tertulis` TINYINT (2) NULL,
  `prosentase_praktik` TINYINT (2) NULL,
  `prosentase_wawancara` TINYINT (2) NULL,
  `status` TINYINT (1) DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE = INNODB CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;