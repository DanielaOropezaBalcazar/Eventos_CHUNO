-- Created by Vertabelo (http://vertabelo.com)
-- Last modification date: 2025-03-08 21:23:32.604

-- tables
-- Table: Asistente
CREATE TABLE Asistente (
    idAsistente int  NOT NULL,
    Gmail varchar(100)  NOT NULL,
    CONSTRAINT Asistente_pk PRIMARY KEY (idAsistente)
);

-- Table: Charlas
CREATE TABLE Charlas (
    idCharla int  NOT NULL,
    Nombre varchar(100)  NOT NULL,
    Institucion varchar(100)  NOT NULL,
    Hora time  NOT NULL,
    Fecha date  NOT NULL,
    LinkReunion varchar(50)  NOT NULL,
    Codigo varchar(50)  NOT NULL,
    LinkPresentacion varchar(100)  NOT NULL,
    Likes int  NOT NULL,
    Dislikes int  NOT NULL,
    Estado boolean  NOT NULL,
    idOrador int  NOT NULL,
    idModalidad int  NOT NULL,
    idDepartamento int  NOT NULL,
    CONSTRAINT Charlas_pk PRIMARY KEY (idCharla)
);

-- Table: CharlasAsistentes
CREATE TABLE CharlasAsistentes (
    idCA int  NOT NULL,
    idAsistente int  NOT NULL,
    idCharla int  NOT NULL,
    CONSTRAINT Charlas-Asistentes_pk PRIMARY KEY (idCA)
);

-- Table: Departamento
CREATE TABLE Departamento (
    idDepartamento int  NOT NULL,
    Departamento varchar(100)  NOT NULL,
    CONSTRAINT Departamento_pk PRIMARY KEY (idDepartamento)
);

-- Table: Modalidad
CREATE TABLE Modalidad (
    idModalidad int  NOT NULL,
    Modalidad char(50)  NOT NULL,
    CONSTRAINT Modalidad_pk PRIMARY KEY (idModalidad)
);

-- Table: Orador
CREATE TABLE Orador (
    idOrador int  NOT NULL,
    Nombre varchar(100)  NOT NULL,
    Gmail varchar(100)  NOT NULL,
    Contrasena varchar(100)  NOT NULL,
    Calificacion decimal(10,2)  NOT NULL,
    CONSTRAINT Orador_pk PRIMARY KEY (idOrador)
);

-- foreign keys
-- Reference: CharlasAsistentes_Asistentes (table: CharlasAsistentes)
ALTER TABLE CharlasAsistentes ADD CONSTRAINT CharlasAsistentes_Asistentes FOREIGN KEY CharlasAsistentes_Asistentes (idAsistente)
    REFERENCES Asistente (idAsistente);

-- Reference: CharlasAsistentes_Charlas (table: CharlasAsistentes)
ALTER TABLE CharlasAsistentes ADD CONSTRAINT CharlasAsistentes_Charlas FOREIGN KEY CharlasAsistentes_Charlas (idCharla)
    REFERENCES Charlas (idCharla);

-- Reference: Charlas_Departamento (table: Charlas)
ALTER TABLE Charlas ADD CONSTRAINT Charlas_Departamento FOREIGN KEY Charlas_Departamento (idDepartamento)
    REFERENCES Departamento (idDepartamento);

-- Reference: Charlas_Modalidad (table: Charlas)
ALTER TABLE Charlas ADD CONSTRAINT Charlas_Modalidad FOREIGN KEY Charlas_Modalidad (idModalidad)
    REFERENCES Modalidad (idModalidad);

-- Reference: Charlas_Oradores (table: Charlas)
ALTER TABLE Charlas ADD CONSTRAINT Charlas_Oradores FOREIGN KEY Charlas_Oradores (idOrador)
    REFERENCES Orador (idOrador);

-- End of file.

