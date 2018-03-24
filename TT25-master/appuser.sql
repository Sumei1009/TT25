DROP TABLE IF EXISTS appuser,car,ride_generate,bid;

CREATE TABLE appuser(
phone_number  INTEGER PRIMARY KEY,
first_name VARCHAR(30) NOT NULL,
last_name VARCHAR(30) NOT NULL,
gender CHAR(1),
password VARCHAR(20) NOT NULL, 
rating NUMERIC
);

INSERT INTO appuser VALUES (
	90388714,
	'Sumei',
	'Su',
	'F',
	'asfsadg',
	null
);
INSERT INTO appuser VALUES (90388914,'Thomas','Smith', 'M', 'asfsdffsadf', 4.5);
INSERT INTO appuser VALUES (60378918,'Gabriel','Johnson', 'M', 'asfsdffsadf', null);
INSERT INTO appuser VALUES (30588916,'Adrian','Chan', 'M', 'asfsdffsadf', 4.8);
INSERT INTO appuser VALUES (90377916,'Cindy','Smith', 'F', 'asfsdffsadf', 4);
INSERT INTO appuser VALUES (90688917,'Kaylee','Low', 'F', 'asfsdffsadf', 3.5);
INSERT INTO appuser VALUES (94588911,'Jessica','Moore', 'F', 'asfsdffsadf', 4.2);
INSERT INTO appuser VALUES (96788912,'Leo','Zhang', 'M', 'asfsdffsadf', 4.9);
INSERT INTO appuser VALUES (98988914,'Victor','Wilson', 'M', 'asfsdffsadf', 5);
INSERT INTO appuser VALUES (99088912,'Müller','Zimmermann', 'M', 'asfsdffsadf', 4.5);
INSERT INTO appuser VALUES (90088914,'Jack','Wilson', 'M', 'asfsdffsadf', 4.5);
INSERT INTO appuser VALUES (99988910,'Rachel','Kuo', 'F', 'asfsdffsadf', 4.5);
INSERT INTO appuser VALUES (90988913,'Elizabeth','Jones', 'F', 'asfsdffsadf', 4.7);
INSERT INTO appuser VALUES (90278914,'Mark','Wilson', 'M', 'asfsdffsadf', 3.5);
INSERT INTO appuser VALUES (90108917,'Jones','Wong', 'F', 'asfsdffsadf', 4.2);
INSERT INTO appuser VALUES (90298914,'Williams','Smith', 'M', 'asfsdffsadf', 4);
INSERT INTO appuser VALUES (90288914,'Junyang','Sun', 'M', 'asfsdffsadf', 4.9);
INSERT INTO appuser VALUES (90458914,'Kevin','Jones', 'M', 'asfsdffsadf', 4.1);
INSERT INTO appuser VALUES (90344914,'Lucy','Davis', 'F', 'asfsdffsadf', 2.5);
INSERT INTO appuser VALUES (90322914,'Martin','Hill', 'M', 'asfsdffsadf', 4.5);
INSERT INTO appuser VALUES (90892914,'Zack','Smith', 'M', 'asfsdffsadf', 4.8);
INSERT INTO appuser VALUES (90112914,'Xavier','Sun', 'M', 'asfsdffsadf', 3.5);
INSERT INTO appuser VALUES (90092914,'Lucas','Johnson', 'M', 'asfsdffsadf', 3.8);
INSERT INTO appuser VALUES (90022914,'Nicolas','Smith', 'M', 'asfsdffsadf', 4.6);
INSERT INTO appuser VALUES (90103414,'Alex','Wong', 'M', 'asfsdffsadf', 4);
INSERT INTO appuser VALUES (90388953,'Derek','Ng', 'M', 'asfsdffsadf', 4.8);
INSERT INTO appuser VALUES (90388992,'Maria','Williams', 'F', 'asfsdffsadf', 4.3);
INSERT INTO appuser VALUES (90388900,'Emma','Taylor', 'F', 'asfsdffsadf', 4.4);
INSERT INTO appuser VALUES (90388901,'Chole','Ong', 'F', 'asfsdffsadf', 4.4);
INSERT INTO appuser VALUES (90388930,'Eva','White', 'F', 'asfsdffsadf', 4.6);
INSERT INTO appuser VALUES (90388203,'Sarah','Wong', 'F', 'asfsdffsadf', 4.5);
INSERT INTO appuser VALUES (90388234,'Laurie','Smith', 'F', 'asfsdffsadf', 4.8);
INSERT INTO appuser VALUES (90388452,'Adele','Smith', 'F', 'asfsdffsadf', 4.9);
INSERT INTO appuser VALUES (90523553,'Evelyn','Williams', 'F', 'asfsdffsadf', 5);
INSERT INTO appuser VALUES (90657732,'Anna','Smith', 'F', 'asfsdffsadf', 4.9);
INSERT INTO appuser VALUES (45352346,'Alice','Phillips', 'F', 'asfsdffsadf', 4);
INSERT INTO appuser VALUES (46784343,'Bob','Tan', 'M', 'asfsdffsadf', 4.8);
INSERT INTO appuser VALUES (54688914,'Curly','Brown', 'F', 'asfsdffsadf', 4.7);
INSERT INTO appuser VALUES (23422335,'Benjamin','Lim', 'M', 'asfsdffsadf', 4.6);
INSERT INTO appuser VALUES (90434536,'Emily','Lim', 'F', 'asfsdffsadf', 4.1);
INSERT INTO appuser VALUES (32543636,'Daisy','Gray', 'F', 'asfsdffsadf', 4.2);
INSERT INTO appuser VALUES (23674583,'Amber','Lee', 'F',  'asfsdffsadf',4.5);
