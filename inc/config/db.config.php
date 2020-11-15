<?php
$db="k76189_qrproject";
$host="10.35.47.70:3306";
$username="k76189_qr";
$password="U4oh09_y";

// $db="qrproject";
// $host="localhost";
// $username="root";
// $password="AiseyKaise?";
$table1="CREATE TABLE IF NOT EXISTS admin (
  id int(11) NOT NULL AUTO_INCREMENT,
  username varchar(45) CHARACTER SET utf8 DEFAULT NULL,
  password varchar(2000) CHARACTER SET utf8 DEFAULT NULL,
  fullname varchar(45) DEFAULT NULL,
  deleted tinyint(4) DEFAULT NULL,
  PRIMARY KEY (id)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

";
$table2="CREATE TABLE IF NOT EXISTS company (
  id int(11) NOT NULL AUTO_INCREMENT,
  companyname varchar(100) DEFAULT NULL,
  stnstno varchar(200) DEFAULT NULL,
  postalcode varchar(100) DEFAULT NULL,
  city varchar(100) DEFAULT NULL,
  state varchar(100) DEFAULT NULL,
  username varchar(100) DEFAULT NULL,
  password varchar(1000) DEFAULT NULL,
  deleted tinyint(4) DEFAULT NULL,
  `qr-code` varchar(2000) CHARACTER SET utf8 DEFAULT NULL,
  createddate datetime DEFAULT NULL,
  PRIMARY KEY (id)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
";
$table3="Drop table if exists visitors;CREATE TABLE IF NOT EXISTS visitors (
  id int(11) NOT NULL AUTO_INCREMENT,
  name varchar(45) DEFAULT NULL,
  phone varchar(45) DEFAULT NULL,
  street varchar(45) DEFAULT NULL,
  code varchar(45) DEFAULT NULL,
  city varchar(45) DEFAULT NULL,
  datetime datetime DEFAULT NULL,
  count int(11) DEFAULT NULL,
  company varchar(45) DEFAULT NULL,
  PRIMARY KEY (id)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
";
$record="LOCK TABLES admin WRITE;
INSERT INTO admin VALUES (1,'admin','0e7517141fb53f21ee439b355b5a1d0a','admin',NULL);
UNLOCK TABLES;";
?>