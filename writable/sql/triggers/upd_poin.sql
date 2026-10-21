DELIMITER $$

DROP TRIGGER IF EXISTS `update_poin`$$

CREATE
    TRIGGER `update_poin` BEFORE UPDATE ON `tes_tertulis` 
    FOR EACH ROW BEGIN
	DECLARE points_correct SMALLINT DEFAULT 0;
	DECLARE points_before INT DEFAULT 0;
	DECLARE main_score SMALLINT DEFAULT 0;

	SELECT COALESCE(MAX(t.`poin_tes_tertulis`), 0), COALESCE(MAX(r.`main`), 0)
	INTO points_correct, main_score
	FROM registrasi r
	JOIN tests t ON t.`kode_test` = r.`kode_test`
	WHERE r.`no_registrasi` = NEW.no_registrasi;

	SELECT COALESCE(SUM(t.`poin`), 0)
	INTO points_before
	FROM tes_tertulis t
	WHERE t.`no_registrasi` = NEW.no_registrasi
		AND t.`nomor` < NEW.nomor;

	IF NEW.`jawaban` IS NULL OR NEW.`jawaban` = ''
		OR NEW.`jawaban` <> NEW.`kunci_jawaban` THEN
		SET NEW.`poin` = 0;
	ELSEIF main_score > 0 THEN
		SET NEW.`poin` = LEAST(points_correct, GREATEST(main_score - points_before, 0));
	ELSE
		SET NEW.`poin` = points_correct;
	END IF;

    END;
$$

DELIMITER ;