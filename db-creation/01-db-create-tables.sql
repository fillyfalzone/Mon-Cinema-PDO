CREATE DATABASE IF NOT EXISTS `Cinema-PDO-01` /*!40100 COLLATE `utf8mb4_0900_ai_ci` */;

USE `Cinema-PDO-01`;

CREATE TABLE IF NOT EXISTS Genre(
   id_genre INT NOT NULL AUTO_INCREMENT,
   label VARCHAR(255) NOT NULL,
   PRIMARY KEY(id_genre)
);

CREATE TABLE IF NOT EXISTS Role(
   id_role INT NOT NULL AUTO_INCREMENT,
   name_role VARCHAR(100) NOT NULL,
   PRIMARY KEY(id_role)
);

CREATE TABLE IF NOT EXISTS Person(
   id_person INT NOT NULL AUTO_INCREMENT,
   lastname VARCHAR(100) NOT NULL,
   firstname VARCHAR(100) NOT NULL,
   gender VARCHAR(50) NOT NULL,
   birth_date DATE NOT NULL,
   is_alive TINYINT(1) NOT NULL,
   PRIMARY KEY(id_person)
);

CREATE TABLE IF NOT EXISTS Actor(
   id_actor INT NOT NULL AUTO_INCREMENT,
   id_person INT NOT NULL,
   PRIMARY KEY(id_actor),
   UNIQUE(id_person),
   FOREIGN KEY(id_person) REFERENCES Person(id_person)
);

CREATE TABLE IFid_personTS Director(
   id_director INT NOT NULL AUTO_INCREMENT,
   id_person INT NOT NULL,
   PRIMARY KEY(id_director),
   UNIQUE(id_person),
   FOREIGN KEY(id_person) REFERENCES Person(id_person)
);

CREATE TABLE IF NOT EXISTS Movie(
   id_movie INT NOT NULL AUTO_INCREMENT,
   release_date DATE NOT NULL,
   duration_ INT NOT NULL,
   synopsy VARCHAR(500) NOT NULL,
   notation INT NOT NULL,
   poster VARCHAR(255) NOT NULL,
   id_director INT NOT NULL,
   PRIMARY KEY(id_movie),
   FOREIGN KEY(id_director) REFERENCES Director(id_director)
);

CREATE TABLE IF NOT EXISTS belongs(
   id_genre INT,
   id_movie INT,
   PRIMARY KEY(id_genre, id_movie),
   FOREIGN KEY(id_genre) REFERENCES Genre(id_genre),
   FOREIGN KEY(id_movie) REFERENCES Movie(id_movie)
);

CREATE TABLE IF NOT EXISTS Casting(
   id_movie INT,
   id_role INT,
   id_actor INT,
   PRIMARY KEY(id_movie, id_role, id_actor),
   FOREIGN KEY(id_movie) REFERENCES Movie(id_movie),
   FOREIGN KEY(id_role) REFERENCES Role(id_role),
   FOREIGN KEY(id_actor) REFERENCES Actor(id_actor)
);
