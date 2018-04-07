DROP TABLE IF EXISTS appuser,car,ride_generate,bid;

CREATE TABLE appuser(
	phone_number  INTEGER PRIMARY KEY,
	first_name VARCHAR(30) NOT NULL,
	last_name VARCHAR(30) NOT NULL,
	gender CHAR(1),
	password VARCHAR(20) NOT NULL, 
	isadmin BOOLEAN
);

CREATE TABLE car(
	car_id VARCHAR(10) UNIQUE,
	car_brand VARCHAR(10) NOT NULL,
	car_model VARCHAR(15),
	phone_number INTEGER REFERENCES appuser(phone_number)
		ON DELETE CASCADE
		ON UPDATE CASCADE,
	PRIMARY KEY (phone_number)
);

CREATE TABLE ride_generate(
	rid_number VARCHAR(10) PRIMARY KEY,
	rider_id INTEGER REFERENCES car(phone_number)
		ON DELETE CASCADE
		ON UPDATE CASCADE,
	passenger_id INTEGER REFERENCES appuser(phone_number)
		ON DELETE CASCADE
		ON UPDATE CASCADE,
	date_of_generation DATE,
	date_of_ride DATE,
	time_of_ride TIME,
	num_of_seats INTEGER,
	origin VARCHAR(100),
	destination VARCHAR(100),
	UNIQUE (rid_number, rider_id),
	UNIQUE (date_of_ride, time_of_ride, rider_id)
);

CREATE TABLE bid(
	phone_number INTEGER REFERENCES appuser(phone_number)
		ON DELETE CASCADE
		ON UPDATE CASCADE,
	rid_number VARCHAR(10),
	rider_id INTEGER,
	FOREIGN KEY (rid_number, rider_id) REFERENCES ride_generate(rid_number, rider_id)
		ON DELETE CASCADE
		ON UPDATE CASCADE,
	status BOOLEAN,
	point INTEGER,
	PRIMARY KEY (phone_number,rid_number),
	CHECK (phone_number <> rider_id),
	CHECK (point >= 0)
);

CREATE OR REPLACE FUNCTION UpdateBid (new_point integer, curr_rid VARCHAR(10), curr_phone INTEGER)
	RETURNS void AS
	$BODY$
		BEGIN
		UPDATE bid SET point = new_point
		WHERE rid_number = curr_rid
		AND phone_number = curr_phone;
		END;
	$BODY$
	LANGUAGE 'plpgsql' VOLATILE
	COST 100;

CREATE OR REPLACE FUNCTION deletecar (user_id INTEGER)
	RETURNS void AS
	$BODY$
		BEGIN
		DELETE FROM bid WHERE rider_id = user_id;
		DELETE FROM ride_generate WHERE rider_id = user_id;
		DELETE FROM car WHERE phone_number = user_id;
		END;
	$BODY$
	LANGUAGE 'plpgsql' VOLATILE;

