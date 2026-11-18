
USE gabyalaprod_bd;

CREATE TABLE admin (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL
)
ENGINE=InnoDB;
desc admin;


CREATE TABLE prod (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(255) NOT NULL,
    bpm INT NOT NULL,
    cle VARCHAR(10) NOT NULL,
    chemin VARCHAR(255) NOT NULL
)
ENGINE=InnoDB;
desc prod;
ALTER TABLE prod ADD type VARCHAR(50) NOT NULL DEFAULT 'Inconnu';

INSERT INTO prod (nom, bpm, cle, chemin, type) VALUES
("Afrique", 134, "Fa", "Afrique.mp3","Afro"),
("Bizzaroïde", 130, "Am", "bizzaroide.mp3","Trap"),
("La drill ou quoi", 144, "Mi", "La_drill_ou_quoi.mp3","Drill"),
("C'est cramé", 90, "Mi", "C_est_crame.wav","Drill"),
("ETE Cousin V2", 126, "Mi", "ETE Cousin V2.mp3","Club");

INSERT INTO admin (username, password) VALUES
("gabyalaprod", "$2y$10$cfPk8dNIVYXzrr2VPg/Ub.aO4FhpZNgB3CjJ3w62TCmXX.hPU7gDK")

