DROP DATABASE IF EXISTS pmsystem;
CREATE DATABASE pmsystem DEFAULT CHARACTER SET utf8 DEFAULT COLLATE utf8_general_ci;
USE pmsystem;

CREATE TABLE `ISSUEACTIVITY` (
	`CODE` VARCHAR(50) NULL , 
	`NAME` VARCHAR(100) NULL , 
	`VALUE` VARCHAR(100) NULL , 
	`POSITION` INTEGER NULL , 
	`DESCRIPTION` VARCHAR(1000) NULL , 
	`ISDEFAULT` BOOLEAN NULL , 
	`ISACTIVE` BOOLEAN NULL , 
	`ID` INTEGER UNSIGNED NULL AUTO_INCREMENT, 
	CONSTRAINT `PK_ISSUEACTIVITY` PRIMARY KEY (`ID`)
) ENGINE=INNODB;

--

INSERT INTO `ISSUEACTIVITY` (`ID`, `NAME`, `POSITION`, `ISDEFAULT`, `ISACTIVE`) VALUES
(1, 'Projektowanie', 1, 0, 1),
(2, 'Rozwój', 2, 0, 1);

--

CREATE TABLE `ISSUEPRIORITY` (
	`CODE` VARCHAR(50) NULL , 
	`NAME` VARCHAR(100) NULL , 
	`VALUE` VARCHAR(100) NULL , 
	`POSITION` INTEGER NULL , 
	`DESCRIPTION` VARCHAR(1000) NULL , 
	`ISDEFAULT` BOOLEAN NULL , 
	`ISACTIVE` BOOLEAN NULL , 
	`ID` INTEGER UNSIGNED NULL AUTO_INCREMENT, 
	CONSTRAINT `PK_ISSUEPRIORITY` PRIMARY KEY (`ID`)
) ENGINE=INNODB;

--

INSERT INTO `ISSUEPRIORITY` (`ID`, `NAME`, `POSITION`, `ISDEFAULT`, `ISACTIVE`) VALUES
(1, 'Niski', 1, 0, 1),
(2, 'Normalny', 2, 1, 1),
(3, 'Wysoki', 3, 0, 1),
(4, 'Pilny', 4, 0, 1),
(5, 'Natychmiastowy', 5, 0, 1);

--

CREATE TABLE `PROJECTSTATUS` (
	`CODE` VARCHAR(50) NULL , 
	`NAME` VARCHAR(100) NULL , 
	`VALUE` VARCHAR(100) NULL , 
	`POSITION` INTEGER NULL , 
	`DESCRIPTION` VARCHAR(1000) NULL , 
	`ISDEFAULT` BOOLEAN NULL , 
	`ISACTIVE` BOOLEAN NULL , 
	`ID` INTEGER UNSIGNED NULL AUTO_INCREMENT, 
	CONSTRAINT `PK_PROJECTSTATUS` PRIMARY KEY (`ID`)
) ENGINE=INNODB;

CREATE TABLE `CUSTOMDICTIONARY` (
	`CODE` VARCHAR(50) NULL , 
	`NAME` VARCHAR(100) NULL , 
	`VALUE` VARCHAR(100) NULL , 
	`POSITION` INTEGER NULL , 
	`DESCRIPTION` VARCHAR(1000) NULL , 
	`ISDEFAULT` BOOLEAN NULL , 
	`ISACTIVE` BOOLEAN NULL , 
	`ID` INTEGER UNSIGNED NULL AUTO_INCREMENT, 
	CONSTRAINT `PK_CUSTOMDICTIONARY` PRIMARY KEY (`ID`)
) ENGINE=INNODB;

CREATE TABLE `TRACKER` (
	`CODE` VARCHAR(50) NULL , 
	`NAME` VARCHAR(100) NULL , 
	`VALUE` VARCHAR(100) NULL , 
	`POSITION` INTEGER NULL , 
	`DESCRIPTION` VARCHAR(1000) NULL , 
	`ISDEFAULT` BOOLEAN NULL , 
	`ISACTIVE` BOOLEAN NULL , 
	`ID` INTEGER UNSIGNED NULL AUTO_INCREMENT, 
	CONSTRAINT `PK_TRACKER` PRIMARY KEY (`ID`)
) ENGINE=INNODB;

