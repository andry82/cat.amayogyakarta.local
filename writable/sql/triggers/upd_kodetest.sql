DELIMITER $$

DROP TRIGGER IF EXISTS `upd_kodetest`$$

CREATE
    TRIGGER `upd_kodetest` AFTER UPDATE ON `tests` 
    FOR EACH ROW BEGIN
	UPDATE desa SET kode_test = NEW.kode_test WHERE kode_test = OLD.kode_test;
    END;
$$

DELIMITER ;