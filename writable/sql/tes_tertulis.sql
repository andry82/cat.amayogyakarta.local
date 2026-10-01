DROP TABLE IF EXISTS `tes_tertulis`;
CREATE TABLE `tes_tertulis` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `no_registrasi` VARCHAR(50),
  `kategori` VARCHAR(100),
  `nomor` INT,
  `pertanyaan` TEXT,
  `a` TEXT,
  `b` TEXT,
  `c` TEXT,
  `d` TEXT,
  `jawaban` ENUM ('a', 'b', 'c', 'd'),
  `kunci_jawaban` ENUM ('a', 'b', 'c', 'd'),
  `poin` TINYINT (1) DEFAULT 0,
  `waktu_jawab` DATETIME,
  PRIMARY KEY (`id`)
) ENGINE = INNODB CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;