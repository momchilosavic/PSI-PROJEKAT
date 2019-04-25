
CREATE TABLE Korisnik
(
	username             VARCHAR(20) NOT NULL,
	password             VARCHAR(20) NOT NULL,
	email                VARCHAR(40) NOT NULL,
	grupa                CHAR NOT NULL CHECK ( grupa IN ('A', 'V', 'R') ),
	zbir_ocena           INTEGER NULL,
	broj_ocena           INTEGER NULL,
	datum_registracije   DATE NOT NULL,
	vreme_registracije   TIME NOT NULL,
	datum_poslednje_prijave DATE NOT NULL,
	vreme_poslednje_prijave TIME NOT NULL
);

ALTER TABLE Korisnik
ADD CONSTRAINT XPKKorisnik PRIMARY KEY (username);

CREATE TABLE Ocena
(
	IDTermin             INTEGER NOT NULL,
	username_ocenjeni    VARCHAR(20) NOT NULL,
	username_ocenjivac   VARCHAR(20) NOT NULL,
	ocena                INTEGER NOT NULL CHECK ( ocena BETWEEN 0 AND 5 ),
	razlog               VARCHAR(128) NOT NULL,
	datum_ocenjivanja    DATE NOT NULL,
	vreme_ocenjivanja    TIME NOT NULL
);

ALTER TABLE Ocena
ADD CONSTRAINT XPKOcena PRIMARY KEY (IDTermin,username_ocenjeni,username_ocenjivac);

CREATE TABLE Sportski_objekat
(
	IDObjekat            INTEGER NOT NULL AUTO_INCREMENT,
	naziv                VARCHAR(30) NOT NULL,
	adresa               VARCHAR(40) NOT NULL,
	veb_sajt             VARCHAR(30) NULL,
	slika                VARCHAR(40) NOT NULL,
	username             VARCHAR(20) NOT NULL,
	PRIMARY KEY(IDObjekat)
);

CREATE TABLE Termin
(
	IDTermin             INTEGER NOT NULL AUTO_INCREMENT,
	naslov               VARCHAR(30) NOT NULL,
	sport                VARCHAR(20) NOT NULL,
	adresa               VARCHAR(40) NOT NULL,
	vreme                TIME NOT NULL,
	datum                DATE NOT NULL,
	cena                 INTEGER NOT NULL CHECK ( cena >= 0 ),
	broj_potrebnih_igraca INTEGER NOT NULL CHECK ( broj_potrebnih_igraca >= 0 ),
	broj_prijavljenih_igraca INTEGER NOT NULL DEFAULT 0 CHECK ( broj_prijavljenih_igraca >= 0 ),
	opis                 VARCHAR(128) NOT NULL,
	username             VARCHAR(20) NOT NULL,
	datum_kreiranja      DATE NOT NULL,
	status               CHAR NOT NULL CHECK ( status IN ('A', 'N') ),
	PRIMARY KEY(IDTermin)
);


CREATE TABLE Zahtev
(
	username             VARCHAR(20) NOT NULL,
	IDTermin             INTEGER NOT NULL,
	odgovor              CHAR NULL CHECK ( odgovor IN ('P', 'O') ),
	datum_zahteva        DATE NOT NULL,
	vreme_zahteva        TIME NOT NULL,
	datum_odgovora       DATE NULL,
	vreme_odgovora       TIME NULL
);

ALTER TABLE Zahtev
ADD CONSTRAINT XPKZahtev PRIMARY KEY (username,IDTermin);

ALTER TABLE Ocena
ADD CONSTRAINT R_4 FOREIGN KEY (IDTermin) REFERENCES Termin (IDTermin);

ALTER TABLE Ocena
ADD CONSTRAINT R_5 FOREIGN KEY (username_ocenjeni) REFERENCES Korisnik (username);

ALTER TABLE Ocena
ADD CONSTRAINT R_6 FOREIGN KEY (username_ocenjivac) REFERENCES Korisnik (username);

ALTER TABLE Sportski_objekat
ADD CONSTRAINT R_7 FOREIGN KEY (username) REFERENCES Korisnik (username);

ALTER TABLE Termin
ADD CONSTRAINT R_1 FOREIGN KEY (username) REFERENCES Korisnik (username);

ALTER TABLE Zahtev
ADD CONSTRAINT R_2 FOREIGN KEY (username) REFERENCES Korisnik (username);

ALTER TABLE Zahtev
ADD CONSTRAINT R_3 FOREIGN KEY (IDTermin) REFERENCES Termin (IDTermin);
