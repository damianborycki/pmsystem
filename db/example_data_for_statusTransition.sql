--przykladowe wypelnienie tablic do statusTransition

INSERT INTO `MEMBERROLE` (`CODE`, `NAME`, `VALUE`, `POSITION`, `DESCRIPTION`, `ISDEFAULT`, `ISACTIVE`, `ID`) VALUES
('PRG', 'Programista', 'Programista', NULL, 'Programista', 1, 1, 1),
('TES', 'Tester', 'Tester', NULL, 'Tester', 0, 1, 2);

INSERT INTO `TRACKER` (`CODE`, `NAME`, `VALUE`, `POSITION`, `DESCRIPTION`, `ISDEFAULT`, `ISACTIVE`, `ID`, `ASSIGNED`, `CATEGORY`, `FIXEDVERSION`, `PARENTISSUE`, `STARTDATE`, `DUEDATE`, `ESTIMATEDHOURS`, `DONERADIO`) VALUES
('BUG', 'Bug', 'Bug', 1, 'Poprawianie bugów', 0, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('DEV', 'Development', 'Development', 2, 'Kodzenie zagadnienia', 1, 1, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

INSERT INTO `STATUSTRANSITION` (`TRACKERID`, `MEMBERROLEID`, `PREVSTATUSID`, `NEXTSTATUSID`, `ID`) VALUES
(1, 2, 2, 5, 388),
(1, 2, 3, 3, 389),
(1, 2, 4, 3, 390),
(1, 2, 5, 3, 391),
(2, 2, 1, 1, 487),
(2, 2, 1, 6, 488),
(2, 2, 3, 2, 489),
(2, 2, 3, 3, 490),
(2, 2, 4, 3, 491),
(2, 2, 5, 3, 492),
(2, 2, 5, 4, 493),
(2, 2, 6, 3, 494),
(2, 2, 6, 4, 495),
(1, 1, 1, 1, 524),
(1, 1, 1, 2, 525),
(1, 1, 1, 3, 526),
(1, 1, 2, 1, 527),
(1, 1, 2, 2, 528),
(1, 1, 3, 2, 529),
(2, 1, 1, 1, 530),
(2, 1, 1, 2, 531),
(2, 1, 1, 4, 532),
(2, 1, 2, 3, 533),
(2, 1, 4, 1, 534),
(2, 1, 4, 2, 535),
(2, 1, 5, 1, 536);

