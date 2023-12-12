CREATE TABLE finalAdmins (
  id int NOT NULL AUTO_INCREMENT,
  name char(100) NOT NULL,
  email char(100) NOT NULL,
  password char(250) NOT NULL,
  status char(100) NOT NULL,
  PRIMARY KEY (id)
) ENGINE = InnoDB;