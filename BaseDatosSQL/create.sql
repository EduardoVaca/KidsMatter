CREATE TABLE State(
	stateId INT NOT NULL AUTO_INCREMENT,
	name VARCHAR(40) NOT NULL,
	PRIMARY KEY (stateId)
);

CREATE TABLE Grade(
	gradeId INT NOT NULL AUTO_INCREMENT,
	grade VARCHAR(40) NOT NULL,
	PRIMARY KEY(gradeId)
);

CREATE TABLE Child(
	CURP VARCHAR(18) NOT NULL,
	name VARCHAR(80) NOT NULL,
	gender VARCHAR(20) NOT NULL,
	birthday DATE NOT NULL,
	picture LONGBLOB,
	stateId INT NOT NULL,
	PRIMARY KEY(CURP),
	FOREIGN KEY (stateId) REFERENCES State(stateId)
);

CREATE TABLE Course(
	courseId INT NOT NULL AUTO_INCREMENT,
	name VARCHAR(40) NOT NULL,
	description VARCHAR(100),
	PRIMARY KEY(courseId)
);

CREATE TABLE Event(
	eventId INT NOT NULL AUTO_INCREMENT,
	name VARCHAR(60) NOT NULL,
	description VARCHAR(100),
	place VARCHAR(60),
	picture LONGBLOB,
	PRIMARY KEY(eventId)
);

CREATE TABLE Institution(
	institutionId INT NOT NULL AUTO_INCREMENT,
	name VARCHAR(80) NOT NULL,
	email VARCHAR(40) NOT NULL,
	phone VARCHAR(10),
	address VARCHAR(70),
	logo LONGBLOB,
	PRIMARY KEY(institutionId)
);

CREATE TABLE BelongsToInstitution(
	CURP VARCHAR(18) NOT NULL,
	institutionId INT NOT NULL,
	arrival DATE NOT NULL,
	PRIMARY KEY(CURP, institutionId),
	FOREIGN KEY (CURP) REFERENCES Child (CURP),
	FOREIGN KEY (institutionId) REFERENCES Institution (institutionId)
);

CREATE TABLE AttendsToEvent(
	CURP VARCHAR(18) NOT NULL,
	eventId INT NOT NULL,
	PRIMARY KEY(CURP, eventId),
	FOREIGN KEY (CURP) REFERENCES Child (CURP),
	FOREIGN KEY (eventId) REFERENCES Event(eventId)
);

CREATE TABLE CreatesEvent(
	institutionId INT NOT NULL,
	eventId INT NOT NULL,
	PRIMARY KEY(institutionId, eventId),
	FOREIGN KEY(institutionId) REFERENCES Institution(institutionId),
	FOREIGN KEY(eventId) REFERENCES Event(eventId)
);

CREATE TABLE ReportCard(
	CURP VARCHAR(18) NOT NULL,
	gradeId INT NOT NULL,
	courseId INT NOT NULL,
	gradeObtained INT NOT NULL,
	PRIMARY KEY(CURP, gradeId, courseId),
	FOREIGN KEY(CURP) REFERENCES Child(CURP),
	FOREIGN KEY(gradeId) REFERENCES Grade (gradeId),
	FOREIGN KEY(courseId) REFERENCES Course (courseId)
);

CREATE TABLE User(
	userName VARCHAR(20) NOT NULL,
	userPassword VARCHAR (20) NOT NULL,
	PRIMARY KEY (userName)
);

CREATE TABLE Rol(
	rolId INT NOT NULL AUTO_INCREMENT,
	name VARCHAR(30) NOT NULL,
	description VARCHAR(80),
	PRIMARY KEY(rolId)
);

CREATE TABLE WorksInInstitution(
	userName VARCHAR(20) NOT NULL,
	institutionId INT NOT NULL,
	PRIMARY KEY (userName, institutionId),
	FOREIGN KEY (userName) REFERENCES User (userName),
	FOREIGN KEY (institutionId) REFERENCES Institution (institutionId)
);

CREATE TABLE HasRole(
	userName VARCHAR(20) NOT NULL,
	rolId INT NOT NULL,
	PRIMARY KEY(userName, rolId),
	FOREIGN KEY(userName) REFERENCES User(userName),
	FOREIGN KEY(rolId) REFERENCES Rol(rolId)
);



/**GENERATION OF DEFAULT DATA **/

