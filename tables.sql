CREATE TABLE application (
id INT(10) unsigned NOT NULL AUTO_INCREMENT,
name VARCHAR(128),
mail VARCHAR(30),
date YEAR(4),
sex VARCHAR(10),
limb INT(5),
bio TEXT,
PRIMARY KEY(id)
);

CREATE TABLE powers (
id INT(10) unsigned NOT NULL AUTO_INCREMENT,
power VARCHAR(128),
PRIMARY KEY(id)
);

CREATE TABLE username (
id INT(10) unsigned NOT NULL AUTO_INCREMENT,
login VARCHAR(128),
pass VARCHAR(128),
PRIMARY KEY(id)
);