INSERT INTO appuser VALUES (99999999,'Mark','Zuckerberg','M','facebook001', TRUE);
INSERT INTO appuser VALUES (90388714,'Sumei','Su','F','11111111',FALSE);
INSERT INTO appuser VALUES (90388914,'Thomas','Smith', 'M', 'asfsdffsadf', FALSE);
INSERT INTO appuser VALUES (60378918,'Gabriel','Johnson', 'M', 'asfsdffsadf', FALSE);
INSERT INTO appuser VALUES (30588916,'Adrian','Chan', 'M', 'asfsdffsadf', FALSE);
INSERT INTO appuser VALUES (90377916,'Cindy','Smith', 'F', 'asfsdffsadf', FALSE);
INSERT INTO appuser VALUES (90688917,'Kaylee','Low', 'F', 'asfsdffsadf', FALSE);
INSERT INTO appuser VALUES (94588911,'Jessica','Moore', 'F', 'asfsdffsadf', FALSE);
INSERT INTO appuser VALUES (96788912,'Leo','Zhang', 'M', 'asfsdffsadf', FALSE);
INSERT INTO appuser VALUES (98988914,'Victor','Wilson', 'M', 'asfsdffsadf', FALSE);
INSERT INTO appuser VALUES (99088912,'Müller','Zimmermann', 'M', 'asfsdffsadf', FALSE);
INSERT INTO appuser VALUES (90088914,'Jack','Wilson', 'M', 'asfsdffsadf', FALSE);
INSERT INTO appuser VALUES (99988910,'Rachel','Kuo', 'F', 'asfsdffsadf', FALSE);
INSERT INTO appuser VALUES (90988913,'Elizabeth','Jones', 'F', 'asfsdffsadf', FALSE);
INSERT INTO appuser VALUES (90278914,'Mark','Wilson', 'M', 'asfsdffsadf', FALSE);
INSERT INTO appuser VALUES (90108917,'Jones','Wong', 'F', 'asfsdffsadf', FALSE);
INSERT INTO appuser VALUES (90298914,'Williams','Smith', 'M', 'asfsdffsadf', FALSE);
INSERT INTO appuser VALUES (90288914,'Junyang','Sun', 'M', 'asfsdffsadf', FALSE);
INSERT INTO appuser VALUES (90458914,'Kevin','Jones', 'M', 'asfsdffsadf', FALSE);
INSERT INTO appuser VALUES (90344914,'Lucy','Davis', 'F', 'asfsdffsadf', FALSE);
INSERT INTO appuser VALUES (90322914,'Martin','Hill', 'M', 'asfsdffsadf', FALSE);
INSERT INTO appuser VALUES (90892914,'Zack','Smith', 'M', 'asfsdffsadf', FALSE);
INSERT INTO appuser VALUES (90112914,'Xavier','Sun', 'M', 'asfsdffsadf', FALSE);
INSERT INTO appuser VALUES (90092914,'Lucas','Johnson', 'M', 'asfsdffsadf', FALSE);
INSERT INTO appuser VALUES (90022914,'Nicolas','Smith', 'M', 'asfsdffsadf', FALSE);
INSERT INTO appuser VALUES (90103414,'Alex','Wong', 'M', 'asfsdffsadf', FALSE);
INSERT INTO appuser VALUES (90388953,'Derek','Ng', 'M', 'asfsdffsadf', FALSE);
INSERT INTO appuser VALUES (90388992,'Maria','Williams', 'F', 'asfsdffsadf', FALSE);
INSERT INTO appuser VALUES (90388900,'Emma','Taylor', 'F', 'asfsdffsadf', FALSE);
INSERT INTO appuser VALUES (90388901,'Chole','Ong', 'F', 'asfsdffsadf', FALSE);
INSERT INTO appuser VALUES (90388930,'Eva','White', 'F', 'asfsdffsadf', FALSE);
INSERT INTO appuser VALUES (90388203,'Sarah','Wong', 'F', 'asfsdffsadf', FALSE);
INSERT INTO appuser VALUES (90388234,'Laurie','Smith', 'F', 'asfsdffsadf', FALSE);
INSERT INTO appuser VALUES (90388452,'Adele','Smith', 'F', 'asfsdffsadf', FALSE);
INSERT INTO appuser VALUES (90523553,'Evelyn','Williams', 'F', 'asfsdffsadf', FALSE);
INSERT INTO appuser VALUES (90657732,'Anna','Smith', 'F', 'asfsdffsadf', FALSE);
INSERT INTO appuser VALUES (45352346,'Alice','Phillips', 'F', 'asfsdffsadf', FALSE);
INSERT INTO appuser VALUES (46784343,'Bob','Tan', 'M', 'asfsdffsadf', FALSE);
INSERT INTO appuser VALUES (54688914,'Curly','Brown', 'F', 'asfsdffsadf', FALSE);
INSERT INTO appuser VALUES (23422335,'Benjamin','Lim', 'M', 'asfsdffsadf', FALSE);
INSERT INTO appuser VALUES (90434536,'Emily','Lim', 'F', 'asfsdffsadf', FALSE);
INSERT INTO appuser VALUES (32543636,'Daisy','Gray', 'F', 'asfsdffsadf', FALSE);
INSERT INTO appuser VALUES (23674583,'Amber','Lee', 'F',  'asfsdffsadf', FALSE);

INSERT INTO car VALUES ('SFK60Y', 'Toyota', 'Aygo',  90388714);
INSERT INTO car VALUES ('SBB20S', 'Toyota', 'Prius',  60378918);
INSERT INTO car VALUES ('SLH7979X', 'Toyota', 'Etios Liva',  94588911);
INSERT INTO car VALUES ('SCP39U', 'Toyota', 'Prius',  99088912);
INSERT INTO car VALUES ('EC1668S', 'Toyota', 'Prius',  90988913);
INSERT INTO car VALUES ('SDX2222P', 'Toyota', 'Aygo',  90298914);
INSERT INTO car VALUES ('SDR121S', 'Toyota', 'Aygo',  90288914);
INSERT INTO car VALUES ('SLW96K', 'Toyota', 'Aygo',  90344914);
INSERT INTO car VALUES ('SKM18B', 'Toyota', 'Aygo',  90892914);
INSERT INTO car VALUES ('SDK18U', 'Toyota', 'Aygo',  90092914);
INSERT INTO car VALUES ('SGH222B', 'Toyota', 'Prius',  90388953);
INSERT INTO car VALUES ('SKQ6P', 'Toyota', 'Etios Liva',  90388992);
INSERT INTO car VALUES ('SLS900K', 'Toyota', 'Etios Liva',  90388901);
INSERT INTO car VALUES ('SJB89R', 'Toyota', 'Aygo',  90388930);
INSERT INTO car VALUES ('SLL9X', 'Toyota', 'Aygo',  90388234);
INSERT INTO car VALUES ('SFZ8888U', 'Toyota', 'Etios Liva',  90388452);
INSERT INTO car VALUES ('EA9817L', 'Toyota', 'Aygo',  90523553);
INSERT INTO car VALUES ('EH2020C', 'Toyota', 'Etios Liva',  45352346);
INSERT INTO car VALUES ('SFB14D', 'Toyota', 'Aygo',  46784343);
INSERT INTO car VALUES ('SJU999P', 'Toyota', 'Etios Liva',  23422335);
INSERT INTO car VALUES ('SDZ9393Y', 'Toyota', 'Etios Liva',  90434536);
INSERT INTO car VALUES ('ST74G', 'Toyota', 'Etios Liva',  32543636);
INSERT INTO car VALUES ('SKG1111P', 'Toyota', 'Etios Liva',  23674583);