CREATE TABLE `ROLE` (
	`CODE` VARCHAR(50) NULL , 
	`NAME` VARCHAR(100) NULL , 
	`VALUE` VARCHAR(100) NULL , 
	`POSITION` INTEGER NULL , 
	`DESCRIPTION` VARCHAR(1000) NULL , 
	`ISDEFAULT` BOOLEAN NULL , 
	`ISACTIVE` BOOLEAN NULL , 
	`ID` INTEGER UNSIGNED NULL AUTO_INCREMENT, 
	CONSTRAINT `PK_ROLE` PRIMARY KEY (`ID`)
) ENGINE=INNODB;

CREATE TABLE `ISSUECATEGORY` (
	`CODE` VARCHAR(50) NULL , 
	`NAME` VARCHAR(100) NULL , 
	`VALUE` VARCHAR(100) NULL , 
	`POSITION` INTEGER NULL , 
	`DESCRIPTION` VARCHAR(1000) NULL , 
	`ISDEFAULT` BOOLEAN NULL , 
	`ISACTIVE` BOOLEAN NULL , 
	`ID` INTEGER UNSIGNED NULL AUTO_INCREMENT, 
	CONSTRAINT `PK_ISSUECATEGORY` PRIMARY KEY (`ID`)
) ENGINE=INNODB;

--

INSERT INTO `ISSUECATEGORY` (`ID`, `NAME`, `POSITION`, `ISDEFAULT`, `ISACTIVE`) VALUES
(1, 'Dokumentacja użytkownika', 1, 0, 1),
(2, 'Dokumentacja techniczna', 2, 0, 1);

--

CREATE TABLE `CUSTOMDICTIONARYVALUE` (
	`CODE` VARCHAR(50) NULL , 
	`NAME` VARCHAR(100) NULL , 
	`VALUE` VARCHAR(100) NULL , 
	`POSITION` INTEGER NULL , 
	`DESCRIPTION` VARCHAR(1000) NULL , 
	`ISDEFAULT` BOOLEAN NULL , 
	`ISACTIVE` BOOLEAN NULL , 
	`ID` INTEGER UNSIGNED NULL AUTO_INCREMENT, 
	CONSTRAINT `PK_CUSTOMDICTIONARYVALUE` PRIMARY KEY (`ID`)
) ENGINE=INNODB;

CREATE TABLE `ISSUESTATUS` (
	`CODE` VARCHAR(50) NULL , 
	`NAME` VARCHAR(100) NULL , 
	`VALUE` VARCHAR(100) NULL , 
	`POSITION` INTEGER NULL , 
	`DESCRIPTION` VARCHAR(1000) NULL , 
	`ISDEFAULT` BOOLEAN NULL , 
	`ISACTIVE` BOOLEAN NULL , 
	`ISCLOSED` BOOLEAN NULL , 
	`ID` INTEGER UNSIGNED NULL AUTO_INCREMENT, 
	CONSTRAINT `PK_ISSUESTATUS` PRIMARY KEY (`ID`)
) ENGINE=INNODB;

--

INSERT INTO `ISSUESTATUS` (`ID`, `NAME`, `ISCLOSED`, `ISDEFAULT`, `POSITION`) VALUES
(1, 'Nowy', 0, 1, 1),
(2, 'W toku', 0, 0, 2),
(3, 'Rozwiązany', 0, 0, 3),
(4, 'Odpowiedź', 0, 0, 4),
(5, 'Zamknięty', 1, 0, 5),
(6, 'Odrzucony', 1, 0, 6);

--

CREATE TABLE `MEMBERROLE` (
	`CODE` VARCHAR(50) NULL , 
	`NAME` VARCHAR(100) NULL , 
	`VALUE` VARCHAR(100) NULL , 
	`POSITION` INTEGER NULL , 
	`DESCRIPTION` VARCHAR(1000) NULL , 
	`ISDEFAULT` BOOLEAN NULL , 
	`ISACTIVE` BOOLEAN NULL , 
	`ID` INTEGER UNSIGNED NULL AUTO_INCREMENT, 
	CONSTRAINT `PK_MEMBERROLE` PRIMARY KEY (`ID`)
) ENGINE=INNODB;

