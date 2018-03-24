DROP TABLE IF EXISTS appuser,car,ride_generate,bid;

CREATE TABLE appuser(
phone_number  INTEGER PRIMARY KEY,
first_name VARCHAR(30) NOT NULL,
last_name VARCHAR(30) NOT NULL,
gender CHAR(1),
password VARCHAR(20) NOT NULL, 
rating NUMERIC
);

CREATE TABLE car(
	car_id VARCHAR(10) PRIMARY KEY,
	car_brand VARCHAR(10) NOT NULL,
	car_model VARCHAR(15),
	phone_number INTEGER REFERENCES appuser(phone_number)
);

CREATE TABLE ride_generate(
	rid_number VARCHAR(10) PRIMARY KEY,
	car_id VARCHAR(10) REFERENCES car(car_id),
	passenger_id INTEGER REFERENCES appuser(phone_number),
	date_of_generation DATE,
	date_of_ride DATE,
	time_of_ride TIME,
	num_of_seats INTEGER,
	origin VARCHAR(100),
	destination VARCHAR(100),
	lowest_bid_point NUMERIC
);


CREATE TABLE bid(
	phone_number INTEGER REFERENCES appuser(phone_number),
	rid_number VARCHAR(10) REFERENCES ride_generate(rid_number),
	status BOOLEAN,
	point INTEGER,
	PRIMARY KEY (phone_number,rid_number)
);

INSERT INTO appuser VALUES (90388714,'Sumei','Su','F','asfsadg',null);
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

INSERT INTO car VALUES ('SFK60Y', 'Toyota', null,  90388714);
INSERT INTO car VALUES ('SBB20S', 'Honda', null,  60378918);
INSERT INTO car VALUES ('SLH7979X', 'Toyota', null,  94588911);
INSERT INTO car VALUES ('SCP39U', 'Toyota', null,  99088912);
INSERT INTO car VALUES ('EC1668S', 'Toyota', null,  90988913);
INSERT INTO car VALUES ('SDX2222P', 'Toyota', null,  90298914);
INSERT INTO car VALUES ('SDR121S', 'Toyota', null,  90288914);
INSERT INTO car VALUES ('SLW96K', 'Toyota', null,  90344914);
INSERT INTO car VALUES ('SKM18B', 'Toyota', null,  90892914);
INSERT INTO car VALUES ('SDK18U', 'Toyota', null,  90092914);
INSERT INTO car VALUES ('SGH222B', 'Toyota', null,  90388953);
INSERT INTO car VALUES ('SKQ6P', 'Toyota', null,  90388992);
INSERT INTO car VALUES ('SLS900K', 'Toyota', null,  90388901);
INSERT INTO car VALUES ('SJB89R', 'Toyota', null,  90388930);
INSERT INTO car VALUES ('SLL9X', 'Toyota', null,  90388234);
INSERT INTO car VALUES ('SFZ8888U', 'Toyota', null,  90388452);
INSERT INTO car VALUES ('EA9817L', 'Toyota', null,  90523553);
INSERT INTO car VALUES ('EH2020C', 'Toyota', null,  45352346);
INSERT INTO car VALUES ('SFB14D', 'Toyota', null,  46784343);
INSERT INTO car VALUES ('SJU999P', 'Toyota', null,  23422335);
INSERT INTO car VALUES ('SDZ9393Y', 'Toyota', null,  90434536);
INSERT INTO car VALUES ('ST74G', 'Toyota', null,  32543636);
INSERT INTO car VALUES ('SKG1111P', 'Toyota', null,  23674583);

INSERT INTO ride_generate VALUES ('AA00000001', 'SFK60Y', null, 
	'2018-02-01', '2018-03-01', '09:00:00', 2, 'Kent Ridge', 'Somerset', 0);
INSERT INTO ride_generate VALUES ('AA00000002', 'SFK60Y', null, 
	'2018-02-01', '2018-03-02', '09:00:00', 2, 'Kent Ridge', 'Somerset', 0);
INSERT INTO ride_generate VALUES ('AA00000003', 'SDX2222P', null, 
	'2018-02-01', '2018-03-03', '09:00:00', 2, 'Kent Ridge', 'Somerset', 0);
INSERT INTO ride_generate VALUES ('AA00000004', 'SLW96K', null, 
	'2018-02-01', '2018-03-01', '10:00:00', 3, 'Bugis', 'Tampines', 0);
INSERT INTO ride_generate VALUES ('AA00000005', 'SKQ6P', null, 
	'2018-02-01', '2018-03-02', '10:00:00', 3, 'Bugis', 'Tampines', 0);
INSERT INTO ride_generate VALUES ('AA00000006', 'SKQ6P', null, 
	'2018-02-01', '2018-03-03', '10:00:00', 3, 'Bugis', 'Tampines', 0);
INSERT INTO ride_generate VALUES ('AA00000007', 'SLS900K', null, 
	'2018-02-01', '2018-03-01', '09:00:00', 2, 'Harbourfront', 'Newton', 0);
INSERT INTO ride_generate VALUES ('AA00000008', 'SDZ9393Y', null, 
	'2018-02-01', '2018-03-02', '09:00:00', 2, 'Harbourfront', 'Newton', 0);
INSERT INTO ride_generate VALUES ('AA00000009', 'SLS900K', null, 
	'2018-02-01', '2018-03-03', '09:00:00', 2, 'Harbourfront', 'Newton', 0);
INSERT INTO ride_generate VALUES ('AA00000010', 'SFB14D', null, 
	'2018-02-01', '2018-03-01', '10:00:00', 3, 'Changi Airport', 'Woodlands', 0);
INSERT INTO ride_generate VALUES ('AA00000011', 'SDX2222P', null, 
	'2018-02-01', '2018-03-02', '10:00:00', 3, 'Changi Airport', 'Woodlands', 0);
INSERT INTO ride_generate VALUES ('AA00000012', 'SFB14D', null, 
	'2018-02-01', '2018-03-03', '10:00:00', 3, 'Changi Airport', 'Woodlands', 0);
INSERT INTO ride_generate VALUES ('AA00000013', 'SDZ9393Y', null, 
	'2018-02-01', '2018-03-01', '09:00:00', 2, 'Promenade', 'Beauty World', 0);
INSERT INTO ride_generate VALUES ('AA00000014', 'SFB14D', null, 
	'2018-02-01', '2018-03-02', '09:00:00', 2, 'Promenade', 'Beauty World', 0);
INSERT INTO ride_generate VALUES ('AA00000015', 'SLW96K', null, 
	'2018-02-01', '2018-03-03', '09:00:00', 2, 'Promenade', 'Beauty World', 0);


INSERT INTO bid VALUES (90388714, 'AA00000001', FALSE, 500);
INSERT INTO bid VALUES (90388714, 'AA00000002', FALSE, 300);
INSERT INTO bid VALUES (90388714, 'AA00000003', FALSE, 100);
INSERT INTO bid VALUES (60378918, 'AA00000001', FALSE, 600);
INSERT INTO bid VALUES (30588916, 'AA00000001', FALSE, 700);
