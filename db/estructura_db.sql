DROP DATABASE IF EXISTS cromos_db;

CREATE DATABASE cromos_db;
USE cromos_db;

CREATE TABLE futbolistes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    equip VARCHAR(100),
    posicio VARCHAR(50),
    any_neixament INT,
    imatge VARCHAR(255) DEFAULT NULL
);

USE cromos_db;
-- Afegim la taula d’equips
CREATE TABLE equips (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL
    -- Foreing Key a la taula alineacions
);

USE cromos_db;
-- Modifiquem la taula futbolistes perquè cada jugador tingui un equip
ALTER TABLE futbolistes ADD COLUMN equip_id INT;
ALTER TABLE futbolistes ADD CONSTRAINT fk_futbolistes_equip FOREIGN KEY (equip_id) REFERENCES equips(id) ON DELETE SET NULL;

USE cromos_db;
ALTER TABLE futbolistes DROP COLUMN equip;

USE cromos_db;
-- Afegim la taula d’alineacions
CREATE TABLE alineacions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    equip_id INT UNIQUE,  -- Cada equip només pot tenir UNA alineació
    sistema VARCHAR(10) NOT NULL, -- Exemple: "4-4-2", "5-3-2"
    FOREIGN KEY (equip_id) REFERENCES equips(id) ON DELETE CASCADE
);

