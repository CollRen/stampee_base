CREATE DATABASE stampee;

CREATE TABLE wuatrpaz_stampee.pays(
id INT AUTO_INCREMENT PRIMARY KEY,
nom VARCHAR(100)
);

CREATE TABLE wuatrpaz_stampee.timbre_categorie(
id INT AUTO_INCREMENT PRIMARY KEY,
nom VARCHAR(45)
);

CREATE TABLE wuatrpaz_stampee.etat_conservation(
id INT AUTO_INCREMENT PRIMARY KEY,
nom VARCHAR(45)
);

CREATE TABLE wuatrpaz_stampee.privilege (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nom VARCHAR(50) NOT NULL
);

INSERT INTO wuatrpaz_stampee.privilege
(nom)
VALUES
('Admin'),
('Membre');


CREATE TABLE wuatrpaz_stampee.user (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(50) NOT NULL,
  `username` VARCHAR(50) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  `privilege_id` INT NOT NULL,
  CONSTRAINT fk_privilege_id FOREIGN KEY (privilege_id) REFERENCES privilege (id)
);

CREATE TABLE wuatrpaz_stampee.`timbre` (
  `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `titre` VARCHAR(60) NOT NULL,
  `description` TEXT NOT NULL,
  `annee` DATE NOT NULL,
  `timbre_categorie_id` INT NOT NULL,
  `user_id` INT NOT NULL,
  `pays_id` INT NOT NULL,
  `prix_depart` DOUBLE NOT NULL,
  `authentifie` TINYINT(1) NOT NULL,
  `etat_conservation_id` INT NOT NULL,
  CONSTRAINT `fk_timbre_categorie_id`
    FOREIGN KEY (`timbre_categorie_id`)
    REFERENCES wuatrpaz_stampee.`timbre_categorie` (`id`),
  CONSTRAINT `fk_user`
    FOREIGN KEY (`user_id`)
    REFERENCES wuatrpaz_stampee.`user` (`id`),
  CONSTRAINT `fk_pays_id`
    FOREIGN KEY (`pays_id`)
    REFERENCES wuatrpaz_stampee.`pays` (`id`),
  CONSTRAINT `fk_etat_conservation`
    FOREIGN KEY (`etat_conservation_id`)
    REFERENCES wuatrpaz_stampee.`etat_conservation` (`id`));

CREATE TABLE wuatrpaz_stampee.image(
id INT AUTO_INCREMENT PRIMARY KEY,
nom VARCHAR(45) NOT NULL UNIQUE,
est_principale TINYINT(1) NOT NULL,
adresse VARCHAR(100) NOT NULL,
timbre_id INT NOT NULL,
CONSTRAINT `fk_timbre_id`
    FOREIGN KEY (`timbre_id`)
    REFERENCES wuatrpaz_stampee.`timbre` (`id`));

CREATE TABLE wuatrpaz_stampee.enchere(
id INT AUTO_INCREMENT PRIMARY KEY,
date_limite DATETIME NOT NULL,
timbre_id INT NOT NULL,
CONSTRAINT `fk_timbre_enchere_id`
    FOREIGN KEY (`timbre_id`)
    REFERENCES wuatrpaz_stampee.`timbre` (`id`));
    
CREATE TABLE wuatrpaz_stampee.enchere_favorie(
enchere_id INT,
user_id INT,
est_favorie TINYINT(1),
CONSTRAINT fk_enchere_id FOREIGN KEY (enchere_id) REFERENCES wuatrpaz_stampee.enchere (id),
CONSTRAINT fk_user_id FOREIGN KEY (user_id) REFERENCES wuatrpaz_stampee.user (id)
);

CREATE TABLE wuatrpaz_stampee.mise(
enchere_id INT,
user_id INT,
prix_offert DOUBLE NOT NULL,
CONSTRAINT fk_mise_enchere_id FOREIGN KEY (enchere_id) REFERENCES wuatrpaz_stampee.enchere (id),
CONSTRAINT fk_mise_user_id FOREIGN KEY (user_id) REFERENCES wuatrpaz_stampee.user (id)
);

INSERT INTO wuatrpaz_stampee.pays
(nom)
VALUES
('Canada');

INSERT INTO wuatrpaz_stampee.timbre_categorie
(nom)
VALUES
('de collection');

INSERT INTO wuatrpaz_stampee.user
(name, username, password, email, privilege_id)
VALUES
('admin', 'admin@me.com','$2y$10$GQsG5y6T2GDmQlwB7u8ui.FCyEnHDtlJ6rZJ.xr3ofA2kB.olsBXy', 'admin@me.com', 1);

INSERT INTO wuatrpaz_stampee.etat_conservation
(nom)
VALUES
('Parfaite'),
('Exellente'),
('Bonne'),
('Moyenne'),
('Endommagé');

INSERT INTO wuatrpaz_stampee.timbre
(titre, description, annee, timbre_categorie_id, user_id, pays_id, prix_depart, authentifie, etat_conservation_id)
VALUES
('Premier timbre', 'Le plus beau au monde','2008-11-11', 1, 1, 1, 10.14, 1, 1);


INSERT INTO wuatrpaz_stampee.enchere
(date_limite, timbre_id)
VALUES
('2024-11-11 13:23:44', 1);

INSERT INTO wuatrpaz_stampee.image
(nom, est_principale, adresse, timbre_id)
VALUES
('Image de ce timbre', '1', 'asset/img/cetibre', 1);

CREATE TABLE wuatrpaz_stampee.actualite (
id INT AUTO_INCREMENT PRIMARY KEY,
date DATETIME(6),
text TEXT(1000)
);

INSERT INTO wuatrpaz_stampee.actualite
(date, text)
VALUES
('111111', "Lord Stampee est fier d'annoncer le lancement d'une série exclusive de timbres commémoratifs en partenariat avec des artistes renommés. Ces œuvres philatéliques uniques célèbrent la diversité culturelle à travers le monde."),
('111111', "Plongez dans l'histoire postale avec notre exposition virtuelle exclusive. Explorez des timbres emblématiques qui ont marqué des moments clés de l'histoire mondiale. Une expérience immersive à ne pas manquer pour les amateurs de philatélie."),
('111111', "Notre prochaine vente aux enchères promet d'être extraordinaire avec une collection rare de timbres provenant des coins les plus reculés de la planète. Soyez prêt à saisir l'opportunité d'ajouter des joyaux philatéliques uniques à votre collection.");
