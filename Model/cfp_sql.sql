CREATE DATABASE m151cfp;
USE m151cfp;

CREATE TABLE users (
  userid int(11) UNSIGNED NOT NULL,
  username varchar(30) NOT NULL,
  passwd varchar(30) NOT NULL,
  isadmin tinyint(1) NOT NULL,
  PRIMARY KEY(userid)
);

CREATE TABLE cases (
	caseid int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  userid int(11) UNSIGNED NOT NULL,
  caseText varchar(420),
  state ENUM('todo','atwork','done') NOT NULL,
  PRIMARY KEY(caseid),
  FOREIGN KEY(userid) REFERENCES users (userid)
);

INSERT INTO users (userid, username, passwd, isadmin) VALUES
(1, 'Gertrud', 'alphaF', 1),
(2, 'Kevin', 'lilKev', 0),
(3, 'Pappa', 'whiteKnight', 0);

INSERT INTO cases (userid , caseText, state) VALUES
(2, 'Bring den Stuhl zurück', 'todo'),
(2, 'Am Michael sein "Frünschaftsbüechli" zurückbringen', 'todo'),
(2, 'Bettwäsche in die Waschzeine werfen', 'atwork'),
(2, 'Fussballschuhe putzen', 'done'),
(3, 'Keine Bohnen mehr, bitte einkaufen gehen.', 'todo'),
(3, 'Kevin zum Flötenuntericht fahren.', 'todo'),
(3, 'Wein für den Jassabend organisieren', 'done');
