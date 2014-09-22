# modyfikacja obecnej tabeli Field
ALTER TABLE `FIELD` 
DROP FOREIGN KEY `FK_FIELD_FIELDFORMAT`,
DROP FOREIGN KEY `FK_FIELD_FIELDCONTEXT`;
ALTER TABLE `FIELD` 
DROP COLUMN `FIELDFORMATID`,
DROP COLUMN `FIELDCONTEXTID`,
ADD COLUMN `MINVALUE` INT UNSIGNED NULL DEFAULT NULL AFTER `ID`,
ADD COLUMN `MAXVALUE` INT UNSIGNED NULL DEFAULT NULL AFTER `MINVALUE`,
ADD COLUMN `ISHIDDEN` TINYINT(1) NULL DEFAULT NULL AFTER `MAXVALUE`,
DROP INDEX `FK_FIELD_FIELDFORMAT`,
DROP INDEX `FK_FIELD_FIELDCONTEXT` ;

# usunięcie niepotrzebnych tabel
DROP TABLE `FIELDCONTEXT`;
DROP TABLE `FIELDFORMAT`;

# stworzenie tabeli przechowujacej powiazania
# miedzy customowymi polami a projektem
CREATE TABLE `PROJECTFIELDS` (
  `PROJECTID` INT(10) UNSIGNED NOT NULL,
  `FIELDID` INT(10) UNSIGNED NOT NULL,
  INDEX `FK_PROJECTFIELDS_PROJECT` (`PROJECTID` ASC),
  INDEX `FK_PROJECTFIELDS_FIELD` (`FIELDID` ASC),
  CONSTRAINT `FK_PROJECTFIELDS_FIELD`
    FOREIGN KEY (`FIELDID`)
    REFERENCES `pmsystem`.`FIELD` (`ID`)
    ON DELETE RESTRICT
    ON UPDATE RESTRICT,
  CONSTRAINT `FK_PROJECTFIELDS_PROJECT`
    FOREIGN KEY (`PROJECTID`)
    REFERENCES `pmsystem`.`PROJECT` (`ID`)
    ON DELETE RESTRICT
    ON UPDATE RESTRICT);
