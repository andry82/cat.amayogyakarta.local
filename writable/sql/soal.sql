DROP TABLE IF EXISTS `soal`;
CREATE TABLE `soal` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `bank_soal` SMALLINT,
  `kategori` SMALLINT,
  `pertanyaan` TEXT,
  `a` TEXT,
  `b` TEXT,
  `c` TEXT,
  `d` TEXT,
  `kunci_jawaban` ENUM ('a', 'b', 'c', 'd'),
  `status` TINYINT (1) DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE = INNODB CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;