DROP TABLE Create_Quote;
DROP TABLE Quote_Note;
DROP TABLE Quote_Item;
DROP TABLE User;
DROP TABLE Quote;
DROP TABLE Note;
DROP TABLE Item;


CREATE TABLE User(
	id INTEGER PRIMARY KEY NOT NULL AUTO_INCREMENT,
	is_associate BOOLEAN DEFAULT(1),
	is_hq BOOLEAN DEFAULT(0),
	is_admin BOOLEAN DEFAULT(0),
	name CHAR(20) NOT NULL,
	password CHAR(16) NOT NULL,
	commission FLOAT NULL,
    address CHAR(50) NULL
);

CREATE TABLE Quote(
	id INTEGER PRIMARY KEY NOT NULL AUTO_INCREMENT,
	customer INTEGER NOT NULL,
	price FLOAT NOT NULL DEFAULT(0),
	customerEmail CHAR(50) NOT NULL DEFAULT 'example@gmail.com',
	status CHAR(1) NOT NULL DEFAULT 'U'
);

CREATE TABLE Note(
	id INTEGER PRIMARY KEY NOT NULL AUTO_INCREMENT,
	text_field CHAR(250)
);

CREATE TABLE Item(
	id INTEGER PRIMARY KEY NOT NULL AUTO_INCREMENT,
	price DECIMAL(7,2) NOT NULL,
	name CHAR(20) NOT NULL
);

CREATE TABLE Create_Quote(
	associate_id INTEGER NOT NULL,
	quote_id INTEGER NOT NULL,
	date_time TIMESTAMP NOT NULL,
	FOREIGN KEY(associate_id) REFERENCES User(id),
	FOREIGN KEY(quote_id) REFERENCES Quote(id)
);

CREATE TABLE Quote_Note(
	quote_id INTEGER NOT NULL,
	note_id INTEGER NOT NULL,
	FOREIGN KEY(quote_id) REFERENCES Quote(id),
	FOREIGN KEY(note_id) REFERENCES Note(id)
);

CREATE TABLE Quote_Item(
	quote_id INTEGER NOT NULL,
	item_id INTEGER NOT NULL,
	quantity INTEGER NOT NULL,
	FOREIGN KEY(quote_id) REFERENCES Quote(id),
	FOREIGN KEY(item_id) REFERENCES Item(id)
);


INSERT INTO User (name, password, commission, address) VALUES ('brad', '1234', '1000.00', '900 Crane Dr.');
INSERT INTO User (name, password, commission, address) VALUES ('test', 'test', '1000.00', '1 Main St.');
INSERT INTO User (name, password, commission, address) VALUES ('another associate', '1234', '999.00', '123 Some St.');
INSERT INTO User (is_associate, is_hq, name, password, commission, address) VALUES (0, 1, 'bradhq', '1234', '0', '475 Laurel St.');
INSERT INTO User (is_associate, is_admin, name, password, commission, address) VALUES (0, 1, 'bradadmin', '1234', '0', '475 Admin St.');