CREATE TABLE `FIELDFORMAT` (
	`CODE` VARCHAR(50) NULL , 
	`NAME` VARCHAR(100) NULL , 
	`VALUE` VARCHAR(100) NULL , 
	`POSITION` INTEGER NULL , 
	`DESCRIPTION` VARCHAR(1000) NULL , 
	`ISDEFAULT` BOOLEAN NULL , 
	`ISACTIVE` BOOLEAN NULL , 
	`ID` INTEGER UNSIGNED NULL AUTO_INCREMENT, 
	CONSTRAINT `PK_FIELDFORMAT` PRIMARY KEY (`ID`)
) ENGINE=INNODB;

CREATE TABLE `FIELDCONTEXT` (
	`CODE` VARCHAR(50) NULL , 
	`NAME` VARCHAR(100) NULL , 
	`VALUE` VARCHAR(100) NULL , 
	`POSITION` INTEGER NULL , 
	`DESCRIPTION` VARCHAR(1000) NULL , 
	`ISDEFAULT` BOOLEAN NULL , 
	`ISACTIVE` BOOLEAN NULL , 
	`ID` INTEGER UNSIGNED NULL AUTO_INCREMENT, 
	CONSTRAINT `PK_FIELDCONTEXT` PRIMARY KEY (`ID`)
) ENGINE=INNODB;

CREATE TABLE `USERTYPE` (
	`CODE` VARCHAR(50) NULL , 
	`NAME` VARCHAR(100) NULL , 
	`VALUE` VARCHAR(100) NULL , 
	`POSITION` INTEGER NULL , 
	`DESCRIPTION` VARCHAR(1000) NULL , 
	`ISDEFAULT` BOOLEAN NULL , 
	`ISACTIVE` BOOLEAN NULL , 
	`ID` INTEGER UNSIGNED NULL AUTO_INCREMENT, 
	CONSTRAINT `PK_USERTYPE` PRIMARY KEY (`ID`)
) ENGINE=INNODB;

CREATE TABLE `QUERYTYPE` (
	`CODE` VARCHAR(50) NULL , 
	`NAME` VARCHAR(100) NULL , 
	`VALUE` VARCHAR(100) NULL , 
	`POSITION` INTEGER NULL , 
	`DESCRIPTION` VARCHAR(1000) NULL , 
	`ISDEFAULT` BOOLEAN NULL , 
	`ISACTIVE` BOOLEAN NULL , 
	`ID` INTEGER UNSIGNED NULL AUTO_INCREMENT, 
	CONSTRAINT `PK_QUERYTYPE` PRIMARY KEY (`ID`)
) ENGINE=INNODB;

CREATE TABLE `FIELDPERMISSION` (
	`CODE` VARCHAR(50) NULL , 
	`NAME` VARCHAR(100) NULL , 
	`VALUE` VARCHAR(100) NULL , 
	`POSITION` INTEGER NULL , 
	`DESCRIPTION` VARCHAR(1000) NULL , 
	`ISDEFAULT` BOOLEAN NULL , 
	`ISACTIVE` BOOLEAN NULL , 
	`ID` INTEGER UNSIGNED NULL AUTO_INCREMENT, 
	CONSTRAINT `PK_FIELDPERMISSION` PRIMARY KEY (`ID`)
) ENGINE=INNODB;

CREATE TABLE `PERMISSION` (
	`CODE` VARCHAR(50) NULL , 
	`NAME` VARCHAR(100) NULL , 
	`VALUE` VARCHAR(100) NULL , 
	`POSITION` INTEGER NULL , 
	`DESCRIPTION` VARCHAR(1000) NULL , 
	`ISDEFAULT` BOOLEAN NULL , 
	`ISACTIVE` BOOLEAN NULL , 
	`ID` INTEGER UNSIGNED NULL AUTO_INCREMENT, 
	CONSTRAINT `PK_PERMISSION` PRIMARY KEY (`ID`)
) ENGINE=INNODB;

CREATE TABLE `ESTIMATEDACTIVITY` (
	`ISSUEACTIVITYID` INTEGER UNSIGNED NULL , 
	`HOURS` INTEGER NULL , 
	`ID` INTEGER UNSIGNED NULL AUTO_INCREMENT, 
	`ISSUEID` INTEGER UNSIGNED NULL , 
	CONSTRAINT `PK_ESTIMATEDACTIVITY` PRIMARY KEY (`ID`)
) ENGINE=INNODB;

