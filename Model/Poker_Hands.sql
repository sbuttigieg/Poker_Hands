CREATE DATABASE pokerhands;

USE pokerhands;

CREATE TABLE player1 (
	id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    card1 CHAR(2) NOT NULL,
    card2 CHAR(2) NOT NULL,
    card3 CHAR(2) NOT NULL,
    card4 CHAR(2) NOT NULL,
    card5 CHAR(2) NOT NULL
);

CREATE TABLE player2 (
	id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    card1 CHAR(2) NOT NULL,
    card2 CHAR(2) NOT NULL,
    card3 CHAR(2) NOT NULL,
    card4 CHAR(2) NOT NULL,
    card5 CHAR(2) NOT NULL
);

CREATE TABLE results (
	id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    ranking1 int(2) NOT NULL,
    highcard1 int(2) NOT NULL,
    ranking2 int(2) NOT NULL,
    highcard2 int(2) NOT NULL,
    winner CHAR(7) NOT NULL
);

CREATE TABLE admin (
	id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(110) NOT NULL,
    password VARCHAR(200) NOT NULL
);

INSERT INTO admin(username, password)
	VALUES ('admin', 'd033e22ae348aeb5660fc2140aec35850c4da997');