INSERT INTO State VALUES(0, "Aguascalientes");
INSERT INTO State VALUES(0, "Baja California");
INSERT INTO State VALUES(0, "Baja California Sur");
INSERT INTO State VALUES(0, "Campeche");
INSERT INTO State VALUES(0, "Chiapas");
INSERT INTO State VALUES(0, "Chihuahua");
INSERT INTO State VALUES(0, "Coahuila");
INSERT INTO State VALUES(0, "Colima");
INSERT INTO State VALUES(0, "Distrito Federal");
INSERT INTO State VALUES(0, "Durango");
INSERT INTO State VALUES(0, "Estado de Mexico");
INSERT INTO State VALUES(0, "Guanajuato");
INSERT INTO State VALUES(0, "Guerrero");
INSERT INTO State VALUES(0, "Hidalgo");
INSERT INTO State VALUES(0, "Jalisco");
INSERT INTO State VALUES(0, "Michoacan");
INSERT INTO State VALUES(0, "Morelos");
INSERT INTO State VALUES(0, "Nayarit");
INSERT INTO State VALUES(0, "Nuevo Leon");
INSERT INTO State VALUES(0, "Oaxaca");
INSERT INTO State VALUES(0, "Puebla");
INSERT INTO State VALUES(0, "Queretaro");
INSERT INTO State VALUES(0, "Quintana Roo");
INSERT INTO State VALUES(0, "San Luis Potosi");
INSERT INTO State VALUES(0, "Sinaloa");
INSERT INTO State VALUES(0, "Sonora");
INSERT INTO State VALUES(0, "Tabasco");
INSERT INTO State VALUES(0, "Tamaulipas");
INSERT INTO State VALUES(0, "Tlaxcala");
INSERT INTO State VALUES(0, "Veracruz");
INSERT INTO State VALUES(0, "Yucatan");
INSERT INTO State VALUES(0, "Zacatecas");


INSERT INTO Grade VALUES(0, "1 Primaria");
INSERT INTO Grade VALUES(0, "2 Primaria");
INSERT INTO Grade VALUES(0, "3 Primaria");
INSERT INTO Grade VALUES(0, "4 Primaria");
INSERT INTO Grade VALUES(0, "5 Primaria");
INSERT INTO Grade VALUES(0, "6 Primaria");
INSERT INTO Grade VALUES(0, "1 Secundaria");
INSERT INTO Grade VALUES(0, "2 Secundaria");
INSERT INTO Grade VALUES(0, "3 Secundaria");
INSERT INTO Grade VALUES(0, "1 Preparatoria");
INSERT INTO Grade VALUES(0, "2 Preparatoria");
INSERT INTO Grade VALUES(0, "3 Preparatoria");

INSERT INTO Course VALUES(0, "Historia", NULL);
INSERT INTO Course VALUES(0, "Espanol", NULL);
INSERT INTO Course VALUES(0, "Ingles", NULL);
INSERT INTO Course VALUES(0, "Matematicas", NULL);
INSERT INTO Course VALUES(0, "Ciencias Naturales", NULL);
INSERT INTO Course VALUES(0, "Biologia", NULL);
INSERT INTO Course VALUES(0, "Religion", NULL);
INSERT INTO Course VALUES(0, "Civica", NULL);
INSERT INTO Course VALUES(0, "Etica", NULL);
INSERT INTO Course VALUES(0, "Frances", NULL);
INSERT INTO Course VALUES(0, "Geografia", NULL);
INSERT INTO Course VALUES(0, "Musica", NULL);
INSERT INTO Course VALUES(0, "Deportes", NULL);
INSERT INTO Course VALUES(0, "Informatica", NULL);
INSERT INTO Course VALUES(0, "Ortografia", NULL);
INSERT INTO Course VALUES(0, "Probabilidad", NULL);
INSERT INTO Course VALUES(0, "Literatura", NULL);
INSERT INTO Course VALUES(0, "Ciencias Sociales", NULL);
INSERT INTO Course VALUES(0, "Grammar", NULL);
INSERT INTO Course VALUES(0, "Spelling", NULL);
INSERT INTO Course VALUES(0, "General Knowledge", NULL);
INSERT INTO Course VALUES(0, "Filosofia", NULL);
INSERT INTO Course VALUES(0, "Derecho", NULL);
INSERT INTO Course VALUES(0, "Administracion", NULL);


INSERT INTO Rol VALUES(0, "Administrador", "Puede accesar a todos los datos en la base y crear usuarios nuevos asi como isntituciones nuevas");
INSERT INTO Rol VALUES(0, "Usuario Base", "Puede accesar únicamente a los datos de su institución");