CREATE TABLE `ISSUE` (
	`PROJECTID` INTEGER UNSIGNED NULL , 
	`PARENTID` INTEGER UNSIGNED NULL , 
	`TRACKERID` INTEGER UNSIGNED NULL , 
	`ISSUESTATUSID` INTEGER UNSIGNED NULL , 
	`SUBJECT` VARCHAR(1000) NULL , 
	`DESCRIPTION` TEXT NULL , 
	`ISSUEPRIORITYID` INTEGER UNSIGNED NULL , 
	`CREATIONTIME` DATETIME NULL , 
	`CREATORID` INTEGER UNSIGNED NULL , 
	`CLOSETIME` DATETIME NULL , 
	`ID` INTEGER UNSIGNED NULL AUTO_INCREMENT, 
	CONSTRAINT `PK_ISSUE` PRIMARY KEY (`ID`)
) ENGINE=INNODB;

CREATE TABLE `ACTIVITYENTRY` (
	`PROJECTID` INTEGER UNSIGNED NULL , 
	`ISSUEID` INTEGER UNSIGNED NULL , 
	`ISSUEACTIVITIESID` INTEGER UNSIGNED NULL , 
	`USERID` INTEGER UNSIGNED NULL , 
	`ID` INTEGER UNSIGNED NULL AUTO_INCREMENT, 
	CONSTRAINT `PK_ACTIVITYENTRY` PRIMARY KEY (`ID`)
) ENGINE=INNODB;

CREATE TABLE `WORKTIMEENTRY` (
	`ACTIVITYENTRIESID` INTEGER UNSIGNED NULL , 
	`HOURS` INTEGER NULL , 
	`COMMENT` VARCHAR(100) NULL , 
	`ENTRYYEAR` INTEGER NULL , 
	`ENTRYMONTH` INTEGER NULL , 
	`ENTRYWEEK` INTEGER NULL , 
	`ENTRYDATE` DATETIME NULL , 
	`CREATIONTIME` DATETIME NULL , 
	`ID` INTEGER UNSIGNED NULL AUTO_INCREMENT, 
	CONSTRAINT `PK_WORKTIMEENTRY` PRIMARY KEY (`ID`)
) ENGINE=INNODB;

CREATE TABLE `QUERY` (
	`QUERYTYPEID` INTEGER UNSIGNED NULL , 
	`PROJECTID` INTEGER UNSIGNED NULL , 
	`USERID` INTEGER UNSIGNED NULL , 
	`NAME` VARCHAR(100) NULL , 
	`ISPUBLIC` BOOLEAN NULL , 
	`SELECTCRITERIA` TEXT NULL , 
	`WHERECRITERIA` TEXT NULL , 
	`SORTCRITERIA` TEXT NULL , 
	`GROUPCRITERIA` TEXT NULL , 
	`DETAILCRITERIA` TEXT NULL , 
	`ID` INTEGER UNSIGNED NULL AUTO_INCREMENT, 
	CONSTRAINT `PK_QUERY` PRIMARY KEY (`ID`)
) ENGINE=INNODB;

CREATE TABLE `FIELDSPERMISSION` (
	`TRACKERID` INTEGER UNSIGNED NULL , 
	`MEMBERROLEID` INTEGER UNSIGNED NULL , 
	`FIELDID` INTEGER UNSIGNED NULL , 
	`ISSUESTATUSID` INTEGER UNSIGNED NULL , 
	`FIELDPERMISSIONID` INTEGER UNSIGNED NULL , 
	`ID` INTEGER UNSIGNED NULL AUTO_INCREMENT, 
	CONSTRAINT `PK_FIELDSPERMISSION` PRIMARY KEY (`ID`)
) ENGINE=INNODB;

CREATE TABLE `STATUSTRANSITION` (
	`TRACKERID` INTEGER UNSIGNED NULL , 
	`MEMBERROLEID` INTEGER UNSIGNED NULL , 
	`PREVSTATUSID` INTEGER UNSIGNED NULL , 
	`NEXTSTATUSID` INTEGER UNSIGNED NULL , 
	`ID` INTEGER UNSIGNED NULL AUTO_INCREMENT, 
	CONSTRAINT `PK_STATUSTRANSITION` PRIMARY KEY (`ID`)
) ENGINE=INNODB;

