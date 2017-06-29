#SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ANSI';
USE mysql;
DROP PROCEDURE IF EXISTS `mysql`.`drop_user_if_exists` ;
DELIMITER $$
CREATE PROCEDURE `mysql`.`drop_user_if_exists`()
BEGIN
  DECLARE foo BIGINT DEFAULT 0 ;
  SELECT COUNT(*)
  INTO foo
    FROM mysql.user
      WHERE User = 'chatpfuser';
  IF foo > 0 THEN 
         DROP USER 'chatpfuser';
  END IF;
  SELECT COUNT(*)
  INTO foo
    FROM mysql.user
      WHERE User = 'chatpfdba';
  IF foo > 0 THEN 
         DROP USER 'chatpfdba';
  END IF;
END ;$$
DELIMITER ;

CALL `mysql`.`drop_user_if_exists`() ;

DROP PROCEDURE IF EXISTS `chatpf`.`drop_users_if_exists` ;
#SET SQL_MODE=@OLD_SQL_MODE ;

DROP DATABASE IF EXISTS chatpf_db;
CREATE DATABASE IF NOT EXISTS chatpf_db;

CREATE USER chatpfdba;
SET PASSWORD FOR 'chatpfdba'= PASSWORD('700r@chatpf2017');

GRANT ALL PRIVILEGES ON chatpf_db.* TO chatpfdba WITH GRANT OPTION;

CREATE USER chatpfuser;
SET PASSWORD FOR 'chatpfuser' = PASSWORD('u55er@chatpf2017');
GRANT SELECT, INSERT, UPDATE ON chatpf_db.* TO chatpfuser;

USE 'chatpf_db';

DROP TABLE IF EXISTS Userchat;
CREATE TABLE IF NOT EXISTS Userchat (
	idUser INT(10) AUTO_INCREMENT NOT NULL,
	nameUser VARCHAR(20) NOT NULL,
	passwordUser VARCHAR(250) NOT NULL,
	publicKeyUser VARCHAR(2100) NOT NULL,
	mailUser VARCHAR(250) NOT NULL,
	authkeyUser VARCHAR(250) DEFAULT NULL,
	activUser TINYINT(4) DEFAULT '0',
	
	PRIMARY KEY(idUser)
);

DROP TABLE IF EXISTS Message;
CREATE TABLE IF NOT EXISTS Message (
	idMessage INT(10) AUTO_INCREMENT NOT NULL,
	headderMessage BLOB NOT NULL,
	messageContent LONGBLOB NOT NULL,
	messagedelievered TINYINT(1) NOT NULL, 
	
	PRIMARY KEY(idMessage)
);

DROP TABLE IF EXISTS Contacts;
CREATE TABLE IF NOT EXISTS Contacts (
	idUser INT(10) 
--      AUTO_INCREMENT 
        NOT NULL,
	idContacted INT(10) NOT NULL,
	
 	PRIMARY KEY(idUser,idContacted),
	
	INDEX (idContacted),
	
	FOREIGN KEY (idContacted)
		REFERENCES Userchat(idUser)
);

GRANT DELETE, SELECT, INSERT, UPDATE ON chatpf_db.Contacts TO chatpfuser;

DROP TABLE IF EXISTS DashboardMedia;
CREATE TABLE DashboardMedia (id_media int auto_increment not null,
	filename varchar(100) not null,
	id_autor int not null,
	fecha datetime,
	extencion varchar(10),
	primary key(id_media));