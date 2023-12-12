CREATE TABLE finalContacts (
  id int NOT NULL AUTO_INCREMENT,
  name char(100) NOT NULL,
  address char(100) NOT NULL,
  city char(100) NOT NULL,
  state char(50) NOT NULL,
  phone char(100) NOT NULL,
  email char(100) NOT NULL,
  dob char(100) NOT NULL,
  contacts char(100) NULL,
  age char(100) NOT NULL,
  PRIMARY KEY (id)
) ENGINE = InnoDB;