CREATE TABLE `USER` (
	`LOGIN` VARCHAR(50) NULL , 
	`HASHEDPASSWORD` VARCHAR(100) NULL , 
	`SALT` VARCHAR(100) NULL , 
	`FIRSTNAME` VARCHAR(100) NULL , 
	`LASTNAME` VARCHAR(100) NULL , 
	`MAIL` VARCHAR(100) NULL , 
	`ISADMIN` BOOLEAN NULL , 
	`ISACTIVE` BOOLEAN NULL , 
	`USERTYPEID` INTEGER UNSIGNED NULL , 
	`ID` INTEGER UNSIGNED NULL AUTO_INCREMENT, 
	CONSTRAINT `PK_USER` PRIMARY KEY (`ID`)
) ENGINE=INNODB;

CREATE TABLE `PROJECT` (
	`NAME` VARCHAR(100) NULL , 
	`DESCRIPTION` TEXT NULL , 
	`IDENTIFIER` VARCHAR(20) NULL , 
	`PROJECTSTATUSID` INTEGER UNSIGNED NULL , 
	`ID` INTEGER UNSIGNED NULL AUTO_INCREMENT, 
	CONSTRAINT `PK_PROJECT` PRIMARY KEY (`ID`)
) ENGINE=INNODB;

CREATE TABLE `MEMBER` (
	`PROJECTID` INTEGER UNSIGNED NULL , 
	`USERID` INTEGER UNSIGNED NULL , 
	`ID` INTEGER UNSIGNED NULL AUTO_INCREMENT, 
	CONSTRAINT `PK_MEMBER` PRIMARY KEY (`ID`)
) ENGINE=INNODB;

CREATE TABLE `FIELD` (
	`FIELDCONTEXTID` INTEGER UNSIGNED NULL , 
	`NAME` VARCHAR(50) NULL , 
	`FIELDFORMATID` INTEGER UNSIGNED NULL , 
	`REGEXP` VARCHAR(1000) NULL , 
	`ISREQUIRED` BOOLEAN NULL , 
	`ISFORALL` BOOLEAN NULL , 
	`ISFILTER` BOOLEAN NULL , 
	`DEFAULTVALUE` VARCHAR(100) NULL , 
	`ISMULTIPLE` BOOLEAN NULL , 
	`ID` INTEGER UNSIGNED NULL AUTO_INCREMENT, 
	CONSTRAINT `PK_FIELD` PRIMARY KEY (`ID`)
) ENGINE=INNODB;

CREATE TABLE `CUSTODICTICUSTODICTIVALUE` (
	`CUSTOMDICTIONARYID` INTEGER UNSIGNED NULL , 
	`CUSTOMDICTIONARYVALUEID` INTEGER UNSIGNED NULL , 
	CONSTRAINT `PK_CUSTODICTICUSTODICTIVALUE` PRIMARY KEY (`CUSTOMDICTIONARYID`,`CUSTOMDICTIONARYVALUEID`)
) ENGINE=INNODB;

CREATE TABLE `TRACKERFIELDS` (
	`TRACKERID` INTEGER UNSIGNED NULL , 
	`FIELDID` INTEGER UNSIGNED NULL , 
	CONSTRAINT `PK_TRACKERFIELDS` PRIMARY KEY (`TRACKERID`,`FIELDID`)
) ENGINE=INNODB;

CREATE TABLE `ROLEPERMISSIONS` (
	`ROLEID` INTEGER UNSIGNED NULL , 
	`PERMISSIONID` INTEGER UNSIGNED NULL , 
	CONSTRAINT `PK_ROLEPERMISSIONS` PRIMARY KEY (`ROLEID`,`PERMISSIONID`)
) ENGINE=INNODB;

CREATE TABLE `MEMBERROLEPERMISSIONS` (
	`MEMBERROLEID` INTEGER UNSIGNED NULL , 
	`PERMISSIONID` INTEGER UNSIGNED NULL , 
	CONSTRAINT `PK_MEMBERROLEPERMISSIONS` PRIMARY KEY (`MEMBERROLEID`,`PERMISSIONID`)
) ENGINE=INNODB;

