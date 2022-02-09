/*Fichier d'installation de la base de donnée SLQ */



CREATE TABLE IF NOT EXISTS Client (
    NumClient INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    NomClient VARCHAR(30),
    PrenomClient VARCHAR(30),
    AdresseClient VARCHAR(250),
    TelClient VARCHAR(15),
    MailClient VARCHAR(60),
    Login VARCHAR(30) UNIQUE,
    Password VARCHAR(60),
    NumResa INT,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS Reservation (
    NumResa INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    DateReservation DATE,
    HoraireDebut TIME,
    HoraireFin TIME,
    TypeResa VARCHAR(50),
    NumClient INT,
    NumTerrain INT
);

CREATE TABLE IF NOT EXISTS Adhesion (
    NumAdhes INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    TypeAdhes VARCHAR(80),
    TempsAdhes DATETIME,
    TarifAdhes DECIMAL(50,12),
    NumClient INT
);

CREATE TABLE IF NOT EXISTS Casier (
    IdCasiers INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    NbCasiers INT,
    DureeResaCasiers DATETIME,
    TarifCasiers DECIMAL(50,12),
    NumClient INT,
    NumResa INT
);

CREATE TABLE IF NOT EXISTS Personnel (
    NumPerso INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    NomPerso VARCHAR(30),
    PrenomPerso VARCHAR(30),
    AdressePerso VARCHAR(250),
    TelPerso VARCHAR(15),
    MailPerso VARCHAR(60),
    FonctionPerso VARCHAR(80),
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS PersoRestauration (
    NumPerso INT,
    TypeVente VARCHAR(100),
    TypeBoisson VARCHAR(100)
);

CREATE TABLE IF NOT EXISTS PersoServices (
    NumPerso INT,
    TypeService VARCHAR(100),
    TypeProduit VARCHAR(100)
);

CREATE TABLE IF NOT EXISTS SalleSquash (
    NumTerrain INT PRIMARY KEY NOT NULL,
    NomTerrain VARCHAR(100)
);

CREATE TABLE IF NOT EXISTS SalleGym (
    NumSalle INT PRIMARY KEY NOT NULL,
    NomSalle VARCHAR(100)
);

CREATE TABLE IF NOT EXISTS PlanningSquash (
    DateSquash DATE,
    CreneauHoraire TIME,
    NumTerrain INT,
    CodeCours INT,
    NumResa INT,
    PRIMARY KEY (DateSquash,CodeCours,NumResa)
);

CREATE TABLE IF NOT EXISTS PlanningGym (
    DateGym DATE,
    CreneauHoraire TIME,
    NumSalle INT,
    CodeCours INT,
    PRIMARY KEY (DateGym,NumSalle,CodeCours)
);

CREATE TABLE IF NOT EXISTS Equipement (
    IdEquipement INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    NbUnite INT,
    TypeLot VARCHAR(80),
    NumSalle INT
);

CREATE TABLE IF NOT EXISTS Cours (
    CodeCours INT PRIMARY KEY NOT NULL,
    NomCours VARCHAR(100),
    TypeCours VARCHAR(100),
    NbClient INT,
    NumSalle INT,
    NumTerrain INT
);

CREATE TABLE IF NOT EXISTS GestionCours (
    CodeCours INT,
    NumPerso INT,
    PRIMARY Key (CodeCours,NumPerso)
);

ALTER TABLE Client
ADD FOREIGN KEY (NumResa) REFERENCES Reservation (NumResa);

ALTER TABLE Reservation
ADD FOREIGN KEY (NumClient) REFERENCES Client (NumClient);
ALTER TABLE Reservation
ADD FOREIGN KEY (NumTerrain) REFERENCES SalleSquash (NumTerrain);

ALTER TABLE Adhesion
ADD FOREIGN KEY (NumClient) REFERENCES Client (NumClient);

ALTER TABLE Casier
ADD FOREIGN KEY (NumClient) REFERENCES Client (NumClient);
ALTER TABLE Casier
ADD FOREIGN KEY (NumResa) REFERENCES Reservation (NumResa);

ALTER TABLE PersoRestauration
ADD FOREIGN KEY (NumPerso) REFERENCES Personnel (NumPerso);
ALTER TABLE PersoServices
ADD FOREIGN KEY (NumPerso) REFERENCES Personnel (NumPerso);

ALTER TABLE PlanningSquash
ADD FOREIGN KEY (NumTerrain) REFERENCES SalleSquash (NumTerrain);
ALTER TABLE PlanningSquash
ADD FOREIGN KEY (NumResa) REFERENCES Reservation (NumResa);
ALTER TABLE PlanningSquash
ADD FOREIGN KEY (CodeCours) REFERENCES Cours (CodeCours);

ALTER TABLE PlanningGym
ADD FOREIGN KEY (NumSalle) REFERENCES SalleGym (NumSalle);
ALTER TABLE PlanningGym
ADD FOREIGN KEY (CodeCours) REFERENCES Cours (CodeCours);

ALTER TABLE Equipement
ADD FOREIGN KEY (NumSalle) REFERENCES SalleGym (NumSalle);

ALTER TABLE Cours
ADD FOREIGN KEY (NumSalle) REFERENCES SalleGym (NumSalle);
ALTER TABLE Cours
ADD FOREIGN KEY (NumTerrain) REFERENCES SalleSquash (NumTerrain);

ALTER TABLE GestionCours
ADD FOREIGN KEY (CodeCours) REFERENCES Cours (CodeCours);
ALTER TABLE GestionCours
ADD FOREIGN KEY (NumPerso) REFERENCES Personnel (NumPerso);
