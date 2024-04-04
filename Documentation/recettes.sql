CREATE DATABASE timbres;

CREATE TABLE etat(
id INT AUTO_INCREMENT PRIMARY KEY,
nom VARCHAR(45),
prenom VARCHAR(45)
);

CREATE TABLE timbre_categorie(
id INT AUTO_INCREMENT PRIMARY KEY,
nom VARCHAR(45)
);

CREATE TABLE timbre(
id INT AUTO_INCREMENT PRIMARY KEY,
titre VARCHAR(60),
description TEXT,
annee DOUBLE,
prix_depart DOUBLE,
timbre_categorie_id INT NOT NULL,
etat_conservation_id INT
);

CREATE TABLE timbre_categorie(
id INT AUTO_INCREMENT PRIMARY KEY,
nom VARCHAR(45)
);

CREATE TABLE pays(
id INT AUTO_INCREMENT PRIMARY KEY,
nom VARCHAR(20)
);

CREATE TABLE enchere(
id INT AUTO_INCREMENT PRIMARY KEY,
nom VARCHAR(45) NOT NULL UNIQUE,
timbre_id INT NOT NULL
);

CREATE TABLE timbre_has_enchere(
id INT AUTO_INCREMENT PRIMARY KEY,
timbre_id INT,
enchere_id INT,
quantite VARCHAR(45),
unite_mesure_id INT,
CONSTRAINT fk_timbre_id FOREIGN KEY (timbre_id) REFERENCES timbre (id),
CONSTRAINT fk_enchere_id FOREIGN KEY (enchere_id) REFERENCES enchere (id),
CONSTRAINT fk_unite_mesure_id FOREIGN KEY (unite_mesure_id) REFERENCES pays (id)
);

INSERT INTO `timbres`.`timbre_categorie`
(`nom`)
VALUES ('Les épices'),
('Fromage'),
('Viande'),
('Fines herbes'),
('Fruit'),
('Légume');


INSERT INTO `timbres`.`enchere`
(
`nom`,
`timbre_id`)
VALUES (
'Sel de célerie',
1);

INSERT INTO `timbres`.`timbre_categorie` (`id`, `nom`) VALUES 
(NULL, 'Dessert'),
(NULL, 'Plats principaux');

INSERT INTO `timbres`.`etat` (`nom`, `prenom`) VALUES 
('de Montigny', 'René'),
('Dallair', 'Ismael'),
('Young', 'Robert'),
('Martel', 'Didier'),
('Larrivée', 'Ricardo'),
('Dubé', 'Nancy');

INSERT INTO `timbres`.`timbre` (`id`, `titre`, `description`, `annee`, `prix_depart`, `timbre_categorie_id`, `etat_conservation_id`) VALUES 
(NULL, 'Dessert cool','Ceci décrivant celà', 11, 11, 1, 1),
(NULL, 'Ceci décrivant celà', 'Dessert cool', 10, 10, 1, 1);

INSERT INTO `pays` (`id`, `nom`) VALUES
(1, 'tsp'),
(2, 'Tbs'),
(3, 'ml'),
(4, '---'),
(5, 'lb'),
(6, 'gr'),
(7, '---'),
(8, 'oz'),
(9, 'Cup');

INSERT INTO `timbres`.`timbre_has_enchere`
(`timbre_id`,
`enchere_id`,
`quantite`,
`unite_mesure_id`)
VALUES
(1,
1,
2,
1);

INSERT INTO `timbres`.`timbre_has_enchere`
(`timbre_id`,
`enchere_id`,
`quantite`,
`unite_mesure_id`)
VALUES
(1,1,1,1);



CREATE TABLE timbres.user (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(50) NOT NULL,
  `username` VARCHAR(50) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  `privilege_id` INT NOT NULL,
  `create_at` TIMESTAMP
);

CREATE TABLE timbres.privilege (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `privilege` VARCHAR(50) NOT NULL
);

INSERT INTO timbres.privilege (`privilege`) VALUES
('Admin'),
('Manager'),
('Etat');


INSERT INTO `timbres` .`user` (`id`, `name`, `username`, `password`, `email`, `privilege_id`) VALUES
(0, 'guest', 'guest@guest.com', '$2y$10$GQsG5y6T2GDmQlwB7u8ui.FCyEnHDtlJ6rZJ.xr3ofA2kB.olsBXy', 'guest@guest.com', 0),
(1, 'René', 'rensax@me.com', '$2y$10$GQsG5y6T2GDmQlwB7u8ui.FCyEnHDtlJ6rZJ.xr3ofA2kB.olsBXy', 'rensax@me.com', 1),
(2, 'manager', 'manager@me.com', '$2y$10$lw8CfdVUs1MfC94mp4v0WuwptDgPogUI8SkitBQKUMXvLr6ipqIl.', 'manager@me.com', 2),
(3, 'etat', 'etat@me.com', '$2y$10$7i65cP/wEtdbijq3rW3.mObL/OUuH6UbK42K7tOoys7t9O4DimY/i', 'etat@me.com', 3),
(4, 'admin', 'admin@me.com', '$2y$10$BtF.zfwv297COxJf5uk91eQfNh07mEjzMAcdyLfKWB32KRMidE.jK', 'admin@me.com', 1);


INSERT INTO `timbres`. `privilege` (`id`, `privilege`) VALUES
(0, 'guest');