CREATE TABLE `ISSUEASSIGNEDUSERS` (
	`ISSUEID` INTEGER UNSIGNED NULL , 
	`USERID` INTEGER UNSIGNED NULL , 
	CONSTRAINT `PK_ISSUEASSIGNEDUSERS` PRIMARY KEY (`ISSUEID`,`USERID`)
) ENGINE=INNODB;

CREATE TABLE `PROJECTTRACKERS` (
	`PROJECTID` INTEGER UNSIGNED NULL , 
	`TRACKERID` INTEGER UNSIGNED NULL , 
	CONSTRAINT `PK_PROJECTTRACKERS` PRIMARY KEY (`PROJECTID`,`TRACKERID`)
) ENGINE=INNODB;

CREATE TABLE `PROJECTISSUECATEGORYS` (
	`PROJECTID` INTEGER UNSIGNED NULL , 
	`ISSUECATEGORYID` INTEGER UNSIGNED NULL , 
	CONSTRAINT `PK_PROJECTISSUECATEGORYS` PRIMARY KEY (`PROJECTID`,`ISSUECATEGORYID`)
) ENGINE=INNODB;

CREATE TABLE `MEMBERMEMBERROLES` (
	`MEMBERID` INTEGER UNSIGNED NULL , 
	`MEMBERROLEID` INTEGER UNSIGNED NULL , 
	CONSTRAINT `PK_MEMBERMEMBERROLES` PRIMARY KEY (`MEMBERID`,`MEMBERROLEID`)
) ENGINE=INNODB;


