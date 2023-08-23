-- Requêtes de la bdd

-- a) Informations d’un film (id_film) : titre, année, durée (au format HH:MM) et  réalisateur
SELECT m.id_movie, m.title, DATE_FORMAT(m.release_date, "%Y") AS anneeDeSortie, DATE_FORMAT(SEC_TO_TIME(m.duration*60), "%H:%i") AS Duration, CONCAT(p.lastname, ' ', p.firstname) AS Realisateur 
FROM movie m
INNER JOIN director d ON d.id_director = m.id_movie
INNER JOIN person p ON d.id_person = p.id_person;

-- b) Liste des films dont la durée excède 2h15 classés par durée (du + long au + court)
SELECT m.title, m.duration
FROM movie m 
WHERE m.duration > 135;

-- c) Liste des films d’un réalisateur (en précisant l’année de sortie)
SELECT CONCAT(p.firstname, ' ', p.lastname) AS Realisateur, m.title
FROM director d
INNER JOIN movie m ON m.id_director = d.id_director
INNER JOIN person p ON p.id_person = d.id_person

-- d) Nombre de films par genre (classés dans l’ordre décroissant)
SELECT g.label, COUNT(m.id_movie) AS NombreDeFilms
FROM genre g 
INNER JOIN belongs b ON g.id_genre = b.id_genre
INNER JOIN movie m ON m.id_movie = b.id_movie
ORDER BY NombreDeFilms DESC
GROUP BY g.label;

-- e) Nombre de films par réalisateur (classés dans l’ordre décroissant)
SELECT d.id_director, CONCAT(p.firstname, ' ', p.lastname) AS Realisateur, COUNT(m.id_movie) AS NombreDeFilms
FROM director d 
INNER JOIN person p ON p.id_person = d.id_person
INNER JOIN movie m ON m.id_director = d.id_director
GROUP BY d.id_director, Realisateur;

-- f) Casting d’un film en particulier (id_film) : nom, prénom des acteurs + sexe
SELECT  m.title, CONCAT(p.firstname, ' ', p.lastname) AS Acteur, p.gender
FROM casting c
INNER JOIN actor a ON a.id_actor = c.id_actor
INNER JOIN person p ON p.id_person = a.id_person
INNER JOIN movie m ON c.id_movie = m.id_movie
WHERE c.id_movie = 2;

-- g) Films tournés par un acteur en particulier (id_acteur) avec leur rôle et l’année de sortie (du film le plus récent au plus ancien)

SELECT m.title, r.name_role, DATE_FORMAT(m.release_date, "%Y") AS AnneeSortie
FROM casting c
INNER JOIN actor a ON a.id_actor = c.id_actor
INNER JOIN movie m ON m.id_movie = c.id_movie
INNER JOIN role r ON r.id_role = c.id_role
WHERE a.id_actor = 3
ORDER BY AnneeSortie DESC 

-- h) Liste des personnes qui sont à la fois acteurs et réalisateurs
SELECT CONCAT(p.firstname, ' ', p.lastname) AS Acteur_Realisateur 
FROM person p 
INNER JOIN actor a ON p.id_person = a.id_person
INNER JOIN director d ON p.id_person = d.id_person;

-- i) Liste des films qui ont moins de 5 ans (classés du plus récent au plus ancien)
SELECT m.title, DATE_FORMAT(m.release_date, "%Y") AS AnneeSortie
FROM movie m 
HAVING  AnneeSortie >= 2005
ORDER BY AnneeSortie DESC ;

-- j) Nombre d’hommes et de femmes parmi les acteurs

SELECT (SELECT COUNT(p1.id_person)  FROM person p1 INNER JOIN actor a1 ON p1.id_person = a1.id_person WHERE p1.gender = 'Female') AS Actrices,
	   ( SELECT COUNT(p2.id_person)  FROM person p2 INNER JOIN actor a2 ON p2.id_person = a2.id_person WHERE p2.gender = 'Male') AS Acteurs		 
FROM person p
INNER JOIN actor a ON a.id_person = p.id_person 
LIMIT 1

-- k) Liste des acteurs ayant plus de 50 ans (âge révolu et non révolu)
SELECT CONCAT(p.firstname, ' ', p.lastname) AS Acteurs, YEAR(CURDATE()) - YEAR(p.birth_date) AS Age
FROM person p
INNER JOIN actor a ON a.id_person = p.id_person
HAVING Age >= 50
ORDER BY age DESC;

-- l) Acteurs ayant joué dans 3 films ou plus
SELECT CONCAT(p.firstname, ' ', p.lastname) AS Acteurs, COUNT(m.id_movie) AS NombreFilms 
FROM actor a 
INNER JOIN person p ON p.id_person = a.id_person
INNER JOIN casting c ON c.id_actor = a.id_actor
INNER JOIN movie m ON m.id_movie = c.id_movie
GROUP BY Acteurs 
HAVING NombreFilms  >= 3; 