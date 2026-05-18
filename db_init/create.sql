-- GI3P - Gestió d'Incidencies Informatiques - G2 --

SET NAMES utf8mb4;

USE a25abualijab_DAM1_GI3P_Grup2;

CREATE TABLE IF NOT EXISTS departaments (
    id_dept INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL UNIQUE
);

CREATE TABLE IF NOT EXISTS tecnics (
    id_tecnic INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL
);

CREATE TABLE IF NOT EXISTS tipus_incidencia (
    id_tipus INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(50) NOT NULL UNIQUE
);

CREATE TABLE IF NOT EXISTS incidencies (
    id_inc INT AUTO_INCREMENT PRIMARY KEY,
    descripcio TEXT NOT NULL,
    data_ini DATE NOT NULL,
    data_fi DATE NULL,
    prioritat ENUM('Alta', 'Mitja', 'Baixa') NOT NULL,
    departament_id INT NOT NULL,
    tecnic_id INT NULL,
    tipus_id INT NULL,
    FOREIGN KEY (departament_id) REFERENCES departaments(id_dept),
    FOREIGN KEY (tecnic_id) REFERENCES tecnics(id_tecnic),
    FOREIGN KEY (tipus_id) REFERENCES tipus_incidencia(id_tipus)
);

CREATE TABLE IF NOT EXISTS actuacions (
    id_actuacio INT AUTO_INCREMENT PRIMARY KEY,
    descripcio TEXT NOT NULL,
    data_actuacio DATETIME NOT NULL,
    temps_minuts INT NOT NULL,
    visible_usuari BOOLEAN NOT NULL,
    incidencia_id INT NOT NULL,
    FOREIGN KEY (incidencia_id) REFERENCES incidencies(id_inc) ON DELETE CASCADE
);


INSERT IGNORE INTO departaments (nom) VALUES 
('Ciències Naturals'),
('Matemàtiques'),
('Llengua Catalana'),
('Tecnologia'),
('Educació Física'),
('Història'),
('Anglès'),
('Filosofia'),
('Música'),
('Plàstica');

INSERT IGNORE INTO tecnics (nom) VALUES 
('Zynox'),
('Kaelen'),
('Vexor'),
('Thornn'),
('Grynn');

INSERT IGNORE INTO tipus_incidencia (nom) VALUES 
('Hardware'),
('Software'),
('Xarxa'),
('Impressora'),
('Altres');