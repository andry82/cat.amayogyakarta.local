DELIMITER $$

CREATE
    TRIGGER `upd_skor_praktik` AFTER UPDATE
    ON `tests`
    FOR EACH ROW BEGIN
	UPDATE registrasi SET 
	skor_praktik = 
	(CAST(NEW.prosentase_word AS UNSIGNED)/100 * CAST(skor_word AS UNSIGNED))+
	(CAST(NEW.prosentase_excel AS UNSIGNED)/100 * CAST(skor_excel AS UNSIGNED))+
	(CAST(NEW.prosentase_ppt AS UNSIGNED)/100 * CAST(skor_ppt AS UNSIGNED))+
	(CAST(NEW.prosentase_email AS UNSIGNED)/100 * CAST(skor_email AS UNSIGNED))
	WHERE kode_test = NEW.kode_test;
    END$$

DELIMITER ;