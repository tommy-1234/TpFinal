CREATE DATABASE  IF NOT EXISTS rekluting;
USE rekluting;

DROP TABLE IF EXISTS career;
CREATE TABLE career (
  careerId int(11) NOT NULL,
  careerDescription varchar(45) DEFAULT NULL,
  careerActive tinyint(1) DEFAULT NULL,
  PRIMARY KEY (careerId)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS companies;
CREATE TABLE companies (
  companyId int(11) NOT NULL AUTO_INCREMENT,
  companyName varchar(30) DEFAULT NULL,
  companyDescription varchar(200) DEFAULT NULL,
  companyEmail varchar(45) DEFAULT NULL,
  companyPhone int(15) DEFAULT NULL,
  companyLinkedin varchar(15) DEFAULT NULL,
  companyAddres varchar(45) DEFAULT NULL,
  companyLink varchar(75) DEFAULT NULL,
  PRIMARY KEY (companyId)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS joboffer;
CREATE TABLE joboffer (
  jobOfferId int(11) NOT NULL AUTO_INCREMENT,
  companyId int(11) NOT NULL,
  jobPositionId int(11) NOT NULL,
  publicationDate date DEFAULT NULL,
  expirationDate date DEFAULT NULL,
  isRemote tinyint(1) DEFAULT NULL,
  projectDescription varchar(200) DEFAULT NULL,
  hourlyLoad int(11) DEFAULT NULL,
  jobOfferActive tinyint(1) DEFAULT NULL,
  PRIMARY KEY (jobOfferId),
  KEY fk_joboffer_jobPositionId_idx (jobPositionId),
  KEY fk_joboffer_companyId_idx (companyId),
  CONSTRAINT fk_joboffer_companyId FOREIGN KEY (companyId) REFERENCES companies (companyId) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT fk_joboffer_jobPositionId FOREIGN KEY (jobPositionId) REFERENCES jobposition (jobPositionId) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS jobposition;
CREATE TABLE jobposition (
  jobPositionId int(11) NOT NULL,
  careerId int(11) NOT NULL,
  jobPositionDescription varchar(45) DEFAULT NULL,
  PRIMARY KEY (jobPositionId),
  KEY fk_jobPosition_careerId_idx (careerId),
  CONSTRAINT fk_jobPosition_careerId FOREIGN KEY (careerId) REFERENCES career (careerId) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS jobrequests;
CREATE TABLE jobrequests (
  jobRequestId int(11) NOT NULL AUTO_INCREMENT,
  jobOfferId int(11) NOT NULL,
  studentId int(11) NOT NULL,
  postulationDate date DEFAULT NULL,
  jobrequestActive tinyint(1) DEFAULT NULL,
  PRIMARY KEY (jobRequestId),
  KEY fk_jobrequests_jobOfferId_idx (jobOfferId),
  KEY fk_jobrequests_studentId_idx (studentId),
  CONSTRAINT fk_jobrequests_jobOfferId FOREIGN KEY (jobOfferId) REFERENCES joboffer (jobOfferId) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT fk_jobrequests_studentId FOREIGN KEY (studentId) REFERENCES students (studentId) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS students;
CREATE TABLE students (
  studentId int(11) NOT NULL,
  careerId int(11) NOT NULL,
  firstName varchar(30) DEFAULT NULL,
  lastName varchar(30) DEFAULT NULL,
  dni varchar(12) DEFAULT NULL,
  fileNumber varchar(12) DEFAULT NULL,
  gender varchar(15) DEFAULT NULL,
  birthDate datetime DEFAULT NULL,
  email varchar(45) DEFAULT NULL,
  phoneNumber varchar(15) DEFAULT NULL,
  studentActive tinyint(1) DEFAULT NULL,
  PRIMARY KEY (studentId),
  KEY fk_student_careerId_idx (careerId),
  CONSTRAINT fk_student_careerId FOREIGN KEY (careerId) REFERENCES career (careerId) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS usercompanies;
CREATE TABLE usercompanies(
userCompanyId int(11) NOT NULL AUTO_INCREMENT,
userCompanyMail varchar(30) not null,
userCompanyPassword varchar(30) not null,
companyId int(11) NOT NULL,
constraint pk_userCompanyId primary key (userCompanyId),
constraint fk_companyId foreign key (companyId) references companies (companyId)
);