ALTER TABLE `ESTIMATEDACTIVITY` ADD CONSTRAINT `FK_ESTIMACTIV_ISSUEACTIV` FOREIGN KEY (`ISSUEACTIVITYID`) REFERENCES `ISSUEACTIVITY` (`ID`);
ALTER TABLE `ESTIMATEDACTIVITY` ADD CONSTRAINT `FK_ESTIMATEDACTIVITY_ISSUE` FOREIGN KEY (`ISSUEID`) REFERENCES `ISSUE` (`ID`);
ALTER TABLE `ISSUE` ADD CONSTRAINT `FK_ISSUE_PROJECT` FOREIGN KEY (`PROJECTID`) REFERENCES `PROJECT` (`ID`);
ALTER TABLE `ISSUE` ADD CONSTRAINT `FK_ISSUE_PARENT` FOREIGN KEY (`PARENTID`) REFERENCES `ISSUE` (`ID`);
ALTER TABLE `ISSUE` ADD CONSTRAINT `FK_ISSUE_TRACKER` FOREIGN KEY (`TRACKERID`) REFERENCES `TRACKER` (`ID`);
ALTER TABLE `ISSUE` ADD CONSTRAINT `FK_ISSUE_ISSUESTATUS` FOREIGN KEY (`ISSUESTATUSID`) REFERENCES `ISSUESTATUS` (`ID`);
ALTER TABLE `ISSUE` ADD CONSTRAINT `FK_ISSUE_ISSUEPRIORITY` FOREIGN KEY (`ISSUEPRIORITYID`) REFERENCES `ISSUEPRIORITY` (`ID`);
ALTER TABLE `ISSUE` ADD CONSTRAINT `FK_ISSUE_CREATOR` FOREIGN KEY (`CREATORID`) REFERENCES `USER` (`ID`);
ALTER TABLE `ACTIVITYENTRY` ADD CONSTRAINT `FK_ACTIVITYENTRY_PROJECT` FOREIGN KEY (`PROJECTID`) REFERENCES `PROJECT` (`ID`);
ALTER TABLE `ACTIVITYENTRY` ADD CONSTRAINT `FK_ACTIVITYENTRY_ISSUE` FOREIGN KEY (`ISSUEID`) REFERENCES `ISSUE` (`ID`);
ALTER TABLE `ACTIVITYENTRY` ADD CONSTRAINT `FK_ACTIVENTRY_ISSUEACTIV` FOREIGN KEY (`ISSUEACTIVITIESID`) REFERENCES `ISSUEACTIVITY` (`ID`);
ALTER TABLE `ACTIVITYENTRY` ADD CONSTRAINT `FK_ACTIVITYENTRY_USER` FOREIGN KEY (`USERID`) REFERENCES `USER` (`ID`);
ALTER TABLE `WORKTIMEENTRY` ADD CONSTRAINT `FK_WORKTIMEENTRY_ACTIVENTRI` FOREIGN KEY (`ACTIVITYENTRIESID`) REFERENCES `ACTIVITYENTRY` (`ID`);
ALTER TABLE `QUERY` ADD CONSTRAINT `FK_QUERY_QUERYTYPE` FOREIGN KEY (`QUERYTYPEID`) REFERENCES `QUERYTYPE` (`ID`);
ALTER TABLE `QUERY` ADD CONSTRAINT `FK_QUERY_PROJECT` FOREIGN KEY (`PROJECTID`) REFERENCES `PROJECT` (`ID`);
ALTER TABLE `QUERY` ADD CONSTRAINT `FK_QUERY_USER` FOREIGN KEY (`USERID`) REFERENCES `USER` (`ID`);
ALTER TABLE `FIELDSPERMISSION` ADD CONSTRAINT `FK_FIELDSPERMISSION_TRACKER` FOREIGN KEY (`TRACKERID`) REFERENCES `TRACKER` (`ID`);
ALTER TABLE `FIELDSPERMISSION` ADD CONSTRAINT `FK_FIELDPERMI_MEMBEROLE` FOREIGN KEY (`MEMBERROLEID`) REFERENCES `MEMBERROLE` (`ID`);
ALTER TABLE `FIELDSPERMISSION` ADD CONSTRAINT `FK_FIELDSPERMISSION_FIELD` FOREIGN KEY (`FIELDID`) REFERENCES `FIELD` (`ID`);
ALTER TABLE `FIELDSPERMISSION` ADD CONSTRAINT `FK_FIELDPERMI_ISSUESTATU` FOREIGN KEY (`ISSUESTATUSID`) REFERENCES `ISSUESTATUS` (`ID`);
ALTER TABLE `FIELDSPERMISSION` ADD CONSTRAINT `FK_FIELDPERMI_FIELDPERMI` FOREIGN KEY (`FIELDPERMISSIONID`) REFERENCES `FIELDPERMISSION` (`ID`);
ALTER TABLE `STATUSTRANSITION` ADD CONSTRAINT `FK_STATUSTRANSITION_TRACKER` FOREIGN KEY (`TRACKERID`) REFERENCES `TRACKER` (`ID`);
ALTER TABLE `STATUSTRANSITION` ADD CONSTRAINT `FK_STATUTRANS_MEMBEROLE` FOREIGN KEY (`MEMBERROLEID`) REFERENCES `MEMBERROLE` (`ID`);
ALTER TABLE `STATUSTRANSITION` ADD CONSTRAINT `FK_STATUTRANS_PREVSTATU` FOREIGN KEY (`PREVSTATUSID`) REFERENCES `ISSUESTATUS` (`ID`);
ALTER TABLE `STATUSTRANSITION` ADD CONSTRAINT `FK_STATUTRANS_NEXTSTATU` FOREIGN KEY (`NEXTSTATUSID`) REFERENCES `ISSUESTATUS` (`ID`);
ALTER TABLE `USER` ADD CONSTRAINT `FK_USER_USERTYPE` FOREIGN KEY (`USERTYPEID`) REFERENCES `USERTYPE` (`ID`);
ALTER TABLE `PROJECT` ADD CONSTRAINT `FK_PROJECT_PROJECTSTATUS` FOREIGN KEY (`PROJECTSTATUSID`) REFERENCES `PROJECTSTATUS` (`ID`);
ALTER TABLE `MEMBER` ADD CONSTRAINT `FK_MEMBER_PROJECT` FOREIGN KEY (`PROJECTID`) REFERENCES `PROJECT` (`ID`);
ALTER TABLE `MEMBER` ADD CONSTRAINT `FK_MEMBER_USER` FOREIGN KEY (`USERID`) REFERENCES `USER` (`ID`);
ALTER TABLE `FIELD` ADD CONSTRAINT `FK_FIELD_FIELDCONTEXT` FOREIGN KEY (`FIELDCONTEXTID`) REFERENCES `FIELDCONTEXT` (`ID`);
ALTER TABLE `FIELD` ADD CONSTRAINT `FK_FIELD_FIELDFORMAT` FOREIGN KEY (`FIELDFORMATID`) REFERENCES `FIELDFORMAT` (`ID`);
ALTER TABLE `CUSTODICTICUSTODICTIVALUE` ADD CONSTRAINT `FK_CUSDICCUSDICVAL_CUSDIC` FOREIGN KEY (`CUSTOMDICTIONARYID`) REFERENCES `CUSTOMDICTIONARY` (`ID`);
ALTER TABLE `CUSTODICTICUSTODICTIVALUE` ADD CONSTRAINT `FK_CUSDICCUSDICVAL_CUSDICVAL` FOREIGN KEY (`CUSTOMDICTIONARYVALUEID`) REFERENCES `CUSTOMDICTIONARYVALUE` (`ID`);
ALTER TABLE `TRACKERFIELDS` ADD CONSTRAINT `FK_TRACKERFIELDS_TRACKER` FOREIGN KEY (`TRACKERID`) REFERENCES `TRACKER` (`ID`);
ALTER TABLE `TRACKERFIELDS` ADD CONSTRAINT `FK_TRACKERFIELDS_FIELD` FOREIGN KEY (`FIELDID`) REFERENCES `FIELD` (`ID`);
ALTER TABLE `ROLEPERMISSIONS` ADD CONSTRAINT `FK_ROLEPERMISSIONS_ROLE` FOREIGN KEY (`ROLEID`) REFERENCES `ROLE` (`ID`);
ALTER TABLE `ROLEPERMISSIONS` ADD CONSTRAINT `FK_ROLEPERMI_PERMI` FOREIGN KEY (`PERMISSIONID`) REFERENCES `PERMISSION` (`ID`);
ALTER TABLE `MEMBERROLEPERMISSIONS` ADD CONSTRAINT `FK_MEMBEROLEPERMI_MEMBEROLE` FOREIGN KEY (`MEMBERROLEID`) REFERENCES `MEMBERROLE` (`ID`);
ALTER TABLE `MEMBERROLEPERMISSIONS` ADD CONSTRAINT `FK_MEMBEROLEPERMI_PERMI` FOREIGN KEY (`PERMISSIONID`) REFERENCES `PERMISSION` (`ID`);
ALTER TABLE `ISSUEASSIGNEDUSERS` ADD CONSTRAINT `FK_ISSUEASSIGNEDUSERS_ISSUE` FOREIGN KEY (`ISSUEID`) REFERENCES `ISSUE` (`ID`);
ALTER TABLE `ISSUEASSIGNEDUSERS` ADD CONSTRAINT `FK_ISSUEASSIGNEDUSERS_USER` FOREIGN KEY (`USERID`) REFERENCES `USER` (`ID`);
ALTER TABLE `PROJECTTRACKERS` ADD CONSTRAINT `FK_PROJECTTRACKERS_PROJECT` FOREIGN KEY (`PROJECTID`) REFERENCES `PROJECT` (`ID`);
ALTER TABLE `PROJECTTRACKERS` ADD CONSTRAINT `FK_PROJECTTRACKERS_TRACKER` FOREIGN KEY (`TRACKERID`) REFERENCES `TRACKER` (`ID`);
ALTER TABLE `PROJECTISSUECATEGORYS` ADD CONSTRAINT `FK_PROJEISSUECATEG_PROJE` FOREIGN KEY (`PROJECTID`) REFERENCES `PROJECT` (`ID`);
ALTER TABLE `PROJECTISSUECATEGORYS` ADD CONSTRAINT `FK_PROJISSUCATE_ISSUCATE` FOREIGN KEY (`ISSUECATEGORYID`) REFERENCES `ISSUECATEGORY` (`ID`);
ALTER TABLE `MEMBERMEMBERROLES` ADD CONSTRAINT `FK_MEMBERMEMBERROLES_MEMBER` FOREIGN KEY (`MEMBERID`) REFERENCES `MEMBER` (`ID`);
ALTER TABLE `MEMBERMEMBERROLES` ADD CONSTRAINT `FK_MEMBEMEMBEROLES_MEMBEROLE` FOREIGN KEY (`MEMBERROLEID`) REFERENCES `MEMBERROLE` (`ID`);