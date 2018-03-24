
CREATE TABLE bid(
phone_number INTEGER REFERENCES appuser(phone_number),
rid_number VARCHAR(10) REFERENCES ride_generate(rid_number),
status BOOLEAN,
point INTEGER,
PRIMARY KEY (phone_number,rid_number)
);