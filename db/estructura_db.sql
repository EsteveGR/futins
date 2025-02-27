DROP DATABASE IF EXISTS cromos_db;

CREATE DATABASE cromos_db;

USE cromos_db;
-- Afegim la taula d’equips
CREATE TABLE equips (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    escut VARCHAR(255) DEFAULT NULL
    -- Foreing Key a la taula alineacions
);

USE cromos_db;
-- Inserim el primer registre "Sense equip"
INSERT INTO equips (nom) VALUES ('Sense equip');

Create table posicions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(50) NOT NULL
);

USE cromos_db;
-- Inserim les posicions
INSERT INTO posicions (nom) VALUES ('Porter');
INSERT INTO posicions (nom) VALUES ('Defensa');
INSERT INTO posicions (nom) VALUES ('Migcampista');
INSERT INTO posicions (nom) VALUES ('Davanter');

USE cromos_db;
-- Afegim la taula d’entrenadors
Create table entrenadors (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    cognoms VARCHAR(100) NOT NULL,
    foto VARCHAR(255) DEFAULT NULL,
    equip_id INT,
    FOREIGN KEY (equip_id) REFERENCES equips(id) ON DELETE SET NULL
);

USE cromos_db;
-- Afegim la taula de futbolistes
CREATE TABLE futbolistes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    foto VARCHAR(255) DEFAULT NULL,
    nom VARCHAR(100) NOT NULL,
    any_neixament INT,
    equip_id INT,
    FOREIGN KEY (equip_id) REFERENCES equips(id) ON DELETE SET NULL,
    posicio_id INT,
    FOREIGN KEY (posicio_id) REFERENCES posicions(id) ON DELETE SET NULL
);

----BORRADOR-----ALINEACIONS-------------------------

USE cromos_db;
-- Afegim la taula d’alineacions
CREATE TABLE alineacions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    equip_id INT UNIQUE,  -- Cada equip només pot tenir UNA alineació
    sistema VARCHAR(10) NOT NULL, -- Exemple: "4-4-2", "5-3-2"
);

Create table alineacions_equips (
    id INT AUTO_INCREMENT PRIMARY KEY,
    alineacio_id INT,
    equip_id INT,
    posicio VARCHAR(50),
    futbolista_id INT,
    FOREIGN KEY (alineacio_id) REFERENCES alineacions(id) ON DELETE CASCADE,
    FOREIGN KEY (equip_id) REFERENCES equips(id) ON DELETE CASCADE,
    FOREIGN KEY (futbolista_id) REFERENCES futbolistes(id) ON DELETE CASCADE
);

