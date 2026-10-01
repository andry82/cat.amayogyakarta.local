DELIMITER $$

DROP TRIGGER IF EXISTS `update_poin`$$

CREATE
    TRIGGER `update_poin` BEFORE UPDATE ON `tes_tertulis` 
    FOR EACH ROW BEGIN
	SET NEW.poin = IF(NEW.jawaban = NEW.kunci_jawaban, (
		SELECT t.`poin_tes_tertulis` FROM tests t WHERE t.`kode_test` IN 
		(SELECT r.`kode_test` FROM registrasi r WHERE r.`no_registrasi` = NEW.no_registrasi)
		), 0);

    END;
$$

DELIMITER ;