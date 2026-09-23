-- Base de données : gestion_chaussures

CREATE DATABASE IF NOT EXISTS gestion_chaussures
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

USE gestion_chaussures;

-- Suppression des tables si elles existent déjà
DROP TABLE IF EXISTS chaussure_taille;
DROP TABLE IF EXISTS chaussure;
DROP TABLE IF EXISTS taille;
DROP TABLE IF EXISTS type;
DROP TABLE IF EXISTS marque;

-- Table des marques
CREATE TABLE marque (
    idMarque INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(50) NOT NULL,
    pays VARCHAR(50)
) ENGINE=InnoDB;

-- Table des types de chaussures
CREATE TABLE type (
    idType INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(50) NOT NULL
) ENGINE=InnoDB;

-- Table des tailles
CREATE TABLE taille (
    idTaille INT AUTO_INCREMENT PRIMARY KEY,
    valeur DECIMAL(4,1) NOT NULL
) ENGINE=InnoDB;

-- Table des chaussures
CREATE TABLE chaussure (
    idChaussure INT AUTO_INCREMENT PRIMARY KEY,
    modele VARCHAR(100) NOT NULL,
    prix DECIMAL(6,2) NOT NULL,
    couleur VARCHAR(30),
    idMarque INT NOT NULL,
    idType INT NOT NULL,

    CONSTRAINT fk_chaussure_marque
        FOREIGN KEY (idMarque) REFERENCES marque(idMarque),

    CONSTRAINT fk_chaussure_type
        FOREIGN KEY (idType) REFERENCES type(idType)
) ENGINE=InnoDB;

-- Table intermédiaire : chaussures disponibles par taille et stock
CREATE TABLE chaussure_taille (
    idChaussure INT NOT NULL,
    idTaille INT NOT NULL,
    stock INT DEFAULT 0,

    PRIMARY KEY (idChaussure, idTaille),

    CONSTRAINT fk_ct_chaussure
        FOREIGN KEY (idChaussure) REFERENCES chaussure(idChaussure)
        ON DELETE CASCADE,

    CONSTRAINT fk_ct_taille
        FOREIGN KEY (idTaille) REFERENCES taille(idTaille)
        ON DELETE CASCADE
) ENGINE=InnoDB;

-- =========================
-- DONNÉES DE TEST
-- =========================

INSERT INTO marque (nom, pays) VALUES
('Nike', 'USA'),
('Adidas', 'Allemagne'),
('Puma', 'Allemagne'),
('New Balance', 'USA');

INSERT INTO type (nom) VALUES
('Sport'),
('Running'),
('Lifestyle'),
('Randonnée');

INSERT INTO taille (valeur) VALUES
(39), (40), (41), (42), (43), (44), (45);

INSERT INTO chaussure (modele, prix, couleur, idMarque, idType) VALUES
('Air Max', 130.00, 'Noir', 1, 1),
('Superstar', 100.00, 'Blanc', 2, 3),
('Suede', 90.00, 'Noir', 3, 3),
('Ultraboost', 160.00, 'Bleu', 2, 2),
('574', 110.00, 'Gris', 4, 3),
('Air Force 1', 120.00, 'Blanc', 1, 3),
('RS-X', 115.00, 'Rouge', 3, 1);

INSERT INTO chaussure_taille (idChaussure, idTaille, stock) VALUES
(1, 3, 5),
(1, 4, 10),
(1, 5, 8),
(2, 2, 3),
(2, 3, 7),
(2, 4, 4),
(3, 4, 6),
(3, 5, 9),
(4, 5, 3),
(4, 6, 5),
(5, 4, 4),
(5, 5, 8),
(6, 3, 10),
(6, 4, 12),
(6, 5, 6),
(7, 4, 5),
(7, 5, 7);

