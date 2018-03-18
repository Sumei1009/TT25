DROP TABLE IF EXISTS car,ride_generate,bid;

CREATE TABLE car(
car_id VARCHAR(10) PRIMARY KEY,
car_brand VARCHAR(10) NOT NULL,
car_model VARCHAR(15),
phone_number INTEGER REFERENCES appuser(phone_number)
);

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