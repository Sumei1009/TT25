DROP TABLE IF EXISTS ride_generate,bid;

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