INSERT INTO ride_generate VALUES ('AA00000001', 90388714, null, 
	'2018-02-01', '2018-03-01', '09:00:00', 2, 'Kent Ridge', 'Somerset');
INSERT INTO ride_generate VALUES ('AA00000002', 90388714, null, 
	'2018-02-01', '2018-03-02', '09:00:00', 2, 'Kent Ridge', 'Somerset');
INSERT INTO ride_generate VALUES ('AA00000003', 90298914, null, 
	'2018-02-01', '2018-03-03', '09:00:00', 2, 'Kent Ridge', 'Somerset');
INSERT INTO ride_generate VALUES ('AA00000004', 90344914, null, 
	'2018-02-01', '2018-03-01', '10:00:00', 3, 'Bugis', 'Tampines');
INSERT INTO ride_generate VALUES ('AA00000005', 90388992, null, 
	'2018-02-01', '2018-03-02', '10:00:00', 3, 'Bugis', 'Tampines');
INSERT INTO ride_generate VALUES ('AA00000006', 90388992, null, 
	'2018-02-01', '2018-03-03', '10:00:00', 3, 'Bugis', 'Tampines');
INSERT INTO ride_generate VALUES ('AA00000007', 90388901, null, 
	'2018-02-01', '2018-03-01', '09:00:00', 2, 'Harbourfront', 'Newton');
INSERT INTO ride_generate VALUES ('AA00000008', 90388901, null, 
	'2018-02-01', '2018-03-02', '09:00:00', 2, 'Harbourfront', 'Newton');
INSERT INTO ride_generate VALUES ('AA00000009', 90388901, null, 
	'2018-02-01', '2018-03-03', '09:00:00', 2, 'Harbourfront', 'Newton');
INSERT INTO ride_generate VALUES ('AA00000010', 46784343, null, 
	'2018-02-01', '2018-03-01', '10:00:00', 3, 'Changi Airport', 'Woodlands');
INSERT INTO ride_generate VALUES ('AA00000011', 46784343, null, 
	'2018-02-01', '2018-03-02', '10:00:00', 3, 'Changi Airport', 'Woodlands');
INSERT INTO ride_generate VALUES ('AA00000012', 46784343, null, 
	'2018-02-01', '2018-03-03', '10:00:00', 3, 'Changi Airport', 'Woodlands');
INSERT INTO ride_generate VALUES ('AA00000013', 90434536, null, 
	'2018-02-01', '2018-03-01', '09:00:00', 2, 'Promenade', 'Beauty World');
INSERT INTO ride_generate VALUES ('AA00000014', 60378918, null, 
	'2018-02-01', '2018-03-02', '09:00:00', 2, 'Promenade', 'Beauty World');
INSERT INTO ride_generate VALUES ('AA00000015', 90344914, null, 
	'2018-02-01', '2018-03-03', '09:00:00', 2, 'Promenade', 'Beauty World');

INSERT INTO bid VALUES (90388714, 'AA00000004', 90344914, null, 100);
INSERT INTO bid VALUES (90388714, 'AA00000005', 90388992, null, 300);
INSERT INTO bid VALUES (90388714, 'AA00000003', 90298914, null, 500);
INSERT INTO bid VALUES (60378918, 'AA00000003', 90298914, null, 600);
INSERT INTO bid VALUES (30588916, 'AA00000003', 90298914, null, 700);
INSERT INTO bid VALUES (30588916, 'AA00000001', 90388714, null, 400);
INSERT INTO bid VALUES (60378918, 'AA00000001', 90388714, null, 200);
INSERT INTO bid VALUES (90022914, 'AA00000001', 90388714, null, 500);
INSERT INTO bid VALUES (90022914, 'AA00000002', 90388714, null, 600);
INSERT INTO bid VALUES (60378918, 'AA00000002', 90388714, null, 800);
